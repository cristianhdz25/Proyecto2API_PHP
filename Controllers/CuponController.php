<?php

require_once 'Business/CuponBusiness.php';
require_once 'Entities/Cupon.php';


class CuponController
{

    private $cuponBusiness;

    public function __construct()
    {
        $this->cuponBusiness = new CuponBusiness();
    }

    public function obtenerCupones()
    {
        return $this->cuponBusiness->obtenerCupones();
    }

    public function obtenerCuponesActivos()
    {
        return $this->cuponBusiness->obtenerCuponesActivos();
    }
    public function obtenerCuponPorEmpresa($idEmpresa, $page)
    {
        return $this->cuponBusiness->obtenerCuponPorEmpresa($idEmpresa, $page);
    }

    public function obtenerCuponPorCategoria($idCategoria)
    {
        return $this->cuponBusiness->obtenerCuponPorCategoria($idCategoria);
    }

    public function registrarCupon($codigo,$nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa)
    {
        $cupon = new Cupon(null, $codigo, $nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa, 0);
        return $this->cuponBusiness->registrarCupon($cupon);
    }

    public function obtenerCuponPorId($id)
    {
        return $this->cuponBusiness->obtenerCuponPorId($id);
    }

    public function obtenerTotalPaginasCuponesPorEmpresa($idEmpresa)
    {
        return $this->cuponBusiness->obtenerTotalPaginasCuponesPorEmpresa($idEmpresa);
    }

    public function actualizarCupon($id, $codigo, $nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa, $activo)
    {
        $cupon = new Cupon($id, $codigo, $nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa, $activo);
        return $this->cuponBusiness->actualizarCupon($cupon);
    }

    public function actualizarEstadoCupon($id, $activo)
    {

        return $this->cuponBusiness->actualizarEstadoCupon($id, $activo);
    }

    public function obtenerCuponPorNombreCategoria($nombre)
    {
        return $this->cuponBusiness->obtenerCuponPorNombreCategoria($nombre);
    }

    public function obtenerDetallesCupon($id)
    {
        return $this->cuponBusiness->obtenerDetallesCupon($id);
    }




}