<?php

namespace Bimp\Forge\Core;

class Builder {

    public static function init(string $base){
        $files = [
            //APP
            'app/controllers',
            'app/functions',
            'app/models',
            //CONFIG
            'config',
            //PUBLIC
            'public/components',
            'public/uploads',
            'public/utils',
            //RESOURCES
            'resources/css',
            'resources/favicon',
            'resources/fonts',
            'resources/img',
            'resources/js',
            'resources/plugins',
            'resources/sounds',
            //TEMPLATES
            'templates/includes',
            'templates/layouts',
            'templates/views/error',
            'templates/views/home',
        ];

        foreach($files as $carpetas){
            $routes = rtrim($base, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$carpetas;

            if(!is_dir($routes)){
                mkdir($routes, 0755, true);
            }
        }
    }
}