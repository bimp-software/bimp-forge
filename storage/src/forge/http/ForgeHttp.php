<?php

namespace Bimp\Forge\Http;

use Bimp\Forge\Exceptions\ForgeHttpException;

use Bimp\Forge\Security\Csrf;

/**
 * @since 3.0.0
 * 
 * Clase encargada de realizar el proceso de peticiones recibidas por las rutas
 * de ajaxController y apiController y sus variantes para controlar 
 * peticiones http y consumir recursos o servicios de la REST API
 * de forge framework
 * 
 * Esta clase implementa las funcionalidades anteriores de forge ajaxController
 * en su versión 2.x
 * 
 * @version 3.0.0
 */
class ForgeHttp {

    /**
     * Determina el tipo de llamada
     * si es api se refiere a que esta solicitando apiController
     * o si es ajax se refiere a que se esta solicitando ajaxController
     * @var string
     */
    private $call = null;

    /**
     * El verbo de la peticion realizada al servidor
     * @var string
     */
    private $r_type = null;

    /**
     * Token csrf de la session del usuario que solicita la peticion
     * solo disponible para ser usada en peticiones ajax POST
     * API requiere una autenticacion diferente
     * @var string
     */
    private $csrf = null;

    /**
     * Todos los paramentros recibidos de la peticion
     * @var array
     */
    private $data  = null;

    /**
     * @since 3.0.0
     * @var mixed
     */
    private $body = null;

    /**
     * Paramentros parseados en caso de ser peticion put | delete | headers | options
     * @var mixed
     */
    private $parsed = null;

    /**
     * Array de archivos binarios pasados
     * en peticion POST al servidor
     * @since 3.0.0
     * @var array
     */
    private $files = [];

    /**
     * Posibles verbos o cciones disponibles para nuestra peticion
     * 
     * @since 3.0.0
     * @var array
     */
    private $accepted_verbs = ['GET','POST','PUT','PATCH','DELETE','COPY','HEAD','OPTIONS','LINK','UNLINK','PURGE','LOCK','UNLOCK','PROPFIND','VIEW'];
    
    /**
     * Cabeceras de la peticion entrante
     * @since 3.0.0
     * @var array
     */
    private $headers = [];

    /**
     * Api Keys recibidas para consumir ciertos recursos
     * solo en  caso de ser necesarias
     * @since 3.0.0
     * @var string
     */
    private $public_key = null;
    private $private_key = null;

    /**
     * Determina si la peticion esta siendo realizada en sun servidor 
     * apache, asi podemos acceder a las cabeceras y su contenido 
     * de forma sencilla usando PHP apache_request_headers()
     * @since 3.0.0
     * @var boolean
     */
    private $apache_request = false;

    /**
     * Determina si es requerido validar que exista una key de autorizacion en las 
     * cabeceras de la peticion
     * 
     * Solo es utilizado si es una peticion http de consumo de la API
     * para peticiones ajax no es requerido ni valido
     * @since 3.0.0
     * @var boolean
     */
    private $authenticate = false;

    /**
     * Protocolo de la URL 
     * puede ser http o https segun sea el caso 
     * 
     * esto genera una variacion en las cabeceras enviadas, es necesario para leer
     * de forma correcta los paramentros de autorizacion en las peticiones
     * Auth_private_key y Auth_public_key
     * 
     * @since 3.0.0
     * @var string
     */
    private $protocol = null;

    /**
     * El dominio de la peticion, para autorizar cuando la API se consume o se trata de acceder desde 
     * otro diferente
     * 
     * @since 3.0.0
     * @var string
     */
    private $origin = '';

    /**
     * Dominios autorizados para acceder a los recursos
     * @since 3.0.0
     * @var array
     */
    private $domains = [];


    function __construct(array $options = [])
    {
        //Autorizacion de acceso con Token en headers
        $this->authenticate = isset($options['authenticate']) ? $options['authenticate'] : \forge_api_authentication();
        
        //Dominios para CORS
        $this->domains = isset($options['domains']) ? $options['domains'] : [];

        //El verbo HTTP utilizado en la peticion
        $this->r_type = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

        //Protocolo http de la peticion
        $this->protocol = PROTOCOL;
    }

    /**
     * Verifica que la peticion tenga un verbo aceptado en la lista de verbos aceptados
     * @return void
     */
    private function validateRequestVerb(){
        if(!in_array(strtoupper($this->r_type), $this->accepted_verbs)){
            throw new ForgeHttpException("Verbo de peticion no aceptado", 403);
        }
    }

