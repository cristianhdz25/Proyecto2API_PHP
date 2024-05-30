<?php 

require_once 'Data/CategoriaData.php';

class CategoriaBusiness
{
    private $categoriaData;

    public function __construct()
    {
        $this->categoriaData = new CategoriaData();
    }

    public function obtenerCategorias()
    {
        return $this->categoriaData->obtenerCategorias();
    }

    public function obtenerCategoriaPorId($id)
    {
        return $this->categoriaData->obtenerCategoriaPorId($id);
    }
}