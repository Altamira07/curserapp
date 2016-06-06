-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-06-2016 a las 16:47:27
-- Versión del servidor: 5.5.47-0+deb8u1-log
-- Versión de PHP: 5.6.20-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `curserapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
`id_articulo` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `contenido` text NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `titulo`, `contenido`, `correo`, `descripcion`, `imagen`) VALUES
(1, 'Trer', 'qweqweqweqweqeqweqe', 'altamira-07@hotmail.com', 'qweqw', 'hexagono.PNG'),
(2, 'sdfsdf', 'sdfsdf', 'luisaltamira07@gmail.com', 'dsfsdf', 'evaluacion.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
`id_comentario` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `contenido` varchar(124) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
`id_curso` int(11) NOT NULL,
  `cveAcceso` varchar(10) NOT NULL,
  `curso` varchar(50) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id_curso`, `cveAcceso`, `curso`, `correo`, `descripcion`, `imagen`) VALUES
(1, 'bed4ab9', 'Prueba', 'altamira-07@hotmail.com', 'Esta es una prueba ', 'hexagono.PNG'),
(2, 'f01d69a', '123', 'altamira-07@hotmail.com', '21312312312', 'XD.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `nick` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apaterno` varchar(50) DEFAULT NULL,
  `amaterno` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `acercaDe` text,
  `correo` varchar(50) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `vinculado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`nick`, `nombre`, `apaterno`, `amaterno`, `edad`, `acercaDe`, `correo`, `id_tipo`, `vinculado`) VALUES
('altamira-07@hotmail.com', 'luis', 'Hernandez', 'Altamira', 25, NULL, 'altamira-07@hotmail.com', NULL, 1),
('luisaltamira07@gmail.com', '213', '123', '123', 12, NULL, 'luisaltamira07@gmail.com', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posee`
--

CREATE TABLE IF NOT EXISTS `posee` (
  `id_articulo` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `id_comentario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE IF NOT EXISTS `privilegio` (
`id_privilegio` int(11) NOT NULL,
  `privilegio` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`id_privilegio`, `privilegio`) VALUES
(1, 'agregar_comentario'),
(2, 'agregar_articulo'),
(3, 'agregar_curso'),
(4, 'eliminar_curso'),
(5, 'eliminar_articulo'),
(6, 'eliminar_comentario'),
(7, 'editar_curso'),
(8, 'editar_comentaro'),
(9, 'editar_articulo'),
(10, 'ediar_perfil'),
(11, 'agregar_privilegio'),
(12, 'agregar_rol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
`id_rol` int(11) NOT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'admin'),
(2, 'profesor'),
(3, 'alumno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_privilegio`
--

CREATE TABLE IF NOT EXISTS `rol_privilegio` (
  `id_rol` int(11) DEFAULT NULL,
  `id_privilegio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol_privilegio`
--

INSERT INTO `rol_privilegio` (`id_rol`, `id_privilegio`) VALUES
(1, 12),
(1, 11),
(1, 1),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(3, 1),
(3, 2),
(3, 5),
(3, 6),
(3, 8),
(3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE IF NOT EXISTS `tema` (
`id_tema` int(11) NOT NULL,
  `tema` varchar(50) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `video` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id_tema`, `tema`, `id_curso`, `descripcion`, `video`) VALUES
(1, 'Tema ', 1, 'PequeÃ±o tema', 'https://www.youtube.com/watch?v=xQfqhGPwacU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
`id_tipo` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tomando`
--

CREATE TABLE IF NOT EXISTS `tomando` (
  `id_curso` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tomando`
--

INSERT INTO `tomando` (`id_curso`, `correo`) VALUES
(1, 'luisaltamira07@gmail.com'),
(2, 'luisaltamira07@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `correo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `clave` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`correo`, `password`, `id_rol`, `clave`) VALUES
('altamira-07@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, ''),
('luisaltamira07@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_rolPrivilegio`
--
CREATE TABLE IF NOT EXISTS `vista_rolPrivilegio` (
`privilegio` varchar(50)
,`rol` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_rolUsuario`
--
CREATE TABLE IF NOT EXISTS `vista_rolUsuario` (
`rol` varchar(50)
,`correo` varchar(50)
);
-- --------------------------------------------------------

--
-- Estructura para la vista `vista_rolPrivilegio`
--
DROP TABLE IF EXISTS `vista_rolPrivilegio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_rolPrivilegio` AS select `p`.`privilegio` AS `privilegio`,`r`.`rol` AS `rol` from ((`privilegio` `p` join `rol_privilegio` `rp` on((`rp`.`id_privilegio` = `p`.`id_privilegio`))) join `rol` `r` on((`r`.`id_rol` = `rp`.`id_rol`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_rolUsuario`
--
DROP TABLE IF EXISTS `vista_rolUsuario`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_rolUsuario` AS (select `r`.`rol` AS `rol`,`u`.`correo` AS `correo` from (`rol` `r` join `usuario` `u` on((`u`.`id_rol` = `r`.`id_rol`))));

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
 ADD PRIMARY KEY (`id_articulo`), ADD KEY `articuloFK` (`correo`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
 ADD PRIMARY KEY (`id_comentario`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
 ADD PRIMARY KEY (`id_curso`), ADD KEY `cursoFK` (`correo`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
 ADD PRIMARY KEY (`nick`), ADD KEY `perfilFK1` (`correo`), ADD KEY `perfilFK2` (`id_tipo`);

--
-- Indices de la tabla `posee`
--
ALTER TABLE `posee`
 ADD KEY `poseeFK1` (`id_articulo`), ADD KEY `poseeFK2` (`correo`), ADD KEY `poseeFK3` (`id_comentario`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
 ADD PRIMARY KEY (`id_privilegio`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_privilegio`
--
ALTER TABLE `rol_privilegio`
 ADD KEY `rolprivilegioFK1` (`id_rol`), ADD KEY `rolprivilegioFK2` (`id_privilegio`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
 ADD PRIMARY KEY (`id_tema`), ADD KEY `temaFK` (`id_curso`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
 ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tomando`
--
ALTER TABLE `tomando`
 ADD KEY `tomandoFK1` (`id_curso`), ADD KEY `tomandoFK2` (`correo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`correo`), ADD UNIQUE KEY `correo` (`correo`), ADD KEY `usuarioFK` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
MODIFY `id_privilegio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
ADD CONSTRAINT `articuloFK` FOREIGN KEY (`correo`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
ADD CONSTRAINT `cursoFK` FOREIGN KEY (`correo`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
ADD CONSTRAINT `perfilFK1` FOREIGN KEY (`correo`) REFERENCES `usuario` (`correo`),
ADD CONSTRAINT `perfilFK2` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id_tipo`);

--
-- Filtros para la tabla `posee`
--
ALTER TABLE `posee`
ADD CONSTRAINT `poseeFK1` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id_articulo`),
ADD CONSTRAINT `poseeFK2` FOREIGN KEY (`correo`) REFERENCES `usuario` (`correo`),
ADD CONSTRAINT `poseeFK3` FOREIGN KEY (`id_comentario`) REFERENCES `comentario` (`id_comentario`);

--
-- Filtros para la tabla `rol_privilegio`
--
ALTER TABLE `rol_privilegio`
ADD CONSTRAINT `rolprivilegioFK1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
ADD CONSTRAINT `rolprivilegioFK2` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegio` (`id_privilegio`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
ADD CONSTRAINT `temaFK` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`);

--
-- Filtros para la tabla `tomando`
--
ALTER TABLE `tomando`
ADD CONSTRAINT `tomandoFK1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`),
ADD CONSTRAINT `tomandoFK2` FOREIGN KEY (`correo`) REFERENCES `usuario` (`correo`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usuarioFK` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
