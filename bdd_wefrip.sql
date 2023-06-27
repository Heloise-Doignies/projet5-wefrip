-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 juin 2023 à 14:37
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
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_slug`, `category_updated_at`, `category_image_name`) VALUES
(409, 'Maison', 'maison', '2023-06-26 13:45:49', 'maison.png'),
(410, 'Couture', 'couture', '2023-06-26 13:45:49', 'Réparation.jpg'),
(411, 'Réparation', 'reparation', '2023-06-26 13:45:49', 'couture.jpg'),
(412, 'Teinture', 'teinture', '2023-06-26 13:45:49', 'Teinture.jpg'),
(413, 'Accessoires', 'accessoires', '2023-06-26 13:45:49', 'Accessoires.jpg'),
(414, 'Patron', 'patron', '2023-06-26 13:45:49', 'patron.png'),
(415, 'Tricot', 'tricot', '2023-06-26 13:45:49', 'tricot.png'),
(416, 'Broderie', 'broderie', '2023-06-26 13:45:49', 'broderie.png');

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
('DoctrineMigrations\\Version20230626111512', '2023-06-26 11:16:02', 23),
('DoctrineMigrations\\Version20230626125821', '2023-06-26 12:58:31', 41);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_event_id` int DEFAULT NULL,
  `event_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` datetime NOT NULL,
  `event_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coordinate_lat` double NOT NULL,
  `coordinate_lng` double NOT NULL,
  `event_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `info_location` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3BAE0AA7BC08CF77` (`type_event_id`),
  KEY `IDX_3BAE0AA761220EA6` (`creator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `type_event_id`, `event_name`, `event_date`, `event_description`, `event_image_name`, `coordinate_lat`, `coordinate_lng`, `event_slug`, `event_updated_at`, `info_location`, `creator_id`) VALUES
(113, 70, 'Atelier de couture', '2023-07-09 14:00:00', 'Atelier pour apprendre les bases de la couture avec Henriette. Rdv chez moi samedi, de 14h à 17h.', 'videdressing.jpg', 48.8919423, 2.3421511, 'atelier-de-couture-Henriette', NULL, 'Interphone 1234 - 2ème étage', NULL),
(114, 69, 'Vide-dressing', '2023-07-10 14:00:00', 'La coloc organise son vide dressing annuel ! Nous sommes trois garçons et nous vendons des vêtements de taille S et M. Dimanche après-midi, jusqu\'à 19h.', 'videdressing.jpg', 48.8694901, 2.3893574, 'vide-dressing-Yani', NULL, 'Sonnez chez Bachi - 3ème étage', NULL),
(115, 69, 'Vide dressing de l\'été', '2023-07-02 09:30:00', '<p>Rdv &agrave; la maison pour des v&ecirc;tements pour des femmes, du 36 au 42.<br />\r\nJe suis dans le 15eme arrondissement.</p>', NULL, 48.867650740822, 2.3093605041504, 'vide-dressing-de-l-ete', NULL, '<p>Appelez-moi ou envoyez-moi un message au 04040404 pour les informations pratiques.</p>', 100);

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
) ENGINE=InnoDB AUTO_INCREMENT=218 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tutorial`
--

INSERT INTO `tutorial` (`id`, `tuto_name`, `tuto_description`, `tuto_file_name`, `tuto_video_name`, `tuto_image_name`, `tuto_support_type`, `tuto_slug`, `tuto_updated_at`) VALUES
(212, 'DIY T-shirts brodés', 'Aujourd\'hui je vous propose un tutoriel pour personnaliser vos vêtements et les rendre uniques.', NULL, 'https://www.youtube.com/embed/zxsuMNaFVIk', 'broderie.png', 'Vidéo', 'broder-un-tee-shirt', NULL),
(213, 'Comment réparer une fermeture éclair', 'Comment réparer une fermeture éclair. C\'est plus facile que de remplacer la fermeture à glissière et très économique', NULL, 'https://www.youtube.com/embed/NhwaMNvrIlc', 'fermeture-eclair.png', 'Vidéo', 'reparer-une-fermeture-eclair', NULL),
(214, 'Apprendre à coudre à la machine', ' Apprendre facilement manipuler le tissu pour faire les lignes droites, parallèles, les courbes, les arrondis, les angles à la machine. Et vous allez voir que la couture c’est facile et amusant !', NULL, 'https://www.youtube.com/embed/CIj4lo9RFo0', 'machineacoudre.jpg', 'Vidéo', 'apprendre-a-coudre-avec-une-machine', NULL),
(215, '17 idées étonnantes de projets DIY upcycling', 'Vous avez de vieux vêtements que vous ne portez plus ? Si vous pensiez les jeter, n\'en faites rien ! On peut réaliser une multitude de d\'objets de déco ou pratiques avec de vieux habits. Regardez !', NULL, 'https://www.youtube.com/embed/rj8tyaG720c', 'astuces.png', 'Vidéo', 'tie-and-dye', NULL),
(216, 'Éponge tawashi : fabriquer sa lavette zéro déchet', 'Éponge tawashi : un tuto facile pour fabriquer sa propre lavette zéro déchet. \r\n        <br>Connaissez-vous l’éponge tawashi, cette lavette en tissu économique, écologique et zéro déchet ? Découvrez dans ce tuto comment fabriquer votre propre tawashi à la maison en recyclant vos vieux vêtements !\r\n        <br><b>Comment fabriquer un tawashi au métier à tisser ? Les étapes :</b>\r\n        <br>1/ A l’aide d’un crayon gras, tracez un carré au centre de votre planche de bois (environ 16 centimètres).\r\n        <br>2/ Tracez des repères tous les 2 centimètres, un pour chaque clou (20 en tout).\r\n        <br>3/ Enfoncez vos clous de manière à obtenir une rangée régulière de 5 clous sur chaque face du carré. Laissez un espace vide aux 4 coins du carrés.\r\n        <br>4/ Découpez la manche d’un pull ou d’un collant/leggings ou autre vêtement légèrement élastique de manière à obtenir 10 fines bandelettes (environ 16 cm de haut). Vous pouvez utiliser des vêtements de couleur différentes pour obtenir un tawashi multicolore.\r\n        <br>5/ Enfilez les 5 premières bandelettes sur les rangées de clous de gauche et de droite, à l’horizontale.', NULL, NULL, 'tawashi.jpg', 'Fiche', 'eponge-tawashi', NULL),
(217, 'Faire un tapis de bain', 'Fabriquer un tapis de bain avec des vieilles serviettes', 'tapisdebain.jpg', NULL, 'tapisdebain.jpg', 'Fiche', 'faire-un-tapis-de-bain', NULL);

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
(212, 416),
(213, 411),
(214, 410),
(215, 409),
(215, 413),
(216, 409),
(217, 409),
(217, 413);

-- --------------------------------------------------------

--
-- Structure de la table `type_event`
--

DROP TABLE IF EXISTS `type_event`;
CREATE TABLE IF NOT EXISTS `type_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_description` longtext COLLATE utf8mb4_unicode_ci,
  `type_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_event`
--

INSERT INTO `type_event` (`id`, `type_name`, `type_description`, `type_slug`, `type_updated_at`) VALUES
(69, 'Vide-dressing', NULL, 'vide-dressing', NULL),
(70, 'Atelier', NULL, 'atelier', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
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
  `new_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `pseudo`, `avatar_name`, `lastname`, `firstname`, `user_slug`, `user_updated_at`, `is_verified`, `new_password`) VALUES
(98, 'user@user.com', '[\"ROLE_USER\"]', '$2y$13$.WtYVXhLJIxLXwBXAAOoXeMFPP9GNEUX4KxKEVQIl6A7xlr0q5P/.', 'User Toto', 'toto.jpg', NULL, NULL, 'user-user', NULL, 1, NULL),
(99, 'admin@wefrip.com', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$5PaPOF4rWnCHHhTmCNyU7ONbcAQ8sj4GHzr3Cfqs0PzKgDK8oZLq2', 'Admin Titi', 'admin.jpg', NULL, NULL, 'admin-admin', NULL, 1, NULL),
(100, 'tutu@tutu.com', '[\"ROLE_USER\"]', '$2y$13$x2jKm2zrilFJNRM5TBDb/eMlcNGdRsndrRnN7l6730Fg5R7zpmtoS', 'Tutu', NULL, NULL, NULL, NULL, NULL, 1, NULL),
(101, 'toto@to.to', '[\"ROLE_USER\"]', '$2y$13$nBxHz8kK8jIdtSt9CtMbG..zjgPssHHtqzFNQh//mUj.W6G66aahC', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(102, 'toto@to.to2', '[\"ROLE_USER\"]', '$2y$13$krI0w0BfjfoDihRPnXaQA.N5wlh8CjBpnDYknZ6IXn8cFinajjAw.', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(103, 'toto@to.to3', '[\"ROLE_USER\"]', '$2y$13$jezGjfvVAI10NNr0b7wdPOg2OQk/A6OLqbcKsel8VnYsZCBarCPVa', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL);

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
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA761220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7BC08CF77` FOREIGN KEY (`type_event_id`) REFERENCES `type_event` (`id`);

--
-- Contraintes pour la table `event_user`
--
ALTER TABLE `event_user`
  ADD CONSTRAINT `FK_92589AE271F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_92589AE2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tutorial_category`
--
ALTER TABLE `tutorial_category`
  ADD CONSTRAINT `FK_D652884112469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_D652884189366B7B` FOREIGN KEY (`tutorial_id`) REFERENCES `tutorial` (`id`) ON DELETE CASCADE;

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
