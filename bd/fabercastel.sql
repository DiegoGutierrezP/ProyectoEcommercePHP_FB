-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-10-2021 a las 01:31:07
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fabercastel`
--
CREATE DATABASE IF NOT EXISTS `fabercastel` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fabercastel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_produc` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_produc` (`id_produc`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_usuario` int(11) DEFAULT NULL,
  `categoria_usu` int(11) DEFAULT NULL,
  `nombres` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domicilio` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `categoria_usu` (`categoria_usu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_usuario`, `categoria_usu`, `nombres`, `apellidos`, `email`, `ciudad`, `distrito`, `domicilio`, `sexo`) VALUES
(1, 3, 'pepe manuel', 'flores enrique', 'pepe24@gmail.com', 'Lima', 'Surco', 'av. benavides 1987', 'Hombre'),
(2, 3, 'Jose', 'Ramirez Gonzal', 'asdad@gmail.com', '', '', '', 'Hombre'),
(3, 3, 'carmen', 'pineda jaimes', 'camucha1223@gmail.com', 'Lima', 'San Juan de Lurigancho', 'av. las flores 21', 'Mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `direccion_envio` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodopago` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `metodoenvio` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `estado_actual` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `id_usuario`, `direccion_envio`, `fecha`, `total`, `metodopago`, `metodoenvio`, `estado_actual`) VALUES
(1, 3, 'av las flores 21', '2021-10-26 03:04:40', '64.00', 'tarjeta', 'transporte', 'Pago Procesado'),
(2, 3, 'Lima San Juan de Lurigancho av. las flores 19', '2021-10-26 03:07:59', '226.50', 'tarjeta', 'transporte', 'Pago Procesado'),
(3, 3, 'Lima San Juan de Lurigancho av. las flores 22', '2021-10-27 02:24:47', '858.80', 'paypal', 'transporte', 'Pago Procesado'),
(4, 1, 'Lima Surco av. benavides 123', '2021-10-27 15:38:10', '244.80', 'tarjeta', 'transporte', 'Pago Procesado'),
(5, 1, 'Lima Surco av. benavides 130', '2021-10-28 02:33:52', '299.38', 'transferencia', 'transporte', 'Pago Procesado'),
(6, 3, 'Lima San Juan de Lurigancho av. las flores 21', '2021-10-28 18:41:01', '1452.00', 'tarjeta', 'transporte', 'Pago Procesado'),
(7, 1, 'Lima Surco av. benavides 1987', '2021-10-29 17:41:33', '378.00', 'paypal', 'transporte', 'Pago Procesado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

DROP TABLE IF EXISTS `pedido_detalle`;
CREATE TABLE IF NOT EXISTS `pedido_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `precio_producto` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id`, `id_pedido`, `id_producto`, `nombre_producto`, `precio_producto`, `cantidad`, `precio_total`) VALUES
(1, 1, 42, 'Crayones Kinder Cohete en seis colores', '9.30', 1, '9.30'),
(2, 1, 46, 'Óleo Pastel estuche rígido x 36 colores', '24.40', 1, '24.40'),
(3, 1, 86, 'Engrapador metálico alicate P-101 color gris', '30.30', 1, '30.30'),
(4, 2, 27, 'Afilalápices Grip 2001 c/triple depósito, metálico plateado', '13.70', 1, '13.70'),
(5, 2, 11, 'Estuche con 12 rotuladores Pitt Artist Pen brush', '131.10', 1, '131.10'),
(6, 2, 10, 'Estuche c/6 rotuladores Pitt Artist Pen Brush, tonos grisess', '50.30', 1, '50.30'),
(7, 2, 12, 'Estuche de 4 rotuladores Pitt Artist Pen, negro', '31.40', 1, '31.40'),
(8, 3, 63, 'Bolígrafo Ambition acero inoxidable', '355.00', 2, '710.00'),
(9, 3, 86, 'Engrapador metálico alicate P-101 color gris', '30.30', 1, '30.30'),
(10, 3, 1, 'Ceras acaureables Gelatos colores iridiscentes', '118.50', 1, '118.50'),
(11, 4, 27, 'Afilalápices Grip 2001 c/triple depósito, metálico plateado', '13.70', 2, '27.40'),
(12, 4, 73, 'Portaminas Ambition resina, 0,7 mm, negro', '186.00', 1, '186.00'),
(13, 4, 12, 'Estuche de 4 rotuladores Pitt Artist Pen, negro', '31.40', 1, '31.40'),
(14, 5, 7, 'Estuche con 36 pasteles blandos', '135.20', 2, '270.40'),
(15, 5, 36, 'Cerámica ultra ligera col basicos 14g x6', '14.49', 1, '14.49'),
(16, 5, 37, 'Cerámica ultra ligera pastel+neon 14g x6', '14.49', 1, '14.49'),
(17, 6, 63, 'Bolígrafo Ambition acero inoxidable', '355.00', 2, '710.00'),
(18, 6, 64, 'Bolígrafo Ambition madera de coco, B', '438.00', 1, '438.00'),
(19, 6, 65, 'Bolígrafo Ambition madera de peral, B', '304.00', 1, '304.00'),
(20, 7, 65, 'Bolígrafo Ambition madera de peral, B', '304.00', 1, '304.00'),
(21, 7, 69, 'Bolígrafo Grip 2011, XB, azul-metálico', '37.00', 2, '74.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `id_subseccion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seccion` (`id_seccion`),
  KEY `id_subseccion` (`id_subseccion`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`, `id_seccion`, `id_subseccion`) VALUES
(1, 'Ceras acaureables Gelatos colores iridiscentes', 'Ceras acuarelables solubles en agua', '118.50', 19, 'ceras_colores_iridiscentes.jpg', 1, 1),
(2, 'Ceras Gelatos colores translúcidos, 15 piezas', 'Se adhieren extraordinariamente bien a superficies', '118.50', 9, 'ceras_colores_translucidos.jpg', 1, 1),
(3, 'Ceras Gelatos tonos amarillos, 6 piezas', '', '36.60', 11, 'ceras_tonos_amarrillos.jpg', 1, 1),
(4, 'Juego de regalo de ceras acuarelables Gelatos, 33 piezas', 'Sus pigmentos compactos libres de ácido se deslizan con suavidad para colores intensos y cubrientes. ', '207.80', 8, 'juego_regalo_gelatos.jpg', 1, 1),
(5, 'Estuche de cartón con 12 pasteles blandos', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '52.40', 11, 'tiza_pastel1.jpg', 1, 2),
(6, 'Estuche de pasteles blandos mini x 24 colores', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '54.50', 18, 'tiza_pastel2.jpg', 1, 2),
(7, 'Estuche con 36 pasteles blandos', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '135.20', 15, 'tiza_pastel3.jpg', 1, 2),
(8, 'Estuche con 72 pasteles blandos mini', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '146.40', 18, 'tiza_pastel4.jpg', 1, 2),
(9, 'Estuche de pasteles blandos x 24 colores', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '103.70', 16, 'tiza_pastel5.jpg', 1, 2),
(10, 'Estuche c/6 rotuladores Pitt Artist Pen Brush, tonos grisess', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.30', 16, 'marcadores1.jpg', 1, 3),
(11, 'Estuche con 12 rotuladores Pitt Artist Pen brush', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '131.10', 11, 'marcadores2.jpg', 1, 3),
(12, 'Estuche de 4 rotuladores Pitt Artist Pen, negro', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '31.40', 7, 'marcadores3.jpg', 1, 3),
(13, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, básicos', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores4.jpg', 1, 3),
(14, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, pastel', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores5.jpg', 1, 3),
(15, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, tonos piel', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores6.jpg', 1, 3),
(16, 'Estuche de cartón c/ 10 marcadores profesionales acuarelables Albrecht Dürer', 'La versatilidad de estos marcadores es especialmente convincente cuando se viaja. Aquellos a quienes les gusta recordar las impresiones de su viaje estarán encantados de poder usar estos marcadores.', '150.40', 10, 'marcadores7.jpg', 1, 3),
(17, 'Estuche de metal con 33 piezas Pitt Monochrome', 'Los colores monochrome clásicos - negro, blanco, sanguina y sepia - pueden encontrarse a diario en casi cualquier clase de arte, ya que hacen que los dibujos cobren vida con vitalidad y expresión.', '241.40', 15, 'grafitos_lapices1.jpg', 1, 4),
(18, 'Estuche de metal con 26 piezas Pitt Grafito', 'La gama Pitt de Faber-Castell ofrece al artista creativo un completo surtido de lápices y tizas de diferentes graduaciones para bocetos, sombreados y diseños gráficos.', '278.40', 15, 'grafitos_lapices2.jpg', 1, 4),
(19, 'Lápiz carbón Pitt, no graso, negro medio', 'Las barras de carbón natural son el más antiguo material del mundo para dibujar y realizar bocetos. Los lápices carbón permiten trazar líneas mucho más negras. ', '6.20', 20, 'grafitos_lapices3.jpg', 1, 4),
(20, 'Ecolápiz tiza Pitt, no graso, negro medio', 'Los lápices carbón permiten trazar líneas mucho más negras. ', '6.00', 18, 'grafitos_lapices4.jpg', 1, 4),
(21, 'Estuche de metal con 5 lápices Graphite Aquarelle', 'El lápiz acuarelable Graphite Aquarelle es perfecto para bocetos, acuarelas y técnicas mixtas.', '30.20', 11, 'grafitos_lapices5.jpg', 1, 4),
(22, 'Óleos Pastel en estuche rígido de 24 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '12.90', 20, 'acuarelas1.jpg', 2, 5),
(23, 'Óleos Pastel neón y metálico en estuche rígido de 12 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '7.70', 20, 'acuarelas2.jpg', 2, 5),
(24, 'Óleos Pastel en estuche rígido de 12 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '7.10', 19, 'acuarelas3.jpg', 2, 5),
(25, 'Estuche de acuarelas Connector, rojo, 12 colores + pincel', 'La caja de acuarela Connector ha sido nombrada como el producto del año en el 2012 por la pro-k association dado su innovador diseño e increíble desempeño y funcionalidad.', '44.70', 20, 'acuarelas4.jpg', 2, 5),
(26, 'Estuche de acuarelas con 12 colores', ' Los colores opacos son ideales para el colegio y la diversión..', '11.00', 20, 'acuarelas5.jpg', 2, 5),
(27, 'Afilalápices Grip 2001 c/triple depósito, metálico plateado', ' El diseño clásico de Grip también ha tenido éxito en el mundo de los afiladores.', '13.70', 15, 'tajador1.jpg', 2, 6),
(28, 'Borrador azul para tinta de lapicero', ' La calidad de la goma de borrar y la correcta elección de la misma permiten obtener óptimos resultados.', '1.00', 19, 'borrador1.jpg', 2, 6),
(29, 'Borrador blanco mediano', ' La calidad de la goma de borrar y la correcta elección de la misma permiten obtener óptimos resultados.', '0.60', 20, 'borrador2.jpg', 2, 6),
(30, 'Tajador de plástico c/ depósito', ' La calidad de un afilalápices, especialmente la cuchilla, es crucial para el óptimo afilado de los lápices de madera.', '1.10', 20, 'tajador2.jpg', 2, 6),
(31, 'Tajador c/ depósito tubular', ' La calidad de un afilalápices, especialmente la cuchilla, es crucial para el óptimo afilado de los lápices de madera.', '4.90', 20, 'tajador3.jpg', 2, 6),
(32, 'Arena Mágica Glitter de 300 gr + 6 moldes', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '20.90', 18, 'plastilina1.jpg', 2, 7),
(33, 'Arena Mágica Glitter de 500 gr + 12 moldes y bandeja', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '31.40', 18, 'plastilina2.jpg', 2, 7),
(34, 'Arena Mágica Estándar de 300 gr + 6 moldes', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '20.90', 19, 'plastilina3.jpg', 2, 7),
(35, 'Arena Mágica Estándar de 500 gr + 12moldes y bandeja', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '31.40', 20, 'plastilina4.jpg', 2, 7),
(36, 'Cerámica ultra ligera col basicos 14g x6', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '14.49', 18, 'ceramica1.jpg', 2, 7),
(37, 'Cerámica ultra ligera pastel+neon 14g x6', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '14.49', 19, 'ceramica2.jpg', 2, 7),
(38, 'Limpiatipo Colores Pastel surtidos', '  Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo1.jpg', 2, 7),
(39, 'Limpiatipo Neón Amarillo', ' Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo2.jpg', 2, 7),
(40, 'Limpiatipo Neón Azul', ' Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo3.jpg', 2, 7),
(41, 'Masa moldeable pote 140gr. estuche x4', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '11.80', 19, 'plastilina5.jpg', 2, 7),
(42, 'Crayones Kinder Cohete en seis colores', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '9.30', 19, 'crayola1.jpg', 2, 8),
(43, 'Crayones de cera delgados estuche x12', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '2.30', 20, 'crayola2.jpg', 2, 8),
(44, 'Crayones de cera retráctiles x 12 colores', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '13.70', 19, 'crayola3.jpg', 2, 8),
(45, 'Crayones Trompo', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '9.30', 20, 'crayola4.jpg', 2, 8),
(46, 'Óleo Pastel estuche rígido x 36 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '24.40', 18, 'crayola5.jpg', 2, 8),
(47, 'Crayones de cera Jumbo estuche x12', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '4.00', 20, 'crayola6.jpg', 2, 8),
(48, 'Plumones doble punta x 10 colores', 'Los plumones de punta gruesa están disponibles para grandes superficies de color, mientras que las puntas finas están disponibles para dibujar líneas finas y acentuar los detalles.', '20.50', 16, 'plumon1.jpg', 2, 9),
(49, 'Plumones Fiesta 45 Caras & Colores x 12 + 3 tonos piel', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '7.90', 20, 'plumon2.jpg', 2, 9),
(50, 'Plumones Fiesta 45 Caras & Colores x 6', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '5.30', 20, 'plumon3.jpg', 2, 9),
(51, 'Plumones Fiesta 45 estuche de cartón x 20 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '13.90', 20, 'plumon4.jpg', 2, 9),
(52, 'Plumones Fiesta 45 en estuche rígido x 48 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '39.40', 17, 'plumon5.jpg', 2, 9),
(53, 'Plumones Fiesta 45 Neón x 6', ' El marcador Fiesta 45 impresiona con sus vivos colores.', '4.80', 20, 'plumon6.jpg', 2, 9),
(54, 'Plumones Fiesta 45 en estuche rígido x 60 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '49.30', 17, 'plumon7.jpg', 2, 9),
(55, 'Plumones Fiesta 45 Pastel x 6', ' El marcador Fiesta 45 impresiona con sus vivos colores.', '4.80', 20, 'plumon8.jpg', 2, 9),
(56, 'Plumones Fiesta 45 x 12 colores + 4 neón + 2 pastel', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '9.00', 19, 'plumon9.jpg', 2, 9),
(57, 'Plumones Fiesta estuche con zipper x 20 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '13.90', 20, 'plumon10.jpg', 2, 9),
(58, 'Plumones Jumbo 47 estuche de cartón x 6 colores', 'Plumón Jumbo 47 impresiona con su extarordinario trazo de 3,6 mm.', '19.30', 20, 'plumon11.jpg', 2, 9),
(59, 'Plumones Winner 47 estuche de cartón x 12 colores', 'Plumones / Marcadores Winner 47 en estuche de cartón x 12 colores.', '20.70', 20, 'plumon12.jpg', 2, 9),
(60, 'Plumones Connector en estuche de camión', ' Los marcadores Connector tienen colores fuertes y luminosos y hasta tienen un beneficio extra.', '55.20', 18, 'plumon13.jpg', 2, 9),
(61, 'Plumones Connector set x 80 colores + accesorios', 'Los marcadores Connector tienen colores fuertes y luminosos y hasta tienen un beneficio extra.', '77.70', 19, 'plumon14.jpg', 2, 9),
(62, 'Plumones Fiesta estuche con zipper x 30 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '21.10', 20, 'plumon15.jpg', 2, 9),
(63, 'Bolígrafo Ambition acero inoxidable', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '355.00', 14, 'boligrafo1.jpg', 3, 10),
(64, 'Bolígrafo Ambition madera de coco, B', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '438.00', 16, 'boligrafo2.jpg', 3, 10),
(65, 'Bolígrafo Ambition madera de peral, B', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '304.00', 16, 'boligrafo3.jpg', 3, 10),
(66, 'Bolígrafo e-motion Pure Black, B, negro', 'Los útiles de escritura e-motion, gracias a su forma dinámica y color negro mate, levantan pasiones.', '368.00', 20, 'boligrafo4.jpg', 3, 10),
(67, 'Bolígrafo Ondoro resina, B, negro grafito', 'LLa inusual forma geométrica de su diseño es lo primero que se percibe y, como era de esperar, Ondoro otorga a cada pieza un toque súper personal.', '328.00', 20, 'boligrafo5.jpg', 3, 10),
(68, 'Bolígrafo Essentio piel, B, negro', 'Atractivos a la vista, cómodos de sujetar y todo un placer a la hora de escribir - estas son las características de las piezas Essentio.', '99.00', 14, 'boligrafo6.jpg', 3, 10),
(69, 'Bolígrafo Grip 2011, XB, azul-metálico', 'El concepto Grip 2011 convence por su atractivo diseño Grip en colores clásicos y su sofisticada ergonomía.', '37.00', 15, 'boligrafo7.jpg', 3, 10),
(70, 'Bolígrafo Loom Piano, B, negro', 'Con zona de agarre estriada, los variados y fascinantes útiles de escritura de la serie Loom destacan por sus luminosos colores y su elegancia purista.', '94.50', 19, 'boligrafo8.jpg', 3, 10),
(71, 'Portaminas Ambition resina Rhombus, 0,7 mm, negro', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '219.00', 15, 'portaminas1.jpg', 3, 11),
(72, 'Portaminas Ambition acero inoxidable, 0,7 mm', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '354.00', 15, 'portaminas2.jpg', 3, 11),
(73, 'Portaminas Ambition resina, 0,7 mm, negro', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '186.00', 14, 'portaminas3.jpg', 3, 11),
(74, 'Portaminas e-motion pure Black, 1,4 mm', 'Los útiles de escritura e-motion, gracias a su forma dinámica y color negro mate, levantan pasiones.', '385.20', 15, 'portaminas4.jpg', 3, 11),
(75, 'Portaminas e-motion madera de peral, 1,4 mm, negro', 'Con su original forma ovalada y tonos madera, los útiles de la línea e-motion encajan cómodamente en la mano.', '148.00', 12, 'portaminas5.jpg', 3, 11),
(76, 'Portaminas Essentio metal, 0,7 mm, mate cromado', 'Atractivos a la vista, cómodos de sujetar y todo un placer a la hora de escribir - estas son las características de las piezas Essentio.', '91.00', 14, 'portamina6.jpg', 3, 11),
(77, 'Portaminas Grip 2011, 0,7 mm, color plata', 'El concepto Grip 2011 convence por su atractivo diseño Grip en colores clásicos y su sofisticada ergonomía.', '42.00', 20, 'portamina7.jpg', 3, 11),
(78, 'Portaminas Ondoro madera de roble ahumado, 0,7 mm', 'La inusual forma geométrica de su diseño es lo primero que se percibe y, como era de esperar, Ondoro otorga a cada pieza un toque súper personal.', '505.00', 15, 'portaminas8.jpg', 3, 11),
(79, 'Portaminas Ondoro resina preciosa naranja', 'La inusual forma geométrica de su diseño es lo primero que se percibe y, como era de esperar, Ondoro otorga a cada pieza un toque súper personal.', '338.00', 15, 'portaminas9.jpg', 3, 11),
(80, 'Portaminas Loom anaranjado metálico', 'Con zona de agarre estriada, los variados y fascinantes útiles de escritura de la serie Loom destacan por sus luminosos colores y su elegancia purista.', '74.00', 15, 'portaminas10.jpg', 3, 11),
(81, 'Cinta correctora retráctil 5mm x 6m', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '4.50', 18, 'corrector1.jpg', 4, 12),
(82, 'Cinta correctora retráctil azul + 1 recarga', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '5.40', 16, 'corrector2.jpg', 4, 12),
(83, 'Cinta correctora retráctil rosa + 1 recarga', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '5.40', 19, 'corrector3.jpg', 4, 12),
(84, 'Cinta correctora retráctil verde + 1 recarga', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '5.40', 20, 'corrector4.jpg', 4, 12),
(85, 'Mini Lápiz corrector 4ml triangular', 'Mini corrector con punta metálica. Secado rápido y cuerpo super blando. Tapa transparente con clip. Contenido 5ml.', '1.60', 20, 'corrector5.jpg', 4, 12),
(86, 'Engrapador metálico alicate P-101 color gris', 'Engrapador tipo alicate para 25 hojas disponible en color plateado.', '30.30', 8, 'engrampador1.jpg', 4, 13),
(94, 'aisa imagen', 'dwqeqwrewtre', '22.00', 40, 'aisaimagen.jpg', 5, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos3`
--

DROP TABLE IF EXISTS `productos3`;
CREATE TABLE IF NOT EXISTS `productos3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `seccion` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `subseccion` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos3`
--

INSERT INTO `productos3` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`, `seccion`, `subseccion`) VALUES
(1, 'kakita', 'Ceras acuarelables solubles en agua', '118.50', 15, 'ceras_colores_iridiscentes.jpg', 'Arte', 'Ceras Profesionales'),
(2, 'Ceras Gelatos colores translúcidos, 15 piezas', 'Se adhieren extraordinariamente bien a superficies rugosas como lienzo o madera', '118.50', 20, 'ceras_colores_translucidos.jpg', 'Arte', 'Ceras Profesionales'),
(3, 'Ceras Gelatos tonos amarillos, 6 piezas', NULL, '36.70', 10, 'ceras_tonos_amarrillos.jpg', 'Arte', 'Ceras Profesionales'),
(4, 'Juego de regalo de ceras acuarelables Gelatos, 33 piezas', 'Sus pigmentos compactos libres de ácido se deslizan con suavidad para colores intensos y cubrientes. ', '207.90', 12, 'juego_regalo_gelatos.jpg', 'Arte', 'Ceras Profesionales'),
(5, 'Estuche de cartón con 12 pasteles blandos', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '52.60', 15, 'tiza_pastel1.jpg', 'Arte', 'Tizas Pastel'),
(6, 'Estuche de pasteles blandos mini x 24 colores', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '54.40', 20, 'tiza_pastel2.jpg', 'Arte', 'Tizas Pastel'),
(7, 'Estuche con 36 pasteles blandos', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '135.50', 20, 'tiza_pastel3.jpg', 'Arte', 'Tizas Pastel'),
(8, 'Estuche con 72 pasteles blandos mini', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '146.70', 20, 'tiza_pastel4.jpg', 'Arte', 'Tizas Pastel'),
(9, 'Estuche de pasteles blandos x 24 colores', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '103.70', 20, 'tiza_pastel5.jpg', 'Arte', 'Tizas Pastel'),
(10, 'Estuche c/6 rotuladores Pitt Artist Pen Brush, tonos grisess', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores1.jpg', 'Arte', 'Marcadores'),
(11, 'Estuche con 12 rotuladores Pitt Artist Pen brush', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '131.10', 15, 'marcadores2.jpg', 'Arte', 'Marcadores'),
(12, 'Estuche de 4 rotuladores Pitt Artist Pen, negro', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '31.40', 10, 'marcadores3.jpg', 'Arte', 'Marcadores'),
(13, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, básicos', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores4.jpg', 'Arte', 'Marcadores'),
(14, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, pastel', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores5.jpg', 'Arte', 'Marcadores'),
(15, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, tonos piel', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 20, 'marcadores6.jpg', 'Arte', 'Marcadores'),
(16, 'Estuche de cartón c/ 10 marcadores profesionales acuarelables Albrecht Dürer', 'La versatilidad de estos marcadores es especialmente convincente cuando se viaja. Aquellos a quienes les gusta recordar las impresiones de su viaje estarán encantados de poder usar estos marcadores.', '150.40', 10, 'marcadores7.jpg', 'Arte', 'Marcadores'),
(17, 'Estuche de metal con 33 piezas Pitt Monochrome', 'Los colores monochrome clásicos - negro, blanco, sanguina y sepia - pueden encontrarse a diario en casi cualquier clase de arte, ya que hacen que los dibujos cobren vida con vitalidad y expresión.', '241.40', 10, 'grafitos_lapices1.jpg', 'Arte', 'Grafitos y lapices'),
(18, 'Estuche de metal con 26 piezas Pitt Grafito', 'La gama Pitt de Faber-Castell ofrece al artista creativo un completo surtido de lápices y tizas de diferentes graduaciones para bocetos, sombreados y diseños gráficos.', '278.40', 15, 'grafitos_lapices2.jpg', 'Arte', 'Grafitos y lapices'),
(19, 'Lápiz carbón Pitt, no graso, negro medio', 'Las barras de carbón natural son el más antiguo material del mundo para dibujar y realizar bocetos. Los lápices carbón permiten trazar líneas mucho más negras. ', '6.10', 20, 'grafitos_lapices3.jpg', 'Arte', 'Grafitos y lapices'),
(20, 'Ecolápiz tiza Pitt, no graso, negro medio', 'Los lápices carbón permiten trazar líneas mucho más negras. ', '6.00', 20, 'grafitos_lapices4.jpg', 'Arte', 'Grafitos y lapices'),
(21, 'Estuche de metal con 5 lápices Graphite Aquarelle', 'El lápiz acuarelable Graphite Aquarelle es perfecto para bocetos, acuarelas y técnicas mixtas.', '30.20', 15, 'grafitos_lapices5.jpg', 'Arte', 'Grafitos y lapices'),
(22, 'Óleos Pastel en estuche rígido de 24 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '12.90', 20, 'acuarelas1.jpg', 'Escolar', 'Acuarelas'),
(23, 'Óleos Pastel neón y metálico en estuche rígido de 12 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '7.70', 20, 'acuarelas2.jpg', 'Escolar', 'Acuarelas'),
(24, 'Óleos Pastel en estuche rígido de 12 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '7.10', 20, 'acuarelas3.jpg', 'Escolar', 'Acuarelas'),
(25, 'Estuche de acuarelas Connector, rojo, 12 colores + pincel', 'La caja de acuarela Connector ha sido nombrada como el producto del año en el 2012 por la pro-k association dado su innovador diseño e increíble desempeño y funcionalidad.', '44.70', 20, 'acuarelas4.jpg', 'Escolar', 'Acuarelas'),
(26, 'Estuche de acuarelas con 12 colores', ' Los colores opacos son ideales para el colegio y la diversión..', '11.00', 20, 'acuarelas5.jpg', 'Escolar', 'Acuarelas'),
(27, 'Afilalápices Grip 2001 c/triple depósito, metálico plateado', ' El diseño clásico de Grip también ha tenido éxito en el mundo de los afiladores.', '13.70', 20, 'tajador1.jpg', 'Escolar', 'Borradores y Tajadores'),
(28, 'Borrador azul para tinta de lapicero', ' La calidad de la goma de borrar y la correcta elección de la misma permiten obtener óptimos resultados.', '1.00', 20, 'borrador1.jpg', 'Escolar', 'Borradores y Tajadores'),
(29, 'Borrador blanco mediano', ' La calidad de la goma de borrar y la correcta elección de la misma permiten obtener óptimos resultados.', '0.60', 20, 'borrador2.jpg', 'Escolar', 'Borradores y Tajadores'),
(30, 'Tajador de plástico c/ depósito', ' La calidad de un afilalápices, especialmente la cuchilla, es crucial para el óptimo afilado de los lápices de madera.', '1.10', 20, 'tajador2.jpg', 'Escolar', 'Borradores y Tajadores'),
(31, 'Tajador c/ depósito tubular', ' La calidad de un afilalápices, especialmente la cuchilla, es crucial para el óptimo afilado de los lápices de madera.', '4.90', 20, 'tajador3.jpg', 'Escolar', 'Borradores y Tajadores'),
(32, 'Arena Mágica Glitter de 300gr + 6moldes', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '20.90', 20, 'plastilina1.jpg', 'Escolar', 'Plastilinas'),
(33, 'Arena Mágica Glitter de 500gr + 12moldes y bandeja', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '31.40', 20, 'plastilina2.jpg', 'Escolar', 'Plastilinas'),
(34, 'Arena Mágica Estándar de 300gr + 6moldes', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '20.90', 20, 'plastilina3.jpg', 'Escolar', 'Plastilinas'),
(35, 'Arena Mágica Estándar de 500gr + 12moldes y bandeja', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '31.40', 20, 'plastilina4.jpg', 'Escolar', 'Plastilinas'),
(36, 'Cerámica ultra ligera basicos 14g x6', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '14.49', 20, 'ceramica1.jpg', 'Escolar', 'Plastilinas'),
(37, 'Cerámica ultra ligera pastel+neon 14g x6', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '14.49', 20, 'ceramica2.jpg', 'Escolar', 'Plastilinas'),
(38, 'Limpiatipo Colores Pastel surtidos', 'Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo1.jpg', 'Escolar', 'Plastilinas'),
(39, 'Limpiatipo Neón Amarillo', 'Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo2.jpg', 'Escolar', 'Plastilinas'),
(40, 'Limpiatipo Neón Azul', 'Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo3.jpg', 'Escolar', 'Plastilinas'),
(41, 'Masa moldeable pote 140gr. estuche x4', 'Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '11.80', 20, 'plastilina5.jpg', 'Escolar', 'Plastilinas'),
(42, 'Crayones Kinder Cohete en 6 colores', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '9.30', 20, 'crayola1.jpg', 'Escolar', 'Crayones'),
(43, 'Crayones de cera delgados estuche x12', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '2.30', 20, 'crayola2.jpg', 'Escolar', 'Crayones'),
(44, 'Crayones de cera retráctiles x 12 colores', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '13.70', 20, 'crayola3.jpg', 'Escolar', 'Crayones'),
(45, 'Crayones Trompo', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '9.30', 20, 'crayola4.jpg', 'Escolar', 'Crayones'),
(46, 'Óleo Pastel estuche rígido x 36 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '24.40', 20, 'crayola5.jpg', 'Escolar', 'Crayones'),
(47, 'Crayones de cera Jumbo estuche x12', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '4.00', 20, 'crayola6.jpg', 'Escolar', 'Crayones'),
(48, 'Plumones doble punta x 10 colores', 'Los plumones de punta gruesa están disponibles para grandes superficies de color, mientras que las puntas finas están disponibles para dibujar líneas finas y acentuar los detalles.', '20.50', 20, 'plumon1.jpg', 'Escolar', 'Plumones'),
(49, 'Plumones Fiesta 45 Caras & Colores x 12 + 3 tonos piel', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '7.90', 20, 'plumon2.jpg', 'Escolar', 'Plumones'),
(50, 'Plumones Fiesta 45 Caras & Colores x 6', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '5.10', 20, 'plumon3.jpg', 'Escolar', 'Plumones'),
(51, 'Plumones Fiesta 45 estuche de cartón x 20 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '13.90', 20, 'plumon4.jpg', 'Escolar', 'Plumones'),
(52, 'Plumones Fiesta 45 en estuche rígido x 48 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '39.40', 20, 'plumon5.jpg', 'Escolar', 'Plumones'),
(53, 'Plumones Fiesta 45 Neón x 6', ' El marcador Fiesta 45 impresiona con sus vivos colores.', '4.80', 20, 'plumon6.jpg', 'Escolar', 'Plumones'),
(54, 'Plumones Fiesta 45 en estuche rígido x 60 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '49.30', 20, 'plumon7.jpg', 'Escolar', 'Plumones'),
(55, 'Plumones Fiesta 45 Pastel x 6', ' El marcador Fiesta 45 impresiona con sus vivos colores.', '4.80', 20, 'plumon8.jpg', 'Escolar', 'Plumones'),
(56, 'Plumones Fiesta 45 x 12 colores + 4 neón + 2 pastel', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '9.00', 20, 'plumon9.jpg', 'Escolar', 'Plumones'),
(57, 'Plumones Fiesta estuche con zipper x 20 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '13.90', 20, 'plumon10.jpg', 'Escolar', 'Plumones'),
(58, 'Plumones Jumbo 47 estuche de cartón x 6 colores', 'Plumón Jumbo 47 impresiona con su extarordinario trazo de 3,6 mm.', '19.20', 20, 'plumon11.jpg', 'Escolar', 'Plumones'),
(59, 'Plumones Winner 47 estuche de cartón x 12 colores', 'Plumones / Marcadores Winner 47 en estuche de cartón x 12 colores.', '20.70', 20, 'plumon12.jpg', 'Escolar', 'Plumones'),
(60, 'Plumones Connector en estuche de camión', ' Los marcadores Connector tienen colores fuertes y luminosos y hasta tienen un beneficio extra.', '55.20', 20, 'plumon13.jpg', 'Escolar', 'Plumones'),
(61, 'Plumones Connector set x 80 colores + accesorios', 'Los marcadores Connector tienen colores fuertes y luminosos y hasta tienen un beneficio extra.', '77.70', 20, 'plumon14.jpg', 'Escolar', 'Plumones'),
(62, 'Plumones Fiesta estuche con zipper x 30 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '21.10', 20, 'plumon15.jpg', 'Escolar', 'Plumones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_problemas`
--

DROP TABLE IF EXISTS `reporte_problemas`;
CREATE TABLE IF NOT EXISTS `reporte_problemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `reporte` text COLLATE utf8_unicode_ci,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_seccion` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `mostrar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `nombre_seccion`, `mostrar`) VALUES
(1, 'Arte', 1),
(2, 'Escolar', 1),
(3, 'Escritura Fina ', 1),
(4, 'Oficina y Escritorio', 1),
(5, 'Regalos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subseccion`
--

DROP TABLE IF EXISTS `subseccion`;
CREATE TABLE IF NOT EXISTS `subseccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_seccion` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre_subseccion` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seccion` (`id_seccion`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subseccion`
--

INSERT INTO `subseccion` (`id`, `id_seccion`, `nombre_subseccion`) VALUES
(1, '1', 'Ceras Profesionales'),
(2, '1', 'Tizas Pastel'),
(3, '1', 'Marcadores'),
(4, '1', 'Grafitos y lapices'),
(5, '2', 'Acuarelas'),
(6, '2', 'Borradores y Tajadores'),
(7, '2', 'Plastilinas'),
(8, '2', 'Crayones'),
(9, '2', 'Plumones'),
(10, '3', 'Boligrafos Premium'),
(11, '3', 'Portaminas Premium'),
(12, '4', 'Correctores'),
(13, '4', 'Engrampadores y Perforadores'),
(14, '4', 'Boligrafos'),
(15, '5', 'Libros para Colorear'),
(16, '5', 'Black Packs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tracking`
--

DROP TABLE IF EXISTS `tracking`;
CREATE TABLE IF NOT EXISTS `tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `pago_recibido` date DEFAULT NULL,
  `problemas` tinyint(1) DEFAULT NULL,
  `empaquetado` date DEFAULT NULL,
  `listo` date DEFAULT NULL,
  `salida` date DEFAULT NULL,
  `encamino` date DEFAULT NULL,
  `llegada` date DEFAULT NULL,
  `entregado` date DEFAULT NULL,
  `cancelado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tracking`
--

INSERT INTO `tracking` (`id`, `id_pedido`, `pago_recibido`, `problemas`, `empaquetado`, `listo`, `salida`, `encamino`, `llegada`, `entregado`, `cancelado`) VALUES
(1, 1, '2021-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, '2021-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, '2021-10-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, '2021-10-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, '2021-10-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, '2021-10-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, '2021-10-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `categoria`) VALUES
(1, 'pepin', 'pepito123', 3),
(2, 'josesin', '12345', 3),
(3, 'camuchina', 'camucha123', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
