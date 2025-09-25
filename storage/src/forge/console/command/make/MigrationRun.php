<?php
declare(strict_types=1);

namespace Bimp\Forge\Console\Command\Make;

use PDO;
use PDOException;
use Bimp\Forge\Console\Command\Command;
use Bimp\Forge\Console\Input\InputManager;

class MigrationRun implements Command
{
    public static function name(): string {
        return 'migrate:run';
    }

    public static function description(): string {
        return 'Ejecuta las migraciones pendientes; crea la BD si no existe.';
    }

    public function execute(array $args): int
    {
        // -------- Flags --------
        $dirArg      = null;         // --dir=path
        $table       = 'forge_migrations'; // --table=nombre
        $steps       = null;         // --steps=N
        $pretend     = false;        // --pretend  (solo muestra)
        $createDb    = false;        // --create-db (no pregunta)
        $silent      = false;        // --silent (menos output)

        foreach ($args as $a) {
            if (str_starts_with($a, '--dir='))       $dirArg   = substr($a, 6);
            if (str_starts_with($a, '--table='))     $table    = substr($a, 8);
            if (str_starts_with($a, '--steps='))     $steps    = (int) substr($a, 8);
            if ($a === '--pretend')                  $pretend  = true;
            if ($a === '--create-db')                $createDb = true;
            if ($a === '--silent')                   $silent   = true;
        }

        // -------- Raíz del proyecto --------
        $root = realpath(dirname(__DIR__, 6));
        if ($root === false) {
            fwrite(STDERR, "No se pudo resolver la ruta raíz del proyecto.\n");
            return 1;
        }

        // -------- Cargar .env --------
        $env = $this->loadEnv($root . DIRECTORY_SEPARATOR . '.env');
        $engine  = $env['DB_ENGINE'] ?? 'mysql';
        $host    = $env['DB_HOST']   ?? '127.0.0.1';
        $port    = (int)($env['DB_PORT'] ?? 3306);
        $dbname  = $env['DB_NAME']   ?? '';
        $user    = $env['DB_USER']   ?? 'root';
        $pass    = $env['DB_PASS']   ?? '';
        $charset = ($env['DB_CHARSET'] ?? 'utf8mb4') ?: 'utf8mb4';

        if ($engine !== 'mysql') {
            fwrite(STDERR, "Por ahora solo se soporta DB_ENGINE=mysql (recibido: {$engine}).\n");
            return 1;
        }
        if ($dbname === '') {
            fwrite(STDERR, "DB_NAME no definido en .env\n");
            return 1;
        }

        // -------- Conexión y creación de BD --------
        try {
            $pdo = $this->connectMySQL($host, $port, $dbname, $user, $pass, $charset);
        } catch (PDOException $e) {
            // Si la base no existe, ofrece crearla
            if (strpos($e->getMessage(), 'Unknown database') !== false) {
                if ($createDb || InputManager::confirm("La base '{$dbname}' no existe. ¿Crear ahora? (S/N) [S]: ", true)) {
                    try {
                        $serverPdo = $this->connectMySQL($host, $port, null, $user, $pass, $charset);
                        $serverPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbname}` CHARACTER SET {$charset} COLLATE {$charset}_general_ci");
                        if (!$silent) echo "Base de datos creada: {$dbname}\n";
                        $pdo = $this->connectMySQL($host, $port, $dbname, $user, $pass, $charset);
                    } catch (PDOException $ex) {
                        fwrite(STDERR, "No se pudo crear/conectar a la BD: " . $ex->getMessage() . "\n");
                        return 1;
                    }
                } else {
                    fwrite(STDERR, "Abortado: BD inexistente.\n");
                    return 1;
                }
            } else {
                fwrite(STDERR, "Error de conexión: " . $e->getMessage() . "\n");
                return 1;
            }
        }

        // -------- Tabla de control de migraciones --------
        $this->ensureMigrationsTable($pdo, $table);

        // -------- Directorio de migraciones --------
        $migrationsDir = $dirArg ?: $this->pickFirstExistingDir([
            $root . '/database/migrations/',
            $root . '/storage/database/migrations/',
            $root . '/app/database/migrations/',
        ], $root . '/database/migrations/');

        if (!is_dir($migrationsDir)) {
            if (!@mkdir($migrationsDir, 0777, true)) {
                fwrite(STDERR, "No existe y no se pudo crear el directorio de migraciones: {$migrationsDir}\n");
                return 1;
            }
        }

        // -------- Obtener migraciones pendientes --------
        $files = $this->findMigrationFiles($migrationsDir);
        if (empty($files)) {
            if (!$silent) echo "No se encontraron archivos de migración en: {$migrationsDir}\n";
            return 0;
        }

        $aplicadas = $this->appliedMigrations($pdo, $table); // set de nombres ya aplicados
        $pendientes = array_values(array_filter($files, fn($f) => !isset($aplicadas[$f['name']])));

        if (empty($pendientes)) {
            if (!$silent) echo "No hay migraciones pendientes. ✔\n";
            return 0;
        }

        if (!$silent) {
            echo "Pendientes: " . count($pendientes) . "\n";
            foreach ($pendientes as $p) echo " - {$p['base']}\n";
        }

        // -------- Ejecutar (por lotes) --------
        $batch = $this->nextBatch($pdo, $table);
        $count = 0;

        foreach ($pendientes as $mig) {
            if ($steps !== null && $count >= $steps) break;

            $ok = $this->runSingleMigration($pdo, $mig, $pretend);
            if (!$ok) {
                fwrite(STDERR, "Error al ejecutar migración: {$mig['base']}\n");
                return 1;
            }

            if (!$pretend) {
                $this->markApplied($pdo, $table, $mig['name'], $batch);
            }

            if (!$silent) echo "✔ " . ($pretend ? "[pretend] " : "") . "{$mig['base']} aplicada\n";
            $count++;
        }

        if (!$silent) echo "Listo. " . ($pretend ? "(simulado) " : "") . "Migraciones ejecutadas: {$count}\n";
        return 0;
    }

    // ================= Helpers =================

    private function loadEnv(string $path): array {
        $out = [];
        if (!is_file($path)) return $out;
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) continue;
            $eq = strpos($line, '=');
            if ($eq === false) continue;
            $key = trim(substr($line, 0, $eq));
            $val = trim(substr($line, $eq + 1));
            // quita comillas
            if ((str_starts_with($val, '"') && str_ends_with($val, '"')) ||
                (str_starts_with($val, "'") && str_ends_with($val, "'"))) {
                $val = substr($val, 1, -1);
            }
            $out[$key] = $val;
        }
        return $out;
    }

    private function connectMySQL(string $host, int $port, ?string $db, string $user, string $pass, string $charset): PDO {
        $dsn = $db
            ? "mysql:host={$host};port={$port};dbname={$db};charset={$charset}"
            : "mysql:host={$host};port={$port};charset={$charset}";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        // Ajustes útiles
        $pdo->exec("SET NAMES {$charset}");
        return $pdo;
    }

    private function ensureMigrationsTable(PDO $pdo, string $table): void {
        $sql = "
            CREATE TABLE IF NOT EXISTS `{$table}` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `migration` VARCHAR(255) NOT NULL UNIQUE,
              `batch` INT UNSIGNED NOT NULL,
              `ran_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        ";
        $pdo->exec($sql);
    }

    private function appliedMigrations(PDO $pdo, string $table): array {
        $stmt = $pdo->query("SELECT migration FROM `{$table}`");
        $set = [];
        foreach ($stmt as $row) {
            $set[$row['migration']] = true;
        }
        return $set;
    }

    private function nextBatch(PDO $pdo, string $table): int {
        $stmt = $pdo->query("SELECT MAX(batch) AS b FROM `{$table}`");
        $max = (int)($stmt->fetchColumn() ?: 0);
        return $max + 1;
    }

    private function markApplied(PDO $pdo, string $table, string $name, int $batch): void {
        $q = $pdo->prepare("INSERT INTO `{$table}` (migration, batch) VALUES (?, ?)");
        $q->execute([$name, $batch]);
    }

    /**
     * Busca migraciones en $dir con estos formatos:
     *  - PHP:  20250924_foo.php   (retorna objeto con up(PDO) / down(PDO) o array ['up'=>callable, 'down'=>callable])
     *  - SQL:  20250924_foo.up.sql  y opcional 20250924_foo.down.sql
     */
    private function findMigrationFiles(string $dir): array {
        $out = [];

        // PHP
        foreach (glob($dir . '/*.php') ?: [] as $file) {
            $base = basename($file);
            $name = $base; // nombre único almacenado en tabla
            $out[] = [
                'type' => 'php',
                'file' => $file,
                'base' => $base,
                'name' => $name,
            ];
        }

        // SQL (solo .up.sql; down será homónimo .down.sql)
        foreach (glob($dir . '/*.up.sql') ?: [] as $file) {
            $base = basename($file);
            $name = $base; // puedes usar base sin .up.sql si prefieres
            $out[] = [
                'type'    => 'sql',
                'file'    => $file,
                'base'    => $base,
                'name'    => $name,
                'downSql' => preg_replace('/\.up\.sql$/', '.down.sql', $file),
            ];
        }

        // Orden por nombre (timestamp_* primero naturalmente)
        usort($out, fn($a, $b) => strcmp($a['base'], $b['base']));
        return $out;
    }

    private function runSingleMigration(PDO $pdo, array $mig, bool $pretend): bool {
        try {
            $pdo->beginTransaction();

            if ($mig['type'] === 'sql') {
                $sql = file_get_contents($mig['file']);
                if ($sql === false) throw new \RuntimeException("No se pudo leer {$mig['file']}");

                if ($pretend) {
                    echo "---- SQL ({$mig['base']}) ----\n{$sql}\n-------------------------------\n";
                } else {
                    $pdo->exec($sql);
                }
            } else { // php
                $runner = $this->loadPhpMigration($mig['file']);
                if ($runner === null) {
                    throw new \RuntimeException("Migración PHP inválida: {$mig['file']}");
                }

                if ($pretend) {
                    echo "---- PHP ({$mig['base']}) ----\n// up(PDO \$pdo) será ejecutado\n-------------------------------\n";
                } else {
                    // Ejecuta up(PDO)
                    $runner->up($pdo);
                }
            }

            $pdo->commit();
            return true;

        } catch (\Throwable $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            fwrite(STDERR, "Error en {$mig['base']}: " . $e->getMessage() . "\n");
            return false;
        }
    }

    /**
     * Carga un archivo PHP de migración y obtiene un objeto con métodos up(PDO) y down(PDO).
     * Formatos soportados:
     *  1) El archivo retorna un objeto con up()/down().
     *  2) El archivo retorna ['up'=>callable, 'down'=>callable] (se envuelven en un objeto).
     *  3) El archivo define una clase con up()/down(); se toma la última clase definida.
     */
    private function loadPhpMigration(string $file): ?object
    {
        $before = get_declared_classes();
        $ret = require $file;

        // Caso 1: retorna objeto con up()/down()
        if (is_object($ret) && method_exists($ret, 'up')) {
            return $ret;
        }

        // Caso 2: retorna array de callables
        if (is_array($ret) && isset($ret['up']) && is_callable($ret['up'])) {
            $up = $ret['up'];
            $down = $ret['down'] ?? function(PDO $pdo){};
            return new class($up, $down) {
                private $u; private $d;
                public function __construct($u, $d){ $this->u=$u; $this->d=$d; }
                public function up(PDO $pdo){ ($this->u)($pdo); }
                public function down(PDO $pdo){ ($this->d)($pdo); }
            };
        }

        // Caso 3: busca nueva clase con up()/down()
        $after = get_declared_classes();
        $new = array_diff($after, $before);
        foreach (array_reverse($new) as $cls) {
            if (method_exists($cls, 'up')) {
                return new $cls();
            }
        }

        return null;
    }

    private function pickFirstExistingDir(array $candidates, string $fallback): string {
        foreach ($candidates as $dir) {
            if (is_dir($dir)) return rtrim($dir, '/\\') . DIRECTORY_SEPARATOR;
        }
        return rtrim($fallback, '/\\') . DIRECTORY_SEPARATOR;
    }
}
