-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 19 juin 2023 à 11:15
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_wefrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `category_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_slug`, `category_updated_at`, `category_image_name`) VALUES
(273, 'Maison', 'maison', NULL, 'maison.png'),
(274, 'Couture', 'couture', NULL, 'Réparation.jpg'),
(275, 'Réparation', 'reparation', NULL, 'couture.jpg'),
(276, 'Teinture', 'teinture', NULL, 'Teinture.jpg'),
(277, 'Accessoires', 'accessoires', NULL, 'Accessoires.jpg'),
(278, 'Patron', 'patron', NULL, 'patron.png'),
(279, 'Tricot', 'tricot', NULL, 'tricot.png'),
(280, 'Broderie', 'broderie', NULL, 'broderie.png');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230619101511', '2023-06-19 10:15:16', 303);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_creator_id` int DEFAULT NULL,
  `type_event_id` int DEFAULT NULL,
  `infos_location_id` int DEFAULT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime DEFAULT NULL,
  `event_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordinate_lat` double NOT NULL,
  `coordinate_lng` double NOT NULL,
  `event_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3BAE0AA75CE9B6D9` (`infos_location_id`),
  KEY `IDX_3BAE0AA7C645C84A` (`user_creator_id`),
  KEY `IDX_3BAE0AA7BC08CF77` (`type_event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `user_creator_id`, `type_event_id`, `infos_location_id`, `event_name`, `event_date`, `event_description`, `event_image_name`, `coordinate_lat`, `coordinate_lng`, `event_slug`, `event_updated_at`) VALUES
(67, NULL, 36, NULL, 'Atelier de couture', '2023-07-09 14:00:00', 'Atelier pour apprendre les bases de la couture avec Henriette. Rdv chez moi samedi, de 14h à 17h.', 'videdressing.jpg', 48.8919423, 2.3421511, 'atelier-de-couture-Henriette', NULL),
(68, NULL, 35, NULL, 'Vide dressing', '2023-07-10 14:00:00', 'La coloc organise son vide dressing annuel ! Nous sommes trois garçons et nous vendons des vêtements de taille S et M. Dimanche après-midi, jusqu\'à 19h.', 'videdressing.jpg', 48.8694901, 2.3893574, 'vide-dressing-Yani', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `event_user`
--

DROP TABLE IF EXISTS `event_user`;
CREATE TABLE IF NOT EXISTS `event_user` (
  `event_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`event_id`,`user_id`),
  KEY `IDX_92589AE271F7E88B` (`event_id`),
  KEY `IDX_92589AE2A76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event_user`
--

INSERT INTO `event_user` (`event_id`, `user_id`) VALUES
(67, 62);

-- --------------------------------------------------------

--
-- Structure de la table `info_location`
--

