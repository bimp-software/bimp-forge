<?php
/**
 * Constantes migradas
 * a este archivo para cuando se deba realizar actualizaciones del sistema 
 */
define('IS_LOCAL'  , in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1', '::1'], true));
define('DEV_PATH'  , '/'.$_ENV['NAME_PROYECTO'].'/'); //Ruta del proyecto
define('LIVE_PATH' , '/');
define('BASE_PATH' , IS_LOCAL ? DEV_PATH : LIVE_PATH);

define('PHPMAILER_TEMPLATE', 'emailTemplate');

// Sesiones de usuario persistentes
define('FORGE_USERS_TABLE'         , $_ENV['FORGE_USERS_TABLE']);      
define('FORGE_COOKIES'             , $_ENV['FORGE_COOKIES']);     
define('FORGE_COOKIE_ID'           , $_ENV['FORGE_COOKIE_ID']);   
define('FORGE_COOKIE_TOKEN'        , $_ENV['FORGE_COOKIE_TOKEN']);  
define('FORGE_COOKIE_LIFETIME'     , $_ENV['FORGE_COOKIE_LIFETIME']);   
define('FORGE_COOKIE_PATH'         , $_ENV['FORGE_COOKIE_PATH']);
define('FORGE_COOKIE_DOMAIN'       , $_ENV['FORGE_COOKIE_DOMAIN']);

define('API_PUBLIC_KEY'          , $_ENV['API_PUBLIC_KEY']);
define('API_PRIVATE_KEY'         , $_ENV['API_PRIVATE_KEY']);

define('API_AUTH'                , $_ENV['API_AUTH']);
