-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 04:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--
CREATE DATABASE IF NOT EXISTS `survey` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `survey`;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `answer`
--

TRUNCATE TABLE `answer`;
--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `user_id`, `question_id`, `survey_id`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 6, '\"Oneens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(2, 1, 11, 6, '\"Volledig eens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(3, 1, 12, 6, '\"Volledig oneens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(4, 1, 13, 6, '\"Volledig eens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(5, 1, 14, 6, '\"Oneens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(6, 1, 15, 6, '\"Noch oneens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(7, 1, 16, 6, '\"Eens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(8, 1, 17, 6, '\"Noch oneens\"', '2017-04-13 15:39:51', '2017-04-13 15:39:51'),
(9, 1, 10, 6, '\"Oneens\"', '2017-04-13 15:46:58', '2017-04-13 15:46:58'),
(10, 1, 11, 6, '\"Oneens\"', '2017-04-13 15:46:58', '2017-04-13 15:46:58'),
(11, 1, 12, 6, '\"Oneens\"', '2017-04-13 15:46:58', '2017-04-13 15:46:58'),
(12, 1, 13, 6, '\"Oneens\"', '2017-04-13 15:46:59', '2017-04-13 15:46:59'),
(13, 1, 14, 6, '\"Oneens\"', '2017-04-13 15:46:59', '2017-04-13 15:46:59'),
(14, 1, 15, 6, '\"Oneens\"', '2017-04-13 15:46:59', '2017-04-13 15:46:59'),
(15, 1, 16, 6, '\"Oneens\"', '2017-04-13 15:46:59', '2017-04-13 15:46:59'),
(16, 1, 17, 6, '\"Oneens\"', '2017-04-13 15:46:59', '2017-04-13 15:46:59'),
(17, NULL, 10, 6, '\"Volledig eens\"', '2017-04-13 16:25:56', '2017-04-13 16:25:56'),
(18, NULL, 11, 6, '\"Volledig oneens\"', '2017-04-13 16:25:56', '2017-04-13 16:25:56'),
(19, NULL, 12, 6, '\"Volledig eens\"', '2017-04-13 16:25:56', '2017-04-13 16:25:56'),
(20, NULL, 13, 6, '\"Oneens\"', '2017-04-13 16:25:57', '2017-04-13 16:25:57'),
(21, NULL, 14, 6, '\"Volledig eens\"', '2017-04-13 16:25:57', '2017-04-13 16:25:57'),
(22, NULL, 15, 6, '\"Noch oneens\"', '2017-04-13 16:25:57', '2017-04-13 16:25:57'),
(23, NULL, 16, 6, '\"Oneens\"', '2017-04-13 16:25:57', '2017-04-13 16:25:57'),
(24, NULL, 17, 6, '\"Eens\"', '2017-04-13 16:25:57', '2017-04-13 16:25:57'),
(25, NULL, 21, 7, '\"eens\"', '2017-04-13 16:37:12', '2017-04-13 16:37:12'),
(26, NULL, 22, 7, '\"5\"', '2017-04-13 16:37:12', '2017-04-13 16:37:12'),
(27, NULL, 23, 7, '\"oualid\"', '2017-04-13 16:37:12', '2017-04-13 16:37:12'),
(28, NULL, 10, 6, '\"Volledig oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(29, NULL, 11, 6, '\"Volledig oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(30, NULL, 12, 6, '\"Volledig oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(31, NULL, 13, 6, '\"Volledig oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(32, NULL, 14, 6, '\"Volledig eens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(33, NULL, 15, 6, '\"Noch oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(34, NULL, 16, 6, '\"Volledig oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(35, NULL, 17, 6, '\"Volledig oneens\"', '2017-04-18 05:16:39', '2017-04-18 05:16:39'),
(36, NULL, 10, 6, '\"Eens\"', '2017-04-18 05:17:21', '2017-04-18 05:17:21'),
(37, NULL, 11, 6, '\"Noch oneens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(38, NULL, 12, 6, '\"Noch oneens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(39, NULL, 13, 6, '\"Volledig oneens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(40, NULL, 14, 6, '\"Volledig eens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(41, NULL, 15, 6, '\"Eens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(42, NULL, 16, 6, '\"Oneens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(43, NULL, 17, 6, '\"Volledig oneens\"', '2017-04-18 05:17:22', '2017-04-18 05:17:22'),
(44, NULL, 10, 6, '\"Eens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(45, NULL, 11, 6, '\"Noch oneens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(46, NULL, 12, 6, '\"Noch oneens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(47, NULL, 13, 6, '\"Volledig oneens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(48, NULL, 14, 6, '\"Volledig eens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(49, NULL, 15, 6, '\"Eens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(50, NULL, 16, 6, '\"Oneens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(51, NULL, 17, 6, '\"Volledig oneens\"', '2017-04-18 05:17:23', '2017-04-18 05:17:23'),
(52, 1, 10, 6, '\"Volledig eens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(53, 1, 11, 6, '\"Oneens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(54, 1, 12, 6, '\"Volledig eens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(55, 1, 13, 6, '\"Eens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(56, 1, 14, 6, '\"Noch oneens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(57, 1, 15, 6, '\"Oneens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(58, 1, 16, 6, '\"Volledig oneens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35'),
(59, 1, 17, 6, '\"Noch oneens\"', '2017-04-18 09:10:35', '2017-04-18 09:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_08_08_110030_create_survey_table', 1),
('2016_08_08_110206_create_question_table', 1),
('2016_08_09_214240_create_answers_table', 1),
('2017_03_22_191530_create_table_protected_url', 2),
('2017_05_07_134230_create_question_category', 3),
('2017_05_07_134553_add_question_category_name', 4),
('2017_05_07_134922_add_question_category_to_question_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `password_resets`
--

TRUNCATE TABLE `password_resets`;
-- --------------------------------------------------------

--
-- Table structure for table `protected_urls`
--

DROP TABLE IF EXISTS `protected_urls`;
CREATE TABLE `protected_urls` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `protected_urls`
--

TRUNCATE TABLE `protected_urls`;
--
-- Dumping data for table `protected_urls`
--

INSERT INTO `protected_urls` (`id`, `survey_id`, `url`, `created_at`, `updated_at`) VALUES
(1, 5, '70390647d69e1bb52cb4c2ae3e69c236', '2017-04-13 08:33:53', '2017-04-13 08:33:53'),
(2, 6, 'a5476016946ee6d1d17c3be52d5c5b9c', '2017-04-13 08:35:59', '2017-04-13 08:35:59'),
(3, 7, 'ff1b857fdd3ce2538653046879013910', '2017-04-13 16:34:26', '2017-04-13 16:34:26'),
(4, 7, '2689731279f22fd26ab36f4c4dc42c2b', '2017-05-04 08:23:08', '2017-05-04 08:23:08'),
(5, 8, '2c152dbb4de2e6e213c55a3b889de9aa', '2017-05-04 08:26:57', '2017-05-04 08:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(10) UNSIGNED NOT NULL,
  `survey_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `question_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option_name` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `question_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `question`
--

TRUNCATE TABLE `question`;
--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `survey_id`, `user_id`, `title`, `question_type`, `option_name`, `created_at`, `updated_at`, `question_category_id`) VALUES
(10, 6, 1, 'Ik kan mijn eigen ICT-problemen oplossen', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 1),
(11, 6, 1, 'Ik leer gemakkelijk nieuwe dingen over ICT', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 1),
(12, 6, 1, 'Ik blijf op de hoogte van belangrijke ICT-ontwikkelingen', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 2),
(13, 6, 1, 'Ik probeer regelmatig dingen uit met ICT', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 3),
(14, 6, 1, 'Ik ken veel verschillende ICT-toepassingen', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 2),
(15, 6, 1, 'Ik beschik over de technische vaardigheden die ik nodig heb om ICT te gebruiken', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-30 09:14:36', 3),
(16, 6, 1, 'Ik kan mijn eigen ICT-problemen oplossen', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 3),
(17, 6, 1, 'Ik kan mijn eigen ICT-problemen oplossen', 'radio', '[\"Volledig oneens\",\"Oneens\",\"Noch oneens\",\"Eens\",\"Volledig eens\"]', '2017-04-11 17:33:10', '2017-04-11 17:33:10', 2),
(18, 5, 1, 'yaaass', '', '[\"2345\",\"1234\",\"345676\"]', '2017-04-13 08:34:08', '2017-04-13 08:34:08', 3),
(19, 5, 1, '12345678', 'checkbox', '[\"23gvfdfghj\"]', '2017-04-13 08:34:19', '2017-04-13 08:34:19', 2),
(20, 5, 1, '2345678g', 'checkbox', '[\"wesdfgvhj\",\"ggftrfde45r6ty\",\"e4sr56tyuijk\"]', '2017-04-13 08:34:37', '2017-04-13 08:34:37', 2),
(21, 7, 1, 'lol', 'radio', '[\"eens\",\"oneens\"]', '2017-04-13 16:34:43', '2017-04-13 16:34:43', 1),
(22, 7, 1, 'sedgf', 'radio', '[\"5\",\"5\"]', '2017-04-13 16:35:12', '2017-04-13 16:35:12', 3),
(23, 7, 1, 'wat is je naam', 'text', NULL, '2017-04-13 16:35:23', '2017-04-13 16:35:23', 2),
(24, 7, 1, '', '', NULL, '2017-05-04 08:23:11', '2017-05-04 08:23:11', 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_category`
--

DROP TABLE IF EXISTS `question_category`;
CREATE TABLE `question_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `question_category`
--

TRUNCATE TABLE `question_category`;
--
-- Dumping data for table `question_category`
--

INSERT INTO `question_category` (`id`, `created_at`, `updated_at`, `category_name`) VALUES
(1, '2017-05-07 13:55:15', '2017-05-07 13:55:15', '1'),
(2, '2017-05-07 13:55:25', '2017-05-07 13:55:25', '2'),
(3, '2017-05-07 13:55:34', '2017-05-07 13:55:34', '3');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `survey`
--

TRUNCATE TABLE `survey`;
--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `title`, `user_id`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'Vragenlijst', 1, 'ICT vragenlijst', NULL, '2017-04-13 08:35:59', '2017-05-03 06:53:22'),
(7, 'test', 1, 'test', NULL, '2017-05-04 08:23:08', '2017-05-04 08:23:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'oualid', 'oualids1007@gmail.com', '$2y$10$nDoYdrByfcy.tcFYnR9LyuHnqmaRTSUN0swKwVAHgFelOMlhcw1t6', 'DjYZvawkM2z7Ns6ZfJHvT80ewgMNol2fZG2UJpi9V9yPGrpshzAjhBHnJ4LJ', '2017-04-04 10:35:17', '2017-04-13 10:01:53'),
(2, 'heyyy', 'hey@hey.nl', '$2y$10$KMoPux66ACGKMBo334n3ru4/nuViqt445a9YepCjEqul9BGoYPp0y', NULL, '2017-04-09 08:44:23', '2017-04-09 08:44:23'),
(3, 'Test', 't@t.t', '$2y$10$jGns7I5/QDSbHAt6kiOyP.0CktlZEfQ9aERvfjvGk6k8MKSRlXQAa', NULL, '2017-05-07 09:14:23', '2017-05-07 09:14:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `protected_urls`
--
ALTER TABLE `protected_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_survey_id_index` (`survey_id`),
  ADD KEY `question_user_id_index` (`user_id`);

--
-- Indexes for table `question_category`
--
ALTER TABLE `question_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `survey_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `protected_urls`
--
ALTER TABLE `protected_urls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `question_category`
--
ALTER TABLE `question_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
