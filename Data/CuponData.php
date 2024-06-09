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
        $query = "CALL sp_obtener_cupones_activos()";
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
        $query = "CALL sp_obtener_cupones_por_id_categoria (" . $id . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function registrarCupon($cupon)
    {
        $nombre = $cupon->getNombre();
        $codigo = $cupon->getCodigo();
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
        $query = "CALL sp_registrar_cupon('" . $codigo . "','" . $nombre . "','" . $imgUrl . "','" . $ubicacion . "'," . $precioBase . ",'" . $fechaCreacion . "','" . $fechaInicio . "','" . $fechaVencimiento . "','" . $descripcion . "'," . $porcentaje . "," . $id_Categoria . "," . $id_Empresa . "," . $activo . ")";
        $queryAutoIncrement = "select MAX(id_Cupon) as id from cupon";
        $resultado = metodoPost($query, $queryAutoIncrement);
        return $resultado;
    }
    

    function actualizarEstadoCupon($id, $activo)
    {
        $query = "CALL sp_actualizar_estado_cupon(" . $id . ", " . $activo . ")";
        $resultado = metodoPut($query);
        return $resultado;
    }

    function actualizarCupon($cupon)
    {
        $id = $cupon->getId_Cupon();
        $codigo = $cupon->getCodigo();
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
        $query = "CALL sp_actualizar_cupon(" . $id . ",'" . $codigo . "' ,'" . $nombre . "','" . $imgUrl . "','" . $ubicacion . "'," . $precioBase . ",'" . $fechaCreacion . "','" . $fechaInicio . "','" . $fechaVencimiento . "','" . $descripcion . "'," . $porcentaje . "," . $id_Categoria . "," . $id_Empresa . "," . $activo . ")";
        $resultado = metodoPut($query);
        return $resultado;
    }

    function obtenerCuponPorNombreCategoria($nombre)
    {
        $query = "CALL sp_obtener_cupones_por_categoria('" . $nombre . "')";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerDetallesCupon($id)
    {
        $query = "CALL sp_get_cupon_detalles(" . $id . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }





}