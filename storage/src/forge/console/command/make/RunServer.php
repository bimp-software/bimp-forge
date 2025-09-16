<?php

declare(strict_types=1);

namespace Bimp\Forge\Console\Command\Make;

use Bimp\Forge\Console\Command\Command;

class RunServer implements Command{

    public static function name(): string {
        return 'runserver';
    }

    public static function description(): string {
        return 'Levanta el servidor embebido de PHP para desarrollo.';
    }

    public function execute(array $args): int {
        $host = '127.0.0.1';
        $port = '8000';
        $docroot = getcwd();
        $router = $docroot. DIRECTORY_SEPARATOR . 'index.php';

        foreach($args as $arg){
            if(\str_starts_with($arg, '--host=')) $host = \substr($arg, 7);
            if(\str_starts_with($arg, '--port=')) $port = \substr($arg, 7);
            if(\str_starts_with($arg, '--docroot=')) $docroot = \substr($arg, 10);
            if(\str_starts_with($arg, '--router=')) $router = \substr($arg, 9); 
        }

        if(!file_exists($router)){
            fwrite(STDERR, 'No se encontro el router: {$router}' . PHP_EOL);
            return 1;
        }

        $cmd = sprintf('php -S %s:%s -t %s %s', escapeshellarg($host), escapeshellarg($port), escapeshellarg($docroot), escapeshellarg($router));
    
        echo "Iniciando servidor en http://{$host}:{$port}\n";
        echo "Docroot: {$docroot}\n";
        echo "Router: {$router}\n";
        echo "Ctrl+C para detener el servidor\n\n";

        passthru($cmd, $exitCode);
        return (int)$exitCode;
    }

}