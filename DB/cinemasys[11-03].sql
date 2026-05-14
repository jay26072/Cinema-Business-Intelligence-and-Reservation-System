-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 02:49 PM
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
-- Database: `cinemasys`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_models`
--

CREATE TABLE `booking_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `show_id` varchar(255) NOT NULL,
  `movie_id` varchar(255) NOT NULL,
  `theater_id` varchar(255) NOT NULL,
  `booking_reference` varchar(255) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `seat_number` varchar(255) NOT NULL,
  `screen_type` varchar(25) NOT NULL,
  `screen_no` varchar(25) NOT NULL,
  `language` varchar(25) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` enum('pending','completed','failed','refunded') NOT NULL,
  `booking_status` enum('locked','confirmed','cancelled') NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `discount_amount` decimal(8,2) DEFAULT 0.00,
  `promo_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_models`
--

INSERT INTO `booking_models` (`id`, `user_id`, `show_id`, `movie_id`, `theater_id`, `booking_reference`, `payment_id`, `seat_number`, `screen_type`, `screen_no`, `language`, `total_price`, `payment_method`, `payment_status`, `booking_status`, `expires_at`, `discount_amount`, `promo_code`, `created_at`, `updated_at`) VALUES
(1, '1', '26', '1', '1', 'BKA909SX0I', 'pay_SNQmXZRzAgSe6M', '[\"e7\",\"f7\"]', '2', '3', 'Hindi', 352.00, 'online', 'completed', 'confirmed', '2026-03-05 00:10:35', 0.00, NULL, '2026-03-05 00:05:35', '2026-03-05 00:06:42'),
(2, '1', '26', '1', '1', 'BKIUKSIRFS', 'pay_SNR91CdROafGlb', '[\"d7\",\"e6\"]', '2', '3', 'Hindi', 440.00, 'online', 'refunded', 'cancelled', '2026-03-05 00:32:09', 0.00, NULL, '2026-03-05 00:27:09', '2026-03-05 01:41:53'),
(3, '1', '26', '1', '1', 'BK9TAMVEMZ', 'pay_SNSo4MFsWxVcsb', '[\"e5\",\"f5\"]', '2', '3', 'Hindi', 440.00, 'online', 'completed', 'confirmed', '2026-03-05 02:09:52', 0.00, NULL, '2026-03-05 02:04:52', '2026-03-05 02:05:27'),
(4, '1', '26', '1', '1', 'BKHGA6NQOP', NULL, '[\"a7\",\"a8\",\"b7\",\"b8\"]', '2', '3', 'Hindi', 1260.00, 'online', 'pending', 'cancelled', '2026-03-05 03:39:58', 0.00, NULL, '2026-03-05 03:34:58', '2026-03-05 03:40:34'),
(5, '2', '26', '1', '1', 'BK3WNOSRWJ', NULL, '[\"g1\",\"g2\",\"g3\"]', '2', '3', 'Hindi', 443.00, 'online', 'pending', 'cancelled', '2026-03-05 03:51:32', 0.00, NULL, '2026-03-05 03:46:32', '2026-03-05 03:57:10'),
(6, '2', '26', '1', '1', 'BKVGI1JONB', NULL, '[\"h3\",\"h4\",\"i3\",\"i4\"]', '2', '3', 'Hindi', 630.00, 'online', 'pending', 'cancelled', '2026-03-05 03:55:01', 0.00, NULL, '2026-03-05 03:50:01', '2026-03-05 03:57:10'),
(7, '2', '26', '1', '1', 'BKY4MI8HNS', NULL, '[\"d2\",\"d3\"]', '2', '3', 'Hindi', 400.00, 'online', 'pending', 'cancelled', '2026-03-05 04:02:48', 0.00, NULL, '2026-03-05 03:57:48', '2026-03-05 04:06:40'),
(8, '2', '26', '1', '1', 'BK9DXXYFYX', NULL, '[\"d5\",\"d6\",\"d7\"]', '2', '3', 'Hindi', 660.00, 'online', 'pending', 'cancelled', '2026-03-05 04:03:38', 0.00, NULL, '2026-03-05 03:58:38', '2026-03-05 04:06:40'),
(9, '1', '26', '1', '1', 'BK2LXXFKHE', NULL, '[\"g5\",\"g6\",\"g7\"]', '2', '3', 'Hindi', 495.00, 'online', 'pending', 'cancelled', '2026-03-05 04:06:45', 0.00, NULL, '2026-03-05 04:01:45', '2026-03-05 04:07:24'),
(10, '1', '26', '1', '1', 'BKU8BVMAXO', NULL, '[\"h6\",\"h7\",\"h8\"]', '2', '3', 'Hindi', 480.00, 'online', 'pending', 'cancelled', '2026-03-05 04:11:49', 0.00, NULL, '2026-03-05 04:06:49', '2026-03-06 00:07:30'),
(11, NULL, '26', '1', '1', 'BK0HLNZRW1', NULL, '[\"a6\",\"b6\"]', '2', '3', 'Hindi', 528.00, 'online', 'pending', 'cancelled', '2026-03-06 00:12:40', 0.00, NULL, '2026-03-06 00:07:40', '2026-03-06 00:13:04'),
(12, '1', '26', '1', '1', 'BK6LTUOVGG', 'pay_SNpcFnYZza9Vrz', '[\"b7\",\"c6\",\"c7\"]', '2', '3', 'Hindi', 990.00, 'online', 'completed', 'confirmed', '2026-03-06 00:28:28', 0.00, NULL, '2026-03-06 00:23:28', '2026-03-06 00:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `cast_models`
--

CREATE TABLE `cast_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `castname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cast_models`
--

