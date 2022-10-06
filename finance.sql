-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2022 at 02:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit` int(11) NOT NULL,
  `target` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `couple_id`, `type`, `name`, `about`, `deposit`, `target`, `created_at`, `updated_at`) VALUES
(16, 15, NULL, 'My savings', 'MTN', 'savings', 7000, 20000, NULL, NULL),
(18, NULL, 3, 'Joint savings', 'Anna', 'savings for a fees', 150000, 1000000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `user_id`, `couple_id`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'greggy created an invoice for bill Fuel', '2022-09-10 10:48:01', NULL),
(2, 1, NULL, 'greggy created an invoice for bill Electricity', '2022-09-10 10:48:01', NULL),
(3, 13, NULL, 'Emma created an invoice for bill Rent', '2022-09-12 10:47:32', NULL),
(4, 15, NULL, 'emmalove23 created an invoice for bill Rent', '2022-09-28 09:45:59', NULL),
(5, 15, NULL, 'emmalove23 created an invoice for bill Electricity', '2022-09-28 09:46:28', NULL),
(6, 15, NULL, 'emmalove23 created an invoice for bill Fuel', '2022-09-28 09:46:56', NULL),
(7, 15, NULL, 'emmalove23 created an invoice for bill Water', '2022-09-28 09:47:19', NULL),
(8, NULL, 3, 'birungianna created an invoice for bill Rent', '2022-09-28 10:40:29', NULL),
(9, 17, NULL, 'birungianna created an invoice for bill Rent', '2022-09-28 10:41:12', NULL),
(10, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 10:41:38', NULL),
(11, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 10:51:41', NULL),
(12, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 10:56:04', NULL),
(13, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 10:56:40', NULL),
(14, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:34:01', NULL),
(15, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:34:21', NULL),
(16, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:34:33', NULL),
(17, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:34:39', NULL),
(18, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:37:43', NULL),
(19, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:40:13', NULL),
(20, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:40:31', NULL),
(21, 1, NULL, 'greggy created an invoice for bill Rent', '2022-09-30 11:40:59', NULL),
(22, NULL, 3, 'emmalove23 created an invoice for bill Rent', '2022-09-30 12:18:23', NULL),
(23, NULL, 3, 'emmalove23 created an invoice for bill Rent', '2022-09-30 12:24:44', NULL),
(24, NULL, 3, 'emmalove23 created an invoice for bill Rent', '2022-09-30 12:25:14', NULL),
(25, 15, NULL, 'emmalove23 created an invoice for bill Rent', '2022-09-30 12:25:51', NULL),
(26, 15, NULL, 'emmalove23 created an invoice for bill Rent', '2022-09-30 12:26:01', NULL),
(27, 1, NULL, 'greggy created an invoice for bill Electricity', '2022-10-02 06:40:29', NULL),
(28, NULL, NULL, 'emmalove23 edited MTN account in joint savings category', '2022-10-03 08:35:40', NULL),
(29, NULL, NULL, 'emmalove23 edited MTN account in joint savings category', '2022-10-03 08:37:38', NULL),
(30, 15, NULL, 'emmalove23 edited MTN account in my savings category', '2022-10-03 08:38:48', NULL),
(31, 15, NULL, 'emmalove23 edited MTN account in my savings category', '2022-10-03 08:42:06', NULL),
(32, 15, NULL, 'emmalove23 edited MTN account in my savings category', '2022-10-03 08:43:49', NULL),
(33, 15, NULL, 'emmalove23 edited Airtel account in my savings category', '2022-10-03 08:49:45', NULL),
(34, NULL, 3, 'emmalove23 edited Anna account in joint savings category', '2022-10-03 08:51:53', NULL),
(35, NULL, 3, 'birungianna created an invoice for bill Electricity', '2022-10-03 08:54:31', NULL),
(36, NULL, 3, 'birungianna created an invoice for bill Fuel', '2022-10-03 08:56:02', NULL),
(37, NULL, 3, 'emmalove23 created an invoice for bill Fuel', '2022-10-03 09:23:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, NULL),
(2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `couple_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_due` int(11) NOT NULL,
  `date_due` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `user_id`, `couple_id`, `name`, `amount_due`, `date_due`, `amount_paid`, `created_at`, `updated_at`) VALUES
(18, 1, NULL, 'Rent', 150000, '2022-10-30', 0, '2022-09-30 11:34:01', '2022-09-30 11:34:01'),
(19, 1, NULL, 'Rent', 150000, '2022-10-30', 60000, '2022-09-30 11:34:21', '2022-10-02 07:56:00'),
(20, 1, NULL, 'Rent', 150000, '2022-10-30', 100000, '2022-09-30 11:34:33', '2022-09-30 11:34:33'),
(21, 1, NULL, 'Rent', 150000, '2022-10-30', 150000, '2022-09-30 11:34:39', '2022-09-30 11:34:39'),
(23, 1, NULL, 'Rent', 200000, '2022-10-31', 0, '2022-09-30 11:40:13', '2022-09-30 11:40:13'),
(24, 1, NULL, 'Rent', 200000, '2022-10-31', 100000, '2022-09-30 11:40:31', '2022-09-30 11:40:31'),
(25, 1, NULL, 'Rent', 200000, '2022-10-31', 200000, '2022-09-30 11:40:59', '2022-09-30 11:40:59'),
(26, NULL, 3, 'Rent', 200000, '2022-10-08', 0, '2022-09-30 12:18:23', '2022-09-30 12:18:23'),
(27, NULL, 3, 'Rent', 200000, '2022-10-08', 100000, '2022-09-30 12:24:44', '2022-09-30 12:24:44'),
(28, NULL, 3, 'Rent', 200000, '2022-10-08', 200000, '2022-09-30 12:25:14', '2022-09-30 12:25:14'),
(29, 15, NULL, 'Rent', 15000, '2022-11-26', 10000, '2022-09-30 12:25:51', '2022-09-30 12:25:51'),
(30, 15, NULL, 'Rent', 15000, '2022-11-26', 15000, '2022-09-30 12:26:01', '2022-09-30 12:26:01'),
(31, 1, NULL, 'Electricity', 5000, '2022-11-30', 1000, '2022-10-02 06:40:30', '2022-10-02 06:40:30'),
(32, NULL, 3, 'Electricity', 50000, '2022-10-21', 10000, '2022-10-03 08:54:31', '2022-10-03 08:54:31'),
(33, NULL, 3, 'Fuel', 120000, '2022-10-01', 75000, '2022-10-03 08:56:02', '2022-10-03 08:56:02'),
(34, NULL, 3, 'Fuel', 120000, '2022-10-01', 95000, '2022-10-03 09:23:46', '2022-10-03 09:23:46');

-- --------------------------------------------------------

--
-- Table structure for table `couple`
--

CREATE TABLE `couple` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wife` int(11) NOT NULL,
  `husband` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couple`
--

INSERT INTO `couple` (`id`, `wife`, `husband`, `created_at`, `updated_at`) VALUES
(3, 17, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_verifies`
--