DROP TABLE IF EXISTS `info_location`;
CREATE TABLE IF NOT EXISTS `info_location` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_creator_id` int NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_loc_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info_loc_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_49ABF2A1C645C84A` (`user_creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tutorial`
--

DROP TABLE IF EXISTS `tutorial`;
CREATE TABLE IF NOT EXISTS `tutorial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tuto_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuto_description` longtext COLLATE utf8mb4_unicode_ci,
  `tuto_file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuto_video_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuto_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuto_support_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tuto_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tuto_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tutorial`
--

INSERT INTO `tutorial` (`id`, `tuto_name`, `tuto_description`, `tuto_file_name`, `tuto_video_name`, `tuto_image_name`, `tuto_support_type`, `tuto_slug`, `tuto_updated_at`) VALUES
(129, 'Broder un tee shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', NULL, 'fixtVideo1.mp4', 'fixtImage1.jpg', 'Fiche', 'broder-un-tee-shirt', NULL),
(130, 'Réparer une fermeture éclair', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', NULL, 'fixtVideo2.mp4', 'fixtImage2.jpg', 'Vidéo', 'reparer-une-fermeture-eclair', NULL),
(131, 'Apprendre à coudre avec une machine', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', NULL, 'fixtVideo3.mp4', 'fixtImage3.jpg', 'Fiche', 'apprendre-a-coudre-avec-une-machine', NULL),
(132, 'Tie and Dye', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', NULL, 'fixtVideo4.mp4', 'fixtImage4.jpg', 'Vidéo', 'tie-and-dye', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tutorial_category`
--

DROP TABLE IF EXISTS `tutorial_category`;
CREATE TABLE IF NOT EXISTS `tutorial_category` (
  `tutorial_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`tutorial_id`,`category_id`),
  KEY `IDX_D652884189366B7B` (`tutorial_id`),
  KEY `IDX_D652884112469DE2` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tutorial_category`
--

INSERT INTO `tutorial_category` (`tutorial_id`, `category_id`) VALUES
(129, 280),
(130, 274),
(131, 274),
(132, 276),
(132, 280);

-- --------------------------------------------------------

--
-- Structure de la table `type_event`
--

DROP TABLE IF EXISTS `type_event`;
CREATE TABLE IF NOT EXISTS `type_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_vide_dressing_id` int DEFAULT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_description` longtext COLLATE utf8mb4_unicode_ci,
  `type_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_35A28D506CF8280` (`type_vide_dressing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_event`
--

INSERT INTO `type_event` (`id`, `type_vide_dressing_id`, `type_name`, `type_description`, `type_slug`, `type_updated_at`) VALUES
(35, NULL, 'Vide dressing', NULL, 'vide-dressing', NULL),
(36, NULL, 'Atelier', NULL, 'atelier', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_vide_dressing`
--

DROP TABLE IF EXISTS `type_vide_dressing`;
CREATE TABLE IF NOT EXISTS `type_vide_dressing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clothes_gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clothes_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vide_dressing_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_creator_id` int DEFAULT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649C645C84A` (`user_creator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `user_creator_id`, `email`, `roles`, `password`, `pseudo`, `avatar_name`, `lastname`, `firstname`, `user_slug`, `user_updated_at`, `is_verified`) VALUES
(61, NULL, 'user@user.com', '[]', '$2y$13$vquFF2UHJq5JO4mpkOJS7OL0Jpb8NtMWBavYbC1dJO7Q8pUBwKZNi', 'User Toto', NULL, NULL, NULL, 'user-user', NULL, 1),
(62, NULL, 'admin@wefrip.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$wR7EbElc75uU/B21OEK7buY0w9PDl5ETAnXDbvpB4jJw.vlXFgyd.', 'Admin Titi', NULL, NULL, NULL, 'admin-admin', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_creator`
--

DROP TABLE IF EXISTS `user_creator`;
CREATE TABLE IF NOT EXISTS `user_creator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `creator_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `user_data` json DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_tutorial`
--

DROP TABLE IF EXISTS `user_tutorial`;
CREATE TABLE IF NOT EXISTS `user_tutorial` (
  `user_id` int NOT NULL,
  `tutorial_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`tutorial_id`),
  KEY `IDX_26E61BE9A76ED395` (`user_id`),
  KEY `IDX_26E61BE989366B7B` (`tutorial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_tutorial`
--

INSERT INTO `user_tutorial` (`user_id`, `tutorial_id`) VALUES
(62, 129);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA75CE9B6D9` FOREIGN KEY (`infos_location_id`) REFERENCES `info_location` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7BC08CF77` FOREIGN KEY (`type_event_id`) REFERENCES `type_event` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7C645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user_creator` (`id`);

--
-- Contraintes pour la table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `FK_92589AE271F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_92589AE2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_location`
--
ALTER TABLE `info_location`
  ADD CONSTRAINT `FK_49ABF2A1C645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user_creator` (`id`);

--
-- Contraintes pour la table `tutorial_category`
--
ALTER TABLE `tutorial_category`
  ADD CONSTRAINT `FK_D652884112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D652884189366B7B` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `type_event`
--
ALTER TABLE `type_event`
  ADD CONSTRAINT `FK_35A28D506CF8280` FOREIGN KEY (`type_vide_dressing_id`) REFERENCES `type_vide_dressing` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649C645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user_creator` (`id`);

--
-- Contraintes pour la table `user_tutorial`
--
ALTER TABLE `user_tutorial`
  ADD CONSTRAINT `FK_26E61BE989366B7B` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_26E61BE9A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
