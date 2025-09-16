<?php

namespace Bimp\Forge\Console\Command\Make;

use Bimp\Forge\Console\Command\Command;
use Bimp\Forge\Database\Database;

class DatabasePing implements Command {

    public static function name(): string {
        return 'db:ping';
    }

    public static function description(): string {
        return 'Verifica la conexión a la base de datos';
    }

    public function execute(array $args): int {
        echo "Verificando conexión a la base de datos..." . PHP_EOL;

        try {
            $v = Database::query('SELECT VERSION()');
            echo "Conexión exitosa. Versión de la base de datos: " . array_values($v[0])[0] . PHP_EOL;
            return 0;
        } catch (\Exception $e) {
            fwrite(STDERR, "Error: No se pudo conectar a la base de datos. " . $e->getMessage() . PHP_EOL);
            return 1;
        }
    }
}