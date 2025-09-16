<?php 

namespace Bimp\Forge\Http;

use Bimp\Forge\Database\Model;
use Bimp\Forge\Helpers\Cookies;

class ForgeSession {

	/**
	 * Identidicador del usuario en curso
	 * @var mixed
	 */
  private $id;

	/**
	 * Token de acceso del usuario
	 * @var string
	 */
	private $token;

	/**
	 * Tabla dónde se almacena la información de usuarios
	 * @var string
	 */
  private $forge_users_table     = FORGE_USERS_TABLE;

	/**
	 * Determina si se usarán o no cookies
	 *
	 * @var bool
	 */
  private $forge_cookies         = FORGE_COOKIES;

	/**
	 * Nombre del cookie para el ID
	 *
	 * @var string
	 */
	private $forge_cookie_id       = FORGE_COOKIE_ID;

	/**
	 * Nombre del cookie para el token
	 *
	 * @var string
	 */
	private $forge_cookie_token    = FORGE_COOKIE_TOKEN;

	/**
	 * Tiempo de expiración del cookie en segundos
	 *
	 * @var int
	 */
	private $forge_cookie_lifetime = FORGE_COOKIE_LIFETIME;
    private $forge_cookie_path     = FORGE_COOKIE_PATH;
	private $forge_cookie_domain   = FORGE_COOKIE_DOMAIN;
	
	/**
	 * Información del usuario
	 *
	 * @var ?array
	 */
	private $current_user        = null;

	function __construct()
	{
		// Validar que todo esté en orden configurado
		$this->check_if_ready();
	}
	
	/**
	 * Verificamos que las configuraciones
	 * sean correctas para poder trabajar
	 * con sesiones persistentes
	 *
	 * @return bool
	 */
	public function check_if_ready()
	{
		// Se verifica la existencia correcta de las constantes requeridas y variables
		try {
			if ($this->forge_cookies === false || !defined('FORGE_COOKIES')) {
				throw new Exception(sprintf('Es requerida la constante %s para poder trabajar con sesiones persistentes de %s.', 'FORGE_COOKIES', get_forge_name()));
			} 

			// Verificar que haya una conexión con la base de datos
			$tables = Model::list_tables();
			if (empty($tables)) {
				throw new Exception('No hay tablas en la base de datos.');
			}
			
			// Verificar que exista la tabla de usuarios en la base de datos
			if (!Model::table_exists($this->forge_users_table)) {
				throw new Exception(sprintf('No existe la tabla %s en la base de datos.', $this->forge_users_table));
			}
	
			// Proceder solo si todo está en orden
			return true;
			
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	/**
	* Valida si existe una sesión almacenada en cookies / y si es válida
	* @access public
	* @var $_COOKIE ID_USR $_COOKIE TKN
	* @return array | false
	**/
	public static function authenticate()
	{
		// Instancia de nuestra BeeSession
		$self = new self();

		// Validar la existencia de los cookies en el sistema
		if (!Cookies::cookie_exists($self->forge_cookie_id) || !Cookies::cookie_exists($self->forge_cookie_token)) {
			// Si no existe la coincidencia vamos a borrar los cookies por seguridad
			Cookies::destroy_cookie($self->forge_cookie_id, $self->forge_cookie_path, $self->forge_cookie_domain);
			Cookies::destroy_cookie($self->forge_cookie_token, $self->forge_cookie_path, $self->forge_cookie_domain);

			return false;
		}

		// Verificamos que exista el usuario con base a la información de nuestro cookie
		if (!$self->current_user = Model::list($self->forge_users_table, ['id' => Cookies::get_cookie($self->forge_cookie_id)], 1)) {
			return false;
		}

		// Información del usuario
		$user        = $self->current_user;
		$auth_token  = $user['auth_token']; // el token guardado en la DB
		$self->token = Cookies::get_cookie($self->forge_cookie_token); // el token guardado en la cookie

		// Verificamos si coincide la información
		if (!password_verify($self->token, $auth_token)) {
			// Si no existe la coincidencia vamos a borrar los cookies por seguridad
			Cookies::destroy_cookie($self->forge_cookie_id, $self->forge_cookie_path, $self->forge_cookie_domain);
			Cookies::destroy_cookie($self->forge_cookie_token, $self->forge_cookie_path, $self->forge_cookie_domain);

			return false;
		}
		
		return $user; // return $user si todo es correcto
	}

	/**
	* Inicia la sesión persistente del usuario en curso
	* @access public
	* @var array
	* @return bool
	**/
	public static function new_session($id) 
	{
		// Nueva instancia para usar las propiedades de la clase
		$self  = new self();

		// Creamos un nuevo token
		$token = generate_token();

		// Cargamos la información del usuario
		$user  = Model::list($self->forge_users_table, ['id' => $id], 1);

		if (empty($user)) {
			return false; // no existe el usuario en curso
		}

		// Verificamos si existen los cookies para borrarlos y generar nuevos
		if (Cookies::cookie_exists($self->forge_cookie_id) || Cookies::cookie_exists($self->forge_cookie_token)) {
			// Si existen los borramos
			Cookies::destroy_cookie($self->forge_cookie_id, $self->forge_cookie_path, $self->forge_cookie_domain);
			Cookies::destroy_cookie($self->forge_cookie_token, $self->forge_cookie_path, $self->forge_cookie_domain);
		}

		// Creamos nuevos cookies
		Cookies::new_cookie($self->forge_cookie_id, $id, $self->forge_cookie_lifetime, $self->forge_cookie_path, $self->forge_cookie_domain);
		Cookies::new_cookie($self->forge_cookie_token, $token, $self->forge_cookie_lifetime, $self->forge_cookie_path, $self->forge_cookie_domain);

		// Actualizamos el token en la base de datos
		Model::update($self->forge_users_table, ['id' => $id], ['auth_token' => password_hash($token, PASSWORD_BCRYPT)]);

		return true;
	}

	/**
   * Utilizada para destruir una sesión persistente de nuestro usuario
   * loggeado en el sistema
   * @return bool
   */
	public static function destroy_session()
	{
		$self = new self();

		// Se destruyen todos los tokens generados para que sea imposible el ingreso con ese mismo token después
        if (!Model::update($self->forge_users_table, ['id' => Cookies::get_cookie($self->forge_cookie_id)], ['auth_token' => null])) {
            return false;
        }
            
        // Se destruyen todos los cookies existentes
        Cookies::destroy_cookie($self->forge_cookie_id, $self->forge_cookie_path, $self->forge_cookie_domain);
        Cookies::destroy_cookie($self->forge_cookie_token, $self->forge_cookie_path, $self->forge_cookie_domain);
        
        // Se regresa true si se borra todo con éxito
        return true;
    }
}