INSERT INTO `cast_models` (`id`, `castname`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Prabhas', '21872.jpg', '2026-01-28 23:15:19', '2026-01-28 23:15:19'),
(2, 'John Kokken', '97231.jpg', '2026-01-28 23:16:17', '2026-01-28 23:16:17'),
(3, 'Anushka Shetty', '74868.jpg', '2026-01-28 23:17:30', '2026-01-28 23:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `city_models`
--

CREATE TABLE `city_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `city_models`
--

INSERT INTO `city_models` (`id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 'Bardoli', '2026-01-28 22:54:46', '2026-01-28 22:54:46'),
(2, 'Surat', '2026-01-28 22:54:54', '2026-01-28 22:54:54'),
(3, 'Navsari', '2026-01-28 22:55:03', '2026-01-28 22:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `crew_models`
--

CREATE TABLE `crew_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `crewname` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crew_models`
--

INSERT INTO `crew_models` (`id`, `crewname`, `image`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Aditya Chopra', '72643.jpg', 'Producer', '2026-01-28 23:06:50', '2026-01-28 23:06:50'),
(2, 'Bhushan Kumar', '21382.jpg', 'Producer', '2026-01-28 23:07:54', '2026-01-28 23:07:54'),
(3, 'Yash Chopra', '29135.jpg', 'Director', '2026-01-28 23:08:46', '2026-01-28 23:08:46'),
(4, 'S. S. Rajamouli', '29031.jpg', 'Director', '2026-01-28 23:11:10', '2026-01-28 23:11:10'),
(5, 'Yash Raj Films', '67749.png', 'Productionhouse', '2026-01-28 23:13:17', '2026-01-28 23:13:17'),
(6, 'T-Series Films', '51086.jpg', 'Productionhouse', '2026-01-28 23:14:05', '2026-01-28 23:14:05');

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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"da4e3bf7-c1f0-47a6-989a-30223b2b30cc\",\"displayName\":\"App\\\\Mail\\\\PaymentSuccessMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\PaymentSuccessMail\\\":30:{s:7:\\\"details\\\";a:12:{s:4:\\\"name\\\";s:3:\\\"jay\\\";s:11:\\\"movie_image\\\";s:9:\\\"63049.jpg\\\";s:5:\\\"movie\\\";s:8:\\\"On Watch\\\";s:8:\\\"language\\\";s:5:\\\"Hindi\\\";s:7:\\\"theater\\\";s:12:\\\"Royal Cinema\\\";s:9:\\\"show_time\\\";s:21:\\\"28 Feb 2026, 10:00 PM\\\";s:9:\\\"screen_no\\\";s:1:\\\"2\\\";s:5:\\\"seats\\\";s:6:\\\"h2, i2\\\";s:11:\\\"total_price\\\";s:6:\\\"300.00\\\";s:8:\\\"discount\\\";s:4:\\\"0.00\\\";s:10:\\\"payment_id\\\";s:18:\\\"pay_SLZ0eFU9OXYEqC\\\";s:17:\\\"booking_reference\\\";s:10:\\\"BK5PMKUKPJ\\\";}s:9:\\\"ticketPdf\\\";N;s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"jaypatel2672002@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1772281771, 1772281771),
(2, 'default', '{\"uuid\":\"84892282-8837-47d3-b0ed-f70f3a3dab73\",\"displayName\":\"App\\\\Mail\\\\PaymentSuccessMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\PaymentSuccessMail\\\":30:{s:7:\\\"details\\\";a:12:{s:4:\\\"name\\\";s:3:\\\"jay\\\";s:11:\\\"movie_image\\\";s:9:\\\"63049.jpg\\\";s:5:\\\"movie\\\";s:8:\\\"On Watch\\\";s:8:\\\"language\\\";s:5:\\\"Hindi\\\";s:7:\\\"theater\\\";s:12:\\\"Royal Cinema\\\";s:9:\\\"show_time\\\";s:21:\\\"28 Feb 2026, 10:00 PM\\\";s:9:\\\"screen_no\\\";s:1:\\\"2\\\";s:5:\\\"seats\\\";s:6:\\\"h2, i2\\\";s:11:\\\"total_price\\\";s:6:\\\"300.00\\\";s:8:\\\"discount\\\";s:4:\\\"0.00\\\";s:10:\\\"payment_id\\\";s:18:\\\"pay_SLZ0eFU9OXYEqC\\\";s:17:\\\"booking_reference\\\";s:10:\\\"BK5PMKUKPJ\\\";}s:9:\\\"ticketPdf\\\";N;s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"jaypatel2672002@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1772282047, 1772282047),
(3, 'default', '{\"uuid\":\"f4edfc5d-d72e-40c5-8f82-228170f47de3\",\"displayName\":\"App\\\\Mail\\\\PaymentSuccessMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\PaymentSuccessMail\\\":30:{s:7:\\\"details\\\";a:12:{s:4:\\\"name\\\";s:8:\\\"Customer\\\";s:11:\\\"movie_image\\\";s:9:\\\"63049.jpg\\\";s:5:\\\"movie\\\";s:8:\\\"On Watch\\\";s:8:\\\"language\\\";s:5:\\\"Hindi\\\";s:7:\\\"theater\\\";s:12:\\\"Royal Cinema\\\";s:9:\\\"show_time\\\";s:21:\\\"28 Feb 2026, 10:00 PM\\\";s:9:\\\"screen_no\\\";s:1:\\\"2\\\";s:5:\\\"seats\\\";s:6:\\\"h2, i2\\\";s:11:\\\"total_price\\\";s:6:\\\"300.00\\\";s:8:\\\"discount\\\";s:4:\\\"0.00\\\";s:10:\\\"payment_id\\\";s:18:\\\"pay_SLZ0eFU9OXYEqC\\\";s:17:\\\"booking_reference\\\";s:10:\\\"BK5PMKUKPJ\\\";}s:9:\\\"ticketPdf\\\";N;s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"jaypatel2672002@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1772282104, 1772282104),
(4, 'default', '{\"uuid\":\"49dbc08f-7ed9-4268-b66c-e8b90ebfe27a\",\"displayName\":\"App\\\\Mail\\\\PaymentSuccessMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":13:{s:8:\\\"mailable\\\";O:27:\\\"App\\\\Mail\\\\PaymentSuccessMail\\\":30:{s:7:\\\"details\\\";a:12:{s:4:\\\"name\\\";s:8:\\\"Customer\\\";s:11:\\\"movie_image\\\";s:9:\\\"63049.jpg\\\";s:5:\\\"movie\\\";s:8:\\\"On Watch\\\";s:8:\\\"language\\\";s:5:\\\"Hindi\\\";s:7:\\\"theater\\\";s:12:\\\"Royal Cinema\\\";s:9:\\\"show_time\\\";s:21:\\\"28 Feb 2026, 10:00 PM\\\";s:9:\\\"screen_no\\\";s:1:\\\"2\\\";s:5:\\\"seats\\\";s:6:\\\"i8, j9\\\";s:11:\\\"total_price\\\";s:6:\\\"300.00\\\";s:8:\\\"discount\\\";s:4:\\\"0.00\\\";s:10:\\\"payment_id\\\";s:18:\\\"pay_SLZFqgv6gq9kiH\\\";s:17:\\\"booking_reference\\\";s:10:\\\"BKXGPGLTTE\\\";}s:9:\\\"ticketPdf\\\";N;s:6:\\\"locale\\\";N;s:4:\\\"from\\\";a:0:{}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:25:\\\"jaypatel2672002@gmail.com\\\";}}s:2:\\\"cc\\\";a:0:{}s:3:\\\"bcc\\\";a:0:{}s:7:\\\"replyTo\\\";a:0:{}s:7:\\\"subject\\\";N;s:8:\\\"markdown\\\";N;s:7:\\\"\\u0000*\\u0000html\\\";N;s:4:\\\"view\\\";N;s:8:\\\"textView\\\";N;s:8:\\\"viewData\\\";a:0:{}s:11:\\\"attachments\\\";a:0:{}s:14:\\\"rawAttachments\\\";a:0:{}s:15:\\\"diskAttachments\\\";a:0:{}s:9:\\\"callbacks\\\";a:0:{}s:5:\\\"theme\\\";N;s:6:\\\"mailer\\\";s:4:\\\"smtp\\\";s:29:\\\"\\u0000*\\u0000assertionableRenderStrings\\\";N;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}}\"}}', 0, NULL, 1772282153, 1772282153);

-- --------------------------------------------------------

--
-- Table structure for table `login_models`
--

CREATE TABLE `login_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_models`
--

INSERT INTO `login_models` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_01_13_050459_create_login_models_table', 1),
(6, '2026_01_16_040913_create_city_models_table', 1),
(7, '2026_01_16_055134_create_typesof_movie_models_table', 1),
(8, '2026_01_19_045841_create_cast_models_table', 1),
(9, '2026_01_19_051508_create_crew_models_table', 1),
(10, '2026_01_19_060213_create_screen_exp_models_table', 1),
(11, '2026_01_20_134642_create_theater_models_table', 1),
(12, '2026_01_21_062722_create_movie_models_table', 1),
(13, '2026_02_12_060947_create_show_models_table', 2),
(14, '2026_02_19_060028_create_booking_models_table', 3),
(15, '2026_02_19_071250_create_user_models_table', 4),
(16, '2026_02_19_164121_create_promo_codes_table', 5),
(17, '2026_02_19_171802_create_booking_models_table', 6),
(18, '2026_02_28_121837_create_jobs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `movie_models`
--

CREATE TABLE `movie_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `movie_image` varchar(255) NOT NULL,
  `movie_description` varchar(255) NOT NULL,
  `movie_type` varchar(255) NOT NULL,
  `movie_duration` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `screen_type` varchar(255) NOT NULL,
  `release_date` varchar(255) NOT NULL,
  `movie_trailer` varchar(255) NOT NULL,
  `movie_trailer_date` varchar(255) NOT NULL,
  `movie_cast` varchar(255) NOT NULL,
  `movie_crew` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `movie_models`
--

INSERT INTO `movie_models` (`id`, `movie_name`, `movie_image`, `movie_description`, `movie_type`, `movie_duration`, `language`, `screen_type`, `release_date`, `movie_trailer`, `movie_trailer_date`, `movie_cast`, `movie_crew`, `status`, `created_at`, `updated_at`) VALUES
(1, 'On Watch', '63049.jpg', 'Hacking Movie', '1,4,6', '120', 'English,Hindi', '1', '2026-01-18', 'https://youtu.be/PhN1xnCyqR8?si=d3Wh6ohsZSPZIDG5', '2025-12-31', '1,2', '2,4,6', '1', '2026-02-01 23:06:09', '2026-02-01 23:06:09'),
(2, 'Fury', '12833.jpg', 'Action Adventure Movies', '1,6', '120', 'English,Hindi', '1,2', '2026-02-25', 'https://youtu.be/q94n3eWOWXM', '0026-12-30', '1,2', '1,2,3,4,6', '1', '2026-02-08 23:07:10', '2026-02-08 23:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount_type` enum('percentage','flat') NOT NULL,
  `discount_value` decimal(8,2) NOT NULL,
  `min_amount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`id`, `code`, `discount_type`, `discount_value`, `min_amount`, `usage_limit`, `used_count`, `expires_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'test50', 'flat', 50.00, 30.00, 50, 0, '2026-02-21 17:08:56', 1, NULL, NULL),
(2, 'Set50', 'percentage', 50.00, 25.00, 25, 0, '2026-02-27 18:30:00', 1, '2026-02-19 12:28:48', '2026-02-19 12:28:48');

-- --------------------------------------------------------

--
-- Table structure for table `screen_exp_models`
--

CREATE TABLE `screen_exp_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `screen_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `screen_exp_models`
--

INSERT INTO `screen_exp_models` (`id`, `screen_type`, `created_at`, `updated_at`) VALUES
(1, '2D', '2026-01-28 22:53:39', '2026-01-28 22:53:39'),
(2, '3D', '2026-01-28 22:53:43', '2026-01-28 22:53:43'),
(3, 'IMAX', '2026-01-28 22:53:46', '2026-01-28 22:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `show_models`
--

CREATE TABLE `show_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` varchar(255) NOT NULL,
  `theater_id` varchar(255) NOT NULL,
  `show_date` date NOT NULL,
  `show_time` time NOT NULL,
  `language` varchar(50) NOT NULL,
  `screen_type` varchar(50) NOT NULL,
  `screen_no` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `show_models`
--

INSERT INTO `show_models` (`id`, `movie_id`, `theater_id`, `show_date`, `show_time`, `language`, `screen_type`, `screen_no`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2026-02-13', '11:00:00', '', '', '', '2026-02-13 01:11:01', '2026-02-13 01:11:01'),
(2, '1', '1', '2026-02-13', '13:00:00', '', '', '', '2026-02-13 01:21:44', '2026-02-13 01:21:44'),
(4, '1', '1', '2026-02-13', '12:00:00', '', '', '', '2026-02-13 01:42:22', '2026-02-13 01:42:22'),
(5, '1', '1', '2026-02-16', '12:00:00', '', '', '', '2026-02-15 23:43:32', '2026-02-15 23:43:32'),
(6, '2', '2', '2026-02-16', '14:00:00', '', '', '', '2026-02-15 23:48:23', '2026-02-15 23:48:23'),
(7, '1', '1', '2026-02-17', '12:00:00', '', '', '', '2026-02-16 01:02:06', '2026-02-16 01:02:06'),
(8, '1', '1', '2026-02-16', '15:45:00', '', '', '', '2026-02-16 01:13:31', '2026-02-16 01:13:31'),
(9, '2', '1', '2026-02-16', '14:30:00', '', '', '', '2026-02-16 01:14:04', '2026-02-16 01:14:04'),
(10, '2', '2', '2026-02-17', '13:00:00', '', '', '', '2026-02-16 01:19:57', '2026-02-16 01:19:57'),
(11, '2', '2', '2026-02-16', '13:30:00', '', '', '', '2026-02-16 01:20:26', '2026-02-16 01:20:26'),
(12, '1', '2', '2026-02-16', '13:30:00', '', '', '', '2026-02-16 01:20:58', '2026-02-16 01:20:58'),
(13, '1', '1', '2026-02-15', '12:00:00', '', '', '', '2026-02-16 01:26:57', '2026-02-16 01:26:57'),
(14, '2', '1', '2026-02-18', '13:00:00', '', '', '', '2026-02-17 23:41:23', '2026-02-17 23:41:23'),
(15, '2', '1', '2026-02-19', '13:00:00', '', '', '', '2026-02-17 23:58:32', '2026-02-17 23:58:32'),
(16, '1', '1', '2026-02-18', '15:00:00', '', '', '', '2026-02-18 03:56:19', '2026-02-18 03:56:19'),
(17, '1', '1', '2026-02-19', '14:00:00', '', '', '', '2026-02-18 23:58:52', '2026-02-18 23:58:52'),
(18, '1', '1', '2026-02-20', '22:00:00', '', '', '', '2026-02-19 09:59:44', '2026-02-19 09:59:44'),
(19, '1', '1', '2026-02-21', '17:00:00', 'Hindi', '1', '3', '2026-02-20 06:48:39', '2026-02-20 06:48:39'),
(20, '1', '1', '2026-02-21', '22:00:00', 'Hindi', '1', '1', '2026-02-21 06:35:31', '2026-02-21 06:35:31'),
(21, '2', '2', '2026-02-25', '23:00:00', 'English', '2', '2', '2026-02-21 06:36:28', '2026-02-21 06:36:28'),
(22, '1', '1', '2026-02-25', '22:00:00', 'Hindi', '1', '1', '2026-02-23 00:42:13', '2026-02-23 00:42:13'),
(23, '1', '1', '2026-02-25', '23:00:00', 'Hindi', '1', '2', '2026-02-25 00:22:07', '2026-02-25 00:22:07'),
(24, '1', '1', '2026-02-26', '20:00:00', 'Hindi', '1', '1', '2026-02-25 23:23:47', '2026-02-25 23:23:47'),
(25, '1', '1', '2026-02-26', '23:00:00', 'Hindi', '2', '2', '2026-02-26 09:02:45', '2026-02-26 09:02:45'),
(26, '1', '1', '2026-03-06', '23:00:00', 'Hindi', '2', '3', '2026-02-27 00:10:04', '2026-02-27 00:10:04'),
(27, '1', '1', '2026-02-28', '22:00:00', 'Hindi', '1', '2', '2026-02-28 05:24:19', '2026-02-28 05:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `theater_models`
--

CREATE TABLE `theater_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `theater_name` varchar(255) NOT NULL,
  `theater_image` varchar(255) NOT NULL,
  `cityid` varchar(255) NOT NULL,
  `theater_address` varchar(255) NOT NULL,
  `theater_contact` varchar(255) NOT NULL,
  `theater_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_of_screen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theater_models`
--

INSERT INTO `theater_models` (`id`, `theater_name`, `theater_image`, `cityid`, `theater_address`, `theater_contact`, `theater_email`, `password`, `no_of_screen`, `created_at`, `updated_at`) VALUES
(1, 'Royal Cinema', '88670.png', '1', 'Surat-Bardoli Road', '9632015478', 'royalcinema@gmail.com', '12345', '3', '2026-01-28 22:56:06', '2026-01-28 22:56:06'),
(2, 'PVR Cinemas', '96951.png', '2', '3rd Floor, Rahul Raj Mall, Dumas Road, Opposite Govardhan Nath Ji Haveli, Piplod', '9632150478', 'pvrcinemas@gmail.com', '12345', '5', '2026-02-13 00:10:26', '2026-02-13 00:10:26');

-- --------------------------------------------------------

--
-- Table structure for table `typesof_movie_models`
--

CREATE TABLE `typesof_movie_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `typesof_movie_models`
--

INSERT INTO `typesof_movie_models` (`id`, `movie_type`, `created_at`, `updated_at`) VALUES
(1, 'Action', '2026-01-28 22:52:03', '2026-01-28 22:52:03'),
(2, 'Comedy', '2026-01-28 22:52:17', '2026-01-28 22:52:17'),
(3, 'Drama', '2026-01-28 22:52:21', '2026-01-28 22:52:21'),
(4, 'Sci-Fi', '2026-01-28 22:52:28', '2026-01-28 22:52:28'),
(5, 'Romantic', '2026-01-28 22:52:38', '2026-01-28 22:52:38'),
(6, 'Thriller', '2026-01-28 22:52:49', '2026-01-28 22:52:49');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_models`
--

CREATE TABLE `user_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_models`
--

INSERT INTO `user_models` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'jay', 'jaypatel2672002@gmail.com', '12345678', '2026-02-19 02:07:49', '2026-02-19 02:07:49'),
(2, 'ankit', 'ankit@gmail.com', '12345678', '2026-03-05 03:45:43', '2026-03-05 03:45:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_models`
--
ALTER TABLE `booking_models`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_models_booking_reference_unique` (`booking_reference`),
  ADD UNIQUE KEY `payment_id` (`payment_id`);

--
-- Indexes for table `cast_models`
--
ALTER TABLE `cast_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_models`
--
ALTER TABLE `city_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crew_models`
--
ALTER TABLE `crew_models`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `login_models`
--
ALTER TABLE `login_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_models`
--
ALTER TABLE `movie_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `promo_codes_code_unique` (`code`);

--
-- Indexes for table `screen_exp_models`
--
ALTER TABLE `screen_exp_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `show_models`
--
ALTER TABLE `show_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theater_models`
--
ALTER TABLE `theater_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typesof_movie_models`
--
ALTER TABLE `typesof_movie_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_models`
--
ALTER TABLE `user_models`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_models`
--
ALTER TABLE `booking_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cast_models`
--
ALTER TABLE `cast_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `city_models`
--
ALTER TABLE `city_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crew_models`
--
ALTER TABLE `crew_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_models`
--
ALTER TABLE `login_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `movie_models`
--
ALTER TABLE `movie_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `screen_exp_models`
--
ALTER TABLE `screen_exp_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `show_models`
--
ALTER TABLE `show_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `theater_models`
--
ALTER TABLE `theater_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `typesof_movie_models`
--
ALTER TABLE `typesof_movie_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_models`
--
ALTER TABLE `user_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
