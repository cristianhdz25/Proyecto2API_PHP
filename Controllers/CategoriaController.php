<?php

require_once 'Entities/Categoria.php';
require_once 'Business/CategoriaBusiness.php';
class CategoriaController{
    private $categoriaBusiness;
    
    public function __construct(){
        $this->categoriaBusiness = new CategoriaBusiness();
    }
    
    public function obtenerCategorias(){
        return $this->categoriaBusiness->obtenerCategorias();
    }
    
    public function obtenerCategoriaPorId($id){
        return $this->categoriaBusiness->obtenerCategoriaPorId($id);
    }

    public function obtenerCategoriasPorPagina($page){
        return $this->categoriaBusiness->obtenerCategoriasPorPagina($page);
    }

    public function obtenerTotalPaginasCategorias(){
        return $this->categoriaBusiness->obtenerTotalPaginasCategorias();
    }


    public function insertarCategoria($nombre){
        $categoria = new Categoria(null, $nombre, 1);
        return $this->categoriaBusiness->insertarCategoria($categoria);
    }

    public function actualizarEstadoCategoria($id, $estado){
        return $this->categoriaBusiness->actualizarEstadoCategoria($id, $estado);
    }
}