<?php

require_once 'Business/PromocionBusiness.php';
require_once 'Entities/Promocion.php';


class PromocionController
{

    private $promocionBusiness;

    public function __construct()
    {
        $this->promocionBusiness = new PromocionBusiness();
    }

    public function obtenerPromociones()
    {
        return $this->promocionBusiness->obtenerPromociones();
    }

    public function obtenerPromocionesActivas()
    {
        return $this->promocionBusiness->obtenerPromocionesActivas();
    }

    public function obtenerPromocionesPorCupon($idCupon, $page)
    {
        return $this->promocionBusiness->obtenerPromocionesPorCupon($idCupon, $page);
    }

    public function obtenerTotalPaginasPromocionesPorCupon($idCupon)
    {
        return $this->promocionBusiness->obtenerTotalPaginasPromocionesPorCupon($idCupon);
    }

    public function registrarPromocion($nombre, $porcentaje, $fechaInicio, $fechaVencimiento, $idCupon)
    {
        $promocion = new Promocion(null, $nombre, $porcentaje, $fechaInicio, $fechaVencimiento, $idCupon, 0);
        return $this->promocionBusiness->registrarPromocion($promocion);
    }

    public function actualizarPromocion($id, $activo)
    {
        return $this->promocionBusiness->actualizarPromocion($id, $activo);
    }

}