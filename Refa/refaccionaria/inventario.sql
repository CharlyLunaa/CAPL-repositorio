-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2024 a las 00:28:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `refaccionaria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `no.parte` varchar(30) NOT NULL,
  `descipcion` varchar(100) NOT NULL,
  `marca` varchar(25) NOT NULL,
  `ubicacion` varchar(6) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `existencia` int(3) NOT NULL,
  `entrada` int(4) NOT NULL,
  `salida` int(4) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `M.A` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `no.parte`, `descipcion`, `marca`, `ubicacion`, `precio`, `existencia`, `entrada`, `salida`, `costo`, `total`, `M.A`) VALUES
(1, '30012', 'CONJUNTO DE ARTICULACION TRAS. A BASE 5105270AD TODO PATRIOT, COMPAS, CALIBER 07/14', 'TRACKONE', '2 K 1', 899.99, 0, 3, 3, 465.51, 0.00, 'D'),
(2, '52037627', 'BRAZO PITMAN TODO RAM 1500 2500 3500 1994 A 2000', 'MOPAR', '2 L 3', 375.01, 1, 1, 0, 193.97, 568.98, 'A'),
(3, '52037660', 'ROTULA SUSPENSIÓN INFERIOR (MOPAR) RAM 1500 2500 94-99', 'MOPAR', '2 D 2', 1993.92, 1, 1, 0, 1031.34, 3025.26, 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
