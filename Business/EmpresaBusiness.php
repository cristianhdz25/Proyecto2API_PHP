<?php

require 'Data/EmpresaData.php';

class EmpresaBusiness   {

    private $empresaData;

    public function __construct() {
        $this->empresaData = new EmpresaData();
    }

    public function obtenerEmpresas() {
        return $this->empresaData->obtenerEmpresas();
    }

    public function obtenerEmpresaPorId($id) {
        return $this->empresaData->obtenerEmpresaPorId($id);
    }

    public function insertarEmpresa($empresa) {
        return $this->empresaData->insertarEmpresa($empresa);
    }

    public function actualizarEmpresa($empresa) {
        return $this->empresaData->actualizarEmpresa($empresa);
    }

    public function actualizarEstadoEmpresa($id, $estado) {
        return $this->empresaData->actualizarEstadoEmpresa($id, $estado);
    }

    public function obtenerTotalPaginasEmpresas() {
        return $this->empresaData->obtenerTotalPaginasEmpresas();
    }

    public function obtenerEmpresasPorPagina($page) {
        return $this->empresaData->obtenerEmpresasPorPagina($page);
    }


    public function obtenerEmpresaPorCorreoYContrasenna($correo, $contrasenna) {
        return $this->empresaData->obtenerEmpresaPorCorreoYContrasenna($correo, $contrasenna);
    }


}