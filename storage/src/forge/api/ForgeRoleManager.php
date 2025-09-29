<?php

class ForgeRoleManager {
    
    /**
     * identificador unico del rol 
     * @var integer $id
     */
    private $id;

    /**
     * Nombre del rol
     * @var string $nombre
     */
    private $nombre;

    /**
     * Privilegios que tiene el rol
     * @var integer $privilegios
     */
    private $privilegios;

    /**
     * Estado del rol
     * @var boolean $estado
     */
    private $estado;

    
    function __construct(){

    }

    /**
     * Agregar una forma mas facil para acceder a los roles de forma predeterminada que tiene un sistema cualquiera
     * usar esta clase para mejerar la distribucion de los roles.
     */

}