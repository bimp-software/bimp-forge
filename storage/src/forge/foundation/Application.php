<?php

namespace Bimp\Forge\Foundation;

use Dotenv\Dotenv;

use \ReflectionMethod;

use Bimp\Forge\Helpers\Autoloader;
use Bimp\Forge\Http\ForgeHookManager;
use Bimp\Forge\Routers\Routers;
use Bimp\Forge\Security\Csrf;

use Bimp\Forge\Auth\Authenticator;

use Bimp\Forge\Helpers\Cookies;
use Bimp\Forge\Http\ForgeSession;


class Application {
    /**
     * Nombre del framework
     * @var string
     */
    private $framework = "forge";

    /**
     * Version del framework
     * @var string
     */
    private $version = "3.0.0";

    /**
     * Logo del framework
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $lng;

    /**
     * La URL completa que se recibe para procesar las peticiones
     * @var string
     */
    private $uri = '';
    
    /**
     * Define si es requerido el uso de librerias externas en el proyecto
     * @var boolean
     * @deprecated 3.0.0
     */


    /**
     * @since 3.0.0
     * @var string
     */
    private $current_controller  = null;
    private $requestedController = null;
    private $controller          = null;
    private $current_method      = null;
    private $method              = null;
    private $params              = [];
    private $cont_not_found      = false;
    private $method_not_found    = false;
    private $missing_params      = false;
    private $is_ajax             = false;
    private $is_endpoint         = false;
    private $endpoint            = ['api']; //Rutas o endpoint autorizados de la API por defecto
    private $ajaxes              = ['ajax']; // Rutas o controladores para procesar peticiones asincronas o AJAX

    function __construct(){}

    function __destruct(){}

    /**
     * Agregar un nuevo endpoint a la lista
     * @param string $endpoint Nombre del controlador a agregar
     * @return void
     */
    function addEndpoint(string $endpoint){
        $this->endpoint[] = $endpoint;
    }

    /**
     * Agregar un nuevo controlador ajax a la lista de autorización
     * @param string $controller Nombre del controlador a agregar
     * @return void
     */
    function addAjax(string $ajax){
        $this->ajaxes[] = $ajax;
    }

    /**
     * Metodo para ejecutar cada "metodo" de forma subsecuente
     * @return void
     */
    private function init(){
        //Todos los metodos que queremos ejecutar consecutivamente
        $this->init_env();
        $this->init_session();
        $this->init_config();
        $this->init_functions();
        $this->init_framework_properties();
        $this->init_load_composer(); // Carga las dependiencia de composer
        $this->init_autoload(); // Inicializa el acargador de nuestras clases

        try {
            ForgeHookManager::runHook('init_set_up', $this);
            ForgeHookManager::runHook('after_functions_loaded');

            /**
             * Se ha actualizado el orden de ejecucion para poder
             * filtrar las peticiones en caso de ser necesario 
             * como un middleware, asi se tiene ya disponible desde el inicio que contralador, metodo y parametro
             * para el usuario, y pueden ser usados desde antes
             * @since 3.0.0
             */
            $routers = new Routers($this->uri);
            $this->uri = $routers->filter_url();
            ForgeHookManager::runHook('after_init_filter_url', $this->uri);
            $this->init_defaults();

            /**
             * Inicializacion de globales del framework, token csrf y autenticación
             */
            $this->init_csrf();
            $this->init_globals();
            ForgeHookManager::runHook('after_init_globals');
            $this->init_authentication();
            $this->init_set_globals();
            ForgeHookManager::runHook('after_set_globals');
            init_custom($this->current_controller, $this->current_method, $this->params);
            ForgeHookManager::runHook('after_init_custom');

            /**
             * Se hace ejecución de todo nuestro framework
             */
            ForgeHookManager::runHook('before_init_dispatch', $this->current_controller, $this->current_method, $this->params);
            $this->init_dispatch();

        } catch (\Exception $e) {
            
        }

    }

    /** */
    private function init_env(): void{
        //Determinar el directorio raiz del proyecto
        //Subes 4 niveles desde la ubicacion actual
        $path = dirname(__DIR__,4);

        if(file_exists($path.'/.env')){
            $dotnev = Dotenv::createImmutable($path);
            $dotnev->load();
        }else{
            die("Error: No se ha encontrado el archivo .env en la raiz del proyecto, es requerido para que el sitio funcione.");
        }
        return;

    }

    /**
     * Metodo para iniciar la sesion en el sistema
     */
    private function init_session(): void {
        if(session_start() === PHP_SESSION_NONE){
            ob_start();
            session_start();
        }
        return;
    }

    /**
     * Metodo para cargar la configuracion del sistema
     * @return void
     */
    private function init_config(): void {
        //Carga del archivo de config inicialmente para establecer las contantes personalizas
        $file = 'storage/src/forge/configuration/Config.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo de configuracion del proyecto. %s", $file));
        require_once $file;

        $file = 'storage/src/forge/configuration/Bootstrap.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo de credenciales del proyecto. %s", $file));
        require_once $file;

        $file = 'storage/src/forge/configuration/Settings.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo de configuracion del proyecto. %s", $file));
        require_once $file;

        return;
    }

