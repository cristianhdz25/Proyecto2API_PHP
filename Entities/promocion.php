<?php

class Promocion
{

    private $id;
    private $nombre;
    private $porcentaje;
    private $fechaInicio;
    private $fechaVencimiento;
    private $Id_Cupon;
    private $activo;

    public function __construct($id, $nombre, $porcentaje, $fechaInicio, $fechaVencimiento, $Id_Cupon, $activo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->porcentaje = $porcentaje;
        $this->fechaInicio = $fechaInicio;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->Id_Cupon = $Id_Cupon;
        $this->activo = $activo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    public function getId_Cupon()
    {
        return $this->Id_Cupon;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function setId_Cupon($Id_Cupon)
    {
        $this->Id_Cupon = $Id_Cupon;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

}