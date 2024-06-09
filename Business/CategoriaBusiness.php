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

    public function insertarCategoria($categoria)
    {
        return $this->categoriaData->insertarCategoria($categoria);
    }

    public function obtenerCategoriasPorPagina($page)
    {
        return $this->categoriaData->obtenerCategoriasPorPagina($page);
    }

    public function obtenerTotalPaginasCategorias()
    {
        return $this->categoriaData->obtenerTotalPaginasCategorias();
    }

    public function actualizarEstadoCategoria($id, $estado)
    {
        return $this->categoriaData->actualizarEstadoCategoria($id, $estado);
    }

    public function actualizarCategoria($categoria)
    {
        return $this->categoriaData->actualizarCategoria($categoria);
    }
}