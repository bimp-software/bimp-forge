<?php

namespace Bimp\Forge\Exceptions;

use \Exception;

/**
 * Handler para exceptiones de elementos JSON
 * @since 3.0.0
 */
class ForgeJsonException extends Exception {
    private $statusCode = null;
    private $errorCode = null;

    public function __construct(string $message, int $statusCode = 400, mixed $errorCode = null){
        $this->statusCode = (int) $statusCode;
        $this->errorCode = $errorCode;

        parent::__construct($message);
    }

    public function getStatusCode(){ return $this->statusCode; }
    public function getErrorCode(){ return $this->errorCode; }
}