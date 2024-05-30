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

    public function obtenerEmpresaPorCorreo($correo) {
        return $this->empresaData->obtenerEmpresaPorCorreo($correo);
    }

    public function obtenerEmpresaPorCedula($cedula) {
        return $this->empresaData->obtenerEmpresaPorCedula($cedula);
    }

    public function obtenerEmpresaPorCorreoYContrasenna($correo, $contrasenna) {
        return $this->empresaData->obtenerEmpresaPorCorreoYContrasenna($correo, $contrasenna);
    }


}