-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql5.freesqldatabase.com
-- Tiempo de generación: 25-02-2025 a las 15:37:01
-- Versión del servidor: 5.5.62-0ubuntu0.14.04.1
-- Versión de PHP: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sql5732219`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discapacidades`
--

CREATE TABLE `discapacidades` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `tipo_discapacidad` int(11) DEFAULT NULL,
  `discapacidad` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `discapacidades`
--

INSERT INTO `discapacidades` (`id`, `persona_id`, `tipo_discapacidad`, `discapacidad`) VALUES
(6, 7, 8, 'Discapacidad intelectual'),
(7, 8, 5, 'Esquizofrenia'),
(8, 9, 2, 'Sordera'),
(9, 10, 2, 'Autismo'),
(10, 11, 6, 'Déficit de atención e hiperactividad (TDAH)'),
(11, 12, 1, 'Esclerosis múltiple'),
(12, 13, 1, 'Depresión crónica.'),
(13, 14, 7, 'Déficit de atención e hiperactividad (TDAH)'),
(14, 15, 4, 'Baja visión'),
(15, 16, 8, 'Trastorno bipolar'),
(16, 17, 2, 'Epilepsia'),
(17, 18, 8, 'Esclerosis múltiple'),
(18, 19, 2, 'Dificultad de movilidad'),
(19, 20, 4, 'Trastorno bipolar'),
(20, 21, 1, 'Síndrome de Down'),
(21, 22, 6, 'Esclerosis múltiple'),
(22, 23, 6, 'Parkinson'),
(23, 24, 5, 'Parkinson'),
(24, 25, 2, 'Fibrosis quística'),
(25, 26, 7, 'Sordera'),
(26, 27, 5, 'Trastorno de ansiedad'),
(27, 28, 7, 'Autismo'),
(28, 29, 7, 'Ceguera'),
(29, 30, 3, 'Autismo'),
(30, 31, 3, 'Fibrosis quística'),
(31, 32, 2, 'Sordera'),
(32, 33, 7, 'Esquizofrenia'),
(33, 34, 3, 'Discapacidad intelectual'),
(34, 35, 7, 'Distrofia muscular'),
(35, 36, 7, 'Asperger'),
(36, 7, 4, 'Fibrosis quística'),
(37, 8, 2, 'Epilepsia'),
(38, 9, 6, 'Depresión crónica.'),
(39, 10, 6, 'Parálisis cerebral'),
(40, 11, 4, 'Fibrosis quística'),
(41, 12, 5, 'Esclerosis múltiple'),
(42, 13, 7, 'Discapacidad intelectual'),
(43, 14, 8, 'Artritis reumatoide'),
(44, 15, 3, 'Hipoacusia'),
(45, 16, 7, 'Esclerosis múltiple'),
(46, 17, 6, 'Dificultad de movilidad'),
(102, 43, 1, 'sordera'),
(103, 43, 5, 'silla de rueda'),
(112, 45, 2, 'Ceguera '),
(113, 46, 2, 'Hipermetropía masiva '),
(114, 47, 4, 'Retraso Mental Moderado '),
(115, 48, 3, 'falta un higado'),
(120, 44, 2, 'cegera'),
(121, 44, 1, 'sordera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos_confort`
--

CREATE TABLE `elementos_confort` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `elemento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `elementos_confort`
--

INSERT INTO `elementos_confort` (`id`, `persona_id`, `elemento`) VALUES
(6, 7, 1),
(7, 8, 3),
(8, 9, 3),
(9, 10, 8),
(10, 11, 2),
(11, 12, 4),
(12, 13, 1),
(13, 14, 5),
(14, 15, 3),
(15, 16, 3),
(16, 17, 8),
(17, 18, 4),
(18, 19, 6),
(19, 20, 8),
(20, 21, 1),
(21, 22, 1),
(22, 23, 5),
(23, 24, 3),
(24, 25, 2),
(25, 26, 5),
(26, 27, 6),
(27, 28, 2),
(28, 29, 1),
(29, 30, 5),
(30, 31, 3),
(31, 32, 8),
(32, 33, 6),
(33, 34, 6),
(34, 35, 4),
(35, 36, 8),
(36, 7, 2),
(37, 8, 2),
(38, 9, 6),
(39, 10, 6),
(40, 11, 6),
(41, 12, 3),
(42, 13, 4),
(43, 14, 6),
(44, 15, 2),
(45, 16, 4),
(46, 17, 6),
(47, 18, 2),
(48, 19, 3),
(49, 20, 1),
(50, 21, 4),
(51, 22, 8),
(52, 23, 1),
(53, 24, 2),
(54, 25, 3),
(55, 26, 4),
(56, 27, 4),
(57, 28, 6),
(58, 29, 8),
(59, 30, 3),
(60, 31, 6),
(61, 7, 4),
(62, 8, 1),
(63, 9, 4),
(64, 10, 3),
(65, 11, 5),
(91, 43, 2),
(92, 43, 3),
(93, 43, 4),
(94, 43, 5),
(95, 43, 6),
(96, 43, 8),
(117, 45, 5),
(118, 45, 6),
(119, 46, 2),
(120, 46, 3),
(121, 46, 5),
(122, 47, 3),
(123, 47, 5),
(124, 47, 7),
(125, 48, 1),
(126, 48, 2),
(131, 44, 2),
(132, 44, 3),
(133, 44, 4),
(134, 44, 5),
(135, 44, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_familiar`
--

CREATE TABLE `grupo_familiar` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `quien` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `escolaridad` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `trabajo` tinyint(1) DEFAULT NULL,
  `donde` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `grupo_familiar`
--

INSERT INTO `grupo_familiar` (`id`, `persona_id`, `quien`, `nacimiento`, `escolaridad`, `trabajo`, `donde`) VALUES
(5, 7, 'Hermano/a', '2005-05-10', '1', 0, NULL),
(6, 8, 'Padre/Madre', '1980-11-25', '0', 1, 'Departamento'),
(7, 9, 'Tío/Tía', '1978-04-14', '1', 1, 'Casa'),
(8, 10, 'Abuelo/a', '1950-03-08', '0', 0, NULL),
(9, 11, 'Hermano/a', '2010-09-15', '1', 0, NULL),
(10, 12, 'Primo/a', '2000-12-20', '0', 1, 'Ciudad'),
(11, 13, 'Hermano/a', '2007-06-05', '1', 0, NULL),
(12, 14, 'Padre/Madre', '1985-01-30', '0', 1, 'Departamento'),
(13, 15, 'Abuelo/a', '1945-10-12', '1', 0, NULL),
(14, 16, 'Hermano/a', '2008-07-22', '0', 0, NULL),
(15, 17, 'Hermano/a', '2012-02-18', '1', 0, NULL),
(16, 18, 'Primo/a', '1995-09-05', '0', 1, 'Ciudad'),
(17, 19, 'Tío/Tía', '1972-03-25', '1', 0, NULL),
(18, 20, 'Padre/Madre', '1982-08-14', '0', 1, 'Casa'),
(19, 21, 'Abuelo/a', '1938-11-09', '1', 0, NULL),
(20, 22, 'Hermano/a', '2003-05-27', '0', 0, NULL),
(21, 23, 'Primo/a', '1998-01-10', '1', 1, 'Ciudad'),
(22, 24, 'Hermano/a', '2015-03-03', '0', 0, NULL),
(23, 25, 'Tío/Tía', '1975-12-20', '1', 0, NULL),
(24, 26, 'Hermano/a', '2008-03-12', '0', 0, NULL),
(25, 26, 'Padre/Madre', '1983-07-09', '1', 1, 'Casa'),
(26, 27, 'Abuelo/a', '1947-01-17', '0', 0, NULL),
(27, 27, 'Tío/Tía', '1976-11-30', '1', 1, 'Departamento'),
(28, 28, 'Hermano/a', '2015-05-22', '0', 0, NULL),
(29, 28, 'Primo/a', '1999-09-13', '1', 1, 'Ciudad'),
(30, 29, 'Padre/Madre', '1987-04-10', '0', 1, 'Casa'),
(31, 29, 'Tío/Tía', '1975-02-28', '1', 0, NULL),
(32, 30, 'Hermano/a', '2011-12-05', '0', 0, NULL),
(33, 30, 'Primo/a', '2001-08-18', '1', 1, 'Ciudad'),
(34, 31, 'Abuelo/a', '1940-10-25', '0', 0, NULL),
(35, 31, 'Padre/Madre', '1981-06-03', '1', 1, 'Casa'),
(36, 32, 'Hermano/a', '2009-02-14', '0', 0, NULL),
(37, 32, 'Primo/a', '1997-11-19', '1', 1, 'Ciudad'),
(38, 33, 'Tío/Tía', '1973-07-21', '0', 0, NULL),
(39, 33, 'Padre/Madre', '1984-03-16', '1', 1, 'Casa'),
(40, 34, 'Abuelo/a', '1943-09-08', '0', 0, NULL),
(41, 34, 'Hermano/a', '2010-05-24', '1', 0, NULL),
(42, 35, 'Primo/a', '2000-06-30', '0', 1, 'Ciudad'),
(43, 35, 'Padre/Madre', '1982-02-11', '1', 1, 'Casa'),
(44, 36, 'Hermano/a', '2013-12-18', '0', 0, NULL),
(45, 36, 'Tío/Tía', '1977-10-04', '1', 1, 'Departamento'),
(68, 43, 'Padre', '1995-02-08', '1', 1, 'EDEA'),
(69, 43, 'hermano', '2018-04-21', '0', 0, ''),
(74, 45, 'Luján Perez', '1971-11-27', '0', 1, 'Casa de familia'),
(75, 45, 'Juárez Raúl ', '1969-11-27', '0', 1, 'Empleado'),
(76, 45, 'Sofia', '2016-11-27', '1', 0, ''),
(77, 45, 'Cristian', '2010-11-09', '1', 0, ''),
(78, 45, 'Diego', '1999-11-27', '1', 1, 'Peluquería '),
(79, 46, 'Thiago Carballo ', '2008-12-30', '1', 1, 'No'),
(80, 46, 'Thomas isaurralde ', '2001-11-28', '1', 1, 'Construcción '),
(81, 47, 'Leandro Nahuel Díaz ', '1986-09-17', '1', 1, 'Trenes argentinos '),
(82, 47, 'Daiana Camila Velcheff ', '1996-07-03', '1', 0, ''),
(83, 48, 'hermano', '1709-12-03', '1', 1, ''),
(84, 44, 'padre', '1964-02-21', '1', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci,
  `imgurl` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `home`
--

INSERT INTO `home` (`id`, `titulo`, `descripcion`, `imgurl`) VALUES
(1, 'Dirección de accesibilidad', '¡Bienvenido! Tu registro nos ayudará a brindarte mejores servicios. Completa este breve formulario en solo 2 minutos.', 'https://i.ibb.co/PvkWvJZH/Whats-App-Image-2025-01-27-at-14-17-56.jpg'),
(2, 'Conócenos', 'Somos una organización dedicada a mejorar la accesibilidad para todos. Explora nuestros servicios.', 'https://www.plenainclusion.org/wp-content/uploads/2021/05/simbolo-logo-signo-pictograma-accesibilidad-universal.jpg'),
(3, 'Servicios', 'Descubre los servicios personalizados que ofrecemos para facilitar tu día a día.', 'https://img.freepik.com/fotos-premium/lindo-pequeno-lobo-anime_994828-311.jpg'),
(4, 'Contacto', 'Si tienes alguna pregunta, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte.', 'https://cocemfenavarra.es/wp-content/uploads/2021/09/Discapacidad-cabeza-1-777x437-1.jpg'),
(5, 'Nuestro objetivo', 'Nuestro objetivo es garantizar que las personas con discapacidad reciban el apoyo necesario para mejorar su calidad de vida. Trabajamos para construir una comunidad accesible, equitativa y solidaria.', NULL),
(6, 'Probando@gmail.com', '@Usuario Instagram', NULL),
(7, '+1 234 567 892', 'Leandro N. Alem, B7100 Dolores, Buenos Aires', 'https://i.ibb.co/PvkWvJZH/Whats-App-Image-2025-01-27-at-14-17-56.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pared`
--

CREATE TABLE `pared` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `tipo_pared` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `pared`
--

INSERT INTO `pared` (`id`, `persona_id`, `tipo_pared`) VALUES
(8, 7, 'Madera'),
(9, 8, 'Chapa'),
(10, 9, 'Revoque'),
(11, 10, 'Madera'),
(12, 11, 'Adobe'),
(13, 7, 'Ladrillo'),
(14, 8, 'Madera'),
(15, 9, 'Ladrillo'),
(16, 10, 'Chapa'),
(17, 11, 'Ladrillo'),
(18, 12, 'Chapa'),
(19, 13, 'Adobe'),
(20, 14, 'Chapa'),
(21, 15, 'Ladrillo'),
(22, 16, 'Ladrillo'),
(23, 17, 'Revoque'),
(24, 18, 'Chapa'),
(25, 19, 'Adobe'),
(26, 20, 'Chapa'),
(27, 21, 'Adobe'),
(28, 22, 'Chapa'),
(29, 23, 'Adobe'),
(30, 24, 'Adobe'),
(31, 25, 'Ladrillo'),
(32, 26, 'Madera'),
(33, 27, 'Madera'),
(34, 28, 'Adobe'),
(35, 29, 'Ladrillo'),
(36, 30, 'Ladrillo'),
(37, 31, 'Madera'),
(38, 32, 'Ladrillo'),
(39, 33, 'Revoque'),
(40, 34, 'Revoque'),
(41, 35, 'Revoque'),
(42, 36, 'Chapa'),
(68, 43, 'Revoque'),
(73, 45, 'Revoque'),
(74, 46, 'Revoque'),
(75, 47, 'Revoque'),
(76, 48, 'Chapa'),
(81, 44, 'Chapa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `noticias` tinyint(1) NOT NULL,
  `ver_tablas` tinyint(1) NOT NULL,
  `editar_tablas` tinyint(1) NOT NULL,
  `graficos` tinyint(1) NOT NULL,
  `roles` tinyint(1) NOT NULL,
  `formulario_discapacidad` tinyint(1) DEFAULT '0',
  `eliminar` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `noticias`, `ver_tablas`, `editar_tablas`, `graficos`, `roles`, `formulario_discapacidad`, `eliminar`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1),
(2, 0, 1, 1, 1, 0, 1, 0),
(3, 1, 0, 0, 1, 0, 0, 0),
(4, 0, 0, 0, 1, 0, 0, 0),
(10, 1, 1, 1, 1, 1, 1, 0),
(11, 1, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `nacimiento` date DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `domicilio` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `zona` int(11) DEFAULT NULL,
  `tipo_tenencia` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `procedencia_agua` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `cantidad_camas` int(11) DEFAULT NULL,
  `ventilacion` int(11) DEFAULT NULL,
  `iluminacion` int(11) DEFAULT NULL,
  `higiene` int(11) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `existencia_sanitaria` tinyint(1) DEFAULT NULL,
  `letrina` varchar(10) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `barreras_arquitectonicas` int(11) DEFAULT NULL,
  `cobertura` tinyint(4) DEFAULT NULL,
  `cud` tinyint(1) DEFAULT NULL,
  `lugar_atencion` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `necesita_asistencia` tinyint(1) DEFAULT NULL,
  `quien_brinda_asistencia` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `cobra_pension` tinyint(1) DEFAULT NULL,
  `observacion_salud` text COLLATE utf8mb4_spanish2_ci,
  `observacion_vivienda` text COLLATE utf8mb4_spanish2_ci,
  `observacion_datos_personales` text COLLATE utf8mb4_spanish2_ci,
  `miembros_grupo_familiar` int(11) DEFAULT NULL,
  `cantidad_ambientes` int(11) DEFAULT NULL,
  `numero_confort` int(11) DEFAULT NULL,
  `numero_discapacidades` int(11) DEFAULT NULL,
  `tipo_pension` varchar(75) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_formulario` date DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `dni`, `nacimiento`, `correo`, `domicilio`, `zona`, `tipo_tenencia`, `procedencia_agua`, `cantidad_camas`, `ventilacion`, `iluminacion`, `higiene`, `orden`, `existencia_sanitaria`, `letrina`, `barreras_arquitectonicas`, `cobertura`, `cud`, `lugar_atencion`, `necesita_asistencia`, `quien_brinda_asistencia`, `cobra_pension`, `observacion_salud`, `observacion_vivienda`, `observacion_datos_personales`, `miembros_grupo_familiar`, `cantidad_ambientes`, `numero_confort`, `numero_discapacidades`, `tipo_pension`, `fecha_formulario`, `telefono`) VALUES
(7, 'Dolph', 'Sooper', '80598821', '2007-11-30', 'dsooper0@cargocollective.com', 'Suite 24', 3, 'usurpada', 'potable', 4, 4, 3, 3, 4, 0, 'fuera', 3, 0, 0, 'Narong', 0, 'Sanatorio', 1, NULL, NULL, NULL, 1, 3, 3, 2, 'ANSES', '2020-03-15', NULL),
(8, 'Mozelle', 'Liddiard', '36345531', '2013-12-12', 'mliddiard1@time.com', 'Room 1788', 1, 'prestada', 'corriente', 4, 1, 1, 3, 3, 0, 'fuera', 3, 0, 0, 'Kuningan', 1, 'Nadie', 0, NULL, NULL, NULL, 1, 3, 3, 2, 'IPS', '2020-06-22', NULL),
(9, 'Sharai', 'Hearty', '72739975', '1996-03-19', 'shearty2@ustream.tv', 'PO Box 61120', 1, 'alquilada', 'bomba', 8, 3, 5, 2, 1, 1, 'dentro', 4, 0, 0, 'Wola Uhruska', 0, 'Sanatorio', 0, NULL, NULL, NULL, 1, 3, 3, 2, 'ANSES', '2020-12-05', NULL),
(10, 'Pammy', 'Cossam', '57508293', '1988-07-10', 'pcossam3@free.fr', 'Suite 88', 3, 'usurpada', 'corriente', 5, 3, 3, 4, 3, 0, 'fuera', 2, 0, 0, 'Voloshka', 0, 'Nadie', 0, NULL, NULL, NULL, 1, 3, 3, 2, 'IPS', '2021-01-18', NULL),
(11, 'Zack', 'Edwardes', '73563654', '1991-10-06', 'zedwardes4@walmart.com', 'Room 1927', 2, 'alquilada', 'pozo', 4, 4, 2, 5, 1, 0, 'fuera', 2, 0, 1, 'Chojata', 1, 'Hospital', 0, NULL, NULL, NULL, 1, 3, 3, 2, 'ANSES', '2021-05-03', NULL),
(12, 'Reggis', 'Kivlehan', '61179701', '1953-12-01', 'rkivlehan5@unc.edu', 'Apt 1131', 4, 'prestada', 'corriente', 2, 5, 4, 2, 3, 0, 'fuera', 1, 0, 1, 'Sabugueiro', 0, 'Sanatorio', 0, NULL, NULL, NULL, 1, 3, 3, 2, 'IPS', '2021-08-19', NULL),
(13, 'Marshal', 'Langlais', '42923549', '1998-01-13', 'mlanglais6@uol.com.br', 'Suite 40', 5, 'alquilada', 'pozo', 7, 1, 4, 2, 2, 1, 'dentro', 5, 0, 1, 'Tuchkovo', 1, 'Hospital', 0, NULL, NULL, NULL, 1, 3, 2, 2, 'ANSES', '2021-11-30', NULL),
(14, 'Merrile', 'Suero', '88365693', '2000-05-18', 'msuero7@amazon.co.uk', 'PO Box 51463', 2, 'prestada', 'pozo', 7, 1, 4, 5, 4, 0, 'fuera', 5, 0, 0, 'Lingbei', 0, 'Sanatorio', 0, NULL, NULL, NULL, 1, 3, 2, 2, 'IPS', '2022-02-15', NULL),
(15, 'Willdon', 'Lonergan', '61278268', '1985-10-17', 'wlonergan8@google.ca', 'PO Box 64588', 4, 'usurpada', 'bomba', 4, 2, 4, 3, 3, 1, 'dentro', 1, 0, 1, 'Bahe', 0, 'Sanatorio', 0, NULL, NULL, NULL, 1, 3, 2, 2, 'ANSES', '2022-05-10', NULL),
(16, 'Willey', 'Razzell', '72417799', '1989-11-01', 'wrazzell9@jimdo.com', 'Room 3', 4, 'cedida', 'pozo', 6, 5, 2, 5, 4, 0, 'dentro', 1, 0, 1, 'Komsomolsk-on-Amur', 1, 'Sanatorio', 1, NULL, NULL, NULL, 1, 3, 2, 2, 'IPS', '2022-09-01', NULL),
(17, 'Shae', 'Bomfield', '44079447', '1990-10-17', 'sbomfielda@mashable.com', '1st Floor', 2, 'propia', 'pozo', 10, 1, 3, 2, 1, 0, 'fuera', 2, 0, 1, 'Cipicung', 1, 'Hospital', 1, NULL, NULL, NULL, 1, 3, 2, 2, 'ANSES', '2022-11-18', NULL),
(18, 'Claudio', 'Geekin', '54480143', '1983-06-17', 'cgeekinb@pcworld.com', 'Room 326', 1, 'propia', 'potable', 10, 2, 4, 2, 4, 1, 'dentro', 1, 0, 1, 'Bartolomé Masó', 1, 'Nadie', 0, NULL, NULL, NULL, 1, 3, 2, 1, 'IPS', '2023-01-20', NULL),
(19, 'Bald', 'Timny', '95578600', '1985-12-01', 'btimnyc@va.gov', 'Suite 34', 1, 'propia', 'pozo', 1, 4, 3, 2, 5, 0, 'fuera', 5, 0, 0, 'Jinotega', 1, 'Hospital', 1, NULL, NULL, NULL, 1, 2, 2, 1, 'ANSES', '2023-04-05', NULL),
(20, 'Grannie', 'Delacoste', '4362097', '1999-03-17', 'gdelacosted@ftc.gov', '12th Floor', 1, 'usurpada', 'bomba', 1, 1, 2, 1, 2, 0, 'fuera', 4, 0, 1, 'Junkou', 1, 'Nadie', 0, NULL, NULL, NULL, 1, 2, 2, 1, 'IPS', '2023-06-25', NULL),
(21, 'Siusan', 'Frayling', '67614192', '1995-04-14', 'sfraylinge@va.gov', 'PO Box 29378', 5, 'cedida', 'pozo', 10, 5, 1, 3, 1, 0, 'fuera', 2, 0, 0, 'Spanish Wells', 0, 'Hospital', 1, NULL, NULL, NULL, 1, 2, 2, 1, 'ANSES', '2023-08-15', NULL),
(22, 'Ed', 'Nutton', '45781978', '1998-10-20', 'enuttonf@google.com', 'Suite 41', 3, 'prestada', 'bomba', 7, 1, 4, 5, 4, 0, 'dentro', 5, 0, 0, 'Várzea', 0, 'Hospital', 1, NULL, NULL, NULL, 1, 2, 2, 1, 'IPS', '2023-11-09', NULL),
(23, 'Brandtr', 'Marconi', '24465250', '1986-03-01', 'bmarconig@google.it', 'Apt 351', 2, 'propia', 'potable', 4, 5, 3, 2, 2, 0, 'dentro', 1, 0, 0, 'Soloneshnoye', 0, 'Sanatorio', 1, NULL, NULL, NULL, 1, 2, 2, 1, 'ANSES', '2024-01-12', NULL),
(24, 'Armstrong', 'O\'Boyle', '93563953', '1996-05-27', 'aoboyleh@hc360.com', 'Room 354', 2, 'prestada', 'corriente', 9, 3, 1, 2, 4, 1, 'dentro', 4, 0, 0, 'Ayia Napa', 0, 'Sanatorio', 0, NULL, NULL, NULL, 1, 2, 2, 1, 'IPS', '2024-03-03', NULL),
(25, 'Bertha', 'Furmage', '53472066', '1980-07-13', 'bfurmagei@delicious.com', 'PO Box 29582', 4, 'prestada', 'corriente', 3, 1, 2, 3, 2, 1, 'fuera', 5, 0, 1, 'Orsay', 1, 'Sanatorio', 1, NULL, NULL, NULL, 1, 2, 2, 1, 'ANSES', '2024-05-18', NULL),
(26, 'Bary', 'Blewitt', '12087595', '1996-06-14', 'bblewittj@fda.gov', 'PO Box 33802', 4, 'usurpada', 'pozo', 10, 5, 1, 5, 1, 1, 'fuera', 3, 1, 0, 'Ar Rawnah', 1, 'Sanatorio', 1, 'probando carga salud', 'probando carga vivienda', 'probando carga personal', 2, 2, 2, 1, 'IPS', '2024-07-22', NULL),
(27, 'Winna', 'Kacheller', '22358877', '1997-09-01', 'wkachellerk@wikipedia.org', 'Apt 1237', 4, 'usurpada', 'bomba', 2, 1, 3, 2, 1, 1, 'fuera', 5, 1, 1, 'Negotino', 1, 'Nadie', 1, NULL, NULL, NULL, 2, 2, 2, 1, 'ANSES', '2024-09-11', NULL),
(28, 'Reiko', 'Lintall', '15086285', '1997-12-24', 'rlintalll@ustream.tv', 'Apt 1702', 4, 'usurpada', 'pozo', 8, 5, 5, 3, 5, 0, 'dentro', 1, 1, 0, 'Yaroslavl', 1, 'Hospital', 0, NULL, NULL, NULL, 2, 2, 1, 1, 'IPS', '2024-11-25', NULL),
(29, 'Whitaker', 'Hubbard', '57143738', '1995-11-27', 'whubbardm@nydailynews.com', '19th Floor', 5, 'prestada', 'bomba', 7, 2, 1, 4, 1, 0, 'fuera', 5, 1, 1, 'Charenton-le-Pont', 1, 'Nadie', 1, NULL, NULL, NULL, 2, 2, 1, 1, 'ANSES', '2020-02-10', NULL),
(30, 'Loise', 'Boniface', '75852389', '1984-08-01', 'lbonifacen@state.gov', '15th Floor', 5, 'propia', 'pozo', 10, 5, 2, 4, 5, 1, 'fuera', 5, 1, 0, 'Atimonan', 0, 'Nadie', 1, NULL, NULL, NULL, 2, 2, 1, 1, 'IPS', '2020-05-07', NULL),
(31, 'Fairlie', 'Waterfall', '28140681', '1997-03-15', 'fwaterfallo@fda.gov', 'Suite 46', 5, 'prestada', 'corriente', 10, 1, 1, 1, 3, 1, 'dentro', 5, 1, 0, 'Nancaicun', 1, 'Sanatorio', 0, NULL, NULL, NULL, 2, 2, 1, 1, 'ANSES', '2020-08-19', NULL),
(32, 'Leland', 'Silcox', '52844466', '1989-04-08', 'lsilcoxp@alexa.com', 'Suite 18', 5, 'propia', 'corriente', 3, 5, 2, 2, 1, 1, 'fuera', 4, 1, 1, 'Oshawa', 0, 'Nadie', 0, NULL, NULL, NULL, 2, 1, 1, 3, 'IPS', '2021-02-15', NULL),
(33, 'Brade', 'Oman', '23984657', '1995-09-26', 'bomanq@zdnet.com', 'Apt 559', 4, 'prestada', 'bomba', 10, 1, 4, 1, 3, 0, 'dentro', 2, 1, 1, 'Banjar Bucu', 0, 'Hospital', 0, NULL, NULL, NULL, 2, 1, 2, 2, 'ANSES', '2021-06-10', NULL),
(34, 'Maddalena', 'Durnin', '6334591', '1988-11-11', 'mdurninr@so-net.ne.jp', 'PO Box 98729', 4, 'alquilada', 'bomba', 10, 1, 2, 1, 1, 0, 'fuera', 1, 1, 0, 'Linhu', 1, 'Hospital', 1, NULL, NULL, NULL, 2, 1, 7, 3, 'IPS', '2021-09-20', NULL),
(35, 'Mignon', 'Gauld', '43132707', '1998-02-13', 'mgaulds@forbes.com', 'Suite 86', 4, 'prestada', 'potable', 2, 3, 1, 5, 4, 1, 'dentro', 2, 1, 1, 'El Zulia', 1, 'Sanatorio', 1, NULL, NULL, NULL, 2, 1, 8, 4, 'ANSES', '2022-03-12', NULL),
(36, 'Horatio', 'Yerrill', '37082589', '1981-01-03', 'hyerrillt@ucoz.com', 'Room 1137', 5, 'propia', 'bomba', 5, 5, 2, 1, 3, 0, 'dentro', 5, 1, 1, 'Salgar', 1, 'Sanatorio', 1, NULL, NULL, NULL, 2, 1, 9, 4, 'IPS', '2022-12-01', NULL),
(43, 'Juan', 'Angeleri', '71093756', '2009-08-07', 'juanangel@gmail.com', 'Belgrano 298', 3, 'propia', 'corriente', 3, 4, 3, 5, 4, 1, 'dentro', 1, 1, 0, 'hospital', 1, 'padre', 0, 'pension null', 'Probando funcionamiento', NULL, 2, 4, 6, 2, NULL, '2024-11-21', NULL),
(44, 'fernando', 'aanaximandro', '84921059', '1992-12-03', 'prueba@gmail.com', 'san martin 230', 1, 'alquila', 'bomba', 2, 3, 4, 2, 1, 1, 'dentro', 1, 0, 1, 'sanatorio', 1, 'padre', 0, 'por favor anda', NULL, NULL, 1, 4, 5, 2, NULL, '2024-11-23', NULL),
(45, 'Flor', 'Exquis', '56842684', '2011-11-27', '2235992276', 'Belgrano 737', 5, 'alquila', 'potable', 5, 3, 3, 3, 3, 1, 'dentro', 3, 0, 0, '', 1, 'Hospital ', 0, NULL, NULL, NULL, 5, 4, 2, 1, NULL, '2020-09-23', NULL),
(46, 'Mariana', 'Enriquez ', '27856931', '1980-11-10', '2245408672', 'San Martin 750', 4, 'propia', 'corriente', 3, 3, 3, 3, 3, 1, 'dentro', 4, 1, 1, 'Hosp ', 1, 'Hospital', 1, 'Necesita asistencia en turnos para atención oftalmología en la plata ', NULL, NULL, 2, 3, 3, 1, 'ANSES', '2024-11-27', NULL),
(47, 'María Celeste ', 'Ledesma Giménez ', '25270152', '1976-07-28', '2245 420106', 'América 910', 2, 'propia', 'potable', 3, 3, 3, 3, 3, 1, 'fuera', 3, 1, 1, 'En el Sanatorio Regional ', 1, 'La familia ', 1, NULL, NULL, 'Tiene pensión IPS ', 2, 5, 3, 1, 'IPS', '2024-11-27', NULL),
(48, 'pepe', 'artillo', '2312309', '1992-12-03', 'pepe@gmail.com', 'san martin 234', 6, 'cedida', 'pozo', 2, 2, 2, 2, 1, 1, 'dentro', 1, 1, 0, 'sanatorio', 1, 'nadei', 1, NULL, NULL, NULL, 1, 1, 2, 1, 'IPS', '2024-09-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `piso`
--

CREATE TABLE `piso` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `tipo_piso` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `piso`
--

INSERT INTO `piso` (`id`, `persona_id`, `tipo_piso`) VALUES
(7, 7, 'Concreto'),
(8, 8, 'Cerámica'),
(9, 9, 'Tierra'),
(10, 10, 'Tierra'),
(11, 11, 'Cerámica'),
(12, 12, 'Cerámica'),
(13, 13, 'Tierra'),
(14, 14, 'Tierra'),
(15, 15, 'Cerámica'),
(16, 16, 'Concreto'),
(17, 17, 'Cerámica'),
(18, 18, 'Concreto'),
(19, 19, 'Cerámica'),
(20, 20, 'Tierra'),
(21, 21, 'Concreto'),
(22, 22, 'Cerámica'),
(23, 23, 'Tierra'),
(24, 24, 'Concreto'),
(25, 25, 'Concreto'),
(26, 26, 'Cerámica'),
(27, 27, 'Concreto'),
(28, 28, 'Tierra'),
(29, 29, 'Concreto'),
(30, 30, 'Concreto'),
(31, 31, 'Tierra'),
(32, 32, 'Tierra'),
(33, 33, 'Tierra'),
(34, 34, 'Tierra'),
(35, 35, 'Tierra'),
(36, 36, 'Concreto'),
(37, 7, 'Cerámica'),
(38, 8, 'Tierra'),
(39, 9, 'Concreto'),
(40, 10, 'Concreto'),
(41, 11, 'Concreto'),
(58, 43, 'Concreto'),
(67, 45, 'Cerámica'),
(68, 46, 'Concreto'),
(69, 47, 'Cerámica'),
(70, 48, 'Tierra'),
(75, 44, 'Cerámica'),
(76, 44, 'Concreto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `que_discapacidad`
--

CREATE TABLE `que_discapacidad` (
  `id` int(11) NOT NULL,
  `cual_discapacidad` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `que_discapacidad`
--

INSERT INTO `que_discapacidad` (`id`, `cual_discapacidad`) VALUES
(1, 'Auditiva'),
(2, 'Visual'),
(3, 'Visceral'),
(4, 'Mental'),
(5, 'Motora'),
(6, 'Congénita'),
(7, 'CEA (Condición del Espectro Autista)'),
(8, 'Trastorno del procesamiento sensorial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `que_elemento`
--

CREATE TABLE `que_elemento` (
  `id` int(11) NOT NULL,
  `cual_elemento` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `que_elemento`
--

INSERT INTO `que_elemento` (`id`, `cual_elemento`) VALUES
(1, 'Otros'),
(2, 'Internet'),
(3, 'Celular'),
(4, 'TV'),
(5, 'Heladera'),
(6, 'Cocina'),
(7, 'Lavarropas'),
(8, 'PlayStation');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_discapacidad`
--

CREATE TABLE `registro_discapacidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dni` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `correo_electronico` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `certificado_discapacidad` tinyint(1) NOT NULL,
  `quienes` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `visitado` tinyint(1) DEFAULT '0',
  `fecha_registro` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `registro_discapacidad`
--

INSERT INTO `registro_discapacidad` (`id`, `nombre`, `apellido`, `dni`, `direccion`, `telefono`, `correo_electronico`, `certificado_discapacidad`, `quienes`, `visitado`, `fecha_registro`) VALUES
(10, 'Maria Celeste ', 'Ledesma ', '25270152', 'América 910', '2245-420106', 'mariacelesteledesmagimenez2@gmail.com', 1, 'Hijo/a', 0, NULL),
(11, 'luciano', 'de paola', '46697004', 'mar del tuyu', '2246503682', 'luchodepaola@gmail.com', 0, 'Padre/Madre', 0, NULL),
(12, 'marta', 'ferrer', '16217370', 'sarmiento 786', '2245478900', 'martainesferrer@gmail.com', 1, 'nieto', 0, NULL),
(13, 'Jaqueline', 'Quinteros', '42549287', 'Paisandú 1123 casa 92 ', '11- 56055737', NULL, 1, '', 0, NULL),
(14, 'Kiara Jazmin', 'Ríos Luna', '50777384', 'Pueyrredón 1030', '2245568303', NULL, 1, '', 0, NULL),
(15, 'Flavia Lorena', 'Chevriau', '29211505', 'América 950', '2246586864', NULL, 1, '', 0, NULL),
(16, 'Rodillo javier', 'Bazzigaluppi', '26843317', 'Mitre684', '2245408181', NULL, 1, 'Padre/Madre', 0, NULL),
(17, 'Lara', 'Melina Vanesa', '27228601', 'Rauch 626', '2245505971', NULL, 1, 'Padre/Madre', 0, NULL),
(18, 'Mendez Salinas', 'Tiziano', '57024921', 'Rauch 626', '2245601305', NULL, 1, 'Hijo/a', 0, NULL),
(19, 'Nieva', 'Juana Maria', '22596070', 'America811', '2245511872', NULL, 1, 'Padre/Madre', 0, NULL),
(20, 'Lucas ', 'Iribarren', '37014169', 'Islas Malvinas 158', '2245427490', NULL, 1, 'Hijo/a', 0, NULL),
(21, 'Barbara Tamara ', 'Ludueña', '35184901', 'Esteban Facio 2107', NULL, NULL, 1, 'Hijo/a', 0, NULL),
(22, 'Valeria Mariel ', 'Adam', '32432535', 'Paysandú 1276', '2245513212', NULL, 1, 'Hijo/a', 0, NULL),
(23, 'Salinas ', 'Ángel Daniel', '47477308', 'Paysandú 1276', '2245513212', NULL, 1, 'Hijo/a', 0, NULL),
(24, 'Ale ', 'Elba Mabel', '17100217', 'Rivera 351', NULL, NULL, 1, 'dueña de la casa', 0, NULL),
(25, 'Luis Ángel ', 'Aizpitarte', '20316381', 'Vucetich 1180', '2245514736', NULL, 1, 'Padre/Madre', 0, NULL),
(26, 'Lamas Villanueva', 'María del Socorro', '94426876', 'Paysandú 525', '01121667970', NULL, 0, 'Padre/Madre', 0, NULL),
(27, 'Gómez ', 'César Gabriel', '32866843', 'Paysandú 525', '1121667970', NULL, 0, 'Padre/Madre', 0, NULL),
(28, 'Pamela Daiana', 'Averza', '32866882', 'Moreno 1050', '2245401147', NULL, 1, 'Hijo/a', 0, NULL),
(29, 'Natalia Paola', 'Cabo', '25270203', 'García Cuerva 63', '2241693626', NULL, 1, 'Hijo/a', 0, NULL),
(30, 'Ambar ', 'Martinez', '54347485', 'Echeverría 1125', '2245479271', NULL, 1, 'Hijo/a', 0, NULL),
(31, 'Amaia', 'Martinez', '57299031', 'Echeverría 1125', '2245479271', NULL, 1, 'Hijo/a', 0, NULL),
(32, 'Alicia ', 'Ortiz', '30488711', 'Libres del sUR 958', '2245518350', NULL, 1, 'Padre/Madre', 0, NULL),
(33, 'Laujen', 'Emiliano Leonel', '59975806', 'Victoriano Montes casa 134', '2245606827', NULL, 1, 'Hijo/a', 0, NULL),
(34, 'Braian ', 'Celillo', '42441290', 'Islas Malvinas 168 departamento 1 ', '2245502802', NULL, 1, 'Hijo/a', 0, NULL),
(35, 'María Elena', 'Luna', '28484039', 'Salta 885', NULL, NULL, 0, 'Padre/Madre', 0, NULL),
(36, 'Sandro', 'Aizpitarte', '21559174', 'Vucetich1180', '2245514736', NULL, 1, 'sobrino', 0, NULL),
(37, 'Alejandra ', 'Pelazzini', '24854058', 'Juncal 2570', '22455111221', NULL, 1, 'Padre/Madre', 0, NULL),
(38, 'Nancy Muriel ', 'Ibañez', '21782515', 'Brandsen 629', '2245502905', NULL, 1, '', 0, NULL),
(39, 'Franco ', 'Pueblas', '37360101', 'Victoriano Montes 1045', '2245423512', NULL, 1, 'Hijo/a', 0, NULL),
(40, 'Lucrecia Marisa', 'Chávez', '30502210', 'Pieres 705', '2245540030', NULL, 1, 'Padre/Madre', 0, NULL),
(41, 'Carlos Alberto', 'Villalba', '14314418', 'Pellegrini 1808', '2245473556', NULL, 1, 'Padre/Madre', 0, NULL),
(42, 'Alfredo ', 'Ferreyra', '12246829', 'Ingeniero Quadry 1020', '2245407496', NULL, 1, 'Padre/Madre', 0, NULL),
(43, 'María Cristina ', 'Palacios', '26773240', 'Pellegrini 915', '2245552817', NULL, 1, 'Padre/Madre', 0, NULL),
(44, 'Melany ', 'Mena', '40223570', 'Vucetich 1496', '2245541284', NULL, 1, 'Hijo/a', 0, NULL),
(45, 'Evelyn María', 'Oliver', '37907000', 'Siccardi 237', '2245510183', NULL, 1, 'Hijo/a', 0, NULL),
(46, 'Milagros Ayelén ', 'León', '41068021', 'Pringles 115', '2245540331', NULL, 1, 'Padre/Madre', 0, NULL),
(47, 'Dante', 'Davila', '50536641', 'Alem 1437', '2245424638', NULL, 1, '---', 0, NULL),
(48, 'Santiago', 'moyano', '31837018', 'Alem 1437', '2245424638', NULL, 1, 'Hijo/a', 0, NULL),
(49, 'Elsa maria', 'Carrera', '12364841', 'libres del sur 531', '2245556742', NULL, 1, 'Padre/Madre', 0, NULL),
(50, 'Hector', 'Medina', '13742104', 'arenales 561', '2245423982', NULL, 1, 'Padre/Madre', 0, NULL),
(51, 'Gladys', 'godoy', '10576192', 'pilotto 394', '2241696477', NULL, 1, 'Abuelo/a', 0, NULL),
(52, 'Elvira', 'ALDAY', '16626479', 'dorrego 1096', '2245407956', NULL, 1, 'Padre/Madre', 0, NULL),
(53, 'Carlos Raul', 'Echeverria', '27856862', 'internado hospitalario', NULL, NULL, 1, 'Hijo/a', 0, NULL),
(54, 'Norma MABEL', 'Bustamante', '6293563', 'angelinetti 597', '2245607219', NULL, 1, 'Abuelo/a', 0, NULL),
(55, 'Monica Gladys', 'Ocaño', '17267756', 'espora 169', '2245505785', NULL, 1, 'Abuelo/a', 0, NULL),
(56, 'Rosa Zelmira', 'Poledo', '17888209', 'paz casa 81', '2245554051', NULL, 1, 'Abuelo/a', 0, NULL),
(57, 'Natalia Mariel', 'Oliva', '27831809', 'paysandu 137', '2245420455', NULL, 1, 'Padre/Madre', 0, NULL),
(58, 'Jehiel gaspar', 'lezcano', '40691752', 'carranza y ameghino', '2245407247', NULL, 1, 'Hijo/a', 0, NULL),
(59, 'Felix Gustavo', 'cellillo', '8708580', 'cramer 662', '2245422085', NULL, 1, 'Padre/Madre', 0, NULL),
(60, 'Elena', 'Pavan', '6236445', 'ing cuadri 1424', '2245502617', NULL, 1, 'Padre/Madre', 0, NULL),
(61, 'jose luis', 'Ramos', '8704196', 'marconi 131', '2241672165', NULL, 1, 'Abuelo/a', 0, NULL),
(62, 'sabrina melisa', 'barbosa', '12887508', 'brandsen 192', '2245478913', NULL, 1, 'Padre/Madre', 0, NULL),
(63, 'Noemi soledad', 'Gonzalez', '32693035', 'Irlanda 113', '2245459036', 'solytomi057@gmail.com', 1, 'Hijo/a', 0, NULL),
(64, 'Jesica', 'Salamen', '36499501', 'Capiel 147', '2245511915', 'jessicapaolasalamen@gmail.com', 1, 'Hijo/a', 0, NULL),
(65, 'alberto martin', 'morales', '22716125', 'rivadavia 1000', '2245516260', NULL, 1, 'Padre/Madre', 0, NULL),
(66, 'Gustavo roberto', 'ciolfi', '22199800', 'ramos mejia 320', '116624565991', NULL, 1, 'Padre/Madre', 0, NULL),
(67, 'Jorge Hernan', 'Navarro', '38692900', 'bulgaria 169', '2245606196', NULL, 1, 'Hijo/a', 0, NULL),
(68, 'Juan Carlos', 'Martino', '10745017', 'callao 137', '2944652335', NULL, 1, 'Padre/Madre', 0, NULL),
(70, 'Ramon Jose', 'Saldarini', '17375413', 'pasaje int sin num', '2245558350', NULL, 1, 'Padre/Madre', 0, NULL),
(71, 'Gladys Ester', 'Garay', '18346319', 'pilotto 761', '2245509445', NULL, 1, 'Padre/Madre', 0, NULL),
(72, 'Nestor Pedro', 'Juarez', '5325199', 'solis 33', '2245517011', NULL, 1, 'Abuelo/a', 0, NULL),
(73, 'Horacio Domingo', 'Racioppe', '12004812', 'camino fuerza aeria', '2245432940', NULL, 1, 'Abuelo/a', 0, NULL),
(74, 'SILVIA YOLANDA', 'STURMA', '12887496', '25 DE MAYO 251', '2245424988', NULL, 1, 'Abuelo/a', 0, NULL),
(75, 'Valeria Natalia', 'Andrade', '24854187', 'junin 470', '2245426600', NULL, 1, 'Hijo/a', 0, NULL),
(76, 'Angel Argentino', 'Vincenti', '4751875', 'balcance 855', '2235492715', NULL, 1, 'Abuelo/a', 0, NULL),
(78, 'Ana Griselda', 'PELLIZZA', '17847038', 'Arenales', '2245423473', NULL, 1, '', 0, '2024-10-23'),
(79, 'Alicia Noemi', 'Dominguez', '5127560', 'garay 111', '2245423701', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(80, 'Norberto Ismael', 'Sotelo', '10745134', 'esteba facio 2107', '2245513604', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(81, 'VirginiaVeronica', 'Foque', '30533678', 'Carranza 556', '2245529814', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(82, 'Alejandra Elsa', 'Vignau', '21931877', 'Bocalandra 610', '2245501661', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(83, 'Jesus Ruben', 'Carrera', '11135962', 'Callao 435', '2245568342', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(84, 'Monica Beatriz', 'Tarzia', '17888142', 'Ameguino 550', '2245474286', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(85, 'Ramon Pablo', 'Devincenti', '22199660', 'RICHIERI 150', '2245401566', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(86, 'Milagros Guadalupe', 'Uviedo', '39279444', 'Juncal 580', '2245602601', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(87, 'Teho', 'Arbillaga', '57024972', 'Buenos Aires 140', '2245458506', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(88, 'Benjamin Ulises', 'Arriscal', '50942640', 'Robecco 319', '2245509143', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(89, 'Ramiro', 'Outon', '32432441', 'Dorrego 436', '2245424467', NULL, 0, 'Hijo/a', 0, '2024-10-23'),
(90, 'Luis Alberto', 'Hutshenreuter', '6196278', 'Marquez 14', '1137890313', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(91, 'Pedro Alberto', 'Marino', '13742238', 'Dr Capiel 520', '2245407313', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(92, 'Brian', 'ECHAURREN', '43595932', 'Esteban Facio 2148', '2245508585', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(93, 'Pedro Elias', 'Battistessa', '10153860', 'Mitre 1268', '2245428417', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(94, 'Nestor', 'Rosales', '10153758', 'Echeverria950', '2245401767', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(95, 'Felipe', 'Aguero Lara', '55947470', 'Marconi 58', '2245477951', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(96, 'Juan Carlos', 'Betti', '12716625', 'Arenales 585', '2245423473', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(97, 'Juana Carmen', 'Peralta', '3226605', '9 de Julio 388', '2245515940', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(98, 'Pascual', 'Antequera', '14784492', 'Malvinas 81', '2245407785', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(99, 'Roberto Alejandro', 'Recaite', '13357048', 'PIERROU 35', '2245471133', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(100, 'Luis ANGEL', 'van mouleghey', '14556348', 'Junin 435', '2245478763', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(101, 'amanda noemi', 'antonino', '58947186', 'mitre 1230', '2245472818', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(102, 'claudio marcelo', 'cowes', '24148973', 'paysandu 261', '2245510236', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(103, 'Luis alberto', 'Navarro', '37014321', 'solis 950', '2245504636', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(104, 'Roberto ariel', 'Aranda', '30260288', 'calle 313 rico y catelli 275', '2245407639', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(105, 'Juan ignacio', 'Junco', '17692100', 'pierrou 156', '2245512153', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(106, 'Alberto vicente', 'Villareal', '4751850', 'belgrano  1567', '2245424367', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(107, 'Daniela vanesa', 'Ferreyra', '26496260', 'salta 884', '2245403133', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(108, 'Lara yackeline', 'Iturmendi', '57589220', 'olmos 98', '2245477356', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(109, 'Rodrigo ezequiel', 'Lujan', '38351485', 'Pringles 115', '2245400150', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(110, 'Horacio sebastian', 'Cellillo', '35830048', 'Islas malvinas 168', '2245400313', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(111, 'Benjamin', 'Gutierrez Baez', '55974489', 'pellegrini 1830', '2245508089', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(112, 'Santa de la cruz', 'Duarte paredes', '94913982', 'Capiel 398', '2245501422', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(113, 'Nelida', 'Corbela', '5318680', 'Martin campos 650', '2245557462', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(114, 'Jesus Rafael', 'Bols', '11135732', 'De crome 802', '2245509316', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(115, 'Celilla ines', 'Moreno', '14784419', 'Carmona 136', '2245400150', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(116, 'Daniela celeste', 'Morales', '27856910', 'Paysandu 1356', '2245502940', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(117, 'Cintia', 'Buscichio', '14556205', 'Paz casa 8', '2245405840', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(118, 'Reynaldo rafael', 'Ramirez', '11135848', 'Pieres 548', '2245423883', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(119, 'Joaquin', 'Parodi Arrechea', '50563575', 'Ramon MELGAR 140', '2245435627', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(120, 'Agustin', 'Rossi', '55947442', 'Riobamba 379', '2245515959', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(121, 'Gaston fernando', 'Amandain', '31782691', 'Bassi 111', '2245558162', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(122, 'Guillermo eduardo', 'Barbero', '25200191', 'De la vega 525', '2245473325', NULL, 1, 'Padre/Madre, Abuelo/a', 0, '2024-10-23'),
(123, 'Evelia Noemi', 'La fuente', '1777514', 'Washington 68', '2241698256', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(124, 'Nazareno lucio', 'Parodi', '26832670', 'Irlanda 120', '2245400105', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(125, 'Gloria esperanza', 'Flores', '13844764', 'Rico 1200', '2245433055', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(126, 'Sandra irene', 'Galeano', '22801952', 'Maipu 80', '1159143462', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(127, 'Luis alberto', 'Demare', '25798612', 'Doumic 336', '2245505378', NULL, 1, 'Padre/Madre, Abuelo/a', 0, '2024-10-23'),
(128, 'Ofelia NORMA', 'Luchetti', '4741853', 'Alberdi 776', '2245476171', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(129, 'Stella Natividad', 'Moyano', '20460178', 'MACHADO 685', '2245403941', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(130, 'Benicio alfredo', 'Daconte', '54530834', 'Olavarria 315', '2245420827', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(131, 'Jorge cayetano', 'Gascue', '5329160', 'Riobamba 1234', '2245421830', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(132, 'Luca Martiniano', 'Belen', '44535926', 'America777', '2245510831', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(133, 'Jose maria', 'Marcelino', '35830041', '25 de mayo 601', '2245457007', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(134, 'Tomas', 'Petroff', '42491265', 'Machado 977', '2245518513', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(135, 'Jessica Yanina', 'Ledesma', '26149946', 'San Martin 184', '2245516090', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(136, 'Hector anibal', 'Focke', '16806683', 'Castelli 950', '2245511939', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(137, 'Nilsa EDITH', 'Deleon', '4566455', 'marconi 273', '2245425615', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(138, 'Noelia', 'Gutierrez', '36499661', 'Reconquista 742', '2245457644', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(139, 'Hector ALBERTO', 'amezaga', '12716737', 'Washington 719', '2245', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(140, 'Rosa alicia', 'Cardozo', '17209154', 'Sucre 768', '23434008814', NULL, 0, 'Abuelo/a', 0, '2024-10-23'),
(141, 'Catalina', 'Barragan', '56633768', 'Cerrito 17', '2245503552', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(142, 'agustina andrea', 'barrientos', '35340247', 'pillado 355', '1126164029', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(143, 'silvia beatriz', 'gherbi', '21782587', 'ing cuadri 1933', '2245438824', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(144, 'alfredo alberto', 'gisondo', '18151855', 'pueyrredon 1751', '2245425023', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(145, 'Maria de los angeles', 'Boides', '4085961', 'Lamadrid 415', '2241679937', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(146, 'benjamin ruben', 'doussat', '55023382', 'alberdi 980', '2241605736', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(147, 'Andrea carolina', 'Vega', '17392691', 'Buenos aires 1380', '2241570866', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(148, 'Vanesa ines', 'Salinas', '30533606', 'Juncal 560', '2245558920', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(149, 'alberto ruben', 'moyano', '20316479', 'bulgaria 169', '2245605055', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(150, 'Rosario ines', 'Gomez', '17691952', 'Juncal 560', '2241581377', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(151, 'maria eugenia', 'bigot', '29785134', 'campagne 525', '2245514821', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(152, 'Pablo', 'Dorcasberro', '20950270', 'Marquez 164', '2245425081', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(153, 'Ambar ana', 'Arias', '58122955', 'Colon y 9 de julio 490', '2245479038', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(154, 'juan carlos', 'miguel', '20950160', 'balcance 750', '2245510977', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(155, 'Roberto ricardo', 'Althabe', '13744988', 'Pringles 1300', '2268512417', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(156, 'stella maris', 'gomez', '16564813', 'rico 1037', '2241558597', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(157, 'Andrea viviana', 'Barrionuevo', '22596099', 'Reconquista 428', '2241694862', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(158, 'nestor manuel', 'gonzales martel', '18719871', 'callao 374', '2245479730', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(159, 'Angel roberto', 'Zamora', '8565550', 'Belgrano 675', '2245509661', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(160, 'Ana paula', 'Valdevalle', '58302330', 'Richieri 830', '2245554649', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(161, 'ramiro gaston', 'polo', '42958992', 'espora 905', '2245420443', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(162, 'Alicia esmeralda', 'Serafino', '4935306', 'Brandsen 150', '2245422811', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(163, 'santiago', 'chiavaro', '48569557', 'agustin alvarez 575', '2245502573', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(164, 'Angel joaquin', 'Alvarengo', '38953224', '3 de febrero 470', '2245515848', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(165, 'maria pompeya', 'pirovano', '21986429', 'barrio cooperativo casa 16', '2245513610', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(166, 'Felix wilfredo', 'Juarez', '20950121', 'Ameghino 880', '2245429166', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(167, 'Estefania', 'Fernandez', '36499852', 'Brandsen 144', '2245473868', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(168, 'washington', 'guedes etchevarne', '92570988', 'barrio cooperativo casa 16', '2245513610', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(169, 'Miriam', 'Palavecino', '34314147', 'Quadri 2044', '2245471140', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(170, 'Juanita', 'Gascue', '6329918', 'Alem 459', '1160158478', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(171, 'Guillermo emilio', 'Devicenti', '16217413', 'Machado 570', '2245401566', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(172, 'Nadia evangelina', 'Pardo', '35830027', 'Richieri 279', '2245515892', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(173, 'Damian ramiro', 'Ortega', '10055514', 'irigoyen 394', '2245510208', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(174, 'Facundo ezequiel', 'Bertucci', '31538740', 'Juncal 1484', '2245505521', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(175, 'Rolando adam', 'Tissoni', '8293664', 'Aristobulo del valle 550', '2245427318', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(176, 'Jorge daniel', 'Fontana', '14556273', 'Washington 265', '2245478524', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(177, 'Rocio natalia', 'Martinez', '37014033', 'Paysandu 764', '2245605205', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(178, 'Cipriano agustin', 'Juarez', '22596267', 'Aristobulo del valle 1876', '2245470494', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(179, 'Pampa gael', 'Sotelo', '53141771', 'Pampas 685', '2245425231', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(180, 'Maria lujan', 'Silva', '22199532', 'Pasaje interno 6', '2245427275', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(181, 'Dardo javier', 'Oliver', '18355902', 'Balcarse 171', '2245442627', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(182, 'Dylan matias', 'Vera', '42906645', 'Negri 590', '2245431981', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(183, 'Jose maria', 'Cepeda', '5326523', 'Belgrano 987', '2245513004', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(184, 'Raul eduardo', 'Goity', '10745240', 'Reconquista 285', '2245541069', NULL, 1, 'Padre/Madre, Hijo/a', 0, '2024-10-23'),
(185, 'Lucas gerardo', 'Batistucci', '35411154', 'Balcarse 369', '2245422599', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(186, 'Mateo fidel', 'Montenegro', '8536364', 'Chascomus 363', '2245515357', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(187, 'Claudia patricia', 'Van mouleghey', '22199588', 'Aurelio bassi 646', '2245508885', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(188, 'Omar hector', 'Aramburu', '5211382', 'Brugetti 1240', '2245401180', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(189, 'Luis esteban', 'Ramos', '21782887', 'Marconi 28', '2241684068', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(190, 'Carlos guillermo', 'Cislaghi', '21808106', 'Paz 575', '2245476873', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(191, 'Arturo cristian', 'Pelazzini', '16564718', 'Islas malvinas 180', '2245501210', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(192, 'Jose luis', 'Galarza', '10855748', 'Sarmiento 1450', '2245513413', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(193, 'Jose alberto', 'Gomez', '14556159', 'Agustin alvarez 786', '2245423186', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(194, 'Elsa beatriz', 'Larraburu', '5894149', 'Echevarria 1195', '2245459594', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(195, 'Octavio jose', 'Torcelli', '38345388', 'Colon 770', '2245528644', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(196, 'Federico ignacio', 'Echetto', '42594202', 'Balbi Robecco 6', '2245502159', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(197, 'Norberto', 'Simaldoni', '14314451', 'Lamadrid 1102', '2241457598', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(198, 'Agustin', 'Zamudio Ramirez', '47280849', 'Capra 386', '2245424742', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(199, 'Oscar rodolfo', 'Echandia', '12004721', 'Paysandu 805', '2245474391', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(200, 'Eduardo mauro', 'Bortolotti', '13742251', 'Riobamba 580', '2245447206', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(201, 'Maycol roman', 'Juliani', '55977491', 'Capra 384', '2245603347', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(202, 'Josefina', 'Juarez', '55947413', 'Pringles 295', '2245478684', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(203, 'Carmen gisela', 'Gimenez', '4085960', 'Brandsen 180', '2245446038', NULL, 1, 'Abuelo/a', 0, '2024-10-23'),
(204, 'Franco', 'Vera', '54139993', 'Intendente tamagno 220', '2245406111', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(205, 'Emanol', 'Gonzales velasquez', '36499975', 'Sarmiento 1160', '2245511565', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(206, 'Felix de jesus', 'Portillos molas', '92588854', 'Castelli 686', '2245400150', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(207, 'Sofia', 'Lopez', '38167433', 'Mendiola 62', '2245400150', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(208, 'Walter adrian', 'Garcia y bols', '42676056', 'San martin 838', '2245400145', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(209, 'Aurelina', 'Torales silva', '92865962', 'Victoriano montes 710', '2245517896', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(210, 'Gustavo antonio', 'pepe', '22716358', 'Hernandez 456', '2245553455', NULL, 1, 'Padre/Madre', 0, '2024-10-23'),
(211, 'Benjamin', 'Fernandez', '58208408', 'Olavarria 401', '2245509997', NULL, 1, 'Hijo/a', 0, '2024-10-23'),
(213, 'BRIAN', 'LOPEZ', '4106096', 'JUNCAL 897', '2245474988', NULL, 0, 'SOY LA PERSONA CON DISCAPACIDAD', 0, '2024-11-14'),
(214, 'Roberto', 'Roja', '8,525365', 'Piloto', '2245495338', 'guayguay@gmail.com', 1, 'Abuelo/a', 0, '2024-11-27'),
(215, 'Florencia', 'Jimenes', '7,512314', 'Junin', '2245441414', 'pipi@gmail.com', 1, 'Hijo/a', 0, '2024-11-27'),
(218, 'mauricio', 'sisti', '26832987', 'ALVEAR 1161', '02245403207', 'mjsis20052@gmail.com', 1, 'campo demo', 0, '2024-12-09'),
(219, 'mauricio', 'sisti', '26832999', 'ALVEAR 1161', '02245403207', 'mjsis20052@gmail.com', 1, 'campo demo', 0, '2024-12-09'),
(220, 'Alejandro Edgardo', 'Redondo', '5333550', 'Balcarce nº 595', '2245-424025', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(221, 'Miguel Ángel', 'Capdeville', '25798821', 'Reconquista nº 140', '2245423086', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(222, 'Brian David', 'López', '41068096', 'Juncal nº 837', '2245-568327', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(223, 'Luis Alberto', 'Demare', '14314584', 'Chiavaro casa 31', '2241-512987', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(224, 'Daiana Ayelén', 'Ceballos', '37014302', 'Irigoyen nº 1435', '2245-540761', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(225, 'Marcela Haydee', 'Poledo', '22716310', 'Arenales nº270', '2245-514487', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(226, 'Olivia', 'Barrera', '56728708', 'Olmos nº560', '2245-502035', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(227, 'Abel Mario', 'Fontana', '10745284', 'Necochea nº 8', '2245-509455', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(228, 'Victoria', 'Cellillo', '16806627', 'Pellegrini nº 78', '2245-428843', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(229, 'Nicolas Fabricio', 'Ibáñez', '50536675', 'Gorriti nº 805', '2245-426393', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(230, 'Nedda Gladys', 'Bel', '3489852', 'Dorrego nº130', '2245-509127', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(231, 'Maximiliano Manuel', 'Moreno', '25798805', 'Agustín Alvarez nº 1670', '2245-508618', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(232, 'Ignacio', 'Rivero', '44335390', 'Nelbone nº 240', '2245-541122', NULL, 1, 'Beneficiario', 0, '2025-02-11'),
(233, 'Mario Alberto', 'Mestralet', '14556231', 'Ingeniero Quadri 811', '2241680398', 'no@gmail.com', 1, 'Beneficiario', 0, '2025-02-24'),
(234, 'Marcelo', 'Ciatto', '10664771', 'Cerrito 395', '1165832685', 'Ciatto@gmail.com', 1, 'Beneficiario', 0, '2025-02-24'),
(235, 'Monica Magdalena', 'Melin', '31999106', 'Yugan 315', '2245400440', 'no@gmail.com', 1, 'Beneficiario', 0, '2025-02-24'),
(236, 'Patricia Nora', 'Posadas', '17691946', 'Paysandu 485', '2241569111', 'no@gmail.com', 1, 'Beneficiario', 0, '2025-02-24'),
(237, 'Pedro Leonardo', 'Arevalo', '13611832', 'Hipólito irigoyen 436', '2234388406', 'no@gmail.com', 1, 'Beneficiario', 0, '2025-02-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `techo`
--

CREATE TABLE `techo` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `tipo_techo` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `techo`
--

INSERT INTO `techo` (`id`, `persona_id`, `tipo_techo`) VALUES
(7, 7, 'Adobe'),
(8, 8, 'Nylon'),
(9, 9, 'Madera'),
(10, 10, 'Adobe'),
(11, 11, 'Madera'),
(12, 7, 'Madera'),
(13, 8, 'Nylon'),
(14, 9, 'Madera'),
(15, 10, 'Madera'),
(16, 11, 'Chapa'),
(17, 12, 'Chapa'),
(18, 13, 'Adobe'),
(19, 14, 'Chapa'),
(20, 15, 'Nylon'),
(21, 16, 'Nylon'),
(22, 17, 'Nylon'),
(23, 18, 'Adobe'),
(24, 19, 'Chapa'),
(25, 20, 'Chapa'),
(26, 21, 'Nylon'),
(27, 22, 'Chapa'),
(28, 23, 'Chapa'),
(29, 24, 'Nylon'),
(30, 25, 'Chapa'),
(31, 26, 'Adobe'),
(32, 27, 'Madera'),
(33, 28, 'Chapa'),
(34, 29, 'Chapa'),
(35, 30, 'Adobe'),
(36, 31, 'Chapa'),
(37, 32, 'Adobe'),
(38, 33, 'Adobe'),
(39, 34, 'Nylon'),
(40, 35, 'Madera'),
(41, 36, 'Madera'),
(58, 43, 'Chapa'),
(63, 45, 'Madera'),
(64, 46, 'Chapa'),
(65, 47, 'Chapa'),
(66, 48, 'Chapa'),
(71, 44, 'Madera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `uso_ambiente`
--

CREATE TABLE `uso_ambiente` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) DEFAULT NULL,
  `uso` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `uso_ambiente`
--

INSERT INTO `uso_ambiente` (`id`, `persona_id`, `uso`) VALUES
(4, 7, 'Almacén'),
(5, 8, 'Almacén'),
(6, 9, 'Ático'),
(7, 10, 'Lavadero'),
(8, 11, 'Comedor'),
(9, 12, 'Jardín'),
(10, 13, 'Ático'),
(11, 14, 'Sótano'),
(12, 15, 'Cocina'),
(13, 16, 'Terraza'),
(14, 17, 'Ático'),
(15, 18, 'Sala de juegos'),
(16, 19, 'Baño'),
(17, 20, 'Jardín'),
(18, 21, 'Baño'),
(19, 22, 'Sala de estar'),
(20, 23, 'Cuarto de servicio'),
(21, 24, 'Jardín'),
(22, 25, 'Baño'),
(23, 26, 'Oficina'),
(24, 27, 'Oficina'),
(25, 28, 'Baño'),
(26, 29, 'Cocina'),
(27, 30, 'Comedor'),
(28, 31, 'Balcón'),
(29, 32, 'Sala de televisión.'),
(30, 33, 'Almacén'),
(31, 34, 'Sótano'),
(32, 35, 'Balcón'),
(33, 36, 'Balcón'),
(34, 7, 'Despensa'),
(35, 8, 'Gimnasio'),
(36, 9, 'Taller'),
(37, 10, 'Cuarto de servicio'),
(38, 11, 'Sótano'),
(39, 12, 'Ático'),
(40, 13, 'Estudio'),
(41, 14, 'Lavadero'),
(42, 15, 'Oficina'),
(43, 16, 'Despensa'),
(44, 17, 'Sala de televisión.'),
(45, 18, 'Almacén'),
(46, 19, 'Taller'),
(47, 20, 'Cuarto de servicio'),
(48, 21, 'Almacén'),
(49, 22, 'Garaje'),
(50, 23, 'Estudio'),
(51, 24, 'Oficina'),
(52, 25, 'Gimnasio'),
(53, 26, 'Lavadero'),
(54, 27, 'Sala de televisión.'),
(55, 28, 'Balcón'),
(56, 29, 'Sala de estar'),
(57, 30, 'Lavadero'),
(58, 31, 'Baño'),
(59, 7, 'Sala de televisión.'),
(60, 8, 'Sala'),
(61, 9, 'Cuarto de servicio'),
(62, 10, 'Almacén'),
(63, 11, 'Sala de juegos'),
(64, 12, 'Gimnasio'),
(65, 13, 'Oficina'),
(66, 14, 'Taller'),
(67, 15, 'Jardín'),
(68, 16, 'Sótano'),
(69, 17, 'Oficina'),
(70, 18, 'Garaje'),
(98, 43, 'living'),
(99, 43, 'cocina'),
(100, 43, 'dormitorio'),
(101, 43, 'baño'),
(118, 45, 'Comedor cocina '),
(119, 45, 'Baño'),
(120, 45, 'Dormitorio '),
(121, 45, 'Dormitorio'),
(122, 46, 'Cocina'),
(123, 46, 'Comedor '),
(124, 46, 'Habitacion'),
(125, 47, 'Comedor'),
(126, 47, 'Cocina'),
(127, 47, 'Habitación '),
(128, 47, 'Habitación '),
(129, 47, 'Baño'),
(130, 48, 'dormitorio'),
(131, 44, 'dormitorio'),
(132, 44, 'living'),
(133, 44, 'cocina'),
(134, 44, 'baño');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `permisos_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `permisos_id`) VALUES
(1, 'admin', '$2y$10$LrPSpInhwH6AEtbtXqMk1ObCydgDiUeMUf9hkJSyYwnSRglWJ1DNy', 1),
(2, 'at', '$2y$10$SrXYGy47Y7zTBZpdseChbuJwxOY8pmlrjI3DRauRuUMBXr3orl5Da', 2),
(3, 'comunicador', '$2y$10$vICogcxC8kF5Jkc9f/c5euASdb78VrzeZhuwdHadpv52V9oUrum82', 3),
(4, 'observador', '$2y$10$AvIW3QQ7Tc6Alpy.bVeGgOG8b.OPEuTwQqa5AP/64TZEDOY1f4Riy', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valores`
--

CREATE TABLE `valores` (
  `id` int(11) NOT NULL,
  `valor` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `valores`
--

INSERT INTO `valores` (`id`, `valor`) VALUES
(1, 'malo'),
(2, 'regular'),
(3, 'bueno'),
(4, 'muy bueno'),
(5, 'excelente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(11) NOT NULL,
  `zona` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `zona`) VALUES
(1, 'JIN 902'),
(2, 'JIN 906'),
(3, 'JIN 903'),
(4, 'JIN 901'),
(5, 'JIN 905'),
(6, 'JIN 904');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `discapacidades`
--
ALTER TABLE `discapacidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_id` (`persona_id`),
  ADD KEY `fk_tipo_discapacidad` (`tipo_discapacidad`);

--
-- Indices de la tabla `elementos_confort`
--
ALTER TABLE `elementos_confort`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_persona_elemento_id` (`persona_id`),
  ADD KEY `fk_elemento_id` (`elemento`);

--
-- Indices de la tabla `grupo_familiar`
--
ALTER TABLE `grupo_familiar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grupo_persona_id` (`persona_id`);

--
-- Indices de la tabla `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pared`
--
ALTER TABLE `pared`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pared_persona_id` (`persona_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_zona_id` (`zona`),
  ADD KEY `fk_ventilacion_id` (`ventilacion`),
  ADD KEY `fk_higiene_id` (`higiene`),
  ADD KEY `fk_orden_id` (`orden`),
  ADD KEY `fk_iluminacion_id` (`iluminacion`),
  ADD KEY `fk_barreras_arquitectonicas_id` (`barreras_arquitectonicas`);

--
-- Indices de la tabla `piso`
--
ALTER TABLE `piso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_piso_persona_id` (`persona_id`);

--
-- Indices de la tabla `que_discapacidad`
--
ALTER TABLE `que_discapacidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `que_elemento`
--
ALTER TABLE `que_elemento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_discapacidad`
--
ALTER TABLE `registro_discapacidad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- Indices de la tabla `techo`
--
ALTER TABLE `techo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_techo_persona_id` (`persona_id`);

--
-- Indices de la tabla `uso_ambiente`
--
ALTER TABLE `uso_ambiente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ambiente_persona_id` (`persona_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_permisos_id` (`permisos_id`);

--
-- Indices de la tabla `valores`
--
ALTER TABLE `valores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `discapacidades`
--
ALTER TABLE `discapacidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT de la tabla `elementos_confort`
--
ALTER TABLE `elementos_confort`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT de la tabla `grupo_familiar`
--
ALTER TABLE `grupo_familiar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT de la tabla `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `pared`
--
ALTER TABLE `pared`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `piso`
--
ALTER TABLE `piso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de la tabla `que_discapacidad`
--
ALTER TABLE `que_discapacidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `que_elemento`
--
ALTER TABLE `que_elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `registro_discapacidad`
--
ALTER TABLE `registro_discapacidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT de la tabla `techo`
--
ALTER TABLE `techo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT de la tabla `uso_ambiente`
--
ALTER TABLE `uso_ambiente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `valores`
--
ALTER TABLE `valores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `discapacidades`
--
ALTER TABLE `discapacidades`
  ADD CONSTRAINT `fk_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tipo_discapacidad` FOREIGN KEY (`tipo_discapacidad`) REFERENCES `que_discapacidad` (`id`);

--
-- Filtros para la tabla `elementos_confort`
--
ALTER TABLE `elementos_confort`
  ADD CONSTRAINT `fk_elemento_id` FOREIGN KEY (`elemento`) REFERENCES `que_elemento` (`id`),
  ADD CONSTRAINT `fk_persona_elemento_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `grupo_familiar`
--
ALTER TABLE `grupo_familiar`
  ADD CONSTRAINT `fk_grupo_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pared`
--
ALTER TABLE `pared`
  ADD CONSTRAINT `fk_pared_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_barreras_arquitectonicas_id` FOREIGN KEY (`barreras_arquitectonicas`) REFERENCES `valores` (`id`),
  ADD CONSTRAINT `fk_higiene_id` FOREIGN KEY (`higiene`) REFERENCES `valores` (`id`),
  ADD CONSTRAINT `fk_iluminacion_id` FOREIGN KEY (`iluminacion`) REFERENCES `valores` (`id`),
  ADD CONSTRAINT `fk_orden_id` FOREIGN KEY (`orden`) REFERENCES `valores` (`id`),
  ADD CONSTRAINT `fk_ventilacion_id` FOREIGN KEY (`ventilacion`) REFERENCES `valores` (`id`),
  ADD CONSTRAINT `fk_zona_id` FOREIGN KEY (`zona`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `piso`
--
ALTER TABLE `piso`
  ADD CONSTRAINT `fk_piso_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `techo`
--
ALTER TABLE `techo`
  ADD CONSTRAINT `fk_techo_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `uso_ambiente`
--
ALTER TABLE `uso_ambiente`
  ADD CONSTRAINT `fk_ambiente_persona_id` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_permisos_id` FOREIGN KEY (`permisos_id`) REFERENCES `permisos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
