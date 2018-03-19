-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 16 fév. 2018 à 22:02
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
-- Base de données :  `finder_2018`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id_agc` int(7) NOT NULL,
  `nom_agc` varchar(30) NOT NULL,
  `localisation_agc` varchar(50) DEFAULT NULL,
  `latitde_agc` decimal(30,10) DEFAULT NULL,
  `longitude_agc` decimal(30,10) DEFAULT NULL,
  `nomPlan_agc` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `agence_pole`
--

CREATE TABLE `agence_pole` (
  `id_agc` int(7) NOT NULL,
  `id_pole` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `assistant`
--

CREATE TABLE `assistant` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bureau`
--

CREATE TABLE `bureau` (
  `id_bur` int(7) NOT NULL,
  `nom_bur` varchar(30) NOT NULL,
  `id_collabo` int(7) NOT NULL,
  `id_plan` int(7) DEFAULT NULL,
  `occupation_bur` varchar(3) DEFAULT NULL,
  `couloir_bur` varchar(10) DEFAULT NULL,
  `niveau_bur` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `collaborateur`
--

CREATE TABLE `collaborateur` (
  `id_collabo` int(6) NOT NULL,
  `nom_collabo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom_collabo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `emailPers_collabo` varchar(60) NOT NULL,
  `emailPro_collabo` varchar(60) NOT NULL,
  `mdp_collabo` varchar(100) NOT NULL,
  `statut_collabo` varchar(20) NOT NULL,
  `fonction_collabo` varchar(50) NOT NULL,
  `port_collabo` int(15) DEFAULT NULL,
  `tel_collabo` varchar(15) DEFAULT NULL,
  `adr_collabo` varchar(100) DEFAULT NULL,
  `questSecr_collabo` varchar(100) DEFAULT NULL,
  `repSecr_collabo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `collaborateur`
--

INSERT INTO `collaborateur` (`id_collabo`, `nom_collabo`, `prenom_collabo`, `emailPers_collabo`, `emailPro_collabo`, `mdp_collabo`, `statut_collabo`, `fonction_collabo`, `port_collabo`, `tel_collabo`, `adr_collabo`, `questSecr_collabo`, `repSecr_collabo`) VALUES
(1, 'Aw', 'Youssouf', 'tabsirou2016@gmail.com', 'youssouf.aw@finder.fr', 'youssouf123', 'admin', 'Développeur', 123456789, '0123456789', '3 square lamartine 78330 fontenay-le-fleury', 'meilleur ami', 'Moussa Hann');

-- --------------------------------------------------------

--
-- Structure de la table `collabo_projet`
--

CREATE TABLE `collabo_projet` (
  `id_collabo` int(7) NOT NULL,
  `id_proj` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commercial`
--

CREATE TABLE `commercial` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `directeur`
--

CREATE TABLE `directeur` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `directeur_projet`
--

CREATE TABLE `directeur_projet` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `directeur_projet`
--

INSERT INTO `directeur_projet` (`id_collabo`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `nom_etp` varchar(30) NOT NULL,
  `description_etp` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre_CA`
--

CREATE TABLE `membre_CA` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pdg`
--

CREATE TABLE `pdg` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `plan`
--

CREATE TABLE `plan` (
  `id_plan` int(7) NOT NULL,
  `nom_plan` varchar(30) NOT NULL,
  `toilettes` varchar(10) DEFAULT NULL,
  `bureaux_vides` varchar(10) DEFAULT NULL,
  `salles_pause` varchar(10) DEFAULT NULL,
  `salles_reunion` varchar(10) DEFAULT NULL,
  `cantines` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pole`
--

CREATE TABLE `pole` (
  `id_pole` int(7) NOT NULL,
  `nom_pole` varchar(30) NOT NULL,
  `desc_pole` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `president`
--

CREATE TABLE `president` (
  `id_collabo` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_proj` int(7) NOT NULL,
  `id_agc` int(7) NOT NULL,
  `id_pole` int(7) NOT NULL,
  `nom_proj` varchar(30) NOT NULL,
  `desc_proj` varchar(300) DEFAULT NULL,
  `dateDeb_proj` date NOT NULL,
  `dateFin_proj` date DEFAULT NULL,
  `effectif_proj` date DEFAULT NULL,
  `directeur_proj` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet_bureau`
--

CREATE TABLE `projet_bureau` (
  `id_proj` int(7) NOT NULL,
  `id_bur` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD UNIQUE KEY `fk_ad` (`id_collabo`) USING BTREE;

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id_agc`);

--
-- Index pour la table `agence_pole`
--
ALTER TABLE `agence_pole`
  ADD KEY `fk_id_agc` (`id_agc`),
  ADD KEY `fk_id_pole` (`id_pole`);

--
-- Index pour la table `assistant`
--
ALTER TABLE `assistant`
  ADD UNIQUE KEY `fk_ass` (`id_collabo`) USING BTREE;

--
-- Index pour la table `bureau`
--
ALTER TABLE `bureau`
  ADD PRIMARY KEY (`id_bur`),
  ADD UNIQUE KEY `fk_id_collabo2` (`id_collabo`),
  ADD UNIQUE KEY `fk_id_plan` (`id_plan`);

--
-- Index pour la table `collaborateur`
--
ALTER TABLE `collaborateur`
  ADD PRIMARY KEY (`id_collabo`) USING BTREE;

--
-- Index pour la table `collabo_projet`
--
ALTER TABLE `collabo_projet`
  ADD KEY `fk_id_collabo3` (`id_collabo`),
  ADD KEY `fk_id_proj` (`id_proj`);

--
-- Index pour la table `commercial`
--
ALTER TABLE `commercial`
  ADD UNIQUE KEY `pk_cm` (`id_collabo`) USING BTREE;

--
-- Index pour la table `directeur`
--
ALTER TABLE `directeur`
  ADD UNIQUE KEY `fk_dir` (`id_collabo`) USING BTREE;

--
-- Index pour la table `directeur_projet`
--
ALTER TABLE `directeur_projet`
  ADD UNIQUE KEY `fk_dp` (`id_collabo`) USING BTREE;

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`nom_etp`);

--
-- Index pour la table `membre_CA`
--
ALTER TABLE `membre_CA`
  ADD UNIQUE KEY `pk_mc` (`id_collabo`) USING BTREE;

--
-- Index pour la table `pdg`
--
ALTER TABLE `pdg`
  ADD UNIQUE KEY `fk_pdg` (`id_collabo`) USING BTREE;

--
-- Index pour la table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id_plan`);

--
-- Index pour la table `pole`
--
ALTER TABLE `pole`
  ADD PRIMARY KEY (`id_pole`);

--
-- Index pour la table `president`
--
ALTER TABLE `president`
  ADD UNIQUE KEY `fk_pr` (`id_collabo`) USING BTREE;

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_proj`),
  ADD UNIQUE KEY `fk_id_agc1` (`id_agc`),
  ADD UNIQUE KEY `fk_id_pole2` (`id_pole`);

--
-- Index pour la table `projet_bureau`
--
ALTER TABLE `projet_bureau`
  ADD KEY `fk_id_proj1` (`id_proj`),
  ADD KEY `fk_id_bur` (`id_bur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
