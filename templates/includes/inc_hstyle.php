<?php
    if (isset($slug)) {
        $archivoCss = $slug . '.css';
        $rutaCompleta = CSS_PATH . $archivoCss;
        $rutaURL = CSS . $archivoCss;

        if (file_exists($rutaCompleta)) {
            echo "<link rel='stylesheet' href='" . $rutaURL . "'>\n";
        }else{
            echo "";
        }
    } else {
        echo "<!-- Slug no definido -->\n";
    }
?>
