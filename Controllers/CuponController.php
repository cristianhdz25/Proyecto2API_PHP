<?php

require_once 'Business/CuponBusiness.php';
require_once 'Entities/Cupon.php';


class CuponController {

    private $cuponBusiness;

    public function __construct()
    {
        $this->cuponBusiness = new CuponBusiness();
    }

    public function obtenerCupones() {
        return $this->cuponBusiness->obtenerCupones();
    }

    public function obtenerCuponesActivos() {
        return $this->cuponBusiness->obtenerCuponesActivos();
    }
    public function obtenerCuponPorEmpresa($idEmpresa) {
        return $this->cuponBusiness->obtenerCuponPorEmpresa($idEmpresa);
    }

    public function registrarCupon($id, $nombre, $imgUrl , $ubicacion , $precioBase, $activo , $categoria , $empresa , $promocion) {
        $cupon = new Cupon($id, $nombre, $imgUrl , $ubicacion , $precioBase, $activo , $categoria , $empresa , $promocion );
        return $this->cuponBusiness->registrarCupon($cupon);
    }

    public function obtenerCuponPorId($id) {
        return $this->cuponBusiness->obtenerCuponPorId($id);
    }

    public function actualizarCupon($id, $nombre, $imgUrl , $ubicacion , $precioBase, $activo , $categoria , $empresa , $promocion) {
        $cupon = new Cupon($id, $nombre, $imgUrl , $ubicacion , $precioBase, $activo , $categoria , $empresa , $promocion );
        return $this->cuponBusiness->actualizarCupon($cupon);
    }

    public function eliminarCupon($id) {
        return $this->cuponBusiness->eliminarCupon($id);
    }


}