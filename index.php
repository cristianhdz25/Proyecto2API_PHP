<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET,POST,PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

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
    } else if ($endpoint == 'empresas') {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $empresa = $empresaController->obtenerEmpresaPorId($id);
        } else {
            $empresas = $empresaController->obtenerEmpresas();
        }
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
    } else if ($endpoint == 'cupones' && isset($_GET['idEmpresa'])) {
        require_once 'Controllers/CuponController.php';
        $idEmpresa = $_GET['idEmpresa'];
        $cuponController = new CuponController();
        $cupon = $cuponController->obtenerCuponPorEmpresa($idEmpresa);
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
    } else {
        if ($endpoint == 'cupones') {
            require_once 'Controllers/CuponController.php';
            $cuponController = new CuponController();
            $cupones = $cuponController->obtenerCupones();
            echo json_encode($cupones);
            header("HTTP/1.1 200 OK");
            exit();
        }
    }


    if ($endpoint == 'categorias' && isset($_GET['id'])) {
        require_once 'Controllers/CategoriaController.php';
        $id = $_GET['id'];
        $categoriaController = new CategoriaController();
        $categoria = $categoriaController->obtenerCategoriaPorId($id);
        echo json_encode($categoria);
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



    if ($endpoint == 'promociones') {
        require_once 'Controllers/PromocionController.php';
        $promocionController = new PromocionController();
        $promociones = $promocionController->obtenerPromociones();
        echo json_encode($promociones);
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
        $fechaCreacion = $_POST['fechaCreacion'];
        $primeraVez = $_POST['primeraVez'];
        $activo = $_POST['activo'];
        $empresaController = new EmpresaController();
        $resultado = $empresaController->registrarEmpresa($nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'cupones') {
        require_once 'Controllers/CuponController.php';
        $nombre = $_POST['nombre'];
        $imgUrl = $_POST['imgUrl'];
        $ubicacion = $_POST['ubicacion'];
        $precioBase = $_POST['precioBase'];
        $activo = $_POST['activo'];
        $categoria = $_POST['categoria'];
        $empresa = $_POST['empresa'];
        $cuponController = new CuponController();
        $resultado = $cuponController->registrarCupon($nombre, $imgUrl, $ubicacion, $precioBase, $activo, $categoria, $empresa);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

}

if ($_POST['METHOD'] == 'PUT') {
    if ($endpoint == 'empresas') {
        require_once 'Controllers/EmpresaController.php';
        $empresaController = new EmpresaController();
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contrasenna = $_POST['contrasenna'];
        $telefono = $_POST['telefono'];
        $direccionFisica = $_POST['direccionFisica'];
        $cedula = $_POST['cedula'];
        $fechaCreacion = $_POST['fechaCreacion'];
        $primeraVez = $_POST['primeraVez'];
        $activo = $_POST['activo'];
        $resultado = $empresaController->actualizarEmpresa($id, $nombre, $correo, $contrasenna, $telefono, $direccionFisica, $cedula, $fechaCreacion, $primeraVez, $activo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }

    if ($endpoint == 'cupones') {
        require_once 'Controllers/CuponController.php';
        $cuponController = new CuponController();
        $id = $_GET['id'];
        $activo = $_POST['activo'];
        $resultado = $cuponController->actualizarCupon($id, $activo);
        echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}


header("HTTP/1.1 400 Bad Request");