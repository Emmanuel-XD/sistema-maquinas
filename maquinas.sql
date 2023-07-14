-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2023 a las 18:21:24
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
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_maquina` int(11) NOT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `horas_t` int(150) DEFAULT NULL,
  `horas_in` int(150) DEFAULT NULL,
  `horometraje_i` varchar(150) DEFAULT NULL,
  `horometraje_f` int(150) DEFAULT NULL,
  `lugar_t` varchar(150) DEFAULT NULL,
  `fallo` varchar(150) NOT NULL,
  `hora_paro` varchar(50) DEFAULT NULL,
  `hora_reinicio` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `gastos_falla` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `id_maquina`, `id_operador`, `observacion`, `horas_t`, `horas_in`, `horometraje_i`, `horometraje_f`, `lugar_t`, `fallo`, `hora_paro`, `hora_reinicio`, `fecha`, `gastos_falla`) VALUES
(105, 2, 4, 'Ninguna', 10, 5, '10', 10, 'tijuana', 'OTRO', '10', '10', '2023-07-14', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE `maquinas` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `serie` varchar(250) NOT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `maquinas`
--

INSERT INTO `maquinas` (`id`, `name`, `modelo`, `serie`, `ubicacion`, `status`, `fecha`) VALUES
(2, 'Maquina 1', '336E', '01613', 'Tren Maya', 'Activo', '2023-07-12 14:02:14'),
(10, 'Maquina 4', '336E', '0235', 'Veracruz', 'Inactivo', '2023-07-12 14:02:24'),
(11, 'Maquina2', 'ksms', 'N6519100', 'Tijuana', 'Inactivo', '2023-07-12 14:02:35'),
(12, 'Maquina 5', 'SMDK300', 'DHASFISD', 'Guadalajara', 'Activo', '2023-07-14 16:01:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` int(50) NOT NULL,
  `telefono` int(50) NOT NULL,
  `fecha de registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operadores`
--

INSERT INTO `operadores` (`id`, `nombre`, `apellido`, `edad`, `telefono`, `fecha de registro`) VALUES
(3, 'Jesus', 'Garcia Marques', 20, 2147483647, '2023-07-14 15:49:08'),
(4, 'Emmanuel', 'Gomez Chavez', 22, 54948151, '2023-07-14 15:48:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `correo`, `telefono`, `password`, `fecha`, `id_rol`) VALUES
(5, 'omar', 'omar@global.mx', 'administrador', '$2y$05$/EGr.neCjwlFVoigWRtZmO.XOLc6fcifznin0rsRugQrQR/fwcmz6', '2023-07-10 16:51:25', 1),
(9, 'ejemplo2223', 'omar@global.mx', 'empleado', '$2y$05$R7hNGFEBFOe6wZfwnAf30ulwBN2ZM7U8zsxGDPXN0R9eoP60qctS2', '2023-07-10 16:50:18', 2),
(10, 'pino', 'pino@global.mx', 'empleado', '$2y$05$Uy21f62/po/umdkKbnakfOZ/IZVCjjnuDqZZ9NOwNRbkCBacmUDKG', '2023-07-10 16:50:59', 2),
(11, 'EJEMPLODEPRUEBA', 'EJEMPLO@G.COM', 'empleado', '$2y$05$65O.l9nTHj06FgJBrvILc.3tD0zY6eDkKTyXDkj8amaZpSTlixwgS', '2023-07-10 17:02:01', 1),
(12, 'Admin', 'admin@gmail.com ', '12345', '$2y$05$GLR6QNdk/09FLAm4.Yl8B.0UFNCMac7gmtemGNw75s8OT.DfsPncy', '2023-07-11 23:19:48', 1);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de la tabla `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
