-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2023 a las 16:40:40
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `maquinas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acarreos`
--

CREATE TABLE `acarreos` (
  `id` int(11) NOT NULL,
  `folio` varchar(50) NOT NULL,
  `transporte` varchar(50) NOT NULL,
  `placa` varchar(150) NOT NULL,
  `cant` varchar(50) NOT NULL,
  `material` varchar(250) NOT NULL,
  `image1` varchar(250) NOT NULL,
  `image2` varchar(250) NOT NULL,
  `user` varchar(50) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `id_maquina` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `datetime` datetime NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_maquina`, `status`, `inicio`, `fin`, `datetime`, `usuario`) VALUES
(1, 2, 'Mantenimiento Relizado', '2023-08-09', '2023-08-11', '2023-08-12 05:32:42', 'admin'),
(2, 10, 'Mantenimiento Realizado', '2023-07-01', '2023-07-08', '2023-08-12 05:32:42', 'admin'),
(3, 2, 'Mantenimiento Relizado', '2023-07-01', '2023-07-03', '2023-08-12 05:41:41', 'admin'),
(4, 11, 'Mantenimiento Relizado', '2023-06-01', '2023-08-21', '2023-08-21 00:00:00', 'admin '),
(5, 11, 'Mantenimiento Relizado', '2023-06-02', '2023-08-21', '2023-08-21 00:00:00', 'admin '),
(6, 2, 'Mantenimiento Relizado', '2023-06-01', '2023-07-01', '2023-08-21 00:00:00', 'admin '),
(8, 10, 'Mantenimiento Relizado', '2023-08-21', '2023-09-01', '2023-08-21 20:24:50', 'admin ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_maquina` int(11) NOT NULL,
  `id_operador` int(11) NOT NULL,
  `observacion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `horas_t` int(150) DEFAULT NULL,
  `horas_in` int(150) DEFAULT NULL,
  `horometraje_i` int(50) DEFAULT NULL,
  `horometraje_f` int(50) DEFAULT NULL,
  `lugar_t` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fallo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `hora_paro` time DEFAULT NULL,
  `hora_reinicio` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `gastos_falla` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `responsable_falla` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_maquina`, `id_operador`, `observacion`, `horas_t`, `horas_in`, `horometraje_i`, `horometraje_f`, `lugar_t`, `fallo`, `hora_paro`, `hora_reinicio`, `fecha`, `gastos_falla`, `responsable_falla`) VALUES
