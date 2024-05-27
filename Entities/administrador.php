<?php 

class Administrador {

    private $id;
    private $usuario;
    private $contrasenna;

    // Constructor
    public function __construct($id = null, $usuario = '', $contrasenna = '') {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->contrasenna = $contrasenna;
    }

    // Getters and Setters

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getContrasenna() {
        return $this->contrasenna;
    }

    public function setContrasenna($contrasenna) {
        $this->contrasenna = $contrasenna;
    }
}

