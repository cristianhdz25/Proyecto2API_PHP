<?php 

require_once 'DataAccess/cuponData.php';

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

    public function obtenerCuponPorEmpresa($idEmpresa)
    {
        return $this->cuponData->obtenerCuponPorEmpresa($idEmpresa);
    }

    public function registrarCupon($cupon)
    {
        return $this->cuponData->registrarCupon($cupon);
    }

    public function obtenerCuponPorId($id)
    {
        return $this->cuponData->obtenerCuponPorId($id);
    }

    public function actualizarCupon($cupon)
    {
        return $this->cuponData->actualizarCupon($cupon);
    }

    public function eliminarCupon($id)
    {
        return $this->cuponData->eliminarCupon($id);
    }
}