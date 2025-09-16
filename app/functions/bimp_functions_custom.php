<?php

    /**
     * Usado para carga de procesos personalizados del sistema
     * funciones, variables, set up
     * @return void
     */
    function init_custom($current_controller, $current_method, $params)
    {
        /**
         * No son necesarios pero es recomendados tenerlos de forma
         * global registrados aquí, para poder acceder desde todo el sistema
         * dentro de Javascript
         * @since 2.0.0
         */
        register_to_forge_obj('current_controller', $current_controller);
        register_to_forge_obj('current_method'    , $current_method);
        register_to_forge_obj('current_params'    , $params);

        // Inicializar procesos personalizados del sistema o aplicación
        // ........
    }