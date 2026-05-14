-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2026 at 05:40 AM
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
(13, '2026_02_12_060947_create_show_models_table', 2);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `show_models`
--

INSERT INTO `show_models` (`id`, `movie_id`, `theater_id`, `show_date`, `show_time`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2026-02-13', '11:00:00', '2026-02-13 01:11:01', '2026-02-13 01:11:01'),
(2, '1', '1', '2026-02-13', '13:00:00', '2026-02-13 01:21:44', '2026-02-13 01:21:44'),
(4, '1', '1', '2026-02-13', '12:00:00', '2026-02-13 01:42:22', '2026-02-13 01:42:22'),
(5, '1', '1', '2026-02-16', '12:00:00', '2026-02-15 23:43:32', '2026-02-15 23:43:32'),
(6, '2', '2', '2026-02-16', '14:00:00', '2026-02-15 23:48:23', '2026-02-15 23:48:23'),
(7, '1', '1', '2026-02-17', '12:00:00', '2026-02-16 01:02:06', '2026-02-16 01:02:06'),
(8, '1', '1', '2026-02-16', '15:45:00', '2026-02-16 01:13:31', '2026-02-16 01:13:31'),
(9, '2', '1', '2026-02-16', '14:30:00', '2026-02-16 01:14:04', '2026-02-16 01:14:04'),
(10, '2', '2', '2026-02-17', '13:00:00', '2026-02-16 01:19:57', '2026-02-16 01:19:57'),
(11, '2', '2', '2026-02-16', '13:30:00', '2026-02-16 01:20:26', '2026-02-16 01:20:26'),
(12, '1', '2', '2026-02-16', '13:30:00', '2026-02-16 01:20:58', '2026-02-16 01:20:58'),
(13, '1', '1', '2026-02-15', '12:00:00', '2026-02-16 01:26:57', '2026-02-16 01:26:57'),
(14, '2', '1', '2026-02-18', '13:00:00', '2026-02-17 23:41:23', '2026-02-17 23:41:23'),
(15, '2', '1', '2026-02-19', '13:00:00', '2026-02-17 23:58:32', '2026-02-17 23:58:32'),
(16, '1', '1', '2026-02-18', '15:00:00', '2026-02-18 03:56:19', '2026-02-18 03:56:19');

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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `login_models`
--
ALTER TABLE `login_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `screen_exp_models`
--
ALTER TABLE `screen_exp_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `show_models`
--
ALTER TABLE `show_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
