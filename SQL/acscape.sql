-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 déc. 2022 à 11:35
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
  `unlock_word` varchar(255) DEFAULT NULL,
  `reward` text,
  `object_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `objects` (`object_id`),
  KEY `users` (`user_id`),
  KEY `scripts` (`script_id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `furnitures`
--

INSERT INTO `furnitures` (`id`, `title`, `picture`, `description`, `action`, `clue`, `clue2`, `clue3`, `padlock`, `unlock_word`, `reward`, `object_id`, `user_id`, `script_id`, `room_id`) VALUES
(1, 'jhjf', NULL, 'hjfghj', 'fouiller', NULL, NULL, NULL, 'no', NULL, NULL, NULL, 14, NULL, NULL),
(2, 'tre', '', 'fgd', 'fgd', '', NULL, NULL, 'yes', NULL, NULL, NULL, 14, NULL, NULL),
(19, 'xwxxw', '1669714514_jorge.png', 'az', 'secouer', 'je suis un indice                    ', 'qsq', NULL, 'yes', NULL, NULL, 9, 18, 52, 10),
(21, 'hjgf', '1669716746_', 'ghjfg', 'hjgf', 'ghf', NULL, NULL, 'yes', NULL, NULL, 9, 18, 52, 10),
(25, 'hgdfhg', '1669719301_antoine.png', 'ghfd', 'secouer', '', NULL, NULL, 'yes', NULL, NULL, 10, 18, 52, 10),
(37, 'fgds', '1669718272_', 'dsfgs', 'fgds', 'fgdsfgdsfddfdddfdffd', NULL, NULL, 'yes', NULL, NULL, 0, 18, 52, 10),
(38, 'dfs', '1669718488_hamza.png', 'dfs', 'secouer', '', NULL, NULL, 'yes', NULL, NULL, 10, 18, 52, 10),
(39, 'je suis un meuble', '1669719417_fondBrique.png', 'qui ressemble à un fond de brique', 'regarder', '', NULL, NULL, 'yes', NULL, NULL, 0, 14, 45, 11),
(40, 'popo', '1670410645_Capture d\'écran_20221114_200901.png', 'titi', 'fouiller', 'premier indice', NULL, NULL, 'yes', NULL, NULL, 0, 14, 54, 14),
(41, 'meuble 2', '1670489842_', 'je suis le second meuble', 'fouiller', '', NULL, NULL, 'yes', NULL, NULL, 0, 14, 54, 14),
(42, 'toto', NULL, 'toto', 'fouiller', 'pouet', NULL, NULL, 'no', NULL, NULL, NULL, 14, 54, 14),
(43, 'je suis le meuble de la salle 14', '1670490703_', ' meubles salle14', 'fouiller', 'trouve moi', NULL, NULL, 'yes', NULL, NULL, 0, 14, 54, 14),
(44, 'mon premier vrai meuble', '1670498900_', 'je suis le premier vrai meuble dans sa structure', 'fouiller', 'je suis un célèbre oiseau de dessin animé accompagné le plus généralement d\'un gros minet', NULL, NULL, 'yes', 'titi', 'pour la pièce \"voiture à toto\" ma solution est sa couleur', NULL, 14, 56, 15);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `objects`
--

INSERT INTO `objects` (`id`, `title`, `description`, `picture`, `user_id`, `script_id`) VALUES
(1, 'aze', 'aze', 'leo.png', 14, NULL),
(2, 'sdq', 'sdq', '', 14, NULL),
(3, 'sdq', 'sdq', 'karolos.png', 14, NULL),
(4, 'hghf', 'hghg', 'jorge.png', 14, NULL),
(5, 'aaaaa', 'hghg', 'natan.png', 14, NULL),
(9, 'qxxq', 'qxxq', '1669716017_natan.png', 18, 52),
(10, 'aaa', 'azerty', '1669718338_leo.png', 18, 52),
(11, 'sdq', 'sdq', '1670320621_natan.png', 14, 54);

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
  `start` tinyint(1) DEFAULT '0',
  `unlock_word` varchar(255) DEFAULT NULL,
  `clue` text,
  `clue2` text,
  `clue3` text,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users` (`user_id`),
  KEY `scripts` (`script_id`),
  KEY `script_id` (`script_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `description`, `picture`, `padlock`, `start`, `unlock_word`, `clue`, `clue2`, `clue3`, `user_id`, `script_id`) VALUES
