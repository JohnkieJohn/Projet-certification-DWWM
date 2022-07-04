-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 juin 2022 à 07:33
-- Version du serveur : 8.0.27
-- Version de PHP : 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bon_de_commande`
--

-- --------------------------------------------------------

--
-- Structure de la table `article_infos`
--

DROP TABLE IF EXISTS `article_infos`;
CREATE TABLE IF NOT EXISTS `article_infos` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `article_nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `article_ref` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `article_prix` int NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article_infos`
--

INSERT INTO `article_infos` (`id_article`, `article_nom`, `article_ref`, `article_prix`) VALUES
(9, 'nokia', 'NKA405', 450),
(8, 'samsung', 'SMG416', 700),
(5, 'iphone', 'IPH300', 850),
(10, 'huawei', 'HWI690', 310);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `user_id_` int NOT NULL,
  `total` int NOT NULL,
  `commande_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_commande`),
  KEY `user_id_` (`user_id_`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `user_id_`, `total`, `commande_date`) VALUES
(4, 1, 2820, '2022-05-30 17:09:42'),
(5, 1, 1070, '2022-05-30 20:25:23'),
(8, 7, 3250, '2022-06-08 23:52:22'),
(9, 7, 1440, '2022-06-08 23:55:23'),
(10, 7, 2200, '2022-06-12 14:36:58'),
(11, 7, 3000, '2022-06-12 14:43:58'),
(12, 7, 2100, '2022-06-12 14:45:33'),
(13, 7, 2280, '2022-06-12 14:46:44'),
(14, 7, 1810, '2022-06-12 14:47:48'),
(15, 7, 1660, '2022-06-12 14:49:00'),
(16, 7, 2170, '2022-06-12 15:41:35');

-- --------------------------------------------------------

--
-- Structure de la table `commande_details`
--

DROP TABLE IF EXISTS `commande_details`;
CREATE TABLE IF NOT EXISTS `commande_details` (
  `commande_id` int NOT NULL,
  `commande_ligne` int NOT NULL,
  `article_ref` varchar(50) NOT NULL,
  `quantite` int NOT NULL,
  KEY `commande_id` (`commande_id`),
  KEY `article_ref` (`article_ref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commande_details`
--

INSERT INTO `commande_details` (`commande_id`, `commande_ligne`, `article_ref`, `quantite`) VALUES
(4, 1, 'IPH300', 1),
(4, 2, 'HWI690', 2),
(4, 3, 'NKA405', 3),
(5, 1, 'NKA405', 1),
(5, 2, 'HWI690', 2),
(8, 3, 'IPH300', 2),
(8, 2, 'HNR150', 1),
(8, 1, 'NKA405', 3),
(9, 1, 'HNR150', 1),
(9, 2, 'HWI690', 4),
(8, 1, 'SMG416', 2),
(9, 1, 'SMG416', 2),
(10, 1, 'SMG416', 2),
(8, 2, 'HNR150', 4),
(9, 2, 'HNR150', 4),
(10, 2, 'HNR150', 4),
(8, 1, 'IPH300', 3),
(8, 2, 'NKA405', 1),
(8, 1, 'IPH300', 2),
(8, 2, 'HNR150', 2),
(13, 1, 'HWI690', 3),
(13, 2, 'NKA405', 3),
(14, 1, 'NKA405', 1),
(14, 2, 'HNR150', 1),
(14, 3, 'IPH300', 1),
(14, 4, 'HWI690', 1),
(15, 1, 'NKA405', 1),
(15, 2, 'HNR150', 1),
(15, 3, 'HWI690', 1),
(15, 4, 'SMG416', 1),
(16, 1, 'HWI690', 7);

-- --------------------------------------------------------

--
-- Structure de la table `users_infos`
--

DROP TABLE IF EXISTS `users_infos`;
CREATE TABLE IF NOT EXISTS `users_infos` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `user_login` varchar(20) NOT NULL,
  `user_prenom` varchar(50) NOT NULL,
  `user_nom` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mdp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users_infos`
--

INSERT INTO `users_infos` (`id_user`, `user_login`, `user_prenom`, `user_nom`, `user_email`, `user_mdp`) VALUES
(1, 'John', 'Jonathan', 'Douis', 'myemail@free.fr', 'huhuhu'),
(2, 'Kali', 'Carla', 'Doe', 'mymail@free.fr', 'huhuhu'),
(3, 'Bob', 'Bobby', 'Doe', 'myemail@sfr.fr', 'huhuhu'),
(6, 'Gégé', 'Gérard', 'Vaillant', 'mail@mail.fr', '$2y$10$owqQRgJdcGnXZUTDXCicJOLf5hxN5L80NjnWBtG/dYajER03UKRLu'),
(7, 'John06', 'Jonathan', 'Douis', 'my@mymail.fr', '$2y$10$cR6KKmwBD.pYBcstsfi.3eQZH8cIuo9Bs0NSs2zU7AVK3ypHdbxFq'),
(8, 'JohnDev', 'John', 'Douis', 'mailmail@mymail.fr', '$2y$10$DuxJlzPlBYvQxVDSYUJh4eRlOhoWHDUKPzBoHVyc.rcGKZar8RFKi');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
