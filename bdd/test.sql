-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 juin 2024 à 12:25
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
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$bZ9RGp42purcVGpU3CaQjeJ61TSxG/WdRCzDJE0dA2N1xKs2kMh/O');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_stock` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_stock` (`id_stock`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `author`, `date`, `content`, `id_stock`) VALUES
(1, 'Jordan', '2024-04-12 13:44:47', 'bonjour', 1),
(2, 'Jordan', '2024-04-19 14:50:17', 'test', 1),
(3, 'Jordan', '2024-06-07 12:53:37', 'test', 2),
(4, 'Jordan', '2024-06-07 13:07:53', 'test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `title`, `date`, `description`, `image`) VALUES
(1, 'titre 1', '2024-04-02', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam non porta urna. Mauris eleifend turpis eu mauris interdum cursus. In aliquam viverra neque, ut placerat diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet dictum diam. Quisque facilisis nec eros vel consequat. Suspendisse id velit leo. Sed tellus odio, suscipit scelerisque nulla id, sollicitudin pretium velit.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nSed feugiat bibendum neque id facilisis. Pellentesque vitae egestas mi. Quisque malesuada metus sit amet lobortis viverra. Aliquam erat volutpat. Aenean blandit elit eu quam vestibulum faucibus. Suspendisse maximus mollis dui, sit amet interdum mauris volutpat eget. Nam sit amet dolor hendrerit, ultricies leo non, condimentum lorem. Aliquam in nisi luctus, lacinia orci laoreet, dapibus lorem. Donec vulputate ac elit eu varius. Nullam a cursus arcu, sed finibus lorem. Sed justo quam, tempor sed orci sit amet, placerat fringilla nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. ', 'image1.jpg'),
(2, 'titre 2', '2024-04-03', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam non porta urna. Mauris eleifend turpis eu mauris interdum cursus. In aliquam viverra neque, ut placerat diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet dictum diam. Quisque facilisis nec eros vel consequat. Suspendisse id velit leo. Sed tellus odio, suscipit scelerisque nulla id, sollicitudin pretium velit.\r\n\r\nSed feugiat bibendum neque id facilisis. Pellentesque vitae egestas mi. Quisque malesuada metus sit amet lobortis viverra. Aliquam erat volutpat. Aenean blandit elit eu quam vestibulum faucibus. Suspendisse maximus mollis dui, sit amet interdum mauris volutpat eget. Nam sit amet dolor hendrerit, ultricies leo non, condimentum lorem. Aliquam in nisi luctus, lacinia orci laoreet, dapibus lorem. Donec vulputate ac elit eu varius. Nullam a cursus arcu, sed finibus lorem. Sed justo quam, tempor sed orci sit amet, placerat fringilla nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. ', 'image2.jpg'),
(5, 'titre 3', '2024-06-13', 'test', 'test.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
