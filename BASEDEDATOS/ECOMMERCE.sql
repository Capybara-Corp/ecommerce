-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-10-2022 a las 22:53:50
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
(1, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL),
(7, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL),
(9, 34, NULL, NULL, NULL),
(10, 46, NULL, NULL, NULL),
(11, 47, NULL, NULL, NULL),
(35, 82, NULL, NULL, NULL),
(36, 83, NULL, NULL, NULL),
(37, 1, NULL, NULL, NULL),
(38, 1, NULL, NULL, NULL),
(39, 103, NULL, NULL, NULL),
(40, 104, NULL, NULL, NULL),
(41, 105, NULL, NULL, NULL),
(42, 106, NULL, NULL, NULL),
(43, 107, NULL, NULL, NULL),
(44, 108, NULL, NULL, NULL);

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
(1, 'Tinto', 200, 150, 'Westinghouse', 'Tinto', 67, 'public/media/bottles/bottle1.png', 'Vino tinto recien traido del himalaya'),
(2, 'Blanco', 300, 200, 'De la viña', 'Blanco', 99, 'public/media/bottles/bottle2.png', 'Vino blanco para acompañar un asado con amigos'),
(3, 'Escoces', 500, 350, 'Santa rosana', 'Escoces', 17, 'public/media/bottles/bottle3.png', 'Vino escocés, traido directamente de Alemania'),
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
  `contrasena` varchar(250) NOT NULL,
  `telefono` int(32) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `rango` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`uid`, `nombre`, `correo`, `contrasena`, `telefono`, `avatar`, `rango`) VALUES
