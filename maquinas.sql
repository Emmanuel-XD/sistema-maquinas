-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 06:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maquinas`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `id_maquina` int(11) NOT NULL,
  `id_operador` int(11) DEFAULT NULL,
  `observacion` varchar(250) DEFAULT NULL,
  `horas_t` int(150) DEFAULT NULL,
  `horas_in` int(150) DEFAULT NULL,
  `horometraje_i` time DEFAULT NULL,
  `horometraje_f` time DEFAULT NULL,
  `lugar_t` varchar(150) DEFAULT NULL,
  `fallo` varchar(150) NOT NULL,
  `hora_paro` time DEFAULT NULL,
  `hora_reinicio` time DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `gastos_falla` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventario`
--

INSERT INTO `inventario` (`id`, `id_maquina`, `id_operador`, `observacion`, `horas_t`, `horas_in`, `horometraje_i`, `horometraje_f`, `lugar_t`, `fallo`, `hora_paro`, `hora_reinicio`, `fecha`, `gastos_falla`) VALUES
(107, 2, 0, '', 0, 0, '00:00:00', '00:00:00', '', '', '00:00:00', '00:00:00', '0000-00-00', ''),
(108, 2, 3, 'ninguna', 42, 2, '06:00:00', '00:00:00', 'Tijuana', 'SIN FALLAS', '08:00:00', '00:00:00', '2023-07-21', '0');

-- --------------------------------------------------------

--
-- Table structure for table `maquinas`
--

CREATE TABLE `maquinas` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `modelo` varchar(250) NOT NULL,
  `serie` varchar(250) NOT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maquinas`
--

INSERT INTO `maquinas` (`id`, `name`, `modelo`, `serie`, `ubicacion`, `status`, `fecha`) VALUES
(2, 'Maquina 1', '336E', '01613', 'Tren Maya', 'Activo', '2023-07-12 14:02:14'),
(10, 'Maquina 4', '336E', '0235', 'Veracruz', 'Inactivo', '2023-07-12 14:02:24'),
(11, 'Maquina 2', 'ksms', 'N6519100', 'Tijuana', 'Inactivo', '2023-07-19 15:53:51'),
(12, 'Maquina 5', 'SMDK300', 'DHASFISD', 'Guadalajara', 'Activo', '2023-07-14 16:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `operadores`
--

CREATE TABLE `operadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` int(50) NOT NULL,
  `telefono` int(50) NOT NULL,
  `fecha de registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `operadores`
--

INSERT INTO `operadores` (`id`, `nombre`, `apellido`, `edad`, `telefono`, `fecha de registro`) VALUES
(3, 'Jesus', 'Garcia Marques', 20, 2147483647, '2023-07-14 15:49:08'),
(4, 'Emmanuel', 'Gomez Chavez', 22, 54948151, '2023-07-14 15:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`id`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Empleado');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usuario`, `correo`, `telefono`, `password`, `fecha`, `id_rol`) VALUES
(5, 'omar', 'omar@global.mx', 'administrador', '$2y$05$/EGr.neCjwlFVoigWRtZmO.XOLc6fcifznin0rsRugQrQR/fwcmz6', '2023-07-10 16:51:25', 1),
(9, 'ejemplo2223', 'omar@global.mx', 'empleado', '$2y$05$R7hNGFEBFOe6wZfwnAf30ulwBN2ZM7U8zsxGDPXN0R9eoP60qctS2', '2023-07-10 16:50:18', 2),
(10, 'pino', 'pino@global.mx', 'empleado', '$2y$05$Uy21f62/po/umdkKbnakfOZ/IZVCjjnuDqZZ9NOwNRbkCBacmUDKG', '2023-07-10 16:50:59', 2),
(11, 'EJEMPLODEPRUEBA', 'EJEMPLO@G.COM', 'empleado', '$2y$05$65O.l9nTHj06FgJBrvILc.3tD0zY6eDkKTyXDkj8amaZpSTlixwgS', '2023-07-10 17:02:01', 1),
(12, 'Admin', 'admin@gmail.com ', '12345', '$2y$05$GLR6QNdk/09FLAm4.Yl8B.0UFNCMac7gmtemGNw75s8OT.DfsPncy', '2023-07-11 23:19:48', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operadores`
--
ALTER TABLE `operadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `operadores`
--
ALTER TABLE `operadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
