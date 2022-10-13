-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2022 at 01:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(5) UNSIGNED NOT NULL,
  `kode_alternatif` varchar(50) DEFAULT NULL,
  `alternatif` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `kode_alternatif`, `alternatif`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'A001', 'Pemeliharaan Tertunda', NULL, '2022-08-19 00:48:23', '2022-08-19 00:50:57', NULL),
(3, 'A002', 'Pemeliharaan Langsung', NULL, '2022-08-19 00:51:17', '2022-08-19 00:51:17', NULL),
(4, 'A003', 'Tidak Direkomendasi Untuk Pemeliharaan', NULL, '2022-08-22 00:31:28', '2022-08-22 00:31:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'PIC IT', 'IT'),
(2, 'PIC UMUM', 'Umum'),
(3, 'SuperAdmin', ''),
(4, 'User', ''),
(5, 'PIC Departemen', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(5, 18),
(5, 22),
(5, 23);

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 4),
(3, 1),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 17:58:58', 1),
(2, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 18:06:16', 1),
(3, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 18:07:40', 1),
(4, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 18:11:52', 1),
(5, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 18:18:16', 1),
(6, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 18:19:31', 1),
(7, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-08 18:23:55', 1),
(8, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-09 05:12:01', 1),
(9, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-10 23:25:06', 1),
(10, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-11 21:00:29', 1),
(11, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-12 01:39:21', 1),
(12, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-13 01:03:08', 1),
(13, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-13 05:50:59', 1),
(14, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-13 08:51:49', 1),
(15, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-13 22:04:29', 1),
(16, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-14 05:51:29', 1),
(17, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-15 01:03:33', 1),
(18, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-18 00:12:51', 1),
(19, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-18 23:03:42', 1),
(20, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-19 06:29:31', 1),
(21, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-20 18:49:48', 1),
(22, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-21 15:44:13', 1),
(23, '::1', 'ainurrofik989@gmail.com', NULL, '2022-07-21 16:01:32', 0),
(24, '::1', 'ainurrofik989@gmail.com', NULL, '2022-07-21 17:07:02', 0),
(25, '::1', 'ainurrofik989@gmail.com', NULL, '2022-07-21 17:59:28', 0),
(26, '::1', 'mohamatainur@gmail.com', NULL, '2022-07-21 17:59:59', 0),
(27, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-21 18:00:16', 1),
(28, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-22 07:36:04', 1),
(29, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-22 16:37:31', 1),
(30, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-22 20:08:45', 1),
(31, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-23 06:45:50', 1),
(32, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-23 11:13:11', 1),
(33, '::1', '18081010073', NULL, '2022-07-22 23:18:07', 0),
(34, '::1', '3529455812190392', NULL, '2022-07-22 23:18:21', 0),
(35, '::1', '18081010073', NULL, '2022-07-22 23:18:28', 0),
(36, '::1', '18081010073', NULL, '2022-07-22 23:18:37', 0),
(37, '::1', '18081010073', NULL, '2022-07-22 23:18:48', 0),
(38, '::1', '6213136006019467', NULL, '2022-07-22 23:19:00', 0),
(39, '::1', '6213136006019467', NULL, '2022-07-22 23:19:08', 0),
(40, '::1', '6213136006019467', NULL, '2022-07-22 23:19:20', 0),
(41, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-22 23:19:27', 1),
(42, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-23 14:59:09', 1),
(43, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-24 00:41:34', 1),
(44, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-24 06:46:41', 1),
(45, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-24 10:53:10', 1),
(46, '::1', 'ainurrofik', NULL, '2022-07-24 02:33:38', 0),
(47, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-24 02:33:45', 1),
(48, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-24 14:42:31', 1),
(49, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-24 19:28:28', 1),
(50, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-25 00:41:39', 1),
(51, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-25 16:57:26', 1),
(52, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-25 23:16:16', 1),
(53, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-26 05:13:25', 1),
(54, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-26 10:39:38', 1),
(55, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-26 13:21:03', 1),
(56, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-27 11:31:58', 1),
(57, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-27 21:33:20', 1),
(58, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 08:04:32', 1),
(59, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-27 22:57:52', 1),
(60, '::1', 'ainurrofik989@gmail.com', NULL, '2022-07-28 18:20:17', 0),
(61, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 18:20:28', 1),
(62, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 06:27:52', 1),
(63, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 18:29:21', 1),
(64, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 06:30:00', 1),
(65, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-29 01:02:11', 1),
(66, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 13:37:44', 1),
(67, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-29 01:45:00', 1),
(68, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-28 21:33:37', 1),
(69, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-30 17:07:39', 1),
(70, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-30 19:55:16', 1),
(71, '::1', 'ainurrofik989@gmail.com', NULL, '2022-07-31 05:51:17', 0),
(72, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-31 05:51:32', 1),
(73, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-30 20:11:42', 1),
(74, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-31 08:54:26', 1),
(75, '::1', 'ainurrofik989@gmail.com', 1, '2022-07-31 15:08:59', 1),
(76, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-01 05:33:44', 1),
(77, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-01 12:55:48', 1),
(78, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-01 04:47:48', 1),
(79, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-01 17:48:03', 1),
(80, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-01 21:09:37', 1),
(81, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 13:25:40', 1),
(82, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 05:04:14', 1),
(83, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 11:03:34', 1),
(84, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 23:56:05', 1),
(85, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 11:56:52', 1),
(86, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 23:57:56', 1),
(87, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 12:21:07', 1),
(88, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 00:32:43', 1),
(89, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 06:32:09', 1),
(90, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 19:31:48', 1),
(91, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 07:50:46', 1),
(92, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-02 20:51:26', 1),
(93, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 09:10:52', 1),
(94, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 12:12:53', 1),
(95, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 01:28:20', 1),
(96, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 13:52:56', 1),
(97, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 02:11:24', 1),
(98, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 14:30:13', 1),
(99, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 18:47:21', 1),
(100, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-03 20:23:37', 1),
(101, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 05:39:09', 1),
(102, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 11:33:44', 1),
(103, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 03:39:28', 1),
(104, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 15:50:14', 1),
(105, '::1', 'jeconia@gmail.com', NULL, '2022-08-04 20:46:22', 0),
(106, '::1', 'jeconia@gmail.com', NULL, '2022-08-04 20:47:02', 0),
(107, '::1', 'jeconia@gmail.com', NULL, '2022-08-04 20:47:15', 0),
(108, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 20:51:17', 1),
(109, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 20:57:34', 1),
(110, '::1', 'mohamatainur@gmail.com', NULL, '2022-08-04 20:59:32', 0),
(111, '::1', 'mohamatainur@gmail.com', NULL, '2022-08-04 20:59:45', 0),
(112, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 23:08:02', 1),
(113, '::1', 'jeconia@gmail.com', 4, '2022-08-04 23:09:58', 0),
(114, '::1', 'jeconia@gmail.com', 4, '2022-08-04 23:10:45', 0),
(115, '::1', 'jeconia@gmail.com', 4, '2022-08-04 23:11:46', 1),
(116, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-04 23:12:17', 1),
(117, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-05 06:32:51', 1),
(118, '::1', 'jeconia@gmail.com', 4, '2022-08-05 10:51:40', 1),
(119, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-05 10:52:50', 1),
(120, '::1', 'mohamatainur@gmail.com', 3, '2022-08-05 11:08:31', 1),
(121, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-05 11:09:03', 1),
(122, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-05 11:16:35', 1),
(123, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-05 00:33:30', 1),
(124, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-05 12:43:39', 1),
(125, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-06 08:42:11', 1),
(126, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-06 13:40:07', 1),
(127, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-06 17:32:42', 1),
(128, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-07 07:11:51', 1),
(129, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-07 18:44:27', 1),
(130, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-08 07:14:06', 1),
(131, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-08 08:15:31', 1),
(132, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-08 09:22:10', 1),
(133, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-08 18:25:05', 1),
(134, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-08 07:58:31', 1),
(135, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-08 22:40:04', 1),
(136, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-09 06:53:58', 1),
(137, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-09 02:08:43', 1),
(138, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-09 14:30:37', 1),
(139, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-09 02:52:07', 1),
(140, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-09 15:12:59', 1),
(141, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-10 14:28:08', 1),
(142, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-11 05:22:13', 1),
(143, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-11 05:23:28', 1),
(144, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-11 14:11:27', 1),
(145, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-11 19:40:09', 1),
(146, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-12 07:01:38', 1),
(147, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-12 20:30:59', 1),
(148, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 03:13:56', 1),
(149, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 08:15:48', 1),
(150, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 11:00:10', 1),
(151, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 00:49:32', 1),
(152, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 12:56:19', 1),
(153, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 19:39:01', 1),
(154, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 19:40:19', 1),
(155, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 06:41:41', 1),
(156, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 06:42:06', 1),
(157, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-13 23:41:54', 1),
(158, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 11:48:58', 1),
(159, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:05:07', 1),
(160, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:06:29', 1),
(161, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:07:49', 1),
(162, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:09:08', 1),
(163, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:09:52', 1),
(164, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:13:56', 1),
(165, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:19:01', 1),
(166, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:20:28', 1),
(167, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:24:20', 1),
(168, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:24:45', 1),
(169, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:27:10', 1),
(170, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:30:04', 1),
(171, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:30:56', 1),
(172, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:34:07', 1),
(173, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:34:53', 1),
(174, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:37:15', 1),
(175, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:41:09', 1),
(176, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:41:53', 1),
(177, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:46:05', 1),
(178, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 16:49:27', 1),
(179, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 04:54:29', 1),
(180, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 17:18:36', 1),
(181, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 17:18:49', 1),
(182, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 17:19:12', 1),
(183, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 22:35:19', 1),
(184, '::1', 'ainurrofik989@gmail.com', NULL, '2022-08-14 22:37:59', 0),
(185, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 22:38:10', 1),
(186, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 22:38:39', 1),
(187, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 10:39:19', 1),
(188, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 22:48:40', 1),
(189, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 22:49:01', 1),
(190, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 11:02:51', 1),
(191, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 11:10:06', 1),
(192, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-14 20:32:09', 1),
(193, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-15 00:53:31', 1),
(194, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-15 13:20:15', 1),
(195, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-15 13:21:02', 1),
(196, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-15 13:21:28', 1),
(197, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-15 19:33:19', 1),
(198, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-16 06:31:32', 1),
(199, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-16 11:23:25', 1),
(200, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-16 14:27:24', 1),
(201, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-16 21:59:21', 1),
(202, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-17 07:19:15', 1),
(203, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-17 16:06:17', 1),
(204, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-17 21:44:05', 1),
(205, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-18 08:52:43', 1),
(206, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-18 14:56:58', 1),
(207, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-18 20:31:26', 1),
(208, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-19 13:16:32', 1),
(209, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-20 08:59:08', 1),
(210, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-20 19:08:28', 1),
(211, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-20 21:44:11', 1),
(212, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-21 01:53:45', 1),
(213, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-21 09:57:41', 1),
(214, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-21 13:06:06', 1),
(215, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-21 19:32:39', 1),
(216, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-22 09:00:28', 1),
(217, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-22 17:24:12', 1),
(218, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-23 07:25:41', 1),
(219, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-24 06:08:45', 1),
(220, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-25 05:47:25', 1),
(221, '::1', 'mohamatainur@gmail.com', NULL, '2022-08-25 07:39:24', 0),
(222, '::1', 'mohamatainur@gmail.com', 3, '2022-08-25 07:39:36', 1),
(223, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-25 07:45:35', 1),
(224, '::1', 'mohamatainur@gmail.com', 3, '2022-08-25 07:57:48', 1),
(225, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-25 08:12:35', 1),
(226, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-25 08:26:22', 1),
(227, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-25 08:26:41', 1),
(228, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-25 08:27:04', 1),
(229, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-28 09:51:37', 1),
(230, '::1', 'mohamatainur@gmail.com', NULL, '2022-08-28 09:53:26', 0),
(231, '::1', 'mohamatainur@gmail.com', 3, '2022-08-28 09:53:43', 1),
(232, '::1', 'jeconia@gmail.com', NULL, '2022-08-28 10:04:23', 0),
(233, '::1', 'jeconia@gmail.com', NULL, '2022-08-28 10:04:46', 0),
(234, '::1', 'jeconia@gmail.com', NULL, '2022-08-28 10:04:58', 0),
(235, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-28 10:05:11', 1),
(236, '::1', 'mohamatainur@gmail.com', 3, '2022-08-28 10:05:34', 1),
(237, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-28 10:06:50', 1),
(238, '::1', 'jeconia@gmail.com', 4, '2022-08-28 10:10:02', 1),
(239, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-28 10:14:31', 1),
(240, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-29 10:14:53', 1),
(241, '::1', 'ainurrofik989@gmail.com', 1, '2022-08-31 20:26:36', 1),
(242, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-01 06:20:19', 1),
(243, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-05 20:06:07', 1),
(244, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-06 11:18:20', 1),
(245, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-07 13:00:21', 1),
(246, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-07 20:54:51', 1),
(247, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-08 07:36:44', 1),
(248, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-08 14:19:49', 1),
(249, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-09 14:46:13', 1),
(250, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-09 23:11:00', 1),
(251, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-10 13:13:34', 1),
(252, '::1', 'jeconia@gmail.com', 4, '2022-09-10 14:58:36', 1),
(253, '::1', 'mohamatainur@gmail.com', 3, '2022-09-10 14:59:13', 1),
(254, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-10 14:59:41', 1),
(255, '::1', 'jeconia@gmail.com', 4, '2022-09-10 15:08:46', 1),
(256, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-10 19:15:07', 1),
(257, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-12 10:35:24', 1),
(258, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-13 18:01:40', 1),
(259, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-14 11:49:06', 1),
(260, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-15 05:42:40', 1),
(261, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-15 09:08:55', 1),
(262, '::1', 'k.07.web.b.2020@gmail.com', NULL, '2022-09-20 14:00:55', 0),
(263, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-20 14:03:52', 1),
(264, '::1', 'ainurrofik989@gmail.com', NULL, '2022-09-20 14:04:15', 0),
(265, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-20 14:21:09', 1),
(266, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-20 20:52:33', 1),
(267, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-21 15:24:38', 1),
(268, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-21 21:32:50', 1),
(269, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-22 09:13:15', 1),
(270, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-23 01:10:09', 1),
(271, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-23 06:06:33', 1),
(272, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-23 09:39:57', 1),
(273, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-23 18:59:28', 1),
(274, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-24 10:06:52', 1),
(275, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-24 13:53:36', 1),
(276, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-24 23:32:56', 1),
(277, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-25 09:25:28', 1),
(278, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-25 09:28:38', 1),
(279, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-25 09:32:38', 1),
(280, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-25 12:37:27', 1),
(281, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-25 17:05:44', 1),
(282, '::1', 'jeconia@gmail.com', 4, '2022-09-25 22:56:36', 1),
(283, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-26 04:57:52', 1),
(284, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-26 08:05:55', 1),
(285, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-26 16:08:40', 1),
(286, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-26 16:10:24', 1),
(287, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-27 07:50:12', 1),
(288, '::1', 'ainurrofik989@gmail.com', NULL, '2022-09-27 12:07:07', 0),
(289, '::1', 'ainurrofik989@gmail.com', NULL, '2022-09-27 12:09:43', 0),
(290, '::1', 'k.07.web.b.2020@gmail.com', NULL, '2022-09-27 12:10:03', 0),
(291, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-27 12:10:24', 1),
(292, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-27 13:18:18', 1),
(293, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-27 13:30:53', 1),
(294, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-27 17:34:10', 1),
(295, '::1', 'ainurrofik989@gmail.com', 1, '2022-09-30 10:09:06', 1),
(296, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-01 14:02:09', 1),
(297, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-02 09:27:38', 0),
(298, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-02 09:27:53', 1),
(299, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-02 12:17:45', 1),
(300, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-03 19:09:36', 1),
(301, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-04 20:24:31', 0),
(302, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-04 20:24:41', 0),
(303, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-04 20:25:00', 0),
(304, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-04 20:25:10', 1),
(305, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-05 07:26:56', 1),
(306, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-05 08:27:11', 1),
(307, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-05 16:47:36', 0),
(308, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-05 16:47:48', 1),
(309, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-05 23:22:30', 0),
(310, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-05 23:22:46', 1),
(311, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-07 02:28:46', 1),
(312, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-07 10:14:45', 1),
(313, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-07 14:47:51', 1),
(314, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-11 07:34:36', 0),
(315, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-11 07:51:35', 1),
(316, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-11 09:01:37', 1),
(317, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-11 14:39:59', 1),
(318, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-11 19:55:31', 1),
(319, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-12 06:16:49', 1),
(320, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-12 12:26:53', 0),
(321, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-12 12:27:08', 1),
(322, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-13 18:03:21', 0),
(323, '::1', 'ainurrofik989@gmail.com', NULL, '2022-10-13 18:03:33', 0),
(324, '::1', 'ainurrofik989@gmail.com', 1, '2022-10-13 18:03:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(2, 'company-read  ', 'Company Management'),
(3, 'company-create', 'Company Management'),
(4, 'company-update', 'Company Management'),
(5, 'company-delete', 'Company Management'),
(6, 'user-read  ', 'User Management'),
(7, 'user-create', 'User Management'),
(8, 'user-update', 'User Management'),
(9, 'user-delete', 'User Management'),
(10, 'klasifikasi-read  ', 'Klasifikasi Management'),
(11, 'klasifikasi-update', 'Klasifikasi Management'),
(12, 'klasifikasi-create', 'Klasifikasi Management'),
(13, 'klasifikasi-delete', 'Klasifikasi Management'),
(14, 'product-read  ', 'Product Managament'),
(15, 'product-create', 'Product Managament'),
(16, 'product-update', 'Product Managament'),
(17, 'product-delete', 'Product Managament'),
(18, 'inventaris-read  ', 'Inventaris Management'),
(19, 'inventaris-create', 'Inventaris Management'),
(20, 'inventaris-update', 'Inventaris Management'),
(21, 'inventaris-delete', 'Inventaris Management'),
(22, 'form-read  ', 'Form Management'),
(23, 'form-create', 'Form Management');

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions_menu`
--

CREATE TABLE `auth_permissions_menu` (
  `permission_id` int(5) NOT NULL,
  `menu_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_permissions_menu`
--

INSERT INTO `auth_permissions_menu` (`permission_id`, `menu_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(1, 11),
(1, 12),
(1, 15),
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bobotkriteria`
--

CREATE TABLE `bobotkriteria` (
  `id_bobotkriteria` int(5) UNSIGNED NOT NULL,
  `kriteria_kode` varchar(50) DEFAULT NULL,
  `value` decimal(10,4) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bobotkriteria`
--

INSERT INTO `bobotkriteria` (`id_bobotkriteria`, `kriteria_kode`, `value`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'C0001', '0.0820', '', '2022-08-21 22:58:15', '2022-09-26 01:07:58', NULL),
(7, 'C0002', '0.2347', '', '2022-08-21 22:58:15', '2022-09-26 01:07:58', NULL),
(8, 'C0003', '0.4486', '', '2022-08-21 22:58:15', '2022-09-26 01:07:58', NULL),
(9, 'C0004', '0.2347', '', '2022-08-21 22:58:15', '2022-09-26 01:07:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dataorder`
--

CREATE TABLE `dataorder` (
  `id_dataorder` int(5) UNSIGNED NOT NULL,
  `kode_order` varchar(50) NOT NULL,
  `detailunit_id` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `peruntukan_awal` varchar(5) DEFAULT NULL,
  `peruntukan` varchar(5) DEFAULT NULL,
  `status_dataorder` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dataorder`
--

INSERT INTO `dataorder` (`id_dataorder`, `kode_order`, `detailunit_id`, `qty`, `peruntukan_awal`, `peruntukan`, `status_dataorder`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '3', 2, '0', '', 'Assign To Location', '2022-09-10 13:41:39', '2022-09-10 13:41:39', NULL),
(2, '2', '23', 1, '0', '', 'Berhasil', '2022-09-10 14:57:47', '2022-09-10 15:09:04', NULL),
(3, '3', '1', 1, '0', '', 'Assign To Location', '2022-09-23 09:17:24', '2022-09-23 09:17:24', NULL),
(4, '4', '22', 1, '0', '1', 'Assign To Employee', '2022-10-11 11:14:31', '2022-10-11 11:14:31', NULL),
(5, '5', '10', 1, '0', '1', 'Assign To Employee', '2022-10-11 15:13:58', '2022-10-11 15:13:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` int(5) UNSIGNED NOT NULL,
  `parent_id` varchar(50) DEFAULT NULL,
  `content` varchar(50) NOT NULL,
  `lokasi_id` int(5) NOT NULL,
  `depth_dep` int(11) NOT NULL,
  `status_dep` enum('Aktif','Tidak Aktif','Pending') NOT NULL DEFAULT 'Aktif',
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `parent_id`, `content`, `lokasi_id`, `depth_dep`, `status_dep`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Jajaran Direksi', 1, 0, 'Tidak Aktif', 'Odit non animi aperiam magni aspernatur aperiam omnis non.', '2022-01-27 07:01:53', '2022-08-03 13:25:36', NULL),
(2, NULL, 'Departemen SDM, Umum, dan Keuangan', 1, 0, 'Aktif', 'Iure delectus deserunt sunt non.', '2022-01-27 07:01:53', '2022-01-27 07:01:53', NULL),
(3, NULL, 'Departemen Operasional', 2, 0, 'Aktif', 'Quo fugiat ut eaque temporibus molestias.', '2022-01-27 07:01:53', '2022-01-27 07:01:53', NULL),
(4, '1', 'Direktur Utama', 6, 1, 'Aktif', 'Error laudantium rerum quo sed magnam expedita.', '2022-01-27 07:01:53', '2022-08-03 21:03:02', NULL),
(5, '2', 'Manager Operasional', 7, 1, 'Aktif', 'Tenetur blanditiis qui quis possimus est.', '2022-01-27 07:01:53', '2022-01-27 07:01:53', NULL),
(6, NULL, 'Biro IT', 1, 0, 'Aktif', NULL, '2022-01-29 19:06:49', '2022-01-29 19:56:05', NULL),
(7, '1', 'Direksi', 5, 1, 'Aktif', NULL, '2022-01-29 20:17:58', '2022-03-05 10:43:52', NULL),
(8, '2', 'Staff Operasional', 9, 1, 'Aktif', NULL, '2022-01-29 21:05:05', '2022-01-29 21:05:05', NULL),
(9, '1', 'Direktur Keuangan', 5, 1, 'Aktif', NULL, '2022-03-05 11:50:36', '2022-03-05 11:55:26', NULL),
(10, '1', 'Direktur SDM', 5, 1, 'Aktif', NULL, '2022-03-05 11:55:38', '2022-03-05 11:59:06', NULL),
(11, '1', 'Direktur Mineral', 5, 1, 'Aktif', NULL, '2022-03-05 11:59:24', '2022-03-07 03:35:12', NULL),
(12, NULL, 'Departemen Mineral', 8, 0, 'Tidak Aktif', NULL, '2022-03-05 13:25:36', '2022-07-29 09:56:20', NULL),
(14, '6', 'Staff Jaringan 2', 9, 1, 'Aktif', NULL, '2022-08-03 14:34:59', '2022-08-03 14:34:59', NULL),
(15, NULL, 'TES', 32, 0, 'Tidak Aktif', NULL, '2022-08-14 16:57:41', '2022-08-14 16:57:53', NULL),
(16, '15', 'tes', 33, 1, 'Tidak Aktif', NULL, '2022-08-14 16:58:22', '2022-08-14 16:58:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detailunits`
--

CREATE TABLE `detailunits` (
  `id_detailunit` int(5) UNSIGNED NOT NULL,
  `unit_id` varchar(50) NOT NULL,
  `supplier_id` varchar(50) NOT NULL,
  `karyawan_id` varchar(50) NOT NULL,
  `unitkerja_id` varchar(50) NOT NULL,
  `milik` varchar(50) NOT NULL,
  `status_unit` varchar(50) NOT NULL,
  `kode_unit` varchar(50) NOT NULL,
  `foto_unit` decimal(10,4) NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `tahun_perolehan` year(4) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `nota_dinas` varchar(50) NOT NULL,
  `pj` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detailunits`
--

INSERT INTO `detailunits` (`id_detailunit`, `unit_id`, `supplier_id`, `karyawan_id`, `unitkerja_id`, `milik`, `status_unit`, `kode_unit`, `foto_unit`, `kondisi`, `tahun_perolehan`, `invoice`, `nota_dinas`, `pj`, `harga`, `stok`, `barcode`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3', '1', '1', '5', '5', 'Available', '0001', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 20000, 1, '1', '3', NULL, '2022-02-02 14:22:16', '2022-08-24 22:54:08', NULL),
(2, '3', '1', '', '5', '5', 'Assign To Location', '0002', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 20000, 1, '2', '3', NULL, '2022-02-02 14:22:16', '2022-08-24 21:25:01', NULL),
(3, '4', '1', '', '5', '14', 'Available', '0003', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 20000, 30, '3', '3', NULL, '2022-02-02 14:22:16', '2022-08-18 09:16:55', NULL),
(4, '1', '1', '3', '6', '6', 'Assign To Employee', '0004', '0.0000', 'Layak Pakai', 2021, 'INV/20YYMMDD/MPL/12121', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 20001, 1, '4', '3', NULL, '2022-02-03 10:54:45', '2022-08-11 21:59:11', NULL),
(5, '1', '1', '3', '5', '5', 'Assign To Employee', '0005', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 20000, 1, '5', '3', NULL, '2022-02-03 10:54:45', '2022-08-14 07:07:52', NULL),
(6, '2', '1', '', '5', '5', 'Assign To Location', '0006', '0.3660', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 900000, 1, '6', '3', NULL, '2022-02-15 11:28:49', '2022-09-23 09:12:32', NULL),
(7, '2', '1', '3', '14', '14', 'Assign To Employee', '0007', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 900000, 1, '7', '3', NULL, '2022-02-15 11:28:49', '2022-09-23 09:15:11', NULL),
(8, '2', '1', '1', '5', '5', 'Assign To Employee', '0008', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 900000, 1, '8', '3', NULL, '2022-02-15 11:28:49', '2022-09-23 09:15:14', NULL),
(9, '2', '1', '', '5', '5', 'Assign To Location', '0009', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 900000, 1, '9', '3', NULL, '2022-02-15 11:28:49', '2022-09-23 09:12:40', NULL),
(10, '3', '1', '1', '5', '5', 'Assign To Employee', '0010', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 200000, 1, '10', '3', NULL, '2022-02-16 09:58:19', '2022-10-11 15:13:58', NULL),
(11, '5', '1', '0', '14', '14', 'Available', '0011', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/0000', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 90000, 20, '11', '3', NULL, '2022-02-25 05:46:32', '2022-08-16 22:04:20', NULL),
(13, '3', '1', '1', '5', '5', 'Available', '0012.2021', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 200000, 1, '12', '3', NULL, '2022-03-10 12:39:56', '2022-08-16 22:04:24', NULL),
(14, '3', '1', '3', '5', '5', 'Assign To Employee', '0013.2021', '0.0000', 'Baik', 2021, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '3', 200000, 1, '13', '3', NULL, '2022-03-10 12:39:56', '2022-09-23 09:14:33', NULL),
(15, '3', '1', '', '7', '7', 'Assign To Location', '0000', '0.0000', 'Layak Pakai', 2021, 'ND. 00XX/DEP.BMC/XXX - 20XX', '', '0', 200000, 1, '0', 'fiqq', NULL, '2022-08-11 14:52:13', '2022-08-11 14:56:03', NULL),
(16, '3', '1', '', '7', '7', 'Assign To Location', '0000', '0.0000', 'Layak Pakai', 2021, 'ND. 00XX/DEP.BMC/XXX - 20XX', '', '0', 200000, 1, '0', 'fiqq', NULL, '2022-08-11 14:52:13', '2022-08-11 14:56:12', NULL),
(17, '2', '1', '', '5', '5', 'Assign To Location', '0000', '0.0000', 'Layak Pakai', 2021, 'ND. 00XX/DEP.BMC/XXX - 20XX', '', '0', 200000, 1, '0', 'fiqq', NULL, '2022-08-11 14:59:00', '2022-09-23 09:11:32', NULL),
(18, '3', '1', '', '9', '9', 'Assign To Location', '0000', '0.0000', 'Kurang Layak Pakai', 2020, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '0', 200000, 1, '0', 'fiqq', NULL, '2022-08-11 15:01:02', '2022-08-11 15:01:02', NULL),
(19, '3', '1', '', '9', '9', 'Assign To Location', '0000', '0.0000', 'Kurang Layak Pakai', 2020, 'INV/20YYMMDD/MPL/XXXXXX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '0', 200000, 1, '0', 'fiqq', NULL, '2022-08-11 15:01:02', '2022-08-11 15:01:02', NULL),
(20, '1', '0', '5', '5', 'Idle', 'Assign To Employee', '', '0.0000', '2021', 0000, 'ND. 00XX/DEP.BMC/XXX - 20XX', '1', '19', 0, 1, '', '19', NULL, '2022-08-14 23:35:37', '2022-09-23 09:14:09', NULL),
(21, '1', '0', '5', '5', 'Idle', 'Assign To Employee', '', '0.0000', '2021', 0000, 'ND. 00XX/DEP.BMC/XXX - 20XX', '1', '20', 0, 1, '', '20', NULL, '2022-08-14 23:35:37', '2022-09-23 09:14:21', NULL),
(22, '1', '1', '1', '6', '6', 'Assign To Employee', '0021.2021', '0.6340', 'Baik', 2021, 'ND. 00XX/DEP.BMC/XXX - 20XX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '', 200000, 1, '21', '', NULL, '2022-08-14 23:41:15', '2022-10-11 11:14:31', NULL),
(23, '1', '1', '', '5', '6', 'Assign To Location', '0022.2021', '0.0000', 'Baik', 2021, 'ND. 00XX/DEP.BMC/XXX - 20XX', 'ND. 00XX/DEP.BMC/XXX - 20XX', '', 200000, 1, '22', '', NULL, '2022-08-14 23:41:16', '2022-09-10 15:09:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fuzzykriteria`
--

CREATE TABLE `fuzzykriteria` (
  `id` int(5) UNSIGNED NOT NULL,
  `fuzzy_id` varchar(50) DEFAULT NULL,
  `left` varchar(50) DEFAULT NULL,
  `right` varchar(50) DEFAULT NULL,
  `valueL` decimal(10,2) DEFAULT NULL,
  `valueM` decimal(10,2) DEFAULT NULL,
  `valueU` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fuzzymaster`
--

CREATE TABLE `fuzzymaster` (
  `id_fuzzy` int(5) UNSIGNED NOT NULL,
  `fuzzy_type` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `up` decimal(10,4) DEFAULT NULL,
  `middle` decimal(10,4) DEFAULT NULL,
  `low` decimal(10,4) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fuzzymaster`
--

INSERT INTO `fuzzymaster` (`id_fuzzy`, `fuzzy_type`, `value`, `up`, `middle`, `low`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'm', '1.0000', '1.0000', '1.0000', '1.0000', 'Equal', '2022-08-20 13:07:53', '2022-08-22 01:20:29', NULL),
(2, 'l', '2.0000', '1.5000', '1.0000', '0.5000', 'Slightly Less Important', '2022-08-20 14:41:30', '2022-09-26 10:33:28', NULL),
(3, 'l', '3.0000', '2.0000', '1.5000', '1.0000', 'Slightly Important', '2022-08-20 14:41:30', '2022-09-26 10:33:55', NULL),
(4, 'l', '4.0000', '2.5000', '2.0000', '1.5000', 'Important And More Important', '2022-08-20 14:41:30', '2022-09-26 10:34:46', NULL),
(5, 'l', '5.0000', '3.0000', '2.5000', '2.0000', 'More Important', '2022-08-20 14:41:30', '2022-09-26 10:35:14', NULL),
(6, 'l', '6.0000', '3.5000', '3.0000', '2.5000', 'Between More Important and Very Important', '2022-08-20 14:41:30', '2022-09-26 10:35:54', NULL),
(7, 'l', '7.0000', '4.0000', '3.5000', '3.0000', 'Very Important', '2022-08-20 14:41:30', '2022-09-26 10:36:39', NULL),
(8, 'l', '8.0000', '4.5000', '4.0000', '3.5000', 'Between Very Important and Extremely Important', '2022-08-20 14:41:30', '2022-09-26 10:37:00', NULL),
(9, 'l', '9.0000', '4.5000', '4.5000', '4.0000', 'Extremely Important', '2022-08-20 14:41:30', '2022-09-26 10:37:31', NULL),
(10, 'r', '0.5000', '2.0000', '1.0000', '0.6667', 'Slightly Less Important', '2022-08-20 14:41:30', '2022-09-26 10:39:21', NULL),
(11, 'r', '0.3333', '1.0000', '0.6667', '0.5000', 'Slightly Important', '2022-08-20 14:41:31', '2022-09-26 10:40:25', NULL),
(12, 'r', '0.2500', '0.6667', '0.5000', '0.4000', 'Important And More Important', '2022-08-20 14:41:31', '2022-09-26 10:41:22', NULL),
(13, 'r', '0.2000', '0.5000', '0.4000', '0.3333', 'More Important', '2022-08-20 14:41:31', '2022-09-26 10:42:23', NULL),
(14, 'r', '0.1667', '0.4000', '0.3333', '0.2857', 'Between More Important and Very Important', '2022-08-20 14:41:31', '2022-09-26 10:43:07', NULL),
(15, 'r', '0.1428', '0.3333', '0.2857', '0.2500', 'Very Important', '2022-08-20 14:41:31', '2022-09-26 10:43:47', NULL),
(16, 'r', '0.1250', '0.2857', '0.2500', '0.2222', 'Between Very Important and Extremely Important', '2022-08-20 14:41:31', '2022-09-26 10:44:24', NULL),
(17, 'r', '0.1111', '0.2500', '0.2857', '0.2857', 'Extremely Important', '2022-08-20 14:41:31', '2022-09-26 10:44:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `detailunit_id` int(11) DEFAULT NULL,
  `order_id` varchar(50) DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8 DEFAULT NULL,
  `aksi` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `detailunit_id`, `order_id`, `keterangan`, `aksi`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, 'Diedit dari harga = 20000 menjadi harga = 20001 -- ', 'Edit', 3, NULL, '2022-02-16 21:13:45', '2022-02-24 02:13:09'),
(2, 4, NULL, 'Diedit dari tahun_perolehan = 2021 menjadi tahun_perolehan = 2020 --  dari invoice = INV/20YYMMDD/MPL/12121 menjadi invoice = INV/20YYMMDD/MPL/XXXXXX --  dari harga = 20001 menjadi harga = 20000 --  oleh ', 'Edit', 3, NULL, '2022-02-16 22:31:09', '2022-02-24 02:13:14'),
(3, 4, NULL, 'Perubahan pada kolom <br> <strong>kondisi</strong> = Baik menjadi <strong>kondisi</strong> = Renovasi <br>  Perubahan pada kolom <br> <strong>invoice</strong> = INV/20YYMMDD/MPL/XXXXXX menjadi <strong>invoice</strong> = INV/20YYMMDD/MPL/12121 <br>  Perubahan pada kolom <br> <strong>harga</strong> = 20000 menjadi <strong>harga</strong> = 20001 <br>  <br> oleh ', 'Edit', 3, NULL, '2022-02-21 12:28:00', '2022-02-24 02:13:19'),
(4, NULL, '9', 'Mengajukan Permohonan <strong>Pemakaian</strong> beberapa inventaris dengan keterangan <strong>untuk keperluan historikal</strong> ke <strong>5</strong>', 'Belum di Approve', 3, NULL, '2022-02-24 03:27:32', '2022-02-24 05:23:22'),
(5, NULL, '9', 'Moh. Ainur Rofik telah menyetujui Permohonan <strong>Pemakaian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>9</strong>', 'Sudah di Approve', 3, NULL, '2022-02-24 05:34:51', NULL),
(6, NULL, '5', '<strong>Moh. Ainur Rofik</strong> telah menolak Permohonan <strong>Pemakaian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>5</strong> <br> dengan alasan <strong>Barang tidak boleh dipakai</strong>', 'Ditolak', 3, NULL, '2022-02-24 07:44:14', NULL),
(7, NULL, '12', 'Mengajukan Permohonan <strong>Pemakaian 1</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-02-25 05:18:36', NULL),
(8, NULL, '12', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pemakaian 1</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>12</strong>', 'Sudah di Approve', 3, NULL, '2022-02-25 05:20:48', NULL),
(9, 11, NULL, 'Penambahan stok barang sejumlah 50', 'Tambah Stok', 3, NULL, '2022-02-25 05:46:32', NULL),
(10, 12, NULL, 'Penambahan stok barang sejumlah 50', 'Tambah Stok', 3, NULL, '2022-02-25 05:46:32', NULL),
(11, NULL, '13', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>keperluan approval</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-02-25 05:48:33', NULL),
(12, NULL, '14', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>unutk ini itu</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-02-25 05:54:37', NULL),
(13, NULL, '15', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>untuk ini itu</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-02-25 06:00:56', NULL),
(14, 3, NULL, ' telah digunakan sebanyak <strong>2</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>15</strong> ke Ruangan Direksi', 'Penggunaan', 3, NULL, '2022-02-25 06:01:10', NULL),
(15, 11, NULL, ' telah digunakan sebanyak <strong>21</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>15</strong> ke Ruangan Direksi', 'Penggunaan', 3, NULL, '2022-02-25 06:01:10', NULL),
(16, NULL, '16', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>untuk 1</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-02-25 06:13:42', NULL),
(17, 3, NULL, ' telah digunakan sebanyak <strong>2</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>16</strong> ke Ruangan Direksi', 'Penggunaan', 3, NULL, '2022-02-25 06:14:34', NULL),
(18, 11, NULL, ' telah digunakan sebanyak <strong>5</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>16</strong> ke Ruangan Direksi', 'Penggunaan', 3, NULL, '2022-02-25 06:14:34', NULL),
(19, NULL, '16', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Penggunaan</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>16</strong>', 'Sudah di Approve', 3, NULL, '2022-02-25 06:14:34', NULL),
(20, NULL, '17', 'Mengajukan Permohonan <strong>Pemakaian</strong> beberapa inventaris dengan keterangan <strong>untuk tes peruntukan</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-08 07:04:01', NULL),
(21, NULL, '18', 'Mengajukan Permohonan <strong>Pemakaian</strong> beberapa inventaris dengan keterangan <strong>untuk keperluan peruntukan 2</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-08 07:16:37', NULL),
(22, NULL, '18', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pemakaian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>18</strong>', 'Sudah di Approve', 3, NULL, '2022-03-08 16:45:02', NULL),
(23, NULL, '19', 'Mengajukan Permohonan <strong>Pemakaian</strong> beberapa inventaris dengan keterangan <strong>untuk keperluan peruntukan 3</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-08 18:36:18', NULL),
(24, 10, NULL, ' telah disetujui pengajuan pemakaian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>19</strong> ke Ruangan Direksi dengan peruntukan <strong> Moh. Ainur Rofik', 'Penggunaan', 3, NULL, '2022-03-08 18:37:23', NULL),
(25, NULL, '19', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pemakaian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>19</strong>', 'Sudah di Approve', 3, NULL, '2022-03-08 18:37:23', NULL),
(26, NULL, '20', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>Sebuah perusahaan yang baik adalah perusahaan yang bisa memanage semua karyawannya dengan baik</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-09 13:48:23', NULL),
(27, 4, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>20</strong> ke Ruangan Direksi dengan peruntukan <strong> Moh. Ainur Rofik', 'Mutasi', 3, NULL, '2022-03-09 13:57:28', NULL),
(28, 5, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>20</strong> ke Ruangan Direksi dengan peruntukan <strong> ', 'Mutasi', 3, NULL, '2022-03-09 13:57:28', NULL),
(29, NULL, '20', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Mutasi</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>20</strong>', 'Sudah di Approve', 3, NULL, '2022-03-09 13:57:28', NULL),
(30, NULL, '21', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong>untuk keperluan peminjaman peruntukan dan tanpa peruntukan </strong> ke <strong>Ruangan Direktur Utama</strong>', 'Belum di Approve', 3, NULL, '2022-03-09 14:12:37', NULL),
(31, 2, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>21</strong> ke Ruangan Direktur Utama dengan peruntukan <strong> Moh. Ainur Rofik', 'Peminjaman', 3, NULL, '2022-03-09 14:13:10', NULL),
(32, 10, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>21</strong> ke Ruangan Direktur Utama dengan peruntukan <strong> ', 'Peminjaman', 3, NULL, '2022-03-09 14:13:10', NULL),
(33, NULL, '21', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Peminjaman</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>21</strong>', 'Sudah di Approve', 3, NULL, '2022-03-09 14:13:10', NULL),
(34, NULL, '23', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong>asas</strong> ke <strong>Ruangan Direktur Utama</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 06:47:31', NULL),
(35, 4, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>23</strong> ke <strong>Ruangan Direktur Utama</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Peminjaman', 3, NULL, '2022-03-10 06:48:16', NULL),
(36, 5, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>23</strong> ke <strong>Ruangan Direktur Utama</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Peminjaman', 3, NULL, '2022-03-10 06:48:16', NULL),
(37, NULL, '23', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Peminjaman</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>23</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 06:48:16', NULL),
(38, NULL, '24', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong>kembalikan tapi tidak semuanya</strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 06:49:19', NULL),
(39, NULL, '27', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Gudang</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 08:39:07', NULL),
(40, NULL, '30', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 09:11:06', NULL),
(41, NULL, '31', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong>sasasas</strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 11:27:00', NULL),
(42, NULL, '32', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong>asasas</strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 11:33:05', NULL),
(43, 4, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>32</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 11:33:16', NULL),
(44, 5, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>32</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 11:33:16', NULL),
(45, NULL, '32', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>32</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 11:33:16', NULL),
(46, NULL, '36', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>sasasa</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 11:43:31', NULL),
(47, NULL, '37', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>1</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 11:48:23', NULL),
(48, 3, NULL, ' telah digunakan sebanyak <strong>2</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>37</strong> ke <strong>Ruangan Direksi</strong> ', 'Penggunaan', 3, NULL, '2022-03-10 11:49:00', NULL),
(49, 11, NULL, ' telah digunakan sebanyak <strong>2</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>37</strong> ke <strong>Ruangan Direksi</strong> ', 'Penggunaan', 3, NULL, '2022-03-10 11:49:00', NULL),
(50, NULL, '37', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Penggunaan</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>37</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 11:49:00', NULL),
(51, NULL, '38', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 11:50:07', NULL),
(52, 11, NULL, ' telah digunakan sebanyak <strong>2</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>38</strong> ke <strong>Ruangan Direksi</strong> ', 'Penggunaan', 3, NULL, '2022-03-10 11:50:32', NULL),
(53, NULL, '38', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Penggunaan</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>38</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 11:50:32', NULL),
(54, 13, NULL, 'Penambahan stok barang sejumlah 1', 'Tambah Stok', 3, NULL, '2022-03-10 12:39:56', NULL),
(55, 14, NULL, 'Penambahan stok barang sejumlah 1', 'Tambah Stok', 3, NULL, '2022-03-10 12:39:56', NULL),
(56, NULL, '39', 'Mengajukan Permohonan <strong>Pemakaian</strong> beberapa inventaris dengan keterangan <strong>untuk pemakaian industri potograpi</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 12:56:57', NULL),
(57, 13, NULL, ' telah disetujui, pengajuan pemakaian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>39</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Pemakaian', 3, NULL, '2022-03-10 12:59:58', NULL),
(58, 14, NULL, ' telah disetujui, pengajuan pemakaian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>39</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Moh. Ainur Rofik', 'Pemakaian', 3, NULL, '2022-03-10 12:59:58', NULL),
(59, NULL, '39', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pemakaian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>39</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 12:59:58', NULL),
(60, NULL, '40', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>semua ini hanya sementara ayola bisa </strong> ke <strong>Ruangan Direktur Utama</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 13:26:35', NULL),
(61, 4, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>40</strong> ke <strong>Ruangan Direktur Utama</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Mutasi', 3, NULL, '2022-03-10 13:27:04', NULL),
(62, 5, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>40</strong> ke <strong>Ruangan Direktur Utama</strong> dengan peruntukan <strong> Moh. Ainur Rofik', 'Mutasi', 3, NULL, '2022-03-10 13:27:04', NULL),
(63, NULL, '40', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Mutasi</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>40</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 13:27:04', NULL),
(64, NULL, '41', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong>untuk keperluan peminjaman 1 jam </strong> ke <strong>Ruangan Manager Operasional</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 13:29:03', NULL),
(65, 6, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>41</strong> ke <strong>Ruangan Manager Operasional</strong> dengan peruntukan <strong> Moh. Ainur Rofik', 'Peminjaman', 3, NULL, '2022-03-10 13:29:30', NULL),
(66, 13, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>41</strong> ke <strong>Ruangan Manager Operasional</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Peminjaman', 3, NULL, '2022-03-10 13:29:30', NULL),
(67, NULL, '41', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Peminjaman</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>41</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 13:29:30', NULL),
(68, NULL, '42', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong>akan ku kembalikan 1 , 1 nya menyuusul </strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 13:31:21', NULL),
(69, 6, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>42</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 13:31:59', NULL),
(70, NULL, '42', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>42</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 13:31:59', NULL),
(71, NULL, '43', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong>tak kembalikan semuanya</strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 13:33:46', NULL),
(72, 7, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>43</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 13:34:09', NULL),
(73, 1, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>43</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 13:34:09', NULL),
(74, NULL, '43', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>43</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 13:34:09', NULL),
(75, NULL, '44', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>new mutasi</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 19:53:13', NULL),
(76, 6, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>44</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> ', 'Mutasi', 3, NULL, '2022-03-10 19:53:43', NULL),
(77, 8, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>44</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Mutasi', 3, NULL, '2022-03-10 19:53:43', NULL),
(78, 9, NULL, ' telah disetujui, pengajuan Mutasi oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>44</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> ', 'Mutasi', 3, NULL, '2022-03-10 19:53:43', NULL),
(79, NULL, '44', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Mutasi</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>44</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 19:53:43', NULL),
(80, NULL, '45', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong>new peminjaman</strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 20:04:48', NULL),
(81, 4, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>45</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Peminjaman', 3, NULL, '2022-03-10 20:05:19', NULL),
(82, 5, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>45</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> ', 'Peminjaman', 3, NULL, '2022-03-10 20:05:19', NULL),
(83, NULL, '45', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Peminjaman</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>45</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 20:05:19', NULL),
(84, NULL, '46', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong>old pengembalian</strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 20:09:23', NULL),
(85, 13, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>46</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 20:10:04', NULL),
(86, NULL, '46', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>46</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 20:10:04', NULL),
(87, NULL, '47', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 20:13:20', NULL),
(88, 4, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>47</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 20:13:31', NULL),
(89, 5, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>47</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 20:13:31', NULL),
(90, NULL, '47', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>47</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 20:13:31', NULL),
(91, NULL, '48', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 20:17:30', NULL),
(92, 4, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>48</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Moh. Ainur Rofik', 'Peminjaman', 3, NULL, '2022-03-10 20:17:43', NULL),
(93, 1, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>48</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Vero Jarwa Kusumo S.H.', 'Peminjaman', 3, NULL, '2022-03-10 20:17:43', NULL),
(94, NULL, '48', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Peminjaman</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>48</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 20:17:43', NULL),
(95, NULL, '49', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 20:18:15', NULL),
(96, 4, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>49</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 20:18:55', NULL),
(97, 1, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>49</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 20:18:55', NULL),
(98, NULL, '49', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>49</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 20:18:55', NULL),
(99, NULL, '50', 'Mengajukan Permohonan <strong>Peminjaman</strong> beberapa inventaris dengan keterangan <strong>tes pengembalian </strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-10 22:18:23', NULL),
(100, 8, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>50</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Moh. Ainur Rofik', 'Peminjaman', 3, NULL, '2022-03-10 22:19:31', NULL),
(101, 13, NULL, ' telah disetujui, pengajuan Peminjaman oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>50</strong> ke <strong>Ruangan Direksi</strong> dengan peruntukan <strong> Moh. Ainur Rofik', 'Peminjaman', 3, NULL, '2022-03-10 22:19:31', NULL),
(102, NULL, '50', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Peminjaman</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>50</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 22:19:31', NULL),
(103, NULL, '51', 'Mengajukan Permohonan <strong>Pengembalian</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong></strong>', 'Belum di Approve', 3, NULL, '2022-03-10 22:39:24', NULL),
(104, 8, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>51</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 22:40:55', NULL),
(105, 13, NULL, ' telah disetujui, pengajuan Pengembalian oleh <strong>Moh. Ainur Rofik</strong> dengan Id Pengajuan <strong>51</strong> ke <strong></strong>', 'Pengembalian', 3, NULL, '2022-03-10 22:40:55', NULL),
(106, NULL, '51', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Pengembalian</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>51</strong>', 'Sudah di Approve', 3, NULL, '2022-03-10 22:40:55', NULL),
(107, NULL, '52', 'Mengajukan Permohonan <strong>Pemakaian</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-16 16:56:48', NULL),
(108, NULL, '53', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-16 16:58:22', NULL),
(109, NULL, '54', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong></strong> ke <strong>Ruangan Direksi</strong>', 'Belum di Approve', 3, NULL, '2022-03-16 16:58:29', NULL),
(110, 3, NULL, ' telah digunakan sebanyak <strong>2</strong> oleh <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>54</strong> ke <strong>Ruangan Direksi</strong> ', 'Penggunaan', 3, NULL, '2022-03-16 17:00:52', NULL),
(111, NULL, '54', '<strong>Moh. Ainur Rofik</strong> telah menyetujui Permohonan <strong>Penggunaan</strong> beberapa inventaris dari <strong>Moh. Ainur Rofik</strong> dengan Id Order <strong>54</strong>', 'Sudah di Approve', 3, NULL, '2022-03-16 17:00:52', NULL),
(112, NULL, '58', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>TES</strong> ke <strong>Ruangan Direksi</strong>', 'Berhasil', 0, NULL, '2022-08-13 21:18:21', '2022-08-13 21:18:21'),
(113, NULL, '62', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>tes</strong> ke <strong>Ruangan Direksi</strong>', 'Berhasil', 0, NULL, '2022-08-14 10:03:50', '2022-08-14 10:03:50'),
(114, 20, NULL, 'Penambahan stok barang sejumlah 2000000', 'Tambah Stok', 19, NULL, '2022-08-14 23:35:37', NULL),
(115, 21, NULL, 'Penambahan stok barang sejumlah 2000000', 'Tambah Stok', 20, NULL, '2022-08-14 23:35:37', NULL),
(116, 22, NULL, 'Penambahan stok barang sejumlah 1', 'Tambah Stok', 0, NULL, '2022-08-14 23:41:16', NULL),
(117, 23, NULL, 'Penambahan stok barang sejumlah 1', 'Tambah Stok', 0, NULL, '2022-08-14 23:41:16', NULL),
(118, NULL, '67', 'Mengajukan Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <strong>tes</strong> ke <strong>Ruangan Direksi</strong>', 'Belum Di Approve', 0, NULL, '2022-08-17 07:26:16', '2022-08-17 07:26:16'),
(119, NULL, '4', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>tes mutasi</strong> ke <strong>Ruangan Direktur Utama</strong>', 'Berhasil', 0, NULL, '2022-10-11 11:14:31', '2022-10-11 11:14:31'),
(120, NULL, '5', 'Mengajukan Permohonan <strong>Mutasi</strong> beberapa inventaris dengan keterangan <strong>tes</strong> ke <strong>Ruangan Direksi</strong>', 'Berhasil', 0, NULL, '2022-10-11 15:13:58', '2022-10-11 15:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id_karyawan` int(5) UNSIGNED NOT NULL,
  `jabatan_id` varchar(50) NOT NULL,
  `nrp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `status_karyawan` enum('PKWT','Organik','Tidak Aktif') NOT NULL DEFAULT 'PKWT',
  `deskripsi` text DEFAULT NULL,
  `is_pic` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id_karyawan`, `jabatan_id`, `nrp`, `email`, `nama`, `alamat`, `foto`, `status_karyawan`, `deskripsi`, `is_pic`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '11', '3529455812190392', 'endah.mandala@natsir.biz', 'Vero Jarwa Kusumo S.H.', 'Ds. Cikutra Barat No. 990, Administrasi Jakarta Utara 74962, Bali', '1646456527_2c6c309a42356cc4de44.png', 'PKWT', 'Aut maiores voluptatem molestiae tempore est aspernatur.', '', '2022-01-27 07:02:02', '2022-07-13 17:46:54', NULL),
(2, '8', '6213136006019467', 'xwinarsih@gmail.com', 'Gandi Hasim Uwai', 'Jln. Acordion No. 502, Bogor 74699, Gorontalo', NULL, 'PKWT', 'Debitis ut optio voluptatibus sunt.', '2', '2022-01-27 07:02:02', '2022-10-03 19:51:37', NULL),
(3, '7', '100011002001', 'ainurrofik989@gmail.com', 'Moh. Ainur Rofik', 'Jl Simo Gunung Kramat Timur7/16 E', '1643472298_93f8a3aa3dc01c71c7b9.png', 'PKWT', NULL, '0', '2022-01-29 23:00:18', '2022-08-14 17:09:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(5) UNSIGNED NOT NULL,
  `kode_kriteria` varchar(50) DEFAULT NULL,
  `parent_kode_kriteria` varchar(50) DEFAULT NULL,
  `kriteria` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `atribut` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `parent_kode_kriteria`, `kriteria`, `level`, `atribut`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'C0002', NULL, 'Kerusakan', '0', 'Benefit', NULL, '2022-08-19 13:43:57', '2022-08-24 07:58:17', NULL),
(3, 'C0003', NULL, 'Kepentingan', '0', 'Benefit', NULL, '2022-08-19 13:44:20', '2022-08-24 07:58:19', NULL),
(4, 'C0004', NULL, 'JumlahPersediaan', '0', 'Cost', NULL, '2022-08-19 13:45:10', '2022-09-14 11:55:54', NULL),
(10, 'C0001', NULL, 'Biaya', '0', 'Cost', NULL, '2022-10-05 10:25:41', '2022-10-05 10:25:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logactivities`
--

CREATE TABLE `logactivities` (
  `id_log` int(5) UNSIGNED NOT NULL,
  `table_names` varchar(100) NOT NULL,
  `table_id` int(5) NOT NULL,
  `description` text NOT NULL,
  `before` varchar(100) NOT NULL,
  `after` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logactivities`
--

INSERT INTO `logactivities` (`id_log`, `table_names`, `table_id`, `description`, `before`, `after`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(6, 'unitkerja', 16, 'update data ', '<strong>unitkerja</strong> : Kantor Cabang TES dan <strong>status_unitkerja</strong> : Aktif ', '<strong>unitkerja</strong> : Kantor Cabang  dan <strong>status_unitkerja</strong> : Tidak Aktif ', 'fiqq', '2022-07-27 22:10:48', '2022-07-27 22:10:48', NULL),
(7, 'unitkerja', 16, 'update data ', '<strong>unitkerja</strong> : Kantor Cabang  <br><strong>status_unitkerja</strong> : Tidak Aktif ', '<strong>unitkerja</strong> : Kantor Cabang Tes <br><strong>status_unitkerja</strong> : Aktif ', 'fiqq', '2022-07-28 08:08:23', '2022-07-28 08:08:23', NULL),
(8, 'unitkerja', 31, 'update data ', '<strong>unitkerja</strong> : Ruangan Gudang ', '<strong>unitkerja</strong> : Ruangan Gudang Baru ', 'fiqq', '2022-08-03 06:38:29', '2022-08-03 06:38:29', NULL),
(9, 'unitkerja', 31, 'update data ', '<strong>unitkerja</strong> : Ruangan Gudang Baru ', '<strong>unitkerja</strong> : Ruangan Gudang ', 'fiqq', '2022-08-03 07:01:14', '2022-08-03 07:01:14', NULL),
(10, 'unitkerja', 31, 'update data ', '<strong>unitkerja</strong> : Ruangan Gudang <br><strong>status_unitkerja</strong> : Aktif ', '<strong>unitkerja</strong> : Ruangan Gudang Baru <br><strong>status_unitkerja</strong> : Tidak Aktif', 'fiqq', '2022-08-03 07:07:28', '2022-08-03 07:07:28', NULL),
(11, 'unitkerja', 19, 'update data ', '<strong>unitkerja</strong> : Ruangan Gudang ', '<strong>unitkerja</strong> : Ruangan Gudang PMS ', 'fiqq', '2022-08-03 08:19:29', '2022-08-03 08:19:29', NULL),
(12, 'departements', 1, 'update data ', '<strong>status_dep</strong> : Aktif ', '<strong>status_dep</strong> : Tidak Aktif ', 'fiqq', '2022-08-03 13:25:36', '2022-08-03 13:25:36', NULL),
(13, 'departements', 4, 'update data ', '', '', 'fiqq', '2022-08-03 21:01:54', '2022-08-03 21:01:54', NULL),
(14, 'departements', 4, 'update data ', '<strong>content</strong> : Direktur Utama 1 <br><strong>status_dep</strong> : Tidak Aktif ', '<strong>content</strong> : Direktur Utama <br><strong>status_dep</strong> : Aktif ', 'fiqq', '2022-08-03 21:03:02', '2022-08-03 21:03:02', NULL),
(15, 'karyawans', 3, 'update data ', '<strong>nrp</strong> : 18081010073 ', '<strong>nrp</strong> : 100011002001 ', 'fiqq', '2022-08-04 14:37:29', '2022-08-04 14:37:29', NULL),
(16, 'users', 3, 'update data ', '<strong>username</strong> : jeconia <br><strong>group_id</strong> : 2 ', '<strong>username</strong> : jeconiaa <br><strong>group_id</strong> : 4 ', 'fiqq', '2022-08-05 08:16:30', '2022-08-05 08:16:30', NULL),
(17, 'users', 3, 'update data ', '<strong>Password</strong>: *********', '<strong>Password</strong>: *********', 'fiqq', '2022-08-05 11:00:06', '2022-08-05 11:00:06', NULL),
(18, 'products', 1, 'update data ', '<strong>deskripsi_product</strong> :  ', '<strong>deskripsi_product</strong> : tes deskripsi ', 'fiqq', '2022-08-08 15:12:07', '2022-08-08 15:12:07', NULL),
(19, 'products', 2, 'update data ', '<strong>deskripsi_product</strong> :  ', '<strong>deskripsi_product</strong> : Deskripsi TES ', 'fiqq', '2022-08-08 18:49:29', '2022-08-08 18:49:29', NULL),
(20, 'units', 1, 'update data ', '<strong>brand</strong> : Xiaomi ', '<strong>brand</strong> : Polo ', 'fiqq', '2022-08-09 08:40:16', '2022-08-09 08:40:16', NULL),
(21, 'suppliers', 2, 'update data ', '<strong>contact1</strong> : 000000 <br><strong>alamat</strong> : shope no 1 ', '<strong>contact1</strong> : 08123 <br><strong>alamat</strong> : shope no tes ', 'fiqq', '2022-08-09 11:34:46', '2022-08-09 11:34:46', NULL),
(22, 'detailunits', 4, 'update data ', '<strong>harga</strong> : 20000 ', '<strong>harga</strong> : 20001 ', 'fiqq', '2022-08-11 21:59:11', '2022-08-11 21:59:11', NULL),
(23, 'detailunits', 22, 'update data ', '', 'Telah Dilakukan Cek Maintanance Aset dengan hasil 0.6340', 'fiqq', '2022-08-25 06:40:46', '2022-08-25 06:40:46', NULL),
(24, 'detailunits', 6, 'update data ', '', 'Telah Dilakukan Cek Maintanance Aset dengan hasil 0.3660', 'fiqq', '2022-08-25 06:40:46', '2022-08-25 06:40:46', NULL),
(25, 'users', 4, 'update data ', '<strong>Password</strong>: *********', '<strong>Password</strong>: *********', 'fiqq', '2022-08-28 10:09:36', '2022-08-28 10:09:36', NULL),
(26, 'users', 4, 'update data ', '<strong>Password</strong>: *********', '<strong>Password</strong>: *********', 'fiqq', '2022-08-28 10:09:40', '2022-08-28 10:09:40', NULL),
(27, 'kriteria', 4, 'update data ', '<strong>kriteria</strong> : Kelayakan <br><strong>atribut</strong> : Benefit ', '<strong>kriteria</strong> : Jumlah Persediaan <br><strong>atribut</strong> : Cost ', 'fiqq', '2022-08-28 10:17:09', '2022-08-28 10:17:09', NULL),
(28, 'detailunits', 3, 'Pengajuan Penggunaan', '', 'Telah dilakukan Permohonan Penggunaan Inventaris oleh fiqq ke Ruangan Direksi ', 'fiqq', '2022-09-10 13:41:39', '2022-09-10 13:41:39', NULL),
(29, 'orders', 1, 'Pengajuan Penggunaan', '', 'Mengajukan Transaksi Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <s', 'fiqq', '2022-09-10 13:41:39', '2022-09-10 13:41:39', NULL),
(30, 'detailunits', 23, 'Pengajuan Penggunaan', '', 'Telah dilakukan Permohonan Penggunaan Inventaris oleh fiqq ke Ruangan Direksi ', 'fiqq', '2022-09-10 14:57:47', '2022-09-10 14:57:47', NULL),
(31, 'orders', 2, 'Pengajuan Penggunaan', '', 'Mengajukan Transaksi Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <s', 'fiqq', '2022-09-10 14:57:47', '2022-09-10 14:57:47', NULL),
(32, 'orders', 2, 'Approve Pengajuan Penggunaan', '', 'transaksi telah disetujui, pengajuan penggunaan oleh <strong>ainurrofik</strong> dengan Id Pengajuan', 'ainurrofik', '2022-09-10 15:09:04', '2022-09-10 15:09:04', NULL),
(33, 'detailunits', 23, 'Approve Pengajuan Penggunaan', '<strong>karyawan_id</strong> : 0 <br><strong>unitkerja_id</strong> : 6 <br><strong>status_unit</stro', '<strong>karyawan_id</strong> :  <br><strong>unitkerja_id</strong> : 5 <br><strong>status_unit</stron', 'ainurrofik', '2022-09-10 15:09:04', '2022-09-10 15:09:04', NULL),
(34, 'unitkerja', 1, 'update data ', '<strong>status_unitkerja</strong> : Aktif ', '<strong>status_unitkerja</strong> : Tidak Aktif ', 'fiqq', '2022-09-21 22:32:27', '2022-09-21 22:32:27', NULL),
(35, 'detailunits', 1, 'Pengajuan Penggunaan', '', 'Telah dilakukan Permohonan Penggunaan Inventaris oleh fiqq ke Ruangan Direksi ', 'fiqq', '2022-09-23 09:17:24', '2022-09-23 09:17:24', NULL),
(36, 'orders', 3, 'Pengajuan Penggunaan', '', 'Mengajukan Transaksi Permohonan <strong>Penggunaan</strong> beberapa inventaris dengan keterangan <s', 'fiqq', '2022-09-23 09:17:24', '2022-09-23 09:17:24', NULL),
(37, 'unitkerja', 11, 'update data ', '<strong>kode_unitkerja</strong> : ROLS ', '<strong>kode_unitkerja</strong> : ROL ', 'fiqq', '2022-09-27 12:19:48', '2022-09-27 12:19:48', NULL),
(38, 'unitkerja', 39, 'update data ', '<strong>unitkerja</strong> : tes5 ', '<strong>unitkerja</strong> : berkah abadi ', 'fiqq', '2022-09-30 10:49:02', '2022-09-30 10:49:02', NULL),
(39, 'unitkerja', 11, 'update data ', '<strong>kode_unitkerja</strong> : ROL ', '<strong>kode_unitkerja</strong> : DIR ', 'fiqq', '2022-10-01 14:27:04', '2022-10-01 14:27:04', NULL),
(40, 'unitkerja', 11, 'update data ', '<strong>kode_unitkerja</strong> : DIR ', '<strong>kode_unitkerja</strong> : ROL ', 'fiqq', '2022-10-01 14:27:22', '2022-10-01 14:27:22', NULL),
(41, 'unitkerja', 11, 'update data ', '<strong>kode_unitkerja</strong> : ROL ', '<strong>kode_unitkerja</strong> : ROLS ', 'fiqq', '2022-10-01 14:28:42', '2022-10-01 14:28:42', NULL),
(42, 'karyawans', 2, 'update data ', '<strong>nama</strong> : Gandi Hasim Uwais <br><strong>status_karyawan</strong> : Organik ', '<strong>nama</strong> : Gandi Hasim Uwai <br><strong>status_karyawan</strong> : PKWT ', 'fiqq', '2022-10-03 19:51:37', '2022-10-03 19:51:37', NULL),
(43, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0001 ', '<strong>kode_kriteria</strong> : C0002 ', 'fiqq', '2022-10-05 09:37:18', '2022-10-05 09:37:18', NULL),
(44, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0002 ', '<strong>kode_kriteria</strong> : C0001 ', 'fiqq', '2022-10-05 09:38:43', '2022-10-05 09:38:43', NULL),
(45, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0001 ', '<strong>kode_kriteria</strong> : C0002 ', 'fiqq', '2022-10-05 09:42:01', '2022-10-05 09:42:01', NULL),
(46, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0002 ', '<strong>kode_kriteria</strong> : C0001 ', 'fiqq', '2022-10-05 09:42:10', '2022-10-05 09:42:10', NULL),
(47, 'kriteria', 1, 'update data ', '', '', 'fiqq', '2022-10-05 09:42:12', '2022-10-05 09:42:12', NULL),
(48, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0001 ', '<strong>kode_kriteria</strong> : C0002 ', 'fiqq', '2022-10-05 09:44:10', '2022-10-05 09:44:10', NULL),
(49, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0002 ', '<strong>kode_kriteria</strong> : C0001 ', 'fiqq', '2022-10-05 09:44:27', '2022-10-05 09:44:27', NULL),
(50, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0001 ', '<strong>kode_kriteria</strong> : C0002 ', 'fiqq', '2022-10-05 09:45:35', '2022-10-05 09:45:35', NULL),
(51, 'kriteria', 1, 'update data ', '<strong>kode_kriteria</strong> : C0002 ', '<strong>kode_kriteria</strong> : C0001 ', 'fiqq', '2022-10-05 09:47:10', '2022-10-05 09:47:10', NULL),
(52, 'detailunits', 22, 'update data ', '', 'Telah dilakukan Mutasi oleh fiqq ke Ruangan Direktur Utama dengan peruntukan Vero Jarwa Kusumo S.H.', 'fiqq', '2022-10-11 11:14:31', '2022-10-11 11:14:31', NULL),
(53, 'detailunits', 10, 'update data ', '', 'Telah dilakukan Mutasi oleh fiqq ke Ruangan Direksi dengan peruntukan Vero Jarwa Kusumo S.H.', 'fiqq', '2022-10-11 15:13:58', '2022-10-11 15:13:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(5) UNSIGNED NOT NULL,
  `parent_id_menu` int(5) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `menuorder` int(5) NOT NULL,
  `level` int(5) NOT NULL,
  `icon` text DEFAULT NULL,
  `deskripsi_menu` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `parent_id_menu`, `title`, `url`, `menuorder`, `level`, `icon`, `deskripsi_menu`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Data Master', '#', 0, 0, '<i class=\"fas fa-fw fa-cog\"></i>', 'Master', '2022-07-09 18:16:00', '2022-07-09 18:16:00', NULL),
(2, 1, 'Unit Kerja', '/master/unitkerja', 0, 1, '#', 'child', '2022-07-10 17:17:08', '2022-07-10 17:17:08', NULL),
(3, 1, 'Ruangan', '/master/ruangan', 1, 1, '#', NULL, '2022-07-11 13:19:33', '2022-07-11 13:19:33', NULL),
(4, 1, 'Departemen', '/master/departements', 2, 1, '#', NULL, '2022-07-11 13:19:33', '2022-07-11 13:19:33', NULL),
(5, 1, 'Jabatan', '/master/jabatan', 3, 1, '#', NULL, '2022-07-11 13:19:33', '2022-07-11 13:19:33', NULL),
(6, 1, 'Karyawan', '/master/karyawans', 4, 1, '#', NULL, '2022-07-11 13:19:33', '2022-07-11 13:19:33', NULL),
(7, 1, 'Kategori', '/master/kategori', 5, 1, '#', NULL, '2022-07-11 13:23:44', '2022-07-11 13:23:44', NULL),
(8, 1, 'Unit', '/master/units', 6, 1, '#', NULL, '2022-07-11 13:23:44', '2022-07-11 13:23:44', NULL),
(10, 1, 'Supplier', '/master/suppliers', 8, 1, '#', NULL, '2022-07-11 13:23:44', '2022-07-11 13:23:44', NULL),
(11, NULL, 'User Management', '#', 1, 0, '<i class=\"fas fa-fw fa-user\"></i>', 'User', '2022-07-11 13:28:47', '2022-07-11 13:28:47', NULL),
(12, 11, 'Account', '/user/account', 0, 1, '#', NULL, '2022-07-11 13:31:13', '2022-07-12 09:02:18', NULL),
(13, 2, 'unitkerja_create', '/tambah/unitkerja', 0, 2, NULL, NULL, '2022-07-12 08:54:13', '2022-07-12 08:54:13', NULL),
(14, 2, 'unitkerja_update', '/edit/unitkerja', 0, 2, NULL, NULL, '2022-07-12 08:54:13', '2022-07-12 08:54:13', NULL),
(15, 1, 'PIC', '/master/pic', 8, 1, '#', NULL, '2022-07-13 17:54:30', '2022-07-13 17:54:30', NULL),
(16, 11, 'Roles & Permissions', '/user/rolespermissions', 1, 1, '#', NULL, '2022-07-13 17:58:23', '2022-07-13 17:58:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(43, '2021-12-07-085836', 'App\\Database\\Migrations\\Unitkerjas', 'default', 'App', 1643241704, 1),
(44, '2021-12-08-171345', 'App\\Database\\Migrations\\Departements', 'default', 'App', 1643241704, 1),
(45, '2021-12-09-014558', 'App\\Database\\Migrations\\Karyawans', 'default', 'App', 1643241704, 1),
(46, '2021-12-09-025353', 'App\\Database\\Migrations\\Users', 'default', 'App', 1643241704, 1),
(47, '2021-12-19-065637', 'App\\Database\\Migrations\\Suplliers', 'default', 'App', 1643241704, 1),
(48, '2021-12-19-083033', 'App\\Database\\Migrations\\Products', 'default', 'App', 1643241704, 1),
(49, '2021-12-20-102809', 'App\\Database\\Migrations\\Units', 'default', 'App', 1643241704, 1),
(50, '2022-01-06-015825', 'App\\Database\\Migrations\\Orders', 'default', 'App', 1643241704, 1),
(51, '2022-01-26-214733', 'App\\Database\\Migrations\\Detailunits', 'default', 'App', 1643241705, 1),
(52, '2022-01-28-071345', 'App\\Database\\Migrations\\Dataorder', 'default', 'App', 1643241705, 1),
(53, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1657213294, 2),
(54, '2022-02-16-030550', 'App\\Database\\Migrations\\History', 'default', 'App', 1657362334, 3),
(55, '2022-07-09-102252', 'App\\Database\\Migrations\\Menu', 'default', 'App', 1657362334, 3),
(56, '2022-07-09-102433', 'App\\Database\\Migrations\\AuthPermissionMenu', 'default', 'App', 1657362334, 3),
(59, '2022-07-13-101524', 'App\\Database\\Migrations\\Pic', 'default', 'App', 1657776718, 4),
(60, '2022-07-26-073642', 'App\\Database\\Migrations\\Logactivities', 'default', 'App', 1658821183, 5),
(62, '2022-08-18-035745', 'App\\Database\\Migrations\\Kriteria', 'default', 'App', 1660797284, 6),
(63, '2022-08-18-170457', 'App\\Database\\Migrations\\Alternatif', 'default', 'App', 1660842420, 7),
(73, '2022-08-19-075940', 'App\\Database\\Migrations\\PairWiseKriteria', 'default', 'App', 1660974820, 8),
(74, '2022-08-20-015333', 'App\\Database\\Migrations\\Bobotkriteria', 'default', 'App', 1660974820, 8),
(75, '2022-08-20-021813', 'App\\Database\\Migrations\\Fuzzykriteria', 'default', 'App', 1660974820, 8),
(76, '2022-08-20-022203', 'App\\Database\\Migrations\\Fuzzymaster', 'default', 'App', 1660974820, 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(5) UNSIGNED NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `order_lokasi` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status_order` varchar(50) NOT NULL,
  `dokumen_order` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `feedbackdescription` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `order_type`, `order_lokasi`, `description`, `status_order`, `dokumen_order`, `created_by`, `updated_by`, `feedbackdescription`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Penggunaan', '5', 'untuk keperluan testing', 'Ditolak', 'Umum', 'fiqq', 'ainurrofik', NULL, '2022-09-10 13:41:39', '2022-09-25 23:07:30', NULL),
(2, 'Penggunaan', '5', 'tes', 'Berhasil', 'Umum', 'fiqq', 'ainurrofik', NULL, '2022-09-10 14:57:47', '2022-09-10 15:09:04', NULL),
(3, 'Penggunaan', '5', 'tes', 'Ditolak', 'IT', 'fiqq', 'fiqq', 'deskripsi tidak jelas', '2022-09-23 09:17:24', '2022-10-07 11:58:54', NULL),
(4, 'Mutasi', '6', 'tes mutasi', 'Berhasil', 'Umum', 'fiqq', NULL, NULL, '2022-10-11 11:14:31', NULL, NULL),
(5, 'Mutasi', '5', 'tes', 'Berhasil', 'Umum', 'fiqq', NULL, NULL, '2022-10-11 15:13:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pairwisekriteria`
--

CREATE TABLE `pairwisekriteria` (
  `id_pairwise` int(5) UNSIGNED NOT NULL,
  `fuzzy_id` varchar(10) DEFAULT NULL,
  `kriteria_kolom` varchar(10) DEFAULT NULL,
  `kriteria_baris` varchar(10) DEFAULT NULL,
  `value` decimal(10,4) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pairwisekriteria`
--

INSERT INTO `pairwisekriteria` (`id_pairwise`, `fuzzy_id`, `kriteria_kolom`, `kriteria_baris`, `value`, `deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, '1', 'C0002', 'C0002', '1.0000', '', '2022-08-20 19:02:21', '2022-08-21 22:38:57', NULL),
(8, '0', 'C0002', 'C0003', '0.5000', '', '2022-08-20 19:02:21', '2022-09-26 01:07:58', NULL),
(9, '1', 'C0002', 'C0004', '1.0000', '', '2022-08-20 19:02:21', '2022-09-26 01:07:58', NULL),
(11, '2', 'C0003', 'C0002', '2.0000', '', '2022-08-20 19:02:21', '2022-09-26 01:07:58', NULL),
(12, '1', 'C0003', 'C0003', '1.0000', '', '2022-08-20 19:02:21', '2022-08-21 22:38:57', NULL),
(13, '2', 'C0003', 'C0004', '2.0000', '', '2022-08-20 19:02:21', '2022-09-26 01:07:58', NULL),
(15, '1', 'C0004', 'C0002', '1.0000', '', '2022-08-20 19:02:21', '2022-09-26 01:07:58', NULL),
(16, '0', 'C0004', 'C0003', '0.5000', '', '2022-08-20 19:02:21', '2022-09-26 01:07:58', NULL),
(17, '1', 'C0004', 'C0004', '1.0000', '', '2022-08-20 19:02:21', '2022-08-21 22:38:57', NULL),
(61, '0', 'C0001', 'C0002', '0.3333', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL),
(62, '0', 'C0001', 'C0003', '0.2000', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL),
(63, '0', 'C0001', 'C0004', '0.3333', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL),
(64, '3', 'C0002', 'C0001', '3.0000', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL),
(65, '5', 'C0003', 'C0001', '5.0000', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL),
(66, '3', 'C0004', 'C0001', '3.0000', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL),
(67, '1', 'C0001', 'C0001', '1.0000', '', '2022-10-05 10:25:41', '2022-10-05 11:16:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pic`
--

CREATE TABLE `pic` (
  `pic_id` int(5) UNSIGNED NOT NULL,
  `pic_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pic`
--

INSERT INTO `pic` (`pic_id`, `pic_name`) VALUES
(1, 'Kantor Pusat - PIC IT'),
(2, 'Kantor Pusat - PIC UMUM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(5) UNSIGNED NOT NULL,
  `parent_id_product` varchar(50) DEFAULT NULL,
  `kode_content_product` varchar(50) NOT NULL,
  `content_product` varchar(50) NOT NULL,
  `jenis_product` varchar(50) DEFAULT NULL,
  `pj_departement` varchar(50) DEFAULT NULL,
  `deskripsi_product` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `parent_id_product`, `kode_content_product`, `content_product`, `jenis_product`, `pj_departement`, `deskripsi_product`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'A', 'Meubelair', NULL, NULL, 'tes deskripsi', '3', '2022-01-30 06:52:55', '2022-08-08 15:12:07', NULL),
(2, '1', '1', 'Meja Kerja Direksi', 'Umum', NULL, 'Deskripsi TES', '3', '2022-01-30 08:33:31', '2022-08-08 18:49:29', NULL),
(3, NULL, 'B', 'Mesin Ketik / Komputer / Peralatan Tata usaha', NULL, NULL, '', '3', '2022-01-30 13:30:47', '2022-01-30 14:23:45', NULL),
(4, '3', '1', 'Mesin Ketik Mekanik', 'IT', NULL, '', '3', '2022-01-30 13:32:11', '2022-08-17 10:08:20', NULL),
(5, '3', '7', 'Printer', 'IT', NULL, '', '3', '2022-01-30 14:40:43', '2022-08-17 10:08:25', NULL),
(6, NULL, 'KT', 'Kertas', NULL, NULL, '', '3', '2022-02-02 09:26:22', '2022-02-02 09:26:22', NULL),
(7, '6', '2', 'Kertas A4', 'Umum', NULL, '', '3', '2022-02-02 09:26:41', '2022-03-07 23:07:19', NULL),
(8, NULL, 'C', 'TES', NULL, NULL, 'TES', 'fiqq', '2022-08-08 08:37:11', '2022-08-08 08:37:11', NULL),
(9, '6', '5', 'Kertas F4', 'Umum', NULL, 'kertas F4', 'fiqq', '2022-08-08 13:05:09', '2022-08-08 13:13:36', NULL),
(10, '8', '6', 'TESchild', 'IT', NULL, 'TES Deskripsi', 'fiqq', '2022-08-08 13:14:43', '2022-08-08 13:58:01', '2022-08-08 13:58:01'),
(11, NULL, 'D', 'TES', NULL, NULL, '', 'fiqq', '2022-10-04 20:54:27', '2022-10-04 20:54:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id_supplier` int(5) UNSIGNED NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `email_supplier` varchar(50) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `contact1` varchar(50) NOT NULL,
  `contact2` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id_supplier`, `supplier`, `email_supplier`, `alamat`, `contact1`, `contact2`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PT Tokopedia', 'demo@1410inc.xyz', 'Simo Gunung Kramat Timur 7/16E', '121212', '083115759401', '2022-01-31 08:38:16', '2022-01-31 10:01:25', NULL),
(2, 'PT Shoppee', 'shoppe@shoppe.ac.id', 'shope no tes', '08123', '0', '2022-08-09 09:43:56', '2022-08-09 12:00:17', '2022-08-09 12:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `unitkerja`
--

CREATE TABLE `unitkerja` (
  `id_unitkerja` int(5) UNSIGNED NOT NULL,
  `parent_id_unitkerja` varchar(50) DEFAULT NULL,
  `kode_unitkerja` varchar(50) NOT NULL,
  `unitkerja` varchar(50) NOT NULL,
  `depth_unitkerja` int(11) NOT NULL,
  `status_unitkerja` enum('Aktif','Tidak Aktif','Pending') NOT NULL DEFAULT 'Aktif',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unitkerja`
--

INSERT INTO `unitkerja` (`id_unitkerja`, `parent_id_unitkerja`, `kode_unitkerja`, `unitkerja`, `depth_unitkerja`, `status_unitkerja`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'KP', 'Head Office PMS', 0, 'Tidak Aktif', '2022-01-27 07:01:49', '2022-09-21 22:32:27', NULL),
(2, NULL, 'KP', 'Head Office Nilam', 0, 'Aktif', '2022-01-27 07:01:49', '2022-01-27 07:01:49', NULL),
(3, NULL, 'KC', 'Kantor Cabang Depo Transhipment', 0, 'Aktif', '2022-01-27 07:01:49', '2022-01-27 07:01:49', NULL),
(4, NULL, 'KC', 'Kantor Cabang Depo IP', 0, 'Aktif', '2022-01-27 07:01:49', '2022-01-27 07:01:49', NULL),
(5, '1', 'DIR', 'Ruangan Direksi', 1, 'Aktif', '2022-01-27 07:01:49', '2022-03-05 13:24:39', NULL),
(6, '1', 'DIR', 'Ruangan Direktur Utama', 1, 'Aktif', '2022-01-27 07:01:49', '2022-01-27 07:01:49', NULL),
(7, '2', 'SMOPS', 'Ruangan Manager Operasional', 1, 'Aktif', '2022-01-27 07:01:49', '2022-01-27 07:01:49', NULL),
(8, NULL, 'KC', 'Kantor Cabang Depo CDC 4', 0, 'Aktif', '2022-01-27 07:02:46', '2022-01-27 07:03:57', NULL),
(9, '2', 'SOPS', 'Ruangan Staff Operasional', 1, 'Aktif', '2022-01-27 07:02:55', '2022-01-27 07:02:55', NULL),
(10, NULL, 'KC', 'Kantor Cabang Depo CDC 2', 0, 'Aktif', '2022-01-29 11:40:43', '2022-01-29 11:40:43', NULL),
(11, '10', 'ROLS', 'Ruangan Operator Lapangan', 1, 'Aktif', '2022-01-29 11:41:12', '2022-10-01 14:28:42', NULL),
(14, '2', 'GD', 'Ruangan Gudang', 1, 'Tidak Aktif', '2022-01-29 17:03:50', '2022-07-29 09:55:16', NULL),
(15, NULL, 'KC', 'Kantor Cabang Depo CDC 3', 0, 'Aktif', '2022-03-07 22:57:41', '2022-08-01 13:13:43', '2022-08-01 13:13:43'),
(16, NULL, 'KC', 'Kantor Cabang', 0, 'Tidak Aktif', '2022-07-24 16:34:36', '2022-08-01 06:04:34', '2022-08-01 06:04:34'),
(17, NULL, 'KC', 'Kantor Cabang Depo CDC 3', 0, 'Aktif', '2022-07-24 19:32:18', '2022-08-01 13:13:43', '2022-08-01 13:13:43'),
(18, NULL, 'KC', 'Kantor Cabang Depo CDC 4', 0, 'Aktif', '2022-07-27 13:28:26', '2022-08-01 13:10:16', '2022-08-01 13:10:16'),
(19, '1', 'GD', 'Ruangan Gudang PMS', 1, 'Aktif', '2022-08-01 21:38:48', '2022-08-03 08:19:29', NULL),
(31, '1', 'GD', 'Ruangan Gudang Baru', 1, 'Tidak Aktif', '2022-08-01 22:51:49', '2022-08-03 08:18:02', '2022-08-03 08:18:02'),
(32, NULL, 'tes', 'tes', 0, 'Tidak Aktif', '2022-08-14 16:55:33', '2022-08-14 16:55:49', NULL),
(33, '2', 'TES', 'TES', 1, 'Tidak Aktif', '2022-08-14 16:56:57', '2022-10-01 14:04:27', '2022-10-01 14:04:27'),
(34, NULL, 'tes', 'tes1', 0, 'Tidak Aktif', '2022-09-24 10:07:27', '2022-09-27 12:54:16', '2022-09-27 12:54:16'),
(35, NULL, 'tes', 'tes1', 0, 'Tidak Aktif', '2022-09-24 10:08:04', '2022-09-27 12:54:16', '2022-09-27 12:54:16'),
(36, NULL, 'KC1', 'tes2', 0, 'Aktif', '2022-09-24 14:14:29', '2022-09-27 12:16:21', '2022-09-27 12:16:21'),
(37, NULL, 'KC2', 'Kantor Cabang Depo CDC 5', 0, 'Tidak Aktif', '2022-09-27 12:15:04', '2022-09-27 12:54:16', '2022-09-27 12:54:16'),
(38, NULL, 'KC3', 'tes2', 0, 'Tidak Aktif', '2022-09-27 17:38:58', '2022-09-27 17:38:58', NULL),
(39, NULL, 'PT', 'berkah abadi', 0, 'Aktif', '2022-09-30 10:19:33', '2022-09-30 10:49:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id_unit` int(5) UNSIGNED NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `nama_unit` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jenis_unit` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id_unit`, `product_id`, `brand`, `nama_unit`, `satuan`, `jenis_unit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2', 'Polo', 'Meja Kerja Direksi Warna hitam', 'unit', 'Tidak Habis Pakai', '2022-01-30 17:40:17', '2022-08-09 08:40:16', NULL),
(2, '2', 'Toshiba', 'Meja Kerja Direksi Warna Biru', 'unit', 'Tidak Habis Pakai', '2022-01-31 08:36:05', '2022-02-01 11:18:02', NULL),
(3, '5', 'Canon', 'Printer Pixma L3150', 'unit', 'Tidak Habis Pakai', '2022-02-01 06:49:13', '2022-02-01 11:18:05', NULL),
(4, '7', 'Sidu', 'Kertas A4 Sidu', 'dus', 'Habis Pakai', '2022-02-02 09:27:16', '2022-02-02 09:27:16', NULL),
(5, '7', 'SUDI', 'Kertas A4 SUDI', 'dus', 'Habis Pakai', '2022-02-25 05:43:54', '2022-02-25 05:45:26', NULL),
(6, '7', 'SIDU', 'Kertas A4 sachetan', 'sachet', 'Habis Pakai', '2022-08-09 07:33:03', '2022-08-09 07:33:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `karyawan_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `karyawan_id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '3', 'ainurrofik989@gmail.com', 'fiqq', '$2y$10$c0JhjoIGO0TF/f3qfN5CI./CMjv8xewjTso/DVv/rqQ/AOCRszZ.i', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-07-08 11:24:29', '2022-07-08 11:24:29', NULL),
(3, '2', 'mohamatainur@gmail.com', 'jeconiaa', '$2y$10$3eWQ80PpgUOopz35mOghteE00ElFIu.s/dOhLhNdnvgfEwo.PXMDS', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-08-04 20:58:47', '2022-08-04 20:58:47', NULL),
(4, '1', 'jeconia@gmail.com', 'ainurrofik', '$2y$10$KU.TEO1t6A1XNiHNVaHivu6Wob0NKw5vPz2EaC.GnmJt9dtGLpPvK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2022-08-04 23:09:14', '2022-08-04 23:09:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `bobotkriteria`
--
ALTER TABLE `bobotkriteria`
  ADD PRIMARY KEY (`id_bobotkriteria`);

--
-- Indexes for table `dataorder`
--
ALTER TABLE `dataorder`
  ADD PRIMARY KEY (`id_dataorder`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailunits`
--
ALTER TABLE `detailunits`
  ADD PRIMARY KEY (`id_detailunit`);

--
-- Indexes for table `fuzzykriteria`
--
ALTER TABLE `fuzzykriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuzzymaster`
--
ALTER TABLE `fuzzymaster`
  ADD PRIMARY KEY (`id_fuzzy`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `logactivities`
--
ALTER TABLE `logactivities`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `pairwisekriteria`
--
ALTER TABLE `pairwisekriteria`
  ADD PRIMARY KEY (`id_pairwise`);

--
-- Indexes for table `pic`
--
ALTER TABLE `pic`
  ADD PRIMARY KEY (`pic_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `unitkerja`
--
ALTER TABLE `unitkerja`
  ADD PRIMARY KEY (`id_unitkerja`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bobotkriteria`
--
ALTER TABLE `bobotkriteria`
  MODIFY `id_bobotkriteria` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dataorder`
--
ALTER TABLE `dataorder`
  MODIFY `id_dataorder` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `detailunits`
--
ALTER TABLE `detailunits`
  MODIFY `id_detailunit` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `fuzzykriteria`
--
ALTER TABLE `fuzzykriteria`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuzzymaster`
--
ALTER TABLE `fuzzymaster`
  MODIFY `id_fuzzy` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id_karyawan` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4294967296;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `logactivities`
--
ALTER TABLE `logactivities`
  MODIFY `id_log` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pairwisekriteria`
--
ALTER TABLE `pairwisekriteria`
  MODIFY `id_pairwise` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `pic`
--
ALTER TABLE `pic`
  MODIFY `pic_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id_supplier` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unitkerja`
--
ALTER TABLE `unitkerja`
  MODIFY `id_unitkerja` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id_unit` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
