-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 juin 2023 à 13:16
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('DoctrineMigrations\\Version20230608131344', '2023-06-08 13:13:48', 741);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_creator_id` int NOT NULL,
  `type_event_id` int NOT NULL,
  `infos_location_id` int NOT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:dateinterval)',
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `event_user_participant`
--

DROP TABLE IF EXISTS `event_user_participant`;
CREATE TABLE IF NOT EXISTS `event_user_participant` (
  `event_id` int NOT NULL,
  `user_participant_id` int NOT NULL,
  PRIMARY KEY (`event_id`,`user_participant_id`),
  KEY `IDX_5894414C71F7E88B` (`event_id`),
  KEY `IDX_5894414CF699EF40` (`user_participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favori`
--

DROP TABLE IF EXISTS `favori`;
CREATE TABLE IF NOT EXISTS `favori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `is_fav` tinyint(1) DEFAULT NULL,
  `fav_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Structure de la table `info_location_user_participant`
--

DROP TABLE IF EXISTS `info_location_user_participant`;
CREATE TABLE IF NOT EXISTS `info_location_user_participant` (
  `info_location_id` int NOT NULL,
  `user_participant_id` int NOT NULL,
  PRIMARY KEY (`info_location_id`,`user_participant_id`),
  KEY `IDX_37AEFE85D9750B71` (`info_location_id`),
  KEY `IDX_37AEFE85F699EF40` (`user_participant_id`)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `tutorial_favori`
--

DROP TABLE IF EXISTS `tutorial_favori`;
CREATE TABLE IF NOT EXISTS `tutorial_favori` (
  `tutorial_id` int NOT NULL,
  `favori_id` int NOT NULL,
  PRIMARY KEY (`tutorial_id`,`favori_id`),
  KEY `IDX_D98EFAC189366B7B` (`tutorial_id`),
  KEY `IDX_D98EFAC1FF17033F` (`favori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  UNIQUE KEY `UNIQ_8D93D649C645C84A` (`user_creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_creator`
--

DROP TABLE IF EXISTS `user_creator`;
CREATE TABLE IF NOT EXISTS `user_creator` (
  `id` int NOT NULL AUTO_INCREMENT,
  `creator_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_favori`
--

DROP TABLE IF EXISTS `user_favori`;
CREATE TABLE IF NOT EXISTS `user_favori` (
  `user_id` int NOT NULL,
  `favori_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`favori_id`),
  KEY `IDX_8AD7B9F1A76ED395` (`user_id`),
  KEY `IDX_8AD7B9F1FF17033F` (`favori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_participant`
--

DROP TABLE IF EXISTS `user_participant`;
CREATE TABLE IF NOT EXISTS `user_participant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `participant_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_user_participant`
--

DROP TABLE IF EXISTS `user_user_participant`;
CREATE TABLE IF NOT EXISTS `user_user_participant` (
  `user_id` int NOT NULL,
  `user_participant_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`user_participant_id`),
  KEY `IDX_391E059A76ED395` (`user_id`),
  KEY `IDX_391E059F699EF40` (`user_participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Contraintes pour la table `event_user_participant`
--
ALTER TABLE `event_user_participant`
  ADD CONSTRAINT `FK_5894414C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5894414CF699EF40` FOREIGN KEY (`user_participant_id`) REFERENCES `user_participant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `info_location`
--
ALTER TABLE `info_location`
  ADD CONSTRAINT `FK_49ABF2A1C645C84A` FOREIGN KEY (`user_creator_id`) REFERENCES `user_creator` (`id`);

--
-- Contraintes pour la table `info_location_user_participant`
--
ALTER TABLE `info_location_user_participant`
  ADD CONSTRAINT `FK_37AEFE85D9750B71` FOREIGN KEY (`info_location_id`) REFERENCES `info_location` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_37AEFE85F699EF40` FOREIGN KEY (`user_participant_id`) REFERENCES `user_participant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tutorial_category`
--
ALTER TABLE `tutorial_category`
  ADD CONSTRAINT `FK_D652884112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D652884189366B7B` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tutorial_favori`
--
ALTER TABLE `tutorial_favori`
  ADD CONSTRAINT `FK_D98EFAC189366B7B` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D98EFAC1FF17033F` FOREIGN KEY (`favori_id`) REFERENCES `favori` (`id`) ON DELETE CASCADE;

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
-- Contraintes pour la table `user_favori`
--
ALTER TABLE `user_favori`
  ADD CONSTRAINT `FK_8AD7B9F1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8AD7B9F1FF17033F` FOREIGN KEY (`favori_id`) REFERENCES `favori` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_user_participant`
--
ALTER TABLE `user_user_participant`
  ADD CONSTRAINT `FK_391E059A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_391E059F699EF40` FOREIGN KEY (`user_participant_id`) REFERENCES `user_participant` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
