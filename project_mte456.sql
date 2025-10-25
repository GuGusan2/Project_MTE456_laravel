-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2025 at 11:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_mte456`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_count_view`
--

CREATE TABLE `tbl_count_view` (
  `count_id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_count_view`
--

INSERT INTO `tbl_count_view` (`count_id`, `menu_id`, `timestamp`) VALUES
(1, NULL, '2025-09-14 12:53:29'),
(2, NULL, '2025-09-14 12:53:32'),
(3, NULL, '2025-09-14 12:53:32'),
(4, NULL, '2025-09-14 12:53:33'),
(5, NULL, '2025-09-14 12:53:33'),
(6, NULL, '2025-09-14 12:53:34'),
(7, NULL, '2025-09-14 12:53:34'),
(8, NULL, '2025-09-14 12:53:34'),
(9, NULL, '2025-09-14 12:53:35'),
(10, NULL, '2025-09-14 12:53:35'),
(11, NULL, '2025-09-14 12:55:10'),
(12, NULL, '2025-09-14 13:13:26'),
(13, NULL, '2025-09-14 13:13:49'),
(14, NULL, '2025-09-15 06:09:29'),
(15, NULL, '2025-09-15 06:09:34'),
(16, NULL, '2025-09-15 06:13:28'),
(17, NULL, '2025-09-15 06:13:28'),
(18, NULL, '2025-09-15 06:13:52'),
(19, NULL, '2025-09-15 06:13:52'),
(20, NULL, '2025-09-21 15:37:25'),
(21, NULL, '2025-09-21 17:41:30'),
(22, NULL, '2025-09-22 00:33:58'),
(23, NULL, '2025-09-22 00:34:22'),
(24, NULL, '2025-09-22 00:35:54'),
(25, NULL, '2025-09-22 00:38:34'),
(26, NULL, '2025-09-22 00:59:25'),
(27, NULL, '2025-09-22 01:07:25'),
(28, NULL, '2025-09-22 01:09:17'),
(29, NULL, '2025-09-22 02:02:07'),
(30, NULL, '2025-09-22 02:10:28'),
(31, NULL, '2025-09-22 02:31:01'),
(32, NULL, '2025-09-22 03:00:26'),
(33, NULL, '2025-09-22 03:00:53'),
(34, NULL, '2025-09-22 03:03:05'),
(35, NULL, '2025-09-22 03:03:26'),
(36, NULL, '2025-09-22 04:01:50'),
(37, NULL, '2025-09-22 07:42:06'),
(38, NULL, '2025-09-22 08:28:46'),
(39, NULL, '2025-09-23 09:14:55'),
(40, NULL, '2025-09-23 09:14:56'),
(41, NULL, '2025-09-23 09:44:04'),
(42, NULL, '2025-09-23 09:51:41'),
(43, NULL, '2025-09-23 10:00:00'),
(44, NULL, '2025-09-25 15:10:36'),
(45, NULL, '2025-09-25 15:10:53'),
(46, NULL, '2025-09-25 15:38:06'),
(47, NULL, '2025-09-26 03:52:13'),
(48, NULL, '2025-09-26 08:30:28'),
(49, NULL, '2025-09-26 08:36:48'),
(50, NULL, '2025-09-26 08:46:36'),
(51, NULL, '2025-09-26 08:46:45'),
(52, NULL, '2025-09-26 08:46:49'),
(53, NULL, '2025-09-26 08:46:56'),
(54, NULL, '2025-09-26 14:07:01'),
(55, NULL, '2025-09-26 14:52:02'),
(56, NULL, '2025-09-26 14:52:04'),
(57, NULL, '2025-09-26 14:52:05'),
(58, NULL, '2025-09-26 14:52:13'),
(59, NULL, '2025-09-26 15:30:32'),
(60, NULL, '2025-09-26 15:33:21'),
(61, NULL, '2025-09-26 15:33:50'),
(62, NULL, '2025-09-26 15:35:01'),
(63, NULL, '2025-09-26 15:35:48'),
(64, NULL, '2025-09-26 15:35:56'),
(65, NULL, '2025-09-26 15:36:07'),
(66, NULL, '2025-09-26 15:36:14'),
(67, NULL, '2025-09-26 15:36:24'),
(68, NULL, '2025-09-26 15:36:39'),
(69, NULL, '2025-09-26 15:36:45'),
(70, NULL, '2025-09-26 15:36:49'),
(71, NULL, '2025-09-26 15:37:33'),
(72, NULL, '2025-09-26 15:37:36'),
(73, NULL, '2025-09-26 15:37:46'),
(74, NULL, '2025-09-26 15:37:48'),
(75, NULL, '2025-09-26 15:37:54'),
(76, NULL, '2025-09-26 15:38:03'),
(77, NULL, '2025-09-27 07:20:47'),
(78, NULL, '2025-09-27 07:22:10'),
(79, NULL, '2025-09-27 09:19:41'),
(80, NULL, '2025-09-27 09:19:51'),
(81, NULL, '2025-09-27 09:27:33'),
(82, NULL, '2025-09-27 09:34:05'),
(83, NULL, '2025-09-27 09:42:18'),
(84, NULL, '2025-09-27 09:43:28'),
(85, NULL, '2025-09-27 09:43:51'),
(86, NULL, '2025-09-27 09:48:18'),
(87, NULL, '2025-09-27 09:48:40'),
(88, NULL, '2025-09-27 09:49:33'),
(89, NULL, '2025-09-27 10:12:56'),
(90, NULL, '2025-09-27 10:15:39'),
(91, NULL, '2025-09-27 10:16:04'),
(92, NULL, '2025-09-27 14:54:52'),
(93, NULL, '2025-09-27 15:04:23'),
(94, NULL, '2025-09-27 16:30:34'),
(95, NULL, '2025-09-27 16:31:57'),
(96, NULL, '2025-09-27 16:33:38'),
(97, NULL, '2025-09-28 02:15:41'),
(98, NULL, '2025-09-28 02:15:59'),
(99, NULL, '2025-09-28 02:27:28'),
(100, NULL, '2025-09-28 03:24:50'),
(101, NULL, '2025-09-28 03:26:56'),
(102, NULL, '2025-09-28 19:18:37'),
(103, NULL, '2025-09-28 19:27:28'),
(104, NULL, '2025-09-28 19:33:54'),
(105, NULL, '2025-09-28 19:52:12'),
(106, NULL, '2025-09-28 19:54:29'),
(107, NULL, '2025-10-04 08:30:25'),
(108, NULL, '2025-10-04 08:30:27'),
(109, NULL, '2025-10-04 08:30:28'),
(110, NULL, '2025-10-04 08:30:28'),
(111, NULL, '2025-10-04 08:30:29'),
(112, NULL, '2025-10-04 08:30:29'),
(113, NULL, '2025-10-04 08:30:29'),
(114, NULL, '2025-10-04 08:30:30'),
(115, NULL, '2025-10-04 08:30:30'),
(116, NULL, '2025-10-04 08:30:50'),
(117, NULL, '2025-10-04 08:37:47'),
(118, 2, '2025-10-04 08:41:57'),
(119, 4, '2025-10-04 08:42:04'),
(120, 5, '2025-10-04 08:42:08'),
(121, 25, '2025-10-04 08:42:49'),
(122, NULL, '2025-10-04 08:44:20'),
(123, NULL, '2025-10-04 08:44:55'),
(124, NULL, '2025-10-04 08:45:22'),
(125, 35, '2025-10-04 08:45:26'),
(126, NULL, '2025-10-04 08:46:18'),
(127, NULL, '2025-10-04 08:47:12'),
(128, 33, '2025-10-04 08:47:25'),
(129, 29, '2025-10-04 08:47:31'),
(130, 29, '2025-10-04 08:47:47'),
(131, NULL, '2025-10-04 09:35:40'),
(132, 5, '2025-10-04 09:35:50'),
(133, 5, '2025-10-04 09:35:54'),
(134, NULL, '2025-10-04 09:36:13'),
(135, NULL, '2025-10-04 09:36:18'),
(136, 2, '2025-10-04 09:36:24'),
(137, 2, '2025-10-04 09:36:28'),
(138, 28, '2025-10-04 09:36:38'),
(139, 28, '2025-10-04 09:36:41'),
(140, 28, '2025-10-04 09:36:45'),
(141, 28, '2025-10-04 09:36:48'),
(142, 31, '2025-10-04 09:36:51'),
(143, 31, '2025-10-04 09:36:55'),
(144, 31, '2025-10-04 09:36:58'),
(145, 21, '2025-10-04 09:37:10'),
(146, 21, '2025-10-04 09:37:13'),
(147, NULL, '2025-10-04 09:37:48'),
(148, 2, '2025-10-04 09:37:54'),
(149, 28, '2025-10-04 09:38:07'),
(150, 28, '2025-10-04 09:38:10'),
(151, 5, '2025-10-04 09:38:16'),
(152, 5, '2025-10-04 09:38:20'),
(153, 4, '2025-10-04 09:38:23'),
(154, NULL, '2025-10-04 09:49:47'),
(155, NULL, '2025-10-04 10:20:57'),
(156, NULL, '2025-10-04 16:04:17'),
(157, NULL, '2025-10-05 02:13:14'),
(158, NULL, '2025-10-05 02:20:03'),
(159, NULL, '2025-10-05 02:37:36'),
(160, NULL, '2025-10-05 02:37:43'),
(161, 2, '2025-10-05 02:37:53'),
(162, 2, '2025-10-05 02:37:57'),
(163, 8, '2025-10-05 02:38:01'),
(164, 8, '2025-10-05 02:38:06'),
(165, 8, '2025-10-05 02:38:10'),
(166, 19, '2025-10-05 02:38:20'),
(167, 19, '2025-10-05 02:38:23'),
(168, 20, '2025-10-05 02:38:26'),
(169, 22, '2025-10-05 02:38:30'),
(170, 26, '2025-10-05 02:38:35'),
(171, 28, '2025-10-05 02:38:45'),
(172, 34, '2025-10-05 02:38:50'),
(173, 33, '2025-10-05 02:38:55'),
(174, NULL, '2025-10-05 02:39:18'),
(175, 8, '2025-10-05 02:39:26'),
(176, NULL, '2025-10-05 02:47:55'),
(177, NULL, '2025-10-05 02:48:27'),
(178, NULL, '2025-10-05 02:48:40'),
(179, NULL, '2025-10-05 02:48:47'),
(180, NULL, '2025-10-05 02:52:49'),
(181, NULL, '2025-10-05 02:53:27'),
(182, NULL, '2025-10-05 02:53:36'),
(183, NULL, '2025-10-05 02:53:46'),
(184, NULL, '2025-10-05 02:53:51'),
(185, NULL, '2025-10-05 02:57:45'),
(186, NULL, '2025-10-05 02:57:55'),
(187, NULL, '2025-10-05 03:00:39'),
(188, NULL, '2025-10-05 03:33:22'),
(189, NULL, '2025-10-05 03:33:32'),
(190, NULL, '2025-10-05 03:51:27'),
(191, NULL, '2025-10-05 03:52:02'),
(192, NULL, '2025-10-05 03:52:14'),
(193, NULL, '2025-10-05 03:56:09'),
(194, NULL, '2025-10-05 03:56:39'),
(195, NULL, '2025-10-05 03:56:55'),
(196, NULL, '2025-10-05 03:59:44'),
(197, NULL, '2025-10-05 04:00:38'),
(198, NULL, '2025-10-05 04:07:59'),
(199, NULL, '2025-10-05 04:08:12'),
(200, NULL, '2025-10-05 04:12:57'),
(201, NULL, '2025-10-05 04:14:23'),
(202, NULL, '2025-10-05 04:14:54'),
(203, NULL, '2025-10-05 04:15:13'),
(204, NULL, '2025-10-05 04:16:31'),
(205, NULL, '2025-10-05 04:18:07'),
(206, NULL, '2025-10-05 04:18:13'),
(207, NULL, '2025-10-05 04:22:04'),
(208, NULL, '2025-10-05 04:23:13'),
(209, NULL, '2025-10-05 05:23:54'),
(210, NULL, '2025-10-05 05:32:11'),
(211, NULL, '2025-10-05 05:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_admin`
--

CREATE TABLE `tbl_emp_admin` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_username` varchar(100) NOT NULL,
  `emp_password` varchar(100) NOT NULL,
  `emp_gender` varchar(10) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_phone` varchar(10) NOT NULL,
  `emp_dob` date NOT NULL,
  `role` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `emp_pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_emp_admin`
--

INSERT INTO `tbl_emp_admin` (`emp_id`, `emp_name`, `emp_username`, `emp_password`, `emp_gender`, `emp_email`, `emp_phone`, `emp_dob`, `role`, `date`, `timestamp`, `emp_pic`) VALUES
(7, 'Sawada Tsunayoshi', 'tsuna', '$2y$12$1IG5OnH3Y/5GOPdrbtMAEO0UKTozeoh/41HkVsbw6jCE.quWK/376', 'male', 'sa.tsunayoshi@gmail.com', '1234567890', '2025-09-07', 'admin', '2025-10-11', '2025-10-01 11:04:27', 'uploads/employee/La6uDjBrp716u7BfnTTOtiDifvxhOBdelTNvNu77.jpg'),
(8, 'Sawada Irena', 'irena', '$2y$12$VrpQ0bF9GfdT.D0r2/8rs.TVRp2xxVEyvM4ckbnWP4FY/pr1VSPLK', 'female', 'sa.irena1@mail.com', '1234567890', '2014-05-12', 'staff', '2025-07-05', '2025-10-03 09:46:29', 'uploads/employee/Kvdyd0XWPwQ8EXp7s0lf8wPTTS4iHqGHxc1CFeLl.jpg'),
(10, 'Gokudera Hayato', 'hayato', '$2y$12$aRFvKs3E5TX1n1f87gMl7eqhHpzBrCaMGYulqIMnC3eyJDcwog9aa', 'male', 'go.hayato@mail.com', 's222222222', '2025-09-12', 'staff', '2025-10-01', '2025-09-07 07:28:27', 'uploads/employee/rWt1C20DjxHJSADULQBMdXOlqUWcnJbgSVd3Yp5H.jpg'),
(11, 'Yamamoto Takeshi', 'takeshi2', '$2y$12$IAnSx5KEc5QQeogkXHxVvuhnHCKYlDWLZ0v6wGu0IDRRXM6wwE3iq', 'male', 'ya.takeshi2@mail.com', 's222266666', '2025-07-02', 'staff', '2025-10-11', '2025-09-07 07:57:13', 'uploads/employee/c16IQKTJ1tdqJbpO6Cz7EWFN4sH7FUiwSmg4ohAk.jpg'),
(12, 'Sasagawa Ryohei', 'sasagawa', '$2y$12$AwMn9Xr424hJzh1jCLLD.et1jSWcK3t7lb1yA8S5GFthK4iOxLTwy', 'male', 'ru.sasagawa@mail.com', '1234567899', '1967-11-12', 'admin', '2002-11-12', '2025-09-07 07:58:24', 'uploads/employee/QJFZwbxxP4i6GRcArPh4QdbptqPR0FVjgBvQGT3W.png'),
(13, 'Hibari Kyoya', 'kyoya', '$2y$12$f3mhmmcjJF9vV.BCaJz0/eZbBdiX9YjrW6dJh/46Kf9NJJv7VPw3K', 'male', 'hi.kyoya@mail.com', '1234560000', '2003-11-05', 'admin', '2100-12-08', '2025-09-07 07:59:57', 'uploads/employee/XBe2RUKJWGphPskXKNjRsbMnp8ype2JwqcJd8O1O.jpg'),
(14, 'Arthy', 'arthy2', '$2y$12$39g94bb5Vl1vfqhCKZpI6.u3.ymiV395hTMmBqmWGiCZ5yjTM1cjW', 'female', 'arthy2@mail.com', '1234567890', '2004-11-12', 'staff', '2015-02-22', '2025-09-08 09:49:42', 'uploads/employee/l1sU665mtMMnCjj636P18WFflPaXx1ymig6O5xsi.jpg'),
(15, 'uto tanomi', 'uto', '$2y$12$RkHPyi1H9g7miLWZTJipZOzQxeApqpk4NH3saN8w./esvyu5omILq', 'female', 'uto@test.com', '1111111111', '2025-10-10', 'staff', '2025-10-11', '2025-10-03 09:44:47', 'uploads/employee/EflVJUSOZjtegStn9EbCjy7HHKTrvpf3TTXai6dT.jpg'),
(17, 'crey', 'crey@mail.com', '$2y$12$Y30Oc26H4y.PppTE2VKUaeGXaG5wl.xjYdYOmQixG1as0/tbygWPC', 'male', 'crey@mail.com', '0282585246', '2002-11-02', 'staff', '2025-12-05', '2025-09-12 06:40:16', 'uploads/employee/utlWkSAq0IVssDCnvocFxPQiXi1O0CYY9bP6sx2G.jpg'),
(20, 'Stephan Reinux', 'stephan', '$2y$12$DhWRdclkZnMwFyGVX4d/BOduH4BPLCLw3UCDF0cmlWTSMiN5guDDq', 'male', 'admin@gmail.com', '1111111111', '2003-10-29', 'admin', '2025-09-22', '2025-10-05 04:17:33', 'uploads/employee/zqhW8WMcA8jFi1yqeUfrFrPYt3uxYniCS08WD7Ze.jpg'),
(21, 'หลวงพี่', 'luangpee', '$2y$12$Wf8A/isPk0ICUjgmG3mdRu84vlt1qG09G43RyB69KUDbYOjr3jeeC', 'male', 'luangpee@gmail.com', '1234567890', '1200-12-12', 'staff', '2502-12-12', '2025-10-05 04:17:46', 'uploads/employee/WcUUohY904zjpdvuKVwo3DKLj92oJRsbJIDvxZrY.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorite`
--

CREATE TABLE `tbl_favorite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mem_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_favorite`
--

INSERT INTO `tbl_favorite` (`id`, `mem_id`, `menu_id`, `timestamp`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-09-28 15:07:35', '2025-09-28 15:07:35', '2025-09-28 15:07:35'),
(2, 1, 2, '2025-09-28 15:07:35', '2025-09-28 15:07:35', '2025-09-28 15:07:35'),
(3, 13, 33, NULL, '2025-09-29 07:44:59', '2025-09-29 07:44:59'),
(12, 23, 35, NULL, '2025-09-30 06:32:22', '2025-09-30 06:32:22'),
(14, 23, 32, NULL, '2025-09-30 06:32:26', '2025-09-30 06:32:26'),
(15, 13, 35, NULL, '2025-10-01 08:33:54', '2025-10-01 08:33:54'),
(17, 23, 26, NULL, '2025-10-02 09:59:21', '2025-10-02 09:59:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
  `mem_id` int(11) NOT NULL,
  `mem_name` varchar(100) NOT NULL,
  `mem_username` varchar(100) NOT NULL,
  `mem_password` varchar(255) NOT NULL,
  `mem_phone` varchar(10) NOT NULL,
  `mem_gender` varchar(10) NOT NULL,
  `mem_email` varchar(100) NOT NULL,
  `mem_dob` date NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'member',
  `point` int(11) DEFAULT 100,
  `emp_id` int(11) DEFAULT NULL,
  `mem_pic` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`mem_id`, `mem_name`, `mem_username`, `mem_password`, `mem_phone`, `mem_gender`, `mem_email`, `mem_dob`, `role`, `point`, `emp_id`, `mem_pic`, `timestamp`) VALUES
(7, 'Uni Jislonero', 'uni-chan', '$2y$12$Xqoiuc19d3blsjrzuUc4AO/hsK/ZuTnk3EomyjHJ2FQbOvr9JF36y', '123456addd', 'female', 'uni@mail.com', '2003-11-02', 'member', NULL, NULL, 'uploads/member/sA1af6AAH4chywhkEdqi2wI7kQTSwvwDfibC9HNY.jpg', '2025-09-07 07:46:28'),
(9, 'Weerawat Phapukdee', 'weewy', '$2y$12$sQ9jmunHEDRHVWac.MloceOXwu/l2dONvmF4GJHFnwHgmjTDhJYsO', '1235467899', 'male', 'ph.weerawat_st@tni.ac.th', '2004-10-10', 'member', NULL, NULL, 'uploads/member/hgYxlQWScmi4yEUzGUCHNnVmdWzKIKdcvFW86XQn.jpg', '2025-09-07 07:49:06'),
(10, 'Arthanasia De Arljia Obilia', 'arthy', '$2y$12$0nhczFuVxiRbvMsqmSFh9O9FIU0SprGq.MANePKZ8ydLp6zxoiTp.', '1111111111', 'female', 'arthy@mqil.com', '1987-10-21', 'member', NULL, NULL, 'uploads/member/ll2blsl52r4ntvGDoF93zLxjNk2cqK5pt8HmzL2j.jpg', '2025-09-07 07:51:05'),
(11, 'Terrey', 'terra', '$2y$12$T6VFBFBrQKCBvvX7SfFdE.N3CCehbDLkqJDxQ5zxsIWUTVFCpUT/C', '1233555555', 'male', 'terrey@mail.com', '2004-11-11', 'member', NULL, NULL, 'uploads/member/3KM4X17Pwf3Ou1Y8HYMHl3337OA0Zr3AyWbGt9E6.png', '2025-09-07 07:52:18'),
(12, 'Sopherim', 'sopherim', '$2y$12$LDeNDaaSzucC3nDUIJQh2Ovdmyqb5hRV8NombCd55TtQ5/eMSm4AS', '0879545632', 'male', 'so@mail.com', '2002-04-04', 'member', NULL, NULL, 'uploads/member/fONUhXs8xnYXqWEtptr3T8oZLpjD66IPVtoSMO8e.jpg', '2025-09-26 09:49:56'),
(14, 'Jin-Song', 'Jin2', '$2y$12$QVaGfbwsvpSdvtuqdt8M3eCHYIfgyppwSp2v59exgj3GAQNzR2A.2', '1023122222', 'male', 'js@gmail.com', '2004-12-23', 'member', 100, NULL, 'uploads/member/0cvaPBZMl2zMJXIPo4HKNYww8rAjZiBDt80RwrZL.jpg', '2025-09-26 09:55:48'),
(33, 'Gemonon', 'genome', '$2y$12$tKZbLGXQhD.VoFsNiJE1e.ADxDFAW0jzvpRuEbaxWEBon1ircMr1G', '1231312311', 'female', 'mee@gmail.com', '2025-07-27', 'member', 100, NULL, 'uploads/member/XTaV2x09vrxv0VwYjqh6dbtiLrCMtL5PaEllhrQg.jpg', '2025-10-05 04:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `menu_type` varchar(20) NOT NULL,
  `menu_pic` varchar(100) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `menu_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `menu_name`, `price`, `menu_type`, `menu_pic`, `emp_id`, `mem_id`, `timestamp`, `menu_detail`) VALUES
(2, 'แกงกะหรี่ปู', 50.00, 'food', 'uploads/menu/noUH9IPYlp5GohyqVD8QhEmzXJybK5HB1Ttgiu82.png', NULL, NULL, '2025-09-05 14:26:16', 'Crab Curry – แกงกะหรี่ปูรสเข้มข้น หอมเครื่องเทศไทย เนื้อปูสดหวานฉ่ำ คลุกเคล้ากับเครื่องแกงสูตรพิเศษ รสชาติกลมกล่อม จัดจ้าน กินคู่กับข้าวสวยร้อน ๆ ลงตัวที่สุด'),
(4, 'กระเพราเนื้อริปอาย', 250.00, 'food', 'uploads/menu/aiRFIAWDF7bNhWQ7Y98gbDWtEYRMTq7wzLqdEIdc.png', NULL, NULL, '2025-09-05 14:40:29', 'เนื้อริบอายคัดพิเศษ หั่นชิ้นพอดีคำ ผัดกับใบกระเพราสดหอมกรุ่น และกระเทียมเจียวจนหอม เสิร์ฟร้อน ๆ พร้อมซอสปรุงรสสูตรเฉพาะ รสชาติกลมกล่อม เผ็ดร้อนเล็กน้อย สีสันสดสวย น่าลิ้มลอง'),
(5, 'สันคอหมูสับปะรด', 259.00, 'food', 'uploads/menu/zLj5COiyckHhPKvJq5C5z0tVXW5SJ9YgYSwuDIha.png', NULL, NULL, '2025-09-05 14:38:40', 'สันคอหมูคัดพิเศษชิ้นโต ผัดจนหอมทอง ผสมสับปะรดสดฉ่ำสีเหลืองทองและหอมหัวใหญ่หวานกรอบ รสชาติกลมกล่อม หวาน เค็ม เปรี้ยว ครบรสในทุกคำ สีสันสดใส น่าลิ้มลอง'),
(6, 'กุ้งดองน้ำปลากวน', 295.00, 'food', 'uploads/menu/pAiQmIoQdeAKO4gTzToEPSGevwumAsu72iy4jyA2.png', NULL, NULL, '2025-09-05 14:35:28', 'กุ้งสดตัวใหญ่ ดองในน้ำปลากวนรสเข้มข้น สีสันน่ากิน ตกแต่งพริกสด ผักชีซอย และหอมแดงซอย เติมรสหวาน เค็ม เปรี้ยว ลงตัว กินเพลินเป็นกับแกล้ม หรือเรียกน้ำย่อย'),
(7, 'ปูทะเลไข่ดองน้ำปลากวน', 375.00, 'food', 'uploads/menu/I7K5LXDWfKGQSDrXZQ76p7DeGejGgJZPHDe9G6By.png', NULL, NULL, '2025-09-05 14:44:51', 'ปูทะเลไข่แน่น สดใหม่ คัดพิเศษ ดองในน้ำปลากวนรสกลมกล่อม หวาน เค็ม เปรี้ยวลงตัว ตกแต่งด้วยมะนาวซีกและผักชีสด สีสันสดใส เนื้อปูแน่น ไข่ปูสีส้มทอง ลิ้มรสความพรีเมียมแบบไทยแท้ในทุกคำ'),
(8, 'แซลมอนดอง', 395.00, 'food', 'uploads/menu/inMOhnoz5R9hjRvEMYyO6jevdGgoDIcj3lgzFY5z.png', NULL, NULL, '2025-09-05 14:47:42', 'แซลมอนสดคุณภาพสูง สไลซ์บาง เรียงอย่างพิถีพิถันบนจานสีขาว เงางามด้วยน้ำดองสูตรพิเศษ ตกแต่งด้วยมะนาวซีก ผักชีสด และหอมหัวใหญ่ซอย รสชาติกลมกล่อม หวาน เค็ม เปรี้ยว ครบในทุกคำ สีสันสดใส เหมาะกับลิ้มรสความพรีเมียมแบบญี่ปุ่น-ไทยร่วมสมัย'),
(9, 'ขนมผักกาด สูตรฮ่องกง', 185.00, 'food', 'uploads/menu/SA4E5sTkPcEspbP3SHTOuDZjgxmquX0Y35WT0rDe.png', NULL, NULL, '2025-09-05 14:51:17', 'ขนมผักกาดสูตรฮ่องกง ทำจากผักกาดขาวสดกรอบผสมแป้งสูตรเฉพาะของร้าน แผ่นบางเนียนสวย ห่อไส้กุ้งสดและหมูสับชั้นดี นึ่งจนสุกพอดี เสิร์ฟร้อน พร้อมรสชาติกลมกล่อม หวาน เค็ม และหอมกรุ่นจากสมุนไพรไทย ผิวแป้งสีขาวนวล เนื้อไส้แน่นเต็มคำ เหมาะกับลิ้มรสแบบพรีเมียม'),
(10, 'แครกเกอร์ปู', 150.00, 'food', 'uploads/menu/UoXVfsHHAW1LJZXct7cdgPFCH0WsZTUTKg9Lzt2C.png', NULL, NULL, '2025-09-05 14:52:59', 'แครกเกอร์กรอบ ราดด้วยเนื้อปูสดหวานเต็มคำ โรยผักชีและเครื่องเทศเล็กน้อย กัดคำแรกแล้วได้รสหวาน เค็ม ครบเครื่อง กินเพลินเป็นกับแกล้มหรือเรียกน้ำย่อย'),
(11, 'เนื้อสัมฤทธิ์', 225.00, 'food', 'uploads/menu/W6qA0MGW0DvJaWHSsbpA7E7ONzB4sjbjgC4IA1F2.png', NULL, NULL, '2025-09-05 14:55:09', 'เนื้อสัมฤทธิ์ชิ้นนุ่ม หมักเข้มข้น ย่างหอมกรุ่น สีสวย รสหวาน เค็ม ครบรส กินคู่ข้าวสวยร้อน ๆ หรือข้าวเหนียว อร่อยง่าย ๆ แบบไทยแท้'),
(12, 'ใบเหลืองขั่ว ห่อหมกแห้งหน้าปู', 442.00, 'food', 'uploads/menu/UaVfdKAohnvjWrQPFqxt2NP8ds6hg1CiwWHv99dK.png', NULL, NULL, '2025-09-05 14:56:19', 'ห่อหมกแห้งรสกลมกล่อม ห่อด้วยใบเหลืองขั่วหอมกรุ่น เสิร์ฟพร้อมเนื้อปูสดหวานเต็มคำ เนื้อห่อหมกเนียนนุ่ม รสชาติหวาน เค็ม เผ็ดเล็กน้อย ครบเครื่องทุกคำ สีสันสวยงาม น่าลิ้มลองแบบพรีเมียม'),
(13, 'หมึกไข่ผัดจอมพล', 350.00, 'food', 'uploads/menu/OL8zin0c0kWv3p10bRr5PhXnXSRV4TFWY6dPOUzp.png', NULL, NULL, '2025-09-05 14:58:47', 'หมึกไข่สดเต็มคำ ผัดกับพริกเผาและเต้าเจี้ยวสูตรพิเศษ รสชาติกลมกล่อม เผ็ดหอมลึกซึ้ง ตกแต่งด้วยสีสันสดของสมุนไพรและเนื้อหมึกเนียนนุ่ม สามารถบีบมะนาวเพิ่มรสเปรี้ยวสดชื่นก่อนลิ้มรส'),
(14, 'แกงเขียวหวานเนื้อตุ๋น', 245.00, 'food', 'uploads/menu/kpPi9EXSdIidcurfpVeSoIBOOGmx2NtOrOsspjGN.png', NULL, NULL, '2025-09-05 15:01:37', 'เนื้อตุ๋นคุณภาพสูงตุ๋นจนเปื่อยนุ่มละลายในปาก ผัดกับพริกแกงสูตรเก่าแก่เข้มข้น ก่อนเคี่ยวกับกะทิคั้นสดเพิ่มความหอมมัน น้ำแกงสีเขียวสวย พร้อมสมุนไพรสดอย่างใบโหระพาและมะเขือพวง รสชาติกลมกล่อม หวาน เค็ม เผ็ดละมุน ครบเครื่องทุกคำ'),
(15, 'กั้งขั่วพริกเกลือ', 270.00, 'food', 'uploads/menu/l3mkBdX7wD53ElBIaNhXv7e7pN7iy3OdJqDWeKjD.png', NULL, NULL, '2025-09-05 15:04:44', 'กั้งสดตัวใหญ่ ผัดกับพริกและเกลือจนหอม เนื้อหวานแน่น รสเค็ม เผ็ดเล็กน้อย กินเพลินเป็นกับข้าวหรือกับแกล้ม สดใหม่ทุกคำ'),
(16, 'ยำใบเหลืองกรอบ', 500.00, 'food', 'uploads/menu/7u9hsFHj71FVkMzR5mPlZNypylF4GEav8eN7XgHJ.png', NULL, NULL, '2025-09-05 15:08:01', 'ใบเหลืองทอดกรอบสีทองสวย ราดด้วยน้ำยำสูตรพิเศษ ผสมพริกเผาและมะพร้าวขั่ว เพิ่มความหอมมัน รสชาติเปรี้ยว หวาน เผ็ดละมุน ครบเครื่องทุกคำ ตกแต่งด้วยผักชีสดเพื่อสีสันสดใส เหมาะกับลิ้มรสแบบพรีเมียม'),
(17, 'ต้มยำกุ้งแม่น้ำ น้ำมะพร้าว', 857.00, 'food', 'uploads/menu/8sJzzxsCFF1VT9EQoYdIpSo3NO7kcd8vuEgm0TQT.png', NULL, NULL, '2025-09-05 15:09:41', 'กุ้งแม่น้ำตัวโตสดใหม่ รสหวานฉ่ำ เคี่ยวในน้ำมะพร้าวสดเพิ่มความหอมมัน ซดน้ำซุปต้มยำร้อน ๆ กลมกล่อม ผสมสมุนไพรไทยอย่างตะไคร้ ใบมะกรูด ข่า และพริกสด รสชาติเปรี้ยว เผ็ด หวาน ครบในทุกคำ สีสันสดใส น่าลิ้มลองแบบพรีเมียม'),
(18, 'ข้าวผัดแสนสุข', 975.00, 'food', 'uploads/menu/4wjEYcJ66j7UGU3F7Tq1Re2VqleJpg7zyO88Xa8f.png', NULL, NULL, '2025-09-05 15:13:04', 'ข้าวผัดร้อน ๆ ผัดกับหมึกดำสดใหม่ รสกลมกล่อม หวาน เค็ม พร้อมเนื้อปูสดและไขากุ้งสีสวย กินง่าย สีสันน่ากิน อร่อยครบเครื่อง เหมาะกับทุกคนในครอบครัว'),
(19, 'ชามะนาว', 49.00, 'beverage', 'uploads/menu/4i0CWEoW82eH41a89NocYkWhBYGQ06j4SjfsvBRM.png', NULL, NULL, '2025-09-10 11:43:05', 'แนะนำ ชาเย็นน้ำผึ้งมะนาวปรุงสำเร็จ 3in1 ขนาด 12 ออนซ์ ให้คุณสดชื่นจากน้ำผึ้งมะนาว เปรี้ยวหวานได้อย่างกลมกล่อมลงตัว ตามสโลแกน \"สดชื่น เปรี้ยว หวานกลมกล่อม\"'),
(20, 'ช็อกโกแลตร้อน เรดเวลเวท', 50.00, 'beverage', 'uploads/menu/tKOy799KomllxpNsCkK5DRHTD2uIiZOM1rXssmFq.png', NULL, NULL, '2025-09-10 11:51:07', 'ใครอยากได้เครื่องดื่มช็อกโกแลตต้อนรับมื้อเช้า ขอนำเสนอเมนูช็อกโกแลตร้อน เรดเวลเวท ใส่นมสดกับดาร์กช็อกโกแลต เติมสีผสมอาหารสีแดงและกลิ่นวานิลลา'),
(21, 'ชาเขียวมัทฉะ', 60.00, 'beverage', 'uploads/menu/iKTBouIZPmSF6r0Heg6Ks4zjjSL81oOA2JJghJdE.png', NULL, NULL, '2025-09-10 11:52:38', 'ชาเขียวสูตร ทำจากผงชาเขียวหรือผงมัทฉะ มีทั้งแบบร้อนและเย็น รสชาติหอมหวานปนขมนิด ๆ อีกทั้งเติมนมสดเพื่อให้มีความหอมนัวมากขึ้น'),
(22, 'ชาไทยเย็น', 49.00, 'beverage', 'uploads/menu/gsmoj5IFbL6ZbJ1N5b3pdhSeFa67Zfn7sBfjxFKd.png', NULL, NULL, '2025-09-10 11:54:35', 'ชาไทยเย็น เครื่องดื่มยอดนิยม รสชาติหอมเข้มละมุน ทำจากผงชาแท้ ไม่ขัดสี'),
(23, 'ลาเต้', 75.00, 'beverage', 'uploads/menu/L1PSUhxBOCU4RnLqXZLUzeGWIeW3A0q4yH1bnepq.png', NULL, NULL, '2025-09-10 11:56:08', 'ลาเต้ คือกาแฟใส่นม ทำให้มีรสชาติอ่อนนุ่มดื่มง่าย โดยลาเต้เป็นภาษาอิตาลี แปลว่า “นม” ดังนั้น “กาแฟลาเต้” หมายถึง กาแฟนมนั่นเอง และอาจสร้างลวดลายด้านบน เรียกว่า ลาเต้อาร์ต (Latte Art) มีทั้งแบบร้อน เย็น และปั่น'),
(24, 'คาปูชิโน่', 55.00, 'beverage', 'uploads/menu/o67kRVOC8EAlQ5cWJYd3HsbCLP60U8aUimVGsHKj.png', NULL, NULL, '2025-09-10 11:57:19', 'คาปูชิโน่ คือกาแฟผสมฟองนม และมีฟองนมด้านบน แม้หน้าตาจะคล้ายลาเต้ แต่สัดส่วนของฟองนมข้างบนจะมีมากกว่า มีทั้งแบบร้อน เย็น และปั่น'),
(25, 'มอคค่า', 65.00, 'beverage', 'uploads/menu/iU73fibPscPDcT8ND4q559Ce8MeAukPXKVVAQRxk.png', NULL, NULL, '2025-09-10 11:58:10', 'มอคค่า คือกาแฟเติมนมผสมช็อกโกแลต เหมาะสำหรับคนเริ่มต้นดื่มกาแฟ จะเสิร์ฟร้อนหรือเย็นก็อร่อยทั้งคู่ แต่งด้วยวิปครีม โฟมนม ซอสคาราเมล หรือซอสอื่น ๆ'),
(26, 'กาแฟคาราเมล', 60.00, 'beverage', 'uploads/menu/Pz0bDXGisYKTD23LaZbCQ8Eg1jDCYgrkAky16bzj.png', NULL, NULL, '2025-09-10 12:01:50', 'กาแฟคาราเมล จุดเด่นคือใส่ซอสคาราเมล ดื่มง่ายมาก เหมาะสำหรับมือใหม่หัดดื่ม มีทั้งแบบร้อน เย็น และปั่น มีการแต่งหน้าด้วยวิปครีมหรือนมอุ่นเพิ่มความละมุน'),
(27, 'อเมริกาโน่', 70.00, 'beverage', 'uploads/menu/GQr7A0AnqulYZ6GaPDDJK7pelhbEbbiu3cePtYO2.png', NULL, NULL, '2025-09-10 12:04:11', 'อเมริกาโน่น้ำส้ม กาแฟรสชาติเข้มข้นมีทั้งแบบเย็นและแบบร้อน เติมน้ำผลไม้อย่างน้ำส้มเพื่อเพิ่มสีสันให้รสชาติ'),
(28, 'Coconut Pineapple Lime Granita', 89.00, 'sweet', 'uploads/menu/yyfgj6AdPCMs7gclXm0Z1ht8YyO454IS8tGDdXzw.png', NULL, NULL, '2025-09-10 12:38:39', 'เมนู Coconut Pineapple Lime Granita กรานิต้าที่ผสานความเปรี้ยวหวานของมะพร้าวสับปะรด และมะนาวได้อย่างสดชื่นลงตัว'),
(29, 'ส้มฉุนหิมะ', 79.00, 'sweet', 'uploads/menu/326W6DU305EBh9F3F535cfnq4oebueLLoI7VhPLX.png', NULL, NULL, '2025-09-10 12:39:39', 'เมนู ส้มฉุนหิมะ ทำเป็นแบบกรานิต้าเกล็ดน้ำแข็งป่นนุ่มๆ หอมกลิ่นน้ำส้มซ่า ผสมน้ำมะกรูด และน้ำมะนาว ใส่มะกรูดเชื่อมสีเขียวสดใส  เงาะ ลิ้นจี่ ขิงอ่อนและหอมแดงเจียว กลิ่นหอม กินแล้วสดชื่นเหมาะกับอากาศบ้านเราจริงๆ'),
(30, 'มะยงชิดลอยแก้ว', 69.00, 'sweet', 'uploads/menu/bPNEAjulW3Cmxx1CqVo2ptLK34L0EpPoIXDKLd2P.png', NULL, NULL, '2025-09-10 12:40:31', 'เมนู มะยงชิดลอยแก้ว มะยงชิด ผลไม้ตามฤดูกาลรสเปรี้ยวอมหวาน ลูกบิ๊กเบิ้ม เนื้อแน่นๆ กินพร้อมกับน้ำเชื่อมผสมน้ำแข็ง รสหวานละมุนสุดชื่นใจ'),
(31, 'ครีมบูเล่เสาวรส', 49.00, 'sweet', 'uploads/menu/eIgbETTXzLs3PvBBwozjvsb8kXdHaebu69UQMAVn.png', NULL, NULL, '2025-09-10 12:42:34', 'ครีมบูเล่ทั่วไปอาจมีรสชาติหวานเลี่ยนไม่ถูกปาก ลองเติมรสชาติเปรี้ยวลงไปก็เข้าท่านะคะ ขอนำเสนอครีมบูเล่เสาวรส เนื้อเสาวรสผสมผสานคัสตาร์ดอย่างลงตัว เพิ่มความเก๋จากน้ำตาลไหม้ด้านบน'),
(32, 'ช็อกโกแลตลาวา', 70.00, 'sweet', 'uploads/menu/tL9JTGHg0uBprIiIqHQvgV2tStjWwwtGwF9HtqFC.png', NULL, NULL, '2025-09-10 12:43:37', 'เอาใจลูกค้าที่ชื่นชอบช็อกโกแลตกันด้วยเมนูช็อกโกแลตลาวา สูตรไม่ใช้เตาอบ เพราะใช้หม้ออบแทน ผ่าออกมาไส้ช็อกโกแลตเยิ้ม'),
(33, 'วาฟเฟิลชาเขียว', 120.00, 'sweet', 'uploads/menu/JRrXZj8BeShrA9WngzZXdzttKWNyxqtNxWpMkHwu.png', NULL, NULL, '2025-09-10 12:44:25', 'พิ่มตัวเลือกเมนูวาฟเฟิลสำหรับคนแพ้กลูเตนกันหน่อยเนอะ ขอนำเสนอวาฟเฟิลชาเขียว ใช้แป้งปราศจากกลูเตน แถมยังใส่ผงชาเขียวออแกนิกส์ จะราดน้ำผึ้งหรือไซรัป ท็อปปิ้งด้วยผลไม้สด'),
(34, 'แพนเค้กราสป์เบอร์รี', 149.00, 'sweet', 'uploads/menu/xJobSqgHTfNUBulyeuj482XVjVz8Ug405infUvM6.png', NULL, NULL, '2025-09-10 12:45:55', 'สำหรับสายสุขภาพต้องลอง !! เมนูแพนเค้กราสป์เบอร์รี ใช้แป้งโฮลวีททำแพนเค้ก เพิ่มความงามจากราสป์เบอร์รี'),
(35, 'ฮันนี่โทสต์มะม่วง', 245.00, 'sweet', 'uploads/menu/IjMnqnhVv3ttjLpyV7aBOQU5jh8bTkOQnsYbJ6KN.png', NULL, NULL, '2025-09-10 12:47:32', 'ขอนำเสนอฮันนี่โทสต์มะม่วง เมนูยอดนิยม ที่มีจุดเด่นคือ เสิร์ฟพร้อมมะม่วงหั่นชิ้น แช่เย็นยิ่งเพิ่มความฟินนะ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotion`
--

CREATE TABLE `tbl_promotion` (
  `pro_id` int(11) NOT NULL,
  `conditions` text NOT NULL,
  `detail` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `mem_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `pro_pic` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_promotion`
--

INSERT INTO `tbl_promotion` (`pro_id`, `conditions`, `detail`, `start_date`, `end_date`, `mem_id`, `emp_id`, `pro_pic`, `timestamp`) VALUES
(2, '• จำกัดสิทธิ์ 1 คน / 1 บิล / 1 วัน \r\n• ร้านค้าขอสงวนสิทธิ์ในการเปลี่ยนแปลงเงื่อนไขโดยไม่ต้องแจ้งล่วงหน้า', '• ฟรีของหวาน 1 รายการ เมื่อสั่งอาหารครบ 500 บาทขึ้นไป', '2025-09-14', '2025-11-08', NULL, NULL, 'uploads/promotion/5oLasC5sxEcFmXOVKCRQigiIC9r126kMVs17uqtn.png', '2025-09-25 15:20:10'),
(3, '• ลูกค้าต้องแสดงบัตรประชาชน หรือบัตรที่มีวันเกิดตรงกับวันที่มาใช้บริการ\r\n• ใช้ได้เฉพาะการรับประทานภายในร้าน\r\n• ส่วนลด 30% ใช้ได้กับค่าอาหารเท่านั้น (ไม่รวมเครื่องดื่มแอลกอฮอล์ หรือเมนูพิเศษที่ร้านกำหนด)\r\n• จำกัดสิทธิ์ 1 ครั้ง ต่อ 1 ท่าน ในวันเกิดเท่านั้น\r\n• โปรโมชั่นนี้ไม่สามารถใช้ร่วมกับโปรโมชั่นอื่น ๆ ได้', '“HAPPY BIRTHDAY! ลดครึ่งราคา”\r\nลูกค้าที่มาทานอาหารในวันเกิดของตนเอง รับสิทธิ์ ส่วนลด 30% ทันที (สำหรับค่าอาหารในบิล)', '2025-09-26', '2025-11-30', NULL, NULL, 'uploads/promotion/2Q0WydfssxrFOIW2Az6OU0vUMQq1WVGNNFjGExfE.png', '2025-09-26 14:27:19'),
(4, '• โปรโมชั่นใช้ได้เฉพาะการรับประทานภายในร้าน\r\n• สามารถเลือกเมนูจากรายการที่ร้านกำหนดเท่านั้น\r\n• จำกัดสิทธิ์ 1 เซ็ตต่อ 1 ใบเสร็จ\r\n• จำกัดสิทธิ์ 50 คน/วัน \r\n• ไม่สามารถใช้ร่วมกับโปรโมชั่นอื่น ๆ ได้', '“Combo Set สุดคุ้ม อิ่มครบ จบในเซ็ต”\r\n• Set A (2 คน) 299.- : เมนูหลัก 2 จาน + เครื่องดื่ม 2 แก้ว', '2025-09-01', '2025-12-31', NULL, NULL, 'uploads/promotion/ZCVM6I9CQiFw6zc5dDTVwO2oKGzn5wZ8qISUDNwK.png', '2025-09-26 14:42:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mem_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(10) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `rating` tinyint(4) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `mem_id`, `menu_id`, `comment`, `rating`, `timestamp`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'อร่อยมาก!', 5, '2025-09-28 15:07:35', '2025-09-28 15:07:35', '2025-09-28 15:07:35'),
(2, 2, 3, 'เฉยๆ', 3, '2025-09-28 15:07:35', '2025-09-28 15:07:35', '2025-09-28 15:07:35'),
(3, 23, 34, 'ดีมาก อร่อย', 5, NULL, '2025-09-29 09:42:07', '2025-09-29 09:42:07'),
(4, 23, 33, 'อร่อยมาก', 5, NULL, '2025-09-29 09:47:14', '2025-09-29 09:47:14'),
(5, 23, 33, 'Delicios', 4, NULL, '2025-09-30 06:31:47', '2025-09-30 06:31:47'),
(6, 8, 35, 'แซ่บเวอร์', 1, NULL, '2025-10-02 08:59:49', '2025-10-02 08:59:49'),
(7, 13, 35, 'ไม่ชอบ', 5, NULL, '2025-10-02 09:04:03', '2025-10-02 09:04:03'),
(8, 13, 35, 'ไม่มักติ๊', 4, NULL, '2025-10-02 09:15:23', '2025-10-02 09:15:23'),
(9, 13, 34, 'dislike', 2, NULL, '2025-10-02 09:23:25', '2025-10-02 09:23:25'),
(10, 13, 34, 'I like it', 3, NULL, '2025-10-02 09:24:41', '2025-10-02 09:24:41'),
(11, 13, 34, NULL, 3, NULL, '2025-10-02 09:27:21', '2025-10-02 09:27:21'),
(12, 13, 34, NULL, 2, NULL, '2025-10-02 09:27:28', '2025-10-02 09:27:28'),
(13, 13, 34, NULL, 3, NULL, '2025-10-02 09:48:15', '2025-10-02 09:48:15'),
(14, 13, 34, 'b', 5, NULL, '2025-10-02 09:49:34', '2025-10-02 09:49:34'),
(15, 13, 34, 'b', 5, NULL, '2025-10-02 09:49:53', '2025-10-02 09:49:53'),
(16, 13, 10, 'NG', 1, NULL, '2025-10-02 09:56:50', '2025-10-02 09:56:50'),
(17, 13, 10, '555555', 3, NULL, '2025-10-02 09:56:58', '2025-10-02 09:56:58'),
(18, 23, 10, 'Likekekeeeeeeeeee', 5, NULL, '2025-10-02 09:57:56', '2025-10-02 09:57:56'),
(19, 23, 32, 'ไม่ชอบ', 5, NULL, '2025-10-02 09:58:29', '2025-10-02 09:58:29'),
(20, 23, 26, 'กกก', 2, NULL, '2025-10-02 09:59:27', '2025-10-02 09:59:27'),
(21, 23, 20, 'ไปแง๊นกับพี่มั้ยน้องงงงงงงงงงง', 4, NULL, '2025-10-02 09:59:48', '2025-10-02 09:59:48'),
(22, 8, 26, 'พี่รักหนูมั้ย', 4, NULL, '2025-10-02 10:02:26', '2025-10-02 10:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tbl_count_view`
--
ALTER TABLE `tbl_count_view`
  ADD PRIMARY KEY (`count_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `tbl_emp_admin`
--
ALTER TABLE `tbl_emp_admin`
  ADD PRIMARY KEY (`emp_id`),
  ADD UNIQUE KEY `emp_username` (`emp_username`),
  ADD UNIQUE KEY `emp_email` (`emp_email`);

--
-- Indexes for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`mem_id`),
  ADD UNIQUE KEY `mem_username` (`mem_username`),
  ADD UNIQUE KEY `mem_email` (`mem_email`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `emp_id` (`emp_id`),
  ADD KEY `mem_id` (`mem_id`);

--
-- Indexes for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `mem_id` (`mem_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_count_view`
--
ALTER TABLE `tbl_count_view`
  MODIFY `count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `tbl_emp_admin`
--
ALTER TABLE `tbl_emp_admin`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_count_view`
--
ALTER TABLE `tbl_count_view`
  ADD CONSTRAINT `tbl_count_view_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD CONSTRAINT `tbl_member_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tbl_emp_admin` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  ADD CONSTRAINT `tbl_promotion_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `tbl_emp_admin` (`emp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_promotion_ibfk_2` FOREIGN KEY (`mem_id`) REFERENCES `tbl_member` (`mem_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
