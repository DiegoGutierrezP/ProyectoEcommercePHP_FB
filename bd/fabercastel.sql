-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-01-2022 a las 02:07:03
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

DROP TABLE IF EXISTS `carrito`;
CREATE TABLE IF NOT EXISTS `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_produc` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_produc` (`id_produc`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `id_cliente`, `id_produc`, `cantidad`) VALUES
(3, 1, 12, 1),
(4, 1, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombres` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `id_usuario`, `nombres`, `apellidos`, `dni`, `email`, `sexo`) VALUES
(1, 15, 'Maria Mercedes', 'Ramirez Villaran', '34451190', 'mariaRa@gmail.com', 'Mujer'),
(2, 16, 'Manuel', 'Gomez Garcia', '78985521', 'nolGG@gmail.com', 'Hombre'),
(3, 17, 'Pepe Carlos', 'Sanches Marez', NULL, 'pepito@gmail.com', 'Hombre'),
(4, 18, 'Carmen Maritza', 'Jaime Salazar', '55663212', 'camu123@gmail.com', 'Mujer'),
(5, 19, 'Pedro ', 'Gutierrez Pineda', NULL, 'carlos@gmail.com', 'Hombre'),
(6, 20, 'Sebastian Marcos', 'Lopez Leguia', NULL, 'sebasmarc@gmail.com', 'Hombre'),
(7, 21, 'Miguel', 'Urbina Flores', NULL, 'miki123@gmail.com', 'Hombre'),
(8, 22, 'Gisela Maria', 'Olivia Centeno', NULL, 'gise@gmail.com', 'Mujer'),
(9, 23, 'Gerardo', 'Paredes Camac', NULL, 'gerad@gmail.com', 'Hombre'),
(10, 24, 'Anthony', 'Saavedra Medrano', '70796654', 'tony23@gmail.com', 'Hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancia_entrega`
--

DROP TABLE IF EXISTS `constancia_entrega`;
CREATE TABLE IF NOT EXISTS `constancia_entrega` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `constancia` text COLLATE utf8_unicode_ci,
  `imagen_constancia` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `constancia_entrega`
--

INSERT INTO `constancia_entrega` (`id`, `id_pedido`, `constancia`, `imagen_constancia`) VALUES
(3, 2, 'se entrego correcatmente', NULL),
(4, 3, 'se entrego bien presento su dni correctamente', NULL),
(5, 1, 'Entregado a la hora', NULL),
(6, 19, 'se entrego el pedido satisfactoriamente...', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dato_cliente_envio`
--

DROP TABLE IF EXISTS `dato_cliente_envio`;
CREATE TABLE IF NOT EXISTS `dato_cliente_envio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `nombres` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ciudad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `distrito` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `domicilio` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `dato_cliente_envio`
--

INSERT INTO `dato_cliente_envio` (`id`, `id_cliente`, `nombres`, `apellidos`, `dni`, `ciudad`, `distrito`, `domicilio`) VALUES
(1, 1, 'maria mercedes', 'castanuela', '78903245', 'Lima', 'Surco', 'av benavides 231'),
(2, 1, 'maria ', 'perez lopez', '34567708', 'Lima', 'Surco', 'av sdadasd 213'),
(3, 2, 'Manuel', 'Gomez Garcia', '71793088', 'Lima', 'San Juan de Lurigancho', 'av las flores 10'),
(4, 3, 'Pepe Carlos', 'Sanches Marez', '78456322', 'Lima', 'Breña', 'av. los angeles 2344'),
(5, 4, 'Carmen Maritza', 'Jaime Salazar', '55663212', 'Lima', 'Cercado', 'av tacna 511'),
(6, 5, 'Pedro ', 'Gutierrez Pineda', '78342144', 'Lima', 'Breña', 'av. avenido 200'),
(7, 6, 'Sebastian Marcos', 'Lopez Leguia', '71793309', 'Lima', 'Villa el Salvador', 'av los insurgente 654'),
(8, 7, 'Miguel', 'Urbina Flores', '34422153', 'Lima', 'Jesus Maria', 'av juan pablo 299'),
(9, 8, 'Gisela Maria', 'Olivia Centeno', '34556780', 'Lima', 'Miraflores', 'av avenida 231'),
(10, 9, 'Gerardo', 'Paredes Camac', '77885543', 'Lima', 'Surco', 'av benavides 323'),
(11, 10, 'Anthony', 'Saavedra Medrano', '70796654', 'Lima', 'Lince', 'av. manuel segura 345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `nombres` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidos` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dni` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sexo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `areaTrabajo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `id_usuario`, `nombres`, `apellidos`, `email`, `dni`, `telefono`, `sexo`, `areaTrabajo`, `estado`) VALUES
(1, 6, 'Juan Manuel', 'Cuba Hernan', 'juancu@gmail.com', '34562166', '996743212', 'hombre', 'transporte', '1'),
(2, 7, 'Maria Jose', 'Bartra Perez', 'majo23@gmail.com', '78903245', '978432111', 'mujer', 'almacen', '1'),
(3, 8, 'Cesar ', 'Jaime Bautista', 'cesar34@gmail.com', '34567708', '96356748', 'hombre', 'transporte', '1'),
(4, 9, 'Mauro Carlos', 'Lopez', 'maucalo@gmail.com', '77890021', '99871234', 'hombre', 'almacen', '1'),
(5, 10, 'Aldo', 'Lozano Torres', 'aldTorres@gmail.com', '78903245', '963892246', 'hombre', 'transporte', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_transporte`
--

DROP TABLE IF EXISTS `empresa_transporte`;
CREATE TABLE IF NOT EXISTS `empresa_transporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEmpresa` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ruc` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa_transporte`
--

INSERT INTO `empresa_transporte` (`id`, `nombreEmpresa`, `ruc`) VALUES
(1, 'Rayos SAC', '10456789223'),
(2, 'Rappi SAC', '67894456223');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_datos_cliente` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `metodopago` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metodoenvio` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precioenvio` decimal(10,2) DEFAULT NULL,
  `estado_actual` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_datos_cliente` (`id_datos_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `id_datos_cliente`, `fecha`, `total`, `metodopago`, `metodoenvio`, `precioenvio`, `estado_actual`, `peso`) VALUES
(1, 1, '2021-11-25 18:31:56', '159.30', 'tarjeta', 'transporte', '25.00', 'Pago Procesado', '7 Kg.'),
(2, 3, '2021-11-25 18:38:38', '742.00', 'paypal', 'transporte', '25.00', 'Pago Procesado', '10 Kg.'),
(3, 3, '2021-11-25 20:59:33', '190.10', 'transferencia', 'transporte', '25.00', 'Pago Procesado', '6 Kg.'),
(4, 4, '2021-11-26 22:17:18', '487.60', 'paypal', 'transporte', '25.00', 'Pago Procesado', '12 Kg.'),
(5, 4, '2021-11-26 23:14:02', '524.00', 'paypal', 'transporte', '25.00', 'Pago Procesado', '5 Kg.'),
(6, 5, '2021-11-27 04:03:17', '130.80', 'tarjeta', 'transporte', '25.00', 'Pago Procesado', '900 gr.'),
(7, 5, '2021-11-27 05:06:09', '238.00', 'paypal', 'transporte', '25.00', 'Pago Procesado', '5 Kg.'),
(8, 6, '2021-11-27 15:07:49', '545.20', 'paypal', 'transporte', '25.00', 'Pago Procesado', '4 Kg.'),
(9, 2, '2021-12-02 00:34:23', '635.80', 'transferencia', 'transporte', '25.00', 'Pago Procesado', NULL),
(10, 7, '2021-12-03 02:15:11', '5392.80', 'paypal', 'transporte', '25.00', 'Pago Procesado', NULL),
(11, 7, '2021-12-03 02:22:16', '3466.80', 'tarjeta', 'transporte', '25.00', 'Pago Procesado', NULL),
(12, 5, '2021-12-04 02:47:30', '152.70', 'tarjeta', 'transporte', '25.00', 'Pago Procesado', NULL),
(13, 8, '2021-12-04 02:50:16', '309.20', 'paypal', 'transporte', '25.00', 'Pago Procesado', NULL),
(15, 3, '2021-12-04 14:34:25', '1081.60', 'tarjeta', 'transporte', '25.00', 'Pago Procesado', NULL),
(16, 9, '2021-12-09 16:14:23', '422.00', 'tarjeta', 'transporte', '25.00', 'Pago Procesado', NULL),
(17, 10, '2021-12-09 16:16:26', '482.20', 'paypal', 'transporte', '25.00', 'Pago Procesado', NULL),
(18, 11, '2021-12-11 02:18:28', '151.80', 'transferencia', 'transporte', '25.00', 'Pago Procesado', '7 Kg.'),
(19, 11, '2021-12-11 14:16:49', '646.40', 'paypal', 'transporte', '25.00', 'Pago Procesado', '7 Kg.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

DROP TABLE IF EXISTS `pedido_detalle`;
CREATE TABLE IF NOT EXISTS `pedido_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `precio_producto` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_producto` (`id_producto`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id`, `id_pedido`, `id_producto`, `precio_producto`, `cantidad`, `precio_total`) VALUES
(1, 1, 5, '52.40', 2, '104.80'),
(2, 1, 6, '54.50', 1, '54.50'),
(3, 2, 64, '438.00', 1, '438.00'),
(4, 2, 65, '304.00', 1, '304.00'),
(5, 3, 27, '13.70', 2, '27.40'),
(6, 3, 54, '49.30', 1, '49.30'),
(7, 3, 52, '39.40', 1, '39.40'),
(8, 3, 80, '74.00', 1, '74.00'),
(9, 4, 18, '278.40', 1, '278.40'),
(10, 4, 12, '31.40', 2, '62.80'),
(11, 4, 8, '146.40', 1, '146.40'),
(12, 5, 25, '44.70', 1, '44.70'),
(13, 5, 26, '11.00', 1, '11.00'),
(14, 5, 86, '30.30', 1, '30.30'),
(15, 5, 64, '438.00', 1, '438.00'),
(16, 6, 85, '2.60', 1, '2.60'),
(17, 6, 82, '5.40', 1, '5.40'),
(18, 6, 81, '4.50', 3, '13.50'),
(19, 6, 54, '49.30', 1, '49.30'),
(20, 6, 60, '55.20', 1, '55.20'),
(21, 6, 55, '4.80', 1, '4.80'),
(22, 7, 6, '54.50', 1, '54.50'),
(23, 7, 5, '52.40', 1, '52.40'),
(24, 7, 11, '131.10', 1, '131.10'),
(25, 8, 2, '118.50', 3, '355.50'),
(26, 8, 7, '135.20', 1, '135.20'),
(27, 8, 6, '54.50', 1, '54.50'),
(28, 9, 4, '207.80', 1, '207.80'),
(29, 9, 8, '146.40', 2, '292.80'),
(30, 9, 7, '135.20', 1, '135.20'),
(31, 10, 74, '385.20', 14, '5392.80'),
(32, 11, 74, '385.20', 9, '3466.80'),
(33, 12, 33, '31.40', 1, '31.40'),
(34, 12, 34, '20.90', 1, '20.90'),
(35, 12, 26, '11.00', 1, '11.00'),
(36, 12, 25, '44.70', 2, '89.40'),
(37, 13, 18, '278.40', 1, '278.40'),
(38, 13, 20, '6.00', 1, '6.00'),
(39, 13, 19, '6.20', 4, '24.80'),
(41, 15, 7, '135.20', 8, '1081.60'),
(42, 16, 16, '150.40', 1, '150.40'),
(43, 16, 17, '241.40', 1, '241.40'),
(44, 16, 21, '30.20', 1, '30.20'),
(45, 17, 64, '438.00', 1, '438.00'),
(46, 17, 53, '4.80', 1, '4.80'),
(47, 17, 52, '39.40', 1, '39.40'),
(48, 18, 89, '11.40', 1, '11.40'),
(49, 18, 86, '30.30', 1, '30.30'),
(50, 18, 93, '9.30', 1, '9.30'),
(51, 18, 13, '50.40', 2, '100.80'),
(52, 19, 13, '50.40', 2, '100.80'),
(53, 19, 12, '31.40', 2, '62.80'),
(54, 19, 17, '241.40', 2, '482.80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `imagen` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id_seccion` int(11) DEFAULT NULL,
  `id_subseccion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seccion` (`id_seccion`),
  KEY `id_subseccion` (`id_subseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `cantidad`, `imagen`, `id_seccion`, `id_subseccion`, `estado`, `eliminado`) VALUES
(1, 'Ceras acaureables Gelatos colores iridiscentes', 'Ceras acuarelables solubles en agua', '118.50', 19, 'ceras_colores_iridiscentes.jpg', 1, 1, 1, NULL),
(2, 'Ceras Gelatos colores translúcidos, 15 piezas', 'Se adhieren extraordinariamente bien a superficies', '118.50', 14, 'ceras_colores_translucidos.jpg', 1, 1, 1, NULL),
(3, 'Ceras Gelatos tonos amarillos, 6 piezas', '', '36.60', 21, 'ceras_tonos_amarrillos.jpg', 1, 1, 1, NULL),
(4, 'Juego de regalo de ceras acuarelables Gelatos, 33 piezas', 'Sus pigmentos compactos libres de ácido se deslizan con suavidad para colores intensos y cubrientes. ', '207.80', 16, 'juego_regalo_gelatos.jpg', 1, 1, 1, NULL),
(5, 'Estuche de cartón con 12 pasteles blandos', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '52.40', 19, 'tiza_pastel1.jpg', 1, 2, 1, NULL),
(6, 'Estuche de pasteles blandos mini x 24 colores', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '54.50', 15, 'tiza_pastel2.jpg', 1, 2, 1, NULL),
(7, 'Estuche con 36 pasteles blandos', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '135.20', 20, 'tiza_pastel3.jpg', 1, 2, 1, NULL),
(8, 'Estuche con 72 pasteles blandos mini', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '146.40', 14, 'tiza_pastel4.jpg', 1, 2, 1, NULL),
(9, 'Estuche de pasteles blandos x 24 colores', 'Las tizas pastel blandas destacan por sus colores súper intensos, la suave y sedosa aplicación del color y resultan perfectas para mezclar y difuminar.', '103.70', 16, 'tiza_pastel5.jpg', 1, 2, 1, NULL),
(10, 'Estuche c/6 rotuladores Pitt Artist Pen Brush, tonos grisess', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.30', 14, 'marcadores1.jpg', 1, 3, 0, '2021-12-11 14:22:20'),
(11, 'Estuche con 12 rotuladores Pitt Artist Pen brush', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '131.10', 9, 'marcadores2.jpg', 1, 3, 1, NULL),
(12, 'Estuche de 4 rotuladores Pitt Artist Pen, negro', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '31.40', 13, 'marcadores3.jpg', 1, 3, 1, NULL),
(13, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, básicos', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 15, 'marcadores4.jpg', 1, 3, 1, NULL),
(14, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, pastel', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 19, 'marcadores5.jpg', 1, 3, 1, NULL),
(15, 'Estuche con 6 rotuladores Pitt Artist Pen Brush, tonos piel', 'El rotulador Pitt. La tinta pigmentada súper resistente a la luz es ideal para bocetos, dibujos, layouts, diseño de moda e ilustración.', '50.40', 19, 'marcadores6.jpg', 1, 3, 1, NULL),
(16, 'Estuche de cartón c/ 10 marcadores profesionales acuarelables Albrecht Dürer', 'La versatilidad de estos marcadores es especialmente convincente cuando se viaja. Aquellos a quienes les gusta recordar las impresiones de su viaje estarán encantados de poder usar estos marcadores.', '150.40', 22, 'marcadores7.jpg', 1, 3, 1, NULL),
(17, 'Estuche de metal con 33 piezas Pitt Monochrome', 'Los colores monochrome clásicos - negro, blanco, sanguina y sepia - pueden encontrarse a diario en casi cualquier clase de arte, ya que hacen que los dibujos cobren vida con vitalidad y expresión.', '241.40', 10, 'grafitos_lapices1.jpg', 1, 4, 1, NULL),
(18, 'Estuche de metal con 26 piezas Pitt Grafito', 'La gama Pitt de Faber-Castell ofrece al artista creativo un completo surtido de lápices y tizas de diferentes graduaciones para bocetos, sombreados y diseños gráficos.', '278.40', 12, 'grafitos_lapices2.jpg', 1, 4, 1, NULL),
(19, 'Lápiz carbón Pitt, no graso, negro medio', 'Las barras de carbón natural son el más antiguo material del mundo para dibujar y realizar bocetos. Los lápices carbón permiten trazar líneas mucho más negras. ', '6.20', 15, 'grafitos_lapices3.jpg', 1, 4, 0, '2021-12-05 01:01:14'),
(20, 'Ecolápiz tiza Pitt, no graso, negro medio', 'Los lápices carbón permiten trazar líneas mucho más negras. ', '6.00', 17, 'grafitos_lapices4.jpg', 1, 4, 0, '2021-12-05 01:32:53'),
(21, 'Estuche de metal con 5 lápices Graphite Aquarelle', 'El lápiz acuarelable Graphite Aquarelle es perfecto para bocetos, acuarelas y técnicas mixtas.', '30.20', 19, 'grafitos_lapices5.jpg', 1, 4, 1, NULL),
(22, 'Óleos Pastel en estuche rígido de 24 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '12.90', 17, 'acuarelas1.jpg', 2, 5, 1, NULL),
(23, 'Óleos Pastel neón y metálico en estuche rígido de 12 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '7.70', 19, 'acuarelas2.jpg', 2, 5, 1, NULL),
(24, 'Óleos Pastel en estuche rígido de 12 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '7.10', 19, 'acuarelas3.jpg', 2, 5, 1, NULL),
(25, 'Estuche de acuarelas Connector, rojo, 12 colores + pincel', 'La caja de acuarela Connector ha sido nombrada como el producto del año en el 2012 por la pro-k association dado su innovador diseño e increíble desempeño y funcionalidad.', '44.70', 16, 'acuarelas4.jpg', 2, 5, 1, NULL),
(26, 'Estuche de acuarelas con 12 colores', ' Los colores opacos son ideales para el colegio y la diversión..', '11.00', 18, 'acuarelas5.jpg', 2, 5, 1, NULL),
(27, 'Afilalápices Grip 2001 c/triple depósito, metálico plateado', ' El diseño clásico de Grip también ha tenido éxito en el mundo de los afiladores.', '13.70', 13, 'tajador1.jpg', 2, 6, 1, NULL),
(28, 'Borrador azul para tinta de lapicero', ' La calidad de la goma de borrar y la correcta elección de la misma permiten obtener óptimos resultados.', '1.00', 19, 'borrador1.jpg', 2, 6, 1, NULL),
(29, 'Borrador blanco mediano', ' La calidad de la goma de borrar y la correcta elección de la misma permiten obtener óptimos resultados.', '0.60', 20, 'borrador2.jpg', 2, 6, 1, NULL),
(30, 'Tajador de plástico c/ depósito', ' La calidad de un afilalápices, especialmente la cuchilla, es crucial para el óptimo afilado de los lápices de madera.', '1.10', 20, 'tajador2.jpg', 2, 6, 1, NULL),
(31, 'Tajador c/ depósito tubular', ' La calidad de un afilalápices, especialmente la cuchilla, es crucial para el óptimo afilado de los lápices de madera.', '4.90', 20, 'tajador3.jpg', 2, 6, 1, NULL),
(32, 'Arena Mágica Glitter de 300 gr + 6 moldes', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '20.90', 18, 'plastilina1.jpg', 2, 7, 1, NULL),
(33, 'Arena Mágica Glitter de 500 gr + 12 moldes y bandeja', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '31.40', 15, 'plastilina2.jpg', 2, 7, 1, NULL),
(34, 'Arena Mágica Estándar de 300 gr + 6 moldes', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '20.90', 16, 'plastilina3.jpg', 2, 7, 1, NULL),
(35, 'Arena Mágica Estándar de 500 gr + 12moldes y bandeja', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '31.40', 20, 'plastilina4.jpg', 2, 7, 1, NULL),
(36, 'Cerámica ultra ligera col basicos 14g x6', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '14.49', 18, 'ceramica1.jpg', 2, 7, 1, NULL),
(37, 'Cerámica ultra ligera pastel+neon 14g x6', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '14.49', 19, 'ceramica2.jpg', 2, 7, 1, NULL),
(38, 'Limpiatipo Colores Pastel surtidos', '  Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo1.jpg', 2, 7, 1, NULL),
(39, 'Limpiatipo Neón Amarillo', ' Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo2.jpg', 2, 7, 1, NULL),
(40, 'Limpiatipo Neón Azul', ' Te presentamos nuestros nuevos Limpiatipos Neón y Pastel.', '1.90', 20, 'limpiatipo3.jpg', 2, 7, 1, NULL),
(41, 'Masa moldeable pote 140gr. estuche x4', ' Ayuda a pequeños artistas a descubrir y explorar su creatividad.', '11.80', 17, 'plastilina5.jpg', 2, 7, 1, NULL),
(42, 'Crayones Kinder Cohete en seis colores', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '9.30', 19, 'crayola1.jpg', 2, 8, 1, NULL),
(43, 'Crayones de cera delgados estuche x12', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '2.30', 20, 'crayola2.jpg', 2, 8, 1, NULL),
(44, 'Crayones de cera retráctiles x 12 colores', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '13.70', 18, 'crayola3.jpg', 2, 8, 1, NULL),
(45, 'Crayones Trompo', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '9.30', 25, 'crayola4.jpg', 2, 8, 1, NULL),
(46, 'Óleo Pastel estuche rígido x 36 colores', 'Las tizas pastel grasas ofrecen sorprendentes posibilidades de aplicación tanto para colores fuertes e intensos como para delicados tonos pastel.', '24.40', 18, 'crayola5.jpg', 2, 8, 1, NULL),
(47, 'Crayones de cera Jumbo estuche x12', 'Los artistas entre los 3 y 6 años adoran experimentar dibujando en diferentes superficies.', '4.00', 20, 'crayola6.jpg', 2, 8, 1, NULL),
(48, 'Plumones doble punta x 10 colores', 'Los plumones de punta gruesa están disponibles para grandes superficies de color, mientras que las puntas finas están disponibles para dibujar líneas finas y acentuar los detalles.', '20.50', 16, 'plumon1.jpg', 2, 9, 1, NULL),
(49, 'Plumones Fiesta 45 Caras & Colores x 12 + 3 tonos piel', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '7.90', 20, 'plumon2.jpg', 2, 9, 1, NULL),
(50, 'Plumones Fiesta 45 Caras & Colores x 6', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '5.30', 20, 'plumon3.jpg', 2, 9, 1, NULL),
(51, 'Plumones Fiesta 45 estuche de cartón x 20 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '13.90', 20, 'plumon4.jpg', 2, 9, 1, NULL),
(52, 'Plumones Fiesta 45 en estuche rígido x 48 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '39.40', 15, 'plumon5.jpg', 2, 9, 1, NULL),
(53, 'Plumones Fiesta 45 Neón x 6', ' El marcador Fiesta 45 impresiona con sus vivos colores.', '4.80', 19, 'plumon6.jpg', 2, 9, 1, NULL),
(54, 'Plumones Fiesta 45 en estuche rígido x 60 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '49.30', 13, 'plumon7.jpg', 2, 9, 0, NULL),
(55, 'Plumones Fiesta 45 Pastel x 6', ' El marcador Fiesta 45 impresiona con sus vivos colores.', '4.80', 19, 'plumon8.jpg', 2, 9, 0, NULL),
(56, 'Plumones Fiesta 45 x 12 colores + 4 neón + 2 pastel', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '9.00', 19, 'plumon9.jpg', 2, 9, 0, NULL),
(57, 'Plumones Fiesta estuche con zipper x 20 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '13.90', 20, 'plumon10.jpg', 2, 9, 1, NULL),
(58, 'Plumones Jumbo 47 estuche de cartón x 6 colores', 'Plumón Jumbo 47 impresiona con su extarordinario trazo de 3,6 mm.', '19.30', 20, 'plumon11.jpg', 2, 9, 1, NULL),
(59, 'Plumones Winner 47 estuche de cartón x 12 colores', 'Plumones / Marcadores Winner 47 en estuche de cartón x 12 colores.', '20.70', 20, 'plumon12.jpg', 2, 9, 1, NULL),
(60, 'Plumones Connector en estuche de camión', ' Los marcadores Connector tienen colores fuertes y luminosos y hasta tienen un beneficio extra.', '55.20', 17, 'plumon13.jpg', 2, 9, 1, NULL),
(61, 'Plumones Connector set x 80 colores + accesorios', 'Los marcadores Connector tienen colores fuertes y luminosos y hasta tienen un beneficio extra.', '77.70', 19, 'plumon14.jpg', 2, 9, 1, NULL),
(62, 'Plumones Fiesta estuche con zipper x 30 colores', 'El marcador Fiesta 45 impresiona con sus vivos colores.', '21.10', 20, 'plumon15.jpg', 2, 9, 1, NULL),
(63, 'Bolígrafo Ambition acero inoxidable', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '355.00', 18, 'boligrafo1.jpg', 3, 10, 1, NULL),
(64, 'Bolígrafo Ambition madera de coco, B', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '438.00', 13, 'boligrafo2.jpg', 3, 10, 1, NULL),
(65, 'Bolígrafo Ambition madera de peral, B', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '304.00', 15, 'boligrafo3.jpg', 3, 10, 1, NULL),
(66, 'Bolígrafo e-motion Pure Black, B, negro', 'Los útiles de escritura e-motion, gracias a su forma dinámica y color negro mate, levantan pasiones.', '368.00', 19, 'boligrafo4.jpg', 3, 10, 1, NULL),
(67, 'Bolígrafo Ondoro resina, B, negro grafito', 'LLa inusual forma geométrica de su diseño es lo primero que se percibe y, como era de esperar, Ondoro otorga a cada pieza un toque súper personal.', '328.00', 20, 'boligrafo5.jpg', 3, 10, 1, NULL),
(68, 'Bolígrafo Essentio piel, B, negro', 'Atractivos a la vista, cómodos de sujetar y todo un placer a la hora de escribir - estas son las características de las piezas Essentio.', '99.00', 14, 'boligrafo6.jpg', 3, 10, 1, NULL),
(69, 'Bolígrafo Grip 2011, XB, azul-metálico', 'El concepto Grip 2011 convence por su atractivo diseño Grip en colores clásicos y su sofisticada ergonomía.', '37.00', 15, 'boligrafo7.jpg', 3, 10, 1, NULL),
(70, 'Bolígrafo Loom Piano, B, negro', 'Con zona de agarre estriada, los variados y fascinantes útiles de escritura de la serie Loom destacan por sus luminosos colores y su elegancia purista.', '94.50', 18, 'boligrafo8.jpg', 3, 10, 1, NULL),
(71, 'Portaminas Ambition resina Rhombus, 0,7 mm, negro', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '219.00', 15, 'portaminas1.jpg', 3, 11, 1, NULL),
(72, 'Portaminas Ambition acero inoxidable, 0,7 mm', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '354.00', 15, 'portaminas2.jpg', 3, 11, 1, NULL),
(73, 'Portaminas Ambition resina, 0,7 mm, negro', 'Las formas limpias y los materiales selectos de los útiles de escritura Ambition causan una extraordinaria impresión.', '186.00', 14, 'portaminas3.jpg', 3, 11, 1, NULL),
(74, 'Portaminas e-motion pure Black, 1,4 mm', 'Los útiles de escritura e-motion, gracias a su forma dinámica y color negro mate, levantan pasiones.', '385.20', 1, 'portaminas4.jpg', 3, 11, 0, NULL),
(75, 'Portaminas e-motion madera de peral, 1,4 mm, negro', 'Con su original forma ovalada y tonos madera, los útiles de la línea e-motion encajan cómodamente en la mano.', '148.00', 12, 'portaminas5.jpg', 3, 11, 1, NULL),
(76, 'Portaminas Essentio metal, 0,7 mm, mate cromado', 'Atractivos a la vista, cómodos de sujetar y todo un placer a la hora de escribir - estas son las características de las piezas Essentio.', '91.00', 14, 'portamina6.jpg', 3, 11, 1, NULL),
(77, 'Portaminas Grip 2011, 0,7 mm, color plata', 'El concepto Grip 2011 convence por su atractivo diseño Grip en colores clásicos y su sofisticada ergonomía.', '42.00', 20, 'portamina7.jpg', 3, 11, 1, NULL),
(78, 'Portaminas Ondoro madera de roble ahumado, 0,7 mm', 'La inusual forma geométrica de su diseño es lo primero que se percibe y, como era de esperar, Ondoro otorga a cada pieza un toque súper personal.', '505.00', 15, 'portaminas8.jpg', 3, 11, 1, NULL),
(79, 'Portaminas Ondoro resina preciosa naranja', 'La inusual forma geométrica de su diseño es lo primero que se percibe y, como era de esperar, Ondoro otorga a cada pieza un toque súper personal.', '338.00', 14, 'portaminas9.jpg', 3, 11, 1, NULL),
(80, 'Portaminas Loom anaranjado metálico', 'Con zona de agarre estriada, los variados y fascinantes útiles de escritura de la serie Loom destacan por sus luminosos colores y su elegancia purista.', '74.00', 14, 'portaminas10.jpg', 3, 11, 1, NULL),
(81, 'Cinta correctora retráctil 5mm x 6m', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '4.50', 15, 'corrector1.jpg', 4, 12, 1, NULL),
(82, 'Cinta correctora retráctil azul + 1 recarga', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '5.40', 11, 'corrector2.jpg', 4, 12, 1, NULL),
(83, 'Cinta correctora retráctil rosa + 1 recarga', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '5.40', 19, 'corrector3.jpg', 4, 12, 1, NULL),
(84, 'Cinta correctora retráctil verde + 1 recarga', 'La cinta correctora Correction Tape proprociona excelente cubrimiento con una suave adherencia en todo tipo de superficies de papel incluyendo papel para fax.', '5.40', 20, 'corrector4.jpg', 4, 12, 1, NULL),
(85, 'Mini Lápiz corrector 4ml triangular', 'Mini corrector con punta metálica. Secado rápido y cuerpo super blando. Tapa transparente con clip. Contenido 5ml.', '4.80', 15, 'corrector5.jpg', 4, 12, 1, NULL),
(86, 'Engrapador metálico alicate P-101 color gris', 'Engrapador tipo alicate para 25 hojas disponible en color plateado.', '30.30', 12, 'engrampador1.jpg', 4, 13, 1, NULL),
(88, 'Mini engrapador E-10 para 10h azul', 'Mini engrapador para 10 hojas disponible en colores azul, rosado, negro y verde.', '3.20', 3, 'engrampador2.jpg', 4, 13, 1, NULL),
(89, 'Engrapador E-20 para 20h azul', 'Engrapador para 20 hojas disponible en colores azul, negro y también en un moderno color rojo.', '11.40', 5, 'engrampador3.jpg', 4, 13, 1, NULL),
(90, 'Engrapador E-20P para 20h plateado', 'Engrapador Premium para 20 hojas.', '11.30', 20, 'engrampador4.jpg', 4, 13, 1, NULL),
(91, 'Engrapador E-25-SG para 25h negro', 'Engrapador para 25 hojas disponible en colores azul, negro y también en un moderno color rojo.', '8.50', 15, 'engrampador5.jpg', 4, 13, 1, NULL),
(92, 'Bolígrafo Trilux 032 M x 5 colores', 'Bolígrafo con cuerpo triangular transparente de tinta seca.', '4.20', 20, 'boligrafo1.jpg', 4, 14, 1, NULL),
(93, 'Bolígrafos Trilux 035 F 6az 3ro 3neg Bl x12', 'Bolígrafo con cuerpo triangular de color verde traslúcido.', '9.30', 19, 'boligrafo2.jpg', 4, 14, 1, NULL),
(94, 'Bolígrafo borrable Erase it Pro negro', 'Los bolígrafos son los instrumentos de escritura más populares y confiables.', '3.50', 20, 'boligrafos10.jpg', 4, 14, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_problemas`
--

DROP TABLE IF EXISTS `reporte_problemas`;
CREATE TABLE IF NOT EXISTS `reporte_problemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pedido` int(11) DEFAULT NULL,
  `area` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_reporte` date NOT NULL,
  `motivo` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `reporte` text COLLATE utf8_unicode_ci,
  `imagen` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `reporte_problemas`
--

INSERT INTO `reporte_problemas` (`id`, `id_pedido`, `area`, `fecha_reporte`, `motivo`, `reporte`, `imagen`, `estado`) VALUES
(1, 3, 'Almacén', '2021-11-25', 'items rotos', 'algunos items se rompieron al listarlos porfavor ayudeme', NULL, 0),
(2, 8, 'Almacén', '2021-12-11', 'Algunos problemas con el producto 2', 'el producto sufrio algunos daños en el traslado', NULL, 0),
(3, 18, 'Almacén', '2021-12-11', 'Productos dañados', 'Dos de los productos del pedido sufrieron daños leves.', NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Estructura de tabla para la tabla `solucion_reporte`
--

DROP TABLE IF EXISTS `solucion_reporte`;
CREATE TABLE IF NOT EXISTS `solucion_reporte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reporte` int(11) DEFAULT NULL,
  `fecha_solucion` date NOT NULL,
  `reporte_solucion` text COLLATE utf8_unicode_ci,
  `imagen` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solucion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_reporte` (`id_reporte`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `solucion_reporte`
--

INSERT INTO `solucion_reporte` (`id`, `id_reporte`, `fecha_solucion`, `reporte_solucion`, `imagen`, `solucion`) VALUES
(1, 1, '2021-11-26', 'se reemplazo aquellos items con problemas observados , todo conforme', NULL, 'solucionado'),
(2, 2, '2021-12-11', 'Producto reestablecido . Le dimos solucion en corto tiempo ', NULL, 'solucionado'),
(3, 3, '2021-12-11', 'Se pudo solucionar aquel problema , ya se empaquetara el pedido', NULL, 'solucionado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subseccion`
--

DROP TABLE IF EXISTS `subseccion`;
CREATE TABLE IF NOT EXISTS `subseccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_seccion` int(40) DEFAULT NULL,
  `nombre_subseccion` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eliminado` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_seccion` (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `subseccion`
--

INSERT INTO `subseccion` (`id`, `id_seccion`, `nombre_subseccion`, `eliminado`) VALUES
(1, 1, 'Ceras Profesionales', NULL),
(2, 1, 'Tizas Pastel', NULL),
(3, 1, 'Marcadores', NULL),
(4, 1, 'Grafitos y lapices', NULL),
(5, 2, 'Acuarelas', NULL),
(6, 2, 'Borradores y Tajadores', NULL),
(7, 2, 'Plastilinas', NULL),
(8, 2, 'Crayones', NULL),
(9, 2, 'Plumones', NULL),
(10, 3, 'Boligrafos Premium', NULL),
(11, 3, 'Portaminas Premium', NULL),
(12, 4, 'Correctores', NULL),
(13, 4, 'Engrampadores y Perforadores', NULL),
(14, 4, 'Boligrafos', NULL),
(15, 5, 'Libros para Colorear', NULL),
(16, 5, 'Black Packs', NULL),
(17, 5, 'gaga75', NULL),
(18, 5, 'gasd', '2021-12-06 17:46:58'),
(19, 5, 'erw', '2021-12-06 17:46:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tracking`
--

INSERT INTO `tracking` (`id`, `id_pedido`, `pago_recibido`, `problemas`, `empaquetado`, `listo`, `salida`, `encamino`, `llegada`, `entregado`, `cancelado`) VALUES
(1, 1, '2021-11-25', NULL, '2021-12-04', '2021-12-06', '2021-12-07', '2021-12-07', '2021-12-07', '2021-12-07', NULL),
(2, 2, '2021-11-25', NULL, '2021-11-25', '2021-11-26', '2021-12-07', '2021-12-07', '2021-12-07', '2021-12-07', NULL),
(3, 3, '2021-11-25', 0, '2021-11-26', '2021-11-26', '2021-12-07', '2021-12-07', '2021-12-07', '2021-12-07', NULL),
(4, 4, '2021-11-26', NULL, '2021-12-04', '2021-12-07', NULL, NULL, NULL, NULL, NULL),
(5, 5, '2021-11-26', NULL, '2021-12-04', '2021-12-04', '2021-12-11', '2021-12-11', NULL, NULL, NULL),
(6, 6, '2021-11-27', NULL, '2021-12-07', '2021-12-11', '2021-12-11', '2021-12-11', NULL, NULL, NULL),
(7, 7, '2021-11-27', NULL, '2021-12-07', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 8, '2021-11-27', 0, '2021-12-11', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, '2021-12-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 10, '2021-12-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 11, '2021-12-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 12, '2021-12-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 13, '2021-12-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 15, '2021-12-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 16, '2021-12-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 17, '2021-12-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 18, '2021-12-11', 0, '2021-12-11', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 19, '2021-12-11', NULL, '2021-12-11', '2021-12-11', '2021-12-11', '2021-12-11', '2021-12-11', '2021-12-11', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportista`
--

DROP TABLE IF EXISTS `transportista`;
CREATE TABLE IF NOT EXISTS `transportista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) DEFAULT NULL,
  `id_empresaT` int(11) DEFAULT NULL,
  `tipoLicencia` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placaVehiculo` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_empresaT` (`id_empresaT`),
  KEY `id_empleado` (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transportista`
--

INSERT INTO `transportista` (`id`, `id_empleado`, `id_empresaT`, `tipoLicencia`, `placaVehiculo`) VALUES
(1, 1, 1, 'B1', 'AFR-345'),
(2, 3, 1, 'B3', 'ZHZ-321'),
(3, 5, 2, 'A2', 'T5Y-234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportista_pedido`
--

DROP TABLE IF EXISTS `transportista_pedido`;
CREATE TABLE IF NOT EXISTS `transportista_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transportista` int(11) DEFAULT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `estado` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transportista` (`id_transportista`),
  KEY `id_pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `transportista_pedido`
--

INSERT INTO `transportista_pedido` (`id`, `id_transportista`, `id_pedido`, `estado`) VALUES
(1, 1, 2, 'Entregado'),
(2, 1, 3, 'Entregado'),
(3, 2, 5, 'Salida'),
(4, 1, 1, 'Entregado'),
(5, 1, 4, 'Asignado'),
(6, 2, 6, 'Salida'),
(7, 2, 19, 'Entregado');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `user`, `password`, `categoria`) VALUES
(6, 'transporte1', 'transporte1', 2),
(7, 'almacen1', 'almacen1', 2),
(8, 'transporte2', 'transporte2', 2),
(9, 'almacen2', 'almacen2', 2),
(10, 'transporte3', 'transporte3', 2),
(15, 'marita', 'marita123', 3),
(16, 'Nolito', 'nolito123', 3),
(17, 'pepin', 'pepe123', 3),
(18, 'carmen', 'carmen123', 3),
(19, 'Carlos', 'carlos123', 3),
(20, 'Sebas', 'sebas123', 3),
(21, 'Miki', 'miki123', 3),
(22, 'Gisela', 'gise123', 3),
(23, 'Gerard', 'gerard123', 3),
(24, 'Toni', 'tony123', 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_produc`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `constancia_entrega`
--
ALTER TABLE `constancia_entrega`
  ADD CONSTRAINT `constancia_entrega_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dato_cliente_envio`
--
ALTER TABLE `dato_cliente_envio`
  ADD CONSTRAINT `dato_cliente_envio_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_datos_cliente`) REFERENCES `dato_cliente_envio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `pedido_detalle_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_subseccion`) REFERENCES `subseccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte_problemas`
--
ALTER TABLE `reporte_problemas`
  ADD CONSTRAINT `reporte_problemas_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solucion_reporte`
--
ALTER TABLE `solucion_reporte`
  ADD CONSTRAINT `solucion_reporte_ibfk_1` FOREIGN KEY (`id_reporte`) REFERENCES `reporte_problemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `subseccion`
--
ALTER TABLE `subseccion`
  ADD CONSTRAINT `subseccion_ibfk_1` FOREIGN KEY (`id_seccion`) REFERENCES `seccion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tracking`
--
ALTER TABLE `tracking`
  ADD CONSTRAINT `tracking_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transportista`
--
ALTER TABLE `transportista`
  ADD CONSTRAINT `transportista_ibfk_1` FOREIGN KEY (`id_empresaT`) REFERENCES `empresa_transporte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportista_ibfk_2` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transportista_pedido`
--
ALTER TABLE `transportista_pedido`
  ADD CONSTRAINT `transportista_pedido_ibfk_2` FOREIGN KEY (`id_transportista`) REFERENCES `transportista` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transportista_pedido_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
