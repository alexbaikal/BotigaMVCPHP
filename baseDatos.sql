-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2022 at 10:53 AM
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
(3, 'Todos', 'De todo!', 1),
(4, 'Blusas', 'Bastante grandes ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cestas`
--

CREATE TABLE `cestas` (
  `id_cesta` int(15) NOT NULL,
  `fk_id_usuario` int(15) NOT NULL,
  `lista_productos` varchar(5000) NOT NULL,
  `precio_total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cestas`
--

INSERT INTO `cestas` (`id_cesta`, `fk_id_usuario`, `lista_productos`, `precio_total`) VALUES
(1, 0, '[{\"id_producto\":1,\"cantidad\":2},{\"id_producto\":2,\"cantidad\":1},{\"id_producto\":3,\"cantidad\":3}]', 0);

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
(1, 1, 1, 1, 'sin seguimiento.', 0, 0);

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
(1, 'Camisa', 'Buena camisa de calidad', 4, 15, 1, 'https://depor.com/resizer/BdfCWDPbdNccDG_sY-atb0ZI8nA=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/3Z2SZYXOEBCVDEOTIVIBF2ZNUE.jpg', 0),
(2, 'Gafas', 'Accesorio gafas', 6, 2, 2, 'https://depor.com/resizer/BdfCWDPbdNccDG_sY-atb0ZI8nA=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/3Z2SZYXOEBCVDEOTIVIBF2ZNUE.jpg', 1);

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
(1, 'Aleksandr', 'alexander.baikalov@inslapineda.cat', '633837566', '123456', 'Marquès de sant-mori 123', 'Barcelona', '08918');

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
  ADD PRIMARY KEY (`id_cesta`);

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
  ADD KEY `categoria` (`categoria`);

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
  MODIFY `id_categoria` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cestas`
--
ALTER TABLE `cestas`
  MODIFY `id_cesta` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
