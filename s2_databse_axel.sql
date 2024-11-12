-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 12 nov. 2024 à 09:34
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `s2_databse_axel`
--

-- --------------------------------------------------------

--
-- Structure de la table `congressiste`
--

CREATE TABLE `congressiste` (
  `id` int(11) NOT NULL,
  `num_organisme` int(11) DEFAULT NULL,
  `num_hotel` int(11) DEFAULT NULL,
  `nom_congre` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `date_inscription` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `nom_hotel` varchar(100) NOT NULL,
  `adresse_hotel` varchar(255) DEFAULT NULL,
  `nombre_etoiles` int(11) DEFAULT NULL CHECK (`nombre_etoiles` between 1 and 5),
  `prix_participant` decimal(10,2) NOT NULL,
  `prix_supplementaire` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`id`, `nom_hotel`, `adresse_hotel`, `nombre_etoiles`, `prix_participant`, `prix_supplementaire`) VALUES
(1, 'Hôtel Paris Centre', '12 Rue de Rivoli, Paris', 4, 120.00, 15.00),
(2, 'Hôtel Lyon Part-Dieu', '45 Avenue Georges Pompidou, Lyon', 3, 95.00, 10.00),
(3, 'Hôtel Bordeaux Lac', 'Avenue Jean Gabriel Domergue, Bordeaux', 4, 110.00, 12.00),
(4, 'Hôtel Nice Côte d\'Azur', '25 Promenade des Anglais, Nice', 5, 150.00, 20.00),
(5, 'Hôtel Lille Grand Place', '10 Place Charles de Gaulle, Lille', 3, 85.00, 8.00);

-- --------------------------------------------------------

--
-- Structure de la table `organisme`
--

CREATE TABLE `organisme` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `organisme`
--

INSERT INTO `organisme` (`id`, `nom`, `adresse`, `tel`) VALUES
(1, 'Entreprise Alpha', '123 Rue Exemple, Paris', '0102030405'),
(2, 'Administration Beta', '456 Avenue Exemple, Lyon', '0102030406'),
(3, 'Université Gamma', '789 Boulevard Exemple, Lille', '0102030407');

-- --------------------------------------------------------

--
-- Structure de la table `participation_session`
--

CREATE TABLE `participation_session` (
  `num_congressiste` int(11) NOT NULL,
  `num_session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `date_session` date NOT NULL,
  `heure_session` time NOT NULL,
  `nom_session` varchar(100) NOT NULL,
  `prix_session` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`id`, `date_session`, `heure_session`, `nom_session`, `prix_session`) VALUES
(1, '2024-11-20', '09:00:00', 'Conférence sur la Sécurité Informatique', 50.00),
(2, '2024-11-21', '14:00:00', 'Atelier Développement Web', 60.00),
(3, '2024-11-22', '10:30:00', 'Présentation des Nouvelles Technologies', 55.00),
(4, '2024-11-20', '10:00:00', 'Conférence Intelligence Artificielle', 70.00),
(5, '2024-11-21', '13:00:00', 'Atelier Cybersécurité', 65.00),
(6, '2024-11-22', '09:00:00', 'Présentation des Startups Innovantes', 60.00),
(7, '2024-11-20', '11:00:00', 'Conférence sur l\'Énergie Renouvelable', 75.00),
(8, '2024-11-21', '15:00:00', 'Atelier Gestion de Projets', 50.00),
(9, '2024-11-22', '14:00:00', 'Conférence sur l\'Agriculture Durable', 55.00),
(10, '2024-11-20', '08:30:00', 'Conférence sur le Tourisme Durable', 90.00),
(11, '2024-11-21', '16:00:00', 'Atelier de Photographie', 70.00),
(12, '2024-11-22', '10:00:00', 'Séminaire de Gestion Hôtelière', 85.00),
(13, '2024-11-20', '09:30:00', 'Conférence sur la Transformation Digitale', 60.00),
(14, '2024-11-21', '14:30:00', 'Atelier Marketing Digital', 55.00),
(15, '2024-11-22', '11:00:00', 'Séminaire d\'Innovation Sociale', 50.00);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `congressiste`
--
ALTER TABLE `congressiste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_organisme` (`num_organisme`),
  ADD KEY `num_hotel` (`num_hotel`);

--
-- Index pour la table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `organisme`
--
ALTER TABLE `organisme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participation_session`
--
ALTER TABLE `participation_session`
  ADD PRIMARY KEY (`num_congressiste`,`num_session`),
  ADD KEY `num_session` (`num_session`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `congressiste`
--
ALTER TABLE `congressiste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `organisme`
--
ALTER TABLE `organisme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `congressiste`
--
ALTER TABLE `congressiste`
  ADD CONSTRAINT `congressiste_ibfk_1` FOREIGN KEY (`num_organisme`) REFERENCES `organisme` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `congressiste_ibfk_2` FOREIGN KEY (`num_hotel`) REFERENCES `hotel` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `participation_session`
--
ALTER TABLE `participation_session`
  ADD CONSTRAINT `participation_session_ibfk_1` FOREIGN KEY (`num_congressiste`) REFERENCES `congressiste` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participation_session_ibfk_2` FOREIGN KEY (`num_session`) REFERENCES `session` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
