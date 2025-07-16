<?php

namespace Bimp\Forge\Helpers;

class Autoloader{

    public static function init() : void {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($class){
        $class = str_replace('Bimp\\Forge\\','', $class);
        $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

        $path = [
            APP,
            BIMP,
            CONFIG,
            PUBLICO,
            RESOURCES,
            TEMPLATES,
            VENDOR,

            CONTROLLERS,
            FUNCTIONS,
            MODELS,

            CLASSES,
            CORE,
            FUNCION,
            LIBS,
            SETTINGS,

            API,
            AUTH,
            CACHE,
            CONSOLE,
            COOKIES,
            DATABASE,
            DIRECTIVES,
            EXCEPTIONS,
            FLASHER,
            HELPERS,
            INTERFACES,
            LOGS,
            MAIL,
            ROUTER,
            MODULES,
            SECURITY,
            SERVER,
            SERVICES,

            COMPONENTS,
            PLUGINS,
            UPLOADS,

            CSS,
            FAVICON,
            FONTS,
            IMG,
            JS,
            SOUNDS,

            INCLUDES,
            VIEWS
        ];

        foreach($path as $dir){
            $file = $dir.$class.'.php';

            if(file_exists($file)){
                require_once $file;
                return;
            }
        }
    }
}