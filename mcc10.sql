-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-05-2025 a las 05:33:54
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
-- Base de datos: `mcc10`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Documentos`
--

CREATE TABLE `Documentos` (
  `ID_documento` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `observacion` varchar(150) NOT NULL,
  `archivo_url` varchar(150) NOT NULL,
  `fecha_alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `Documentos`
--

INSERT INTO `Documentos` (`ID_documento`, `ID_user`, `observacion`, `archivo_url`, `fecha_alta`) VALUES
(16, 3, 'Corazón Paciente', 'documentos_archivos/ATMUwZijDhnvbYh7kgBcT3IYP4UmKnauLs2EXk71.png', '2025-05-18'),
(17, 5, 'Corazón Facultativo', 'documentos_archivos/swcKD4hHTv9WYRx77mK7OD8D6i38Vu3P9Tmy0u49.png', '2025-05-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Enlaces`
--

CREATE TABLE `Enlaces` (
  `ID_enlace` int(11) NOT NULL,
  `ID_user` int(11) DEFAULT NULL,
  `nombre_url` varchar(100) DEFAULT NULL,
  `ruta_enlace` text NOT NULL,
  `observacion_url` text DEFAULT NULL,
  `fecha_alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Enlaces`
--

INSERT INTO `Enlaces` (`ID_enlace`, `ID_user`, `nombre_url`, `ruta_enlace`, `observacion_url`, `fecha_alta`) VALUES
(11, 1, 'Seguridad Social', 'https://www.seg-social.es/wps/portal/wss/internet/Inicio', 'General', '2025-05-21'),
(14, 5, 'clicsalud', 'https://www.sspa.juntadeandalucia.es/servicioandaluzdesalud/clicsalud', 'Aquí puede consultar los resultados de las pruebas analíticas que consten en su historia electrónica.', '2025-05-20'),
(15, 4, 'Salud Digital', 'https://www.sanidad.gob.es/areas/saludDigital/home.htm', 'Servicios Digitales para la ciudadanía', '2025-05-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Especialidades`
--

CREATE TABLE `Especialidades` (
  `ID_especialidad` int(11) NOT NULL,
  `nombre_especialidad` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Especialidades`
--

INSERT INTO `Especialidades` (`ID_especialidad`, `nombre_especialidad`, `descripcion`) VALUES
(1, 'Cardiología', 'Especialidad médica que se ocupa del corazón y demás'),
(2, 'Dermatología', 'Especialidad en la piel y enfermedades cutáneas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facultativos`
--

CREATE TABLE `Facultativos` (
  `ID_facultativo` int(11) NOT NULL,
  `ID_user` int(11) DEFAULT NULL,
  `ID_especialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Facultativos`
--

INSERT INTO `Facultativos` (`ID_facultativo`, `ID_user`, `ID_especialidad`) VALUES
(1, 5, 1),
(2, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Facultativos_Autorizados`
--

CREATE TABLE `Facultativos_Autorizados` (
  `ID_autorizado` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `ID_facultativo` int(11) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Facultativos_Autorizados`
--

INSERT INTO `Facultativos_Autorizados` (`ID_autorizado`, `ID_user`, `ID_facultativo`, `fecha_alta`, `activo`) VALUES
(1, 3, 1, '2025-05-19', 1),
(2, 4, 2, '2025-05-15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `ID_user` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_user` enum('paciente','facultativo','admin') NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`ID_user`, `nombre`, `apellidos`, `telefono`, `email`, `password`, `tipo_user`, `fecha_alta`, `activo`) VALUES
(1, 'Ana', 'Martínez López', '612345678', 'admin01@example.com', '$2y$12$cbYHfBySdspuS88XtI0WZexFEAWS4Z4FIfBAjxjjlO8iWTJ/C8/U.', 'admin', '2025-05-18', 1),
(2, 'Javier', 'Gómez Torres', '645987321', 'admin02@example.com', '$2y$12$lgudBvEhlLOlzcMj9LYCnOz5hsJGeudfllTEf9YSxO7z0bBYg32/e', 'admin', '2025-05-18', 1),
(3, 'Laura', 'Ruiz Fernández', '699112230', 'paciente01@example.com', '$2y$12$2Rjtr5/yq81nEm0GUPoa9OTfVAROu.x1B6UAOV20N.ItXwKovE3yC', 'paciente', '2025-05-21', 1),
(4, 'Marcos', 'Pérez Rodríguez', '633221100', 'paciente02@example.com', '$2y$12$nmxv6ggNKbaedeZopZkpjOjEstX28Xjj8.Ahd4usJ3wskgG2NnVMG', 'paciente', '2025-05-18', 1),
(5, 'Carmen', 'Díaz Romero', '655443323', 'facultativo01@example.com', '$2y$12$6sRY5Fbm3bbGDL02Wpy.s.KBFTj4Oo3O37KIr3glQ3qUdUJtP8WUG', 'facultativo', '2025-05-21', 1),
(6, 'Pablo', 'Navarro García', '600778899', 'facultativo02@example.com', '$2y$12$Vp4wrRpemkIuH2ULCnHtkOY5d9RlheLEnFss6AiEyQSiz0BosUsAa', 'facultativo', '2025-05-18', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Documentos`
--
ALTER TABLE `Documentos`
  ADD PRIMARY KEY (`ID_documento`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indices de la tabla `Enlaces`
--
ALTER TABLE `Enlaces`
  ADD PRIMARY KEY (`ID_enlace`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indices de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  ADD PRIMARY KEY (`ID_especialidad`);

--
-- Indices de la tabla `Facultativos`
--
ALTER TABLE `Facultativos`
  ADD PRIMARY KEY (`ID_facultativo`),
  ADD KEY `ID_user` (`ID_user`),
  ADD KEY `ID_especialidad` (`ID_especialidad`);

--
-- Indices de la tabla `Facultativos_Autorizados`
--
ALTER TABLE `Facultativos_Autorizados`
  ADD PRIMARY KEY (`ID_autorizado`),
  ADD KEY `ID_user` (`ID_user`),
  ADD KEY `ID_facultativo` (`ID_facultativo`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Documentos`
--
ALTER TABLE `Documentos`
  MODIFY `ID_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `Enlaces`
--
ALTER TABLE `Enlaces`
  MODIFY `ID_enlace` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `Especialidades`
--
ALTER TABLE `Especialidades`
  MODIFY `ID_especialidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Facultativos`
--
ALTER TABLE `Facultativos`
  MODIFY `ID_facultativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `Facultativos_Autorizados`
--
ALTER TABLE `Facultativos_Autorizados`
  MODIFY `ID_autorizado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `ID_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Documentos`
--
ALTER TABLE `Documentos`
  ADD CONSTRAINT `Documentos_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`);

--
-- Filtros para la tabla `Enlaces`
--
ALTER TABLE `Enlaces`
  ADD CONSTRAINT `Enlaces_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`);

--
-- Filtros para la tabla `Facultativos`
--
ALTER TABLE `Facultativos`
  ADD CONSTRAINT `Facultativos_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`),
  ADD CONSTRAINT `Facultativos_ibfk_2` FOREIGN KEY (`ID_especialidad`) REFERENCES `Especialidades` (`ID_especialidad`);

--
-- Filtros para la tabla `Facultativos_Autorizados`
--
ALTER TABLE `Facultativos_Autorizados`
  ADD CONSTRAINT `Facultativos_Autorizados_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `users` (`ID_user`),
  ADD CONSTRAINT `Facultativos_Autorizados_ibfk_2` FOREIGN KEY (`ID_facultativo`) REFERENCES `Facultativos` (`ID_facultativo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
