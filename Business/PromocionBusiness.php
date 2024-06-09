<?php

require_once 'Data/PromocionData.php';


class PromocionBusiness {

    private $promocionData;

    public function __construct() {
        $this->promocionData = new PromocionData();
    }

    public function obtenerPromociones() {
        return $this->promocionData->obtenerPromociones();
    }

    public function obtenerPromocionesActivas() {
        return $this->promocionData->obtenerPromocionesActivas();
    }

    public function obtenerPromocionesPorCupon($idCupon, $page) {
        return $this->promocionData->obtenerPromocionesPorCupon($idCupon, $page);
    }

    
    public function obtenerTodasLasPromocionesPorCupon($id) {
        return $this->promocionData->obtenerTodasLasPromocionesPorCupon($id);
    }
    

    public function obtenerTotalPaginasPromocionesPorCupon($idCupon){
        return $this->promocionData->obtenerTotalPaginasPromocionesPorCupon($idCupon);
    }

    public function registrarPromocion($promocion) {
        return $this->promocionData->registrarPromocion($promocion);
    }

    public function actualizarEstadoPromocion($id, $activo) {
        return $this->promocionData->actualizarEstadoPromocion($id, $activo);
    }

    public function actualizarPromocion($promocion) {
        return $this->promocionData->actualizarPromocion($promocion);
    }


}