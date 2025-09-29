<?php

namespace Bimp\Forge\Console\Command\Make;

use Bimp\Forge\Console\Support\Process;
use Bimp\Forge\Console\Command\Command;

class Migration implements Command
{
    private function getProject(): string
    {
        return basename(dirname(__DIR__, 6));
    }

    public static function name(): string
    {
        return 'make:migrations';
    }

    public static function description(): string
    {
        return 'Crea una migración para la base de datos.';
    }

    public function execute(array $args): int
    {
        /**
         * Parseo basico de args/flags
         * Ejemplos validos
         * php forge make:schema users
         * php forge make:schema users --pivot
         * php forge make:schema users --engine=InnoDB --charset=utf8mb4
         */
        if(empty($args[0])){
            echo "Uso: php forge make:migrations <table> [--pivot] [--engine=InnoDB] [--charset=utf8mb4]";
            return 1;
        }

        $tableRaw = $args[0];
        $flags = array_slice($args, 1);

        $isPivot   = false;
        $engineIn  = '';
        $charsetIn = '';

        foreach($flags as $flag){
            if($flag === '--pivot'){
                $isPivot = true;
            }elseif(str_starts_with($flag, '--engine=')){
                $engineIn = substr($flag, 9);
            }elseif(str_starts_with($flag, '--charset=')){
                $charsetIn = substr($flag, 10);
            }
        }

        //--- Validaciones / normalizaciones ---
        $table = $this->toSnakeCase($tableRaw);
        if($table === '' || strlen($table) < 2){
            echo "El nombre de tabla es invalido o demasiado corto.\n";
            return 1;
        }

        $template = 'storage/src/forge/modules/migrationTemplateModule.txt';
        if(!is_file($template)){
            echo "No existe la plantilla: {$template}\n";
            return 1;
        }

        //Timestamp + filename
        $timestamp = date('Y_m_d_His');
        $fileName = $timestamp . '_' . ($isPivot ? "create_{$table}_pivot" : "create_{$table}_table").'.php';
        $path = 'database/migrations/' . $fileName;

        if(is_file($path)){
            echo "La migracion ya existe: {$path}";
            return 1;
        }

        $php = @file_get_contents($template);
        if($php === false){
            echo "No se pudo leer la plantilla: {$template}";
            return 1;
        }

        $engine = $engineIn !== '' ? $engineIn : (defined('DB_ENGINE') ? DB_ENGINE : 'InnoDB');
        $charset = $charsetIn !== '' ? $charsetIn : (defined('DB_CHARSET') ? DB_CHARSET : 'utf8mb4');

        $php = str_replace(
            ['[[TABLE]]','[[TABLE_UPPER]]','[[TABLE_STUDLY]]','[[ENGINE]]','[[CHARSET]]'],
            [$table, strtoupper($table), $this->toStudlyCase($table), $engine, $charset],
            $php
        );

        if(@file_put_contents($path, $php) === false){
            echo "Ocurrio un problema al crear la migración: {$path}\n";
            return 1;
        }

        echo "Migración creada: {$path}\n";
        return 0;

    }

    private function toSnakeCase(string $name): string
    {
        $name = str_replace(['-', '.', '/', '\\'], ' ', $name);
        $name = preg_replace('/(?<!^)[A-Z]/', '_$0', $name);
        $name = preg_replace('/[\s]+/', '_', $name);
        $name = strtolower($name);
        $name = preg_replace('/_+/', '_', $name);
        return trim($name, '_');
    }

    private function toStudlyCase(string $name): string {
        $name = str_replace(['-','_','.','/','//'],' ',strtolower($name));
        $name = ucwords(preg_replace('/\s+/',' ',$name));
        return str_replace(' ','',$name);
    }
}
