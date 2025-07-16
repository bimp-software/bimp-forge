<?php

namespace Bimp\Forge\Security;

use Bimp\Forge\Auth\Authenticator;
use Bimp\Forge\Flasher\Flasher;

class Middleware {
     
    public static function handlePrueba($type, $params){
        
    }

    /**
     * Validar ususario con la funcion handleAuth
     * @var boolean
     * @return true|false
     */
    public static function handleAuth(){
        Authenticator::validate() ? true : Flasher::new('Usuario no autorizado','danger');
    }



}