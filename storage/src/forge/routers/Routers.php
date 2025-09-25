<?php

namespace Bimp\Forge\Routers;

class Routers {
    private $url = [];

    public function __construct($uri){
        $this->url = $uri;
    }

    public function filter_url(){
        if (isset($_GET['uri'])) {
            $this->url = $_GET['uri'];
            $this->url = rtrim($this->url, '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', strtolower($this->url));
            //Ejecutar middleware si existen
            $this->middleware();
            return $this->url;
        }
    }

    private function middleware(){
        $path = APP. 'middleware/';

        if(is_dir($path)){
            foreach(glob($path.'*.php') as $files){
                $class = 'App\\Middleware\\'.basename($files,'.php');

                if(class_exists($class)){
                    $middleware = new $class();

                    if(method_exists($middleware, 'handle')){
                        $result = $middleware->handle($this->url);

                        if($result !== null){
                            $this->url = $result;
                        }
                    }
                }
            }
        }
    }

}