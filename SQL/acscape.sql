-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 06 jan. 2023 à 13:35
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `furnitures`
--

INSERT INTO `furnitures` (`id`, `title`, `picture`, `description`, `action`, `clue`, `clue2`, `clue3`, `padlock`, `unlock_word`, `reward`, `object_id`, `user_id`, `script_id`, `room_id`) VALUES
(47, 'éprouvette', '1672759797_eprouvette.jpg', 'une éprouvette est posé sur son bureau, on dirait qu\'elle contient quelque chose, mais un verrou empêche de voir ce que c\'est.\r\nApparemment il s\'en sert pour des travaux qui portent son nom.', 'examiner', 'c\'est un procédé de conservation des aliments', 'a commencé ses travaux sur la stabilisation des vins au 19e siècle', 'autre nom de la débactérisation thermocontrôlée', 'yes', 'pasteurisation', 'Les températures de pasteurisation commence à 62 \r\nHum que faire de cette information, peut-être devrais je la noter quelques part.', NULL, 32, 57, 22),
(48, 'bière', '1672760715_biere.jpg', 'Un verre de bière est posé sur le bureau, je devrais l\'examiner de plus prêt, mince un couvercle avec des lettres dans le désordre et certaines effacées ferme le verre et empêche de déguster ce précieux nectar.\r\n\r\nOn peut y apercevoir : OHNBO, qu\'est ce que ça peut bien vouloir dire, on dirait un ingrédient.\r\n', 'boire', 'plante grimpante', 'la lettre manquante est le \"U\"', 'le mot commence par Ho*****', 'yes', 'houblon', 'pour avoir trouvé le houblon, un chiffre apparaît et vous pouvez enfin déguster la bière, enfin personne ne sait depuis combien de temps elle est ici...\r\n\r\nCe chiffre est : 1602', NULL, 32, 57, 22),
(49, 'hiéroglyphe', '1672998806_hieroglyphe.jpg', 'Vous trouvez devant vous des hiéroglyphes, ils sont surement utiles pour quitter cette pièce.\r\nPlus loin dans la pièce vous apercevez plusieurs dessins mis en valeurs, un serpent, un oiseau et une jambe.\r\nSerait-ce un indice\r\n', 'examiner', 'Il y a des lettres qui me sont familières au dessus des hiéroglyphes', 'et si les associés était la solution', NULL, 'yes', 'jab', 'vous avez déchiffrez les hiéroglyphes, vous avez un sentiment étrange qui vous fait penser à la nature. Que signifie t\'il ? Serait-ce la couleur ?', NULL, 32, 58, 25);

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
(5, 'aaaaa', 'hghg', 'natan.png', 14, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_recover`
--

DROP TABLE IF EXISTS `password_recover`;
CREATE TABLE IF NOT EXISTS `password_recover` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token_user` varchar(64) NOT NULL,
  `token` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

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
  `n_room` tinyint(4) DEFAULT NULL,
  `unlock_word` varchar(255) DEFAULT NULL,
  `clue` text,
  `clue2` text,
  `clue3` text,
  `reward` text,
  `user_id` int(11) NOT NULL,
  `script_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users` (`user_id`),
  KEY `scripts` (`script_id`),
  KEY `script_id` (`script_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `description`, `picture`, `padlock`, `n_room`, `unlock_word`, `clue`, `clue2`, `clue3`, `reward`, `user_id`, `script_id`) VALUES
(22, 'Le Laboratoire de Louis Pasteur', 'Vous êtes coincé à l\'intérieur du labo de Louis Pasteur, il va falloir trouvé des indices pour ouvrir la porte bloquée par un étrange mécanisme.', '1672758477_bureau.jpg', 'no', 1, '', '', NULL, NULL, '', 32, 57),
(23, 'Le Laboratoire de Louis Pasteur', 'Pensant être sortie du bureau de Louis Pasteur, vous voilà de nouveaux coincé dans cette salle, il y a surement des choses à fouiller.\r\nVous êtes dans un labo de Chimie, ', '1672758843_pasteur.jpg', 'yes', 2, '1664', 'marque de bière', 'addition', 'et si je faisais la somme de ce que m\'ont appris les indices.', 'youpi c\'était ça, mais vous voilà à nouveau dans une pièce fermée, diantre.\r\n', 32, 57),
(25, 'tombeau', 'vous vous trouvez dans le tombeau du Pharaon. La pièce est sombre et silencieuse, et vous êtes entouré de statues de dieux et de sarcophages en pierre. Vous sentez une présence oppressante dans l\'air, comme si les esprits des morts veillaient sur vous. Vous devez trouver un moyen de sortir de cette pièce avant qu\'il ne soit trop tard.\r\n\r\nVous inspectez les alentours et vous remarquez plusieurs objets étranges : une grande plaque de pierre gravée de hiéroglyphes, un vase en forme de tête de lion, et une étagère couverte de jarres et de pots en terre cuite. Vous pouvez également entendre un faible grondement qui semble provenir de derrière l\'une des statues.\r\n\r\nIl y a une porte en bois qui mène vers une autre pièce, mais elle est verrouillée. Pour la déverrouiller, vous devrez résoudre l\'énigme cachée dans cette pièce. Faites attention, car il ne vous reste que peu de temps avant que les gardiens ne reviennent', '1672995606_tombeau.jpg', 'yes', 1, '', '', NULL, NULL, '', 32, 58),
(26, 'Le Labyrinthe de la Tombe', 'Un étrange mécanisme est gravé sur la porte, on dirait un labyrinthe.\r\nDes chemins de couleurs différentes sont déjà tracés, lequel prendre ?\r\nEst-ce la solution pour déverrouiller cette porte ?', '1672996865_labyrinthe.jpg', 'yes', 2, 'chlorophylle', 'la solution semble être la couleur, mais quelque chose ne va pas', 'ce vert est d\'une couleur naturel ', 'serait-ce le vert de la nature ? Mais d\'où vient-t\'il déjà, comment est-il fabriqué ?', 'Vous venez de pénétrer dans le Labyrinthe de la Tombe, une pièce sombre et sinueuse remplie de couloirs et de passages secrets. Le sol est couvert de poussière et de débris, et vous avez l\'impression de vous enfoncer de plus en plus profondément dans les entrailles de la pyramide, mais grâce à votre perspicacité, vous avez trouvé la sortie\r\n\r\nVous avancez avec prudence, attentif aux pièges qui pourraient se cacher dans les ombres. Les murs sont couverts de hiéroglyphes et de fresques qui racontent l\'histoire du Pharaon et de ses exploits. \r\n\r\nSoudain, vous entendez un grondement qui semble provenir de la salle suivante. Vous hésitez un instant, puis vous prenez votre courage à deux mains et vous avancez vers la porte verrouillée. Pour la déverrouiller, vous devrez résoudre l\'énigme cachée dans cette pièce.', 32, 58),
(27, 'la sortie', 'Vous voilà face à la dernière porte, arriverez vous enfin à sortir de cette pyramide ?\r\nRien n\'est moins sûr.\r\nOn dirait qu\'il y avait quelque chose avant cette pyramide, comme si elle avait été construite par dessus une ancienne structure.\r\nSerait-ce une sépulture des souverains de l\'ancien empire égyptien\r\n\r\n', '1673000469_Mastaba.jpg', 'yes', 3, 'mastaba', 'nom des anciennes sépultures', ' édifice funéraire égyptien servant de sépulture aux rois des deux premières dynasties', NULL, 'bravo', 32, 58);

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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `scripts`
--

INSERT INTO `scripts` (`id`, `title`, `difficulty`, `description`, `winner_msg`, `lost_msg`, `picture`, `duration`, `user_id`) VALUES
(57, 'Le Laboratoire de Louis Pasteur', 3, 'Vous êtes un groupe de scientifiques qui avez été invités à visiter le célèbre laboratoire de Louis Pasteur. Cependant, lorsque vous arrivez, vous découvrez que le laboratoire est verrouillé et que vous êtes coincés à l\'intérieur! Vous devez maintenant résoudre les énigmes et trouver les mots de passe cachés dans le laboratoire pour vous échapper avant que le temps ne s\'écoule', 'Bravo, vous avez permis aux scientifiques d\'accomplir leur mission, grâce à vous, le monde est sauvé', 'Dommage, vous n\'avez pas pu libérer les scientifiques à temps, le virus va se propager et éliminer toute vie sur terre.', '1672756200_pasteur.jpg', 60, 32),
(58, 'échapper à la tombe du Pharaon', 3, 'Vous êtes un archéologue qui a réussi à pénétrer dans la tombe du Pharaon, mais vous vous êtes fait surprendre par des gardiens qui ont verrouillé les portes derrière vous. Vous devez maintenant trouver un moyen de sortir avant qu\'il ne soit trop tard. Explorez les différentes pièces et résolvez les énigmes pour déverrouiller les portes et vous échapper de la tombe.', 'Bravo vous avez réussi à vous échapper ! ', 'Vous avez succomber aux pièges de la pyramide.', '1672995121_scriptBg.jpg', 60, 32);

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
  `token` text,
  `role` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `token`, `role`, `created_at`) VALUES
(13, 'test', 'toto@toto.com', '$2y$10$9/ZqiBv3t1hmjw7poJl0Ou2AjSeRBiozVRxyroyYAZd0Z44RGbyES', NULL, 1, '2023-01-02 15:25:14'),
(14, 'alain', 'test@test.com', '$2y$10$ynWz9L88hlcb1W1IoFVzLuGwuhNwZb6GOVZJxGULWkLDNs0lmaLg.', NULL, 1, '2023-01-02 15:25:14'),
(18, 'toto', 'toto@tata.com', '$2y$10$bSKol5vM9Zkb2GL4mkp5rOmBZBhEW2CFjhvl1PhW5LhQ218r6J652', '08f70c85349c7e1ba955b03688f7d80e8e01c534d5cb1426e9a51c1', 1, '2023-01-02 15:25:14'),
(30, 'token', 'aaaa@jjj.com', '$2y$10$FVfMeM.PycvmHIgRsag5y.1A5K2hZu4hMnEGjiDLDZgJu5DlOKUba', '4fc5f3b5b206a2ac5006e7b98218050b869ee9a9cf9162d8', 1, '2023-01-02 15:25:14'),
(32, 'gamerbike', 'champidub@gmail.com', '$2y$10$V9cq.lcX7QZWXDiTvmq22OtT5J1E8UcJ1F6m2XxDYMlj7m9tio94a', '15aff1fd0d47872fda64cc0895400b1bdea72dde1319af81906193ddead8abc0', 1, '2023-01-03 14:23:58');

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
