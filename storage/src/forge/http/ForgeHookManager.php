<?php 

namespace Bimp\Forge\Http;

class ForgeHookManager {

    /**
     * Instancia singleton de la clase ForgeHookManager
     * @var ForgeHookManager
     */
    private static $instance = null;

    /**
     * Listado de hooks ejecutables
     * @var array
     */
    private static $hooks = [];

    /**
     * Listado de todos los hooks registrados en algun punto de ejecucion
     * @var array
     */
    private static $hookList = [];

    //Constructor privado para evitar instanciacion directa
    private function __construct(){}

    public static function getIntance(){
        if(self::$instance === null) self::$instance = new self();

        return self::$instance;
    }

    /**
     * Registra un hook en la lista de hooks
     *
     * @param string $hookName
     * @param string $function
     * @return void
     */
    public static function registerHook(string $hookName, callable $function){
        self::$hooks[$hookName][] = $function;
    }

    /**
     * Undocumented function
     *
     * @param string $hookName
     * @param array ...$args
     * @return void
     */
    public static function runHook(string $hookName, ...$args){
        // Registrar el hook en el listado
        self::$hookList[] = $hookName;

        // Validar si existe dentro del array de hooks para ejecutar
        if (isset(self::$hooks[$hookName])) {
            foreach (self::$hooks[$hookName] as $function) {
                // if (!function_exists($function)) continue; // Permitirá generar funciones anónimas de PHP
                
                call_user_func_array($function, $args);
            }
        }
    }

    public static function runOnce(string $hookName, ...$args){
        // Registrar el hook en el listado
        self::$hookList[] = $hookName;

        // Validar si existe dentro del array de hooks para ejecutar
        if (isset(self::$hooks[$hookName])) {
            foreach (array_reverse(self::$hooks[$hookName]) as $function) {
                call_user_func_array($function, $args);

                break;
            }
        }
    }

    public static function getHookData(string $hookName, ...$args){
        $hookData = [];

        if (isset(self::$hooks[$hookName])) {
        foreach (self::$hooks[$hookName] as $function) {
            $hookData[] = call_user_func_array($function, $args);
        }
        }

        return $hookData;
    }

    /**
     * Regresa el listado de hooks ejecutables
     *
     * @return array
     */
    public static function getHooks(){
        return self::$hooks;
    }

    /**
     * Regresa el listaod de todos los hooks registrados
     *
     * @return void
     */
    public static function getHookList(){
        return self::$hookList;
    }


}