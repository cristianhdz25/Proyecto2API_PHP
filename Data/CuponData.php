<?php

require_once 'Conexion.php';

class CuponData
{

    function obtenerCupones()
    {
        $query = "select * from cupon";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCuponPorId($id)
    {
        $query = "select * from cupon where id_Cupon='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerTotalPaginasCuponesPorEmpresa($idEmpresa)
    {
        $query = "CALL sp_get_totalPages_cupones_by_empresa(" . $idEmpresa . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCuponesActivos()
    {
        $query = "select * from cupon where activo=1";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCuponPorEmpresa($idEmpresa, $page)
    {
        $query = "CALL sp_get_some_cupones_by_empresa(" . $idEmpresa . ", " . $page . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }


    function obtenerCuponPorCategoria($id)
    {
        $query = "select * from cupon where id_Categoria='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function registrarCupon($cupon)
    {
        $nombre = $cupon->getNombre();
        $imgUrl = $cupon->getImgUrl();
        $ubicacion = $cupon->getUbicacion();
        $precioBase = $cupon->getPrecioBase();
        $fechaCreacion = $cupon->getFechaCreacion();
        $fechaInicio = $cupon->getFechaInicio();
        $fechaVencimiento = $cupon->getFechaVencimiento();
        $descripcion = $cupon->getDescripcion();
        $porcentaje = $cupon->getPorcentaje();
        $id_Categoria = $cupon->getCategoria();
        $id_Empresa = $cupon->getEmpresa();
        $activo = $cupon->getActivo();
        $query = "insert into cupon (nombre, imgUrl, ubicacion, precioBase, fechaCreacion, fechaInicio, fechaVencimiento, descripcion, porcentaje, id_Categoria, id_Empresa, activo) values ('$nombre','$imgUrl','$ubicacion','$precioBase','$fechaCreacion','$fechaInicio','$fechaVencimiento','$descripcion','$porcentaje','$id_Categoria','$id_Empresa','$activo')";
        $queryAutoIncrement = "select MAX(id_Cupon) as id from cupon";
        $resultado = metodoPost($query, $queryAutoIncrement);
        return $resultado;
    }

    function actualizarCupon($id, $activo)
    {
        $query = "update cupon set activo='$activo' where id='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }

        function obtenerCuponPorNombreCategoria($nombre)
    {
        $query = "select * from cupon C join categoria ca on c.id_Categoria = ca.id_Categoria where ca.nombre = '$nombre';";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }





}