-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 09-06-2024 a las 06:14:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_proyecto2lenguajes`
--
CREATE DATABASE IF NOT EXISTS `db_proyecto2lenguajes` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `db_proyecto2lenguajes`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_cupon` (IN `_id` INT, IN `_codigo` VARCHAR(500), IN `_nombre` VARCHAR(500), IN `_imgUrl` VARCHAR(500), IN `_ubicacion` VARCHAR(500), IN `_precioBase` INT, IN `_fechaCreacion` DATE, IN `_fechaInicio` DATE, IN `_fechaVencimiento` DATE, IN `_descripcion` VARCHAR(500), IN `_porcentaje` DOUBLE, IN `_id_Categoria` INT, IN `_id_Empresa` INT, IN `_activo` BOOLEAN)   update cupon set 
nombre=_nombre,
codigo = _codigo,
imgUrl=_imgUrl,
ubicacion=_ubicacion,
precioBase=_precioBase,
fechaCreacion=_fechaCreacion,
fechaInicio=_fechaInicio,
fechaVencimiento=_fechaVencimiento,
descripcion=_descripcion,
porcentaje=_porcentaje,
id_Categoria=_id_Categoria,
id_Empresa=_id_Empresa,
activo=_activo 
where id_Cupon=_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_estado_cupon` (IN `_id` INT, IN `_activo` BOOLEAN)   update cupon set activo=_activo where id_Cupon=_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_comprobar_promociones_por_cupon` (IN `_fechaInicio` DATE, IN `_fechaVencimiento` DATE, IN `_id` INT)   SELECT COUNT(id_Promocion) as promociones FROM promocion
WHERE (fechaInicio < _fechaInicio OR fechaVencimiento > _fechaVencimiento) AND id_Cupon = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_admin_by_usuario_contrasenna` (IN `_usuario` VARCHAR(255), IN `_contrasenna` VARCHAR(255))   SELECT id_Admin
FROM administrador
WHERE _usuario LIKE usuario
AND _contrasenna LIKE contrasenna$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_cupon_detalles` (IN `cuponId` INT)   BEGIN 
    SELECT 
        cupon.id_Cupon,
        cupon.codigo,
        cupon.imgUrl,
        cupon.nombre AS nombreCupon,
        cupon.descripcion AS descripcionCupon,
        cupon.fechaCreacion AS fechaCreacionCupon,
        cupon.fechaInicio AS fechaInicioCupon,
        cupon.fechaVencimiento AS fechaVencimientoCupon,
        cupon.porcentaje AS porcentajeDescuentoCupon,
        cupon.precioBase AS precioBaseCupon,
        cupon.ubicacion AS ubicacionCupon,
        empresa.nombre AS nombreEmpresa,
        categoria.nombre AS nombreCategoria,
        promocion.nombre AS nombrePromocion,
        promocion.porcentaje AS porcentajeDescuentoPromocion,
        promocion.fechaInicio AS fechaInicioPromocion,
        promocion.fechaVencimiento AS fechaVencimientoPromocion
    FROM 
        cupon
    JOIN 
        empresa ON cupon.id_Empresa = empresa.id
    JOIN 
        categoria ON cupon.id_Categoria = categoria.id_Categoria
    LEFT JOIN 
        promocion ON cupon.id_Cupon = promocion.id_Cupon
    WHERE 
        cupon.id_Cupon = cuponId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_empresa_by_usuario_contrasenna` (IN `_correo` VARCHAR(255), IN `_contrasenna` VARCHAR(255))   SELECT *
FROM empresa
WHERE _correo LIKE correo
AND _contrasenna LIKE contrasenna AND activo = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_some_categorias` (IN `page` INT)   BEGIN
DECLARE v_displacement INT DEFAULT ((page - 1) * 10);
select * from categoria
LIMIT v_displacement, 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_some_cupones_by_empresa` (IN `idEmpresa` INT, IN `page` INT)   BEGIN
DECLARE v_displacement INT DEFAULT ((page - 1) * 10);
select * from cupon
where id_Empresa = idEmpresa
LIMIT v_displacement, 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_some_empresas` (IN `page` INT)   BEGIN
DECLARE v_displacement INT DEFAULT ((page - 1) * 10);
select * from empresa 
LIMIT v_displacement, 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_some_promociones_by_cupon` (IN `idCupon` INT, IN `page` INT)   BEGIN
DECLARE v_displacement INT DEFAULT ((page - 1) * 10);
select * from promocion 
where id_Cupon = idCupon
LIMIT v_displacement, 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_totalPages_categorias` ()   SELECT CEIL(COUNT(*)/10) AS total_pages
FROM categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_totalPages_cupones_by_empresa` (IN `idEmpresa` INT)   SELECT CEIL(COUNT(*)/10) AS total_pages
FROM cupon WHERE id_Empresa = idEmpresa$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_totalPages_empresas` ()   SELECT CEIL(COUNT(*)/10) AS total_pages
FROM empresa$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_totalPages_promociones_by_cupon` (IN `idCupon` INT)   SELECT CEIL(COUNT(*)/10) AS total_pages
FROM promocion WHERE id_Cupon = idCupon$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_cupones_activos` ()   BEGIN
    SELECT 
        cupon.id_Cupon,
        cupon.codigo,
        cupon.imgUrl,
        cupon.nombre AS nombreCupon,
        cupon.descripcion AS descripcionCupon,
        cupon.fechaCreacion AS fechaCreacionCupon,
        cupon.fechaInicio AS fechaInicioCupon,
        cupon.fechaVencimiento AS fechaVencimientoCupon,
        cupon.porcentaje AS porcentajeDescuentoCupon,
        cupon.precioBase AS precioBaseCupon,
        cupon.ubicacion AS ubicacionCupon,
        empresa.nombre AS nombreEmpresa,
        categoria.nombre AS nombreCategoria,
        promocion.nombre AS nombrePromocion,
        promocion.porcentaje AS porcentajeDescuentoPromocion,
        promocion.fechaInicio AS fechaInicioPromocion,
        promocion.fechaVencimiento AS fechaVencimientoPromocion
    FROM 
        cupon
    JOIN 
        empresa ON cupon.id_Empresa = empresa.id
    JOIN 
        categoria ON cupon.id_Categoria = categoria.id_Categoria
    LEFT JOIN 
        promocion ON cupon.id_Cupon = promocion.id_Cupon
    WHERE 
        cupon.activo = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_cupones_por_categoria` (IN `p_nombreCategoria` VARCHAR(255))   BEGIN
    SELECT 
        cupon.id_Cupon,
        cupon.imgUrl,
        cupon.nombre AS nombreCupon,
        cupon.descripcion AS descripcionCupon,
        cupon.fechaCreacion AS fechaCreacionCupon,
        cupon.fechaInicio AS fechaInicioCupon,
        cupon.fechaVencimiento AS fechaVencimientoCupon,
        cupon.porcentaje AS porcentajeDescuentoCupon,
        cupon.precioBase AS precioBaseCupon,
        cupon.ubicacion AS ubicacionCupon,
        empresa.nombre AS nombreEmpresa,
        categoria.nombre AS nombreCategoria,
        promocion.nombre AS nombrePromocion,
        promocion.porcentaje AS porcentajeDescuentoPromocion,
        promocion.fechaInicio AS fechaInicioPromocion,
        promocion.fechaVencimiento AS fechaVencimientoPromocion
    FROM 
        cupon
    JOIN 
        empresa ON cupon.id_Empresa = empresa.id
    JOIN 
        categoria ON cupon.id_Categoria = categoria.id_Categoria
    LEFT JOIN 
        promocion ON cupon.id_Cupon = promocion.id_Cupon
    WHERE 
        categoria.id_Categoria = p_idCategoria AND cupon.activo =1;
  
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_cupones_por_id_categoria` (IN `p_idCategoria` INT)   BEGIN
    SELECT 
        cupon.id_Cupon,
        cupon.imgUrl,
        cupon.nombre AS nombreCupon,
        cupon.descripcion AS descripcionCupon,
        cupon.fechaCreacion AS fechaCreacionCupon,
        cupon.fechaInicio AS fechaInicioCupon,
        cupon.fechaVencimiento AS fechaVencimientoCupon,
        cupon.porcentaje AS porcentajeDescuentoCupon,
        cupon.precioBase AS precioBaseCupon,
        cupon.ubicacion AS ubicacionCupon,
        empresa.nombre AS nombreEmpresa,
        categoria.nombre AS nombreCategoria,
        promocion.nombre AS nombrePromocion,
        promocion.porcentaje AS porcentajeDescuentoPromocion,
        promocion.fechaInicio AS fechaInicioPromocion,
        promocion.fechaVencimiento AS fechaVencimientoPromocion
    FROM 
        cupon
    JOIN 
        empresa ON cupon.id_Empresa = empresa.id
    JOIN 
        categoria ON cupon.id_Categoria = categoria.id_Categoria
    LEFT JOIN 
        promocion ON cupon.id_Cupon = promocion.id_Cupon
    WHERE 
        categoria.id_Categoria = p_idCategoria
        AND cupon.activo = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_todas_las_promociones_por_cupon` (IN `_id` INT)   SELECT * FROM promocion
WHERE id_Cupon = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_registrar_cupon` (IN `_codigo` VARCHAR(255), IN `_nombre` VARCHAR(255), IN `_imgUrl` VARCHAR(255), IN `_ubicacion` VARCHAR(500), IN `_precioBase` INT, IN `_fechaCreacion` DATE, IN `_fechaInicio` DATE, IN `_fechaVencimiento` DATE, IN `_descripcion` VARCHAR(500), IN `_porcentaje` DOUBLE, IN `_id_Categoria` INT, IN `_id_Empresa` INT, IN `_activo` BOOLEAN)   insert into cupon (codigo,nombre, imgUrl, ubicacion, precioBase, fechaCreacion, fechaInicio, fechaVencimiento, descripcion, porcentaje, id_Categoria, id_Empresa, activo) values (_codigo,_nombre,_imgUrl,_ubicacion,_precioBase,_fechaCreacion,_fechaInicio,_fechaVencimiento,_descripcion,_porcentaje,_id_Categoria,_id_Empresa,_activo)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_Admin` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `contrasenna` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_Admin`, `usuario`, `contrasenna`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_Categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_Categoria`, `nombre`, `estado`) VALUES
(1, 'Comida', 1),
(2, 'Bebida', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupon`
--

