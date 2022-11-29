-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 29 nov. 2022 à 07:59
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `escape_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `furnitures`
--

DROP TABLE IF EXISTS `furnitures`;
CREATE TABLE IF NOT EXISTS `furnitures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `picture` text,
  `description` text NOT NULL,
  `action` varchar(50) NOT NULL DEFAULT 'fouiller',
  `clue` text,
  `clue2` text,
  `clue3` text,
  `padlock` enum('yes','no') NOT NULL DEFAULT 'no',
  `interaction_id` int(11) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interaction` (`interaction_id`),
  KEY `objects` (`object_id`),
  KEY `users` (`user_id`),
  KEY `scripts` (`script_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `furnitures`
--

INSERT INTO `furnitures` (`id`, `title`, `picture`, `description`, `action`, `clue`, `clue2`, `clue3`, `padlock`, `interaction_id`, `object_id`, `user_id`, `script_id`, `room_id`) VALUES
(1, 'jhjf', NULL, 'hjfghj', 'fouiller', NULL, NULL, NULL, 'no', NULL, NULL, 14, NULL, NULL),
(2, 'tre', '', 'fgd', 'fgd', '', NULL, NULL, 'yes', NULL, NULL, 14, NULL, NULL),
(3, 'test', '', 'test', 'test', '', NULL, NULL, 'yes', NULL, NULL, 14, 42, NULL),
(4, 'fgdfg', '', 'fgdfg', 'fgdfgd', 'fgd', NULL, NULL, 'yes', NULL, NULL, 14, 43, NULL),
(5, 'test', '', 'test', 'teset', 'test', NULL, NULL, 'yes', NULL, NULL, 14, 42, NULL),
(6, 'tst', '', 'ets', 'test', 'teset', NULL, NULL, 'yes', NULL, NULL, 14, 42, NULL),
(10, 'pop', '', 'pop', '', '', NULL, NULL, 'yes', NULL, NULL, 14, 42, 7),
(12, 'caca', '', 'hjgfhj', '', '                    ', NULL, NULL, 'yes', NULL, NULL, 14, 42, 8),
(14, 'popopopo', '', 'ioiopi', '', 'll', 'llk', 'jjj', 'yes', NULL, NULL, 14, 42, 7),
(15, 'test', '', 'test', 'fouiller', 'azert', NULL, NULL, 'yes', NULL, NULL, 14, 42, 7),
(16, 'test33', 'karolos.png', 'rr', '', '', NULL, NULL, 'yes', NULL, NULL, 14, 42, 7),
(17, 'je suis un meuble', '', 'un super meuble', 'fouille moi', 'je suis un indice', 'je suis un deuxième indice                        ', NULL, 'yes', NULL, NULL, 14, 44, 9),
(18, 'delete moi ', '', 'aaa', '', '', NULL, NULL, 'yes', NULL, NULL, 14, 44, 9);

-- --------------------------------------------------------

--
-- Structure de la table `interactions`
--

DROP TABLE IF EXISTS `interactions`;
CREATE TABLE IF NOT EXISTS `interactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `furniture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `furnitures` (`furniture_id`),
  KEY `users` (`user_id`),
  KEY `script` (`script_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `objects` (`object_id`),
  KEY `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `objects`
--

DROP TABLE IF EXISTS `objects`;
CREATE TABLE IF NOT EXISTS `objects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` text,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users` (`user_id`),
  KEY `scripts` (`script_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `objects`
--

INSERT INTO `objects` (`id`, `title`, `description`, `picture`, `user_id`, `script_id`) VALUES
(1, 'aze', 'aze', 'leo.png', 14, NULL),
(2, 'sdq', 'sdq', '', 14, NULL),
(3, 'sdq', 'sdq', 'karolos.png', 14, NULL),
(4, 'hghf', 'hghg', 'jorge.png', 14, NULL),
(5, 'aaaaa', 'hghg', 'natan.png', 14, NULL),
(6, 'qsd', 'qsd', '', 14, 42),
(7, 'pipo', 'lalalalal', '', 14, 44);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `picture` text,
  `padlock` enum('yes','no') NOT NULL DEFAULT 'no',
  `furniture_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `furnitures` (`furniture_id`),
  KEY `users` (`user_id`),
  KEY `scripts` (`script_id`),
  KEY `script_id` (`script_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `description`, `picture`, `padlock`, `furniture_id`, `user_id`, `script_id`) VALUES
