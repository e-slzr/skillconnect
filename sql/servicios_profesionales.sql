-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 07:13:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `servicios_profesionales`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `sueldo` decimal(10,2) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `descripcion_empresa` text DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`id`, `usuario_id`, `nombre`, `profesion`, `descripcion`, `sueldo`, `telefono`, `ubicacion`, `foto_url`, `descripcion_empresa`, `email`, `created_at`) VALUES
(1, 1, 'Auxiliar Contable (Pasantía remunerada)', 'Pasantia', 'Texto de prueba para descripción de puesto.', 0.00, '', 'Santa Ana', 'ruta_de_la_foto.jpg', 'Texto de prueba para descripción de empresa que publica la oferta.', 'pasantias@empresa.com', '2024-11-10 04:56:12'),
(2, 1, 'Albañil (Proyecto de 6 meses)', 'Oficio', 'Descripcion de la oferta de trabajo.', 400.00, '', 'Metapan', 'ruta_de_la_foto.jpg', 'Texto descriptivo de la empresa que publica la oferta.', 'albanil@oficio.com', '2024-11-10 05:07:16'),
(3, 1, 'Docente de Matemáticas (Bachillerato)', 'Profesión', 'Licenciado/a en educación, matematicas o carreras a fin, para impartir clases a alumnos de bachillerato de primero a tercer año.', 650.00, '7746-5684', 'Santa Ana', 'ruta_de_la_foto.jpg', 'Texto descriptivo de la empresa que publica la oferta.', 'docente@profesion.com', '2024-11-10 05:10:25'),
(4, 3, 'Auxiliar de IT (Pasantia)', 'Pasantia', 'Texto descripción del puesto de trabajo que se esta ofertando, en este caso una pasantía para Auxiliar de IT, podría ser una pasantia remunerada, donde el pasante reciba biaticos de transporte y comida durante su estadia dentro de la empresa.', 0.00, '6045-8965', 'Candelaria de la Frontera', 'ruta_de_la_foto.jpg', 'Texto de prueba para la descripcion de la empresa.', 'pasantias@empresa.com', '2024-11-10 05:51:15'),
(5, 1, 'Diseñador Gráfico Junior', 'Pasantia', 'Se busca diseñador gráfico junior para apoyar en proyectos de marketing y diseño visual.', 0.00, '7256-4457', 'Santa Ana', 'ruta_de_la_foto.jpg', 'Empresa enfocada en publicidad y marketing digital.', 'diseno@empresa.com', '2024-11-11 05:07:49'),
(6, 2, 'Técnico Electricista', 'Oficio', 'Técnico en electricidad con experiencia en instalaciones residenciales y comerciales.', 450.00, '7623-1122', 'Metapán', 'ruta_de_la_foto.jpg', 'Empresa de servicios eléctricos y mantenimiento industrial.', 'electricista@servicios.com', '2024-11-11 05:07:49'),
(7, 3, 'Asistente de Recursos Humanos', 'Profesion', 'Asistente en el área de recursos humanos, encargado de apoyar en el reclutamiento y selección de personal.', 550.00, '7845-3267', 'Chalchuapa', 'ruta_de_la_foto.jpg', 'Empresa dedicada a la consultoría y gestión de recursos humanos.', 'rrhh@consultoria.com', '2024-11-11 05:07:49'),
(8, 1, 'Mecánico Automotriz', 'Oficio', 'Mecánico con experiencia en reparación de vehículos livianos y pesados.', 500.00, '7896-5555', 'Coatepeque', 'ruta_de_la_foto.jpg', 'Taller automotriz especializado en mantenimiento de vehículos.', 'mecanico@automotriz.com', '2024-11-11 05:07:49'),
(9, 2, 'Analista de Datos', 'Profesion', 'Se busca analista de datos para trabajar en la interpretación de estadísticas y mejora de procesos.', 750.00, '7123-8877', 'Texistepeque', 'ruta_de_la_foto.jpg', 'Empresa de tecnología y análisis de datos.', 'datos@empresa.com', '2024-11-11 05:07:49'),
(10, 3, 'Auxiliar Administrativo', 'Pasantia', 'Asistente administrativo para apoyo en tareas de oficina y gestión de documentos.', 0.00, '7054-2233', 'Santa Ana', 'ruta_de_la_foto.jpg', 'Empresa de servicios administrativos y contables.', 'administrativo@empresa.com', '2024-11-11 05:09:23'),
(11, 1, 'Soldador Industrial', 'Oficio', 'Se busca soldador con experiencia en trabajos de estructuras metálicas y soldadura industrial.', 550.00, '7633-9988', 'Metapán', 'ruta_de_la_foto.jpg', 'Empresa de construcción y mantenimiento industrial.', 'soldador@metalurgia.com', '2024-11-11 05:09:23'),
(12, 2, 'Especialista en Marketing Digital', 'Profesion', 'Especialista en marketing digital para gestión de redes sociales y campañas de publicidad.', 700.00, '7722-3344', 'Chalchuapa', 'ruta_de_la_foto.jpg', 'Agencia de marketing y publicidad digital.', 'marketing@agencia.com', '2024-11-11 05:09:23'),
(13, 3, 'Asesor de Ventas', 'Profesion', 'Asesor de ventas para atención al cliente y promoción de productos en tienda.', 450.00, '7891-5647', 'Coatepeque', 'ruta_de_la_foto.jpg', 'Empresa de ventas al por menor y distribución de productos.', 'ventas@empresa.com', '2024-11-11 05:09:23'),
(14, 1, 'Operador de Maquinaria Pesada', 'Oficio', 'Operador con experiencia en manejo de maquinaria para construcción y excavación.', 600.00, '7112-8834', 'Texistepeque', 'ruta_de_la_foto.jpg', 'Empresa constructora y de infraestructura.', 'maquinaria@construccion.com', '2024-11-11 05:09:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `profesion` varchar(255) NOT NULL,
  `dui` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `about` text DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('Profesional','Usuario') DEFAULT 'Usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `profesion`, `dui`, `telefono`, `direccion`, `about`, `correo`, `contrasena`, `rol`, `fecha_registro`) VALUES
(1, 'tester-user', 'Ingeniero de Sistemas Informaticos', '047597315', '60452084', 'Santa Ana, El Salavador', 'Texto demostrativo para el campo \"Sobre mi\" del registro de nuevo usuario, este texto no continene nada relevante, todo es por motivos de prueba.', 'test-user@correo.com', '$2y$10$boZ1Vuj4y3ooiFz1U93N2O1XGzQuASX7/u3A71oyvn7cWJJM8YgNy', 'Profesional', '2024-11-11 01:12:12'),
(2, 'tester-user-02', 'Licenciado en Matematicas', '047894355', '77492563', 'El Congo, El Salvador', 'Texto demostrativo para el campo \"Sobre mi\" del registro de nuevo usuario, este texto no continene nada relevante, todo es por motivos de prueba.', 'test-user-02@correo.com', '$2y$10$/CZor1xQX2ArY4NP.yTHleVlLqkO.ksxf5ud6ejSpL8oSnDv5MNzW', 'Profesional', '2024-11-11 01:29:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
