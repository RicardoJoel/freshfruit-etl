-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2021 a las 20:07:00
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `precisoo_tmt_intranet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afps`
--

CREATE TABLE `afps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `afps`
--

INSERT INTO `afps` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Habitat', 'HBT', NULL, NULL, NULL),
(2, 'Integra', 'ITG', NULL, NULL, NULL),
(3, 'Prima', 'PRM', NULL, NULL, NULL),
(4, 'Profuturo', 'PFT', NULL, NULL, NULL),
(5, 'ONP', 'ONP', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `banks`
--

INSERT INTO `banks` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Banco de Comercio', 'COM', NULL, NULL, NULL),
(2, 'Banco de Crédito BCP', 'BCP', NULL, NULL, NULL),
(3, 'Banco Interamericano de Finanzas', 'BIF', NULL, NULL, NULL),
(4, 'Banco Pichincha', 'PCH', NULL, NULL, NULL),
(5, 'BBVA', 'BBV', NULL, NULL, NULL),
(6, 'Citibank Perú', 'CIT', NULL, NULL, NULL),
(7, 'Interbank', 'IBK', NULL, NULL, NULL),
(8, 'Mibanco', 'MIB', NULL, NULL, NULL),
(9, 'Scotiabank Perú', 'SCT', NULL, NULL, NULL),
(10, 'Banco GNB Perú', 'GNB', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bussiness`
--

CREATE TABLE `bussiness` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `bussiness`
--

