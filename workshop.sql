-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 10 sep. 2018 à 12:40
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `workshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'restauration', ''),
(2, 'Logement', 'Se loger'),
(3, 'Sortir', 'Soirées étudiantes'),
(9, 'Bon Plan', '');

-- --------------------------------------------------------

--
-- Structure de la table `confirmation`
--

DROP TABLE IF EXISTS `confirmation`;
CREATE TABLE IF NOT EXISTS `confirmation` (
  `pseudo_user` varchar(255) NOT NULL,
  `image_cni` varchar(255) NOT NULL,
  `approbation` char(1) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`pseudo_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `confirmation`
--

INSERT INTO `confirmation` (`pseudo_user`, `image_cni`, `approbation`, `commentaire`) VALUES
('Myzal', '1.png', '0', ''),
('Pranks', '13.png', '2', '');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
CREATE TABLE IF NOT EXISTS `conversation` (
  `idConversation` int(11) NOT NULL AUTO_INCREMENT,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  PRIMARY KEY (`idConversation`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversation`
--

INSERT INTO `conversation` (`idConversation`, `user1`, `user2`) VALUES
(1, 1, 10),
(2, 14, 1),
(3, 1, 17),
(7, 1, 16),
(6, 1, 13),
(8, 13, 13),
(9, 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `echange`
--

DROP TABLE IF EXISTS `echange`;
CREATE TABLE IF NOT EXISTS `echange` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyGiver` varchar(255) NOT NULL,
  `pseudo_taker` varchar(255) NOT NULL,
  `pseudo_giver` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `state` int(11) DEFAULT '0',
  `idObject` int(11) NOT NULL,
  `lastRevive` timestamp NULL DEFAULT NULL,
  `totalRevives` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `echange`
--

INSERT INTO `echange` (`id`, `keyGiver`, `pseudo_taker`, `pseudo_giver`, `date`, `state`, `idObject`, `lastRevive`, `totalRevives`) VALUES
(25, 'f897570e', 'Vodka', 'Myzal', '2018-06-25 10:48:44', 1, 9, '2018-07-03 18:30:45', 7),
(24, 'b07eb98688', 'Myzal', 'Pranks', '2018-06-30 10:48:44', 1, 2, NULL, 0),
(27, 'b7f4c82db4', 'Pranks', 'Myzal', '2018-07-01 13:04:31', 2, 1, NULL, 0),
(28, '108aeeed', 'Camilleon', 'Myzal', '2018-07-01 14:04:56', 3, 18, NULL, 0),
(30, '492fd6295b', 'Vodka', 'Myzal', '2018-07-03 18:38:02', 0, 22, NULL, 0),
(31, '36330b9b', 'Pranks', 'Myzal', '2018-07-03 18:38:40', 0, 19, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conversation` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `dateHour` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `conversation`, `message`, `sender`, `dateHour`) VALUES
(1, 1, 'Yo mon bro', 1, '2018-05-30 08:03:39'),
(2, 1, 'yo ! comment ça va toi ?', 10, '2018-05-30 08:11:05'),
(3, 1, 'Nickel et toi ?', 1, '2018-05-30 08:11:12'),
(4, 1, 'Ca va ca va', 10, '2018-05-30 08:11:17'),
(5, 2, 'Hey salut ! ', 1, '2018-05-30 08:11:46'),
(6, 2, 'Salut ! Ca va?', 14, '2018-05-30 08:11:56'),
(7, 1, 'Quoi de beau ?', 1, '2018-05-30 11:30:34'),
(8, 1, 'T\'es là ? ', 1, '2018-05-30 11:30:34'),
(9, 1, 'Lalala', 1, '2018-05-30 11:30:34'),
(10, 1, 'Lalala', 1, '2018-05-30 11:30:34'),
(11, 1, 'Test', 1, '2018-05-30 11:30:34'),
(12, 1, 'Test', 10, '2018-05-30 12:11:17'),
(13, 1, 'Test', 10, '2018-05-30 08:11:17'),
(14, 1, 'Test', 10, '2018-05-30 08:11:17'),
(15, 1, 'Test', 10, '2018-05-30 08:11:17'),
(16, 3, 'test', 1, '2018-05-30 12:39:21'),
(17, 3, 'test', 17, '2018-05-30 12:39:29'),
(18, 2, 'Lalala', 1, '2018-05-30 12:39:59'),
(19, 2, 'Salut frère', 1, '2018-05-30 12:46:20'),
(20, 2, 'Hey ! ', 1, '2018-05-30 12:47:52'),
(21, 2, 'Hey ! ', 1, '2018-05-30 12:47:55'),
(22, 2, 'Coucou', 1, '2018-05-30 12:48:09'),
(23, 3, 'Hello', 1, '2018-05-30 12:48:17'),
(35, 1, 'Retest', 10, '2018-06-12 16:39:02'),
(34, 1, 'Test', 1, '2018-06-12 16:38:33'),
(31, 1, 'Mdrrrr', 1, '2018-05-30 14:40:16'),
(32, 1, 'Tranquille sinon ? ', 1, '2018-05-30 14:40:22'),
(33, 1, 'Tranquille sinon ? ', 1, '2018-05-30 14:41:09'),
(36, 6, 'test', 1, '2018-07-01 18:26:30'),
(37, 6, 'Lourd', 1, '2018-07-01 18:26:41'),
(38, 7, 'Test', 1, '2018-07-01 18:27:01'),
(39, 8, 'Test', 13, '2018-07-01 18:28:03'),
(40, 1, 'Salut ! ', 1, '2018-07-03 08:46:42'),
(41, 9, 'Test', 1, '2018-07-03 08:46:50'),
(42, 9, 'Hey ', 1, '2018-07-03 08:46:54'),
(43, 9, 'Salut ! ', 15, '2018-07-03 08:47:16');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_objet` varchar(50) NOT NULL,
  `approbation` char(1) NOT NULL,
  `description` text NOT NULL,
  `dateHeure` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateDisponibilite` date NOT NULL,
  `pseudo_user` varchar(255) NOT NULL,
  `categorie` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `lent` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom_objet`, `approbation`, `description`, `dateHeure`, `dateDisponibilite`, `pseudo_user`, `categorie`, `type`, `lent`) VALUES
(18, 'Bob de Lorenzo', '1', 'Authentique bob de Lorenzo qualité mashallah', '2018-07-01 11:57:39', '2018-07-02', 'Myzal', 9, 'pret', 1),
(2, 'Armoire', '1', 'Armoire IKEA sur roulettes', '2018-05-17 08:00:00', '2018-03-27', 'Pranks', 9, 'pret', 1),
(9, 'Call Of Duty - Black Ops 2', '1', 'Jeu PS4 call of duty black ops 2', '2018-05-18 12:17:56', '2018-05-18', 'Myzal', 9, 'pret', 1),
(15, 'Le php pour les nuls', '1', 'Pratique pour apprendre en s\'amusant', '2018-06-05 10:06:13', '2018-06-05', 'Pranks', 9, 'pret', 0),
(1, 'Perceuse', '1', 'Je prête une perceuse sur demande', '2018-03-26 09:05:00', '2018-03-27', 'Myzal', 9, 'pret', 1),
(19, 'Pioche', '1', 'Pioche classique a deux têtes', '2018-07-01 14:03:33', '2018-07-02', 'Myzal', 9, 'pret', 1),
(20, 'Vidéo projecteur ACER', '0', '', '2018-07-01 17:06:22', '2018-07-02', 'Myzal', 9, 'pret', 0),
(21, 'Ballon de basket', '1', 'Taille 5', '2018-07-03 10:43:58', '2018-07-03', 'Vodka', 9, 'pret', 0),
(22, 'Langage C ', '1', '', '2018-07-03 18:15:56', '2018-07-03', 'Myzal', 9, 'pret', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` char(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `role` char(1) NOT NULL DEFAULT '0',
  `dateInscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastUpdate` timestamp NULL DEFAULT NULL,
  `country` char(2) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '200',
  `validationKey` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `gender`, `email`, `nom`, `prenom`, `password`, `date_naissance`, `pseudo`, `role`, `dateInscription`, `lastUpdate`, `country`, `ville`, `score`, `validationKey`) VALUES
(1, '0', 'maxime.lalo.pro@gmail.com', 'LALO', 'Maxime', '$2y$10$pzKPAZVHxllxw8aYK2QbSeYw6uU/CkeZ6HKEJdq2mWVhmZD4J2ISS', '1998-12-28', 'Myzal', '4', '2018-04-23 06:27:31', NULL, 'fr', 'Orry La Ville', 850, ''),
(10, '0', 'adrien.heffer@gmail.com', 'HEFFER', 'Adrien', '$2y$10$2TJitGySZ6WWkgXfkV5xPes0C/7Q5Pihy7CJDdritsmlnAhp0NjD.', '1998-12-28', 'Vodka', '3', '2018-04-23 06:59:41', NULL, 'fr', 'Montesson', 520, ''),
(13, '0', 'hugo91150@hotmail.fr', 'FREYNET', 'Hugo', '$2y$10$gIuK3urqEmb99qfUPmZRDeH6rpdlH2sL4LUKTdaMJqCBlQgzjK6Oq', '1998-12-28', 'Pranks', '2', '2018-07-03 08:28:18', NULL, 'fr', 'Massy', 200, '09183e1d81'),
(14, '1', 'camille.lecozler@gmail.com', 'LE COZLER', 'Camille', '$2y$10$xYjZdlPu63CgN4kICa8VhecdyalBVYHA8mpL0HQioTCvqPBi0LK2e', '1997-07-30', 'Camilleon', '1', '2018-04-23 07:11:30', NULL, 'fr', '', 400, ''),
(16, '0', 'peter.balivet@gmail.com', 'BALIVET', 'Peter', '$2y$10$3Q52N28qm45Xfh/K7bRSM.GRyTkW7pkVfq.OpS9TNtmbGjvJLff3C', '1999-04-14', 'MasterBigD', '0', '2018-04-23 10:10:12', NULL, 'fr', '', 200, ''),
(15, '1', 'celia.allaoua@gmail.com', 'ALLAOUA', 'Célia', '$2y$10$t./j1t3EL/YpA/PKW0dTK.I26Y3ISpX69frezx2JaelhugfuduYx2', '1998-12-28', 'Célou', '1', '2018-04-23 10:00:29', NULL, 'fr', '', 400, 'ababab'),
(17, '0', 'stephane.beauvois@gmail.com', 'BEAUVOIS', 'Stéphane', '$2y$10$0qB3mG8LYLsWYKx/G7tjV.xa9Kizvr2oIT.PeMXT8ykvuEePhlxrK', '1995-10-26', 'Stephano', '0', '2018-05-17 09:19:54', NULL, 'fr', 'Thiais', 200, ''),
(18, '0', 'aywayzminecraft@gmail.com', 'TEST', 'Test', '$2y$10$7NOxWIgyXlf.9ZJ4pSFAKuqbFW7t1mzbWIUvYvlUfU1itIBTYdaau', '1998-12-28', 'Test', '1', '2018-07-03 08:03:57', NULL, 'fr', 'test', 200, 'cc3b3c8b79'),
(20, '0', 'max281298@gmail.com', 'LALO', 'Maxime', '$2y$10$EWlgyjRUKGDak/VA42z0WOsrvSvorrsoNCEtbBy2uvA4Z9XGI5NgO', '1998-12-28', 'Maxime', '1', '2018-07-03 08:34:32', NULL, 'fr', 'Orry', 200, '060cbe3df8');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
