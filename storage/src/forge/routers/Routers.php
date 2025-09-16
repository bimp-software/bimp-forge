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
            return $this->url;
        }
    }

}