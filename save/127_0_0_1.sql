-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 avr. 2023 à 13:14
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mystock`
--
CREATE DATABASE IF NOT EXISTS `mystock` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mystock`;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `date`, `price`) VALUES
(1, 'Produit 1', ' Vivamus dignissim urna tellus, dignissim tristique ipsum bibendum vel. Aliquam tincidunt, ex ut dictum tempor, sem ex feugiat justo, at varius odio eros id neque. Nam eget enim facilisis, malesuada risus sed, gravida dui. Nunc vitae tellus sit amet turpis viverra molestie dignissim eu justo. Nulla facilisi. Nulla non ornare purus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\r\n\r\nVivamus laoreet leo nec dolor venenatis pharetra. Etiam eget justo diam. Sed rutrum sem eu sem porta cursus. Sed ut odio ultricies, rutrum nisi vitae, tincidunt nunc. Ut eget justo ac nulla consequat tincidunt. Donec semper pretium nisi vitae venenatis. Nunc efficitur ac elit ut hendrerit. Nam elementum mi eget consectetur vulputate. Fusce arcu arcu, malesuada vitae tempor id, posuere eget urna. ', '2023-04-07', '25.00'),
(2, 'Produit 2', ' Vivamus dignissim urna tellus, dignissim tristique ipsum bibendum vel. Aliquam tincidunt, ex ut dictum tempor, sem ex feugiat justo, at varius odio eros id neque. Nam eget enim facilisis, malesuada risus sed, gravida dui. Nunc vitae tellus sit amet turpis viverra molestie dignissim eu justo. Nulla facilisi. Nulla non ornare purus. Interdum et malesuada fames ac ante ipsum primis in faucibus.\r\n\r\nVivamus laoreet leo nec dolor venenatis pharetra. Etiam eget justo diam. Sed rutrum sem eu sem porta cursus. Sed ut odio ultricies, rutrum nisi vitae, tincidunt nunc. Ut eget justo ac nulla consequat tincidunt. Donec semper pretium nisi vitae venenatis. Nunc efficitur ac elit ut hendrerit. Nam elementum mi eget consectetur vulputate. Fusce arcu arcu, malesuada vitae tempor id, posuere eget urna. ', '2023-04-07', '30.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
