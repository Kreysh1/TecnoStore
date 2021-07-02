-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 02-07-2021 a las 19:54:16
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tecnostore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_carrito`
--

CREATE TABLE `t_carrito` (
  `ID_Carrito` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Precio` double(6,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Subtotal` double(6,2) NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_productos`
--

CREATE TABLE `t_productos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Precio` double(15,2) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL DEFAULT 0,
  `Estado` int(11) NOT NULL DEFAULT 1,
  `Imagen` varchar(255) DEFAULT NULL,
  `Vendidos` int(11) NOT NULL DEFAULT 0,
  `Ganancias` double(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_productos`
--

INSERT INTO `t_productos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Cantidad`, `Estado`, `Imagen`, `Vendidos`, `Ganancias`) VALUES
(1, 'Articulo 1', 'Este es un producto (Descripción)', 850.00, 94, 1, 'Funda_1.jpg', 6, 5100.00),
(2, 'Articulo 2 modificado', 'Descripcion aasdasdzxxzzz11111s', 470.00, 87, 1, '60da474691d165.34810774.PNG', 13, 6110.00),
(3, 'Articulo 3', 'Descripcion asdasdaxcs', 235.00, 100, 1, 'Motorola_1.JPG', 0, 0.00),
(4, 'Articulo 4', 'Descripcion asdasdaxcs', 740.00, 100, 1, 'Motorola_1.JPG', 0, 0.00),
(18, 'Articulo 5', 'Desc SQL', 400.00, 66, 1, '60d91605268b22.84916263.PNG', 34, 13600.00),
(19, 'Articulo 6', 'Desc SQL', 400.00, 84, 1, '60d91605268b22.84916263.PNG', 16, 6400.00),
(20, 'Articulo 7', 'Descripcion asdasdaxcs', 235.00, 100, 0, 'Motorola_1.JPG', 0, 0.00),
(21, 'Articulo 8', 'Este es un producto (Descripción)', 850.00, 93, 1, '60d9833554cb49.98003186.PNG', 7, 5950.00),
(22, 'Articulo 9', 'Descripcion asdasdaxcs', 235.00, 100, 0, 'Motorola_1.JPG', 0, 0.00),
(23, 'Articulo 10', 'Descripción de prueba numero 10', 534.27, 94, 1, '60d97773955517.18707967.JPG', 6, 3205.62),
(24, 'Articulo 11', 'exxzzx', 555.23, 79, 1, '60d97683a0c504.20156962.PNG', 21, 11659.83),
(27, 'Producto Prueba', 'Descripcion de prueba', 27.13, 91, 1, '60d9849db6dab2.41237354.JPG', 9, 244.17),
(28, 'Prueba producto modificado', 'deescasd modificado', 25.00, 92, 1, '60de46d00a99f0.99711087.JPG', 8, 200.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Nick` varchar(20) NOT NULL,
  `Correo` varchar(40) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `Nivel` int(11) NOT NULL,
  `Estado` int(11) NOT NULL DEFAULT 1,
  `Compras` int(11) NOT NULL DEFAULT 0,
  `Gastos` double(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`ID`, `Nombre`, `Edad`, `Nick`, `Correo`, `Pass`, `Nivel`, `Estado`, `Compras`, `Gastos`) VALUES
(9, 'Alan', 18, 'ALAN', 'alan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 30, 12500.00),
(12, 'Pito Perez', 18, 'PITOPEREZ', 'pitoperez27@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 13, 6766.08),
(13, 'Admin', 18, 'ADMIN', 'admin@tecnostore.com', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 19, 8510.00),
(14, 'pepe grillo', 18, 'GRILLO', 'grillo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 1, 25.00),
(15, 'Paquito', 29, 'PAQUITO29', 'paquito@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 17, 9128.45),
(17, 'Juan Carlos x', 19, 'KREYSH2', 'kreysh@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 6, 3450.00),
(18, 'paco', 40, 'PACO40', 'paco40@hotmai.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 4, 2220.92),
(19, 'Joshua', 27, 'JOSHUA27', 'joshua27@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 7, 1835.65),
(21, 'Juan Carlos Gonzalez', 24, 'KREYSH', 'juan.c_sega@hotmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 20, 7475.00),
(22, 'tecno', 18, 'TECNOSTORE', 'tecnostoreuas@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 1, 0, 0.00),
(23, 'Paquito', 25, 'PAQUITO25', 'paquito25@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 3, 2550.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ventas`
--

CREATE TABLE `t_ventas` (
  `ID` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Nick` varchar(20) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `P_Nombre` varchar(50) NOT NULL,
  `Cantidad` int(11) NOT NULL DEFAULT 0,
  `Precio` double(15,2) NOT NULL DEFAULT 0.00,
  `Total` double(15,2) NOT NULL DEFAULT 0.00,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_ventas`
--

INSERT INTO `t_ventas` (`ID`, `ID_Usuario`, `Nick`, `ID_Producto`, `P_Nombre`, `Cantidad`, `Precio`, `Total`, `Fecha`) VALUES
(4, 13, 'Admin', 2, 'Articulo 2 modificado', 1, 470.00, 470.00, '2021-07-02 00:23:38'),
(5, 13, 'Admin', 2, 'Articulo 2 modificado', 1, 470.00, 470.00, '2021-07-02 00:24:25'),
(6, 13, 'Admin', 2, 'Articulo 2 modificado', 1, 470.00, 470.00, '2021-07-02 00:27:19'),
(7, 13, 'Admin', 2, 'Articulo 2 modificado', 2, 470.00, 940.00, '2021-07-02 00:27:26'),
(8, 13, 'Admin', 2, 'Articulo 2 modificado', 1, 470.00, 470.00, '2021-07-02 00:28:04'),
(9, 13, 'Admin', 2, 'Articulo 2 modificado', 1, 470.00, 470.00, '2021-07-02 00:31:07'),
(10, 13, 'Admin', 18, 'Articulo 5', 2, 400.00, 800.00, '2021-07-02 00:33:27'),
(11, 13, 'Admin', 19, 'Articulo 6', 1, 400.00, 400.00, '2021-07-02 00:33:27'),
(12, 13, 'Admin', 2, 'Articulo 2 modificado', 4, 470.00, 1880.00, '2021-07-02 00:47:28'),
(13, 13, 'Admin', 2, 'Articulo 2 modificado', 2, 470.00, 940.00, '2021-07-02 00:48:11'),
(14, 13, 'Admin', 19, 'Articulo 6', 3, 400.00, 1200.00, '2021-07-02 00:48:11'),
(15, 9, 'Alan', 18, 'Articulo 5', 26, 400.00, 9999.99, '2021-07-02 10:19:46'),
(16, 9, 'Alan', 27, 'Producto Prueba', 4, 27.13, 108.52, '2021-07-02 10:19:53'),
(17, 12, 'Pito Perez', 1, 'Articulo 1', 1, 850.00, 850.00, '2021-07-02 10:20:06'),
(18, 12, 'Pito Perez', 18, 'Articulo 5', 4, 400.00, 1600.00, '2021-07-02 10:20:12'),
(19, 12, 'Pito Perez', 23, 'Articulo 10', 6, 534.27, 3205.62, '2021-07-02 10:20:20'),
(20, 12, 'Pito Perez', 24, 'Articulo 11', 2, 555.23, 1110.46, '2021-07-02 10:21:34'),
(21, 14, 'pepe grillo', 28, 'Prueba producto modificado', 1, 25.00, 25.00, '2021-07-02 10:22:01'),
(22, 15, 'Paquito', 18, 'Articulo 5', 2, 400.00, 800.00, '2021-07-02 10:22:19'),
(23, 15, 'Paquito', 24, 'Articulo 11', 15, 555.23, 8328.45, '2021-07-02 10:22:26'),
(24, 17, 'Juan Carlos x', 28, 'Prueba producto modificado', 2, 25.00, 50.00, '2021-07-02 10:22:45'),
(25, 17, 'Juan Carlos x', 21, 'Articulo 8', 4, 850.00, 3400.00, '2021-07-02 10:22:52'),
(26, 18, 'paco', 24, 'Articulo 11', 4, 555.23, 2220.92, '2021-07-02 10:24:09'),
(27, 19, 'Joshua', 27, 'Producto Prueba', 5, 27.13, 135.65, '2021-07-02 10:24:32'),
(28, 19, 'Joshua', 1, 'Articulo 1', 2, 850.00, 1700.00, '2021-07-02 10:24:37'),
(29, 21, 'Juan Carlos Gonzalez', 21, 'Articulo 8', 3, 850.00, 2550.00, '2021-07-02 10:24:57'),
(30, 21, 'Juan Carlos Gonzalez', 28, 'Prueba producto modificado', 5, 25.00, 125.00, '2021-07-02 10:25:02'),
(31, 21, 'Juan Carlos Gonzalez', 19, 'Articulo 6', 12, 400.00, 4800.00, '2021-07-02 10:25:12'),
(32, 23, 'Paquito', 1, 'Articulo 1', 3, 850.00, 2550.00, '2021-07-02 10:25:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_carrito`
--
ALTER TABLE `t_carrito`
  ADD PRIMARY KEY (`ID_Carrito`) USING BTREE;

--
-- Indices de la tabla `t_productos`
--
ALTER TABLE `t_productos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_carrito`
--
ALTER TABLE `t_carrito`
  MODIFY `ID_Carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `t_productos`
--
ALTER TABLE `t_productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
