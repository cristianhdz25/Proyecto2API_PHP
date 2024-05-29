<?php

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
}