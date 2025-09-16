<?php

namespace Bimp\Forge\Console\Command\Make;

use Bimp\Forge\Console\Support\Process;
use Bimp\Forge\Console\Command\Command;

class Install implements Command {

    private function getProject(): string {
        return basename(dirname(__DIR__, 6));
    }

    public static function name(): string {
        return 'install';
    }

    public static function description(): string {
        return 'Instala las dependencias del proyecto';
    }

    public function execute(array $args): int {
        echo "Instalando dependencias..." . PHP_EOL;
        
        $min = "8.1.0";
        if(version_compare(PHP_VERSION, $min, '<')){
            fwrite(STDERR, "Error: La version de PHP es " . PHP_VERSION . ", se requiere al menos la version $min" . PHP_EOL);
            return 1;
        }


        echo "PHP version " . PHP_VERSION . " OK" . PHP_EOL;

        //Crear archivo .env si no existe
        $path = getcwd() . DIRECTORY_SEPARATOR . '.env';
        if(!file_exists($path)){
            $env = $this->default();
            if(file_put_contents($path, $env) === false){
                fwrite(STDERR, "Error: No se pudo crear el archivo .env en la raiz del proyecto" . PHP_EOL);
                return 1;
            }
            echo "Archivo .env creado correctamente" . PHP_EOL;
        }else{
            echo "Archivo .env ya existe, se omite su creación" . PHP_EOL;
        }

        $composer = null;
        if(Process::available('composer')){
            $composer = 'composer';
        }else if(file_exists('composer.phar')){
            $composer = 'php composer.phar';
        }

        if($composer){
            echo "Ejecutando dependencias de composer..." . PHP_EOL;
            $ret = Process::run("$composer install --no-interaction --prefer-dist");
            if($ret !== 0){
                fwrite(STDERR, "Error: No se pudieron instalar las dependencias de composer" . PHP_EOL);
                return $ret;
            }
            echo "Dependencias de composer instaladas correctamente" . PHP_EOL;
        }else{
            echo "No se encontro composer, se omite la instalación de dependencias" . PHP_EOL;
        }

        echo "Instalación completada." . PHP_EOL;
        return 0;
    }

    private function default(): string {
        $file = 'storage/src/forge/function/bimp_core.php';
        if(!is_file($file)) die(sprintf("Error: La carga del archivo funciones no fue posible cargarla. %s", $file));
        require_once $file;

        $project = $this->getProject();
        $project_logo = $this->getProject() . '.png'; 

        $key_public  = generate_key();
        $key_private = generate_key();

        $content = <<<ENV
#Nombre del proyecto principal no modificar
NAME_PROYECTO    = "{$project}"
LOGO_PROYECTO    = "{$project_logo}"
VERSION_PROYECTO = "1.0.0"
IS_DEMO          = true

# Datos de la empresa / negocio / sistema

SITE_LANG        = "es"
SITE_CHARSET     = ""
SITE_NAME        = ""
SITE_VERSION     = ""
SITE_LOGO        = ""
SITE_FAVICON     = ""
SITE_DESC        = ""
                    
# Set para conexión en producción o servidor real
DB_ENGINE  = "mysql"
DB_HOST    = "localhost"
DB_NAME    = ""
DB_USER    = "root"
DB_PASS    = ""
DB_CHARSET = "uft-8"

#Css framework a utilizar
CSS_FRAMEWORK = "bs5" #bs4 | bs5 | tailwind | foundation | bulma | materialize | uikit | none 

#Keys para consumos de la API de esta instancia de bimp forge
#puedes generarlas en bimp/generate
API_PUBLIC_KEY  = "{$key_public}"
API_PRIVATE_KEY = "{$key_private}"

#Salt utilizada para agregar seguridad al hash de contraseñas dependiendo el uso requerido
AUTH_SALT = ""

# Define si es requeria autenticacion para consumir los recursos de la API
#programaticamente se define que recursos son accesibles sin autenticación
#Por defecto true | false para consumir la API sin autenticacion | no recomendado 
API_AUTH = true

#Sesiones de usuario persistentes
FORGE_USERS_TABLE     = "_users"         #Nombre de la tabla para autenticación de usuarios
FORGE_COOKIES         = true               #Es utilizada para determinar si se usarán sesiones persistentes con cookies en el sistema
FORGE_COOKIE_ID       = "forge__cookie_id"  #Nombre del cookie para el identificador de usuario
FORGE_COOKIE_TOKEN    = "forge__cookie_tkn" # Nombre del cookie para el token generado para usuario
FORGE_COOKIE_LIFETIME = '60 * 60 * 24 * 7'
FORGE_COOKIE_PATH     = '/'
FORGE_COOKIE_DOMAIN   = ""

#Utilidades
JQUERY      = true
VUEJS       = true
AXIOS       = false
SWEETALERT2 = true
TOASTR      = true
WAITME      = true
LIGHTBOX    = false

USE_TWIG = false #define si será usado Twig por defecto para renderizar las vistas

CORREO_EMPRESA = ""
CLAVE_EMPRESA = ""

DEFAULT_CONTROLLER = "home"
DEFAULT_METHOD     = "index"

PHPMAILER_TEMPLATE = 'emailTemplate'

GMAPS = ""

ENV;

        return $content;
    }
}