    /**
     * Setea los valores del nombre del framework
     * la version del framework y el lenguaje
     * Requiere que se hayan cargado config y setting
     * @return void
     */
    private function init_framework_properties(){
        $this->framework = "Bimp Forge";
        $this->version   = "3.0.0";
        $this->logo      = "bimp_logo.png";
        $this->lng       = "es";

        define('FORGE_NAME'    , $this->framework);
        define('FORGE_VERSION' , $this->version);
        define('FORGE_LOGO'    , $this->logo);
        define('FORGE_DEVS'    , 'benjamin Patricio Caceres Ramirez');
    }

    /**
     * Inicializa composer
     */
    private function init_load_composer(){
        $file = ROOT.'vendor/autoload.php';
        if(!is_file($file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que el sitio funcione.',$file));
        }

        //Cargando el archivo de configuración
        require_once $file;
    }

    /**
     * Metodo para cargar las variables globales del sistema
     * @return void
     */
    private function init_globals(){
        $file = ROOT.'app/functions/bimp_globals.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo de variables globales del proyecto. %s", $file));
        require_once $file;
    }

    private function init_set_globals(){
        global $Forge_Cookies, $Forge_Messages, $Forge_Object;

        $Forge_Cookies = Cookies::get_all_cookies();

        $Forge_Object = \forge_obj_default_config();

        $Forge_Messages = \get_forge_default_messages();
    }

    /**
     * Metodo para cargar el archivo con funciones personalizadas del usuario
     * @return void
     */
    private function init_functions(){
        $file = ROOT.'app/functions/bimp_functions_custom.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo de funciones customizadas del proyecto. %s", $file));
        require_once $file;

        $file = FUNCIONES.'bimp_core.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo de funciones predeterminada del proyecto. %s", $file));
        require_once $file;

    }


    /**
     * Iteramos sobre los elementos de la uri
     * para descomponer los elementos que necesitamos
     * controller
     * method
     * params
     * 
     * Definimos las diferentes constantes que ayudan al sistema Forge
     * a funcionar de forma correcta
     * @return void
     */
    private function init_defaults(){
        /**
         * Necesitamos saber si se esta pasando el nombre de un controlador en nuestro URI
         * $this->uri[0] es el controlador en cuestión
         */
        if(isset($this->uri[0])){
            $this->current_controller = strtolower($this->uri[0]); //users Controller.php
            unset($this->uri[0]);
        }else{
            $this->current_controller = DEFAULT_CONTROLLER;
        }

        //Definir el controlador solicitado (este valor no cambiara en ningun punto)
        $this->requestedController = $this->current_controller;

        //Validando si la peticion entrante original es ajax, ajaxController es el unico controlador aceptado para AJAX
        if(in_array($this->current_controller, $this->ajaxes)){
            $this->is_ajax = true;
        }

        //Validando si la peticion entrante original es un endpoint de API
        if(in_array($this->current_controller, $this->endpoint)){
            $this->is_endpoint = true;//Lo usamos para filtrar mas adelante nuestro tipo de respuesta al usuario
        }

        //Definiendo el nombre del archivo del controlador
        $this->controller = $this->current_controller.'Controller';

        //Verificamos si no existe la clase buscada, se asigna la por defecto si no existe
        if(!class_exists($this->controller)){
            $this->current_controller = DEFAULT_ERROR_CONTROLLER; //Para que el controlador sea Error
            $this->controller         = DEFAULT_ERROR_CONTROLLER.'Controller'; // errorController
            $this->cont_not_found     = true;// No se ha encontrado la clase o controlador en el sistema
        }

        /////////////////////////////////////////////////////////////////////////////////
        // Validación del método solicitado
        if (isset($this->uri[1])) {
            $this->method = str_replace('-', '_', strtolower($this->uri[1]));

            // Existe o no el método dentro de la clase a ejecutar (controllador)
            if (!method_exists($this->controller, $this->method)) {
                $this->current_controller = DEFAULT_ERROR_CONTROLLER; // controlador de errores por defecto
                $this->controller         = DEFAULT_ERROR_CONTROLLER . 'Controller'; // errorController
                $this->current_method     = DEFAULT_METHOD; // método index por defecto
                $this->method_not_found   = true; // el método de la clase no existe
            } else {
                $this->current_method     = $this->method;
            }

            unset($this->uri[1]);
        } else {
            $this->current_method       = DEFAULT_METHOD; // index
        }

        //Verificar que el metodo solicitado sea publico de lo contrario no se da acceso
        $reflection = new ReflectionMethod($this->controller, $this->current_method);
        if(!$reflection->isPublic()){
            $this->current_controller = DEFAULT_ERROR_CONTROLLER; // controlador de errores por defecto
            $this->controller         = DEFAULT_ERROR_CONTROLLER . 'Controller'; // errorController
            $this->current_method     = DEFAULT_METHOD; // método index por defecto
        }

        //Obteniendo los paramentros de la URI
        $this->params = array_values(empty($this->uri) ? [] : $this->uri);

        /**
         * Verifica el tipo de peticion que se esta solicitando
         * @since 3.0.0
         */
        $this->init_check_request_type();

        /////////////////////////////////////////////////////////////////////////////////
        // Creando constantes para utilizar más adelante
        define('CONTROLLER', $this->current_controller);
        define('METHOD'    , $this->current_method);
    }

    /**
     * Verifica el tipo de peticion que esta recibiendo nuestro
     * sistema, para setear una constante que nos ayudara a filtrar
     * ciertas acciones a realizar al inicio
     * @return void
     */
    private function init_check_request_type(){
        /**
         * Reconstruye los valores por defecto si es una peticion aJAX o a Endpoint de API
         * @since 3.0.0
         */
        if ($this->is_ajax === true) {
            define('DOING_AJAX', true);
        } elseif ($this->is_endpoint === true) {
            define('DOING_API', true);
        } elseif ($this->current_controller === 'cronjob') {
            define('DOING_CRON', true);
        } elseif ($this->current_controller === 'xml') {
            define('DOING_XML', true);
        }

        // En caso de que no exista el controlador solicitado pero es AJAX o Endpoint
        if ($this->cont_not_found === true) {
            if ($this->is_ajax === true) {
                $this->current_controller = 'ajax';
                $this->controller         = $this->current_controller . 'Controller';
                $this->current_method     = DEFAULT_METHOD;
            }

            if ($this->is_endpoint === true) {
                $this->current_controller = 'api';
                $this->controller         = $this->current_controller . 'Controller';
                $this->current_method     = DEFAULT_METHOD;
            }
        }

        // En caso de que no exista la ruta solicitada
        if ($this->method_not_found === true && ($this->is_ajax || $this->is_endpoint)) {
            $this->current_controller = $this->requestedController;
            $this->controller         = $this->current_controller . 'Controller';
            $this->current_method     = DEFAULT_METHOD;
        }
    }

    /**
     * Metodo para cargar todos los archivos de forma automatica
     */
    private function init_autoload(){
        Autoloader::init();
        return; 
    }

    /**
     * Inicia la validación de sesión en caso de existir 
     * sesiones persistentes de Bee framework
     *
     * @return mixed
     */
    private function init_authentication(){
        global $Forge_User;

        // Para mantener abierta una sesión de usuario al ser persistente
        if (persistent_session()) {
            try {
                // Autenticamos al usuario en caso de existir los cookies
                // y de que sean válidos
                $user = ForgeSession::authenticate();

                // En caso de que validación sea negativa y exista una sesión en curso abierta
                // se destruye para prevenir cualquier error o ataque
                if ($user === false && Authenticator::validate()) {
                    Authenticator::logout();
                    return true; // para prevenir que siga ejecutando
                }

                // En esta parte se puede cargar información diferente o adicional del usuario
                // ya que sabemos que su autenticación es válida
                ////////////////////////////////////

                $Bee_User = !empty($user) ? $user : [];
                // ---> $user = usuarioModel::by_id($id);

                ////////////////////////////////////
                // Se agrega la información del usuario a sesión
                if (!empty($Forge_User)) {
                    /**
                     * Para prevenir la regeneración del token e id de sesión
                     * en caso de que ya haya ocurrido un inicio de sesión previo
                     */
                    if (!Authenticator::validate()) {
                        Authenticator::login($Forge_User['id'], $Forge_User);
                    }
                }

                return true;
            } catch (\Exception $e) {
                forge_die($e->getMessage());
            }
        }
    }


    private function init_csrf(){
        $csrf = new Csrf();
        define('CSRF_TOKEN', $csrf->get_token());
    }

    /**
     * Método para ejecutar y cargar de forma automática el controlador solicitado por el usuario
     * su método y pasar parámetros a él.
     *
     * @return bool
     */
    private function init_dispatch(){
        // Ejecutando controlador y método según se haga la petición
        $this->controller = new $this->controller;
        $controllerType   = 'regular';

        // Verificar el tipo de controlador
        if (method_exists($this->controller, 'getControllerType')) {
            $controllerType = $this->controller->getControllerType();
        }

        // Llamada al método que solicita el usuario en curso
        if (empty($this->params)) {
            call_user_func([$this->controller, $this->current_method]);
        } else {
            call_user_func_array([$this->controller, $this->current_method], $this->params);
        }

        return true; // Línea final, todo sucede entre esta línea y el comienzo
    }

    public static function forge(){
        $app = new self();
        $app->init();
        return;
    }
}