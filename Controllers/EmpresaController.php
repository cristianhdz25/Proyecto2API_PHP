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

    public function registrarEmpresa($nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $cedulaTipo) {
        $empresa = new Empresa(null, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, 1,1, $cedulaTipo);
        return $this->empresaBusiness->insertarEmpresa($empresa);
    }

    public function obtenerEmpresaPorId($id) {
        return $this->empresaBusiness->obtenerEmpresaPorId($id);
    }

    public function obtenerTotalPaginasEmpresas() {
        return $this->empresaBusiness->obtenerTotalPaginasEmpresas();
    }

    public function obtenerEmpresasPorPagina($page) {
        return $this->empresaBusiness->obtenerEmpresasPorPagina($page);
    }

    public function actualizarEmpresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo , $cedulaFisica) {
        $empresa = new Empresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo , $cedulaFisica);
        return $this->empresaBusiness->actualizarEmpresa($empresa);
    }

    public function actualizarEstadoEmpresa($id, $estado) {
        return $this->empresaBusiness->actualizarEstadoEmpresa($id, $estado);
    }
}