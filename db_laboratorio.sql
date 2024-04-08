-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-04-2024 a las 16:51:32
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
-- Base de datos: `db_laboratorio`
--

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
-- Estructura de tabla para la tabla `form_type_values`
--

CREATE TABLE `form_type_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `form_type_values`
--

INSERT INTO `form_type_values` (`id`, `test_id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, '@resultadoIgMN', 'number', '2024-04-01 21:13:58', '2024-04-01 21:13:58'),
(2, 1, '@resultadoCutOffIgMN', 'number', '2024-04-01 21:13:58', '2024-04-01 21:13:58'),
(3, 1, '@estadoIgMS', 'text', '2024-04-01 21:13:58', '2024-04-01 21:13:58'),
(4, 1, '@resultadoIgGN', 'number', '2024-04-01 21:13:59', '2024-04-01 21:13:59'),
(5, 1, '@resultadoCutOffIgGN', 'number', '2024-04-01 21:13:59', '2024-04-01 21:13:59'),
(6, 1, '@estadoIgMS', 'text', '2024-04-01 21:13:59', '2024-04-01 21:13:59'),
(7, 1, '@resultadoVIHS', 'text', '2024-04-01 21:13:59', '2024-04-01 21:13:59'),
(8, 1, '@estadoFinalS', 'text', '2024-04-01 21:13:59', '2024-04-01 21:13:59'),
(9, 2, '@resultadoS', 'text', '2024-04-08 17:32:10', '2024-04-08 17:32:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hora` time NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen_files`
--

CREATE TABLE `imagen_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagen_files`
--

INSERT INTO `imagen_files` (`id`, `path`, `created_at`, `updated_at`) VALUES
(1, 'cover1.png', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(2, 'cover2.png', '2024-03-23 04:09:45', '2024-03-23 04:09:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_citas`
--

CREATE TABLE `lista_citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hora_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `horario` time NOT NULL,
  `fecha` date NOT NULL DEFAULT '2024-03-23',
  `prescription` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_citas`
--

INSERT INTO `lista_citas` (`id`, `hora_id`, `code`, `horario`, `fecha`, `prescription`, `status`, `client_id`, `user_id`, `created_at`, `updated_at`) VALUES
(3, NULL, '202403-0001', '15:06:00', '2024-03-25', NULL, 4, 2, NULL, '2024-03-23 06:01:15', '2024-04-01 21:30:15'),
(4, NULL, '202404-0001', '09:24:00', '2024-04-02', NULL, 4, 1, NULL, '2024-04-01 17:22:38', '2024-04-08 18:11:01'),
(5, NULL, '202404-0002', '11:28:00', '2024-04-10', NULL, 4, 2, NULL, '2024-04-08 17:28:27', '2024-04-08 18:21:01'),
(6, NULL, '202404-0003', '11:45:00', '2024-04-09', NULL, 4, 3, NULL, '2024-04-08 17:43:59', '2024-04-08 17:45:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_clientes`
--

CREATE TABLE `lista_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_clientes`
--

INSERT INTO `lista_clientes` (`id`, `user_id`, `gender`, `contact`, `dob`, `address`, `estado`, `created_at`, `updated_at`) VALUES
(1, 3, 'Masculino', '56566556', '1997-06-02', 'Lima', 1, '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(2, 5, 'Masculino', '55548427', '2006-11-22', 'calle union', 1, '2024-03-23 04:29:02', '2024-04-01 17:20:38'),
(3, 6, 'Masculino', '36166885', '2008-03-25', 'calle union', 0, '2024-04-01 20:05:52', '2024-04-01 20:05:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_historials`
--

CREATE TABLE `lista_historials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `remarks` text NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_historials`
--

INSERT INTO `lista_historials` (`id`, `status`, `remarks`, `appointment_id`, `created_at`, `updated_at`) VALUES
(2, 1, 'Sin observaciones', 3, '2024-04-01 17:35:38', '2024-04-01 17:35:38'),
(3, 2, 'Sin observaciones', 3, '2024-04-01 21:23:31', '2024-04-01 21:23:31'),
(4, 4, 'La prueba se finalizo', 3, '2024-04-01 21:30:15', '2024-04-01 21:30:15'),
(5, 1, 'Sin observaciones', 5, '2024-04-08 17:28:46', '2024-04-08 17:28:46'),
(6, 2, 'Sin observaciones', 5, '2024-04-08 17:35:19', '2024-04-08 17:35:19'),
(7, 4, 'Prueba finalizada', 5, '2024-04-08 17:36:37', '2024-04-08 17:36:37'),
(8, 1, 'Sin observaciones', 6, '2024-04-08 17:44:40', '2024-04-08 17:44:40'),
(9, 2, 'Sin observaciones', 6, '2024-04-08 17:45:06', '2024-04-08 17:45:06'),
(10, 4, 'Prueba finalizada', 6, '2024-04-08 17:45:27', '2024-04-08 17:45:27'),
(11, 2, 'Sin observaciones', 4, '2024-04-08 17:51:42', '2024-04-08 17:51:42'),
(12, 4, 'Prueba finalizada', 4, '2024-04-08 18:11:01', '2024-04-08 18:11:01'),
(13, 4, 'Prueba finalizada', 5, '2024-04-08 18:21:01', '2024-04-08 18:21:01'),
(14, 4, 'Prueba finalizada', 3, '2024-04-08 18:23:18', '2024-04-08 18:23:18'),
(15, 4, 'Prueba finalizada', 4, '2024-04-08 18:39:32', '2024-04-08 18:39:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_pruebas`
--

CREATE TABLE `lista_pruebas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` int(11) NOT NULL DEFAULT 1,
  `delete` int(11) NOT NULL DEFAULT 0,
  `fecha` date NOT NULL DEFAULT '2024-03-23',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_pruebas`
--

INSERT INTO `lista_pruebas` (`id`, `name`, `description`, `cost`, `status`, `delete`, `fecha`, `created_at`, `updated_at`) VALUES
(1, 'Inmunología', '<table style=\"width: 100%; border-collapse: collapse; text-align: center;\">\r\n<tbody>\r\n<tr>\r\n<td>Doctor</td>\r\n<td>F. Petici&oacute;n</td>\r\n<td>Edad</td>\r\n<td>N&deg; Historia</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; #nombreDoctor</td>\r\n<td>&nbsp; #ePeticion</td>\r\n<td>&nbsp; #edad</td>\r\n<td>&nbsp; #nHistoria</td>\r\n</tr>\r\n<tr>\r\n<td>Nombre del Paciente</td>\r\n<td>N&deg; Asegurado</td>\r\n<td>Sexo</td>\r\n<td>N&deg; Consulta</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; #paciente</td>\r\n<td>&nbsp; #asegurado</td>\r\n<td>&nbsp; #sexo</td>\r\n<td>&nbsp; #consulta</td>\r\n</tr>\r\n<tr>\r\n<td>Orig&eacute;n</td>\r\n<td>Entidad</td>\r\n<td>Cliente</td>\r\n<td>N&deg; Orden</td>\r\n</tr>\r\n<tr>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td>&nbsp; #cliente</td>\r\n<td>&nbsp; #nOrden</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 100%;\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Inmunolog&iacute;a</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Determinaci&oacute;n</td>\r\n<td style=\"text-align: center;\">Resultado</td>\r\n<td style=\"text-align: center;\">Unidades</td>\r\n<td style=\"text-align: center;\">Valores de Referencia</td>\r\n<td style=\"text-align: center;\">!</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Resultado Toxoplasmosis IgM</strong></td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; @resultadoIgMN</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cut Off</td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; @resultadoCutOffIgMN</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Conclusi&oacute;n</td>\r\n<td colspan=\"4\"><strong>La muestra&nbsp; @estadoIgMS presenta Anticuerpos de tipo IgM contra Toxoplasma Gondii.</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Resultado Toxoplasmosis IgG</strong></td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; @resultadoIgGN</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cut Off</td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; @resultadoCutOffIgGN</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Conclusi&oacute;n</td>\r\n<td colspan=\"4\"><strong>La muestra&nbsp; @estadoIgMS presenta Anticuerpos de tipo IgG contra Toxoplasma Gondii.</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>YIH Prueba R&aacute;pida</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">&nbsp;M&eacute;todo: Prueba R&aacute;pida de detecci&oacute;n de anticuerpos contra VIH.</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\" colspan=\"5\"><strong>&nbsp; @resultadoVIHS&nbsp; contra el virus de inmunodeficiencia humana.</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Reagina Plasm&aacute;tica R&aacute;pida. (R.P.R.)</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: Aglutinaci&oacute;n L&aacute;tex cuantitativo.</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\" colspan=\"5\"><strong>&nbsp; @estadoFinalS</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 255.00, 1, 0, '2024-03-23', '2024-03-23 05:07:24', '2024-03-23 05:14:00'),
(2, 'Hormonas', '<p>&nbsp;</p>\r\n<table style=\"width: 864px; text-align: center; height: 112px;\">\r\n<tbody>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Doctor</span></td>\r\n<td><span style=\"font-size: 10pt;\">F. Petici&oacute;n</span></td>\r\n<td><span style=\"font-size: 10pt;\">Edad</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Historia</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #nombreDoctor</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #ePeticion</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #edad</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #nHistoria</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Nombre del Paciente</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Asegurado</span></td>\r\n<td><span style=\"font-size: 10pt;\">Sexo</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Consulta</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #paciente</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #asegurado</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #sexo</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #consulta</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Orig&eacute;n</span></td>\r\n<td><span style=\"font-size: 10pt;\">Entidad</span></td>\r\n<td><span style=\"font-size: 10pt;\">Cliente</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Orden</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\r\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #cliente</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; #nOrden</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 861px; height: 176px;\">\r\n<tbody>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\"><strong>Hormonas</strong></span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Determinaci&oacute;n</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Resultado</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Unidades</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Valores de Referencia</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">!</span></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">\r\n<p><strong><span lang=\"ES\" style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)</span></strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)&nbsp; </span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\"><strong>@resultadoS</strong></span></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 150.00, 1, 0, '2024-03-23', '2024-03-26 18:50:34', '2024-04-08 17:27:55'),
(3, 'Urianálisis', '<table style=\"width: 100%; border-collapse: collapse; text-align: center;\">\r\n<tbody>\r\n<tr>\r\n<td>Doctor</td>\r\n<td>F. Petici&oacute;n</td>\r\n<td>Edad</td>\r\n<td>N&deg; Historia</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; #nombreDoctor</td>\r\n<td>&nbsp; #ePeticion</td>\r\n<td>&nbsp; #edad</td>\r\n<td>&nbsp; #nHistoria</td>\r\n</tr>\r\n<tr>\r\n<td>Nombre del Paciente</td>\r\n<td>N&deg; Asegurado</td>\r\n<td>Sexo</td>\r\n<td>N&deg; Consulta</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; #paciente</td>\r\n<td>&nbsp; #asegurado</td>\r\n<td>&nbsp; #sexo</td>\r\n<td>&nbsp; #consulta</td>\r\n</tr>\r\n<tr>\r\n<td>Orig&eacute;n</td>\r\n<td>Entidad</td>\r\n<td>Cliente</td>\r\n<td>N&deg; Orden</td>\r\n</tr>\r\n<tr>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td>&nbsp; #cliente</td>\r\n<td>&nbsp; #nOrden</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h3>Urian&aacute;lisis</h3>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 40%;\"><strong>Determinaci&oacute;n</strong></td>\r\n<td style=\"width: 25%;\"><strong>Resultado</strong></td>\r\n<th style=\"width: 15%;\">Unidades</th>\r\n<th style=\"width: 15%;\">Valores de Referencia</th>\r\n<th style=\"width: 5%;\">!</th>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>M&eacute;todo : Examen macroscopico y qu&iacute;mico.</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Urianalisis :</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo : Examen macroscopico y qu&iacute;mico.</td>\r\n</tr>\r\n<tr>\r\n<td>Color</td>\r\n<th>Amarillo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Aspecto</td>\r\n<th>Ligeramente opalescente</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>pH en orina</td>\r\n<th>7,0</th>\r\n<td>&nbsp;</td>\r\n<td>5-7</td>\r\n</tr>\r\n<tr>\r\n<td>Densidad</td>\r\n<th>1025</th>\r\n<td>&nbsp;</td>\r\n<td>1008-1025</td>\r\n</tr>\r\n<tr>\r\n<td>Prote&iacute;nas</td>\r\n<th>Negativo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Glucosa</td>\r\n<th>Negativo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cuerpos cet&oacute;nicos</td>\r\n<th>Negativo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Bilirrubina</td>\r\n<th>Negativo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Hemoglobina</td>\r\n<th>Negativo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Nitritos</td>\r\n<th>Positivo</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Sedimento Urinario:</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo : Examen microsc&oacute;pico.</td>\r\n</tr>\r\n<tr>\r\n<td>C&eacute;lulas epiteliales</td>\r\n<th>6 a 8 c&eacute;lulas por campo</th>\r\n<td>&nbsp;</td>\r\n<td>&lt;10</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Leucocitos</td>\r\n<th>25 a 30 por campo</th>\r\n<td>&nbsp;</td>\r\n<td>&lt;10</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Eritrocitos</td>\r\n<th>No se observan</th>\r\n<td>&nbsp;</td>\r\n<td>0-1</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cilindros</td>\r\n<th>No se observan</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cristales</td>\r\n<th>No se observan</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Bacterias</td>\r\n<th>Solo 2 bacterias</th>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>Comentario Sedimentos:<strong> Cantidad de bacilos grand negativos moderada. Cantidad de filamentos de mucus.</strong></p>', 100.00, 1, 0, '2024-03-23', '2024-03-26 19:30:51', '2024-04-01 18:04:41'),
(4, 'Hemograma', '<p>&nbsp;</p>\r\n<table style=\"width: 100%; border-collapse: collapse; text-align: center;\">\r\n<tbody>\r\n<tr>\r\n<td>Doctor</td>\r\n<td>F. Petici&oacute;n</td>\r\n<td>Edad</td>\r\n<td>N&deg; Historia</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; #nombreDoctor</td>\r\n<td>&nbsp; #ePeticion</td>\r\n<td>&nbsp; #edad</td>\r\n<td>&nbsp; #nHistoria</td>\r\n</tr>\r\n<tr>\r\n<td>Nombre del Paciente</td>\r\n<td>N&deg; Asegurado</td>\r\n<td>Sexo</td>\r\n<td>N&deg; Consulta</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; #paciente</td>\r\n<td>&nbsp; #asegurado</td>\r\n<td>&nbsp; #sexo</td>\r\n<td>&nbsp; #consulta</td>\r\n</tr>\r\n<tr>\r\n<td>Orig&eacute;n</td>\r\n<td>Entidad</td>\r\n<td>Cliente</td>\r\n<td>N&deg; Orden</td>\r\n</tr>\r\n<tr>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td>&nbsp; #cliente</td>\r\n<td>&nbsp; #nOrden</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<h3><strong>Hemograma Completo</strong></h3>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td><strong>Determinaci&oacute;n</strong></td>\r\n<td><strong>Resultado</strong></td>\r\n<th>Unidades</th>\r\n<th>Valores de Referencia</th>\r\n<th>!</th>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Hematimetr&iacute;a</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: Conteo Impedancia Autoanalizador HumaCount 80s</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Serie Roja</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Eritrocitos</td>\r\n<td>7,70</td>\r\n<td>Mill/mm3</td>\r\n<td>4.5 - 5.9</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Hemoglobina</td>\r\n<td>22,1</td>\r\n<td>g/dl</td>\r\n<td>12.5 - 17.5</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Hematrocito</td>\r\n<td>70</td>\r\n<td>%</td>\r\n<td>42.0 - 55.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>V.C.M.</td>\r\n<td>90</td>\r\n<td>fl</td>\r\n<td>88.0 - 98.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>H.C.M.</td>\r\n<td>29</td>\r\n<td>pq</td>\r\n<td>26.0 - 33.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>C.H.C.M.</td>\r\n<td>32</td>\r\n<td>g/dl</td>\r\n<td>28.0 - 36.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Serie Blanca</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Leucocitos</td>\r\n<td>8,10</td>\r\n<td>mm3</td>\r\n<td>5.0 - 10.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Monocitos</td>\r\n<td>5</td>\r\n<td>%</td>\r\n<td>2 - 10</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Linfocitos</td>\r\n<td>38</td>\r\n<td>%</td>\r\n<td>20 - 40</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Neutr&oacute;filos</td>\r\n<td>57</td>\r\n<td>%</td>\r\n<td>40 - 70</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cayados</td>\r\n<td>0</td>\r\n<td>%</td>\r\n<td>0 - 3</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Eosin&oacute;filos</td>\r\n<td>0</td>\r\n<td>%</td>\r\n<td>0 - 4</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Bas&oacute;filos</td>\r\n<td>0</td>\r\n<td>%</td>\r\n<td>0 - 2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Plaquetas</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Plaquetas</td>\r\n<td>137,0</td>\r\n<td>Mil/mm3</td>\r\n<td>150.0 - 400.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>VPM</td>\r\n<td>7,9</td>\r\n<td>fl</td>\r\n<td>6,4 - 10,4</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Eritrocedimentacion</td>\r\n<td>1</td>\r\n<td>mm</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Grupo Sangu&iacute;neo y Factor Rh</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: Aglutinaci&oacute;n en tubo</td>\r\n</tr>\r\n<tr>\r\n<td>Grupo Sangu&iacute;neo</td>\r\n<td>&rdquo;O&rdquo;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Factor Rh</td>\r\n<td>Positivo</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Tiempo de Sangr&iacute;a y Coagulaci&oacute;n</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: Automatizador HumaClot Junior</td>\r\n</tr>\r\n<tr>\r\n<td>Tiempo de sangr&iacute;a</td>\r\n<td>2 min</td>\r\n<td>&nbsp;</td>\r\n<td>1 a 3 minutos</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Tiempo de coagulaci&oacute;n</td>\r\n<td>10 min</td>\r\n<td>&nbsp;</td>\r\n<td>6 a 10 minutos</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Tiempo de Tromboplastina Parcial Activado (TTPA)</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: Automatizador HumaClot Junior-Quick</td>\r\n</tr>\r\n<tr>\r\n<td>Tiempo de tromboplastina parcial activado(TTPA)</td>\r\n<td>40,0</td>\r\n<td>seg</td>\r\n<td>20.0 - 40.0</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Tiempo de Protombina e INR</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: M&eacute;todo: Automatizador HumaClot Junior.</td>\r\n</tr>\r\n<tr>\r\n<td>Tiempo de protrombina</td>\r\n<td>12,90</td>\r\n<td>seg</td>\r\n<td>11,00 - 13,00</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Actividad protromb&iacute;nica</td>\r\n<td>85,0</td>\r\n<td>%</td>\r\n<td>90% - 100%</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>INR</td>\r\n<td>1,30</td>\r\n<td>&nbsp;</td>\r\n<td>1.0 - 1.2</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>Comentario Hemograma</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Comentario hemograma</td>\r\n<td colspan=\"4\">SERIE ROJA: eritrocitos verificada por m&eacute;todo manual y automatizado, SERI&Eacute; TROMBOCITICA: trombocitopenia verificada por m&eacute;todo manual y automatizado</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 80.00, 1, 0, '2024-03-23', '2024-03-26 19:55:15', '2024-03-26 19:55:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_prueba_citas`
--

CREATE TABLE `lista_prueba_citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `pdf` varchar(255) DEFAULT NULL,
  `formulario` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `fecha` datetime NOT NULL DEFAULT '2024-03-23 00:09:37',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_prueba_citas`
--

INSERT INTO `lista_prueba_citas` (`id`, `appointment_id`, `test_id`, `pdf`, `formulario`, `estado`, `fecha`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 'pdfs/2024-04-08_14-23-18.pdf', '<table style=\"width: 100%; border-collapse: collapse; text-align: center;\">\r\n<tbody>\r\n<tr>\r\n<td>Doctor</td>\r\n<td>F. Petici&oacute;n</td>\r\n<td>Edad</td>\r\n<td>N&deg; Historia</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; Alex Pereira </td>\r\n<td>&nbsp; 232</td>\r\n<td>&nbsp; 17</td>\r\n<td>&nbsp; 79</td>\r\n</tr>\r\n<tr>\r\n<td>Nombre del Paciente</td>\r\n<td>N&deg; Asegurado</td>\r\n<td>Sexo</td>\r\n<td>N&deg; Consulta</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp; Charly Brauw </td>\r\n<td>&nbsp; 765</td>\r\n<td>&nbsp; Masculino</td>\r\n<td>&nbsp; 876</td>\r\n</tr>\r\n<tr>\r\n<td>Orig&eacute;n</td>\r\n<td>Entidad</td>\r\n<td>Cliente</td>\r\n<td>N&deg; Orden</td>\r\n</tr>\r\n<tr>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td><strong>LABORATORIO PEREZ</strong></td>\r\n<td>&nbsp; 97</td>\r\n<td>&nbsp; 45</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 100%;\">\r\n<tbody>\r\n<tr>\r\n<td><strong>Inmunolog&iacute;a</strong></td>\r\n</tr>\r\n<tr>\r\n<td>Determinaci&oacute;n</td>\r\n<td style=\"text-align: center;\">Resultado</td>\r\n<td style=\"text-align: center;\">Unidades</td>\r\n<td style=\"text-align: center;\">Valores de Referencia</td>\r\n<td style=\"text-align: center;\">!</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Resultado Toxoplasmosis IgM</strong></td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; 4.2</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cut Off</td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; 00.4</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Conclusi&oacute;n</td>\r\n<td colspan=\"4\"><strong>La muestra&nbsp; Si presenta Anticuerpos de tipo IgM contra Toxoplasma Gondii.</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Resultado Toxoplasmosis IgG</strong></td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; 09.2</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Cut Off</td>\r\n<td style=\"text-align: center;\"><strong>&nbsp; 0.2</strong></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Conclusi&oacute;n</td>\r\n<td colspan=\"4\"><strong>La muestra&nbsp; Si presenta Anticuerpos de tipo IgG contra Toxoplasma Gondii.</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\"><strong>YIH Prueba R&aacute;pida</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">&nbsp;M&eacute;todo: Prueba R&aacute;pida de detecci&oacute;n de anticuerpos contra VIH.</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\" colspan=\"5\"><strong>&nbsp; No&nbsp; contra el virus de inmunodeficiencia humana.</strong></td>\r\n</tr>\r\n<tr>\r\n<td><strong>Reagina Plasm&aacute;tica R&aacute;pida. (R.P.R.)</strong></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">M&eacute;todo: Aglutinaci&oacute;n L&aacute;tex cuantitativo.</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\" colspan=\"5\"><strong>&nbsp; Sno</strong></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 2, '2024-03-23 00:09:37', '2024-03-23 06:01:15', '2024-04-08 18:23:18'),
(3, 4, 2, 'pdfs/2024-04-08_14-39-33.pdf', '<p>&nbsp;</p>\r\n<table style=\"width: 864px; text-align: center; height: 112px;\">\r\n<tbody>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Doctor</span></td>\r\n<td><span style=\"font-size: 10pt;\">F. Petici&oacute;n</span></td>\r\n<td><span style=\"font-size: 10pt;\">Edad</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Historia</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; Mauricio Perez </span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 232</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 26</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 79</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Nombre del Paciente</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Asegurado</span></td>\r\n<td><span style=\"font-size: 10pt;\">Sexo</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Consulta</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; Javier Tito Gonzales</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 765</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; Masculino</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 876</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Orig&eacute;n</span></td>\r\n<td><span style=\"font-size: 10pt;\">Entidad</span></td>\r\n<td><span style=\"font-size: 10pt;\">Cliente</span></td>\r\n<td><span style=\"font-size: 10pt;\">N&deg; Orden</span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\r\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 97</span></td>\r\n<td><span style=\"font-size: 10pt;\">&nbsp; 45</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<table style=\"width: 861px; height: 176px;\">\r\n<tbody>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\"><strong>Hormonas</strong></span></td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Determinaci&oacute;n</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Resultado</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Unidades</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Valores de Referencia</span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">!</span></td>\r\n</tr>\r\n<tr>\r\n<td colspan=\"5\">\r\n<p><strong><span lang=\"ES\" style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)</span></strong></p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td><span style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)&nbsp; </span></td>\r\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\"><strong>@resultadoCutOffIgM</strong></span></td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 2, '2024-03-23 00:09:37', '2024-04-01 17:22:38', '2024-04-08 18:39:33'),
(4, 5, 2, 'pdfs/2024-04-08_14-21-01.pdf', '<p>&nbsp;</p>\n<table style=\"width: 864px; text-align: center; height: 112px;\">\n<tbody>\n<tr>\n<td><span style=\"font-size: 10pt;\">Doctor</span></td>\n<td><span style=\"font-size: 10pt;\">F. Petici&oacute;n</span></td>\n<td><span style=\"font-size: 10pt;\">Edad</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Historia</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">&nbsp; Mauricio Perez </span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 232</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 17</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 79</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Nombre del Paciente</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Asegurado</span></td>\n<td><span style=\"font-size: 10pt;\">Sexo</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Consulta</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">&nbsp; Charly Brauw </span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 765</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; Masculino</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 876</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Orig&eacute;n</span></td>\n<td><span style=\"font-size: 10pt;\">Entidad</span></td>\n<td><span style=\"font-size: 10pt;\">Cliente</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Orden</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 97</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 45</span></td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table style=\"width: 861px; height: 176px;\">\n<tbody>\n<tr>\n<td><span style=\"font-size: 10pt;\"><strong>Hormonas</strong></span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Determinaci&oacute;n</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Resultado</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Unidades</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Valores de Referencia</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">!</span></td>\n</tr>\n<tr>\n<td colspan=\"5\">\n<p><strong><span lang=\"ES\" style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)</span></strong></p>\n</td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)&nbsp; </span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\"><strong>Positivo</strong></span></td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', 2, '2024-03-23 00:09:37', '2024-04-08 17:28:27', '2024-04-08 18:21:01'),
(5, 6, 2, 'pdfs/2024-04-08_13-45-27.pdf', '<p>&nbsp;</p>\n<table style=\"width: 864px; text-align: center; height: 112px;\">\n<tbody>\n<tr>\n<td><span style=\"font-size: 10pt;\">Doctor</span></td>\n<td><span style=\"font-size: 10pt;\">F. Petici&oacute;n</span></td>\n<td><span style=\"font-size: 10pt;\">Edad</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Historia</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">&nbsp; Mauricio Perez </span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 232</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 16</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 79</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Nombre del Paciente</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Asegurado</span></td>\n<td><span style=\"font-size: 10pt;\">Sexo</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Consulta</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">&nbsp; Juan Gabirel Perez Mamani</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 765</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; Masculino</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 876</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Orig&eacute;n</span></td>\n<td><span style=\"font-size: 10pt;\">Entidad</span></td>\n<td><span style=\"font-size: 10pt;\">Cliente</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Orden</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 97</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; 45</span></td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<table style=\"width: 861px; height: 176px;\">\n<tbody>\n<tr>\n<td><span style=\"font-size: 10pt;\"><strong>Hormonas</strong></span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Determinaci&oacute;n</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Resultado</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Unidades</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">Valores de Referencia</span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\">!</span></td>\n</tr>\n<tr>\n<td colspan=\"5\">\n<p><strong><span lang=\"ES\" style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)</span></strong></p>\n</td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Prueba R&aacute;pida de Embarazo (hCG Cualitativa)&nbsp; </span></td>\n<td style=\"text-align: center;\"><span style=\"font-size: 10pt;\"><strong>Negativo</strong></span></td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', 2, '2024-03-23 00:09:37', '2024-04-08 17:43:59', '2024-04-08 17:45:27');

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
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_12_235954_create_horarios_table', 1),
(7, '2024_01_13_133806_create_lista_clientes_table', 1),
(8, '2024_01_13_143523_create_lista_citas_table', 1),
(9, '2024_01_13_143548_create_lista_pruebas_table', 1),
(10, '2024_01_13_143659_create_lista_prueba_citas_table', 1),
(11, '2024_01_13_143910_create_lista_historials_table', 1),
(12, '2024_01_13_144004_create_system_infos_table', 1),
(13, '2024_01_13_151329_create_permission_tables', 1),
(14, '2024_01_23_191644_imagen_file', 1),
(15, '2024_02_26_210942_create_form_type_values_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'GestionCitas', 'web', '2024-03-23 04:09:45', '2024-03-23 04:09:45');

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
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(2, 'Bioquimico', 'web', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(3, 'Cliente', 'web', '2024-03-23 04:09:45', '2024-03-23 04:09:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `system_infos`
--

CREATE TABLE `system_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `system_infos`
--

INSERT INTO `system_infos` (`id`, `meta_field`, `meta_value`, `created_at`, `updated_at`) VALUES
(1, 'name', 'Sistema de Laboratorio Clínico', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(2, 'cover', 'uploads/cover-1690914540.png', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(3, 'short_name', 'SIS-LABORATORIO', '2024-03-23 04:09:45', '2024-03-23 05:48:16'),
(4, 'user_avatar', 'uploads/user_avatar.jpg', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(5, 'logo', 'uploads/1706040611.png', '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(10, 'form', '<p>&nbsp;</p>\n<table style=\"width: 864px; text-align: center; height: 112px;\">\n<tbody>\n<tr>\n<td><span style=\"font-size: 10pt;\">Doctor</span></td>\n<td><span style=\"font-size: 10pt;\">F. Petici&oacute;n</span></td>\n<td><span style=\"font-size: 10pt;\">Edad</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Historia</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">&nbsp; #nombreDoctor</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #ePeticion</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #edad</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #nHistoria</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Nombre del Paciente</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Asegurado</span></td>\n<td><span style=\"font-size: 10pt;\">Sexo</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Consulta</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">&nbsp; #paciente</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #asegurado</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #sexo</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #consulta</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\">Orig&eacute;n</span></td>\n<td><span style=\"font-size: 10pt;\">Entidad</span></td>\n<td><span style=\"font-size: 10pt;\">Cliente</span></td>\n<td><span style=\"font-size: 10pt;\">N&deg; Orden</span></td>\n</tr>\n<tr>\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\n<td><span style=\"font-size: 10pt;\"><strong>LABORATORIO PEREZ</strong></span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #cliente</span></td>\n<td><span style=\"font-size: 10pt;\">&nbsp; #nOrden</span></td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>', '2024-03-23 04:09:45', '2024-03-23 04:09:45');

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
  `nombres` varchar(250) NOT NULL,
  `apellido_pa` varchar(250) DEFAULT NULL,
  `apellido_ma` varchar(250) DEFAULT NULL,
  `ci` varchar(250) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `nombres`, `apellido_pa`, `apellido_ma`, `ci`, `avatar`, `last_login`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$brtPrMb81jxd5JMIOHjlZezAHC.HwCp/NmwOYL67pBz5Uwa4Tdl3.', 'Alex', 'Pereira', NULL, '9786757', NULL, NULL, 1, 1, NULL, '2024-03-23 04:09:44', '2024-03-23 04:09:44'),
(2, '9898786', 'Perez@gmail.com', NULL, '$2y$12$ERUaACiVM3SZkbPgVhOcN.oCLNfUFWuQxhEDzoaVRdYlxVBR6BXnG', 'Mauricio', 'Perez', NULL, '9898786', NULL, NULL, 2, 1, NULL, '2024-03-23 04:09:45', '2024-03-23 04:09:45'),
(3, '9999999', 'javier@gmail.com', NULL, '$2y$12$7TxppOuqI4ACMmKFMEWE1.Mn/kA3A5Rat7OohVxFxAvKDTRKyVDvq', 'Javier', 'Tito', 'Gonzales', '9999999', NULL, NULL, 3, 1, NULL, '2024-03-23 04:09:45', '2024-03-23 04:26:39'),
(4, '5555555', 'juan@gmail.com', NULL, '$2y$12$9ulHJyQ4.YJ7N.Owz4ZSi.m7c.0k//5r0Y0TcvHV/YbiuCc9UgTWi', 'Juan Gabirel', 'Santos', 'Mamani', '5555555', NULL, NULL, 2, 1, NULL, '2024-03-23 04:17:55', '2024-03-23 04:24:43'),
(5, '1111111', 'charly@gmail.com', NULL, '$2y$12$LpWZTV8ylNviJrZvYfodQOpiBV1ahqNSAw69PJOzcS9a8dmUpokni', 'Charly', 'Brauw', NULL, '1111111', NULL, NULL, 3, 1, NULL, '2024-03-23 04:29:02', '2024-04-01 17:20:38'),
(6, '0439432', 'alex@gmail.com', NULL, '$2y$12$JJIIxD0ZkyWmE5k8dNMGueU6JQajSz8B1v8vZNNHo/Ck9CiLhOzMK', 'Juan Gabirel', 'Perez', 'Mamani', '0439432', NULL, NULL, 3, 1, NULL, '2024-04-01 20:05:52', '2024-04-01 20:05:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `form_type_values`
--
ALTER TABLE `form_type_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_type_values_test_id_foreign` (`test_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `imagen_files`
--
ALTER TABLE `imagen_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_citas`
--
ALTER TABLE `lista_citas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `lista_citas_hora_id_foreign` (`hora_id`),
  ADD KEY `lista_citas_client_id_foreign` (`client_id`);

--
-- Indices de la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lista_clientes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `lista_historials`
--
ALTER TABLE `lista_historials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lista_historials_appointment_id_foreign` (`appointment_id`);

--
-- Indices de la tabla `lista_pruebas`
--
ALTER TABLE `lista_pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_prueba_citas`
--
ALTER TABLE `lista_prueba_citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lista_prueba_citas_appointment_id_foreign` (`appointment_id`),
  ADD KEY `lista_prueba_citas_test_id_foreign` (`test_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `system_infos`
--
ALTER TABLE `system_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_ci_unique` (`ci`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `form_type_values`
--
ALTER TABLE `form_type_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen_files`
--
ALTER TABLE `imagen_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lista_citas`
--
ALTER TABLE `lista_citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lista_historials`
--
ALTER TABLE `lista_historials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `lista_pruebas`
--
ALTER TABLE `lista_pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lista_prueba_citas`
--
ALTER TABLE `lista_prueba_citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `system_infos`
--
ALTER TABLE `system_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `form_type_values`
--
ALTER TABLE `form_type_values`
  ADD CONSTRAINT `form_type_values_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `lista_pruebas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lista_citas`
--
ALTER TABLE `lista_citas`
  ADD CONSTRAINT `lista_citas_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `lista_clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lista_citas_hora_id_foreign` FOREIGN KEY (`hora_id`) REFERENCES `horarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  ADD CONSTRAINT `lista_clientes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lista_historials`
--
ALTER TABLE `lista_historials`
  ADD CONSTRAINT `lista_historials_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `lista_citas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `lista_prueba_citas`
--
ALTER TABLE `lista_prueba_citas`
  ADD CONSTRAINT `lista_prueba_citas_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `lista_citas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lista_prueba_citas_test_id_foreign` FOREIGN KEY (`test_id`) REFERENCES `lista_pruebas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
