<?php

namespace Bimp\Forge\Logs;

class Logs {
    protected $logPath;
    protected $enviroment;

    function __construct(string $path, string $enviroment = 'produccion'){
        $this->logPath = $path;
        $this->enviroment = $enviroment;

        

        if(!is_dir($this->logPath)){
            mkdir($this->logPath, 0755, true);
        }
    }

    public function log(string $level, string $message, array $context = []) : void {
        $timestamp = data('Y-m-d H:i:s');
        $context = !empty($context) ? json_encode($context, JSON_UNESCAPED_UNICODE) : '';
        $formatted = "[$timestamp]".strtoupper($level).": $message";

        if($context){
            $formatted .= " | Context: $context";
        }

        $filename = $this->enviroment === 'local' ? 'dev_log.log' : 'bimp_log.log';
        file_put_contents(ROOT.$this->logPath.$filename, $formatted.PHP_EOL, FILE_APPEND);
    }

    public function error(string $message, array $context = []) : void {
        $this->log('error', $message, $context);
    }

    public function debug(string $message, array $context = []) : void {
        $this->log('debug', $message, $context);
    }

    public function info(string $message, array $context = []) : void {
        $this->log('info', $message, $context);
    }
}