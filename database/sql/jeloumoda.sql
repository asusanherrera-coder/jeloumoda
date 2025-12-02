-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2025 a las 08:26:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jeloumoda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_producto` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `id_talla` int(10) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `fecha_agregado` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_producto`, `nombre`, `categoria`, `precio`, `id_talla`, `descripcion`, `stock`, `imagen`, `estado`, `fecha_agregado`) VALUES
(1, 'Baggy Jeans Celeste con bolsillo', 'pantalon', 50.00, 4, 'jean con muchos bolsillos', 80, 'BAGGYJEANS/CONBOLCILLO/Celeste.jpg', 'activo', '2025-08-04 03:06:05'),
(2, 'Baggy Jeans Celeste con bolsillo', 'pantalon', 50.00, 5, '', 80, 'BAGGYJEANS/CONBOLCILLO/Celeste.jpg', 'activo', '2025-08-04 03:06:05'),
(3, 'Baggy Jeans Celeste con bolsillo', 'pantalon', 50.00, 6, '', 80, 'BAGGYJEANS/CONBOLCILLO/Celeste.jpg', 'activo', '2025-08-04 03:06:05'),
(4, 'Baggy Jeans con Bolsillo color Clásico', 'pantalon', 50.00, 4, '', 80, 'BAGGYJEANS/CONBOLCILLO/clasico.jpg', 'activo', '2025-08-04 03:06:05'),
(5, 'Baggy Jeans con Bolsillo color Clásico', 'pantalon', 50.00, 5, '', 80, 'BAGGYJEANS/CONBOLCILLO/clasico.jpg', 'activo', '2025-08-04 03:06:05'),
(6, 'Baggy Jeans con Bolsillo color Clásico', 'pantalon', 50.00, 6, '', 80, 'BAGGYJEANS/CONBOLCILLO/clasico.jpg', 'activo', '2025-08-04 03:06:05'),
(7, 'Baggy Jeans con Bolsillo color Negro', 'pantalon', 50.00, 4, '', 80, 'BAGGYJEANS/CONBOLCILLO/negro.jpg', 'activo', '2025-08-04 03:06:05'),
(8, 'Baggy Jeans con Bolsillo color Negro', 'pantalon', 50.00, 5, '', 80, 'BAGGYJEANS/CONBOLCILLO/negro.jpg', 'activo', '2025-08-04 03:06:05'),
(9, 'Baggy Jeans con Bolsillo color Negro', 'pantalon', 50.00, 6, '', 80, 'BAGGYJEANS/CONBOLCILLO/negro.jpg', 'activo', '2025-08-04 03:06:05'),
(10, 'Baggy Jeans Rasgado azul', 'pantalon', 55.00, 4, '', 80, 'BAGGYJEANS/RASGADOS/AZUL.jpg', 'activo', '2025-08-04 03:06:05'),
(11, 'Baggy Jeans Rasgado azul', 'pantalon', 55.00, 5, '', 80, 'BAGGYJEANS/RASGADOS/AZUL.jpg', 'activo', '2025-08-04 03:06:05'),
(12, 'Baggy Jeans Rasgado azul', 'pantalon', 55.00, 6, '', 80, 'BAGGYJEANS/RASGADOS/AZUL.jpg', 'activo', '2025-08-04 03:06:05'),
(13, 'Baggy Jeans Rasgado celeste', 'pantalon', 55.00, 4, '', 80, 'BAGGYJEANS/RASGADOS/CELESTE.jpg', 'activo', '2025-08-04 03:06:05'),
(14, 'Baggy Jeans Rasgado celeste', 'pantalon', 55.00, 5, '', 80, 'BAGGYJEANS/RASGADOS/CELESTE.jpg', 'activo', '2025-08-04 03:06:05'),
(15, 'Baggy Jeans Rasgado celeste', 'pantalon', 55.00, 6, '', 80, 'BAGGYJEANS/RASGADOS/CELESTE.jpg', 'activo', '2025-08-04 03:06:05'),
(16, 'Baggy Jeans Rasgado negro', 'pantalon', 55.00, 4, '', 80, 'BAGGYJEANS/RASGADOS/NEGRO.jpg', 'activo', '2025-08-04 03:06:05'),
(17, 'Baggy Jeans Rasgado negro', 'pantalon', 55.00, 5, '', 80, 'BAGGYJEANS/RASGADOS/NEGRO.jpg', 'activo', '2025-08-04 03:06:05'),
(18, 'Baggy Jeans Rasgado negro', 'pantalon', 55.00, 6, '', 80, 'BAGGYJEANS/RASGADOS/NEGRO.jpg', 'activo', '2025-08-04 03:06:05'),
(19, 'Baggy Jeans sin Bolsillo azul', 'pantalon', 45.00, 4, '', 80, 'BAGGYJEANS/SINBOLSILLO/Azul.jpg', 'activo', '2025-08-04 03:06:05'),
(20, 'Baggy Jeans sin Bolsillo azul', 'pantalon', 45.00, 5, '', 80, 'BAGGYJEANS/SINBOLSILLO/Azul.jpg', 'activo', '2025-08-04 03:06:05'),
(21, 'Baggy Jeans sin Bolsillo azul', 'pantalon', 45.00, 6, '', 80, 'BAGGYJEANS/SINBOLSILLO/Azul.jpg', 'activo', '2025-08-04 03:06:05'),
(22, 'Baggy Jeans sin Bolsillo Beige', 'pantalon', 45.00, 4, '', 80, 'BAGGYJEANS/SINBOLSILLO/Beige.jpg', 'activo', '2025-08-04 03:40:00'),
(23, 'Baggy Jeans sin Bolsillo Beige', 'pantalon', 45.00, 5, '', 80, 'BAGGYJEANS/SINBOLSILLO/Beige.jpg', 'activo', '2025-08-04 03:40:00'),
(24, 'Baggy Jeans sin Bolsillo Beige', 'pantalon', 45.00, 6, '', 80, 'BAGGYJEANS/SINBOLSILLO/Beige.jpg', 'activo', '2025-08-04 03:40:00'),
(25, 'Baggy Jeans sin Bolsillo Celeste', 'pantalon', 45.00, 4, '', 80, 'BAGGYJEANS/SINBOLSILLO/Celeste.jpg', 'activo', '2025-08-04 03:40:00'),
(26, 'Baggy Jeans sin Bolsillo Celeste', 'pantalon', 45.00, 5, '', 80, 'BAGGYJEANS/SINBOLSILLO/Celeste.jpg', 'activo', '2025-08-04 03:40:00'),
(27, 'Baggy Jeans sin Bolsillo Celeste', 'pantalon', 45.00, 6, '', 80, 'BAGGYJEANS/SINBOLSILLO/Celeste.jpg', 'activo', '2025-08-04 03:40:00'),
(28, 'Baggy Jeans sin Bolsillo Clasico', 'pantalon', 45.00, 4, '', 80, 'BAGGYJEANS/SINBOLSILLO/Clasico.jpg', 'activo', '2025-08-04 03:40:00'),
(29, 'Baggy Jeans sin Bolsillo Clasico', 'pantalon', 45.00, 5, '', 80, 'BAGGYJEANS/SINBOLSILLO/Clasico.jpg', 'activo', '2025-08-04 03:40:00'),
(30, 'Baggy Jeans sin Bolsillo Clasico', 'pantalon', 45.00, 6, '', 80, 'BAGGYJEANS/SINBOLSILLO/Clasico.jpg', 'activo', '2025-08-04 03:40:00'),
(31, 'Baggy Jeans sin Bolsillo Negro', 'pantalon', 45.00, 4, '', 80, 'BAGGYJEANS/SINBOLSILLO/Negro.jpg', 'activo', '2025-08-04 03:40:00'),
(32, 'Baggy Jeans sin Bolsillo Negro', 'pantalon', 45.00, 5, '', 80, 'BAGGYJEANS/SINBOLSILLO/Negro.jpg', 'activo', '2025-08-04 03:40:00'),
(33, 'Baggy Jeans sin Bolsillo Negro', 'pantalon', 45.00, 6, '', 80, 'BAGGYJEANS/SINBOLSILLO/Negro.jpg', 'activo', '2025-08-04 03:40:00'),
(34, 'Baggy Jeans sin Bolsillo Vintage', 'pantalon', 45.00, 4, '', 80, 'BAGGYJEANS/SINBOLSILLO/Vintage.jpg', 'activo', '2025-08-04 03:40:00'),
(35, 'Baggy Jeans sin Bolsillo Vintage', 'pantalon', 45.00, 5, '', 80, 'BAGGYJEANS/SINBOLSILLO/Vintage.jpg', 'activo', '2025-08-04 03:40:00'),
(36, 'Baggy Jeans sin Bolsillo Vintage', 'pantalon', 45.00, 6, '', 80, 'BAGGYJEANS/SINBOLSILLO/Vintage.jpg', 'activo', '2025-08-04 03:40:00'),
(37, 'Crop top blanco', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGACORTA/crop-top-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(38, 'Crop top blanco', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGACORTA/crop-top-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(39, 'Crop top blanco', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGACORTA/crop-top-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(40, 'Crop top coral', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGACORTA/crop-top-coral.jpg', 'activo', '2025-08-04 03:40:00'),
(41, 'Crop top coral', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGACORTA/crop-top-coral.jpg', 'activo', '2025-08-04 03:40:00'),
(42, 'Crop top coral', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGACORTA/crop-top-coral.jpg', 'activo', '2025-08-04 03:40:00'),
(43, 'Crop top lila', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGACORTA/crop-top-lila.jpg', 'activo', '2025-08-04 03:40:00'),
(44, 'Crop top lila', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGACORTA/crop-top-lila.jpg', 'activo', '2025-08-04 03:40:00'),
(45, 'Crop top lila', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGACORTA/crop-top-lila.jpg', 'activo', '2025-08-04 03:40:00'),
(46, 'Crop top negro', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGACORTA/crop-top-negro.jpg', 'activo', '2025-08-04 03:40:00'),
(47, 'Crop top negro', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGACORTA/crop-top-negro.jpg', 'activo', '2025-08-04 03:40:00'),
(48, 'Crop top negro', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGACORTA/crop-top-negro.jpg', 'activo', '2025-08-04 03:40:00'),
(49, 'Crop top negro y blanco', 'polo', 25.00, 1, '', 50, 'POLOS/DEMANGACORTA/crop-top-negro-y-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(50, 'Crop top negro y blanco', 'polo', 25.00, 2, '', 50, 'POLOS/DEMANGACORTA/crop-top-negro-y-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(51, 'Crop top negro y blanco', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGACORTA/crop-top-negro-y-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(52, 'Crop top rosa y blanco', 'polo', 25.00, 1, '', 50, 'POLOS/DEMANGACORTA/crop-top-rosa-y-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(53, 'Crop top rosa y blanco', 'polo', 25.00, 2, '', 50, 'POLOS/DEMANGACORTA/crop-top-rosa-y-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(54, 'Crop top rosa y blanco', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGACORTA/crop-top-rosa-y-blanco.jpg', 'activo', '2025-08-04 03:40:00'),
(55, 'De manga larga beige con detalle', 'polo', 25.00, 1, '', 50, 'POLOS/DEMANGALARGA/beish-con-detalle.jpg', 'activo', '2025-08-04 03:40:00'),
(56, 'De manga larga beige con detalle', 'polo', 25.00, 2, '', 50, 'POLOS/DEMANGALARGA/beish-con-detalle.jpg', 'activo', '2025-08-04 03:40:00'),
(57, 'De manga larga beige con detalle', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGALARGA/beish-con-detalle.jpg', 'activo', '2025-08-04 03:40:00'),
(58, 'De manga larga blanco con encaje', 'polo', 25.00, 1, '', 50, 'POLOS/DEMANGALARGA/blanco-con-encaje.jpg', 'activo', '2025-08-04 03:40:00'),
(59, 'De manga larga blanco con encaje', 'polo', 25.00, 2, '', 50, 'POLOS/DEMANGALARGA/blanco-con-encaje.jpg', 'activo', '2025-08-04 03:40:00'),
(60, 'De manga larga blanco con encaje', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGALARGA/blanco-con-encaje.jpg', 'activo', '2025-08-04 03:40:00'),
(61, 'De manga larga negro con encaje', 'polo', 25.00, 1, '', 50, 'POLOS/DEMANGALARGA/negro-con-encaje.jpg', 'activo', '2025-08-04 03:40:00'),
(62, 'De manga larga negro con encaje', 'polo', 25.00, 2, '', 50, 'POLOS/DEMANGALARGA/negro-con-encaje.jpg', 'activo', '2025-08-04 03:40:00'),
(63, 'De manga larga negro con encaje', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGALARGA/negro-con-encaje.jpg', 'activo', '2025-08-04 03:40:00'),
(64, 'De manga larga rojo con detalle', 'polo', 25.00, 1, '', 80, 'POLOS/DEMANGALARGA/rojo-con-detalle.jpg', 'activo', '2025-08-04 03:58:09'),
(65, 'De manga larga rojo con detalle', 'polo', 25.00, 2, ' ', 80, 'POLOS/DEMANGALARGA/rojo-con-detalle.jpg', 'activo', '2025-08-04 03:58:09'),
(66, 'De manga larga rojo con detalle', 'polo', 25.00, 3, '', 80, 'POLOS/DEMANGALARGA/rojo-con-detalle.jpg', 'activo', '2025-08-04 03:58:09'),
(67, 'De manga larga beige con cuello', 'polo', 25.00, 1, '', 80, 'POLOS/DEMANGALARGA/largo-beish-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(68, 'De manga larga beige con cuello', 'polo', 25.00, 2, '', 80, 'POLOS/DEMANGALARGA/largo-beish-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(69, 'De manga larga beige con cuello', 'polo', 25.00, 3, '', 80, 'POLOS/DEMANGALARGA/largo-beish-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(70, 'De manga larga blanco con cuello', 'polo', 25.00, 1, '', 80, 'POLOS/DEMANGALARGA/largo-blanco-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(71, 'De manga larga blanco con cuello', 'polo', 25.00, 2, '', 80, 'POLOS/DEMANGALARGA/largo-blanco-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(72, 'De manga larga blanco con cuello', 'polo', 25.00, 3, '', 80, 'POLOS/DEMANGALARGA/largo-blanco-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(73, 'De manga larga guinda con cuello', 'polo', 25.00, 1, '', 80, 'POLOS/DEMANGALARGA/largo-guinda-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(74, 'De manga larga guinda con cuello', 'polo', 25.00, 2, '', 80, 'POLOS/DEMANGALARGA/largo-guinda-cuello.jpg', 'activo', '2025-08-04 03:58:09'),
(75, 'De manga larga guinda con cuello', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGALARGA/largo-guinda-cuello.jpg', 'activo', '2025-08-04 04:08:58'),
(76, 'De manga larga negro con cuello', 'polo', 25.00, 1, '', 50, 'POLOS/DEMANGALARGA/largo-negro-cuello.jpg', 'activo', '2025-08-04 06:13:39'),
(77, 'De manga larga negro con cuello', 'polo', 25.00, 2, '', 50, 'POLOS/DEMANGALARGA/largo-negro-cuello.jpg', 'activo', '2025-08-04 06:13:39'),
(78, 'De manga larga negro con cuello', 'polo', 25.00, 3, '', 50, 'POLOS/DEMANGALARGA/largo-negro-cuello.jpg', 'activo', '2025-08-04 06:13:39'),
(79, 'De manga larga blanco simple', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGALARGA/largo-blanco-simple.jpg', 'activo', '2025-08-04 06:13:39'),
(80, 'De manga larga blanco simple', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGALARGA/largo-blanco-simple.jpg', 'activo', '2025-08-04 06:13:39'),
(81, 'De manga larga blanco simple', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGALARGA/largo-blanco-simple.jpg', 'activo', '2025-08-04 06:13:39'),
(82, 'De manga larga gris simple', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGALARGA/largo-gris-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(83, 'De manga larga gris simple', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGALARGA/largo-gris-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(84, 'De manga larga gris simple', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGALARGA/largo-gris-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(85, 'De manga larga negro simple', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGALARGA/largo-negro-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(86, 'De manga larga negro simple', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGALARGA/largo-negro-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(87, 'De manga larga negro simple', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGALARGA/largo-negro-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(88, 'De manga larga palo rosa simple', 'polo', 20.00, 1, '', 50, 'POLOS/DEMANGALARGA/largo-palo-rosa-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(89, 'De manga larga palo rosa simple', 'polo', 20.00, 2, '', 50, 'POLOS/DEMANGALARGA/largo-palo-rosa-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(90, 'De manga larga palo rosa simple', 'polo', 20.00, 3, '', 50, 'POLOS/DEMANGALARGA/largo-palo-rosa-simple.jpg', 'activo', '2025-08-04 06:26:15'),
(91, 'Bibidi celeste', 'polo', 18.00, 1, '', 50, 'POLOS/SINMAGAS/bibidi-celeste.jpg', 'activo', '2025-08-04 06:34:46'),
(92, 'Bibidi celeste', 'polo', 18.00, 2, '', 50, 'POLOS/SINMAGAS/bibidi-celeste.jpg', 'activo', '2025-08-04 06:34:46'),
(93, 'Bibidi celeste', 'polo', 18.00, 3, '', 50, 'POLOS/SINMAGAS/bibidi-celeste.jpg', 'activo', '2025-08-04 06:34:46'),
(94, 'Bibidi guinda', 'polo', 18.00, 1, '', 50, 'POLOS/SINMAGAS/bibidi-guinda.jpg', 'activo', '2025-08-04 06:34:46'),
(95, 'Bibidi guinda', 'polo', 18.00, 2, '', 50, 'POLOS/SINMAGAS/bibidi-guinda.jpg', 'activo', '2025-08-04 06:34:46'),
(96, 'Bibidi guinda', 'polo', 18.00, 3, '', 50, 'POLOS/SINMAGAS/bibidi-guinda.jpg', 'activo', '2025-08-04 06:34:46'),
(97, 'Bibidi lila', 'polo', 18.00, 1, '', 50, 'POLOS/SINMAGAS/bibidi-lila.jpg', 'activo', '2025-08-04 22:29:58'),
(98, 'Bibidi lila', 'polo', 18.00, 2, '', 50, 'POLOS/SINMAGAS/bibidi-lila.jpg', 'activo', '2025-08-04 06:34:46'),
(99, 'Bibidi lila', 'polo', 18.00, 3, '', 50, 'POLOS/SINMAGAS/bibidi-lila.jpg', 'activo', '2025-08-04 06:34:46'),
(100, 'Bibidi negro', 'polo', 18.00, 1, '', 50, 'POLOS/SINMAGAS/bibidi-negro.jpg', 'activo', '2025-08-04 06:43:22'),
(101, 'Bibidi negro', 'polo', 18.00, 2, '', 50, 'POLOS/SINMAGAS/bibidi-negro.jpg', 'activo', '2025-08-04 06:43:22'),
(102, 'Bibidi negro', 'polo', 18.00, 3, '', 50, 'POLOS/SINMAGAS/bibidi-negro.jpg', 'activo', '2025-08-04 06:43:22'),
(103, 'Bibidi rosado claro', 'polo', 18.00, 1, '', 50, 'POLOS/SINMAGAS/bibidi-rosado-claro.jpg', 'activo', '2025-08-04 06:43:22'),
(104, 'Bibidi rosado claro', 'polo', 18.00, 2, '', 50, 'POLOS/SINMAGAS/bibidi-rosado-claro.jpg', 'activo', '2025-08-04 06:43:22'),
(105, 'Bibidi rosado claro', 'polo', 18.00, 3, '', 50, 'POLOS/SINMAGAS/bibidi-rosado-claro.jpg', 'activo', '2025-08-04 06:43:22'),
(106, 'Bibidi rosado', 'polo', 18.00, 1, '', 50, 'POLOS/SINMAGAS/bibidi-rosado.jpg', 'activo', '2025-08-04 06:50:29'),
(107, 'Bibidi rosado', 'polo', 18.00, 2, '', 50, 'POLOS/SINMAGAS/bibidi-rosado.jpg', 'activo', '2025-08-04 06:50:29'),
(108, 'Bibidi rosado', 'polo', 18.00, 3, '', 50, 'POLOS/SINMAGAS/bibidi-rosado.jpg', 'activo', '2025-08-04 06:50:29'),
(109, 'Bibidi blanco simple', 'polo', 15.00, 1, '', 50, 'POLOS/SINMAGAS/blanco-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(110, 'Bibidi blanco simple', 'polo', 15.00, 2, '', 50, 'POLOS/SINMAGAS/blanco-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(111, 'Bibidi blanco simple', 'polo', 15.00, 3, '', 50, 'POLOS/SINMAGAS/blanco-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(112, 'Bibidi marrón simple', 'polo', 15.00, 1, '', 50, 'POLOS/SINMAGAS/marron-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(113, 'Bibidi marrón simple', 'polo', 15.00, 2, '', 50, 'POLOS/SINMAGAS/marron-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(114, 'Bibidi marrón simple', 'polo', 15.00, 3, '', 50, 'POLOS/SINMAGAS/marron-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(115, 'Bibidi negro simple', 'polo', 15.00, 1, '', 50, 'POLOS/SINMAGAS/negro-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(116, 'Bibidi negro simple', 'polo', 15.00, 2, '', 50, 'POLOS/SINMAGAS/negro-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(117, 'Bibidi negro simple', 'polo', 15.00, 3, '', 50, 'POLOS/SINMAGAS/negro-simple.jpg', 'activo', '2025-08-04 06:50:29'),
(118, 'Tank crop top color Azul', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-azul.jpg', 'activo', '2025-08-04 07:03:32'),
(119, 'Tank crop top color Azul', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-azul.jpg', 'activo', '2025-08-04 22:40:16'),
(120, 'Tank crop top color Azul', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-azul.jpg', 'activo', '2025-08-04 07:03:32'),
(121, 'Tank crop top color Beige', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-beige.jpg', 'activo', '2025-08-04 07:03:32'),
(122, 'Tank crop top color Beige', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-beige.jpg', 'activo', '2025-08-04 07:03:32'),
(123, 'Tank crop top color Beige', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-beige.jpg', 'activo', '2025-08-04 07:03:32'),
(124, 'Tank crop top color Naranja', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-naranja.jpg', 'activo', '2025-08-04 07:03:32'),
(125, 'Tank crop top color Naranja', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-naranja.jpg', 'activo', '2025-08-04 07:03:32'),
(126, 'Tank crop top color Naranja', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-naranja.jpg', 'activo', '2025-08-04 07:03:32'),
(127, 'Tank crop top color Negro', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-negro.jpg', 'activo', '2025-08-04 07:12:17'),
(128, 'Tank crop top color Negro', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-negro.jpg', 'activo', '2025-08-04 07:12:17'),
(129, 'Tank crop top color Negro', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-negro.jpg', 'activo', '2025-08-04 07:12:17'),
(130, 'Tank crop top color Rojo', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-rojo.jpg', 'activo', '2025-08-04 07:12:17'),
(131, 'Tank crop top color Rojo', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-rojo.jpg', 'activo', '2025-08-04 07:12:17'),
(132, 'Tank crop top color Rojo', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-rojo.jpg', 'activo', '2025-08-04 07:12:17'),
(133, 'Tank crop top color Rosa', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-rosa.jpg', 'activo', '2025-08-04 07:12:17'),
(134, 'Tank crop top color Rosa', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-rosa.jpg', 'activo', '2025-08-04 07:12:17'),
(135, 'Tank crop top color Rosa', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-rosa.jpg', 'activo', '2025-08-04 07:12:17'),
(136, 'Tank crop top color Verde', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/tank-crop-top-verde.jpg', 'activo', '2025-08-04 07:12:17'),
(137, 'Tank crop top color Verde', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/tank-crop-top-verde.jpg', 'activo', '2025-08-04 07:12:17'),
(138, 'Tank crop top color Verde', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/tank-crop-top-verde.jpg', 'activo', '2025-08-04 07:12:17'),
(139, 'Crop top Azul sin mangas', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/CROP-TOP-AZUL.jpg', 'activo', '2025-08-04 07:22:09'),
(140, 'Crop top Azul sin mangas', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/CROP-TOP-AZUL.jpg', 'activo', '2025-08-04 07:22:09'),
(141, 'Crop top Azul sin mangas', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/CROP-TOP-AZUL.jpg', 'activo', '2025-08-04 07:22:09'),
(142, 'Crop top Blanco sin mangas', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/CROP-TOP-BLANCO.jpg', 'activo', '2025-08-04 07:22:09'),
(143, 'Crop top Blanco sin mangas', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/CROP-TOP-BLANCO.jpg', 'activo', '2025-08-04 07:22:09'),
(144, 'Crop top Blanco sin mangas', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/CROP-TOP-BLANCO.jpg', 'activo', '2025-08-04 07:22:09'),
(145, 'Crop top Celeste sin mangas', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/CROP-TOP-CELESTE.jpg', 'activo', '2025-08-04 07:22:09'),
(146, 'Crop top Celeste sin mangas', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/CROP-TOP-CELESTE.jpg', 'activo', '2025-08-04 07:22:09'),
(147, 'Crop top Celeste sin mangas', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/CROP-TOP-CELESTE.jpg', 'activo', '2025-08-04 07:22:09'),
(148, 'Crop top Marrón sin mangas', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/CROP-TOP-MARRON.jpg', 'activo', '2025-08-04 07:22:09'),
(149, 'Crop top Marrón sin mangas', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/CROP-TOP-MARRON.jpg', 'activo', '2025-08-04 07:22:09'),
(150, 'Crop top Marrón sin mangas', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/CROP-TOP-MARRON.jpg', 'activo', '2025-08-04 07:22:09'),
(151, 'Crop top Negro sin mangas', 'polo', 16.00, 1, '', 50, 'POLOS/SINMAGAS/CROP-TOP-NEGRO.jpg', 'activo', '2025-08-04 07:22:09'),
(152, 'Crop top Negro sin mangas', 'polo', 16.00, 2, '', 50, 'POLOS/SINMAGAS/CROP-TOP-NEGRO.jpg', 'activo', '2025-08-04 07:22:09'),
(153, 'Crop top Negro sin mangas', 'polo', 16.00, 3, '', 50, 'POLOS/SINMAGAS/CROP-TOP-NEGRO.jpg', 'activo', '2025-08-04 07:22:09'),
(154, 'Zapatillas Adidas color blanco', 'zapatilla', 40.00, 8, '', 60, 'ZAPATILLAS/ADIDAS/adidas-blancas.jpg', 'activo', '2025-08-04 07:39:00'),
(155, 'Zapatillas Adidas color blanco', 'zapatilla', 60.00, 9, '', 60, 'ZAPATILLAS/ADIDAS/adidas-blancas.jpg', 'activo', '2025-08-04 07:39:00'),
(156, 'Zapatillas Adidas color blanco', 'zapatilla', 40.00, 10, '', 60, 'ZAPATILLAS/ADIDAS/adidas-blancas.jpg', 'activo', '2025-08-04 07:39:00'),
(157, 'Zapatillas Adidas color negro', 'zapatilla', 60.00, 8, '', 60, 'ZAPATILLAS/ADIDAS/adidas-negras.jpg', 'activo', '2025-08-04 07:39:00'),
(158, 'Zapatillas Adidas color negro', 'zapatilla', 60.00, 9, '', 60, 'ZAPATILLAS/ADIDAS/adidas-negras.jpg', 'activo', '2025-08-04 07:39:00'),
(159, 'Zapatillas Adidas color negro', 'zapatilla', 60.00, 10, '', 60, 'ZAPATILLAS/ADIDAS/adidas-negras.jpg', 'activo', '2025-08-04 07:39:00'),
(160, 'Zapatillas Adidas samba blancas', 'zapatilla', 36.00, 8, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-blancas.jpg', 'activo', '2025-08-04 07:39:00'),
(161, 'Zapatillas Adidas samba blancas', 'zapatilla', 36.00, 9, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-blancas.jpg', 'activo', '2025-08-04 07:39:00'),
(162, 'Zapatillas Adidas samba blancas', 'zapatilla', 36.00, 10, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-blancas.jpg', 'activo', '2025-08-04 07:39:00'),
(163, 'Zapatillas Adidas samba negras', 'zapatilla', 36.00, 8, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-negras.jpg', 'activo', '2025-08-04 07:39:00'),
(164, 'Zapatillas Adidas samba negras', 'zapatilla', 36.00, 9, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-negras.jpg', 'activo', '2025-08-04 07:39:00'),
(165, 'Zapatillas Adidas samba negras', 'zapatilla', 36.00, 10, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-negras.jpg', 'activo', '2025-08-04 07:39:00'),
(166, 'Zapatillas Adidas samba lineas rosa', 'zapatilla', 36.00, 8, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-con-lineas-rosas.jpg', 'activo', '2025-08-04 07:39:00'),
(167, 'Zapatillas Adidas samba lineas rosa', 'zapatilla', 36.00, 9, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-con-lineas-rosas.jpg', 'activo', '2025-08-04 07:39:00'),
(168, 'Zapatillas Adidas samba lineas rosa', 'zapatilla', 36.00, 10, '', 60, 'ZAPATILLAS/ADIDAS/SAMBA/samba-con-lineas-rosas.jpg', 'activo', '2025-08-04 07:39:00'),
(169, 'Zapatillas Nike air force 1 blancas', 'zapatilla', 40.00, 8, '', 60, 'ZAPATILLAS/NIKE/air-force-1-blancas.jpg', 'activo', '2025-08-04 07:56:18'),
(170, 'Zapatillas Nike air force 1 blancas', 'zapatilla', 40.00, 9, '', 60, 'ZAPATILLAS/NIKE/air-force-1-blancas.jpg', 'activo', '2025-08-04 07:56:18'),
(171, 'Zapatillas Nike air force 1 blancas', 'zapatilla', 40.00, 10, '', 60, 'ZAPATILLAS/NIKE/air-force-1-blancas.jpg', 'activo', '2025-08-04 07:56:18'),
(172, 'Zapatillas Nike air force 1 negras', 'zapatilla', 40.00, 8, '', 60, 'ZAPATILLAS/NIKE/air-force-1-negras.jpg', 'activo', '2025-08-04 07:56:18'),
(173, 'Zapatillas Nike air force 1 negras', 'zapatilla', 40.00, 9, '', 60, 'ZAPATILLAS/NIKE/air-force-1-negras.jpg', 'activo', '2025-08-04 07:56:18'),
(174, 'Zapatillas Nike air force 1 negras', 'zapatilla', 40.00, 10, '', 60, 'ZAPATILLAS/NIKE/air-force-1-negras.jpg', 'activo', '2025-08-04 07:56:18'),
(175, 'Zapatillas Nike color blanco con negro', 'zapatilla', 40.00, 8, '', 60, 'ZAPATILLAS/NIKE/blanco-con-negro.jpg', 'activo', '2025-08-04 07:56:18'),
(176, 'Zapatillas Nike color blanco con negro', 'zapatilla', 40.00, 9, '', 60, 'ZAPATILLAS/NIKE/blanco-con-negro.jpg', 'activo', '2025-08-04 07:56:18'),
(177, 'Zapatillas Nike color blanco con negro', 'zapatilla', 40.00, 10, '', 60, 'ZAPATILLAS/NIKE/blanco-con-negro.jpg', 'activo', '2025-08-04 07:56:18'),
(178, 'Gorra Brooklyn color Azul', 'gorra', 20.00, 12, '', 60, 'GORRAS/brooklyn-azul.jpg', 'activo', '2025-08-04 08:06:00'),
(179, 'Gorra Brooklyn color Gris', 'gorra', 20.00, 12, '', 60, 'GORRAS/brooklyn-gris.jpg', 'activo', '2025-08-04 08:06:00'),
(180, 'Gorra Brooklyn color Marrón', 'gorra', 20.00, 12, '', 60, 'GORRAS/brooklyn-marron.jpg', 'activo', '2025-08-04 08:06:00'),
(181, 'Gorra Brooklyn color Plomo', 'gorra', 20.00, 12, '', 60, 'GORRAS/brooklyn-plomo.jpg', 'activo', '2025-08-04 08:06:00'),
(182, 'Gorra Brooklyn color Verde', 'gorra', 20.00, 12, '', 60, 'GORRAS/brooklyn-verde.jpg', 'activo', '2025-08-04 08:06:00'),
(183, 'Gorra Los Angeles color Beige', 'gorra', 20.00, 12, '', 60, 'GORRAS/los-angeles-beige.jpg', 'activo', '2025-08-04 08:06:00'),
(184, 'Gorra Los Angeles color Guinda', 'gorra', 20.00, 12, '', 60, 'GORRAS/los-angeles-guinda.jpg', 'activo', '2025-08-04 08:06:00'),
(185, 'Gorra Los Angeles color Plomo', 'gorra', 20.00, 12, '', 60, 'GORRAS/los-angeles-plomo.jpg', 'activo', '2025-08-04 08:06:00'),
(186, 'Gorra Los Angeles color Verde amarillo', 'gorra', 20.00, 12, '', 60, 'GORRAS/los-angeles-verde-amarillo.jpg', 'activo', '2025-08-04 08:06:00'),
(187, 'Gorra Los Angeles color Verde', 'gorra', 20.00, 12, '', 60, 'GORRAS/los-angeles-verde.jpg', 'activo', '2025-08-04 08:06:00'),
(188, 'Gorra New York color Azul', 'gorra', 20.00, 12, '', 60, 'GORRAS/new-york-azul.jpg', 'activo', '2025-08-04 08:06:00'),
(189, 'Gorra New York color Marrón', 'gorra', 20.00, 12, '', 60, 'GORRAS/new-york-marron.jpg', 'activo', '2025-08-04 08:06:00'),
(190, 'Gorra New York color Plomo', 'gorra', 20.00, 12, '', 60, 'GORRAS/new-york-plomo.jpg', 'activo', '2025-08-04 08:06:00'),
(191, 'Gorra New York color Rosa oscuro', 'gorra', 20.00, 12, '', 60, 'GORRAS/new-york-rosa-oscuro.jpg', 'activo', '2025-08-04 08:06:00'),
(192, 'Gorra New York color Verde', 'gorra', 20.00, 12, '', 60, 'GORRAS/new-york-verde.jpg', 'activo', '2025-08-04 08:06:00'),
(193, 'Bufanda color Azul', 'bufanda', 18.00, 12, '', 30, 'BUFANDAS/bufanda-azul.jpg', 'activo', '2025-08-04 08:37:07'),
(194, 'Bufanda color Beige', 'bufanda', 18.00, 12, '', 30, 'BUFANDAS/bufanda-beish.jpg', 'activo', '2025-08-04 08:37:07'),
(195, 'Bufanda color Naranja', 'bufanda', 18.00, 12, '', 30, 'BUFANDAS/bufanda-naranja.jpg', 'activo', '2025-08-04 08:37:07'),
(196, 'Bufanda color Negro', 'bufanda', 18.00, 12, '', 30, 'BUFANDAS/bufanda-negra.jpg', 'activo', '2025-08-04 08:37:07'),
(197, 'Bufanda color Rojo', 'bufanda', 18.00, 12, '', 30, 'BUFANDAS/bufanda-roja.jpg', 'activo', '2025-08-04 08:37:07'),
(198, 'Bolso color Beige con bolsillos', 'bolso', 25.00, 12, '', 40, 'BOLSAS/bolsa-beish-con-bolsillos.jpg', 'activo', '2025-08-04 08:37:07'),
(199, 'Bolso color Negro con bolsillos', 'bolso', 25.00, 12, '', 40, 'BOLSAS/bolsa-negra-con-bolsillos.jpg', 'activo', '2025-08-04 08:37:07'),
(200, 'Bolso sencillo color Beige', 'bolso', 20.00, 12, '', 40, 'BOLSAS/bolsa-beish.jpg', 'activo', '2025-08-04 08:37:07'),
(201, 'Bolso sencillo color Negro', 'bolso', 20.00, 12, '', 40, 'BOLSAS/bolsa-negra.jpg', 'activo', '2025-08-04 08:37:07'),
(202, 'Bolso sencillo color Rojo', 'bolso', 20.00, 12, '', 40, 'BOLSAS/bolsa-roja.jpg', 'activo', '2025-08-04 08:37:07'),
(203, 'Pijama color Guinda con encaje', 'pijama', 28.00, 1, '', 30, 'PIJAMAS/pijama-con-encaje-guinda.jpg', 'activo', '2025-08-04 08:50:13'),
(204, 'Pijama color Guinda con encaje', 'pijama', 28.00, 2, '', 30, 'PIJAMAS/pijama-con-encaje-guinda.jpg', 'activo', '2025-08-04 08:50:13'),
(205, 'Pijama color Guinda con encaje', 'pijama', 28.00, 3, '', 30, 'PIJAMAS/pijama-con-encaje-guinda.jpg', 'activo', '2025-08-04 08:50:13'),
(206, 'Pijama color Negro con encaje', 'pijama', 28.00, 1, '', 30, 'PIJAMAS/pijama-con-encaje-negro.jpg', 'activo', '2025-08-04 08:50:13'),
(207, 'Pijama color Negro con encaje', 'pijama', 28.00, 2, '', 30, 'PIJAMAS/pijama-con-encaje-negro.jpg', 'activo', '2025-08-04 08:50:13'),
(208, 'Pijama color Negro con encaje', 'pijama', 28.00, 3, '', 30, 'PIJAMAS/pijama-con-encaje-negro.jpg', 'activo', '2025-08-04 08:50:13'),
(209, 'Pijama de Lineas rosas', 'pijama', 28.00, 1, '', 30, 'PIJAMAS/pijama-lineas-rosas.jpg', 'activo', '2025-08-04 08:50:13'),
(210, 'Pijama de Lineas rosas', 'pijama', 28.00, 2, '', 30, 'PIJAMAS/pijama-lineas-rosas.jpg', 'activo', '2025-08-04 08:50:13'),
(211, 'Pijama de Lineas rosas', 'pijama', 28.00, 3, '', 30, 'PIJAMAS/pijama-lineas-rosas.jpg', 'activo', '2025-08-04 08:50:13'),
(212, 'Pijama con corazones', 'pijama', 25.00, 1, '', 30, 'PIJAMAS/pijama-corazones.jpg', 'activo', '2025-08-04 08:58:04'),
(213, 'Pijama con corazones', 'pijama', 25.00, 2, '', 30, 'PIJAMAS/pijama-corazones.jpg', 'activo', '2025-08-04 08:58:04'),
(214, 'Pijama con corazones', 'pijama', 25.00, 3, '', 30, 'PIJAMAS/pijama-corazones.jpg', 'activo', '2025-08-04 08:58:04'),
(215, 'Pijama de vaquita', 'pijama', 25.00, 1, '', 30, 'PIJAMAS/pijama-de-vaquita.jpeg', 'activo', '2025-08-04 08:58:04'),
(216, 'Pijama de vaquita', 'pijama', 25.00, 2, '', 30, 'PIJAMAS/pijama-de-vaquita.jpeg', 'activo', '2025-08-04 08:58:04'),
(217, 'Pijama de vaquita', 'pijama', 25.00, 3, '', 30, 'PIJAMAS/pijama-de-vaquita.jpeg', 'activo', '2025-08-04 08:58:04'),
(218, 'Pijama de fresitas', 'pijama', 25.00, 1, '', 30, 'PIJAMAS/pijama-fresitas.jpg', 'activo', '2025-08-04 08:58:04'),
(219, 'Pijama de fresitas', 'pijama', 25.00, 2, '', 30, 'PIJAMAS/pijama-fresitas.jpg', 'activo', '2025-08-04 08:58:04'),
(220, 'Pijama de fresitas', 'pijama', 25.00, 3, '', 30, 'PIJAMAS/pijama-fresitas.jpg', 'activo', '2025-08-04 08:58:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `correo`, `clave`, `telefono`, `direccion`, `fecha_registro`, `estado`) VALUES
(4, 'Sushell', 'sushellherrerasanchez@gmail.com', '$2y$12$tngZ60.7cEciCiV4VQ8pQOmwQ1715E3DZGdr04SFBvspJETNAzqSm', '999999998', 'Calle Lo Ciruelos', '2025-12-01 20:58:49', 'activo'),
(5, 'Aracely', 'a.aracelyherrera@seoane.edu.pe', '$2y$12$af/WAYw1AZAOlUv1ykB3hekmDim.b6LgVSvs.ussNVdQ.zYCkjQMO', '999999999', 'Cristo Rey San Juan de Lurigancho', '2025-12-02 04:26:01', 'activo'),
(6, 'Angely', 'saikosakuratheeternal7@gmail.com', '$2y$12$RK9h3dhmCpAsdZk51ets0uOw3x7M1h7nVffGfIxOT/K5lWJi5MXem', '963258741', 'san juan de lurigancho', '2025-12-02 05:17:31', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  `estado_pago` varchar(50) NOT NULL DEFAULT 'completado',
  `imagen_comprobante` varchar(255) DEFAULT NULL,
  `datos_carrito` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`datos_carrito`)),
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `transaction_id`, `metodo_pago`, `monto_total`, `estado_pago`, `imagen_comprobante`, `datos_carrito`, `fecha_compra`, `id_usuario`) VALUES
(8, 'TRANS-H6w3ne8DQpSY', 'yape', 100.00, 'aprobado', NULL, '{\"6\":{\"id\":\"6\",\"nombre\":\"Baggy Jeans con Bolsillo color Cl\\u00e1sico\",\"precio\":\"50.00\",\"imagen\":\"BAGGYJEANS\\/CONBOLCILLO\\/clasico.jpg\",\"cantidad\":\"2\"}}', '2025-12-02 05:29:47', 4),
(9, 'TRANS-I5Ewod6cq63S', 'plin', 100.00, 'aprobado', NULL, '{\"4\":{\"id\":\"4\",\"nombre\":\"Baggy Jeans con Bolsillo color Cl\\u00e1sico\",\"precio\":\"50.00\",\"imagen\":\"BAGGYJEANS\\/CONBOLCILLO\\/clasico.jpg\",\"cantidad\":2}}', '2025-12-02 06:41:52', 4),
(10, 'TRANS-dbTh5NP34RZd', 'yape', 110.00, 'aprobado', '1764641962_Captura.PNG', '{\"10\":{\"id\":\"10\",\"nombre\":\"Baggy Jeans Rasgado azul\",\"precio\":\"55.00\",\"imagen\":\"BAGGYJEANS\\/RASGADOS\\/AZUL.jpg\",\"cantidad\":2}}', '2025-12-02 07:19:22', 4),
(11, 'TRANS-3rdyLcXRZtT0', 'plin', 40.00, 'pendiente', '1764649228_reciclaje.jpg', '{\"188\":{\"id\":\"188\",\"nombre\":\"Gorra New York color Azul\",\"precio\":\"20.00\",\"imagen\":\"GORRAS\\/new-york-azul.jpg\",\"cantidad\":2}}', '2025-12-02 09:20:28', 4),
(12, 'TRANS-c70aDJCHzzaM', 'plin', 80.00, 'pendiente', '1764649653_reciclaje.jpg', '{\"170\":{\"id\":\"170\",\"nombre\":\"Zapatillas Nike air force 1 blancas\",\"precio\":\"40.00\",\"imagen\":\"ZAPATILLAS\\/NIKE\\/air-force-1-blancas.jpg\",\"cantidad\":\"2\"}}', '2025-12-02 09:27:33', 5),
(13, 'TRANS-G0LvxPjRErNE', 'plin', 56.00, 'aprobado', '1764649930_reciclaje.jpg', '{\"207\":{\"id\":\"207\",\"nombre\":\"Pijama color Negro con encaje\",\"precio\":\"28.00\",\"imagen\":\"PIJAMAS\\/pijama-con-encaje-negro.jpg\",\"cantidad\":\"2\",\"talla\":\"M\"}}', '2025-12-02 09:32:10', 5),
(14, 'TRANS-W6FWc6PVnKaK', 'yape', 25.00, 'aprobado', '1764653045_WhatsApp Image 2025-12-02 at 12.23.12 AM.jpeg', '{\"215\":{\"id\":\"215\",\"nombre\":\"Pijama de vaquita\",\"precio\":\"25.00\",\"imagen\":\"PIJAMAS\\/pijama-de-vaquita.jpeg\",\"cantidad\":\"1\",\"talla\":\"S\"}}', '2025-12-02 10:24:05', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `mensaje` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `nombre`, `correo`, `telefono`, `tipo`, `mensaje`) VALUES
(1, 'usuario', 'usuario@gmail.com', 987654321, 'ninguno', 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(10) UNSIGNED NOT NULL,
  `dni` varchar(8) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `dni`, `nombres`, `telefono`, `correo`, `cargo`, `direccion`, `fecha_ingreso`, `estado`) VALUES
(1, '75082645', 'Administrador', 932912333, 'admin@gmail.com', 'administrador', 'utec', '2025-11-12', 'activo'),
(2, '73969936', 'Mishell', 936080878, 'a.susanherrera@seoane.edu.pe', 'Counter', 'mz d lt 8', '2025-12-01', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_11_30_144048_create_talla_table', 1),
(6, '2025_11_30_144056_create_catalogo_table', 1),
(7, '2025_11_30_144101_create_clientes_table', 1),
(8, '2025_11_30_144107_create_compras_table', 1),
(9, '2025_11_30_144112_create_contacto_table', 1),
(10, '2025_11_30_144117_create_empleados_table', 1),
(11, '2025_11_30_144123_create_reclamos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
--

CREATE TABLE `reclamos` (
  `id_reclamo` int(10) UNSIGNED NOT NULL,
  `tipo_documento` varchar(50) NOT NULL,
  `num_documento` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `departamento` varchar(20) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `distrito` varchar(50) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `monto` decimal(10,0) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tipo_reclamo` varchar(255) NOT NULL,
  `detalle_reclamo` varchar(255) NOT NULL,
  `pedido` varchar(255) NOT NULL,
  `fecha_reclamo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talla`
--

CREATE TABLE `talla` (
  `id_talla` int(10) UNSIGNED NOT NULL,
  `nombre_talla` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `talla`
--

INSERT INTO `talla` (`id_talla`, `nombre_talla`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, '28'),
(5, '30'),
(6, '32'),
(7, '35'),
(8, '36'),
(9, '37'),
(10, '38'),
(11, '39'),
(12, 'standar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `catalogo_id_talla_foreign` (`id_talla`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD PRIMARY KEY (`id_reclamo`);

--
-- Indices de la tabla `talla`
--
ALTER TABLE `talla`
  ADD PRIMARY KEY (`id_talla`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  MODIFY `id_reclamo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `talla`
--
ALTER TABLE `talla`
  MODIFY `id_talla` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD CONSTRAINT `catalogo_id_talla_foreign` FOREIGN KEY (`id_talla`) REFERENCES `talla` (`id_talla`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
