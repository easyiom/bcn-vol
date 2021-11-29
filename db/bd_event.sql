-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2021 a las 15:53:30
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_event`
--	
   CREATE DATABASE bd_event;
-- --------------------------------------------------------
   USE bd_event;
--
-- Estructura de tabla para la tabla `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id_events` int(11) NOT NULL,
  `nom_events` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `data_ini_event` date NOT NULL,
  `data_fi_event` date NOT NULL,
  `adre_event` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `desc_event` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `ubi_event` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `foto_event` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inscri`
--

CREATE TABLE `tbl_inscri` (
  `id_inscri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_events` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE `tbl_rol` (
  `id_rol` int(11) NOT NULL,
  `nom_rol` varchar(30) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_rol`
--

INSERT INTO `tbl_rol` (`id_rol`, `nom_rol`) VALUES
(1, 'SuperUser'),
(2, 'Responsable'),
(3, 'Usuari');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuari`
--

CREATE TABLE `tbl_usuari` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass_user` varchar(40) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nom_user` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cognom_user` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dni_user` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `telf_user` varchar(9) COLLATE utf8mb4_spanish_ci NOT NULL,
  `foto_user` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `rol_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_usuari`
--

INSERT INTO `tbl_usuari` (`id_user`, `email_user`, `pass_user`, `nom_user`, `cognom_user`, `dni_user`, `telf_user`, `foto_user`, `rol_user`) VALUES
(2, 'isaac@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Isaac', 'Ortiz', '0000000Ç', '666666696', NULL, 1),
(3, 'raul@fje.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'Raul', 'Santacruz', '0000000R', '666666696', NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id_events`);

--
-- Indices de la tabla `tbl_inscri`
--
ALTER TABLE `tbl_inscri`
  ADD PRIMARY KEY (`id_inscri`),
  ADD KEY `id_user` (`id_user`,`id_events`),
  ADD KEY `id_events` (`id_events`);

--
-- Indices de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `rol_user` (`rol_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id_events` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_inscri`
--
ALTER TABLE `tbl_inscri`
  MODIFY `id_inscri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_inscri`
--
ALTER TABLE `tbl_inscri`
  ADD CONSTRAINT `tbl_inscri_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuari` (`id_user`),
  ADD CONSTRAINT `tbl_inscri_ibfk_2` FOREIGN KEY (`id_events`) REFERENCES `tbl_events` (`id_events`);

--
-- Filtros para la tabla `tbl_usuari`
--
ALTER TABLE `tbl_usuari`
  ADD CONSTRAINT `tbl_usuari_ibfk_1` FOREIGN KEY (`rol_user`) REFERENCES `tbl_rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
