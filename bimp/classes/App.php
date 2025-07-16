<?php

namespace Bimp\Forge;

use Bimp\Forge\Helpers\Autoloader;
use Bimp\Forge\Router\Routes;
use Bimp\Forge\Security\Csrf;
use Bimp\Forge\Flasher\Flasher;

use Bimp\Forge\Logs\Logs;
use Bimp\Forge\Exceptions\Exceptions;

class App {

    /**
     * Nombre del framework
     * @var string
     */
    private $framework    = 'Bimp Forge';

    /**
     * Version del framework
     * @var string
     */
    private $version      = '2.0.0';

    /**
     * Lenguaje
     * @var string
     */
    private $lng          = 'es';


    public function __construct(){
        try {
            $this->init();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    private function init(){
        $this->init_session();
        $this->init_config();
        $this->init_function();
        $this->init_composer();
        $this->init_autoload();
        $this->init_configuracion();
        $this->init_csrf();
        $this->init_logs();
        $this->init_router();
    }

    private function init_composer() : void {
        $file = realpath(__DIR__ . '/../../vendor/autoload.php');
        if (!$file || !is_file($file)) {
            die(sprintf("El archivo %s no se encuentra, es requerido para que funciones.", 'vendor/autoload.php'));
        }
        require_once $file;
    }

    private function init_config() : void {
        $file = 'bimp/settings/Settings.php';
        if(!is_file($file)){ die(sprintf("Error al cargar la configuracion del proyecto. %s", $file)); }
        require_once $file;
        return;
    }

    private function init_function() : void {
        $file = FUNCION.'bimp_function_core.php';
        if(!is_file($file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que funcione.', $file)); 
        }
        require_once $file;

        $file = FUNCTIONS.'bimp_function_custom.php';
        if(!is_file($file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que funcione.', $file)); 
        }
        require_once $file;
        
        return;
    }

    private function init_configuracion() : void {
        $file = CONFIG.'bimp_config.php';
        if(!is_file($file)){
            die(sprintf('El archivo %s no se encuentra, es requerido para que funcione.', $file)); 
        }
        require_once $file;
        
        return;
    }

    private function init_session() : void {
        if(session_status() === PHP_SESSION_NONE){
            ob_start();
            session_start();
        }
        return;
    }

    private function init_csrf(){
        $csrf = new Csrf();
        define('CSRF_TOKEN', $csrf->get_token());
    }

    private function init_autoload() : void {
        Autoloader::init();
        return;
    }

    private function init_logs(){
        $logger = new Logs(LOG, is_local() ? 'local' : 'production');
        set_exception_handler([new Exceptions($logger), 'handle']);

        if(is_local()){
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
        }else{
            ini_set('display_errors', 0);
            error_reporting(0);
        }
    }

    private function init_router() {
        $routes = new Routes();
        $routes->dispatch();
    }

    public static function run(){
        new self();

        return;
    }
}