(1, 'bnbn', 'bnvbnv', '', 'yes', NULL, 14, 0),
(2, 'popo', 'popopo', 'convention.jpg', 'yes', NULL, 14, 0),
(3, 'popopo', 'popopo', 'jorge.png', 'no', NULL, 14, 0),
(4, 'opiuopuipoiu', 'jkghjkghjkhgjhg', 'jorge.png', 'no', NULL, 14, 0),
(5, 'scqcsq', 'hgjjjjjjjjjjjjjjjjjjjjj', 'pauline.png', 'no', NULL, 14, 0),
(6, 'ghfd', 'sdsdsd', '', 'yes', NULL, 14, 43),
(7, 'hgf', 'hgfgh', '', 'no', NULL, 14, 42),
(8, 'ghfd22', 'ghfdg', '', 'no', NULL, 14, 42),
(9, 'rte', 'rte', '', 'yes', NULL, 14, 44);

-- --------------------------------------------------------

--
-- Structure de la table `scripts`
--

DROP TABLE IF EXISTS `scripts`;
CREATE TABLE IF NOT EXISTS `scripts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `difficulty` tinyint(4) NOT NULL DEFAULT '3',
  `description` text NOT NULL,
  `winner_msg` varchar(255) NOT NULL,
  `lost_msg` varchar(255) NOT NULL,
  `picture` text,
  `duration` time NOT NULL DEFAULT '01:00:00',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `scripts`
--

INSERT INTO `scripts` (`id`, `title`, `difficulty`, `description`, `winner_msg`, `lost_msg`, `picture`, `duration`, `user_id`) VALUES
(42, 'jjk', 1, 'kjk', 'kk', 'jkjh', 'julien.png', '01:00:00', 14),
(43, 'hgfd', 1, 'ghdf', 'ghfd', 'ghf', 'antoine.png', '01:00:00', 14),
(44, 'fgfg', 1, 'gfdgdf', 'fgddfg', 'dfgdfg', 'natan.png', '01:00:00', 14),
(45, 'tata', 4, 'La tante trop gentille', 'vous avez vaincu la tante', 'la tante vous a enfermé dans une tente', 'antoine.png', '01:00:00', 14);

-- --------------------------------------------------------

--
-- Structure de la table `script_inventory`
--

DROP TABLE IF EXISTS `script_inventory`;
CREATE TABLE IF NOT EXISTS `script_inventory` (
  `script_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `scripts` (`script_id`),
  KEY `objects` (`object_id`),
  KEY `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(13, 'test', 'toto@toto.com', '$2y$10$9/ZqiBv3t1hmjw7poJl0Ou2AjSeRBiozVRxyroyYAZd0Z44RGbyES', 1),
(14, 'alain', 'test@test.com', '$2y$10$ynWz9L88hlcb1W1IoFVzLuGwuhNwZb6GOVZJxGULWkLDNs0lmaLg.', 1),
(17, 'popo', 'aaa@toto.com', '$2y$10$btYb/QrexNFPNTn/qUJ5SeFD0MwfwnuvQ/YWFM8qD3Asvm4MxHmn6', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `furnitures`
--
ALTER TABLE `furnitures`
  ADD CONSTRAINT `furnitures_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`),
  ADD CONSTRAINT `furnitures_ibfk_2` FOREIGN KEY (`interaction_id`) REFERENCES `interactions` (`id`),
  ADD CONSTRAINT `furnitures_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `furnitures_ibfk_4` FOREIGN KEY (`script_id`) REFERENCES `scripts` (`id`);

--
-- Contraintes pour la table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furnitures` (`id`),
  ADD CONSTRAINT `interactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `interactions_ibfk_3` FOREIGN KEY (`script_id`) REFERENCES `scripts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `objects`
--
ALTER TABLE `objects`
  ADD CONSTRAINT `objects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `objects_ibfk_2` FOREIGN KEY (`script_id`) REFERENCES `scripts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furnitures` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `scripts`
--
ALTER TABLE `scripts`
  ADD CONSTRAINT `scripts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `script_inventory`
--
ALTER TABLE `script_inventory`
  ADD CONSTRAINT `script_inventory_ibfk_1` FOREIGN KEY (`script_id`) REFERENCES `scripts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `script_inventory_ibfk_2` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `script_inventory_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
