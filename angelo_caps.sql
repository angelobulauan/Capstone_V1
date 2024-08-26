-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 06:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seagrass_mapping`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_15_015633_create_admins_table', 1),
(6, '2024_03_22_043138_create_roles_table', 1),
(7, '2024_03_22_061315_create_role_users_table', 1),
(8, '2024_03_25_013613_create_seaviews_table', 1),
(9, '2024_03_29_102636_create_photos_table', 2),
(10, '2024_04_18_014633_create_seapics_table', 3),
(11, '2024_04_18_015643_create_seagrasspics_table', 4),
(12, '2024_08_25_003256_create_sea_grass_likes_table', 5);

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2024-05-09 20:38:07', '2024-05-09 20:38:07'),
(2, 'user', '2024-05-09 20:38:07', '2024-05-09 20:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '2024-05-09 20:38:08', '2024-05-09 20:38:08'),
(2, '2', '2', '2024-05-09 20:38:08', '2024-05-09 20:38:08'),
(3, '3', '2', '2024-05-21 18:14:29', '2024-05-21 18:14:29'),
(4, '4', '2', '2024-05-30 23:04:10', '2024-05-30 23:04:10'),
(5, '5', '2', '2024-08-24 16:24:55', '2024-08-24 16:24:55'),
(6, '6', '2', '2024-08-24 23:40:35', '2024-08-24 23:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `seagrasspics`
--

CREATE TABLE `seagrasspics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sea_id` int(11) NOT NULL,
  `Photo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seagrasspics`
--

INSERT INTO `seagrasspics` (`id`, `sea_id`, `Photo`, `created_at`, `updated_at`) VALUES
(1, 1, 'seagrass/m5MwwtzMWaVhYzvGtAkJrmN2MwfseJ3YzjqpiOlH.jpg', '2024-08-24 06:52:37', '2024-08-24 06:52:37'),
(2, 1, 'seagrass/TFAiM0XHXDvzMwDNBIEITKqpJuOr1iZ7q0oGvSFX.jpg', '2024-08-24 06:52:37', '2024-08-24 06:52:37'),
(3, 1, 'seagrass/KEbOnDsP8R4lsFbPfiMVP9P8SbnGcwb3zQbxTmXG.jpg', '2024-08-24 06:52:37', '2024-08-24 06:52:37'),
(4, 2, 'seagrass/bBX2m845GEIAYJByQaFKFQtYohnhdCFkcEQn5BUq.jpg', '2024-08-24 06:56:20', '2024-08-24 06:56:20'),
(5, 2, 'seagrass/V2pbPSGKAWOQtM6mGjvgLKqOAkY4DfKkUj393wlY.jpg', '2024-08-24 06:56:20', '2024-08-24 06:56:20'),
(6, 2, 'seagrass/6VLZp7IUrRsuGe7DyEVukrXm4v7W1XD89PZPd9zD.jpg', '2024-08-24 06:56:20', '2024-08-24 06:56:20'),
(7, 3, 'seagrass/CH0TL3Vsv8loAPGII2fEI64JQepAPmjnAjgkndKZ.jpg', '2024-08-24 06:59:26', '2024-08-24 06:59:26'),
(8, 3, 'seagrass/qaQDqHXRvQW749mtkFon8QzhoSBhhwkn2hXRUuZ5.jpg', '2024-08-24 06:59:26', '2024-08-24 06:59:26'),
(9, 3, 'seagrass/sXTY5Jihjq47uCc8wVHRz5YjLnEYDrGNNLAiv9EH.jpg', '2024-08-24 06:59:26', '2024-08-24 06:59:26'),
(10, 1, 'seagrass/sYRxMQf0059KXNcjShncx6UgvMLSRhHfCd74E6mx.jpg', '2024-08-24 07:08:53', '2024-08-24 07:08:53'),
(11, 1, 'seagrass/UA4nR5BwU6KM79imWsBzgRawvXTymFHN7Wy9J07e.jpg', '2024-08-24 07:08:53', '2024-08-24 07:08:53'),
(12, 1, 'seagrass/kM45ipFH4hxw0OKe2TihIlcl2SabB9xC9MCYrIwy.jpg', '2024-08-24 07:08:53', '2024-08-24 07:08:53'),
(13, 2, 'seagrass/lUogpLXoDoxMr3RWH0hUl6lpQgvgJaLZzl9cR2SW.jpg', '2024-08-24 22:14:05', '2024-08-24 22:14:05'),
(14, 2, 'seagrass/ksknquZkUAPym9YOvXfcCcrqcQbyNXfYjzDyaeJN.jpg', '2024-08-24 22:14:05', '2024-08-24 22:14:05'),
(15, 2, 'seagrass/Wg5jm9CriKYYRxbinvyLgEFUmvRfZgAsOxjCOhv6.jpg', '2024-08-24 22:14:05', '2024-08-24 22:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `seapics`
--

CREATE TABLE `seapics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seaviews`
--

CREATE TABLE `seaviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` int(225) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `scientificname` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `location` varchar(255) NOT NULL,
  `lati` decimal(10,6) DEFAULT NULL,
  `longti` decimal(10,6) DEFAULT NULL,
  `abundance` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seaviews`
