-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 10-11-2022 a las 16:46:12
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

--
-- Volcado de datos para la tabla `DETALLEVENTA`
--

INSERT INTO `DETALLEVENTA` (`dvid`, `vid`, `pid`, `cantidad`, `subtotal`) VALUES
(252, 399, 2, 2, 600),
(253, 399, 1, 3, 600),
(254, 400, 1, 1, 200),
(255, 401, 5, 4, 1200),
(256, 402, 5, 4, 1200),
(257, 402, 6, 2, 700),
(258, 403, 4, 1, 200),
(259, 403, 4, 2, 400),
(260, 403, 1, 2, 400),
(261, 403, 2, 2, 600),
(262, 405, 2, 1, 300),
(263, 405, 4, 2, 400),
(264, 405, 5, 1, 300),
(265, 405, 6, 1, 350),
(266, 406, 1, 2, 400),
(267, 406, 2, 2, 600),
(268, 407, 1, 2, 400),
(269, 407, 2, 3, 900),
(270, 407, 4, 1, 200),
(271, 408, 2, 2, 600),
(272, 408, 5, 1, 300),
(273, 408, 6, 1, 350),
(274, 408, 4, 2, 400),
(275, 410, 2, 2, 600),
(276, 411, 2, 1, 300),
(277, 411, 4, 2, 400),
(278, 411, 17, 4, 4800),
(279, 413, 17, 4, 4800),
(280, 414, 17, 3, 3600),
(281, 415, 17, 2, 2400),
(282, 416, 6, 2, 700),
(283, 417, 17, 3, 3600),
(284, 418, 17, 2, 2400),
(285, 419, 17, 6, 7200),
(286, 420, 17, 4, 4800),
(287, 421, 17, 12, 14400),
(288, 422, 17, 4, 4800),
(289, 423, 17, 9, 10800);

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
(1, 'Tinto', 200, 150, 'Westinghouse', 'Tinto', 1158, 'public/media/bottles/bottle1.png', 'Vino tinto recien traido del himalaya'),
(2, 'Blanco', 300, 200, 'De la viña', 'Blanco', 1451, 'public/media/bottles/bottle2.png', 'Vino blanco para acompañar un asado con amigos'),
(3, 'Escoces', 500, 350, 'Santa rosana', 'Escoces', 0, 'public/media/bottles/bottle3.png', 'Vino escocés, traido directamente de Alemania'),
(4, 'Rosado', 200, 100, 'Naturalvinos', 'Rosado', 29, 'public/media/bottles/bottle4.png', 'Corta descripcion'),
(5, 'Tannat', 300, 200, 'Los paisanos', 'Tannat', 60, 'public/media/bottles/bottle5.png', 'Tannat, directamente traido desde tannatlandia'),
(6, 'Dulce', 350, 200, 'Las chauchas', 'Rosado dulce', 25, 'public/media/bottles/bottle6.png', 'Vino dulce elaborado con 3 kilos de miel por litro de vino'),
(7, 'Mexicano', 250, 150, 'Mexicanito', 'Tinto', 34, 'public/media/bottles/bottle7.png', 'Vino mexicano recién traido de Cataluña.'),
(8, 'Picante', 350, 300, 'Samsung', 'Picante', 52, 'public/media/bottles/bottle8.png', 'Vino picante, sabor picante. Ideal para aquellas tardes con amigos.'),
(9, 'Vino 9', 350, 277, 'Vinoman', 'Rosado', 32, 'public/media/bottles/bottle9.png', 'Un vino para toda la familia'),
(10, 'Vino 10', 300, 250, 'Vinoiss', 'Rosado', 37, '', 'Un vino magico'),
(13, 'Vinitou', 350, 250, 'Tenshinhan', 'Clarette', 24, '', 'Un vino magico'),
(14, 'Vinoprueba', 324, 245, 'Vinoman', 'Rosado', 24, '', 'Un vino para toda la familia'),
(15, 'Pruebita', 350, 277, 'Vinoman', 'Rosado', 24, '', 'Un vino para toda la familia'),
(16, 'Pruebass', 350, 250, 'Tenshinhan', 'Clarette', 40, '', 'DOSIJFOISDFJOISDJFOS'),
(17, 'Vodka', 1200, 30, 'Para machos', 'Vodka', 67, 'public/media/bottles/bottle17.png', 'No apta para betas. ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE `USUARIOS` (
  `uid` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contrasena` varchar(250) NOT NULL,
  `telefono` int(32) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `rango` int(2) NOT NULL,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`uid`, `nombre`, `correo`, `contrasena`, `telefono`, `avatar`, `rango`, `estado`) VALUES
(12, 'Lujambia', 'luli@gmail.com', '$2y$10$AzE18QwS0SXj3R3wYP2Ls.AiMhb3/oTs1r5Vi9OXYKygHBk6cywYS', 436436536, 'public/img/perfil/12.jpg', 3, 1),
(15, 'PPPPP', 'elsantoposada@gmail.com', '$2y$10$Ybpc.5pRvAcjif9DeckhDuV2i9TwuzI17.Fz0kxCrQNJ1GGmaQoo.', 123456, 'public/img/perfil/15.jpg', 4, 1),
(20, 'Paz', 'elamor@gmail.com', '$2y$10$fVa13QOokk5tOWCi5Z8pcuYCflkD3deYp9bqHRsnKkjOB6M3as/CC', 1212121212, 'public/img/perfil/20.jpg', 1, 1),
(30, 'Prueba', 'prueba@gmail.com', '$2y$10$7VCR6BsaiXawTfsZ2fuwfeNlRHPPNz3cSTu5sLvRSwVx9.eS8yCIO', 43342323, 'public/img/perfil/default.jpg', 1, 1),
(38, 'SantiagoXD', 'santiago@mail.com', '$2y$10$kL3q/wCpT3d0jo4edbeoLOpde.AqzMYaecUWUGBiFc6BO/CZ4zsBy', 434343434, 'public/img/perfil/default.jpg', 2, 1),
(40, 'SoyUnCorreoXDXD', 'correo@mail.com', '$2y$10$9wKcXtNCAjkfLcaSIfyHxuKEdPpKW6kXLNvKyaSAGq2KpDGYZZEa.', 34343434, 'public/img/perfil/default.jpg', 2, 1),
(52, 'Juancitogamer', 'juancito23@gmail.com', '$2y$10$5aPEOdzGxREFDMcMHdn1Xu5Oo8cDdnQlywpCC/IyEjQYAoZsc1rGm', 435435345, 'public/img/perfil/default.jpg', 2, 1),
(54, 'Pepito de las tinieblas', 'pepeperez@gmail.com', '$2y$10$35MjLISwGW8SZRVBmIDM7OwOpTPclorvJdg6PVEzfjIj01zHvG4re', 1234567812, 'public/img/perfil/default.jpg', 2, 2),
(55, 'Daniel Carrasco', 'dhcarrasco@gmail.com', '$2y$10$6WSP4Xu1ABPzVjN076zSaOv4YFHWPKuh0QxqJQOYO6VE.XE74.Fxq', 123456789, 'public/img/perfil/55.jpg', 3, 1),
(67, 'Las tetas de la virgen', 'lastetasdelavirgen@gmail.com', '$2y$10$Ye.RVTtGZZVnVBtZLl7wU.5OxaNODOqOAkNGLHlqmfAGKetzXvXvW', 12345678, 'public/img/perfil/default.jpg', 2, 1),
(68, 'La Rata', 'elraton@gmail.com', '$2y$10$zhEsdomdp.10ZcGzLUFEGeKuVtgRpew3HqRYMQ8P58ppP7udMsGaC', 12345678, 'public/img/perfil/default.jpg', 2, 1),
(69, 'La Rata 2', 'larata2@gmail.com', '$2y$10$yzsOEA3uXbwFnpHC7z6kAOhnUBUAO83Kj8A7Lv27Narsv46gz4vYi', 44334433, 'public/img/perfil/default.jpg', 3, 1),
(70, 'MACHO MAN', 'machoman@gmail.com', '$2y$10$QZLwBGNsPXzku0XiQZnr.OBo4MWlSx0ocH3A4P8kocxQNWPKywQvy', 453567676, 'public/img/perfil/70.jpg', 4, 1),
(71, 'Mariposon Huhu', 'mariposon@gmail.com', '$2y$10$lXjXzPHCjzFLkBrK/s4H2.NX2O2T1BuY4rk3OtWPX2zT66StY3XIG', 12345678, 'public/img/perfil/default.jpg', 2, 1);

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
(30, 12, 'Enrique Zegoviano'),
(32, 12, 'Direccion 1'),
(33, 12, 'Direccion 2'),
(34, 12, 'Direccion 3'),
(35, 12, 'XXXTENTACION'),
(36, 12, 'XXXTENTACION2'),
(37, 12, 'Direccion 4'),
(38, 12, 'Direccion 6'),
(39, 12, 'Direccion 333'),
(40, 12, 'Pepe con papas'),
(41, 12, 'el loco'),
(42, 12, 'la direcaoo'),
(43, 55, 'La casa de las ilusiones'),
(44, 12, '213213213'),
(45, 12, '213213213'),
(46, 12, '213213213'),
(47, 70, 'Macho Landia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS_Estado`
--

CREATE TABLE `USUARIOS_Estado` (
  `eid` int(2) NOT NULL,
  `nombre` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS_Estado`
--

INSERT INTO `USUARIOS_Estado` (`eid`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

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
(1, 'Admin', '#B6B6B6'),
(2, 'Usuario', '#FFF'),
(3, 'Emperador', '#E5E200'),
(4, 'Supremo Lider', '#000');

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
(16, 12, '2222222'),
(63, 15, '123213'),
(65, 12, 'dsadasdasdsadasdasdasdasd'),
(66, 12, 'dsadasdasdsadasdasdasdasd'),
(67, 12, '2211221231123'),
(68, 12, '2211221231123'),
(69, 12, '2211221231123'),
(70, 12, '13123123123123'),
(71, 12, '13123123123123'),
(72, 12, '13123123123123'),
(73, 12, '13123123123123'),
(74, 12, 'asdasdasd'),
(75, 12, 'asdasdasd'),
(76, 12, 'sadasdasd'),
(77, 12, 'sadasdasd'),
(78, 12, 'sadasdasd'),
(79, 12, '12345678'),
(80, 12, '22222'),
(81, 12, '223232323'),
(82, 12, 'dasdfdfssdfsdfsdfdsf');

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
-- Volcado de datos para la tabla `VENTAS`
--

INSERT INTO `VENTAS` (`vid`, `uid`, `Fecha`, `Total`) VALUES
(399, 15, '2022-11-02', 1200),
(400, 15, '2022-11-03', 200),
(401, 15, '2022-11-03', 1200),
(402, 15, '2022-11-03', 1900),
(403, 15, '2022-11-03', 200),
(405, 55, '2022-11-05', 1350),
(406, 55, '2022-11-05', 1000),
(407, 12, '2022-11-05', 1500),
(408, 52, '2022-11-05', 1250),
(410, 70, '2022-11-10', 600),
(411, 71, '2022-11-10', 700),
(413, 70, '2022-11-10', 4800),
(414, 70, '2022-11-10', 3600),
(415, 55, '2022-11-10', 2400),
(416, 70, '2022-11-10', 700),
(417, 70, '2022-11-10', 3600),
(418, 70, '2022-11-10', 2400),
(419, 70, '2022-11-10', 7200),
(420, 70, '2022-11-10', 4800),
(421, 70, '2022-11-10', 14400),
(422, 70, '2022-11-10', 4800),
(423, 70, '2022-11-10', 10800);

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
-- Indices de la tabla `USUARIOS_Estado`
--
ALTER TABLE `USUARIOS_Estado`
  ADD PRIMARY KEY (`eid`);

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
  MODIFY `dvid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT de la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  MODIFY `duid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Estado`
--
ALTER TABLE `USUARIOS_Estado`
  MODIFY `eid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Rangos`
--
ALTER TABLE `USUARIOS_Rangos`
  MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Tarjetas`
--
ALTER TABLE `USUARIOS_Tarjetas`
  MODIFY `tuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

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
