-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 22, 2025 at 02:14 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhc_workorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Pengecekan', 1, NULL, NULL),
(2, 'Perbaikan', 1, NULL, NULL),
(3, 'Konfigurasi', 1, NULL, NULL),
(4, 'Instalasi', 1, NULL, NULL),
(5, 'Pemasangan', 1, NULL, NULL),
(6, 'Penambahan', 1, NULL, NULL),
(7, 'Pemindahan', 1, NULL, NULL),
(8, 'Other', 1, NULL, NULL),
(9, 'Pengecekan', 2, NULL, NULL),
(10, 'Perbaikan', 2, NULL, NULL),
(11, 'Konfigurasi', 2, NULL, NULL),
(12, 'Instalasi', 2, NULL, NULL),
(13, 'Pemasangan', 2, NULL, NULL),
(14, 'Penambahan', 2, NULL, NULL),
(15, 'Pemindahan', 2, NULL, NULL),
(16, 'Other', 2, NULL, NULL),
(17, 'Pembuatan', 3, NULL, NULL),
(18, 'Penambahan', 3, NULL, NULL),
(19, 'Revisi', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'IT', NULL, NULL),
(2, 'Engineering', NULL, NULL),
(3, 'Markom', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Computer', 1, NULL, NULL),
(2, 'Access Point', 1, NULL, NULL),
(3, 'TV Cable', 1, NULL, NULL),
(4, 'Smart TV', 1, NULL, NULL),
(5, 'Ethernet', 1, NULL, NULL),
(6, 'CCTV', 1, NULL, NULL),
(7, 'PABX', 1, NULL, NULL),
(8, 'Printer', 1, NULL, NULL),
(9, 'Email', 1, NULL, NULL),
(10, 'Elektrikal', 2, NULL, NULL),
(11, 'Plumbing', 2, NULL, NULL),
(12, 'Event', 2, NULL, NULL),
(13, 'Civil', 2, NULL, NULL),
(14, 'Furniture', 2, NULL, NULL),
(15, 'Decoration', 2, NULL, NULL),
(16, 'Welding', 2, NULL, NULL),
(17, 'AC', 2, NULL, NULL),
(18, 'Other', 2, NULL, NULL),
(19, 'Brosur', 3, '2025-07-22 01:31:55', '2025-07-22 01:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_07_03_080205_create_roles_table', 1),
(5, '2025_07_03_082436_add_role_id_to_users_table', 1),
(6, '2025_07_04_022512_create_departments_table', 1),
(7, '2025_07_04_031058_create_categories_table', 1),
(8, '2025_07_04_031106_create_items_table', 1),
(9, '2025_07_04_033256_create_progresses_table', 1),
(10, '2025_07_04_072554_create_priorities_table', 1),
(11, '2025_07_04_080755_create_orders_table', 1),
(12, '2025_07_15_082437_add_department_id_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `item_id` bigint UNSIGNED DEFAULT NULL,
  `pic` bigint UNSIGNED DEFAULT NULL,
  `reporter` bigint UNSIGNED DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `create_date` date DEFAULT NULL,
  `create_time` time DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `paused_at` datetime DEFAULT NULL,
  `resume_at` datetime DEFAULT NULL,
  `total_duration` int NOT NULL DEFAULT '0',
  `progress_id` bigint UNSIGNED DEFAULT NULL,
  `priority_id` bigint UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `title`, `letter_number`, `department_id`, `category_id`, `item_id`, `pic`, `reporter`, `description`, `create_date`, `create_time`, `started_at`, `paused_at`, `resume_at`, `total_duration`, `progress_id`, `priority_id`, `start_date`, `due_date`, `created_at`, `updated_at`) VALUES
(1, 'Order Title 1', 'ORD-00001', 3, 2, 1, 1, 2, 'This is the description for order #1', '2025-07-01', '11:02:00', '2025-07-01 08:02:00', '2025-07-01 10:48:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-01 04:02:00', '2025-07-01 04:02:00'),
(2, 'Order Title 2', 'ORD-00002', 1, 3, 2, 2, 2, 'This is the description for order #2', '2025-07-11', '17:12:00', '2025-07-11 13:12:00', '2025-07-11 16:30:00', NULL, 0, 4, 2, NULL, NULL, '2025-07-11 10:12:00', '2025-07-11 10:12:00'),
(3, 'Order Title 3', 'ORD-00003', 2, 1, 1, 2, 2, 'This is the description for order #3', '2025-07-28', '17:16:00', '2025-07-28 15:16:00', '2025-07-28 17:03:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-28 10:16:00', '2025-07-28 10:16:00'),
(4, 'Order Title 4', 'ORD-00004', 2, 1, 3, 2, 1, 'This is the description for order #4', '2025-07-19', '08:10:00', '2025-07-19 07:10:00', NULL, NULL, 0, 3, 2, NULL, NULL, '2025-07-19 01:10:00', '2025-07-19 01:10:00'),
(5, 'Order Title 5', 'ORD-00005', 2, 2, 1, 2, 3, 'This is the description for order #5', '2025-07-08', '09:26:00', '2025-07-08 05:26:00', '2025-07-08 08:31:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-08 02:26:00', '2025-07-08 02:26:00'),
(6, 'Order Title 6', 'ORD-00006', 3, 1, 2, 1, 3, 'This is the description for order #6', '2025-07-10', '10:20:00', '2025-07-10 06:20:00', '2025-07-10 09:24:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-10 03:20:00', '2025-07-10 03:20:00'),
(8, 'Order Title 8', 'ORD-00008', 3, 1, 1, 3, 1, 'This is the description for order #8', '2025-07-09', '12:07:00', NULL, NULL, NULL, 0, 2, 3, NULL, NULL, '2025-07-09 05:07:00', '2025-07-09 05:07:00'),
(9, 'Order Title 9', 'ORD-00009', 1, 1, 3, 3, 2, 'This is the description for order #9', '2025-07-08', '10:23:00', NULL, NULL, NULL, 0, 1, 2, NULL, NULL, '2025-07-08 03:23:00', '2025-07-08 03:23:00'),
(10, 'Order Title 10', 'ORD-00010', 1, 3, 2, 1, 2, 'This is the description for order #10', '2025-07-26', '16:24:00', '2025-07-26 14:24:00', NULL, NULL, 2428, 5, 1, NULL, NULL, '2025-07-26 09:24:00', '2025-07-26 09:24:00'),
(11, 'Order Title 11', 'ORD-00011', 2, 1, 1, 1, 2, 'This is the description for order #11', '2025-07-05', '09:02:00', '2025-07-05 08:02:00', NULL, NULL, 6098, 5, 2, NULL, NULL, '2025-07-05 02:02:00', '2025-07-05 02:02:00'),
(12, 'Order Title 12', 'ORD-00012', 3, 1, 2, 3, 2, 'This is the description for order #12', '2025-07-15', '17:32:00', '2025-07-15 14:32:00', NULL, NULL, 6636, 5, 1, NULL, NULL, '2025-07-15 10:32:00', '2025-07-15 10:32:00'),
(13, 'Order Title 13', 'ORD-00013', 1, 1, 3, 2, 1, 'This is the description for order #13', '2025-07-26', '10:25:00', NULL, NULL, NULL, 0, 1, 1, NULL, NULL, '2025-07-26 03:25:00', '2025-07-26 03:25:00'),
(14, 'Order Title 14', 'ORD-00014', 2, 2, 2, 1, 3, 'This is the description for order #14', '2025-07-05', '11:24:00', NULL, NULL, NULL, 0, 1, 3, NULL, NULL, '2025-07-05 04:24:00', '2025-07-05 04:24:00'),
(15, 'Order Title 15', 'ORD-00015', 3, 3, 3, 2, 2, 'This is the description for order #15', '2025-07-14', '13:16:00', '2025-07-14 10:16:00', NULL, NULL, 0, 3, 3, NULL, NULL, '2025-07-14 06:16:00', '2025-07-14 06:16:00'),
(16, 'Order Title 16', 'ORD-00016', 1, 2, 1, 2, 3, 'This is the description for order #16', '2025-07-04', '11:34:00', NULL, NULL, NULL, 0, 1, 2, NULL, NULL, '2025-07-04 04:34:00', '2025-07-04 04:34:00'),
(17, 'Order Title 17', 'ORD-00017', 1, 1, 1, 1, 3, 'This is the description for order #17', '2025-07-11', '12:39:00', NULL, NULL, NULL, 0, 2, 1, NULL, NULL, '2025-07-11 05:39:00', '2025-07-11 05:39:00'),
(18, 'Order Title 18', 'ORD-00018', 3, 2, 1, 3, 1, 'This is the description for order #18', '2025-07-18', '13:59:00', NULL, NULL, NULL, 0, 1, 3, NULL, NULL, '2025-07-18 06:59:00', '2025-07-18 06:59:00'),
(19, 'Order Title 19', 'ORD-00019', 3, 1, 3, 3, 3, 'This is the description for order #19', '2025-07-12', '16:57:00', '2025-07-12 13:57:00', NULL, NULL, 0, 3, 2, NULL, NULL, '2025-07-12 09:57:00', '2025-07-12 09:57:00'),
(20, 'Order Title 20', 'ORD-00020', 3, 3, 3, 2, 1, 'This is the description for order #20', '2025-07-03', '10:13:00', '2025-07-03 07:13:00', '2025-07-03 09:14:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-03 03:13:00', '2025-07-03 03:13:00'),
(21, 'Order Title 21', 'ORD-00021', 3, 3, 3, 3, 1, 'This is the description for order #21', '2025-07-24', '10:57:00', '2025-07-24 08:57:00', '2025-07-24 10:32:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-24 03:57:00', '2025-07-24 03:57:00'),
(22, 'Order Title 22', 'ORD-00022', 3, 1, 3, 1, 3, 'This is the description for order #22', '2025-07-02', '15:51:00', '2025-07-02 13:51:00', NULL, NULL, 0, 3, 3, NULL, NULL, '2025-07-02 08:51:00', '2025-07-02 08:51:00'),
(23, 'Order Title 23', 'ORD-00023', 3, 2, 1, 3, 1, 'This is the description for order #23', '2025-07-12', '09:58:00', '2025-07-12 06:58:00', '2025-07-12 08:58:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-12 02:58:00', '2025-07-12 02:58:00'),
(24, 'Order Title 24', 'ORD-00024', 2, 3, 2, 2, 3, 'This is the description for order #24', '2025-07-19', '12:31:00', '2025-07-19 09:31:00', '2025-07-19 12:17:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-19 05:31:00', '2025-07-19 05:31:00'),
(25, 'Order Title 25', 'ORD-00025', 2, 1, 2, 1, 3, 'This is the description for order #25', '2025-07-11', '14:58:00', '2025-07-11 12:58:00', NULL, NULL, 3512, 5, 1, NULL, NULL, '2025-07-11 07:58:00', '2025-07-11 07:58:00'),
(26, 'Order Title 26', 'ORD-00026', 3, 3, 2, 3, 2, 'This is the description for order #26', '2025-07-25', '15:03:00', NULL, NULL, NULL, 0, 2, 1, NULL, NULL, '2025-07-25 08:03:00', '2025-07-25 08:03:00'),
(27, 'Order Title 27', 'ORD-00027', 1, 2, 2, 3, 2, 'This is the description for order #27', '2025-07-14', '15:03:00', NULL, NULL, NULL, 0, 2, 1, NULL, NULL, '2025-07-14 08:03:00', '2025-07-14 08:03:00'),
(28, 'Order Title 28', 'ORD-00028', 1, 2, 1, 3, 1, 'This is the description for order #28', '2025-07-27', '14:15:00', '2025-07-27 11:15:00', NULL, NULL, 4545, 5, 3, NULL, NULL, '2025-07-27 07:15:00', '2025-07-27 07:15:00'),
(29, 'Order Title 29', 'ORD-00029', 3, 3, 3, 3, 3, 'This is the description for order #29', '2025-07-08', '10:42:00', NULL, NULL, NULL, 0, 2, 2, NULL, NULL, '2025-07-08 03:42:00', '2025-07-08 03:42:00'),
(30, 'Order Title 30', 'ORD-00030', 1, 2, 3, 3, 2, 'This is the description for order #30', '2025-07-23', '11:44:00', '2025-07-23 08:44:00', '2025-07-23 11:22:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-23 04:44:00', '2025-07-23 04:44:00'),
(31, 'Order Title 31', 'ORD-00031', 1, 2, 3, 1, 2, 'This is the description for order #31', '2025-07-08', '12:37:00', NULL, NULL, NULL, 0, 2, 1, NULL, NULL, '2025-07-08 05:37:00', '2025-07-08 05:37:00'),
(32, 'Order Title 32', 'ORD-00032', 2, 2, 2, 1, 1, 'This is the description for order #32', '2025-07-20', '08:34:00', '2025-07-20 06:34:00', '2025-07-20 07:52:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-20 01:34:00', '2025-07-20 01:34:00'),
(33, 'Order Title 33', 'ORD-00033', 1, 2, 2, 1, 1, 'This is the description for order #33', '2025-07-07', '16:22:00', '2025-07-07 13:22:00', NULL, NULL, 0, 3, 2, NULL, NULL, '2025-07-07 09:22:00', '2025-07-07 09:22:00'),
(34, 'Order Title 34', 'ORD-00034', 3, 3, 1, 3, 2, 'This is the description for order #34', '2025-07-08', '08:47:00', '2025-07-08 04:47:00', '2025-07-08 08:00:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-08 01:47:00', '2025-07-08 01:47:00'),
(35, 'Order Title 35', 'ORD-00035', 2, 1, 1, 2, 1, 'This is the description for order #35', '2025-07-02', '17:29:00', NULL, NULL, NULL, 0, 1, 3, NULL, NULL, '2025-07-02 10:29:00', '2025-07-02 10:29:00'),
(36, 'Order Title 36', 'ORD-00036', 3, 3, 3, 2, 3, 'This is the description for order #36', '2025-07-14', '14:05:00', NULL, NULL, NULL, 0, 1, 1, NULL, NULL, '2025-07-14 07:05:00', '2025-07-14 07:05:00'),
(37, 'Order Title 37', 'ORD-00037', 3, 2, 2, 2, 2, 'This is the description for order #37', '2025-07-22', '08:51:00', '2025-07-22 07:51:00', NULL, NULL, 0, 3, 3, NULL, NULL, '2025-07-22 01:51:00', '2025-07-22 01:51:00'),
(38, 'Order Title 38', 'ORD-00038', 1, 1, 3, 1, 2, 'This is the description for order #38', '2025-07-01', '10:49:00', '2025-07-01 07:49:00', NULL, NULL, 2584, 5, 2, NULL, NULL, '2025-07-01 03:49:00', '2025-07-01 03:49:00'),
(39, 'Order Title 39', 'ORD-00039', 2, 1, 3, 2, 3, 'This is the description for order #39', '2025-07-30', '08:58:00', '2025-07-30 07:58:00', NULL, NULL, 2838, 5, 3, NULL, NULL, '2025-07-30 01:58:00', '2025-07-30 01:58:00'),
(40, 'Order Title 40', 'ORD-00040', 2, 2, 1, 3, 3, 'This is the description for order #40', '2025-07-14', '11:08:00', '2025-07-14 07:08:00', '2025-07-14 10:45:00', NULL, 0, 4, 2, NULL, NULL, '2025-07-14 04:08:00', '2025-07-14 04:08:00'),
(41, 'Order Title 41', 'ORD-00041', 1, 2, 1, 3, 2, 'This is the description for order #41', '2025-07-26', '11:48:00', NULL, NULL, NULL, 0, 2, 2, NULL, NULL, '2025-07-26 04:48:00', '2025-07-26 04:48:00'),
(42, 'Order Title 42', 'ORD-00042', 3, 1, 3, 3, 2, 'This is the description for order #42', '2025-07-17', '12:17:00', '2025-07-17 09:17:00', NULL, NULL, 0, 3, 3, NULL, NULL, '2025-07-17 05:17:00', '2025-07-17 05:17:00'),
(43, 'Order Title 43', 'ORD-00043', 1, 1, 3, 2, 3, 'This is the description for order #43', '2025-07-11', '12:22:00', '2025-07-11 08:22:00', '2025-07-11 11:42:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-11 05:22:00', '2025-07-11 05:22:00'),
(44, 'Order Title 44', 'ORD-00044', 3, 1, 2, 1, 3, 'This is the description for order #44', '2025-07-04', '12:57:00', '2025-07-04 08:57:00', '2025-07-04 12:24:00', NULL, 0, 4, 2, NULL, NULL, '2025-07-04 05:57:00', '2025-07-04 05:57:00'),
(45, 'Order Title 45', 'ORD-00045', 2, 1, 2, 1, 3, 'This is the description for order #45', '2025-07-15', '14:42:00', '2025-07-15 13:42:00', NULL, NULL, 0, 3, 2, NULL, NULL, '2025-07-15 07:42:00', '2025-07-15 07:42:00'),
(46, 'Order Title 46', 'ORD-00046', 3, 1, 2, 1, 3, 'This is the description for order #46', '2025-07-15', '15:36:00', '2025-07-15 11:36:00', NULL, NULL, 6642, 5, 3, NULL, NULL, '2025-07-15 08:36:00', '2025-07-15 08:36:00'),
(47, 'Order Title 47', 'ORD-00047', 1, 3, 2, 3, 1, 'This is the description for order #47', '2025-07-14', '14:17:00', '2025-07-14 10:17:00', '2025-07-14 13:38:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-14 07:17:00', '2025-07-14 07:17:00'),
(48, 'Order Title 48', 'ORD-00048', 1, 2, 1, 1, 1, 'This is the description for order #48', '2025-07-07', '10:01:00', NULL, NULL, NULL, 0, 2, 2, NULL, NULL, '2025-07-07 03:01:00', '2025-07-07 03:01:00'),
(49, 'Order Title 49', 'ORD-00049', 2, 2, 2, 3, 2, 'This is the description for order #49', '2025-07-01', '16:14:00', '2025-07-01 14:14:00', '2025-07-01 15:31:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-01 09:14:00', '2025-07-01 09:14:00'),
(50, 'Order Title 50', 'ORD-00050', 1, 1, 1, 2, 1, 'This is the description for order #50', '2025-07-25', '13:31:00', '2025-07-25 09:31:00', '2025-07-25 12:34:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-25 06:31:00', '2025-07-25 06:31:00'),
(51, 'Order Title 51', 'ORD-00051', 3, 3, 1, 1, 1, 'This is the description for order #51', '2025-07-04', '08:02:00', '2025-07-04 04:02:00', NULL, NULL, 2871, 5, 3, NULL, NULL, '2025-07-04 01:02:00', '2025-07-04 01:02:00'),
(52, 'Order Title 52', 'ORD-00052', 3, 3, 2, 3, 3, 'This is the description for order #52', '2025-07-16', '09:09:00', NULL, NULL, NULL, 0, 1, 1, NULL, NULL, '2025-07-16 02:09:00', '2025-07-16 02:09:00'),
(53, 'Order Title 53', 'ORD-00053', 1, 1, 2, 3, 1, 'This is the description for order #53', '2025-07-24', '16:44:00', NULL, NULL, NULL, 0, 2, 3, NULL, NULL, '2025-07-24 09:44:00', '2025-07-24 09:44:00'),
(54, 'Order Title 54', 'ORD-00054', 1, 1, 1, 2, 1, 'This is the description for order #54', '2025-07-17', '15:04:00', '2025-07-17 14:04:00', NULL, NULL, 0, 3, 1, NULL, NULL, '2025-07-17 08:04:00', '2025-07-17 08:04:00'),
(55, 'Order Title 55', 'ORD-00055', 3, 2, 1, 3, 2, 'This is the description for order #55', '2025-07-08', '12:15:00', NULL, NULL, NULL, 0, 1, 2, NULL, NULL, '2025-07-08 05:15:00', '2025-07-08 05:15:00'),
(56, 'Order Title 56', 'ORD-00056', 1, 1, 2, 1, 3, 'This is the description for order #56', '2025-07-25', '17:20:00', '2025-07-25 14:20:00', NULL, NULL, 0, 3, 2, NULL, NULL, '2025-07-25 10:20:00', '2025-07-25 10:20:00'),
(57, 'Order Title 57', 'ORD-00057', 1, 1, 2, 2, 2, 'This is the description for order #57', '2025-07-14', '10:25:00', '2025-07-14 07:25:00', NULL, NULL, 3262, 5, 3, NULL, NULL, '2025-07-14 03:25:00', '2025-07-14 03:25:00'),
(58, 'Order Title 58', 'ORD-00058', 2, 3, 3, 3, 3, 'This is the description for order #58', '2025-07-26', '08:07:00', NULL, NULL, NULL, 0, 1, 2, NULL, NULL, '2025-07-26 01:07:00', '2025-07-26 01:07:00'),
(59, 'Order Title 59', 'ORD-00059', 2, 2, 3, 2, 3, 'This is the description for order #59', '2025-07-26', '16:03:00', '2025-07-26 11:03:00', NULL, NULL, 6982, 5, 2, NULL, NULL, '2025-07-26 09:03:00', '2025-07-26 09:03:00'),
(60, 'Order Title 60', 'ORD-00060', 1, 1, 3, 3, 1, 'This is the description for order #60', '2025-07-03', '11:03:00', '2025-07-03 09:03:00', '2025-07-03 10:29:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(61, 'Order Title 61', 'ORD-00061', 3, 3, 2, 2, 2, 'This is the description for order #61', '2025-07-22', '15:21:00', NULL, NULL, NULL, 0, 1, 3, NULL, NULL, '2025-07-22 08:21:00', '2025-07-22 08:21:00'),
(62, 'Order Title 62', 'ORD-00062', 2, 3, 3, 3, 1, 'This is the description for order #62', '2025-07-31', '08:11:00', '2025-07-31 06:11:00', '2025-07-31 07:33:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-31 01:11:00', '2025-07-31 01:11:00'),
(63, 'Order Title 63', 'ORD-00063', 1, 3, 3, 3, 2, 'This is the description for order #63', '2025-07-27', '10:33:00', NULL, NULL, NULL, 0, 2, 3, NULL, NULL, '2025-07-27 03:33:00', '2025-07-27 03:33:00'),
(64, 'Order Title 64', 'ORD-00064', 2, 3, 2, 2, 3, 'This is the description for order #64', '2025-07-12', '12:08:00', '2025-07-12 10:08:00', NULL, NULL, 0, 3, 1, NULL, NULL, '2025-07-12 05:08:00', '2025-07-12 05:08:00'),
(65, 'Order Title 65', 'ORD-00065', 1, 1, 3, 1, 3, 'This is the description for order #65', '2025-07-03', '17:52:00', NULL, NULL, NULL, 0, 2, 3, NULL, NULL, '2025-07-03 10:52:00', '2025-07-03 10:52:00'),
(66, 'Order Title 66', 'ORD-00066', 1, 1, 2, 2, 3, 'This is the description for order #66', '2025-07-23', '14:22:00', '2025-07-23 13:22:00', NULL, NULL, 3841, 5, 3, NULL, NULL, '2025-07-23 07:22:00', '2025-07-23 07:22:00'),
(67, 'Order Title 67', 'ORD-00067', 1, 1, 3, 3, 1, 'This is the description for order #67', '2025-07-18', '16:36:00', NULL, NULL, NULL, 0, 1, 3, NULL, NULL, '2025-07-18 09:36:00', '2025-07-18 09:36:00'),
(68, 'Order Title 68', 'ORD-00068', 3, 3, 3, 2, 1, 'This is the description for order #68', '2025-07-12', '13:14:00', NULL, NULL, NULL, 0, 1, 1, NULL, NULL, '2025-07-12 06:14:00', '2025-07-12 06:14:00'),
(69, 'Order Title 69', 'ORD-00069', 2, 1, 2, 2, 3, 'This is the description for order #69', '2025-07-05', '09:02:00', '2025-07-05 07:02:00', NULL, NULL, 0, 3, 2, NULL, NULL, '2025-07-05 02:02:00', '2025-07-05 02:02:00'),
(70, 'Order Title 70', 'ORD-00070', 1, 2, 1, 1, 1, 'This is the description for order #70', '2025-07-22', '13:18:00', '2025-07-22 09:18:00', '2025-07-22 12:41:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-22 06:18:00', '2025-07-22 06:18:00'),
(71, 'Order Title 71', 'ORD-00071', 3, 2, 3, 2, 2, 'This is the description for order #71', '2025-07-09', '09:07:00', '2025-07-09 06:07:00', '2025-07-09 08:18:00', NULL, 0, 4, 2, NULL, NULL, '2025-07-09 02:07:00', '2025-07-09 02:07:00'),
(72, 'Order Title 72', 'ORD-00072', 1, 2, 1, 3, 2, 'This is the description for order #72', '2025-07-22', '15:22:00', '2025-07-22 11:22:00', '2025-07-22 14:22:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-22 08:22:00', '2025-07-22 08:22:00'),
(73, 'Order Title 73', 'ORD-00073', 2, 1, 2, 3, 3, 'This is the description for order #73', '2025-07-01', '09:55:00', '2025-07-01 08:55:00', NULL, NULL, 4836, 5, 1, NULL, NULL, '2025-07-01 02:55:00', '2025-07-01 02:55:00'),
(74, 'Order Title 74', 'ORD-00074', 3, 2, 1, 3, 2, 'This is the description for order #74', '2025-07-08', '12:19:00', '2025-07-08 08:19:00', '2025-07-08 11:40:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-08 05:19:00', '2025-07-08 05:19:00'),
(75, 'Order Title 75', 'ORD-00075', 2, 1, 2, 3, 2, 'This is the description for order #75', '2025-07-03', '16:16:00', '2025-07-03 13:16:00', '2025-07-03 15:27:00', NULL, 0, 4, 1, NULL, NULL, '2025-07-03 09:16:00', '2025-07-03 09:16:00'),
(76, 'Order Title 76', 'ORD-00076', 3, 2, 1, 3, 1, 'This is the description for order #76', '2025-07-19', '08:14:00', '2025-07-19 05:14:00', '2025-07-19 07:54:00', NULL, 0, 4, 3, NULL, NULL, '2025-07-19 01:14:00', '2025-07-19 01:14:00'),
(77, 'Order Title 77', 'ORD-00077', 1, 2, 3, 1, 3, 'This is the description for order #77', '2025-07-14', '17:56:00', '2025-07-14 13:56:00', NULL, NULL, 6441, 5, 3, NULL, NULL, '2025-07-14 10:56:00', '2025-07-14 10:56:00'),
(78, 'Order Title 78', 'ORD-00078', 1, 3, 3, 2, 1, 'This is the description for order #78', '2025-07-15', '12:10:00', NULL, NULL, NULL, 0, 1, 3, NULL, NULL, '2025-07-15 05:10:00', '2025-07-15 05:10:00'),
(79, 'Order Title 79', 'ORD-00079', 1, 2, 2, 2, 1, 'This is the description for order #79', '2025-07-03', '14:46:00', NULL, NULL, NULL, 0, 2, 1, NULL, NULL, '2025-07-03 07:46:00', '2025-07-03 07:46:00'),
(80, 'Order Title 80', 'ORD-00080', 1, 2, 1, 2, 3, 'This is the description for order #80', '2025-07-19', '14:29:00', '2025-07-19 11:29:00', NULL, NULL, 6123, 5, 2, NULL, NULL, '2025-07-19 07:29:00', '2025-07-19 07:29:00'),
(81, 'Brosur Squid Game', 'ORD-00081', 3, 17, 19, 7, 3, 'Mainan anak - anak 8 Tahun s/d 15 Tahun', '2025-07-22', '08:32:54', NULL, NULL, NULL, 0, 1, 2, NULL, NULL, '2025-07-22 01:32:54', '2025-07-22 01:32:54'),
(82, 'Laptop mas Sukma', 'ORD-00082', 1, 2, 1, 2, 7, 'Laptopku nak meledagg', '2025-07-22', '08:57:32', NULL, NULL, NULL, 0, 1, 4, NULL, NULL, '2025-07-22 01:57:32', '2025-07-22 01:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint UNSIGNED NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `priority`, `created_at`, `updated_at`) VALUES
(1, 'Low', NULL, NULL),
(2, 'Medium', NULL, NULL),
(3, 'High', NULL, NULL),
(4, 'Critical', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `progresses`
--

CREATE TABLE `progresses` (
  `id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progresses`
--

INSERT INTO `progresses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Not Started', NULL, NULL),
(2, 'Schedule', NULL, NULL),
(3, 'On Progress', NULL, NULL),
(4, 'Hold', NULL, NULL),
(5, 'Finished', NULL, NULL),
(6, 'Cancel', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, NULL),
(2, 'Admin', NULL, NULL),
(3, 'Employee', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dKs1MjeekYLMGvXDvmI11x4ItzBeFQXX6P5EI0EY', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXNSMjg3NVNTSUF2VWU5YWJQMWFQeUJhVnVhNmxqNFYxNjFFTDEwcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjc7fQ==', 1753150310),
('h6uNhpjacNdJ79xgXaHIYBYkVgVJWRWcLP9eHwNl', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXZDdWRIWmJ3NWZvU1NFUVh2MDFielVBcEdWT29tWDNnb2I3RlVhVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvb3JkZXJzLWJ5LWRhdGU/ZGF0ZT0yMDI1LTA3LTA4JmRlcGFydG1lbnQ9TWFya29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1753087882);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `role_id`, `email`, `department_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin MHC', 'adminmhc', 1, 'admin@gmail.com', 1, '2025-07-17 02:09:56', '$2y$12$YRSqkNXGVQbtWILoTKhuKOy7PYVfvqmgnK0bOpqHNfb.OUnlFYX/O', 'mGnoQhFkS7FWOKpyGWsIaSEQFe9btl37Pbxud4RnHzbjcBtrrUZWQ4fwIOqG', '2025-07-17 02:09:56', '2025-07-17 02:09:56'),
(2, 'Ilhan Pratama', 'ilhan', 2, 'ilhan@gmail.com', 1, '2025-07-17 02:09:56', '$2y$12$DeEhDUfLPw.6qmmeD8iNNuku8QPGHq4wkP8zwugKb.jiYbp.uZ5Yy', 'srYxlFPxwa', '2025-07-17 02:09:57', '2025-07-22 01:36:29'),
(3, 'Farras', 'farras', 2, 'farras@gmail.com', 1, '2025-07-17 02:09:57', '$2y$12$p8juE6WthVnK5qqOq0GToOuGgVbJd32hDQRzCb8Trw7J/097egE3.', 'a9nXKWVCja', '2025-07-17 02:09:57', '2025-07-17 02:09:57'),
(4, 'Hadi', 'hadi', 2, 'hadi@gmail.com', 2, '2025-07-17 02:09:57', '$2y$12$837lmS4ecR2GJ4AqC3tYwOuXR2g/KB.wZHFybGd42De5/6CLVqE4a', 'ycdIPvjUh4', '2025-07-17 02:09:57', '2025-07-17 02:09:57'),
(5, 'Rudi', 'rudi', 2, 'rudi@gmail.com', 2, '2025-07-17 02:09:57', '$2y$12$akgoB6H67L8p0OUqKRTaXujHEOSCkRA6PLU8J4210f8/X0r4t5iWG', 'ezDxSypFdT', '2025-07-17 02:09:57', '2025-07-17 02:09:57'),
(6, 'Lukman', 'lukman', 2, 'lukman@gmail.com', 2, '2025-07-17 02:09:57', '$2y$12$JR/tPlNffjZqFt2ED/PQFuJzNZ4qU7O4ojnpnbG0mZki13aUMu2mm', 'KIAnSxv6lr', '2025-07-17 02:09:58', '2025-07-17 02:09:58'),
(7, 'Sukma', 'sukma', 2, 'sukma@gmail.com', 3, '2025-07-17 02:09:58', '$2y$12$l8UBcYFpofFPivS2mTtJH.HM97aAmANApZ.n1zoAtauzXTjVXFPE6', '9uU0qHoygp', '2025-07-17 02:09:58', '2025-07-22 01:55:03'),
(8, 'Ara', 'ara', 2, 'ara@gmail.com', 3, '2025-07-17 02:09:58', '$2y$12$jOkOq5yPDDyWTK0VHg5eA.ZJ1cadEu.742/peFzlM6Savd7LstAtq', 'wpcNL07Dnc', '2025-07-17 02:09:58', '2025-07-17 02:09:58');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_department_id_foreign` (`department_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_department_id_foreign` (`department_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_letter_number_unique` (`letter_number`),
  ADD KEY `orders_department_id_foreign` (`department_id`),
  ADD KEY `orders_category_id_foreign` (`category_id`),
  ADD KEY `orders_item_id_foreign` (`item_id`),
  ADD KEY `orders_pic_foreign` (`pic`),
  ADD KEY `orders_reporter_foreign` (`reporter`),
  ADD KEY `orders_progress_id_foreign` (`progress_id`),
  ADD KEY `orders_priority_id_foreign` (`priority_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `progresses`
--
ALTER TABLE `progresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_unique` (`role`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `progresses`
--
ALTER TABLE `progresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_pic_foreign` FOREIGN KEY (`pic`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_progress_id_foreign` FOREIGN KEY (`progress_id`) REFERENCES `progresses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_reporter_foreign` FOREIGN KEY (`reporter`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