INSERT INTO `bussiness` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Banca, finanzas y aseguradoras', NULL, NULL, NULL),
(2, 'Consumo masivo', NULL, NULL, NULL),
(3, 'Retail', NULL, NULL, NULL),
(4, 'Energía y minas', NULL, NULL, NULL),
(5, 'Consultoría', NULL, NULL, NULL),
(6, 'Automóviles', NULL, NULL, NULL),
(7, 'Publicidad y marketing', NULL, NULL, NULL),
(8, 'Sector público', NULL, NULL, NULL),
(9, 'Coaching', NULL, NULL, NULL),
(10, 'Proyectos propios', NULL, NULL, NULL),
(11, 'Agroexportación', NULL, NULL, NULL),
(12, 'Contenidos', NULL, NULL, NULL),
(13, 'Immobiliaria', NULL, NULL, NULL),
(14, 'Educación', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `commissions`
--

INSERT INTO `commissions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Comisión sobre el sueldo', NULL, NULL, NULL),
(2, 'Comisión mixta', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_type_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date DEFAULT NULL,
  `position` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_types`
--

CREATE TABLE `contact_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Principal', NULL, NULL, NULL),
(2, 'Cobranza', NULL, NULL, NULL),
(3, 'Comercial', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mob_pattern` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `mob_pattern`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Afganistán', '+93', '', NULL, NULL, NULL),
(2, 'Albania', '+355', '', NULL, NULL, NULL),
(3, 'Alemania', '+49', '', NULL, NULL, NULL),
(4, 'Andorra', '+376', '', NULL, NULL, NULL),
(5, 'Angola', '+244', '', NULL, NULL, NULL),
(6, 'Anguila', '+1264', '', NULL, NULL, NULL),
(7, 'Antigua y Barbuda', '+1268', '', NULL, NULL, NULL),
(8, 'Antillas Neerlandesas', '+599', '', NULL, NULL, NULL),
(9, 'Arabia Saudita', '+966', '', NULL, NULL, NULL),
(10, 'Argelia', '+213', '', NULL, NULL, NULL),
(11, 'Argentina', '+54', '', NULL, NULL, NULL),
(12, 'Armenia', '+374', '', NULL, NULL, NULL),
(13, 'Aruba', '+297', '', NULL, NULL, NULL),
(14, 'Australia', '+61', '', NULL, NULL, NULL),
(15, 'Austria', '+43', '', NULL, NULL, NULL),
(16, 'Autoridad Palestina', '+970', '', NULL, NULL, NULL),
(17, 'Azerbaiyán', '+994', '', NULL, NULL, NULL),
(18, 'Bahamas', '+1242', '', NULL, NULL, NULL),
(19, 'Bahrain', '+973', '', NULL, NULL, NULL),
(20, 'Bangladesh', '+880', '', NULL, NULL, NULL),
(21, 'Barbados', '+1246', '', NULL, NULL, NULL),
(22, 'Belarus', '+375', '', NULL, NULL, NULL),
(23, 'Bélgica', '+32', '', NULL, NULL, NULL),
(24, 'Belice', '+501', '', NULL, NULL, NULL),
(25, 'Benín', '+229', '', NULL, NULL, NULL),
(26, 'Bermuda', '+1441', '', NULL, NULL, NULL),
(27, 'Bolivia', '+591', '', NULL, NULL, NULL),
(28, 'Bosnia/Herzegovina', '+387', '', NULL, NULL, NULL),
(29, 'Botsuana', '+267', '', NULL, NULL, NULL),
(30, 'Brasil', '+55', '', NULL, NULL, NULL),
(31, 'Brunéi', '+673', '', NULL, NULL, NULL),
(32, 'Bulgaria', '+359', '', NULL, NULL, NULL),
(33, 'Burkina Faso', '+226', '', NULL, NULL, NULL),
(34, 'Burundi', '+257', '', NULL, NULL, NULL),
(35, 'Bután', '+975', '', NULL, NULL, NULL),
(36, 'Camboya', '+855', '', NULL, NULL, NULL),
(37, 'Camerún', '+237', '', NULL, NULL, NULL),
(38, 'Chad', '+235', '', NULL, NULL, NULL),
(39, 'Chile', '+56', '', NULL, NULL, NULL),
(40, 'China', '+86', '', NULL, NULL, NULL),
(41, 'Chipre', '+357', '', NULL, NULL, NULL),
(42, 'Colombia', '+57', '', NULL, NULL, NULL),
(43, 'Comoras', '+269', '', NULL, NULL, NULL),
(44, 'Congo (República Democrática)', '+243', '', NULL, NULL, NULL),
(45, 'Congo (República)', '+242', '', NULL, NULL, NULL),
(46, 'Corea (Norte)', '+850', '', NULL, NULL, NULL),
(47, 'Corea (Sur)', '+82', '', NULL, NULL, NULL),
(48, 'Costa de Marfil', '+225', '', NULL, NULL, NULL),
(49, 'Costa Rica', '+506', '', NULL, NULL, NULL),
(50, 'Croacia', '+385', '', NULL, NULL, NULL),
(51, 'Cuba', '+53', '', NULL, NULL, NULL),
(52, 'Diego García', '+246', '', NULL, NULL, NULL),
(53, 'Dinamarca', '+45', '', NULL, NULL, NULL),
(54, 'Dominica', '+1767', '', NULL, NULL, NULL),
(55, 'Ecuador', '+593', '', NULL, NULL, NULL),
(56, 'Egipto', '+20', '', NULL, NULL, NULL),
(57, 'El Salvador', '+503', '', NULL, NULL, NULL),
(58, 'Emiratos Árabes Unidos', '+971', '', NULL, NULL, NULL),
(59, 'Eritrea', '+291', '', NULL, NULL, NULL),
(60, 'Eslovaquia', '+421', '', NULL, NULL, NULL),
(61, 'Eslovenia', '+386', '', NULL, NULL, NULL),
(62, 'España', '+34', '', NULL, NULL, NULL),
(63, 'Estonia', '+372', '', NULL, NULL, NULL),
(64, 'Etiopía', '+251', '', NULL, NULL, NULL),
(65, 'Filipinas', '+63', '', NULL, NULL, NULL),
(66, 'Finlandia', '+358', '', NULL, NULL, NULL),
(67, 'Fiyi', '+679', '', NULL, NULL, NULL),
(68, 'Francia', '+33', '', NULL, NULL, NULL),
(69, 'Gabón', '+241', '', NULL, NULL, NULL),
(70, 'Gambia', '+220', '', NULL, NULL, NULL),
(71, 'Georgia', '+995', '', NULL, NULL, NULL),
(72, 'Ghana', '+233', '', NULL, NULL, NULL),
(73, 'Gibraltar', '+350', '', NULL, NULL, NULL),
(74, 'Granada', '+1473', '', NULL, NULL, NULL),
(75, 'Grecia', '+30', '', NULL, NULL, NULL),
(76, 'Groenlandia', '+299', '', NULL, NULL, NULL),
(77, 'Guadalupe (Antillas Francesas)', '+590', '', NULL, NULL, NULL),
(78, 'Guatemala', '+502', '', NULL, NULL, NULL),
(79, 'Guernsey', '+44', '', NULL, NULL, NULL),
(80, 'Guinea', '+224', '', NULL, NULL, NULL),
(81, 'Guinea Ecuatorial', '+240', '', NULL, NULL, NULL),
(82, 'Guinea-Bisáu', '+245', '', NULL, NULL, NULL),
(83, 'Guyana', '+592', '', NULL, NULL, NULL),
(84, 'Guyana Francesa', '+594', '', NULL, NULL, NULL),
(85, 'Haití', '+509', '', NULL, NULL, NULL),
(86, 'Holanda', '+31', '', NULL, NULL, NULL),
(87, 'Honduras', '+504', '', NULL, NULL, NULL),
(88, 'Hong Kong', '+852', '', NULL, NULL, NULL),
(89, 'Hungría', '+36', '', NULL, NULL, NULL),
(90, 'India', '+91', '', NULL, NULL, NULL),
(91, 'Indonesia', '+62', '', NULL, NULL, NULL),
(92, 'Irán', '+98', '', NULL, NULL, NULL),
(93, 'Iraq', '+964', '', NULL, NULL, NULL),
(94, 'Irlanda', '+353', '', NULL, NULL, NULL),
(95, 'Isla de Man', '+44', '', NULL, NULL, NULL),
(96, 'Isla de San Martín', '+1721', '', NULL, NULL, NULL),
(97, 'Islandia', '+354', '', NULL, NULL, NULL),
(98, 'Islas Caimán', '+1345', '', NULL, NULL, NULL),
(99, 'Islas Cook', '+682', '', NULL, NULL, NULL),
(100, 'Islas de Cabo Verde', '+238', '', NULL, NULL, NULL),
(101, 'Islas Feroe', '+298', '', NULL, NULL, NULL),
(102, 'Islas Malvinas', '+500', '', NULL, NULL, NULL),
(103, 'Islas Marianas del Norte', '+1670', '', NULL, NULL, NULL),
(104, 'Islas Marshall', '+692', '', NULL, NULL, NULL),
(105, 'Islas Mauricio', '+230', '', NULL, NULL, NULL),
(106, 'Islas Salomón', '+677', '', NULL, NULL, NULL),
(107, 'Islas Turcas y Caicos', '+1649', '', NULL, NULL, NULL),
(108, 'Islas Vírgenes Británicas', '+1284', '', NULL, NULL, NULL),
(109, 'Israel', '+972', '', NULL, NULL, NULL),
(110, 'Italia', '+39', '', NULL, NULL, NULL),
(111, 'Jamaica', '+1876', '', NULL, NULL, NULL),
(112, 'Japón', '+81', '', NULL, NULL, NULL),
(113, 'Jersey', '+44', '', NULL, NULL, NULL),
(114, 'Jordania', '+962', '', NULL, NULL, NULL),
(115, 'Kazajistán', '+7', '', NULL, NULL, NULL),
(116, 'Kenia', '+254', '', NULL, NULL, NULL),
(117, 'Kirguizistán', '+996', '', NULL, NULL, NULL),
(118, 'Kiribati', '+686', '', NULL, NULL, NULL),
(119, 'Kuwait', '+965', '', NULL, NULL, NULL),
(120, 'Laos', '+856', '', NULL, NULL, NULL),
(121, 'Lesoto', '+266', '', NULL, NULL, NULL),
(122, 'Letonia', '+371', '', NULL, NULL, NULL),
(123, 'Líbano', '+961', '', NULL, NULL, NULL),
(124, 'Liberia', '+231', '', NULL, NULL, NULL),
(125, 'Libia', '+218', '', NULL, NULL, NULL),
(126, 'Liechtenstein', '+423', '', NULL, NULL, NULL),
(127, 'Lituania', '+370', '', NULL, NULL, NULL),
(128, 'Luxemburgo', '+352', '', NULL, NULL, NULL),
(129, 'Macau', '+853', '', NULL, NULL, NULL),
(130, 'Macedonia', '+389', '', NULL, NULL, NULL),
(131, 'Madagascar', '+261', '', NULL, NULL, NULL),
(132, 'Malasia', '+60', '', NULL, NULL, NULL),
(133, 'Malaui', '+265', '', NULL, NULL, NULL),
(134, 'Maldivas', '+960', '', NULL, NULL, NULL),
(135, 'Malí', '+223', '', NULL, NULL, NULL),
(136, 'Malta', '+356', '', NULL, NULL, NULL),
(137, 'Marruecos', '+212', '', NULL, NULL, NULL),
(138, 'Martinica', '+596', '', NULL, NULL, NULL),
(139, 'Mauritania', '+222', '', NULL, NULL, NULL),
(140, 'México', '+52', '', NULL, NULL, NULL),
(141, 'Micronesia', '+691', '', NULL, NULL, NULL),
(142, 'Moldova', '+373', '', NULL, NULL, NULL),
(143, 'Mónaco', '+377', '', NULL, NULL, NULL),
(144, 'Mongolia', '+976', '', NULL, NULL, NULL),
(145, 'Montenegro', '+382', '', NULL, NULL, NULL),
(146, 'Montserrat', '+1664', '', NULL, NULL, NULL),
(147, 'Mozambique', '+258', '', NULL, NULL, NULL),
(148, 'Myanmar (Birmania)', '+95', '', NULL, NULL, NULL),
(149, 'Namibia', '+264', '', NULL, NULL, NULL),
(150, 'Nauru', '+674', '', NULL, NULL, NULL),
(151, 'Nepal', '+977', '', NULL, NULL, NULL),
(152, 'Nicaragua', '+505', '', NULL, NULL, NULL),
(153, 'Níger', '+227', '', NULL, NULL, NULL),
(154, 'Nigeria', '+234', '', NULL, NULL, NULL),
(155, 'Noruega', '+47', '', NULL, NULL, NULL),
(156, 'Nueva Caledonia', '+687', '', NULL, NULL, NULL),
(157, 'Nueva Zelanda', '+64', '', NULL, NULL, NULL),
(158, 'Omán', '+968', '', NULL, NULL, NULL),
(159, 'Pakistán', '+92', '', NULL, NULL, NULL),
(160, 'Palaos', '+680', '', NULL, NULL, NULL),
(161, 'Panamá', '+507', '', NULL, NULL, NULL),
(162, 'Papúa Nueva Guinea', '+675', '', NULL, NULL, NULL),
(163, 'Paraguay', '+595', '', NULL, NULL, NULL),
(164, 'Perú', '+51', '', NULL, NULL, NULL),
(165, 'Polonia', '+48', '', NULL, NULL, NULL),
(166, 'Portugal', '+351', '', NULL, NULL, NULL),
(167, 'Qatar', '+974', '', NULL, NULL, NULL),
(168, 'Reino Unido', '+44', '', NULL, NULL, NULL),
(169, 'República Centroafricana', '+236', '', NULL, NULL, NULL),
(170, 'República Checa', '+420', '', NULL, NULL, NULL),
(171, 'República Dominicana', '+1', '', NULL, NULL, NULL),
(172, 'Reunión', '+262', '', NULL, NULL, NULL),
(173, 'Ruanda', '+250', '', NULL, NULL, NULL),
(174, 'Rumania', '+40', '', NULL, NULL, NULL),
(175, 'Rusia', '+7', '', NULL, NULL, NULL),
(176, 'Saipán (Islas Marianas del Norte)', '+1670', '', NULL, NULL, NULL),
(177, 'Samoa', '+685', '', NULL, NULL, NULL),
(178, 'Samoa Americana', '+1684', '', NULL, NULL, NULL),
(179, 'San Cristóbal/Nieves', '+1869', '', NULL, NULL, NULL),
(180, 'San Marino', '+378', '', NULL, NULL, NULL),
(181, 'San Pedro/Miquelón', '+508', '', NULL, NULL, NULL),
(182, 'San Vicente/Granadinas', '+1784', '', NULL, NULL, NULL),
(183, 'Santa Lucía', '+1758', '', NULL, NULL, NULL),
(184, 'Santo Tomé/Príncipe', '+239', '', NULL, NULL, NULL),
(185, 'Senegal', '+221', '', NULL, NULL, NULL),
(186, 'Serbia', '+381', '', NULL, NULL, NULL),
(187, 'Seychelles', '+248', '', NULL, NULL, NULL),
(188, 'Sierra Leona', '+232', '', NULL, NULL, NULL),
(189, 'Singapur', '+65', '', NULL, NULL, NULL),
(190, 'Siria', '+963', '', NULL, NULL, NULL),
(191, 'Sri Lanka', '+94', '', NULL, NULL, NULL),
(192, 'Suazilandia', '+268', '', NULL, NULL, NULL),
(193, 'Sudáfrica', '+27', '', NULL, NULL, NULL),
(194, 'Sudán', '+249', '', NULL, NULL, NULL),
(195, 'Sudán Meridional', '+211', '', NULL, NULL, NULL),
(196, 'Suecia', '+46', '', NULL, NULL, NULL),
(197, 'Suiza', '+41', '', NULL, NULL, NULL),
(198, 'Suriname', '+597', '', NULL, NULL, NULL),
(199, 'Tailandia', '+66', '', NULL, NULL, NULL),
(200, 'Taiwán', '+886', '', NULL, NULL, NULL),
(201, 'Tanzania', '+255', '', NULL, NULL, NULL),
(202, 'Tayikistán', '+992', '', NULL, NULL, NULL),
(203, 'Territorio australiano', '+672', '', NULL, NULL, NULL),
(204, 'Togo', '+228', '', NULL, NULL, NULL),
(205, 'Tokelau', '+690', '', NULL, NULL, NULL),
(206, 'Tonga', '+676', '', NULL, NULL, NULL),
(207, 'Trinidad y Tobago', '+1868', '', NULL, NULL, NULL),
(208, 'Túnez', '+216', '', NULL, NULL, NULL),
(209, 'Turkmenistán', '+993', '', NULL, NULL, NULL),
(210, 'Turquía', '+90', '', NULL, NULL, NULL),
(211, 'Tuvalu', '+688', '', NULL, NULL, NULL),
(212, 'Ucrania', '+380', '', NULL, NULL, NULL),
(213, 'Uganda', '+256', '', NULL, NULL, NULL),
(214, 'Uruguay', '+598', '', NULL, NULL, NULL),
(215, 'Uzbekistán', '+998', '', NULL, NULL, NULL),
(216, 'Vanuatu', '+678', '', NULL, NULL, NULL),
(217, 'Venezuela', '+58', '', NULL, NULL, NULL),
(218, 'Vietnam', '+84', '', NULL, NULL, NULL),
(219, 'Yemen', '+967', '', NULL, NULL, NULL),
(220, 'Yibuti', '+253', '', NULL, NULL, NULL),
(221, 'Zambia', '+260', '', NULL, NULL, NULL),
(222, 'Zimbabue', '+263', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Soles', 'PEN', NULL, NULL, NULL),
(2, 'Dólares', 'USD', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `business_id`, `district_id`, `ruc`, `name`, `alias`, `address`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 1160, '99999999999', 'Genérico', 'GENERICO', 'N/A', 'GEN', '2021-09-14 08:40:06', '2021-09-14 08:40:06', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gerencia de Asesoría Legal', '001', NULL, NULL, NULL),
(2, 'Oficina de Recursos Humanos', '002', NULL, NULL, NULL),
(3, 'Subgerencia de Proyectos', '003', NULL, NULL, NULL),
(4, 'Gerencia de Administración, Finanzas y Sistemas', '004', NULL, NULL, NULL),
(5, 'Oficina de Sistemas', '005', NULL, NULL, NULL),
(6, 'Gerencia General', '006', NULL, NULL, NULL),
(7, 'Imagen Institucional', '007', NULL, NULL, NULL),
(8, 'Gerencia de Estudios y Proyectos', '008', NULL, NULL, NULL),
(9, 'Oficina de Contabilidad', '009', NULL, NULL, NULL),
(10, 'Gerencia de Planeamiento y Presupuesto', '010', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependents`
--

CREATE TABLE `dependents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dependent_type_id` bigint(20) UNSIGNED NOT NULL,
  `document_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependent_types`
--

CREATE TABLE `dependent_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dependent_types`
--

INSERT INTO `dependent_types` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cónyugue', 'CNY', NULL, NULL, NULL),
(2, 'Hijo(a) menor de edad', 'HME', NULL, NULL, NULL),
(3, 'Hijo(a) cursando estudios superiores', 'HUI', NULL, NULL, NULL),
(4, 'Conviviente', 'CON', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `districts`
--

INSERT INTO `districts` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Lima', NULL, NULL, NULL),
(2, 'Ancon', NULL, NULL, NULL),
(3, 'Ate', NULL, NULL, NULL),
(4, 'Barranco', NULL, NULL, NULL),
(5, 'Breña', NULL, NULL, NULL),
(6, 'Carabayllo', NULL, NULL, NULL),
(7, 'Chaclacayo', NULL, NULL, NULL),
(8, 'Chorrillos', NULL, NULL, NULL),
(9, 'Cieneguilla', NULL, NULL, NULL),
(10, 'Comas', NULL, NULL, NULL),
(11, 'El Agustino', NULL, NULL, NULL),
(12, 'Independencia', NULL, NULL, NULL),
(13, 'Jesus Maria', NULL, NULL, NULL),
(14, 'La Molina', NULL, NULL, NULL),
(15, 'La Victoria', NULL, NULL, NULL),
(16, 'Lince', NULL, NULL, NULL),
(17, 'Los Olivos', NULL, NULL, NULL),
(18, 'Lurigancho', NULL, NULL, NULL),
(19, 'Lurin', NULL, NULL, NULL),
(20, 'Magdalena del Mar', NULL, NULL, NULL),
(21, 'Pueblo Libre', NULL, NULL, NULL),
(22, 'Miraflores', NULL, NULL, NULL),
(23, 'Pachacamac', NULL, NULL, NULL),
(24, 'Pucusana', NULL, NULL, NULL),
(25, 'Puente Piedra', NULL, NULL, NULL),
(26, 'Punta Hermosa', NULL, NULL, NULL),
(27, 'Punta Negra', NULL, NULL, NULL),
(28, 'Rimac', NULL, NULL, NULL),
(29, 'San Bartolo', NULL, NULL, NULL),
(30, 'San Borja', NULL, NULL, NULL),
(31, 'San Isidro', NULL, NULL, NULL),
(32, 'San Juan de Lurigancho', NULL, NULL, NULL),
(33, 'San Juan de Miraflores', NULL, NULL, NULL),
(34, 'San Luis', NULL, NULL, NULL),
(35, 'San Martin de Porres', NULL, NULL, NULL),
(36, 'San Miguel', NULL, NULL, NULL),
(37, 'Santa Anita', NULL, NULL, NULL),
(38, 'Santa Maria del Mar', NULL, NULL, NULL),
(39, 'Santa Rosa', NULL, NULL, NULL),
(40, 'Santiago de Surco', NULL, NULL, NULL),
(41, 'Surquillo', NULL, NULL, NULL),
(42, 'Villa El Salvador', NULL, NULL, NULL),
(43, 'Villa Maria del Triunfo', NULL, NULL, NULL),
(44, 'Callao', NULL, NULL, NULL),
(45, 'Bellavista', NULL, NULL, NULL),
(46, 'Carmen de La Legua-Reynoso', NULL, NULL, NULL),
(47, 'La Perla', NULL, NULL, NULL),
(48, 'La Punta', NULL, NULL, NULL),
(49, 'Ventanilla', NULL, NULL, NULL),
(50, 'Mi Perú', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `length` int(11) NOT NULL,
  `is_number` tinyint(1) NOT NULL,
  `is_exact` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `document_types`
--

INSERT INTO `document_types` (`id`, `name`, `code`, `length`, `is_number`, `is_exact`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Doc. Nacional de Identidad', '01', 8, 1, 1, NULL, NULL, NULL),
(2, 'Carnet de extranjería', '04', 12, 0, 0, NULL, NULL, NULL),
(3, 'Reg. Único de Contribuyente', '06', 11, 1, 1, NULL, NULL, NULL),
(4, 'Pasaporte', '07', 12, 0, 0, NULL, NULL, NULL),
(5, 'Partida de nacimiento-identidad', '11', 15, 0, 0, NULL, NULL, '2021-05-11 23:00:00'),
(6, 'Otros', '99', 15, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `detail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourly_rate` double(8,2) UNSIGNED NOT NULL,
  `num_hours` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epss`
--

CREATE TABLE `epss` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `epss`
--

INSERT INTO `epss` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Básico', 'ABA', NULL, NULL, NULL),
(2, 'Adicional 1', 'AD1', NULL, NULL, NULL),
(3, 'Adicional 2', 'AD2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exchange_rates`
--

CREATE TABLE `exchange_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `value` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `date`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2021-06-16', 3.91, NULL, NULL, NULL),
(2, '2021-06-17', 3.89, NULL, NULL, NULL),
(3, '2021-06-18', 3.90, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `freelancers`
--

CREATE TABLE `freelancers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `document_type_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cci` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frequencies`
--

CREATE TABLE `frequencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `frequencies`
--

INSERT INTO `frequencies` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mensual', '001', NULL, NULL, NULL),
(2, 'Trimestral', '003', NULL, NULL, NULL),
(3, 'Semestral', '006', NULL, NULL, NULL),
(4, 'Anual', '012', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

CREATE TABLE `genders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Femenino', 'FEM', NULL, NULL, NULL),
(2, 'Masculino', 'MAS', NULL, NULL, NULL),
(3, 'Otros', 'OTR', NULL, NULL, NULL),
(4, 'Transgénero', 'BTR', NULL, NULL, '2021-03-03 22:00:00'),
(5, 'Intersexual', 'INT', NULL, NULL, '2021-03-03 22:00:00'),
(6, 'Sin especificar', 'SES', NULL, NULL, '2021-05-11 23:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `independents`
--

CREATE TABLE `independents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `exchange_rate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `detail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_08_20_170339_create_project_types_table', 1),
(5, '2020_08_20_172143_create_businesses_table', 1),
(6, '2020_08_20_172624_create_customers_table', 1),
(7, '2020_08_20_175204_create_projects_table', 1),
(8, '2020_08_20_190956_create_activities_table', 1),
(9, '2014_10_11_000000_create_roles_table', 2),
(10, '2020_08_20_190957_create_breakdowns_table', 2),
(11, '2021_01_12_172143_create_parameters_table', 2),
(12, '2021_01_13_172143_create_ubigeos_table', 3),
(13, '2021_01_13_170339_create_contact_types_table', 4),
(15, '2021_01_13_172143_create_districts_table', 6),
(16, '2021_01_13_170339_create_contacts_table', 7),
(18, '2020_08_20_170339_create_document_types_table', 8),
(20, '2021_01_13_170339_create_banks_table', 9),
(21, '2021_01_13_170339_create_relationships_table', 10),
(29, '2021_01_13_170339_create_profiles_table', 11),
(30, '2021_01_13_170339_create_dependent_types_table', 12),
(31, '2021_01_13_170339_create_dependents_table', 12),
(34, '2021_01_13_170339_create_epss_table', 14),
(35, '2021_01_13_172143_create_countries_table', 15),
(36, '2021_01_13_172143_create_genders_table', 16),
(37, '2021_01_13_170339_create_afps_table', 17),
(38, '2021_01_13_170339_create_commissions_table', 17),
(39, '2021_01_13_172143_create_frequencies_table', 18),
(41, '2021_05_13_170339_create_variations_table', 19),
(44, '2021_05_19_175204_create_visits_table', 20),
(54, '2021_05_25_175204_create_proposals_table', 25),
(67, '2021_06_15_172624_create_suppliers_table', 27),
(68, '2021_06_16_172624_create_freelancers_table', 27),
(69, '2021_01_13_170339_create_exchange_rates_table', 28),
(72, '2021_06_22_170339_create_employees_table', 29),
(73, '2021_06_22_170339_create_providers_table', 29),
(74, '2021_06_22_170339_create_sellers_table', 30),
(75, '2021_05_23_170339_create_currencies_table', 31),
(76, '2021_05_23_170339_create_modes_table', 32),
(77, '2021_05_23_170339_create_types_table', 32),
(79, '2021_06_22_170339_create_independents_table', 33),
(80, '2021_09_01_000000_create_project_user_table', 34),
(83, '2021_09_04_000000_create_tasks_table', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modes`
--

CREATE TABLE `modes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `modes`
--

INSERT INTO `modes` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '100% al finalizar', 'PM1', NULL, NULL, NULL),
(2, '40% 60%', 'PM2', NULL, NULL, NULL),
(3, '30% 30% 40%', 'PM3', NULL, NULL, NULL),
(4, '60% 40%', 'PM4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parameters`
--

CREATE TABLE `parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `description`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'DATES', 'Cantidad de días, desde la fecha actual hacia atrás, en los que el usuario puede ingresar, editar y eliminar actividades en la hoja de tiempo.', 1, NULL, '2021-09-17 12:30:13', NULL),
(2, 'MAXSAL', 'Monto máximo permitido para un salario.', 10000, NULL, NULL, NULL),
(3, 'MONTHS', 'Cantidad de meses mínima permitida para un cambio de sueldo.\r\n', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `code`, `type`, `salary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Analista de proyectos', 'P01', 'C', 9000, NULL, NULL, NULL),
(2, 'Asistente de proyectos', 'P02', 'C', 6500, NULL, NULL, NULL),
(3, 'Camarógrafo', 'P03', 'C', 4500, NULL, NULL, NULL),
(4, 'Corrector de estilo Junior', 'P04', 'C', 4500, NULL, NULL, NULL),
(5, 'Corrector de estilo Senior', 'P05', 'C', 8000, NULL, NULL, NULL),
(6, 'Diagramador', 'P06', 'C', 4500, NULL, NULL, NULL),
(7, 'Director comercial', 'P07', 'C', 18000, NULL, NULL, NULL),
(8, 'Director de planeamiento estratégico', 'P08', 'C', 25000, NULL, NULL, NULL),
(9, 'Director de proyectos', 'P09', 'C', 15000, NULL, NULL, NULL),
(10, 'Diseñador gráfico Junior', 'P10', 'C', 4500, NULL, NULL, NULL),
(11, 'Diseñador gráfico Senior', 'P11', 'C', 8000, NULL, NULL, NULL),
(12, 'Editor de fotografía', 'P12', 'C', 10000, NULL, NULL, NULL),
(13, 'Editor de publicaciones', 'P13', 'C', 15000, NULL, NULL, NULL),
(14, 'Editor de video', 'P14', 'C', 6500, NULL, NULL, NULL),
(15, 'Editor general', 'P15', 'C', 18000, NULL, NULL, NULL),
(16, 'Editor web', 'P16', 'C', 12000, NULL, NULL, NULL),
(17, 'Ejecutiva de cuentas Junior', 'P17', 'C', 4500, NULL, NULL, NULL),
(18, 'Ejecutiva de cuentas Senior', 'P18', 'C', 8000, NULL, NULL, NULL),
(19, 'Fotógrafo', 'P19', 'C', 8000, NULL, NULL, NULL),
(20, 'Ilustrador', 'P20', 'C', 6000, NULL, NULL, NULL),
(21, 'Infografista', 'P21', 'C', 6000, NULL, NULL, NULL),
(22, 'Jefe de diseño', 'P22', 'C', 12000, NULL, NULL, NULL),
(23, 'Practicante', 'P23', 'C', 930, NULL, NULL, NULL),
(24, 'Programador Junior', 'P24', 'C', 4500, NULL, NULL, NULL),
(25, 'Programador Senior', 'P25', 'C', 8000, NULL, NULL, NULL),
(26, 'Publicista Junior', 'P26', 'C', 4500, NULL, NULL, NULL),
(27, 'Redactor Junior', 'P27', 'C', 4500, NULL, NULL, NULL),
(28, 'Redactor Senior', 'P28', 'C', 8000, NULL, NULL, NULL),
(29, 'Redactor web Junior', 'P29', 'C', 4500, NULL, NULL, NULL),
(30, 'Redactor web Senior', 'P30', 'C', 8000, NULL, NULL, NULL),
(31, 'Analista de proyectos dos', 'P31', 'I', 4900, NULL, NULL, NULL),
(32, 'Coordinador de imagen', 'P32', 'I', 4900, NULL, NULL, NULL),
(33, 'Desarrollador uno', 'P33', 'I', 5200, NULL, NULL, NULL),
(34, 'Desarrollador dos', 'P34', 'I', 5200, NULL, NULL, NULL),
(35, 'Desarrollador tres', 'P35', 'I', 7100, NULL, NULL, NULL),
(36, 'Diagramador externo', 'P36', 'I', 3900, NULL, NULL, NULL),
(37, 'Digitador Junior', 'P37', 'I', 5000, NULL, NULL, NULL),
(38, 'Digitador Senior', 'P38', 'I', 5000, NULL, NULL, NULL),
(39, 'Encuadernador', 'P39', 'I', 6230, NULL, NULL, NULL),
(40, 'Especialista Junior', 'P40', 'I', 4900, NULL, NULL, NULL),
(41, 'Fotógrafo externo', 'P41', 'I', 5050, NULL, NULL, NULL),
(42, 'Ingeniero de audio', 'P42', 'I', 4680, NULL, NULL, NULL),
(43, 'Ingeniero de fotografía', 'P43', 'I', 5000, NULL, NULL, NULL),
(44, 'Electricista', 'P44', 'P', 3000, NULL, NULL, NULL),
(45, 'Gasfitero', 'P45', 'P', 2800, NULL, NULL, NULL),
(46, 'Limpieza', 'P46', 'P', 1100, NULL, NULL, NULL),
(47, 'Repartidor', 'P47', 'P', 1000, NULL, NULL, NULL),
(48, 'Seguridad', 'P48', 'P', 2000, NULL, NULL, NULL),
(49, 'Otros', 'P49', 'X', 0, NULL, NULL, NULL),
(50, 'Analista de sistemas', 'P50', 'T', 0, NULL, NULL, NULL),
(51, 'Asistente de gerencia general', 'P51', 'T', 0, NULL, NULL, NULL),
(52, 'Asistente administrativo', 'P52', 'T', 0, NULL, NULL, NULL),
(53, 'Asistente de imagen institucional', 'P53', 'T', 0, NULL, NULL, NULL),
(54, 'Asistente legal', 'P54', 'T', 0, NULL, NULL, NULL),
(55, 'Especialista de estudios de tráfico y modelamiento', 'P55', 'T', 0, NULL, NULL, NULL),
(56, 'Especialista en contrataciones del Estado y control patrimonial', 'P56', 'T', 0, NULL, NULL, NULL),
(57, 'Especialista en planillas', 'P57', 'T', 0, NULL, NULL, NULL),
(58, 'Especialista en tesorería y finanzas', 'P58', 'T', 0, NULL, NULL, NULL),
(59, 'Especialista legal', 'P59', 'T', 0, NULL, NULL, NULL),
(60, 'Especialista en elaboración de estudios de tránsito y transportes', 'P60', 'T', 0, NULL, NULL, NULL),
(61, 'Especialista en elaboración y ejecución de proyectos viales', 'P61', 'T', 0, NULL, NULL, NULL),
(62, 'Formuladora de proyectos', 'P62', 'T', 0, NULL, NULL, NULL),
(63, 'Gerente de administración, finanzas y sistemas', 'P63', 'T', 0, NULL, NULL, NULL),
(64, 'Gerente de asesoría legal', 'P64', 'T', 0, NULL, NULL, NULL),
(65, 'Gerente de estudios y proyectos', 'P65', 'T', 0, NULL, NULL, NULL),
(66, 'Gerente general', 'P66', 'T', 0, NULL, NULL, NULL),
(67, 'Jefe de contabilidad', 'P67', 'T', 0, NULL, NULL, NULL),
(68, 'Jefe de recursos humanos', 'P68', 'T', 0, NULL, NULL, NULL),
(69, 'Jefe de sistemas', 'P69', 'T', 0, NULL, NULL, NULL),
(70, 'Responsable de archivos', 'P70', 'T', 0, NULL, NULL, NULL),
(71, 'Subgerente de proyectos', 'P71', 'T', 0, NULL, NULL, NULL),
(72, 'Trabajadora social', 'P72', 'T', 0, NULL, NULL, NULL),
(73, 'Responsable de imagen institucional', 'P73', 'T', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_type_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proposal_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `happen_at` date DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `project_type_id`, `customer_id`, `user_id`, `proposal_id`, `code`, `name`, `happen_at`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, NULL, NULL, NULL, 'OTR000000000TEM', 'Otros temas', NULL, 'O', NULL, NULL, NULL),
(2, 4, NULL, NULL, NULL, 'OTR000000000VAC', 'Vacaciones', NULL, 'O', NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL, 'OTR000000000PER', 'Permiso', NULL, 'O', NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL, 'OTR000000000ALM', 'Almuerzo', NULL, 'O', NULL, NULL, NULL),
(5, 4, 1, 4, NULL, 'OTRGEN140921001', 'Actividades de secretaría', '2021-09-14', 'O', '2021-09-14 08:50:23', '2021-09-16 19:27:41', NULL),
(6, 4, 1, 25, NULL, 'OTRGEN140921002', 'TUMI - Promoción de recuperación del espacio público del uso del transporte no motorizado', '2021-09-14', 'O', '2021-09-14 09:35:04', '2021-09-16 22:15:18', NULL),
(7, 4, 1, 8, NULL, 'OTRGEN140921003', 'Programa de biciescuela', '2021-09-14', 'O', '2021-09-14 09:38:58', '2021-09-14 09:38:58', NULL),
(8, 4, 1, 25, NULL, 'OTRGEN140921004', 'Proyecto de ciclovía permanente', '2021-09-14', 'O', '2021-09-14 09:40:32', '2021-09-14 09:40:32', NULL),
(9, 4, 1, 25, NULL, 'OTRGEN140921005', 'Implementación de estacionamientos para bicicletas en espacios públicos y privados', '2021-09-14', 'O', '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(10, 4, 1, 8, NULL, 'OTRGEN140921006', 'Creación e implementación del programa municipal para protección la del ciclista y peatón trujillano', '2021-09-14', 'O', '2021-09-14 09:48:36', '2021-09-16 20:44:25', NULL),
(11, 4, 1, 25, NULL, 'OTRGEN140921007', 'Eliminación de elementos arquitectónicos del centro histórico', '2021-09-14', 'O', '2021-09-14 09:52:20', '2021-09-14 09:52:20', NULL),
(12, 4, 1, 8, NULL, 'OTRGEN140921008', 'Entornos escolares - actividad operativa no contemplada en el POI (RR de MTC)', '2021-09-14', 'O', '2021-09-14 09:55:14', '2021-09-14 09:55:14', NULL),
(13, 4, 1, 15, NULL, 'OTRGEN140921009', 'Mejoramiento y ampliación del observatorio de movilidad de la ciudad de Trujillo - provincia Trujillo - departamento La Libertad', '2021-09-14', 'O', '2021-09-14 10:02:48', '2021-09-16 23:04:08', NULL),
(14, 4, 1, 15, NULL, 'OTRGEN140921010', 'Mejoramiento y ampliación de la red de paraderos en el distrito de Trujillo, provincia de Trujillo-La Libertad', '2021-09-14', 'O', '2021-09-16 23:51:15', '2021-09-16 23:51:15', NULL),
(15, 4, 1, 8, NULL, 'OTRGEN140921011', 'Al trabajo en bici: Impulsar a entidades públicas y privadas', '2021-09-14', 'O', '2021-09-17 00:00:51', '2021-09-17 00:00:51', NULL),
(16, 4, 1, 8, NULL, 'OTRGEN140921012', 'Diagnóstico de puntos críticos de accidentabilidad en el distrito de Trujillo - Estudio', '2021-09-14', 'O', '2021-09-17 00:10:40', '2021-09-17 00:10:40', NULL),
(17, 4, 1, 18, NULL, 'OTRGEN140921013', 'Elaboración de estudios técnicos para propuestas de proyecto de ordenanza', '2021-09-14', 'O', '2021-09-17 00:22:08', '2021-09-17 00:22:08', NULL),
(18, 4, 1, 18, NULL, 'OTRGEN140921014', 'Foros virtuales de sensibilización respecto a la movilidad sostenible', '2021-09-14', 'O', '2021-09-17 00:36:16', '2021-09-17 00:36:16', NULL),
(19, 4, 1, 18, NULL, 'OTRGEN140921015', 'Fortalecimiento de capacidades en temas de planificación y gestión de transporte urbano sostenible', '2021-09-14', 'O', '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(20, 4, 1, 25, NULL, 'OTRGEN140921016', 'Asistencia al proceso de diagramación del PMUS', '2021-09-14', 'O', '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(21, 4, 1, 18, NULL, 'OTRGEN140921017', 'Acompañamiento, asesoría y asistencia técnica para levantar observaciones del Sistema Integrado de Transportes de Trujillo', '2021-09-14', 'O', '2021-09-17 09:59:19', '2021-09-17 10:45:36', NULL),
(22, 4, 1, 8, NULL, 'OTRGEN140921018', 'Estudios de tráfico', '2021-09-14', 'O', '2021-09-17 10:09:18', '2021-09-17 10:10:07', NULL),
(23, 4, 1, 18, NULL, 'OTRGEN140921019', 'Mejoramiento del servicio de transporte urbano de pasajeros a través de un corredor troncal en 5 distritos de la provincia de Trujillo, departamento La Libertad - Levantamiento de observaciones', '2021-09-14', 'O', '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_types`
--

CREATE TABLE `project_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `project_types`
--

INSERT INTO `project_types` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Consultoría', 'CON', NULL, NULL, NULL),
(2, 'Contenidos', 'PUB', NULL, NULL, NULL),
(3, 'Sistemas', 'SIS', NULL, NULL, NULL),
(4, 'Otros', 'OTR', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `project_user`
--

CREATE TABLE `project_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 4, '2021-09-14 08:52:10', '2021-09-14 08:52:10', NULL),
(2, 5, 2, '2021-09-14 09:17:38', '2021-09-14 09:17:38', NULL),
(3, 6, 13, '2021-09-14 09:35:04', '2021-09-14 09:35:04', NULL),
(4, 6, 3, '2021-09-14 09:35:04', '2021-09-14 09:35:04', NULL),
(5, 6, 26, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(6, 6, 22, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(7, 6, 17, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(8, 6, 25, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(9, 6, 6, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(10, 6, 9, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(11, 6, 19, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(12, 6, 18, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(13, 6, 8, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(14, 6, 21, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(15, 6, 5, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(16, 6, 4, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(17, 6, 23, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(18, 6, 15, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(19, 6, 12, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(20, 6, 14, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(21, 6, 10, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(22, 6, 24, '2021-09-14 09:35:05', '2021-09-14 09:35:05', NULL),
(23, 7, 8, '2021-09-14 09:38:58', '2021-09-14 09:38:58', NULL),
(24, 10, 8, '2021-09-14 09:49:19', '2021-09-14 09:49:19', NULL),
(25, 11, 25, '2021-09-14 09:52:20', '2021-09-14 09:52:20', NULL),
(26, 13, 15, '2021-09-14 10:02:48', '2021-09-14 10:02:48', NULL),
(27, 13, 25, '2021-09-14 10:02:48', '2021-09-14 10:02:48', NULL),
(28, 13, 2, '2021-09-14 10:18:23', '2021-09-14 10:18:23', '2021-09-16 21:05:50'),
(29, 10, 13, '2021-09-16 20:00:16', '2021-09-16 20:00:16', NULL),
(30, 9, 25, '2021-09-16 20:53:27', '2021-09-16 20:53:27', NULL),
(31, 10, 3, '2021-09-16 21:29:26', '2021-09-16 21:29:26', NULL),
(32, 10, 26, '2021-09-16 21:29:27', '2021-09-16 21:29:27', NULL),
(33, 10, 22, '2021-09-16 21:29:27', '2021-09-16 21:29:27', NULL),
(34, 10, 17, '2021-09-16 21:29:27', '2021-09-16 21:29:27', NULL),
(35, 10, 25, '2021-09-16 21:29:27', '2021-09-16 21:29:27', NULL),
(36, 10, 6, '2021-09-16 21:29:27', '2021-09-16 21:29:27', NULL),
(37, 10, 9, '2021-09-16 21:29:27', '2021-09-16 21:29:27', NULL),
(38, 10, 19, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(39, 10, 18, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(40, 10, 21, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(41, 10, 5, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(42, 10, 4, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(43, 10, 23, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(44, 10, 15, '2021-09-16 21:29:28', '2021-09-16 21:29:28', NULL),
(45, 10, 12, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(46, 10, 14, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(47, 10, 10, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(48, 10, 24, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(49, 10, 2, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(50, 10, 16, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(51, 10, 7, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(52, 10, 11, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(53, 10, 20, '2021-09-16 21:29:29', '2021-09-16 21:29:29', NULL),
(54, 7, 13, '2021-09-16 21:44:48', '2021-09-16 21:44:48', NULL),
(55, 7, 3, '2021-09-16 21:44:48', '2021-09-16 21:44:48', NULL),
(56, 7, 26, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(57, 7, 22, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(58, 7, 17, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(59, 7, 25, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(60, 7, 6, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(61, 7, 9, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(62, 7, 19, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(63, 7, 18, '2021-09-16 21:44:49', '2021-09-16 21:44:49', NULL),
(64, 7, 21, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(65, 7, 5, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(66, 7, 4, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(67, 7, 23, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(68, 7, 15, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(69, 7, 12, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(70, 7, 14, '2021-09-16 21:44:50', '2021-09-16 21:44:50', NULL),
(71, 7, 10, '2021-09-16 21:44:51', '2021-09-16 21:44:51', NULL),
(72, 7, 24, '2021-09-16 21:44:51', '2021-09-16 21:44:51', NULL),
(73, 7, 2, '2021-09-16 21:44:51', '2021-09-16 21:44:51', NULL),
(74, 7, 7, '2021-09-16 21:44:51', '2021-09-16 21:44:51', NULL),
(75, 7, 11, '2021-09-16 21:44:51', '2021-09-16 21:44:51', NULL),
(76, 7, 20, '2021-09-16 21:44:51', '2021-09-16 21:44:51', NULL),
(77, 8, 25, '2021-09-16 21:49:55', '2021-09-16 21:49:55', NULL),
(78, 8, 4, '2021-09-16 22:06:34', '2021-09-16 22:06:34', NULL),
(79, 8, 19, '2021-09-16 22:06:34', '2021-09-16 22:06:34', NULL),
(80, 6, 2, '2021-09-16 22:15:18', '2021-09-16 22:15:18', NULL),
(81, 6, 16, '2021-09-16 22:15:18', '2021-09-16 22:15:18', NULL),
(82, 6, 7, '2021-09-16 22:15:18', '2021-09-16 22:15:18', NULL),
(83, 6, 11, '2021-09-16 22:15:19', '2021-09-16 22:15:19', NULL),
(84, 6, 20, '2021-09-16 22:15:19', '2021-09-16 22:15:19', NULL),
(85, 9, 18, '2021-09-16 22:22:28', '2021-09-16 22:22:28', NULL),
(86, 9, 15, '2021-09-16 22:22:28', '2021-09-16 22:22:28', NULL),
(87, 9, 14, '2021-09-16 22:22:28', '2021-09-16 22:22:28', NULL),
(88, 9, 8, '2021-09-16 22:22:29', '2021-09-16 22:22:29', NULL),
(89, 9, 13, '2021-09-16 22:22:29', '2021-09-16 22:22:29', NULL),
(90, 11, 18, '2021-09-16 22:39:11', '2021-09-16 22:39:11', NULL),
(91, 11, 15, '2021-09-16 22:39:12', '2021-09-16 22:39:12', NULL),
(92, 11, 14, '2021-09-16 22:39:12', '2021-09-16 22:39:12', NULL),
(93, 11, 8, '2021-09-16 22:39:12', '2021-09-16 22:39:12', NULL),
(94, 11, 13, '2021-09-16 22:39:12', '2021-09-16 22:39:12', NULL),
(95, 12, 16, '2021-09-16 22:50:41', '2021-09-16 22:50:41', NULL),
(96, 12, 4, '2021-09-16 22:50:42', '2021-09-16 22:50:42', NULL),
(97, 12, 19, '2021-09-16 22:50:42', '2021-09-16 22:50:42', NULL),
(98, 12, 24, '2021-09-16 22:50:42', '2021-09-16 22:50:42', NULL),
(99, 12, 9, '2021-09-16 22:50:43', '2021-09-16 22:50:43', NULL),
(100, 12, 12, '2021-09-16 22:50:44', '2021-09-16 22:50:44', NULL),
(101, 12, 11, '2021-09-16 22:50:44', '2021-09-16 22:50:44', NULL),
(102, 12, 5, '2021-09-16 22:50:44', '2021-09-16 22:50:44', NULL),
(103, 13, 18, '2021-09-16 23:04:08', '2021-09-16 23:04:08', NULL),
(104, 13, 14, '2021-09-16 23:04:09', '2021-09-16 23:04:09', NULL),
(105, 13, 8, '2021-09-16 23:04:09', '2021-09-16 23:04:09', NULL),
(106, 13, 13, '2021-09-16 23:04:09', '2021-09-16 23:04:09', NULL),
(107, 14, 25, '2021-09-16 23:51:19', '2021-09-16 23:51:19', NULL),
(108, 14, 18, '2021-09-16 23:51:20', '2021-09-16 23:51:20', NULL),
(109, 14, 15, '2021-09-16 23:51:20', '2021-09-16 23:51:20', NULL),
(110, 14, 14, '2021-09-16 23:51:20', '2021-09-16 23:51:20', NULL),
(111, 14, 8, '2021-09-16 23:51:21', '2021-09-16 23:51:21', NULL),
(112, 14, 13, '2021-09-16 23:51:21', '2021-09-16 23:51:21', NULL),
(113, 15, 13, '2021-09-17 00:01:16', '2021-09-17 00:01:16', NULL),
(114, 15, 3, '2021-09-17 00:01:17', '2021-09-17 00:01:17', NULL),
(115, 15, 26, '2021-09-17 00:01:17', '2021-09-17 00:01:17', NULL),
(116, 15, 22, '2021-09-17 00:01:17', '2021-09-17 00:01:17', NULL),
(117, 15, 17, '2021-09-17 00:01:17', '2021-09-17 00:01:17', NULL),
(118, 15, 25, '2021-09-17 00:01:17', '2021-09-17 00:01:17', NULL),
(119, 15, 6, '2021-09-17 00:01:18', '2021-09-17 00:01:18', NULL),
(120, 15, 9, '2021-09-17 00:01:18', '2021-09-17 00:01:18', NULL),
(121, 15, 19, '2021-09-17 00:01:18', '2021-09-17 00:01:18', NULL),
(122, 15, 18, '2021-09-17 00:01:18', '2021-09-17 00:01:18', NULL),
(123, 15, 8, '2021-09-17 00:01:19', '2021-09-17 00:01:19', NULL),
(124, 15, 21, '2021-09-17 00:01:19', '2021-09-17 00:01:19', NULL),
(125, 15, 5, '2021-09-17 00:01:19', '2021-09-17 00:01:19', NULL),
(126, 15, 4, '2021-09-17 00:01:19', '2021-09-17 00:01:19', NULL),
(127, 15, 23, '2021-09-17 00:01:21', '2021-09-17 00:01:21', NULL),
(128, 15, 15, '2021-09-17 00:01:22', '2021-09-17 00:01:22', NULL),
(129, 15, 12, '2021-09-17 00:01:25', '2021-09-17 00:01:25', NULL),
(130, 15, 14, '2021-09-17 00:01:25', '2021-09-17 00:01:25', NULL),
(131, 15, 10, '2021-09-17 00:01:27', '2021-09-17 00:01:27', NULL),
(132, 15, 24, '2021-09-17 00:01:28', '2021-09-17 00:01:28', NULL),
(133, 15, 2, '2021-09-17 00:01:29', '2021-09-17 00:01:29', NULL),
(134, 15, 16, '2021-09-17 00:01:29', '2021-09-17 00:01:29', NULL),
(135, 15, 7, '2021-09-17 00:01:30', '2021-09-17 00:01:30', NULL),
(136, 15, 11, '2021-09-17 00:01:30', '2021-09-17 00:01:30', NULL),
(137, 15, 20, '2021-09-17 00:01:31', '2021-09-17 00:01:31', NULL),
(138, 16, 13, '2021-09-17 00:10:47', '2021-09-17 00:10:47', NULL),
(139, 16, 3, '2021-09-17 00:10:47', '2021-09-17 00:10:47', NULL),
(140, 16, 26, '2021-09-17 00:10:48', '2021-09-17 00:10:48', NULL),
(141, 16, 22, '2021-09-17 00:10:49', '2021-09-17 00:10:49', NULL),
(142, 16, 17, '2021-09-17 00:10:49', '2021-09-17 00:10:49', NULL),
(143, 16, 25, '2021-09-17 00:10:50', '2021-09-17 00:10:50', NULL),
(144, 16, 6, '2021-09-17 00:10:50', '2021-09-17 00:10:50', NULL),
(145, 16, 19, '2021-09-17 00:10:50', '2021-09-17 00:10:50', NULL),
(146, 16, 18, '2021-09-17 00:10:51', '2021-09-17 00:10:51', NULL),
(147, 16, 8, '2021-09-17 00:10:51', '2021-09-17 00:10:51', NULL),
(148, 16, 21, '2021-09-17 00:10:52', '2021-09-17 00:10:52', NULL),
(149, 16, 5, '2021-09-17 00:10:53', '2021-09-17 00:10:53', NULL),
(150, 16, 4, '2021-09-17 00:10:53', '2021-09-17 00:10:53', NULL),
(151, 16, 23, '2021-09-17 00:10:54', '2021-09-17 00:10:54', NULL),
(152, 16, 15, '2021-09-17 00:10:54', '2021-09-17 00:10:54', NULL),
(153, 16, 12, '2021-09-17 00:10:54', '2021-09-17 00:10:54', NULL),
(154, 16, 14, '2021-09-17 00:10:55', '2021-09-17 00:10:55', NULL),
(155, 16, 10, '2021-09-17 00:10:55', '2021-09-17 00:10:55', NULL),
(156, 16, 24, '2021-09-17 00:10:55', '2021-09-17 00:10:55', NULL),
(157, 16, 2, '2021-09-17 00:10:55', '2021-09-17 00:10:55', NULL),
(158, 16, 16, '2021-09-17 00:10:56', '2021-09-17 00:10:56', NULL),
(159, 16, 7, '2021-09-17 00:10:56', '2021-09-17 00:10:56', NULL),
(160, 16, 11, '2021-09-17 00:10:56', '2021-09-17 00:10:56', NULL),
(161, 16, 20, '2021-09-17 00:10:57', '2021-09-17 00:10:57', NULL),
(162, 17, 17, '2021-09-17 00:22:10', '2021-09-17 00:22:10', NULL),
(163, 17, 16, '2021-09-17 00:22:11', '2021-09-17 00:22:11', NULL),
(164, 17, 4, '2021-09-17 00:22:11', '2021-09-17 00:22:11', NULL),
(165, 17, 19, '2021-09-17 00:22:11', '2021-09-17 00:22:11', NULL),
(166, 17, 7, '2021-09-17 00:22:11', '2021-09-17 00:22:11', NULL),
(167, 17, 24, '2021-09-17 00:22:11', '2021-09-17 00:22:11', NULL),
(168, 17, 9, '2021-09-17 00:22:11', '2021-09-17 00:22:11', NULL),
(169, 17, 12, '2021-09-17 00:22:12', '2021-09-17 00:22:12', NULL),
(170, 17, 11, '2021-09-17 00:22:12', '2021-09-17 00:22:12', NULL),
(171, 17, 8, '2021-09-17 00:22:12', '2021-09-17 00:22:12', NULL),
(172, 17, 5, '2021-09-17 00:22:12', '2021-09-17 00:22:12', NULL),
(173, 18, 16, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(174, 18, 4, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(175, 18, 19, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(176, 18, 24, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(177, 18, 9, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(178, 18, 12, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(179, 18, 11, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(180, 18, 5, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(181, 19, 16, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(182, 19, 4, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(183, 19, 19, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(184, 19, 24, '2021-09-17 00:47:16', '2021-09-17 00:47:16', NULL),
(185, 19, 9, '2021-09-17 00:47:16', '2021-09-17 00:47:16', NULL),
(186, 19, 12, '2021-09-17 00:47:16', '2021-09-17 00:47:16', NULL),
(187, 19, 11, '2021-09-17 00:47:16', '2021-09-17 00:47:16', NULL),
(188, 19, 5, '2021-09-17 00:47:16', '2021-09-17 00:47:16', NULL),
(189, 20, 25, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(190, 20, 18, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(191, 20, 15, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(192, 20, 14, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(193, 20, 8, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(194, 20, 13, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(195, 21, 13, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(196, 21, 3, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(197, 21, 26, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(198, 21, 22, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(199, 21, 17, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(200, 21, 25, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(201, 21, 6, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(202, 21, 9, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(203, 21, 19, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(204, 21, 18, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(205, 21, 8, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(206, 21, 21, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(207, 21, 5, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(208, 21, 4, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(209, 21, 23, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(210, 21, 15, '2021-09-17 09:59:21', '2021-09-17 09:59:21', NULL),
(211, 21, 12, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(212, 21, 14, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(213, 21, 10, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(214, 21, 24, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(215, 21, 2, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(216, 21, 16, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(217, 21, 7, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(218, 21, 11, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(219, 21, 20, '2021-09-17 09:59:22', '2021-09-17 09:59:22', NULL),
(220, 22, 13, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(221, 22, 3, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(222, 22, 26, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(223, 22, 22, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(224, 22, 17, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(225, 22, 25, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(226, 22, 6, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(227, 22, 9, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(228, 22, 19, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(229, 22, 18, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(230, 22, 8, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(231, 22, 21, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(232, 22, 5, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(233, 22, 4, '2021-09-17 10:09:20', '2021-09-17 10:09:20', NULL),
(234, 22, 23, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(235, 22, 15, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(236, 22, 12, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(237, 22, 14, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(238, 22, 10, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(239, 22, 24, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(240, 22, 2, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(241, 22, 16, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(242, 22, 7, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(243, 22, 11, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(244, 22, 20, '2021-09-17 10:09:21', '2021-09-17 10:09:21', NULL),
(245, 23, 13, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(246, 23, 3, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(247, 23, 26, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(248, 23, 22, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(249, 23, 17, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(250, 23, 25, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(251, 23, 6, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(252, 23, 9, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(253, 23, 19, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(254, 23, 18, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(255, 23, 8, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(256, 23, 21, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(257, 23, 5, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(258, 23, 4, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(259, 23, 23, '2021-09-17 10:31:43', '2021-09-17 10:31:43', NULL),
(260, 23, 15, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(261, 23, 12, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(262, 23, 14, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(263, 23, 10, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(264, 23, 24, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(265, 23, 2, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(266, 23, 16, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(267, 23, 7, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(268, 23, 11, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL),
(269, 23, 20, '2021-09-17 10:31:44', '2021-09-17 10:31:44', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_type_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `visit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pay_curr_id` bigint(20) UNSIGNED NOT NULL,
  `pay_mode_id` bigint(20) UNSIGNED NOT NULL,
  `pay_type_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` tinyint(4) UNSIGNED NOT NULL,
  `term_weeks` int(11) UNSIGNED NOT NULL,
  `serv_order` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `perc_fit` float UNSIGNED DEFAULT NULL,
  `happen_at` date NOT NULL,
  `changed_at` date DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

CREATE TABLE `providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `currency_id` bigint(20) UNSIGNED NOT NULL,
  `exchange_rate_id` bigint(20) UNSIGNED DEFAULT NULL,
  `detail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relationships`
--

CREATE TABLE `relationships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `relationships`
--

INSERT INTO `relationships` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Planilla', 'PLN', NULL, NULL, NULL),
(2, 'Practicante', 'PRC', NULL, NULL, NULL),
(3, 'Recibo por honorarios', 'RHO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sellers`
--

CREATE TABLE `sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `proposal_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `detail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile_id` bigint(20) UNSIGNED NOT NULL,
  `document_type_id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cci` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `row` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_at` date NOT NULL,
  `end_at` date NOT NULL,
  `start_ms` tinyint(1) NOT NULL,
  `end_ms` tinyint(1) NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progress` double(8,2) NOT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relevance` int(10) UNSIGNED NOT NULL,
  `duration` int(10) UNSIGNED NOT NULL,
  `level` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `row`, `code`, `name`, `start_at`, `end_at`, `start_ms`, `end_ms`, `status`, `progress`, `description`, `relevance`, `duration`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 0, '1', 'Actividades de secretaría', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 08:50:23', '2021-09-16 19:27:41', NULL),
(2, 5, 1, '1.1', 'Apoyo en el procesamiento de información (digitación): aforos vehiculares', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:01', NULL),
(3, 5, 2, '1.2', 'Organizar archivos y documentación de la Gerencia de Estudios y Proyectos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:01', NULL),
(4, 5, 3, '1.3', 'Encargada de la agenda de la Gerencia de Estudios y Proyectos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(5, 5, 4, '1.4', 'Encargada de mesa de partes virtual: recepción y seguimiento de los documentos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(6, 5, 5, '1.5', 'Verificar las actividades semanales de todo el personal de TMT', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(7, 5, 6, '1.6', 'Coordinaciones con la GEP y la GG', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(8, 5, 7, '1.7', 'Encargada de responder el correo de acceso a la información pública', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(9, 5, 8, '1.8', 'Asistencia administrativa en la Gerencia de Estudios y Proyectos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(10, 5, 9, '1.9', 'Organización de eventos o reuniones de la Gerencia de Estudios y Proyectos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(11, 5, 10, '1.10', 'Asistencia para lograr la comunicación con personal', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 08:50:23', '2021-09-16 19:26:02', NULL),
(12, 6, 0, '1', 'TUMI - Promoción de recuperación del espacio público del uso del transporte no motorizado', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 09:35:04', '2021-09-16 22:15:18', NULL),
(13, 6, 1, '1.1', 'Intervención Comunicacional y Educativa para promover el respeto actores de la movilidad no motorizada en sus distintas formas', '2021-06-01', '2021-09-30', 0, 0, 'STATUS_UNDEFINED', 0.00, 'Intervención Comunicacional y Educativa para promover el respeto a los actores de la movilidad no motorizada en sus distintas formas (peatonal, ciclista,  entre otras)', 0, 12, 1, '2021-09-14 09:35:04', '2021-09-16 22:09:59', NULL),
(14, 6, 2, '1.2', 'Recuperación de Espacios Públicos', '2021-06-01', '2021-09-30', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:35:04', '2021-09-16 22:10:00', NULL),
(15, 7, 0, '1', 'Programa de biciescuela', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 0, '2021-09-14 09:38:58', '2021-09-16 21:44:47', NULL),
(16, 7, 1, '1.1', 'Elaboración del plan de trabajo', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:38:58', '2021-09-16 21:47:54', NULL),
(17, 7, 2, '1.2', 'Identificación de los espacios públicos donde se llevará a cabo el programa', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:38:58', '2021-09-16 21:44:47', NULL),
(18, 7, 3, '1.3', 'Compra de bicicletas (15 depende del presupuesto)', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:38:58', '2021-09-16 21:44:47', NULL),
(19, 7, 4, '1.4', 'Preparación de materiales de difusión', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:38:58', '2021-09-16 21:44:48', NULL),
(20, 7, 5, '1.5', 'Contratación de un instructor y un asistente (por cuatro meses, depende)', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:38:58', '2021-09-16 21:44:48', NULL),
(21, 7, 6, '1.6', 'Supervisión de la ejecución de talleres gratuitos (semanal probablemente)', '2021-09-01', '2021-12-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 88, 1, '2021-09-14 09:38:58', '2021-09-16 21:44:48', NULL),
(22, 8, 0, '1', 'Proyecto de ciclovía permanente', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 09:40:32', '2021-09-16 21:49:54', NULL),
(23, 8, 1, '1.1', 'Terminar de resolver los comentarios sobre el expediente técnico (subsanar).', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:40:32', '2021-09-14 09:40:32', NULL),
(24, 9, 0, '1', 'Implementación de estacionamientos para bicicletas en espacios públicos y privados', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(25, 9, 1, '1.1', 'Plan de trabajo', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(26, 9, 2, '1.2', 'Identificación de centros atractores (públicas y privadas)', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(27, 9, 3, '1.3', 'Recopilación de la información', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(28, 9, 4, '1.4', 'Coordinar reuniones con las instituciones públicas y privadas para implementación de ciclo parqueaderos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(29, 9, 5, '1.5', 'Acuerdos y/o convenios de la implementación de ciclo parqueaderos en las institución públicas y privadas', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(30, 9, 6, '1.6', 'Propuesta del diseño arquitectónico del ciclo parqueaderos según áreas establecidas en los convenios con las instituciones públicas y privadas', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:24', NULL),
(31, 9, 7, '1.7', 'Expediente técnico', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-16 19:45:25', NULL),
(32, 9, 8, NULL, NULL, '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:43:08', '2021-09-14 09:43:34', '2021-09-14 09:43:34'),
(33, 10, 0, '1', 'Creación e implementación del programa municipal para protección la del ciclista y peatón trujillano', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 09:48:36', '2021-09-16 20:44:25', NULL),
(34, 10, 1, '1.1', 'Propuesta Programa Municipal Protección del Ciclista y Peatón', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:48:36', '2021-09-16 20:00:16', NULL),
(35, 10, 2, '1.2', 'Aportes de asociaciones de ciclistas para mejorar programa del Protección del Ciclista y Peatón', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:48:36', '2021-09-16 20:00:16', NULL),
(36, 10, 3, '1.3', 'Aportes de la cooperación GIZ para mejorar programa del Protección del Ciclista y Peatón', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, 'Reunión para definición de competencias del Programa (TMT - Gerencia de transporte) y recibir aportes de la municipalidad.', 0, 1, 1, '2021-09-14 09:48:36', '2021-09-16 20:00:16', NULL),
(37, 10, 4, '1.4', 'Aprobación Programa Municipal para la Protección del Ciclista y Peatón Trujillano - PROCIPET', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, 'A finales de mayo', 0, 1, 1, '2021-09-14 09:48:36', '2021-09-16 20:00:16', NULL),
(38, 11, 0, '1', 'Eliminación de elementos arquitectónicos del centro histórico', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 09:52:20', '2021-09-16 22:39:11', NULL),
(39, 11, 1, '1.1', 'Levantamiento de información del centro', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:52:20', '2021-09-14 09:52:20', NULL),
(40, 11, 2, '1.2', 'Evaluación de los puntos que necesitan ser nivelados', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:52:20', '2021-09-14 09:52:20', NULL),
(41, 11, 3, '1.3', 'Propuesta de solución', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:52:20', '2021-09-14 09:52:20', NULL),
(42, 11, 4, '1.4', 'Revisión y evaluación de la propuesta', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:52:20', '2021-09-14 09:52:20', NULL),
(43, 11, 5, '1.5', 'Seguimiento y supervisión de la labor del locador', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:52:20', '2021-09-14 09:52:44', NULL),
(44, 12, 0, '1', 'Nombre del proyecto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 09:55:14', '2021-09-14 09:55:14', NULL),
(45, 12, 1, '1.1', 'Asistentes de la capacitación (mayo - jul)', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:55:14', '2021-09-14 09:55:14', NULL),
(46, 12, 2, '1.2', 'Análisis de los casos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:55:14', '2021-09-14 09:55:14', NULL),
(47, 12, 3, '1.3', 'Aplicación del curso', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:55:14', '2021-09-14 09:55:14', NULL),
(48, 12, 4, '1.4', 'Elaboración del expediente y presupuesto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 09:55:14', '2021-09-14 09:55:14', NULL),
(49, 13, 0, '1', 'Mejoramiento y ampliación del observatorio de movilidad de la ciudad de Trujillo - provincia Trujillo - departamento La Libertad', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-14 10:02:48', '2021-09-16 23:04:08', NULL),
(50, 13, 1, '1.1', 'Plan de trabajo', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(51, 13, 2, '1.2', 'Contratación de un asesor para opinión técnica para la implementación del proyecto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(52, 13, 3, '1.3', 'Levantamiento topográfico', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(53, 13, 4, '1.4', 'Elaboración de los metrados', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(54, 13, 5, '1.5', 'Elaboración de presupuesto de inversión', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(55, 13, 6, '1.6', 'Identificación del problema', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(56, 13, 7, '1.7', 'Recopilación de información diagnostica y estadística', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-14 10:02:48', '2021-09-16 21:05:49', NULL),
(57, 5, 2, NULL, 'Actividad 1', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 2, '2021-09-14 10:12:32', '2021-09-16 19:26:01', '2021-09-16 19:26:01'),
(58, 5, 3, NULL, 'Actividad 2', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 2, '2021-09-14 10:12:32', '2021-09-16 19:26:01', '2021-09-16 19:26:01'),
(59, 5, 4, NULL, 'Subactividad 1', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 3, '2021-09-14 10:12:32', '2021-09-16 19:26:01', '2021-09-16 19:26:01'),
(60, 5, 5, NULL, 'Subactividad 2', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 3, '2021-09-14 10:12:32', '2021-09-16 19:26:01', '2021-09-16 19:26:01'),
(61, 9, 8, '1.8', 'Implementación', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 19:45:25', '2021-09-16 19:45:25', NULL),
(62, 10, 5, '1.5', 'Actividades: 3 de junio: Día Nacional de la Bicicleta 22 de setiembre: Día Sin Auto 23 de noviembre: Día del Ciclista y Peatón Trujillano\"', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 20:00:16', '2021-09-16 20:04:43', '2021-09-16 20:04:43'),
(63, 10, 5, '1.5', 'Actividades en días especiales', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, '- 03 de junio: Día Nacional de la Bicicleta\n- 22 de setiembre: Día Sin Auto\n- 23 de noviembre: Día del Ciclista y Peatón Trujillano', 0, 1, 1, '2021-09-16 20:44:25', '2021-09-16 20:47:59', NULL),
(64, 10, 6, '1.5.1', '-> 03 de junio: Día Nacional de la Bicicleta', '2021-06-03', '2021-06-03', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 2, '2021-09-16 20:44:25', '2021-09-17 12:38:49', NULL),
(65, 10, 7, '1.5.2', '-> 22 de setiembre: Día Sin Auto', '2021-09-22', '2021-09-22', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 2, '2021-09-16 20:44:26', '2021-09-17 12:38:49', NULL),
(66, 10, 8, '1.5.3', '-> 23 de noviembre: Día del Ciclista y Peatón Trujillano', '2021-11-23', '2022-01-31', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 50, 2, '2021-09-16 20:44:26', '2021-09-17 12:38:50', NULL),
(67, 13, 8, '1.8', 'Identificación del problema y objetivos del proyecto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:49', '2021-09-16 21:05:49', NULL),
(68, 13, 9, '1.9', 'Planteamiento de alternativas', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:49', '2021-09-16 21:05:49', NULL),
(69, 13, 10, '1.10', 'Análisis de la oferta y demanda', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(70, 13, 11, '1.11', 'Formulación técnica del proyecto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(71, 13, 12, '1.12', 'Costos y beneficios del proyecto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(72, 13, 13, '1.13', 'Evaluación económica y social del proyecto', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(73, 13, 14, '1.14', 'Análisis de sensibilidad y sostenibilidad', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(74, 13, 15, '1.15', 'Marco lógico, conclusiones y anexos', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(75, 13, 16, '1.16', 'Diseño e impresión del documento final', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(76, 13, 17, '1.17', 'Diseño arquitectónico y cuantificación presupuestal', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(77, 13, 18, '1.18', 'Informe final para presentación del expediente técnico', '2021-09-15', '2021-09-15', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 21:05:50', '2021-09-16 21:05:50', NULL),
(78, 14, 0, '1.', 'Mejoramiento y ampliación de la red de paraderos en el distrito de Trujillo, provincia de Trujillo-La Libertad', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-16 23:51:16', '2021-09-16 23:51:16', NULL),
(79, 14, 1, '1.1', 'Inclusión del proyecto dentro de la programación multianual de inversiones', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:16', '2021-09-16 23:51:16', NULL),
(80, 14, 2, '1.2', 'Diagnóstico de las necesidades y recopilación de información (2 semanas)', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:17', '2021-09-16 23:51:17', NULL),
(81, 14, 3, '1.3', 'Diseño de la infraestructura de acuerdo a las necesidades (3 semanas)', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:17', '2021-09-16 23:51:17', NULL),
(82, 14, 4, '1.4', 'Presupuesto de la infraestructura y equipamiento (2 semanas)', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:17', '2021-09-16 23:51:17', NULL),
(83, 14, 5, '1.5', 'Formulación, evaluación del proyecto y entrega final (2 semanas)', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:18', '2021-09-16 23:51:18', NULL),
(84, 14, 6, '1.6', 'Elaboración del expediente técnico (1 mes)', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:18', '2021-09-16 23:51:18', NULL),
(85, 14, 7, '1.7', 'Subir al sistema de Invierte.pe', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-16 23:51:19', '2021-09-16 23:51:19', NULL),
(86, 15, 0, '1', 'Al trabajo en bici: Impulsar a entidades públicas y privadas', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 00:01:11', '2021-09-17 00:01:11', NULL),
(87, 15, 1, '1.1', 'Plan de Trabajo', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:12', '2021-09-17 00:01:12', NULL),
(88, 15, 2, '1.2', 'Verificar las actividades semanales de todo el personal de TMT: productos entregados, actividades diarias.', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:13', '2021-09-17 00:01:13', NULL),
(89, 15, 3, '1.3', 'Oficializar la ley 30936 a las Instituciones Públicas y Privadas en el distrito de Trujillo', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:13', '2021-09-17 00:01:13', NULL),
(90, 15, 4, '1.4', 'Coordinar Reuniones con las instituciones Públicas y Privadas para promover la Ley n°30936', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:14', '2021-09-17 00:01:14', NULL),
(91, 15, 5, '1.5', 'Compromiso MPT entre las institución pública y privadas que promuevan el uso de la bicicleta en sus centros laborales', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:15', '2021-09-17 00:01:15', NULL),
(92, 15, 6, '1.6', 'Capacitación virtual al personal de las instituciones comprometidas sobre la Ley 30936 en promover el uso de la bicicleta en los centros laborales', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:15', '2021-09-17 00:01:15', NULL),
(93, 15, 7, '1.7', 'Supervisar la implementación, ejecución de la presente ley 30936 por las instituciones públicas y privadas promoviendo el uso de la bicicleta en sus centros laborales.', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:16', '2021-09-17 00:01:16', NULL),
(94, 15, 8, '1.8', 'Reconocimiento a instituciones elegidas como AMIGOS DEL PLANETA que promovieron la Ley n° 30936', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:16', '2021-09-17 00:01:16', NULL),
(95, 15, 9, '1.9', 'Informe Final', '2021-09-17', '2021-09-17', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:01:16', '2021-09-17 00:01:16', NULL),
(96, 16, 0, '1', 'Diagnóstico de puntos críticos de accidentabilidad en el distrito de Trujillo - Estudio', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 00:10:40', '2021-09-17 00:10:40', NULL),
(97, 16, 1, '1.1', 'Elaboración de plan de trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:10:43', '2021-09-17 00:10:43', NULL),
(98, 16, 2, '1.2', 'Mapeo de los accidentes de tránsito (revisión de base de datos)', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:10:45', '2021-09-17 00:10:45', NULL),
(99, 16, 3, '1.3', 'Identificación y diagnóstico de puntos críticos (trabajo de campo)', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:10:46', '2021-09-17 00:10:46', NULL),
(100, 16, 4, '1.4', 'Proponer soluciones frente a los problemas identificados', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:10:46', '2021-09-17 00:10:46', NULL),
(101, 17, 0, '1', 'Elaboración de estudios técnicos para propuestas de proyecto de ordenanza', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 00:22:08', '2021-09-17 00:22:08', NULL),
(102, 17, 1, '1.1', 'Plan de trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:22:09', '2021-09-17 00:22:09', NULL),
(103, 17, 2, '1.2', 'Evaluación problemática y planteamiento de propuestas', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:22:09', '2021-09-17 00:22:09', NULL),
(104, 17, 3, '1.3', 'Solicitud de información a gerencia de transportes, tránsito y seguridad vial', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:22:10', '2021-09-17 00:22:10', NULL),
(105, 17, 4, '1.4', 'Elaboración de TDR para estudios necesarios', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:22:10', '2021-09-17 00:22:10', NULL),
(106, 17, 5, '1.5', 'Proceso de selección contratación consultoría para estudios', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:22:10', '2021-09-17 00:22:10', NULL),
(107, 17, 6, '1.6', 'Propuesta de ordenanzas', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:22:10', '2021-09-17 00:22:10', NULL),
(108, 18, 0, '1', 'Foros virtuales de sensibilización respecto a la movilidad sostenible', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 00:36:16', '2021-09-17 00:36:16', NULL),
(109, 18, 1, '1.1', 'Plan de Trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:36:16', '2021-09-17 00:36:16', NULL),
(110, 18, 2, '1.2', 'Gestión para contratar/invitar a expositores', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:36:16', '2021-09-17 00:36:16', NULL),
(111, 18, 3, '1.3', 'Presentación de propuestas temática y expositores', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:36:16', '2021-09-17 00:36:16', NULL),
(112, 18, 4, '1.4', 'Capacitaciones Virtuales', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:36:17', '2021-09-17 00:36:17', NULL),
(113, 19, 0, '1', 'Fortalecimiento de capacidades en temas de planificación y gestión de transporte urbano sostenible', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(114, 19, 1, NULL, 'Plan de Trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(115, 19, 2, NULL, 'Elaboración de Términos de Referencia', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(116, 19, 3, NULL, 'Proceso Contratación', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(117, 19, 4, NULL, 'Instalación y actualización del software', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(118, 19, 5, NULL, 'Capacitaciones', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 00:47:15', '2021-09-17 00:47:15', NULL),
(119, 20, 0, '1', 'Asistencia al proceso de diagramación del PMUS', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(120, 20, 1, '1.1', 'Reuniones con la GIZ (TUMI)', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(121, 20, 2, '1.2', 'Reuniones internas y coordinaciones en proyectos específicos', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(122, 20, 3, '1.3', 'Elaboración de planes integrales de cada proyecto', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:44:22', '2021-09-17 09:44:22', NULL),
(123, 21, 0, '1', 'Acompañamiento, asesoría y asistencia técnica para levantar observaciones del Sistema Integrado de Transportes de Trujillo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 09:59:20', '2021-09-17 10:45:36', NULL),
(124, 21, 1, '1.1', 'Plan de Trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(125, 21, 2, '1.2', 'Elaboración de Términos de Referencia', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(126, 21, 3, '1.3', 'Proceso Contratación', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(127, 21, 4, '1.4', 'Servicio', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(128, 21, 5, '1.5', 'Informe Final', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 09:59:20', '2021-09-17 09:59:20', NULL),
(129, 22, 0, '1', 'Estudios de tráfico', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 10:09:19', '2021-09-17 10:10:08', NULL),
(130, 22, 1, '1.1', 'Plan de Trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(131, 22, 2, '1.2', 'Presentación de informe con requerimiento', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(132, 22, 3, '1.3', 'Capacitación para Aforos', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(133, 22, 4, '1.4', 'Aforos', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(134, 22, 5, '1.5', 'Informe Final', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:09:19', '2021-09-17 10:09:19', NULL),
(135, 23, 0, '1', 'Mejoramiento del servicio de transporte urbano de pasajeros a través de un corredor troncal en 5 distritos de la provincia de Trujillo, departamento La Libertad - Levantamiento de observaciones', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 0, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(136, 23, 1, '1.1', 'Plan de trabajo', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(137, 23, 2, '1.2', 'Elaboración de los Términos de Referencia para la consultoría', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(138, 23, 3, '1.3', 'Revisión por parte del Ministerio de Transportes y Comunicaciones en merito al convenio especifico celebrado para el proyecto del corredor vial norte sur', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(139, 23, 4, '1.4', 'Proceso de selección contratación consultoría para estudios', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(140, 23, 5, '1.5', 'Estudio EVALUACIÓN AMBIENTAL PRELIMINAR DEL PROYECTO DE INVERSIÓN', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL),
(141, 23, 6, '1.6', 'Entrega producto e informe final', '2021-09-20', '2021-09-20', 0, 0, 'STATUS_UNDEFINED', 0.00, NULL, 0, 1, 1, '2021-09-17 10:31:42', '2021-09-17 10:31:42', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `types`
--

INSERT INTO `types` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '30 días', 'PT1', NULL, NULL, NULL),
(2, '60 días', 'PT2', NULL, NULL, NULL),
(3, '90 días', 'PT3', NULL, NULL, NULL),
(4, '120 días', 'PT4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubigeos`
--

CREATE TABLE `ubigeos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ubigeos`
--

INSERT INTO `ubigeos` (`id`, `department`, `province`, `district`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Amazonas', 'Chachapoyas', 'Chachapoyas', NULL, NULL, NULL),
(2, 'Amazonas', 'Chachapoyas', 'Asuncion', NULL, NULL, NULL),
(3, 'Amazonas', 'Chachapoyas', 'Balsas', NULL, NULL, NULL),
(4, 'Amazonas', 'Chachapoyas', 'Cheto', NULL, NULL, NULL),
(5, 'Amazonas', 'Chachapoyas', 'Chiliquin', NULL, NULL, NULL),
(6, 'Amazonas', 'Chachapoyas', 'Chuquibamba', NULL, NULL, NULL),
(7, 'Amazonas', 'Chachapoyas', 'Granada', NULL, NULL, NULL),
(8, 'Amazonas', 'Chachapoyas', 'Huancas', NULL, NULL, NULL),
(9, 'Amazonas', 'Chachapoyas', 'La Jalca', NULL, NULL, NULL),
(10, 'Amazonas', 'Chachapoyas', 'Leimebamba', NULL, NULL, NULL),
(11, 'Amazonas', 'Chachapoyas', 'Levanto', NULL, NULL, NULL),
(12, 'Amazonas', 'Chachapoyas', 'Magdalena', NULL, NULL, NULL),
(13, 'Amazonas', 'Chachapoyas', 'Mariscal Castilla', NULL, NULL, NULL),
(14, 'Amazonas', 'Chachapoyas', 'Molinopampa', NULL, NULL, NULL),
(15, 'Amazonas', 'Chachapoyas', 'Montevideo', NULL, NULL, NULL),
(16, 'Amazonas', 'Chachapoyas', 'Olleros', NULL, NULL, NULL),
(17, 'Amazonas', 'Chachapoyas', 'Quinjalca', NULL, NULL, NULL),
(18, 'Amazonas', 'Chachapoyas', 'San Francisco de Daguas', NULL, NULL, NULL),
(19, 'Amazonas', 'Chachapoyas', 'San Isidro de Maino', NULL, NULL, NULL),
(20, 'Amazonas', 'Chachapoyas', 'Soloco', NULL, NULL, NULL),
(21, 'Amazonas', 'Chachapoyas', 'Sonche', NULL, NULL, NULL),
(22, 'Amazonas', 'Bagua', 'Bagua', NULL, NULL, NULL),
(23, 'Amazonas', 'Bagua', 'Aramango', NULL, NULL, NULL),
(24, 'Amazonas', 'Bagua', 'Copallin', NULL, NULL, NULL),
(25, 'Amazonas', 'Bagua', 'El Parco', NULL, NULL, NULL),
(26, 'Amazonas', 'Bagua', 'Imaza', NULL, NULL, NULL),
(27, 'Amazonas', 'Bagua', 'La Peca', NULL, NULL, NULL),
(28, 'Amazonas', 'Bongara', 'Jumbilla', NULL, NULL, NULL),
(29, 'Amazonas', 'Bongara', 'Chisquilla', NULL, NULL, NULL),
(30, 'Amazonas', 'Bongara', 'Churuja', NULL, NULL, NULL),
(31, 'Amazonas', 'Bongara', 'Corosha', NULL, NULL, NULL),
(32, 'Amazonas', 'Bongara', 'Cuispes', NULL, NULL, NULL),
(33, 'Amazonas', 'Bongara', 'Florida', NULL, NULL, NULL),
(34, 'Amazonas', 'Bongara', 'Jazan', NULL, NULL, NULL),
(35, 'Amazonas', 'Bongara', 'Recta', NULL, NULL, NULL),
(36, 'Amazonas', 'Bongara', 'San Carlos', NULL, NULL, NULL),
(37, 'Amazonas', 'Bongara', 'Shipasbamba', NULL, NULL, NULL),
(38, 'Amazonas', 'Bongara', 'Valera', NULL, NULL, NULL),
(39, 'Amazonas', 'Bongara', 'Yambrasbamba', NULL, NULL, NULL),
(40, 'Amazonas', 'Condorcanqui', 'Nieva', NULL, NULL, NULL),
(41, 'Amazonas', 'Condorcanqui', 'El Cenepa', NULL, NULL, NULL),
(42, 'Amazonas', 'Condorcanqui', 'Rio Santiago', NULL, NULL, NULL),
(43, 'Amazonas', 'Luya', 'Lamud', NULL, NULL, NULL),
(44, 'Amazonas', 'Luya', 'Camporredondo', NULL, NULL, NULL),
(45, 'Amazonas', 'Luya', 'Cocabamba', NULL, NULL, NULL),
(46, 'Amazonas', 'Luya', 'Colcamar', NULL, NULL, NULL),
(47, 'Amazonas', 'Luya', 'Conila', NULL, NULL, NULL),
(48, 'Amazonas', 'Luya', 'Inguilpata', NULL, NULL, NULL),
(49, 'Amazonas', 'Luya', 'Longuita', NULL, NULL, NULL),
(50, 'Amazonas', 'Luya', 'Lonya Chico', NULL, NULL, NULL),
(51, 'Amazonas', 'Luya', 'Luya', NULL, NULL, NULL),
(52, 'Amazonas', 'Luya', 'Luya Viejo', NULL, NULL, NULL),
(53, 'Amazonas', 'Luya', 'Maria', NULL, NULL, NULL),
(54, 'Amazonas', 'Luya', 'Ocalli', NULL, NULL, NULL),
(55, 'Amazonas', 'Luya', 'Ocumal', NULL, NULL, NULL),
(56, 'Amazonas', 'Luya', 'Pisuquia', NULL, NULL, NULL),
(57, 'Amazonas', 'Luya', 'Providencia', NULL, NULL, NULL),
(58, 'Amazonas', 'Luya', 'San Cristobal', NULL, NULL, NULL),
(59, 'Amazonas', 'Luya', 'San Francisco de Yeso', NULL, NULL, NULL),
(60, 'Amazonas', 'Luya', 'San Jeronimo', NULL, NULL, NULL),
(61, 'Amazonas', 'Luya', 'San Juan de Lopecancha', NULL, NULL, NULL),
(62, 'Amazonas', 'Luya', 'Santa Catalina', NULL, NULL, NULL),
(63, 'Amazonas', 'Luya', 'Santo Tomas', NULL, NULL, NULL),
(64, 'Amazonas', 'Luya', 'Tingo', NULL, NULL, NULL),
(65, 'Amazonas', 'Luya', 'Trita', NULL, NULL, NULL),
(66, 'Amazonas', 'Rodriguez de Mendoza', 'San Nicolas', NULL, NULL, NULL),
(67, 'Amazonas', 'Rodriguez de Mendoza', 'Chirimoto', NULL, NULL, NULL),
(68, 'Amazonas', 'Rodriguez de Mendoza', 'Cochamal', NULL, NULL, NULL),
(69, 'Amazonas', 'Rodriguez de Mendoza', 'Huambo', NULL, NULL, NULL),
(70, 'Amazonas', 'Rodriguez de Mendoza', 'Limabamba', NULL, NULL, NULL),
(71, 'Amazonas', 'Rodriguez de Mendoza', 'Longar', NULL, NULL, NULL),
(72, 'Amazonas', 'Rodriguez de Mendoza', 'Mariscal Benavides', NULL, NULL, NULL),
(73, 'Amazonas', 'Rodriguez de Mendoza', 'Milpuc', NULL, NULL, NULL),
(74, 'Amazonas', 'Rodriguez de Mendoza', 'Omia', NULL, NULL, NULL),
(75, 'Amazonas', 'Rodriguez de Mendoza', 'Santa Rosa', NULL, NULL, NULL),
(76, 'Amazonas', 'Rodriguez de Mendoza', 'Totora', NULL, NULL, NULL),
(77, 'Amazonas', 'Rodriguez de Mendoza', 'Vista Alegre', NULL, NULL, NULL),
(78, 'Amazonas', 'Utcubamba', 'Bagua Grande', NULL, NULL, NULL),
(79, 'Amazonas', 'Utcubamba', 'Cajaruro', NULL, NULL, NULL),
(80, 'Amazonas', 'Utcubamba', 'Cumba', NULL, NULL, NULL),
(81, 'Amazonas', 'Utcubamba', 'El Milagro', NULL, NULL, NULL),
(82, 'Amazonas', 'Utcubamba', 'Jamalca', NULL, NULL, NULL),
(83, 'Amazonas', 'Utcubamba', 'Lonya Grande', NULL, NULL, NULL),
(84, 'Amazonas', 'Utcubamba', 'Yamon', NULL, NULL, NULL),
(85, 'Ancash', 'Huaraz', 'Huaraz', NULL, NULL, NULL),
(86, 'Ancash', 'Huaraz', 'Cochabamba', NULL, NULL, NULL),
(87, 'Ancash', 'Huaraz', 'Colcabamba', NULL, NULL, NULL),
(88, 'Ancash', 'Huaraz', 'Huanchay', NULL, NULL, NULL),
(89, 'Ancash', 'Huaraz', 'Independencia', NULL, NULL, NULL),
(90, 'Ancash', 'Huaraz', 'Jangas', NULL, NULL, NULL),
(91, 'Ancash', 'Huaraz', 'La Libertad', NULL, NULL, NULL),
(92, 'Ancash', 'Huaraz', 'Olleros', NULL, NULL, NULL),
(93, 'Ancash', 'Huaraz', 'Pampas Grande', NULL, NULL, NULL),
(94, 'Ancash', 'Huaraz', 'Pariacoto', NULL, NULL, NULL),
(95, 'Ancash', 'Huaraz', 'Pira', NULL, NULL, NULL),
(96, 'Ancash', 'Huaraz', 'Tarica', NULL, NULL, NULL),
(97, 'Ancash', 'Aija', 'Aija', NULL, NULL, NULL),
(98, 'Ancash', 'Aija', 'Coris', NULL, NULL, NULL),
(99, 'Ancash', 'Aija', 'Huacllan', NULL, NULL, NULL),
(100, 'Ancash', 'Aija', 'La Merced', NULL, NULL, NULL),
(101, 'Ancash', 'Aija', 'Succha', NULL, NULL, NULL),
(102, 'Ancash', 'Antonio Raymondi', 'Llamellin', NULL, NULL, NULL),
(103, 'Ancash', 'Antonio Raymondi', 'Aczo', NULL, NULL, NULL),
(104, 'Ancash', 'Antonio Raymondi', 'Chaccho', NULL, NULL, NULL),
(105, 'Ancash', 'Antonio Raymondi', 'Chingas', NULL, NULL, NULL),
(106, 'Ancash', 'Antonio Raymondi', 'Mirgas', NULL, NULL, NULL),
(107, 'Ancash', 'Antonio Raymondi', 'San Juan de Rontoy', NULL, NULL, NULL),
(108, 'Ancash', 'Asuncion', 'Chacas', NULL, NULL, NULL),
(109, 'Ancash', 'Asuncion', 'Acochaca', NULL, NULL, NULL),
(110, 'Ancash', 'Bolognesi', 'Chiquian', NULL, NULL, NULL),
(111, 'Ancash', 'Bolognesi', 'Abelardo Pardo Lezameta', NULL, NULL, NULL),
(112, 'Ancash', 'Bolognesi', 'Antonio Raymondi', NULL, NULL, NULL),
(113, 'Ancash', 'Bolognesi', 'Aquia', NULL, NULL, NULL),
(114, 'Ancash', 'Bolognesi', 'Cajacay', NULL, NULL, NULL),
(115, 'Ancash', 'Bolognesi', 'Canis', NULL, NULL, NULL),
(116, 'Ancash', 'Bolognesi', 'Colquioc', NULL, NULL, NULL),
(117, 'Ancash', 'Bolognesi', 'Huallanca', NULL, NULL, NULL),
(118, 'Ancash', 'Bolognesi', 'Huasta', NULL, NULL, NULL),
(119, 'Ancash', 'Bolognesi', 'Huayllacayan', NULL, NULL, NULL),
(120, 'Ancash', 'Bolognesi', 'La Primavera', NULL, NULL, NULL),
(121, 'Ancash', 'Bolognesi', 'Mangas', NULL, NULL, NULL),
(122, 'Ancash', 'Bolognesi', 'Pacllon', NULL, NULL, NULL),
(123, 'Ancash', 'Bolognesi', 'San Miguel de Corpanqui', NULL, NULL, NULL),
(124, 'Ancash', 'Bolognesi', 'Ticllos', NULL, NULL, NULL),
(125, 'Ancash', 'Carhuaz', 'Carhuaz', NULL, NULL, NULL),
(126, 'Ancash', 'Carhuaz', 'Acopampa', NULL, NULL, NULL),
(127, 'Ancash', 'Carhuaz', 'Amashca', NULL, NULL, NULL),
(128, 'Ancash', 'Carhuaz', 'Anta', NULL, NULL, NULL),
(129, 'Ancash', 'Carhuaz', 'Ataquero', NULL, NULL, NULL),
(130, 'Ancash', 'Carhuaz', 'Marcara', NULL, NULL, NULL),
(131, 'Ancash', 'Carhuaz', 'Pariahuanca', NULL, NULL, NULL),
(132, 'Ancash', 'Carhuaz', 'San Miguel de Aco', NULL, NULL, NULL),
(133, 'Ancash', 'Carhuaz', 'Shilla', NULL, NULL, NULL),
(134, 'Ancash', 'Carhuaz', 'Tinco', NULL, NULL, NULL),
(135, 'Ancash', 'Carhuaz', 'Yungar', NULL, NULL, NULL),
(136, 'Ancash', 'Carlos Fermin Fitzcarrald', 'San Luis', NULL, NULL, NULL),
(137, 'Ancash', 'Carlos Fermin Fitzcarrald', 'San Nicolas', NULL, NULL, NULL),
(138, 'Ancash', 'Carlos Fermin Fitzcarrald', 'Yauya', NULL, NULL, NULL),
(139, 'Ancash', 'Casma', 'Casma', NULL, NULL, NULL),
(140, 'Ancash', 'Casma', 'Buena Vista Alta', NULL, NULL, NULL),
(141, 'Ancash', 'Casma', 'Comandante Noel', NULL, NULL, NULL),
(142, 'Ancash', 'Casma', 'Yautan', NULL, NULL, NULL),
(143, 'Ancash', 'Corongo', 'Corongo', NULL, NULL, NULL),
(144, 'Ancash', 'Corongo', 'Aco', NULL, NULL, NULL),
(145, 'Ancash', 'Corongo', 'Bambas', NULL, NULL, NULL),
(146, 'Ancash', 'Corongo', 'Cusca', NULL, NULL, NULL),
(147, 'Ancash', 'Corongo', 'La Pampa', NULL, NULL, NULL),
(148, 'Ancash', 'Corongo', 'Yanac', NULL, NULL, NULL),
(149, 'Ancash', 'Corongo', 'Yupan', NULL, NULL, NULL),
(150, 'Ancash', 'Huari', 'Huari', NULL, NULL, NULL),
(151, 'Ancash', 'Huari', 'Anra', NULL, NULL, NULL),
(152, 'Ancash', 'Huari', 'Cajay', NULL, NULL, NULL),
(153, 'Ancash', 'Huari', 'Chavin de Huantar', NULL, NULL, NULL),
(154, 'Ancash', 'Huari', 'Huacachi', NULL, NULL, NULL),
(155, 'Ancash', 'Huari', 'Huacchis', NULL, NULL, NULL),
(156, 'Ancash', 'Huari', 'Huachis', NULL, NULL, NULL),
(157, 'Ancash', 'Huari', 'Huantar', NULL, NULL, NULL),
(158, 'Ancash', 'Huari', 'Masin', NULL, NULL, NULL),
(159, 'Ancash', 'Huari', 'Paucas', NULL, NULL, NULL),
(160, 'Ancash', 'Huari', 'Ponto', NULL, NULL, NULL),
(161, 'Ancash', 'Huari', 'Rahuapampa', NULL, NULL, NULL),
(162, 'Ancash', 'Huari', 'Rapayan', NULL, NULL, NULL),
(163, 'Ancash', 'Huari', 'San Marcos', NULL, NULL, NULL),
(164, 'Ancash', 'Huari', 'San Pedro de Chana', NULL, NULL, NULL),
(165, 'Ancash', 'Huari', 'Uco', NULL, NULL, NULL),
(166, 'Ancash', 'Huarmey', 'Huarmey', NULL, NULL, NULL),
(167, 'Ancash', 'Huarmey', 'Cochapeti', NULL, NULL, NULL),
(168, 'Ancash', 'Huarmey', 'Culebras', NULL, NULL, NULL),
(169, 'Ancash', 'Huarmey', 'Huayan', NULL, NULL, NULL),
(170, 'Ancash', 'Huarmey', 'Malvas', NULL, NULL, NULL),
(171, 'Ancash', 'Huaylas', 'Caraz', NULL, NULL, NULL),
(172, 'Ancash', 'Huaylas', 'Huallanca', NULL, NULL, NULL),
(173, 'Ancash', 'Huaylas', 'Huata', NULL, NULL, NULL),
(174, 'Ancash', 'Huaylas', 'Huaylas', NULL, NULL, NULL),
(175, 'Ancash', 'Huaylas', 'Mato', NULL, NULL, NULL),
(176, 'Ancash', 'Huaylas', 'Pamparomas', NULL, NULL, NULL),
(177, 'Ancash', 'Huaylas', 'Pueblo Libre', NULL, NULL, NULL),
(178, 'Ancash', 'Huaylas', 'Santa Cruz', NULL, NULL, NULL),
(179, 'Ancash', 'Huaylas', 'Santo Toribio', NULL, NULL, NULL),
(180, 'Ancash', 'Huaylas', 'Yuracmarca', NULL, NULL, NULL),
(181, 'Ancash', 'Mariscal Luzuriaga', 'Piscobamba', NULL, NULL, NULL),
(182, 'Ancash', 'Mariscal Luzuriaga', 'Casca', NULL, NULL, NULL),
(183, 'Ancash', 'Mariscal Luzuriaga', 'Eleazar Guzman Barron', NULL, NULL, NULL),
(184, 'Ancash', 'Mariscal Luzuriaga', 'Fidel Olivas Escudero', NULL, NULL, NULL),
(185, 'Ancash', 'Mariscal Luzuriaga', 'Llama', NULL, NULL, NULL),
(186, 'Ancash', 'Mariscal Luzuriaga', 'Llumpa', NULL, NULL, NULL),
(187, 'Ancash', 'Mariscal Luzuriaga', 'Lucma', NULL, NULL, NULL),
(188, 'Ancash', 'Mariscal Luzuriaga', 'Musga', NULL, NULL, NULL),
(189, 'Ancash', 'Ocros', 'Ocros', NULL, NULL, NULL),
(190, 'Ancash', 'Ocros', 'Acas', NULL, NULL, NULL),
(191, 'Ancash', 'Ocros', 'Cajamarquilla', NULL, NULL, NULL),
(192, 'Ancash', 'Ocros', 'Carhuapampa', NULL, NULL, NULL),
(193, 'Ancash', 'Ocros', 'Cochas', NULL, NULL, NULL),
(194, 'Ancash', 'Ocros', 'Congas', NULL, NULL, NULL),
(195, 'Ancash', 'Ocros', 'Llipa', NULL, NULL, NULL),
(196, 'Ancash', 'Ocros', 'San Cristobal de Rajan', NULL, NULL, NULL),
(197, 'Ancash', 'Ocros', 'San Pedro', NULL, NULL, NULL),
(198, 'Ancash', 'Ocros', 'Santiago de Chilcas', NULL, NULL, NULL),
(199, 'Ancash', 'Pallasca', 'Cabana', NULL, NULL, NULL),
(200, 'Ancash', 'Pallasca', 'Bolognesi', NULL, NULL, NULL),
(201, 'Ancash', 'Pallasca', 'Conchucos', NULL, NULL, NULL),
(202, 'Ancash', 'Pallasca', 'Huacaschuque', NULL, NULL, NULL),
(203, 'Ancash', 'Pallasca', 'Huandoval', NULL, NULL, NULL),
(204, 'Ancash', 'Pallasca', 'Lacabamba', NULL, NULL, NULL),
(205, 'Ancash', 'Pallasca', 'Llapo', NULL, NULL, NULL),
(206, 'Ancash', 'Pallasca', 'Pallasca', NULL, NULL, NULL),
(207, 'Ancash', 'Pallasca', 'Pampas', NULL, NULL, NULL),
(208, 'Ancash', 'Pallasca', 'Santa Rosa', NULL, NULL, NULL),
(209, 'Ancash', 'Pallasca', 'Tauca', NULL, NULL, NULL),
(210, 'Ancash', 'Pomabamba', 'Pomabamba', NULL, NULL, NULL),
(211, 'Ancash', 'Pomabamba', 'Huayllan', NULL, NULL, NULL),
(212, 'Ancash', 'Pomabamba', 'Parobamba', NULL, NULL, NULL),
(213, 'Ancash', 'Pomabamba', 'Quinuabamba', NULL, NULL, NULL),
(214, 'Ancash', 'Recuay', 'Recuay', NULL, NULL, NULL),
(215, 'Ancash', 'Recuay', 'Catac', NULL, NULL, NULL),
(216, 'Ancash', 'Recuay', 'Cotaparaco', NULL, NULL, NULL),
(217, 'Ancash', 'Recuay', 'Huayllapampa', NULL, NULL, NULL),
(218, 'Ancash', 'Recuay', 'Llacllin', NULL, NULL, NULL),
(219, 'Ancash', 'Recuay', 'Marca', NULL, NULL, NULL),
(220, 'Ancash', 'Recuay', 'Pampas Chico', NULL, NULL, NULL),
(221, 'Ancash', 'Recuay', 'Pararin', NULL, NULL, NULL),
(222, 'Ancash', 'Recuay', 'Tapacocha', NULL, NULL, NULL),
(223, 'Ancash', 'Recuay', 'Ticapampa', NULL, NULL, NULL),
(224, 'Ancash', 'Santa', 'Chimbote', NULL, NULL, NULL),
(225, 'Ancash', 'Santa', 'Caceres del Peru', NULL, NULL, NULL),
(226, 'Ancash', 'Santa', 'Coishco', NULL, NULL, NULL),
(227, 'Ancash', 'Santa', 'Macate', NULL, NULL, NULL),
(228, 'Ancash', 'Santa', 'Moro', NULL, NULL, NULL),
(229, 'Ancash', 'Santa', 'NepeÃ±a', NULL, NULL, NULL),
(230, 'Ancash', 'Santa', 'Samanco', NULL, NULL, NULL),
(231, 'Ancash', 'Santa', 'Santa', NULL, NULL, NULL),
(232, 'Ancash', 'Santa', 'Nuevo Chimbote', NULL, NULL, NULL),
(233, 'Ancash', 'Sihuas', 'Sihuas', NULL, NULL, NULL),
(234, 'Ancash', 'Sihuas', 'Acobamba', NULL, NULL, NULL),
(235, 'Ancash', 'Sihuas', 'Alfonso Ugarte', NULL, NULL, NULL),
(236, 'Ancash', 'Sihuas', 'Cashapampa', NULL, NULL, NULL),
(237, 'Ancash', 'Sihuas', 'Chingalpo', NULL, NULL, NULL),
(238, 'Ancash', 'Sihuas', 'Huayllabamba', NULL, NULL, NULL),
(239, 'Ancash', 'Sihuas', 'Quiches', NULL, NULL, NULL),
(240, 'Ancash', 'Sihuas', 'Ragash', NULL, NULL, NULL),
(241, 'Ancash', 'Sihuas', 'San Juan', NULL, NULL, NULL),
(242, 'Ancash', 'Sihuas', 'Sicsibamba', NULL, NULL, NULL),
(243, 'Ancash', 'Yungay', 'Yungay', NULL, NULL, NULL),
(244, 'Ancash', 'Yungay', 'Cascapara', NULL, NULL, NULL),
(245, 'Ancash', 'Yungay', 'Mancos', NULL, NULL, NULL),
(246, 'Ancash', 'Yungay', 'Matacoto', NULL, NULL, NULL),
(247, 'Ancash', 'Yungay', 'Quillo', NULL, NULL, NULL),
(248, 'Ancash', 'Yungay', 'Ranrahirca', NULL, NULL, NULL),
(249, 'Ancash', 'Yungay', 'Shupluy', NULL, NULL, NULL),
(250, 'Ancash', 'Yungay', 'Yanama', NULL, NULL, NULL),
(251, 'Apurimac', 'Abancay', 'Abancay', NULL, NULL, NULL),
(252, 'Apurimac', 'Abancay', 'Chacoche', NULL, NULL, NULL),
(253, 'Apurimac', 'Abancay', 'Circa', NULL, NULL, NULL),
(254, 'Apurimac', 'Abancay', 'Curahuasi', NULL, NULL, NULL),
(255, 'Apurimac', 'Abancay', 'Huanipaca', NULL, NULL, NULL),
(256, 'Apurimac', 'Abancay', 'Lambrama', NULL, NULL, NULL),
(257, 'Apurimac', 'Abancay', 'Pichirhua', NULL, NULL, NULL),
(258, 'Apurimac', 'Abancay', 'San Pedro de Cachora', NULL, NULL, NULL),
(259, 'Apurimac', 'Abancay', 'Tamburco', NULL, NULL, NULL),
(260, 'Apurimac', 'Andahuaylas', 'Andahuaylas', NULL, NULL, NULL),
(261, 'Apurimac', 'Andahuaylas', 'Andarapa', NULL, NULL, NULL),
(262, 'Apurimac', 'Andahuaylas', 'Chiara', NULL, NULL, NULL),
(263, 'Apurimac', 'Andahuaylas', 'Huancarama', NULL, NULL, NULL),
(264, 'Apurimac', 'Andahuaylas', 'Huancaray', NULL, NULL, NULL),
(265, 'Apurimac', 'Andahuaylas', 'Huayana', NULL, NULL, NULL),
(266, 'Apurimac', 'Andahuaylas', 'Kishuara', NULL, NULL, NULL),
(267, 'Apurimac', 'Andahuaylas', 'Pacobamba', NULL, NULL, NULL),
(268, 'Apurimac', 'Andahuaylas', 'Pacucha', NULL, NULL, NULL),
(269, 'Apurimac', 'Andahuaylas', 'Pampachiri', NULL, NULL, NULL),
(270, 'Apurimac', 'Andahuaylas', 'Pomacocha', NULL, NULL, NULL),
(271, 'Apurimac', 'Andahuaylas', 'San Antonio de Cachi', NULL, NULL, NULL),
(272, 'Apurimac', 'Andahuaylas', 'San Jeronimo', NULL, NULL, NULL),
(273, 'Apurimac', 'Andahuaylas', 'San Miguel de Chaccrampa', NULL, NULL, NULL),
(274, 'Apurimac', 'Andahuaylas', 'Santa Maria de Chicmo', NULL, NULL, NULL),
(275, 'Apurimac', 'Andahuaylas', 'Talavera', NULL, NULL, NULL),
(276, 'Apurimac', 'Andahuaylas', 'Tumay Huaraca', NULL, NULL, NULL),
(277, 'Apurimac', 'Andahuaylas', 'Turpo', NULL, NULL, NULL),
(278, 'Apurimac', 'Andahuaylas', 'Kaquiabamba', NULL, NULL, NULL),
(279, 'Apurimac', 'Andahuaylas', 'Jose Maria Arguedas', NULL, NULL, NULL),
(280, 'Apurimac', 'Antabamba', 'Antabamba', NULL, NULL, NULL),
(281, 'Apurimac', 'Antabamba', 'El Oro', NULL, NULL, NULL),
(282, 'Apurimac', 'Antabamba', 'Huaquirca', NULL, NULL, NULL),
(283, 'Apurimac', 'Antabamba', 'Juan Espinoza Medrano', NULL, NULL, NULL),
(284, 'Apurimac', 'Antabamba', 'Oropesa', NULL, NULL, NULL),
(285, 'Apurimac', 'Antabamba', 'Pachaconas', NULL, NULL, NULL),
(286, 'Apurimac', 'Antabamba', 'Sabaino', NULL, NULL, NULL),
(287, 'Apurimac', 'Aymaraes', 'Chalhuanca', NULL, NULL, NULL),
(288, 'Apurimac', 'Aymaraes', 'Capaya', NULL, NULL, NULL),
(289, 'Apurimac', 'Aymaraes', 'Caraybamba', NULL, NULL, NULL),
(290, 'Apurimac', 'Aymaraes', 'Chapimarca', NULL, NULL, NULL),
(291, 'Apurimac', 'Aymaraes', 'Colcabamba', NULL, NULL, NULL),
(292, 'Apurimac', 'Aymaraes', 'Cotaruse', NULL, NULL, NULL),
(293, 'Apurimac', 'Aymaraes', 'Ihuayllo', NULL, NULL, NULL),
(294, 'Apurimac', 'Aymaraes', 'Justo Apu Sahuaraura', NULL, NULL, NULL),
(295, 'Apurimac', 'Aymaraes', 'Lucre', NULL, NULL, NULL),
(296, 'Apurimac', 'Aymaraes', 'Pocohuanca', NULL, NULL, NULL),
(297, 'Apurimac', 'Aymaraes', 'San Juan de ChacÃ±a', NULL, NULL, NULL),
(298, 'Apurimac', 'Aymaraes', 'SaÃ±ayca', NULL, NULL, NULL),
(299, 'Apurimac', 'Aymaraes', 'Soraya', NULL, NULL, NULL),
(300, 'Apurimac', 'Aymaraes', 'Tapairihua', NULL, NULL, NULL),
(301, 'Apurimac', 'Aymaraes', 'Tintay', NULL, NULL, NULL),
(302, 'Apurimac', 'Aymaraes', 'Toraya', NULL, NULL, NULL),
(303, 'Apurimac', 'Aymaraes', 'Yanaca', NULL, NULL, NULL),
(304, 'Apurimac', 'Cotabambas', 'Tambobamba', NULL, NULL, NULL),
(305, 'Apurimac', 'Cotabambas', 'Cotabambas', NULL, NULL, NULL),
(306, 'Apurimac', 'Cotabambas', 'Coyllurqui', NULL, NULL, NULL),
(307, 'Apurimac', 'Cotabambas', 'Haquira', NULL, NULL, NULL),
(308, 'Apurimac', 'Cotabambas', 'Mara', NULL, NULL, NULL),
(309, 'Apurimac', 'Cotabambas', 'Challhuahuacho', NULL, NULL, NULL),
(310, 'Apurimac', 'Chincheros', 'Chincheros', NULL, NULL, NULL),
(311, 'Apurimac', 'Chincheros', 'Anco_Huallo', NULL, NULL, NULL),
(312, 'Apurimac', 'Chincheros', 'Cocharcas', NULL, NULL, NULL),
(313, 'Apurimac', 'Chincheros', 'Huaccana', NULL, NULL, NULL),
(314, 'Apurimac', 'Chincheros', 'Ocobamba', NULL, NULL, NULL),
(315, 'Apurimac', 'Chincheros', 'Ongoy', NULL, NULL, NULL),
(316, 'Apurimac', 'Chincheros', 'Uranmarca', NULL, NULL, NULL),
(317, 'Apurimac', 'Chincheros', 'Ranracancha', NULL, NULL, NULL),
(318, 'Apurimac', 'Chincheros', 'Rocchacc', NULL, NULL, NULL),
(319, 'Apurimac', 'Chincheros', 'El Porvenir', NULL, NULL, NULL),
(320, 'Apurimac', 'Chincheros', 'Los Chankas', NULL, NULL, NULL),
(321, 'Apurimac', 'Grau', 'Chuquibambilla', NULL, NULL, NULL),
(322, 'Apurimac', 'Grau', 'Curpahuasi', NULL, NULL, NULL),
(323, 'Apurimac', 'Grau', 'Gamarra', NULL, NULL, NULL),
(324, 'Apurimac', 'Grau', 'Huayllati', NULL, NULL, NULL),
(325, 'Apurimac', 'Grau', 'Mamara', NULL, NULL, NULL),
(326, 'Apurimac', 'Grau', 'Micaela Bastidas', NULL, NULL, NULL),
(327, 'Apurimac', 'Grau', 'Pataypampa', NULL, NULL, NULL),
(328, 'Apurimac', 'Grau', 'Progreso', NULL, NULL, NULL),
(329, 'Apurimac', 'Grau', 'San Antonio', NULL, NULL, NULL),
(330, 'Apurimac', 'Grau', 'Santa Rosa', NULL, NULL, NULL),
(331, 'Apurimac', 'Grau', 'Turpay', NULL, NULL, NULL),
(332, 'Apurimac', 'Grau', 'Vilcabamba', NULL, NULL, NULL),
(333, 'Apurimac', 'Grau', 'Virundo', NULL, NULL, NULL),
(334, 'Apurimac', 'Grau', 'Curasco', NULL, NULL, NULL),
(335, 'Arequipa', 'Arequipa', 'Arequipa', NULL, NULL, NULL),
(336, 'Arequipa', 'Arequipa', 'Alto Selva Alegre', NULL, NULL, NULL),
(337, 'Arequipa', 'Arequipa', 'Cayma', NULL, NULL, NULL),
(338, 'Arequipa', 'Arequipa', 'Cerro Colorado', NULL, NULL, NULL),
(339, 'Arequipa', 'Arequipa', 'Characato', NULL, NULL, NULL),
(340, 'Arequipa', 'Arequipa', 'Chiguata', NULL, NULL, NULL),
(341, 'Arequipa', 'Arequipa', 'Jacobo Hunter', NULL, NULL, NULL),
(342, 'Arequipa', 'Arequipa', 'La Joya', NULL, NULL, NULL),
(343, 'Arequipa', 'Arequipa', 'Mariano Melgar', NULL, NULL, NULL),
(344, 'Arequipa', 'Arequipa', 'Miraflores', NULL, NULL, NULL),
(345, 'Arequipa', 'Arequipa', 'Mollebaya', NULL, NULL, NULL),
(346, 'Arequipa', 'Arequipa', 'Paucarpata', NULL, NULL, NULL),
(347, 'Arequipa', 'Arequipa', 'Pocsi', NULL, NULL, NULL),
(348, 'Arequipa', 'Arequipa', 'Polobaya', NULL, NULL, NULL),
(349, 'Arequipa', 'Arequipa', 'QuequeÃ±a', NULL, NULL, NULL),
(350, 'Arequipa', 'Arequipa', 'Sabandia', NULL, NULL, NULL),
(351, 'Arequipa', 'Arequipa', 'Sachaca', NULL, NULL, NULL),
(352, 'Arequipa', 'Arequipa', 'San Juan de Siguas', NULL, NULL, NULL),
(353, 'Arequipa', 'Arequipa', 'San Juan de Tarucani', NULL, NULL, NULL),
(354, 'Arequipa', 'Arequipa', 'Santa Isabel de Siguas', NULL, NULL, NULL),
(355, 'Arequipa', 'Arequipa', 'Santa Rita de Siguas', NULL, NULL, NULL),
(356, 'Arequipa', 'Arequipa', 'Socabaya', NULL, NULL, NULL),
(357, 'Arequipa', 'Arequipa', 'Tiabaya', NULL, NULL, NULL),
(358, 'Arequipa', 'Arequipa', 'Uchumayo', NULL, NULL, NULL),
(359, 'Arequipa', 'Arequipa', 'Vitor', NULL, NULL, NULL),
(360, 'Arequipa', 'Arequipa', 'Yanahuara', NULL, NULL, NULL),
(361, 'Arequipa', 'Arequipa', 'Yarabamba', NULL, NULL, NULL),
(362, 'Arequipa', 'Arequipa', 'Yura', NULL, NULL, NULL),
(363, 'Arequipa', 'Arequipa', 'Jose Luis Bustamante Y Rivero', NULL, NULL, NULL),
(364, 'Arequipa', 'Camana', 'Camana', NULL, NULL, NULL),
(365, 'Arequipa', 'Camana', 'Jose Maria Quimper', NULL, NULL, NULL),
(366, 'Arequipa', 'Camana', 'Mariano Nicolas Valcarcel', NULL, NULL, NULL),
(367, 'Arequipa', 'Camana', 'Mariscal Caceres', NULL, NULL, NULL),
(368, 'Arequipa', 'Camana', 'Nicolas de Pierola', NULL, NULL, NULL),
(369, 'Arequipa', 'Camana', 'OcoÃ±a', NULL, NULL, NULL),
(370, 'Arequipa', 'Camana', 'Quilca', NULL, NULL, NULL),
(371, 'Arequipa', 'Camana', 'Samuel Pastor', NULL, NULL, NULL),
(372, 'Arequipa', 'Caraveli', 'Caraveli', NULL, NULL, NULL),
(373, 'Arequipa', 'Caraveli', 'Acari', NULL, NULL, NULL),
(374, 'Arequipa', 'Caraveli', 'Atico', NULL, NULL, NULL),
(375, 'Arequipa', 'Caraveli', 'Atiquipa', NULL, NULL, NULL),
(376, 'Arequipa', 'Caraveli', 'Bella Union', NULL, NULL, NULL),
(377, 'Arequipa', 'Caraveli', 'Cahuacho', NULL, NULL, NULL),
(378, 'Arequipa', 'Caraveli', 'Chala', NULL, NULL, NULL),
(379, 'Arequipa', 'Caraveli', 'Chaparra', NULL, NULL, NULL),
(380, 'Arequipa', 'Caraveli', 'Huanuhuanu', NULL, NULL, NULL),
(381, 'Arequipa', 'Caraveli', 'Jaqui', NULL, NULL, NULL),
(382, 'Arequipa', 'Caraveli', 'Lomas', NULL, NULL, NULL),
(383, 'Arequipa', 'Caraveli', 'Quicacha', NULL, NULL, NULL),
(384, 'Arequipa', 'Caraveli', 'Yauca', NULL, NULL, NULL),
(385, 'Arequipa', 'Castilla', 'Aplao', NULL, NULL, NULL),
(386, 'Arequipa', 'Castilla', 'Andagua', NULL, NULL, NULL),
(387, 'Arequipa', 'Castilla', 'Ayo', NULL, NULL, NULL),
(388, 'Arequipa', 'Castilla', 'Chachas', NULL, NULL, NULL),
(389, 'Arequipa', 'Castilla', 'Chilcaymarca', NULL, NULL, NULL),
(390, 'Arequipa', 'Castilla', 'Choco', NULL, NULL, NULL),
(391, 'Arequipa', 'Castilla', 'Huancarqui', NULL, NULL, NULL),
(392, 'Arequipa', 'Castilla', 'Machaguay', NULL, NULL, NULL),
(393, 'Arequipa', 'Castilla', 'Orcopampa', NULL, NULL, NULL),
(394, 'Arequipa', 'Castilla', 'Pampacolca', NULL, NULL, NULL),
(395, 'Arequipa', 'Castilla', 'Tipan', NULL, NULL, NULL),
(396, 'Arequipa', 'Castilla', 'UÃ±on', NULL, NULL, NULL),
(397, 'Arequipa', 'Castilla', 'Uraca', NULL, NULL, NULL),
(398, 'Arequipa', 'Castilla', 'Viraco', NULL, NULL, NULL),
(399, 'Arequipa', 'Caylloma', 'Chivay', NULL, NULL, NULL),
(400, 'Arequipa', 'Caylloma', 'Achoma', NULL, NULL, NULL),
(401, 'Arequipa', 'Caylloma', 'Cabanaconde', NULL, NULL, NULL),
(402, 'Arequipa', 'Caylloma', 'Callalli', NULL, NULL, NULL),
(403, 'Arequipa', 'Caylloma', 'Caylloma', NULL, NULL, NULL),
(404, 'Arequipa', 'Caylloma', 'Coporaque', NULL, NULL, NULL),
(405, 'Arequipa', 'Caylloma', 'Huambo', NULL, NULL, NULL),
(406, 'Arequipa', 'Caylloma', 'Huanca', NULL, NULL, NULL),
(407, 'Arequipa', 'Caylloma', 'Ichupampa', NULL, NULL, NULL),
(408, 'Arequipa', 'Caylloma', 'Lari', NULL, NULL, NULL),
(409, 'Arequipa', 'Caylloma', 'Lluta', NULL, NULL, NULL),
(410, 'Arequipa', 'Caylloma', 'Maca', NULL, NULL, NULL),
(411, 'Arequipa', 'Caylloma', 'Madrigal', NULL, NULL, NULL),
(412, 'Arequipa', 'Caylloma', 'San Antonio de Chuca', NULL, NULL, NULL),
(413, 'Arequipa', 'Caylloma', 'Sibayo', NULL, NULL, NULL),
(414, 'Arequipa', 'Caylloma', 'Tapay', NULL, NULL, NULL),
(415, 'Arequipa', 'Caylloma', 'Tisco', NULL, NULL, NULL),
(416, 'Arequipa', 'Caylloma', 'Tuti', NULL, NULL, NULL),
(417, 'Arequipa', 'Caylloma', 'Yanque', NULL, NULL, NULL),
(418, 'Arequipa', 'Caylloma', 'Majes', NULL, NULL, NULL),
(419, 'Arequipa', 'Condesuyos', 'Chuquibamba', NULL, NULL, NULL),
(420, 'Arequipa', 'Condesuyos', 'Andaray', NULL, NULL, NULL),
(421, 'Arequipa', 'Condesuyos', 'Cayarani', NULL, NULL, NULL),
(422, 'Arequipa', 'Condesuyos', 'Chichas', NULL, NULL, NULL),
(423, 'Arequipa', 'Condesuyos', 'Iray', NULL, NULL, NULL),
(424, 'Arequipa', 'Condesuyos', 'Rio Grande', NULL, NULL, NULL),
(425, 'Arequipa', 'Condesuyos', 'Salamanca', NULL, NULL, NULL),
(426, 'Arequipa', 'Condesuyos', 'Yanaquihua', NULL, NULL, NULL),
(427, 'Arequipa', 'Islay', 'Mollendo', NULL, NULL, NULL),
(428, 'Arequipa', 'Islay', 'Cocachacra', NULL, NULL, NULL),
(429, 'Arequipa', 'Islay', 'Dean Valdivia', NULL, NULL, NULL),
(430, 'Arequipa', 'Islay', 'Islay', NULL, NULL, NULL),
(431, 'Arequipa', 'Islay', 'Mejia', NULL, NULL, NULL),
(432, 'Arequipa', 'Islay', 'Punta de Bombon', NULL, NULL, NULL),
(433, 'Arequipa', 'La UniÃ²n', 'Cotahuasi', NULL, NULL, NULL),
(434, 'Arequipa', 'La UniÃ²n', 'Alca', NULL, NULL, NULL),
(435, 'Arequipa', 'La UniÃ²n', 'Charcana', NULL, NULL, NULL),
(436, 'Arequipa', 'La UniÃ²n', 'Huaynacotas', NULL, NULL, NULL),
(437, 'Arequipa', 'La UniÃ²n', 'Pampamarca', NULL, NULL, NULL),
(438, 'Arequipa', 'La UniÃ²n', 'Puyca', NULL, NULL, NULL),
(439, 'Arequipa', 'La UniÃ²n', 'Quechualla', NULL, NULL, NULL),
(440, 'Arequipa', 'La UniÃ²n', 'Sayla', NULL, NULL, NULL),
(441, 'Arequipa', 'La UniÃ²n', 'Tauria', NULL, NULL, NULL),
(442, 'Arequipa', 'La UniÃ²n', 'Tomepampa', NULL, NULL, NULL),
(443, 'Arequipa', 'La UniÃ²n', 'Toro', NULL, NULL, NULL),
(444, 'Ayacucho', 'Huamanga', 'Ayacucho', NULL, NULL, NULL),
(445, 'Ayacucho', 'Huamanga', 'Acocro', NULL, NULL, NULL),
(446, 'Ayacucho', 'Huamanga', 'Acos Vinchos', NULL, NULL, NULL),
(447, 'Ayacucho', 'Huamanga', 'Carmen Alto', NULL, NULL, NULL),
(448, 'Ayacucho', 'Huamanga', 'Chiara', NULL, NULL, NULL),
(449, 'Ayacucho', 'Huamanga', 'Ocros', NULL, NULL, NULL),
(450, 'Ayacucho', 'Huamanga', 'Pacaycasa', NULL, NULL, NULL),
(451, 'Ayacucho', 'Huamanga', 'Quinua', NULL, NULL, NULL),
(452, 'Ayacucho', 'Huamanga', 'San Jose de Ticllas', NULL, NULL, NULL),
(453, 'Ayacucho', 'Huamanga', 'San Juan Bautista', NULL, NULL, NULL),
(454, 'Ayacucho', 'Huamanga', 'Santiago de Pischa', NULL, NULL, NULL),
(455, 'Ayacucho', 'Huamanga', 'Socos', NULL, NULL, NULL),
(456, 'Ayacucho', 'Huamanga', 'Tambillo', NULL, NULL, NULL),
(457, 'Ayacucho', 'Huamanga', 'Vinchos', NULL, NULL, NULL),
(458, 'Ayacucho', 'Huamanga', 'Jesus Nazareno', NULL, NULL, NULL),
(459, 'Ayacucho', 'Huamanga', 'Andres Avelino Caceres Dorregaray', NULL, NULL, NULL),
(460, 'Ayacucho', 'Cangallo', 'Cangallo', NULL, NULL, NULL),
(461, 'Ayacucho', 'Cangallo', 'Chuschi', NULL, NULL, NULL),
(462, 'Ayacucho', 'Cangallo', 'Los Morochucos', NULL, NULL, NULL),
(463, 'Ayacucho', 'Cangallo', 'Maria Parado de Bellido', NULL, NULL, NULL),
(464, 'Ayacucho', 'Cangallo', 'Paras', NULL, NULL, NULL),
(465, 'Ayacucho', 'Cangallo', 'Totos', NULL, NULL, NULL),
(466, 'Ayacucho', 'Huanca Sancos', 'Sancos', NULL, NULL, NULL),
(467, 'Ayacucho', 'Huanca Sancos', 'Carapo', NULL, NULL, NULL),
(468, 'Ayacucho', 'Huanca Sancos', 'Sacsamarca', NULL, NULL, NULL),
(469, 'Ayacucho', 'Huanca Sancos', 'Santiago de Lucanamarca', NULL, NULL, NULL),
(470, 'Ayacucho', 'Huanta', 'Huanta', NULL, NULL, NULL),
(471, 'Ayacucho', 'Huanta', 'Ayahuanco', NULL, NULL, NULL),
(472, 'Ayacucho', 'Huanta', 'Huamanguilla', NULL, NULL, NULL),
(473, 'Ayacucho', 'Huanta', 'Iguain', NULL, NULL, NULL),
(474, 'Ayacucho', 'Huanta', 'Luricocha', NULL, NULL, NULL),
(475, 'Ayacucho', 'Huanta', 'Santillana', NULL, NULL, NULL),
(476, 'Ayacucho', 'Huanta', 'Sivia', NULL, NULL, NULL),
(477, 'Ayacucho', 'Huanta', 'Llochegua', NULL, NULL, NULL),
(478, 'Ayacucho', 'Huanta', 'Canayre', NULL, NULL, NULL),
(479, 'Ayacucho', 'Huanta', 'Uchuraccay', NULL, NULL, NULL),
(480, 'Ayacucho', 'Huanta', 'Pucacolpa', NULL, NULL, NULL),
(481, 'Ayacucho', 'Huanta', 'Chaca', NULL, NULL, NULL),
(482, 'Ayacucho', 'La Mar', 'San Miguel', NULL, NULL, NULL),
(483, 'Ayacucho', 'La Mar', 'Anco', NULL, NULL, NULL),
(484, 'Ayacucho', 'La Mar', 'Ayna', NULL, NULL, NULL),
(485, 'Ayacucho', 'La Mar', 'Chilcas', NULL, NULL, NULL),
(486, 'Ayacucho', 'La Mar', 'Chungui', NULL, NULL, NULL),
(487, 'Ayacucho', 'La Mar', 'Luis Carranza', NULL, NULL, NULL),
(488, 'Ayacucho', 'La Mar', 'Santa Rosa', NULL, NULL, NULL),
(489, 'Ayacucho', 'La Mar', 'Tambo', NULL, NULL, NULL),
(490, 'Ayacucho', 'La Mar', 'Samugari', NULL, NULL, NULL),
(491, 'Ayacucho', 'La Mar', 'Anchihuay', NULL, NULL, NULL),
(492, 'Ayacucho', 'La Mar', 'Oronccoy', NULL, NULL, NULL),
(493, 'Ayacucho', 'Lucanas', 'Puquio', NULL, NULL, NULL),
(494, 'Ayacucho', 'Lucanas', 'Aucara', NULL, NULL, NULL),
(495, 'Ayacucho', 'Lucanas', 'Cabana', NULL, NULL, NULL),
(496, 'Ayacucho', 'Lucanas', 'Carmen Salcedo', NULL, NULL, NULL),
(497, 'Ayacucho', 'Lucanas', 'ChaviÃ±a', NULL, NULL, NULL),
(498, 'Ayacucho', 'Lucanas', 'Chipao', NULL, NULL, NULL),
(499, 'Ayacucho', 'Lucanas', 'Huac-Huas', NULL, NULL, NULL),
(500, 'Ayacucho', 'Lucanas', 'Laramate', NULL, NULL, NULL),
(501, 'Ayacucho', 'Lucanas', 'Leoncio Prado', NULL, NULL, NULL),
(502, 'Ayacucho', 'Lucanas', 'Llauta', NULL, NULL, NULL),
(503, 'Ayacucho', 'Lucanas', 'Lucanas', NULL, NULL, NULL),
(504, 'Ayacucho', 'Lucanas', 'OcaÃ±a', NULL, NULL, NULL),
(505, 'Ayacucho', 'Lucanas', 'Otoca', NULL, NULL, NULL),
(506, 'Ayacucho', 'Lucanas', 'Saisa', NULL, NULL, NULL),
(507, 'Ayacucho', 'Lucanas', 'San Cristobal', NULL, NULL, NULL),
(508, 'Ayacucho', 'Lucanas', 'San Juan', NULL, NULL, NULL),
(509, 'Ayacucho', 'Lucanas', 'San Pedro', NULL, NULL, NULL),
(510, 'Ayacucho', 'Lucanas', 'San Pedro de Palco', NULL, NULL, NULL),
(511, 'Ayacucho', 'Lucanas', 'Sancos', NULL, NULL, NULL),
(512, 'Ayacucho', 'Lucanas', 'Santa Ana de Huaycahuacho', NULL, NULL, NULL),
(513, 'Ayacucho', 'Lucanas', 'Santa Lucia', NULL, NULL, NULL),
(514, 'Ayacucho', 'Parinacochas', 'Coracora', NULL, NULL, NULL),
(515, 'Ayacucho', 'Parinacochas', 'Chumpi', NULL, NULL, NULL),
(516, 'Ayacucho', 'Parinacochas', 'Coronel CastaÃ±eda', NULL, NULL, NULL),
(517, 'Ayacucho', 'Parinacochas', 'Pacapausa', NULL, NULL, NULL),
(518, 'Ayacucho', 'Parinacochas', 'Pullo', NULL, NULL, NULL),
(519, 'Ayacucho', 'Parinacochas', 'Puyusca', NULL, NULL, NULL),
(520, 'Ayacucho', 'Parinacochas', 'San Francisco de Ravacayco', NULL, NULL, NULL),
(521, 'Ayacucho', 'Parinacochas', 'Upahuacho', NULL, NULL, NULL),
(522, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Pausa', NULL, NULL, NULL),
(523, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Colta', NULL, NULL, NULL),
(524, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Corculla', NULL, NULL, NULL),
(525, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Lampa', NULL, NULL, NULL),
(526, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Marcabamba', NULL, NULL, NULL),
(527, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Oyolo', NULL, NULL, NULL),
(528, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Pararca', NULL, NULL, NULL),
(529, 'Ayacucho', 'PÃ ucar del Sara Sara', 'San Javier de Alpabamba', NULL, NULL, NULL),
(530, 'Ayacucho', 'PÃ ucar del Sara Sara', 'San Jose de Ushua', NULL, NULL, NULL),
(531, 'Ayacucho', 'PÃ ucar del Sara Sara', 'Sara Sara', NULL, NULL, NULL),
(532, 'Ayacucho', 'Sucre', 'Querobamba', NULL, NULL, NULL),
(533, 'Ayacucho', 'Sucre', 'Belen', NULL, NULL, NULL),
(534, 'Ayacucho', 'Sucre', 'Chalcos', NULL, NULL, NULL),
(535, 'Ayacucho', 'Sucre', 'Chilcayoc', NULL, NULL, NULL),
(536, 'Ayacucho', 'Sucre', 'HuacaÃ±a', NULL, NULL, NULL),
(537, 'Ayacucho', 'Sucre', 'Morcolla', NULL, NULL, NULL),
(538, 'Ayacucho', 'Sucre', 'Paico', NULL, NULL, NULL),
(539, 'Ayacucho', 'Sucre', 'San Pedro de Larcay', NULL, NULL, NULL),
(540, 'Ayacucho', 'Sucre', 'San Salvador de Quije', NULL, NULL, NULL),
(541, 'Ayacucho', 'Sucre', 'Santiago de Paucaray', NULL, NULL, NULL),
(542, 'Ayacucho', 'Sucre', 'Soras', NULL, NULL, NULL),
(543, 'Ayacucho', 'Victor Fajardo', 'Huancapi', NULL, NULL, NULL),
(544, 'Ayacucho', 'Victor Fajardo', 'Alcamenca', NULL, NULL, NULL),
(545, 'Ayacucho', 'Victor Fajardo', 'Apongo', NULL, NULL, NULL),
(546, 'Ayacucho', 'Victor Fajardo', 'Asquipata', NULL, NULL, NULL),
(547, 'Ayacucho', 'Victor Fajardo', 'Canaria', NULL, NULL, NULL),
(548, 'Ayacucho', 'Victor Fajardo', 'Cayara', NULL, NULL, NULL),
(549, 'Ayacucho', 'Victor Fajardo', 'Colca', NULL, NULL, NULL),
(550, 'Ayacucho', 'Victor Fajardo', 'Huamanquiquia', NULL, NULL, NULL),
(551, 'Ayacucho', 'Victor Fajardo', 'Huancaraylla', NULL, NULL, NULL),
(552, 'Ayacucho', 'Victor Fajardo', 'Hualla', NULL, NULL, NULL),
(553, 'Ayacucho', 'Victor Fajardo', 'Sarhua', NULL, NULL, NULL),
(554, 'Ayacucho', 'Victor Fajardo', 'Vilcanchos', NULL, NULL, NULL),
(555, 'Ayacucho', 'Vilcas Huaman', 'Vilcas Huaman', NULL, NULL, NULL),
(556, 'Ayacucho', 'Vilcas Huaman', 'Accomarca', NULL, NULL, NULL),
(557, 'Ayacucho', 'Vilcas Huaman', 'Carhuanca', NULL, NULL, NULL),
(558, 'Ayacucho', 'Vilcas Huaman', 'Concepcion', NULL, NULL, NULL),
(559, 'Ayacucho', 'Vilcas Huaman', 'Huambalpa', NULL, NULL, NULL),
(560, 'Ayacucho', 'Vilcas Huaman', 'Independencia', NULL, NULL, NULL),
(561, 'Ayacucho', 'Vilcas Huaman', 'Saurama', NULL, NULL, NULL),
(562, 'Ayacucho', 'Vilcas Huaman', 'Vischongo', NULL, NULL, NULL),
(563, 'Cajamarca', 'Cajamarca', 'Cajamarca', NULL, NULL, NULL),
(564, 'Cajamarca', 'Cajamarca', 'Asuncion', NULL, NULL, NULL),
(565, 'Cajamarca', 'Cajamarca', 'Chetilla', NULL, NULL, NULL),
(566, 'Cajamarca', 'Cajamarca', 'Cospan', NULL, NULL, NULL),
(567, 'Cajamarca', 'Cajamarca', 'EncaÃ±ada', NULL, NULL, NULL),
(568, 'Cajamarca', 'Cajamarca', 'Jesus', NULL, NULL, NULL),
(569, 'Cajamarca', 'Cajamarca', 'Llacanora', NULL, NULL, NULL),
(570, 'Cajamarca', 'Cajamarca', 'Los BaÃ±os del Inca', NULL, NULL, NULL),
(571, 'Cajamarca', 'Cajamarca', 'Magdalena', NULL, NULL, NULL),
(572, 'Cajamarca', 'Cajamarca', 'Matara', NULL, NULL, NULL),
(573, 'Cajamarca', 'Cajamarca', 'Namora', NULL, NULL, NULL),
(574, 'Cajamarca', 'Cajamarca', 'San Juan', NULL, NULL, NULL),
(575, 'Cajamarca', 'Cajabamba', 'Cajabamba', NULL, NULL, NULL),
(576, 'Cajamarca', 'Cajabamba', 'Cachachi', NULL, NULL, NULL),
(577, 'Cajamarca', 'Cajabamba', 'Condebamba', NULL, NULL, NULL),
(578, 'Cajamarca', 'Cajabamba', 'Sitacocha', NULL, NULL, NULL),
(579, 'Cajamarca', 'Celendin', 'Celendin', NULL, NULL, NULL),
(580, 'Cajamarca', 'Celendin', 'Chumuch', NULL, NULL, NULL),
(581, 'Cajamarca', 'Celendin', 'Cortegana', NULL, NULL, NULL),
(582, 'Cajamarca', 'Celendin', 'Huasmin', NULL, NULL, NULL),
(583, 'Cajamarca', 'Celendin', 'Jorge Chavez', NULL, NULL, NULL),
(584, 'Cajamarca', 'Celendin', 'Jose Galvez', NULL, NULL, NULL),
(585, 'Cajamarca', 'Celendin', 'Miguel Iglesias', NULL, NULL, NULL),
(586, 'Cajamarca', 'Celendin', 'Oxamarca', NULL, NULL, NULL),
(587, 'Cajamarca', 'Celendin', 'Sorochuco', NULL, NULL, NULL),
(588, 'Cajamarca', 'Celendin', 'Sucre', NULL, NULL, NULL),
(589, 'Cajamarca', 'Celendin', 'Utco', NULL, NULL, NULL),
(590, 'Cajamarca', 'Celendin', 'La Libertad de Pallan', NULL, NULL, NULL),
(591, 'Cajamarca', 'Chota', 'Chota', NULL, NULL, NULL),
(592, 'Cajamarca', 'Chota', 'Anguia', NULL, NULL, NULL),
(593, 'Cajamarca', 'Chota', 'Chadin', NULL, NULL, NULL),
(594, 'Cajamarca', 'Chota', 'Chiguirip', NULL, NULL, NULL),
(595, 'Cajamarca', 'Chota', 'Chimban', NULL, NULL, NULL),
(596, 'Cajamarca', 'Chota', 'Choropampa', NULL, NULL, NULL),
(597, 'Cajamarca', 'Chota', 'Cochabamba', NULL, NULL, NULL),
(598, 'Cajamarca', 'Chota', 'Conchan', NULL, NULL, NULL),
(599, 'Cajamarca', 'Chota', 'Huambos', NULL, NULL, NULL),
(600, 'Cajamarca', 'Chota', 'Lajas', NULL, NULL, NULL),
(601, 'Cajamarca', 'Chota', 'Llama', NULL, NULL, NULL),
(602, 'Cajamarca', 'Chota', 'Miracosta', NULL, NULL, NULL),
(603, 'Cajamarca', 'Chota', 'Paccha', NULL, NULL, NULL),
(604, 'Cajamarca', 'Chota', 'Pion', NULL, NULL, NULL),
(605, 'Cajamarca', 'Chota', 'Querocoto', NULL, NULL, NULL),
(606, 'Cajamarca', 'Chota', 'San Juan de Licupis', NULL, NULL, NULL),
(607, 'Cajamarca', 'Chota', 'Tacabamba', NULL, NULL, NULL),
(608, 'Cajamarca', 'Chota', 'Tocmoche', NULL, NULL, NULL),
(609, 'Cajamarca', 'Chota', 'Chalamarca', NULL, NULL, NULL),
(610, 'Cajamarca', 'Contumaza', 'Contumaza', NULL, NULL, NULL),
(611, 'Cajamarca', 'Contumaza', 'Chilete', NULL, NULL, NULL),
(612, 'Cajamarca', 'Contumaza', 'Cupisnique', NULL, NULL, NULL),
(613, 'Cajamarca', 'Contumaza', 'Guzmango', NULL, NULL, NULL),
(614, 'Cajamarca', 'Contumaza', 'San Benito', NULL, NULL, NULL),
(615, 'Cajamarca', 'Contumaza', 'Santa Cruz de Toledo', NULL, NULL, NULL),
(616, 'Cajamarca', 'Contumaza', 'Tantarica', NULL, NULL, NULL),
(617, 'Cajamarca', 'Contumaza', 'Yonan', NULL, NULL, NULL),
(618, 'Cajamarca', 'Cutervo', 'Cutervo', NULL, NULL, NULL),
(619, 'Cajamarca', 'Cutervo', 'Callayuc', NULL, NULL, NULL),
(620, 'Cajamarca', 'Cutervo', 'Choros', NULL, NULL, NULL),
(621, 'Cajamarca', 'Cutervo', 'Cujillo', NULL, NULL, NULL),
(622, 'Cajamarca', 'Cutervo', 'La Ramada', NULL, NULL, NULL),
(623, 'Cajamarca', 'Cutervo', 'Pimpingos', NULL, NULL, NULL),
(624, 'Cajamarca', 'Cutervo', 'Querocotillo', NULL, NULL, NULL),
(625, 'Cajamarca', 'Cutervo', 'San Andres de Cutervo', NULL, NULL, NULL),
(626, 'Cajamarca', 'Cutervo', 'San Juan de Cutervo', NULL, NULL, NULL),
(627, 'Cajamarca', 'Cutervo', 'San Luis de Lucma', NULL, NULL, NULL),
(628, 'Cajamarca', 'Cutervo', 'Santa Cruz', NULL, NULL, NULL),
(629, 'Cajamarca', 'Cutervo', 'Santo Domingo de la Capilla', NULL, NULL, NULL),
(630, 'Cajamarca', 'Cutervo', 'Santo Tomas', NULL, NULL, NULL),
(631, 'Cajamarca', 'Cutervo', 'Socota', NULL, NULL, NULL),
(632, 'Cajamarca', 'Cutervo', 'Toribio Casanova', NULL, NULL, NULL),
(633, 'Cajamarca', 'Hualgayoc', 'Bambamarca', NULL, NULL, NULL),
(634, 'Cajamarca', 'Hualgayoc', 'Chugur', NULL, NULL, NULL),
(635, 'Cajamarca', 'Hualgayoc', 'Hualgayoc', NULL, NULL, NULL),
(636, 'Cajamarca', 'Jaen', 'Jaen', NULL, NULL, NULL),
(637, 'Cajamarca', 'Jaen', 'Bellavista', NULL, NULL, NULL),
(638, 'Cajamarca', 'Jaen', 'Chontali', NULL, NULL, NULL),
(639, 'Cajamarca', 'Jaen', 'Colasay', NULL, NULL, NULL),
(640, 'Cajamarca', 'Jaen', 'Huabal', NULL, NULL, NULL),
(641, 'Cajamarca', 'Jaen', 'Las Pirias', NULL, NULL, NULL),
(642, 'Cajamarca', 'Jaen', 'Pomahuaca', NULL, NULL, NULL),
(643, 'Cajamarca', 'Jaen', 'Pucara', NULL, NULL, NULL),
(644, 'Cajamarca', 'Jaen', 'Sallique', NULL, NULL, NULL),
(645, 'Cajamarca', 'Jaen', 'San Felipe', NULL, NULL, NULL),
(646, 'Cajamarca', 'Jaen', 'San Jose del Alto', NULL, NULL, NULL),
(647, 'Cajamarca', 'Jaen', 'Santa Rosa', NULL, NULL, NULL),
(648, 'Cajamarca', 'San Ignacio', 'San Ignacio', NULL, NULL, NULL),
(649, 'Cajamarca', 'San Ignacio', 'Chirinos', NULL, NULL, NULL),
(650, 'Cajamarca', 'San Ignacio', 'Huarango', NULL, NULL, NULL),
(651, 'Cajamarca', 'San Ignacio', 'La Coipa', NULL, NULL, NULL),
(652, 'Cajamarca', 'San Ignacio', 'Namballe', NULL, NULL, NULL),
(653, 'Cajamarca', 'San Ignacio', 'San Jose de Lourdes', NULL, NULL, NULL),
(654, 'Cajamarca', 'San Ignacio', 'Tabaconas', NULL, NULL, NULL),
(655, 'Cajamarca', 'San Marcos', 'Pedro Galvez', NULL, NULL, NULL),
(656, 'Cajamarca', 'San Marcos', 'Chancay', NULL, NULL, NULL),
(657, 'Cajamarca', 'San Marcos', 'Eduardo Villanueva', NULL, NULL, NULL),
(658, 'Cajamarca', 'San Marcos', 'Gregorio Pita', NULL, NULL, NULL),
(659, 'Cajamarca', 'San Marcos', 'Ichocan', NULL, NULL, NULL),
(660, 'Cajamarca', 'San Marcos', 'Jose Manuel Quiroz', NULL, NULL, NULL),
(661, 'Cajamarca', 'San Marcos', 'Jose Sabogal', NULL, NULL, NULL),
(662, 'Cajamarca', 'San Miguel', 'San Miguel', NULL, NULL, NULL),
(663, 'Cajamarca', 'San Miguel', 'Bolivar', NULL, NULL, NULL),
(664, 'Cajamarca', 'San Miguel', 'Calquis', NULL, NULL, NULL),
(665, 'Cajamarca', 'San Miguel', 'Catilluc', NULL, NULL, NULL),
(666, 'Cajamarca', 'San Miguel', 'El Prado', NULL, NULL, NULL),
(667, 'Cajamarca', 'San Miguel', 'La Florida', NULL, NULL, NULL),
(668, 'Cajamarca', 'San Miguel', 'Llapa', NULL, NULL, NULL),
(669, 'Cajamarca', 'San Miguel', 'Nanchoc', NULL, NULL, NULL),
(670, 'Cajamarca', 'San Miguel', 'Niepos', NULL, NULL, NULL),
(671, 'Cajamarca', 'San Miguel', 'San Gregorio', NULL, NULL, NULL),
(672, 'Cajamarca', 'San Miguel', 'San Silvestre de Cochan', NULL, NULL, NULL),
(673, 'Cajamarca', 'San Miguel', 'Tongod', NULL, NULL, NULL),
(674, 'Cajamarca', 'San Miguel', 'Union Agua Blanca', NULL, NULL, NULL),
(675, 'Cajamarca', 'San Pablo', 'San Pablo', NULL, NULL, NULL),
(676, 'Cajamarca', 'San Pablo', 'San Bernardino', NULL, NULL, NULL),
(677, 'Cajamarca', 'San Pablo', 'San Luis', NULL, NULL, NULL),
(678, 'Cajamarca', 'San Pablo', 'Tumbaden', NULL, NULL, NULL),
(679, 'Cajamarca', 'Santa Cruz', 'Santa Cruz', NULL, NULL, NULL),
(680, 'Cajamarca', 'Santa Cruz', 'Andabamba', NULL, NULL, NULL),
(681, 'Cajamarca', 'Santa Cruz', 'Catache', NULL, NULL, NULL),
(682, 'Cajamarca', 'Santa Cruz', 'ChancaybaÃ±os', NULL, NULL, NULL),
(683, 'Cajamarca', 'Santa Cruz', 'La Esperanza', NULL, NULL, NULL),
(684, 'Cajamarca', 'Santa Cruz', 'Ninabamba', NULL, NULL, NULL),
(685, 'Cajamarca', 'Santa Cruz', 'Pulan', NULL, NULL, NULL),
(686, 'Cajamarca', 'Santa Cruz', 'Saucepampa', NULL, NULL, NULL),
(687, 'Cajamarca', 'Santa Cruz', 'Sexi', NULL, NULL, NULL),
(688, 'Cajamarca', 'Santa Cruz', 'Uticyacu', NULL, NULL, NULL),
(689, 'Cajamarca', 'Santa Cruz', 'Yauyucan', NULL, NULL, NULL),
(690, 'Callao', 'Prov. Const. del Callao', 'Callao', NULL, NULL, NULL),
(691, 'Callao', 'Prov. Const. del Callao', 'Bellavista', NULL, NULL, NULL),
(692, 'Callao', 'Prov. Const. del Callao', 'Carmen de la Legua Reynoso', NULL, NULL, NULL),
(693, 'Callao', 'Prov. Const. del Callao', 'La Perla', NULL, NULL, NULL),
(694, 'Callao', 'Prov. Const. del Callao', 'La Punta', NULL, NULL, NULL),
(695, 'Callao', 'Prov. Const. del Callao', 'Ventanilla', NULL, NULL, NULL),
(696, 'Callao', 'Prov. Const. del Callao', 'Mi Peru', NULL, NULL, NULL),
(697, 'Cusco', 'Cusco', 'Cusco', NULL, NULL, NULL),
(698, 'Cusco', 'Cusco', 'Ccorca', NULL, NULL, NULL),
(699, 'Cusco', 'Cusco', 'Poroy', NULL, NULL, NULL),
(700, 'Cusco', 'Cusco', 'San Jeronimo', NULL, NULL, NULL),
(701, 'Cusco', 'Cusco', 'San Sebastian', NULL, NULL, NULL),
(702, 'Cusco', 'Cusco', 'Santiago', NULL, NULL, NULL),
(703, 'Cusco', 'Cusco', 'Saylla', NULL, NULL, NULL),
(704, 'Cusco', 'Cusco', 'Wanchaq', NULL, NULL, NULL),
(705, 'Cusco', 'Acomayo', 'Acomayo', NULL, NULL, NULL),
(706, 'Cusco', 'Acomayo', 'Acopia', NULL, NULL, NULL),
(707, 'Cusco', 'Acomayo', 'Acos', NULL, NULL, NULL),
(708, 'Cusco', 'Acomayo', 'Mosoc Llacta', NULL, NULL, NULL),
(709, 'Cusco', 'Acomayo', 'Pomacanchi', NULL, NULL, NULL),
(710, 'Cusco', 'Acomayo', 'Rondocan', NULL, NULL, NULL),
(711, 'Cusco', 'Acomayo', 'Sangarara', NULL, NULL, NULL),
(712, 'Cusco', 'Anta', 'Anta', NULL, NULL, NULL),
(713, 'Cusco', 'Anta', 'Ancahuasi', NULL, NULL, NULL),
(714, 'Cusco', 'Anta', 'Cachimayo', NULL, NULL, NULL),
(715, 'Cusco', 'Anta', 'Chinchaypujio', NULL, NULL, NULL),
(716, 'Cusco', 'Anta', 'Huarocondo', NULL, NULL, NULL),
(717, 'Cusco', 'Anta', 'Limatambo', NULL, NULL, NULL),
(718, 'Cusco', 'Anta', 'Mollepata', NULL, NULL, NULL),
(719, 'Cusco', 'Anta', 'Pucyura', NULL, NULL, NULL),
(720, 'Cusco', 'Anta', 'Zurite', NULL, NULL, NULL),
(721, 'Cusco', 'Calca', 'Calca', NULL, NULL, NULL),
(722, 'Cusco', 'Calca', 'Coya', NULL, NULL, NULL),
(723, 'Cusco', 'Calca', 'Lamay', NULL, NULL, NULL),
(724, 'Cusco', 'Calca', 'Lares', NULL, NULL, NULL),
(725, 'Cusco', 'Calca', 'Pisac', NULL, NULL, NULL),
(726, 'Cusco', 'Calca', 'San Salvador', NULL, NULL, NULL),
(727, 'Cusco', 'Calca', 'Taray', NULL, NULL, NULL),
(728, 'Cusco', 'Calca', 'Yanatile', NULL, NULL, NULL),
(729, 'Cusco', 'Canas', 'Yanaoca', NULL, NULL, NULL),
(730, 'Cusco', 'Canas', 'Checca', NULL, NULL, NULL),
(731, 'Cusco', 'Canas', 'Kunturkanki', NULL, NULL, NULL),
(732, 'Cusco', 'Canas', 'Langui', NULL, NULL, NULL),
(733, 'Cusco', 'Canas', 'Layo', NULL, NULL, NULL),
(734, 'Cusco', 'Canas', 'Pampamarca', NULL, NULL, NULL),
(735, 'Cusco', 'Canas', 'Quehue', NULL, NULL, NULL),
(736, 'Cusco', 'Canas', 'Tupac Amaru', NULL, NULL, NULL),
(737, 'Cusco', 'Canchis', 'Sicuani', NULL, NULL, NULL),
(738, 'Cusco', 'Canchis', 'Checacupe', NULL, NULL, NULL),
(739, 'Cusco', 'Canchis', 'Combapata', NULL, NULL, NULL),
(740, 'Cusco', 'Canchis', 'Marangani', NULL, NULL, NULL),
(741, 'Cusco', 'Canchis', 'Pitumarca', NULL, NULL, NULL),
(742, 'Cusco', 'Canchis', 'San Pablo', NULL, NULL, NULL),
(743, 'Cusco', 'Canchis', 'San Pedro', NULL, NULL, NULL),
(744, 'Cusco', 'Canchis', 'Tinta', NULL, NULL, NULL),
(745, 'Cusco', 'Chumbivilcas', 'Santo Tomas', NULL, NULL, NULL),
(746, 'Cusco', 'Chumbivilcas', 'Capacmarca', NULL, NULL, NULL),
(747, 'Cusco', 'Chumbivilcas', 'Chamaca', NULL, NULL, NULL),
(748, 'Cusco', 'Chumbivilcas', 'Colquemarca', NULL, NULL, NULL),
(749, 'Cusco', 'Chumbivilcas', 'Livitaca', NULL, NULL, NULL),
(750, 'Cusco', 'Chumbivilcas', 'Llusco', NULL, NULL, NULL),
(751, 'Cusco', 'Chumbivilcas', 'QuiÃ±ota', NULL, NULL, NULL),
(752, 'Cusco', 'Chumbivilcas', 'Velille', NULL, NULL, NULL),
(753, 'Cusco', 'Espinar', 'Espinar', NULL, NULL, NULL),
(754, 'Cusco', 'Espinar', 'Condoroma', NULL, NULL, NULL),
(755, 'Cusco', 'Espinar', 'Coporaque', NULL, NULL, NULL),
(756, 'Cusco', 'Espinar', 'Ocoruro', NULL, NULL, NULL),
(757, 'Cusco', 'Espinar', 'Pallpata', NULL, NULL, NULL),
(758, 'Cusco', 'Espinar', 'Pichigua', NULL, NULL, NULL),
(759, 'Cusco', 'Espinar', 'Suyckutambo', NULL, NULL, NULL),
(760, 'Cusco', 'Espinar', 'Alto Pichigua', NULL, NULL, NULL),
(761, 'Cusco', 'La Convencion', 'Santa Ana', NULL, NULL, NULL),
(762, 'Cusco', 'La Convencion', 'Echarate', NULL, NULL, NULL),
(763, 'Cusco', 'La Convencion', 'Huayopata', NULL, NULL, NULL),
(764, 'Cusco', 'La Convencion', 'Maranura', NULL, NULL, NULL),
(765, 'Cusco', 'La Convencion', 'Ocobamba', NULL, NULL, NULL),
(766, 'Cusco', 'La Convencion', 'Quellouno', NULL, NULL, NULL),
(767, 'Cusco', 'La Convencion', 'Kimbiri', NULL, NULL, NULL),
(768, 'Cusco', 'La Convencion', 'Santa Teresa', NULL, NULL, NULL),
(769, 'Cusco', 'La Convencion', 'Vilcabamba', NULL, NULL, NULL),
(770, 'Cusco', 'La Convencion', 'Pichari', NULL, NULL, NULL),
(771, 'Cusco', 'La Convencion', 'Inkawasi', NULL, NULL, NULL),
(772, 'Cusco', 'La Convencion', 'Villa Virgen', NULL, NULL, NULL),
(773, 'Cusco', 'La Convencion', 'Villa Kintiarina', NULL, NULL, NULL),
(774, 'Cusco', 'La Convencion', 'Megantoni', NULL, NULL, NULL),
(775, 'Cusco', 'Paruro', 'Paruro', NULL, NULL, NULL),
(776, 'Cusco', 'Paruro', 'Accha', NULL, NULL, NULL),
(777, 'Cusco', 'Paruro', 'Ccapi', NULL, NULL, NULL),
(778, 'Cusco', 'Paruro', 'Colcha', NULL, NULL, NULL),
(779, 'Cusco', 'Paruro', 'Huanoquite', NULL, NULL, NULL),
(780, 'Cusco', 'Paruro', 'Omacha', NULL, NULL, NULL),
(781, 'Cusco', 'Paruro', 'Paccaritambo', NULL, NULL, NULL),
(782, 'Cusco', 'Paruro', 'Pillpinto', NULL, NULL, NULL),
(783, 'Cusco', 'Paruro', 'Yaurisque', NULL, NULL, NULL),
(784, 'Cusco', 'Paucartambo', 'Paucartambo', NULL, NULL, NULL),
(785, 'Cusco', 'Paucartambo', 'Caicay', NULL, NULL, NULL),
(786, 'Cusco', 'Paucartambo', 'Challabamba', NULL, NULL, NULL),
(787, 'Cusco', 'Paucartambo', 'Colquepata', NULL, NULL, NULL),
(788, 'Cusco', 'Paucartambo', 'Huancarani', NULL, NULL, NULL),
(789, 'Cusco', 'Paucartambo', 'KosÃ±ipata', NULL, NULL, NULL),
(790, 'Cusco', 'Quispicanchi', 'Urcos', NULL, NULL, NULL),
(791, 'Cusco', 'Quispicanchi', 'Andahuaylillas', NULL, NULL, NULL),
(792, 'Cusco', 'Quispicanchi', 'Camanti', NULL, NULL, NULL),
(793, 'Cusco', 'Quispicanchi', 'Ccarhuayo', NULL, NULL, NULL),
(794, 'Cusco', 'Quispicanchi', 'Ccatca', NULL, NULL, NULL),
(795, 'Cusco', 'Quispicanchi', 'Cusipata', NULL, NULL, NULL),
(796, 'Cusco', 'Quispicanchi', 'Huaro', NULL, NULL, NULL),
(797, 'Cusco', 'Quispicanchi', 'Lucre', NULL, NULL, NULL),
(798, 'Cusco', 'Quispicanchi', 'Marcapata', NULL, NULL, NULL),
(799, 'Cusco', 'Quispicanchi', 'Ocongate', NULL, NULL, NULL),
(800, 'Cusco', 'Quispicanchi', 'Oropesa', NULL, NULL, NULL),
(801, 'Cusco', 'Quispicanchi', 'Quiquijana', NULL, NULL, NULL),
(802, 'Cusco', 'Urubamba', 'Urubamba', NULL, NULL, NULL),
(803, 'Cusco', 'Urubamba', 'Chinchero', NULL, NULL, NULL),
(804, 'Cusco', 'Urubamba', 'Huayllabamba', NULL, NULL, NULL),
(805, 'Cusco', 'Urubamba', 'Machupicchu', NULL, NULL, NULL),
(806, 'Cusco', 'Urubamba', 'Maras', NULL, NULL, NULL),
(807, 'Cusco', 'Urubamba', 'Ollantaytambo', NULL, NULL, NULL),
(808, 'Cusco', 'Urubamba', 'Yucay', NULL, NULL, NULL),
(809, 'Huancavelica', 'Huancavelica', 'Huancavelica', NULL, NULL, NULL),
(810, 'Huancavelica', 'Huancavelica', 'Acobambilla', NULL, NULL, NULL),
(811, 'Huancavelica', 'Huancavelica', 'Acoria', NULL, NULL, NULL),
(812, 'Huancavelica', 'Huancavelica', 'Conayca', NULL, NULL, NULL),
(813, 'Huancavelica', 'Huancavelica', 'Cuenca', NULL, NULL, NULL),
(814, 'Huancavelica', 'Huancavelica', 'Huachocolpa', NULL, NULL, NULL),
(815, 'Huancavelica', 'Huancavelica', 'Huayllahuara', NULL, NULL, NULL),
(816, 'Huancavelica', 'Huancavelica', 'Izcuchaca', NULL, NULL, NULL),
(817, 'Huancavelica', 'Huancavelica', 'Laria', NULL, NULL, NULL),
(818, 'Huancavelica', 'Huancavelica', 'Manta', NULL, NULL, NULL),
(819, 'Huancavelica', 'Huancavelica', 'Mariscal Caceres', NULL, NULL, NULL),
(820, 'Huancavelica', 'Huancavelica', 'Moya', NULL, NULL, NULL),
(821, 'Huancavelica', 'Huancavelica', 'Nuevo Occoro', NULL, NULL, NULL),
(822, 'Huancavelica', 'Huancavelica', 'Palca', NULL, NULL, NULL),
(823, 'Huancavelica', 'Huancavelica', 'Pilchaca', NULL, NULL, NULL),
(824, 'Huancavelica', 'Huancavelica', 'Vilca', NULL, NULL, NULL),
(825, 'Huancavelica', 'Huancavelica', 'Yauli', NULL, NULL, NULL),
(826, 'Huancavelica', 'Huancavelica', 'Ascension', NULL, NULL, NULL),
(827, 'Huancavelica', 'Huancavelica', 'Huando', NULL, NULL, NULL),
(828, 'Huancavelica', 'Acobamba', 'Acobamba', NULL, NULL, NULL),
(829, 'Huancavelica', 'Acobamba', 'Andabamba', NULL, NULL, NULL),
(830, 'Huancavelica', 'Acobamba', 'Anta', NULL, NULL, NULL),
(831, 'Huancavelica', 'Acobamba', 'Caja', NULL, NULL, NULL),
(832, 'Huancavelica', 'Acobamba', 'Marcas', NULL, NULL, NULL),
(833, 'Huancavelica', 'Acobamba', 'Paucara', NULL, NULL, NULL);
INSERT INTO `ubigeos` (`id`, `department`, `province`, `district`, `created_at`, `updated_at`, `deleted_at`) VALUES
(834, 'Huancavelica', 'Acobamba', 'Pomacocha', NULL, NULL, NULL),
(835, 'Huancavelica', 'Acobamba', 'Rosario', NULL, NULL, NULL),
(836, 'Huancavelica', 'Angaraes', 'Lircay', NULL, NULL, NULL),
(837, 'Huancavelica', 'Angaraes', 'Anchonga', NULL, NULL, NULL),
(838, 'Huancavelica', 'Angaraes', 'Callanmarca', NULL, NULL, NULL),
(839, 'Huancavelica', 'Angaraes', 'Ccochaccasa', NULL, NULL, NULL),
(840, 'Huancavelica', 'Angaraes', 'Chincho', NULL, NULL, NULL),
(841, 'Huancavelica', 'Angaraes', 'Congalla', NULL, NULL, NULL),
(842, 'Huancavelica', 'Angaraes', 'Huanca-Huanca', NULL, NULL, NULL),
(843, 'Huancavelica', 'Angaraes', 'Huayllay Grande', NULL, NULL, NULL),
(844, 'Huancavelica', 'Angaraes', 'Julcamarca', NULL, NULL, NULL),
(845, 'Huancavelica', 'Angaraes', 'San Antonio de Antaparco', NULL, NULL, NULL),
(846, 'Huancavelica', 'Angaraes', 'Santo Tomas de Pata', NULL, NULL, NULL),
(847, 'Huancavelica', 'Angaraes', 'Secclla', NULL, NULL, NULL),
(848, 'Huancavelica', 'Castrovirreyna', 'Castrovirreyna', NULL, NULL, NULL),
(849, 'Huancavelica', 'Castrovirreyna', 'Arma', NULL, NULL, NULL),
(850, 'Huancavelica', 'Castrovirreyna', 'Aurahua', NULL, NULL, NULL),
(851, 'Huancavelica', 'Castrovirreyna', 'Capillas', NULL, NULL, NULL),
(852, 'Huancavelica', 'Castrovirreyna', 'Chupamarca', NULL, NULL, NULL),
(853, 'Huancavelica', 'Castrovirreyna', 'Cocas', NULL, NULL, NULL),
(854, 'Huancavelica', 'Castrovirreyna', 'Huachos', NULL, NULL, NULL),
(855, 'Huancavelica', 'Castrovirreyna', 'Huamatambo', NULL, NULL, NULL),
(856, 'Huancavelica', 'Castrovirreyna', 'Mollepampa', NULL, NULL, NULL),
(857, 'Huancavelica', 'Castrovirreyna', 'San Juan', NULL, NULL, NULL),
(858, 'Huancavelica', 'Castrovirreyna', 'Santa Ana', NULL, NULL, NULL),
(859, 'Huancavelica', 'Castrovirreyna', 'Tantara', NULL, NULL, NULL),
(860, 'Huancavelica', 'Castrovirreyna', 'Ticrapo', NULL, NULL, NULL),
(861, 'Huancavelica', 'Churcampa', 'Churcampa', NULL, NULL, NULL),
(862, 'Huancavelica', 'Churcampa', 'Anco', NULL, NULL, NULL),
(863, 'Huancavelica', 'Churcampa', 'Chinchihuasi', NULL, NULL, NULL),
(864, 'Huancavelica', 'Churcampa', 'El Carmen', NULL, NULL, NULL),
(865, 'Huancavelica', 'Churcampa', 'La Merced', NULL, NULL, NULL),
(866, 'Huancavelica', 'Churcampa', 'Locroja', NULL, NULL, NULL),
(867, 'Huancavelica', 'Churcampa', 'Paucarbamba', NULL, NULL, NULL),
(868, 'Huancavelica', 'Churcampa', 'San Miguel de Mayocc', NULL, NULL, NULL),
(869, 'Huancavelica', 'Churcampa', 'San Pedro de Coris', NULL, NULL, NULL),
(870, 'Huancavelica', 'Churcampa', 'Pachamarca', NULL, NULL, NULL),
(871, 'Huancavelica', 'Churcampa', 'Cosme', NULL, NULL, NULL),
(872, 'Huancavelica', 'Huaytara', 'Huaytara', NULL, NULL, NULL),
(873, 'Huancavelica', 'Huaytara', 'Ayavi', NULL, NULL, NULL),
(874, 'Huancavelica', 'Huaytara', 'Cordova', NULL, NULL, NULL),
(875, 'Huancavelica', 'Huaytara', 'Huayacundo Arma', NULL, NULL, NULL),
(876, 'Huancavelica', 'Huaytara', 'Laramarca', NULL, NULL, NULL),
(877, 'Huancavelica', 'Huaytara', 'Ocoyo', NULL, NULL, NULL),
(878, 'Huancavelica', 'Huaytara', 'Pilpichaca', NULL, NULL, NULL),
(879, 'Huancavelica', 'Huaytara', 'Querco', NULL, NULL, NULL),
(880, 'Huancavelica', 'Huaytara', 'Quito-Arma', NULL, NULL, NULL),
(881, 'Huancavelica', 'Huaytara', 'San Antonio de Cusicancha', NULL, NULL, NULL),
(882, 'Huancavelica', 'Huaytara', 'San Francisco de Sangayaico', NULL, NULL, NULL),
(883, 'Huancavelica', 'Huaytara', 'San Isidro', NULL, NULL, NULL),
(884, 'Huancavelica', 'Huaytara', 'Santiago de Chocorvos', NULL, NULL, NULL),
(885, 'Huancavelica', 'Huaytara', 'Santiago de Quirahuara', NULL, NULL, NULL),
(886, 'Huancavelica', 'Huaytara', 'Santo Domingo de Capillas', NULL, NULL, NULL),
(887, 'Huancavelica', 'Huaytara', 'Tambo', NULL, NULL, NULL),
(888, 'Huancavelica', 'Tayacaja', 'Pampas', NULL, NULL, NULL),
(889, 'Huancavelica', 'Tayacaja', 'Acostambo', NULL, NULL, NULL),
(890, 'Huancavelica', 'Tayacaja', 'Acraquia', NULL, NULL, NULL),
(891, 'Huancavelica', 'Tayacaja', 'Ahuaycha', NULL, NULL, NULL),
(892, 'Huancavelica', 'Tayacaja', 'Colcabamba', NULL, NULL, NULL),
(893, 'Huancavelica', 'Tayacaja', 'Daniel Hernandez', NULL, NULL, NULL),
(894, 'Huancavelica', 'Tayacaja', 'Huachocolpa', NULL, NULL, NULL),
(895, 'Huancavelica', 'Tayacaja', 'Huaribamba', NULL, NULL, NULL),
(896, 'Huancavelica', 'Tayacaja', 'Ã‘ahuimpuquio', NULL, NULL, NULL),
(897, 'Huancavelica', 'Tayacaja', 'Pazos', NULL, NULL, NULL),
(898, 'Huancavelica', 'Tayacaja', 'Quishuar', NULL, NULL, NULL),
(899, 'Huancavelica', 'Tayacaja', 'Salcabamba', NULL, NULL, NULL),
(900, 'Huancavelica', 'Tayacaja', 'Salcahuasi', NULL, NULL, NULL),
(901, 'Huancavelica', 'Tayacaja', 'San Marcos de Rocchac', NULL, NULL, NULL),
(902, 'Huancavelica', 'Tayacaja', 'Surcubamba', NULL, NULL, NULL),
(903, 'Huancavelica', 'Tayacaja', 'Tintay Puncu', NULL, NULL, NULL),
(904, 'Huancavelica', 'Tayacaja', 'Quichuas', NULL, NULL, NULL),
(905, 'Huancavelica', 'Tayacaja', 'Andaymarca', NULL, NULL, NULL),
(906, 'Huancavelica', 'Tayacaja', 'Roble', NULL, NULL, NULL),
(907, 'Huancavelica', 'Tayacaja', 'Pichos', NULL, NULL, NULL),
(908, 'Huancavelica', 'Tayacaja', 'Santiago de Tucuma', NULL, NULL, NULL),
(909, 'Huanuco', 'Huanuco', 'Huanuco', NULL, NULL, NULL),
(910, 'Huanuco', 'Huanuco', 'Amarilis', NULL, NULL, NULL),
(911, 'Huanuco', 'Huanuco', 'Chinchao', NULL, NULL, NULL),
(912, 'Huanuco', 'Huanuco', 'Churubamba', NULL, NULL, NULL),
(913, 'Huanuco', 'Huanuco', 'Margos', NULL, NULL, NULL),
(914, 'Huanuco', 'Huanuco', 'Quisqui (Kichki)', NULL, NULL, NULL),
(915, 'Huanuco', 'Huanuco', 'San Francisco de Cayran', NULL, NULL, NULL),
(916, 'Huanuco', 'Huanuco', 'San Pedro de Chaulan', NULL, NULL, NULL),
(917, 'Huanuco', 'Huanuco', 'Santa Maria del Valle', NULL, NULL, NULL),
(918, 'Huanuco', 'Huanuco', 'Yarumayo', NULL, NULL, NULL),
(919, 'Huanuco', 'Huanuco', 'Pillco Marca', NULL, NULL, NULL),
(920, 'Huanuco', 'Huanuco', 'Yacus', NULL, NULL, NULL),
(921, 'Huanuco', 'Huanuco', 'San Pablo de Pillao', NULL, NULL, NULL),
(922, 'Huanuco', 'Ambo', 'Ambo', NULL, NULL, NULL),
(923, 'Huanuco', 'Ambo', 'Cayna', NULL, NULL, NULL),
(924, 'Huanuco', 'Ambo', 'Colpas', NULL, NULL, NULL),
(925, 'Huanuco', 'Ambo', 'Conchamarca', NULL, NULL, NULL),
(926, 'Huanuco', 'Ambo', 'Huacar', NULL, NULL, NULL),
(927, 'Huanuco', 'Ambo', 'San Francisco', NULL, NULL, NULL),
(928, 'Huanuco', 'Ambo', 'San Rafael', NULL, NULL, NULL),
(929, 'Huanuco', 'Ambo', 'Tomay Kichwa', NULL, NULL, NULL),
(930, 'Huanuco', 'Dos de Mayo', 'La Union', NULL, NULL, NULL),
(931, 'Huanuco', 'Dos de Mayo', 'Chuquis', NULL, NULL, NULL),
(932, 'Huanuco', 'Dos de Mayo', 'Marias', NULL, NULL, NULL),
(933, 'Huanuco', 'Dos de Mayo', 'Pachas', NULL, NULL, NULL),
(934, 'Huanuco', 'Dos de Mayo', 'Quivilla', NULL, NULL, NULL),
(935, 'Huanuco', 'Dos de Mayo', 'Ripan', NULL, NULL, NULL),
(936, 'Huanuco', 'Dos de Mayo', 'Shunqui', NULL, NULL, NULL),
(937, 'Huanuco', 'Dos de Mayo', 'Sillapata', NULL, NULL, NULL),
(938, 'Huanuco', 'Dos de Mayo', 'Yanas', NULL, NULL, NULL),
(939, 'Huanuco', 'Huacaybamba', 'Huacaybamba', NULL, NULL, NULL),
(940, 'Huanuco', 'Huacaybamba', 'Canchabamba', NULL, NULL, NULL),
(941, 'Huanuco', 'Huacaybamba', 'Cochabamba', NULL, NULL, NULL),
(942, 'Huanuco', 'Huacaybamba', 'Pinra', NULL, NULL, NULL),
(943, 'Huanuco', 'Huamalies', 'Llata', NULL, NULL, NULL),
(944, 'Huanuco', 'Huamalies', 'Arancay', NULL, NULL, NULL),
(945, 'Huanuco', 'Huamalies', 'Chavin de Pariarca', NULL, NULL, NULL),
(946, 'Huanuco', 'Huamalies', 'Jacas Grande', NULL, NULL, NULL),
(947, 'Huanuco', 'Huamalies', 'Jircan', NULL, NULL, NULL),
(948, 'Huanuco', 'Huamalies', 'Miraflores', NULL, NULL, NULL),
(949, 'Huanuco', 'Huamalies', 'Monzon', NULL, NULL, NULL),
(950, 'Huanuco', 'Huamalies', 'Punchao', NULL, NULL, NULL),
(951, 'Huanuco', 'Huamalies', 'PuÃ±os', NULL, NULL, NULL),
(952, 'Huanuco', 'Huamalies', 'Singa', NULL, NULL, NULL),
(953, 'Huanuco', 'Huamalies', 'Tantamayo', NULL, NULL, NULL),
(954, 'Huanuco', 'Leoncio Prado', 'Rupa-Rupa', NULL, NULL, NULL),
(955, 'Huanuco', 'Leoncio Prado', 'Daniel Alomia Robles', NULL, NULL, NULL),
(956, 'Huanuco', 'Leoncio Prado', 'Hermilio Valdizan', NULL, NULL, NULL),
(957, 'Huanuco', 'Leoncio Prado', 'Jose Crespo y Castillo', NULL, NULL, NULL),
(958, 'Huanuco', 'Leoncio Prado', 'Luyando', NULL, NULL, NULL),
(959, 'Huanuco', 'Leoncio Prado', 'Mariano Damaso Beraun', NULL, NULL, NULL),
(960, 'Huanuco', 'Leoncio Prado', 'Pucayacu', NULL, NULL, NULL),
(961, 'Huanuco', 'Leoncio Prado', 'Castillo Grande', NULL, NULL, NULL),
(962, 'Huanuco', 'Leoncio Prado', 'Pueblo Nuevo', NULL, NULL, NULL),
(963, 'Huanuco', 'Leoncio Prado', 'Santo Domingo de Anda', NULL, NULL, NULL),
(964, 'Huanuco', 'MaraÃ±on', 'Huacrachuco', NULL, NULL, NULL),
(965, 'Huanuco', 'MaraÃ±on', 'Cholon', NULL, NULL, NULL),
(966, 'Huanuco', 'MaraÃ±on', 'San Buenaventura', NULL, NULL, NULL),
(967, 'Huanuco', 'MaraÃ±on', 'La Morada', NULL, NULL, NULL),
(968, 'Huanuco', 'MaraÃ±on', 'Santa Rosa de Alto Yanajanca', NULL, NULL, NULL),
(969, 'Huanuco', 'Pachitea', 'Panao', NULL, NULL, NULL),
(970, 'Huanuco', 'Pachitea', 'Chaglla', NULL, NULL, NULL),
(971, 'Huanuco', 'Pachitea', 'Molino', NULL, NULL, NULL),
(972, 'Huanuco', 'Pachitea', 'Umari', NULL, NULL, NULL),
(973, 'Huanuco', 'Puerto Inca', 'Puerto Inca', NULL, NULL, NULL),
(974, 'Huanuco', 'Puerto Inca', 'Codo del Pozuzo', NULL, NULL, NULL),
(975, 'Huanuco', 'Puerto Inca', 'Honoria', NULL, NULL, NULL),
(976, 'Huanuco', 'Puerto Inca', 'Tournavista', NULL, NULL, NULL),
(977, 'Huanuco', 'Puerto Inca', 'Yuyapichis', NULL, NULL, NULL),
(978, 'Huanuco', 'Lauricocha', 'Jesus', NULL, NULL, NULL),
(979, 'Huanuco', 'Lauricocha', 'BaÃ±os', NULL, NULL, NULL),
(980, 'Huanuco', 'Lauricocha', 'Jivia', NULL, NULL, NULL),
(981, 'Huanuco', 'Lauricocha', 'Queropalca', NULL, NULL, NULL),
(982, 'Huanuco', 'Lauricocha', 'Rondos', NULL, NULL, NULL),
(983, 'Huanuco', 'Lauricocha', 'San Francisco de Asis', NULL, NULL, NULL),
(984, 'Huanuco', 'Lauricocha', 'San Miguel de Cauri', NULL, NULL, NULL),
(985, 'Huanuco', 'Yarowilca', 'Chavinillo', NULL, NULL, NULL),
(986, 'Huanuco', 'Yarowilca', 'Cahuac', NULL, NULL, NULL),
(987, 'Huanuco', 'Yarowilca', 'Chacabamba', NULL, NULL, NULL),
(988, 'Huanuco', 'Yarowilca', 'Aparicio Pomares', NULL, NULL, NULL),
(989, 'Huanuco', 'Yarowilca', 'Jacas Chico', NULL, NULL, NULL),
(990, 'Huanuco', 'Yarowilca', 'Obas', NULL, NULL, NULL),
(991, 'Huanuco', 'Yarowilca', 'Pampamarca', NULL, NULL, NULL),
(992, 'Huanuco', 'Yarowilca', 'Choras', NULL, NULL, NULL),
(993, 'Ica', 'Ica', 'Ica', NULL, NULL, NULL),
(994, 'Ica', 'Ica', 'La TinguiÃ±a', NULL, NULL, NULL),
(995, 'Ica', 'Ica', 'Los Aquijes', NULL, NULL, NULL),
(996, 'Ica', 'Ica', 'Ocucaje', NULL, NULL, NULL),
(997, 'Ica', 'Ica', 'Pachacutec', NULL, NULL, NULL),
(998, 'Ica', 'Ica', 'Parcona', NULL, NULL, NULL),
(999, 'Ica', 'Ica', 'Pueblo Nuevo', NULL, NULL, NULL),
(1000, 'Ica', 'Ica', 'Salas', NULL, NULL, NULL),
(1001, 'Ica', 'Ica', 'San Jose de Los Molinos', NULL, NULL, NULL),
(1002, 'Ica', 'Ica', 'San Juan Bautista', NULL, NULL, NULL),
(1003, 'Ica', 'Ica', 'Santiago', NULL, NULL, NULL),
(1004, 'Ica', 'Ica', 'Subtanjalla', NULL, NULL, NULL),
(1005, 'Ica', 'Ica', 'Tate', NULL, NULL, NULL),
(1006, 'Ica', 'Ica', 'Yauca del Rosario', NULL, NULL, NULL),
(1007, 'Ica', 'Chincha', 'Chincha Alta', NULL, NULL, NULL),
(1008, 'Ica', 'Chincha', 'Alto Laran', NULL, NULL, NULL),
(1009, 'Ica', 'Chincha', 'Chavin', NULL, NULL, NULL),
(1010, 'Ica', 'Chincha', 'Chincha Baja', NULL, NULL, NULL),
(1011, 'Ica', 'Chincha', 'El Carmen', NULL, NULL, NULL),
(1012, 'Ica', 'Chincha', 'Grocio Prado', NULL, NULL, NULL),
(1013, 'Ica', 'Chincha', 'Pueblo Nuevo', NULL, NULL, NULL),
(1014, 'Ica', 'Chincha', 'San Juan de Yanac', NULL, NULL, NULL),
(1015, 'Ica', 'Chincha', 'San Pedro de Huacarpana', NULL, NULL, NULL),
(1016, 'Ica', 'Chincha', 'Sunampe', NULL, NULL, NULL),
(1017, 'Ica', 'Chincha', 'Tambo de Mora', NULL, NULL, NULL),
(1018, 'Ica', 'Nasca', 'Nasca', NULL, NULL, NULL),
(1019, 'Ica', 'Nasca', 'Changuillo', NULL, NULL, NULL),
(1020, 'Ica', 'Nasca', 'El Ingenio', NULL, NULL, NULL),
(1021, 'Ica', 'Nasca', 'Marcona', NULL, NULL, NULL),
(1022, 'Ica', 'Nasca', 'Vista Alegre', NULL, NULL, NULL),
(1023, 'Ica', 'Palpa', 'Palpa', NULL, NULL, NULL),
(1024, 'Ica', 'Palpa', 'Llipata', NULL, NULL, NULL),
(1025, 'Ica', 'Palpa', 'Rio Grande', NULL, NULL, NULL),
(1026, 'Ica', 'Palpa', 'Santa Cruz', NULL, NULL, NULL),
(1027, 'Ica', 'Palpa', 'Tibillo', NULL, NULL, NULL),
(1028, 'Ica', 'Pisco', 'Pisco', NULL, NULL, NULL),
(1029, 'Ica', 'Pisco', 'Huancano', NULL, NULL, NULL),
(1030, 'Ica', 'Pisco', 'Humay', NULL, NULL, NULL),
(1031, 'Ica', 'Pisco', 'Independencia', NULL, NULL, NULL),
(1032, 'Ica', 'Pisco', 'Paracas', NULL, NULL, NULL),
(1033, 'Ica', 'Pisco', 'San Andres', NULL, NULL, NULL),
(1034, 'Ica', 'Pisco', 'San Clemente', NULL, NULL, NULL),
(1035, 'Ica', 'Pisco', 'Tupac Amaru Inca', NULL, NULL, NULL),
(1036, 'Junin', 'Huancayo', 'Huancayo', NULL, NULL, NULL),
(1037, 'Junin', 'Huancayo', 'Carhuacallanga', NULL, NULL, NULL),
(1038, 'Junin', 'Huancayo', 'Chacapampa', NULL, NULL, NULL),
(1039, 'Junin', 'Huancayo', 'Chicche', NULL, NULL, NULL),
(1040, 'Junin', 'Huancayo', 'Chilca', NULL, NULL, NULL),
(1041, 'Junin', 'Huancayo', 'Chongos Alto', NULL, NULL, NULL),
(1042, 'Junin', 'Huancayo', 'Chupuro', NULL, NULL, NULL),
(1043, 'Junin', 'Huancayo', 'Colca', NULL, NULL, NULL),
(1044, 'Junin', 'Huancayo', 'Cullhuas', NULL, NULL, NULL),
(1045, 'Junin', 'Huancayo', 'El Tambo', NULL, NULL, NULL),
(1046, 'Junin', 'Huancayo', 'Huacrapuquio', NULL, NULL, NULL),
(1047, 'Junin', 'Huancayo', 'Hualhuas', NULL, NULL, NULL),
(1048, 'Junin', 'Huancayo', 'Huancan', NULL, NULL, NULL),
(1049, 'Junin', 'Huancayo', 'Huasicancha', NULL, NULL, NULL),
(1050, 'Junin', 'Huancayo', 'Huayucachi', NULL, NULL, NULL),
(1051, 'Junin', 'Huancayo', 'Ingenio', NULL, NULL, NULL),
(1052, 'Junin', 'Huancayo', 'Pariahuanca', NULL, NULL, NULL),
(1053, 'Junin', 'Huancayo', 'Pilcomayo', NULL, NULL, NULL),
(1054, 'Junin', 'Huancayo', 'Pucara', NULL, NULL, NULL),
(1055, 'Junin', 'Huancayo', 'Quichuay', NULL, NULL, NULL),
(1056, 'Junin', 'Huancayo', 'Quilcas', NULL, NULL, NULL),
(1057, 'Junin', 'Huancayo', 'San Agustin', NULL, NULL, NULL),
(1058, 'Junin', 'Huancayo', 'San Jeronimo de Tunan', NULL, NULL, NULL),
(1059, 'Junin', 'Huancayo', 'SaÃ±o', NULL, NULL, NULL),
(1060, 'Junin', 'Huancayo', 'Sapallanga', NULL, NULL, NULL),
(1061, 'Junin', 'Huancayo', 'Sicaya', NULL, NULL, NULL),
(1062, 'Junin', 'Huancayo', 'Santo Domingo de Acobamba', NULL, NULL, NULL),
(1063, 'Junin', 'Huancayo', 'Viques', NULL, NULL, NULL),
(1064, 'Junin', 'Concepcion', 'Concepcion', NULL, NULL, NULL),
(1065, 'Junin', 'Concepcion', 'Aco', NULL, NULL, NULL),
(1066, 'Junin', 'Concepcion', 'Andamarca', NULL, NULL, NULL),
(1067, 'Junin', 'Concepcion', 'Chambara', NULL, NULL, NULL),
(1068, 'Junin', 'Concepcion', 'Cochas', NULL, NULL, NULL),
(1069, 'Junin', 'Concepcion', 'Comas', NULL, NULL, NULL),
(1070, 'Junin', 'Concepcion', 'Heroinas Toledo', NULL, NULL, NULL),
(1071, 'Junin', 'Concepcion', 'Manzanares', NULL, NULL, NULL),
(1072, 'Junin', 'Concepcion', 'Mariscal Castilla', NULL, NULL, NULL),
(1073, 'Junin', 'Concepcion', 'Matahuasi', NULL, NULL, NULL),
(1074, 'Junin', 'Concepcion', 'Mito', NULL, NULL, NULL),
(1075, 'Junin', 'Concepcion', 'Nueve de Julio', NULL, NULL, NULL),
(1076, 'Junin', 'Concepcion', 'Orcotuna', NULL, NULL, NULL),
(1077, 'Junin', 'Concepcion', 'San Jose de Quero', NULL, NULL, NULL),
(1078, 'Junin', 'Concepcion', 'Santa Rosa de Ocopa', NULL, NULL, NULL),
(1079, 'Junin', 'Chanchamayo', 'Chanchamayo', NULL, NULL, NULL),
(1080, 'Junin', 'Chanchamayo', 'Perene', NULL, NULL, NULL),
(1081, 'Junin', 'Chanchamayo', 'Pichanaqui', NULL, NULL, NULL),
(1082, 'Junin', 'Chanchamayo', 'San Luis de Shuaro', NULL, NULL, NULL),
(1083, 'Junin', 'Chanchamayo', 'San Ramon', NULL, NULL, NULL),
(1084, 'Junin', 'Chanchamayo', 'Vitoc', NULL, NULL, NULL),
(1085, 'Junin', 'Jauja', 'Jauja', NULL, NULL, NULL),
(1086, 'Junin', 'Jauja', 'Acolla', NULL, NULL, NULL),
(1087, 'Junin', 'Jauja', 'Apata', NULL, NULL, NULL),
(1088, 'Junin', 'Jauja', 'Ataura', NULL, NULL, NULL),
(1089, 'Junin', 'Jauja', 'Canchayllo', NULL, NULL, NULL),
(1090, 'Junin', 'Jauja', 'Curicaca', NULL, NULL, NULL),
(1091, 'Junin', 'Jauja', 'El Mantaro', NULL, NULL, NULL),
(1092, 'Junin', 'Jauja', 'Huamali', NULL, NULL, NULL),
(1093, 'Junin', 'Jauja', 'Huaripampa', NULL, NULL, NULL),
(1094, 'Junin', 'Jauja', 'Huertas', NULL, NULL, NULL),
(1095, 'Junin', 'Jauja', 'Janjaillo', NULL, NULL, NULL),
(1096, 'Junin', 'Jauja', 'Julcan', NULL, NULL, NULL),
(1097, 'Junin', 'Jauja', 'Leonor OrdoÃ±ez', NULL, NULL, NULL),
(1098, 'Junin', 'Jauja', 'Llocllapampa', NULL, NULL, NULL),
(1099, 'Junin', 'Jauja', 'Marco', NULL, NULL, NULL),
(1100, 'Junin', 'Jauja', 'Masma', NULL, NULL, NULL),
(1101, 'Junin', 'Jauja', 'Masma Chicche', NULL, NULL, NULL),
(1102, 'Junin', 'Jauja', 'Molinos', NULL, NULL, NULL),
(1103, 'Junin', 'Jauja', 'Monobamba', NULL, NULL, NULL),
(1104, 'Junin', 'Jauja', 'Muqui', NULL, NULL, NULL),
(1105, 'Junin', 'Jauja', 'Muquiyauyo', NULL, NULL, NULL),
(1106, 'Junin', 'Jauja', 'Paca', NULL, NULL, NULL),
(1107, 'Junin', 'Jauja', 'Paccha', NULL, NULL, NULL),
(1108, 'Junin', 'Jauja', 'Pancan', NULL, NULL, NULL),
(1109, 'Junin', 'Jauja', 'Parco', NULL, NULL, NULL),
(1110, 'Junin', 'Jauja', 'Pomacancha', NULL, NULL, NULL),
(1111, 'Junin', 'Jauja', 'Ricran', NULL, NULL, NULL),
(1112, 'Junin', 'Jauja', 'San Lorenzo', NULL, NULL, NULL),
(1113, 'Junin', 'Jauja', 'San Pedro de Chunan', NULL, NULL, NULL),
(1114, 'Junin', 'Jauja', 'Sausa', NULL, NULL, NULL),
(1115, 'Junin', 'Jauja', 'Sincos', NULL, NULL, NULL),
(1116, 'Junin', 'Jauja', 'Tunan Marca', NULL, NULL, NULL),
(1117, 'Junin', 'Jauja', 'Yauli', NULL, NULL, NULL),
(1118, 'Junin', 'Jauja', 'Yauyos', NULL, NULL, NULL),
(1119, 'Junin', 'Junin', 'Junin', NULL, NULL, NULL),
(1120, 'Junin', 'Junin', 'Carhuamayo', NULL, NULL, NULL),
(1121, 'Junin', 'Junin', 'Ondores', NULL, NULL, NULL),
(1122, 'Junin', 'Junin', 'Ulcumayo', NULL, NULL, NULL),
(1123, 'Junin', 'Satipo', 'Satipo', NULL, NULL, NULL),
(1124, 'Junin', 'Satipo', 'Coviriali', NULL, NULL, NULL),
(1125, 'Junin', 'Satipo', 'Llaylla', NULL, NULL, NULL),
(1126, 'Junin', 'Satipo', 'Mazamari', NULL, NULL, NULL),
(1127, 'Junin', 'Satipo', 'Pampa Hermosa', NULL, NULL, NULL),
(1128, 'Junin', 'Satipo', 'Pangoa', NULL, NULL, NULL),
(1129, 'Junin', 'Satipo', 'Rio Negro', NULL, NULL, NULL),
(1130, 'Junin', 'Satipo', 'Rio Tambo', NULL, NULL, NULL),
(1131, 'Junin', 'Satipo', 'Vizcatan del Ene', NULL, NULL, NULL),
(1132, 'Junin', 'Tarma', 'Tarma', NULL, NULL, NULL),
(1133, 'Junin', 'Tarma', 'Acobamba', NULL, NULL, NULL),
(1134, 'Junin', 'Tarma', 'Huaricolca', NULL, NULL, NULL),
(1135, 'Junin', 'Tarma', 'Huasahuasi', NULL, NULL, NULL),
(1136, 'Junin', 'Tarma', 'La Union', NULL, NULL, NULL),
(1137, 'Junin', 'Tarma', 'Palca', NULL, NULL, NULL),
(1138, 'Junin', 'Tarma', 'Palcamayo', NULL, NULL, NULL),
(1139, 'Junin', 'Tarma', 'San Pedro de Cajas', NULL, NULL, NULL),
(1140, 'Junin', 'Tarma', 'Tapo', NULL, NULL, NULL),
(1141, 'Junin', 'Yauli', 'La Oroya', NULL, NULL, NULL),
(1142, 'Junin', 'Yauli', 'Chacapalpa', NULL, NULL, NULL),
(1143, 'Junin', 'Yauli', 'Huay-Huay', NULL, NULL, NULL),
(1144, 'Junin', 'Yauli', 'Marcapomacocha', NULL, NULL, NULL),
(1145, 'Junin', 'Yauli', 'Morococha', NULL, NULL, NULL),
(1146, 'Junin', 'Yauli', 'Paccha', NULL, NULL, NULL),
(1147, 'Junin', 'Yauli', 'Santa Barbara de Carhuacayan', NULL, NULL, NULL),
(1148, 'Junin', 'Yauli', 'Santa Rosa de Sacco', NULL, NULL, NULL),
(1149, 'Junin', 'Yauli', 'Suitucancha', NULL, NULL, NULL),
(1150, 'Junin', 'Yauli', 'Yauli', NULL, NULL, NULL),
(1151, 'Junin', 'Chupaca', 'Chupaca', NULL, NULL, NULL),
(1152, 'Junin', 'Chupaca', 'Ahuac', NULL, NULL, NULL),
(1153, 'Junin', 'Chupaca', 'Chongos Bajo', NULL, NULL, NULL),
(1154, 'Junin', 'Chupaca', 'Huachac', NULL, NULL, NULL),
(1155, 'Junin', 'Chupaca', 'Huamancaca Chico', NULL, NULL, NULL),
(1156, 'Junin', 'Chupaca', 'San Juan de Iscos', NULL, NULL, NULL),
(1157, 'Junin', 'Chupaca', 'San Juan de Jarpa', NULL, NULL, NULL),
(1158, 'Junin', 'Chupaca', 'Tres de Diciembre', NULL, NULL, NULL),
(1159, 'Junin', 'Chupaca', 'Yanacancha', NULL, NULL, NULL),
(1160, 'La Libertad', 'Trujillo', 'Trujillo', NULL, NULL, NULL),
(1161, 'La Libertad', 'Trujillo', 'El Porvenir', NULL, NULL, NULL),
(1162, 'La Libertad', 'Trujillo', 'Florencia de Mora', NULL, NULL, NULL),
(1163, 'La Libertad', 'Trujillo', 'Huanchaco', NULL, NULL, NULL),
(1164, 'La Libertad', 'Trujillo', 'La Esperanza', NULL, NULL, NULL),
(1165, 'La Libertad', 'Trujillo', 'Laredo', NULL, NULL, NULL),
(1166, 'La Libertad', 'Trujillo', 'Moche', NULL, NULL, NULL),
(1167, 'La Libertad', 'Trujillo', 'Poroto', NULL, NULL, NULL),
(1168, 'La Libertad', 'Trujillo', 'Salaverry', NULL, NULL, NULL),
(1169, 'La Libertad', 'Trujillo', 'Simbal', NULL, NULL, NULL),
(1170, 'La Libertad', 'Trujillo', 'Victor Larco Herrera', NULL, NULL, NULL),
(1171, 'La Libertad', 'Ascope', 'Ascope', NULL, NULL, NULL),
(1172, 'La Libertad', 'Ascope', 'Chicama', NULL, NULL, NULL),
(1173, 'La Libertad', 'Ascope', 'Chocope', NULL, NULL, NULL),
(1174, 'La Libertad', 'Ascope', 'Magdalena de Cao', NULL, NULL, NULL),
(1175, 'La Libertad', 'Ascope', 'Paijan', NULL, NULL, NULL),
(1176, 'La Libertad', 'Ascope', 'Razuri', NULL, NULL, NULL),
(1177, 'La Libertad', 'Ascope', 'Santiago de Cao', NULL, NULL, NULL),
(1178, 'La Libertad', 'Ascope', 'Casa Grande', NULL, NULL, NULL),
(1179, 'La Libertad', 'Bolivar', 'Bolivar', NULL, NULL, NULL),
(1180, 'La Libertad', 'Bolivar', 'Bambamarca', NULL, NULL, NULL),
(1181, 'La Libertad', 'Bolivar', 'Condormarca', NULL, NULL, NULL),
(1182, 'La Libertad', 'Bolivar', 'Longotea', NULL, NULL, NULL),
(1183, 'La Libertad', 'Bolivar', 'Uchumarca', NULL, NULL, NULL),
(1184, 'La Libertad', 'Bolivar', 'Ucuncha', NULL, NULL, NULL),
(1185, 'La Libertad', 'Chepen', 'Chepen', NULL, NULL, NULL),
(1186, 'La Libertad', 'Chepen', 'Pacanga', NULL, NULL, NULL),
(1187, 'La Libertad', 'Chepen', 'Pueblo Nuevo', NULL, NULL, NULL),
(1188, 'La Libertad', 'Julcan', 'Julcan', NULL, NULL, NULL),
(1189, 'La Libertad', 'Julcan', 'Calamarca', NULL, NULL, NULL),
(1190, 'La Libertad', 'Julcan', 'Carabamba', NULL, NULL, NULL),
(1191, 'La Libertad', 'Julcan', 'Huaso', NULL, NULL, NULL),
(1192, 'La Libertad', 'Otuzco', 'Otuzco', NULL, NULL, NULL),
(1193, 'La Libertad', 'Otuzco', 'Agallpampa', NULL, NULL, NULL),
(1194, 'La Libertad', 'Otuzco', 'Charat', NULL, NULL, NULL),
(1195, 'La Libertad', 'Otuzco', 'Huaranchal', NULL, NULL, NULL),
(1196, 'La Libertad', 'Otuzco', 'La Cuesta', NULL, NULL, NULL),
(1197, 'La Libertad', 'Otuzco', 'Mache', NULL, NULL, NULL),
(1198, 'La Libertad', 'Otuzco', 'Paranday', NULL, NULL, NULL),
(1199, 'La Libertad', 'Otuzco', 'Salpo', NULL, NULL, NULL),
(1200, 'La Libertad', 'Otuzco', 'Sinsicap', NULL, NULL, NULL),
(1201, 'La Libertad', 'Otuzco', 'Usquil', NULL, NULL, NULL),
(1202, 'La Libertad', 'Pacasmayo', 'San Pedro de Lloc', NULL, NULL, NULL),
(1203, 'La Libertad', 'Pacasmayo', 'Guadalupe', NULL, NULL, NULL),
(1204, 'La Libertad', 'Pacasmayo', 'Jequetepeque', NULL, NULL, NULL),
(1205, 'La Libertad', 'Pacasmayo', 'Pacasmayo', NULL, NULL, NULL),
(1206, 'La Libertad', 'Pacasmayo', 'San Jose', NULL, NULL, NULL),
(1207, 'La Libertad', 'Pataz', 'Tayabamba', NULL, NULL, NULL),
(1208, 'La Libertad', 'Pataz', 'Buldibuyo', NULL, NULL, NULL),
(1209, 'La Libertad', 'Pataz', 'Chillia', NULL, NULL, NULL),
(1210, 'La Libertad', 'Pataz', 'Huancaspata', NULL, NULL, NULL),
(1211, 'La Libertad', 'Pataz', 'Huaylillas', NULL, NULL, NULL),
(1212, 'La Libertad', 'Pataz', 'Huayo', NULL, NULL, NULL),
(1213, 'La Libertad', 'Pataz', 'Ongon', NULL, NULL, NULL),
(1214, 'La Libertad', 'Pataz', 'Parcoy', NULL, NULL, NULL),
(1215, 'La Libertad', 'Pataz', 'Pataz', NULL, NULL, NULL),
(1216, 'La Libertad', 'Pataz', 'Pias', NULL, NULL, NULL),
(1217, 'La Libertad', 'Pataz', 'Santiago de Challas', NULL, NULL, NULL),
(1218, 'La Libertad', 'Pataz', 'Taurija', NULL, NULL, NULL),
(1219, 'La Libertad', 'Pataz', 'Urpay', NULL, NULL, NULL),
(1220, 'La Libertad', 'Sanchez Carrion', 'Huamachuco', NULL, NULL, NULL),
(1221, 'La Libertad', 'Sanchez Carrion', 'Chugay', NULL, NULL, NULL),
(1222, 'La Libertad', 'Sanchez Carrion', 'Cochorco', NULL, NULL, NULL),
(1223, 'La Libertad', 'Sanchez Carrion', 'Curgos', NULL, NULL, NULL),
(1224, 'La Libertad', 'Sanchez Carrion', 'Marcabal', NULL, NULL, NULL),
(1225, 'La Libertad', 'Sanchez Carrion', 'Sanagoran', NULL, NULL, NULL),
(1226, 'La Libertad', 'Sanchez Carrion', 'Sarin', NULL, NULL, NULL),
(1227, 'La Libertad', 'Sanchez Carrion', 'Sartimbamba', NULL, NULL, NULL),
(1228, 'La Libertad', 'Santiago de Chuco', 'Santiago de Chuco', NULL, NULL, NULL),
(1229, 'La Libertad', 'Santiago de Chuco', 'Angasmarca', NULL, NULL, NULL),
(1230, 'La Libertad', 'Santiago de Chuco', 'Cachicadan', NULL, NULL, NULL),
(1231, 'La Libertad', 'Santiago de Chuco', 'Mollebamba', NULL, NULL, NULL),
(1232, 'La Libertad', 'Santiago de Chuco', 'Mollepata', NULL, NULL, NULL),
(1233, 'La Libertad', 'Santiago de Chuco', 'Quiruvilca', NULL, NULL, NULL),
(1234, 'La Libertad', 'Santiago de Chuco', 'Santa Cruz de Chuca', NULL, NULL, NULL),
(1235, 'La Libertad', 'Santiago de Chuco', 'Sitabamba', NULL, NULL, NULL),
(1236, 'La Libertad', 'Gran Chimu', 'Cascas', NULL, NULL, NULL),
(1237, 'La Libertad', 'Gran Chimu', 'Lucma', NULL, NULL, NULL),
(1238, 'La Libertad', 'Gran Chimu', 'Marmot', NULL, NULL, NULL),
(1239, 'La Libertad', 'Gran Chimu', 'Sayapullo', NULL, NULL, NULL),
(1240, 'La Libertad', 'Viru', 'Viru', NULL, NULL, NULL),
(1241, 'La Libertad', 'Viru', 'Chao', NULL, NULL, NULL),
(1242, 'La Libertad', 'Viru', 'Guadalupito', NULL, NULL, NULL),
(1243, 'Lambayeque', 'Chiclayo', 'Chiclayo', NULL, NULL, NULL),
(1244, 'Lambayeque', 'Chiclayo', 'Chongoyape', NULL, NULL, NULL),
(1245, 'Lambayeque', 'Chiclayo', 'Eten', NULL, NULL, NULL),
(1246, 'Lambayeque', 'Chiclayo', 'Eten Puerto', NULL, NULL, NULL),
(1247, 'Lambayeque', 'Chiclayo', 'Jose Leonardo Ortiz', NULL, NULL, NULL),
(1248, 'Lambayeque', 'Chiclayo', 'La Victoria', NULL, NULL, NULL),
(1249, 'Lambayeque', 'Chiclayo', 'Lagunas', NULL, NULL, NULL),
(1250, 'Lambayeque', 'Chiclayo', 'Monsefu', NULL, NULL, NULL),
(1251, 'Lambayeque', 'Chiclayo', 'Nueva Arica', NULL, NULL, NULL),
(1252, 'Lambayeque', 'Chiclayo', 'Oyotun', NULL, NULL, NULL),
(1253, 'Lambayeque', 'Chiclayo', 'Picsi', NULL, NULL, NULL),
(1254, 'Lambayeque', 'Chiclayo', 'Pimentel', NULL, NULL, NULL),
(1255, 'Lambayeque', 'Chiclayo', 'Reque', NULL, NULL, NULL),
(1256, 'Lambayeque', 'Chiclayo', 'Santa Rosa', NULL, NULL, NULL),
(1257, 'Lambayeque', 'Chiclayo', 'SaÃ±a', NULL, NULL, NULL),
(1258, 'Lambayeque', 'Chiclayo', 'Cayalti', NULL, NULL, NULL),
(1259, 'Lambayeque', 'Chiclayo', 'Patapo', NULL, NULL, NULL),
(1260, 'Lambayeque', 'Chiclayo', 'Pomalca', NULL, NULL, NULL),
(1261, 'Lambayeque', 'Chiclayo', 'Pucala', NULL, NULL, NULL),
(1262, 'Lambayeque', 'Chiclayo', 'Tuman', NULL, NULL, NULL),
(1263, 'Lambayeque', 'FerreÃ±afe', 'FerreÃ±afe', NULL, NULL, NULL),
(1264, 'Lambayeque', 'FerreÃ±afe', 'CaÃ±aris', NULL, NULL, NULL),
(1265, 'Lambayeque', 'FerreÃ±afe', 'Incahuasi', NULL, NULL, NULL),
(1266, 'Lambayeque', 'FerreÃ±afe', 'Manuel Antonio Mesones Muro', NULL, NULL, NULL),
(1267, 'Lambayeque', 'FerreÃ±afe', 'Pitipo', NULL, NULL, NULL),
(1268, 'Lambayeque', 'FerreÃ±afe', 'Pueblo Nuevo', NULL, NULL, NULL),
(1269, 'Lambayeque', 'Lambayeque', 'Lambayeque', NULL, NULL, NULL),
(1270, 'Lambayeque', 'Lambayeque', 'Chochope', NULL, NULL, NULL),
(1271, 'Lambayeque', 'Lambayeque', 'Illimo', NULL, NULL, NULL),
(1272, 'Lambayeque', 'Lambayeque', 'Jayanca', NULL, NULL, NULL),
(1273, 'Lambayeque', 'Lambayeque', 'Mochumi', NULL, NULL, NULL),
(1274, 'Lambayeque', 'Lambayeque', 'Morrope', NULL, NULL, NULL),
(1275, 'Lambayeque', 'Lambayeque', 'Motupe', NULL, NULL, NULL),
(1276, 'Lambayeque', 'Lambayeque', 'Olmos', NULL, NULL, NULL),
(1277, 'Lambayeque', 'Lambayeque', 'Pacora', NULL, NULL, NULL),
(1278, 'Lambayeque', 'Lambayeque', 'Salas', NULL, NULL, NULL),
(1279, 'Lambayeque', 'Lambayeque', 'San Jose', NULL, NULL, NULL),
(1280, 'Lambayeque', 'Lambayeque', 'Tucume', NULL, NULL, NULL),
(1281, 'Lima', 'Lima', 'Lima', NULL, NULL, NULL),
(1282, 'Lima', 'Lima', 'Ancon', NULL, NULL, NULL),
(1283, 'Lima', 'Lima', 'Ate', NULL, NULL, NULL),
(1284, 'Lima', 'Lima', 'Barranco', NULL, NULL, NULL),
(1285, 'Lima', 'Lima', 'BreÃ±a', NULL, NULL, NULL),
(1286, 'Lima', 'Lima', 'Carabayllo', NULL, NULL, NULL),
(1287, 'Lima', 'Lima', 'Chaclacayo', NULL, NULL, NULL),
(1288, 'Lima', 'Lima', 'Chorrillos', NULL, NULL, NULL),
(1289, 'Lima', 'Lima', 'Cieneguilla', NULL, NULL, NULL),
(1290, 'Lima', 'Lima', 'Comas', NULL, NULL, NULL),
(1291, 'Lima', 'Lima', 'El Agustino', NULL, NULL, NULL),
(1292, 'Lima', 'Lima', 'Independencia', NULL, NULL, NULL),
(1293, 'Lima', 'Lima', 'Jesus Maria', NULL, NULL, NULL),
(1294, 'Lima', 'Lima', 'La Molina', NULL, NULL, NULL),
(1295, 'Lima', 'Lima', 'La Victoria', NULL, NULL, NULL),
(1296, 'Lima', 'Lima', 'Lince', NULL, NULL, NULL),
(1297, 'Lima', 'Lima', 'Los Olivos', NULL, NULL, NULL),
(1298, 'Lima', 'Lima', 'Lurigancho', NULL, NULL, NULL),
(1299, 'Lima', 'Lima', 'Lurin', NULL, NULL, NULL),
(1300, 'Lima', 'Lima', 'Magdalena del Mar', NULL, NULL, NULL),
(1301, 'Lima', 'Lima', 'Pueblo Libre', NULL, NULL, NULL),
(1302, 'Lima', 'Lima', 'Miraflores', NULL, NULL, NULL),
(1303, 'Lima', 'Lima', 'Pachacamac', NULL, NULL, NULL),
(1304, 'Lima', 'Lima', 'Pucusana', NULL, NULL, NULL),
(1305, 'Lima', 'Lima', 'Puente Piedra', NULL, NULL, NULL),
(1306, 'Lima', 'Lima', 'Punta Hermosa', NULL, NULL, NULL),
(1307, 'Lima', 'Lima', 'Punta Negra', NULL, NULL, NULL),
(1308, 'Lima', 'Lima', 'Rimac', NULL, NULL, NULL),
(1309, 'Lima', 'Lima', 'San Bartolo', NULL, NULL, NULL),
(1310, 'Lima', 'Lima', 'San Borja', NULL, NULL, NULL),
(1311, 'Lima', 'Lima', 'San Isidro', NULL, NULL, NULL),
(1312, 'Lima', 'Lima', 'San Juan de Lurigancho', NULL, NULL, NULL),
(1313, 'Lima', 'Lima', 'San Juan de Miraflores', NULL, NULL, NULL),
(1314, 'Lima', 'Lima', 'San Luis', NULL, NULL, NULL),
(1315, 'Lima', 'Lima', 'San Martin de Porres', NULL, NULL, NULL),
(1316, 'Lima', 'Lima', 'San Miguel', NULL, NULL, NULL),
(1317, 'Lima', 'Lima', 'Santa Anita', NULL, NULL, NULL),
(1318, 'Lima', 'Lima', 'Santa Maria del Mar', NULL, NULL, NULL),
(1319, 'Lima', 'Lima', 'Santa Rosa', NULL, NULL, NULL),
(1320, 'Lima', 'Lima', 'Santiago de Surco', NULL, NULL, NULL),
(1321, 'Lima', 'Lima', 'Surquillo', NULL, NULL, NULL),
(1322, 'Lima', 'Lima', 'Villa El Salvador', NULL, NULL, NULL),
(1323, 'Lima', 'Lima', 'Villa Maria del Triunfo', NULL, NULL, NULL),
(1324, 'Lima', 'Barranca', 'Barranca', NULL, NULL, NULL),
(1325, 'Lima', 'Barranca', 'Paramonga', NULL, NULL, NULL),
(1326, 'Lima', 'Barranca', 'Pativilca', NULL, NULL, NULL),
(1327, 'Lima', 'Barranca', 'Supe', NULL, NULL, NULL),
(1328, 'Lima', 'Barranca', 'Supe Puerto', NULL, NULL, NULL),
(1329, 'Lima', 'Cajatambo', 'Cajatambo', NULL, NULL, NULL),
(1330, 'Lima', 'Cajatambo', 'Copa', NULL, NULL, NULL),
(1331, 'Lima', 'Cajatambo', 'Gorgor', NULL, NULL, NULL),
(1332, 'Lima', 'Cajatambo', 'Huancapon', NULL, NULL, NULL),
(1333, 'Lima', 'Cajatambo', 'Manas', NULL, NULL, NULL),
(1334, 'Lima', 'Canta', 'Canta', NULL, NULL, NULL),
(1335, 'Lima', 'Canta', 'Arahuay', NULL, NULL, NULL),
(1336, 'Lima', 'Canta', 'Huamantanga', NULL, NULL, NULL),
(1337, 'Lima', 'Canta', 'Huaros', NULL, NULL, NULL),
(1338, 'Lima', 'Canta', 'Lachaqui', NULL, NULL, NULL),
(1339, 'Lima', 'Canta', 'San Buenaventura', NULL, NULL, NULL),
(1340, 'Lima', 'Canta', 'Santa Rosa de Quives', NULL, NULL, NULL),
(1341, 'Lima', 'CaÃ±ete', 'San Vicente de CaÃ±ete', NULL, NULL, NULL),
(1342, 'Lima', 'CaÃ±ete', 'Asia', NULL, NULL, NULL),
(1343, 'Lima', 'CaÃ±ete', 'Calango', NULL, NULL, NULL),
(1344, 'Lima', 'CaÃ±ete', 'Cerro Azul', NULL, NULL, NULL),
(1345, 'Lima', 'CaÃ±ete', 'Chilca', NULL, NULL, NULL),
(1346, 'Lima', 'CaÃ±ete', 'Coayllo', NULL, NULL, NULL),
(1347, 'Lima', 'CaÃ±ete', 'Imperial', NULL, NULL, NULL),
(1348, 'Lima', 'CaÃ±ete', 'Lunahuana', NULL, NULL, NULL),
(1349, 'Lima', 'CaÃ±ete', 'Mala', NULL, NULL, NULL),
(1350, 'Lima', 'CaÃ±ete', 'Nuevo Imperial', NULL, NULL, NULL),
(1351, 'Lima', 'CaÃ±ete', 'Pacaran', NULL, NULL, NULL),
(1352, 'Lima', 'CaÃ±ete', 'Quilmana', NULL, NULL, NULL),
(1353, 'Lima', 'CaÃ±ete', 'San Antonio', NULL, NULL, NULL),
(1354, 'Lima', 'CaÃ±ete', 'San Luis', NULL, NULL, NULL),
(1355, 'Lima', 'CaÃ±ete', 'Santa Cruz de Flores', NULL, NULL, NULL),
(1356, 'Lima', 'CaÃ±ete', 'ZuÃ±iga', NULL, NULL, NULL),
(1357, 'Lima', 'Huaral', 'Huaral', NULL, NULL, NULL),
(1358, 'Lima', 'Huaral', 'Atavillos Alto', NULL, NULL, NULL),
(1359, 'Lima', 'Huaral', 'Atavillos Bajo', NULL, NULL, NULL),
(1360, 'Lima', 'Huaral', 'Aucallama', NULL, NULL, NULL),
(1361, 'Lima', 'Huaral', 'Chancay', NULL, NULL, NULL),
(1362, 'Lima', 'Huaral', 'Ihuari', NULL, NULL, NULL),
(1363, 'Lima', 'Huaral', 'Lampian', NULL, NULL, NULL),
(1364, 'Lima', 'Huaral', 'Pacaraos', NULL, NULL, NULL),
(1365, 'Lima', 'Huaral', 'San Miguel de Acos', NULL, NULL, NULL),
(1366, 'Lima', 'Huaral', 'Santa Cruz de Andamarca', NULL, NULL, NULL),
(1367, 'Lima', 'Huaral', 'Sumbilca', NULL, NULL, NULL),
(1368, 'Lima', 'Huaral', 'Veintisiete de Noviembre', NULL, NULL, NULL),
(1369, 'Lima', 'Huarochiri', 'Matucana', NULL, NULL, NULL),
(1370, 'Lima', 'Huarochiri', 'Antioquia', NULL, NULL, NULL),
(1371, 'Lima', 'Huarochiri', 'Callahuanca', NULL, NULL, NULL),
(1372, 'Lima', 'Huarochiri', 'Carampoma', NULL, NULL, NULL),
(1373, 'Lima', 'Huarochiri', 'Chicla', NULL, NULL, NULL),
(1374, 'Lima', 'Huarochiri', 'Cuenca', NULL, NULL, NULL),
(1375, 'Lima', 'Huarochiri', 'Huachupampa', NULL, NULL, NULL),
(1376, 'Lima', 'Huarochiri', 'Huanza', NULL, NULL, NULL),
(1377, 'Lima', 'Huarochiri', 'Huarochiri', NULL, NULL, NULL),
(1378, 'Lima', 'Huarochiri', 'Lahuaytambo', NULL, NULL, NULL),
(1379, 'Lima', 'Huarochiri', 'Langa', NULL, NULL, NULL),
(1380, 'Lima', 'Huarochiri', 'Laraos', NULL, NULL, NULL),
(1381, 'Lima', 'Huarochiri', 'Mariatana', NULL, NULL, NULL),
(1382, 'Lima', 'Huarochiri', 'Ricardo Palma', NULL, NULL, NULL),
(1383, 'Lima', 'Huarochiri', 'San Andres de Tupicocha', NULL, NULL, NULL),
(1384, 'Lima', 'Huarochiri', 'San Antonio', NULL, NULL, NULL),
(1385, 'Lima', 'Huarochiri', 'San Bartolome', NULL, NULL, NULL),
(1386, 'Lima', 'Huarochiri', 'San Damian', NULL, NULL, NULL),
(1387, 'Lima', 'Huarochiri', 'San Juan de Iris', NULL, NULL, NULL),
(1388, 'Lima', 'Huarochiri', 'San Juan de Tantaranche', NULL, NULL, NULL),
(1389, 'Lima', 'Huarochiri', 'San Lorenzo de Quinti', NULL, NULL, NULL),
(1390, 'Lima', 'Huarochiri', 'San Mateo', NULL, NULL, NULL),
(1391, 'Lima', 'Huarochiri', 'San Mateo de Otao', NULL, NULL, NULL),
(1392, 'Lima', 'Huarochiri', 'San Pedro de Casta', NULL, NULL, NULL),
(1393, 'Lima', 'Huarochiri', 'San Pedro de Huancayre', NULL, NULL, NULL),
(1394, 'Lima', 'Huarochiri', 'Sangallaya', NULL, NULL, NULL),
(1395, 'Lima', 'Huarochiri', 'Santa Cruz de Cocachacra', NULL, NULL, NULL),
(1396, 'Lima', 'Huarochiri', 'Santa Eulalia', NULL, NULL, NULL),
(1397, 'Lima', 'Huarochiri', 'Santiago de Anchucaya', NULL, NULL, NULL),
(1398, 'Lima', 'Huarochiri', 'Santiago de Tuna', NULL, NULL, NULL),
(1399, 'Lima', 'Huarochiri', 'Santo Domingo de Los Olleros', NULL, NULL, NULL),
(1400, 'Lima', 'Huarochiri', 'Surco', NULL, NULL, NULL),
(1401, 'Lima', 'Huaura', 'Huacho', NULL, NULL, NULL),
(1402, 'Lima', 'Huaura', 'Ambar', NULL, NULL, NULL),
(1403, 'Lima', 'Huaura', 'Caleta de Carquin', NULL, NULL, NULL),
(1404, 'Lima', 'Huaura', 'Checras', NULL, NULL, NULL),
(1405, 'Lima', 'Huaura', 'Hualmay', NULL, NULL, NULL),
(1406, 'Lima', 'Huaura', 'Huaura', NULL, NULL, NULL),
(1407, 'Lima', 'Huaura', 'Leoncio Prado', NULL, NULL, NULL),
(1408, 'Lima', 'Huaura', 'Paccho', NULL, NULL, NULL),
(1409, 'Lima', 'Huaura', 'Santa Leonor', NULL, NULL, NULL),
(1410, 'Lima', 'Huaura', 'Santa Maria', NULL, NULL, NULL),
(1411, 'Lima', 'Huaura', 'Sayan', NULL, NULL, NULL),
(1412, 'Lima', 'Huaura', 'Vegueta', NULL, NULL, NULL),
(1413, 'Lima', 'Oyon', 'Oyon', NULL, NULL, NULL),
(1414, 'Lima', 'Oyon', 'Andajes', NULL, NULL, NULL),
(1415, 'Lima', 'Oyon', 'Caujul', NULL, NULL, NULL),
(1416, 'Lima', 'Oyon', 'Cochamarca', NULL, NULL, NULL),
(1417, 'Lima', 'Oyon', 'Navan', NULL, NULL, NULL),
(1418, 'Lima', 'Oyon', 'Pachangara', NULL, NULL, NULL),
(1419, 'Lima', 'Yauyos', 'Yauyos', NULL, NULL, NULL),
(1420, 'Lima', 'Yauyos', 'Alis', NULL, NULL, NULL),
(1421, 'Lima', 'Yauyos', 'Allauca', NULL, NULL, NULL),
(1422, 'Lima', 'Yauyos', 'Ayaviri', NULL, NULL, NULL),
(1423, 'Lima', 'Yauyos', 'Azangaro', NULL, NULL, NULL),
(1424, 'Lima', 'Yauyos', 'Cacra', NULL, NULL, NULL),
(1425, 'Lima', 'Yauyos', 'Carania', NULL, NULL, NULL),
(1426, 'Lima', 'Yauyos', 'Catahuasi', NULL, NULL, NULL),
(1427, 'Lima', 'Yauyos', 'Chocos', NULL, NULL, NULL),
(1428, 'Lima', 'Yauyos', 'Cochas', NULL, NULL, NULL),
(1429, 'Lima', 'Yauyos', 'Colonia', NULL, NULL, NULL),
(1430, 'Lima', 'Yauyos', 'Hongos', NULL, NULL, NULL),
(1431, 'Lima', 'Yauyos', 'Huampara', NULL, NULL, NULL),
(1432, 'Lima', 'Yauyos', 'Huancaya', NULL, NULL, NULL),
(1433, 'Lima', 'Yauyos', 'Huangascar', NULL, NULL, NULL),
(1434, 'Lima', 'Yauyos', 'Huantan', NULL, NULL, NULL),
(1435, 'Lima', 'Yauyos', 'HuaÃ±ec', NULL, NULL, NULL),
(1436, 'Lima', 'Yauyos', 'Laraos', NULL, NULL, NULL),
(1437, 'Lima', 'Yauyos', 'Lincha', NULL, NULL, NULL),
(1438, 'Lima', 'Yauyos', 'Madean', NULL, NULL, NULL),
(1439, 'Lima', 'Yauyos', 'Miraflores', NULL, NULL, NULL),
(1440, 'Lima', 'Yauyos', 'Omas', NULL, NULL, NULL),
(1441, 'Lima', 'Yauyos', 'Putinza', NULL, NULL, NULL),
(1442, 'Lima', 'Yauyos', 'Quinches', NULL, NULL, NULL),
(1443, 'Lima', 'Yauyos', 'Quinocay', NULL, NULL, NULL),
(1444, 'Lima', 'Yauyos', 'San Joaquin', NULL, NULL, NULL),
(1445, 'Lima', 'Yauyos', 'San Pedro de Pilas', NULL, NULL, NULL),
(1446, 'Lima', 'Yauyos', 'Tanta', NULL, NULL, NULL),
(1447, 'Lima', 'Yauyos', 'Tauripampa', NULL, NULL, NULL),
(1448, 'Lima', 'Yauyos', 'Tomas', NULL, NULL, NULL),
(1449, 'Lima', 'Yauyos', 'Tupe', NULL, NULL, NULL),
(1450, 'Lima', 'Yauyos', 'ViÃ±ac', NULL, NULL, NULL),
(1451, 'Lima', 'Yauyos', 'Vitis', NULL, NULL, NULL),
(1452, 'Loreto', 'Maynas', 'Iquitos', NULL, NULL, NULL),
(1453, 'Loreto', 'Maynas', 'Alto Nanay', NULL, NULL, NULL),
(1454, 'Loreto', 'Maynas', 'Fernando Lores', NULL, NULL, NULL),
(1455, 'Loreto', 'Maynas', 'Indiana', NULL, NULL, NULL),
(1456, 'Loreto', 'Maynas', 'Las Amazonas', NULL, NULL, NULL),
(1457, 'Loreto', 'Maynas', 'Mazan', NULL, NULL, NULL),
(1458, 'Loreto', 'Maynas', 'Napo', NULL, NULL, NULL),
(1459, 'Loreto', 'Maynas', 'Punchana', NULL, NULL, NULL),
(1460, 'Loreto', 'Maynas', 'Torres Causana', NULL, NULL, NULL),
(1461, 'Loreto', 'Maynas', 'Belen', NULL, NULL, NULL),
(1462, 'Loreto', 'Maynas', 'San Juan Bautista', NULL, NULL, NULL),
(1463, 'Loreto', 'Alto Amazonas', 'Yurimaguas', NULL, NULL, NULL),
(1464, 'Loreto', 'Alto Amazonas', 'Balsapuerto', NULL, NULL, NULL),
(1465, 'Loreto', 'Alto Amazonas', 'Jeberos', NULL, NULL, NULL),
(1466, 'Loreto', 'Alto Amazonas', 'Lagunas', NULL, NULL, NULL),
(1467, 'Loreto', 'Alto Amazonas', 'Santa Cruz', NULL, NULL, NULL),
(1468, 'Loreto', 'Alto Amazonas', 'Teniente Cesar Lopez Rojas', NULL, NULL, NULL),
(1469, 'Loreto', 'Loreto', 'Nauta', NULL, NULL, NULL),
(1470, 'Loreto', 'Loreto', 'Parinari', NULL, NULL, NULL),
(1471, 'Loreto', 'Loreto', 'Tigre', NULL, NULL, NULL),
(1472, 'Loreto', 'Loreto', 'Trompeteros', NULL, NULL, NULL),
(1473, 'Loreto', 'Loreto', 'Urarinas', NULL, NULL, NULL),
(1474, 'Loreto', 'Mariscal Ramon Castilla', 'Ramon Castilla', NULL, NULL, NULL),
(1475, 'Loreto', 'Mariscal Ramon Castilla', 'Pebas', NULL, NULL, NULL),
(1476, 'Loreto', 'Mariscal Ramon Castilla', 'Yavari', NULL, NULL, NULL),
(1477, 'Loreto', 'Mariscal Ramon Castilla', 'San Pablo', NULL, NULL, NULL),
(1478, 'Loreto', 'Requena', 'Requena', NULL, NULL, NULL),
(1479, 'Loreto', 'Requena', 'Alto Tapiche', NULL, NULL, NULL),
(1480, 'Loreto', 'Requena', 'Capelo', NULL, NULL, NULL),
(1481, 'Loreto', 'Requena', 'Emilio San Martin', NULL, NULL, NULL),
(1482, 'Loreto', 'Requena', 'Maquia', NULL, NULL, NULL),
(1483, 'Loreto', 'Requena', 'Puinahua', NULL, NULL, NULL),
(1484, 'Loreto', 'Requena', 'Saquena', NULL, NULL, NULL),
(1485, 'Loreto', 'Requena', 'Soplin', NULL, NULL, NULL),
(1486, 'Loreto', 'Requena', 'Tapiche', NULL, NULL, NULL),
(1487, 'Loreto', 'Requena', 'Jenaro Herrera', NULL, NULL, NULL),
(1488, 'Loreto', 'Requena', 'Yaquerana', NULL, NULL, NULL),
(1489, 'Loreto', 'Ucayali', 'Contamana', NULL, NULL, NULL),
(1490, 'Loreto', 'Ucayali', 'Inahuaya', NULL, NULL, NULL),
(1491, 'Loreto', 'Ucayali', 'Padre Marquez', NULL, NULL, NULL),
(1492, 'Loreto', 'Ucayali', 'Pampa Hermosa', NULL, NULL, NULL),
(1493, 'Loreto', 'Ucayali', 'Sarayacu', NULL, NULL, NULL),
(1494, 'Loreto', 'Ucayali', 'Vargas Guerra', NULL, NULL, NULL),
(1495, 'Loreto', 'Datem del MaraÃ±on', 'Barranca', NULL, NULL, NULL),
(1496, 'Loreto', 'Datem del MaraÃ±on', 'Cahuapanas', NULL, NULL, NULL),
(1497, 'Loreto', 'Datem del MaraÃ±on', 'Manseriche', NULL, NULL, NULL),
(1498, 'Loreto', 'Datem del MaraÃ±on', 'Morona', NULL, NULL, NULL),
(1499, 'Loreto', 'Datem del MaraÃ±on', 'Pastaza', NULL, NULL, NULL),
(1500, 'Loreto', 'Datem del MaraÃ±on', 'Andoas', NULL, NULL, NULL),
(1501, 'Loreto', 'Putumayo', 'Putumayo', NULL, NULL, NULL),
(1502, 'Loreto', 'Putumayo', 'Rosa Panduro', NULL, NULL, NULL),
(1503, 'Loreto', 'Putumayo', 'Teniente Manuel Clavero', NULL, NULL, NULL),
(1504, 'Loreto', 'Putumayo', 'Yaguas', NULL, NULL, NULL),
(1505, 'Madre de Dios', 'Tambopata', 'Tambopata', NULL, NULL, NULL),
(1506, 'Madre de Dios', 'Tambopata', 'Inambari', NULL, NULL, NULL),
(1507, 'Madre de Dios', 'Tambopata', 'Las Piedras', NULL, NULL, NULL),
(1508, 'Madre de Dios', 'Tambopata', 'Laberinto', NULL, NULL, NULL),
(1509, 'Madre de Dios', 'Manu', 'Manu', NULL, NULL, NULL),
(1510, 'Madre de Dios', 'Manu', 'Fitzcarrald', NULL, NULL, NULL),
(1511, 'Madre de Dios', 'Manu', 'Madre de Dios', NULL, NULL, NULL),
(1512, 'Madre de Dios', 'Manu', 'Huepetuhe', NULL, NULL, NULL),
(1513, 'Madre de Dios', 'Tahuamanu', 'IÃ±apari', NULL, NULL, NULL),
(1514, 'Madre de Dios', 'Tahuamanu', 'Iberia', NULL, NULL, NULL),
(1515, 'Madre de Dios', 'Tahuamanu', 'Tahuamanu', NULL, NULL, NULL),
(1516, 'Moquegua', 'Mariscal Nieto', 'Moquegua', NULL, NULL, NULL),
(1517, 'Moquegua', 'Mariscal Nieto', 'Carumas', NULL, NULL, NULL),
(1518, 'Moquegua', 'Mariscal Nieto', 'Cuchumbaya', NULL, NULL, NULL),
(1519, 'Moquegua', 'Mariscal Nieto', 'Samegua', NULL, NULL, NULL),
(1520, 'Moquegua', 'Mariscal Nieto', 'San Cristobal', NULL, NULL, NULL),
(1521, 'Moquegua', 'Mariscal Nieto', 'Torata', NULL, NULL, NULL),
(1522, 'Moquegua', 'General Sanchez Cerro', 'Omate', NULL, NULL, NULL),
(1523, 'Moquegua', 'General Sanchez Cerro', 'Chojata', NULL, NULL, NULL),
(1524, 'Moquegua', 'General Sanchez Cerro', 'Coalaque', NULL, NULL, NULL),
(1525, 'Moquegua', 'General Sanchez Cerro', 'IchuÃ±a', NULL, NULL, NULL),
(1526, 'Moquegua', 'General Sanchez Cerro', 'La Capilla', NULL, NULL, NULL),
(1527, 'Moquegua', 'General Sanchez Cerro', 'Lloque', NULL, NULL, NULL),
(1528, 'Moquegua', 'General Sanchez Cerro', 'Matalaque', NULL, NULL, NULL),
(1529, 'Moquegua', 'General Sanchez Cerro', 'Puquina', NULL, NULL, NULL),
(1530, 'Moquegua', 'General Sanchez Cerro', 'Quinistaquillas', NULL, NULL, NULL),
(1531, 'Moquegua', 'General Sanchez Cerro', 'Ubinas', NULL, NULL, NULL),
(1532, 'Moquegua', 'General Sanchez Cerro', 'Yunga', NULL, NULL, NULL),
(1533, 'Moquegua', 'Ilo', 'Ilo', NULL, NULL, NULL),
(1534, 'Moquegua', 'Ilo', 'El Algarrobal', NULL, NULL, NULL),
(1535, 'Moquegua', 'Ilo', 'Pacocha', NULL, NULL, NULL),
(1536, 'Pasco', 'Pasco', 'Chaupimarca', NULL, NULL, NULL),
(1537, 'Pasco', 'Pasco', 'Huachon', NULL, NULL, NULL),
(1538, 'Pasco', 'Pasco', 'Huariaca', NULL, NULL, NULL),
(1539, 'Pasco', 'Pasco', 'Huayllay', NULL, NULL, NULL),
(1540, 'Pasco', 'Pasco', 'Ninacaca', NULL, NULL, NULL),
(1541, 'Pasco', 'Pasco', 'Pallanchacra', NULL, NULL, NULL),
(1542, 'Pasco', 'Pasco', 'Paucartambo', NULL, NULL, NULL),
(1543, 'Pasco', 'Pasco', 'San Francisco de Asis de Yarusyacan', NULL, NULL, NULL),
(1544, 'Pasco', 'Pasco', 'Simon Bolivar', NULL, NULL, NULL),
(1545, 'Pasco', 'Pasco', 'Ticlacayan', NULL, NULL, NULL),
(1546, 'Pasco', 'Pasco', 'Tinyahuarco', NULL, NULL, NULL),
(1547, 'Pasco', 'Pasco', 'Vicco', NULL, NULL, NULL),
(1548, 'Pasco', 'Pasco', 'Yanacancha', NULL, NULL, NULL),
(1549, 'Pasco', 'Daniel Alcides Carrion', 'Yanahuanca', NULL, NULL, NULL),
(1550, 'Pasco', 'Daniel Alcides Carrion', 'Chacayan', NULL, NULL, NULL),
(1551, 'Pasco', 'Daniel Alcides Carrion', 'Goyllarisquizga', NULL, NULL, NULL),
(1552, 'Pasco', 'Daniel Alcides Carrion', 'Paucar', NULL, NULL, NULL),
(1553, 'Pasco', 'Daniel Alcides Carrion', 'San Pedro de Pillao', NULL, NULL, NULL),
(1554, 'Pasco', 'Daniel Alcides Carrion', 'Santa Ana de Tusi', NULL, NULL, NULL),
(1555, 'Pasco', 'Daniel Alcides Carrion', 'Tapuc', NULL, NULL, NULL),
(1556, 'Pasco', 'Daniel Alcides Carrion', 'Vilcabamba', NULL, NULL, NULL),
(1557, 'Pasco', 'Oxapampa', 'Oxapampa', NULL, NULL, NULL),
(1558, 'Pasco', 'Oxapampa', 'Chontabamba', NULL, NULL, NULL),
(1559, 'Pasco', 'Oxapampa', 'Huancabamba', NULL, NULL, NULL),
(1560, 'Pasco', 'Oxapampa', 'Palcazu', NULL, NULL, NULL),
(1561, 'Pasco', 'Oxapampa', 'Pozuzo', NULL, NULL, NULL),
(1562, 'Pasco', 'Oxapampa', 'Puerto Bermudez', NULL, NULL, NULL),
(1563, 'Pasco', 'Oxapampa', 'Villa Rica', NULL, NULL, NULL),
(1564, 'Pasco', 'Oxapampa', 'Constitucion', NULL, NULL, NULL),
(1565, 'Piura', 'Piura', 'Piura', NULL, NULL, NULL),
(1566, 'Piura', 'Piura', 'Castilla', NULL, NULL, NULL),
(1567, 'Piura', 'Piura', 'Catacaos', NULL, NULL, NULL),
(1568, 'Piura', 'Piura', 'Cura Mori', NULL, NULL, NULL),
(1569, 'Piura', 'Piura', 'El Tallan', NULL, NULL, NULL),
(1570, 'Piura', 'Piura', 'La Arena', NULL, NULL, NULL),
(1571, 'Piura', 'Piura', 'La Union', NULL, NULL, NULL),
(1572, 'Piura', 'Piura', 'Las Lomas', NULL, NULL, NULL),
(1573, 'Piura', 'Piura', 'Tambo Grande', NULL, NULL, NULL),
(1574, 'Piura', 'Piura', 'Veintiseis de Octubre', NULL, NULL, NULL),
(1575, 'Piura', 'Ayabaca', 'Ayabaca', NULL, NULL, NULL),
(1576, 'Piura', 'Ayabaca', 'Frias', NULL, NULL, NULL),
(1577, 'Piura', 'Ayabaca', 'Jilili', NULL, NULL, NULL),
(1578, 'Piura', 'Ayabaca', 'Lagunas', NULL, NULL, NULL),
(1579, 'Piura', 'Ayabaca', 'Montero', NULL, NULL, NULL),
(1580, 'Piura', 'Ayabaca', 'Pacaipampa', NULL, NULL, NULL),
(1581, 'Piura', 'Ayabaca', 'Paimas', NULL, NULL, NULL),
(1582, 'Piura', 'Ayabaca', 'Sapillica', NULL, NULL, NULL),
(1583, 'Piura', 'Ayabaca', 'Sicchez', NULL, NULL, NULL),
(1584, 'Piura', 'Ayabaca', 'Suyo', NULL, NULL, NULL),
(1585, 'Piura', 'Huancabamba', 'Huancabamba', NULL, NULL, NULL),
(1586, 'Piura', 'Huancabamba', 'Canchaque', NULL, NULL, NULL),
(1587, 'Piura', 'Huancabamba', 'El Carmen de la Frontera', NULL, NULL, NULL),
(1588, 'Piura', 'Huancabamba', 'Huarmaca', NULL, NULL, NULL),
(1589, 'Piura', 'Huancabamba', 'Lalaquiz', NULL, NULL, NULL),
(1590, 'Piura', 'Huancabamba', 'San Miguel de El Faique', NULL, NULL, NULL),
(1591, 'Piura', 'Huancabamba', 'Sondor', NULL, NULL, NULL),
(1592, 'Piura', 'Huancabamba', 'Sondorillo', NULL, NULL, NULL),
(1593, 'Piura', 'Morropon', 'Chulucanas', NULL, NULL, NULL),
(1594, 'Piura', 'Morropon', 'Buenos Aires', NULL, NULL, NULL),
(1595, 'Piura', 'Morropon', 'Chalaco', NULL, NULL, NULL),
(1596, 'Piura', 'Morropon', 'La Matanza', NULL, NULL, NULL),
(1597, 'Piura', 'Morropon', 'Morropon', NULL, NULL, NULL),
(1598, 'Piura', 'Morropon', 'Salitral', NULL, NULL, NULL),
(1599, 'Piura', 'Morropon', 'San Juan de Bigote', NULL, NULL, NULL),
(1600, 'Piura', 'Morropon', 'Santa Catalina de Mossa', NULL, NULL, NULL),
(1601, 'Piura', 'Morropon', 'Santo Domingo', NULL, NULL, NULL),
(1602, 'Piura', 'Morropon', 'Yamango', NULL, NULL, NULL),
(1603, 'Piura', 'Paita', 'Paita', NULL, NULL, NULL),
(1604, 'Piura', 'Paita', 'Amotape', NULL, NULL, NULL),
(1605, 'Piura', 'Paita', 'Arenal', NULL, NULL, NULL),
(1606, 'Piura', 'Paita', 'Colan', NULL, NULL, NULL),
(1607, 'Piura', 'Paita', 'La Huaca', NULL, NULL, NULL),
(1608, 'Piura', 'Paita', 'Tamarindo', NULL, NULL, NULL),
(1609, 'Piura', 'Paita', 'Vichayal', NULL, NULL, NULL),
(1610, 'Piura', 'Sullana', 'Sullana', NULL, NULL, NULL),
(1611, 'Piura', 'Sullana', 'Bellavista', NULL, NULL, NULL),
(1612, 'Piura', 'Sullana', 'Ignacio Escudero', NULL, NULL, NULL),
(1613, 'Piura', 'Sullana', 'Lancones', NULL, NULL, NULL),
(1614, 'Piura', 'Sullana', 'Marcavelica', NULL, NULL, NULL),
(1615, 'Piura', 'Sullana', 'Miguel Checa', NULL, NULL, NULL),
(1616, 'Piura', 'Sullana', 'Querecotillo', NULL, NULL, NULL),
(1617, 'Piura', 'Sullana', 'Salitral', NULL, NULL, NULL),
(1618, 'Piura', 'Talara', 'PariÃ±as', NULL, NULL, NULL),
(1619, 'Piura', 'Talara', 'El Alto', NULL, NULL, NULL),
(1620, 'Piura', 'Talara', 'La Brea', NULL, NULL, NULL),
(1621, 'Piura', 'Talara', 'Lobitos', NULL, NULL, NULL),
(1622, 'Piura', 'Talara', 'Los Organos', NULL, NULL, NULL),
(1623, 'Piura', 'Talara', 'Mancora', NULL, NULL, NULL),
(1624, 'Piura', 'Sechura', 'Sechura', NULL, NULL, NULL),
(1625, 'Piura', 'Sechura', 'Bellavista de la Union', NULL, NULL, NULL),
(1626, 'Piura', 'Sechura', 'Bernal', NULL, NULL, NULL),
(1627, 'Piura', 'Sechura', 'Cristo Nos Valga', NULL, NULL, NULL),
(1628, 'Piura', 'Sechura', 'Vice', NULL, NULL, NULL),
(1629, 'Piura', 'Sechura', 'Rinconada Llicuar', NULL, NULL, NULL),
(1630, 'Puno', 'Puno', 'Puno', NULL, NULL, NULL),
(1631, 'Puno', 'Puno', 'Acora', NULL, NULL, NULL),
(1632, 'Puno', 'Puno', 'Amantani', NULL, NULL, NULL),
(1633, 'Puno', 'Puno', 'Atuncolla', NULL, NULL, NULL),
(1634, 'Puno', 'Puno', 'Capachica', NULL, NULL, NULL),
(1635, 'Puno', 'Puno', 'Chucuito', NULL, NULL, NULL),
(1636, 'Puno', 'Puno', 'Coata', NULL, NULL, NULL),
(1637, 'Puno', 'Puno', 'Huata', NULL, NULL, NULL),
(1638, 'Puno', 'Puno', 'MaÃ±azo', NULL, NULL, NULL),
(1639, 'Puno', 'Puno', 'Paucarcolla', NULL, NULL, NULL),
(1640, 'Puno', 'Puno', 'Pichacani', NULL, NULL, NULL),
(1641, 'Puno', 'Puno', 'Plateria', NULL, NULL, NULL),
(1642, 'Puno', 'Puno', 'San Antonio', NULL, NULL, NULL),
(1643, 'Puno', 'Puno', 'Tiquillaca', NULL, NULL, NULL),
(1644, 'Puno', 'Puno', 'Vilque', NULL, NULL, NULL),
(1645, 'Puno', 'Azangaro', 'Azangaro', NULL, NULL, NULL),
(1646, 'Puno', 'Azangaro', 'Achaya', NULL, NULL, NULL),
(1647, 'Puno', 'Azangaro', 'Arapa', NULL, NULL, NULL),
(1648, 'Puno', 'Azangaro', 'Asillo', NULL, NULL, NULL),
(1649, 'Puno', 'Azangaro', 'Caminaca', NULL, NULL, NULL),
(1650, 'Puno', 'Azangaro', 'Chupa', NULL, NULL, NULL),
(1651, 'Puno', 'Azangaro', 'Jose Domingo Choquehuanca', NULL, NULL, NULL),
(1652, 'Puno', 'Azangaro', 'MuÃ±ani', NULL, NULL, NULL),
(1653, 'Puno', 'Azangaro', 'Potoni', NULL, NULL, NULL),
(1654, 'Puno', 'Azangaro', 'Saman', NULL, NULL, NULL),
(1655, 'Puno', 'Azangaro', 'San Anton', NULL, NULL, NULL),
(1656, 'Puno', 'Azangaro', 'San Jose', NULL, NULL, NULL),
(1657, 'Puno', 'Azangaro', 'San Juan de Salinas', NULL, NULL, NULL),
(1658, 'Puno', 'Azangaro', 'Santiago de Pupuja', NULL, NULL, NULL),
(1659, 'Puno', 'Azangaro', 'Tirapata', NULL, NULL, NULL),
(1660, 'Puno', 'Carabaya', 'Macusani', NULL, NULL, NULL),
(1661, 'Puno', 'Carabaya', 'Ajoyani', NULL, NULL, NULL),
(1662, 'Puno', 'Carabaya', 'Ayapata', NULL, NULL, NULL),
(1663, 'Puno', 'Carabaya', 'Coasa', NULL, NULL, NULL),
(1664, 'Puno', 'Carabaya', 'Corani', NULL, NULL, NULL),
(1665, 'Puno', 'Carabaya', 'Crucero', NULL, NULL, NULL),
(1666, 'Puno', 'Carabaya', 'Ituata', NULL, NULL, NULL);
INSERT INTO `ubigeos` (`id`, `department`, `province`, `district`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1667, 'Puno', 'Carabaya', 'Ollachea', NULL, NULL, NULL),
(1668, 'Puno', 'Carabaya', 'San Gaban', NULL, NULL, NULL),
(1669, 'Puno', 'Carabaya', 'Usicayos', NULL, NULL, NULL),
(1670, 'Puno', 'Chucuito', 'Juli', NULL, NULL, NULL),
(1671, 'Puno', 'Chucuito', 'Desaguadero', NULL, NULL, NULL),
(1672, 'Puno', 'Chucuito', 'Huacullani', NULL, NULL, NULL),
(1673, 'Puno', 'Chucuito', 'Kelluyo', NULL, NULL, NULL),
(1674, 'Puno', 'Chucuito', 'Pisacoma', NULL, NULL, NULL),
(1675, 'Puno', 'Chucuito', 'Pomata', NULL, NULL, NULL),
(1676, 'Puno', 'Chucuito', 'Zepita', NULL, NULL, NULL),
(1677, 'Puno', 'El Collao', 'Ilave', NULL, NULL, NULL),
(1678, 'Puno', 'El Collao', 'Capazo', NULL, NULL, NULL),
(1679, 'Puno', 'El Collao', 'Pilcuyo', NULL, NULL, NULL),
(1680, 'Puno', 'El Collao', 'Santa Rosa', NULL, NULL, NULL),
(1681, 'Puno', 'El Collao', 'Conduriri', NULL, NULL, NULL),
(1682, 'Puno', 'Huancane', 'Huancane', NULL, NULL, NULL),
(1683, 'Puno', 'Huancane', 'Cojata', NULL, NULL, NULL),
(1684, 'Puno', 'Huancane', 'Huatasani', NULL, NULL, NULL),
(1685, 'Puno', 'Huancane', 'Inchupalla', NULL, NULL, NULL),
(1686, 'Puno', 'Huancane', 'Pusi', NULL, NULL, NULL),
(1687, 'Puno', 'Huancane', 'Rosaspata', NULL, NULL, NULL),
(1688, 'Puno', 'Huancane', 'Taraco', NULL, NULL, NULL),
(1689, 'Puno', 'Huancane', 'Vilque Chico', NULL, NULL, NULL),
(1690, 'Puno', 'Lampa', 'Lampa', NULL, NULL, NULL),
(1691, 'Puno', 'Lampa', 'Cabanilla', NULL, NULL, NULL),
(1692, 'Puno', 'Lampa', 'Calapuja', NULL, NULL, NULL),
(1693, 'Puno', 'Lampa', 'Nicasio', NULL, NULL, NULL),
(1694, 'Puno', 'Lampa', 'Ocuviri', NULL, NULL, NULL),
(1695, 'Puno', 'Lampa', 'Palca', NULL, NULL, NULL),
(1696, 'Puno', 'Lampa', 'Paratia', NULL, NULL, NULL),
(1697, 'Puno', 'Lampa', 'Pucara', NULL, NULL, NULL),
(1698, 'Puno', 'Lampa', 'Santa Lucia', NULL, NULL, NULL),
(1699, 'Puno', 'Lampa', 'Vilavila', NULL, NULL, NULL),
(1700, 'Puno', 'Melgar', 'Ayaviri', NULL, NULL, NULL),
(1701, 'Puno', 'Melgar', 'Antauta', NULL, NULL, NULL),
(1702, 'Puno', 'Melgar', 'Cupi', NULL, NULL, NULL),
(1703, 'Puno', 'Melgar', 'Llalli', NULL, NULL, NULL),
(1704, 'Puno', 'Melgar', 'Macari', NULL, NULL, NULL),
(1705, 'Puno', 'Melgar', 'NuÃ±oa', NULL, NULL, NULL),
(1706, 'Puno', 'Melgar', 'Orurillo', NULL, NULL, NULL),
(1707, 'Puno', 'Melgar', 'Santa Rosa', NULL, NULL, NULL),
(1708, 'Puno', 'Melgar', 'Umachiri', NULL, NULL, NULL),
(1709, 'Puno', 'Moho', 'Moho', NULL, NULL, NULL),
(1710, 'Puno', 'Moho', 'Conima', NULL, NULL, NULL),
(1711, 'Puno', 'Moho', 'Huayrapata', NULL, NULL, NULL),
(1712, 'Puno', 'Moho', 'Tilali', NULL, NULL, NULL),
(1713, 'Puno', 'San Antonio de Putina', 'Putina', NULL, NULL, NULL),
(1714, 'Puno', 'San Antonio de Putina', 'Ananea', NULL, NULL, NULL),
(1715, 'Puno', 'San Antonio de Putina', 'Pedro Vilca Apaza', NULL, NULL, NULL),
(1716, 'Puno', 'San Antonio de Putina', 'Quilcapuncu', NULL, NULL, NULL),
(1717, 'Puno', 'San Antonio de Putina', 'Sina', NULL, NULL, NULL),
(1718, 'Puno', 'San Roman', 'Juliaca', NULL, NULL, NULL),
(1719, 'Puno', 'San Roman', 'Cabana', NULL, NULL, NULL),
(1720, 'Puno', 'San Roman', 'Cabanillas', NULL, NULL, NULL),
(1721, 'Puno', 'San Roman', 'Caracoto', NULL, NULL, NULL),
(1722, 'Puno', 'San Roman', 'San Miguel', NULL, NULL, NULL),
(1723, 'Puno', 'Sandia', 'Sandia', NULL, NULL, NULL),
(1724, 'Puno', 'Sandia', 'Cuyocuyo', NULL, NULL, NULL),
(1725, 'Puno', 'Sandia', 'Limbani', NULL, NULL, NULL),
(1726, 'Puno', 'Sandia', 'Patambuco', NULL, NULL, NULL),
(1727, 'Puno', 'Sandia', 'Phara', NULL, NULL, NULL),
(1728, 'Puno', 'Sandia', 'Quiaca', NULL, NULL, NULL),
(1729, 'Puno', 'Sandia', 'San Juan del Oro', NULL, NULL, NULL),
(1730, 'Puno', 'Sandia', 'Yanahuaya', NULL, NULL, NULL),
(1731, 'Puno', 'Sandia', 'Alto Inambari', NULL, NULL, NULL),
(1732, 'Puno', 'Sandia', 'San Pedro de Putina Punco', NULL, NULL, NULL),
(1733, 'Puno', 'Yunguyo', 'Yunguyo', NULL, NULL, NULL),
(1734, 'Puno', 'Yunguyo', 'Anapia', NULL, NULL, NULL),
(1735, 'Puno', 'Yunguyo', 'Copani', NULL, NULL, NULL),
(1736, 'Puno', 'Yunguyo', 'Cuturapi', NULL, NULL, NULL),
(1737, 'Puno', 'Yunguyo', 'Ollaraya', NULL, NULL, NULL),
(1738, 'Puno', 'Yunguyo', 'Tinicachi', NULL, NULL, NULL),
(1739, 'Puno', 'Yunguyo', 'Unicachi', NULL, NULL, NULL),
(1740, 'San Martin', 'Moyobamba', 'Moyobamba', NULL, NULL, NULL),
(1741, 'San Martin', 'Moyobamba', 'Calzada', NULL, NULL, NULL),
(1742, 'San Martin', 'Moyobamba', 'Habana', NULL, NULL, NULL),
(1743, 'San Martin', 'Moyobamba', 'Jepelacio', NULL, NULL, NULL),
(1744, 'San Martin', 'Moyobamba', 'Soritor', NULL, NULL, NULL),
(1745, 'San Martin', 'Moyobamba', 'Yantalo', NULL, NULL, NULL),
(1746, 'San Martin', 'Bellavista', 'Bellavista', NULL, NULL, NULL),
(1747, 'San Martin', 'Bellavista', 'Alto Biavo', NULL, NULL, NULL),
(1748, 'San Martin', 'Bellavista', 'Bajo Biavo', NULL, NULL, NULL),
(1749, 'San Martin', 'Bellavista', 'Huallaga', NULL, NULL, NULL),
(1750, 'San Martin', 'Bellavista', 'San Pablo', NULL, NULL, NULL),
(1751, 'San Martin', 'Bellavista', 'San Rafael', NULL, NULL, NULL),
(1752, 'San Martin', 'El Dorado', 'San Jose de Sisa', NULL, NULL, NULL),
(1753, 'San Martin', 'El Dorado', 'Agua Blanca', NULL, NULL, NULL),
(1754, 'San Martin', 'El Dorado', 'San Martin', NULL, NULL, NULL),
(1755, 'San Martin', 'El Dorado', 'Santa Rosa', NULL, NULL, NULL),
(1756, 'San Martin', 'El Dorado', 'Shatoja', NULL, NULL, NULL),
(1757, 'San Martin', 'Huallaga', 'Saposoa', NULL, NULL, NULL),
(1758, 'San Martin', 'Huallaga', 'Alto Saposoa', NULL, NULL, NULL),
(1759, 'San Martin', 'Huallaga', 'El Eslabon', NULL, NULL, NULL),
(1760, 'San Martin', 'Huallaga', 'Piscoyacu', NULL, NULL, NULL),
(1761, 'San Martin', 'Huallaga', 'Sacanche', NULL, NULL, NULL),
(1762, 'San Martin', 'Huallaga', 'Tingo de Saposoa', NULL, NULL, NULL),
(1763, 'San Martin', 'Lamas', 'Lamas', NULL, NULL, NULL),
(1764, 'San Martin', 'Lamas', 'Alonso de Alvarado', NULL, NULL, NULL),
(1765, 'San Martin', 'Lamas', 'Barranquita', NULL, NULL, NULL),
(1766, 'San Martin', 'Lamas', 'Caynarachi', NULL, NULL, NULL),
(1767, 'San Martin', 'Lamas', 'CuÃ±umbuqui', NULL, NULL, NULL),
(1768, 'San Martin', 'Lamas', 'Pinto Recodo', NULL, NULL, NULL),
(1769, 'San Martin', 'Lamas', 'Rumisapa', NULL, NULL, NULL),
(1770, 'San Martin', 'Lamas', 'San Roque de Cumbaza', NULL, NULL, NULL),
(1771, 'San Martin', 'Lamas', 'Shanao', NULL, NULL, NULL),
(1772, 'San Martin', 'Lamas', 'Tabalosos', NULL, NULL, NULL),
(1773, 'San Martin', 'Lamas', 'Zapatero', NULL, NULL, NULL),
(1774, 'San Martin', 'Mariscal Caceres', 'Juanjui', NULL, NULL, NULL),
(1775, 'San Martin', 'Mariscal Caceres', 'Campanilla', NULL, NULL, NULL),
(1776, 'San Martin', 'Mariscal Caceres', 'Huicungo', NULL, NULL, NULL),
(1777, 'San Martin', 'Mariscal Caceres', 'Pachiza', NULL, NULL, NULL),
(1778, 'San Martin', 'Mariscal Caceres', 'Pajarillo', NULL, NULL, NULL),
(1779, 'San Martin', 'Picota', 'Picota', NULL, NULL, NULL),
(1780, 'San Martin', 'Picota', 'Buenos Aires', NULL, NULL, NULL),
(1781, 'San Martin', 'Picota', 'Caspisapa', NULL, NULL, NULL),
(1782, 'San Martin', 'Picota', 'Pilluana', NULL, NULL, NULL),
(1783, 'San Martin', 'Picota', 'Pucacaca', NULL, NULL, NULL),
(1784, 'San Martin', 'Picota', 'San Cristobal', NULL, NULL, NULL),
(1785, 'San Martin', 'Picota', 'San Hilarion', NULL, NULL, NULL),
(1786, 'San Martin', 'Picota', 'Shamboyacu', NULL, NULL, NULL),
(1787, 'San Martin', 'Picota', 'Tingo de Ponasa', NULL, NULL, NULL),
(1788, 'San Martin', 'Picota', 'Tres Unidos', NULL, NULL, NULL),
(1789, 'San Martin', 'Rioja', 'Rioja', NULL, NULL, NULL),
(1790, 'San Martin', 'Rioja', 'Awajun', NULL, NULL, NULL),
(1791, 'San Martin', 'Rioja', 'Elias Soplin Vargas', NULL, NULL, NULL),
(1792, 'San Martin', 'Rioja', 'Nueva Cajamarca', NULL, NULL, NULL),
(1793, 'San Martin', 'Rioja', 'Pardo Miguel', NULL, NULL, NULL),
(1794, 'San Martin', 'Rioja', 'Posic', NULL, NULL, NULL),
(1795, 'San Martin', 'Rioja', 'San Fernando', NULL, NULL, NULL),
(1796, 'San Martin', 'Rioja', 'Yorongos', NULL, NULL, NULL),
(1797, 'San Martin', 'Rioja', 'Yuracyacu', NULL, NULL, NULL),
(1798, 'San Martin', 'San Martin', 'Tarapoto', NULL, NULL, NULL),
(1799, 'San Martin', 'San Martin', 'Alberto Leveau', NULL, NULL, NULL),
(1800, 'San Martin', 'San Martin', 'Cacatachi', NULL, NULL, NULL),
(1801, 'San Martin', 'San Martin', 'Chazuta', NULL, NULL, NULL),
(1802, 'San Martin', 'San Martin', 'Chipurana', NULL, NULL, NULL),
(1803, 'San Martin', 'San Martin', 'El Porvenir', NULL, NULL, NULL),
(1804, 'San Martin', 'San Martin', 'Huimbayoc', NULL, NULL, NULL),
(1805, 'San Martin', 'San Martin', 'Juan Guerra', NULL, NULL, NULL),
(1806, 'San Martin', 'San Martin', 'La Banda de Shilcayo', NULL, NULL, NULL),
(1807, 'San Martin', 'San Martin', 'Morales', NULL, NULL, NULL),
(1808, 'San Martin', 'San Martin', 'Papaplaya', NULL, NULL, NULL),
(1809, 'San Martin', 'San Martin', 'San Antonio', NULL, NULL, NULL),
(1810, 'San Martin', 'San Martin', 'Sauce', NULL, NULL, NULL),
(1811, 'San Martin', 'San Martin', 'Shapaja', NULL, NULL, NULL),
(1812, 'San Martin', 'Tocache', 'Tocache', NULL, NULL, NULL),
(1813, 'San Martin', 'Tocache', 'Nuevo Progreso', NULL, NULL, NULL),
(1814, 'San Martin', 'Tocache', 'Polvora', NULL, NULL, NULL),
(1815, 'San Martin', 'Tocache', 'Shunte', NULL, NULL, NULL),
(1816, 'San Martin', 'Tocache', 'Uchiza', NULL, NULL, NULL),
(1817, 'Tacna', 'Tacna', 'Tacna', NULL, NULL, NULL),
(1818, 'Tacna', 'Tacna', 'Alto de la Alianza', NULL, NULL, NULL),
(1819, 'Tacna', 'Tacna', 'Calana', NULL, NULL, NULL),
(1820, 'Tacna', 'Tacna', 'Ciudad Nueva', NULL, NULL, NULL),
(1821, 'Tacna', 'Tacna', 'Inclan', NULL, NULL, NULL),
(1822, 'Tacna', 'Tacna', 'Pachia', NULL, NULL, NULL),
(1823, 'Tacna', 'Tacna', 'Palca', NULL, NULL, NULL),
(1824, 'Tacna', 'Tacna', 'Pocollay', NULL, NULL, NULL),
(1825, 'Tacna', 'Tacna', 'Sama', NULL, NULL, NULL),
(1826, 'Tacna', 'Tacna', 'Coronel Gregorio Albarracin Lanchipa', NULL, NULL, NULL),
(1827, 'Tacna', 'Tacna', 'La Yarada los Palos', NULL, NULL, NULL),
(1828, 'Tacna', 'Candarave', 'Candarave', NULL, NULL, NULL),
(1829, 'Tacna', 'Candarave', 'Cairani', NULL, NULL, NULL),
(1830, 'Tacna', 'Candarave', 'Camilaca', NULL, NULL, NULL),
(1831, 'Tacna', 'Candarave', 'Curibaya', NULL, NULL, NULL),
(1832, 'Tacna', 'Candarave', 'Huanuara', NULL, NULL, NULL),
(1833, 'Tacna', 'Candarave', 'Quilahuani', NULL, NULL, NULL),
(1834, 'Tacna', 'Jorge Basadre', 'Locumba', NULL, NULL, NULL),
(1835, 'Tacna', 'Jorge Basadre', 'Ilabaya', NULL, NULL, NULL),
(1836, 'Tacna', 'Jorge Basadre', 'Ite', NULL, NULL, NULL),
(1837, 'Tacna', 'Tarata', 'Tarata', NULL, NULL, NULL),
(1838, 'Tacna', 'Tarata', 'Heroes Albarracin', NULL, NULL, NULL),
(1839, 'Tacna', 'Tarata', 'Estique', NULL, NULL, NULL),
(1840, 'Tacna', 'Tarata', 'Estique-Pampa', NULL, NULL, NULL),
(1841, 'Tacna', 'Tarata', 'Sitajara', NULL, NULL, NULL),
(1842, 'Tacna', 'Tarata', 'Susapaya', NULL, NULL, NULL),
(1843, 'Tacna', 'Tarata', 'Tarucachi', NULL, NULL, NULL),
(1844, 'Tacna', 'Tarata', 'Ticaco', NULL, NULL, NULL),
(1845, 'Tumbes', 'Tumbes', 'Tumbes', NULL, NULL, NULL),
(1846, 'Tumbes', 'Tumbes', 'Corrales', NULL, NULL, NULL),
(1847, 'Tumbes', 'Tumbes', 'La Cruz', NULL, NULL, NULL),
(1848, 'Tumbes', 'Tumbes', 'Pampas de Hospital', NULL, NULL, NULL),
(1849, 'Tumbes', 'Tumbes', 'San Jacinto', NULL, NULL, NULL),
(1850, 'Tumbes', 'Tumbes', 'San Juan de la Virgen', NULL, NULL, NULL),
(1851, 'Tumbes', 'Contralmirante Villar', 'Zorritos', NULL, NULL, NULL),
(1852, 'Tumbes', 'Contralmirante Villar', 'Casitas', NULL, NULL, NULL),
(1853, 'Tumbes', 'Contralmirante Villar', 'Canoas de Punta Sal', NULL, NULL, NULL),
(1854, 'Tumbes', 'Zarumilla', 'Zarumilla', NULL, NULL, NULL),
(1855, 'Tumbes', 'Zarumilla', 'Aguas Verdes', NULL, NULL, NULL),
(1856, 'Tumbes', 'Zarumilla', 'Matapalo', NULL, NULL, NULL),
(1857, 'Tumbes', 'Zarumilla', 'Papayal', NULL, NULL, NULL),
(1858, 'Ucayali', 'Coronel Portillo', 'Calleria', NULL, NULL, NULL),
(1859, 'Ucayali', 'Coronel Portillo', 'Campoverde', NULL, NULL, NULL),
(1860, 'Ucayali', 'Coronel Portillo', 'Iparia', NULL, NULL, NULL),
(1861, 'Ucayali', 'Coronel Portillo', 'Masisea', NULL, NULL, NULL),
(1862, 'Ucayali', 'Coronel Portillo', 'Yarinacocha', NULL, NULL, NULL),
(1863, 'Ucayali', 'Coronel Portillo', 'Nueva Requena', NULL, NULL, NULL),
(1864, 'Ucayali', 'Coronel Portillo', 'Manantay', NULL, NULL, NULL),
(1865, 'Ucayali', 'Atalaya', 'Raymondi', NULL, NULL, NULL),
(1866, 'Ucayali', 'Atalaya', 'Sepahua', NULL, NULL, NULL),
(1867, 'Ucayali', 'Atalaya', 'Tahuania', NULL, NULL, NULL),
(1868, 'Ucayali', 'Atalaya', 'Yurua', NULL, NULL, NULL),
(1869, 'Ucayali', 'Padre Abad', 'Padre Abad', NULL, NULL, NULL),
(1870, 'Ucayali', 'Padre Abad', 'Irazola', NULL, NULL, NULL),
(1871, 'Ucayali', 'Padre Abad', 'Curimana', NULL, NULL, NULL),
(1872, 'Ucayali', 'Padre Abad', 'Neshuya', NULL, NULL, NULL),
(1873, 'Ucayali', 'Padre Abad', 'Alexander Von Humboldt', NULL, NULL, NULL),
(1874, 'Ucayali', 'Purus', 'Purus', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relationship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_id` bigint(20) UNSIGNED DEFAULT NULL,
  `str_salary` double(8,2) DEFAULT NULL,
  `cur_salary` double(8,2) DEFAULT NULL,
  `commission` float DEFAULT NULL,
  `frequency_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_at` date DEFAULT NULL,
  `end_at` date DEFAULT NULL,
  `bank_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cci` varchar(23) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `afp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cuspp` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cts_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cts_account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eps_id` bigint(20) UNSIGNED DEFAULT NULL,
  `essalud` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_fullname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_relationship` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `contact_mobile` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_annex` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `is_admin`, `code`, `name`, `lastname`, `email`, `document_type_id`, `document`, `gender_id`, `birthdate`, `address`, `district_id`, `country_id`, `mobile`, `phone`, `annex`, `alt_email`, `relationship_id`, `department_id`, `profile_id`, `str_salary`, `cur_salary`, `commission`, `frequency_id`, `start_at`, `end_at`, `bank_id`, `bank_account`, `cci`, `afp_id`, `commission_id`, `cuspp`, `cts_id`, `cts_account`, `eps_id`, `essalud`, `contact_fullname`, `contact_relationship`, `contact_address`, `contact_district_id`, `contact_country_id`, `contact_mobile`, `contact_phone`, `contact_annex`, `email_verified_at`, `password`, `confirmation_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '', 'Administrador', NULL, 'admin@preciso.pe', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-21 15:27:19', '$2y$10$R9MrGULc/CrND7.admt4BunTWtd1XZkS/0DuiWWgcP7oL3krHLDmG', 'uJ1RWt3dbmnYU3KjdJVrhMJfKcx0XuMB0MwFbpbX5fAmd6mq7Vy2Fx3pOe3v', NULL, '2020-10-21 15:27:19', '2020-10-21 15:27:19', NULL),
(2, 0, 'U2020001', 'Ricardo Joel', 'Béjar Luque', 'rbejar@preciso.pe', 1, '70689935', 2, '1989-07-14', 'Jr. Cochas 5088 - Urb. Parque Naranjal', 1160, 164, '991 267 284', NULL, NULL, NULL, 1, 4, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, NULL, NULL, '2020-10-21 15:27:19', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', 'ex9yx648XZH9hUetP0HcmscQv2HJuUSvJUgR2YlIgwASylZWVa8xZC8lMxwn', 'rwxGJc1QeB901l76Vvl2pOFSG98m8Y6fxXOFiHogpYZayvGTF8VxJnqcy5hy', '2020-10-21 15:27:19', '2021-09-07 21:36:30', NULL),
(3, 0, 'U2020002', 'Araceli Elizabeth', 'Lecca Morales', 'lm.araceli@hotmail.com', 1, '42991279', 1, '1985-04-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 51, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(4, 0, 'U2020003', 'Leny Lizeth', 'Murga Ramirez', 'leny_mr@hotmail.com\r\n', 1, '73451183\r\n', 1, '1992-09-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 52, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(5, 0, 'U2020004', 'Karito Isabel', 'Terrones Palacios', 'kari_gnr@hotmail.com\r\n', 1, '41160263\r\n', 1, '1979-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 53, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(6, 0, 'U2020005', 'Diana Carolina', 'Orbegoso Suquilanda', 'eiprel20@gmail.com\r\n', 1, '72460970\r\n', 1, '1994-04-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 54, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(7, 0, 'U2020006', 'Roxana Janett', 'Cruz Rodríguez', 'rjanettcr@gmail.com\r\n', 1, '46830428\r\n', 1, '1981-05-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 55, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(8, 0, 'U2020007', 'Jorge Alberto', 'Sánchez Cabanillas', 'jsanchez@tmt.gob.pe\r\n', 1, '40654322\r\n', 2, '1980-05-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 56, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(9, 0, 'U2020008', 'Dimas Segundo', 'Huayunga Pizuri', 'logistica@tmt.gob.pe\r\n', 1, '44098194\r\n', 2, '1987-01-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 57, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(10, 0, 'U2020009', 'María Del Carmen', 'Azabache Aguilera', 'maricarmenazabache@gmail.com\r\n', 1, '47422271\r\n', 1, '1991-12-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 58, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(11, 0, 'U2020010', 'Susan Carol', 'Ruiz Agreda', 'planeamientoypresupuesto@tmt.gob.pe\r\n', 1, '40695719\r\n', 1, '1980-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 59, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(12, 0, 'U2020011', 'Lucia Pierina', 'Mendez Vasquez', 'luciapierina_mendez@hotmail.com\r\n', 1, '74569569', 1, '1996-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 60, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(13, 1, 'U2020012', 'Amelia Guadalupe', 'Vergaray Escobar', 'agvergaraye@gmail.com\r\n', 1, '72762334\r\n', 1, '1997-09-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 61, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$R9MrGULc/CrND7.admt4BunTWtd1XZkS/0DuiWWgcP7oL3krHLDmG', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(14, 0, 'U2020013', 'Luis Junior', 'Lozano Trujillo', 'lljuniorlozanoll@icloud.com\r\n', 1, '70266135\r\n', 2, '1994-04-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 62, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(15, 0, 'U2020014', 'Lourdes Isabel', 'Depaz Lavado', 'lourdesdepaz2013@gmail.com\r\n', 1, '44206827\r\n', 1, '1987-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 63, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(16, 0, 'U2020015', 'Robert Jesús', 'Castillo Salvador', 'contabilidad@tmt.gob.pe', 1, '44178741\r\n', 2, '1987-02-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 64, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(17, 0, 'U2020016', 'Daily Judith', 'Alvarado Tuesta', 'dalvarado@tmt.gob.pe', 1, '41428489\r\n', 1, '1981-01-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 65, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(18, 0, 'U2020017', 'Jonathan', 'Torres Rodríguez', 'jcr_38@hotmail.com', 1, '74036137\r\n', 2, '1993-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 66, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(19, 0, 'U2020018', 'Gladis Mariela', 'Tantalean Olano', 'mtantalean02@gmail.com', 1, '41941858\r\n', 1, '1983-09-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 67, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(20, 0, 'U2020019', 'Yuliza Marleny', 'Torres Silva', 'yuliza2000@hotmail.com', 1, '40859581\r\n', 1, '1981-01-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 68, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(21, 0, 'U2020020', 'Jorge Jefferson', 'Barreto Jara', 'jjbarretojara@gmail.com', 1, '44659879\r\n', 2, '1987-10-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 69, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(22, 0, 'U2020021', 'Clodomiro Alexander', 'Cruzado Chávez', 'ccruzado@tmt.gob.pe', 1, '41461797\r\n', 2, '1982-04-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 70, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(23, 0, 'U2020022', 'Lily Marisell', 'Robles Arqueros', 'marisellrobles@gmail.com\r\n', 1, '41838062\r\n', 1, '1983-01-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 71, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(24, 0, 'U2020023', 'Pedro Cesar', 'Gutiérrez Otiniano', 'archivogeneral@tmt.gob.pe\r\n', 1, '17811033\r\n', 1, '1964-06-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 72, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(25, 0, 'U2020024', 'Deivis Cesar', 'Bravo Jara', 'dbravojara@gmail.com\r\n', 1, '43668447\r\n', 2, '1986-07-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 73, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL),
(26, 0, 'U2020025', 'Carmen Aurora', 'Arana Felipe', 'krmn.geminis@gmail.com\r\n', 1, '47809792\r\n', 1, '1992-06-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 74, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-09-06 15:20:36', '$2y$10$rMFmFkG9DSyaNrdb3iVpZehuMbjiTQTpeygFdT8w.4XOEELeDQggu', NULL, NULL, '2021-09-06 15:20:36', '2021-09-06 15:20:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` date NOT NULL,
  `before` double(8,2) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `after` double(8,2) NOT NULL,
  `observation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visits`
--

CREATE TABLE `visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_type_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `happen_at` datetime NOT NULL,
  `is_done` tinyint(1) NOT NULL,
  `by_reference` tinyint(1) NOT NULL,
  `code` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prop_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_user_id_foreign` (`user_id`),
  ADD KEY `activities_project_id_foreign` (`project_id`) USING BTREE,
  ADD KEY `activities_task_id_foreign` (`task_id`);

--
-- Indices de la tabla `afps`
--
ALTER TABLE `afps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `afps_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `bussiness`
--
ALTER TABLE `bussiness`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commissions_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_contact_type_id_foreign` (`contact_type_id`),
  ADD KEY `contacts_customer_id_foreign` (`customer_id`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indices de la tabla `contact_types`
--
ALTER TABLE `contact_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_name_deleted_at_unique` (`name`,`deleted_at`),
  ADD UNIQUE KEY `currencies_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `customers_business_id_foreign` (`business_id`),
  ADD KEY `customers_districts_id_foreign` (`district_id`);

--
-- Indices de la tabla `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `dependents`
--
ALTER TABLE `dependents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dependents_dependent_type_id_foreign` (`dependent_type_id`),
  ADD KEY `dependents_user_id_foreign` (`user_id`),
  ADD KEY `dependents_document_type_id_foreign` (`document_type_id`),
  ADD KEY `dependents_gender_id_foreign` (`gender_id`);

--
-- Indices de la tabla `dependent_types`
--
ALTER TABLE `dependent_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dependent_types_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_types_name_code_deleted_at_unique` (`name`,`code`,`deleted_at`);

--
-- Indices de la tabla `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_proposal_id_foreign` (`proposal_id`),
  ADD KEY `employees_profile_id_foreign` (`profile_id`);

--
-- Indices de la tabla `epss`
--
ALTER TABLE `epss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `epss_name_code_deleted_at_unique` (`name`,`code`,`deleted_at`);

--
-- Indices de la tabla `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `exchange_rates_date_deleted_at_unique` (`date`,`deleted_at`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `freelancers`
--
ALTER TABLE `freelancers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `freelancers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `freelancers_profile_id_foreign` (`profile_id`),
  ADD KEY `freelancers_document_type_id_foreign` (`document_type_id`),
  ADD KEY `freelancers_district_id_foreign` (`district_id`),
  ADD KEY `freelancers_country_id_foreign` (`country_id`),
  ADD KEY `freelancers_bank_id_foreign` (`bank_id`);

--
-- Indices de la tabla `frequencies`
--
ALTER TABLE `frequencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frequencies_name_code_deleted_at_unique` (`name`,`deleted_at`,`code`) USING BTREE;

--
-- Indices de la tabla `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genders_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `independents`
--
ALTER TABLE `independents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `independents_proposal_id_foreign` (`proposal_id`),
  ADD KEY `independents_profile_id_foreign` (`profile_id`),
  ADD KEY `independents_currency_id_foreign` (`currency_id`),
  ADD KEY `independents_exchange_rate_id_foreign` (`exchange_rate_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modes`
--
ALTER TABLE `modes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modes_name_deleted_at_unique` (`name`,`deleted_at`),
  ADD UNIQUE KEY `modes_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parameters_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profiles_name_deleted_at_unique` (`name`,`deleted_at`) USING BTREE;

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `projects_project_type_id_foreign` (`project_type_id`),
  ADD KEY `projects_customer_id_foreign` (`customer_id`),
  ADD KEY `projects_user_id_foreign` (`user_id`) USING BTREE,
  ADD KEY `projects_visit_id_foreign` (`proposal_id`);

--
-- Indices de la tabla `project_types`
--
ALTER TABLE `project_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_types_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_project_id_foreign` (`project_id`),
  ADD KEY `project_user_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proposals_prop_code_version_deleted_at_unique` (`code`,`version`,`deleted_at`) USING BTREE,
  ADD KEY `proposals_project_type_id_foreign` (`project_type_id`),
  ADD KEY `proposals_customer_id_foreign` (`customer_id`),
  ADD KEY `proposals_user_id_foreign` (`user_id`),
  ADD KEY `proposals_visit_id_foreign` (`visit_id`),
  ADD KEY `proposals_currency_id_foreign` (`pay_curr_id`) USING BTREE,
  ADD KEY `proposals_mode_id_foreign` (`pay_mode_id`),
  ADD KEY `proposals_type_id_foreign` (`pay_type_id`);

--
-- Indices de la tabla `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `providers_proposal_id_foreign` (`proposal_id`),
  ADD KEY `providers_profile_id_foreign` (`profile_id`),
  ADD KEY `providers_currency_id_foreign` (`currency_id`),
  ADD KEY `providers_exchange_rate_id_foreign` (`exchange_rate_id`);

--
-- Indices de la tabla `relationships`
--
ALTER TABLE `relationships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `relationships_name_deleted_at_unique` (`name`,`deleted_at`);

--
-- Indices de la tabla `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sellers_proposal_id_foreign` (`proposal_id`),
  ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `suppliers_profile_id_foreign` (`profile_id`),
  ADD KEY `suppliers_document_type_id_foreign` (`document_type_id`),
  ADD KEY `suppliers_district_id_foreign` (`district_id`),
  ADD KEY `suppliers_country_id_foreign` (`country_id`),
  ADD KEY `suppliers_bank_id_foreign` (`bank_id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_id_foreign` (`project_id`);

--
-- Indices de la tabla `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `types_name_deleted_at_unique` (`name`,`deleted_at`),
  ADD UNIQUE KEY `types_code_deleted_at_unique` (`code`,`deleted_at`);

--
-- Indices de la tabla `ubigeos`
--
ALTER TABLE `ubigeos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ubigeos_department_province_district_deleted_at_unique` (`department`,`province`,`district`,`deleted_at`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_deleted_at_unique` (`email`,`deleted_at`),
  ADD KEY `users_document_type_id_foreign` (`document_type_id`),
  ADD KEY `users_relationship_id_foreign` (`relationship_id`),
  ADD KEY `users_profile_id_foreign` (`profile_id`),
  ADD KEY `users_bank_id_foreign` (`bank_id`),
  ADD KEY `users_afp_id_foreign` (`afp_id`),
  ADD KEY `users_cts_id_foreign` (`cts_id`),
  ADD KEY `users_eps_id_foreign` (`eps_id`),
  ADD KEY `users_districts_id_foreign` (`district_id`),
  ADD KEY `users_gender_id_foreign` (`gender_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_commission_id_foreign` (`commission_id`),
  ADD KEY `users_contact_district_id_foreign` (`contact_district_id`),
  ADD KEY `users_contact_country_id_foreign` (`contact_country_id`),
  ADD KEY `users_frequency_id_foreign` (`frequency_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- Indices de la tabla `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variations_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visits_code_deleted_at_unique` (`code`,`deleted_at`),
  ADD KEY `visits_customer_id_foreign` (`customer_id`),
  ADD KEY `visits_project_type_id_foreign` (`project_type_id`),
  ADD KEY `visits_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `afps`
--
ALTER TABLE `afps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `bussiness`
--
ALTER TABLE `bussiness`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contact_types`
--
ALTER TABLE `contact_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dependents`
--
ALTER TABLE `dependents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dependent_types`
--
ALTER TABLE `dependent_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `epss`
--
ALTER TABLE `epss`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `exchange_rates`
--
ALTER TABLE `exchange_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `freelancers`
--
ALTER TABLE `freelancers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `frequencies`
--
ALTER TABLE `frequencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `genders`
--
ALTER TABLE `genders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `independents`
--
ALTER TABLE `independents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de la tabla `modes`
--
ALTER TABLE `modes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `project_types`
--
ALTER TABLE `project_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT de la tabla `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `relationships`
--
ALTER TABLE `relationships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ubigeos`
--
ALTER TABLE `ubigeos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1875;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
