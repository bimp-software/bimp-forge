<?php

namespace Bimp\Forge\Console\Command\Make;

use Bimp\Forge\Console\Support\Process;
use Bimp\Forge\Console\Command\Command;


class Migration implements Command {

    private function getProject(): string {
        return basename(dirname(__DIR__, 6));
    }

    public static function name(): string {
        return 'make:schema';
    }

    public static function description(): string {
        return 'Crea una migracion para la base de datos, facilitando la creacion de tablas.';
    }

    public function execute(array $args): int {
        
    }

}