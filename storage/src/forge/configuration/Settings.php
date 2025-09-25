<?php

// Datos de la empresa / negocio / sistema
define('SITE_LANG'               , $_ENV['SITE_LANG']);
define('SITE_CHARSET'            , $_ENV['SITE_CHARSET']);
define('SITE_NAME'               , $_ENV['SITE_NAME']);    // Nombre del sitio
define('SITE_VERSION'            , $_ENV['SITE_VERSION']);          // Versión del sitio
define('SITE_LOGO'               , $_ENV['SITE_LOGO']);       // Nombre del archivo del logotipo base
define('SITE_FAVICON'            , $_ENV['SITE_FAVICON']);    // Nombre del archivo del favicon base
define('SITE_DESC'               , $_ENV['SITE_DESC']); // Descripción meta del sitio

define('VERSION_PROYECTO'      , $_ENV['VERSION_PROYECTO']); // Versión del proyecto
define('CSS_FRAMEWORK'         , $_ENV['CSS_FRAMEWORK']); // Define el framework CSS a utilizar en el proyecto

define('IS_DEMO'      , $_ENV['IS_DEMO']); // Si es requerida añadir funcionalidad DEMO en tu sistema, puedes usarlo con esta constante

define('PROTOCOL'    , isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
define('HOST'        , $_SERVER['HTTP_HOST'] === 'localhost' ? 'localhost' : $_SERVER['HTTP_HOST']);
define('REQUEST_URI' , $_SERVER['REQUEST_URI']);
define('URL'         , PROTOCOL.'://'.HOST.BASE_PATH); //Url del sitio
define('CUR_PAGE'    , PROTOCOL.'://'.HOST.REQUEST_URI);//Url actual incluyendo paramentros get

//Las rutas de directorios y archivos
define('DS'          , DIRECTORY_SEPARATOR);
define('ROOT'        , getcwd().DS);

/** App */
define('APP'         , ROOT . 'app' . DS);
define('CONTROLLERS' , APP . 'controllers' . DS);
define('FUNCTIONS'   , APP . 'functions' . DS);
define('MODELS'      , APP . 'models' . DS);
define('MIDDLEWARE'  , APP . 'middleware' . DS);

/** Database */
define('DATABASE'    , ROOT . 'database' . DS);
define('FACTORIES'   , DATABASE . 'factories' . DS);
define('MIGRATIONS'  , DATABASE . 'migrations' . DS);
define('SEEDERS'     , DATABASE . 'seeders' . DS);

/** LOG */
define('LOG'        , ROOT . 'logs' . DS);

/** RESOURCES */
define('RESOURCES'   , URL . 'resources/');
define('CSS'         , RESOURCES . 'css/');
define('FAVICON'     , RESOURCES . 'favicon/');
define('IMG'         , RESOURCES . 'img/');
define('JS'          , RESOURCES . 'js/');
define('PLUGINS'     , RESOURCES . 'plugins/');
define('UPLOADS'     , RESOURCES . 'uploads/');

define('UPLOADED'    , ROOT.'resources'.DS.'uploads'.DS);

// Rutas de recursos y assets absolutos
define('IMAGES_PATH' ,ROOT . 'resources' . DS . 'img' . DS);

/** STORAGE */
define('STORAGE'     , ROOT . 'storage' . DS);
define('TEST'        , STORAGE . 'test' . DS);
define('SRC'         , STORAGE . 'src' . DS);
define('FORGE'       , SRC . 'forge' . DS);
define('API'         , FORGE . 'api' . DS);
define('AUTH'        , FORGE . 'auth' . DS);
define('CONFIG'      , FORGE . 'configuration' . DS);

define('CONSOLE'     , FORGE . 'console' . DS);
define('COMMAND'     , CONSOLE . 'command' . DS);
define('SUPPORT'     , CONSOLE . 'support' . DS);
define('MAKE'        , COMMAND . 'make' . DS);
define('INPUT'       , COMMAND . 'input' . DS);

define('DBASE'       , FORGE . 'databse' . DS);
define('DIRECTIVE'   , FORGE . 'directive' . DS);
define('EXCEPTIONS'  , FORGE . 'exceptions' . DS);
define('FLASHER'     , FORGE . 'flasher' . DS);
define('FOUNDATION'  , FORGE . 'foundation' . DS);
define('FUNCIONES'   , FORGE . 'function' . DS);
define('HELPERS'     , FORGE . 'helpers' . DS);
define('HTTP'        , FORGE . 'http' . DS);
define('INTERFACES'  , FORGE . 'interfaces' . DS);
define('LOGS'        , FORGE . 'logs' . DS);
define('MAIL'        , FORGE . 'mail' . DS);
define('MODULES'     , FORGE . 'modules' . DS);
define('PAGINATIONS' , FORGE . 'paginations' . DS);
define('ROUTERS'     , FORGE . 'routers' . DS);
define('SECURITY'    , FORGE . 'security' . DS);
define('SERVICES'    , FORGE . 'services' . DS);
define('VIEWS'       , FORGE . 'views' . DS);

/** Templates  */
define('TEMPLATES'   , ROOT . 'templates' . DS);
define('INCLUDES'    , TEMPLATES . 'includes' . DS);
define('LAYOUT'      , TEMPLATES . 'layout' . DS);
define('VIEW'       , TEMPLATES . 'views' . DS);
define('MODULE'     , TEMPLATES . 'modules' . DS);

/** Public */
define('PUBLICO'     , ROOT .'');
define('COMPONENTS'  , PUBLICO.'components'.DS);
define('UTILS'       , PUBLICO.'utils'.DS);

/** PARA GLOB */
define('JS_PATH' , ROOT.'resources'.DS.'js'.DS);           // Para usar en glob()
define('CSS_PATH' , ROOT.'resources'.DS.'css'.DS);           // Para usar en glob()

// Utilidades
define('JQUERY'                  , $_ENV['JQUERY']);  // define si es requerido jQuery para el sitio
define('VUEJS'                   , $_ENV['VUEJS']);  // define si es requerido Vue js 3 para el sitio | CDN
define('AXIOS'                   , $_ENV['AXIOS']); // define si es requerido Axios para peticiones HTTP
define('SWEETALERT2'             , $_ENV['SWEETALERT2']);  // define si es requerido sweetalert2 por defecto
define('TOASTR'                  , $_ENV['TOASTR']);  // define si es requerido Toastr para notificaciones con Javascript
define('WAITME'                  , $_ENV['WAITME']);  // define si es requerido WaitMe
define('LIGHTBOX'                , $_ENV['LIGHTBOX']); // define si es requerido Lightbox

define('USE_TWIG'                , $_ENV['USE_TWIG']); // define si se usará Twig como motor de plantillas

/**
 * Configuracion de controladores y metodos por defecto
 * Se establecen los valores predeterminados para manejar las solicitudes y errores
 */
define('DEFAULT_CONTROLLER'       , $_ENV['DEFAULT_CONTROLLER']);
define('DEFAULT_METHOD'           , $_ENV['DEFAULT_METHOD']);

define('DEFAULT_ERROR_CONTROLLER' , 'error');

define('PHPMAILER_TEMPLATE'      , $_ENV['PHPMAILER_TEMPLATE']); 