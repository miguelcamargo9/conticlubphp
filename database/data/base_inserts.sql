-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-06-2019 a las 20:58:55
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

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'Armenia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Barranquilla', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(3, 'Bello', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(4, 'Bogotá', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(5, 'Bosconia', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(6, 'Bucaramanga', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(7, 'Cali', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(8, 'Cartagena', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(9, 'Cartago', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(10, 'Chia', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(11, 'Dos Quebradas', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(12, 'Duitama', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(13, 'Facatativa', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(14, 'Fusagasuga', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(15, 'Girardot', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(16, 'Ibague', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(17, 'Ipiales', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(18, 'Itagui', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(19, 'Manizales', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(20, 'Marinilla', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(21, 'Medellín', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(22, 'Monteria', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(23, 'Neiva', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(24, 'Pasto', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(25, 'Pereira', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(26, 'Pitalito', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(27, 'Popayan', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(28, 'Rionegro', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(29, 'Santa Marta', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(30, 'Sincelejo', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(31, 'Sogamoso', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(32, 'Tocancipa', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(33, 'Tunja', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(34, 'Valledupar', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(35, 'Villavicencio', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(36, 'Yopal', '2019-05-07 00:44:10', '2019-05-07 00:33:50'),
(37, 'Zipaquira', '2019-05-07 00:44:10', '2019-05-07 00:33:50');

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `updated_at`, `created_at`) VALUES
(1, 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'general', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'rueda', '2019-06-01 00:00:00', '2019-06-01 11:17:41'),
(4, 'aprobador', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'comprador', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Volcado de datos para la tabla `subsidiary`
--

INSERT INTO `subsidiary` (`id`, `name`, `address`, `cities_id`, `profiles_id`, `updated_at`, `created_at`) VALUES
(2, 'Batericars no. 10', NULL, 1, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(3, 'Batericars no. 8', NULL, 1, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(4, 'Merquellantas armenia', NULL, 1, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(5, 'Merquellantas barranquilla', NULL, 2, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(6, 'La rueda león tire', NULL, 2, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(7, 'Ardillantas fusa', NULL, 3, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(8, 'Csa éxito bello', NULL, 3, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(9, 'Merquellantas la felicidad', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(10, 'Al llantas', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(11, 'Ardillantas bogotá', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(12, 'Ardillantas fusa', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(13, 'Csa éxito 170', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(14, 'Csa éxito 80', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(15, 'Csa éxito villamayor', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(16, 'Dacar plus', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(17, 'Llantas beto', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(18, 'Multillantas la sabana ', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(19, 'Merquellantas bogotá', NULL, 4, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(20, 'La rueda calle 170', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(21, 'La rueda calle 80', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(22, 'La rueda carrera', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(23, 'La rueda fontibón', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(24, 'La rueda hayuelos', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(25, 'La rueda paloquemao', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(26, 'La rueda puente aranda', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(27, 'La rueda quito', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(28, 'La rueda terminal', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(29, 'La rueda normandia', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(30, 'La rueda suba', NULL, 4, 3, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(31, 'Merquellantas bosconia', NULL, 5, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(32, 'Merquellantas bucaramanga', NULL, 6, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(33, 'Transpiedecuesta', NULL, 6, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(34, 'Call llantas', NULL, 7, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(35, 'Interllantas cali', NULL, 7, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(36, 'Merquellantas cali', NULL, 7, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(37, 'Dislubrival', NULL, 8, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(38, 'Merquellantas cartagena', NULL, 8, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(39, 'Llantas mallarino', NULL, 8, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(40, 'Serviteca gomez velasquez', NULL, 9, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(41, 'Multillantas la sabana ', NULL, 10, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(42, 'Multillantas fontanar', NULL, 10, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(43, 'Merquellantas dos quebradas', NULL, 11, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(44, 'Csa duitama', NULL, 12, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(45, 'Multillantas la sabana ', NULL, 13, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(46, 'Multillantas la sabana ', NULL, 14, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(47, 'Merquellantas girardot', NULL, 15, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(48, 'Merquellantas ibague', NULL, 16, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(49, 'Batericars no. 5', NULL, 17, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(50, 'Merquellantas itagui', NULL, 18, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(51, 'Merquellantas manizales', NULL, 19, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(52, 'Keluillantas', NULL, 20, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(53, 'Casagrande', NULL, 21, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(54, 'Interllantas medellín', NULL, 21, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(55, 'Marllantas', NULL, 21, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(56, 'Servillantas la 57', NULL, 21, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(57, 'Tecnicentro eurogas', NULL, 21, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(58, 'Tecnicentro los colores', NULL, 21, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(59, 'Su llanta', NULL, 22, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(60, 'Merquellantas neiva', NULL, 23, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(61, 'Andina de llantas', NULL, 24, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(62, 'Batericars no. 4', NULL, 24, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(63, 'Batericars no. 6', NULL, 24, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(64, 'Batericars no. 7', NULL, 24, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(65, 'Csa pereira', NULL, 25, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(66, 'Est de serv de corales', NULL, 25, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(67, 'Est de serv de pereira', NULL, 25, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(68, 'Merquellantas pitalito', NULL, 26, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(69, 'Batericars no. 9', NULL, 27, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(70, 'Maxllantas', NULL, 28, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(71, 'Merquellantas santa marta', NULL, 29, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(72, 'Interllantas', NULL, 30, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(73, 'Mundillantas', NULL, 31, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(74, 'Multillantas la sabana ', NULL, 32, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(75, 'Casarana boutique', NULL, 33, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(76, 'Inprollantas ', NULL, 33, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(77, 'Merquellantas valledupar', NULL, 34, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(78, 'Merquellantas villavicencio', NULL, 35, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(79, 'Merquellantas yopal', NULL, 36, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17'),
(80, 'Multillantas la sabana ', NULL, 37, 2, '2019-06-15 11:35:17', '2019-06-15 11:35:17');

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phone`, `identification_number`, `identification_type`, `state`, `points`, `profiles_id`, `subsidiary_id`, `updated_at`, `created_at`) VALUES
(1, 'Administrador', '$2y$10$6sOHOhtD7dp5EU6ZE/vZ7.nVSXY7fGSgzXCaow1PF7UHaEpL1q7yG', 'admin@admin.com', '', '1015426224', 'C.C', 1, 0, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Víctor Bello', '$2y$10$f.aftV1G7ZFnz3N44va8C.vdu3HsZyvwm8qAYb9uxuMz9mvp/Dt8u', 'victor.bello@continental.com', '3134451459', '80852792', 'C.C', 1, 0, 4, NULL, '2019-06-15 17:15:10', '0000-00-00 00:00:00'),
(3, 'Félix Guevara', '$2y$10$ussY1kxI.XZ8nsxA3SSdtuR7YQRDY1zIv6H5WBhnKoPxO8Uq7pNIG', 'felix.guevara@continental.com', '3107620676', '79655840', 'C.C', 1, 0, 4, NULL, '2019-06-15 17:15:26', '0000-00-00 00:00:00'),
(4, 'Rosendo Russo', '$2y$10$ArxxyUdHmu9oR6xIimbyYuS1GnXn2PCljaYupqlgtKyxScCOZQw3G', 'rosendo.russo@continental.com', '3103388745', '12555389', 'C.C', 1, 0, 4, NULL, '2019-06-15 17:15:38', '0000-00-00 00:00:00'),
(5, 'Marcela Solis', '$2y$10$p968U3KOm8/u9CCN8opSAuWexYmTKMuvSFteYJOQDHZH8Vkbc7NSO', 'marcela.solis@continental.com', '3213472911', '33677808', 'C.C', 1, 0, 4, NULL, '2019-06-15 17:15:51', '0000-00-00 00:00:00'),
(6, 'Diana Páez', '$2y$10$h1DE76TGkgJGgKER4Gt6duX9oqoet8Tk8MKU/EoPAlNt4WLwTutne', 'diana.paez@continental.com', '3204218183', '52886131', 'C.C', 1, 0, 4, NULL, '2019-06-15 17:16:05', '0000-00-00 00:00:00'),
(7, 'Juan Carlos Rosado', '$2y$10$8nLyeTlzB8Ug9fKQKYHMKOVe7ayDczwheR3/D3X4sRn9tXmwVVtr.', 'juan.rosado@continental.com', '3134830817', '87215150', 'C.C', 1, 0, 4, NULL, '2019-06-15 17:16:23', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
