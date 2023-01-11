-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2023 at 09:28 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `botiga`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(7, 'admin', '$2y$04$4hMSNSXF5PmQlmnYvKOeZeXEiK0zhc1Yo02wRLW3j8zxRWGfDun9S');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `isactive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `isactive`) VALUES
(1, 'Zapatos', 'Replica exacta.', 1),
(2, 'Otros', 'De todo!', 1),
(3, 'Blusas', 'Bastante grandes ', 1),
(7, 'Pantalones', 'Buenos para hinvierno.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cestas`
--

CREATE TABLE `cestas` (
  `id_cesta` int(15) NOT NULL,
  `fk_id_usuario` int(15) NOT NULL,
  `precio_total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cestas`
--

INSERT INTO `cestas` (`id_cesta`, `fk_id_usuario`, `precio_total`) VALUES
(1, 1, 100),
(23, 2, 230);

-- --------------------------------------------------------

--
-- Table structure for table `cesta_productos`
--

CREATE TABLE `cesta_productos` (
  `fk_id_cesta` int(100) NOT NULL,
  `fk_id_producto` int(100) NOT NULL,
  `cantidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cesta_productos`
--

INSERT INTO `cesta_productos` (`fk_id_cesta`, `fk_id_producto`, `cantidad`) VALUES
(1, 1, 4),
(23, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `empresa_transporte`
--

CREATE TABLE `empresa_transporte` (
  `id_empresa_transporte` int(100) NOT NULL,
  `nombre_empresa_transporte` varchar(256) NOT NULL,
  `precio_empresa_transporte` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `empresa_transporte`
--

INSERT INTO `empresa_transporte` (`id_empresa_transporte`, `nombre_empresa_transporte`, `precio_empresa_transporte`) VALUES
(1, 'DHL', 20),
(2, 'UPS', 15),
(3, 'Correos', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fk_id_cesta` int(11) NOT NULL,
  `fk_id_empresa_transporte` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL,
  `num_seguimiento` varchar(128) DEFAULT NULL,
  `estado` int(1) NOT NULL,
  `fecha` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fk_id_cesta`, `fk_id_empresa_transporte`, `fk_id_usuario`, `num_seguimiento`, `estado`, `fecha`) VALUES
(1, 1, 3, 1, 'sin seguimiento.', 2, 1671473220),
(2, 23, 3, 2, 'sin asignar', 0, 1673423270),
(3, 23, 1, 2, 'sin asignar', 0, 1673423663);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantidad` int(255) NOT NULL,
  `precio` float NOT NULL,
  `categoria` int(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `isactive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `cantidad`, `precio`, `categoria`, `foto`, `isactive`) VALUES
(1, 'Camisa', 'Buena camisa de calidad', 4, 15, 3, 'https://cdn.grupoelcorteingles.es/statics/manager/contents/images/uploads/2022/02/rJLYTyu19.jpeg', 1),
(2, 'Gafas', 'Accesorio gafas', 2, 2, 2, 'https://magento.opticalia.com/media/catalog/product/cache/e4be6767ec9b37c1ae8637aee2f57a6a/p/j/pjg338112.png', 1),
(11, 'Jeans', 'Producto útil', 3, 23, 7, 'https://media.gettyimages.com/id/173239968/es/foto/fino-herm%C3%A9tico-jeans-azul-sobre-fondo-blanco.jpg?s=612x612&w=gi&k=20&c=Dt203p3YIQW-vcbKcZoxnvGsC0tDZNy-aeQLTFCDj3E=', 1),
(12, 'Gorro', 'Perfecto para hinvierno!', 5, 13, 1, 'https://cdn01.pisamonas.es/media/catalog/product/cache/3/image/9df78eab33525d08d6e5fb8d27136e95/g/o/gorro-borla-pompon-pelo_4_.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(15) NOT NULL,
  `nombre` varchar(48) NOT NULL,
  `correo` varchar(48) NOT NULL,
  `telefono` varchar(14) DEFAULT NULL,
  `contraseña` varchar(256) NOT NULL,
  `direccion` varchar(124) DEFAULT NULL,
  `provincia` varchar(24) DEFAULT NULL,
  `cp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `telefono`, `contraseña`, `direccion`, `provincia`, `cp`) VALUES
(1, 'Aleksandr', 'alexander.baikalov2@inslapineda.cat', '633837566', '$2y$10$gQ7XZwWjnB0S3VccmsB8xOX1ftT.G98yajlZr4dN5FsE05EC2cZ/e', 'Marquès de sant-mori 123', 'Barcelona', '08918'),
(2, 'Aleksandr Baikalov', 'alexander.baikalov@inslapineda.cat', '6978679', '$2y$10$gQ7XZwWjnB0S3VccmsB8xOX1ftT.G98yajlZr4dN5FsE05EC2cZ/e', 'Marquès sant-mori 174 6-3', 'Badalona', '08918');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `cestas`
--
ALTER TABLE `cestas`
  ADD PRIMARY KEY (`id_cesta`),
  ADD UNIQUE KEY `Foreign key` (`fk_id_usuario`) USING BTREE;

--
-- Indexes for table `cesta_productos`
--
ALTER TABLE `cesta_productos`
  ADD UNIQUE KEY `fk_id_producto` (`fk_id_producto`,`fk_id_cesta`),
  ADD KEY `fk_id_cesta` (`fk_id_cesta`);

--
-- Indexes for table `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
  ADD PRIMARY KEY (`id_empresa_transporte`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `Foreign keys` (`categoria`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cestas`
--
ALTER TABLE `cestas`
  MODIFY `id_cesta` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
  MODIFY `id_empresa_transporte` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cestas`
--
ALTER TABLE `cestas`
  ADD CONSTRAINT `cestas_ibfk_2` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Constraints for table `cesta_productos`
--
ALTER TABLE `cesta_productos`
  ADD CONSTRAINT `cesta_productos_ibfk_1` FOREIGN KEY (`fk_id_cesta`) REFERENCES `cestas` (`id_cesta`),
  ADD CONSTRAINT `cesta_productos_ibfk_2` FOREIGN KEY (`fk_id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
