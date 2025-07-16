<?php

namespace Bimp\Forge\Exceptions;

use Bimp\Forge\Logs\Logs;
use \Throwable;

class Exceptions {
    protected Logs $logger;

    public function __construct(Logs $log){
        $this->logger = $log;
    }

    public function handle(\Throwable $e) : void {
        $this->logger->error($e->getMessage(), [
            'file'  => $e->getFile(),
            'line'  => $e->getLine(),
            'trace' => $e->getTraceAsString() 
        ]);

        //Mostrar el error usando el controlador errorController
        if(class_exists(CONTROLLERS.'errorController')){
            (new \errorController())->index($e);
        }else{
            //Fallback basico si no se encuentra el controlador
            http_response_code(500);
            echo "<h1>Ocurrio un error</h1>";
            echo "<p>{$e->getMessage()}</p>";
        }
        
        exit;
    }
    
}