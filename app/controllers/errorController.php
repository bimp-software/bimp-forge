<?php

use Bimp\Forge\Routers\Controller;
use Bimp\Forge\Interfaces\IController;

class errorController extends Controller implements IController {

    function __construct(){ 
        http_response_code(404);
        //Ejecuta la funcionalidad del controlador padre
        parent::__construct(); 
    }

    function index(){
        $this->setTitle('Página no encontrada');
        $this->addToData('code', 404);
        $this->setView('index');
        $this->render();
    }
}