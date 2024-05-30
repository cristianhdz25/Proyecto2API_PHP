<?php

require_once 'Conexion.php';
class CategoriaData {

    function obtenerCategorias() {
        $query = "select * from categoria";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCategoriaPorId($id) {
        $query = "select * from categoria where id='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

}