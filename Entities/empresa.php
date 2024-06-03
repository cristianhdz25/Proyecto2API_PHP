<?php

class Empresa
{

    private $id;
    private $nombre;
    private $correo;
    private $contrasenna;
    private $telefono;
    private $direccionFisica;
    private $cedulaTipo;
    private $cedula;
    private $fechaCreacion;
    private $primeraVez;
    private $activo;

    // Constructor
    public function __construct($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo, $cedulaTipo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contrasenna = $contrasenna;
        $this->telefono = $telefono;
        $this->direccionFisica = $direccionFisica;
        $this->cedula = $cedula;
        $this->fechaCreacion = $fechaCreacion;
        $this->primeraVez = $primeraVez;
        $this->activo = $activo;
        $this->cedulaTipo = $cedulaTipo;
    }

    // Getters and Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    public function getContrasenna()
    {
        return $this->contrasenna;
    }

    public function setContrasenna($contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getCedulaTipo()
    {
        return $this->cedulaTipo;
    }

    public function setCedulaTipo($cedulaTipo)
    {
        $this->$cedulaTipo = $cedulaTipo;
    }


    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getDireccionFisica()
    {
        return $this->direccionFisica;
    }

    public function setDireccionFisica($direccionFisica)
    {
        $this->direccionFisica = $direccionFisica;
    }

    public function getCedula()
    {
        return $this->cedula;
    }

    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getPrimeraVez()
    {
        return $this->primeraVez;
    }

    public function setPrimeraVez($primeraVez)
    {
        $this->primeraVez = $primeraVez;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

}