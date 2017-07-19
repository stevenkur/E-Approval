-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2017 at 06:52 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-approval`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id_activity` int(10) UNSIGNED NOT NULL,
  `nama_activity` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id_activity`, `nama_activity`, `created_at`, `updated_at`) VALUES
(1, 'View', NULL, NULL),
(2, 'Approved', NULL, NULL),
(3, 'Reject', NULL, NULL),
(4, 'Add Comment', NULL, NULL),
(5, 'Attach File', NULL, NULL),
(6, 'Register Ticket', NULL, NULL),
(7, 'Approved by System', NULL, NULL),
(8, 'Revised', NULL, NULL),
(9, 'Canceled', NULL, NULL),
(10, 'Waiting', NULL, NULL),
(11, 'Updated', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(10) UNSIGNED NOT NULL,
  `nama_category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `nama_category`, `created_at`, `updated_at`) VALUES
(1, 'Marcom', NULL, NULL),
(2, 'BDF', NULL, NULL),
(3, 'RDP', NULL, NULL),
(4, 'Natura', NULL, NULL),
(5, 'BDFConsLum', NULL, NULL),
(6, 'MarcomConslum', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_accesses`
--

CREATE TABLE `category_accesses` (
  `id_access` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `auto_approved` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_accesses`
--

INSERT INTO `category_accesses` (`id_access`, `id_user`, `id_category`, `id_role`, `auto_approved`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 5, NULL, NULL),
(2, 1, 2, 2, 5, NULL, NULL),
(3, 1, 3, 2, 5, NULL, NULL),
(4, 1, 4, 2, 5, NULL, NULL),
(5, 2, 1, 3, 5, NULL, NULL),
(6, 2, 2, 3, 5, NULL, NULL),
(7, 2, 3, 3, 5, NULL, NULL),
(8, 2, 4, 3, 5, NULL, NULL),
(9, 3, 1, 4, 5, NULL, NULL),
(10, 3, 2, 4, 5, NULL, NULL),
(11, 3, 3, 4, 5, NULL, NULL),
(12, 3, 4, 4, 5, NULL, NULL),
(13, 3, 5, 4, 5, NULL, NULL),
(14, 3, 6, 4, 5, NULL, NULL),
(15, 4, 1, 5, 5, NULL, NULL),
(16, 4, 2, 5, 5, NULL, NULL),
(17, 4, 3, 5, 5, NULL, NULL),
(18, 4, 5, 5, 5, NULL, NULL),
(19, 4, 6, 5, 5, NULL, NULL),
(20, 5, 3, 6, 5, NULL, NULL),
(21, 6, 3, 7, 5, NULL, NULL),
(22, 7, 1, 8, 5, NULL, NULL),
(23, 7, 6, 8, 5, NULL, NULL),
(24, 8, 4, 9, 5, NULL, NULL),
(25, 9, 1, 10, 5, NULL, NULL),
(26, 9, 6, 10, 5, NULL, NULL),
(27, 9, 1, 11, 5, NULL, NULL),
(28, 9, 6, 11, 5, NULL, NULL),
(29, 10, 1, 10, 5, NULL, NULL),
(30, 10, 6, 10, 5, NULL, NULL),
(31, 11, 2, 12, 5, NULL, NULL),
(32, 11, 5, 12, 5, NULL, NULL),
(33, 11, 2, 11, 5, NULL, NULL),
(34, 11, 5, 11, 5, NULL, NULL),
(35, 12, 2, 12, 5, NULL, NULL),
(36, 12, 5, 12, 5, NULL, NULL),
(37, 13, 1, 13, 5, NULL, NULL),
(38, 13, 2, 13, 5, NULL, NULL),
(39, 13, 5, 13, 5, NULL, NULL),
(40, 13, 6, 13, 5, NULL, NULL),
(41, 14, 4, 14, 5, NULL, NULL),
(42, 15, 1, 15, 5, NULL, NULL),
(43, 15, 2, 15, 5, NULL, NULL),
(44, 15, 3, 15, 5, NULL, NULL),
(45, 15, 5, 15, 5, NULL, NULL),
(46, 15, 6, 15, 5, NULL, NULL),
(47, 16, 1, 16, 5, NULL, NULL),
(48, 16, 2, 16, 5, NULL, NULL),
(49, 16, 3, 16, 5, NULL, NULL),
(50, 16, 5, 16, 5, NULL, NULL),
(51, 16, 6, 16, 5, NULL, NULL),
(52, 17, 1, 17, 5, NULL, NULL),
(53, 17, 2, 17, 5, NULL, NULL),
(54, 17, 3, 17, 5, NULL, NULL),
(55, 17, 5, 17, 5, NULL, NULL),
(56, 17, 6, 17, 5, NULL, NULL),
(57, 18, 1, 18, 5, NULL, NULL),
(58, 18, 2, 18, 5, NULL, NULL),
(59, 18, 3, 18, 5, NULL, NULL),
(60, 18, 5, 18, 5, NULL, NULL),
(61, 18, 6, 18, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_details`
--

CREATE TABLE `category_details` (
  `id_categorydetail` int(10) UNSIGNED NOT NULL,
  `nama_category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_details`
--

INSERT INTO `category_details` (`id_categorydetail`, `nama_category`, `category_type`, `created_at`, `updated_at`) VALUES
(1, 'Marcom', 'HM1 - Build the Base ', NULL, NULL),
(2, 'Marcom', 'HM2 - LED Lamps Leadership', NULL, NULL),
(3, 'Marcom', 'HM3 - ProShop', NULL, NULL),
(4, 'BDF', 'HM4 - MR Growth', NULL, NULL),
(5, 'BDF', 'HM5 - Branded Retail (excl BDF)', NULL, NULL),
(6, 'RDP', 'HM8 - Cross Cons Campaign', NULL, NULL),
(7, 'RDP', 'HM9 - Local Cons Campaign', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id_claim` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_category` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_program` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `entitlement` int(11) NOT NULL,
  `programforyear` int(11) NOT NULL,
  `pr_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airwaybill` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_form` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_tax` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_distributor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_flow` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_flow` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claim_attachments`
--

CREATE TABLE `claim_attachments` (
  `id_attachment` int(10) UNSIGNED NOT NULL,
  `id_claim` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_attachment` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_attachment` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id_dist` int(10) UNSIGNED NOT NULL,
  `distributor_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_distributor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id_dist`, `distributor_id`, `nama_distributor`, `country`, `created_at`, `updated_at`) VALUES
(1, 'IDTRJKT1', 'PT. Sahabat Abadi Sejahtera 31', 'Indonesia', NULL, NULL),
(2, 'IDTRJKT2', 'PT. Sahabat Abadi Sejahtera 32', 'Indonesia', NULL, NULL),
(3, 'IDTRJKT4', 'PT. Sahabat Abadi Sejahtera 34', 'Indonesia', NULL, NULL),
(4, 'IDTRJKT5', 'PT. Telesindo Citra Sejahtera', 'Indonesia', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `flows`
--

CREATE TABLE `flows` (
  `id_flow` int(10) UNSIGNED NOT NULL,
  `kode_flow` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_flow` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int(11) NOT NULL,
  `level_flow` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id_holiday` int(10) UNSIGNED NOT NULL,
  `tanggal_libur` date NOT NULL,
  `date_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id_holiday`, `tanggal_libur`, `date_name`, `created_at`, `updated_at`) VALUES
(1, '2017-07-22', 'Sabtu', NULL, NULL),
(2, '2017-07-23', 'Minggu', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log_claims`
--

CREATE TABLE `log_claims` (
  `id_log` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_claim` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_activity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marketings`
--

CREATE TABLE `marketings` (
  `id_marketing` int(10) UNSIGNED NOT NULL,
  `id_dist` int(20) NOT NULL,
  `id_program` int(11) NOT NULL,
  `entitlement` int(11) NOT NULL,
  `maxclaim_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marketings`
--

INSERT INTO `marketings` (`id_marketing`, `id_dist`, `id_program`, `entitlement`, `maxclaim_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1000000, '2017-08-11', NULL, NULL),
(2, 1, 2, 500000, '2017-08-25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(55, '2014_10_12_000000_create_users_table', 1),
(56, '2014_10_12_100000_create_password_resets_table', 1),
(57, '2017_07_17_093811_create_roles_table', 1),
(58, '2017_07_17_093852_create_categories_table', 1),
(59, '2017_07_17_094001_create_distributors_table', 1),
(60, '2017_07_17_094040_create_user_distributors_table', 1),
(61, '2017_07_17_094155_create_marketings_table', 1),
(62, '2017_07_17_094228_create_holidays_table', 1),
(63, '2017_07_17_094255_create_category_details_table', 1),
(64, '2017_07_17_094336_create_programs_table', 1),
(65, '2017_07_17_094404_create_flows_table', 1),
(66, '2017_07_17_094428_create_claims_table', 1),
(67, '2017_07_17_094456_create_comments_table', 1),
(68, '2017_07_17_094523_create_category_accesses_table', 1),
(69, '2017_07_17_094601_create_claim_attachments_table', 1),
(70, '2017_07_17_094636_create_activities_table', 1),
(71, '2017_07_17_094707_create_log_claims_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id_program` int(10) UNSIGNED NOT NULL,
  `nama_program` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id_program`, `nama_program`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'program a', 2017, NULL, NULL),
(2, 'program b', 2017, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(10) UNSIGNED NOT NULL,
  `nama_role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `nama_role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL),
(2, 'Distributor', NULL, NULL),
(3, 'Distributor Manager', NULL, NULL),
(4, 'Regional Sales Manager', NULL, NULL),
(5, 'Admin Marketing', NULL, NULL),
(6, 'Sales Analyst Manager', NULL, NULL),
(7, 'Sales Manager', NULL, NULL),
(8, 'Admin Marcom', NULL, NULL),
(9, 'Admin Natura', NULL, NULL),
(10, 'Marcom Manager', NULL, NULL),
(11, 'B2C', NULL, NULL),
(12, 'Trade Consumer Manager', NULL, NULL),
(13, 'Marketing Manager', NULL, NULL),
(14, 'Admin SCM', NULL, NULL),
(15, 'Admin Finance', NULL, NULL),
(16, 'Controller', NULL, NULL),
(17, 'CFO', NULL, NULL),
(18, 'CEO', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email3` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email4` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email5` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email6` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email7` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email8` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email9` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `email`, `password`, `email1`, `email2`, `email3`, `email4`, `email5`, `email6`, `email7`, `email8`, `email9`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Distributor A', 'distributor@philips.com', 'distributor@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(2, 'mariootto poluan', 'mariootto.poluan@philips.com', 'mariootto.poluan@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(3, 'Heri Dono', 'heri.dono1@philips.com', 'heri.dono1@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(4, 'Admin Marketing', 'admin.marketing@philips.com', 'admin.marketing@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(5, 'Ahmad Saiful', 'ahmad.saiful@philips.com', 'ahmad.saiful@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(6, 'Dedy B.Pramono', 'dedy.b.pramono@philips.com', 'dedy.b.pramono@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(7, 'Setia Adi Nugraha', 'setia.adi.nugraha@philips.com', 'setia.adi.nugraha@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(8, 'Puja Kusuma', 'Puja.Kusuma@philips.com', 'Puja.Kusuma@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(9, 'Alberta Pietutami', 'alberta.pietutami@philips.com', 'alberta.pietutami@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(10, 'Astrid Ramli', 'Astrid.Ramli@philips.com', 'Astrid.Ramli@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(11, 'Herumono Saputro', 'Herumono.Saputro@philips.com', 'Herumono.Saputro@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(12, 'Edi Marsongko', 'edi.marsongko1@philips.com', 'edi.marsongko1@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(13, 'Sauhong Lim', 'sauhong.lim@philips.com', 'sauhong.lim@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(14, 'Annisa Arrofah', 'annisa.arrofah@philips.com', 'annisa.arrofah@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(15, 'Oktavia richa', 'oktavia.richa@philips.com', 'oktavia.richa@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(16, 'Luella Luhukay', 'luella.luhukay@philips.com', 'luella.luhukay@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(17, 'Riste Milev', 'riste.milev@philips.com', 'riste.milev@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(18, 'Rami Hajjar', 'rami.hajjar@philips.com', 'rami.hajjar@philips.com', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(19, 'Administrator', 'Administrator', 'Administrator', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_distributors`
--

CREATE TABLE `user_distributors` (
  `id_user_distributor` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `distributor_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_distributors`
--

INSERT INTO `user_distributors` (`id_user_distributor`, `id_user`, `distributor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'IDTRJKT1', NULL, NULL),
(2, 2, 'IDTRJKT1', NULL, NULL),
(3, 3, 'IDTRJKT1', NULL, NULL),
(4, 4, 'IDTRJKT1', NULL, NULL),
(5, 5, 'IDTRJKT1', NULL, NULL),
(6, 6, 'IDTRJKT1', NULL, NULL),
(7, 7, 'IDTRJKT1', NULL, NULL),
(8, 8, 'IDTRJKT1', NULL, NULL),
(9, 9, 'IDTRJKT1', NULL, NULL),
(10, 10, 'IDTRJKT1', NULL, NULL),
(11, 11, 'IDTRJKT1', NULL, NULL),
(12, 12, 'IDTRJKT1', NULL, NULL),
(13, 13, 'IDTRJKT1', NULL, NULL),
(14, 14, 'IDTRJKT1', NULL, NULL),
(15, 15, 'IDTRJKT1', NULL, NULL),
(16, 16, 'IDTRJKT1', NULL, NULL),
(17, 17, 'IDTRJKT1', NULL, NULL),
(18, 18, 'IDTRJKT1', NULL, NULL),
(19, 3, 'IDTRJKT2', NULL, NULL),
(20, 4, 'IDTRJKT2', NULL, NULL),
(21, 5, 'IDTRJKT2', NULL, NULL),
(22, 6, 'IDTRJKT2', NULL, NULL),
(23, 7, 'IDTRJKT2', NULL, NULL),
(24, 8, 'IDTRJKT2', NULL, NULL),
(25, 9, 'IDTRJKT2', NULL, NULL),
(26, 10, 'IDTRJKT2', NULL, NULL),
(27, 11, 'IDTRJKT2', NULL, NULL),
(28, 12, 'IDTRJKT2', NULL, NULL),
(29, 13, 'IDTRJKT2', NULL, NULL),
(30, 14, 'IDTRJKT2', NULL, NULL),
(31, 15, 'IDTRJKT2', NULL, NULL),
(32, 16, 'IDTRJKT2', NULL, NULL),
(33, 17, 'IDTRJKT2', NULL, NULL),
(34, 18, 'IDTRJKT2', NULL, NULL),
(35, 3, 'IDTRJKT4', NULL, NULL),
(36, 4, 'IDTRJKT4', NULL, NULL),
(37, 5, 'IDTRJKT4', NULL, NULL),
(38, 6, 'IDTRJKT4', NULL, NULL),
(39, 7, 'IDTRJKT4', NULL, NULL),
(40, 8, 'IDTRJKT4', NULL, NULL),
(41, 9, 'IDTRJKT4', NULL, NULL),
(42, 10, 'IDTRJKT4', NULL, NULL),
(43, 11, 'IDTRJKT4', NULL, NULL),
(44, 12, 'IDTRJKT4', NULL, NULL),
(45, 13, 'IDTRJKT4', NULL, NULL),
(46, 14, 'IDTRJKT4', NULL, NULL),
(47, 15, 'IDTRJKT4', NULL, NULL),
(48, 16, 'IDTRJKT4', NULL, NULL),
(49, 17, 'IDTRJKT4', NULL, NULL),
(50, 18, 'IDTRJKT4', NULL, NULL),
(51, 4, 'IDTRJKT5', NULL, NULL),
(52, 5, 'IDTRJKT5', NULL, NULL),
(53, 6, 'IDTRJKT5', NULL, NULL),
(54, 7, 'IDTRJKT5', NULL, NULL),
(55, 8, 'IDTRJKT5', NULL, NULL),
(56, 9, 'IDTRJKT5', NULL, NULL),
(57, 10, 'IDTRJKT5', NULL, NULL),
(58, 11, 'IDTRJKT5', NULL, NULL),
(59, 12, 'IDTRJKT5', NULL, NULL),
(60, 13, 'IDTRJKT5', NULL, NULL),
(61, 14, 'IDTRJKT5', NULL, NULL),
(62, 15, 'IDTRJKT5', NULL, NULL),
(63, 16, 'IDTRJKT5', NULL, NULL),
(64, 17, 'IDTRJKT5', NULL, NULL),
(65, 18, 'IDTRJKT5', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id_activity`),
  ADD UNIQUE KEY `activities_id_activity_unique` (`id_activity`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `categories_id_category_unique` (`id_category`);

--
-- Indexes for table `category_accesses`
--
ALTER TABLE `category_accesses`
  ADD PRIMARY KEY (`id_access`),
  ADD UNIQUE KEY `category_accesses_id_access_unique` (`id_access`);

--
-- Indexes for table `category_details`
--
ALTER TABLE `category_details`
  ADD PRIMARY KEY (`id_categorydetail`),
  ADD UNIQUE KEY `category_details_id_categorydetail_unique` (`id_categorydetail`);

--
-- Indexes for table `claim_attachments`
--
ALTER TABLE `claim_attachments`
  ADD PRIMARY KEY (`id_attachment`),
  ADD UNIQUE KEY `claim_attachments_id_attachment_unique` (`id_attachment`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD UNIQUE KEY `comments_id_comment_unique` (`id_comment`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id_dist`),
  ADD UNIQUE KEY `distributors_id_dist_unique` (`id_dist`);

--
-- Indexes for table `flows`
--
ALTER TABLE `flows`
  ADD PRIMARY KEY (`id_flow`),
  ADD UNIQUE KEY `flows_id_flow_unique` (`id_flow`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id_holiday`),
  ADD UNIQUE KEY `holidays_id_holiday_unique` (`id_holiday`);

--
-- Indexes for table `log_claims`
--
ALTER TABLE `log_claims`
  ADD PRIMARY KEY (`id_log`),
  ADD UNIQUE KEY `log_claims_id_log_unique` (`id_log`);

--
-- Indexes for table `marketings`
--
ALTER TABLE `marketings`
  ADD PRIMARY KEY (`id_marketing`),
  ADD UNIQUE KEY `marketings_id_marketing_unique` (`id_marketing`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id_program`),
  ADD UNIQUE KEY `programs_id_program_unique` (`id_program`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `roles_id_role_unique` (`id_role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_id_user_unique` (`id_user`);

--
-- Indexes for table `user_distributors`
--
ALTER TABLE `user_distributors`
  ADD PRIMARY KEY (`id_user_distributor`),
  ADD UNIQUE KEY `user_distributors_id_user_distributor_unique` (`id_user_distributor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id_activity` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category_accesses`
--
ALTER TABLE `category_accesses`
  MODIFY `id_access` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `category_details`
--
ALTER TABLE `category_details`
  MODIFY `id_categorydetail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `claim_attachments`
--
ALTER TABLE `claim_attachments`
  MODIFY `id_attachment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id_dist` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `flows`
--
ALTER TABLE `flows`
  MODIFY `id_flow` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id_holiday` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_claims`
--
ALTER TABLE `log_claims`
  MODIFY `id_log` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `marketings`
--
ALTER TABLE `marketings`
  MODIFY `id_marketing` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id_program` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_distributors`
--
ALTER TABLE `user_distributors`
  MODIFY `id_user_distributor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
