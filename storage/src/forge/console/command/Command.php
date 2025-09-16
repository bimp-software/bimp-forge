<?php

namespace Bimp\Forge\Console\Command;

interface Command {
    /**
     * Nombre del comando
     * @return string
     */
    public static function name() : string;

    /**
     * Descripcion corta para --help
     * @return string
     */
    public static function description(): string;

    /**
     * Ejecuta el comando
     * @param array $args Argumentos pasados al comando
     * @return int Código de salida
     */
    public function execute(array $args) : int;
}