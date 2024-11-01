-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2024 a las 21:17:17
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
-- Base de datos: `gymu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id`, `mensaje`, `fecha`) VALUES
(1, 'Gran oferta de fin de semana en todos nuestros productos. ¡No te lo pierdas!', '2024-09-14'),
(2, 'El gimnasio estará cerrado el próximo lunes por mantenimiento. Disculpa los inconvenientes.', '2024-09-15'),
(3, '¡Únete a nuestro nuevo programa de entrenamiento y mejora tu forma física!', '2024-09-16'),
(4, 'Recordatorio: Las inscripciones para el próximo curso de yoga cierran mañana.', '2024-09-17'),
(5, 'Oferta especial para nuevos miembros: Descuento del 20% en la primera mensualidad.', '2024-09-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_actual` date NOT NULL,
  `hora_actual` time NOT NULL,
  `presente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_grupos`
--

CREATE TABLE `detalles_grupos` (
  `id_detalle` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `duracion` int(11) NOT NULL DEFAULT 50,
  `id_horario` int(11) NOT NULL,
  `cupo` int(11) NOT NULL,
  `frecuencia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalles_grupos`
--

INSERT INTO `detalles_grupos` (`id_detalle`, `id_grupo`, `duracion`, `id_horario`, `cupo`, `frecuencia`) VALUES
(1, 1, 50, 1, 12, 'F2'),
(2, 1, 50, 2, 12, 'F2'),
(3, 1, 50, 3, 12, 'F2'),
(4, 1, 50, 4, 12, 'F2'),
(5, 1, 50, 5, 12, 'F2'),
(6, 1, 50, 6, 12, 'F2'),
(7, 1, 50, 7, 12, 'F2'),
(8, 1, 50, 8, 12, 'F2'),
(9, 1, 50, 9, 12, 'F2'),
(10, 1, 50, 10, 12, 'F2'),
(11, 1, 50, 11, 12, 'F2'),
(12, 1, 50, 12, 12, 'F2'),
(13, 2, 50, 1, 10, 'F3'),
(14, 2, 50, 2, 10, 'F3'),
(15, 2, 50, 3, 10, 'F3'),
(16, 2, 50, 4, 10, 'F3'),
(17, 2, 50, 5, 10, 'F3'),
(18, 2, 50, 6, 10, 'F3'),
(19, 2, 50, 7, 10, 'F3'),
(20, 2, 50, 8, 10, 'F3'),
(21, 2, 50, 9, 10, 'F3'),
(22, 2, 50, 10, 10, 'F3'),
(23, 2, 50, 11, 10, 'F3'),
(24, 2, 50, 12, 10, 'F3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `precio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `proveedor` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `contacto` varchar(15) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `precio`, `cantidad`, `proveedor`, `descripcion`, `direccion`, `contacto`, `fecha`) VALUES
(1, 'Cinta de Correr', 500, 10, 'SportMax', 'Cinta de correr con pantalla LCD', 'Avenida del Deporte 123, Ciudad', '123-456-789', '2024-09-15'),
(2, 'Bicicleta Estática', 300, 15, 'FitLife', 'Bicicleta estática con ajuste de resistencia', 'Calle de la Salud 456, Ciudad', '987-654-321', '2024-09-16'),
(3, 'Máquina de Pesas', 750, 5, 'PowerGym', 'Máquina de pesas con múltiples estaciones', 'Paseo del Fitness 789, Ciudad', '555-123-456', '2024-09-17'),
(4, 'Banco de Ejercicios', 150, 20, 'ProTrain', 'Banco ajustable para ejercicios de fuerza', 'Avenida de la Gimnasia 101, Ciudad', '666-789-123', '2024-09-18'),
(5, 'Pesas Libres', 200, 30, 'GymTools', 'Pesas libres de varios tamaños', 'Calle del Fitness 202, Ciudad', '777-456-789', '2024-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `descripcion`) VALUES
(1, 'Pilates', 'Ejercicio de estiramiento y tonificación muscular con énfasis en la flexibilidad y fuerza.'),
(2, 'Musculación', 'Entrenamiento de fuerza para desarrollar masa muscular y mejorar el acondicionamiento físico.'),
(3, 'G.B.I', 'Gimnasio de Bajo Impacto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `hora` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `hora`) VALUES
(1, '07:00'),
(2, '08:00'),
(3, '09:00'),
(4, '10:00'),
(5, '11:00'),
(6, '14:00'),
(7, '15:00'),
(8, '16:00'),
(9, '17:00'),
(10, '18:00'),
(11, '19:00'),
(12, '20:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `fecha_registro` date NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `ano_pago` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `contacto` varchar(15) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Activo',
  `asistencia_total` int(11) NOT NULL,
  `peso_inicial` int(11) NOT NULL DEFAULT 0,
  `peso_actual` int(11) NOT NULL DEFAULT 0,
  `tipo_cuerpo_inicial` varchar(50) NOT NULL,
  `tipo_cuerpo_actual` varchar(50) NOT NULL,
  `fecha_progreso` date NOT NULL,
  `recordatorio` int(11) NOT NULL DEFAULT 0,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `nivel_aptitud` varchar(50) DEFAULT NULL,
  `patologias` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id_usuario`, `nombre_completo`, `genero`, `fecha_registro`, `precio`, `fecha_pago`, `ano_pago`, `direccion`, `contacto`, `estado`, `asistencia_total`, `peso_inicial`, `peso_actual`, `tipo_cuerpo_inicial`, `tipo_cuerpo_actual`, `fecha_progreso`, `recordatorio`, `foto_perfil`, `nivel_aptitud`, `patologias`) VALUES
(26, 'Andreina Alejandra', 'Femenino', '2024-09-22', 700, '2024-09-19', 2024, 'Caracas, Venezuela', '04126153090', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, '../uploads/66f08fb2b22cd4.52834115-BIENVENIDO A (2).jpg', 'Novato 2', 'Ectomorfo'),
(30, 'Juan Mendoza', 'Masculino', '2024-09-23', 1200, '2024-09-22', 2024, 'Los Teques', '04126153090', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, 'Novato', 'Ectomorfo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro_documento`
--

CREATE TABLE `miembro_documento` (
  `id_documento` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `ruta_documento` varchar(255) NOT NULL,
  `fecha_subida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miembro_documento`
--

INSERT INTO `miembro_documento` (`id_documento`, `id_usuario`, `ruta_documento`, `fecha_subida`) VALUES
(2, 26, '../uploads/66f08aea1895b2.51755054-BIENVENIDO A (1).jpg', '2024-09-22'),
(3, 26, '../uploads/66f08b341cec28.44147256-gymu (2).sql', '2024-09-22'),
(4, 26, '../uploads/66f08b95a76bb4.28527123-BIENVENIDO A (1).jpg', '2024-09-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro_grupo`
--

CREATE TABLE `miembro_grupo` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miembro_grupo`
--

INSERT INTO `miembro_grupo` (`id_usuario`, `id_grupo`) VALUES
(26, 2),
(26, 3),
(30, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro_tarifa`
--

CREATE TABLE `miembro_tarifa` (
  `id_usuario` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `miembro_tarifa`
--

INSERT INTO `miembro_tarifa` (`id_usuario`, `id`) VALUES
(26, 2),
(26, 3),
(30, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recordatorio`
--

CREATE TABLE `recordatorio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `estado_tarea` varchar(50) NOT NULL,
  `descripcion_tarea` varchar(100) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `estado_tarea`, `descripcion_tarea`, `id_usuario`) VALUES
(1, 'Pendiente', 'Revisar el informe de ventas del mes', 1),
(2, 'En progreso', 'Actualizar el sistema de gestión de inventario', 1),
(3, 'Completa', 'Reunión con el equipo de desarrollo', 1),
(4, 'Pendiente', 'Preparar presentación para la reunión de la junta', 1),
(5, 'En progreso', 'Desarrollar nuevas funcionalidades para la aplicación móvil', 1),
(6, 'Completa', 'Enviar informe semanal al cliente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id`, `nombre`, `costo`) VALUES
(1, 'Pilates F2', 55.00),
(2, 'Pilates F3', 60.00),
(3, 'Musculación Adicional F2', 70.00),
(4, 'Musculación Adicional F3', 75.00),
(5, 'Musculación F2 + Pilates F3', 85.00),
(6, 'Musculación F3 + Pilates F2', 90.00),
(7, 'Viajes', 100.00),
(8, 'Eventos', 50.00),
(9, 'Insumos', 20.00),
(10, 'Otros', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_usuarios`
--

CREATE TABLE `tipos_usuarios` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipos_usuarios`
--

INSERT INTO `tipos_usuarios` (`id_tipo`, `tipo`) VALUES
(1, 'Administrador'),
(2, 'Profesor'),
(3, 'Socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `suspendido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contrasena`, `id_tipo`, `suspendido`) VALUES
(1, 'Andre112', '050910', 2, 0),
(3, 'Marcos11', '123', 2, 0),
(5, 'Andre11', '0509', 3, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `detalles_grupos`
--
ALTER TABLE `detalles_grupos`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `miembro_documento`
--
ALTER TABLE `miembro_documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `miembro_grupo`
--
ALTER TABLE `miembro_grupo`
  ADD PRIMARY KEY (`id_usuario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `miembro_tarifa`
--
ALTER TABLE `miembro_tarifa`
  ADD PRIMARY KEY (`id_usuario`,`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_tipo_usuario` (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_grupos`
--
ALTER TABLE `detalles_grupos`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `miembro_documento`
--
ALTER TABLE `miembro_documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recordatorio`
--
ALTER TABLE `recordatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `detalles_grupos`
--
ALTER TABLE `detalles_grupos`
  ADD CONSTRAINT `detalles_grupos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `detalles_grupos_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`);

--
-- Filtros para la tabla `miembro_documento`
--
ALTER TABLE `miembro_documento`
  ADD CONSTRAINT `miembro_documento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `miembro_grupo`
--
ALTER TABLE `miembro_grupo`
  ADD CONSTRAINT `miembro_grupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `miembro_tarifa`
--
ALTER TABLE `miembro_tarifa`
  ADD CONSTRAINT `miembro_tarifa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_tarifa_ibfk_2` FOREIGN KEY (`id`) REFERENCES `tarifas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD CONSTRAINT `recordatorio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`id_tipo`) REFERENCES `tipos_usuarios` (`id_tipo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
