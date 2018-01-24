-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 24 jan. 2018 à 10:01
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `alliance_dojo_71`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherent_administratif`
--

CREATE TABLE `adherent_administratif` (
  `no_adherent` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `sexe` enum('M','F') COLLATE utf8_bin NOT NULL,
  `date_n` varchar(12) COLLATE utf8_bin NOT NULL,
  `lieu_n` varchar(255) COLLATE utf8_bin NOT NULL,
  `nationalite` varchar(2) COLLATE utf8_bin NOT NULL,
  `no_secu_sociale` bigint(15) NOT NULL,
  `adresse` varchar(255) COLLATE utf8_bin NOT NULL,
  `code_postal` int(5) NOT NULL,
  `ville` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel_f` int(10) NOT NULL,
  `tel_m_1` int(10) NOT NULL,
  `tel_m_2` int(10) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `newsletter` tinyint(1) NOT NULL,
  `photo` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des données administratives des adhérents';

-- --------------------------------------------------------

--
-- Structure de la table `adherent_sportif`
--

CREATE TABLE `adherent_sportif` (
  `no_adherent` bigint(20) UNSIGNED NOT NULL,
  `no_licence` varchar(255) COLLATE utf8_bin NOT NULL,
  `membre_ad71` tinyint(1) NOT NULL DEFAULT '0',
  `dojo` varchar(255) COLLATE utf8_bin NOT NULL,
  `certificat_med` varchar(255) COLLATE utf8_bin NOT NULL,
  `date_certificat` date NOT NULL,
  `attestation_sante` varchar(255) COLLATE utf8_bin NOT NULL,
  `autorisation_parent` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `autorisation_prelevement` varchar(255) COLLATE utf8_bin NOT NULL,
  `location_kimono` tinyint(1) NOT NULL DEFAULT '0',
  `no_passeport` int(11) NOT NULL,
  `categorie_age` varchar(255) COLLATE utf8_bin NOT NULL,
  `categorie_poids` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des données sportives des adhérents';

-- --------------------------------------------------------

--
-- Structure de la table `adherent_sportif_ceinture`
--

CREATE TABLE `adherent_sportif_ceinture` (
  `no_adherent` int(11) NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `adherent_sportif_fonctions_judo`
--

CREATE TABLE `adherent_sportif_fonctions_judo` (
  `no_adherent` int(11) NOT NULL,
  `fonction` varchar(255) NOT NULL,
  `date_obtention` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ceinture`
--

CREATE TABLE `ceinture` (
  `couleur` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fonctions_judo`
--

CREATE TABLE `fonctions_judo` (
  `id` int(11) NOT NULL,
  `fonction` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `president` varchar(20) COLLATE utf8_bin NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des messages envoyés par les présidents au super admin';

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `president`, `date_envoi`, `contenu`, `lu`) VALUES
(6, 'p1', '2018-01-24 08:55:11', 'test', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `mot_de_passe` text COLLATE utf8_bin NOT NULL,
  `club` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`login`, `mot_de_passe`, `club`) VALUES
('administrateur', '81dc9bdb52d04dc20036dbd8313ed055', 'aucun'),
('p1', '81dc9bdb52d04dc20036dbd8313ed055', '1');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent_administratif`
--
ALTER TABLE `adherent_administratif`
  ADD PRIMARY KEY (`no_adherent`);

--
-- Index pour la table `adherent_sportif`
--
ALTER TABLE `adherent_sportif`
  ADD PRIMARY KEY (`no_licence`);

--
-- Index pour la table `ceinture`
--
ALTER TABLE `ceinture`
  ADD PRIMARY KEY (`couleur`);

--
-- Index pour la table `fonctions_judo`
--
ALTER TABLE `fonctions_judo`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent_administratif`
--
ALTER TABLE `adherent_administratif`
  MODIFY `no_adherent` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `fonctions_judo`
--
ALTER TABLE `fonctions_judo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
