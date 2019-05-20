-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sistema_externo`
--

-- --------------------------------------------------------
--
-- Table structure for table `mensajes`
--

CREATE TABLE `mensajes` (
  `mensaje_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `estado` varchar(20),
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `movil_numero` int(11) NOT NULL,
  `fcm_registro` varchar(255),
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for table `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`mensaje_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for table `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `mensaje_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;

--
-- Constraints for table `mensajes`
--

ALTER TABLE  `mensajes` ADD FOREIGN KEY (  `usuario_id` ) REFERENCES  `usuarios` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE ;
