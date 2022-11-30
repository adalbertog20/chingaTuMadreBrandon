-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 28, 2022 at 05:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `num_telefonico` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `usuario`, `contrasena`, `email`, `fecha_nacimiento`, `num_telefonico`) VALUES
(1, 'rusty', 'rusty', 'rustytheguy2@gmail.com', '2003-01-03', '6121442134');

-- --------------------------------------------------------

--
-- Table structure for table `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `id_categoria_producto` int(11) NOT NULL,
  `nombre` enum('Comic','Manga','Libro') NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria_producto`
--

INSERT INTO `categoria_producto` (`id_categoria_producto`, `nombre`, `descripcion`) VALUES
(1, 'Comic', 'Historieta Infantil'),
(2, 'Manga', 'Historieta Japonesa');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_venta` date NOT NULL,
  `monto_venta` float NOT NULL,
  `descripcion_venta` varchar(500) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `stock` int(11) NOT NULL,
  `idioma` enum('ESPANOL','INGLES','JAPONES') NOT NULL,
  `id_categoria_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_detalle_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `num_telefonico` (`num_telefonico`);

--
-- Indexes for table `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`id_categoria_producto`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria_producto` (`id_categoria_producto`);

--
-- Indexes for table `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_detalle_venta` (`id_detalle_venta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `id_categoria_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `detalle_venta_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_categoria_producto`) REFERENCES `categoria_producto` (`id_categoria_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admins` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_detalle_venta`) REFERENCES `detalle_venta` (`id_detalle_venta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Trigger que impide campos vacios, nulos y repetidos.
USE comics;
DROP TRIGGER IF EXISTS BEFORE_ADMIN_INSERT;
DELIMITER $$
CREATE TRIGGER BEFORE_ADMIN_INSERT BEFORE INSERT
ON admins
FOR EACH ROW
BEGIN
	-- NOMBRE DE USUARIO
	IF ISNULL(NEW.usuario) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL USUARIO INGRESADO ES NULA';
	END IF;

    IF (SELECT usuario FROM admins WHERE usuario = NEW.usuario) = NEW.usuario THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL USUARIO INGRESADO YA EXISTE';
    END IF;
    -- CONTRASEÑA
	IF ISNULL(NEW.contrasena) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LA CONTRASEÑA INGRESADA ES NULA';
	END IF;

    -- FECHA DE NACIMIENTO
    IF ISNULL(NEW.fecha_nacimiento) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LA FECHA DE NACIMIENTO INGRESADA ES NULA';
	END IF;

    -- CORREO ELECTRONICO
    IF ISNULL(NEW.email) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL EMAIL INGRESADO ES NULA';
	END IF;

     IF (SELECT email FROM admins WHERE email = NEW.email) = NEW.email THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL EMAIL INGRESADO YA EXISTE';
    END IF;
    -- NUMERO TELEFONICO
    IF ISNULL(NEW.num_telefonico) THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL EMAIL INGRESADO ES NULA';
	END IF;

     IF (SELECT num_telefonico FROM admins WHERE num_telefonico = NEW.num_telefonico) = NEW.num_telefonico THEN
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'EL NUMERO TELEFONICO INGRESADO YA EXISTE';
    END IF;

END$$
DELIMITER ;
SELECT * FROM admins;
