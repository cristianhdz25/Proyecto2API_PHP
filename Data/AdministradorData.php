<?php

require_once 'Conexion.php';
class AdministradorData {

    public function __construct() {
        
    }
    function obtenerAdministradorPorUsuarioYContrasenna($usuario, $contrasenna) {
        $query = "CALL sp_get_admin_by_usuario_contrasenna('$usuario', '$contrasenna')";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }
    

}
