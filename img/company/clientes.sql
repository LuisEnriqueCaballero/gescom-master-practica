-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2021 a las 01:12:10
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prizma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_telefono` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_direccion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_tipo` int(11) NOT NULL,
  `cliente_documento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_pais` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_departamento` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_provincia` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_distrito` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_sucursal` int(11) NOT NULL,
  `cliente_contacto` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_cargo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_ciudad` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cliente_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_nombre`, `cliente_telefono`, `cliente_email`, `cliente_direccion`, `cliente_tipo`, `cliente_documento`, `cliente_pais`, `cliente_departamento`, `cliente_provincia`, `cliente_distrito`, `cliente_sucursal`, `cliente_contacto`, `cliente_cargo`, `cliente_ciudad`, `cliente_registro`) VALUES
(1, 'CLIENTE 1', '987654321', 'CLIENTE1@DEMO.COM', 'DIRECCION 1', 1, '72579909', 'PERU', 'LIMA', 'LIMA', 'LOS OLIVOS', 1, 'MARIO', '-', 'LIMA', '0000-00-00 00:00:00'),
(2, 'CLIENTE 2', '963852741', 'CLIENTE2@DEMO.COM', 'DIRECCION 2', 2, '10725799093', 'PERU', 'LIMA', 'LIMA', 'LOS OLIVOS', 1, 'MARIO', '-', 'LIMA', '0000-00-00 00:00:00'),
(3, 'CLIENTE 3', '951628473', 'CLIENTE3@DEMO.COM', 'DIRECCION 3', 3, '859632147895', 'COLOMBIA', '-', '-', '-', 1, 'MARIO', '-', 'LIMA', '0000-00-00 00:00:00'),
(4, 'CLIENTE 4', '913467981', 'CLIENTE4@DEMO.COM', 'DIRECCION 4', 1, '12345678', 'PERU', 'LIMA', 'LIMA', 'LOS OLIVOS', 1, 'MARIO', '-', 'LIMA', '0000-00-00 00:00:00'),
(5, 'CLIENTE 5', '985632147', 'CLIENTE5@DEMO.COM', 'DIRECCION 5', 2, '12345678965', 'PERU', 'LIMA', 'LIMA', 'LOS OLIVOS', 1, 'MARIO', '-', 'LIMA', '0000-00-00 00:00:00'),
(6, 'CLIENTE 6', '985674132', 'CLIENTE6@DEMO.COM', 'DIRECCION 6', 3, '128574963245', 'MEXICO', '-', '-', '-', 1, 'MARIO', '', 'LIMA', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
