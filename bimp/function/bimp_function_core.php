<?php

function get_sitename(){ return SITE_NAME; }

function json_output($json, $die = true){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');

    if(is_array($json)){
        $json = json_encode($json);
    }
    
    echo $json;
    if($die){
        die;
    }

    return true;
}

function json_build($status = 200, $data = null, $msg = '', $error_code = null){
    if(empty($msg) || $msg == ''){
        switch($status){
            case 200: 
                $msg = 'OK';
                break;
            case 201: 
                $msg = 'Created';
                break;
            case 400: 
                $msg = 'Invalid request';
                break;
            case 403: 
                $msg = 'Access denied';
                break;
            case 404: 
                $msg = 'Not found';
                break;
            case 500: 
                $msg = 'Internal Server Error';
                break;
            case 550: 
                $msg = 'Permission denied';
                break;
            default:
                break; 
        }
    }

    $json = [
        'status' => $status,
        'error' => false,
        'msg' => $msg,
        'data' => $data
    ];

    if(in_array($status, [400, 403, 404, 405, 500])){
        $json['error'] = true;
    }

    if($error_code !== null){
        $json['error'] = $error_code;
    }

    return json_encode($json);
}

function check_posted_data($required_params = [], $posted_data = []){
    if(empty($posted_data)){
        return false;
    }

    $defaults = ['hook','action'];
    $required_params = array_merge($required_params, $defaults);
    $required = count($required_params);
    $found = 0;

    foreach($posted_data as $k => $v){
        if(in_array($k, $required_params)){
            $found++;
        }
    }

    if($found !== $required){
        return false;
    }

    return true;
}

function clean($str, $cleanhtml = false){
    $str = trim($str);
    $patterns = [
        '/\b(SELECT|INSERT|UPDATE|DELETE|DROP|EXEC|COUNT|AVG|SUM|MAX|MIN|CREATE|TRUNCATE|REPLACE|RENAME|ALTER|LOAD|UNION|ALL|ORDER|WHERE|LIMIT|GROUP|HAVING|INTO|VALUES|SET|FROM|LIKE|OR|AND|NOT|IN|BETWEEN|BY|TO|AS|NULL|TRUE|FALSE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE|EXECUTE)\b/i',
        '/\b(OR|AND|XOR|NOT|LIKE|BETWEEN|IN|IS|NULL)\b/i',
        '/--\s*\n/', // Comentarios en SQL
        '/#\s*\n/',   // Comentarios en SQL
        '/\/\*.*?\*\//s', // Comentarios en SQL
        '/;\s*$/',   // Punto y coma al final
        '/\bTRUE\b/i', // TRUE en SQL
        '/\bFALSE\b/i', // FALSE en SQL
        '/\bOR\s+TRUE\b/i', // OR TRUE en SQL
        '/\bAND\s+TRUE\b/i', // AND TRUE en SQL
    ];

    foreach($patterns as $pattern){
        $str = preg_replace($pattern, '', $str);
    }

    if($cleanhtml === true){
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    return filter_var($str, FILTER_SANITIZE_STRING);
}

/**
 * Convierte el elemento en un objecto
 *
 * @param [type] $array
 * @return void
 */
function to_object($array) {
  return json_decode(json_encode($array));
}

/**
 * Regresa parseado un modulo
 *
 * @param string $view
 * @param array $data
 * @return void
 */
function get_module($view, $data = []) {
  $file_to_include = MODULES.$view.'Module.php';
	$output = '';
	
	// Por si queremos trabajar con objeto
	$d = to_object($data);
	
	if(!is_file($file_to_include)) {
		return false;
	}

	ob_start();
	require_once $file_to_include;
	$output = ob_get_clean();

	return $output;
}

/**
 * Generar un link dinámico con parámetros get y token
 * 
 */
function buildURL($url , $params = [] , $redirection = true, $csrf = true) {
	
	// Check if theres a ?
	$query     = parse_url($url, PHP_URL_QUERY);
	$_params[] = 'hook='.strtolower(SITE_NAME);
	$_params[] = 'action=doing-task';

	// Si requiere token csrf
	if ($csrf) {
		$_params[] = '_t='.CSRF_TOKEN;
	}
	
	// Si requiere redirección
	if($redirection){
		$_params[] = 'redirect_to='.urlencode(CUR_URL);
	}

	// Si no es un array regresa la url original
	if (!is_array($params)) {
		return $url;
	}

	// Listando parámetros
	foreach ($params as $key => $value) {
		$_params[] = sprintf('%s=%s', urlencode($key), urlencode($value));
	}
	
	$url .= strpos($url, '?') ? '&' : '?';
	$url .= implode('&', $_params);
	return $url;
}

function get_user($key = null){
    if (!isset($_SESSION['user_session'])) return false;

    $session = $_SESSION['user_session'];

    if(!isset($session['user']) || empty($session['user'])) return false;
    
    $user = $session['user'];

    if($key === null) return $user;

    if(!isset($user[$key])) return false;

    return $user[$key];
}

/**
 * Insert campos html en un formulario
 * @return string
 */
function insert_inputs(){
    $output = '';
    
    if(isset($_POST['redirect_to'])){   
        $location = $_POST['redirect_to'];
    }else if(isset($_GET['redirect_to'])){
        $location = $_GET['redirect_to'];
    }else{
        $location = CUR_URL;
    }
    
    $output .= '<input type="hidden" id="redirect_to" name="redirect_to" value="'.$location.'">';
    $output .= '<input type="hidden" id="timecheck" name="timecheck" value="'.time().'">';
    $output .= '<input type="hidden" id="csrf" name="csrf" value="'.CSRF_TOKEN.'">';
    $output .= '<input type="hidden" id="hook" name="hook" value="bimp_hook">';
    $output .= '<input type="hidden" id="action" name="action" value="post">';
    
    return $output;
}

/**
 * Validar rut chileno
 * @return string
 */
function validar_rut($rut) {
    // Eliminar espacios y limpiar
    $rut = strtoupper(trim($rut));

    // Verificar formato general
    if (!preg_match('/^[0-9]{7,8}-[0-9K]$/', $rut)) {
        return false;
    }

    // Separar número y dígito verificador
    [$numero, $digito] = explode('-', $rut);

    // Calcular dígito verificador esperado
    $suma = 0;
    $multiplo = 2;
    for ($i = strlen($numero) - 1; $i >= 0; $i--) {
        $suma += $numero[$i] * $multiplo;
        $multiplo = ($multiplo == 7) ? 2 : $multiplo + 1;
    }

    $resto = $suma % 11;
    $dv_calculado = 11 - $resto;

    if ($dv_calculado == 11) $dv_calculado = '0';
    elseif ($dv_calculado == 10) $dv_calculado = 'K';
    else $dv_calculado = (string)$dv_calculado;

    // Comparar con el dígito ingresado
    return $digito === $dv_calculado;
}



