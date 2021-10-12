-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: database:3306
-- Generation Time: Aug 16, 2020 at 09:55 AM
-- Server version: 8.0.21
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `InfoTest`
--
CREATE DATABASE IF NOT EXISTS `InfoTest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `InfoTest`;

-- --------------------------------------------------------

--
-- Table structure for table `categorie_keyword`
--

DROP TABLE IF EXISTS `categorie_keyword`;
CREATE TABLE IF NOT EXISTS `categorie_keyword` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `keyword_Keyword` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_Denumire` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Categorie_Keyword_Keywords_Keyword` (`keyword_Keyword`),
  KEY `fk_Categorie_Keyword_Categorii_Denumire` (`categorie_Denumire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorii`
--

DROP TABLE IF EXISTS `categorii`;
CREATE TABLE IF NOT EXISTS `categorii` (
  `Denumire` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Descriere` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`Denumire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorii`
--

INSERT INTO `categorii` (`Denumire`, `Descriere`) VALUES
('Incalzire', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comentarii`
--

DROP TABLE IF EXISTS `comentarii`;
CREATE TABLE IF NOT EXISTS `comentarii` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `Titlu` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Continut` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Autor` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `comentarii_id_unique` (`id`),
  UNIQUE KEY `comentarii_titlu_unique` (`Titlu`),
  KEY `fk_Comentarii_Useri_Email` (`Autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

DROP TABLE IF EXISTS `keywords`;
CREATE TABLE IF NOT EXISTS `keywords` (
  `Keyword` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Postare` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Keyword`),
  KEY `fk_Keywords_Postari_Slug` (`Postare`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_15_101847_create_useri_table', 1),
(2, '2019_12_15_153831_create_comentarii_table', 1),
(3, '2019_12_15_191926_create_postari_table', 1),
(4, '2019_12_15_192629_create_categorii_table', 1),
(5, '2019_12_15_194112_create_keywords_table', 1),
(6, '2019_12_15_194617_create_categorie_keyword_table', 1),
(7, '2019_12_16_092410_add_foreign_keys_to_comentarii', 1),
(8, '2019_12_16_092603_add_foreign_keys_to_postari', 1),
(9, '2019_12_16_092825_add_foreign_keys_to_keywords', 1),
(10, '2019_12_16_092914_add_foreign_keys_to_categorii_keywords', 1),
(11, '2019_12_19_124147_create_roles_table', 1),
(12, '2019_12_19_124625_create_role_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `postari`
--

DROP TABLE IF EXISTS `postari`;
CREATE TABLE IF NOT EXISTS `postari` (
  `slug` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Titlu` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Continut` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Autor` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Categorie` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`slug`),
  KEY `fk_Postari_Useri_Email` (`Autor`),
  KEY `fk_Postari_Categorii_Denumire` (`Categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postari`
--

INSERT INTO `postari` (`slug`, `Titlu`, `Continut`, `Autor`, `Categorie`, `created_at`, `updated_at`) VALUES
('suma', 'Suma', '<p style=\"font-size:20pt;\">Sa se calculeze suma unor numere date.</p>\r\n<p></p><table class=\"table table-bordered\"><tbody><tr><td style=\"text-align: center;\">suma.in</td><td style=\"text-align: center;\">suma.out</td></tr><tr><td><p>4</p><p><span style=\"font-size: 0.9375rem; font-weight: initial;\">2 3 1 7</span></p></td><td>13</td></tr></tbody></table><p></p>', 'admin@infotest.ro', 'Incalzire', '2020-07-30 13:11:57', '2020-08-02 11:54:35');

-- --------------------------------------------------------

--
-- Table structure for table `probleme`
--

DROP TABLE IF EXISTS `probleme`;
CREATE TABLE IF NOT EXISTS `probleme` (
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`nume`),
  UNIQUE KEY `probleme_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `probleme`
--

INSERT INTO `probleme` (`nume`, `location`, `slug`, `thumbnail`) VALUES
('suma', '/opt/solutions/suma', 'suma', '/var/www/html/public/upload/images/image_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriere` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role`, `descriere`, `created_at`, `updated_at`) VALUES
('Admin', 'Rol principal de administrare a platformei', '2020-07-28 12:35:34', '2020-07-28 12:35:34'),
('Student', 'Rol destinat elevilor/studentilor', '2020-07-28 12:35:34', '2020-07-28 12:35:34'),
('Teacher', 'Rol destinat profesorilor', '2020-07-28 12:35:34', '2020-07-28 12:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_Email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Role_User_Roles_role` (`role_role`),
  KEY `fk_Role_User_Useri_Email` (`user_Email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_role`, `user_Email`) VALUES
(1, 'Student', 'tiberiu.petre@hotmail.com'),
(2, 'Admin', 'admin@infotest.ro'),
(3, 'Teacher', 'tiberiu.petrickah@gmail.com'),
(4, 'Student', 'tiberiu.petrickah@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `setari`
--

DROP TABLE IF EXISTS `setari`;
CREATE TABLE IF NOT EXISTS `setari` (
  `Obtiune` varchar(50) CHARACTER SET utf16 COLLATE utf16_romanian_ci NOT NULL,
  `Valoare` varchar(250) COLLATE utf16_romanian_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf16 COLLATE=utf16_romanian_ci;

--
-- Dumping data for table `setari`
--

INSERT INTO `setari` (`Obtiune`, `Valoare`) VALUES
('current_theme', 'Snipp');

-- --------------------------------------------------------

--
-- Table structure for table `solutii`
--

DROP TABLE IF EXISTS `solutii`;
CREATE TABLE IF NOT EXISTS `solutii` (
  `ID` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `score` int NOT NULL,
  `utilizator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `problema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_solutii_has_user` (`utilizator`),
  KEY `fk_solutie_has_problema` (`problema`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solutii`
--

INSERT INTO `solutii` (`ID`, `score`, `utilizator`, `problema`) VALUES
(1, 100, 'admin@infotest.ro', 'suma'),
(2, 100, 'tiberiu.petre@hotmail.com', 'suma'),
(3, 100, 'tiberiu.petre@hotmail.com', 'suma');

-- --------------------------------------------------------

--
-- Table structure for table `useri`
--

DROP TABLE IF EXISTS `useri`;
CREATE TABLE IF NOT EXISTS `useri` (
  `Email` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nume` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Prenume` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `useri_username_unique` (`Username`),
  UNIQUE KEY `useri_auth_token_unique` (`auth_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `useri`
--

INSERT INTO `useri` (`Email`, `Username`, `Password`, `Nume`, `Prenume`, `auth_token`) VALUES
('admin@infotest.ro', 'Administrator', '$2y$10$fZK/4mKS22Bd5cvc8vsSCOkMYkb7fEzK7SrhllAKCCGVDF/O3ACaq', NULL, NULL, '769a10d3-2c6d-45f6-937a-7c6193af55d9'),
('tiberiu.petre@hotmail.com', 'Petrickah', '$2y$10$FsxhXqGWGDFz0QsUrs1n9.x9cFvSurpm3Jw6MNvszStpdqOxBscCW', NULL, NULL, '7568dfbb-60f5-47b4-975f-5985f6c9731b'),
('tiberiu.petrickah@gmail.com', 'Tiberiu', '$2y$10$dA37dFYu.tfi.UXXnrAuJ.o5M3kxbM8GfUozuqcWzokk9p/9U4B6K', 'Petre', 'Tiberiu', 'be03ad37-ff1d-4f3a-a640-eaeba3b4525a');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categorie_keyword`
--
ALTER TABLE `categorie_keyword`
  ADD CONSTRAINT `fk_Categorie_Keyword_Categorii_Denumire` FOREIGN KEY (`categorie_Denumire`) REFERENCES `categorii` (`Denumire`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Categorie_Keyword_Keywords_Keyword` FOREIGN KEY (`keyword_Keyword`) REFERENCES `keywords` (`Keyword`) ON DELETE CASCADE;

--
-- Constraints for table `comentarii`
--
ALTER TABLE `comentarii`
  ADD CONSTRAINT `fk_Comentarii_Useri_Email` FOREIGN KEY (`Autor`) REFERENCES `useri` (`Email`) ON DELETE CASCADE;

--
-- Constraints for table `keywords`
--
ALTER TABLE `keywords`
  ADD CONSTRAINT `fk_Keywords_Postari_Slug` FOREIGN KEY (`Postare`) REFERENCES `postari` (`slug`) ON DELETE CASCADE;

--
-- Constraints for table `postari`
--
ALTER TABLE `postari`
  ADD CONSTRAINT `fk_Postari_Categorii_Denumire` FOREIGN KEY (`Categorie`) REFERENCES `categorii` (`Denumire`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Postari_Useri_Email` FOREIGN KEY (`Autor`) REFERENCES `useri` (`Email`) ON DELETE CASCADE;

--
-- Constraints for table `probleme`
--
ALTER TABLE `probleme`
  ADD CONSTRAINT `fk_probleme_is_postare` FOREIGN KEY (`slug`) REFERENCES `postari` (`slug`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `fk_Role_User_Roles_role` FOREIGN KEY (`role_role`) REFERENCES `roles` (`role`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_Role_User_Useri_Email` FOREIGN KEY (`user_Email`) REFERENCES `useri` (`Email`) ON DELETE CASCADE;

--
-- Constraints for table `solutii`
--
ALTER TABLE `solutii`
  ADD CONSTRAINT `fk_solutie_has_problema` FOREIGN KEY (`problema`) REFERENCES `probleme` (`nume`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_solutii_has_user` FOREIGN KEY (`utilizator`) REFERENCES `useri` (`Email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
