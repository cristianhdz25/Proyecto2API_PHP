<?php

require_once 'Entities/Administrador.php';
require_once 'Data/AdministradorData.php';

class AdministradorBusiness
{

    private $administradorData;

    public function __construct()
    {
        $this->administradorData = new AdministradorData();
    }

    public function obtenerAdministradorPorUsuarioYContrasenna($usuario, $contrasenna)
    {
        return $this->administradorData->obtenerAdministradorPorUsuarioYContrasenna($usuario, $contrasenna);
    }
}