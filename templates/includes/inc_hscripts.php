<?php
    if (isset($slug)) {
        $archivoJs = $slug . '.js';
        $rutaCompleta = JS_PATH . $archivoJs;
        $rutaURL = JS . $archivoJs;

        if (file_exists($rutaCompleta)) {
            echo "<script src='" . $rutaURL . "'></script>\n";
        } else {
            echo " ";
        }
    } else {
        echo " ";
    }
?>
