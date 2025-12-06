-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2025 at 04:22 PM
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
-- Database: `db_project_flow`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `project_id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke In Progress', '2025-11-30 22:28:05', '2025-11-30 22:28:05'),
(2, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke Done', '2025-11-30 22:28:09', '2025-11-30 22:28:09'),
(3, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke In Progress', '2025-11-30 22:28:26', '2025-11-30 22:28:26'),
(4, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke In Progress', '2025-11-30 22:57:57', '2025-11-30 22:57:57'),
(5, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke To Do', '2025-11-30 22:57:57', '2025-11-30 22:57:57'),
(6, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:57:58', '2025-11-30 22:57:58'),
(7, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:57:58', '2025-11-30 22:57:58'),
(8, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:57:59', '2025-11-30 22:57:59'),
(9, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:57:59', '2025-11-30 22:57:59'),
(10, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:00', '2025-11-30 22:58:00'),
(11, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:00', '2025-11-30 22:58:00'),
(12, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:01', '2025-11-30 22:58:01'),
(13, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:01', '2025-11-30 22:58:01'),
(14, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:02', '2025-11-30 22:58:02'),
(15, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:02', '2025-11-30 22:58:02'),
(16, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:03', '2025-11-30 22:58:03'),
(17, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:03', '2025-11-30 22:58:03'),
(18, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:04', '2025-11-30 22:58:04'),
(19, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:04', '2025-11-30 22:58:04'),
(20, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:05', '2025-11-30 22:58:05'),
(21, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:05', '2025-11-30 22:58:05'),
(22, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:06', '2025-11-30 22:58:06'),
(23, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:06', '2025-11-30 22:58:06'),
(24, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-11-30 22:58:07', '2025-11-30 22:58:07'),
(25, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:07', '2025-11-30 22:58:07'),
(26, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke Done', '2025-11-30 22:58:30', '2025-11-30 22:58:30'),
(27, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-11-30 22:58:34', '2025-11-30 22:58:34'),
(28, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke In Progress', '2025-11-30 22:58:43', '2025-11-30 22:58:43'),
(29, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke To Do', '2025-11-30 23:56:09', '2025-11-30 23:56:09'),
(30, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke In Progress', '2025-11-30 23:56:09', '2025-11-30 23:56:09'),
(31, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke To Do', '2025-11-30 23:56:10', '2025-11-30 23:56:10'),
(32, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke In Progress', '2025-11-30 23:56:12', '2025-11-30 23:56:12'),
(33, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke To Do', '2025-11-30 23:56:13', '2025-11-30 23:56:13'),
(34, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke In Progress', '2025-11-30 23:56:13', '2025-11-30 23:56:13'),
(35, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke To Do', '2025-11-30 23:56:31', '2025-11-30 23:56:31'),
(36, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke To Do', '2025-11-30 23:56:32', '2025-11-30 23:56:32'),
(37, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke In Progress', '2025-11-30 23:56:33', '2025-11-30 23:56:33'),
(38, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke In Progress', '2025-11-30 23:56:33', '2025-11-30 23:56:33'),
(39, 2, 1, 'move', 'rainfu memindahkan \'Mabar\' ke In Progress', '2025-11-30 23:56:34', '2025-11-30 23:56:34'),
(40, 2, 1, 'move', 'rainfu memindahkan \'Mabar\' ke To Do', '2025-11-30 23:56:34', '2025-11-30 23:56:34'),
(41, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke To Do', '2025-11-30 23:56:35', '2025-11-30 23:56:35'),
(42, 2, 1, 'move', 'rainfu memindahkan \'mabar\' ke To Do', '2025-11-30 23:56:35', '2025-11-30 23:56:35'),
(43, 2, 1, 'move', 'rainfu memindahkan \'Mabar\' ke In Progress', '2025-11-30 23:56:51', '2025-11-30 23:56:51'),
(44, 2, 1, 'create', 'rainfu membuat tugas baru: \'Kerja Statistika\'', '2025-12-01 00:04:15', '2025-12-01 00:04:15'),
(45, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke Done', '2025-12-01 00:04:56', '2025-12-01 00:04:56'),
(46, 2, 1, 'assign', 'rainfu menugaskan rainfay ke \'Kerja Statistika\'', '2025-12-01 00:05:05', '2025-12-01 00:05:05'),
(47, 2, 1, 'assign', 'rainfu menugaskan rainfay ke \'Mabar\'', '2025-12-01 00:10:42', '2025-12-01 00:10:42'),
(48, 2, 2, 'move', 'rainfay memindahkan \'Kerja Statistika\' ke In Progress', '2025-12-01 00:32:41', '2025-12-01 00:32:41'),
(49, 2, 2, 'move', 'rainfay memindahkan \'Kerja Statistika\' ke To Do', '2025-12-01 00:32:41', '2025-12-01 00:32:41'),
(50, 5, 1, 'create', 'rainfu membuat tugas baru: \'Makan\'', '2025-12-01 01:07:15', '2025-12-01 01:07:15'),
(51, 5, 1, 'move', 'rainfu memindahkan \'Makan\' ke In Progress', '2025-12-01 01:07:18', '2025-12-01 01:07:18'),
(52, 5, 1, 'move', 'rainfu memindahkan \'Makan\' ke To Do', '2025-12-01 01:07:18', '2025-12-01 01:07:18'),
(53, 5, 1, 'move', 'rainfu memindahkan \'Makan\' ke In Progress', '2025-12-01 01:07:20', '2025-12-01 01:07:20'),
(54, 5, 1, 'move', 'rainfu memindahkan \'Makan\' ke To Do', '2025-12-01 01:07:23', '2025-12-01 01:07:23'),
(55, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke To Do', '2025-12-01 01:14:18', '2025-12-01 01:14:18'),
(56, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke Done', '2025-12-01 01:14:24', '2025-12-01 01:14:24'),
(57, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-12-01 01:14:25', '2025-12-01 01:14:25'),
(58, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke Done', '2025-12-01 01:14:25', '2025-12-01 01:14:25'),
(59, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke In Progress', '2025-12-01 01:14:26', '2025-12-01 01:14:26'),
(60, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke To Do', '2025-12-01 01:14:27', '2025-12-01 01:14:27'),
(61, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke Done', '2025-12-01 01:14:27', '2025-12-01 01:14:27'),
(62, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-12-01 01:14:28', '2025-12-01 01:14:28'),
(63, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke In Progress', '2025-12-01 01:14:28', '2025-12-01 01:14:28'),
(64, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke Done', '2025-12-01 01:14:30', '2025-12-01 01:14:30'),
(65, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke In Progress', '2025-12-01 01:14:30', '2025-12-01 01:14:30'),
(66, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke In Progress', '2025-12-01 01:14:31', '2025-12-01 01:14:31'),
(67, 1, 1, 'move', 'rainfu memindahkan \'tidur\' ke To Do', '2025-12-01 01:14:33', '2025-12-01 01:14:33'),
(68, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke Done', '2025-12-01 01:14:38', '2025-12-01 01:14:38'),
(69, 1, 1, 'move', 'rainfu memindahkan \'tugas basdat\' ke In Progress', '2025-12-01 01:14:38', '2025-12-01 01:14:38'),
(70, 2, 1, 'move', 'rainfu memindahkan \'Tugas 1\' ke In Progress', '2025-12-01 01:18:53', '2025-12-01 01:18:53'),
(71, 2, 1, 'move', 'rainfu memindahkan \'Mabar\' ke Done', '2025-12-01 01:18:54', '2025-12-01 01:18:54'),
(72, 6, 1, 'create', 'rainfu membuat tugas: \'Membuat Database\'', '2025-12-06 14:13:48', '2025-12-06 14:13:48'),
(73, 6, 1, 'move', 'rainfu memindahkan \'Membuat Database\' ke In Progress', '2025-12-06 14:14:09', '2025-12-06 14:14:09'),
(74, 6, 1, 'move', 'rainfu memindahkan \'Membuat Database\' ke Done', '2025-12-06 14:14:15', '2025-12-06 14:14:15'),
(75, 6, 1, 'move', 'rainfu memindahkan \'Membuat Database\' ke To Do', '2025-12-06 14:15:08', '2025-12-06 14:15:08'),
(76, 6, 1, 'move', 'rainfu memindahkan \'Membuat Database\' ke In Progress', '2025-12-06 14:15:09', '2025-12-06 14:15:09'),
(77, 6, 1, 'assign', 'rainfu menugaskan Ariel ke \'Membuat Database\'', '2025-12-06 14:15:11', '2025-12-06 14:15:11'),
(78, 6, 1, 'assign', 'rainfu menugaskan Ariel ke \'Membuat Database\'', '2025-12-06 14:15:15', '2025-12-06 14:15:15');

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_23_150704_create_projects_table', 1),
(5, '2025_11_23_150713_create_project_lists_table', 1),
(6, '2025_11_23_150721_create_tasks_table', 1),
(7, '2025_11_23_150730_create_comments_table', 1),
(8, '2025_12_01_060504_create_activity_logs_table', 2),
(9, '2025_12_01_065047_add_deadline_to_projects_table', 3),
(10, '2025_12_01_074919_add_priority_to_tasks_table', 4),
(11, '2025_12_01_081544_add_project_order_to_users_table', 5),
(12, '2025_12_01_082520_change_deadline_to_datetime_in_projects', 5),
(13, '2025_12_01_092651_add_avatar_column_to_users_table', 5),
(14, '2025_12_01_092934_force_add_avatar_to_users', 6),
(15, '2025_12_06_204214_add_is_admin_to_users_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('rainnrr.12@gmail.com', '$2y$12$G2iMwfWtLnrXjHh/1rAoWurxnYajtdWpjV3oa2/ToxMNLRGoEvdR2', '2025-12-01 00:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `deadline`, `owner_id`, `created_at`, `updated_at`) VALUES
(1, 'anjay', 'anjir', NULL, 1, '2025-11-25 06:03:27', '2025-11-25 06:03:27'),
(2, 'Statistika', NULL, NULL, 1, '2025-11-30 05:19:29', '2025-11-30 05:19:29'),
(3, 'Project Case Based', 'Memenuhi tugas mata kuliah pemrogwaman web', '2025-12-03 00:00:00', 1, '2025-12-01 00:19:42', '2025-12-01 00:19:42'),
(4, 'UAS Stat', 'bismillah  cumlaude', '2025-12-02 00:00:00', 1, '2025-12-01 00:23:05', '2025-12-01 00:23:05'),
(5, 'Project Case Based', 'jshdujoashdoiuawhd', '2025-12-24 00:00:00', 1, '2025-12-01 00:38:02', '2025-12-01 00:38:02'),
(6, 'Pengembangan Website Kampus', 'Tugas Pemrograman Web', '2025-12-07 23:12:00', 1, '2025-12-06 14:12:25', '2025-12-06 14:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `project_lists`
--

CREATE TABLE `project_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_lists`
--

INSERT INTO `project_lists` (`id`, `name`, `project_id`, `order`, `created_at`, `updated_at`) VALUES
(1, 'To Do', 1, 1, '2025-11-25 06:03:27', '2025-11-25 06:03:27'),
(2, 'In Progress', 1, 2, '2025-11-25 06:03:27', '2025-11-25 06:03:27'),
(3, 'Done', 1, 3, '2025-11-25 06:03:27', '2025-11-25 06:03:27'),
(4, 'To Do', 2, 1, '2025-11-30 05:19:29', '2025-11-30 05:19:29'),
(5, 'In Progress', 2, 2, '2025-11-30 05:19:29', '2025-11-30 05:19:29'),
(6, 'Done', 2, 3, '2025-11-30 05:19:29', '2025-11-30 05:19:29'),
(7, 'To Do', 3, 1, '2025-12-01 00:19:42', '2025-12-01 00:19:42'),
(8, 'In Progress', 3, 2, '2025-12-01 00:19:42', '2025-12-01 00:19:42'),
(9, 'Done', 3, 3, '2025-12-01 00:19:42', '2025-12-01 00:19:42'),
(10, 'To Do', 4, 1, '2025-12-01 00:23:05', '2025-12-01 00:23:05'),
(11, 'In Progress', 4, 2, '2025-12-01 00:23:05', '2025-12-01 00:23:05'),
(12, 'Done', 4, 3, '2025-12-01 00:23:05', '2025-12-01 00:23:05'),
(13, 'To Do', 5, 1, '2025-12-01 00:38:02', '2025-12-01 00:38:02'),
(14, 'In Progress', 5, 2, '2025-12-01 00:38:02', '2025-12-01 00:38:02'),
(15, 'Done', 5, 3, '2025-12-01 00:38:02', '2025-12-01 00:38:02'),
(16, 'To Do', 6, 1, '2025-12-06 14:12:25', '2025-12-06 14:12:25'),
(17, 'In Progress', 6, 2, '2025-12-06 14:12:25', '2025-12-06 14:12:25'),
(18, 'Done', 6, 3, '2025-12-06 14:12:25', '2025-12-06 14:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 2, NULL, NULL),
(7, 1, 4, NULL, NULL),
(8, 6, 4, NULL, NULL);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HPDHiO4lE8bNSfJ2c4ehkDomvoA5ThmO3cewoB9W', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTHppUlFDUjJJd2kyVHNYVjE3SXp0MlNWUUtkbFd3SVNUUnJpZ1VqZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxNToiYWRtaW4uZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1765034220);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `priority` varchar(255) NOT NULL DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `project_list_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `priority`, `due_date`, `project_list_id`, `created_at`, `updated_at`) VALUES
(2, 'tugas basdat', NULL, 'medium', NULL, 2, '2025-11-25 06:17:28', '2025-12-01 01:14:38'),
(3, 'tidur', NULL, 'medium', NULL, 1, '2025-11-30 02:05:16', '2025-12-01 01:14:33'),
(5, 'Tugas 1', NULL, 'medium', NULL, 5, '2025-11-30 05:19:44', '2025-12-01 01:18:53'),
(6, 'mabar', NULL, 'medium', NULL, 4, '2025-11-30 22:13:21', '2025-11-30 23:56:35'),
(7, 'Mabar', NULL, 'medium', NULL, 6, '2025-11-30 23:56:21', '2025-12-01 01:18:54'),
(8, 'Kerja Statistika', NULL, 'urgent', '2025-11-30', 4, '2025-12-01 00:04:15', '2025-12-01 00:32:41'),
(9, 'Makan', NULL, 'medium', '2025-12-20', 13, '2025-12-01 01:07:15', '2025-12-01 01:07:23'),
(10, 'Membuat Database', NULL, 'high', '2025-12-07', 17, '2025-12-06 14:13:48', '2025-12-06 14:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(15, 3, 1, NULL, NULL),
(16, 2, 2, NULL, NULL),
(17, 8, 2, NULL, NULL),
(18, 7, 2, NULL, NULL),
(20, 10, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) DEFAULT NULL,
  `project_order` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`project_order`)),
  `whatsapp_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `avatar`, `project_order`, `whatsapp_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rainfu', 'rainnrr.12@gmail.com', 1, '2.jpg', '[\"1\",\"2\",\"3\",\"4\",\"5\"]', '085396828502', NULL, '$2y$12$viGpqdQSmrgC7bSpl1IsDuG.IDaDxivOGOWtdVpnuTSLxNA0i6Vwi', NULL, '2025-11-25 05:57:25', '2025-12-06 12:44:47'),
(2, 'rainfay', 'ramadhanr24h@student.unhas.ac.id', 0, NULL, NULL, '012983021930', NULL, '$2y$12$K2gBN9txIg4QnnE4eOB2POUxd2x/nbjX59oMJELEA0V2WjackgxZi', NULL, '2025-11-25 06:38:47', '2025-11-25 06:38:47'),
(4, 'Ariel', 'arielriwali25@gmail.com', 0, NULL, NULL, '085935026994', NULL, '$2y$12$wxAYyy95KS.M3MO.3ECNKui/0rcutb0mnAFXdIkW01eNaShhgDIv6', NULL, '2025-12-06 13:46:08', '2025-12-06 13:46:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_project_id_foreign` (`project_id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_task_id_foreign` (`task_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

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
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `project_lists`
--
ALTER TABLE `project_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_lists_project_id_foreign` (`project_id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_project_id_foreign` (`project_id`),
  ADD KEY `project_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_project_list_id_foreign` (`project_list_id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_user_task_id_foreign` (`task_id`),
  ADD KEY `task_user_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_lists`
--
ALTER TABLE `project_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_lists`
--
ALTER TABLE `project_lists`
  ADD CONSTRAINT `project_lists_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_list_id_foreign` FOREIGN KEY (`project_list_id`) REFERENCES `project_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
