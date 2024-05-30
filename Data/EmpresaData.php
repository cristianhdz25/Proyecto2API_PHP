<?php

require_once 'Conexion.php';
class EmpresaData
{

    public function __construct()
    {

    }

    function obtenerEmpresas()
    {
        $query = "select * from empresa";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function insertarEmpresa($empresa)
    {
        $nombre = $empresa->getNombre();
        $correo = $empresa->getCorreo();
        $contrasenna = $empresa->getContrasenna();
        $telefono = $empresa->getTelefono();
        $direccionFisica = $empresa->getDireccionFisica();
        $cedula = $empresa->getCedula();
        $fechaCreacion = $empresa->getFechaCreacion();
        $primeraVez = $empresa->getPrimeraVez();
        $activo = $empresa->getActivo();
        $query = "insert into empresa(nombre, correo, contrasenna, telefono, direccionFisica, cedula, fechaCreacion, primeraVez, activo) values ('$nombre', '$correo', '$contrasenna', '$telefono', '$direccionFisica', '$cedula', '$fechaCreacion', '$primeraVez', '$activo')";
        $queryAutoIncrement = "select MAX(id) as id from empresa";
        $resultado = metodoPost($query, $queryAutoIncrement);
        return $resultado;
    }

    function actualizarEmpresa($empresa)
    {
        $id = $empresa->getId();
        $nombre = $empresa->getNombre();
        $correo = $empresa->getCorreo();
        $contrasenna = $empresa->getContrasenna();
        $telefono = $empresa->getTelefono();
        $direccionFisica = $empresa->getDireccionFisica();
        $cedula = $empresa->getCedula();
        $fechaCreacion = $empresa->getFechaCreacion();
        $primeraVez = $empresa->getPrimeraVez();
        $activo = $empresa->getActivo();
        $query = "UPDATE empresa SET nombre='$nombre', correo='$correo', contrasenna='$contrasenna', telefono='$telefono', direccionFisica='$direccionFisica', cedula='$cedula', fechaCreacion='$fechaCreacion', primeraVez='$primeraVez', activo='$activo' WHERE id='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }

    function obtenerEmpresaPorId($id)
    {
        $query = "select * from empresa where id='$id'";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function eliminarEmpresa()
    {
        $id = $_GET['id'];
        $query = "DELETE FROM empresa WHERE id='$id'";
        $resultado = metodoDelete($query);
        return $resultado;
    }


}