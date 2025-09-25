<?php

require __DIR__ . '/vendor/autoload.php';

define('FORGE_START', microtime(true));

//Requerido
use Bimp\Forge\Foundation\Application;

//Ejecuta el framework forge
Application::forge();