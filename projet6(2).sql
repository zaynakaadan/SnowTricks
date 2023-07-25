-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 juil. 2023 à 08:33
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
-- Base de données : `projet6`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3AF346685E237E06` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(180, 'Hip', 'hip'),
(181, 'Step-up', 'step-up'),
(185, 'Nose Grab', 'Nose-Grab'),
(186, 'Japan air', 'Japan-air');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962AA76ED395` (`user_id`),
  KEY `IDX_5F9E962AB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `trick_id`, `user_id`, `content`, `created_at`) VALUES
(91, 114, 90, 'Assumenda perspiciatis consequatur.', '2023-06-17 16:23:50'),
(92, 113, 90, 'Iste voluptate qui iste.', '2023-06-17 16:23:50'),
(93, 122, 90, 'Quisquam voluptas earum consequatur maiores.', '2023-06-17 16:23:50'),
(94, 121, 90, 'Quo a adipisci et.', '2023-06-17 16:23:50'),
(95, 113, 90, 'Eos ratione labore.', '2023-06-17 16:23:50'),
(96, 113, 90, 'Sunt qui.', '2023-06-17 16:23:50'),
(97, 115, 90, 'Sed minima ea consequuntur.', '2023-06-17 16:23:50'),
(98, 122, 90, 'Ut quae porro quod et et.', '2023-06-17 16:23:50'),
(99, 114, 90, 'Vel est sed.', '2023-06-17 16:23:50'),
(100, 114, 90, 'Possimus explicabo repudiandae at eius odio sit.', '2023-06-17 16:23:50'),
(101, 121, 90, 'Sint ut.', '2023-06-17 16:23:50'),
(102, 119, 90, 'Quia voluptates aut cumque.', '2023-06-17 16:23:50'),
(103, 116, 90, 'Occaecati omnis est voluptas.', '2023-06-17 16:23:50'),
(104, 119, 90, 'Voluptate et error molestias.', '2023-06-17 16:23:50'),
(105, 115, 90, 'Reiciendis.', '2023-06-17 16:23:50'),
(106, 113, 90, 'Qui labore dolor facilis velit quos.', '2023-06-17 16:23:50'),
(107, 118, 90, 'Animi temporibus.', '2023-06-17 16:23:50'),
(108, 118, 90, 'Velit provident error molestiae.', '2023-06-17 16:23:50'),
(109, 121, 90, 'Est ratione.', '2023-06-17 16:23:50'),
(110, 113, 90, 'Quos ut doloremque.', '2023-06-17 16:23:50'),
(111, 121, 90, 'Dicta ut ab aut.', '2023-06-17 16:23:50'),
(112, 113, 90, 'Beatae expedita.', '2023-06-17 16:23:50'),
(113, 113, 90, 'Tenetur voluptates est.', '2023-06-17 16:23:50'),
(114, 120, 90, 'Ratione.', '2023-06-17 16:23:50'),
(115, 116, 90, 'Quia ut omnis.', '2023-06-17 16:23:50'),
(116, 113, 90, 'Recusandae.', '2023-06-17 16:23:50'),
(117, 115, 90, 'Quam est consequatur ut.', '2023-06-17 16:23:50'),
(118, 119, 90, 'In fuga consequatur voluptate officia ea quis.', '2023-06-17 16:23:50'),
(119, 119, 90, 'Molestiae.', '2023-06-17 16:23:50'),
(120, 115, 90, 'Vel fugit.', '2023-06-17 16:23:50'),
(121, NULL, 90, 'first comment', '2023-07-16 21:04:55'),
(122, NULL, 90, 'second comment', '2023-07-16 21:07:43'),
(130, 135, 90, 'Ajout un commentaire', '2023-07-18 06:30:29'),
(131, 135, 112, 'Ecrire message', '2023-07-18 06:33:35'),
(132, 135, 90, 'Hello', '2023-07-18 17:48:11'),
(133, 139, 90, 'Nice trick japan', '2023-07-18 18:39:33'),
(134, 135, 128, 'Joli photo', '2023-07-25 06:23:12');

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
('DoctrineMigrations\\Version20230514143814', '2023-05-14 14:51:23', 640),
('DoctrineMigrations\\Version20230514152131', '2023-05-14 15:21:48', 165),
('DoctrineMigrations\\Version20230514160803', '2023-05-14 16:08:16', 168),
('DoctrineMigrations\\Version20230612074914', '2023-06-12 07:50:55', 783),
('DoctrineMigrations\\Version20230616174517', '2023-06-16 18:01:33', 465),
('DoctrineMigrations\\Version20230616184315', '2023-06-16 18:43:58', 347),
('DoctrineMigrations\\Version20230616184708', '2023-06-16 18:47:19', 336),
('DoctrineMigrations\\Version20230616184915', '2023-06-16 18:49:26', 318),
('DoctrineMigrations\\Version20230616185142', '2023-06-16 18:51:51', 401),
('DoctrineMigrations\\Version20230619083022', '2023-06-19 08:32:37', 269),
('DoctrineMigrations\\Version20230703132129', '2023-07-03 13:23:23', 369),
('DoctrineMigrations\\Version20230710071315', '2023-07-10 07:13:46', 306),
('DoctrineMigrations\\Version20230714182543', '2023-07-15 20:32:19', 281),
('DoctrineMigrations\\Version20230715204047', '2023-07-15 20:40:58', 140),
('DoctrineMigrations\\Version20230715210125', '2023-07-15 21:01:38', 166),
('DoctrineMigrations\\Version20230718104325', '2023-07-18 10:43:35', 216),
('DoctrineMigrations\\Version20230722133108', '2023-07-22 13:31:45', 261),
('DoctrineMigrations\\Version20230722154102', '2023-07-22 15:41:07', 236);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `trick_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E01FBE6AB281BE2E` (`trick_id`)
) ENGINE=InnoDB AUTO_INCREMENT=733 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `trick_id`, `name`) VALUES
(720, 136, 'cecf888d408a03eca4357c6d1d352c5d.webp'),
(723, 135, '15b044afaa63e5a8d39d233748ad368c.webp'),
(724, 135, '84b58a5acb061008b0378d0463be20bc.webp'),
(725, 139, 'efc5d194313cfb8eb44fb1f455bbf694.webp'),
(726, 139, 'ea48c040af9d4678653e69c9bbe85d56.webp'),
(729, 141, '96053eb3f93e0aec46b00f274ce81c4a.webp'),
(730, 135, '127217e1af8aadfd561130a797cd4898.webp'),
(731, 142, 'd1e31f58fe4b85d4d6b9e943258f486d.webp'),
(732, 144, '5b5b2830a08aeb6017e593f18b04520e.webp');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":4:{i:0;s:25:\\\"emails/register.html.twig\\\";i:1;N;i:2;a:1:{s:4:\\\"user\\\";O:16:\\\"App\\\\Entity\\\\Users\\\":10:{s:20:\\\"\\0App\\\\Entity\\\\Users\\0id\\\";i:99;s:23:\\\"\\0App\\\\Entity\\\\Users\\0email\\\";s:19:\\\"email13@hotmail.com\\\";s:23:\\\"\\0App\\\\Entity\\\\Users\\0roles\\\";a:0:{}s:26:\\\"\\0App\\\\Entity\\\\Users\\0password\\\";s:60:\\\"$2y$13$u34MFbcGa0JELQ9NufU1r.XxDPRbdSbYmIcxX6G4Wz8f5tCQ8EHQC\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0lastname\\\";s:5:\\\"nom13\\\";s:27:\\\"\\0App\\\\Entity\\\\Users\\0firstname\\\";s:8:\\\"prenom13\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0comments\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:24:\\\"\\0App\\\\Entity\\\\Users\\0tricks\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:29:\\\"\\0App\\\\Entity\\\\Users\\0is_verified\\\";b:0;s:28:\\\"\\0App\\\\Entity\\\\Users\\0created_at\\\";O:17:\\\"DateTimeImmutable\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-06-20 10:49:21.292173\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"no-replay@monsite.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"email13@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:49:\\\"Activation de votre compte sur le site snowtricks\\\";s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2023-06-20 10:49:23', '2023-06-20 10:49:23', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":4:{i:0;s:25:\\\"emails/register.html.twig\\\";i:1;N;i:2;a:1:{s:4:\\\"user\\\";O:16:\\\"App\\\\Entity\\\\Users\\\":10:{s:20:\\\"\\0App\\\\Entity\\\\Users\\0id\\\";i:100;s:23:\\\"\\0App\\\\Entity\\\\Users\\0email\\\";s:19:\\\"email14@hotmail.com\\\";s:23:\\\"\\0App\\\\Entity\\\\Users\\0roles\\\";a:0:{}s:26:\\\"\\0App\\\\Entity\\\\Users\\0password\\\";s:60:\\\"$2y$13$8mmIeLmk46ifAK.vtlgQV.eH.qM2dhqB2jShWQZ3ec/JgvySEYh9W\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0lastname\\\";s:5:\\\"nom14\\\";s:27:\\\"\\0App\\\\Entity\\\\Users\\0firstname\\\";s:8:\\\"prenom14\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0comments\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:24:\\\"\\0App\\\\Entity\\\\Users\\0tricks\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:29:\\\"\\0App\\\\Entity\\\\Users\\0is_verified\\\";b:0;s:28:\\\"\\0App\\\\Entity\\\\Users\\0created_at\\\";O:17:\\\"DateTimeImmutable\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-06-29 07:55:52.673029\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"no-replay@monsite.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"email14@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:49:\\\"Activation de votre compte sur le site snowtricks\\\";s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2023-06-29 07:55:53', '2023-06-29 07:55:53', NULL),
(3, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":4:{i:0;s:25:\\\"emails/register.html.twig\\\";i:1;N;i:2;a:1:{s:4:\\\"user\\\";O:16:\\\"App\\\\Entity\\\\Users\\\":10:{s:20:\\\"\\0App\\\\Entity\\\\Users\\0id\\\";i:101;s:23:\\\"\\0App\\\\Entity\\\\Users\\0email\\\";s:19:\\\"email15@hotmail.com\\\";s:23:\\\"\\0App\\\\Entity\\\\Users\\0roles\\\";a:0:{}s:26:\\\"\\0App\\\\Entity\\\\Users\\0password\\\";s:60:\\\"$2y$13$9CBBBzYcP46wgksc8577te58bmHqr/GR/GGoerFiNrJnvWxO7PYHO\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0lastname\\\";s:5:\\\"nom15\\\";s:27:\\\"\\0App\\\\Entity\\\\Users\\0firstname\\\";s:8:\\\"prenom15\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0comments\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:24:\\\"\\0App\\\\Entity\\\\Users\\0tricks\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:29:\\\"\\0App\\\\Entity\\\\Users\\0is_verified\\\";b:0;s:28:\\\"\\0App\\\\Entity\\\\Users\\0created_at\\\";O:17:\\\"DateTimeImmutable\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-06-29 08:06:09.595119\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"no-replay@monsite.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"email15@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:49:\\\"Activation de votre compte sur le site snowtricks\\\";s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2023-06-29 08:06:10', '2023-06-29 08:06:10', NULL),
(4, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":4:{i:0;s:25:\\\"emails/register.html.twig\\\";i:1;N;i:2;a:1:{s:4:\\\"user\\\";O:16:\\\"App\\\\Entity\\\\Users\\\":10:{s:20:\\\"\\0App\\\\Entity\\\\Users\\0id\\\";i:102;s:23:\\\"\\0App\\\\Entity\\\\Users\\0email\\\";s:19:\\\"email16@hotmail.com\\\";s:23:\\\"\\0App\\\\Entity\\\\Users\\0roles\\\";a:0:{}s:26:\\\"\\0App\\\\Entity\\\\Users\\0password\\\";s:60:\\\"$2y$13$WT2A7trXzPiAZwrcD0vt1uPTjK5zYon3SlA5Rvn/E4zJKEMPlWgm6\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0lastname\\\";s:5:\\\"nom16\\\";s:27:\\\"\\0App\\\\Entity\\\\Users\\0firstname\\\";s:8:\\\"prenom16\\\";s:26:\\\"\\0App\\\\Entity\\\\Users\\0comments\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:24:\\\"\\0App\\\\Entity\\\\Users\\0tricks\\\";O:33:\\\"Doctrine\\\\ORM\\\\PersistentCollection\\\":2:{s:13:\\\"\\0*\\0collection\\\";O:43:\\\"Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\\":1:{s:53:\\\"\\0Doctrine\\\\Common\\\\Collections\\\\ArrayCollection\\0elements\\\";a:0:{}}s:14:\\\"\\0*\\0initialized\\\";b:1;}s:29:\\\"\\0App\\\\Entity\\\\Users\\0is_verified\\\";b:0;s:28:\\\"\\0App\\\\Entity\\\\Users\\0created_at\\\";O:17:\\\"DateTimeImmutable\\\":3:{s:4:\\\"date\\\";s:26:\\\"2023-06-29 12:55:12.115689\\\";s:13:\\\"timezone_type\\\";i:3;s:8:\\\"timezone\\\";s:3:\\\"UTC\\\";}}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:21:\\\"no-replay@monsite.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:19:\\\"email16@hotmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:49:\\\"Activation de votre compte sur le site snowtricks\\\";s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2023-06-29 12:55:14', '2023-06-29 12:55:14', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `IDX_E1D902C1A76ED395` (`user_id`),
  KEY `IDX_E1D902C112469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tricks`
--

INSERT INTO `tricks` (`id`, `name`, `description`, `created_at`, `category_id`, `user_id`, `slug`) VALUES
(135, 'Trick1 modifi', 'Description1', '2023-07-18 06:20:51', 180, 90, 'Trick1-modifi'),
(136, 'Trick1', 'Description1', '2023-07-18 06:21:02', 180, 90, 'Trick1'),
(139, 'Japan', 'saisie de l\'avant de la planche, avec la main avant, du côté de la carre frontside', '2023-07-18 18:31:40', 186, 90, 'Japan'),
(141, 'un joli trick', 'un très joli trick', '2023-07-24 19:38:22', 181, 90, 'un-joli-trick'),
(142, 'Trick5', 'description trick5', '2023-07-25 06:25:04', 181, 90, 'Trick5'),
(144, 'trick2', 'description 1', '2023-07-25 07:23:17', 181, 90, 'trick2');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_verified` tinyint(1) NOT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `lastname`, `firstname`, `created_at`, `is_verified`, `reset_token`, `avatar_url`) VALUES
(90, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$Hp7MOGjH/BZojviP5CP6vOIr3oUmm5B74M1VX/vSdffSRE.0nivJG', 'kaa', 'zayn', '2023-06-17 16:23:25', 1, '', NULL),
(109, 'email23@hotmail.com', '[\"ROLE_TRICK_ADMIN\"]', '$2y$13$TbrupoIkqN1TgXGs05ch7.L53dSud0E.LpRs4/ihrO29/rI3uRFGm', 'nom23', 'prenom23', '2023-06-30 07:10:06', 1, '', NULL),
(112, 'email26@hotmail.com', '[]', '$2y$13$1b3apKtzizBRsBmspnduJOD9zaqDpx6ec4gYXFinGv0t3VzNz/jIm', 'nom26', 'prenom26', '2023-06-30 10:24:32', 0, '', NULL),
(114, 'email28@hotmail.com', '[]', '$2y$13$rG0MCtqv39382KLN..ISqeT3ZN0isyCa0Mhh6dNBw9WqRyPDrOACa', 'nom28', 'prenom28', '2023-06-30 10:40:12', 1, '', NULL),
(115, 'email29@hotmail.com', '[]', '$2y$13$wjH0hF5WbPcJ23iDk8NfMuUwF5li6M3JL9U0ZzbY9TCfdvD85kXXO', 'nom29', 'prenom29', '2023-06-30 10:42:57', 1, '', NULL),
(117, 'email31@hotmail.com', '[]', '$2y$13$KVuaClWZDarifisTPj2Dqus4ihoCSp2GAmC8rB2E6q4HstvEnTpF6', 'nom31', 'prenom31', '2023-06-30 10:48:25', 0, '', NULL),
(118, 'email32@hotmail.com', '[]', '$2y$13$Ue2ZDVflkEBgbCwFEQ8WcO.S09SpvXm6IicSyjrKf/liL7OUZR/Ce', 'nom32', 'prenom32', '2023-07-02 09:26:17', 0, '', NULL),
(119, 'email33@hotmail.com', '[]', '$2y$13$Tn/DUXcyLcfcIxR7ErSrE.6OdS3ken/IjUTCKA5V2/E5jnNhS4h96', 'nom33', 'prenom33', '2023-07-02 13:14:05', 1, 'BIOb8VZseCZwzTVDNz_P9M_AHfOOZg24_Oh69G-TDZU', NULL),
(120, 'email34@hotmail.com', '[]', '$2y$13$Lnr4mFmO4eDKUMWysUwwsezCCYr/Bmuhg2bEVBVIKeQ/DnyF.APIW', 'nom34', 'prenom34', '2023-07-03 07:28:25', 1, '', NULL),
(124, 'email40@hotmail.com', '[]', '$2y$13$nhLa12ru4hjcjME.Wx.gjeGOvrsMlJcxk3tOhvN/Z42eey78vGBq6', 'nom40', 'prenom40', '2023-07-22 16:35:27', 1, '', NULL),
(125, 'email41@hotmail.com', '[]', '$2y$13$pz58.UtJo/E1fHqFyxogweXbZ0EnodF6xGJiBY.6qLipy1PzQayX2', 'nom41', 'prenom41', '2023-07-22 18:03:07', 0, '', NULL),
(126, 'email42@hotmail.com', '[]', '$2y$13$Md99ajcQDvyqg0DVyAcJBucFQaLZA2ED4WBDS2EYbUQyCShydlGdO', 'nom42', 'prenom42', '2023-07-22 18:43:00', 0, '', NULL),
(127, 'email43@hotmail.com', '[]', '$2y$13$XVxrTfVkKLyJYa0sTaMhSOjcLaimn0g2LjEpMZl7wv58yoffd8snK', 'nom43', 'prenom43', '2023-07-22 18:47:35', 1, '', NULL),
(128, 'email44@hotmail.com', '[]', '$2y$13$6K.e13l/I3R59fmphvpBpuV9UsjzuP.o2Z8itDv9ueJlO1Z2pThpa', 'nom44', 'prenom44', '2023-07-25 06:20:30', 0, '', NULL),
(129, 'email45@hotmail.com', '[]', '$2y$13$nhr0lhyowlRw9rmV759.KekZo50Zm1S.d19UKCcf93ze2bhD5wwam', 'nom45', 'prenom45', '2023-07-25 07:54:06', 1, '', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_5F9E962AB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_E01FBE6AB281BE2E` FOREIGN KEY (`trick_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `FK_E1D902C112469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `FK_E1D902C1A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
