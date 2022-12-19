-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 19 2022 г., 23:51
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `botiga`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(7, 'admin', '$2y$04$4hMSNSXF5PmQlmnYvKOeZeXEiK0zhc1Yo02wRLW3j8zxRWGfDun9S');

-- --------------------------------------------------------

--
-- Структура таблицы `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `isactive` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `isactive`) VALUES
(1, 'Zapatos', 'Replica exacta.', 1),
(2, 'Todos', 'De todo!', 1),
(3, 'Blusas', 'Bastante grandes ', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cestas`
--

CREATE TABLE `cestas` (
  `id_cesta` int(15) NOT NULL,
  `fk_id_usuario` int(15) NOT NULL,
  `precio_total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cestas`
--

INSERT INTO `cestas` (`id_cesta`, `fk_id_usuario`, `precio_total`) VALUES
(1, 1, 100),
(23, 2, 25);

-- --------------------------------------------------------

--
-- Структура таблицы `cesta_productos`
--

CREATE TABLE `cesta_productos` (
  `fk_id_cesta` int(100) NOT NULL,
  `fk_id_producto` int(100) NOT NULL,
  `cantidad` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `cesta_productos`
--

INSERT INTO `cesta_productos` (`fk_id_cesta`, `fk_id_producto`, `cantidad`) VALUES
(1, 1, 3),
(23, 2, 2),
(23, 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `empresa_transporte`
--

CREATE TABLE `empresa_transporte` (
  `id_empresa_transporte` int(100) NOT NULL,
  `nombre_empresa_transporte` varchar(256) NOT NULL,
  `precio_empresa_transporte` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `empresa_transporte`
--

INSERT INTO `empresa_transporte` (`id_empresa_transporte`, `nombre_empresa_transporte`, `precio_empresa_transporte`) VALUES
(1, 'DHL', 20),
(2, 'UPS', 15),
(3, 'Correos', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `pedidos`
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
-- Дамп данных таблицы `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fk_id_cesta`, `fk_id_empresa_transporte`, `fk_id_usuario`, `num_seguimiento`, `estado`, `fecha`) VALUES
(1, 1, 3, 1, 'sin seguimiento.', 2, 1671473220);

-- --------------------------------------------------------

--
-- Структура таблицы `productos`
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
-- Дамп данных таблицы `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `cantidad`, `precio`, `categoria`, `foto`, `isactive`) VALUES
(1, 'Camisa', 'Buena camisa de calidad', 4, 15, 1, 'https://depor.com/resizer/BdfCWDPbdNccDG_sY-atb0ZI8nA=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/3Z2SZYXOEBCVDEOTIVIBF2ZNUE.jpg', 0),
(2, 'Gafas', 'Accesorio gafas', 6, 2, 2, 'https://depor.com/resizer/BdfCWDPbdNccDG_sY-atb0ZI8nA=/580x330/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/3Z2SZYXOEBCVDEOTIVIBF2ZNUE.jpg', 1),
(11, 'Borrar', 'Producto inútil', 4, 23, 3, '', 1),
(12, 'birara', 'asdasd', 5, 13, 1, 'https://boiab.ahe.eh/agf', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `usuarios`
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
-- Дамп данных таблицы `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `telefono`, `contraseña`, `direccion`, `provincia`, `cp`) VALUES
(1, 'Aleksandr', 'alexander.baikalov2@inslapineda.cat', '633837566', '$2y$10$gQ7XZwWjnB0S3VccmsB8xOX1ftT.G98yajlZr4dN5FsE05EC2cZ/e', 'Marquès de sant-mori 123', 'Barcelona', '08918'),
(2, 'Aleksandr Baikalov', 'alexander.baikalov@inslapineda.cat', '6978679', '$2y$10$gQ7XZwWjnB0S3VccmsB8xOX1ftT.G98yajlZr4dN5FsE05EC2cZ/e', 'Marquès sant-mori 174 6-3', 'Badalona', '08918');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Индексы таблицы `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Индексы таблицы `cestas`
--
ALTER TABLE `cestas`
  ADD PRIMARY KEY (`id_cesta`),
  ADD UNIQUE KEY `Foreign key` (`fk_id_usuario`) USING BTREE;

--
-- Индексы таблицы `cesta_productos`
--
ALTER TABLE `cesta_productos`
  ADD UNIQUE KEY `fk_id_producto` (`fk_id_producto`,`fk_id_cesta`),
  ADD KEY `fk_id_cesta` (`fk_id_cesta`);

--
-- Индексы таблицы `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
  ADD PRIMARY KEY (`id_empresa_transporte`);

--
-- Индексы таблицы `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD UNIQUE KEY `Foreign keys` (`fk_id_cesta`,`fk_id_empresa_transporte`,`fk_id_usuario`);

--
-- Индексы таблицы `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `Foreign keys` (`categoria`);

--
-- Индексы таблицы `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cestas`
--
ALTER TABLE `cestas`
  MODIFY `id_cesta` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `empresa_transporte`
--
ALTER TABLE `empresa_transporte`
  MODIFY `id_empresa_transporte` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cestas`
--
ALTER TABLE `cestas`
  ADD CONSTRAINT `cestas_ibfk_2` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Ограничения внешнего ключа таблицы `cesta_productos`
--
ALTER TABLE `cesta_productos`
  ADD CONSTRAINT `cesta_productos_ibfk_1` FOREIGN KEY (`fk_id_cesta`) REFERENCES `cestas` (`id_cesta`),
  ADD CONSTRAINT `cesta_productos_ibfk_2` FOREIGN KEY (`fk_id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Ограничения внешнего ключа таблицы `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
