-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2021 a las 16:49:10
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calendario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `main_tasks`
--

CREATE TABLE `main_tasks` (
  `id` int(10) NOT NULL,
  `author` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `scheduled_tasks`
--

CREATE TABLE `scheduled_tasks` (
  `id` int(10) NOT NULL,
  `author` int(10) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `scheduled_tasks`
--

INSERT INTO `scheduled_tasks` (`id`, `author`, `title`, `description`, `created`, `modified`, `start`, `end`) VALUES
(5, NULL, 'All Day Event', NULL, NULL, NULL, '2021-06-01 09:27:19', NULL),
(6, NULL, 'Long Event', NULL, NULL, NULL, '2021-06-07 09:27:19', '2021-06-10 09:27:19'),
(7, NULL, 'Repeating Event', NULL, NULL, NULL, '2021-06-09 09:27:19', NULL),
(8, NULL, 'Repeating Event', NULL, NULL, NULL, '2021-06-16 09:27:19', NULL),
(9, NULL, 'Conference', NULL, NULL, NULL, '2021-06-11 09:27:19', '2021-06-13 09:27:19'),
(10, NULL, 'All Day Event', NULL, NULL, NULL, '2021-06-01 09:27:19', NULL),
(11, NULL, 'Long Event', NULL, NULL, NULL, '2021-06-07 09:27:19', '2021-06-10 09:27:19'),
(12, NULL, 'Repeating Event', NULL, NULL, NULL, '2021-06-09 09:27:19', NULL),
(13, NULL, 'Repeating Event', NULL, NULL, NULL, '2021-06-16 09:27:19', NULL),
(14, NULL, 'Conference', NULL, NULL, NULL, '2021-06-11 09:27:19', '2021-06-13 09:27:19'),
(15, NULL, 'Meeting', NULL, NULL, NULL, '2021-06-12 09:30:24', NULL),
(16, NULL, 'Lunch', NULL, NULL, NULL, '2021-06-12 09:30:24', NULL),
(17, NULL, 'Meeting', NULL, NULL, NULL, '2021-06-12 09:30:53', NULL),
(18, NULL, 'Happy Hour', NULL, NULL, NULL, '2021-06-12 09:30:53', NULL),
(19, NULL, 'Birthday Party', NULL, NULL, NULL, '2021-06-13 09:30:53', NULL),
(20, NULL, 'Click for Google', NULL, NULL, NULL, '2021-06-28 09:30:53', NULL),
(21, NULL, 'Meeting', NULL, NULL, NULL, '2021-06-12 09:30:24', NULL),
(22, NULL, 'Lunch', NULL, NULL, NULL, '2021-06-12 09:30:24', NULL),
(23, NULL, 'Meeting', NULL, NULL, NULL, '2021-06-12 09:30:53', NULL),
(24, NULL, 'Happy Hour', NULL, NULL, NULL, '2021-06-12 09:30:53', NULL),
(25, NULL, 'Birthday Party', NULL, NULL, NULL, '2021-06-13 09:30:53', NULL),
(26, NULL, 'Click for Google', NULL, NULL, NULL, '2021-06-28 09:30:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `primer_apellido` varchar(100) NOT NULL,
  `segundo_apellido` varchar(100) NOT NULL,
  `nombreusuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `activado` tinyint(1) NOT NULL,
  `ultimavisita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `main_tasks`
--
ALTER TABLE `main_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_autor` (`author`);

--
-- Indices de la tabla `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_autor` (`author`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `main_tasks`
--
ALTER TABLE `main_tasks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
