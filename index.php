<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST,PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

//date_default_timezone_set('America/Costa_Rica');

$endpoint = $_GET['endpoint'] ?? '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($endpoint == 'empresas' && isset($_GET['id'])) {
        require_once 'Controllers/EmpresaController.php';
        $id = $_GET['id'];
        $empresaController = new EmpresaController();
        $empresa = $empresaController->obtenerEmpresaPorId($id);
        echo json_encode($empresa);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'empresas' && isset($_GET['page'])) {
        require_once 'Controllers/EmpresaController.php';
        $page = $_GET['page'];
        $empresaController = new EmpresaController();
        $empresas = $empresaController->obtenerEmpresasPorPagina($page);
        echo json_encode($empresas);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'empresas' && isset($_GET['total'])) {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        $empresas = $empresaController->obtenerTotalPaginasEmpresas();
        echo json_encode($empresas);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'empresas' && isset($_GET['correo']) && isset($_GET['$contrasenna'])) {
        require_once 'Controllers/EmpresaController.php';
        $correo = $_GET['correo'];
        $contrasenna = $_GET['contrasenna'];
        $empresaController = new EmpresaController();
        $empresa = $empresaController->obtenerEmpresaPorCorreoYContrasenna($correo, $contrasenna);
        echo json_encode($empresa);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'empresas') {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        $empresas = $empresaController->obtenerEmpresas();
        echo json_encode($empresas);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'cupones' && isset($_GET['id'])) {
        require_once 'Controllers/CuponController.php';
        $id = $_GET['id'];
        $cuponController = new CuponController();
        $cupon = $cuponController->obtenerCuponPorId($id);
        echo json_encode($cupon);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'cupones' && isset($_GET['idEmpresa']) && isset($_GET['page'])) {
        require_once 'Controllers/CuponController.php';
        $idEmpresa = $_GET['idEmpresa'];
        $page = $_GET['page'];
        $cuponController = new CuponController();
        $cuponData = $cuponController->obtenerCuponPorEmpresa($idEmpresa, $page);
        echo json_encode($cuponData);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'cupones' && isset($_GET['idEmpresa'])) {
        require_once 'Controllers/CuponController.php';
        $idEmpresa = $_GET['idEmpresa'];
        $cuponController = new CuponController();
        $cupon = $cuponController->obtenerTotalPaginasCuponesPorEmpresa($idEmpresa);
        echo json_encode($cupon);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'cupones' && isset($_GET['activos'])) {
        require_once 'Controllers/CuponController.php';
        $cuponController = new CuponController();
        $cupones = $cuponController->obtenerCuponesActivos();
        echo json_encode($cupones);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'cupones' && isset($_GET['idCategoria'])) {
        require_once 'Controllers/CuponController.php';
        $idCategoria = $_GET['idCategoria'];
        $cuponController = new CuponController();
        $cupon = $cuponController->obtenerCuponPorCategoria($idCategoria);
        echo json_encode($cupon);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'cupones' && isset($_GET['nombre'])) {
        require_once 'Controllers/CuponController.php';
        $nombre = $_GET['nombre'];
        $cuponController = new CuponController();
        $cupon = $cuponController->obtenerCuponPorNombreCategoria($nombre);
        echo json_encode($cupon);
        header("HTTP/1.1 200 OK");
        exit();
    } else
        if ($endpoint == 'cupones' && isset($_GET['idComprados'])) {
            require_once 'Controllers/CuponController.php';
            $cuponController = new CuponController();
            // Decodificar la cadena JSON recibida del parámetro idComprados
            $idComprados = json_decode($_GET['idComprados'], true);
            // Luego puedes usar $idComprados como un array PHP normal
            $cupones = $cuponController->obtenerCuponesComprados($idComprados);
            echo json_encode($cupones);
            header("HTTP/1.1 200 OK");
            exit();
        }

    //  else if ($endpoint == 'cupones' ) {
    //     require_once 'Controllers/CuponController.php';
    //     $cuponController = new CuponController();
    //     $cupones = $cuponController->obtenerCupones();
    //     echo json_encode($cupones);
    //     header("HTTP/1.1 200 OK");
    //     exit();
    // }


    if ($endpoint == 'categorias' && isset($_GET['id'])) {
        require_once 'Controllers/CategoriaController.php';
        $id = $_GET['id'];
        $categoriaController = new CategoriaController();
        $categoria = $categoriaController->obtenerCategoriaPorId($id);
        echo json_encode($categoria);
        header("HTTP/1.1 200 OK");
        exit();
    } else if
    ($endpoint == 'categorias' && isset($_GET['page'])) {
        require_once 'Controllers/CategoriaController.php';
        $page = $_GET['page'];
        $categoriaController = new CategoriaController();
        $categorias = $categoriaController->obtenerCategoriasPorPagina($page);
        echo json_encode($categorias);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'categorias' && isset($_GET['total'])) {
        require_once 'Controllers/CategoriaController.php';
        $categoriaController = new CategoriaController();
        $categorias = $categoriaController->obtenerTotalPaginasCategorias();
        echo json_encode($categorias);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'categorias') {
        require_once 'Controllers/CategoriaController.php';
        $categoriaController = new CategoriaController();
        $categorias = $categoriaController->obtenerCategorias();
        echo json_encode($categorias);
        header("HTTP/1.1 200 OK");
        exit();
    }


    if ($endpoint == 'promociones' && isset($_GET['idCupon']) && isset($_GET['page'])) {
        require_once 'Controllers/PromocionController.php';
        $idCupon = $_GET['idCupon'];
        $page = $_GET['page'];
        $promocionController = new PromocionController();
        $promocion = $promocionController->obtenerPromocionesPorCupon($idCupon, $page);
        echo json_encode($promocion);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'promociones' && isset($_GET['fechaInicio']) && isset($_GET['fechaVencimiento']) && isset($_GET['idCupon'])) {
        require_once 'Controllers/PromocionController.php';
        $id = $_GET['idCupon'];
        $fechaInicio = $_GET['fechaInicio'];
        $fechaVencimiento = $_GET['fechaVencimiento'];
        $promocionController = new PromocionController();
        $promociones = $promocionController->obtenerTodasLasPromocionesPorCupon($id);
        echo json_encode($promociones);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'promociones' && isset($_GET['idCupon'])) {
        require_once 'Controllers/PromocionController.php';
        $idCupon = $_GET['idCupon'];
        $promocionController = new PromocionController();
        $promocion = $promocionController->obtenerTotalPaginasPromocionesPorCupon($idCupon);
        echo json_encode($promocion);
        header("HTTP/1.1 200 OK");
        exit();
    }


    // if ($endpoint == 'promociones') {
    //     require_once 'Controllers/PromocionController.php';
    //     $promocionController = new PromocionController();
    //     $promociones = $promocionController->obtenerPromociones();
    //     echo json_encode($promociones);
    //     header("HTTP/1.1 200 OK");
    //     exit();
    // }


    if ($endpoint == 'admin' && isset($_GET['usuario']) && isset($_GET['contrasenna'])) {
        require_once 'Controllers/AdministradorController.php';
        $usuario = $_GET['usuario'];
        $contrasenna = $_GET['contrasenna'];
        $adminController = new AdministradorController();
        $resultado = $adminController->obtenerAdministradorPorUsuarioYContrasenna($usuario, $contrasenna);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
}

