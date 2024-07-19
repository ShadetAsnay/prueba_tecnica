-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-07-2024 a las 04:25:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto_id` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `categoria_id` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_disponible` int(11) NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `fecha_publicacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto_id`, `titulo`, `categoria_id`, `precio`, `cantidad_disponible`, `estado`, `fecha_publicacion`) VALUES
(11, 'MLU687279598', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 10, NULL, '2024-07-18 14:08:16'),
(13, 'MLU687191646', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 10, NULL, '2024-07-18 14:36:49'),
(14, 'MLU687351116', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 22:10:08'),
(15, 'MLU687228882', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 10, 'new', '2024-07-18 22:10:09'),
(16, 'MLU687363576', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 23:01:08'),
(17, 'MLU687441564', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 5, 'new', '2024-07-18 23:01:08'),
(18, 'MLU687480580', 'Item De Test - No Ofertar', 'MLU446796', 1200.00, 7, 'new', '2024-07-18 23:01:09'),
(19, 'MLU687376610', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 23:14:33'),
(20, 'MLU687428582', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 5, 'new', '2024-07-18 23:14:34'),
(21, 'MLU687428584', 'Item De Test - No Ofertar', 'MLU446796', 1200.00, 7, 'new', '2024-07-18 23:14:35'),
(22, 'MLU687363598', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 23:14:47'),
(23, 'MLU687363600', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 5, 'new', '2024-07-18 23:14:47'),
(24, 'MLU687402592', 'Item De Test - No Ofertar', 'MLU446796', 1200.00, 7, 'new', '2024-07-18 23:14:48'),
(25, 'MLU687376622', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 23:20:12'),
(26, 'MLU687363606', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 5, 'new', '2024-07-18 23:20:12'),
(27, 'MLU687480618', 'Item De Test - No Ofertar', 'MLU446796', 1200.00, 7, 'new', '2024-07-18 23:20:13'),
(28, 'MLU687480622', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 23:22:04'),
(29, 'MLU687376624', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 5, 'new', '2024-07-18 23:22:05'),
(30, 'MLU687402602', 'Item De Test - No Ofertar', 'MLU446796', 1350.00, 10, 'new', '2024-07-18 23:22:25'),
(31, 'MLU687480624', 'Item De Test - No Ofertar', 'MLU446796', 1050.00, 5, 'new', '2024-07-18 23:22:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_comprados`
--

CREATE TABLE `productos_comprados` (
  `id` int(11) NOT NULL,
  `producto_id` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `email_comprador` varchar(100) NOT NULL,
  `preference_id` varchar(50) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_comprados`
--

INSERT INTO `productos_comprados` (`id`, `producto_id`, `cantidad`, `email_comprador`, `preference_id`, `fecha_compra`) VALUES
(1, 'MLU687315716', 1, 'test_user_513625702@testuser.com', '1907090842-6ef70955-23e5-484e-a50b-ab2e4b69d6a1', '2024-07-18 22:51:27'),
(2, 'MLU687315716', 1, 'test_user_513625702@testuser.com', '1907090842-3544645b-4102-47d3-856e-8edc17a8fa9f', '2024-07-19 01:18:26'),
(3, 'MLU687315716', 1, 'test_user_513625702@testuser.com', '1907090842-3427b483-277e-4848-80c1-b9cc7033f786', '2024-07-19 02:02:38'),
(4, 'MLU687315716', 1, 'test_user_513625702@testuser.com', '1907090842-ec42b5e8-8c3e-4197-a8fc-d0d40c53908b', '2024-07-19 02:24:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_comprados`
--
ALTER TABLE `productos_comprados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `productos_comprados`
--
ALTER TABLE `productos_comprados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