CREATE TABLE `email_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reciever` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `sender`, `reciever`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pop@gmail.com', 'beth@gmail.com', 'ok', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `body`, `created_at`, `updated_at`) VALUES
(5, 17, 15, 'hola', '2022-09-28 10:35:42', '2022-09-28 10:35:42'),
(6, 17, 15, 'some money', '2022-09-28 10:35:56', '2022-09-28 10:35:56'),
(7, 15, 17, 'I have no money', '2022-09-28 10:36:54', '2022-09-28 10:36:54');

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
(13, '2014_10_12_000000_create_users_table', 1),
(15, '2022_09_04_113910_create_email_verifies_table', 1),
(16, '2014_10_12_100000_create_password_resets_table', 2),
(17, '2022_09_05_104416_create_invitations_table', 3),
(19, '2022_09_05_112721_create_couple_table', 4),
(21, '2022_09_08_094245_create_bills_table', 5),
(22, '2022_09_08_153235_create_accounts_table', 6),
(23, '2022_09_08_173625_create_messages_table', 7),
(24, '2022_09_09_180212_create_admin_table', 8),
(26, '2022_09_10_071701_create_activity_table', 9),
(27, '2022_09_30_131219_add_deposit_to_accounts_table', 10),
(28, '2022_10_03_100527_add_target_accounts_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'pop@gmail.com', 'jtA1ch69qx9ycljCAFMugwRJ19kg0sTF4LCxb2A8281FIhGB2pGuzKL7zTg8BR9i', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `f_name`, `l_name`, `tel_no`, `gender`, `national_id`, `passport`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'greggy', 'Gregory', 'Solmon', '0712804062', 'male', NULL, NULL, 'pop@gmail.com', 1, '$2y$10$OHUhYbqVQmW.I6fRwt/KQu/8feb/T7O99rgKAVC2tu8swtrwypUUO', NULL, '2022-09-04 10:38:34', '2022-09-08 06:39:26'),
(4, 'kembos', 'kakembo', 'Henry', '0759338684', 'male', NULL, NULL, 'kembos@yahoo.com', 1, '$2y$10$LZeMDwifA8TOaxvDHuwMoeYUfUtXWeehAknX1AHqpUfrcoYuXviy6', NULL, '2022-09-09 15:32:05', '2022-09-09 15:32:05'),
(15, 'emmalove23', 'Lakidi', 'Emmanuel', '0704070916', 'male', NULL, NULL, 'lakidiemmanuel23@outlook.com', 1, '$2y$10$hWkZuGUbbvW7nEPBX40GZOo76pL6PjgnZRux.JvqoJYyfhTc3mDoC', NULL, '2022-09-28 09:35:17', '2022-09-28 09:44:53'),
(17, 'birungianna', 'Birungi', 'Anna Margret', '0700791351', 'female', NULL, NULL, 'birungiannamargret20@gmail.com', 1, '$2y$10$457RRv.CZC5mI3v6EK7zAe6xdY.XuRHdaVzpP0RIYwvS5wgJa/FYS', NULL, '2022-09-28 10:33:20', '2022-09-28 10:35:18'),
(18, 'emmamorris', 'Emma', 'Morris', '0738867903', 'male', NULL, NULL, 'emmamorris@gmail.com', 1, '$2y$10$Xv0b8xqqDvaauZH9tmWabegA4YwTjmsOHOj.1/VtKbJgs7XqgzyHK', NULL, '2022-09-28 10:48:00', '2022-09-28 10:48:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couple`
--
ALTER TABLE `couple`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifies`
--
ALTER TABLE `email_verifies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `couple`
--
ALTER TABLE `couple`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `email_verifies`
--
ALTER TABLE `email_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
