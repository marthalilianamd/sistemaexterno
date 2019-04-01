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
-- Table structure for table `gremios`
--

CREATE TABLE `gremios` (
  `gremio_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gremios`
--

INSERT INTO `gremios` (`gremio_id`, `nombre`, `fecha_creacion`) VALUES
(1, 'Fontaneria', '2019-01-16 06:57:40'),
(2, 'Albañileria', '2019-01-16 06:57:40'),
(3, 'Pintura', '2019-01-16 06:57:40'),
(4, 'Cerrajeria', '2019-01-16 06:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `mensajes`
--

CREATE TABLE `mensajes` (
  `mensaje_id` int(11) NOT NULL,
  `gremio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
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
  `movil_numero` int(11) NOT NULL,
  `api_key` varchar(32) NOT NULL,
  `fcm_registro_id` varchar(32) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gremios`
--
ALTER TABLE `gremios`
  ADD PRIMARY KEY (`gremio_id`);

--
-- Indexes for table `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`mensaje_id`),
  ADD KEY `gremio_id` (`gremio_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gremios`
--
ALTER TABLE `gremios`
  MODIFY `gremio_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `mensaje_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mensajes`
--

ALTER TABLE  `mensajes` ADD FOREIGN KEY (  `usuario_id` ) REFERENCES  `usuarios` (`usuario_id`) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE  `mensajes` ADD FOREIGN KEY (  `gremio_id` ) REFERENCES  `gremios` (`gremio_id`) ON DELETE CASCADE ON UPDATE CASCADE ;
