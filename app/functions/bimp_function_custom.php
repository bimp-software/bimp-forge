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
