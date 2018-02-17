-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 fév. 2018 à 16:03
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movies` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `actors` varchar(250) NOT NULL,
  `director` varchar(250) NOT NULL,
  `producer` varchar(250) NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(100) NOT NULL,
  `category` enum('policier','science fiction','horreur','enfants') NOT NULL,
  `storyline` text NOT NULL,
  `video` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movies`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(106, 'les dents de la mer', 'olivier', 'spielberg', 'spielberg', 1982, 'francais', 'horreur', 'A quelques jours du début de la saison estivale, les habitants de la petite station balnéaire d\'Amity sont mis en émoi par la découverte sur le littoral du corps atrocement mutilé d\'une jeune vacancière. Pour Martin Brody, le chef de la police, il ne fait aucun doute que la jeune fille a été victime d\'un requin. Il décide alors d\'interdire l\'accès des plages mais se heurte à l\'hostilité du maire uniquement intéressé par l\'afflux des touristes. Pendant ce temps, le requin continue à semer la terreur le long des côtes et à dévorer les baigneurs', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movies`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
