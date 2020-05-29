-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2020 a las 04:26:17
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Marcaje`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adelantoefectivo`
--

CREATE TABLE `adelantoefectivo` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id` varchar(15) NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `adelantoefectivo`
--

INSERT INTO `adelantoefectivo` (`id`, `fecha`, `empleado_id`, `monto`) VALUES
(2, '2020-05-10', '26', 400),
(3, '2020-05-10', '24', 1000),
(4, '2020-05-26', '29', 311),
(5, '2020-05-26', '26', 2900),
(6, '2020-05-27', '31', 300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nombre`, `apellido`, `foto`, `created_on`) VALUES
(1, 'admin', '$2y$10$UrGSvHTWm8.ZK4BzPmo8iuqsK6XF5RfHay6ooC5D50y/nShon5wqe', 'Willy_7', 'González', '1587945375.jpg', '2020-04-30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1),
  `time_out` time NOT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `empleado_id`, `date`, `time_in`, `status`, `time_out`, `num_hr`) VALUES
(123, 24, '2020-05-10', '21:49:27', 0, '03:06:46', 3.8166666666667),
(125, 24, '2020-05-14', '00:30:00', 1, '22:30:00', 8),
(126, 27, '2020-05-10', '02:42:54', 1, '02:45:40', 6.2333333333333),
(128, 28, '2020-05-13', '14:47:12', 0, '14:48:14', 0.016666666666667),
(129, 29, '2020-05-15', '21:10:32', 0, '21:11:05', 3.1666666666667),
(130, 28, '2020-05-15', '21:36:03', 0, '21:36:24', 4.6),
(131, 30, '2020-05-27', '20:39:16', 0, '21:13:44', 2.65),
(132, 31, '2020-05-27', '20:42:57', 1, '20:53:27', 14.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deducciones`
--

CREATE TABLE `deducciones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `monto` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `deducciones`
--

INSERT INTO `deducciones` (`id`, `descripcion`, `monto`) VALUES
(5, 'Pago de EPS 4%', 2500),
(7, 'OTRO DESCUENTO', 789),
(8, 'CARGAS', 900),
(10, 'PARQUEO', 2900),
(11, 'COMIDA', 11),
(12, 'Capacitaciones', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `empleado_id` varchar(15) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` text NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `posicion_i` int(11) NOT NULL,
  `calendario_id` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `empleado_id`, `nombre`, `apellidos`, `direccion`, `fechaNacimiento`, `contacto`, `genero`, `posicion_id`, `calendario_id`, `foto`, `created_on`) VALUES
(24, 'MAW817094635', 'Abelardo', 'Mejia', 'Calle 54 N 12-23', '1989-07-12', 'RESPONDABLE', 'Female', 2, 2, '', '2020-01-07'),
(26, 'RBT891430576', 'AXEL JUANES', 'Hernadez', 'el Milagro', '2020-04-28', 'RESPONSABLE', 'Male', 2, 3, 'pp (3).jpg', '2020-05-09'),
(27, 'CZH608759324', 'MARIAAAA', 'JUAREZZZZ', 'EL MILAGRO', '2020-04-30', 'RESPONSABLE', 'Female', 1, 3, '', '2020-05-10'),
(28, 'ONT397465108', 'CHEJO', 'GARCIA', 'LA FLORIDA', '2020-05-14', 'responsable', 'Male', 1, 1, 'CHEJO.jpg', '2020-05-13'),
(29, 'HWY439726015', 'Marcos', 'Perez', 'El Milagro', '2020-05-13', 'Responsable', 'Male', 1, 2, 'pp.jpg', '2020-05-15'),
(30, 'VKC042386571', 'keydell', 'Rosales', 'Colinas', '1995-06-14', 'keydd@corre.com', 'Male', 1, 3, 'keydell.jpg', '2020-05-27'),
(31, 'OUW248975306', 'Jairo', 'perez', 'colinas2', '2020-04-27', 'RESPONSABLE', 'Male', 8, 7, '1.jpg', '2020-05-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `time_in`, `time_out`) VALUES
(1, '07:00:00', '16:00:00'),
(2, '08:00:00', '17:00:00'),
(3, '09:00:00', '18:00:00'),
(4, '10:00:00', '19:00:00'),
(6, '21:00:00', '17:00:00'),
(7, '21:00:00', '05:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `empleado_id` varchar(15) NOT NULL,
  `hora` double NOT NULL,
  `sueldo` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `overtime`
--

INSERT INTO `overtime` (`id`, `empleado_id`, `horas`, `sueldo`, `date_overtime`) VALUES
(6, '26', 43.716666666667, 478, '2020-04-28'),
(7, '24', 68.083333333333, 89, '2020-04-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion`
--

CREATE TABLE `posicion` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `sueldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posicion`
--

INSERT INTO `posicion` (`id`, `descripcion`, `sueldo`) VALUES
(1, 'Programador', 100000),
(2, 'Escritor', 79000),
(3, 'Marketing ', 42000),
(4, 'DiseÃ±ador GrÃ¡fico', 35000),
(7, 'Seguridad', 70),
(8, 'directo', 9000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adelantoefectivo`
--
ALTER TABLE `adelantoefectivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posicion`
--
ALTER TABLE `posicion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adelantoefectivo`
--
ALTER TABLE `adelantoefectivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT de la tabla `deducciones`
--
ALTER TABLE `deducciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `posicion`
--
ALTER TABLE `posicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