if ($_POST['METHOD'] == 'POST') {
    if ($endpoint == 'empresas') {
        require_once 'Controllers/EmpresaController.php';
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasenna = $_POST['contrasenna'];
        $telefono = $_POST['telefono'];
        $direccionFisica = $_POST['direccionFisica'];
        $cedula = $_POST['cedula'];
        $cedulaTipo = $_POST['cedulaTipo'];
        $fechaCreacion = ($_POST['fechaCreacion']);
        $empresaController = new EmpresaController();
        $resultado = $empresaController->registrarEmpresa($nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $cedulaTipo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'cupones') {
        require_once 'Controllers/CuponController.php';
        $nombre = $_POST['nombre'];
        $codigo = $_POST['codigo'];
        $imgUrl = $_POST['imgUrl'];
        $ubicacion = $_POST['ubicacion'];
        $precioBase = $_POST['precioBase'];
        $fechaCreacion = $_POST['fechaCreacion'];
        $fechaInicio = $_POST['fechaInicio'];
        $fechaVencimiento = $_POST['fechaVencimiento'];
        $descripcion = $_POST['descripcion'];
        $porcentaje = $_POST['porcentaje'];
        $id_Categoria = $_POST['id_Categoria'];
        $id_Empresa = $_POST['id_Empresa'];
        $cuponController = new CuponController();
        $resultado = $cuponController->registrarCupon($codigo, $nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'promociones') {
        require_once 'Controllers/PromocionController.php';
        $nombre = $_POST['nombre'];
        $porcentaje = $_POST['porcentaje'];
        $fechaInicio = ($_POST['fechaInicio']);
        $fechaVencimiento = ($_POST['fechaVencimiento']);
        $idCupon = $_POST['idCupon'];
        $promocionController = new PromocionController();
        $resultado = $promocionController->registrarPromocion($nombre, $porcentaje, $fechaInicio, $fechaVencimiento, $idCupon);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'categorias') {
        require_once 'Controllers/CategoriaController.php';
        $nombre = $_POST['nombre'];
        $categoriaController = new CategoriaController();
        $resultado = $categoriaController->insertarCategoria($nombre);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
}

if ($_POST['METHOD'] == 'PUT') {

    if ($endpoint == 'empresas' && isset($_POST['estado'])) {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        $id = $_GET['id'];
        $estado = $_POST['estado'];
        $resultado = $empresaController->actualizarEstadoEmpresa($id, $estado);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'empresas' && isset($_POST['contrasenna']) && isset($_GET['primeraVez'])) {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        $id = $_GET['id'];
        $contrasenna = $_POST['contrasenna'];
        $resultado = $empresaController->actualizarContrasennaEmpresa($id, $contrasenna);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'empresas') {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasenna = $_POST['contrasenna'];
        $telefono = $_POST['telefono'];
        $direccionFisica = $_POST['direccionFisica'];
        $cedula = $_POST['cedula'];
        $cedulaTipo = $_POST['cedulaTipo'];
        $fechaCreacion = $_POST['fechaCreacion'];
        $primeraVez = $_POST['primeraVez'];
        $activo = $_POST['activo'];
        $resultado = $empresaController->actualizarEmpresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo, $cedulaTipo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'cupones' && isset($_POST['codigo'])) {
        require_once 'Controllers/CuponController.php';
        $cuponController = new CuponController();
        $id = $_GET['id'];
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $imgUrl = $_POST['imgUrl'];
        $ubicacion = $_POST['ubicacion'];
        $precioBase = $_POST['precioBase'];
        $fechaCreacion = ($_POST['fechaCreacion']);
        $fechaInicio = ($_POST['fechaInicio']);
        $fechaVencimiento = ($_POST['fechaVencimiento']);
        $descripcion = $_POST['descripcion'];
        $porcentaje = $_POST['porcentaje'];
        $id_Categoria = $_POST['id_Categoria'];
        $id_Empresa = $_POST['id_Empresa'];
        $activo = $_POST['activo'];
        $resultado = $cuponController->actualizarCupon($id, $codigo, $nombre, $imgUrl, $ubicacion, $precioBase, $fechaCreacion, $fechaInicio, $fechaVencimiento, $descripcion, $porcentaje, $id_Categoria, $id_Empresa, $activo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    } else
        if ($endpoint == 'cupones' && isset($_POST['activo'])) {
            require_once 'Controllers/CuponController.php';
            $cuponController = new CuponController();
            $id = $_GET['id'];
            $activo = $_POST['activo'];
            $resultado = $cuponController->actualizarEstadoCupon($id, $activo);
            echo json_encode($resultado);
            header("HTTP/1.1 200 OK");
            exit();
        }


    if ($endpoint == 'promociones' && isset($_POST['nombre'])) {
        require_once 'Controllers/PromocionController.php';
        $promocionController = new PromocionController();
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $porcentaje = $_POST['porcentaje'];
        $fechaInicio = ($_POST['fechaInicio']);
        $fechaVencimiento = ($_POST['fechaVencimiento']);
        $idCupon = $_POST['idCupon'];
        $activo = $_POST['activo'];
        $resultado = $promocionController->actualizarPromocion($id, $nombre, $porcentaje, $fechaInicio, $fechaVencimiento, $idCupon, $activo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    } else if ($endpoint == 'promociones' && isset($_POST['activo'])) {
        require_once 'Controllers/PromocionController.php';
        $promocionController = new PromocionController();
        $id = $_GET['id'];
        $activo = $_POST['activo'];
        $resultado = $promocionController->actualizarEstadoPromocion($id, $activo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

}
if ($endpoint == 'categorias') {
    require_once 'Controllers/CategoriaController.php';
    $categoriaController = new CategoriaController();
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $resultado = $categoriaController->actualizarCategoria($id, $nombre, $estado);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
} else
    if ($endpoint == 'categorias' && isset($_POST['estado'])) {
        require_once 'Controllers/CategoriaController.php';
        $categoriaController = new CategoriaController();
        $id = $_GET['id'];
        $estado = $_POST['estado'];
        $resultado = $categoriaController->actualizarEstadoCategoria($id, $estado);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();

    }

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

function sumarUnDia($fecha)
{
    // Crear un objeto DateTime con la fecha proporcionada
    $fechaObj = new DateTime($fecha);

    // Sumar un día
    $fechaObj->modify('+1 day');

    // Obtener la fecha resultante en el formato deseado (por ejemplo, YYYY-MM-DD)
    return $fechaObj->format('Y-m-d');
}

header("HTTP/1.1 400 Bad Request");