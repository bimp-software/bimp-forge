<?php

namespace Bimp\Forge\Exceptions;

/**
 * Handler para excepciones de la clase ForgeHttp
 * @since 3.0.0
 */
class ForgeHttpException extends \Exception
{
    private $statucode =  null;

    public function __construct(string $message, int $statucode = 400, int $code = 0, Exception $previous = null) {
        $this->statucode = $statucode;
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(){
        return $this->statucode;
    }
}