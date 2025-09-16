<?php

namespace Bimp\Forge\Helpers;

class Redirect{
    private $location;

    /**
     * Método para redirigir al usuario a una sección determinada
     *
     * @param string $location
     * @return void
     */
    public static function to($location)
    {
        $self           = new self();
        $self->location = $location;

        // Verificar que si la URL o locación de redirección es externa o no
        if (strpos($self->location, 'http') === false) {
            $self->location = URL . $self->location;
        }

        // Si las cabeceras ya fueron envíadas
        if (headers_sent()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $self->location . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $self->location . '" />';
            echo '</noscript>';
            die();
        }

        // Redirigir al usuario a otra sección
        header('Location: ' . $self->location);
        die();
    }

    /**
     * Redirige de vuelta a la URL previa
     *
     * @param string $location
     * @return void
     */
    public static function back($location = '')
    {
        if (!isset($_POST['redirect_to']) && !isset($_GET['redirect_to']) && $location == '') {
            header('Location: ' . URL . DEFAULT_CONTROLLER);
            die();
        }

        if (isset($_POST['redirect_to'])) {
            header(sprintf('Location: %s', $_POST['redirect_to']));
            die();
        }

        if (isset($_GET['redirect_to'])) {
            header(sprintf('Location: %s', urldecode($_GET['redirect_to'])));
            die();
        }

        if (!empty($location)) {
            self::to($location);
        }
    }
}