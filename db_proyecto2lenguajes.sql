-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 12-06-2024 a las 07:25:33
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_cupones_comprados` (IN `cuponesIds` VARCHAR(255))   BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE cuponId VARCHAR(255);
    DECLARE cur CURSOR FOR 
        SELECT value FROM (SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(cuponesIds, ',', numbers.n), ',', -1) value
                           FROM (SELECT 1 n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL 
                                        SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL 
                                        SELECT 9 UNION ALL SELECT 10) numbers 
                           WHERE numbers.n <= CHAR_LENGTH(cuponesIds) - CHAR_LENGTH(REPLACE(cuponesIds, ',', '')) + 1) ids;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    CREATE TEMPORARY TABLE IF NOT EXISTS result (
        id_Cupon INT, 
        nombre VARCHAR(255), 
        descripcion VARCHAR(255), 
        fechaCreacion DATE, 
        fechaInicio DATE, 
        fechaVencimiento DATE, 
        id_Categoria INT, 
        id_Empresa INT, 
        imgUrl VARCHAR(255), 
        porcentaje DOUBLE, 
        precioBase DOUBLE, 
        ubicacion VARCHAR(255), 
        activo TINYINT
    );

    OPEN cur;

    read_loop: LOOP
        FETCH cur INTO cuponId;
        IF done THEN
            LEAVE read_loop;
        END IF;

        INSERT INTO result
        SELECT 
            id_Cupon, nombre, descripcion, fechaCreacion, fechaInicio, fechaVencimiento, id_Categoria, id_Empresa, imgUrl, porcentaje, precioBase, ubicacion, activo
        FROM cupon
        WHERE id_Cupon = cuponId;
    END LOOP;

    CLOSE cur;

    SELECT * FROM result;
    DROP TEMPORARY TABLE result;
END$$

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
        promocion_activa.nombre AS nombrePromocion,
        promocion_activa.porcentaje AS porcentajeDescuentoPromocion,
        promocion_activa.fechaInicio AS fechaInicioPromocion,
        promocion_activa.fechaVencimiento AS fechaVencimientoPromocion
    FROM 
        cupon
    JOIN 
        empresa ON cupon.id_Empresa = empresa.id
    JOIN 
        categoria ON cupon.id_Categoria = categoria.id_Categoria
    LEFT JOIN 
        (
            SELECT 
                id_Cupon,
                nombre,
                porcentaje,
                fechaInicio,
                fechaVencimiento
            FROM 
                promocion
            WHERE 
                activo = 1 AND id_Cupon = cuponId
           
        ) AS promocion_activa ON cupon.id_Cupon = promocion_activa.id_Cupon
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_categorias_activas` ()   BEGIN
    SELECT 
        id_Categoria,
        nombre
    FROM 
        categoria
    WHERE 
        estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_obtener_cupones_activos` ()   SELECT 
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
    promocion_activa.nombre AS nombrePromocion,
    promocion_activa.porcentaje AS porcentajeDescuentoPromocion,
    promocion_activa.fechaInicio AS fechaInicioPromocion,
    promocion_activa.fechaVencimiento AS fechaVencimientoPromocion
FROM 
    cupon
JOIN 
    empresa ON cupon.id_Empresa = empresa.id
JOIN 
    categoria ON cupon.id_Categoria = categoria.id_Categoria
LEFT JOIN 
    (
        SELECT 
            id_Cupon,
            nombre,
            porcentaje,
            fechaInicio,
            fechaVencimiento
        FROM 
            promocion
        WHERE 
            promocion.activo = 1
    ) AS promocion_activa ON cupon.id_Cupon = promocion_activa.id_Cupon
WHERE 
    cupon.activo = 1 
    AND categoria.estado = 1$$

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
        categoria.nombre = p_nombreCategoria AND cupon.activo = 1;
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
(2, 'Bebida', 1),
(3, 'Varios', 1);

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
(1, 'CUP-01', 'Dos Pinos', 'http://localhost/Proyecto2_APIImages_PHP/img/stretched-1920-1080-1167537 (1).jpg', 20000, 2, '2024-06-09', '2024-06-12', '2024-06-28', 'Cupon de descuento 2', 1, 0.15, 'Costa Rica', 1),
(2, 'CUP-02', 'Prueba', 'http://localhost/Proyecto2_APIImages_PHP/img/Gojo ;c.png', 20000, 1, '2024-06-09', '2024-06-11', '2024-06-26', 'Descuento', 1, 0.18, 'Costa Rica', 1);

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
(1, 'majobm2504@gmail.com', 'Avenged!7', 'Dos Pinos', 'Juan Viñas Costa Rica', '11-255-345789', '2024-06-07', '7281-0534', 0, 1, 0);

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
(1, 'Promocion 1', 0.15, '2024-06-13', '2024-06-17', 1, 0),
(5, 'Cristian', 0.11, '2024-06-14', '2024-06-16', 1, 1);

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
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id_Cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_Promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