    private function handlePreflightRequest(){
        //Establecer las cabeceras CORS para la Preflight request
        //Obtener el valor del origen de la solicitud desde el encabezado
        $this->origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : null;

        //Verificar si el origen esta en la lista de dominios permitidos
        if(in_array($this->origin, $this->domains)){
            //Establecer el valor del origen permitido en la cabecera Access-Control-Allow-Origin
            header("Access-Control-Allow-Origin: " . $this->origin);
        } else if(in_array('*', $this->domains)){ 
            //Permitir cualquier origen (dominio) para acceder a tu API
            header("Access-Control-Allow-Origin: *");
        } else {
            //Permitir solo el dominio base por defecto
            header("Access-Control-Allow-Origin: " . URL);
        }

        // Especificar los métodos HTTP permitidos para acceder a tu API
        header(sprintf('Access-Control-Allow-Methods: %s', rtrim(implode(',', $this->accepted_verbs), ',')));

        if ($this->authenticate === true) {
            // Permitir ciertos encabezados personalizados en las solicitudes
            header('Access-Control-Allow-Headers: Content-Type, Authorization');

            // Indicar si las credenciales (cookies, autenticación HTTP) se pueden incluir en la solicitud desde el cliente
            header('Access-Control-Allow-Credentials: true');

        } else {
            header('Access-Control-Allow-Headers: Content-Type');
        }

        // Verificar si la solicitud es una Preflight Request (OPTIONS)
        if ($this->r_type === 'OPTIONS') {
            http_response_code(200);
            exit(); // Terminar el script después de enviar las cabeceras de respuesta
        }
    }

    /**
     * Carga todas las cabeceras de la petición
     * se almacenan en nuestra propiedad $headers
     * @since 3.0.0
     * @return void
     */
    private function get_headers() {
        $this->apache_request = false;

        if (function_exists('apache_request_headers')) {
            $this->headers        = apache_request_headers();
            $this->apache_request = true;
            $this->headers        = isset($_SERVER) ? array_merge($this->headers, $_SERVER) : $this->headers;
        } else {
            $this->headers        = isset($_SERVER) ? $_SERVER : $this->headers;
        }
    }

    /**
     * Buscamos dentro de las cabeceras de la petición
     * si se han enviado alguna de las API keys de autenticación
     * para consumir los recursos de la API.
     * 
     * Se ha actualizado el nombre de nuestra cabecera de autorización para
     * mejorar la seguridad e ir a la par con estándares actuales
     * @since 3.0.0
     * @return void
     */
    private function set_api_keys() {
        // Verificar si la cabecera 'Authorization' está presente en la solicitud
        if (isset($this->headers['HTTP_AUTHORIZATION'])) {
            // Obtener el valor del encabezado 'Authorization'
            $authorizationHeader = $this->headers['HTTP_AUTHORIZATION'];
            // Comprobar si el encabezado contiene el prefijo "BimpForge "
            if (preg_match('/^BimpForge\s+(.*)$/', $authorizationHeader, $matches)) {
                $this->private_key = $matches[1];
            }
        }
    }

    /**
     * Compara la api key privada de esta instancia de bee framework
     * con la enviada en las cabeceras de la petición http para autorizar el acceso
     *
     * @return true si es correcto | excepción si no lo es
     */
    public function authenticate_request() {
        if ($this->authenticate === false) return true; // no es necesaria la autenticación
        
        $api_key = get_forge_api_private_key();

        if (strcmp($api_key, $this->private_key) !== 0) {
            throw new ForgeHttpException(get_forge_message(0), 403);
        }

        return true;
    }

    function setAuthentication(bool $authenticate) {
        $this->authenticate = $authenticate;
    }

    /**
     * Verifica y establece el valor del token CSRF enviado por el usuario
     * en la petición en
     *
     * @return void
     */
    private function check_csrf(){
        $this->csrf = isset($this->data['csrf']) ? $this->data['csrf'] : null;
    }

    /**
     * Establece el tipo de llamada o petición realizada
     *
     * @param string $callType
     * @return void
     */
    function setCallType(string $callType) {
        $this->call = $callType;
    }

