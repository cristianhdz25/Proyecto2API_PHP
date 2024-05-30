<?php

require_once 'Entities/Empresa.php';
require_once 'Business/EmpresaBusiness.php';
class EmpresaController {

    private $empresaBusiness;

    public function __construct()
    {
        $this->empresaBusiness = new EmpresaBusiness();
    }

    public function obtenerEmpresas() {
        return $this->empresaBusiness->obtenerEmpresas();
    }

    public function registrarEmpresa($nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo) {
        $empresa = new Empresa(null, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo);
        return $this->empresaBusiness->insertarEmpresa($empresa);
    }

    public function obtenerEmpresaPorId($id) {
        return $this->empresaBusiness->obtenerEmpresaPorId($id);
    }

    public function actualizarEmpresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo) {
        $empresa = new Empresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo);
        return $this->empresaBusiness->actualizarEmpresa($empresa);
    }
}