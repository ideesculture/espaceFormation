-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 04 déc. 2023 à 13:04
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `formation`
--

-- --------------------------------------------------------

--
-- Structure de la table `centres`
--

DROP TABLE IF EXISTS `centres`;
CREATE TABLE IF NOT EXISTS `centres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `lieu` longtext,
  `georeference` text,
  `url_lieu1` text,
  `url_lieu2` text,
  `url_lieu3` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `centres`
--

INSERT INTO `centres` (`id`, `name`, `lieu`, `georeference`, `url_lieu1`, `url_lieu2`, `url_lieu3`) VALUES
(1, 'IdéesCulture Salle de réunion', 'Laigné en belin', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `formateurs`
--

DROP TABLE IF EXISTS `formateurs`;
CREATE TABLE IF NOT EXISTS `formateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text,
  `prenom` text,
  `chemin_cv` text,
  `liste_diplome` longtext,
  `numero_decl_activite` text,
  `qualiopi` text,
  `siret` text,
  `adresse` text,
  `attestation_assurance_url` text,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_formateur_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formateurs`
--

INSERT INTO `formateurs` (`id`, `nom`, `prenom`, `chemin_cv`, `liste_diplome`, `numero_decl_activite`, `qualiopi`, `siret`, `adresse`, `attestation_assurance_url`, `user_id`) VALUES
(1, 'Test', 'test', 'uploads/formateurs/1/jb_beam.png', 'uploads/formateurs/1/diplomes', '', '', '', '', 'uploads/formateurs/1/attestation-inscription.pdf', 3),
(5, 'gsdfgdsfg', 'dfsgdfgsdfgdsgfs', NULL, 'uploads/formateurs/5/diplomes', '', '', '', '', NULL, 9),
(6, 'fdsfdsfdsf', 'dsfdsfdsfdsfsdf', NULL, 'uploads/formateurs/6/diplomes', '', '', '', '', 'uploads/formateurs/6/jb_beam.png', 10),
(7, 'testste', 'nicolas', 'uploads/formateurs/7/jb_beam.png', 'uploads/formateurs/7/diplomes', '', '', '', '', NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `prerequis` longtext,
  `objectif1` text,
  `objectif2` text,
  `objectif3` text,
  `objectif4` text,
  `objectif5` text,
  `objectif6` text,
  `objectif7` text,
  `objectif8` text,
  `objectif9` text,
  `objectif10` text,
  `nbmax` int DEFAULT NULL,
  `url_planformation` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `name`, `prerequis`, `objectif1`, `objectif2`, `objectif3`, `objectif4`, `objectif5`, `objectif6`, `objectif7`, `objectif8`, `objectif9`, `objectif10`, `nbmax`, `url_planformation`) VALUES
(1, 'CollectiveAccess utilisateur', '- savoir utiliser un navigateur web- savoir gérer ses favoris- savoir utiliser un moteur de recherche sur internet', '- Mémoriser les adresses d’accès à l’interface publique et à l’interface professionnelle du logiciel', '- Savoir se connecter et récupérer ses identifiants en cas de perte', '- Réaliser une recherche simple avec plusieurs mots parmi les objets de la base des collections', '- Concevoir un tableau de bord personnalisé à l’aide des widgets de CollectiveAccess', '', '', '', '', '', '', 8, 'uploads/planFormation/1/avis-arret-de-travail-et-atmp.pdf'),
(2, 'CollectiveAccess administrateur', '- Percevoir les enjeux d\'une politique de contrôle des accès (login, mot de passe, perception des enjeux de confidentialité et de sécurité)\r\n- Connaître ou comprendre le vocabulaire de base de CollectiveAccess (champs, grilles de saisie, menu, barre de défilement, barre d\'adresse...)\r\nOU\r\n- Formation CollectiveAccess utilisateur', '- Organiser les droits d’accès à l’interface professionnelle du logiciel', '- Préparer l’arrivée d’un nouvel utilisateur', '- Savoir ajouter un champ dans la base de données et savoir le placer dans une grille de saisie', '- Réaliser des traitements par lot sur la base (modification, suppression)', '', '', '', '', '', '', 6, ''),
(3, 'HTML/CSS initiation', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(4, 'HTML/CSS perfectionnement', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(5, 'ITIL et helpdesk', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(6, 'Analyse visuelle et expression', '', '', '', '', '', '', '', '', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
CREATE TABLE IF NOT EXISTS `organisations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessionformateur`
--

DROP TABLE IF EXISTS `sessionformateur`;
CREATE TABLE IF NOT EXISTS `sessionformateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int DEFAULT NULL,
  `formateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session` (`session_id`),
  KEY `formateur` (`formateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sessionformateur`
--

INSERT INTO `sessionformateur` (`id`, `session_id`, `formateur_id`) VALUES
(1, 1, 1),
(2, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int DEFAULT NULL,
  `centre_id` int DEFAULT NULL,
  `debut` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `contact_structure_ou_entreprise` text,
  `contact_structure_ou_entreprise_email` text,
  `contact_financeur` text,
  `contact_financeur_email` text,
  `adresse_structure_ou_entreprise` longtext,
  `siret_structure_ou_entreprise` text,
  `plan_de_formation` text,
  `questionnaire_satisfaction_formateur` text,
  PRIMARY KEY (`id`),
  KEY `formation` (`formation_id`),
  KEY `centre` (`centre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `formation_id`, `centre_id`, `debut`, `fin`, `contact_structure_ou_entreprise`, `contact_structure_ou_entreprise_email`, `contact_financeur`, `contact_financeur_email`, `adresse_structure_ou_entreprise`, `siret_structure_ou_entreprise`, `plan_de_formation`, `questionnaire_satisfaction_formateur`) VALUES
(1, 2, 1, '2023-02-10 00:00:00', '2023-02-17 00:00:00', '', '', '', '', '', '', '', ''),
(2, 3, 1, '2023-02-20 00:00:00', '2023-02-23 00:00:00', '', '', '', '', '', '', '', ''),
(3, 1, 1, '2023-12-10 00:00:00', '2023-12-17 00:00:00', '', '', '', '', '', '', '', ''),
(4, 4, 1, '2023-11-09 00:00:00', '2023-11-12 00:00:00', '', '', '', '', '', '', '', ''),
(5, 1, 1, '2023-08-10 00:00:00', '2023-08-17 00:00:00', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `sessionstagiaire`
--

DROP TABLE IF EXISTS `sessionstagiaire`;
CREATE TABLE IF NOT EXISTS `sessionstagiaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int DEFAULT NULL,
  `stagiaire_id` int DEFAULT NULL,
  `present_demij1` int DEFAULT NULL,
  `present_demij2` int DEFAULT NULL,
  `present_demij3` int DEFAULT NULL,
  `present_demij4` int DEFAULT NULL,
  `present_demij5` int DEFAULT NULL,
  `present_demij6` int DEFAULT NULL,
  `present_demij7` int DEFAULT NULL,
  `present_demij8` int DEFAULT NULL,
  `present_demij9` int DEFAULT NULL,
  `present_demij10` int DEFAULT NULL,
  `reponses_questionnaire_niveau_initial_json` longtext,
  `reponses_questionnaire_niveau_final_json` longtext,
  `reponses_satisfaction_json` longtext,
  `stagiaire_hors_convention_auditeur_libre` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session` (`session_id`),
  KEY `stagiaire` (`stagiaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sessionstagiaire`
--

INSERT INTO `sessionstagiaire` (`id`, `session_id`, `stagiaire_id`, `present_demij1`, `present_demij2`, `present_demij3`, `present_demij4`, `present_demij5`, `present_demij6`, `present_demij7`, `present_demij8`, `present_demij9`, `present_demij10`, `reponses_questionnaire_niveau_initial_json`, `reponses_questionnaire_niveau_final_json`, `reponses_satisfaction_json`, `stagiaire_hors_convention_auditeur_libre`) VALUES
(4, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

DROP TABLE IF EXISTS `stagiaires`;
CREATE TABLE IF NOT EXISTS `stagiaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email2` text,
  `telephone` text,
  `historique_sessions` longtext,
  `derniere_version_reglement_interieur_accepte` text,
  `derniere_version_cgv_acceptee` text,
  `derniere_version_cgu_acceptee` text,
  `user_id` int DEFAULT NULL,
  `organisation_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stagiaire_user` (`user_id`),
  KEY `fk_stagiaire_organisation` (`organisation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `nom`, `prenom`, `email2`, `telephone`, `historique_sessions`, `derniere_version_reglement_interieur_accepte`, `derniere_version_cgv_acceptee`, `derniere_version_cgu_acceptee`, `user_id`, `organisation_id`) VALUES
(1, 'Deruelle', 'Marine', 'email@secours.fr', '0620346464', '', '', '', '', 2, NULL),
(2, 'Simon', 'Nicolas 2', 'email@secours.fr', '0742723278', '', '', '', '', 4, NULL),
(3, 'Sairien', 'Jean', 'email@secours.fr', '0610813837', '', '', '', '', 4, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` text,
  `role` text,
  `password_reset_token` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `email`, `password`, `role`, `password_reset_token`) VALUES
(1, 'admin@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'admin', NULL),
(2, 'stagiaire@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'stagiaire', NULL),
(3, 'formateur@test.fr', '$2y$13$wFueohb6A5Ovb5o2idG2B.fi54i0rRzUSAXfW0KrIy35M0VtfS4/W', 'formateur', NULL),
(4, 'stagiaire2@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'stagiaire', NULL),
(5, 'stagiaire3@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'stagiaire', NULL),
(9, 'testsettest@fdg.gf', '$2y$13$vXyzK6eGnPwExys0tDw6jOkKvcEofx7iQ8oJ58kEkAoaBfTsN0VnS', 'formateur', NULL),
(10, 'fdsfd@test.de', '$2y$13$bAYIvlqEnXNvjTpMt6AA9O8tQDvbJYF.ScW8RnOwfwPNJdIJU4ugW', 'formateur', NULL),
(11, 'testtest@test.fr', '$2y$13$aTnUJouB52F8VX.wHVKgqOUJyEACpqonQuA3lybjv0g3i3tv50W/6', 'formateur', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `formateurs`
--
ALTER TABLE `formateurs`
  ADD CONSTRAINT `fk_formateur_user` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sessionformateur`
--
ALTER TABLE `sessionformateur`
  ADD CONSTRAINT `sessionformateur_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `sessionformateur_ibfk_2` FOREIGN KEY (`formateur_id`) REFERENCES `formateurs` (`id`);

--
-- Contraintes pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`centre_id`) REFERENCES `centres` (`id`);

--
-- Contraintes pour la table `sessionstagiaire`
--
ALTER TABLE `sessionstagiaire`
  ADD CONSTRAINT `sessionstagiaire_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`),
  ADD CONSTRAINT `sessionstagiaire_ibfk_2` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`);

--
-- Contraintes pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD CONSTRAINT `fk_stagiaire_organisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stagiaire_user` FOREIGN KEY (`user_id`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