(149, 2, 3, 'funciona perfectamente', 9, 2, 6319, 6328, 'Tren maya', 'servicios,voladuras,sin falla', '00:00:00', '00:00:00', '2023-07-01', '', ''),
(151, 2, 3, 'funciona perfectamente ', 6, 0, 6328, 6334, 'Tren maya', 'sin falla', '00:00:00', '00:00:00', '2023-07-02', '', ''),
(152, 2, 4, 'nada', 14, 0, 6334, 6348, 'Tren maya', '', '00:00:00', '00:00:00', '2023-07-03', '', ''),
(153, 2, 3, 'todo esta en orden  ', 11, 0, 6348, 6359, 'Tren maya', 'sin falla', '00:00:00', '00:00:00', '2023-07-04', '', ''),
(155, 2, 3, 'funciona perfectamente ', 12, 0, 6359, 6371, 'Tren maya', 'sin falla', '00:00:00', '00:00:00', '2023-07-05', '', ''),
(156, 2, 3, 'sigue funcionando bien', 10, 0, 6371, 6381, 'Tren maya', 'sin falla', '00:00:00', '00:00:00', '2023-07-06', '', ''),
(157, 2, 3, 'maquina en buen funcionamiento', 11, 0, 6381, 6392, 'Tren maya', 'sin falla', '00:00:00', '00:00:00', '2023-07-07', '', ''),
(158, 2, 3, 'se trabajo medio día por mi cumpleaños', 6, 0, 6392, 6398, 'Tren maya', 'sin falla', '14:00:00', '00:00:00', '2023-07-08', '', ''),
(159, 2, 3, 'no se presento el operador ', 0, 10, 6398, 6398, 'Tren maya', 'operador', '00:00:00', '00:00:00', '2023-07-09', '', ''),
(160, 2, 3, 'todo en orden', 7, 0, 6398, 6405, 'Tren maya', 'sin falla', '00:00:00', '00:00:00', '2023-07-10', '', ''),
(162, 10, 6, 'se rompió la manguera ', 8, 2, 3279, 3287, 'Tren maya', 'mangueras', '17:00:00', '00:00:00', '2023-07-01', '', ''),
(163, 10, 6, 'esta en reparación ', 0, 10, 3287, 3287, 'Tren maya', 'mangueras', '00:00:00', '00:00:00', '2023-07-02', '', ''),
(407, 10, 3, 'Ninguna1', 10, 2, 1000, 258, 'banco de material acc2', '', '21:10:00', '21:06:00', '2023-08-11', '0', 'Global'),
(408, 11, 7, '1111', 100, 2, 10000, 55572, 'tramo', 'mecanica,operador,diesel', '21:09:00', '18:12:00', '2023-08-11', '10', 'empresa'),
(409, 14, 6, '10', 10, 124, 101, 10, 'banco de material acc2', 'mecanica,aceite,falta valvula-pago,cabezal-pago', '18:23:00', '18:27:00', '2023-08-24', '10', 'Global'),
(410, 12, 9, 'kkl-j-', 56, 786, 756756, 767676, 'banco de material acc2', 'mecanica,operador,diesel,falta valvula', '18:38:00', '20:35:00', '2023-08-11', '10', 'empresa'),
(411, 11, 6, '44554', 8998, 78, 78785775, 578, 'banco de material tulum', 'operador, clima, cabezal-pago, sin falla', '22:39:00', '23:39:00', '2023-08-11', '10', 'Global'),
(412, 2, 4, 'Ninguna', 442, 44, 10, 10, 'banco de material acc2', 'mecanica, fractura de bote, voladuras, cabezal-pago', '18:44:00', '18:44:00', '2023-08-11', '10', 'empresa'),
(413, 10, 6, '688', 68, 56, 86, 86, 'Tren maya', 'mecanica,operador,voladuras,cabezal-pago', '18:44:00', '18:45:00', '2023-08-25', '666', 'Global'),
(414, 14, 4, 'Ninguna', 10, 10, 142755, 657375, 'banco de material acc2', 'mecanica,operador,mangueras,clima,voladuras', '10:45:00', '08:48:00', '2023-08-21', '100', 'Global'),
(415, 12, 6, '0', 10, 2, 224242, 42042, 'Tren maya', 'operador,aceite,mangueras,cabezal,pago', '09:17:00', '09:21:00', '2023-08-21', '0', 'Global'),
(416, 14, 4, 'Ninguna1', 10, 2, 120, 752075, 'banco de material acc2', 'diesel,bote,mangueras', '13:03:00', '15:03:00', '2023-08-21', '0', 'Global'),
(417, 14, 3, 'Ninguna1', 10, 5, 10, 20, 'Tren maya', 'servicios,tramo,mangueras', '13:05:00', '12:08:00', '2023-08-21', '2222', 'Global'),
(418, 14, 3, 'Ninguna', 10, 20, 10, 22, 'banco de material acc2', 'mangueras,voladuras,cabezal,pago', '12:19:00', '12:19:00', '2023-08-10', '10', 'Global');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `modelo` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `serie` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `ubicacion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`id`, `name`, `modelo`, `serie`, `ubicacion`, `status`, `fecha`) VALUES
(2, 'Maquina 1', '336E', 'CAT0336EHBZY01613', 'Tren maya', 'Inactivo', '2023-08-03 19:54:25'),
(10, 'Maquina 4', '336E', 'CAT0336ECYEP00235', 'Tren maya', 'Activo', '2023-08-08 17:01:28'),
(11, 'Maquina 5', '330D', 'CAT0330DLB6H00252', 'Tren maya', 'Inactivo', '2023-08-03 23:39:08'),
(12, 'Maquina 6', 'PC390LC-8M0 KOMATSU', '83578', 'Tren maya', 'Activo', '2023-07-31 16:20:36'),
(14, 'Maquina 7', 'PC390LC-8M0 KOMATSU', '83617', 'banco de material acc2', 'Activo', '2023-07-31 17:34:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `edad` int(50) NOT NULL,
  `telefono` int(50) NOT NULL,
  `fecha de registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `operadores`
--

INSERT INTO `operadores` (`id`, `nombre`, `apellido`, `edad`, `telefono`, `fecha de registro`) VALUES
(3, 'Joaquin', 'Garcia Marques', 20, 2147483647, '2023-07-24 17:46:47'),
(4, 'Erick', 'Gomez Chavez', 22, 54948151, '2023-07-24 17:46:30'),
(6, 'Domingo', 'sierra', 45, 554567896, '2023-07-21 23:10:19'),
(7, 'Jose', 'aguilar', 33, 33333, '2023-07-26 21:56:50'),
(9, 'Sin operador', '-', 0, 12345, '2023-07-27 00:06:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `correo`, `telefono`, `password`, `fecha`, `id_rol`) VALUES
(5, 'Omar', 'omar.rodriguez@a.mx', 'Administrador', '$2y$05$UxN47LMLv9hUyRkTEuHPR.ms42Qceaw/LdLgeo2xDfvD8tuxg6Zp2', '2023-08-10 18:20:16', 1),
(10, 'Pino', 'pino@global.mx', 'Empleado', '$2y$05$h2fXdJV6vHMDXdYThGxGjOc696lBIfbIyceKyeWSSO9YN1QppTRlq', '2023-07-25 14:58:42', 2),
(12, 'admin', 'ricardo.garcia@gl.mx', '12345', '$2y$05$Grln/f.IBgVtg2gzpnDMD.ceKYjnLBasnx3KfbN7J84AdWGudpigW', '2023-08-10 18:19:53', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acarreos`
--
ALTER TABLE `acarreos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `operadores`
--
ALTER TABLE `operadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acarreos`
--
ALTER TABLE `acarreos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
