-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2022 a las 02:48:24
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE `cancha` (
  `cod_cancha` int(11) NOT NULL,
  `nombre_cancha` varchar(200) NOT NULL,
  `estado_cancha` tinyint(1) NOT NULL,
  `obs_cancha` varchar(1000) DEFAULT NULL,
  `Disciplina_cod_disciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cancha`
--

INSERT INTO `cancha` (`cod_cancha`, `nombre_cancha`, `estado_cancha`, `obs_cancha`, `Disciplina_cod_disciplina`) VALUES
(3, 'test cancha', 0, 'la mejor observacion', 5),
(4, 'test otra cancha', 1, 'otra obs', 7),
(5, 'matriz cotacachi', 0, 'Cancha de basquet ubicada en cerca del hospital de cotacachi.', 8),
(7, 'Mas pruebas', 1, 'si si esto funciona? dfsjfklds', 7),
(14, 'La merced', 0, 'Una cancha ubicada en la parroquia san jose de cotacachi\r\n', 5),
(15, 'Locos por el fubtbol', 0, 'Cancha ubicada en la cuidadad de Otavalo muy cerca de terminal.', 5),
(16, 'Rodrigo Paz Delgado', 0, 'El estadio de Liga Deportiva Universitaria, conocido extraoficialmente como estadio Casa Blanca y denominado oficialmente como estadio Rodrigo Paz Delgado, es un estadio de fútbol que se encuentra ubicado en la avenida John F. Kennedy y calle Gustavo Lemos, en el sector de Ponceano, al norte de la ciudad de Quito, Ecuador; a 2727 msnm siendo propiedad de Liga Deportiva Universitaria.', 8),
(17, 'Estadio Olímpico de Ibarra', 0, 'El Estadio Olímpico de Ibarra es un estadio de fútbol de Ecuador. Está ubicado entre las Avdas. Víctor Manuel Peñaherrera y Jaime Roldós de la ciudad de Ibarra a 2202 msnm. Su capacidad es para 17 300 espectadores, y allí juega como local el Imbabura Sporting Club, el Club Deportivo Ibarra, el La Cantera Fútbol Club y el Club Deportivo Leones del Norte, equipos de la Segunda Categoría del fútbol ecuatoriano.', 7),
(18, 'Estadio Bellavista', 0, 'El estadio Bellavista es un estadio de fútbol de Ecuador. Está ubicado entre las Avdas. Bolivariana y Bellavista de la ciudad de Ambato a 2620 msnm. Su capacidad es para 16 467 espectadores, y allí juega como local el Club Deportivo Macará y el Club Técnico Universitario, equipos de la Serie A del fútbol ecuatoriano.', 7),
(19, 'Estadio Olímpico de Cotacachi ', 0, 'El Estadio Francisco Espinoza es un estadio multiusos ubicado en la ciudad de Cotacachi, provincia de Imbabura. Fue inaugurado en el año 2006. Es usado para la práctica del fútbol y posee una capacidad para 20 000 espectadores.\r\n\r\nDesempeña un importante papel en el fútbol local, ya que los clubes de cotacachences como el Club Deportivo Cedecot hacen y/o hacían de local en este escenario deportivo, que participan en el Campeonato Provincial de Segunda Categoría de Imbabura.\r\n\r\nEl estadio es sede de distintos eventos deportivos a nivel local, ya que también es usado para los campeonatos escolares de fútbol que se desarrollan en la ciudad en las distintas categorías, también puede ser usado para eventos culturales, artísticos, musicales de la localidad.\r\n\r\nEl recinto deportivo está ubicado en la Avenida del Sol y calle 10 de Agosto de la ciudad de Cotacachi. El estadio tiene instalaciones modernas con camerinos para árbitros, equipos local y visitante, zona de calentamiento, cabinas de p', 5),
(20, 'Estadio Olímpico Jaime Terán', 0, 'El Estadio Olímpico Jaime Terán es un estadio multiusos. Está ubicado en la avenida Rocafuerte y Velasco de la ciudad de Atuntaqui, provincia de Imbabura. Es usado mayoritariamente para la práctica del fútbol, Tiene capacidad para 7 000 espectadores.\r\n\r\nDesempeña un importante papel en el fútbol local, ya que los clubes anteños como el Atuntaqui Fútbol Club, 2 de Marzo e Imbabura Sporting Club hacían y/o hacen de locales en este escenario deportivo.\r\n\r\nEl estadio es sede de distintos eventos deportivos a nivel local, así como es escenario para varios eventos de tipo cultural, especialmente conciertos musicales (que también se realizan en el Coliseo de la Liga Cantonal de Antonio Ante de Atuntaqui).', 7),
(21, 'Cotacachi', 0, 'Cancha de voley ubicada cerca del terminal terrestre de cotacachi,', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(200) NOT NULL,
  `apellido_cliente` varchar(200) NOT NULL,
  `dir_cliente` varchar(1000) DEFAULT NULL,
  `tel_cliente` varchar(20) DEFAULT NULL,
  `correo_cliente` varchar(100) DEFAULT NULL,
  `pass` text NOT NULL,
  `genero_cliente` varchar(10) DEFAULT NULL,
  `fn_cliente` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `nombre_cliente`, `apellido_cliente`, `dir_cliente`, `tel_cliente`, `correo_cliente`, `pass`, `genero_cliente`, `fn_cliente`) VALUES
(4, 'Maite', 'Perugachi', 'Cotacachi, via imantag', '0978926595', 'maite@mail.com', '$2y$10$qlIL7VuradXRrDL1BDKe3u8DecieuIxIQYfEI6ybL/.8G4MuZxala', 'Mujer', '2009-09-27'),
(5, 'Jose', 'Narvaez', 'Otavalo', '0978953549', 'jose@gmail.com', '$2y$10$zBVzJO/9kDiESCqlBHmhFOESTIDY9/yrr5pZnineRF3zA/4D13GgK', 'Hombre', '2001-01-09'),
(6, 'Maria', 'Fernandez', 'Imantag', '0978926595', 'maria@gmai.cpm', '$2y$10$LsnsrJ5gm1PFPFNJ2KaTJOpSN7IblsrG/r9CmXevk4.b1QkE.HfFW', 'Mujer', '2022-02-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_reserva`
--

CREATE TABLE `detalle_reserva` (
  `cancha_cod_cancha` int(11) NOT NULL,
  `reserva_cod_reserva` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_reserva`
--

INSERT INTO `detalle_reserva` (`cancha_cod_cancha`, `reserva_cod_reserva`, `cantidad`, `precio`) VALUES
(5, 9, 1, '5.20'),
(14, 6, 1, '14.40'),
(16, 8, 1, '5.20'),
(18, 5, 1, '19.95'),
(21, 7, 1, '22.00'),
(21, 10, 1, '22.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `disciplina`
--

CREATE TABLE `disciplina` (
  `cod_disciplina` int(11) NOT NULL,
  `nombre_disciplina` varchar(200) NOT NULL,
  `empresa_cod_empresa` int(11) NOT NULL,
  `precio_disciplina` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `disciplina`
--

INSERT INTO `disciplina` (`cod_disciplina`, `nombre_disciplina`, `empresa_cod_empresa`, `precio_disciplina`) VALUES
(5, 'Fútbol', 2, 32),
(7, 'Tenis', 2, 21),
(8, 'Basket', 2, 10.4),
(9, 'Voley', 2, 22),
(11, 'Natacion ', 2, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `cod_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(45) NOT NULL,
  `ruc_empresa` varchar(45) NOT NULL,
  `direccion_empresa` varchar(45) DEFAULT NULL,
  `telefono_empresa` varchar(45) DEFAULT NULL,
  `correo_empresa` varchar(45) DEFAULT NULL,
  `password` text NOT NULL,
  `representante_empresa` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`cod_empresa`, `nombre_empresa`, `ruc_empresa`, `direccion_empresa`, `telefono_empresa`, `correo_empresa`, `password`, `representante_empresa`) VALUES
(2, 'Asociación del nuevo amanecer', '1768156470001', 'Cotacachi entre, calle Pedro Moncayo y Salina', '0978563451', 'nuevoamanecer@gmail.com', '$2y$10$eFO81gRintV9RhX1m7oi2ObzpG2z.pIRzZlYtqCAGF0LczHl9mAV.', 'Ing. Carlos Fernandez ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `cod_promocion` int(11) NOT NULL,
  `nombre_promocion` varchar(200) NOT NULL,
  `fechai_promocion` date DEFAULT NULL,
  `fechaf_promocion` date DEFAULT NULL,
  `descuento_promocion` decimal(8,2) NOT NULL,
  `Disciplina_cod_disciplina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`cod_promocion`, `nombre_promocion`, `fechai_promocion`, `fechaf_promocion`, `descuento_promocion`, `Disciplina_cod_disciplina`) VALUES
(5, 'test promo', '2022-02-15', '2022-02-24', '5.00', 7),
(6, 'Black week', '2022-02-23', '2022-02-25', '50.00', 7),
(22, 'Black friday', '2022-02-25', '2022-02-25', '55.00', 5),
(23, 'Promo carnaval', '2022-02-26', '2022-02-26', '33.00', 5),
(24, 'Promo carnavalazo', '2022-02-24', '2022-02-28', '50.00', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `cod_reserva` int(11) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `estado_reserva` char(2) NOT NULL,
  `cliente_cod_cliente` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `fecha_contrato_reserva` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`cod_reserva`, `fecha_reserva`, `estado_reserva`, `cliente_cod_cliente`, `hora_inicio`, `hora_fin`, `fecha_contrato_reserva`) VALUES
(5, '2022-02-25', '1', 4, '09:00:00', '10:00:00', '2022-02-24'),
(6, '2022-02-25', '1', 4, '10:00:00', '11:00:00', '2022-02-24'),
(7, '2022-02-25', '1', 4, '11:00:00', '13:00:00', '2022-02-24'),
(8, '2022-02-26', '1', 4, '07:00:00', '08:00:00', '2022-02-24'),
(9, '2022-02-26', '1', 6, '09:01:00', '10:01:00', '2022-02-24'),
(10, '2022-02-27', '1', 6, '11:06:00', '00:06:00', '2022-02-24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`cod_cancha`),
  ADD KEY `fk_cancha_Disciplina1_idx` (`Disciplina_cod_disciplina`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indices de la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  ADD PRIMARY KEY (`cancha_cod_cancha`,`reserva_cod_reserva`),
  ADD KEY `fk_cancha_has_reserva_reserva1_idx` (`reserva_cod_reserva`),
  ADD KEY `fk_cancha_has_reserva_cancha1_idx` (`cancha_cod_cancha`);

--
-- Indices de la tabla `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`cod_disciplina`),
  ADD KEY `fk_Disciplinas_empresa_idx` (`empresa_cod_empresa`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`cod_empresa`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`cod_promocion`),
  ADD KEY `fk_promocion_Disciplina1_idx` (`Disciplina_cod_disciplina`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`cod_reserva`),
  ADD KEY `fk_reserva_cliente1_idx` (`cliente_cod_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `cod_cancha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `cod_disciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `cod_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `cod_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD CONSTRAINT `fk_cancha_Disciplina1` FOREIGN KEY (`Disciplina_cod_disciplina`) REFERENCES `disciplina` (`cod_disciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_reserva`
--
ALTER TABLE `detalle_reserva`
  ADD CONSTRAINT `fk_cancha_has_reserva_cancha1` FOREIGN KEY (`cancha_cod_cancha`) REFERENCES `cancha` (`cod_cancha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cancha_has_reserva_reserva1` FOREIGN KEY (`reserva_cod_reserva`) REFERENCES `reserva` (`cod_reserva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `fk_Disciplinas_empresa` FOREIGN KEY (`empresa_cod_empresa`) REFERENCES `empresa` (`cod_empresa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `fk_promocion_Disciplina1` FOREIGN KEY (`Disciplina_cod_disciplina`) REFERENCES `disciplina` (`cod_disciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_reserva_cliente1` FOREIGN KEY (`cliente_cod_cliente`) REFERENCES `cliente` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
