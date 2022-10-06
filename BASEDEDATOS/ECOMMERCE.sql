-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 06-10-2022 a las 22:48:05
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ECOMMERCE`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DETALLEVENTA`
--

CREATE TABLE `DETALLEVENTA` (
  `dvid` int(11) NOT NULL,
  `vid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `cantidad` int(4) DEFAULT NULL,
  `subtotal` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRODUCTOS`
--

CREATE TABLE `PRODUCTOS` (
  `pid` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `precio_venta` int(7) NOT NULL,
  `precio_compra` int(7) NOT NULL,
  `marca` varchar(32) NOT NULL,
  `tipo` varchar(24) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `img` varchar(60) NOT NULL,
  `descrip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `PRODUCTOS`
--

INSERT INTO `PRODUCTOS` (`pid`, `nombre`, `precio_venta`, `precio_compra`, `marca`, `tipo`, `cantidad`, `img`, `descrip`) VALUES
(1, 'Tinto', 200, 150, 'Westinghouse', 'Tinto', 14, 'public/media/bottles/bottle1.png', 'Vino tinto recien traido del himalaya'),
(2, 'Blanco', 300, 200, 'De la viña', 'Blanco', 42, 'public/media/bottles/bottle2.png', 'Vino blanco para acompañar un asado con amigos'),
(3, 'Escoces', 500, 350, 'Santa rosana', 'Escoces', 32, 'public/media/bottles/bottle3.png', 'Vino escocés, traido directamente de Alemania'),
(4, 'Rosado', 200, 100, 'Naturalvinos', 'Rosado', 63, 'public/media/bottles/bottle4.png', 'Vino rosado, color azul, perfecto para acompañar una sopa'),
(5, 'Tannat', 300, 200, 'Los paisanos', 'Tannat', 78, 'public/media/bottles/bottle5.png', 'Tannat, directamente traido desde tannatlandia'),
(6, 'Dulce', 350, 200, 'Las chauchas', 'Rosado dulce', 45, 'public/media/bottles/bottle6.png', 'Vino dulce elaborado con 3 kilos de miel por litro de vino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `uid` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `telefono` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`uid`, `nombre`, `correo`, `contraseña`, `telefono`) VALUES
(1, 'Santiago', 'santiago@gmail.com', '123456', 43324235),
(2, 'Roberto', 'roberto@gmail.com', 'q1w2e3', 43322465),
(3, 'Raul', 'raul@mail.com', '246810', 43332424),
(4, 'Miguel', 'miguel@mail.com', 'tspass', 99242659),
(10, 'santiago', 'santiago', '$2y$10$H4c7QvHPmhQkUDMQH5Os5uZ8RbPLNnqMDM3TNYODGwq3FeRuOJheS', 434343434);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS_Direcciones`
--

CREATE TABLE `USUARIOS_Direcciones` (
  `duid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `direccion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS_Direcciones`
--

INSERT INTO `USUARIOS_Direcciones` (`duid`, `uid`, `direccion`) VALUES
(1, 1, 'Calle 13'),
(2, 1, 'Calle 21'),
(3, 2, 'Calle 17'),
(4, 3, 'Ruta 20'),
(5, 4, 'Las naranjas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS_Tarjetas`
--

CREATE TABLE `USUARIOS_Tarjetas` (
  `tuid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `tarjeta` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS_Tarjetas`
--

INSERT INTO `USUARIOS_Tarjetas` (`tuid`, `uid`, `tarjeta`) VALUES
(1, 1, '1231421'),
(2, 1, '54545454'),
(3, 2, '5123414'),
(4, 3, '34213424'),
(5, 4, '3242424');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `VENTAS`
--

CREATE TABLE `VENTAS` (
  `vid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Total` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  ADD PRIMARY KEY (`dvid`),
  ADD KEY `vid` (`vid`),
  ADD KEY `pid` (`pid`);

--
-- Indices de la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  ADD PRIMARY KEY (`pid`);

--
-- Indices de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  ADD PRIMARY KEY (`uid`);

--
-- Indices de la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  ADD PRIMARY KEY (`duid`),
  ADD KEY `uid` (`uid`);

--
-- Indices de la tabla `USUARIOS_Tarjetas`
--
ALTER TABLE `USUARIOS_Tarjetas`
  ADD PRIMARY KEY (`tuid`),
  ADD KEY `uid` (`uid`);

--
-- Indices de la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `uid` (`uid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  MODIFY `dvid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  MODIFY `duid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Tarjetas`
--
ALTER TABLE `USUARIOS_Tarjetas`
  MODIFY `tuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DETALLEVENTA`
--
ALTER TABLE `DETALLEVENTA`
  ADD CONSTRAINT `DETALLEVENTA_ibfk_1` FOREIGN KEY (`vid`) REFERENCES `VENTAS` (`vid`),
  ADD CONSTRAINT `DETALLEVENTA_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `PRODUCTOS` (`pid`);

--
-- Filtros para la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  ADD CONSTRAINT `USUARIOS_Direcciones_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `USUARIOS` (`uid`);

--
-- Filtros para la tabla `USUARIOS_Tarjetas`
--
ALTER TABLE `USUARIOS_Tarjetas`
  ADD CONSTRAINT `USUARIOS_Tarjetas_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `USUARIOS` (`uid`);

--
-- Filtros para la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  ADD CONSTRAINT `VENTAS_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `USUARIOS` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;