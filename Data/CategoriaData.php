<?php

require_once 'Conexion.php';
class CategoriaData
{

    function obtenerCategorias()
    {
        $query = "CALL sp_obtener_categorias_activas()";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }
    function obtenerCategoriaPorId($id)
    {
        $query = "select * from categoria where id='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCategoriasPorPagina($page)
    {
        $query = "CALL sp_get_some_categorias(" . $page . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerTotalPaginasCategorias()
    {
        $query = "CALL sp_get_totalPages_categorias()";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function insertarCategoria($categoria)
    {
        $nombre = $categoria->getNombre();
        $estado = $categoria->getEstado();
        echo json_encode($categoria);
        $query = "insert into categoria (nombre, estado) values ('$nombre', '$estado')";
        $queryAutoIncrement = "select MAX(id_Categoria) as id_Categoria from categoria";
        $resultado = metodoPost($query, $queryAutoIncrement);
        return $resultado;
    }

    function actualizarEstadoCategoria($id, $estado)
    {
        $query = "update categoria set estado='$estado' where id_Categoria='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }

    function actualizarCategoria($categoria)
    {
        $id = $categoria->getId();
        $nombre = $categoria->getNombre();
        $estado = $categoria->getEstado();
        $query = "update categoria set nombre='$nombre', estado='$estado' where id_Categoria='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }

}