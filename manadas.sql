-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2025 a las 22:42:33
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
-- Base de datos: `manadas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

CREATE TABLE `mascota` (
  `id_mascota` int(11) NOT NULL,
  `id_dueno` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `raza` varchar(100) NOT NULL,
  `tamano` varchar(100) NOT NULL,
  `observaciones` enum('chico','mediano','grande') NOT NULL,
  `creada_en` date NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`id_mascota`, `id_dueno`, `nombre`, `raza`, `tamano`, `observaciones`, `creada_en`, `img`) VALUES
(1, 1, 'Firulais', 'Labrador Retriever', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog01.jpg'),
(2, 1, 'Luna', 'Caniche', 'chico', '', '2025-10-15', 'https://example.com/dogs/dog02.jpg'),
(3, 1, 'Rocky', 'Bulldog Francés', 'mediano', '', '2025-10-15', 'https://example.com/dogs/dog03.jpg'),
(4, 4, 'Nina', 'Beagle', 'mediano', '', '2025-10-15', 'https://example.com/dogs/dog04.jpg'),
(5, 5, 'Toby', 'Golden Retriever', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog05.jpg'),
(6, 6, 'Milo', 'Mestizo', 'mediano', '', '2025-10-15', 'https://example.com/dogs/dog06.jpg'),
(7, 7, 'Kira', 'Border Collie', 'mediano', '', '2025-10-15', 'https://example.com/dogs/dog07.jpg'),
(8, 8, 'Olivia', 'Dachshund', 'chico', '', '2025-10-15', 'https://example.com/dogs/dog08.jpg'),
(9, 9, 'Simón', 'Boxer', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog09.jpg'),
(10, 10, 'Greta', 'Schnauzer Mini', 'chico', '', '2025-10-15', 'https://example.com/dogs/dog10.jpg'),
(11, 11, 'Bruno', 'Rottweiler', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog11.jpg'),
(12, 12, 'Mora', 'Shih Tzu', 'chico', '', '2025-10-15', 'https://example.com/dogs/dog12.jpg'),
(13, 13, 'Coco', 'Pug', 'chico', '', '2025-10-15', 'https://example.com/dogs/dog13.jpg'),
(14, 14, 'Zoe', 'Pastor Alemán', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog14.jpg'),
(15, 15, 'Rita', 'Galgo', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog15.jpg'),
(16, 16, 'Choco', 'Cocker Spaniel', 'mediano', '', '2025-10-15', 'https://example.com/dogs/dog16.jpg'),
(17, 17, 'Lola', 'Bichón Frisé', 'chico', '', '2025-10-15', 'https://example.com/dogs/dog17.jpg'),
(18, 18, 'Max', 'Husky Siberiano', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog18.jpg'),
(19, 19, 'Nico', 'Akita Inu', 'grande', '', '2025-10-15', 'https://example.com/dogs/dog19.jpg'),
(20, 20, 'Pampa', 'Mestizo', 'mediano', '', '2025-10-15', 'https://example.com/dogs/dog20.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_paseo` int(11) DEFAULT NULL,
  `monto` int(11) NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `creado_en` date NOT NULL,
  `id_dueno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseador`
--

