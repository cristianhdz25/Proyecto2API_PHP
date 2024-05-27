<?php

require_once 'Entities/Empresa.php';
require_once 'DataAccess/empresaData.php';
class EmpresaController {

    private $empresaData;

    public function __construct()
    {
        $this->empresaData = new EmpresaData();
    }

    public function obtenerEmpresas() {
        return $this->empresaData->obtenerEmpresas();
    }

    public function registrarEmpresa($nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo) {
        $empresa = new Empresa(null, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo);
        return $this->empresaData->insertarEmpresa($empresa);
    }

    public function obtenerEmpresaPorId($id) {
        return $this->empresaData->obtenerEmpresaPorId($id);
    }

    public function actualizarEmpresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo) {
        $empresa = new Empresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo);
        return $this->empresaData->actualizarEmpresa($empresa);
    }
}