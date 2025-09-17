<?php

use Bimp\Forge\Routers\Controller;
use Bimp\Forge\Interfaces\IController;

use Bimp\Forge\Flasher\Flasher;

class homeController extends Controller implements IController {

    function __construct(){ parent::__construct(); }

    function index(){
        $this->setTitle('Inicio');
        $this->setView('index');
        $this->render();
    }
}