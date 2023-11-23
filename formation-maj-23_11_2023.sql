-- -------------------------------------------------------------
-- TablePlus 5.3.0(486)
--
-- https://tableplus.com/
--
-- Database: formation
-- Generation Time: 2023-02-03 15:22:26.8880
-- -------------------------------------------------------------
use formation;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `Centres`;
CREATE TABLE `Centres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `lieu` longtext DEFAULT NULL,
  `georeference` text DEFAULT NULL,
  `url_lieu1` text DEFAULT NULL,
  `url_lieu2` text DEFAULT NULL,
  `url_lieu3` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Formateurs`;
CREATE TABLE `Formateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `chemin_cv` text DEFAULT NULL,
  `liste_diplome` longtext DEFAULT NULL,
  `numero_decl_activite` text DEFAULT NULL,
  `qualiopi` text DEFAULT NULL,
  `siret` text DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `attestation_assurance_url` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Formations`;
CREATE TABLE `Formations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `prerequis` longtext DEFAULT NULL,
  `objectif1` text DEFAULT NULL,
  `objectif2` text DEFAULT NULL,
  `objectif3` text DEFAULT NULL,
  `objectif4` text DEFAULT NULL,
  `objectif5` text DEFAULT NULL,
  `objectif6` text DEFAULT NULL,
  `objectif7` text DEFAULT NULL,
  `objectif8` text DEFAULT NULL,
  `objectif9` text DEFAULT NULL,
  `objectif10` text DEFAULT NULL,
  `nbmax` int(11) DEFAULT NULL,
  `url_planformation` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Sessions`;
CREATE TABLE `Sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formation_id` int(11) DEFAULT NULL,
  `centre_id` int(11) DEFAULT NULL,
  `debut` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `contact_structure_ou_entreprise` text DEFAULT NULL,
  `contact_structure_ou_entreprise_email` text DEFAULT NULL,
  `contact_financeur` text DEFAULT NULL,
  `contact_financeur_email` text DEFAULT NULL,
  `adresse_structure_ou_entreprise` longtext DEFAULT NULL,
  `siret_structure_ou_entreprise` text DEFAULT NULL,
  `plan_de_formation` text DEFAULT NULL,
  `questionnaire_satisfaction_formateur` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `formation` (`formation_id`),
  KEY `centre` (`centre_id`),
  CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `Formations` (`id`),
  CONSTRAINT `sessions_ibfk_2` FOREIGN KEY (`centre_id`) REFERENCES `Centres` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Stagiaires`;
CREATE TABLE `Stagiaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text DEFAULT NULL,
  `prenom` text DEFAULT NULL,
  `email2` text DEFAULT NULL,
  `telephone` text DEFAULT NULL,
  `historique_sessions` longtext DEFAULT NULL,
  `derniere_version_reglement_interieur_accepte` text DEFAULT NULL,
  `derniere_version_cgv_acceptee` text DEFAULT NULL,
  `derniere_version_cgu_acceptee` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `Utilisateurs`;
CREATE TABLE `Utilisateurs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` text DEFAULT NULL,
  `password_reset_token` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `SessionFormateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `formateur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session` (`session_id`),
  KEY `formateur` (`formateur_id`),
  CONSTRAINT `sessionformateur_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `Sessions` (`id`),
  CONSTRAINT `sessionformateur_ibfk_2` FOREIGN KEY (`formateur_id`) REFERENCES `Formateurs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `SessionStagiaire`;
CREATE TABLE `SessionStagiaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) DEFAULT NULL,
  `stagiaire_id` int(11) DEFAULT NULL,
  `present_demij1` int(1) DEFAULT NULL,
  `present_demij2` int(1) DEFAULT NULL,
  `present_demij3` int(1) DEFAULT NULL,
  `present_demij4` int(1) DEFAULT NULL,
  `present_demij5` int(1) DEFAULT NULL,
  `present_demij6` int(1) DEFAULT NULL,
  `present_demij7` int(1) DEFAULT NULL,
  `present_demij8` int(1) DEFAULT NULL,
  `present_demij9` int(1) DEFAULT NULL,
  `present_demij10` int(1) DEFAULT NULL,
  `reponses_questionnaire_niveau_initial_json` longtext DEFAULT NULL,
  `reponses_questionnaire_niveau_final_json` longtext DEFAULT NULL,
  `reponses_satisfaction_json` longtext DEFAULT NULL,
  `stagiaire_hors_convention_auditeur_libre` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session` (`session_id`),
  KEY `stagiaire` (`stagiaire_id`),
  CONSTRAINT `sessionstagiaire_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `Sessions` (`id`),
  CONSTRAINT `sessionstagiaire_ibfk_2` FOREIGN KEY (`stagiaire_id`) REFERENCES `Stagiaires` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;


ALTER TABLE `Stagiaires`
ADD COLUMN `user_id` INT,
ADD CONSTRAINT `fk_stagiaire_user`
FOREIGN KEY (`user_id`)
REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE;

ALTER TABLE `Formateurs`
ADD COLUMN `user_id` INT,
ADD CONSTRAINT `fk_formateur_user`
FOREIGN KEY (`user_id`)
REFERENCES `utilisateurs`(`id`) ON DELETE CASCADE;

