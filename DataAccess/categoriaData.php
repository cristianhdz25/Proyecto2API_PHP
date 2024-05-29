<?php

require_once 'conexion.php';
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