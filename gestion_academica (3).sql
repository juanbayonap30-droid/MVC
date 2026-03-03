-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2026 a las 14:42:16
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
-- Base de datos: `gestion_academica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambiente`
--

CREATE TABLE `ambiente` (
  `amb_id` varchar(5) NOT NULL,
  `amb_nombre` varchar(45) DEFAULT NULL,
  `SEDE_sede_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ambiente`
--

INSERT INTO `ambiente` (`amb_id`, `amb_nombre`, `SEDE_sede_id`) VALUES
('A101', 'Laboratorio Sistemas', 1),
('B201', 'Aula Contable', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE `asignacion` (
  `ASIG_ID` int(11) NOT NULL,
  `INSTRUCTOR_inst_id` int(11) DEFAULT NULL,
  `asig_fecha_ini` datetime DEFAULT NULL,
  `asig_fecha_fin` datetime DEFAULT NULL,
  `FICHA_fich_id` int(11) DEFAULT NULL,
  `AMBIENTE_amb_id` varchar(5) DEFAULT NULL,
  `COMPETENCIA_comp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignacion`
--

INSERT INTO `asignacion` (`ASIG_ID`, `INSTRUCTOR_inst_id`, `asig_fecha_ini`, `asig_fecha_fin`, `FICHA_fich_id`, `AMBIENTE_amb_id`, `COMPETENCIA_comp_id`) VALUES
(2, 2, '2026-02-03 00:00:00', '2026-03-12 00:00:00', 1, 'A101', 1),
(3, 1, '2026-02-03 00:00:00', '2026-02-10 00:00:00', 2, 'B201', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_formacion`
--

CREATE TABLE `centro_formacion` (
  `cent_id` int(11) NOT NULL,
  `cent_nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centro_formacion`
--

INSERT INTO `centro_formacion` (`cent_id`, `cent_nombre`) VALUES
(1, 'Centro de Comercio y Servicios'),
(2, 'Centro de Desarrollo Tecnológico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `comp_id` int(11) NOT NULL,
  `comp_nombre_corto` varchar(30) DEFAULT NULL,
  `comp_horas` int(11) DEFAULT NULL,
  `comp_nombre_unidad_competencia` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencia`
--

INSERT INTO `competencia` (`comp_id`, `comp_nombre_corto`, `comp_horas`, `comp_nombre_unidad_competencia`) VALUES
(1, 'Base de Datos', 120, 'Diseñar bases de datos según requerimientos'),
(2, 'Programación Web', 150, 'Desarrollar aplicaciones web según especificaciones'),
(3, 'Contabilidad Básica', 100, 'Registrar operaciones contables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competxprograma`
--

CREATE TABLE `competxprograma` (
  `PROGRAMA_prog_id` int(11) NOT NULL,
  `COMPETENCIA_comp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competxprograma`
--

INSERT INTO `competxprograma` (`PROGRAMA_prog_id`, `COMPETENCIA_comp_id`) VALUES
(1, 1),
(1, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinacion`
--

CREATE TABLE `coordinacion` (
  `coord_id` int(11) NOT NULL,
  `coord_descripcion` varchar(45) DEFAULT NULL,
  `coord_password` varchar(45) NOT NULL,
  `CENTRO_FORMACION_cent_id` int(11) DEFAULT NULL,
  `coord_nombre_coordinador` varchar(45) DEFAULT NULL,
  `coord_correo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coordinacion`
--

INSERT INTO `coordinacion` (`coord_id`, `coord_descripcion`, `coord_password`, `CENTRO_FORMACION_cent_id`, `coord_nombre_coordinador`, `coord_correo`) VALUES
(1, 'Coordinación Sistemas', '', 2, NULL, NULL),
(2, 'Coordinación Administración', '', 1, NULL, NULL),
(3, 'juan', '$2y$10$fN7SVn.G4RbwV8Zr1RK8ZevBz.qX/yqXgx/PKe', 2, NULL, NULL),
(4, 'Coordinador', '$2y$10$ztp1YDqW/etD/OZiUg7U..AfpL5Tkq4qBc99Wi', NULL, 'edward', 'edward@gmail.com'),
(5, 'Coordinador', '$2y$10$6qOQtBT0I6kvZZ8vFUsvkOpPceWN2sHaEfnhMw', NULL, 'mauricio', 'mauricio@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_asignacion`
--

CREATE TABLE `detalle_asignacion` (
  `detasig_id` int(11) NOT NULL,
  `ASIGNACION_ASIG_ID` int(11) DEFAULT NULL,
  `detasig_hora_ini` datetime DEFAULT NULL,
  `detasig_hora_fin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `fich_id` int(11) NOT NULL,
  `PROGRAMA_prog_id` int(11) DEFAULT NULL,
  `INSTRUCTOR_inst_id_lider` int(11) DEFAULT NULL,
  `fich_jornada` varchar(20) DEFAULT NULL,
  `COORDINACION_coord_id` int(11) DEFAULT NULL,
  `fich_fecha_ini_lectiva` date DEFAULT NULL,
  `fich_fecha_fin_lectiva` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`fich_id`, `PROGRAMA_prog_id`, `INSTRUCTOR_inst_id_lider`, `fich_jornada`, `COORDINACION_coord_id`, `fich_fecha_ini_lectiva`, `fich_fecha_fin_lectiva`) VALUES
(1, 1, 1, 'Mañana', 1, NULL, NULL),
(2, 2, 2, 'Tarde', 2, NULL, NULL),
(4, 1, 1, 'Mixta', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `inst_id` int(11) NOT NULL,
  `inst_nombres` varchar(45) DEFAULT NULL,
  `inst_apellidos` varchar(45) DEFAULT NULL,
  `inst_correo` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `inst_telefono` bigint(10) DEFAULT NULL,
  `CENTRO_FORMACION_cent_id` int(11) DEFAULT NULL,
  `inst_password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`inst_id`, `inst_nombres`, `inst_apellidos`, `inst_correo`, `password`, `inst_telefono`, `CENTRO_FORMACION_cent_id`, `inst_password`) VALUES
(1, 'Carlos', 'Martínez', 'carlos.martinez@sena.edu.co', '123456', 3001234567, 2, NULL),
(2, 'Laura', 'Gómez', 'laura.gomez@sena.edu.co', '', 3019876543, 1, NULL),
(4, 'Carlos', 'Rodriguez', 'carlos@sena.edu.co', '', 3001234567, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.o'),
(5, 'Laura', 'Martinez', 'laura@sena.edu.co', '', 3007654321, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.o');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instru_competencia`
--

CREATE TABLE `instru_competencia` (
  `inscomp_id` int(11) NOT NULL,
  `INSTRUCTOR_inst_id` int(11) NOT NULL,
  `COMPETXPROGRAMA_PROGRAMA_prog_id` int(11) NOT NULL,
  `COMPETXPROGRAMA_COMPETENCIA_comp_id` int(11) NOT NULL,
  `inscomp_vigencia` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `prog_codigo` int(11) NOT NULL,
  `prog_denominacion` varchar(100) NOT NULL,
  `TIT_PROGRAMA_titpro_id` int(11) DEFAULT NULL,
  `prog_tipo` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`prog_codigo`, `prog_denominacion`, `TIT_PROGRAMA_titpro_id`, `prog_tipo`) VALUES
(1, 'Análisis y Desarrollo de Software', 1, 'Presencial'),
(2, 'Gestión Administrativa', 2, 'Virtual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `sede_id` int(11) NOT NULL,
  `sede_nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`sede_id`, `sede_nombre`) VALUES
(1, 'Sede Principal'),
(2, 'Sede Norte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo_programa`
--

CREATE TABLE `titulo_programa` (
  `titpro_id` int(11) NOT NULL,
  `titpro_nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `titulo_programa`
--

INSERT INTO `titulo_programa` (`titpro_id`, `titpro_nombre`) VALUES
(1, 'Tecnólogo'),
(2, 'Técnico');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD PRIMARY KEY (`amb_id`),
  ADD KEY `SEDE_sede_id` (`SEDE_sede_id`);

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`ASIG_ID`),
  ADD KEY `INSTRUCTOR_inst_id` (`INSTRUCTOR_inst_id`),
  ADD KEY `FICHA_fich_id` (`FICHA_fich_id`),
  ADD KEY `AMBIENTE_amb_id` (`AMBIENTE_amb_id`),
  ADD KEY `COMPETENCIA_comp_id` (`COMPETENCIA_comp_id`);

--
-- Indices de la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  ADD PRIMARY KEY (`cent_id`);

--
-- Indices de la tabla `competencia`
--
ALTER TABLE `competencia`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indices de la tabla `competxprograma`
--
ALTER TABLE `competxprograma`
  ADD PRIMARY KEY (`PROGRAMA_prog_id`,`COMPETENCIA_comp_id`),
  ADD KEY `COMPETENCIA_comp_id` (`COMPETENCIA_comp_id`);

--
-- Indices de la tabla `coordinacion`
--
ALTER TABLE `coordinacion`
  ADD PRIMARY KEY (`coord_id`),
  ADD KEY `CENTRO_FORMACION_cent_id` (`CENTRO_FORMACION_cent_id`);

--
-- Indices de la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  ADD PRIMARY KEY (`detasig_id`),
  ADD KEY `ASIGNACION_ASIG_ID` (`ASIGNACION_ASIG_ID`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`fich_id`),
  ADD KEY `PROGRAMA_prog_id` (`PROGRAMA_prog_id`),
  ADD KEY `INSTRUCTOR_inst_id_lider` (`INSTRUCTOR_inst_id_lider`),
  ADD KEY `COORDINACION_coord_id` (`COORDINACION_coord_id`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`inst_id`),
  ADD KEY `CENTRO_FORMACION_cent_id` (`CENTRO_FORMACION_cent_id`);

--
-- Indices de la tabla `instru_competencia`
--
ALTER TABLE `instru_competencia`
  ADD PRIMARY KEY (`inscomp_id`),
  ADD KEY `idx_instructor` (`INSTRUCTOR_inst_id`),
  ADD KEY `idx_comp_prog` (`COMPETXPROGRAMA_PROGRAMA_prog_id`,`COMPETXPROGRAMA_COMPETENCIA_comp_id`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`prog_codigo`),
  ADD KEY `TIT_PROGRAMA_titpro_id` (`TIT_PROGRAMA_titpro_id`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`sede_id`);

--
-- Indices de la tabla `titulo_programa`
--
ALTER TABLE `titulo_programa`
  ADD PRIMARY KEY (`titpro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `ASIG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centro_formacion`
--
ALTER TABLE `centro_formacion`
  MODIFY `cent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `competencia`
--
ALTER TABLE `competencia`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `coordinacion`
--
ALTER TABLE `coordinacion`
  MODIFY `coord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  MODIFY `detasig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `fich_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `inst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `instru_competencia`
--
ALTER TABLE `instru_competencia`
  MODIFY `inscomp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `prog_codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `sede_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `titulo_programa`
--
ALTER TABLE `titulo_programa`
  MODIFY `titpro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ambiente`
--
ALTER TABLE `ambiente`
  ADD CONSTRAINT `ambiente_ibfk_1` FOREIGN KEY (`SEDE_sede_id`) REFERENCES `sede` (`sede_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD CONSTRAINT `asignacion_ibfk_1` FOREIGN KEY (`INSTRUCTOR_inst_id`) REFERENCES `instructor` (`inst_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_ibfk_2` FOREIGN KEY (`FICHA_fich_id`) REFERENCES `ficha` (`fich_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_ibfk_3` FOREIGN KEY (`AMBIENTE_amb_id`) REFERENCES `ambiente` (`amb_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `asignacion_ibfk_4` FOREIGN KEY (`COMPETENCIA_comp_id`) REFERENCES `competencia` (`comp_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `competxprograma`
--
ALTER TABLE `competxprograma`
  ADD CONSTRAINT `competxprograma_ibfk_1` FOREIGN KEY (`PROGRAMA_prog_id`) REFERENCES `programa` (`prog_codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `competxprograma_ibfk_2` FOREIGN KEY (`COMPETENCIA_comp_id`) REFERENCES `competencia` (`comp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `coordinacion`
--
ALTER TABLE `coordinacion`
  ADD CONSTRAINT `coordinacion_ibfk_1` FOREIGN KEY (`CENTRO_FORMACION_cent_id`) REFERENCES `centro_formacion` (`cent_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_asignacion`
--
ALTER TABLE `detalle_asignacion`
  ADD CONSTRAINT `detalle_asignacion_ibfk_1` FOREIGN KEY (`ASIGNACION_ASIG_ID`) REFERENCES `asignacion` (`ASIG_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`PROGRAMA_prog_id`) REFERENCES `programa` (`prog_codigo`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_ibfk_2` FOREIGN KEY (`INSTRUCTOR_inst_id_lider`) REFERENCES `instructor` (`inst_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ficha_ibfk_3` FOREIGN KEY (`COORDINACION_coord_id`) REFERENCES `coordinacion` (`coord_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`CENTRO_FORMACION_cent_id`) REFERENCES `centro_formacion` (`cent_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `instru_competencia`
--
ALTER TABLE `instru_competencia`
  ADD CONSTRAINT `fk_instcomp_instructor` FOREIGN KEY (`INSTRUCTOR_inst_id`) REFERENCES `instructor` (`inst_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_instcomp_relacion` FOREIGN KEY (`COMPETXPROGRAMA_PROGRAMA_prog_id`,`COMPETXPROGRAMA_COMPETENCIA_comp_id`) REFERENCES `competxprograma` (`PROGRAMA_prog_id`, `COMPETENCIA_comp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `programa_ibfk_1` FOREIGN KEY (`TIT_PROGRAMA_titpro_id`) REFERENCES `titulo_programa` (`titpro_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
