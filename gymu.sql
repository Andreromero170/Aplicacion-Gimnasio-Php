-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2025 a las 19:17:29
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
  `estado_asistencia` varchar(300) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `id_usuario`, `fecha_actual`, `estado_asistencia`, `id_grupo`) VALUES
(24, 31, '2024-10-04', 'Faltó con Aviso', 3),
(25, 26, '2024-10-04', 'Faltó sin Aviso', 1),
(27, 26, '2024-10-06', 'Faltó sin Aviso', 3),
(29, 32, '2024-10-06', 'Faltó sin Aviso', 2),
(30, 32, '2024-10-07', 'Faltó sin Aviso', 3),
(31, 26, '2024-10-07', 'Faltó sin Aviso', 1),
(32, 26, '2024-10-15', 'Asistió', 3),
(34, 26, '2024-10-19', 'Asistió', 3),
(35, 31, '2024-10-19', 'Asistió', 3),
(36, 32, '2024-10-19', 'Asistió', 3),
(37, 26, '2024-10-19', 'Asistió', 2),
(38, 31, '2024-10-19', 'Asistió', 2),
(39, 32, '2024-10-19', 'Asistió', 2),
(40, 26, '2024-10-26', 'Asistió', 1),
(41, 26, '2024-10-28', 'Asistió', 2),
(42, 31, '2024-10-28', 'Asistió', 2),
(43, 32, '2024-10-28', 'Asistió', 2),
(44, 36, '2024-10-28', 'Faltó sin Aviso', 2),
(45, 26, '2024-11-18', 'Asistió', 1),
(46, 35, '2024-11-18', 'Asistió', 1);

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
-- Estructura de tabla para la tabla `estado_asistencia`
--

