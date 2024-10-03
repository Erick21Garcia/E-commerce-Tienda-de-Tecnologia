-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2024 a las 21:33:08
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombreC` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `email`, `contraseña`, `nombreC`) VALUES
(27, 'erick@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Erick'),
(29, 'mateo@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Mateo'),
(30, 'adrian@hotmail.com', '8f7096d1807a86c1ad832c8626a2aa13', 'Adrian'),
(31, 'jon@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Jonsito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleventas`
--

CREATE TABLE `detalleventas` (
  `id` int(11) NOT NULL,
  `idProducto` int(5) NOT NULL,
  `idVenta` int(5) NOT NULL,
  `cantidad` int(5) NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` double NOT NULL,
  `existencia` int(5) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `existencia`, `imagen`, `categoria`, `descripcion`) VALUES
(4, 'Tablet Samsung ', 90, 23, 'Tablet.jpg', 'Tablets', 'Pantalla brillante, potente rendimiento, versatilidad digital, conectividad fluida, experiencia mult'),
(7, 'Tablet Apple ', 200, 20, 'TabletApple.jpg', 'Tablets', 'Elegancia minimalista, ecosistema integrado, alto rendimiento, creatividad y productividad portátil,'),
(10, 'Tablet Xiaomi', 150, 15, 'Tablet.jpg', 'Tablets', 'Valor excepcional, innovación asequible, rendimiento sólido, interfaz personalizada, amplia duración'),
(11, 'Celular Apple', 300, 4, 'iphone2.jpg', 'Celulares', 'Diseño icónico, potencia sobresaliente, cámara avanzada, integración perfecta, seguridad robusta, ec'),
(12, 'Celular Samsung', 200, 20, 'CS (1).jpg', 'Celulares', 'Diversidad de opciones, pantallas impresionantes, innovación tecnológica, versatilidad fotográfica, '),
(13, 'Celular Xiaomi', 150, 33, 'Xiaomi c (1).jpg', 'Celulares', 'Innovación asequible, diseño moderno, características avanzadas, alta relación calidad-precio, comun'),
(14, 'Laptop Apple', 300, 50, 'laptop apple.jpg', 'Laptops', 'Elegancia minimalista, rendimiento potente, pantalla retina vibrante, ecosistema integrado, durabili'),
(15, 'Laptop Samsung', 300, 17, 'Samsung Ltp (1).jpg', 'Laptops', 'Variedad de opciones, diseño moderno, tecnología innovadora, rendimiento confiable, opciones persona'),
(16, 'Laptops Xiaomi', 200, 17, 'LaptopX (1).jpg', 'Laptops', 'Equilibrio calidad-precio, diseño elegante, especificaciones sólidas, innovación tecnológica, experi'),
(18, 'Tablet Multiuso X20', 200, 20, 'TabletApple.jpg', 'Tablets', 'Tablet Multiuso fácil de usar.'),
(20, 'Tablet XY', 155, 20, 'TabletApple.jpg', 'Tablets', 'Tablet super eficiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroventas`
--

CREATE TABLE `registroventas` (
  `id` int(11) NOT NULL,
  `ClienteNombre` varchar(50) NOT NULL,
  `FechaCompra` varchar(20) NOT NULL,
  `IngresoTotal` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registroventas`
--

INSERT INTO `registroventas` (`id`, `ClienteNombre`, `FechaCompra`, `IngresoTotal`) VALUES
(1, 'Erick', '2023-08-13 20:22:59', '200'),
(2, 'Erick', '2023-08-13 20:24:28', '1000'),
(3, 'Paula', '2023-08-14 01:54:28', '500'),
(4, 'Paula', '2023-08-14 02:02:31', '600'),
(5, 'Paulaas', '2023-08-14 07:36:46', '450'),
(6, 'Paulaas', '2023-08-14 07:37:04', '140'),
(7, 'Fernando', '2023-08-14 17:46:32', '1070'),
(8, 'Andres', '2023-08-14 20:50:37', '300'),
(9, 'Andres', '2023-08-14 20:52:34', '900'),
(10, 'Mateo', '2023-12-03 04:30:37', '180'),
(11, 'Erick', '2023-12-03 04:37:01', '2090'),
(12, 'Adrian', '2024-05-06 04:05:02', '690'),
(13, 'Erick', '2024-10-02 20:58:13', '600');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `nombreU` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `contraseña`, `nombreU`) VALUES
(12, 'erick@email.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Erick'),
(14, 'mary@hotmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Maria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `idCliente` int(5) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registroventas`
--
ALTER TABLE `registroventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCliente` (`idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `registroventas`
--
ALTER TABLE `registroventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleventas`
--
ALTER TABLE `detalleventas`
  ADD CONSTRAINT `detalleventas_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalleventas_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
