-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-02-2024 a las 03:08:33
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
-- Base de datos: `laboratorio`
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
(1, 'cover1.png', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(2, 'cover2.png', '2024-01-30 17:43:04', '2024-01-30 17:43:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_citas`
--

CREATE TABLE `lista_citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `schedule` datetime NOT NULL,
  `prescription_path` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_citas`
--

INSERT INTO `lista_citas` (`id`, `code`, `schedule`, `prescription_path`, `status`, `client_id`, `created_at`, `updated_at`) VALUES
(1, '202401-0001', '2024-01-13 09:54:00', NULL, 4, 1, '2024-01-30 17:54:22', '2024-02-01 06:07:02'),
(2, '202401-0002', '2024-01-20 09:59:00', NULL, 4, 2, '2024-01-30 17:59:25', '2024-01-31 18:20:54'),
(3, '202401-0003', '2024-01-20 22:31:00', NULL, 4, 3, '2024-02-01 03:31:32', '2024-02-01 05:45:51'),
(4, '202402-0001', '2024-01-20 22:07:00', NULL, 0, 1, '2024-02-01 06:05:13', '2024-02-01 06:05:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_clientes`
--

CREATE TABLE `lista_clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gender` varchar(50) NOT NULL,
  `contact` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `delete_flag` int(11) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_clientes`
--

INSERT INTO `lista_clientes` (`id`, `gender`, `contact`, `dob`, `address`, `delete_flag`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Masculino', '565665566', '1997-06-02', 'Lima', 0, 3, '2024-01-30 17:43:03', '2024-01-30 17:43:03'),
(2, 'Male', '938491211', '2024-01-17', '25 de diciembre', 0, 4, '2024-01-30 17:57:50', '2024-01-30 18:26:33'),
(3, 'Masculino', '98248237', '2005-12-15', 'la vencidad', 0, 6, '2024-02-01 02:50:30', '2024-02-01 02:50:30');

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
(1, 1, 'Sin observaciones', 1, '2024-01-30 17:54:44', '2024-01-30 17:54:44'),
(2, 1, 'Sin observaciones', 2, '2024-01-31 18:11:50', '2024-01-31 18:11:50'),
(3, 1, 'Sin observaciones', 3, '2024-02-01 03:39:46', '2024-02-01 03:39:46'),
(4, 4, 'Prueba finalizada', 3, '2024-02-01 05:45:08', '2024-02-01 05:45:08'),
(5, 4, 'Prueba finalizada', 3, '2024-02-01 05:45:51', '2024-02-01 05:45:51'),
(6, 2, 'Sin observaciones', 1, '2024-02-01 06:05:53', '2024-02-01 06:05:53'),
(7, 4, 'Prueba finalizada', 1, '2024-02-01 06:07:02', '2024-02-01 06:07:02');

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
  `delete_flag` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_pruebas`
--

INSERT INTO `lista_pruebas` (`id`, `name`, `description`, `cost`, `status`, `delete_flag`, `created_at`, `updated_at`) VALUES
(1, 'Covid 19', '<figure class=\"table\"><table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Consulta</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Nombre del pacien</td><td>N° Asegurado</td><td>Sexo</td><td>N° Historia</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Origen</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIOS PEREZ</strong></td><td><strong>LABORATORIOS PEREZ</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 500.00, 1, 0, '2024-01-30 17:53:59', '2024-01-30 17:53:59'),
(2, 'Orina', '<figure class=\"table\"><table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Consulta</td></tr><tr><td>Es el nuevo</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Nombre del pacien</td><td>N° Asegurado</td><td>Sexo</td><td>N° Historia</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Origen</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIOS PEREZ</strong></td><td><strong>LABORATORIOS PEREZ</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 6423.00, 1, 0, '2024-02-01 02:51:18', '2024-02-01 02:51:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_prueba_citas`
--

CREATE TABLE `lista_prueba_citas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `informe` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `lista_prueba_citas`
--

INSERT INTO `lista_prueba_citas` (`id`, `informe`, `descripcion`, `appointment_id`, `test_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'pdfs/202401-0001.pdf', '<p>Listo amigo mio Termindao</p>', 1, 1, 2, '2024-01-30 17:54:22', '2024-02-01 06:07:02'),
(2, 'pdfs/202401-0002.pdf', '<figure class=\"table\"><table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Consulta</td></tr><tr><td>Soy el admin,</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Nombre del pacien</td><td>N° Asegurado</td><td>Sexo</td><td>N° Historia</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Origen</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIOS PEREZ</strong></td><td><strong>LABORATORIOS PEREZ</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure><p>Llenado por el bioquimico</p><p>&nbsp;</p>', 2, 1, 0, '2024-01-30 17:59:25', '2024-01-31 18:20:54'),
(3, 'pdfs/202401-0003.pdf', '<figure class=\"table\"><table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Consulta</td></tr><tr><td>CAmbiado</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Nombre del pacien</td><td>N° Asegurado</td><td>Sexo</td><td>N° Historia</td></tr><tr><td>Ok bamos a ver</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Origen</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIOS PEREZ</strong></td><td><strong>LABORATORIOS PEREZ</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 3, 1, 2, '2024-02-01 03:31:32', '2024-02-01 05:45:08'),
(4, 'pdfs/202401-0003.pdf', '<figure class=\"table\"><table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Consulta</td></tr><tr><td>Es el nuevo</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Nombre del pacien</td><td>N° Asegurado</td><td>Sexo</td><td>N° Historia</td></tr><tr><td>Completo ahora si</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Origen</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIOS PEREZ</strong></td><td><strong>LABORATORIOS PEREZ</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 3, 2, 2, '2024-02-01 03:31:32', '2024-02-01 05:45:51'),
(5, NULL, '<figure class=\"table\"><table><tbody><tr><td>Doctor</td><td>F. Petición</td><td>Edad</td><td>N° Consulta</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Nombre del pacien</td><td>N° Asegurado</td><td>Sexo</td><td>N° Historia</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Origen</td><td>Entidad</td><td>Cliente</td><td>N° Orden</td></tr><tr><td><strong>LABORATORIOS PEREZ</strong></td><td><strong>LABORATORIOS PEREZ</strong></td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>', 4, 1, 0, '2024-02-01 06:05:14', '2024-02-01 06:05:14');

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
(6, '2024_01_13_133806_create_lista_clientes_table', 1),
(7, '2024_01_13_143523_create_lista_citas_table', 1),
(8, '2024_01_13_143548_create_lista_pruebas_table', 1),
(9, '2024_01_13_143659_create_lista_prueba_citas_table', 1),
(10, '2024_01_13_143910_create_lista_historials_table', 1),
(11, '2024_01_13_144004_create_system_infos_table', 1),
(12, '2024_01_13_151329_create_permission_tables', 1),
(13, '2024_01_23_191644_imagen_file', 1);

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
(3, 'App\\Models\\User', 4),
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
(1, 'GestionCitas', 'web', '2024-01-30 17:43:04', '2024-01-30 17:43:04');

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
(1, 'Admin', 'web', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(2, 'Bioquimico', 'web', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(3, 'Cliente', 'web', '2024-01-30 17:43:04', '2024-01-30 17:43:04');

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
(1, 'name', 'Sistema de Laboratorio Clínico', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(2, 'cover', 'uploads/cover-1690914540.png', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(3, 'short_name', 'SIS-LABORATORIO', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(4, 'user_avatar', 'uploads/user_avatar.jpg', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(5, 'logo', 'uploads/1706040611.png', '2024-01-30 17:43:04', '2024-01-30 17:43:04'),
(10, 'form', '<table style=\"border-collapse: collapse; width: 99.9726%; height: 100.125px;\" border=\"1\"><colgroup><col style=\"width: 34.5726%;\"><col style=\"width: 22.6604%;\">\n           <tbody>\n           \n           <tr style=\"height: 18.6625px;\">\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\"><span style=\"font-size: 10pt; font-family: arial, helvetica, sans-serif;\">Doctor</span></td>\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\">F. Petici&oacute;n</td>\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\">Edad</td>\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\">N&deg; Consulta</td>\n           \n           </tr>\n           \n           <tr style=\"height: 10px;\">\n           \n           <td style=\"height: 10px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           <td style=\"height: 10px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           <td style=\"height: 10px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           <td style=\"height: 10px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           </tr>\n           \n           <tr style=\"height: 18.6625px;\">\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\"><span style=\"font-size: 10pt; font-family: arial, helvetica, sans-serif;\">Nombre del pacien\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\">N&deg; Asegurado</td>\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\">Sexo</td>\n           \n           <td style=\"height: 18.6625px; text-align: center; line-height: 1.1;\">N&deg; Historia</td>\n           \n           </tr>\n           \n           <tr style=\"height: 17.6px;\">\n           \n           <td style=\"height: 17.6px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           <td style=\"height: 17.6px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           <td style=\"height: 17.6px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           <td style=\"height: 17.6px; text-align: center; line-height: 1.1;\">&nbsp;</td>\n           \n           </tr>\n           \n           <tr style=\"height: 17.6px;\">\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\">Origen</td>\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\">Entidad</td>\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\">Cliente</td>\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\">N&deg; Orden</td>\n           \n           </tr>\n           \n           <tr style=\"height: 17.6px;\">\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\"><strong>LABORATORIOS PEREZ</strong></td>\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\"><strong>LABORATORIOS PEREZ</strong></td>\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\">&nbsp;</td>\n           \n           <td style=\"text-align: center; line-height: 1.1; height: 17.6px;\">&nbsp;</td>\n           \n           </tr>\n           \n           </tbody>\n           \n           </table>', '2024-01-30 17:43:04', '2024-01-30 17:43:04');

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
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `nombres`, `apellido_pa`, `apellido_ma`, `ci`, `avatar`, `last_login`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$kL.Nj0nOBiY2qUZujDC6Lu8m/lIGW/xq7H7FhT8BBECysezRLKdai', 'Tarea', 'Completo', NULL, '9786757', 'uploads/avatar-1.png?v=1689027780', NULL, 1, 1, NULL, '2024-01-30 17:43:03', '2024-01-30 17:43:03'),
(2, 'Joel', 'joel@gmail.com', NULL, '$2y$12$6E/8EH5Wtj0/Jgu7hMgG1uKiUW0lW5.9TJ10jZjiX/F0nWiib0vnq', 'Joel', 'Perez', 'coquito', '9898786', 'avatars/1706622797.png', NULL, 2, 1, NULL, '2024-01-30 17:43:03', '2024-01-31 18:19:54'),
(3, 'javier', 'javier@gmail.com', NULL, '$2y$12$UgIuZsMXkZHV/60qZzzmju7HRe/w8ceK/L3.kddRpCKvk0yZE1ahi', 'Javier', 'Tito', NULL, '86756544', 'uploads/client-6.png?v=1690995142', NULL, 3, 1, NULL, '2024-01-30 17:43:03', '2024-01-30 17:43:03'),
(4, '9999999', 'noelia@gmail.com', NULL, '$2y$12$1eEY4TkCR/SounWYp.tEnuegidd0DpBYXf7rZirOzYJJ9tWZI9aWS', 'Juan', 'Manrique', 'Tapia', '9999999', 'avatars/1706624301.png', NULL, 3, 1, NULL, '2024-01-30 17:57:49', '2024-01-30 18:18:38'),
(5, '5555555', 'ramo@gmail.com', NULL, '$2y$12$YvrmXmMJ49qbjl9.UP.7ZOL1P5EmHusLGIZakNfxhQQscT60LvwQW', 'Don Damon', 'Ramos', 'Valde', '5555555', NULL, NULL, 2, 1, NULL, '2024-02-01 02:46:21', '2024-02-01 06:06:27'),
(6, 'elChavodel8', 'chavo@gmail.com', NULL, '$2y$12$qP05vN8fhE0WTS/JN8fKEem3vmZRLC8Xf7fnvZ38zV7R2oC728slm', 'Roberto', 'Bolaños', 'Gomez', '9283421', NULL, NULL, 3, 1, NULL, '2024-02-01 02:50:30', '2024-02-01 02:50:30');

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
-- Indices de la tabla `imagen_files`
--
ALTER TABLE `imagen_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lista_citas`
--
ALTER TABLE `lista_citas`
  ADD PRIMARY KEY (`id`),
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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `lista_clientes`
--
ALTER TABLE `lista_clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lista_historials`
--
ALTER TABLE `lista_historials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `lista_pruebas`
--
ALTER TABLE `lista_pruebas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lista_prueba_citas`
--
ALTER TABLE `lista_prueba_citas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Filtros para la tabla `lista_citas`
--
ALTER TABLE `lista_citas`
  ADD CONSTRAINT `lista_citas_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `lista_clientes` (`id`) ON DELETE CASCADE;

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
