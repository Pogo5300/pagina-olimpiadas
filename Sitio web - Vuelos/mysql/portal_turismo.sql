-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2025 a las 17:32:52
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
-- Base de datos: `portal_turismo`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insertar_usuario` (IN `p_nombre` VARCHAR(25), IN `p_apellido` VARCHAR(25), IN `p_email` VARCHAR(100), IN `p_contrasena` TEXT)   BEGIN
    -- Validar si el email ya existe
    IF EXISTS (SELECT 1 FROM Usuarios WHERE email = p_email) THEN
        SELECT 'USUARIO_YA_EXISTE' AS Resultado;
    ELSE
        -- Insertar el nuevo usuario
        INSERT INTO Usuarios (nombre, apellido, email, contraseña)
        VALUES (p_nombre, p_apellido, p_email, p_contrasena);
        
        SELECT 'REGISTRO_EXITOSO' AS Resultado;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LoginAdmin` (IN `pUsuario` VARCHAR(100), IN `pContrasena` VARCHAR(100))   BEGIN
    IF EXISTS (
        SELECT 1 FROM Administradores 
        WHERE Usuario = pUsuario AND Contrasena = pContrasena AND Activo = 1
    ) THEN
        SELECT 'LOGIN_ADMIN_CORRECTO' AS Resultado;
    ELSE
        SELECT 'LOGIN_ADMIN_INCORRECTO' AS Resultado;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LoginUsuario` (IN `pCorreo` VARCHAR(100), IN `pContrasena` VARCHAR(100))   BEGIN
    IF EXISTS (
        SELECT 1 FROM Usuarios WHERE Correo = pCorreo AND Contrasena = pContrasena
    ) THEN
        SELECT 'LOGIN_CORRECTO' AS Resultado;
    ELSE
        SELECT 'LOGIN_INCORRECTO' AS Resultado;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login_usuario` (IN `p_email` VARCHAR(100))   BEGIN
    DECLARE v_count INT;

    -- Verificar si el correo existe
    SELECT COUNT(*) INTO v_count FROM Usuarios WHERE email = p_email;

    IF v_count = 0 THEN
        SELECT 'CUENTA_NO_EXISTE' AS Resultado;
    ELSE
        -- Devolver el hash de la contraseña para verificarlo en PHP
        SELECT id_usuario, nombre, apellido, email, contraseña FROM Usuarios WHERE email = p_email;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_RegistrarCompra` (IN `pIdUsuario` INT, IN `pIdPaquete` INT, IN `pIdVuelo` INT, IN `pIdAlojamiento` INT, IN `pIdAuto` INT)   BEGIN
    IF NOT EXISTS (SELECT 1 FROM Usuarios WHERE Id = pIdUsuario) THEN
        SELECT 'ERROR: Usuario no encontrado' AS Resultado;
    ELSE
        INSERT INTO Compras (IdUsuario, IdPaquete, IdVuelo, IdAlojamiento, IdAuto)
        VALUES (pIdUsuario, pIdPaquete, pIdVuelo, pIdAlojamiento, pIdAuto);
        SELECT 'COMPRA_REGISTRADA' AS Resultado;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `email`, `contraseña`, `activo`) VALUES
(1, 'admin', 'admin@email.com', '$2y$10$2964iGbinNJX/xjosScpaOxCAIecluYB4ITNWGT84yETCpd5qBIWy', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `codigo_verificacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `features` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria`, `features`) VALUES
(18, 'Madrid - París', 'Vuelo directo con Iberia, vuelo directo, duracion 2h, horario tarde', 299.00, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?q=80&w=873&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'vuelos', 'Directo, Equipaje incluido, Asiento estándar'),
(19, 'Europa Clásica - 10 días', 'París, Roma, Barcelona con vuelos y hoteles', 1899.00, 'https://images.unsplash.com/photo-1635255440966-335b08f2b49f?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'paquete', 'Vuelos incluidos, hoteles 4 estrellas, Desayunos, Guia turistica, Familiar'),
(20, 'Caribe Mexicano - 7 días', 'Cancún y Playa del Carmen todo incluido', 1299.00, 'https://images.unsplash.com/photo-1700188223446-883d92810f38?q=80&w=1032&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'paquete', 'Todo incluido, Resort 5 estrellas, Excursiones, Translados, Romantico'),
(21, 'Japón Tradicional - 12 días', 'Tokio, Kioto, Osaka con experiencias culturales', 1299.00, 'https://images.unsplash.com/photo-1736153960697-51f785ffe3d0?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'paquete', 'Hoteles tradicionales, JR Pass, Ceremonias del té, Guia local, Cultural'),
(22, 'Hotel Barceló Maya Palace', 'Resort todo incluido en Riviera Maya', 299.00, 'https://www.kayak.com.ar/rimg/himg/da/f0/83/ice-6988-66542198_3XL-103586.jpg?width=1366&height=768&crop=true', 'alojamiento', 'Todo incluido, Piscina, Spa, Playa privada'),
(23, 'Hotel Ritz Madrid', 'Hotel de lujo en el centro de Madrid', 450.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5YYaFSGP0YZ_njGcqKQLwZxCEjDIjmsgdDA&s', 'alojamiento', '5 estrellas, Desayuno incluido, Gimnasio, Concierge'),
(24, 'Hostal Central Barcelona', 'Alojamiento económico cerca de Las Ramblas', 89.00, 'https://www.hostallevante.com/en/assets/images/edificio-hotel-hostal-levante.jpg', 'alojamiento', 'WiFi grati, Cocina compartida, Ubicación central'),
(25, 'Resort Maldivas Paradise', 'Villa sobre el agua en Maldivas', 850.00, 'https://images.trvl-media.com/lodging/2000000/1940000/1932500/1932406/d76bb275.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill', 'alojamiento', 'Villa privada, Todo incluido, Snowkei, Spa'),
(27, 'Barcelona - Roma', 'Vuelo con Vueling, 1 escala en Milán, duracion 2h, horario noche', 189.00, 'https://concepto.de/wp-content/uploads/2024/02/imperio-romano.jpg', 'vuelos', '1 escala, equipaje de mano, snack indluido'),
(28, 'México - Cancún', 'Vuelo nacional con Aeroméxico, duracion 2h, horario mañana', 189.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQMAVW5I1uCOHKXka4ROM5EMaE64SMgLmPxww&s', 'vuelos', 'Directo, Equipaje incluido, Entretenimiento'),
(29, 'Oferta Flash- Miami', 'Vuelos + 5 noches en South Beach', 899.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVaZIHH3At2CFFJNtv4FPbyZvoblwDe_Gpqw&s', 'oferta', 'Vuelo Directo, Hoteles 4 estrellas, Desayuno, Valido 48h, Mediterraneo'),
(30, 'Escapada a Londres', '3 dias en en el corazon de Londres', 599.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0WVGaRka0eysgmQMnbHOZTKSqSWkc9llLaA&s', 'oferta', 'Hotel centrico, Desayuno ingles, Tour Gratuito, Lluvioso'),
(33, 'Londres - Tokio', 'Vuelo de larga distancia con British Airways, duracion 14h, horario noche', 899.00, 'https://images.unsplash.com/photo-1551641506-ee5bf4cb45f1?q=80&w=884&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'vuelos', 'Directo, Asiento premium, Comidas gourmet, Kit de viaje'),
(35, 'Miami - São Paulo', 'Vuelo internacional con LATAM Airlines, duracion 8h, horario mañana', 650.00, 'https://images.unsplash.com/photo-1523214496-759e60a282d6?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'vuelos', 'Directo, Equipaje incluido, Entretenimiento, Snacks'),
(36, 'Nueva York - Los Ángeles', 'Vuelo transcontinental con American Airlines, duracion 6h, horario tarde', 450.00, 'https://images.unsplash.com/photo-1597982087634-9884f03198ce?q=80&w=888&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'vuelos', 'Directo, WiFi gratis, Entretenimiento, Comida incluida'),
(37, 'Lodge Safari Kenia', 'Experiencia única en la sabana africana', 680.00, 'https://images.unsplash.com/photo-1675775472532-72ce9db0aa93?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8TG9kZ2UlMjBTYWZhcmklMjBLZW5pYXxlbnwwfHwwfHx8MA%3D%3D', 'alojamiento', 'Safari incluido, Todo incluido, Guia local, Fotografia'),
(38, 'Hotel Boutique París', 'Hotel elegante en el distrito 7', 320.00, 'https://plus.unsplash.com/premium_photo-1661963123153-5471a95b7042?q=80&w=774&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'alojamiento', 'Boutique, Vista Torre Eiffel, Desayuno frances, Concierge'),
(39, 'Aventura en Costa Rica- 8 dias', 'Selva,Volcanes y Playas paradisiacas', 1599.00, 'https://images.unsplash.com/photo-1536708880921-03a9306ec47d?q=80&w=775&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'paquete', 'Ecoturismo, Conopy, Rafting, Avistamiento de fauna, Romantico'),
(40, 'Egipto Milenario- 9 dias', 'El cairo, Luxor y crucero por el Nilo', 1799.00, 'https://images.unsplash.com/photo-1539768942893-daf53e448371?q=80&w=871&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'paquete', 'Vuelos incluidos, Crucero 5+, Guia egiptologo, Entradas'),
(41, 'Nueva York Completo- 6 dias', 'La Gran Manzana con tours y espectaculos', 1499.00, 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'paquete', 'Hotel centrico, City Pass, Musical Broadway, Tour contraste, Familiar'),
(42, 'Semana Santa en Grecia', 'Atenas y Santorini - 8 dias', 1599.00, 'https://images.unsplash.com/photo-1580502304784-8985b7eb7260?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'oferta', 'islas griegas, Ferry incluido, Hoteles con vista, Media pension, Mediterraneo'),
(43, 'Safari en Tanzania', '7 días en Serengeti y Ngorongoro', 2299.00, 'https://images.unsplash.com/photo-1516026672322-bc52d61a55d5?q=80&w=772&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'oferta', 'Safari 4x4, Lodge premium, Guia experto, Todas las comidas, Arido'),
(45, 'Crucero por el Mediterráneo', '10 días visitando 8 puertos\r\n\r\n', 1899.00, 'https://images.unsplash.com/photo-1554254648-2d58a1bc3fd5?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D', 'oferta', 'Todo incluido, Camarote con balcón, Excursiones, Entretenimiento, Mediterraneo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  `apellido` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contraseña` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `contraseña`, `fecha_registro`) VALUES
(1, 'Juan', 'Perez', 'juan@gmail.com', '$2y$10$W.lwLPuhO1fXeSCR.enEiuE9mCKr7j9SmFSZh50TWq4nWssIvu2o.', '2025-06-22 18:08:33'),
(2, 'Matias', 'Martinez', 'matiasgamer58@gmail.com', '$2y$10$6QE/bsrIwe1ZzkqQGz4mdO2kRRWf75XFzU5uNZgnZKhFEENoigjSO', '2025-06-23 01:53:08'),
(3, 'Luis', 'Mendoza', 'Luis@gmail.com', '$2y$10$Mn1CawudEGxsITYzARE2uOxSZMqcGVp1XTYlaMh81BvLJxc2kFKia', '2025-06-23 02:04:41'),
(4, 'Salsa', 'Mora', 'Solsa@gmail.com', '$2y$10$av3fFZ4ugzstD4CsK8hPeeDMIsuJ6SOVVHKIdM.Dp8b8DgYte0tc.', '2025-06-23 03:23:24'),
(5, 'Esteban', 'Ari', 'esteban@gmail.com', '$2y$10$7iPEBTNEIcnipRFTAMKHVuk4SPTOogMFUt40noSH0OugvJ9t6n1dS', '2025-06-25 02:04:19'),
(6, 'Matias', 'Martinez', 'usuario@gmail.com', '$2y$10$FhwxeLtzo7PaawhxTiYn/ugTCAvE/l.5RfWrTBnYqUXxjYV0fUBai', '2025-06-25 02:06:22'),
(7, 'Usuario', 'prueba', 'usuario1@gmail.com', '$2y$10$0uJHa5FRAJoa59VMbmysp.Rl7DfimJRmcLnVyXPQIbeFF3ck3KGwG', '2025-06-25 02:40:33'),
(8, 'Mati', 'Pciha', 'Picha@gmail.com', '$2y$10$tSiYoNuUI9z8okUc.QXw5ezdQQUsUIrkDk9mA9KlUUNY7irjF3gFC', '2025-06-25 02:52:08'),
(9, 'Nicolas', 'franchini', 'nico@gmail.com', '$2y$10$PXYSLR05mozZ7.tfDfb.a.6AOukVlZ5Zzpp8FB.7IzS4.6vOejHqe', '2025-06-25 02:55:35'),
(10, 'abel', 'boyzo', 'abel@gmail.com', '$2y$10$9sSmdRL.7nInSzbTVny1teBi4d4aCY.HBXzawy5.86E2bl33dcDae', '2025-06-25 02:59:42'),
(11, 'joaquin', 'ruiz', 'joaco@gmail.com', '$2y$10$9bDZfTKR8Dl2zfw5pHrHvuEo7cdr.mHcIIfKP0FqE8UdNx.NKmMiu', '2025-06-25 03:00:34'),
(12, 'Juan', 'Sacala', 'pepito@gmail.com', '$2y$10$qU1GGaZ6H/2vNY6jAMwwTOkfxczTCfMzdouPytF3Ga0/RnLKbuz9y', '2025-06-25 03:16:53'),
(13, 'rico', 'huevo', 'petesaurio@gmail.com', '$2y$10$SZdR94ehj.VPtgtGq7RgDugzXAGvL80W4vjgVUJj3NQDUsNxVMOoa', '2025-06-27 17:43:51'),
(14, 'Jenny', 'Gutierrez', 'jenny@gmail.com', '$2y$10$GLYcbN.2M/es1gAx/jGuXufVvXOQ7KAUWQgDn6k/10XMhu2JtYG1K', '2025-06-28 00:52:29'),
(15, 'Matias', 'Martinez', 'Matt@gmail.com', '$2y$10$wdvvkue2klpe1ARrUOPK/.aXFSiDOJ6.aMjzjblsqhI1R6M2npCX6', '2025-06-29 01:13:10'),
(16, 'Esteban', 'Lopez', 'Lopez@gmail.com', '$2y$10$l2vgBQwB99bBFJ4QgxBZ9.NnS7szzNnTA5rFyGeYpyT8Fuc1X3TlC', '2025-06-29 01:16:51'),
(17, 'Juano', 'Lez', 'pichin@gmail.com', '$2y$10$krgnB10ipHRKVFNENnYPdO5lggkVMHD/jD.jrEkhTP2mhJ46lgVlK', '2025-06-29 19:22:19'),
(18, 'user', 'test', 'User123@gmail.com', '$2y$10$aJ/HVBU7df4kjmMI3QpMSu1EPVSy12iF5uiNAauT0Y2UzubFNHrya', '2025-06-29 19:41:11'),
(19, 'Juan', 'Mono', 'mono@gmail.com', '$2y$10$k0U/Hr8CsmRNb6vyLeTsleRM8YzkNp6wOhkyGtX..KoivDcdMBNT6', '2025-06-30 02:38:40'),
(20, 'Matias', 'Polon', 'elmaty@gmail.com', '$2y$10$Mk1q4JfjFKnWQtt.b801Rey2CQy.gaMLgR.dTNWTE0NOJl3JxISHG', '2025-06-30 02:51:21'),
(21, 'john', 'connor', 'juancho@gmail.com', '$2y$10$x81gbytWFKQr2DsgoZgLVeNyVptayMopQQRs2.MQFHImgGSkHJYPi', '2025-06-30 03:27:21'),
(22, 'Juan', 'Martinez', 'choclo@gmail.com', '$2y$10$wbqIrD3spVS.VGyAk2B.FeWb/b4bJeV9/MBx83MAweZIUZLwDZWZK', '2025-06-30 03:34:04'),
(23, 'user', 'tester', 'test@gmail.com', '$2y$10$qQAB9.Z7/dA8r.YU4wXCmepax6PbjPjL4tTGN3/w8PpEGTl75IEOe', '2025-06-30 03:46:43'),
(24, 'Juan', 'Martinez', 'Mortero@gmail.com', '$2y$10$UxKgEb1kK0KJDeLR0Jl55eE3/Hsiv/tnM6b6qFcy.eP6smyrt32Qy', '2025-06-30 04:20:46'),
(25, 'Alejo', 'Mirarshi', 'Neko@gmail.com', '$2y$10$RGWfOchOhJKRgT2057qXWO3bD5LZ4IRJ4t3qHtvF.FAbiPiSuYOyO', '2025-06-30 04:21:58'),
(26, 'Matias', 'Martinez', 'Berenjena@gmail.com', '$2y$10$gyzEX73v2neInao5qs0I6OpWPKKJC.9cuek0aIbvwJKC4UhoeUALy', '2025-06-30 13:53:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD CONSTRAINT `pedidos_productos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `pedidos_productos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
