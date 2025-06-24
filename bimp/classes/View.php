<?php

namespace Bimp\Forge;

use Bimp\Forge\Directives\Glow;
use Exception;

class View {
    
    public static function render(string $view, array $data = []) {
        $path = str_replace(['.', '/'], DS, $view);
        $file = VIEWS . CONTROLLER . DS . $path . 'View.php';

        if (!file_exists($file)) {
            throw new Exception("La vista {$file} no existe.");
        }

        extract($data, EXTR_SKIP);
        require_once $file;
        exit();
    }
}
