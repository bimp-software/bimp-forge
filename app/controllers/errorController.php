<?php

use Bimp\Forge\Interfaces\IController;
use Bimp\Forge\Controller;

use Bimp\Forge\Logs\Logs;

class errorController extends Controller implements IController{

    protected Logs $logger;

    function __construct(){ 
        parent::__construct(); 
        $this->logger = new Logs(LOG, is_local() ? 'local' : 'production');
    }

    /** INDEX */
    function index(\Throwable $exception = null){
        $is_local = is_local();

        if($exception){
            //Si es local mnuestra mas detalles
            if($is_local){
                http_response_code(500);
                $this->addToData('error', $exception->getMessage());
                $this->addToData('file', $exception->getFile());
                $this->addToData('trace', $exception->getTraceAsString());
            }

            $this->setTitle('Ha ocurrido un error');
            $this->setDescription('Lo sentimos, a ocurrido un problema inesperado. Intentalo nuevamente.');
        }

        $this->addToData('titulo','Error');
        $this->setSlug('error');
        $this->render();
    }
}