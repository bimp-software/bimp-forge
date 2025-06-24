<?php

use Bimp\Forge\Interfaces\IController;
use Bimp\Forge\Controller;

class ComponentController extends Controller implements IController {
    public function handle() {
        $input = json_decode(file_get_contents('php://input'), true);
        
        $componentClass = $input['component'];
        $method = $input['method'];
        $selector = $input['selector'];
        $data = $input['data'] ?? [];
        
        if (class_exists($componentClass)) {
            $component = new $componentClass($data);
            $component->$method();
            exit;
        }
        
        http_response_code(404);
        echo "Componente no encontrado";
    }
}