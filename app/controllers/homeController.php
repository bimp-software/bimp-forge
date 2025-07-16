<?php

use Bimp\Forge\Interfaces\IController;
use Bimp\Forge\Controller;
use Bimp\Forge\Security\Middleware;

class homeController extends Controller implements IController{

    function __construct(){ parent::__construct(); }

    /**
     * ======================================================================
     *                              INDEX
     * ======================================================================
     */
    function index(){
        $this->setAuthor(SITE_NAME);
        $this->setTitle('Inicio');
        $this->setSlug('home');
        $this->setDescription('home');
        $this->render();
    }

    function documentacion(){
        throw new Exception("Esto es un error de prueba desde la pagina de documentacion");
    }

    
}