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

    function obtenerEmpresaPorCorreoYContrasenna($correo, $contrasenna)
    {
        $query = "CALL sp_get_empresa_by_usuario_contrasenna('" . $correo . "', '" . $contrasenna . "')";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerTotalPaginasEmpresas()
    {
        $query = "CALL sp_get_totalPages_empresas()";
        $resultado = metodoGet($query);
        return $resultado->fetchAll();
    }

    function obtenerEmpresasPorPagina($page)
    {
        $query = "CALL sp_get_some_empresas(" . $page . ")";
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
        $cedulaTipo = $empresa->getCedulaTipo();
        $cedula = $empresa->getCedula();
        $fechaCreacion = $empresa->getFechaCreacion();
        $primeraVez = $empresa->getPrimeraVez();
        $activo = $empresa->getActivo();
        $query = "insert into empresa(nombre, correo, contrasenna, telefono, direccionFisica, cedula, fechaCreacion, primeraVez, activo, cedulaTipo) values ('$nombre', '$correo', '$contrasenna', '$telefono', '$direccionFisica', '$cedula', '$fechaCreacion', '$primeraVez', '$activo' , '$cedulaTipo')";
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
        $cedulaTipo = $empresa->getCedulaTipo();
        $cedula = $empresa->getCedula();
        $fechaCreacion = $empresa->getFechaCreacion();
        $primeraVez = $empresa->getPrimeraVez();
        $activo = $empresa->getActivo();
        $query = "UPDATE empresa SET nombre='$nombre', correo='$correo', contrasenna='$contrasenna', telefono='$telefono', direccionFisica='$direccionFisica', cedula='$cedula', fechaCreacion='$fechaCreacion', primeraVez='$primeraVez', activo='$activo', cedulaTipo='$cedulaTipo' WHERE id='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }

    function actualizarEstadoEmpresa($id, $estado)
    {
        $query = "UPDATE empresa SET activo='$estado' WHERE id='$id'";
        $resultado = metodoPut($query);
        return $resultado;
    }

    function actualizarContrasennaEmpresa($id, $contrasenna)
    {
        $query = "UPDATE empresa SET contrasenna='$contrasenna', primeraVez='0' WHERE id='$id'";
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