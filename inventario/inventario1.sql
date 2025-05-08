-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2019 a las 08:44:49
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `fecha`) VALUES
(1, 'Bebidas', '2019-01-28 17:23:42'),
(3, 'Repostería', '2019-01-28 18:12:41'),
(4, 'Lácteos', '2019-01-28 18:38:46'),
(19, 'Frutos secos', '2019-01-28 18:39:12'),
(20, 'Dulces', '2019-01-28 18:39:23'),
(21, 'Congelados', '2019-01-28 18:39:40'),
(22, 'Charcutería', '2019-01-28 18:39:50'),
(23, 'Piensos', '2019-01-28 18:40:18'),
(24, 'Pescadería', '2019-01-28 18:40:44'),
(25, 'Cosmética', '2019-01-28 18:40:53'),
(27, 'Higiene', '2019-01-28 18:41:07'),
(33, 'Alcohol', '2019-01-28 19:04:01'),
(34, 'Electrodomésticos', '2019-02-05 10:09:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `documento`, `email`, `telefono`, `direccion`, `fecha_nacimiento`, `compras`, `fecha`) VALUES
(1, 'Juan Jose López', '44.888.455-Ñ', 'juanjo@gmail.com', '959 382 198', 'Avda. La Arboleda, s/n', '1975-06-12', 0, '2019-01-30 08:58:31'),
(2, 'Han Acompañado', '11.111.111-S', 'jjj@gmail.com', '658 65 98 43', 'dlkjakdjaskl', '2011-11-11', 0, '2019-01-30 09:08:03'),
(4, 'Han Solo', '33.333.333-W', 'hansolo@star.es', '111.111.111', 'C/ Galaxia Profunda, s/n', '2022-02-22', 0, '2018-09-05 18:59:24'),
(5, 'Alfreds Futterkiste', '78.569.215-H', 'alfki@gmail.com', '959.959.959', 'Avda. America, 3', '2000-01-26', 0, '2018-09-05 20:10:26'),
(6, 'ismael', '23.456.789-O', 'ismaelabrio@gmail.com', '111.111.111', 'C/ la encina', '1993-04-28', 0, '2019-01-29 18:38:20'),
(7, 'Antonio', '23.456.777-Ñ', 'hola@hola.com', '693763032', '21440', '2019-01-31', 0, '2019-01-29 16:37:57'),
(8, 'Jose', '23.456.777-Ñ', 'a@sdf.com', '693.763.032', 'C/ El almendro nº9', '1993-04-19', 0, '2019-01-29 19:05:34'),
(9, 'Pepi', '29.616.451-T', 'sdfsdf@sdf.com', '693.763.032', 'C/ Venezuela nº34', '1985-05-04', 0, '2019-01-29 19:04:58'),
(11, 'Javier', '28.566.252-R', 'javierlepe@gmail.com', '722.225.689', 'C/ Dios sabrá', '1996-09-22', 0, '2019-01-29 19:06:28'),
(12, 'María', '28.455.669-S', 'maria@hotmail.com', '655.482.135', 'PLZ/ los acebuches portal-3 2º-IZQ', '1966-11-15', 0, '2019-01-29 19:07:42'),
(14, 'Manuel', '23.566.736-X', 'manuel@ejemplo.com', '645.344.222', 'AVD/ La arboleda nº120', '1978-09-17', 0, '2019-01-29 19:09:56'),
(15, 'Nikone', '23.344.455-F', 'nikone_madrid@gmail.com', '722.678.653', 'C/ El redondo nº 23', '1995-01-24', 0, '2019-01-29 19:10:59'),
(16, 'Dani', '28.456.344-E', 'ejemplo@ejemplo.es', '693.763.032', 'C/ Miravent nº35', '1999-03-29', 0, '2019-01-30 08:48:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `ventas`, `fecha`) VALUES
(3, 19, '444', 'Sirope de regaliz', 'vistas/img/productos/444/444.jpg', 16, 300, 420, 0, '2019-02-05 11:25:40'),
(4, 22, '103', 'Chocolate Nestle', 'vistas/img/productos/103/103.jpg', 12, 21, 28.98, 0, '2019-02-05 13:04:29'),
(7, 20, '2001', 'Chocolate Valor', 'vistas/img/productos/2001/2001.jpg', 22, 1, 2, 0, '2019-02-05 11:42:10'),
(8, 24, '2401', 'Lubina', 'vistas/img/productos/2401/2401.png', 15, 200, 350, 0, '2019-02-05 12:58:34'),
(9, 24, '2402', 'Sardina', 'vistas/img/productos/default/anonymous.png', 8, 13, 17, 0, '2019-02-05 13:01:41'),
(10, 23, '104', 'Sardina para gatos', 'vistas/img/productos/104/104.png', 32, 13, 18.2, 0, '2019-02-05 12:13:32'),
(11, 22, '105', 'Sardina', 'vistas/img/productos/default/anonymous.png', 13, 33.34, 46.676, 0, '2019-02-05 13:02:08'),
(12, 21, '2101', 'atún', 'vistas/img/productos/default/anonymous.png', 3, 23.57, 32.998, 0, '2019-02-05 13:01:32'),
(13, 20, '2002', 'Tarta tres chocolates', 'vistas/img/productos/default/anonymous.png', 7, 22, 44, 0, '2019-02-05 13:02:30'),
(14, 20, '2003', 'Caña de azúcar', 'vistas/img/productos/default/anonymous.png', 33, 22, 55, 0, '2019-02-05 13:02:46'),
(15, 23, '104', 'Sardina para gatos', 'vistas/img/productos/104/104.png', 32, 13, 18.2, 0, '2019-02-05 12:13:32'),
(16, 19, '445', 'kikos', 'vistas/img/productos/445/445.png', 45, 34, 47.6, 0, '2019-02-05 13:02:57'),
(17, 21, '2102', 'Pizza de atún y beacon', 'vistas/img/productos/2102/2102.jpg', 13, 23, 33.58, 0, '2019-02-05 13:03:15'),
(18, 20, '2004', 'Vizcocho de chocolate', 'vistas/img/productos/2004/2004.jpg', 15, 234, 327.6, 0, '2019-02-05 13:03:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `intentos` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`, `intentos`) VALUES
(19, 'admin', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/admin.jpg', 1, '2019-02-07 22:06:00', '2019-02-07 21:06:00', 0),
(20, 'carrasco', 'carrasco', '$2a$07$asxx54ahjppf45sd87a5auA73TZsXmeKTcEtI2IAUDBdAw.FVh6nW', 'Especial', 'vistas/img/usuarios/carrasco/carrasco.jpg', 1, '2019-01-30 10:14:51', '2019-01-31 18:07:54', NULL),
(21, 'Ivan', 'ivan', '$2a$07$asxx54ahjppf45sd87a5aunS8Yrdx8dGRis.rjhNWkQ3irbXiwAz.', 'Vendedor', 'vistas/img/usuarios/ivan/ivan.png', 1, '0000-00-00 00:00:00', '2019-01-29 20:00:05', 0),
(22, 'jose', 'jose88', '$2a$07$asxx54ahjppf45sd87a5auPCBVOq6AORNOPkYmHXY.pDNBGlGoNkW', 'Especial', 'vistas/img/usuarios/jose88/jose88.jpg', 0, '0000-00-00 00:00:00', '2019-01-29 20:00:07', 0),
(23, 'Manuel', 'manueLL', '$2a$07$asxx54ahjppf45sd87a5auzGWsQTfKOMsOYFLg7Hy45ZazhjvCXSa', 'Vendedor', 'vistas/img/usuarios/manueLL/manueLL.jpg', 0, '0000-00-00 00:00:00', '2019-01-29 20:00:08', 0),
(25, 'Manga', 'manga', '$2a$07$asxx54ahjppf45sd87a5au4gG2PucVOGjfyd7IgLvarlZ2vCzy1tu', 'Administrador', 'vistas/img/usuarios/manga/manga.png', 1, '0000-00-00 00:00:00', '2019-01-29 20:00:10', 0),
(26, 'David', 'david96', '$2a$07$asxx54ahjppf45sd87a5auY00k1u8xuSPBVWyPyNbI1/Yjo0Ydzra', 'Vendedor', 'vistas/img/usuarios/david96/david96.jpg', 0, '0000-00-00 00:00:00', '2019-01-29 20:00:12', 0),
(27, 'Antonio', 'antonio', '$2a$07$asxx54ahjppf45sd87a5aux3fiG.CAm7hUVI0Yj9MXmviPVpRzC6.', 'Administrador', 'vistas/img/usuarios/antonio/antonio.png', 1, '0000-00-00 00:00:00', '2019-02-05 13:01:14', 0),
(28, 'Enrique', 'kike', '$2a$07$asxx54ahjppf45sd87a5au6pCcPkrLsXf/sqNc0KOM9QceBk/BW4q', 'Especial', '', 1, '0000-00-00 00:00:00', '2019-01-29 20:00:25', 0),
(31, 'maria', 'maria', '$2a$07$asxx54ahjppf45sd87a5au/styESZTpqxpFPzgJF99YaIo877LNdy', 'Administrador', 'vistas/img/usuarios/maria/maria.jpg', 1, '0000-00-00 00:00:00', '2019-01-29 20:00:27', 0),
(32, 'Alfonso', 'alfonso', '$2a$07$asxx54ahjppf45sd87a5aunY8RMQUwoW5XMV2xnZx9kYVKVZx7rxi', 'Vendedor', 'vistas/img/usuarios/alfonso/alfonso.jpg', 1, '0000-00-00 00:00:00', '2019-01-29 20:00:33', 0),
(33, 'Iñaki', 'inaki', '$2a$07$asxx54ahjppf45sd87a5auwwe9niHEB12D9gff1oz5TbQfDI/8tV6', 'Especial', 'vistas/img/usuarios/inaki/inaki.png', 0, '0000-00-00 00:00:00', '2019-01-29 20:00:47', 0),
(34, 'Juan', 'juan', '$2a$07$asxx54ahjppf45sd87a5auwRi.z6UsW7kVIpm0CUEuCpmsvT2sG6O', 'Vendedor', '', 1, '0000-00-00 00:00:00', '2019-01-29 20:00:54', 0),
(35, 'Alfredo', 'alfredo', '$2a$07$asxx54ahjppf45sd87a5auev2W8SbVfjcGUOb0yg1v4g9M9dgCd8C', 'Especial', 'vistas/img/usuarios/alfredo/alfredo.jpg', 0, '0000-00-00 00:00:00', '2019-01-29 20:01:01', 0),
(36, 'retert', 'eteterte', '$2a$07$asxx54ahjppf45sd87a5aulU9r2cPykOPe1ujKOriacVQCfK3P7a6', 'Especial', 'vistas/img/usuarios/eteterte/eteterte.jpg', 0, '0000-00-00 00:00:00', '2019-02-04 10:03:25', 0),
(37, 'Ruth', 'sdfsdf', '$2a$07$asxx54ahjppf45sd87a5auet.s.qhFGkQk2IjkotDeyHOXfGW7yGu', 'Especial', 'vistas/img/usuarios/sdfsdf/sdfsdf.png', 1, '0000-00-00 00:00:00', '2019-02-04 10:05:09', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
