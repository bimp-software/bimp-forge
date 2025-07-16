<?php

//Saber si estamos trabajando de forma local o remota
define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1','::1']));
define('BASEPATH', IS_LOCAL ? '/bimp-forge/' : '____ EL BASEPATH EN PRODUCCION ____');

/**
 * Informacion del sitio
 * Esta es la configuracion principal del framework
 */
define('BF_NAME'    , 'Bimp Forge');
define('BF_VERSION' , '2.0.0');
define('BF_LOGO'    , 'bimp.png');

define('LNG'        , 'es');

/**
 * Configuracion de la URL del sitio 
 * Detecta si el sitio esta en HTTP o HTTPS y genera la URL correcta
 */
define('PROTOCOLO'   , isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
define('HOST'        , $_SERVER['HTTP_HOST'] === 'localhost' ? 'localhost' : $_SERVER['HTTP_HOST']);
define('REQUEST_URL' , $_SERVER['REQUEST_URI']);
define('URL'         , PROTOCOLO.'://'.HOST.BASEPATH);
define('CUR_URL'     , PROTOCOLO.'://'.HOST.REQUEST_URL);

/**
 * Definicion de rutas de directorios y archivos 
 * Se establecen constantes para facilitar la referencia a los directorios del framework
 */
define('DS'          , DIRECTORY_SEPARATOR);
define('ROOT'        , getcwd().DS);

//Carpetas principales del framework
define('APP'         , ROOT.'app'.DS);
define('BIMP'        , ROOT.'bimp'.DS);
define('CONFIG'      , ROOT.'config'.DS);
define('PUBLICO'     , ROOT.'public'.DS);
define('TEMPLATES'   , ROOT.'templates'.DS);
define('LOG'         , ROOT.'log'.DS);
define('VENDOR'      , ROOT.'vendor'.DS);

/**
 * Sub carpetas de APP
 */
define('CONTROLLERS' , APP.'controllers'.DS);
define('FUNCTIONS'   , APP.'functions'.DS);
define('MODELS'      , APP.'models'.DS);

/**
 * SubCarpetas de Bimp
 */
define('CLASSES'     , BIMP.'classes'.DS);
define('CORE'        , BIMP.'core'.DS);
define('FUNCION'     , BIMP.'function'.DS);
define('LIBS'        , BIMP.'libs'.DS);
define('SETTINGS'    , BIMP.'settings'.DS);

/**
 * SubCarpetas de CLASSES
 */
define('API'         , CLASSES.'api'.DS);
define('AUTH'        , CLASSES.'auth'.DS);
define('CACHE'       , CLASSES.'cache'.DS);
define('CONSOLE'     , CLASSES.'console'.DS);
define('COOKIES'     , CLASSES.'cookies'.DS);
define('DATABASE'    , CLASSES.'database'.DS);
define('DIRECTIVES'  , CLASSES.'directives'.DS);
define('EXCEPTIONS'  , CLASSES.'exceptions'.DS);
define('FLASHER'     , CLASSES.'flasher'.DS);
define('HELPERS'     , CLASSES.'helpers'.DS);
define('INTERFACES'  , CLASSES.'interfaces'.DS);
define('LOGS'        , CLASSES.'logs'.DS);
define('MAIL'        , CLASSES.'mail'.DS);
define('ROUTER'      , CLASSES.'router'.DS);
define('MODULES'     , CLASSES.'modules'.DS);
define('SECURITY'    , CLASSES.'security'.DS);
define('SERVER'      , CLASSES.'server'.DS);
define('SERVICES'    , CLASSES.'services'.DS);


/**
 * SubCarpetas de Public
 */
define('COMPONENTS'   , PUBLICO.'components'.DS);
define('UPLOADS'      , PUBLICO.'uploads'.DS);
define('UTILS'      , PUBLICO.'utils'.DS);
define('UPLOADED', ROOT.'public'.DS.'uploads'.DS);


define('UPLOADED_LOGO', UPLOADED.'logo');
define('UPLOADED_IMG', UPLOADED.'img');


/**
 * SubCarpetas de Resources
 */
define('RESOURCES'    , URL.'resources/');
define('CSS'          , RESOURCES.'css/');
define('FAVICON'      , RESOURCES.'favicon/');
define('FONTS'        , RESOURCES.'fonts/');
define('IMG'          , RESOURCES.'img/');
define('JS'           , RESOURCES.'js/');
define('SOUNDS'       , RESOURCES.'sounds/');
define('PLUGINS'      , RESOURCES.'plugins/');


/**
 * SubCarpetas de Templates
 */
define('INCLUDES'     , TEMPLATES.'includes'.DS);
define('VIEWS'        , TEMPLATES.'views'.DS);
define('LAYOUTS'      , TEMPLATES.'layouts'.DS);


/** PARA GLOB */
define('JS_PATH' , ROOT.'resources'.DS.'js'.DS);           // Para usar en glob()
define('CSS_PATH' , ROOT.'resources'.DS.'css'.DS);           // Para usar en glob()


/**
 * Keys para consumos de la API de esta instancia de Bimp Forge
 * puedes regenerarlas en Bimp/generate
 * @since 1.0.0
 */
define('API_PUBLIC_KEY', '');
define('API_PRIVATE_KEY', '');

/**
 * Configuracion de controladores y metodos por defecto
 * Se establecen los valores predeterminados para manejar las solicitudes y errores
 */
define('DEFAULT_CONTROLLER'       , 'home');
define('DEFAULT_ERROR_CONTROLLER' , 'error');
define('DEFAULT_METHOD'           , 'index');