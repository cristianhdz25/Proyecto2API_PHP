-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 27-05-2024 a las 23:25:01
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
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imgUrl` varchar(500) NOT NULL,
  `ubicacion` varchar(800) NOT NULL,
  `precioBase` double NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_Categoria` int(11) NOT NULL,
  `id_Empresa` int(11) NOT NULL,
  `id_Promocion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `cupon`
--

INSERT INTO `cupon` (`id`, `nombre`, `imgUrl`, `ubicacion`, `precioBase`, `activo`, `id_Categoria`, `id_Empresa`, `id_Promocion`) VALUES
(1, 'Cupon Para Coca Colas', 'img.png', 'SJ Costa Rica', 2000, 1, 1, 1, 1);

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
(1, 'losreyes2504@gmail.com', '1324', 'Dos Pinos 1', 'Los Alpes', '11-2222-2555', '2005-12-27', '78965874', 0, 0),
(2, 'losreyes2504@gmail.com', '1234', 'Cristian Hernandez', 'Juan Viñas Costa Rica', '22-1425-0144', '2024-04-17', '72810534', 0, 0),
(3, 'majobm@gmail.com', '1234', 'Cristian', 'Juan Viñas', '22-1425-0144', '2023-08-17', '72810534', 0, 0),
(4, 'losreyes2504@gmail.com', '1234', 'Dos Pinos 3', 'Juan Viñas', '22-1425-0144', '2024-04-23', '72810534', 0, 0),
(5, 'losreyes2504@gmail.com', '1234', 'Dos Pinos', 'Juan Viñas', '22-1425-0144', '2024-04-22', '72810535', 0, 0),
(6, 'majobm@gmail.com', '1234', 'Probando', 'Juan Viñas', '22-1425-0144', '2024-04-12', '72810534', 0, 0),
(7, 'joseant2302@gmail.com', '13', 'Cristian 2', 'Juan Viñas', '11-2225-1457', '2018-04-16', '72849578', 1, 0),
(8, 'rolo@gmail.com', '134', 'Prueba', 'Coronado', '22-1425-0144', '2024-05-01', '72812547', 1, 0),
(9, 'majobm@gmail.com', '1234', 'Cristian', 'Coronado', '22-1425-0144', '2024-04-16', '78965874', 1, 0),
(10, 'yordi@gmail.com', '134', 'Yordi', 'Juan Viñas', '11-2222-2555', '2024-05-03', '12587487', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_Promocion` int(11) NOT NULL,
  `porcentaje` double NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_Promocion`, `porcentaje`, `fechaInicio`, `fechaVencimiento`, `activo`) VALUES
(1, 0.15, '2024-03-15', '2024-05-06', 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuponEmpresa` (`id_Empresa`),
  ADD KEY `cuponCategoria` (`id_Categoria`),
  ADD KEY `cuponPromocion` (`id_Promocion`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_Promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cupon`
--
ALTER TABLE `cupon`
  ADD CONSTRAINT `cuponCategoria` FOREIGN KEY (`id_Categoria`) REFERENCES `categoria` (`id_Categoria`),
  ADD CONSTRAINT `cuponEmpresa` FOREIGN KEY (`id_Empresa`) REFERENCES `empresa` (`id`),
  ADD CONSTRAINT `cuponPromocion` FOREIGN KEY (`id_Promocion`) REFERENCES `promocion` (`id_Promocion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