CREATE TABLE `cupon` (
  `id_Cupon` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `imgUrl` varchar(500) NOT NULL,
  `precioBase` double NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `porcentaje` double NOT NULL,
  `ubicacion` varchar(300) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cupon`
--

INSERT INTO `cupon` (`id_Cupon`, `codigo`, `nombre`, `imgUrl`, `precioBase`, `id_Categoria`, `fechaCreacion`, `fechaInicio`, `fechaVencimiento`, `descripcion`, `activo`, `porcentaje`, `ubicacion`, `id_Empresa`) VALUES
(1, 'CUP-01', 'Dos Pinos', 'http://localhost/Proyecto2_APIImages_PHP/img/rick-morty.png', 20000, 2, '2024-06-08', '2024-06-09', '2024-06-14', 'Cupon de descuento 2', 1, 0.15, 'Costa Rica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasenna` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `direccionFisica` varchar(800) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `primeraVez` tinyint(1) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `cedulaTipo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `correo`, `contrasenna`, `nombre`, `direccionFisica`, `cedula`, `fechaCreacion`, `telefono`, `primeraVez`, `activo`, `cedulaTipo`) VALUES
(1, 'losreyes2504@gmail.com', 'Avenged@7', 'Dos Pinos', 'Juan Viñas', '11-111-114477', '2024-06-03', '7589-5748', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_Promocion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `porcentaje` double NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `id_Cupon` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_Promocion`, `nombre`, `porcentaje`, `fechaInicio`, `fechaVencimiento`, `id_Cupon`, `activo`) VALUES
(1, 'Promocion 1', 0.15, '2024-06-09', '2024-06-13', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_Admin`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`id_Cupon`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_Promocion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_Admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id_Cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_Promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
