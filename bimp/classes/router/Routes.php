<?php

namespace Bimp\Forge\Router;

class Routes{

    private $url = [];

    public function __construct() {
        $this->filter_url();
    }

    private function filter_url() {
        if (isset($_GET['uri'])) {
            $this->url = $_GET['uri'];
            $this->url = rtrim($this->url, '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', strtolower($this->url));
            return $this->url;
        }
    }

    public function dispatch() {
        //Controlador
        if(isset($this->url[0])){
            $current_controller = $this->url[0];
            unset($this->url[0]);
        }else{
            $current_controller = DEFAULT_CONTROLLER;
        }

        //Ejecucion del controlador
        $controller = $current_controller.'Controller'; //homeController
        if(!class_exists($controller)){
            $current_controller = DEFAULT_ERROR_CONTROLLER;
            $controller = DEFAULT_ERROR_CONTROLLER.'Controller';//errorController
        }

        //Ejecucion del metodo solicitado
        if(isset($this->url[1])){
            $method = str_replace('-','_', $this->url[1]);

            if(!method_exists($controller, $method)){
                $controller = DEFAULT_ERROR_CONTROLLER.'Controller';
                $current_method = DEFAULT_METHOD;
                $current_controller = DEFAULT_ERROR_CONTROLLER;
            }else{
                $current_method = $method;
            }

            unset($this->url[1]);
        }else{
            $current_method = DEFAULT_METHOD;
        }

        define('CONTROLLER', $current_controller);
        define('METHOD', $current_method);

        $controller = new $controller;

        $params = array_values(empty($this->url) ? [] : $this->url);

        if(empty($params)){
            call_user_func([$controller, $current_method]);
        }else{
            call_user_func_array([$controller, $current_method], $params);
        }
    }
    
}