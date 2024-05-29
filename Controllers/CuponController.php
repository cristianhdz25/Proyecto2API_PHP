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
    public function obtenerCuponPorEmpresa($idEmpresa)
    {
        return $this->cuponBusiness->obtenerCuponPorEmpresa($idEmpresa);
    }

    public function registrarCupon( $nombre, $imgUrl, $ubicacion, $precioBase, $activo, $categoria, $empresa)
    {
        $cupon = new Cupon(null, $nombre, $imgUrl, $ubicacion, $precioBase, $activo, $categoria, $empresa);
        return $this->cuponBusiness->registrarCupon($cupon);
    }

    public function obtenerCuponPorId($id)
    {
        return $this->cuponBusiness->obtenerCuponPorId($id);
    }

    public function actualizarCupon($id, $activo)
    {
       
        return $this->cuponBusiness->actualizarCupon($id, $activo);
    }




}