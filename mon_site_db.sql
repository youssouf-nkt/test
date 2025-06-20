-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 20 juin 2025 à 15:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mon_site_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_soumission` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `email`, `objet`, `message`, `date_soumission`) VALUES
(1, 't', 'youyoucamara40@gmail.com', 'Proposition de stage', 'youyou', '2025-06-20 12:44:11'),
(2, 'youyou', 'youyoucamara40@gmail.com', 'Autre', 'La sociologie est une discipline des sciences sociales qui a pour objectif de rechercher des explications et des compréhensions typiquement sociales, et non pas mentales ou biophysiques, à des phénomènes observables. La sociologie étudie les relations sociales qui produisent par exemple, selon les approches : des pratiques, des faits sociaux, des interactions, des identités sociales, des institutions sociales, des organisations, des réseaux, des cultures, des classes sociales, des normes sociales, des conflits ou des controverses ainsi que de toutes ces entités qui n\'ont pas d\'explications purement biophysiques et qui sont produites par les individus et groupes sociaux. Une explication sociologique est vue comme le produit d\'une démarche scientifique, afin de rendre compte, expliquer', '2025-06-20 12:45:54'),
(3, 'rr', 'youyoucamara40@gmail.com', 'Demande d\'informations', 'yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy', '2025-06-20 14:24:05'),
(4, 'youssouf', 'youyoucamara40@gmail.com', 'Support technique', 'aaa', '2025-06-20 14:54:34');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
