-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 22 jan. 2018 à 09:02
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.8

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
  `date_n` date NOT NULL,
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
  `no_licence` int(11) NOT NULL,
  `membre_ad71` tinyint(1) NOT NULL DEFAULT '0',
  `dojo` varchar(255) COLLATE utf8_bin NOT NULL,
  `certificat_med` varchar(255) COLLATE utf8_bin NOT NULL,
  `date_certificat` date NOT NULL,
  `attestation_sante` varchar(255) COLLATE utf8_bin NOT NULL,
  `autorisation_parent` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `autorisation_prelevement` varchar(255) COLLATE utf8_bin NOT NULL,
  `location_kimono` tinyint(1) NOT NULL DEFAULT '0',
  `no_passeport` int(11) NOT NULL,
  `categorie_age` int(3) NOT NULL,
  `categorie_poids` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des données sportives des adhérents';

-- --------------------------------------------------------

--
-- Structure de la table `fonctions_judo`
--

CREATE TABLE `fonctions_judo` (
  `no_adherent` bigint(20) UNSIGNED NOT NULL,
  `arbitre_f1` date DEFAULT NULL,
  `arbitre_f2` date DEFAULT NULL,
  `arbitre_f3` date DEFAULT NULL,
  `arbitre_f4` date DEFAULT NULL,
  `arbitre_f5A` date DEFAULT NULL,
  `arbitre_f5B` date DEFAULT NULL,
  `com_sportif_n1` date DEFAULT NULL,
  `com_sportif_n2` date DEFAULT NULL,
  `com_sportif_n3` date DEFAULT NULL,
  `com_sportif_n4` date DEFAULT NULL,
  `fonction_codep` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fonction_ligue_regionale` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fonction_autre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `recompense` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des fonctions de chaque adhérent';

-- --------------------------------------------------------

--
-- Structure de la table `grade`
--

CREATE TABLE `grade` (
  `no_adherent` bigint(20) UNSIGNED NOT NULL,
  `B` date NOT NULL,
  `B_J` date NOT NULL,
  `J` date NOT NULL,
  `J_O` date NOT NULL,
  `O` date NOT NULL,
  `O_V` date NOT NULL,
  `V` date NOT NULL,
  `V_Bl` date NOT NULL,
  `Bl` date NOT NULL,
  `M` date NOT NULL,
  `N_1` date NOT NULL,
  `N_2` date NOT NULL,
  `N_3` date NOT NULL,
  `N_4` date NOT NULL,
  `N_5` date NOT NULL,
  `N_6` date NOT NULL,
  `N_7` date NOT NULL,
  `N_8` date NOT NULL,
  `N_9` date NOT NULL,
  `N_10` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des données de grades des adhérents';

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `no_president` tinyint(1) UNSIGNED NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` text COLLATE utf8_bin NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='table des messages envoyés par les présidents au super admin';

-- --------------------------------------------------------

--
-- Structure de la table `president`
--

CREATE TABLE `president` (
  `no_adherent` bigint(20) UNSIGNED NOT NULL,
  `no_president` tinyint(4) NOT NULL,
  `dojo` varchar(255) COLLATE utf8_bin NOT NULL,
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `mot_de_passe` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `super_administrateur`
--

CREATE TABLE `super_administrateur` (
  `login` varchar(20) COLLATE utf8_bin NOT NULL,
  `mot_de_passe` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  ADD PRIMARY KEY (`no_licence`),
  ADD KEY `e_no_adh` (`no_adherent`);

--
-- Index pour la table `fonctions_judo`
--
ALTER TABLE `fonctions_judo`
  ADD KEY `e_numero_adherent` (`no_adherent`);

--
-- Index pour la table `grade`
--
ALTER TABLE `grade`
  ADD KEY `e_no_adherent` (`no_adherent`);

--
-- Index pour la table `president`
--
ALTER TABLE `president`
  ADD PRIMARY KEY (`no_president`),
  ADD KEY `no_adherent` (`no_adherent`);

--
-- Index pour la table `super_administrateur`
--
ALTER TABLE `super_administrateur`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherent_administratif`
--
ALTER TABLE `adherent_administratif`
  MODIFY `no_adherent` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `president`
--
ALTER TABLE `president`
  MODIFY `no_president` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent_sportif`
--
ALTER TABLE `adherent_sportif`
  ADD CONSTRAINT `e_no_adh` FOREIGN KEY (`no_adherent`) REFERENCES `adherent_administratif` (`no_adherent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fonctions_judo`
--
ALTER TABLE `fonctions_judo`
  ADD CONSTRAINT `e_numero_adherent` FOREIGN KEY (`no_adherent`) REFERENCES `adherent_administratif` (`no_adherent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `e_no_adherent` FOREIGN KEY (`no_adherent`) REFERENCES `adherent_administratif` (`no_adherent`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
