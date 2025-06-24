<?php

define('SITE_NAME'     , 'Bimp Software');
define('SITE_VERSION'  , '2.0.0');

/**
 * Set para conexion en produccion o servidor 
 */
define('DB_ENGINE'     , 'mysql');
define('DB_HOST'       , 'localhost');
define('DB_NAME'       , '');
define('DB_USER'       , 'root');
define('DB_PASS'       , '');
define('DB_CHARSET'    , 'utf8');

//Para uso futuro de Gmaps o alguna implementacion similar
define('GMAPS'         , '__TOKEN__');

/**
 * Nombres de cookies para autenticacion de usuarios
 * El valor puede ser cambiado en caso de utilizar
 * Multiples instancias de Bimp Forge para proyectos diferentes y los cookies no representen un problema por el nombre repetido
 */
define('AUTH_TKN_NAME' , 'bimp__cookie_tkn');
define('AUTH_ID_NAME'  , 'bimp__cookie_id');

/**
 * Sal del sistema
 */
define('AUTH_SALT', '');

/**
 * Credenciales para el envio de correos
 */
define('CORREO_EMPRESA', '');
define('CLAVE_EMPRESA' , '');