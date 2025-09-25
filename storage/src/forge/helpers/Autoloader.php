<?php

namespace Bimp\Forge\Helpers;

class Autoloader {
    public static function init(): void {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    private static function autoload($class){
        $class = str_replace('Bimp\\Forge\\','',$class);
        $class = str_replace('\\', DS, $class);

        $path = [
            APP,
            CONTROLLERS,
            FUNCTIONS,
            MODELS,
            MIDDLEWARE,

            /** Database */
            DATABASE,
            FACTORIES,
            MIGRATIONS,
            SEEDERS,

            /** LOG */
            LOG,

            /** RESOURCES */
            RESOURCES,
            CSS,
            FAVICON,
            IMG,
            JS,
            PLUGINS,
            UPLOADS,

            UPLOADED,

            /** STORAGE */
            STORAGE,
            TEST,
            SRC,
            FORGE,
            API,
            AUTH,
            CONFIG,
            CONSOLE,
            COMMAND,
            SUPPORT,
            MAKE,
            INPUT,
            DBASE,
            DIRECTIVE,
            EXCEPTIONS,
            FLASHER,
            FOUNDATION,
            FUNCIONES,
            HELPERS,
            HTTP,
            INTERFACES,
            LOGS,
            MAIL,
            MODULES,
            PAGINATIONS,
            ROUTERS,
            SECURITY,
            SERVICES,
            VIEWS,

            /** Templates  */
            TEMPLATES,
            INCLUDES,
            LAYOUT,
            VIEW,
            MODULE,

            /** Public */
            PUBLICO,
            COMPONENTS,    
            UTILS
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