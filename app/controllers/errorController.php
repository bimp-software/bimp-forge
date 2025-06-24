<?php

use Bimp\Forge\Interfaces\IController;
use Bimp\Forge\Controller;

class errorController extends Controller implements IController{

    function __construct(){ parent::__construct(); }

    /** INDEX */
    function index(){
        $this->setTitle('Error');
        $this->addToData('description' , null);
        $this->addToData('titulo','Error');
        $this->setView('index');
        $this->render();
    }
}