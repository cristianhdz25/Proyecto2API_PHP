<?php

require_once 'Entities/Administrador.php';
require_once 'DataAccess/administradorData.php';

class AdministradorController
{

    private $administradorData;

    public function __construct()
    {
        $this->administradorData = new AdministradorData();
    }

    public function obtenerAdministradorPorId($usuario, $contrasenna)
    {
        return $this->administradorData->obtenerAdministradorPorId($usuario, $contrasenna);
    }
}