    /**
     * Valida que el token CSRF enviado en la petición
     * sea correcto y válido para el usuario en curso
     *
     * @return void
     */
    private function validate_csrf(){
        if ($this->call === 'ajax' && in_array(strtolower($this->r_type), ['post', 'put', 'delete']) && !Csrf::validate($this->csrf)) {
            throw new ForgeHttpException('Autorización no válida.', 401); // 401
        }
    }

    /**
     * Parsea el contenido del cuerpo de la petición con
     * base al verbo o tipo de petición realizada
     * @since 3.0.0
     * @return void
     */
    private function parse_body() {
        // Leer el ouput del cuerpo dependiendo el verbo o petición
        switch (strtolower($this->r_type)) {
            case 'get':
                    $this->body  = $_GET;
                    $this->data  = $this->body;
                break;
            case 'post':
            case 'put':
            case 'delete':
            case 'headers':
            case 'options':
                // Accedemos al content type definido por la petición
                $contentType = isset($this->headers['CONTENT_TYPE']) ? $this->headers['CONTENT_TYPE'] : '';

                // Dependiendo el tipo de petición accedemos de forma diferente al cuerpo de la petición y la data en él
                if ($this->r_type === 'POST') {
                    if ($contentType === 'application/json' || strpos($contentType, 'application/json') !== false) {
                        // El cuerpo de la solicitud está en formato JSON
                        $this->body   = file_get_contents('php://input');
                        $this->data   = json_decode($this->body, true);
                    } else if (strpos($contentType, 'multipart/form-data') !== false) {
                        // El cuerpo de la solicitud está en formato form-data o similar
                        $this->data   = $this->body = $_POST;
                    } else if (strpos($contentType, 'text/plain') !== false) {
                        $this->body   = file_get_contents('php://input');
                        $this->data   = json_decode($this->body, true);
                    } else if (isset($_POST)) {
                        $this->data   = $this->body = $_POST;
                    }
                } else if ($this->r_type === 'PUT') {
                    // Cargamos todo el contenido del cuerpo de la solicitud
                    $this->body     = file_get_contents('php://input');

                    // Verificar el tipo de contenido del cuerpo de la solicitud
                    if ($contentType === 'application/json' || strpos($contentType, 'application/json') !== false) {
                        // El cuerpo de la solicitud está en formato JSON
                        $this->data   = json_decode($this->body, true);
                    } else if (strpos($contentType, 'multipart/form-data') !== false) {
                        // El cuerpo de la solicitud está en formato form-data o similar
                        // Puedes usar parse_str para analizar los datos de form-data en un array asociativo
                        parse_str($this->body, $this->parsed);
                        $this->data = $this->parsed;
                    }
                } else {
                    $this->body   = file_get_contents('php://input');
                    $this->data   = json_decode($this->body, true);
                }

                // Anexamos todos los archivos encontrados
                $this->files  = isset($_FILES) ? $_FILES : [];
            break;
        }
    }

    /**
     * Contruye un array con toda la información de la petición
     * @since 3.0.0
     * @return array
     */
    private function build_request() {
        return
        [
            'headers' => $this->headers,
            'type'    => $this->r_type,
            'data'    => $this->data,
            'files'   => $this->files
        ];
    }

    /**
     * Para escpecificar los verbos aceptados o autorizados en una ruta determinada.
     *
     * @param array $verbs
     * @return true
     */
    public function accept(array $verbs) {
        if (!in_array(strtoupper($this->r_type), array_map('strtoupper', $verbs))) {
            throw new ForgeHttpException('El verbo HTTP solicitado no está autorizado en esta ruta.',403);
        }
        
        return true;
    }

    /**
     * Regresa el contenido de la petición
     *
     * @return array
     */
    public function get_request(){
        return $this->build_request();
    }

    function process(){
        /**
         * @since 3.0.0
         */
        //Validar que se pase un verbo valido y aceptado
        $this->validateRequestVerb();

        //Se encarga de validar la peticiones OPTIONS de preflight para CORS
        $this->handlePreflightRequest();

        //Almacenando y detemrniando las cabeceras recibidas
        $this->get_headers();

        //Establecer las API keys si en caso de estar presentes en la peticion
        $this->set_api_keys();

        //Pasinge del cuerpo de la petición
        $this->parse_body();

        //Validar token CSRF si es necesario
        $this->check_csrf();
        
        //Verificar la autenticación de la petición si es requerida
        $this->validate_csrf();
    }

    function registerDomain(string $domain) {
        $this->domains[] = $domain;
    }

}