(1, 'bnbn', 'bnvbnv', '', 'yes', 0, NULL, NULL, NULL, NULL, 14, 0),
(2, 'popo', 'popopo', 'convention.jpg', 'yes', 0, NULL, NULL, NULL, NULL, 14, 0),
(3, 'popopo', 'popopo', 'jorge.png', 'no', 0, NULL, NULL, NULL, NULL, 14, 0),
(4, 'opiuopuipoiu', 'jkghjkghjkhgjhg', 'jorge.png', 'no', 0, NULL, NULL, NULL, NULL, 14, 0),
(5, 'scqcsq', 'hgjjjjjjjjjjjjjjjjjjjjj', 'pauline.png', 'no', 0, NULL, NULL, NULL, NULL, 14, 0),
(6, 'ghfd', 'sdsdsd', '', 'yes', 0, NULL, NULL, NULL, NULL, 14, 43),
(7, 'hgf', 'hgfgh', '', 'no', 0, NULL, NULL, NULL, NULL, 14, 42),
(8, 'ghfd22', 'ghfdg', '', 'no', 0, NULL, NULL, NULL, NULL, 14, 42),
(9, 'rte', 'rte', '', 'yes', 0, NULL, NULL, NULL, NULL, 14, 44),
(10, 'ghfd', 'ghdf', '1669714253_jorge.png', 'yes', 0, NULL, NULL, NULL, NULL, 18, 52),
(11, 'salle de départ', 'rte', '1670336925_for_who.png', 'no', 0, NULL, NULL, NULL, NULL, 14, 45),
(12, 'salle 3', 'un deux un deux', '1669725936_chris.png', 'yes', 0, NULL, NULL, NULL, NULL, 14, 54),
(13, 'salle 2', 'azert', '1669727042_julien.png', 'yes', 0, NULL, NULL, NULL, NULL, 14, 54),
(14, 'salle 1', 'rtez', '1669729362_antoine.png', 'no', 1, NULL, NULL, NULL, NULL, 14, 54),
(15, 'première salle', 'je suis la première salle', '1670497769_chris.png', 'no', 1, 'toto', 'je suis le nom d\'un célèbre personnage de blague', NULL, NULL, 14, 56);

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
  `duration` int(11) NOT NULL DEFAULT '60',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `scripts`
--

INSERT INTO `scripts` (`id`, `title`, `difficulty`, `description`, `winner_msg`, `lost_msg`, `picture`, `duration`, `user_id`) VALUES
(45, 'tata', 4, 'La tante trop gentille', 'vous avez vaincu la tante', 'la tante vous a enfermé dans une tente', 'antoine.png', 60, 14),
(49, 'scénario de toto', 5, 'toto part en voiture mais ne sait plus où elle est, aide le à la retrouver', 'Bravo vous avez trouvé la voiture de Toto', 'Dommage la voiture de Toto est perdue à tout jamais', 'vincent.png', 60, 18),
(50, 'bug id', 1, 'bug', 'bug', 'bug', 'julien.png', 60, 14),
(52, 'gg', 1, 'fdgh', 'fdghd', 'ghdf', 'bernard.png', 60, 18),
(54, 'sdqsd', 1, 'sdqsd', 'qsdqs', 'dqsdq', '1669727206_tiana.png', 60, 14),
(55, 'ml', 1, 'kljh', 'jklh', 'kljh', '1669713069_', 60, 13),
(56, 'popo', 1, 'popo s\'en va tester des forms', 'bravo popo', 't\'es nul popo', '1670316706_chris.png', 60, 14);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(13, 'test', 'toto@toto.com', '$2y$10$9/ZqiBv3t1hmjw7poJl0Ou2AjSeRBiozVRxyroyYAZd0Z44RGbyES', 1),
(14, 'alain', 'test@test.com', '$2y$10$ynWz9L88hlcb1W1IoFVzLuGwuhNwZb6GOVZJxGULWkLDNs0lmaLg.', 1),
(17, 'popo', 'aaa@toto.com', '$2y$10$btYb/QrexNFPNTn/qUJ5SeFD0MwfwnuvQ/YWFM8qD3Asvm4MxHmn6', 1),
(18, 'toto', 'toto@tata.com', '$2y$10$bSKol5vM9Zkb2GL4mkp5rOmBZBhEW2CFjhvl1PhW5LhQ218r6J652', 1),
(20, 'azerty', 'azert@gmail.com', '$2y$10$bqmIkoir/nC//HmlVs1bq.8Fcb9xkzzSc1gY2CV2aWbO1Vom8IM/m', 1),
(21, 'aqwzsx', 'azertyuiop@azert.com', '$2y$10$k4CIZsB.x1MwU/KHrAB8B.g43ZA3j9GufIVXJhFVmL/BmV4ggHxPC', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `furnitures`
--
ALTER TABLE `furnitures`
  ADD CONSTRAINT `furnitures_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `furnitures_ibfk_4` FOREIGN KEY (`script_id`) REFERENCES `scripts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `furnitures_ibfk_5` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `interactions`
--
ALTER TABLE `interactions`
  ADD CONSTRAINT `interactions_ibfk_1` FOREIGN KEY (`furniture_id`) REFERENCES `furnitures` (`id`),
  ADD CONSTRAINT `interactions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `interactions_ibfk_3` FOREIGN KEY (`script_id`) REFERENCES `scripts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `scripts`
--
ALTER TABLE `scripts`
  ADD CONSTRAINT `scripts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
