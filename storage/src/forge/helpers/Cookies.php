<?php

namespace Bimp\Forge\Helpers;

class Cookies {
    
    /**
     * Cargar y regresa todos los cookies del sitio
     *
     * @return array
     */
    public static function get_all_cookies(){
        $cookies = [];

        if (!isset($_COOKIE) || empty($_COOKIE)) {
            return $cookies;
        }

        // Iteramos entre todos los cookies guardados del sitio
        // para almacenarlos en una nueva variable
        foreach ($_COOKIE as $name => $value) {
            $cookies[$name] = $value;
        }

        return $cookies;
    }

    /**
     * Para volver a buscar y asignar los cookies
     * a nuestra global de cookies en caso de que
     * sea necesario
     * @return bool
     */
    public static function load_all_cookies() {
        global $Forge_Cookies;

        $Forge_Cookies = get_all_cookies();

        return true;
    }


    /**
     * Creamos un cookie directamente
     * con base a los parámetros pasados
     *
     * @param array $cookies
     * @return bool
     */
    public static function new_cookie($name, $value, $lifetime = null, $path = '', $domain = ''){
        // Para prevenir cualquier error de ejecución
        // al ser enviadas ya las cabeceras del sitio
        if (headers_sent()) {
            return false;
        }

        // Valor por defecto de la duración del cookie
        $default  = 60 * 60 * 24; // 1 día por defecto si no existe la constante
        $lifetime = defined('FORGE_COOKIE_LIFETIME') && $lifetime === null ? FORGE_COOKIE_LIFETIME : (!is_integer($lifetime) ? $default : $lifetime);

        // Creamos el nuevo cookie
        setcookie($name, $value, time() + $lifetime, $path, $domain);

        return true;
    }

    /**
     * Verifica si existe un determinado cookie creado
     *
     * @param string $cookie
     * @return bool | true si existe | false si no
     */
    public static function cookie_exists($cookie){
        return isset($_COOKIE[$cookie]);
    }

    /**
     * Carga la información de un cookie en caso de existir
     *
     * @param string $cookie_name
     * @return mixed
     */
    public static function get_cookie(string $cookie)
    {
        return isset($_COOKIE[$cookie]) ? $_COOKIE[$cookie] : false;
    }


    /**
     * Borrar cookies en caso de existir,
     * se pasa el nombre de cada cookie como parámetro array
     *
     * @param array $cookies
     * @return bool
     */
    public static function destroy_cookie($cookie, $path = '', $domain = '')
    {
        global $Forge_Cookies;

        // Para prevenir cualquier error de ejecución
        // al ser enviadas ya las cabeceras del sitio
        if (headers_sent()) {
            return false;
        }

        // Verificamos que exista el cookie dentro de nuestra
        // global, si no existe entonces no existe el cookie en sí
        if (!isset($_COOKIE[$cookie])) {
            return false;
        }

        // Seteamos el cookie con un valor null y tiempo negativo para destruirlo
        setcookie($cookie, '', time() - 1000, $path, $domain);
        unset($Forge_Cookies[$cookie]);

        return true;
    }
}