(12, 'Lujambia', 'luli@gmail.com', '$2y$10$AzE18QwS0SXj3R3wYP2Ls.AiMhb3/oTs1r5Vi9OXYKygHBk6cywYS', 436436536, 'public/img/perfil/12.jpg', 1),
(15, 'Santiago Romero', 'elsantoposada@gmail.com', '$2y$10$Ybpc.5pRvAcjif9DeckhDuV2i9TwuzI17.Fz0kxCrQNJ1GGmaQoo.', 123456, 'public/img/perfil/15.jpg', 4),
(20, 'Paz', 'elamor@gmail.com', '$2y$10$fVa13QOokk5tOWCi5Z8pcuYCflkD3deYp9bqHRsnKkjOB6M3as/CC', 1212121212, 'public/img/perfil/20.jpg', 1),
(30, 'Prueba', 'prueba@gmail.com', '$2y$10$7VCR6BsaiXawTfsZ2fuwfeNlRHPPNz3cSTu5sLvRSwVx9.eS8yCIO', 43342323, 'public/img/perfil/default.jpg', 1),
(37, 'JorgeGamer', 'jorgegamer@gmail.com', '$2y$10$4Ef6NiCOYL/qolyBIGzbn.IiMgvF6BRCMikDuFalyG6JrsfGtXutO', 12345678, 'public/img/perfil/default.jpg', 2),
(38, 'SantiagoXD', 'santiago@mail.com', '$2y$10$kL3q/wCpT3d0jo4edbeoLOpde.AqzMYaecUWUGBiFc6BO/CZ4zsBy', 434343434, 'public/img/perfil/default.jpg', 2),
(40, 'SoyUnCorreoXDXD', 'correo@mail.com', '$2y$10$9wKcXtNCAjkfLcaSIfyHxuKEdPpKW6kXLNvKyaSAGq2KpDGYZZEa.', 34343434, 'public/img/perfil/default.jpg', 2),
(52, 'Juancitogamer', 'juancito23@gmail.com', '$2y$10$5aPEOdzGxREFDMcMHdn1Xu5Oo8cDdnQlywpCC/IyEjQYAoZsc1rGm', 435435345, 'public/img/perfil/default.jpg', 2),
(54, 'Pepito de las tinieblas', 'pepeperez@gmail.com', '$2y$10$35MjLISwGW8SZRVBmIDM7OwOpTPclorvJdg6PVEzfjIj01zHvG4re', 1234567812, 'public/img/perfil/default.jpg', 2),
(55, 'Daniel Carrasco', 'dhcarrasco@gmail.com', '$2y$10$6WSP4Xu1ABPzVjN076zSaOv4YFHWPKuh0QxqJQOYO6VE.XE74.Fxq', 123456789, 'public/img/perfil/55.jpg', 3);

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
(10, 15, 'Enrique Zegoviano'),
(30, 12, 'Enrique Zegoviano');

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
(11, 15, '12345678'),
(13, 15, '12341222'),
(14, 15, '12341222'),
(15, 15, '11111'),
(16, 12, '2222222');

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
(1, 15, '2008-11-11', 106),
(2, 15, '2008-11-11', 105),
(3, 15, '2008-11-11', 1),
(4, 15, '2008-11-11', 3),
(5, 15, '2008-11-11', 2),
(6, 15, '2008-11-11', 1),
(7, 15, '2008-11-11', 1),
(8, 15, '2008-11-11', 1),
(9, 15, '2008-11-11', 1),
(10, 15, '2008-11-11', 19800),
(11, 15, '2008-11-11', 19400),
(12, 15, '2008-11-11', 0),
(13, 15, '2008-11-11', 18600),
(14, 15, '2008-11-11', 18200),
(15, 15, '2008-11-11', 18000),
(16, 15, '2008-11-11', 200),
(17, 15, '2008-11-11', 400),
(18, 15, '2008-11-11', 900),
(19, 15, '2008-11-11', 400),
(20, 15, '2008-11-11', 400),
(21, 15, '2008-11-11', 400),
(22, 15, '2008-11-11', 400),
(23, 15, '2008-11-11', 400),
(24, 15, '2008-11-11', 400),
(25, 15, '2008-11-11', 400),
(26, 15, '2008-11-11', 400),
(27, 15, '2008-11-11', 400),
(28, 15, '2008-11-11', 200),
(29, 15, '2008-11-11', 400),
(30, 15, '2008-11-11', 300),
(31, 15, '2008-11-11', 400),
(32, 15, '2008-11-11', 400),
(33, 15, '2008-11-11', 400),
(34, 15, '2008-11-11', 400),
(35, 15, '2008-11-11', 400),
(36, 15, '2008-11-11', 400),
(37, 15, '2008-11-11', 400),
(38, 15, '2008-11-11', 400),
(39, 15, '2008-11-11', 400),
(40, 15, '2008-11-11', 400),
(41, 15, '2008-11-11', 400),
(42, 15, '2008-11-11', 400),
(43, 15, '2008-11-11', 400),
(44, 15, '2008-11-11', 400),
(45, 15, '2008-11-11', 400),
(46, 15, '2008-11-11', 400),
(47, 15, '2008-11-11', 200),
(48, 15, '2008-11-11', 400),
(49, 15, '2008-11-11', 400),
(50, 15, '2008-11-11', 400),
(51, 15, '2008-11-11', 400),
(52, 15, '2008-11-11', 200),
(53, 15, '2008-11-11', 400),
(54, 15, '2008-11-11', 400),
(55, 15, '2008-11-11', 400),
(56, 15, '2008-11-11', 400),
(57, 15, '2008-11-11', 400),
(58, 15, '2008-11-11', 400),
(59, 15, '2008-11-11', 400),
(60, 15, '2008-11-11', 400),
(61, 15, '2008-11-11', 400),
(62, 15, '2008-11-11', 400),
(63, 15, '2008-11-11', 200),
(64, 15, '2008-11-11', 200),
(65, 15, '2008-11-11', 200),
(66, 15, '2008-11-11', 200),
(67, 15, '2008-11-11', 200),
(68, 15, '2008-11-11', 200),
(69, 15, '2008-11-11', 200),
(70, 15, '2008-11-11', 200),
(71, 15, '2008-11-11', 200),
(72, 15, '2008-11-11', 200),
(73, 15, '2008-11-11', 200),
(74, 15, '2008-11-11', 200),
(75, 15, '2008-11-11', 200),
(76, 15, '2008-11-11', 200),
(77, 15, '2008-11-11', 200),
(78, 15, '2008-11-11', 200),
(79, 15, '2008-11-11', 200),
(80, 15, '2008-11-11', 200),
(81, 15, '2008-11-11', 200),
(82, 15, '2008-11-11', 200),
(83, 15, '2008-11-11', 400),
(84, 15, '2008-11-11', 200),
(85, 15, '2008-11-11', 400),
(86, 15, '2008-11-11', 200),
(91, 15, '2008-11-11', 200),
(92, NULL, '2008-11-11', NULL),
(93, NULL, '2022-11-11', NULL),
(94, NULL, '2022-11-11', NULL),
(95, NULL, '2022-11-11', NULL),
(96, NULL, NULL, 223),
(97, 15, '2008-11-11', 200),
(98, 15, '2008-11-11', 200),
(99, 15, '2008-11-11', 200),
(100, 15, '2008-11-11', 200),
(101, 15, '2008-11-11', 200),
(102, 15, '2008-11-11', 200),
(103, 15, '2008-11-11', 200),
(104, 15, '2008-11-11', 400),
(105, 15, '2008-11-11', 200),
(106, 15, '2008-11-11', 300),
(107, 15, '2008-11-11', 200),
(108, 15, '2008-11-11', 600);

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
  MODIFY `dvid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `PRODUCTOS`
--
ALTER TABLE `PRODUCTOS`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `USUARIOS`
--
ALTER TABLE `USUARIOS`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Direcciones`
--
ALTER TABLE `USUARIOS_Direcciones`
  MODIFY `duid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Rangos`
--
ALTER TABLE `USUARIOS_Rangos`
  MODIFY `rid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `USUARIOS_Tarjetas`
--
ALTER TABLE `USUARIOS_Tarjetas`
  MODIFY `tuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `VENTAS`
--
ALTER TABLE `VENTAS`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

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
