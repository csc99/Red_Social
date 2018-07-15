--
-- Base de datos: `red_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `CodAm` int(11) NOT NULL,
  `usua_enviador` int(11) DEFAULT NULL,
  `usua_receptor` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  `solicitud` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`CodAm`, `usua_enviador`, `usua_receptor`, `status`, `solicitud`) VALUES
(1, 3, 4, b'1', b'1'),
(2, 5, 3, b'1', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `CodCom` int(11) NOT NULL,
  `comentario` text,
  `CodPost` int(11) DEFAULT NULL,
  `CodUsua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`CodCom`, `comentario`, `CodPost`, `CodUsua`) VALUES
(1, 'Hola', 1, 3),
(2, 'como estas', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mg`
--

CREATE TABLE `mg` (
  `CodLike` int(11) NOT NULL,
  `CodPost` int(11) DEFAULT NULL,
  `CodUsua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mg`
--

INSERT INTO `mg` (`CodLike`, `CodPost`, `CodUsua`) VALUES
(1, 1, 3),
(2, 1, 5),
(3, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `CodNot` int(11) NOT NULL,
  `accion` bit(1) DEFAULT NULL,
  `visto` bit(1) DEFAULT NULL,
  `CodPost` int(11) DEFAULT NULL,
  `CodUsua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`CodNot`, `accion`, `visto`, `CodPost`, `CodUsua`) VALUES
(2, b'1', b'1', 1, 3),
(3, b'0', b'1', 1, 5),
(4, b'0', b'1', 1, 5),
(5, b'1', b'1', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `CodPost` int(11) NOT NULL,
  `contenido` text,
  `img` varchar(200) DEFAULT NULL,
  `CodUsua` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`CodPost`, `contenido`, `img`, `CodUsua`) VALUES
(1, 'Imagen de prueba', 'subidos/fondo.jpg', 3),
(2, 'Me encanta comer', 'subidos/homer-simpson.jpg', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `CodUsua` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `pass` varchar(200) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `profesion` varchar(50) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`CodUsua`, `nombre`, `usuario`, `pass`, `pais`, `profesion`, `edad`, `foto_perfil`) VALUES
(3, 'Homero simpson', 'homero', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Estados Unidos', 'Abogado', 21, 'subidos/3195385_640px.jpg'),
(4, 'Lisa Simpson', 'lisa', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Estados Unidos', 'Profesor', 25, 'img/sin foto de perfil.jpg'),
(5, 'Bart simpson', 'bart', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 'Estados Unidos', 'Doctor', 29, 'img/sin foto de perfil.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`CodAm`),
  ADD KEY `usua_enviador` (`usua_enviador`),
  ADD KEY `usua_receptor` (`usua_receptor`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`CodCom`),
  ADD KEY `CodUsua` (`CodUsua`),
  ADD KEY `CodPost` (`CodPost`);

--
-- Indices de la tabla `mg`
--
ALTER TABLE `mg`
  ADD PRIMARY KEY (`CodLike`),
  ADD KEY `CodUsua` (`CodUsua`),
  ADD KEY `CodPost` (`CodPost`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`CodNot`),
  ADD KEY `CodUsua` (`CodUsua`),
  ADD KEY `fk_post` (`CodPost`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`CodPost`),
  ADD KEY `CodUsua` (`CodUsua`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`CodUsua`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `CodAm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `CodCom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mg`
--
ALTER TABLE `mg`
  MODIFY `CodLike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `CodNot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `CodPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `CodUsua` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`usua_enviador`) REFERENCES `usuarios` (`CodUsua`),
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`usua_receptor`) REFERENCES `usuarios` (`CodUsua`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`CodUsua`) REFERENCES `usuarios` (`CodUsua`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`CodPost`) REFERENCES `post` (`CodPost`);

--
-- Filtros para la tabla `mg`
--
ALTER TABLE `mg`
  ADD CONSTRAINT `mg_ibfk_1` FOREIGN KEY (`CodUsua`) REFERENCES `usuarios` (`CodUsua`),
  ADD CONSTRAINT `mg_ibfk_2` FOREIGN KEY (`CodPost`) REFERENCES `post` (`CodPost`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_post` FOREIGN KEY (`CodPost`) REFERENCES `post` (`CodPost`),
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`CodUsua`) REFERENCES `usuarios` (`CodUsua`);

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`CodUsua`) REFERENCES `usuarios` (`CodUsua`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
