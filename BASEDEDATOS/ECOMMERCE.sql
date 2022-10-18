-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-10-2022 a las 18:24:50
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
(1, 'Tinto', 200, 150, 'Westinghouse', 'Tinto', 24, 'public/media/bottles/bottle1.png', 'Vino tinto recien traido del himalaya'),
(2, 'Blanco', 300, 200, 'De la viña', 'Blanco', 109, 'public/media/bottles/bottle2.png', 'Vino blanco para acompañar un asado con amigos'),
(3, 'Escoces', 500, 350, 'Santa rosana', 'Escoces', 18, 'public/media/bottles/bottle3.png', 'Vino escocés, traido directamente de Alemania'),
(4, 'Rosado', 200, 100, 'Naturalvinos', 'Rosado', 53, 'public/media/bottles/bottle4.png', 'Vino rosado, color azul, perfecto para acompañar una sopa'),
(5, 'Tannat', 300, 200, 'Los paisanos', 'Tannat', 72, 'public/media/bottles/bottle5.png', 'Tannat, directamente traido desde tannatlandia'),
(6, 'Dulce', 350, 200, 'Las chauchas', 'Rosado dulce', 40, 'public/media/bottles/bottle6.png', 'Vino dulce elaborado con 3 kilos de miel por litro de vino'),
(7, 'Mexicano', 250, 150, 'Mexicanito', 'Tinto', 34, 'public/media/bottles/bottle7.png', 'Vino mexicano recién traido de Cataluña.'),
(8, 'Picante', 350, 300, 'Samsung', 'Picante', 52, 'public/media/bottles/bottle8.png', 'Vino picante, sabor picante. Ideal para aquellas tardes con amigos.'),
(9, 'Vino 9', 350, 277, 'Vinoman', 'Rosado', 32, 'public/media/bottles/bottle9.png', 'Un vino para toda la familia'),
(10, 'Vino 10', 300, 250, 'Vinoiss', 'Rosado', 37, '', 'Un vino magico'),
(13, 'Vinitou', 350, 250, 'Tenshinhan', 'Clarette', 24, '', 'Un vino magico'),
(14, 'Vinoprueba', 324, 245, 'Vinoman', 'Rosado', 24, '', 'Un vino para toda la familia'),
(15, 'Pruebita', 350, 277, 'Vinoman', 'Rosado', 24, '', 'Un vino para toda la familia'),
(16, 'Pruebass', 350, 250, 'Tenshinhan', 'Clarette', 40, '', 'DOSIJFOISDFJOISDJFOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `uid` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `telefono` int(16) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `rango` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`uid`, `nombre`, `correo`, `contraseña`, `telefono`, `avatar`, `rango`) VALUES
(12, 'Lujambia12', 'luli@gmail.com', '$2y$10$AzE18QwS0SXj3R3wYP2Ls.AiMhb3/oTs1r5Vi9OXYKygHBk6cywYS', 436436536, 'public/img/perfil/12.jpg', 2),
(15, 'Santiago Romero', 'elsantoposada@gmail.com', '$2y$10$Ybpc.5pRvAcjif9DeckhDuV2i9TwuzI17.Fz0kxCrQNJ1GGmaQoo.', 12345678, 'public/img/perfil/15.jpg', 1),
(20, 'Paz', 'elamor@gmail.com', '$2y$10$fVa13QOokk5tOWCi5Z8pcuYCflkD3deYp9bqHRsnKkjOB6M3as/CC', 1212121212, 'public/img/perfil/20.jpg', 1),
(30, 'Prueba', 'prueba@gmail.com', '$2y$10$7VCR6BsaiXawTfsZ2fuwfeNlRHPPNz3cSTu5sLvRSwVx9.eS8yCIO', 43342323, 'public/img/perfil/default.jpg', 1),
(37, 'JorgeGamer', 'jorgegamer@gmail.com', '$2y$10$4Ef6NiCOYL/qolyBIGzbn.IiMgvF6BRCMikDuFalyG6JrsfGtXutO', 12345678, 'public/img/perfil/default.jpg', 2),
(38, 'SantiagoXD', 'santiago@mail.com', '$2y$10$kL3q/wCpT3d0jo4edbeoLOpde.AqzMYaecUWUGBiFc6BO/CZ4zsBy', 434343434, 'public/img/perfil/default.jpg', 2),
(40, 'SoyUnCorreoXDXD', 'correo@mail.com', '$2y$10$9wKcXtNCAjkfLcaSIfyHxuKEdPpKW6kXLNvKyaSAGq2KpDGYZZEa.', 34343434, 'public/img/perfil/default.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS_Direcciones`
--

CREATE TABLE `USUARIOS_Direcciones` (
  `duid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `direccion` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS_Direcciones`
--

INSERT INTO `USUARIOS_Direcciones` (`duid`, `uid`, `direccion`) VALUES
(1, 12, 'Eduardo Montanar 355'),
(6, 12, 'Ricardo Montaner 333'),
(7, 12, 'Los tanjarinos 334'),
(8, 12, 'Direccion Pedro'),
(9, 15, 'Una direccion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS_Rangos`
--

CREATE TABLE `USUARIOS_Rangos` (
  `rid` int(2) NOT NULL,
  `nombre` varchar(16) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS_Rangos`
--

INSERT INTO `USUARIOS_Rangos` (`rid`, `nombre`, `color`) VALUES
(1, 'Admin', '#000'),
(2, 'Usuario', '#FFF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS_Tarjetas`
--

CREATE TABLE `USUARIOS_Tarjetas` (
  `tuid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `tarjeta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS_Tarjetas`
--

INSERT INTO `USUARIOS_Tarjetas` (`tuid`, `uid`, `tarjeta`) VALUES
(1, 12, '44334343434'),
(6, 12, '22222222222'),
(11, 15, '12345678');

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
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  ADD PRIMARY KEY (`duid`),
  ADD KEY `uid` (`uid`);

--
-- Indices de la tabla `USUARIOS_Rangos`
--
ALTER TABLE `USUARIOS_Rangos`
  ADD PRIMARY KEY (`rid`);

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
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  MODIFY `duid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Rangos`
--
ALTER TABLE `USUARIOS_Rangos`
  MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Tarjetas`
--
ALTER TABLE `USUARIOS_Tarjetas`
  MODIFY `tuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
