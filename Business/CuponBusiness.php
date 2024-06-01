<?php 

require_once 'Data/CuponData.php';

class CuponBusiness
{
    private $cuponData;

    public function __construct()
    {
        $this->cuponData = new CuponData();
    }

    public function obtenerCupones()
    {
        return $this->cuponData->obtenerCupones();
    }

    public function obtenerCuponesActivos()
    {
        return $this->cuponData->obtenerCuponesActivos();
    }

    public function obtenerCuponPorEmpresa($idEmpresa, $page)
    {
        return $this->cuponData->obtenerCuponPorEmpresa($idEmpresa, $page);
    }

    public function obtenerCuponPorCategoria($idCategoria)
    {
        return $this->cuponData->obtenerCuponPorCategoria($idCategoria);
    }

    public function registrarCupon($cupon)
    {
        return $this->cuponData->registrarCupon($cupon);
    }

    public function obtenerCuponPorId($id)
    {
        return $this->cuponData->obtenerCuponPorId($id);
    }

    public function obtenerTotalPaginasCuponesPorEmpresa($idEmpresa)
    {
        return $this->cuponData->obtenerTotalPaginasCuponesPorEmpresa($idEmpresa);
    }

    public function actualizarCupon($id, $activo)
    {
        return $this->cuponData->actualizarCupon($id, $activo);
    }

    public function obtenerCuponPorNombreCategoria($nombre)
    {
        return $this->cuponData->obtenerCuponPorNombreCategoria($nombre);
    }


}