INSERT INTO `Centres` (`id`, `name`, `lieu`, `georeference`, `url_lieu1`, `url_lieu2`, `url_lieu3`) VALUES
(1, 'IdéesCulture Salle de réunion', 'Laigné en belin', '', '', '', '');

INSERT INTO `Utilisateurs` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'admin'),
(2, 'stagiaire@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'stagiaire'),
(3, 'formateur@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'formateur'),
(4, 'stagiaire2@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'stagiaire'),
(5, 'stagiaire3@test.fr', '$2y$10$OJYf315tkENrUHD1/wUq4ON0G.dpKCbUJQ8aBHmBX1dXOaiip7tG6', 'stagiaire');

INSERT INTO `Formateurs` (`id`, `nom`, `prenom`, `chemin_cv`, `liste_diplome`, `numero_decl_activite`, `qualiopi`, `siret`, `adresse`, `attestation_assurance_url`, `user_id`) VALUES
(1, 'Test', 'test', '', '', NULL, NULL, NULL, NULL, NULL, '3');

INSERT INTO `Formations` (`id`, `name`, `prerequis`, `objectif1`, `objectif2`, `objectif3`, `objectif4`, `objectif5`, `objectif6`, `objectif7`, `objectif8`, `objectif9`, `objectif10`, `nbmax`, `url_planformation`) VALUES
(1, 'CollectiveAccess utilisateur', '- savoir utiliser un navigateur web\r\n- savoir gérer ses favoris\r\n- savoir utiliser un moteur de recherche sur internet', '- Mémoriser les adresses d’accès à l’interface publique et à l’interface professionnelle du logiciel', '- Savoir se connecter et récupérer ses identifiants en cas de perte', '- Réaliser une recherche simple avec plusieurs mots parmi les objets de la base des collections', '- Concevoir un tableau de bord personnalisé à l’aide des widgets de CollectiveAccess', '', '', '', '', '', '', 8, ''),
(2, 'CollectiveAccess administrateur', '- Percevoir les enjeux d\'une politique de contrôle des accès (login, mot de passe, perception des enjeux de confidentialité et de sécurité)\r\n- Connaître ou comprendre le vocabulaire de base de CollectiveAccess (champs, grilles de saisie, menu, barre de défilement, barre d\'adresse...)\r\nOU\r\n- Formation CollectiveAccess utilisateur', '- Organiser les droits d’accès à l’interface professionnelle du logiciel', '- Préparer l’arrivée d’un nouvel utilisateur', '- Savoir ajouter un champ dans la base de données et savoir le placer dans une grille de saisie', '- Réaliser des traitements par lot sur la base (modification, suppression)', '', '', '', '', '', '', 6, ''),
(3, 'HTML/CSS initiation', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(4, 'HTML/CSS perfectionnement', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(5, 'ITIL et helpdesk', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
(6, 'Analyse visuelle et expression', '', '', '', '', '', '', '', '', '', '', '', NULL, '');

INSERT INTO `Sessions` (`id`, `formation_id`, `centre_id`, `debut`, `fin`, `contact_structure_ou_entreprise`, `contact_structure_ou_entreprise_email`, `contact_financeur`, `contact_financeur_email`, `adresse_structure_ou_entreprise`, `siret_structure_ou_entreprise`, `plan_de_formation`, `questionnaire_satisfaction_formateur`) VALUES
(1, 2, 1, '2023-02-10 00:00:00', '2023-02-17 00:00:00', '', '', '', '', '', '', '', ''),
(2, 3, 1, '2023-02-20 00:00:00', '2023-02-23 00:00:00', '', '', '', '', '', '', '', ''),
(3, 1, 1, '2023-12-10 00:00:00', '2023-12-17 00:00:00', '', '', '', '', '', '', '', ''),
(4, 4, 1, '2023-11-09 00:00:00', '2023-11-12 00:00:00', '', '', '', '', '', '', '', ''),
(5, 1, 1, '2023-08-10 00:00:00', '2023-08-17 00:00:00', '', '', '', '', '', '', '', '');

INSERT INTO `SessionStagiaire` (`id`, `session_id`, `stagiaire_id`, `present_demij1`, `present_demij2`, `present_demij3`, `present_demij4`, `present_demij5`, `present_demij6`, `present_demij7`, `present_demij8`, `present_demij9`, `present_demij10`, `reponses_questionnaire_niveau_initial_json`, `reponses_questionnaire_niveau_final_json`, `reponses_satisfaction_json`, `stagiaire_hors_convention_auditeur_libre`) VALUES
(4, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 5, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO `Stagiaires` (`id`, `nom`, `prenom`, `email2`, `telephone`, `historique_sessions`, `derniere_version_reglement_interieur_accepte`, `derniere_version_cgv_acceptee`, `derniere_version_cgu_acceptee`, `user_id`) VALUES
(1, 'Deruelle', 'Marine', 'email@secours.fr', '0620346464', '', '', '', '', '2'),
(2, 'Simon', 'Nicolas 2', 'email@secours.fr', '0742723278', '', '', '', '', '4'),
(3, 'Sairien', 'Jean', 'email@secours.fr', '0610813837', '', '', '', '', '4');

INSERT INTO `SessionFormateur` (`session_id`, `formateur_id`) VALUES (1, 1);
INSERT INTO `SessionFormateur` (`session_id`, `formateur_id`) VALUES (3, 1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;