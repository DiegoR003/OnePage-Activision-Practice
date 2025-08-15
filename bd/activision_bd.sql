-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-11-2024 a las 01:54:31
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `activision_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `id_noticia` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `id_autor_noticia` int NOT NULL,
  `contenido` varchar(300) NOT NULL,
  `imagen_publicacion` varchar(100) NOT NULL,
  `fecha_publicacion` varchar(20) NOT NULL,
  PRIMARY KEY (`id_noticia`),
  KEY `fk_noticias_usuario` (`id_autor_noticia`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id_noticia`, `titulo`, `id_autor_noticia`, `contenido`, `imagen_publicacion`, `fecha_publicacion`) VALUES
(5, 'Campaña de <em>Black Ops 6</em>: la historia hasta ahora, parte 2', 2, 'No confíes en nadie. Realiza tu propio informe con un vistazo más de\r\ncerca a la narrativa de la campaña de <em>Black Ops 6</em> y a las biografías de algunos nuevos personajes de la serie. Además, obtén consejos para empezar la campaña y un avance de las recompensas que obtendrás por completar misi', 'imagenes/noticias6.jpg', '2024-11-24 20:19:29.'),
(7, 'Resultados de los sistemas de moderación de texto y voz del juego; moderación de <em>Black Ops 6</em', 2, 'Resultados de los sistemas de moderación de texto y voz del juego;\r\nmoderación de &lt;em&gt;Black Ops 6&lt;/em&gt; desde el primer día', 'imagenes/noticias5.jpg', '2024-11-24 20:56:41'),
(8, 'Innovaciones de sonido de <em>Black Ops 6</em>', 2, 'Desde avances en la reverberación espacial hasta un nuevo sistema de\r\nprioridad que destaca los sonidos más importantes para la supervivencia de tu operador y mucho más, creemos que <em>Black Ops 6</em> ofrecerá uno de los paisajes sonoros técnicamente más impresionantes hasta la fecha.', 'imagenes/noticias4.jpg', '2024-11-24 20:56:59'),
(9, 'Tráiler, requisitos y más de <em>Black Ops 6</em> para PC', 2, 'Prepárate para el lanzamiento de <em>Black Ops 6</em> en PC el 25 de\r\noctubre con detalles sobre la integración de AMD en el juego, tiempos de precarga, tamaños de archivo y especificaciones mínimas, recomendadas, competitivas/ultra 4K y más.', 'imagenes/activision3.jpg', '2024-11-24 20:57:58'),
(10, '<em>Black Ops 6</em>: modos multijugador, mapas y más', 2, 'Prepárate para el multijugador de <em>Black Ops 6</em> con información no censurada sobre cada modo de lanzamiento, una muestra de los 16 mapas de\r\nlanzamiento y una presentación de todos los operadores de las facciones Rogue Black Ops y Crimson One.', 'imagenes/noticia2.jpg', '2024-11-24 20:58:32'),
(11, 'El camino hacia el lanzamiento de <em>Black Ops 6</em>', 2, 'El camino hacia el lanzamiento de Black Ops 6', 'imagenes/noticias1.jpg', '2024-11-24 22:15:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_autor_producto` int NOT NULL,
  `nombre_producto` varchar(200) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `precio` double NOT NULL,
  `imagen_producto` varchar(100) NOT NULL,
  `estatus_publicacion` varchar(100) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk_productos_usuarios` (`id_autor_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_autor_producto`, `nombre_producto`, `descripcion`, `precio`, `imagen_producto`, `estatus_publicacion`) VALUES
(1, 2, 'CALL OF DUTY MW3: ULTIMATE EDITION', 'La ultima versión más con todo el contenido que ofrece las demas ediciones y acceso libre a pases de batalla.', 5299.99, 'imagenes/noticias1.jpg', '1'),
(2, 2, 'CALL OF DUTY MW3: DELUXE EDITION', 'Adquiere la edición completa con operadores exclusivos y el pase de batalla back cell con 50 niveles de omisión, ademas de los operadores exclusivos de la campaña con acceso anticipado', 3299, 'imagenes/call_of_duty_modern_warfare_logo.png', '1'),
(4, 2, 'CALL OF DUTY MW3: STANDARD EDITION', 'El lanzamiento para mobiles presenta CALL OF DUTY MOBILE, artículos exclusivos y pase de batalla', 1299.99, 'imagenes/imagenes-de-call-of-duty.jpg', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(150) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `estatus_activo` int NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `correo`, `contrasena`, `estatus_activo`) VALUES
(2, 'Diego R.', 'diegomossonava248@gmail.com', '123', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_noticias_usuario` FOREIGN KEY (`id_autor_noticia`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_usuarios` FOREIGN KEY (`id_autor_producto`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
