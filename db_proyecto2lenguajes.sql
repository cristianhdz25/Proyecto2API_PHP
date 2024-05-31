-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 31-05-2024 a las 08:06:20
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_some_cupones_by_empresa` (IN `idEmpresa` INT, IN `page` INT)   BEGIN
DECLARE v_displacement INT DEFAULT ((page - 1) * 10);
select * from cupon
where id_Empresa = idEmpresa
LIMIT v_displacement, 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_some_promociones_by_cupon` (IN `idCupon` INT, IN `page` INT)   BEGIN
DECLARE v_displacement INT DEFAULT ((page - 1) * 10);
select * from promocion 
where id_Cupon = idCupon
LIMIT v_displacement, 10;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_totalPages_cupones_by_empresa` (IN `idEmpresa` INT)   SELECT CEIL(COUNT(*)/10) AS total_pages
FROM cupon WHERE id_Empresa = idEmpresa$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_totalPages_promociones_by_cupon` (IN `idCupon` INT)   SELECT CEIL(COUNT(*)/10) AS total_pages
FROM promocion WHERE id_Cupon = idCupon$$

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_Categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_Categoria`, `nombre`) VALUES
(1, 'Comida y Bebida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupon`
--

CREATE TABLE `cupon` (
  `id_Cupon` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `imgUrl` varchar(500) NOT NULL,
  `precioBase` double NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `ubicacion` varchar(300) NOT NULL,
  `id_Empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cupon`
--

INSERT INTO `cupon` (`id_Cupon`, `nombre`, `imgUrl`, `precioBase`, `id_Categoria`, `fechaCreacion`, `fechaInicio`, `fechaVencimiento`, `descripcion`, `activo`, `porcentaje`, `ubicacion`, `id_Empresa`) VALUES
(1, 'Coca Cola', './img/Gojo ;c.png', 1500, 1, '2024-05-30', '2024-05-28', '2024-05-31', '0', 0, 12, 'Costa Rica', 1),
(2, 'Cristian', './img/thumb-1920-1334857.png', 20000, 1, '2024-05-30', '2024-05-27', '2024-05-31', '0', 0, 1, 'Costa Rica', 1),
(3, 'Cristian', './img/coctel-sexo-en-la-playa-sex.jpg', 20000, 1, '2024-05-30', '2024-05-20', '2024-06-06', '0', 0, 15, 'Costa Rica', 1),
(4, 'Cristian', './img/rick-morty.png', 20000, 1, '2024-05-30', '2024-05-31', '2024-06-01', '0', 0, 15, 'CR', 1),
(5, 'Dos Pinos', 'null', 25000, 1, '2024-05-30', '2024-05-31', '2024-06-10', 'Descuento', 0, 15, 'Costa Rica', 4),
(6, 'Estandarizada', './img/rick-morty.png', 15000, 1, '2024-05-31', '2024-06-01', '2024-06-16', 'Ober', 0, 15, 'CR', 4),
(7, 'Prueba', './img/Gojo ;c.png', 20000, 1, '2024-06-01', '2024-06-02', '2024-06-09', 'Cupon de descuento ', 0, 15, 'Costa Rica', 4);

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
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `correo`, `contrasenna`, `nombre`, `direccionFisica`, `cedula`, `fechaCreacion`, `telefono`, `primeraVez`, `activo`) VALUES
(1, 'losreyes2504@gmail.com', '1324', 'Dos Pinos 1', 'Los Alpes', '11-2222-2555', '2005-12-25', '78965874', 0, 0),
(2, 'losreyes2504@gmail.com', '1234', 'Cristian Hernandez', 'Juan Viñas Costa Rica', '22-1425-0144', '2024-04-17', '72810534', 0, 0),
(3, 'majobm@gmail.com', '1234', 'Cristian', 'Juan Viñas', '22-1425-0144', '2023-08-17', '72810534', 0, 0),
(4, 'losreyes2504@gmail.com', '1234', 'Dos Pinos 3', 'Juan Viñas', '22-1425-0144', '2024-04-23', '72810534', 0, 0),
(5, 'losreyes2504@gmail.com', '1234', 'Dos Pinos', 'Juan Viñas', '22-1425-0144', '2024-04-20', '72810535', 0, 0),
(6, 'majobm@gmail.com', '1234', 'Probando', 'Juan Viñas', '22-1425-0144', '2024-04-10', '72810534', 0, 0),
(7, 'joseant2302@gmail.com', '13', 'Cristian 2', 'Juan Viñas', '11-2225-1457', '2018-04-16', '72849578', 1, 0),
(8, 'rolo@gmail.com', '134', 'Prueba', 'Coronado', '22-1425-0144', '2024-05-01', '72812547', 1, 0),
(9, 'majobm@gmail.com', '1234', 'Cristian', 'Coronado', '22-1425-0144', '2024-04-16', '78965874', 1, 0),
(10, 'yordi@gmail.com', '134', 'Yordi', 'Juan Viñas', '11-2222-2555', '2024-05-03', '12587487', 1, 0),
(11, 'pepsi@gmail.com', '1234', 'Pepsi', 'Coronado', '22-1425-0144', '2024-05-04', '72810534', 1, 0),
(12, 'losreyes2504@gmail.com', '1234', 'Cristian', 'Juan Viñas', '11-2222-2555', '2024-05-26', '72474578', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_Promocion` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `porcentaje` varchar(5) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `id_Cupon` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_Promocion`, `nombre`, `porcentaje`, `fechaInicio`, `fechaVencimiento`, `id_Cupon`, `activo`) VALUES
(1, 'Cristian', '15', '2024-05-31', '2024-06-04', 5, 0),
(2, 'Cristian', '15', '2024-05-31', '2024-06-05', 5, 0),
(3, 'Estandarizada', '15', '2024-06-03', '2024-06-07', 7, 0);

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
  MODIFY `id_Admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id_Cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_Promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
