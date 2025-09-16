<?php
declare(strict_types=1);

namespace Bimp\Forge\Console;

use Bimp\Forge\Console\Command\Command;

use Bimp\Forge\Console\Command\Make\RunServer;
use Bimp\Forge\Console\Command\Make\Install;
use Bimp\Forge\Console\Command\Make\DatabasePing;

final class Forge
{
    /** @var array<string, class-string<Command>> */
    private array $commands = [];

    public function __construct()
    {
        // REGISTRA sin asignar al array (register() ya escribe en $this->commands)
        $this->register(RunServer::class);
        $this->register(Install::class);
        $this->register(DatabasePing::class);
    }

    /**
     * Registra un comando por su FQCN.
     * @param class-string<Command> $command
     */
    private function register(string $command): void
    {
        // Validaciones útiles
        if (!class_exists($command)) {
            return;
        }
        $implements = class_implements($command) ?: [];
        if (!in_array(Command::class, $implements, true)) {
            return;
        }

        // Métodos estáticos exigidos por tu interfaz
        $name = $command::name();
        $this->commands[$name] = $command;
    }

    public function run(array $argv): int
    {
        $name = $argv[1] ?? 'help';

        if ($name === 'help' || $name === '--help' || $name === '-h') {
            $this->help();
            return 0;
        }

        if (!isset($this->commands[$name])) {
            fwrite(STDERR, "Comando no reconocido: {$name}\n\n");
            $this->help();
            return 1;
        }

        $fqcn = $this->commands[$name];
        $cmd  = new $fqcn();                   // instancia del comando
        return (int) $cmd->execute($argv);     // ejecuta (no estático)
    }

    private function help(): void
    {
        echo <<<TXT
            Bimp Forge CLI

            Uso:
            php forge <comando> [opciones]

            Comandos disponibles:
            TXT;

                    foreach ($this->commands as $n => $fqcn) {
                        $desc = $fqcn::description();
                        echo "\n  - {$n}\t{$desc}";
                    }

                    echo <<<TXT


            Ejemplos:
            php forge runserver\n
            php forge install\n
            TXT;
    }
}