CREATE TABLE `paseador` (
  `id_paseador` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `zona` varchar(100) NOT NULL,
  `disponibilidad` enum('manana','tarde','noche') NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL,
  `bio` text NOT NULL,
  `rating` decimal(10,0) NOT NULL,
  `fecha_alta` date NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paseador`
--

INSERT INTO `paseador` (`id_paseador`, `nombre`, `apellido`, `email`, `password`, `telefono`, `zona`, `disponibilidad`, `estado`, `bio`, `rating`, `fecha_alta`, `img`) VALUES
(1, 'Carlos', 'Medina', 'carlos.medina@manadas.com', '1234', '1165432109', 'Palermo', 'manana', 'activo', 'Paseador con 3 años de experiencia en grupos pequeños y manejo de razas grandes.', 5, '2025-10-15', 'https://example.com/paseadores/carlos.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseo`
--

CREATE TABLE `paseo` (
  `id_paseo` int(11) NOT NULL,
  `id_paseador` int(11) DEFAULT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `zona` varchar(100) NOT NULL,
  `punto_encuentro` varchar(100) NOT NULL,
  `estado_paseo` enum('no_iniciado','en_curso','finalizado') NOT NULL,
  `precio` int(11) NOT NULL,
  `creado_en` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(42) NOT NULL,
  `fecha_registro` date NOT NULL,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `password`, `telefono`, `direccion`, `fecha_registro`, `img`) VALUES
(1, 'Augusto', 'Barbieri', 'barbieriaugusto@gmail.com', '123564', '1540263200', 'Av. OLazabal', '2015-05-25', 'img.jpg'),
(2, 'Juan', 'Kavulakian', 'jpkavulakian@gmail.com', '1234', '1234567890', 'Calle Falsa 123', '2025-10-15', 'https://example.com/image.jpg'),
(3, 'María', 'Pérez', 'maria.perez@gmail.com', '1234', '1134567890', 'Av. Libertador 456', '2025-10-15', 'https://example.com/img2.jpg'),
(4, 'Lucía', 'Fernández', 'lucia.fernandez@gmail.com', '1234', '1145678901', 'San Martín 789', '2025-10-15', 'https://example.com/img3.jpg'),
(5, 'Agustín', 'Gómez', 'agustin.gomez@gmail.com', '1234', '1156789012', 'Rivadavia 1010', '2025-10-15', 'https://example.com/img4.jpg'),
(6, 'Valentina', 'Torres', 'valen.torres@gmail.com', '1234', '1167890123', 'Belgrano 202', '2025-10-15', 'https://example.com/img5.jpg'),
(7, 'Tomás', 'Rodríguez', 'tomas.rodriguez@gmail.com', '1234', '1178901234', 'Sarmiento 345', '2025-10-15', 'https://example.com/img6.jpg'),
(8, 'Sofía', 'López', 'sofia.lopez@gmail.com', '1234', '1189012345', 'Mitre 678', '2025-10-15', 'https://example.com/img7.jpg'),
(9, 'Martina', 'Silva', 'martina.silva@gmail.com', '1234', '1190123456', 'Alsina 789', '2025-10-15', 'https://example.com/img8.jpg'),
(10, 'Felipe', 'Díaz', 'felipe.diaz@gmail.com', '1234', '1201234567', 'Lavalle 321', '2025-10-15', 'https://example.com/img9.jpg'),
(11, 'Camila', 'Moreno', 'camila.moreno@gmail.com', '1234', '1212345678', 'Florida 654', '2025-10-15', 'https://example.com/img10.jpg'),
(12, 'Joaquín', 'Sánchez', 'joaquin.sanchez@gmail.com', '1234', '1223456789', 'Corrientes 987', '2025-10-15', 'https://example.com/img11.jpg'),
(13, 'Emilia', 'Rossi', 'emilia.rossi@gmail.com', '1234', '1234567890', 'Castro Barros 432', '2025-10-15', 'https://example.com/img12.jpg'),
(14, 'Mateo', 'Rivas', 'mateo.rivas@gmail.com', '1234', '1245678901', 'Olleros 214', '2025-10-15', 'https://example.com/img13.jpg'),
(15, 'Carolina', 'Martínez', 'carolina.martinez@gmail.com', '1234', '1256789012', 'Córdoba 101', '2025-10-15', 'https://example.com/img14.jpg'),
(16, 'Nicolás', 'Bianchi', 'nicolas.bianchi@gmail.com', '1234', '1267890123', 'Scalabrini Ortiz 555', '2025-10-15', 'https://example.com/img15.jpg'),
(17, 'Julieta', 'Domínguez', 'julieta.dominguez@gmail.com', '1234', '1278901234', 'Pueyrredón 777', '2025-10-15', 'https://example.com/img16.jpg'),
(18, 'Benjamín', 'Cruz', 'benjamin.cruz@gmail.com', '1234', '1289012345', 'Dorrego 232', '2025-10-15', 'https://example.com/img17.jpg'),
(19, 'Valeria', 'Gutiérrez', 'valeria.gutierrez@gmail.com', '1234', '1290123456', 'Gorriti 909', '2025-10-15', 'https://example.com/img18.jpg'),
(20, 'Ignacio', 'Ruiz', 'ignacio.ruiz@gmail.com', '1234', '1301234567', 'Mendoza 1234', '2025-10-15', 'https://example.com/img19.jpg'),
(21, 'Florencia', 'Acosta', 'florencia.acosta@gmail.com', '1234', '1312345678', 'Urquiza 678', '2025-10-15', 'https://example.com/img20.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`id_mascota`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `paseador`
--
ALTER TABLE `paseador`
  ADD PRIMARY KEY (`id_paseador`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `paseo`
--
ALTER TABLE `paseo`
  ADD PRIMARY KEY (`id_paseo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paseador`
--
ALTER TABLE `paseador`
  MODIFY `id_paseador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `paseo`
--
ALTER TABLE `paseo`
  MODIFY `id_paseo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
