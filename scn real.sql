-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-07-2015 a las 22:47:37
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `scn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_categoria` varchar(50) NOT NULL,
  `descripcion_categoria` varchar(200) NOT NULL DEFAULT 'N/D',
  `estado_categoria` int(1) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `estado_categoria`) VALUES
(1, 'Jabón en Barra', '', 0),
(2, 'Jabón Líquido', '', 0),
(3, 'Crema Corporal', '', 0),
(4, 'Jabón Líquido repuesto', '', 0),
(5, 'Protector Labial', '', 0),
(6, 'Hidratante Refrescante', '', 0),
(7, 'Loción Protectora', '', 0),
(8, 'Lápiz Labial', '', 0),
(9, 'Shampoo', '', 0),
(10, 'Acondicionador', '', 0),
(11, 'Shampoo repuesto', '', 0),
(12, 'Acondicionador repuesto', '', 0),
(13, 'Perfumería Hombre', '', 0),
(14, 'Perfumería Mujer', '', 0),
(15, 'Desodorante Spray', '', 0),
(16, 'Desodorante Roll-on', '', 0),
(17, 'Desodorante Crema', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_compra` date NOT NULL,
  `hora_compra` time NOT NULL,
  `estado_compra` int(1) NOT NULL,
  PRIMARY KEY (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE IF NOT EXISTS `detalle_compra` (
  `id_detalle_compra` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` bigint(13) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_compra`),
  KEY `id_producto` (`codigo_producto`,`id_compra`),
  KEY `id_compra` (`id_compra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE IF NOT EXISTS `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` bigint(13) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  PRIMARY KEY (`id_detalle_venta`),
  KEY `codigo_producto` (`codigo_producto`,`id_venta`),
  KEY `id_venta` (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE IF NOT EXISTS `linea` (
  `id_linea` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_linea` varchar(50) NOT NULL,
  `descripcion_linea` varchar(200) NOT NULL DEFAULT 'N/D',
  `estado_linea` int(1) NOT NULL,
  PRIMARY KEY (`id_linea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`id_linea`, `nombre_linea`, `descripcion_linea`, `estado_linea`) VALUES
(1, 'Tododia', '', 0),
(2, 'Ekos', '', 0),
(3, 'Higeia', '', 0),
(4, 'Erva Doce', '', 0),
(5, 'Essencial', '', 0),
(6, 'Chronos', '', 0),
(7, 'Fotoequilibrio', '', 0),
(8, 'Una', '', 0),
(9, 'Aquarela', '', 0),
(10, 'Faces', '', 0),
(11, 'Sève', '', 0),
(12, 'Mamá y Bebé', '', 0),
(13, 'Naturé', '', 0),
(14, 'Plant', '', 0),
(15, 'Creer Para Ver', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `codigo_producto` bigint(13) NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_linea` int(11) NOT NULL,
  `descripcion_producto` varchar(200) NOT NULL DEFAULT 'N/D',
  `stock_producto` int(11) NOT NULL DEFAULT '0',
  `bajo_stock` int(11) NOT NULL DEFAULT '0',
  `sobre_stock` int(11) NOT NULL DEFAULT '0',
  `estado_producto` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`codigo_producto`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_linea` (`id_linea`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo_producto`, `nombre_producto`, `id_categoria`, `id_linea`, `descripcion_producto`, `stock_producto`, `bajo_stock`, `sobre_stock`, `estado_producto`) VALUES
(7898506875436, 'Jabón Delicada Frescura', 2, 3, 'Jabón íntimo 200ml', 0, 0, 0, 0),
(7898506875443, 'Jabón Delicada Frescura', 4, 3, 'Jabón íntimo 200ml', 0, 0, 0, 0),
(7898506877263, 'Jabón Cremoso Puro Vegetal', 1, 4, 'Jabón de tocador 90g x 3', 0, 0, 0, 0),
(7898506884919, 'Jabón para el cuerpo', 2, 4, 'Jabón 200ml', 0, 0, 0, 0),
(7898528409695, 'Jabón Orquídea', 1, 1, 'Jabón de tocador 90g x 2', 0, 0, 0, 0),
(7898532694520, 'Jabón Suave Confort', 4, 3, 'Jabón íntimo 200ml', 0, 0, 0, 0),
(7898532694537, 'Jabón Suave Confort', 2, 3, 'Jabón íntimo 200ml', 0, 0, 0, 0),
(7898532699723, 'Jabón Surtido CCCM', 1, 2, 'Jabón de tocador 100g x 4', 0, 0, 0, 0),
(7898548802964, 'Jabón Pitanga', 1, 2, 'Jabón de tocador 100g', 0, 0, 0, 0),
(7898548802971, 'Jabón Surtido MvBMP', 1, 2, 'Jabón de tocador 100g x 4', 0, 0, 0, 0),
(7898548802995, 'Jabón Surtido PABM', 1, 2, 'Jabón de tocador 100g x 4', 0, 0, 0, 0),
(7898548803152, 'Jabón Pitanga', 2, 2, 'Jabón exfoliante 200ml', 0, 0, 0, 0),
(7898548808003, 'Protector Labial FPS 50', 5, 7, 'Labial Hidratante 5g', 0, 0, 0, 0),
(7899563201299, 'Jabón Lija Acaí', 1, 2, 'Jabón de tocador 100g', 0, 0, 0, 0),
(7899563201657, 'Jabón Algodón', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563201664, 'Jabón Mora y Almendras', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563201688, 'Jabón Orquídea', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563201695, 'Jabón Cereza y Avellana', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563211045, 'Jabón Avellana y Granada', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563217672, 'Protector FPS 30', 7, 7, 'Loción 120ml', 0, 0, 0, 0),
(7899563217696, 'Pos Sol', 6, 7, 'Crema Hidratante 120ml', 0, 0, 0, 0),
(7899563217740, 'Protector Niño FPS 30', 7, 7, 'Loción 120ml', 0, 0, 0, 0),
(7899563217764, 'Protector Niño FPS 50', 7, 7, 'Loción 120ml', 0, 0, 0, 0),
(7899563217788, 'Lápiz Labial FPS 50', 8, 7, 'Lápiz Labial 5g', 0, 0, 0, 0),
(7899563217795, 'Protector Facial FPS 30', 7, 7, 'Loción 50ml', 0, 0, 0, 0),
(7899563217818, 'Protector Facial FPS 50', 7, 7, 'Loción 50ml', 0, 0, 0, 0),
(7899563217832, 'Protector Facial Bebé FPS 50', 7, 7, 'Loción 50ml', 0, 0, 0, 0),
(7899563234785, 'Jabón Surtido AJBAFF', 1, 1, 'Jabón de tocador 90g x 6', 0, 0, 0, 0),
(7899563240304, 'Jabón Lavanda y Vainilla', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563242803, 'Jabón Frutas Tropicales', 1, 1, 'Jabón de tocador 90g x 5', 0, 0, 0, 0),
(7899563242810, 'Jabón Cremoso Surtido AC', 1, 2, 'Jabón en gajos 200g x 2', 0, 0, 0, 0),
(7899563833704, 'Exfoliante Jazmín', 3, 1, 'Crema exfoliante 190g', 0, 0, 0, 0),
(7899563834374, 'Jabón Exclusivo Floral', 1, 5, 'Jabón de tocador 90g x 3', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(2) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `user`, `pass`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_venta` date NOT NULL,
  `hora_venta` time NOT NULL,
  `estado_venta` int(1) NOT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_3` FOREIGN KEY (`codigo_producto`) REFERENCES `producto` (`codigo_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_venta_ibfk_3` FOREIGN KEY (`codigo_producto`) REFERENCES `producto` (`codigo_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_linea`) REFERENCES `linea` (`id_linea`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
