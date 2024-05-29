<?php
class Cupon {
    private $id;
    private $nombre;
    private $imgUrl;
    private $ubicacion;
    private $precioBase;
    private $activo;
    private $categoria;
    private $empresa;

    // Constructor

    public function __construct($id, $nombre, $imgUrl , $ubicacion , $precioBase, $activo , $categoria , $empresa  ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->imgUrl = $imgUrl;
        $this->ubicacion = $ubicacion;
        $this->precioBase = $precioBase;
        $this->activo = $activo;
        $this->categoria = $categoria;
        $this->empresa = $empresa;
    }

    



    

    // Getters and Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getImgUrl() {
        return $this->imgUrl;
    }

    public function setImgUrl($imgUrl) {
        $this->imgUrl = $imgUrl;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }

    public function setUbicacion($ubicacion) {
        $this->ubicacion = $ubicacion;
    }

    public function getPrecioBase() {
        return $this->precioBase;
    }

    public function setPrecioBase($precioBase) {
        $this->precioBase = $precioBase;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

}



