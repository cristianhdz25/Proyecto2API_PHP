<?php

require_once 'Conexion.php';

class PromocionData
{

    public function __construct()
    {

    }


    function obtenerPromociones()
    {
        $query = "select * from promocion";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerPromocionesPorCupon($idCupon, $page)
    {
        $query = "CALL sp_get_some_promociones_by_cupon(" . $idCupon . ", " . $page . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerTotalPaginasPromocionesPorCupon($idCupon)
    {
        $query = "CALL sp_get_totalPages_promociones_by_cupon(" . $idCupon . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerTodasLasPromocionesPorCupon( $id) {
        $query = "CALL sp_obtener_todas_las_promociones_por_cupon(". $id . ")";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function registrarPromocion($promocion)
    {
        $porcentaje = $promocion->getPorcentaje();
        $nombre = $promocion->getNombre();
        $fechaInicio = $promocion->getFechaInicio();
        $fechaVencimiento = $promocion->getFechaVencimiento();
        $idCupon = $promocion->getId_Cupon();
        $activo = $promocion->getActivo();
        $query = "insert into promocion (nombre,porcentaje, fechaInicio, fechaVencimiento, id_Cupon, activo) values ('$nombre','$porcentaje','$fechaInicio','$fechaVencimiento','$idCupon','$activo')";
        $queryAutoIncrement = "select MAX(id_Promocion) as id_Promocion from promocion";
        $resultado = metodoPost($query, $queryAutoIncrement);
        return $resultado;
    }

    function obtenerPromocionesActivas()
    {
        $query = "select * from promocion where activo=1";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function actualizarEstadoPromocion($id, $activo)
    {
        // Primero, coloca todas las promociones en 0
        $queryReset = "UPDATE promocion SET activo='0'";
        $resultadoReset = metodoPut($queryReset);

        if (!$resultadoReset) {
            // Si la actualización de todas las promociones falla, devuelve un error o maneja la falla según tus necesidades
            return false;
        }

        // Luego, actualiza la promoción específica con el estado proporcionado
        $queryUpdate = "UPDATE promocion SET activo='$activo' WHERE id_Promocion='$id'";
        $resultadoUpdate = metodoPut($queryUpdate);

        return $resultadoUpdate;
    }

    public function actualizarPromocion ($promocion){
        $id = $promocion->getId();
        $porcentaje = $promocion->getPorcentaje();
        $nombre = $promocion->getNombre();
        $fechaInicio = $promocion->getFechaInicio();
        $fechaVencimiento = $promocion->getFechaVencimiento();
        $idCupon = $promocion->getId_Cupon();
        $activo = $promocion->getActivo();
        $query = "UPDATE promocion SET nombre='$nombre', porcentaje='$porcentaje', fechaInicio='$fechaInicio', fechaVencimiento='$fechaVencimiento', id_Cupon='$idCupon', activo='$activo' WHERE id_Promocion='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }


}