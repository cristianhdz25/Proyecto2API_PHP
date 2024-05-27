<?php

class Promocion{

    private $id;
    private $porcentaje;
    private $fechaInicio;
    private $fechaVencimiento;

    // Constructor
    public function __construct($id = null, $porcentaje = 0, $fechaInicio = '', $fechaVencimiento = '') {
        $this->id = $id;
        $this->porcentaje = $porcentaje;
        $this->fechaInicio = $fechaInicio;
        $this->fechaVencimiento = $fechaVencimiento;
    }

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getPorcentaje() {
        return $this->porcentaje;
    }

    public function setPorcentaje($porcentaje) {
        $this->porcentaje = $porcentaje;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function getFechaVencimiento() {
        return $this->fechaVencimiento;
    }

    public function setFechaVencimiento($fechaVencimiento) {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    
}