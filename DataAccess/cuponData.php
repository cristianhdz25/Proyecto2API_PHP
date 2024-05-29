<?php

require_once 'conexion.php';

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
        $query = "select * from cupon where id='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCuponesActivos()
    {
        $query = "select * from cupon where activo=1";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerCuponPorEmpresa($id)
    {
        $query = "select * from cupon where empresa='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function registrarCupon($cupon)
    {
        $nombre = $cupon->getNombre();
        $imgUrl = $cupon->getImgUrl();
        $ubicacion = $cupon->getUbicacion();
        $precioBase = $cupon->getPrecioBase();
        $activo = $cupon->getActivo();
        $id_Categoria = $cupon->getCategoria();
        $id_Empresa	= $cupon->getEmpresa();
        $query = "insert into cupon(nombre, imgUrl, ubicacion, precioBase, activo, id_Categoria, id_Empresa) values ('$nombre', '$imgUrl', '$ubicacion', '$precioBase', '$activo', '$id_Categoria', '$id_Empresa')";
        $queryAutoIncrement = "select MAX(id) as id from cupon";
        $resultado = metodoPost($query, $queryAutoIncrement);
        return $resultado;
    }




}