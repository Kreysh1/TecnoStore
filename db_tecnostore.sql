-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 28-06-2021 a las 05:05:08
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
-- Estructura de tabla para la tabla `t_productos`
--

CREATE TABLE `t_productos` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Descripcion` varchar(100) DEFAULT NULL,
  `Precio` double(6,2) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL DEFAULT 0,
  `Estado` int(11) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_productos`
--

INSERT INTO `t_productos` (`ID`, `Nombre`, `Descripcion`, `Precio`, `Cantidad`, `Estado`, `Imagen`) VALUES
(1, 'Articulo 1', 'Este es un producto (Descripción)', 850.00, 0, 1, 'Funda_1.jpg'),
(2, 'Articulo 2', 'Descripcion asdasdaxcs', 465.00, 0, 1, 'Motorola_1.JPG'),
(3, 'Articulo 3', 'Descripcion asdasdaxcs', 235.00, 0, 1, 'Motorola_1.JPG'),
(4, 'Articulo 4', 'Descripcion asdasdaxcs', 740.00, 0, 1, 'Motorola_1.JPG'),
(18, 'Articulo 5', 'Desc SQL', 400.00, 5, 1, '60d91605268b22.84916263.PNG'),
(19, 'Articulo 6', 'Desc SQL', 400.00, 5, 1, '60d91605268b22.84916263.PNG'),
(20, 'Articulo 7', 'Descripcion asdasdaxcs', 235.00, 0, 1, 'Motorola_1.JPG'),
(21, 'Articulo 8', 'Este es un producto (Descripción)', 850.00, 0, 1, 'Funda_1.jpg'),
(22, 'Articulo 9', 'Descripcion asdasdaxcs', 235.00, 0, 1, 'Motorola_1.JPG');

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
  `Nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`ID`, `Nombre`, `Edad`, `Nick`, `Correo`, `Pass`, `Nivel`) VALUES
(8, 'Juan Carlos', 18, 'KREYSH', 'juan.c_sega@hotmail.com', '2626f918aaeb132de303d8272cdc9f62', 3),
(9, 'Alan', 18, 'ALAN', 'alan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3),
(12, 'Pito Perez', 18, 'PITOPEREZ', 'pitoperez27@hotmail.com', '2626f918aaeb132de303d8272cdc9f62', 3),
(13, 'Admin', 18, 'ADMIN', 'admin@tecnostore.com', '21232f297a57a5a743894a0e4a801fc3', 1),
(14, 'pepe grillo', 18, 'GRILLO', 'grillo@gmail.com', '2626f918aaeb132de303d8272cdc9f62', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ventas`
--

CREATE TABLE `t_ventas` (
  `ID` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Producto` int(11) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `t_productos`
--
ALTER TABLE `t_productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
