<?php

require_once 'Entities/Administrador.php';
require_once 'Business/AdministradorBusiness.php';

class AdministradorController
{

    private $administradorBusiness;

    public function __construct()
    {
        $this->administradorBusiness = new AdministradorBusiness();
    }

    public function obtenerAdministradorPorUsuarioYContrasenna($usuario, $contrasenna)
    {
        return $this->administradorBusiness->obtenerAdministradorPorUsuarioYContrasenna($usuario, $contrasenna);
    }
}
