-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2015 a las 22:45:58
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bestnid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
`idCategoria` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` longtext
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombre`, `descripcion`) VALUES
(3, 'ElectrodomÃ©sticos', 'Cualquier electrodomÃ©stico'),
(4, 'Otros', 'Cualquier producto que no estÃ© dentro de las otras categorias					'),
(5, 'Deportes', 'indumentaria deportiva, artÃ­culos deportivos, entre otros'),
(8, 'ElectrÃ³nica', 'Todo tipo de dispositivos electrÃ³nicos'),
(9, 'Indumentaria', 'Cualquier tipo de indumentaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`idComentario` int(11) NOT NULL,
  `texto` longtext NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSubasta` int(11) NOT NULL,
  `respuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
`idClave` int(11) NOT NULL,
  `clave` varchar(60) NOT NULL,
  `valor` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idClave`, `clave`, `valor`) VALUES
(1, 'administrador', 'admin'),
(2, 'porcentaje', '15'),
(3, 'duracion_maxima', '10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
`idOferta` int(11) NOT NULL,
  `razon` longtext NOT NULL,
  `monto` bigint(20) NOT NULL,
  `fecha` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idSubasta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`idOferta`, `razon`, `monto`, `fecha`, `idUsuario`, `idSubasta`) VALUES
(5, 'soy coleccionista de pelotas', 100, '2015-06-01', 28, 11),
(6, 'Necesito una mesa para la cocina', 40, '2015-06-02', 15, 7),
(7, 'Necesito un escritorio', 500, '2015-06-03', 16, 7),
(8, 'la que tengo quedo chica', 200, '2015-06-03', 23, 7),
(9, 'Se me pinchÃ³ mi pelota', 100, '2015-06-03', 15, 10),
(10, 'Quiero decorar mi casa', 600, '2015-06-03', 15, 11),
(11, 'prueba de necesidad', 20, '2015-06-03', 15, 12),
(12, 'Necesito hacer un regalo', 200, '2015-06-03', 21, 10),
(13, 'prueba de necesidad 2', 100, '2015-06-03', 21, 12),
(14, 'Tenia una pelota igual', 1000, '2015-06-03', 27, 10),
(15, 'Me robaron un televisor de mi casa', 200, '2015-06-03', 23, 13),
(16, 'Otra necesidad', 300, '2015-06-03', 28, 10),
(17, 'Tengo una igual y necesito otra mas', 900, '2015-06-03', 27, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
`idProducto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` longtext,
  `idCategoria` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombre`, `descripcion`, `idCategoria`, `imagen`) VALUES
