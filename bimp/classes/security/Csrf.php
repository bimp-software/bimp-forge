<?php

namespace Bimp\Forge\Security;

class Csrf{

    private $length = 32; // longitud de nuestro token
    private $token; // token
    private $token_expiration; // tiempo de expiración
    private $expiration_time = 60 * 5; // 5 minutos de expiración

    // Crear nuestro token si no existe y es el primer ingreso al sitio
    function __construct() {
        if(!isset($_SESSION['csrf_token'])) {
            $this->generate();
            $_SESSION['csrf_token'] = [
                'token'      => $this->token,
                'expiration' => $this->token_expiration
            ];
            
            return $this;
        }
        $this->token            = $_SESSION['csrf_token']['token'];
        $this->token_expiration = $_SESSION['csrf_token']['expiration'];
        return $this;
    }

    /**
     * Método para generar un nuevo token
     *
     * @return void
     */
    private function generate() {
        if (function_exists('random_bytes')) {
            $this->token = bin2hex(random_bytes($this->length));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $this->token = bin2hex(openssl_random_pseudo_bytes($this->length));
        } else {
            $this->token = '';
            for ($i = 0; $i < $this->length; $i++) {
                $this->token .= dechex(mt_rand(0, 15));
            }
        }
        $this->token_expiration = time() + $this->expiration_time;
        return $this->token;
    }


    /**
     * Validar el token de la petición con el del sistema
     *
     * @param string $csrf_token
     * @param boolean $validate_expiration
     * @return void
     */
    public static function validate($csrf_token, $validate_expiration = false) {
        $self = new self();
        // Validando el tiempo de expiración del token
        if($validate_expiration && $self->get_expiration() < time()) { return false; }
        if($csrf_token !== $self->get_token()) { return false; }
        return true;
    }

    /**
     * Método para obtener el token
     *
     * @return string
     */
    public function get_token() {
        return $this->token;
    }

    /**
     * Método para obtener la expiración del token
     *
     * @return void
     */
    public function get_expiration() {
        return $this->token_expiration;
    }



}