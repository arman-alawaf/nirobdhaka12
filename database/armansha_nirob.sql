-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 10:16 PM
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
-- Database: `armansha_nirob`
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
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ashon` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `nid` varchar(255) NOT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `fother` varchar(255) DEFAULT NULL,
  `mother` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `zila` varchar(255) DEFAULT NULL,
  `upazila` varchar(255) DEFAULT NULL,
  `city_corporation` varchar(255) DEFAULT NULL,
  `word` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `area_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `ashon`, `name`, `dob`, `nid`, `gender`, `fother`, `mother`, `occupation`, `address`, `zila`, `upazila`, `city_corporation`, `word`, `area`, `area_number`, `created_at`, `updated_at`) VALUES
(11, '১২', 'মোঃ জিহাদুল ইসলাম', '2006-06-02', '260925713800', 'male', NULL, NULL, 'বেকার', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯২৫', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(12, '১২', 'মোঃ আলমগীর হোসেন', '1963-05-04', '260925014401', 'male', NULL, NULL, 'ব্যাবসা', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯২৬', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(13, '১২', 'মোঃ মুরাদ্দুজ্জামান মিলন', '1979-06-26', '260925014407', 'male', NULL, NULL, 'ব্যাবসা', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯২৭', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(14, '১২', 'মোঃ মিজানুর রহমান', '1972-08-24', '260925014412', 'male', NULL, NULL, 'শ্রমিক', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯২৮', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(15, '১২', 'নেয়ামত আলী', '1966-05-20', '260925014416', 'male', NULL, NULL, 'ব্যাবসা', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯২৯', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(16, '১২', 'মোঃ সেলিম রেজা', '1966-03-02', '260925014419', 'male', NULL, NULL, 'ড্রাইভার', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯৩০', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(17, '১২', 'মোঃ জাবেদ হাসান', '1967-04-03', '260925014422', 'male', NULL, NULL, 'অন্যান্য', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯৩১', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(18, '১২', 'লিটন রানা', '1985-04-02', '260925014430', 'male', NULL, NULL, 'বেসরকারী চাকুরী', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯৩২', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(19, '১২', 'মোঃ মতিউর রহমান', '1975-11-16', '260925014443', 'male', NULL, NULL, 'ব্যাবসা', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯৩৩', '2026-01-07 14:59:11', '2026-01-07 14:59:11'),
(20, '১২', 'মোঃ শাহজাহান', '1987-04-10', '260925014446', 'male', NULL, NULL, 'বেসরকারী চাকুরী', NULL, 'ঢাকা', 'পল্লবি', 'ঢাকা উত্তর সিটি কর্পোরেশন', '০২', 'সেকশন ১২ ব্লক এ', '২৬০৯৩৪', '2026-01-07 14:59:11', '2026-01-07 14:59:11');

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
(4, '2024_01_01_000003_create_members_table', 2);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('h0D19CjS8JOsfKCD0Bsc2dHKKIUW33bR9j5jUd17', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVEY5ZENFOGFrckx2MkN4UXlvQTZoZmRSeUJxcG9jWFlCU0RqS1Q5YSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767820564),
('kAqiUZSXT9ojY6RUy5SEEbOFz6ffEKl7ICCx5vzi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWmNSMjR1T0l4ZFdxek5jbEZUZ0JTUk1wSVRraUp4VW9JZ2VKZXJCaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767813792);

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
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `members_nid_unique` (`nid`),
  ADD KEY `members_name_index` (`name`),
  ADD KEY `members_dob_index` (`dob`),
  ADD KEY `members_gender_index` (`gender`),
  ADD KEY `members_nid_index` (`nid`),
  ADD KEY `members_zila_index` (`zila`),
  ADD KEY `members_upazila_index` (`upazila`),
  ADD KEY `members_city_corporation_index` (`city_corporation`),
  ADD KEY `members_word_index` (`word`),
  ADD KEY `members_area_index` (`area`),
  ADD KEY `members_occupation_index` (`occupation`),
  ADD KEY `members_zila_upazila_index` (`zila`,`upazila`),
  ADD KEY `members_zila_upazila_city_corporation_index` (`zila`,`upazila`,`city_corporation`),
  ADD KEY `members_gender_zila_index` (`gender`,`zila`),
  ADD KEY `members_name_nid_index` (`name`,`nid`);

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
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