(8, 'mesa', 'mesa de madera', 4, 'Imagenes/mesa.JPG'),
(9, 'logo bestnid', 'logo de la Empresa Bestnid', 4, 'Imagenes/logo.png'),
(10, 'cuadro', 'cuadro de paisaje', 4, 'Imagenes/paisaje_verde.jpg'),
(11, 'pelota de futbol', 'pelota de futbol adidas impecable', 4, 'Imagenes/pelota adidas.png'),
(12, 'Balon de oro', 'Balon de oro temporada 2011', 4, 'Imagenes/balon de oro.PNG'),
(13, 'prueba', 'prueba con imagen alta', 4, 'Imagenes/imagen_alta.jpg'),
(14, 'televisor', 'televisor antigÃ¼o de 20 pulgadas', 8, 'Imagenes/televisor.jpg'),
(15, 'raqueta de tenis', 'descripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion largadescripcion larga', 5, 'Imagenes/raqueta de tenis.jpg'),
(16, 'microondas', 'microondas nuevo con botones marca whirpool', 5, 'Imagenes/microondas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subasta`
--

CREATE TABLE IF NOT EXISTS `subasta` (
`idSubasta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fecha_cierre` date NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `fecha_realizacion` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `subasta`
--

INSERT INTO `subasta` (`idSubasta`, `idUsuario`, `estado`, `fecha_cierre`, `idProducto`, `fecha_realizacion`) VALUES
(7, 14, 'cerrada', '2015-05-06', 8, '0000-00-00'),
(8, 14, 'cerrada', '2015-06-06', 9, '0000-00-00'),
(9, 14, 'cerrada', '2015-04-06', 10, '0000-00-00'),
(10, 14, 'cerrada', '2015-06-03', 11, '2015-05-30'),
(11, 14, 'cerrada', '2015-06-03', 12, '2015-05-30'),
(12, 14, 'activa', '2015-06-13', 13, '2015-06-01'),
(13, 27, 'activa', '2015-06-04', 14, '2015-06-03'),
(14, 23, 'activa', '2015-06-06', 15, '2015-06-03'),
(15, 27, 'activa', '2015-06-06', 16, '2015-06-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `numero_calle` varchar(10) NOT NULL,
  `nombre_usuario` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `e_mail` varchar(50) NOT NULL,
  `confirmado` tinyint(1) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `piso` varchar(1) DEFAULT NULL,
  `depto` varchar(1) DEFAULT NULL,
  `calle` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `telefono`, `numero_calle`, `nombre_usuario`, `password`, `e_mail`, `confirmado`, `estado`, `piso`, `depto`, `calle`) VALUES
(14, 'Juan', 'Gardey', '02923698276', '723', 'snake200', 'Juan123', 'juancruzgardey@hotmail.com', 0, 'activo', '6', 'B', '60'),
(15, 'Juan', 'Filameno', '02923698271', '543', 'juanf', 'Juanf12', 'juanf@hotmail.com', 0, 'activo', '', '', '45'),
(16, 'ariel', 'sobrado', '02923698271', '1', 'asobrado', 'Adminadmin1', 'asobrado@gmail.com', 0, 'activo', '1', 'w', 'q'),
(21, 'Juan', 'Iriarte', '02923698271', '723', 'jiriarte', 'Juan123', 'juancruzgardey@gmail.com', 0, 'activo', '6', 'B', '60'),
(23, 'Ignacio', 'Tempo', '02922465011', '456', 'itempo', 'Itempo123', 'ignaciot@gmail.com', 0, 'activo', '', '', 'EspaÃ±a'),
(24, 'Victor', 'Estrella', '02923698271', '8', 'vestrella', 'Vestrella123', 'victore@hotmail.com', 0, 'activo', '2', 'C', '450'),
(26, 'Pete ', 'Sampras', '0291235467', '768', 'psampras', 'Pete123', 'pete@yahoo.com', 0, 'activo', '2', 'A', '2'),
(27, 'David', 'Nalbandian', '02922465011', '270', 'admin', 'David123', 'david@yahoo.com', 0, 'activo', '', '', '25 de mayo'),
(28, 'virginia', 'bertuzzi', '2923416328', '518', 'virginiabertuzz', 'Virginiabertuzzi1!', 'virgibertuzzi@gmail.com', 0, 'activo', '1', 'E', '47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
`idVenta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `porcentaje` int(11) NOT NULL,
  `idOferta` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idVenta`, `fecha`, `porcentaje`, `idOferta`) VALUES
(1, '2015-06-03', 15, 7),
(2, '2015-06-03', 15, 12),
(4, '2015-06-03', 15, 10);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
 ADD PRIMARY KEY (`idCategoria`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`idComentario`), ADD KEY `idUsuario` (`idUsuario`), ADD KEY `idSubasta` (`idSubasta`), ADD KEY `respuesta` (`respuesta`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
 ADD PRIMARY KEY (`idClave`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
 ADD PRIMARY KEY (`idOferta`), ADD KEY `idUsuario` (`idUsuario`), ADD KEY `idSubasta` (`idSubasta`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`idProducto`), ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `subasta`
--
ALTER TABLE `subasta`
 ADD PRIMARY KEY (`idSubasta`), ADD KEY `idUsuario` (`idUsuario`), ADD KEY `subasta_ibfk_2_idx` (`idProducto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`idUsuario`), ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`), ADD UNIQUE KEY `e_mail` (`e_mail`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
 ADD PRIMARY KEY (`idVenta`), ADD KEY `idOferta` (`idOferta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
MODIFY `idClave` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
MODIFY `idOferta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `subasta`
--
ALTER TABLE `subasta`
MODIFY `idSubasta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`idSubasta`) REFERENCES `subasta` (`idSubasta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `comentario_ibfk_3` FOREIGN KEY (`respuesta`) REFERENCES `comentario` (`idComentario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
ADD CONSTRAINT `oferta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `oferta_ibfk_2` FOREIGN KEY (`idSubasta`) REFERENCES `subasta` (`idSubasta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subasta`
--
ALTER TABLE `subasta`
ADD CONSTRAINT `subasta_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `subasta_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idOferta`) REFERENCES `oferta` (`idOferta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