--

INSERT INTO `seaviews` (`id`, `u_id`, `name`, `scientificname`, `description`, `location`, `lati`, `longti`, `abundance`, `photo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'stest', 'alsmdcal\'', 'kdsfmk', 'Casagan, Sta. Ana, Cagayan', 18.457303, 122.114742, 34, 'seagrass/sYRxMQf0059KXNcjShncx6UgvMLSRhHfCd74E6mx.jpg', '2024-08-24 07:08:53', '2024-08-24 07:08:53'),
(2, NULL, 'dfsfsf', 'sdfsdfa', 'sfrarf', 'Casagan, Sta. Ana, Cagayan', 18.518028, 122.194793, 34, 'seagrass/ksknquZkUAPym9YOvXfcCcrqcQbyNXfYjzDyaeJN.jpg', '2024-08-24 22:14:04', '2024-08-24 22:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `sea_grass_likes`
--

CREATE TABLE `sea_grass_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `seaviews_id` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sea_grass_likes`
--

INSERT INTO `sea_grass_likes` (`id`, `u_id`, `seaviews_id`, `likes`, `dislikes`, `views`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, 0, 2, NULL, NULL),
(2, 5, 2, 1, 0, 3, NULL, NULL),
(3, 6, 1, 1, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, NULL, '$2y$12$6pi0N9p8dGlvkyMNYoDwge/kW1GXgMWY0zcVoZt8I.IL0kHV5j7FC', NULL, '2024-05-09 20:38:08', '2024-05-09 20:38:08'),
(2, ' User', 'user@gmail.com', NULL, NULL, '$2y$12$geQ0pk36jJRaMJBAWwLOe.yqWzCeXMY4pcq9CW2ihN0/.49hUk5Je', NULL, '2024-05-09 20:38:08', '2024-05-09 20:38:08'),
(3, 'Robert', 'robert@mail.com', NULL, NULL, '$2y$12$JCRtzsXatIbBnCObZD235O98nprNog08Cp82VVt8Xgn6F4kWqXn0u', NULL, '2024-05-21 18:14:29', '2024-05-21 18:14:29'),
(4, 'angelo', 'angelo@gmail.com', NULL, NULL, '$2y$12$Rg8g4G2ZjqhvMstvtXjFgu1RAXZEbXk5tk1Je4S7BrD.8gAI8oll6', NULL, '2024-05-30 23:04:10', '2024-05-30 23:04:10'),
(5, 'Gino Carlo Rabina', 'gino@mail.com', NULL, NULL, '$2y$12$9mecf/.d6ZIbPEB2Vz7rDu3AVSr6UU4tdxE1bCjhwGI3YM4/M8Wfi', NULL, '2024-08-24 16:24:55', '2024-08-24 16:24:55'),
(6, 'test', 'test@mail.com', NULL, NULL, '$2y$12$c1SE3zYfTGYRi0gKwv02V./Zg9QypYvAF0thbxHViqOut1ryFJ2Be', NULL, '2024-08-24 23:40:35', '2024-08-24 23:40:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seagrasspics`
--
ALTER TABLE `seagrasspics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seapics`
--
ALTER TABLE `seapics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seaviews`
--
ALTER TABLE `seaviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sea_grass_likes`
--
ALTER TABLE `sea_grass_likes`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `seagrasspics`
--
ALTER TABLE `seagrasspics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `seapics`
--
ALTER TABLE `seapics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seaviews`
--
ALTER TABLE `seaviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sea_grass_likes`
--
ALTER TABLE `sea_grass_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
