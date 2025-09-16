<?php

namespace Bimp\Forge\Console\Support;

class Process {

    /**
     * Ejecuta un comando adjuntando STDIN/STDOUT/STDERR
     *  @param string|string $cmd, $cwd
     *  @return int
     */
    public static function run(string $cmd, ?string $cwd = null): int {
        $descriptorspec = [
            0 => STDIN,
            1 => STDOUT,
            2 => STDERR
        ];

        $process = proc_open($cmd, $descriptorspec, $pipes, $cwd ?: getcwd());

        if (!\is_resource($process)) {
            fwrite(STDERR, "Error: No se pudo ejecutar el comando: $cmd" . PHP_EOL);
            return 1;
        }

        return proc_close($process);
    }

    /**
     * Verifica si un binario esta disponible en el PATH del sistema
     *  @param string $binary
     */
    public static function available(string $bin): bool{
        $path = getenv('PATH') ?: '';
        $paths = explode(PATH_SEPARATOR, $path);
        $suffix = (PHP_OS_FAMILY === 'Windows') ? '.exe' : '';
        foreach($paths as $p){
            $candidate = rtrim($p, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $bin . $suffix;
            if(file_exists($candidate) && is_readable($candidate)){
                return true;
            }
        }

        return false;
    }
}