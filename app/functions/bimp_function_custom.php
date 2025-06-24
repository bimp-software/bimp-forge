<?php
//////////////////////////////////////////////////

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use Dompdf\Dompdf;
use Dompdf\Options;
//////////////////////////////////////////////////


function generarQR($texto = '') {
    if (empty($texto)) return null;

    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        'eccLevel'   => QRCode::ECC_M,
        'scale'      => 5, 
    ]);

    $qrcode = new QRCode($options);
    $imageData = $qrcode->render($texto);

    return 'data:image/png;base64,' . base64_encode($imageData);
}


/**================================================================================================== */
/**
 * Regresa el rol del usuario
 * @return mixed
 */
function get_user_role(){ return $rol = get_user('rol'); }
function get_default_roles() { return ['Administrador', 'Root']; }
function is_root($rol) { return in_array($rol, ['Root']); }
function is_admin($rol) { return in_array($rol, ['Administrador','Root']); }
function is_profesor($rol) { return in_array($rol, ['Profesor','Administrador','Root']); }
function is_director($rol) { return in_array($rol, ['Director','Administrador','Root']); }
function is_estudiante($rol) { return in_array($rol, ['Estudiante','Administrador','Root']); } 
function is_apoderado($rol) { return in_array($rol, ['Apoderado','Administrador','Root']); } 

function is_user($rol, $roles_aceptados){
    $default = get_default_roles();
    
    if(!is_array($roles_aceptados)){
        array_push($default, $roles_aceptados);
        return in_array($rol, $default);
    } 
    return in_array($rol, array_merge($default, $roles_aceptados));
}

function get_notificaciones($index = 0){
    $notificaciones = [
        'Acceso no autorizado.',
        'Acción no autorizada.',
        'Hubo un error al agregar el registro.',
        'Hubo un error al actualizar el registro.',
        'Hubo un error al borrar el registro.'
    ];

    return isset($notificaciones[$index]) ? $notificaciones[$index] : $notificaciones[0];
}