CREATE TABLE `estado_asistencia` (
  `id` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad_inscritos` int(11) DEFAULT 0,
  `costo` decimal(10,2) NOT NULL,
  `visible` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `cantidad_inscritos`, `costo`, `visible`) VALUES
(1, 'Viaje a la Argentina', 20, 200.00, 1),
(3, 'Viaje a Caracas', 26, 600.00, 0),
(4, 'Viaje a Montevideo', 10, 300.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_mensuales`
--

CREATE TABLE `gastos_mensuales` (
  `id` int(11) NOT NULL,
  `tipo_gasto` varchar(255) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gastos_mensuales`
--

INSERT INTO `gastos_mensuales` (`id`, `tipo_gasto`, `monto`, `fecha`) VALUES
(12, 'Pago a Instructores de GBI', 6000.00, '2024-06'),
(14, 'Compra de Equipo para GBI', 800.00, '2024-11'),
(16, 'Alquiler de Local', 1200.00, '2024-11'),
(17, 'Pago a Instructores de GBI', 3500.00, '2024-11'),
(18, 'Electricidad', 600.00, '2024-11'),
(19, 'Agua', 1100.00, '2024-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `cupos_disponibles` int(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id_grupo`, `nombre_grupo`, `cupos_disponibles`) VALUES
(1, 'Pilates F1', 15),
(2, 'Musculación', 20),
(3, 'G.B.I', 20),
(12, 'F3 - Pilates - 08:00', 12),
(13, 'F2 - Pilates - 08:00', 12),
(14, 'F3 - Pilates - 09:00', 12),
(15, 'F3 - Pilates - 10:00', 12),
(16, 'F2 - Pilates - 10:00', 12),
(17, 'F2 - Balance Training - 09:00', 12),
(18, 'F3 - Pilates - 11:00', 12),
(19, 'F2 - Pilates - 11:00', 12),
(20, 'F3 - Pilates - 15:00', 12),
(21, 'F2 - Pilates - 18:00', 12),
(22, 'F2 - Pilates - 19:00', 12),
(23, 'F2 - Pilates - 16:00', 12),
(24, 'F3 - Pilates - 16:00', 12),
(25, 'F2 - Pilates - 17:00', 12),
(26, 'F3 - Pilates - 17:00', 12),
(27, 'F2 - Pilates - 20:00', 12),
(28, 'F3 - Pilates - 19:00', 12),
(29, 'F3 - Pilates - 20:00', 12),
(30, 'F3 - GBI - 18:00', 12),
(31, 'F3 - Musculacion - 16:00', 12),
(32, 'F2 - Musculacion - 16:00', 12),
(33, 'F3 - Musculacion - 17:00', 12),
(34, 'F2 - Musculacion - 19:00', 12),
(35, 'F2 - Musculacion - 20:00', 12),
(36, 'F3 - Musculacion - 18:00', 12),
(37, 'F3 - Musculacion - 19:00', 12),
(38, 'F3 - Musculacion - 20:00', 12),
(39, 'F3 - Musculacion - 15:00', 12),
(40, 'F2 - Musculacion - 08:00', 12),
(41, 'F3 - Musculacion - 10:00', 12),
(42, 'F2 - Musculacion - 09:00', 12),
(43, 'F2 - Musculacion - 10:00', 12),
(44, 'F2 - Musculacion - 15:00', 12),
(45, 'F2 - Musculacion - 18:00', 12);

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
-- Estructura de tabla para la tabla `inasistencias`
--

CREATE TABLE `inasistencias` (
  `id_inasistencia` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_asistencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inasistencias`
--

INSERT INTO `inasistencias` (`id_inasistencia`, `id_usuario`, `fecha`, `id_asistencia`) VALUES
(6, 26, '2024-10-05', 25),
(8, 26, '2024-10-05', 27),
(10, 32, '2024-10-06', 29),
(11, 32, '2024-10-07', 30),
(12, 26, '2024-10-07', 31),
(13, 36, '2024-10-28', 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion_eventos`
--

CREATE TABLE `inscripcion_eventos` (
  `id` int(11) NOT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `id_evento` int(11) DEFAULT NULL,
  `tipo_pago_id` int(11) DEFAULT NULL,
  `fecha_viaje` date NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `numero_cuotas` int(30) NOT NULL,
  `cuota_actual` int(11) DEFAULT 1,
  `estado_pago` enum('pendiente','pagado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscripcion_eventos`
--

INSERT INTO `inscripcion_eventos` (`id`, `cedula`, `id_evento`, `tipo_pago_id`, `fecha_viaje`, `monto_pagado`, `numero_cuotas`, `cuota_actual`, `estado_pago`) VALUES
(5, '27371913', 3, 2, '2024-10-11', 200.00, 3, 3, 'pagado'),
(7, '27371913', 3, 2, '2024-10-02', 600.00, 1, 1, 'pagado'),
(8, '27371945', 4, 2, '2024-10-28', 75.00, 4, 4, 'pagado'),
(9, '27371919', 4, 2, '2024-11-29', 100.00, 3, 3, 'pagado'),
(10, '27371914', 1, 2, '2024-11-28', 40.00, 5, 4, 'pendiente'),
(11, '27371945', 1, 2, '2024-11-30', 50.00, 4, 2, 'pendiente');

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
  `nivel_aptitud` enum('Alumno de extremo cuidado','Alumno con muchas dificultades, alta demanda','Alumno que requiere cierta atención, pero ya es algo independiente','Alumno bien. Demanda normal.','Alumno casi Independiente. Baja demanda.','Alumno "sobrado". Apto para variantes más complejas.') NOT NULL,
  `patologias` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id_usuario`, `nombre_completo`, `genero`, `fecha_registro`, `precio`, `fecha_pago`, `ano_pago`, `direccion`, `contacto`, `estado`, `asistencia_total`, `peso_inicial`, `peso_actual`, `tipo_cuerpo_inicial`, `tipo_cuerpo_actual`, `fecha_progreso`, `recordatorio`, `foto_perfil`, `nivel_aptitud`, `patologias`) VALUES
(26, 'Andreina Romero', 'Masculino', '2024-09-28', 700, '2024-09-19', 2024, 'Caracas, Venezuela', '04126153090', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, '../uploads/674ce70a8175f4.37973321-Screenshot_20241114-153034~2.png', '', 'Ectomorfo'),
(31, 'Juan Mendoza', 'Masculino', '2024-10-13', 1200, '2024-09-29', 2024, 'Los Teques 2', '04126153090', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', 'flaco'),
(32, 'Marcos Alonso', 'Masculino', '2024-10-16', 4500, '2024-10-04', 2024, 'Caracas, Venezuela', '041256878445', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', 'mon'),
(35, 'Gabriel Pereira', 'Masculino', '2024-10-17', 625, '2024-10-28', 2024, 'Montevideo, Uruguay', '04126153090', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', 'Asma'),
(36, 'Andy Lopez', 'Masculino', '2024-10-30', 625, '2024-10-28', 2024, 'Montevideo, Uruguay', '04126153090', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', 'Asma'),
(37, 'Silvia Valdivieso', 'Femenino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(38, 'Sonia Mamita', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(39, 'Susana Bica', 'Femenino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(40, 'Graciela Fagundez', 'Femenino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(41, 'Mirian Nuñez', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(42, 'Luis (Beto) Gomez', 'Masculino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(43, 'Graciela Pinto', 'Femenino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(44, 'Silvia da Silveira', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(45, 'Leni Rosas', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(46, 'Liana Da Cunda', 'Femenino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(47, 'Adriana Ade', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(48, 'Elena Rodriguez', 'Femenino', '0000-00-00', 2300, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(50, 'María del Carmen Ramos', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(51, 'Miriam Olivera', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(52, 'Elba Mendes', 'Femenino', '2024-10-02', 800, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(53, 'Lorena Borrea', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(54, 'Sandra Rebollo', 'Femenino', '2024-10-01', 800, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(55, 'Yasi Rivas', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(56, 'Karen Silva', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(57, 'Susana Bertran', 'Femenino', '2024-10-04', 800, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(58, 'Cristina Duarte', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(59, 'Emila Ibañez', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(60, 'Yosely Alvez', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(61, 'Esther Camacho', 'Femenino', '2024-10-09', 0, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(62, 'Mirna Notejane', 'Femenino', '2024-10-11', 0, '2024-10-11', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(63, 'Elizabeth de la Rosa', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(64, 'Marta Farias', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(65, 'Alicia Rivero', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(66, 'Marta Taroco', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(67, 'Cacha', 'Femenino', '2024-10-04', 0, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(68, 'Zulma Oliva', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(69, 'Mariela Lemos', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(70, 'Irene Mendiondo', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(71, 'Susana Moreira', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(72, 'Ana Araujo', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(73, 'Inés Laprebendere', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(74, 'Elsa Moreira', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(75, 'Marta Duarte', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(76, 'Cristina Varela', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(77, 'Olga Maldonado', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(78, 'Margie Sosa', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(79, 'Mabel González', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(80, 'Mirta Rodríguez', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(81, 'Sandra Paz', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(82, 'Santa Justina', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(83, 'Ana Irazoqui', 'Femenino', '2024-10-04', 2000, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(84, 'Martha Rodriguez', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(85, 'Lidia Guedes', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(86, 'Pelusa', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(87, 'Gladys Hernández', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(88, 'Mari Pintos', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(89, 'Raquel Lopez', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(90, 'Betty Lopez', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(91, 'Cristina Pedrozo', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(92, 'Yesi Bidarte', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(93, 'Walter Saldaña', 'Masculino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(94, 'Maria Inés Vargas', 'Femenino', '2024-10-04', 0, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(95, 'Malena Chiappara', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(96, 'Elena Pedragosa', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(97, 'Nelson Lopez', 'Masculino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(98, 'Rosa de la Rosa', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(99, 'Nilda Ramos', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(100, 'Renni de la Rosa', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(101, 'Iris Moreira', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(102, 'Marta de Mello', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(103, 'Maria Luisa Pereira (chola)', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(104, 'Marisa Machado', 'Femenino', '2024-10-15', 100, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(105, 'Nely Almeida', 'Femenino', '2024-10-04', 0, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(106, 'Nilda Alvez', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(107, 'Beatrice Borges', 'Femenino', '2024-10-15', 0, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(108, 'Zoila Veleda', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(109, 'María Teresa', 'Femenino', '2024-10-08', 2300, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(110, 'Lilian Aristimuño', 'Femenino', '2024-10-15', 1200, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(111, 'Patricia Bebeder', 'Femenino', '2024-10-04', 0, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(112, 'Carmen Garcia', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(113, 'Isabel Rodríguez', 'Femenino', '2024-10-09', 0, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(114, 'Washington', 'Masculino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(115, 'Sonia Epifanía', 'Femenino', '2024-10-16', 0, '2024-10-16', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(116, 'Heber Perroni', 'Masculino', '2024-10-04', 0, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(117, 'Alba Clock', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(118, 'Laura De los Santos', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(119, 'Micaela Embarazada', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(120, 'Magaly Guevara', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(121, 'Milka Launas', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(122, 'Anabel Cabrera', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(123, 'Doris (Gisele) Alvez', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(124, 'Jorge de la Rosa', 'Masculino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(125, 'Graciela Montecoral', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(126, 'Marta Rodríguez', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(127, 'Stella Rodríguez', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(128, 'Nubia Do Santos', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(129, 'Loreley De los Santos', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(130, 'Koly Bragnça', 'Femenino', '2024-10-15', 0, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(131, 'Verónica Rodríguez', 'Femenino', '2024-10-09', 0, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(132, 'Brenda Venini', 'Femenino', '2024-10-09', 0, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(133, 'Andrea', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(134, 'Alicia', 'Femenino', '2024-10-01', 0, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(135, 'Mariangel Ospitaleche', 'Femenino', '2024-10-05', 0, '2024-10-05', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(136, 'Rosa Crossa', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(137, 'Aldo Maciel', 'Masculino', '2024-10-07', 0, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(138, 'Sandra Echevarría', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(139, 'Silvia Cardozo', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(140, 'Leticia Cardona', 'Femenino', '2024-11-09', 0, '2024-11-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(141, 'Mirta Pareja', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(142, 'Aurora', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(143, 'Beatriz Velazquez', 'Femenino', '2024-10-04', 2600, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(144, 'Melina Rebollo', 'Femenino', '2024-10-04', 2600, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(145, 'Rosa Machado', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(146, 'Melina Cabrera', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(147, 'Roberto Melo', 'Masculino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(148, 'Rina Gomez', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(149, 'Yina Cierra', 'Femenino', '2024-10-15', 0, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(150, 'Elisa Belen', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(151, 'Viviana Seguí', 'Femenino', '2024-10-15', 0, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(152, 'Andrea Mora', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(153, 'Ana Clara Valbuena', 'Femenino', '0000-00-00', 0, '2024-10-14', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(154, 'Lujan Villegas', 'Femenino', '2024-10-15', 800, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(155, 'Nilsa da Costa', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(156, 'Lorena Loretto', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(157, 'Marianella Menafra', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(158, 'Mirta Escoto', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(159, 'Carla Delze', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(160, 'Marta Cohelo', 'Femenino', '2024-10-01', 800, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(161, 'Leticia Madeira', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(162, 'Silvia Albornoz', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(163, 'Ana Prieto', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(164, 'Rosana González', 'Femenino', '0000-00-00', 800, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(165, 'Lilian Mello', 'Femenino', '2024-10-15', 0, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(166, 'Margaret Sampayo', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(167, 'Ricardo Olivera', 'Masculino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(168, 'Elsa González', 'Femenino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(169, 'Claudia Prieto', 'Femenino', '2024-10-01', 800, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(170, 'Cristina Baraibar', 'Femenino', '2024-10-03', 700, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(171, 'Laura Olivera', 'Femenino', '0000-00-00', 2600, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(172, 'Ana Maria Brum', 'Femenino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(173, 'Sandra Güedes', 'Femenino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(174, 'Sonia Neto', 'Femenino', '0000-00-00', 800, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(175, 'Sandra Vargas', 'Femenino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(176, 'Geeny Ferreira', 'Femenino', '2024-10-10', 800, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(177, 'Nelly Farías', 'Femenino', '2024-10-07', 800, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(178, 'Selva Pintado', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(179, 'Marta Medina', 'Femenino', '0000-00-00', 1200, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(180, 'Teresita Albornoz', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(181, 'Ema Da Cunha', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(182, 'Cristina Viera', 'Femenino', '0000-00-00', 1200, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(183, 'Mirtha Paiva', 'Femenino', '2024-10-03', 2300, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(184, 'Mariana', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(185, 'Camila Gonzales', 'Femenino', '0000-00-00', 1200, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(186, 'Emilia Peraza', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(187, 'Dora Gaye', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(188, 'Nancy Barrientos', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(189, 'Eva Maria Amado', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(190, 'Mirian Bassi', 'Femenino', '2024-10-16', 800, '2024-10-16', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(191, 'Rina González', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(192, 'Susane Ribeiro', 'Femenino', '2024-10-01', 2600, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(193, 'María Frugoni', 'Femenino', '2024-10-09', 2600, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(194, 'Eva Díaz', 'Femenino', '2024-10-17', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(195, 'Alicia Fumero', 'Femenino', '2024-10-10', 800, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(196, 'Adelia Dos Reis', 'Femenino', '2024-10-10', 800, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(197, 'Gladys Pereira', 'Femenino', '2024-10-15', 800, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(198, 'Virginia Ritta', 'Femenino', '2024-10-07', 800, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(199, 'Ana María Abimorad', 'Femenino', '2024-10-09', 800, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(200, 'Paola Rodríguez', 'Femenino', '2024-10-09', 800, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(201, 'Gloria Farias', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(202, 'Dario Peri', 'Masculino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(203, 'Ana Lya Chagas', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(204, 'Patricia Viera', 'Femenino', '2024-10-03', 2300, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(205, 'Rossana Gularte', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(206, 'Andrea Rivero', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(207, 'Natalia Ongay', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(208, 'Esther Gularte', 'Femenino', '2024-10-09', 1200, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(209, 'Ana Antunez', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(210, 'Corina Moreira', 'Femenino', '0000-00-00', 1200, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(211, 'Elena Carballo', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(212, 'Yara Vilches', 'Femenino', '2024-10-11', 1200, '2024-10-11', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(213, 'Florencia Viera', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(214, 'Patricia González', 'Femenino', '2024-10-11', 800, '2024-10-11', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(215, 'Fernanda Costa', 'Femenino', '2024-10-10', 800, '2024-10-10', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(216, 'Valeria Hernández', 'Femenino', '2024-10-01', 800, '2024-10-01', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(217, 'Mary Vaqueiro', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(218, 'Marta Álvarez', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(219, 'Mónica Suarez', 'Femenino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(220, 'Fernanda Monzón', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(221, 'Johanna Huppert', 'Femenino', '2024-10-05', 800, '2024-10-05', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(222, 'Maria Ines García', 'Femenino', '2024-10-03', 800, '2024-10-03', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(223, 'Carla Silva', 'Femenino', '2024-10-08', 800, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(224, 'Mirta Regueiro', 'Femenino', '2024-10-05', 0, '2024-10-05', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(225, 'Rosario Clames', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(226, 'Elba Montero', 'Femenino', '2024-10-11', 1200, '2024-10-11', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(227, 'Susana Cuña', 'Femenino', '2024-10-09', 1200, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(228, 'Olga Leticia Funques', 'Femenino', '2024-10-16', 1200, '2024-10-16', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(229, 'Marta Correa', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(230, 'Mirna Da Silva', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(231, 'Carmen Sosa', 'Femenino', '2024-10-16', 1200, '2024-10-16', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(232, 'Alejandra Bertran', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(233, 'Angelica Machado', 'Femenino', '2024-10-15', 1200, '2024-10-15', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(234, 'Sarita Moreira', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(235, 'Elsa Alvez', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(236, 'Ana Jorge', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(237, 'Ana Perroni', 'Femenino', '2024-10-08', 2300, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(238, 'María Fernanda Fagundez', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(239, 'Ana Narbondo', 'Femenino', '2024-10-08', 1200, '2024-10-08', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(240, 'Ana Fernández', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(241, 'Nilda Pereira', 'Femenino', '2024-10-06', 2300, '2024-10-06', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(242, 'Rosario Machado', 'Femenino', '0000-00-00', 1200, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(243, 'Katerine Balsamo', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(244, 'Martín Alonso', 'Masculino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(245, 'Marta Roses', 'Femenino', '2024-10-07', 1200, '2024-10-07', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(246, 'Ana Valbuena', 'Femenino', '2024-10-16', 1200, '2024-10-16', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(247, 'Maribel Pirez', 'Femenino', '2024-10-09', 1200, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(248, 'Raquel Machado', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(249, 'Diamantina Da Silveira', 'Femenino', '2024-10-09', 1200, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(250, 'Haydee Rodríguez', 'Femenino', '2024-10-09', 1200, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(251, 'Zulema Gularte', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(252, 'Matilde Pacheco', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(253, 'Andrea Martínez', 'Femenino', '2024-10-09', 1200, '2024-10-09', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(255, 'Olma Elverdín', 'Femenino', '2024-10-02', 1200, '2024-10-02', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(256, 'Nilda (Nina) Ferreira', 'Femenino', '2024-10-04', 1200, '2024-10-04', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(257, 'Alicia Fumeiro', 'Femenino', '2024-10-16', 0, '2024-10-16', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(258, 'Eleida Paula De Los Santos', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(259, 'Norberto González', 'Masculino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(260, 'Marianagel Ospitaleche', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(261, 'Betty Zabala', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(262, 'Mercedes Pedragosa', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(263, 'Julia Aristimuño', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(264, 'Alba Fontoura', 'Femenino', '2024-10-17', 0, '2024-10-17', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(265, 'Gabriela Moreira', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(266, 'Luisa Suanes', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, 'Montevideo, Uruguay', '', '', 0, 0, 0, '', '', '0000-00-00', 0, NULL, '', NULL),
(282, 'Cecilia Viera', 'Femenino', '2024-10-01', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', ''),
(283, 'Mary dos Santos', 'Femenino', '2024-10-01', 0, '2024-10-09', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', 'Cuidar rodillas'),
(285, 'Aline Fernández', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno con muchas dificultades, alta demanda', ''),
(286, 'Maria Eugenia Frugoni', 'Femenino', '2024-10-09', 0, '2024-10-09', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(289, 'Lenin Delgado', 'Masculino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', ''),
(290, 'Eracelia Denis', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', ''),
(291, 'Rosa Borges', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno con muchas dificultades, alta demanda', ''),
(292, 'Eva Suarez', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno con muchas dificultades, alta demanda', ''),
(293, 'Susana Álvarez', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(295, 'Cristina Rodríguez', 'Femenino', '2024-10-01', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', '-'),
(297, 'Ico Machado', 'Masculino', '2024-10-07', 0, '2024-10-07', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', 'Cuidar Rodillas. Cervicales comprometidas'),
(298, 'Quique Borrea', 'Masculino', '2024-10-14', 0, '2024-10-14', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', 'Cuidar rodillas y Lumbares'),
(299, 'Natalia de Barros', 'Femenino', '2024-10-01', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', 'Cuidar no sobre-exigir (mareos/agotamiento)'),
(300, 'Lourdes Gamboa', 'Femenino', '2024-10-14', 0, '2024-10-14', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', 'Cuidar lesión en Tobillo, lumbares y costillas.'),
(301, 'Alicia da Silva', 'Femenino', '2024-10-01', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(302, 'Monica Cottens', 'Femenino', '2024-10-11', 0, '2024-10-11', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(303, 'Patricia Melo', 'Femenino', '2024-10-16', 0, '2024-10-16', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(305, 'Juan Trinidad', 'Masculino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', ''),
(306, 'Veruska Rodriguez', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, '', '96125685', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', ''),
(308, 'Ricardo Da Rosa', 'Masculino', '2024-10-08', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(309, 'Fernanda Fagundez', 'Femenino', '2024-10-01', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(310, 'Lujan Rivero', 'Femenino', '2024-10-01', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(311, 'Marcelo Gomez', 'Masculino', '2024-10-08', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(312, 'Celeste Villamil', 'Femenino', '2024-10-03', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(313, 'María Virginia Montejo', 'Femenino', '2024-10-10', 0, '2024-10-10', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(314, 'Patricia Moreira', 'Femenino', '2024-10-18', 0, '2024-10-18', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno con muchas dificultades, alta demanda', ''),
(315, 'Marisa Cardozo', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(317, 'Jaquelin Olivera', 'Femenino', '2024-10-16', 0, '2024-10-16', 2024, '', '', 'Hora 19:00', 0, 0, 0, '', '', '0000-00-00', 0, '', '', ''),
(320, 'Yina Sierra', 'Femenino', '2024-10-04', 0, '2024-10-04', 2024, '', 'M+P', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(321, 'Leticia Denis', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, 'Tobillos y Rodillas - Sobrepeso', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '4', '', ''),
(322, 'Telmo Acosta', 'Masculino', '2024-10-07', 0, '2024-10-07', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(325, 'Estela Sosa', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno de extremo cuidado', '-'),
(326, 'Silvana Silveira', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, '', '99034991', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(327, 'Mariana González', 'Femenino', '2024-10-08', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', ''),
(329, 'Alejandro Vonder', 'Masculino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(330, 'Melina Fernandez', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(331, 'Roberto Costa', 'Masculino', '2024-10-08', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '8-10'),
(333, 'Paola Pereira', 'Femenino', '2024-10-09', 0, '2024-10-09', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno de extremo cuidado', 'Grave escoliosis en S. Lumbar y Cervical dolor'),
(334, 'Rossana Gonzáles', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', '-'),
(335, 'Viviana Rodriguez', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', 'eBrou', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno casi Independiente. Baja demanda.', '-'),
(336, 'Walter Tejeira', 'Masculino', '2024-10-09', 0, '2024-10-09', 2024, '', '95797997', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno con muchas dificultades, alta demanda', 'Descordinación general'),
(337, 'Gabriela Rodríguez', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(338, 'Ana Claudia Lopez', 'Femenino', '2024-10-02', 0, '2024-10-02', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(339, 'Rosana Morales', 'Femenino', '2024-10-07', 0, '2024-10-07', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', '-'),
(341, 'Samanta Degues', 'Femenino', '2024-10-11', 0, '2024-10-11', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(342, 'Carolina Castilho', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(343, 'Maria Antuña', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(344, 'Nelson Breberman', 'Masculino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(347, 'Beto Gomez', 'Masculino', '0000-00-00', 0, '2024-10-02', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', 'Columna (zona lumbar)'),
(351, 'Ricardo Morales', 'Masculino', '0000-00-00', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', '-'),
(354, 'Sonia Nuñez', 'Femenino', '0000-00-00', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(355, 'Andrea Suárez', 'Femenino', '0000-00-00', 0, '2024-10-09', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(356, 'Fany Michelin', 'Femenino', '0000-00-00', 0, '2024-10-09', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(357, 'Mariana Escandón', 'Femenino', '0000-00-00', 0, '2024-10-01', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(358, 'Cristina', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(359, 'Valdir Marquez', 'Masculino', '0000-00-00', 0, '1905-06-22', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(360, 'Susana Dos Reis', 'Femenino', '0000-00-00', 0, '2024-10-11', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(361, 'Fátima Da Silveira', 'Femenino', '0000-00-00', 0, '2024-10-18', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(363, 'Andrea Sosa', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(364, 'Silvia Denis', 'Femenino', '0000-00-00', 0, '2024-10-10', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(365, 'Rita Magdaleno', 'Femenino', '0000-00-00', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(366, 'Nubia Dos Santos', 'Femenino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(371, 'Verónica dos Santos', 'Femenino', '0000-00-00', 0, '2024-10-15', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', 'Prueba'),
(372, 'Alba Duarte', 'Femenino', '0000-00-00', 0, '2024-10-10', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(373, 'Atahualpa Pérez', 'Femenino', '0000-00-00', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', '-'),
(374, 'Celina Camiruaga', 'Femenino', '0000-00-00', 0, '2024-10-03', 2024, '', '99789959', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', '-'),
(376, 'Alba (Meche) Dos Santos', 'Femenino', '0000-00-00', 0, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(377, 'Olma María Taroco', 'Femenino', '0000-00-00', 0, '2024-10-08', 2024, '', '98438804', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno con muchas dificultades, alta demanda', 'Columna'),
(379, 'Glaee del Longo', 'Femenino', '0000-00-00', 0, '2024-10-05', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', 'Rodillas'),
(380, 'Patricia Beveder', 'Femenino', '0000-00-00', 0, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', '-'),
(381, 'Jesús Sosa', 'Masculino', '0000-00-00', 0, '2024-10-05', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(382, 'Pablo Gaye', 'Masculino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(383, 'Nelson Bremermann', 'Masculino', '0000-00-00', 1200, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(384, 'Adela Culshaw', 'Femenino', '0000-00-00', 1200, '2024-10-15', 2024, '', '98646408', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', 'Rodillas'),
(385, 'Marianela Acevedo', 'Femenino', '0000-00-00', 1200, '2024-10-03', 2024, '', '99772260', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(386, 'Ida González', 'Femenino', '0000-00-00', 1200, '2024-10-03', 2024, '', '98840503', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(388, 'Alberico Fontes', 'Masculino', '0000-00-00', 1200, '2024-10-01', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', 'Poco control del cuerpo'),
(389, 'Mabel Cano', 'Femenino', '0000-00-00', 600, '0000-00-00', 2024, '', '99585055', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', 'Rodillas muy delicadas'),
(390, 'Claudia Roldan', 'Femenino', '0000-00-00', 1200, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', '-'),
(391, 'Miguel Ojeda', 'Masculino', '0000-00-00', 1200, '2024-10-03', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno que requiere cierta atención, pero ya es algo independiente', 'Rodilla (meniscos)'),
(392, 'Deisy Nuñez', 'Femenino', '0000-00-00', 1200, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(393, 'Cristian Alvez', 'Masculino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', 'Alumno bien. Demanda normal.', 'Rodillas (meniscos)'),
(394, 'Yurema Pintos', 'Femenino', '0000-00-00', 1200, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(395, 'Roque Alvez', 'Masculino', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(397, 'Florencia García', 'Femenino', '0000-00-00', 1200, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(398, 'Yuly Mendieta', 'Femenino', '0000-00-00', 1200, '2024-10-08', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '-'),
(399, '', '', '0000-00-00', 0, '0000-00-00', 2024, '', '', '', 0, 0, 0, '', '', '0000-00-00', 0, '', '', '');
INSERT INTO `miembros` (`id_usuario`, `nombre_completo`, `genero`, `fecha_registro`, `precio`, `fecha_pago`, `ano_pago`, `direccion`, `contacto`, `estado`, `asistencia_total`, `peso_inicial`, `peso_actual`, `tipo_cuerpo_inicial`, `tipo_cuerpo_actual`, `fecha_progreso`, `recordatorio`, `foto_perfil`, `nivel_aptitud`, `patologias`) VALUES
(404, 'Andrea Camargo', '', '2024-10-11', 0, '2024-10-11', 0, '', '', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, 'Alumno de extremo cuidado', NULL),
(405, 'Silvia Correa', '', '0000-00-00', 0, '0000-00-00', 0, '', '', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, 'Alumno de extremo cuidado', NULL),
(406, 'Miguel Dutra', '', '2024-10-14', 0, '2024-10-14', 0, '', '', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, 'Alumno de extremo cuidado', NULL),
(407, 'Ana Sabrina Castillo', '', '2024-10-16', 0, '2024-10-16', 0, '', '', 'Activo', 0, 0, 0, '', '', '0000-00-00', 0, NULL, 'Alumno de extremo cuidado', NULL);

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
(3, 26, '../uploads/66f87055cae0c1.38362579-gymu (3).sql', '2024-09-28'),
(6, 26, '../uploads/67143e947565d0.99771003-BASEBALL.png', '2024-10-20');

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
(26, 1),
(26, 2),
(31, 2),
(32, 2),
(35, 1),
(36, 2),
(37, 12),
(37, 40),
(38, 12),
(39, 12),
(39, 40),
(40, 12),
(40, 40),
(41, 12),
(42, 12),
(43, 12),
(43, 40),
(44, 12),
(44, 13),
(45, 12),
(45, 40),
(46, 12),
(46, 40),
(47, 12),
(48, 12),
(48, 40),
(50, 13),
(51, 13),
(52, 13),
(53, 13),
(53, 33),
(54, 13),
(55, 13),
(56, 13),
(57, 13),
(58, 13),
(59, 13),
(60, 13),
(61, 14),
(62, 14),
(62, 42),
(63, 14),
(64, 14),
(65, 14),
(65, 42),
(66, 14),
(66, 42),
(67, 14),
(68, 14),
(69, 14),
(70, 14),
(71, 14),
(71, 42),
(72, 14),
(73, 17),
(73, 31),
(74, 17),
(75, 17),
(76, 17),
(77, 17),
(78, 17),
(79, 17),
(80, 17),
(81, 17),
(81, 41),
(82, 17),
(83, 17),
(83, 34),
(84, 17),
(85, 15),
(86, 15),
(87, 15),
(88, 15),
(89, 15),
(90, 15),
(91, 15),
(92, 15),
(93, 15),
(94, 15),
(95, 15),
(96, 15),
(97, 16),
(98, 16),
(99, 16),
(99, 32),
(100, 16),
(101, 16),
(102, 16),
(103, 16),
(104, 16),
(105, 16),
(106, 16),
(107, 16),
(108, 16),
(109, 18),
(110, 18),
(110, 43),
(111, 18),
(112, 18),
(112, 35),
(113, 18),
(114, 18),
(115, 18),
(116, 18),
(117, 18),
(118, 18),
(119, 18),
(120, 18),
(120, 43),
(121, 19),
(122, 19),
(123, 19),
(124, 19),
(125, 19),
(125, 31),
(126, 19),
(126, 45),
(127, 19),
(128, 19),
(129, 19),
(130, 19),
(131, 20),
(132, 20),
(133, 20),
(134, 20),
(135, 20),
(136, 20),
(137, 20),
(138, 20),
(139, 20),
(140, 20),
(141, 20),
(142, 20),
(143, 21),
(143, 36),
(144, 21),
(144, 36),
(145, 21),
(146, 21),
(147, 21),
(148, 21),
(149, 21),
(150, 21),
(151, 21),
(152, 21),
(153, 21),
(154, 21),
(155, 22),
(156, 22),
(157, 22),
(158, 22),
(159, 22),
(160, 22),
(161, 22),
(162, 22),
(163, 22),
(164, 22),
(165, 22),
(166, 22),
(167, 23),
(168, 23),
(169, 23),
(170, 23),
(171, 23),
(172, 23),
(173, 23),
(174, 23),
(175, 23),
(176, 23),
(177, 23),
(178, 24),
(179, 24),
(180, 24),
(181, 24),
(182, 24),
(183, 24),
(183, 32),
(184, 24),
(185, 24),
(186, 24),
(187, 24),
(188, 24),
(189, 24),
(190, 25),
(191, 25),
(192, 25),
(193, 25),
(194, 25),
(195, 25),
(196, 25),
(197, 25),
(198, 25),
(198, 30),
(199, 25),
(200, 25),
(201, 26),
(202, 26),
(203, 26),
(204, 26),
(204, 34),
(205, 26),
(206, 26),
(207, 26),
(208, 26),
(209, 26),
(210, 26),
(211, 26),
(212, 26),
(213, 27),
(214, 27),
(215, 27),
(216, 27),
(217, 27),
(218, 27),
(219, 27),
(220, 27),
(221, 27),
(222, 27),
(223, 27),
(224, 27),
(224, 38),
(225, 28),
(226, 28),
(227, 28),
(228, 28),
(229, 28),
(230, 28),
(231, 28),
(232, 28),
(233, 28),
(233, 35),
(234, 28),
(235, 28),
(236, 28),
(237, 29),
(237, 35),
(238, 29),
(239, 29),
(239, 35),
(240, 29),
(241, 29),
(241, 44),
(242, 29),
(243, 29),
(244, 29),
(245, 29),
(246, 29),
(247, 30),
(248, 30),
(249, 30),
(250, 30),
(251, 30),
(252, 30),
(253, 30),
(255, 30),
(256, 30),
(257, 30),
(257, 31),
(258, 23),
(259, 23),
(260, 23),
(261, 23),
(262, 23),
(263, 23),
(264, 23),
(265, 23),
(266, 23),
(282, 31),
(283, 31),
(285, 31),
(286, 31),
(289, 32),
(290, 32),
(291, 32),
(292, 32),
(293, 32),
(295, 33),
(297, 33),
(298, 33),
(299, 33),
(300, 33),
(301, 33),
(302, 33),
(302, 36),
(303, 33),
(305, 34),
(306, 34),
(308, 34),
(309, 34),
(310, 34),
(311, 34),
(312, 34),
(313, 34),
(314, 36),
(315, 36),
(317, 36),
(320, 36),
(321, 36),
(322, 36),
(325, 35),
(326, 35),
(327, 35),
(329, 35),
(330, 35),
(331, 35),
(333, 38),
(334, 38),
(335, 38),
(336, 38),
(337, 38),
(338, 38),
(339, 38),
(341, 38),
(342, 39),
(343, 39),
(344, 39),
(347, 40),
(351, 40),
(354, 40),
(355, 41),
(356, 41),
(357, 41),
(358, 41),
(359, 41),
(360, 41),
(361, 41),
(363, 42),
(364, 42),
(365, 42),
(366, 42),
(371, 42),
(372, 42),
(373, 43),
(374, 43),
(376, 43),
(377, 43),
(379, 43),
(380, 43),
(381, 43),
(382, 43),
(383, 44),
(384, 44),
(385, 44),
(386, 44),
(388, 44),
(389, 44),
(390, 45),
(391, 45),
(392, 45),
(393, 45),
(394, 45),
(395, 45),
(397, 45),
(398, 45);

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
(31, 2),
(32, 2),
(35, 2),
(36, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_mensuales`
--

CREATE TABLE `pagos_mensuales` (
  `id_pago` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_pago` date NOT NULL DEFAULT '2024-01-01',
  `estado_pago` enum('Pendiente','Pagado') DEFAULT 'Pendiente',
  `fecha_proximo_pago` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos_mensuales`
--

INSERT INTO `pagos_mensuales` (`id_pago`, `id_usuario`, `fecha_pago`, `estado_pago`, `fecha_proximo_pago`) VALUES
(16, 37, '2024-10-01', 'Pagado', '2024-11-01'),
(17, 38, '2024-10-01', 'Pendiente', '2024-11-01'),
(18, 39, '2024-10-10', 'Pendiente', '2024-11-10'),
(19, 40, '2024-10-04', 'Pendiente', '2024-11-04'),
(20, 41, '2024-10-01', 'Pendiente', '2024-11-01'),
(21, 42, '2024-10-02', 'Pendiente', '2024-11-02'),
(22, 43, '2024-10-01', 'Pendiente', '2024-11-01'),
(23, 44, '2024-10-03', 'Pendiente', '2024-11-03'),
(24, 45, '2024-10-01', 'Pendiente', '2024-11-01'),
(25, 46, '2024-10-01', 'Pendiente', '2024-11-01'),
(26, 47, '2024-10-10', 'Pendiente', '2024-11-10'),
(27, 48, '2024-10-08', 'Pendiente', '2024-11-08'),
(52, 44, '2024-10-08', 'Pendiente', '2024-11-08'),
(53, 50, '2024-10-08', 'Pendiente', '2024-11-08'),
(54, 51, '2024-10-03', 'Pendiente', '2024-11-03'),
(55, 52, '2024-10-02', 'Pendiente', '2024-11-02'),
(56, 53, '2024-10-01', 'Pendiente', '2024-11-01'),
(57, 54, '2024-10-01', 'Pendiente', '2024-11-01'),
(58, 55, '2024-10-03', 'Pendiente', '2024-11-03'),
(59, 56, '2024-10-08', 'Pendiente', '2024-11-08'),
(60, 57, '2024-10-04', 'Pendiente', '2024-11-04'),
(61, 58, '2024-10-08', 'Pendiente', '2024-11-08'),
(62, 59, '2024-10-08', 'Pendiente', '2024-11-08'),
(63, 60, '2024-10-03', 'Pendiente', '2024-11-03'),
(64, 61, '2024-10-09', 'Pendiente', '2024-11-09'),
(65, 62, '2024-10-11', 'Pendiente', '2024-11-11'),
(66, 63, '2024-10-03', 'Pendiente', '2024-11-03'),
(67, 64, '2024-10-01', 'Pendiente', '2024-11-01'),
(68, 65, '2024-10-01', 'Pendiente', '2024-11-01'),
(69, 66, '2024-10-01', 'Pendiente', '2024-11-01'),
(70, 67, '2024-10-04', 'Pendiente', '2024-11-04'),
(71, 68, '2024-10-10', 'Pendiente', '2024-11-10'),
(72, 69, '2024-10-10', 'Pendiente', '2024-11-10'),
(73, 70, '2024-10-02', 'Pendiente', '2024-11-02'),
(74, 71, '2024-10-08', 'Pendiente', '2024-11-08'),
(75, 72, '2024-10-02', 'Pendiente', '2024-11-02'),
(76, 73, '2024-10-01', 'Pendiente', '2024-11-01'),
(77, 75, '2024-10-03', 'Pendiente', '2024-11-03'),
(78, 77, '2024-10-08', 'Pendiente', '2024-11-08'),
(79, 78, '2024-10-03', 'Pendiente', '2024-11-03'),
(80, 79, '2024-10-03', 'Pendiente', '2024-11-03'),
(81, 80, '2024-10-08', 'Pendiente', '2024-11-08'),
(82, 81, '2024-10-08', 'Pendiente', '2024-11-08'),
(83, 82, '2024-10-03', 'Pendiente', '2024-11-03'),
(84, 83, '2024-10-10', 'Pendiente', '2024-11-10'),
(85, 85, '2024-10-03', 'Pendiente', '2024-11-03'),
(86, 86, '2024-10-01', 'Pendiente', '2024-11-01'),
(87, 88, '2024-10-02', 'Pendiente', '2024-11-02'),
(88, 89, '2024-10-02', 'Pendiente', '2024-11-02'),
(89, 90, '2024-10-02', 'Pendiente', '2024-11-02'),
(90, 91, '2024-10-10', 'Pendiente', '2024-11-10'),
(91, 92, '2024-10-01', 'Pendiente', '2024-11-01'),
(92, 93, '2024-10-08', 'Pendiente', '2024-11-08'),
(93, 94, '2024-10-04', 'Pendiente', '2024-11-04'),
(94, 95, '2024-10-02', 'Pendiente', '2024-11-02'),
(95, 96, '2024-10-02', 'Pendiente', '2024-11-02'),
(96, 97, '2024-10-03', 'Pendiente', '2024-11-03'),
(97, 98, '2024-10-01', 'Pendiente', '2024-11-01'),
(98, 99, '2024-10-03', 'Pendiente', '2024-11-03'),
(99, 100, '2024-10-01', 'Pendiente', '2024-11-01'),
(100, 101, '2024-10-10', 'Pendiente', '2024-11-10'),
(101, 102, '2024-10-03', 'Pendiente', '2024-11-03'),
(102, 103, '2024-10-01', 'Pendiente', '2024-11-01'),
(103, 104, '2024-10-15', 'Pendiente', '2024-11-15'),
(104, 105, '2024-10-04', 'Pendiente', '2024-11-04'),
(105, 106, '2024-10-03', 'Pendiente', '2024-11-03'),
(106, 107, '2024-10-15', 'Pendiente', '2024-11-15'),
(107, 108, '2024-10-03', 'Pendiente', '2024-11-03'),
(108, 109, '2024-10-08', 'Pendiente', '2024-11-08'),
(109, 110, '2024-10-15', 'Pendiente', '2024-11-15'),
(110, 111, '2024-10-04', 'Pendiente', '2024-11-04'),
(111, 112, '2024-10-02', 'Pendiente', '2024-11-02'),
(112, 113, '2024-10-09', 'Pendiente', '2024-11-09'),
(113, 114, '2024-10-03', 'Pendiente', '2024-11-03'),
(114, 115, '2024-10-16', 'Pendiente', '2024-11-16'),
(115, 116, '2024-10-04', 'Pendiente', '2024-11-04'),
(116, 117, '2024-10-02', 'Pendiente', '2024-11-02'),
(117, 120, '2024-10-01', 'Pendiente', '2024-11-01'),
(118, 121, '2024-10-03', 'Pendiente', '2024-11-03'),
(119, 122, '2024-10-08', 'Pendiente', '2024-11-08'),
(120, 123, '2024-10-08', 'Pendiente', '2024-11-08'),
(121, 124, '2024-10-01', 'Pendiente', '2024-11-01'),
(122, 125, '2024-10-01', 'Pendiente', '2024-11-01'),
(123, 126, '2024-10-03', 'Pendiente', '2024-11-03'),
(124, 127, '2024-10-03', 'Pendiente', '2024-11-03'),
(125, 128, '2024-10-03', 'Pendiente', '2024-11-03'),
(126, 129, '2024-10-10', 'Pendiente', '2024-11-10'),
(127, 130, '2024-10-15', 'Pendiente', '2024-11-15'),
(128, 131, '2024-10-09', 'Pendiente', '2024-11-09'),
(129, 132, '2024-10-09', 'Pendiente', '2024-11-09'),
(130, 133, '2024-10-01', 'Pendiente', '2024-11-01'),
(131, 134, '2024-10-01', 'Pendiente', '2024-11-01'),
(132, 135, '2024-10-05', 'Pendiente', '2024-11-05'),
(133, 136, '2024-10-07', 'Pendiente', '2024-11-07'),
(134, 137, '2024-10-07', 'Pendiente', '2024-11-07'),
(135, 138, '2024-10-07', 'Pendiente', '2024-11-07'),
(136, 139, '2024-10-07', 'Pendiente', '2024-11-07'),
(137, 140, '2024-11-09', 'Pendiente', '2024-12-09'),
(138, 141, '2024-10-07', 'Pendiente', '2024-11-07'),
(139, 143, '2024-10-04', 'Pendiente', '2024-11-04'),
(140, 144, '2024-10-02', 'Pendiente', '2024-11-02'),
(141, 145, '2024-10-01', 'Pendiente', '2024-11-01'),
(142, 146, '2024-10-08', 'Pendiente', '2024-11-08'),
(143, 147, '2024-10-08', 'Pendiente', '2024-11-08'),
(144, 148, '2024-10-08', 'Pendiente', '2024-11-08'),
(145, 149, '2024-10-15', 'Pendiente', '2024-11-15'),
(146, 150, '2024-10-17', 'Pendiente', '2024-11-17'),
(147, 151, '2024-10-15', 'Pendiente', '2024-11-15'),
(148, 152, '2024-10-10', 'Pendiente', '2024-11-10'),
(149, 153, '2024-10-14', 'Pendiente', '2024-11-14'),
(150, 154, '2024-10-15', 'Pendiente', '2024-11-15'),
(151, 155, '2024-10-03', 'Pendiente', '2024-11-03'),
(152, 156, '2024-10-08', 'Pendiente', '2024-11-08'),
(153, 157, '2024-10-10', 'Pendiente', '2024-11-10'),
(154, 158, '2024-10-03', 'Pendiente', '2024-11-03'),
(155, 159, '2024-10-08', 'Pendiente', '2024-11-08'),
(156, 160, '2024-10-01', 'Pendiente', '2024-11-01'),
(157, 161, '2024-10-08', 'Pendiente', '2024-11-08'),
(158, 162, '2024-10-03', 'Pendiente', '2024-11-03'),
(159, 163, '2024-10-08', 'Pendiente', '2024-11-08'),
(160, 165, '2024-10-15', 'Pendiente', '2024-11-15'),
(161, 166, '2024-10-08', 'Pendiente', '2024-11-08'),
(162, 167, '2024-10-03', 'Pendiente', '2024-11-03'),
(163, 168, '2024-10-03', 'Pendiente', '2024-11-03'),
(164, 169, '2024-10-01', 'Pendiente', '2024-11-01'),
(165, 170, '2024-10-03', 'Pendiente', '2024-11-03'),
(166, 171, '2024-10-01', 'Pendiente', '2024-11-01'),
(167, 172, '2024-10-03', 'Pendiente', '2024-11-03'),
(168, 173, '2024-10-03', 'Pendiente', '2024-11-03'),
(169, 174, '0000-00-00', 'Pendiente', NULL),
(170, 175, '2024-10-03', 'Pendiente', '2024-11-03'),
(171, 176, '2024-10-10', 'Pendiente', '2024-11-10'),
(172, 177, '2024-10-07', 'Pendiente', '2024-11-07'),
(173, 178, '2024-10-02', 'Pendiente', '2024-11-02'),
(174, 180, '2024-10-04', 'Pendiente', '2024-11-04'),
(175, 181, '2024-10-02', 'Pendiente', '2024-11-02'),
(176, 183, '2024-10-03', 'Pendiente', '2024-11-03'),
(177, 186, '2024-10-07', 'Pendiente', '2024-11-07'),
(178, 187, '2024-10-07', 'Pendiente', '2024-11-07'),
(179, 188, '2024-10-07', 'Pendiente', '2024-11-07'),
(180, 189, '2024-10-07', 'Pendiente', '2024-11-07'),
(181, 190, '2024-10-16', 'Pendiente', '2024-11-16'),
(182, 192, '2024-10-01', 'Pendiente', '2024-11-01'),
(183, 193, '2024-10-09', 'Pendiente', '2024-11-09'),
(184, 195, '2024-10-10', 'Pendiente', '2024-11-10'),
(185, 196, '2024-10-10', 'Pendiente', '2024-11-10'),
(186, 197, '2024-10-15', 'Pendiente', '2024-11-15'),
(187, 198, '2024-10-07', 'Pendiente', '2024-11-07'),
(188, 199, '2024-10-09', 'Pendiente', '2024-11-09'),
(189, 200, '2024-10-09', 'Pendiente', '2024-11-09'),
(190, 201, '2024-10-02', 'Pendiente', '2024-11-02'),
(191, 202, '2024-10-02', 'Pendiente', '2024-11-02'),
(192, 203, '2024-10-04', 'Pendiente', '2024-11-04'),
(193, 204, '2024-10-03', 'Pendiente', '2024-11-03'),
(194, 205, '2024-10-02', 'Pendiente', '2024-11-02'),
(195, 206, '2024-10-02', 'Pendiente', '2024-11-02'),
(196, 207, '2024-10-07', 'Pendiente', '2024-11-07'),
(197, 208, '2024-10-09', 'Pendiente', '2024-11-09'),
(198, 209, '2024-10-04', 'Pendiente', '2024-11-04'),
(199, 211, '2024-10-07', 'Pendiente', '2024-11-07'),
(200, 212, '2024-10-11', 'Pendiente', '2024-11-11'),
(201, 213, '2024-10-08', 'Pendiente', '2024-11-08'),
(202, 214, '2024-10-11', 'Pendiente', '2024-11-11'),
(203, 215, '2024-10-10', 'Pendiente', '2024-11-10'),
(204, 216, '2024-10-01', 'Pendiente', '2024-11-01'),
(205, 217, '2024-10-08', 'Pendiente', '2024-11-08'),
(206, 218, '2024-10-08', 'Pendiente', '2024-11-08'),
(207, 219, '2024-10-03', 'Pendiente', '2024-11-03'),
(208, 220, '2024-10-08', 'Pendiente', '2024-11-08'),
(209, 221, '2024-10-05', 'Pendiente', '2024-11-05'),
(210, 222, '2024-10-03', 'Pendiente', '2024-11-03'),
(211, 223, '2024-10-08', 'Pendiente', '2024-11-08'),
(212, 224, '2024-10-08', 'Pendiente', '2024-11-08'),
(213, 225, '2024-10-04', 'Pendiente', '2024-11-04'),
(214, 226, '2024-10-11', 'Pendiente', '2024-11-11'),
(215, 227, '2024-10-09', 'Pendiente', '2024-11-09'),
(216, 228, '2024-10-16', 'Pendiente', '2024-11-16'),
(217, 229, '2024-10-04', 'Pendiente', '2024-11-04'),
(218, 230, '2024-10-07', 'Pendiente', '2024-11-07'),
(219, 231, '2024-10-16', 'Pendiente', '2024-11-16'),
(220, 232, '2024-10-02', 'Pendiente', '2024-11-02'),
(221, 233, '2024-10-02', 'Pendiente', '2024-11-02'),
(222, 234, '2024-10-04', 'Pendiente', '2024-11-04'),
(223, 235, '2024-10-02', 'Pendiente', '2024-11-02'),
(224, 236, '2024-10-02', 'Pendiente', '2024-11-02'),
(225, 237, '2024-10-08', 'Pendiente', '2024-11-08'),
(226, 239, '2024-10-08', 'Pendiente', '2024-11-08'),
(227, 240, '2024-10-04', 'Pendiente', '2024-11-04'),
(228, 241, '2024-10-06', 'Pendiente', '2024-11-06'),
(229, 243, '2024-10-02', 'Pendiente', '2024-11-02'),
(230, 244, '2024-10-04', 'Pendiente', '2024-11-04'),
(231, 245, '2024-10-07', 'Pendiente', '2024-11-07'),
(232, 246, '2024-10-16', 'Pendiente', '2024-11-16'),
(233, 198, '2024-10-07', 'Pendiente', '2024-11-07'),
(234, 247, '2024-10-09', 'Pendiente', '2024-11-09'),
(235, 248, '2024-10-04', 'Pendiente', '2024-11-04'),
(236, 249, '2024-10-09', 'Pendiente', '2024-11-09'),
(237, 250, '2024-10-09', 'Pendiente', '2024-11-09'),
(238, 251, '2024-10-04', 'Pendiente', '2024-11-04'),
(239, 252, '2024-10-04', 'Pendiente', '2024-11-04'),
(240, 253, '2024-10-09', 'Pendiente', '2024-11-09'),
(241, 255, '2024-10-02', 'Pendiente', '2024-11-02'),
(242, 256, '2024-10-04', 'Pendiente', '2024-11-04'),
(243, 257, '2024-10-13', 'Pendiente', '2024-11-13'),
(244, 258, '2024-10-17', 'Pendiente', '2024-11-17'),
(245, 259, '2024-10-17', 'Pendiente', '2024-11-17'),
(246, 260, '2024-10-17', 'Pendiente', '2024-11-17'),
(247, 261, '2024-10-17', 'Pendiente', '2024-11-17'),
(248, 262, '2024-10-17', 'Pendiente', '2024-11-17'),
(249, 263, '2024-10-17', 'Pendiente', '2024-11-17'),
(250, 264, '2024-10-17', 'Pendiente', '2024-11-17'),
(251, 73, '2024-10-02', 'Pendiente', '2024-11-02'),
(252, 125, '2024-10-02', 'Pendiente', '2024-11-02'),
(253, 257, '2024-10-16', 'Pendiente', '2024-11-16'),
(254, 282, '2024-10-02', 'Pendiente', '2024-11-02'),
(255, 283, '2024-10-02', 'Pendiente', '2024-11-02'),
(256, 285, '2024-10-07', 'Pendiente', '2024-11-07'),
(257, 286, '2024-10-09', 'Pendiente', '2024-11-09'),
(258, 183, '2024-10-03', 'Pendiente', '2024-11-03'),
(259, 289, '2024-10-03', 'Pendiente', '2024-11-03'),
(260, 290, '2024-10-03', 'Pendiente', '2024-11-03'),
(261, 291, '2024-10-03', 'Pendiente', '2024-11-03'),
(262, 292, '2024-10-03', 'Pendiente', '2024-11-03'),
(263, 293, '2024-10-03', 'Pendiente', '2024-11-03'),
(264, 53, '2024-10-07', 'Pendiente', '2024-11-07'),
(265, 297, '2024-10-07', 'Pendiente', '2024-11-07'),
(266, 298, '2024-10-14', 'Pendiente', '2024-11-14'),
(267, 300, '2024-10-14', 'Pendiente', '2024-11-14'),
(268, 302, '2024-10-16', 'Pendiente', '2024-11-16'),
(269, 303, '2024-10-16', 'Pendiente', '2024-11-16'),
(270, 83, '2024-10-03', 'Pendiente', '2024-11-03'),
(271, 204, '2024-10-03', 'Pendiente', '2024-11-03'),
(272, 305, '2024-10-03', 'Pendiente', '2024-11-03'),
(273, 306, '2024-10-08', 'Pendiente', '2024-11-08'),
(274, 308, '2024-10-08', 'Pendiente', '2024-11-08'),
(275, 311, '2024-10-08', 'Pendiente', '2024-11-08'),
(276, 312, '2024-10-03', 'Pendiente', '2024-11-03'),
(277, 313, '2024-10-10', 'Pendiente', '2024-11-10'),
(278, 143, '2024-10-04', 'Pendiente', '2024-11-04'),
(279, 144, '2024-10-11', 'Pendiente', '2024-11-11'),
(280, 302, '2024-10-11', 'Pendiente', '2024-11-11'),
(281, 314, '2024-10-18', 'Pendiente', '2024-11-18'),
(282, 315, '2024-10-02', 'Pendiente', '2024-11-02'),
(283, 317, '2024-10-16', 'Pendiente', '2024-11-16'),
(284, 320, '2024-10-04', 'Pendiente', '2024-11-04'),
(285, 321, '2024-10-04', 'Pendiente', '2024-11-04'),
(286, 322, '2024-10-07', 'Pendiente', '2024-11-07'),
(287, 112, '2024-10-08', 'Pendiente', '2024-11-08'),
(288, 233, '2024-10-15', 'Pendiente', '2024-11-15'),
(289, 237, '2024-10-08', 'Pendiente', '2024-11-08'),
(290, 239, '2024-10-08', 'Pendiente', '2024-11-08'),
(291, 326, '2024-10-08', 'Pendiente', '2024-11-08'),
(292, 327, '2024-10-08', 'Pendiente', '2024-11-08'),
(293, 331, '2024-10-08', 'Pendiente', '2024-11-08'),
(294, 224, '2024-10-05', 'Pendiente', '2024-11-05'),
(295, 333, '2024-10-09', 'Pendiente', '2024-11-09'),
(296, 336, '2024-10-09', 'Pendiente', '2024-11-09'),
(297, 337, '2024-10-02', 'Pendiente', '2024-11-02'),
(298, 338, '2024-10-02', 'Pendiente', '2024-11-02'),
(299, 339, '2024-10-07', 'Pendiente', '2024-11-07'),
(300, 341, '2024-10-11', 'Pendiente', '2024-11-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_usuarios`
--

CREATE TABLE `permisos_usuarios` (
  `id_permiso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `enlace_pagina` varchar(255) NOT NULL,
  `estado_acceso` enum('Permitido','Bloqueado') NOT NULL DEFAULT 'Bloqueado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos_usuarios`
--

INSERT INTO `permisos_usuarios` (`id_permiso`, `id_usuario`, `enlace_pagina`, `estado_acceso`) VALUES
(1, 13, 'list-users.php', 'Permitido'),
(2, 13, 'user-entry.php', 'Permitido'),
(3, 13, 'user-rols.php', 'Permitido'),
(4, 13, 'members.php', 'Permitido'),
(5, 13, 'member-entry.php', 'Permitido'),
(6, 13, 'archive-member.php', 'Permitido'),
(7, 13, 'files.php', 'Permitido'),
(8, 13, 'member-group-remove.php', 'Permitido'),
(9, 13, 'member-group.php', 'Permitido'),
(10, 13, 'members-attendence.php', 'Permitido'),
(11, 13, 'detalles_miembros.php', 'Permitido'),
(12, 13, 'groups.php', 'Permitido'),
(13, 13, 'services.php', 'Permitido'),
(14, 13, 'group_service.php', 'Permitido'),
(15, 13, 'event.php', 'Permitido'),
(16, 13, 'events.php', 'Permitido'),
(17, 13, 'persons.php', 'Permitido'),
(18, 13, 'inscripciones.php', 'Permitido'),
(19, 13, 'inscripciones-list.php', 'Permitido'),
(20, 13, 'shop.php', 'Permitido'),
(21, 13, 'shops.php', 'Permitido'),
(22, 13, 'products.php', 'Permitido'),
(23, 13, 'egreso-entry.php', 'Permitido'),
(24, 13, 'list-egreso.php', 'Permitido'),
(25, 14, 'list-users.php', 'Bloqueado'),
(26, 14, 'user-entry.php', 'Bloqueado'),
(27, 14, 'user-rols.php', 'Bloqueado'),
(28, 14, 'members.php', 'Bloqueado'),
(29, 14, 'member-entry.php', 'Bloqueado'),
(30, 14, 'archive-member.php', 'Bloqueado'),
(31, 14, 'files.php', 'Bloqueado'),
(32, 14, 'member-group-remove.php', 'Bloqueado'),
(33, 14, 'member-group.php', 'Permitido'),
(34, 14, 'members-attendence.php', 'Bloqueado'),
(35, 14, 'detalles_miembros.php', 'Bloqueado'),
(36, 14, 'groups.php', 'Bloqueado'),
(37, 14, 'services.php', 'Bloqueado'),
(38, 14, 'group_service.php', 'Bloqueado'),
(39, 14, 'event.php', 'Bloqueado'),
(40, 14, 'events.php', 'Bloqueado'),
(41, 14, 'persons.php', 'Bloqueado'),
(42, 14, 'inscripciones.php', 'Bloqueado'),
(43, 14, 'inscripciones-list.php', 'Bloqueado'),
(44, 14, 'shop.php', 'Bloqueado'),
(45, 14, 'shops.php', 'Bloqueado'),
(46, 14, 'products.php', 'Bloqueado'),
(47, 14, 'egreso-entry.php', 'Bloqueado'),
(48, 14, 'list-egreso.php', 'Bloqueado'),
(75, 19, 'list-users.php', 'Permitido'),
(76, 19, 'user-entry.php', 'Bloqueado'),
(77, 19, 'user-rols.php', 'Bloqueado'),
(78, 19, 'members.php', 'Bloqueado'),
(79, 19, 'member-entry.php', 'Bloqueado'),
(80, 19, 'archive-member.php', 'Bloqueado'),
(81, 19, 'files.php', 'Bloqueado'),
(82, 19, 'members-attendence.php', 'Bloqueado'),
(83, 19, 'groups.php', 'Bloqueado'),
(84, 19, 'services.php', 'Bloqueado'),
(85, 19, 'event.php', 'Bloqueado'),
(86, 20, 'list-users.php', 'Permitido'),
(87, 20, 'user-entry.php', 'Permitido'),
(88, 20, 'user-rols.php', 'Bloqueado'),
(89, 20, 'members.php', 'Bloqueado'),
(90, 20, 'member-entry.php', 'Bloqueado'),
(91, 20, 'archive-member.php', 'Bloqueado'),
(92, 20, 'files.php', 'Bloqueado'),
(93, 20, 'members-attendence.php', 'Bloqueado'),
(94, 20, 'groups.php', 'Bloqueado'),
(95, 20, 'services.php', 'Bloqueado'),
(96, 20, 'event.php', 'Bloqueado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`cedula`, `nombre`, `celular`, `fecha_nacimiento`) VALUES
('27371913', 'Angie Carolina', '04126153090', '2024-10-12'),
('27371914', 'Andreina Romero 1', '04126153095', '2024-10-30'),
('27371919', 'Maria Gonzales', '04126153094', '1965-02-12'),
('27371945', 'Marcos Perez', '04126153090', '1992-02-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `costo` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre_producto`, `costo`) VALUES
(1, 'Camiseta Deportiva 1', 15.90),
(2, 'Medias de Compresión', 20.50),
(5, 'Toalla de Gimnasio', 12.00),
(6, 'Cinta de Correr', 1200.00),
(7, 'Mancuernas de 5kg', 25.00),
(8, 'Colchoneta de Ejercicio', 30.00),
(9, 'Zapatillas de Entrenamiento', 70.00),
(10, 'Guantes de Entrenamiento', 15.00),
(12, 'Camisa FC Barcelona', 2500.00);

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
(2, 'Pilates F2', 1250.00),
(3, 'Musculación Adicional F2', 70.00),
(4, 'Musculación Adicional F3', 75.00);

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
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id`, `nombre`) VALUES
(2, 'Cuotas');

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
(13, 'Fabian', '1233', 1, 0),
(14, 'Bryan', '1235', 2, 0),
(15, 'Antonio', '1236', 2, 0),
(16, 'Jorge', '1237', 2, 1),
(19, 'Andre11', '1230', 2, 0),
(20, 'Maria', '1230', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_grupo`
--

CREATE TABLE `usuarios_grupo` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `cedula` varchar(110) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `cantidad`, `total`, `cedula`, `id_producto`, `fecha`) VALUES
(1, 5, 60.00, '27371913', 2, '2024-10-13'),
(3, 10, 0.00, '27371913', 8, '2024-10-13'),
(4, 10, 159.90, '27371913', 1, '2024-10-13'),
(5, 1, 15.99, '27371913', 1, '2024-10-13'),
(6, 10, 0.00, '27371913', 1, '2024-10-14'),
(8, 3, 7500.00, '27371945', 12, '2024-10-28'),
(9, 12, 14400.00, '27371913', 6, '2024-11-30');

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
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `asistencia_ibfk_2` (`id_grupo`);

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
-- Indices de la tabla `estado_asistencia`
--
ALTER TABLE `estado_asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos_mensuales`
--
ALTER TABLE `gastos_mensuales`
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
-- Indices de la tabla `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD PRIMARY KEY (`id_inasistencia`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `inasistencias_ibfk_2` (`id_asistencia`);

--
-- Indices de la tabla `inscripcion_eventos`
--
ALTER TABLE `inscripcion_eventos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `tipo_pago_id` (`tipo_pago_id`);

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
-- Indices de la tabla `pagos_mensuales`
--
ALTER TABLE `pagos_mensuales`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `pagos_mensuales_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `permisos_usuarios`
--
ALTER TABLE `permisos_usuarios`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_tipo_usuario` (`id_tipo`);

--
-- Indices de la tabla `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD PRIMARY KEY (`id_usuario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cedula` (`cedula`),
  ADD KEY `id_producto` (`id_producto`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

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
-- AUTO_INCREMENT de la tabla `estado_asistencia`
--
ALTER TABLE `estado_asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `gastos_mensuales`
--
ALTER TABLE `gastos_mensuales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `inasistencias`
--
ALTER TABLE `inasistencias`
  MODIFY `id_inasistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `inscripcion_eventos`
--
ALTER TABLE `inscripcion_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=408;

--
-- AUTO_INCREMENT de la tabla `miembro_documento`
--
ALTER TABLE `miembro_documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pagos_mensuales`
--
ALTER TABLE `pagos_mensuales`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT de la tabla `permisos_usuarios`
--
ALTER TABLE `permisos_usuarios`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipos_usuarios`
--
ALTER TABLE `tipos_usuarios`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalles_grupos`
--
ALTER TABLE `detalles_grupos`
  ADD CONSTRAINT `detalles_grupos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`),
  ADD CONSTRAINT `detalles_grupos_ibfk_2` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`);

--
-- Filtros para la tabla `inasistencias`
--
ALTER TABLE `inasistencias`
  ADD CONSTRAINT `inasistencias_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`),
  ADD CONSTRAINT `inasistencias_ibfk_2` FOREIGN KEY (`id_asistencia`) REFERENCES `asistencia` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `inscripcion_eventos`
--
ALTER TABLE `inscripcion_eventos`
  ADD CONSTRAINT `inscripcion_eventos_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `personas` (`cedula`),
  ADD CONSTRAINT `inscripcion_eventos_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `inscripcion_eventos_ibfk_3` FOREIGN KEY (`tipo_pago_id`) REFERENCES `tipo_pago` (`id`);

--
-- Filtros para la tabla `miembro_documento`
--
ALTER TABLE `miembro_documento`
  ADD CONSTRAINT `miembro_documento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `miembro_grupo`
--
ALTER TABLE `miembro_grupo`
  ADD CONSTRAINT `fk_grupo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_grupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `miembro_tarifa`
--
ALTER TABLE `miembro_tarifa`
  ADD CONSTRAINT `fk_tarifa_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_tarifa_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembros` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `miembro_tarifa_ibfk_2` FOREIGN KEY (`id`) REFERENCES `tarifas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos_mensuales`
--
ALTER TABLE `pagos_mensuales`
  ADD CONSTRAINT `pagos_mensuales_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `miembro_grupo` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permisos_usuarios`
--
ALTER TABLE `permisos_usuarios`
  ADD CONSTRAINT `permisos_usuarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;

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

--
-- Filtros para la tabla `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD CONSTRAINT `usuarios_grupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `usuarios_grupo_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id_grupo`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `cedula_ventas_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `personas` (`cedula`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
