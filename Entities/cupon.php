<?php
class Cupon
{
    private $id_Cupon;
    private $codigo;
    private $nombre;
    private $imgUrl;
    private $ubicacion;
    private $precioBase;
    private $fechaCreacion;
    private $fechaInicio;
    private $fechaVencimiento;
    private $descripcion;
    private $porcentaje;
    private $activo;
    private $id_Categoria;
    private $id_Empresa;

    // Constructor
    public function __construct($id_Cupon, $codigo, $nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa, $activo)
    {
        $this->id_Cupon = $id_Cupon;
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->imgUrl = $imgUrl;
        $this->ubicacion = $ubicacion;
        $this->precioBase = $precioBase;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaInicio = $fechaInicio;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->descripcion = $descripcion;
        $this->porcentaje = $porcentaje;
        $this->activo = $activo;
        $this->id_Categoria = $id_Categoria;
        $this->id_Empresa = $id_Empresa;
    }

    // Getters
    public function getId_Cupon()
    {
        return $this->id_Cupon;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImgUrl()
    {
        return $this->imgUrl;
    }

    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    public function getPrecioBase()
    {
        return $this->precioBase;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function getCategoria()
    {
        return $this->id_Categoria;
    }

    public function getEmpresa()
    {
        return $this->id_Empresa;
    }

    // Setters

    public function setId_Cupon($id_Cupon)
    {
        $this->id_Cupon = $id_Cupon;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;
    }

    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;
    }

    public function setPrecioBase($precioBase)
    {
        $this->precioBase = $precioBase;
    }

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function setCategoria($id_Categoria)
    {
        $this->id_Categoria = $id_Categoria;
    }

    public function setEmpresa($id_Empresa)
    {
        $this->id_Empresa = $id_Empresa;
    }




}



