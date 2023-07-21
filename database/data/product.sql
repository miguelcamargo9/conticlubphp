-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-06-2019 a las 04:15:20
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conti_club`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `image` text,
  `points` int(11) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `product_categories_id` int(11) NOT NULL,
  `points_value` varchar(20) NOT NULL,
  `estimated_value` varchar(20) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `points`, `state`, `product_categories_id`, `points_value`, `estimated_value`, `updated_at`, `created_at`) VALUES
(1, 'Tarjeta de Cine Colombia', '/products/Vivenciales/1/Tarjeta-de-Cine-Colombia-100.png', 1300, '1', 1, '104000', '100000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(2, 'Spotifyi Premium x 6 Meses', '/products/Vivenciales/2/Spotifyi-Premium-x-6-Meses.jpg', 1200, '1', 1, '96000', '90000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(3, 'Spotifyi Premium x 3 Meses', '/products/Vivenciales/3/Spotifyi-Premium-x-3-Meses.jpg', 600, '1', 1, '48000', '45000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(4, 'Bono de Netflix por $100.000', '/products/Vivenciales/4/Bono-de-Netflix-por-100.000.png', 1300, '1', 1, '104000', '100000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(5, 'Bono de Netflix por $50.000', '/products/Vivenciales/5/Bono-de-Netflix-por-50.000.png', 700, '1', 1, '56000', '50000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(6, 'Bono de Ropa De Arturo Calle', '/products/Vivenciales/6/Bono-de-Ropa-De-Arturo-Calle-150.png', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(7, 'Bono de Ropa Totto', '/products/Vivenciales/7/Bono-de-Ropa-Totto-150.jpg', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(8, 'Bono de Ropa Zara', '/products/Vivenciales/8/Bono-de-Ropa-Zara-150.jpeg', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(9, 'Bono de Ropa Adidas', '/products/Vivenciales/9/Bono-de-Ropa-Adidas-150.png', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(10, 'Bono de Ropa Nike', '/products/Vivenciales/10/Bono-de-Ropa-Nike-150.jpg', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(11, 'Bono de Ropa Tenis', '/products/Vivenciales/11/Bono-de-Ropa-Tenis-150.jpg', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(12, 'Bono de Ropa Koaj', '/products/Vivenciales/12/Bono-de-Ropa-Koaj-150.jpg', 1900, '1', 1, '152000', '150000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(13, 'Bono de Ropa De Arturo Calle', '/products/Vivenciales/13/Bono-de-Ropa-De-Arturo-Calle-200.jpg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(14, 'Bono de Ropa Totto', '/products/Vivenciales/14/Bono-de-Ropa-Totto-200.jpg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(15, 'Bono de Ropa Zara', '/products/Vivenciales/15/Bono-de-Ropa-Zara-200.jpeg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(16, 'Bono de Ropa Adidas', '/products/Vivenciales/16/Bono-de-Ropa-Adidas-200.png', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(17, 'Bono de Ropa Nike', '/products/Vivenciales/17/Bono-de-Ropa-Nike-200.jpg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(18, 'Bono de Ropa Tenis', '/products/Vivenciales/18/Bono-de-Ropa-Tenis-200.jpg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(19, 'Bono de Ropa Koaj', '/products/Vivenciales/19/Bono-de-Ropa-Koaj-200.jpg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(20, 'Bono de Ropa De Arturo Calle', '/products/Vivenciales/20/Bono-de-Ropa-De-Arturo-Calle-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(21, 'Bono de Ropa Totto', '/products/Vivenciales/21/Bono-de-Ropa-Totto-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(22, 'Bono de Ropa Zara', '/products/Vivenciales/22/Bono-de-Ropa-Zara-300.jpeg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(23, 'Bono de Ropa Adidas', '/products/Vivenciales/23/Bono-de-Ropa-Adidas-300.png', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(24, 'Bono de Ropa Nike', '/products/Vivenciales/24/Bono-de-Ropa-Nike-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(25, 'Bono de Ropa Tenis', '/products/Vivenciales/25/Bono-de-Ropa-Tenis-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(26, 'Bono de Ropa Koaj', '/products/Vivenciales/26/Bono-de-Ropa-Koaj-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(27, 'Bono de Ropa De Arturo Calle', '/products/Vivenciales/27/Bono-de-Ropa-De-Arturo-Calle-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(28, 'Bono de Ropa Totto', '/products/Vivenciales/28/Bono-de-Ropa-Totto-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(29, 'Bono de Ropa Zara', '/products/Vivenciales/29/Bono-de-Ropa-Zara-400.jpeg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(30, 'Bono de Ropa Adidas', '/products/Vivenciales/30/Bono-de-Ropa-Adidas-400.png', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(31, 'Bono de Ropa Nike', '/products/Vivenciales/31/Bono-de-Ropa-Nike-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(32, 'Bono de Ropa Tenis', '/products/Vivenciales/32/Bono-de-Ropa-Tenis-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(33, 'Bono de Ropa Koaj', '/products/Vivenciales/33/Bono-de-Ropa-Koaj-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(34, 'Bono renovación de Hogar De Falabella ', '/products/Vivenciales/34/Bono renovacion-de-Hogar-De-Falabella-250.jpg', 3200, '1', 1, '256000', '250000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(35, 'Bono renovación de Hogar HomeCenter', '/products/Vivenciales/35/Bono-renovacion-de-Hogar-HomeCenter-250.jpg', 3200, '1', 1, '256000', '250000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(36, 'Bono renovación de Hogar Éxito', '/products/Vivenciales/36/Bono-renovacion-de-Hogar-Exito-250.jpg', 3200, '1', 1, '256000', '250000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(37, 'Bono renovación de Hogar De Falabella ', '/products/Vivenciales/37/Bono renovacion-de-Hogar-De-Falabella-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(38, 'Bono renovación de Hogar HomeCenter', '/products/Vivenciales/38/Bono-renovacion-de-Hogar-HomeCenter-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(39, 'Bono renovación de Hogar Éxito', '/products/Vivenciales/39/Bono-renovacion-de-Hogar-Exito-300.jpg', 3800, '1', 1, '304000', '300000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(40, 'Bono renovación de Hogar De Falabella ', '/products/Vivenciales/40/Bono renovacion-de-Hogar-De-Falabella-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(41, 'Bono renovación de Hogar HomeCenter', '/products/Vivenciales/41/Bono-renovacion-de-Hogar-HomeCenter-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(42, 'Bono renovación de Hogar Éxito', '/products/Vivenciales/42/Bono-renovacion-de-Hogar-Exito-400.jpg', 5000, '1', 1, '400000', '400000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(43, 'Bono el Corral ', '/products/Vivenciales/43/Bono-el-Corral-60.png', 700, '1', 1, '56000', '60000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(44, 'Bono el Corral ', '/products/Vivenciales/44/Bono-el-Corral-100.png', 1300, '1', 1, '104000', '100000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(45, 'Bono de Crepes & waffles', '/products/Vivenciales/45/Bono-de-Crepes-_-waffles-60.png', 700, '1', 1, '56000', '60000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(46, 'Bono de Crepes & waffles', '/products/Vivenciales/46/Bono-de-Crepes-_-waffles-100.png', 1300, '1', 1, '104000', '100000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(47, 'Bono Bosi', '/products/Vivenciales/47/Bono-Bosi-100.jpg', 1300, '1', 1, '104000', '100', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(48, 'Bono Bosi', '/products/Vivenciales/48/Bono-Bosi-200.jpg', 2500, '1', 1, '200000', '200000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(49, 'Caja para  Herramientas 20 Pul', '/products/Hogar/49/Caja-para-Herramientas 20.jpeg', 1000, '1', 2, '80000', '52000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(50, 'caja para herraminientas 24 Pul', '/products/Hogar/50/caja-para-herraminientas-24.jpeg', 1000, '1', 2, '80000', '68000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(51, 'Atornillador Inalámbrico 3.6V', '/products/Hogar/51/atornillador-inalambrico-12-v.jpeg', 1000, '1', 2, '80000', '69900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(52, 'Set x 2 Toallas', '/products/Hogar/52/Set-x-2-Toallas.jpg', 1000, '1', 2, '80000', '73900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(53, 'Sanduchera 2 puestos', '/products/Hogar/53/Sanduchera-2-puestos.jpg', 1000, '1', 2, '80000', '80000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(54, 'Exprimidor De Citricos ', '/products/Hogar/54/Exprimidor-De-Citricos.jpg', 1200, '1', 2, '96000', '85000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(55, 'Juego de Cubiertos x 24 piezas', '/products/Hogar/55/Juego-de-Cubiertos-x-24-piezas.jpeg', 1200, '1', 2, '96000', '95990', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(56, 'cama para perro ', '/products/Hogar/56/cama-para-perro.jpeg', 1500, '1', 2, '120000', '110000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(57, 'Licuadora 10 Velocidades ', '/products/Hogar/57/Licuadora-10-Velocidades.jpg', 1500, '1', 2, '120000', '119900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(58, 'Olla Arroz  10 t', '/products/Hogar/58/Olla-Arroz-10-t.jpg', 2500, '1', 2, '200000', '155000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(59, 'Plumón El Dorado 160x190', '/products/Hogar/59/Plumon-El-Dorado-160x190.jpg', 2500, '1', 2, '200000', '199900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(60, 'Butacó Alto Color Negro', '/products/Hogar/60/Butaco-Alto-Color-Negro.png', 2500, '1', 2, '200000', '209990', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(61, 'Ventilador 3 en 1 Samurai', '/products/Hogar/61/Ventilador-3-en-1-Samurai.jpg', 3000, '1', 2, '240000', '212000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(62, 'Horno tostador ', '/products/Hogar/62/Horno-tostador.jpg', 3000, '1', 2, '240000', '229000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(63, 'maquina multi bebida mini nescafe', '/products/Hogar/63/maquina-multi-bebida-mini-nescafe.jpeg', 3200, '1', 2, '256000', '249000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(64, 'Licuadora Oster Cromada 3V ', '/products/Hogar/64/Licuadora Oster Cromada 3V.jpeg', 3500, '1', 2, '280000', '253900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(65, 'atornillador inalambrico 12 v', '/products/Hogar/65/Atornillador-Inalambrico-3.6V.jpeg', 3500, '1', 2, '280000', '259900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(66, 'Vajilla Corelle x 4 piezas  Blanca', '/products/Hogar/66/Vajilla-Corelle-x-4-piezas-Blanca.jpg', 3500, '1', 2, '280000', '269950', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(67, 'Bateria de ollas ', '/products/Hogar/67/Bateria-de-ollas.jpg', 4000, '1', 2, '320000', '310000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(68, 'Nevera para camping con Ruedas', '/products/Hogar/68/Nevera-para-camping-con-Ruedas.jpeg', 4500, '1', 2, '360000', '349900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(69, 'Horno Microondas', '/products/Hogar/69/Horno-Microondas.jpg', 4800, '1', 2, '384000', '369900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(70, 'Aspiradora', '/products/Hogar/70/Aspiradora.jpg', 4800, '1', 2, '384000', '379900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(71, 'Asador de carbón', '/products/Hogar/71/Asador-de-carbon.jpeg', 4800, '1', 2, '384000', '399000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(72, 'Asador de gas', '/products/Hogar/72/Asador-de-gas.jpeg', 5500, '1', 2, '440000', '499900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(73, 'bateria recargable mini', '/products/Tecnología/73/bateria-recargable-mini.jpeg', 800, '1', 3, '64000', '39900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(74, 'Batería Recargable', '/products/Tecnología/74/Bateria-Recargable.jpeg', 1000, '1', 3, '80000', '79990', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(75, 'Audífono Diadema', '/products/Tecnología/75/Audifono-Diadema.jpg', 1500, '1', 3, '120000', '90900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(76, 'Secador de pelo', '/products/Tecnología/76/Secador-de-pelo.jpeg', 1500, '1', 3, '120000', '99900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(77, 'Teléfono inalámbrico identificar llamadas ', '/products/Tecnología/77/Telefono-inalambrico-identificar-llamadas.jpeg', 1500, '1', 3, '120000', '114900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(78, 'máquina corta cabello', '/products/Tecnología/78/maquina-corta-cabello.jpg', 1500, '1', 3, '120000', '137900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(79, 'Parlante inalámbrico', '/products/Tecnología/79/Parlante-inalambrico.jpeg', 2000, '1', 3, '160000', '139900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(80, 'afeitadora recargable', '/products/Tecnología/80/afeitadora-recargable.jpeg', 2000, '1', 3, '160000', '139900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(81, 'Plancha para pelo', '/products/Tecnología/81/Plancha-para-pelo.jpeg', 2000, '1', 3, '160000', '145000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(82, 'Taladro Percutor', '/products/Tecnología/82/Taladro-Percutor.jpeg', 2000, '1', 3, '160000', '149900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(83, 'Decodificador TDT', '/products/Tecnología/83/Decodificador-TDT.jpeg', 1500, '1', 3, '120000', '159900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(84, 'Secador de pelo philips', '/products/Tecnología/84/Secador-de-pelo-philips.jpeg', 1500, '1', 3, '120000', '179900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(85, 'Afeitadora Eléctrica uso humedo y seco', '/products/Tecnología/85/Afeitadora-Electrica-uso-humedo-y-seco.jpg', 2500, '1', 3, '200000', '189900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(86, 'Disco duro 1 Tera', '/products/Tecnología/86/Disco-duro-1-Tera.jpeg', 3000, '1', 3, '240000', '249900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(87, 'Reloj Inteligente xiaomi', '/products/Tecnología/87/Reloj-Inteligente-xiaomi.jpg', 3200, '1', 3, '256000', '249900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(88, 'Plancha para pelo alisadora', '/products/Tecnología/88/Plancha-para-pelo-alisadora.jpeg', 3800, '1', 3, '304000', '309900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(89, 'Teatro en casa', '/products/Tecnología/89/Teatro-en-casa.jpg', 6000, '1', 3, '480000', '450900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(90, 'Tablet Quad Core T3-7 3G', '/products/Tecnología/90/Tablet-Quad-Core-T3-7-3G.jpeg', 6000, '1', 3, '480000', '459990', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(91, 'Smartphone', '/products/Tecnología/91/Smartphone.jpeg', 6500, '1', 3, '520000', '499900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(92, 'Smartphonej4', '/products/Tecnología/92/Smartphonej4.jpeg', 7000, '1', 3, '560000', '529900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(93, 'Apple TV  32 gb', '/products/Tecnología/93/Apple-TV-32-gb.jpg', 7500, '1', 3, '600000', '559000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(94, 'Audífonos Airpods', '/products/Tecnología/94/Audifonos-Airpods.jpeg', 8000, '1', 3, '640000', '589900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(95, 'Barra de sonido', '/products/Tecnología/95/Barra-de-sonido.jpeg', 8500, '1', 3, '680000', '799000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(96, 'Computador Portátil', '/products/Tecnología/96/Computador-Portatil.jpg', 13000, '1', 3, '1040000', '950900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(97, 'Televisor LED 32 HD Smart', '/products/Tecnología/97/Televisor-LED-32-HD-Smart.jpeg', 13000, '1', 3, '1040000', '999000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(98, 'Teatro en casa SONY', '/products/Tecnología/98/Teatro-en-casa-SONY.jpg', 13000, '1', 3, '1040000', '1029000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(99, 'Computador portátil', '/products/Tecnología/99/Computador-portatil.jpeg', 13000, '1', 3, '1040000', '1099000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(100, 'Computador All In One', '/products/Tecnología/100/Computador-All-In-One.jpg', 13500, '1', 3, '1080000', '1199000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(101, 'Apple Watch', '/products/Tecnología/101/Apple-Watch.jpeg', 15000, '1', 3, '1200000', '1269900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(102, 'Microcomponente', '/products/Tecnología/102/Microcomponente.jpg', 15000, '1', 3, '1200000', '1293000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(103, 'Ipad 97 sexta g', '/products/Tecnología/103/Ipad-97-sexta-g.jpeg', 17000, '1', 3, '1360000', '1328900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(104, 'portátil 2 en 1', '/products/Tecnología/104/portatil-2-en-1.jpg', 17000, '1', 3, '1360000', '1349000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(105, 'Smartwatch Gear S3', '/products/Tecnología/105/Smartwatch-Gear-S3.jpeg', 19000, '1', 3, '1520000', '1499900', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(106, 'Televisor LED 43 FHD Smart TV', '/products/Tecnología/106/Televisor-LED-43-FHD-Smart-TV.png', 24000, '1', 3, '1920000', '1849000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(107, 'Iphone 7 de 32gb', '/products/Tecnología/107/Iphone-7-de-32gb.jpg', 25000, '1', 3, '2000000', '1939000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(108, 'Balon Baloncesto', 'products/Regalos y Deportes/108/Balon-Baloncesto.jpg', 2000, '1', 4, '160000', '161000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(109, 'Balon Voleibol', 'products/Regalos y Deportes/109/Balon-Voleibol.jpg', 2000, '1', 4, '160000', '161000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(110, 'Balon profesional Fútbol', 'products/Regalos y Deportes/110/Balon-profesional-Futbol.jpg', 2000, '1', 4, '160000', '120000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(111, 'Balon profesional Fútbol sala', 'products/Regalos y Deportes/111/Balon-profesional-Futbol-sala.jpg', 2000, '1', 4, '160000', '145000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(112, 'first bike niño', 'products/Regalos y Deportes/112/first-bike-nino.jpg', 3500, '1', 4, '280000', '249000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(113, 'fist bike niña', 'products/Regalos y Deportes/113/bicicleta-r-16-nina.jpg', 3500, '1', 4, '280000', '249000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(114, 'bicicleta r 16 niña', 'products/Regalos y Deportes/114/fist-bike-nina.jpg', 4500, '1', 4, '360000', '350000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(115, 'bicicleta r 16 niño', 'products/Regalos y Deportes/115/bicicleta-r-16-nino.jpg', 4500, '1', 4, '360000', '350000', '2019-06-15 00:00:00', '2019-06-15 00:00:00'),
(116, 'Carpa  de 3 a 4 personas', 'products/Regalos y Deportes/116/Carpa-de-3-a-4-personas.jpeg', 5500, '1', 4, '440000', '449000', '2019-06-15 00:00:00', '2019-06-15 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_product_categories1_idx` (`product_categories_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_categories1` FOREIGN KEY (`product_categories_id`) REFERENCES `product_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
