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
use formation;
-- --------------------------------------------------------

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
  `stagiaire_hors_convention_auditeur_libre` boolean,
  PRIMARY KEY (`id`),
  KEY `session` (`session_id`),
  KEY `stagiaire` (`stagiaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `sessionformateur`;
CREATE TABLE IF NOT EXISTS `sessionformateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int DEFAULT NULL,
  `formateur_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session` (`session_id`),
  KEY `formateur` (`formateur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int,
  `centre_id` int,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
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


DROP TABLE IF EXISTS `centres`;
CREATE TABLE IF NOT EXISTS `centres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lieu` longtext,
  `georeference` text,
  `url_lieu1` text,
  `url_lieu2` text,
  `url_lieu3` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `formateurs`;
CREATE TABLE IF NOT EXISTS `formateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
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


DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
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


DROP TABLE IF EXISTS `organisations`;
CREATE TABLE IF NOT EXISTS `organisations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `personne_a_contacter1` varchar(50),
  `email1` varchar(80),
  `telephone1` varchar(20),
  `personne_a_contacter2` varchar(50),
  `email2` varchar(80),
  `telephone2` varchar(20),    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `role` text NOT NULL,
  `password_reset_token` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


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
  ADD CONSTRAINT `sessionstagiaire_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessionstagiaire_ibfk_2` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
ADD CONSTRAINT `fk_stagiaire_organisation` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;



-- Mot de passe hashé : rocknroll
INSERT INTO `utilisateurs` (`id`, `email`, `password`, `role`, `password_reset_token`) VALUES
(1, 'admin@test.fr', '$2y$10$taMSgwLS6V68HWgj2vzysuqB1a4TcozOog7gAXmEsM.J2KmQ/YZ.a', 'admin', NULL),
(2, 'stagiaire@test.fr', '$2y$10$taMSgwLS6V68HWgj2vzysuqB1a4TcozOog7gAXmEsM.J2KmQ/YZ.a', 'stagiaire', NULL),
(3, 'formateur@test.fr', '$2y$10$taMSgwLS6V68HWgj2vzysuqB1a4TcozOog7gAXmEsM.J2KmQ/YZ.a', 'formateur', NULL),
(4, 'stagiaire2@test.fr', '$2y$10$taMSgwLS6V68HWgj2vzysuqB1a4TcozOog7gAXmEsM.J2KmQ/YZ.a', 'stagiaire', NULL),
(5, 'stagiaire3@test.fr', '$2y$10$taMSgwLS6V68HWgj2vzysuqB1a4TcozOog7gAXmEsM.J2KmQ/YZ.a', 'stagiaire', NULL);

INSERT INTO `organisations` (`id`, `nom`, `personne_a_contacter1`, `email1`, `telephone1`,`personne_a_contacter2`,`email2`,`telephone2`) VALUES
(1, 'Musée d''Orsay - Debuisson', 'sylvie Julé', 'sylvie.jule@musee-orsay.fr', '0620346464', 'Nicolas Andry', 'nicolas.andry@musee-orsay.fr', ''),
(2, 'INRAP', 'ouzia Sahir-El Kobbi', 'fouzia.sahir-el-kobbi@inrap.fr', 'non renseigné', '', '', ''),
(3, 'Musée des blindés', 'Jean', 'email@chef.com', '0610813837', 'Autre personne', 'autre@email.com', '0710435476');

INSERT INTO `stagiaires` (`id`, `nom`, `prenom`, `email2`, `telephone`, `historique_sessions`, `derniere_version_reglement_interieur_accepte`, `derniere_version_cgv_acceptee`, `derniere_version_cgu_acceptee`, `user_id`, `organisation_id`) VALUES
(1, 'Deruelle', 'Marine', 'email@secours.fr', '0620346464', '', '', '', '', 2, 1),
(2, 'Simon', 'Nicolas 2', 'emaildenico@secours.fr', '0742723278', '', '', '', '', 4, 2),
(3, 'Sairien', 'Jean', 'emailjeean@secours.fr', '0610813837', '', '', '', '', 4, 3);


INSERT INTO `centres` (`id`, `name`, `lieu`, `georeference`, `url_lieu1`, `url_lieu2`, `url_lieu3`) VALUES
(1, 'IdéesCulture Salle de réunion', 'Laigné en belin', '', '', '', '');

INSERT INTO `formateurs` (`id`, `nom`, `prenom`, `chemin_cv`, `liste_diplome`, `numero_decl_activite`, `qualiopi`, `siret`, `adresse`, `attestation_assurance_url`, `user_id`) VALUES
(1, 'Test', 'test', '', '', '', '', '', '', '', 3);


INSERT INTO `formations` (`id`, `name`, `prerequis`, `objectif1`, `objectif2`, `objectif3`, `objectif4`, `objectif5`, `objectif6`, `objectif7`, `objectif8`, `objectif9`, `objectif10`, `nbmax`, `url_planformation`) VALUES
(1, 'CollectiveAccess utilisateur', '- savoir utiliser un navigateur web- savoir gérer ses favoris- savoir utiliser un moteur de recherche sur internet', '- Mémoriser les adresses d’accès à l’interface publique et à l’interface professionnelle du logiciel', '- Savoir se connecter et récupérer ses identifiants en cas de perte', '- Réaliser une recherche simple avec plusieurs mots parmi les objets de la base des collections', '- Concevoir un tableau de bord personnalisé à l’aide des widgets de CollectiveAccess', '', '', '', '', '', '', 8, 'uploads/planFormation/1/avis-arret-de-travail-et-atmp.pdf'),
(2, 'CollectiveAccess administrateur', '- Percevoir les enjeux d\'une politique de contrôle des accès (login, mot de passe, perception des enjeux de confidentialité et de sécurité)\r\n- Connaître ou comprendre le vocabulaire de base de CollectiveAccess (champs, grilles de saisie, menu, barre de défilement, barre d\'adresse...)\r\nOU\r\n- Formation CollectiveAccess utilisateur', '- Organiser les droits d’accès à l’interface professionnelle du logiciel', '- Préparer l’arrivée d’un nouvel utilisateur', '- Savoir ajouter un champ dans la base de données et savoir le placer dans une grille de saisie', '- Réaliser des traitements par lot sur la base (modification, suppression)', '', '', '', '', '', '', 6, ''),
(3, 'HTML/CSS initiation', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(4, 'HTML/CSS perfectionnement', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(5, 'ITIL et helpdesk', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(6, 'Analyse visuelle et expression', '', '', '', '', '', '', '', '', '', '', '', NULL, '');


INSERT INTO `sessions` (`id`, `formation_id`, `centre_id`, `debut`, `fin`, `contact_structure_ou_entreprise`, `contact_structure_ou_entreprise_email`, `contact_financeur`, `contact_financeur_email`, `adresse_structure_ou_entreprise`, `siret_structure_ou_entreprise`, `plan_de_formation`, `questionnaire_satisfaction_formateur`) VALUES
(1, 2, 1, '2023-02-10 00:00:00', '2023-02-17 00:00:00', '', '', '', '', '', '', '', ''),
(2, 3, 1, '2023-02-20 00:00:00', '2023-02-23 00:00:00', '', '', '', '', '', '', '', ''),
(3, 1, 1, '2023-12-10 00:00:00', '2023-12-17 00:00:00', '', '', '', '', '', '', '', ''),
(4, 4, 1, '2023-11-09 00:00:00', '2023-11-12 00:00:00', '', '', '', '', '', '', '', ''),
(5, 1, 1, '2023-08-10 00:00:00', '2023-08-17 00:00:00', '', '', '', '', '', '', '', '');

INSERT INTO `sessionstagiaire` (`id`, `session_id`, `stagiaire_id`, `present_demij1`, `present_demij2`, `present_demij3`, `present_demij4`, `present_demij5`, `present_demij6`, `present_demij7`, `present_demij8`, `present_demij9`, `present_demij10`, `reponses_questionnaire_niveau_initial_json`, `reponses_questionnaire_niveau_final_json`, `reponses_satisfaction_json`, `stagiaire_hors_convention_auditeur_libre`) VALUES
(4, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `sessionformateur` (`id`, `session_id`, `formateur_id`) VALUES
(1, 1, 1),
(2, 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
