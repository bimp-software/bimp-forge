<?php

namespace Bimp\Forge\Console\Command\Make;

use Bimp\Forge\Console\Support\Process;
use Bimp\Forge\Console\Command\Command;
use Bimp\Forge\Console\Input\InputManager; // lo puedes usar si quieres

class Controller implements Command {

    private function getProject(): string {
        return basename(dirname(__DIR__, 6));
    }

    public static function name(): string {
        return 'make:controller';
    }

    public static function description(): string {
        return 'Crea un controlador (opcionalmente genera carpeta y vista, con o sin Twig).';
    }

    public function execute(array $args): int {
        // --- Defaults
        $keyword   = 'Controller';
        $useTwig   = null;   // null => preguntar
        $makeView  = null;   // null => preguntar
        $force     = false;
        $nameArg   = null;

        // --- Parseo de argumentos tipo --name=Home --view=y --twig=n --force
        foreach ($args as $arg) {
            if (str_starts_with($arg, '--name='))   $nameArg  = substr($arg, 7);
            if (str_starts_with($arg, '--view='))   $makeView = InputManager::toBool(substr($arg, 7));
            if (str_starts_with($arg, '--twig='))   $useTwig  = InputManager::toBool(substr($arg, 7));
            if ($arg === '--force' || $arg === '-f') $force   = true;
        }

        // --- 0) Raíz del proyecto (sube 6 niveles desde /storage/src/forge/console/command/make)
        $root = realpath(dirname(__DIR__, 6));
        if ($root === false) {
            fwrite(STDERR, "No se pudo resolver la ruta raíz del proyecto.\n");
            return 1;
        }

        // --- 0.1) Directorios candidatos para controllers y views
        $controllersDir = $this->pickFirstExistingDir([
            $root . '/app/controllers/',
            $root . '/app/Controllers/',
            $root . '/controllers/',
            $root . '/app/http/controllers/',
            $root . '/app/http/Controllers/',
        ], $root . '/app/controllers/'); // fallback si no existe ninguno

        $viewsDir = $this->pickFirstExistingDir([
            $root . '/templates/views/',
            $root . '/templates/Views/',
            $root . '/views/',
        ], $root . '/templates/views/');

        // Asegura carpetas base si no existen
        if (!is_dir($controllersDir) && !@mkdir($controllersDir, 0777, true)) {
            fwrite(STDERR, "No se pudo crear la carpeta de controladores: {$controllersDir}\n");
            return 1;
        }
        if (!is_dir($viewsDir) && !@mkdir($viewsDir, 0777, true)) {
            fwrite(STDERR, "No se pudo crear la carpeta de vistas: {$viewsDir}\n");
            return 1;
        }

        // --- 0.2) Módulos/plantillas (sin MODULES): usa storage/src/forge/modules/...
        $modulesDir = $root . '/storage/src/forge/modules/';
        $controllerTemplate = $modulesDir . 'controllerTemplate.txt';

        // --- 1) Nombre
        $name = $nameArg ?: InputManager::ask('Nombre del controlador (sin ".php"; puede incluir espacios): ');
        if (!is_string($name) || $name === '') {
            fwrite(STDERR, "Ingresa un nombre de controlador válido por favor.\n");
            return 1;
        }

        // Normalización similar a tu código web:
        $filename = strtolower($name);
        $filename = str_replace(' ', '_', $filename);
        $filename = str_replace('.php', '', $filename);
        // (opcional) sanitizar extra:
        $filename = preg_replace('/[^a-z0-9_]/', '', $filename) ?: $filename;

        if (strlen($name) < 5) {
            fwrite(STDERR, sprintf("El nombre '%s' es demasiado corto (>=5).\n", $name));
            return 1;
        }

        // --- 2) ¿Generar vista? (S/N)
        if ($makeView === null) {
            $makeView = InputManager::confirm('¿Generar carpeta y vista base? (S/N) [S]: ', true);
        }

        // --- 3) ¿Usar Twig? (S/N)
        if ($useTwig === null) {
            $useTwig = InputManager::confirm('¿Usar Twig para la vista? (S/N) [N]: ', false);
        }

        // --- 4) Plantillas de vista según engine
        $viewTemplate = $modulesDir . ($useTwig ? 'viewTwigTemplate.txt' : 'viewTemplate.txt');

        $controllerPath = $controllersDir . $filename . $keyword . '.php';
        $viewDir        = rtrim($viewsDir, '/\\') . DIRECTORY_SEPARATOR . $filename . DIRECTORY_SEPARATOR;
        $viewFile       = $viewDir . ($useTwig ? 'indexView.twig' : 'indexView.php');

        // --- 5) Validaciones
        if (is_file($controllerPath) && !$force) {
            fwrite(STDERR, sprintf("Ya existe el controlador %s. Usa --force para sobrescribir.\n", $controllerPath));
            return 1;
        }

        if (!is_file($controllerTemplate)) {
            fwrite(STDERR, sprintf("No existe la plantilla de controlador: %s\n", $controllerTemplate));
            return 1;
        }

        if ($makeView && !is_file($viewTemplate)) {
            fwrite(STDERR, sprintf("Aviso: no existe la plantilla de vista: %s (se omitirá la vista)\n", $viewTemplate));
            $makeView = false;
        }

        // --- 6) Cargar plantilla controlador y reemplazar tokens
        $php = @file_get_contents($controllerTemplate);
        if ($php === false) {
            fwrite(STDERR, sprintf("Ocurrió un problema al leer la plantilla: %s\n", $controllerTemplate));
            return 1;
        }

        $php = str_replace('[[REPLACE]]', $filename, $php);
        $php = str_replace('[[ENGINE]]',  $useTwig ? 'twig' : 'forge', $php);

        // --- 7) Escribir controlador
        if (@file_put_contents($controllerPath, $php) === false) {
            fwrite(STDERR, sprintf("Ocurrió un problema al crear el controlador en: %s\n", $controllerPath));
            return 1;
        }
        echo "Controlador creado: {$controllerPath}\n";

        // --- 8) Crear carpeta y vista (si aplica)
        if ($makeView) {
            if (!is_dir($viewDir) && !@mkdir($viewDir, 0777, true) && !is_dir($viewDir)) {
                fwrite(STDERR, sprintf("No se pudo crear la carpeta de vistas: %s\n", $viewDir));
                return 1;
            }
            echo "Carpeta de vistas creada: {$viewDir}\n";

            $html = @file_get_contents($viewTemplate);
            if ($html === false) {
                fwrite(STDERR, sprintf("No se pudo leer la plantilla de vista: %s\n", $viewTemplate));
            } else {
                // Variantes del nombre para usar en la vista
                $title = ucwords(str_replace(['_', '-'], ' ', $filename)); // "home_page" -> "Home Page"
                $kebab = strtolower(str_replace('_', '-', $filename));     // "home_page" -> "home-page"

                // Reemplazos estándar en vistas
                $html = str_replace(
                    ['[[REPLACE]]', '[[TITLE]]', '[[SNAKE]]', '[[KEBAB]]'],
                    [$title,        $title,      $filename,   $kebab],
                    $html
                );

                if (@file_put_contents($viewFile, $html) === false) {
                    fwrite(STDERR, sprintf("No se pudo crear la vista en: %s\n", $viewFile));
                } else {
                    echo "Vista creada: {$viewFile}\n";
                }
            }
        }

        echo "✔ Hecho.\n";
        return 0;
    }

    private function pickFirstExistingDir(array $candidates, string $fallback): string {
        foreach ($candidates as $dir) {
            if (is_dir($dir)) return rtrim($dir, '/\\') . DIRECTORY_SEPARATOR;
        }
        return rtrim($fallback, '/\\') . DIRECTORY_SEPARATOR;
    }
}