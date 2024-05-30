<?php

require_once 'Conexion.php';
class AdministradorData{


    function obtenerAdministradorPorId ($usuario, $contrasenna) {
        $query = "select * from administrador where usuario = '$usuario' and contrasenna = '$contrasenna'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }
    

}