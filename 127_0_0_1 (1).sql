-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2022 at 02:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ici`
--
CREATE DATABASE IF NOT EXISTS `ici` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `ici`;

-- --------------------------------------------------------

--
-- Table structure for table `bitacora`
--

CREATE TABLE `bitacora` (
  `IDSESION` int(11) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `FECHAINICIO` timestamp NOT NULL DEFAULT current_timestamp(),
  `FECHAFIN` timestamp NOT NULL DEFAULT current_timestamp(),
  `HOST` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bitacora`
--

INSERT INTO `bitacora` (`IDSESION`, `IDUSUARIO`, `FECHAINICIO`, `FECHAFIN`, `HOST`) VALUES
(1, 2, '2022-04-25 20:28:31', '2022-04-28 23:24:09', 'HOSTDEPRUEBA'),
(2, 2, '2022-04-25 20:29:42', '2022-04-25 20:29:42', '::1'),
(3, 2, '2022-04-25 20:34:52', '2022-04-25 20:34:52', '::1'),
(4, 2, '2022-04-25 20:35:48', '2022-04-25 20:35:48', '::1'),
(5, 1, '2022-04-25 20:36:04', '2022-04-25 20:36:04', '::1'),
(6, 2, '2022-04-25 20:38:13', '2022-04-25 20:38:13', '::1'),
(7, 1, '2022-04-25 20:46:47', '2022-04-25 20:46:47', '::1'),
(8, 1, '2022-04-25 20:47:23', '2022-04-25 20:47:23', '::1'),
(9, 2, '2022-04-25 20:47:33', '2022-04-25 20:47:33', '::1'),
(10, 1, '2022-04-25 20:49:23', '2022-04-25 20:49:23', '::1'),
(11, 1, '2022-04-25 20:50:16', '2022-04-25 20:50:16', '::1'),
(12, 1, '2022-04-25 20:50:57', '2022-04-25 20:50:57', '::1'),
(13, 2, '2022-04-25 20:51:16', '2022-04-25 20:51:16', '::1'),
(14, 1, '2022-04-25 20:54:26', '2022-04-25 20:54:26', '::1'),
(15, 2, '2022-04-26 00:47:04', '2022-04-26 00:47:04', '::1'),
(16, 1, '2022-04-26 00:56:24', '2022-04-26 00:56:24', '::1'),
(17, 1, '2022-04-26 01:01:10', '2022-04-26 01:01:10', '::1'),
(18, 2, '2022-04-26 01:02:46', '2022-04-26 01:02:46', '::1'),
(19, 2, '2022-04-26 01:03:26', '2022-04-26 01:03:26', '::1'),
(20, 2, '2022-04-26 01:03:45', '2022-04-26 01:03:45', '::1'),
(21, 2, '2022-04-26 01:04:05', '2022-04-26 01:04:05', '::1'),
(22, 2, '2022-04-26 01:04:14', '2022-04-26 01:04:14', '::1'),
(23, 2, '2022-04-26 01:04:27', '2022-04-26 01:04:27', '::1'),
(24, 2, '2022-04-26 01:04:32', '2022-04-26 01:04:32', '::1'),
(25, 2, '2022-04-26 01:05:48', '2022-04-26 01:05:48', '::1'),
(26, 2, '2022-04-26 01:06:17', '2022-04-26 01:06:17', '::1'),
(27, 1, '2022-04-26 01:12:52', '2022-04-26 01:12:52', '::1'),
(28, 2, '2022-04-26 01:13:25', '2022-04-26 01:13:25', '::1'),
(29, 2, '2022-04-26 01:14:17', '2022-04-26 01:14:17', '::1'),
(30, 2, '2022-04-26 01:15:26', '2022-04-26 01:15:26', '::1'),
(31, 2, '2022-04-26 01:15:41', '2022-04-26 01:15:41', '::1'),
(32, 2, '2022-04-26 01:16:08', '2022-04-26 01:16:08', '::1'),
(33, 2, '2022-04-26 01:16:29', '2022-04-26 01:16:29', '::1'),
(34, 2, '2022-04-26 01:17:01', '2022-04-26 01:17:01', '::1'),
(35, 2, '2022-04-26 01:17:13', '2022-04-26 01:17:13', '::1'),
(36, 2, '2022-04-26 01:18:30', '2022-04-26 01:18:30', '::1'),
(37, 2, '2022-04-26 01:18:46', '2022-04-26 01:18:46', '::1'),
(38, 2, '2022-04-26 01:21:02', '2022-04-26 01:21:02', '::1'),
(39, 3, '2022-04-26 01:21:35', '2022-04-26 01:21:35', '::1'),
(40, 4, '2022-04-26 01:22:20', '2022-04-26 01:22:20', '::1'),
(41, 2, '2022-04-26 01:25:29', '2022-04-26 01:25:29', '::1'),
(42, 2, '2022-04-26 01:37:59', '2022-04-26 01:37:59', '::1'),
(43, 2, '2022-04-26 01:38:22', '2022-04-26 01:38:22', '::1'),
(44, 3, '2022-04-26 01:53:06', '2022-04-26 01:53:06', '::1'),
(45, 3, '2022-04-26 01:54:21', '2022-04-26 01:54:21', '::1'),
(46, 4, '2022-04-26 01:59:53', '2022-04-26 01:59:53', '::1'),
(47, 4, '2022-04-26 02:05:07', '2022-04-26 02:05:07', '::1'),
(48, 2, '2022-04-26 02:05:15', '2022-04-26 02:05:15', '::1'),
(49, 3, '2022-04-26 02:05:22', '2022-04-26 02:05:22', '::1'),
(50, 2, '2022-04-26 02:11:44', '2022-04-26 02:11:44', '::1'),
(51, 3, '2022-04-28 23:06:52', '2022-04-28 23:06:52', '::1'),
(52, 2, '2022-04-28 23:07:00', '2022-04-28 23:07:00', '::1'),
(53, 1, '2022-04-28 23:15:58', '2022-04-28 23:15:58', '::1'),
(54, 2, '2022-04-28 23:36:18', '2022-04-28 23:36:18', '::1'),
(55, 2, '2022-04-28 23:37:35', '2022-04-28 23:37:35', '::1'),
(56, 3, '2022-04-28 23:38:49', '2022-04-28 23:38:49', '::1'),
(57, 2, '2022-04-28 23:40:02', '2022-04-28 23:40:02', '::1'),
(58, 4, '2022-04-28 23:40:22', '2022-04-28 23:40:22', '::1'),
(59, 2, '2022-04-28 23:42:17', '2022-04-28 23:42:17', '::1'),
(60, 4, '2022-04-28 23:43:16', '2022-04-28 23:43:16', '::1'),
(61, 3, '2022-04-28 23:44:53', '2022-04-28 23:44:53', '::1'),
(62, 2, '2022-04-28 23:47:58', '2022-04-28 23:48:04', '::1'),
(63, 1, '2022-04-28 23:48:46', '2022-04-28 23:48:47', '::1'),
(64, 2, '2022-04-28 23:49:52', '2022-04-28 23:49:57', '::1'),
(65, 1, '2022-04-29 00:06:41', '2022-04-29 00:06:44', '::1'),
(66, 1, '2022-04-29 00:07:25', '2022-04-29 00:09:00', '::1'),
(67, 2, '2022-04-29 00:09:13', '2022-04-29 00:43:00', '::1'),
(68, 2, '2022-04-29 00:43:05', '2022-04-29 00:49:31', '::1'),
(69, 2, '2022-04-29 00:49:34', '2022-04-29 01:03:07', '::1'),
(70, 1, '2022-04-29 01:03:11', '2022-04-29 02:19:58', '::1'),
(71, 2, '2022-04-29 02:20:01', '2022-04-29 02:20:03', '::1'),
(72, 3, '2022-04-29 02:20:12', '2022-04-29 02:25:36', '::1'),
(73, 4, '2022-04-29 02:25:42', '2022-04-29 02:30:25', '::1'),
(74, 1, '2022-04-29 02:30:31', '2022-04-29 02:38:37', '::1'),
(75, 4, '2022-04-29 02:38:42', '2022-04-29 02:38:46', '::1'),
(76, 3, '2022-04-29 02:38:56', '2022-04-29 02:39:06', '::1'),
(77, 1, '2022-04-29 02:42:01', '2022-04-29 02:42:28', '::1'),
(78, 3, '2022-04-29 02:49:21', '2022-04-29 02:49:21', '::1'),
(79, 2, '2022-05-02 21:23:27', '2022-05-02 21:23:30', '::1'),
(80, 3, '2022-05-02 21:23:33', '2022-05-02 21:34:17', '::1'),
(81, 1, '2022-05-02 21:35:49', '2022-05-02 21:38:59', '::1'),
(82, 3, '2022-05-02 21:47:49', '2022-05-02 22:06:04', '::1'),
(83, 1, '2022-05-02 22:06:31', '2022-05-02 22:06:42', '::1'),
(84, 3, '2022-05-02 22:06:45', '2022-05-02 22:39:43', '::1'),
(85, 1, '2022-05-02 22:39:52', '2022-05-02 22:40:45', '::1'),
(86, 4, '2022-05-02 22:40:51', '2022-05-02 22:40:57', '::1'),
(87, 3, '2022-05-02 22:41:04', '2022-05-02 22:43:02', '::1'),
(88, 5, '2022-05-02 22:44:25', '2022-05-02 22:44:28', '::1'),
(89, 6, '2022-05-02 22:45:36', '2022-05-02 22:46:32', '::1'),
(90, 3, '2022-05-02 22:46:37', '2022-05-02 23:41:53', '::1'),
(91, 1, '2022-05-02 23:41:58', '2022-05-02 23:41:58', '::1'),
(92, 3, '2022-05-03 14:39:11', '2022-05-03 14:39:15', '::1'),
(93, 1, '2022-05-03 14:39:19', '2022-05-03 14:44:17', '::1'),
(94, 1, '2022-05-03 14:44:21', '2022-05-03 14:44:29', '::1'),
(95, 1, '2022-05-03 14:45:02', '2022-05-03 14:45:02', '::1'),
(96, 5, '2022-05-03 14:46:57', '2022-05-03 14:49:23', '::1'),
(97, 5, '2022-05-03 14:48:13', '2022-05-03 14:48:13', '127.0.0.1'),
(98, 5, '2022-05-03 14:49:37', '2022-05-03 14:54:18', '::1'),
(99, 2, '2022-05-03 14:59:15', '2022-05-03 14:59:19', '::1'),
(100, 1, '2022-05-03 14:59:24', '2022-05-03 15:00:07', '::1'),
(101, 1, '2022-05-03 15:00:59', '2022-05-03 15:04:53', '::1'),
(102, 1, '2022-05-03 15:06:02', '2022-05-03 15:06:13', '::1'),
(103, 1, '2022-05-03 15:07:40', '2022-05-03 17:09:17', '::1'),
(104, 1, '2022-05-03 17:09:22', '2022-05-03 17:11:13', '::1'),
(105, 1, '2022-05-03 17:11:18', '2022-05-03 17:11:18', '::1'),
(106, 5, '2022-05-05 14:44:51', '2022-05-05 15:27:11', '127.0.0.1'),
(107, 1, '2022-05-05 15:27:44', '2022-05-05 15:27:44', '127.0.0.1'),
(108, 1, '2022-05-09 16:45:25', '2022-05-09 16:45:25', '::1'),
(109, 1, '2022-05-11 15:40:12', '2022-05-11 17:15:50', '::1'),
(110, 1, '2022-05-11 23:13:19', '2022-05-11 23:13:19', '::1'),
(111, 1, '2022-05-19 02:34:19', '2022-05-19 02:34:39', '::1'),
(112, 1, '2022-05-19 03:32:25', '2022-05-19 03:33:19', '::1'),
(113, 4, '2022-05-19 03:33:36', '2022-05-19 03:33:36', '::1'),
(114, 3, '2022-05-19 14:19:08', '2022-05-19 14:19:14', '::1'),
(115, 4, '2022-05-19 14:19:17', '2022-05-19 21:31:34', '::1'),
(116, 1, '2022-05-20 19:10:15', '2022-05-20 19:10:19', '::1'),
(117, 4, '2022-05-20 19:11:11', '2022-05-26 15:41:23', '::1'),
(118, 4, '2022-05-26 15:41:30', '2022-05-26 15:42:00', '::1'),
(119, 4, '2022-05-26 15:42:05', '2022-05-26 15:42:13', '::1'),
(120, 3, '2022-05-26 15:42:16', '2022-05-26 15:42:16', '::1'),
(121, 2, '2022-06-20 15:51:21', '2022-06-20 15:53:19', '::1'),
(122, 3, '2022-06-20 15:53:22', '2022-06-20 15:53:32', '::1'),
(123, 4, '2022-06-20 15:53:36', '2022-06-20 15:54:34', '::1'),
(124, 2, '2022-06-20 17:49:42', '2022-06-20 17:49:42', '::1'),
(125, 2, '2022-06-20 17:51:11', '2022-06-20 18:42:04', '::1'),
(126, 2, '2022-06-20 18:42:14', '2022-06-20 18:42:14', '127.0.0.1'),
(127, 2, '2022-06-20 18:42:43', '2022-06-20 18:46:42', '::1'),
(128, 2, '2022-06-20 18:48:28', '2022-06-20 22:21:06', '::1'),
(129, 2, '2022-06-20 22:51:25', '2022-06-20 22:56:48', '::1'),
(130, 2, '2022-06-20 22:56:51', '2022-06-20 22:57:13', '::1'),
(131, 2, '2022-06-20 22:58:54', '2022-06-20 22:59:15', '::1'),
(132, 2, '2022-06-20 23:01:00', '2022-06-20 23:01:20', '::1'),
(133, 2, '2022-06-20 23:02:49', '2022-06-20 23:04:01', '::1'),
(134, 2, '2022-06-20 23:05:00', '2022-06-20 23:06:26', '::1'),
(135, 2, '2022-06-20 23:31:20', '2022-06-20 23:31:20', '::1'),
(136, 2, '2022-06-20 23:33:35', '2022-06-20 23:37:01', '::1'),
(137, 2, '2022-06-20 23:37:03', '2022-06-20 23:37:03', '::1'),
(138, 3, '2022-06-20 23:39:06', '2022-06-21 00:30:21', '::1'),
(139, 3, '2022-06-21 00:30:28', '2022-06-21 00:42:23', '::1'),
(140, 3, '2022-06-21 00:42:31', '2022-06-21 02:19:23', '::1'),
(141, 3, '2022-06-21 02:19:26', '2022-06-21 02:47:46', '::1'),
(142, 3, '2022-06-21 02:47:48', '2022-06-21 03:06:14', '::1'),
(143, 3, '2022-06-21 03:12:38', '2022-06-21 03:17:30', '::1'),
(144, 4, '2022-06-21 03:17:33', '2022-06-21 03:18:28', '::1'),
(145, 3, '2022-06-21 03:18:34', '2022-06-21 03:28:35', '::1'),
(146, 4, '2022-06-21 03:28:37', '2022-06-21 03:29:01', '::1'),
(147, 4, '2022-06-21 03:30:01', '2022-06-21 03:30:07', '::1'),
(148, 3, '2022-06-21 03:30:09', '2022-06-21 03:30:09', '::1'),
(149, 3, '2022-06-23 14:50:40', '2022-06-23 14:51:34', '::1'),
(150, 2, '2022-06-23 14:56:07', '2022-06-23 15:18:37', '::1'),
(151, 2, '2022-06-23 15:18:40', '2022-06-23 15:19:22', '::1'),
(152, 2, '2022-06-23 15:19:24', '2022-06-23 15:25:50', '::1'),
(153, 2, '2022-06-23 15:25:53', '2022-06-23 15:27:07', '::1'),
(154, 3, '2022-06-23 15:27:10', '2022-06-23 16:02:09', '::1'),
(155, 3, '2022-06-23 16:02:13', '2022-06-23 16:36:40', '::1'),
(156, 3, '2022-06-23 17:07:55', '2022-06-23 17:39:02', '::1'),
(157, 3, '2022-06-23 18:11:28', '2022-06-23 20:07:24', '::1'),
(158, 3, '2022-06-23 20:07:27', '2022-06-23 22:16:48', '::1'),
(159, 3, '2022-06-23 22:16:51', '2022-06-23 23:42:12', '::1'),
(160, 3, '2022-06-23 23:42:15', '2022-06-23 23:49:34', '::1'),
(161, 2, '2022-06-23 23:49:37', '2022-06-23 23:49:37', '::1'),
(162, 2, '2022-06-29 21:36:35', '2022-06-29 22:16:43', '::1'),
(163, 2, '2022-06-29 22:16:47', '2022-06-29 22:18:50', '::1'),
(164, 3, '2022-06-29 22:18:52', '2022-06-29 22:23:09', '::1'),
(165, 2, '2022-06-29 22:23:12', '2022-06-29 23:40:34', '::1'),
(166, 2, '2022-06-29 23:40:37', '2022-06-30 00:03:33', '::1'),
(167, 2, '2022-06-30 00:03:37', '2022-06-30 00:04:44', '::1'),
(168, 2, '2022-06-30 00:04:50', '2022-06-30 00:13:16', '::1'),
(169, 2, '2022-06-30 00:13:36', '2022-06-30 00:15:02', '::1'),
(170, 2, '2022-06-30 00:15:05', '2022-06-30 00:15:05', '::1'),
(171, 2, '2022-07-04 22:30:08', '2022-07-04 22:30:24', '::1'),
(172, 3, '2022-07-04 22:30:26', '2022-07-04 22:30:53', '::1'),
(173, 2, '2022-07-04 22:30:56', '2022-07-04 22:41:35', '::1'),
(174, 2, '2022-07-04 22:41:41', '2022-07-04 22:44:29', '::1'),
(175, 3, '2022-07-04 22:44:32', '2022-07-04 22:49:42', '::1'),
(176, 2, '2022-07-04 22:49:45', '2022-07-04 22:51:15', '::1'),
(177, 3, '2022-07-04 22:51:22', '2022-07-04 22:53:06', '::1'),
(178, 2, '2022-07-04 22:53:09', '2022-07-04 22:54:12', '::1'),
(179, 3, '2022-07-04 22:54:15', '2022-07-04 22:54:50', '::1'),
(180, 2, '2022-07-04 22:54:53', '2022-07-04 23:04:08', '::1'),
(181, 2, '2022-07-05 16:39:10', '2022-07-05 16:39:10', '::1'),
(182, 11, '2022-07-06 00:44:05', '2022-07-06 00:44:08', '::1'),
(183, 11, '2022-07-06 00:44:56', '2022-07-06 00:45:09', '::1'),
(184, 2, '2022-07-08 21:57:39', '2022-07-08 22:35:07', '127.0.0.1'),
(185, 2, '2022-07-08 22:35:12', '2022-07-08 22:54:27', '127.0.0.1'),
(186, 3, '2022-07-08 22:56:45', '2022-07-08 23:01:43', '127.0.0.1'),
(187, 2, '2022-07-08 23:02:43', '2022-07-08 23:02:43', '127.0.0.1'),
(188, 2, '2022-07-11 23:28:44', '2022-07-12 00:33:17', '127.0.0.1'),
(189, 2, '2022-07-12 00:33:26', '2022-07-12 00:38:54', '::1'),
(190, 2, '2022-07-12 00:38:58', '2022-07-12 00:39:21', '::1'),
(191, 2, '2022-07-12 00:39:28', '2022-07-12 00:40:55', '::1'),
(192, 2, '2022-07-12 00:52:20', '2022-07-12 00:52:21', '::1'),
(193, 1, '2022-07-12 02:00:00', '2022-07-12 02:01:40', '::1'),
(194, 3, '2022-07-12 02:01:45', '2022-07-12 02:03:28', '::1'),
(195, 1, '2022-07-12 02:03:31', '2022-07-12 02:03:42', '::1'),
(196, 4, '2022-07-12 02:04:04', '2022-07-12 02:06:10', '::1'),
(197, 3, '2022-07-12 02:10:46', '2022-07-12 02:10:46', '::1'),
(198, 3, '2022-07-12 21:34:22', '2022-07-12 21:53:58', '::1'),
(199, 3, '2022-07-12 21:54:03', '2022-07-12 22:32:40', '::1'),
(200, 3, '2022-07-12 22:32:47', '2022-07-12 22:33:00', '::1'),
(201, 3, '2022-07-12 22:34:25', '2022-07-12 22:36:02', '::1'),
(202, 3, '2022-07-12 22:36:38', '2022-07-12 23:17:50', '::1'),
(203, 3, '2022-07-12 23:17:55', '2022-07-13 00:17:21', '::1'),
(204, 3, '2022-07-13 00:17:26', '2022-07-13 00:33:49', '::1'),
(205, 3, '2022-07-13 00:33:55', '2022-07-13 01:26:07', '::1'),
(206, 2, '2022-07-13 01:26:13', '2022-07-13 01:26:13', '::1'),
(207, 3, '2022-07-13 22:27:50', '2022-07-13 22:50:40', '::1'),
(208, 3, '2022-07-13 22:50:43', '2022-07-13 23:35:27', '::1'),
(209, 3, '2022-07-13 23:35:31', '2022-07-13 23:35:31', '::1'),
(210, 3, '2022-07-14 00:03:14', '2022-07-14 00:03:14', '127.0.0.1'),
(211, 3, '2022-07-14 14:33:16', '2022-07-14 14:46:53', '127.0.0.1'),
(212, 2, '2022-07-14 14:46:56', '2022-07-14 15:45:55', '127.0.0.1'),
(213, 2, '2022-07-14 15:46:02', '2022-07-14 15:47:58', '127.0.0.1'),
(214, 3, '2022-07-14 15:48:02', '2022-07-14 16:38:20', '127.0.0.1'),
(215, 3, '2022-07-14 16:38:29', '2022-07-15 02:29:11', '127.0.0.1'),
(216, 3, '2022-07-14 16:58:02', '2022-07-15 02:34:07', '::1'),
(217, 3, '2022-07-15 02:29:17', '2022-07-15 02:33:49', '127.0.0.1'),
(218, 3, '2022-07-15 02:33:57', '2022-07-15 02:33:57', '127.0.0.1'),
(219, 3, '2022-07-15 02:34:14', '2022-07-15 02:41:22', '::1'),
(220, 2, '2022-07-15 02:42:28', '2022-07-15 02:42:51', '::1'),
(221, 2, '2022-07-15 02:43:48', '2022-07-15 02:43:53', '::1'),
(222, 2, '2022-07-15 02:45:01', '2022-07-15 02:47:20', '::1'),
(223, 3, '2022-07-15 02:47:23', '2022-07-15 02:47:23', '::1'),
(224, 3, '2022-07-15 02:50:04', '2022-07-15 02:50:04', '::1'),
(225, 2, '2022-07-15 17:11:30', '2022-07-15 17:12:57', '::1'),
(226, 3, '2022-07-15 17:13:01', '2022-07-15 18:59:23', '::1'),
(227, 2, '2022-07-15 19:11:48', '2022-07-15 19:12:04', '::1'),
(228, 1, '2022-07-15 19:15:25', '2022-07-15 19:15:43', '::1'),
(229, 3, '2022-07-15 20:37:02', '2022-07-15 20:37:07', '::1'),
(230, 3, '2022-07-15 20:50:34', '2022-07-15 20:50:44', '::1'),
(231, 3, '2022-07-15 20:57:12', '2022-07-15 20:59:10', '::1'),
(232, 2, '2022-07-15 22:16:01', '2022-07-15 22:16:01', '::1'),
(233, 2, '2022-07-15 22:16:01', '2022-07-15 22:25:45', '::1'),
(234, 3, '2022-07-15 22:31:28', '2022-07-15 22:31:28', '::1'),
(235, 3, '2022-07-15 22:31:28', '2022-07-15 22:34:33', '::1'),
(236, 2, '2022-07-15 22:50:25', '2022-07-15 22:52:55', '::1'),
(237, 2, '2022-07-15 23:03:33', '2022-07-15 23:03:42', '::1'),
(238, 3, '2022-07-15 23:12:12', '2022-07-15 23:13:05', '::1'),
(239, 3, '2022-07-15 23:25:17', '2022-07-15 23:25:17', '::1'),
(240, 3, '2022-07-18 23:53:39', '2022-07-18 23:59:21', '127.0.0.1'),
(241, 2, '2022-07-18 23:59:26', '2022-07-18 23:59:53', '127.0.0.1'),
(242, 2, '2022-07-19 00:00:18', '2022-07-19 00:05:28', '127.0.0.1'),
(243, 3, '2022-07-19 00:05:32', '2022-07-19 00:05:32', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `configuracion`
--

CREATE TABLE `configuracion` (
  `IDOPCION` int(11) NOT NULL,
  `PARAMETRO` varchar(50) COLLATE utf8_bin NOT NULL,
  `VALOR` varchar(50) COLLATE utf8_bin NOT NULL,
  `DESCRIPCION` varchar(200) COLLATE utf8_bin NOT NULL,
  `ACTIVO` char(2) COLLATE utf8_bin DEFAULT NULL,
  `ACTUALIZADO_POR` int(11) NOT NULL,
  `ULTIMA_ACTUALIZACION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `configuracion`
--

INSERT INTO `configuracion` (`IDOPCION`, `PARAMETRO`, `VALOR`, `DESCRIPCION`, `ACTIVO`, `ACTUALIZADO_POR`, `ULTIMA_ACTUALIZACION`) VALUES
(1, 'expiracion', '900', 'Tiempo de expiración de la sesión dado en segundos', 'SI', 0, '2022-06-20 23:16:36'),
(2, 'notificacion', 'SI', 'Parámetro para activar o desactivar el envío de notificaciones por email', 'SI', 0, '2022-06-20 23:17:45'),
(3, 'registro', 'SI', 'Parámetro para activar o desactivar el registro de usuarios nuevos en la aplicación', 'SI', 0, '2022-06-20 23:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `congresos`
--

CREATE TABLE `congresos` (
  `IDCONGRESO` int(11) NOT NULL,
  `NOMBRE` varchar(300) COLLATE utf8_bin NOT NULL,
  `DETALLES` varchar(500) COLLATE utf8_bin NOT NULL,
  `SEDE` varchar(2000) COLLATE utf8_bin NOT NULL,
  `FECHAINICIO` date DEFAULT NULL,
  `FECHAFIN` date DEFAULT NULL,
  `CREADOPOR` int(11) NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `TITULO` varchar(300) COLLATE utf8_bin NOT NULL,
  `IDPROYECTO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `congresos`
--

INSERT INTO `congresos` (`IDCONGRESO`, `NOMBRE`, `DETALLES`, `SEDE`, `FECHAINICIO`, `FECHAFIN`, `CREADOPOR`, `FECHACREACION`, `TITULO`, `IDPROYECTO`) VALUES
(1, 'Prueba', 'asasasasasas', 'Aguascalientes', '2022-07-13', '2022-08-13', 3, '2022-07-12 22:49:08', 'Diploma', 1),
(7, 'Prueba02', 'aadfdsgdfgdfgdfgdfgdfgdffg', 'Aguascalientes', '2022-07-11', '2022-08-13', 3, '2022-07-12 23:25:40', 'Diploma', 1),
(8, 'Prueba0303', 'ASDASDASDASDASDASDFGDFFDHFGHFGHFGHFGHFGH', 'Aguascalientes', '2022-07-07', '2022-08-13', 3, '2022-07-13 00:17:58', 'Certificado', 4),
(9, 'Desarrollo Web avanzado', 'Lenguaajes de progrmaciÃ³n PHP, AJax, Javascript        ', 'Aguascalientes', '2022-07-14', '2022-07-18', 3, '2022-07-13 00:19:22', 'Titulo', 3),
(10, 'PruebaABC', 'sdfsdfsdfsdfsdfsdsdfs', 'Aguascalientes', '2022-07-13', '2022-08-13', 3, '2022-07-13 00:36:14', 'Diploma', 3),
(11, 'Congreso de estudiantes de ICI', 'Congreso de estudiantes de la carrera ICI', 'Campus Sur', '2022-07-18', '2022-07-22', 3, '2022-07-14 16:18:04', 'Constancia', 1),
(12, '  EvoluciÃ³n de la IA', 'Conferencia sobre la evoluciÃ³n de la IA         ', 'Campus Principal', '2022-07-25', '2022-07-29', 3, '2022-07-15 17:15:46', 'Constancia', 2);

-- --------------------------------------------------------

--
-- Table structure for table `idiomas`
--

CREATE TABLE `idiomas` (
  `IDIDIOMA` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8_bin NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREADOPOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `idiomas`
--

INSERT INTO `idiomas` (`IDIDIOMA`, `NOMBRE`, `FECHACREACION`, `CREADOPOR`) VALUES
(1, 'Espanol', '2022-05-02 23:37:48', 1),
(2, 'Ingles', '2022-05-02 23:37:49', 1),
(3, 'Frances', '2022-05-02 23:37:50', 1),
(4, 'Chino', '2022-05-02 23:37:50', 1),
(5, 'Japones', '2022-05-02 23:37:51', 1),
(6, 'Portugues', '2022-05-02 23:37:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logerrores`
--

CREATE TABLE `logerrores` (
  `IDREGISTRO` int(11) NOT NULL,
  `IDSESION` int(11) NOT NULL,
  `MENSAJE` varchar(500) COLLATE utf8_bin NOT NULL,
  `CODIGO` varchar(200) COLLATE utf8_bin NOT NULL,
  `FECHAERROR` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logerrores`
--

INSERT INTO `logerrores` (`IDREGISTRO`, `IDSESION`, `MENSAJE`, `CODIGO`, `FECHAERROR`) VALUES
(1, 1, 'MENSAJE DE PRUEBA', 'ERROR01', '2022-04-28 23:57:27'),
(3, 1, 'MENSAJE DE PRUEBA 2', 'ERROR03', '2022-04-28 23:59:59'),
(4, 5, 'MENSAJE DE PRUEBA 2', 'ERROR03', '2022-04-29 00:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `lprogramacion`
--

CREATE TABLE `lprogramacion` (
  `IDLENGP` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8_bin NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREADOPOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `lprogramacion`
--

INSERT INTO `lprogramacion` (`IDLENGP`, `NOMBRE`, `FECHACREACION`, `CREADOPOR`) VALUES
(1, 'Git', '2022-05-02 23:24:22', 1),
(2, 'C', '2022-05-02 23:24:24', 1),
(3, 'C++', '2022-05-02 23:24:25', 1),
(4, 'C#', '2022-05-02 23:24:25', 1),
(5, 'Java', '2022-05-02 23:24:26', 1),
(6, 'Javascript', '2022-05-02 23:24:27', 1),
(7, 'Python', '2022-05-02 23:24:28', 1),
(8, 'HTML', '2022-05-02 23:24:28', 1),
(9, 'PHP', '2022-05-02 23:24:29', 1),
(10, 'ASP', '2022-05-02 23:24:30', 1),
(11, 'Perl', '2022-05-02 23:24:30', 1),
(12, 'SQL', '2022-05-02 23:24:31', 1),
(13, 'PL/SQL', '2022-05-02 23:24:32', 1),
(14, 'Visual Basic .Net', '2022-05-02 23:24:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movimientos`
--

CREATE TABLE `movimientos` (
  `IDMOVIMIENTO` int(11) NOT NULL,
  `IDSESION` int(11) NOT NULL,
  `FECHAMOVIMEINTO` timestamp NOT NULL DEFAULT current_timestamp(),
  `TIPOMOVIMIENTO` varchar(300) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `movimientos`
--

INSERT INTO `movimientos` (`IDMOVIMIENTO`, `IDSESION`, `FECHAMOVIMEINTO`, `TIPOMOVIMIENTO`) VALUES
(9, 5, '2022-05-02 21:54:30', 'Prueba'),
(10, 5, '2022-05-02 21:54:43', 'Prueba'),
(14, 82, '2022-05-02 22:01:44', 'UPDATE USUARIOS'),
(15, 82, '2022-05-02 22:05:17', 'UPDATE USUARIOS'),
(16, 84, '2022-05-02 22:07:43', 'UPDATE USUARIOS'),
(17, 84, '2022-05-02 22:22:17', 'UPDATE USUARIOS'),
(18, 84, '2022-05-02 22:38:02', 'UPDATE USUARIOS'),
(19, 89, '2022-05-02 22:46:09', 'UPDATE USUARIOS'),
(20, 108, '2022-05-09 18:28:26', 'UPDATE SKILLS'),
(21, 108, '2022-05-09 18:29:13', 'UPDATE SKILLS'),
(22, 108, '2022-05-09 18:30:39', 'UPDATE SKILLS'),
(23, 108, '2022-05-09 18:32:28', 'UPDATE SKILLS'),
(24, 109, '2022-05-11 15:40:24', 'UPDATE SKILLS'),
(25, 109, '2022-05-11 16:45:33', 'DELETE SKILLS'),
(26, 109, '2022-05-11 16:46:35', 'DELETE SKILLS'),
(27, 109, '2022-05-11 16:47:56', 'DELETE SKILLS'),
(28, 109, '2022-05-11 16:48:57', 'DELETE SKILLS'),
(29, 109, '2022-05-11 17:13:29', 'DELETE SKILLS'),
(30, 109, '2022-05-11 17:13:37', 'DELETE SKILLS'),
(31, 113, '2022-05-19 03:36:20', 'UPDATE USUARIOS'),
(32, 1, '2022-05-19 15:49:05', 'UPDATE USUARIOS - IDROL'),
(33, 1, '2022-05-19 15:51:24', 'UPDATE USUARIOS - IDROL'),
(34, 1, '2022-06-21 03:17:54', 'UPDATE USUARIOS - IDROL'),
(35, 148, '2022-06-21 03:36:18', 'UPDATE USUARIOS'),
(36, 148, '2022-06-21 03:36:28', 'UPDATE USUARIOS'),
(37, 184, '2022-07-08 21:58:15', 'UPDATE SKILLS'),
(38, 185, '2022-07-08 22:38:43', 'UPDATE USUARIOS'),
(39, 185, '2022-07-08 22:38:59', 'UPDATE USUARIOS'),
(40, 185, '2022-07-08 22:39:46', 'UPDATE USUARIOS'),
(41, 185, '2022-07-08 22:41:04', 'UPDATE USUARIOS'),
(42, 185, '2022-07-08 22:47:53', 'UPDATE USUARIOS'),
(43, 185, '2022-07-08 22:48:54', 'UPDATE USUARIOS'),
(44, 185, '2022-07-08 22:50:53', 'UPDATE USUARIOS'),
(45, 186, '2022-07-08 22:56:53', 'UPDATE USUARIOS'),
(46, 186, '2022-07-08 23:01:00', 'UPDATE USUARIOS'),
(47, 187, '2022-07-08 23:02:52', 'UPDATE USUARIOS'),
(48, 187, '2022-07-08 23:04:59', 'UPDATE USUARIOS'),
(49, 187, '2022-07-08 23:05:43', 'UPDATE USUARIOS'),
(50, 188, '2022-07-12 00:04:01', 'UPDATE USUARIOS'),
(51, 193, '2022-07-12 02:01:15', 'UPDATE SKILLS'),
(52, 193, '2022-07-12 02:01:27', 'DELETE SKILLS'),
(53, 193, '2022-07-12 02:01:35', 'DELETE SKILLS'),
(54, 1, '2022-07-12 02:02:33', 'UPDATE USUARIOS - IDROL'),
(55, 1, '2022-07-12 02:02:36', 'UPDATE USUARIOS - IDROL'),
(56, 196, '2022-07-12 02:04:42', 'UPDATE USUARIOS'),
(57, 1, '2022-07-12 02:05:52', 'UPDATE USUARIOS - IDROL'),
(58, 214, '2022-07-14 16:12:53', 'UPDATE USUARIOS'),
(59, 217, '2022-07-15 02:29:29', 'UPDATE USUARIOS'),
(60, 222, '2022-07-15 02:46:13', 'DELETE SKILLS'),
(61, 225, '2022-07-15 17:11:50', 'UPDATE USUARIOS'),
(62, 225, '2022-07-15 17:12:46', 'UPDATE SKILLS'),
(63, 226, '2022-07-15 17:13:22', 'UPDATE USUARIOS'),
(64, 1, '2022-07-15 17:13:36', 'UPDATE USUARIOS - IDROL'),
(65, 1, '2022-07-15 17:13:47', 'UPDATE USUARIOS - IDROL');

-- --------------------------------------------------------

--
-- Table structure for table `niveles`
--

CREATE TABLE `niveles` (
  `IDNIVEL` int(11) NOT NULL,
  `NIVEL` varchar(100) COLLATE utf8_bin NOT NULL,
  `TIPO` varchar(50) COLLATE utf8_bin NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREADOPOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `niveles`
--

INSERT INTO `niveles` (`IDNIVEL`, `NIVEL`, `TIPO`, `FECHACREACION`, `CREADOPOR`) VALUES
(1, 'Nada', 'Idioma', '2022-05-02 23:09:40', 1),
(2, 'Casi nada', 'Idioma', '2022-05-02 23:09:42', 1),
(3, 'Poco', 'Idioma', '2022-05-02 23:09:43', 1),
(4, 'Algo', 'Idioma', '2022-05-02 23:09:43', 1),
(5, 'Mucho', 'Idioma', '2022-05-02 23:09:44', 1),
(6, 'Nativo', 'Idioma', '2022-05-02 23:09:45', 1),
(8, 'Nada', 'Habilidad', '2022-05-02 23:09:46', 1),
(9, 'Casi nada', 'Habilidad', '2022-05-02 23:09:47', 1),
(10, 'Poco', 'Habilidad', '2022-05-02 23:09:48', 1),
(11, 'Algo', 'Habilidad', '2022-05-02 23:09:48', 1),
(12, 'Mucho', 'Habilidad', '2022-05-02 23:09:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ponentes`
--

CREATE TABLE `ponentes` (
  `IDPONENTE` int(11) NOT NULL,
  `IDCONGRESO` int(11) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `ASIGNADOPOR` int(11) NOT NULL,
  `comentarios` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `FECHAASIGNACION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ponentes`
--

INSERT INTO `ponentes` (`IDPONENTE`, `IDCONGRESO`, `IDUSUARIO`, `ASIGNADOPOR`, `comentarios`, `FECHAASIGNACION`) VALUES
(1, 9, 2, 3, NULL, '2022-07-14 15:59:40'),
(2, 7, 5, 3, 'asdasdasdas', '2022-07-15 02:13:29'),
(3, 1, 1, 3, 'Prueba de asignaciÃ³n 02', '2022-07-15 02:15:21'),
(4, 9, 1, 3, 'dasdasdas', '2022-07-15 02:15:50'),
(5, 9, 7, 3, 'sdfsdfsdfsdf', '2022-07-15 02:16:01'),
(6, 9, 7, 3, 'sdfsdfsdfsdf', '2022-07-15 02:16:01'),
(7, 7, 7, 3, 'asdasdasdasdasdasdasd', '2022-07-15 02:19:14'),
(9, 10, 7, 3, 'asdasdasd', '2022-07-15 02:34:34'),
(11, 1, 5, 3, 'asdasdasda', '2022-07-15 02:37:22'),
(12, 1, 6, 3, 'asdasdasd', '2022-07-15 02:37:28'),
(13, 8, 1, 3, 'fgfhghghfghfg ddsfssdf', '2022-07-15 02:48:34'),
(14, 1, 27, 3, 'Prueba', '2022-07-15 02:51:42'),
(15, 12, 1, 3, 'Sugerido para su ponencia', '2022-07-15 17:16:21');

-- --------------------------------------------------------

--
-- Stand-in structure for view `ponentes_v`
-- (See below for the actual view)
--
CREATE TABLE `ponentes_v` (
`idponente` varchar(11)
,`idcongreso` varchar(11)
,`nombre` varchar(300)
,`idusuario` varchar(11)
,`usuario` varchar(401)
,`idasignadopor` varchar(11)
,`asignadopor` varchar(401)
,`fechaasignacion` varchar(19)
);

-- --------------------------------------------------------

--
-- Table structure for table `postulantes`
--

CREATE TABLE `postulantes` (
  `IDVACANTE` int(11) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `FECHAPOSTULACION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `postulantes`
--

INSERT INTO `postulantes` (`IDVACANTE`, `IDUSUARIO`, `FECHAPOSTULACION`) VALUES
(1, 2, '2022-06-29 23:40:43'),
(2, 2, '2022-06-30 00:13:40'),
(4, 2, '2022-06-30 00:15:19'),
(7, 2, '2022-06-30 00:15:48'),
(7, 1, '2022-07-12 02:00:21'),
(8, 1, '2022-07-12 02:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `proyectos`
--

CREATE TABLE `proyectos` (
  `IDPROYECTO` int(11) NOT NULL,
  `IDUSUARIO` int(11) NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `TITULO` varchar(300) COLLATE utf8_bin NOT NULL,
  `DESCRIPCION` varchar(500) COLLATE utf8_bin NOT NULL,
  `ACTIVIDADES` varchar(2000) COLLATE utf8_bin NOT NULL,
  `TIPO` varchar(300) COLLATE utf8_bin NOT NULL,
  `FECHAINICIO` date DEFAULT NULL,
  `FECHAFIN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `proyectos`
--

INSERT INTO `proyectos` (`IDPROYECTO`, `IDUSUARIO`, `FECHACREACION`, `TITULO`, `DESCRIPCION`, `ACTIVIDADES`, `TIPO`, `FECHAINICIO`, `FECHAFIN`) VALUES
(1, 1, '2022-07-12 22:30:53', 'Carga inicial', 'Proyecto de carga inicial', 'Actividades varias', 'Academico', '2022-07-12', '2022-07-17'),
(2, 3, '2022-07-13 00:04:50', 'Conceptos básicos de programación', 'Guia web sobre los conceptos básicos de la lógica de progrmación', 'Publicación de página web', 'Académico', '2022-07-11', '2022-07-22'),
(3, 3, '2022-07-13 00:06:46', 'Conceptos básicos de programación 2', 'Guia web sobre los conceptos básicos de la lógica de progrmación', 'Publicación de página web', 'Evaluación', '2022-07-02', '2022-08-11'),
(4, 3, '2022-07-13 00:15:40', 'Conceptos básicos de programación 3', 'Guia web sobre los conceptos básicos de la lógica de progrmación', 'Publicación de página web', 'Certificación', '2022-07-07', '2022-08-16'),
(5, 4, '2022-07-18 23:16:13', 'Análisis de lenguajes WEB', 'Descipción y principales características de los lenguajes de progrmación web más usados en la actualidad', 'Desarrollo de un artículo web', 'Académico', '2022-07-13', '2022-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `IDROL` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8_bin NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `REGISTRO` char(2) COLLATE utf8_bin NOT NULL,
  `NOTIFICACIONES` char(2) COLLATE utf8_bin NOT NULL,
  `FECHAACTUALIZACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDSESION` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`IDROL`, `NOMBRE`, `FECHACREACION`, `REGISTRO`, `NOTIFICACIONES`, `FECHAACTUALIZACION`, `IDSESION`) VALUES
(1, 'Alumno', '2022-04-25 19:38:20', 'N', 'Y', '2022-04-25 19:38:20', NULL),
(2, 'Profesor', '2022-04-25 19:38:21', 'N', 'Y', '2022-04-25 19:38:21', NULL),
(3, 'Administrador', '2022-04-25 19:38:22', 'Y', 'Y', '2022-04-25 19:38:22', NULL),
(4, 'Registrado', '2022-04-25 19:39:49', 'N', 'N', '2022-04-25 19:39:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `IDSKILL` int(11) NOT NULL,
  `IDUSUARIO` int(11) DEFAULT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREADOPOR` int(11) NOT NULL,
  `IDTECNOLOGIA` int(11) DEFAULT NULL,
  `IDIDIOMA` int(11) DEFAULT NULL,
  `IDNIVEL` int(11) DEFAULT NULL,
  `TIPO` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`IDSKILL`, `IDUSUARIO`, `FECHACREACION`, `CREADOPOR`, `IDTECNOLOGIA`, `IDIDIOMA`, `IDNIVEL`, `TIPO`) VALUES
(2, 1, '2022-05-03 03:17:50', 1, 14, NULL, 12, 'Habilidad'),
(13, 6, '2022-05-03 04:18:24', 6, NULL, 1, 6, 'Idioma'),
(14, 6, '2022-05-03 04:21:25', 6, NULL, 2, 5, 'Idioma'),
(15, 6, '2022-05-03 04:21:45', 6, NULL, 6, 5, 'Idioma'),
(16, 6, '2022-05-03 04:21:56', 6, NULL, 4, 1, 'Idioma'),
(17, 6, '2022-05-03 04:22:08', 6, NULL, 5, 2, 'Idioma'),
(18, 6, '2022-05-03 04:22:14', 6, NULL, 3, 4, 'Idioma'),
(19, 6, '2022-05-03 04:22:19', 6, NULL, NULL, 1, 'Idioma'),
(20, 6, '2022-05-03 04:31:17', 6, 2, NULL, 9, 'Habilidad'),
(21, 6, '2022-05-03 04:38:05', 6, 4, NULL, 9, 'Habilidad'),
(22, 6, '2022-05-03 04:38:10', 6, 5, NULL, 11, 'Habilidad'),
(23, 6, '2022-05-03 04:38:16', 6, 7, NULL, 11, 'Habilidad'),
(24, 6, '2022-05-03 04:38:20', 6, 6, NULL, 11, 'Habilidad'),
(25, 6, '2022-05-03 04:38:24', 6, 8, NULL, 11, 'Habilidad'),
(26, 6, '2022-05-03 04:38:31', 6, 9, NULL, 9, 'Habilidad'),
(27, 6, '2022-05-03 04:38:35', 6, 10, NULL, 12, 'Habilidad'),
(28, 6, '2022-05-03 04:38:39', 6, 11, NULL, 9, 'Habilidad'),
(29, 6, '2022-05-03 04:38:42', 6, 12, NULL, 8, 'Habilidad'),
(30, 6, '2022-05-03 04:38:45', 6, 13, NULL, 8, 'Habilidad'),
(31, 6, '2022-05-03 04:38:50', 6, 14, NULL, 12, 'Habilidad'),
(32, 6, '2022-05-03 04:38:55', 6, 15, NULL, 10, 'Habilidad'),
(33, 6, '2022-05-03 04:44:25', 6, 3, NULL, 9, 'Habilidad'),
(34, 6, '2022-05-03 04:44:49', 6, NULL, NULL, 8, 'Habilidad'),
(35, 1, '2022-05-03 04:53:14', 1, 4, NULL, 9, 'Habilidad'),
(36, 1, '2022-05-03 04:54:14', 1, 6, NULL, 8, 'Habilidad'),
(38, 6, '2022-05-03 04:55:18', 6, 1, NULL, 11, 'Habilidad'),
(41, 1, '2022-05-03 05:42:27', 1, NULL, 5, 5, 'Idioma'),
(42, 1, '2022-05-03 05:42:31', 1, 1, NULL, 12, 'Habilidad'),
(43, 1, '2022-05-03 05:42:35', 1, 3, NULL, 8, 'Habilidad'),
(44, 1, '2022-05-03 05:42:39', 1, 5, NULL, 11, 'Habilidad'),
(47, 1, '2022-05-03 05:42:48', 1, 9, NULL, 12, 'Habilidad'),
(48, 1, '2022-05-03 05:42:51', 1, 10, NULL, 12, 'Habilidad'),
(51, 1, '2022-05-03 05:43:01', 1, 13, NULL, 10, 'Habilidad'),
(52, 5, '2022-05-03 14:04:51', 5, 1, NULL, 9, 'Habilidad'),
(53, 5, '2022-05-03 14:05:10', 5, NULL, 1, 6, 'Idioma'),
(54, 5, '2022-05-03 14:05:21', 5, NULL, 2, 4, 'Idioma'),
(55, 5, '2022-05-03 14:05:36', 5, 15, NULL, 11, 'Habilidad'),
(56, 5, '2022-05-03 14:25:41', 5, 2, NULL, 10, 'Habilidad'),
(57, 5, '2022-05-03 14:25:51', 5, NULL, 6, 5, 'Idioma'),
(58, 5, '2022-05-03 14:29:13', 5, NULL, 4, 1, 'Idioma'),
(59, 5, '2022-05-03 14:29:27', 5, 8, NULL, 12, 'Habilidad'),
(60, 5, '2022-05-03 14:30:29', 5, NULL, 5, 2, 'Idioma'),
(61, 5, '2022-05-03 14:30:37', 5, NULL, 3, 4, 'Idioma'),
(62, 5, '2022-05-03 14:47:07', 5, 5, NULL, 10, 'Habilidad'),
(63, 1, '2022-05-11 17:13:53', 1, 11, NULL, 11, 'Habilidad'),
(64, 1, '2022-05-19 03:32:36', 1, NULL, 2, 3, 'Idioma'),
(65, 2, '2022-06-20 17:51:28', 2, NULL, 2, 5, 'Idioma'),
(66, 2, '2022-06-20 17:51:33', 2, 3, NULL, 12, 'Habilidad'),
(67, 2, '2022-06-20 17:58:40', 2, NULL, 1, 6, 'Idioma'),
(69, 2, '2022-06-20 18:55:35', 2, 1, NULL, 9, 'Habilidad'),
(71, 2, '2022-06-20 21:26:52', 2, 2, NULL, 8, 'Habilidad'),
(72, 2, '2022-06-20 21:27:07', 2, 5, NULL, 8, 'Habilidad'),
(73, 2, '2022-06-20 22:51:35', 2, NULL, 4, 5, 'Idioma'),
(75, 1, '2022-07-12 02:00:59', 1, 7, NULL, 12, 'Habilidad'),
(76, 2, '2022-07-15 17:12:29', 2, NULL, 3, 3, 'Idioma');

-- --------------------------------------------------------

--
-- Table structure for table `tecnologias`
--

CREATE TABLE `tecnologias` (
  `IDTECNOLOGIA` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8_bin NOT NULL,
  `TIPO` varchar(50) COLLATE utf8_bin NOT NULL,
  `FECHACREACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREADOPOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tecnologias`
--

INSERT INTO `tecnologias` (`IDTECNOLOGIA`, `NOMBRE`, `TIPO`, `FECHACREACION`, `CREADOPOR`) VALUES
(1, 'Git', 'Sistema de control de versiones', '2022-05-02 23:34:15', 1),
(2, 'C', 'Lenguaje de programación', '2022-05-02 23:34:17', 1),
(3, 'C++', 'Lenguaje de programación', '2022-05-02 23:34:17', 1),
(4, 'C#', 'Lenguaje de programación', '2022-05-02 23:34:18', 1),
(5, 'Java', 'Lenguaje de programación', '2022-05-02 23:34:19', 1),
(6, 'Javascript', 'Lenguaje de programación', '2022-05-02 23:34:19', 1),
(7, 'Python', 'Lenguaje de programación', '2022-05-02 23:34:20', 1),
(8, 'HTML', 'Lenguaje de etiquetas de hipertexto', '2022-05-02 23:34:21', 1),
(9, 'CSS', 'Lenguaje de hojas de estilo', '2022-05-02 23:34:21', 1),
(10, 'PHP', 'Lenguaje de programación', '2022-05-02 23:34:22', 1),
(11, 'ASP', 'Lenguaje de programación', '2022-05-02 23:34:23', 1),
(12, 'Perl', 'Lenguaje de programación', '2022-05-02 23:34:23', 1),
(13, 'SQL', 'Lenguaje de programación', '2022-05-02 23:34:24', 1),
(14, 'PL/SQL', 'Lenguaje de programación', '2022-05-02 23:34:25', 1),
(15, 'Visual Basic .Net', 'Lenguaje de programación', '2022-05-02 23:34:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUSUARIO` int(11) NOT NULL,
  `NOMBRE` varchar(100) COLLATE utf8_bin NOT NULL,
  `APELLIDOS` varchar(300) COLLATE utf8_bin NOT NULL,
  `FECHANACIMIENTO` date DEFAULT NULL,
  `TELEFONO` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL` varchar(30) COLLATE utf8_bin NOT NULL,
  `FECHAREGISTRO` timestamp NOT NULL DEFAULT current_timestamp(),
  `FECHAFIN` timestamp NULL DEFAULT NULL,
  `IDROL` int(11) DEFAULT NULL,
  `TELCONTACTO` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `SEMESTRE` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `NUMEROEMPLEADO` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `NUMEROMATRICULA` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `BLOQUEADO` char(2) COLLATE utf8_bin DEFAULT NULL,
  `CONTRASENA` varchar(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`IDUSUARIO`, `NOMBRE`, `APELLIDOS`, `FECHANACIMIENTO`, `TELEFONO`, `EMAIL`, `FECHAREGISTRO`, `FECHAFIN`, `IDROL`, `TELCONTACTO`, `SEMESTRE`, `NUMEROEMPLEADO`, `NUMEROMATRICULA`, `BLOQUEADO`, `CONTRASENA`) VALUES
(1, 'Yisus', 'Warrior', '1981-12-19', '449 1930661', 'jguerreroe@gmail.com', '2022-04-25 19:25:43', NULL, 1, '449 2390683', 'Noveno', NULL, '28008112300', NULL, '$2y$10$sngEFQZ1cf99aIhxYmcjx.EYzyHnu2ipd5IgIhz/zReJABIEvit5G'),
(2, 'Rol de Alumno', 'Prueba', '1999-08-10', '1234567890', '123', '2022-04-25 20:22:59', NULL, 1, '12345678999', 'primero', NULL, 'ES2005478', NULL, '$2y$10$Yst05s29WDTl/N.32xcw9uEj8m/ZxQgBmrXTJ0Nh22uQM0FA3L5c6'),
(3, 'Rol de Profesor', 'Prueba Prueba', '1993-12-02', '5555555555', '456', '2022-04-26 01:21:14', NULL, 2, '1234567890', NULL, '123456789', '456789', NULL, '$2y$10$w2J0JvM1xqU4oaB8uLR2NOt6Jjrsr8sCZd1Tjkycez3EYFQPCqZSS'),
(4, 'Pepe', 'Administrador', '1987-03-28', '5554447788', '789', '2022-04-26 01:21:53', NULL, 3, '13132123', 'sexto', '12131313132', 'ES123456789', NULL, '$2y$10$ft0WdiCjlTVTJ1dKerGXIOrtJkr3AIoCZEi.NOPWbjJLXmMx/aHB6'),
(5, 'Lina', 'GarcÃ­a', NULL, NULL, 'lgarcia@hotmail.com', '2022-05-02 22:43:34', NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$97OcMIEboDrtFwXsVRQA8OEFcTh942cB.dTQASckHv1ojdfspbBjK'),
(6, 'Arnulfo', 'Contreras', '1979-11-09', '334455667788', 'acontreras@gmail.com', '2022-05-02 22:43:55', NULL, 1, '', 'quinto', NULL, '5544778866', NULL, '$2y$10$0uVaMaHW98oXd4BqJJHuQuzsa57hLj/zqOyNOTdvm7Dld4I7t.2AO'),
(7, 'Pedro Alfonso', 'PÃ¡ramo Venegas', NULL, NULL, 'pp@pp.com', '2022-05-19 03:27:18', NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$oC.44/w6qmKTbpJRfk7YueByFXdeic.gfJe9LW87m37lg3qJ0YdTC'),
(8, 'prueba1', 'prueba1', NULL, NULL, 'p1p1@com', '2022-05-19 03:31:15', NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$Itnf/qYj0qplt0cK8MLQv.K2w2vxDBJIqaRX2PCf7RwUtEfZYOmyy'),
(9, 'prueba02', 'Prueba02', NULL, NULL, 'prueba02@prueba02.com', '2022-06-21 03:29:28', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$z3EdiUlvJ5ARzX6ie.Fi9ekwjreb7YyzFRXlvuYjTEiHFeuD/6Vr6'),
(10, 'prueba03', 'prueba03', NULL, NULL, 'prueba03@prueba03.com', '2022-06-21 03:29:56', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$ojk3vTqCtFqfLTn3SX80OOAFcBY9rY6Ya7eeVbnhUlJiNxR/UMqNi'),
(11, 'USUARIO TEST', 'TEST', NULL, NULL, '123@123.net', '2022-07-06 00:30:37', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$d88FucRnjOqOB4ahcxZKaubD8GTisqXPVHKZEayNsoWnJ8DabGa.6'),
(12, 'Prueba2022', '2022Prueba', NULL, NULL, '123@123.com', '2022-07-12 00:53:39', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$TIu3dS4h0OngS/PUr5xBYuGvayYVCHJy8m.2nrAlm4daz4cEhtyOO'),
(13, 'Tito ', 'Pruebas', NULL, NULL, 'tito@pruebas.com', '2022-07-12 01:24:22', NULL, 2, NULL, NULL, NULL, NULL, NULL, '$2y$10$LurGeTMXQD0sZBMBNwz8t.q3ogigm03qsx.SRxw/KIW1uGd.QcueS'),
(14, 'Tito ', 'Pruebas', NULL, NULL, 'tito@pruebas.com', '2022-07-12 01:31:30', NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$lUi3CMRav2yO2aMRf9.WQul90K.Tno9sY0GQ8FY/QFMFwbBLC2uwa'),
(15, 'pruebaaa', 'pruebaaaa', NULL, NULL, '456@456.net', '2022-07-12 01:32:03', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$5Rd/E94zOjSIN4x7cMfWbemQjrzUs/pOXBBS6niYTCsnWuP5rz93e'),
(16, 'asasa', 'asasa', NULL, NULL, 'asas', '2022-07-12 01:33:30', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$wRz57p39X60n6OzY/uYbt.6RuLv3Bkr8mnEnuHXIpWiTnx4kCgoDu'),
(17, 'asasa', 'asasa', NULL, NULL, 'asas', '2022-07-12 01:34:50', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$GPLWrU5FcvXEPCO9QcepU.szZ0L/QMoObQHexQDFdYI55LOM81xkS'),
(18, 'asasa', 'asasa', NULL, NULL, '', '2022-07-12 01:34:58', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$Fb5ljXGOcLPuI1sWGE3vNeqsDPG/WysVmmTx1...KjShXZ.izYvaa'),
(19, '', '', NULL, NULL, '', '2022-07-12 01:35:40', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$d5pfRN.QmpcC.YY1FH1Kw.nhjvFNp9i3LPtl2GZzs8Tg7GixOyMOy'),
(20, '', '', NULL, NULL, '', '2022-07-12 01:35:56', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$PQS0wSP8J.iFRuuwbxDQyu.rQwYS75584VZ7ScDNq.vtZRoARxd6a'),
(21, 'asasa', 'asasa', NULL, NULL, 'aasas', '2022-07-12 01:37:33', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$Vpxg4LEinSkEohe7/VkaGu841xCzl/H12uXpRWOrudHsX.UUddDSq'),
(22, 'asasas', 'asasas', NULL, NULL, 'asasa', '2022-07-12 01:45:25', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$6VGQA9XbE3L9nWnctkT8Hu0agnOMhTBBVIR1cPHEHXAf4.1k8Zo06'),
(23, 'werwerwer', 'werwerwe', NULL, NULL, 'ewerwerwe', '2022-07-12 01:46:01', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$qoi42uUM95u8uBte7BdDxO1JdZXwCob2M1ktdPJc1S93hwLnHLCQ2'),
(24, 'asas', 'asas', NULL, NULL, 'asa', '2022-07-12 01:50:01', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$ygREwfAmJ79cQRzoByh7LOrkXkxoUv4Dm.pADQUvAaNjVy9N/Zlm6'),
(25, 'asasa', 'asdadsa', NULL, NULL, 'dsdfsdfsdfsdf', '2022-07-12 01:50:57', NULL, 4, NULL, NULL, NULL, NULL, NULL, '$2y$10$Lkhm9IQvF7LH6MxZTVKdmedKQ2rMSqDTx8umwicTFIs6wBxgrBwSi'),
(26, 'Jesus', 'Guerrero', NULL, NULL, 'jguerreroe2@gmail.com', '2022-07-12 01:56:40', NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$4Vm1sZ3HXs5PanqIb/5dtuLDCVgxu0QhBNPVommVHAae6Dxf5XPum'),
(27, 'Rita', 'Guerrero', NULL, NULL, 'rgu@123.net', '2022-07-12 01:59:10', NULL, 1, NULL, NULL, NULL, NULL, NULL, '$2y$10$mPdNxmV/Kz30r8L.LDvzvu89eCuvqmtfUGSwhgaC0YMtIYPnnEwOG');

-- --------------------------------------------------------

--
-- Table structure for table `vacantes`
--

CREATE TABLE `vacantes` (
  `IDVACANTE` int(11) NOT NULL,
  `TITULO` varchar(300) COLLATE utf8_bin NOT NULL,
  `DETALLES` varchar(2000) COLLATE utf8_bin NOT NULL,
  `TELEFONO` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `EMAIL` varchar(30) COLLATE utf8_bin NOT NULL,
  `FECHAPUBLICACION` timestamp NOT NULL DEFAULT current_timestamp(),
  `FECHAFIN` timestamp NOT NULL DEFAULT current_timestamp(),
  `IDUSUARIO` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vacantes`
--

INSERT INTO `vacantes` (`IDVACANTE`, `TITULO`, `DETALLES`, `TELEFONO`, `EMAIL`, `FECHAPUBLICACION`, `FECHAFIN`, `IDUSUARIO`) VALUES
(1, 'PRUEBA01', 'Esta es una vacante de prueba\n dónde se vea que es una prueba 01', '4491234567', 'prueba@vacante.com', '2022-06-23 05:00:00', '0000-00-00 00:00:00', 3),
(2, 'PRUEBA02', 'Esta es una vacante de prueba\ndónde se vea que es una prueba 02', '4497654321', 'prueba2@vacante.com', '2022-06-23 05:00:00', '0000-00-00 00:00:00', 3),
(3, 'PRUEBA03', 'Esta es una vacante de prueba\ndónde se vea que es una prueba 03', '4497894563', 'prueba3@vacante.com', '2022-06-23 18:02:48', '0000-00-00 00:00:00', 3),
(4, 'asasas', '        ', '1234567890', 'asasasas', '2022-06-23 05:00:00', '2022-07-23 05:00:00', 3),
(5, 'Prueba de captura1', 'Prueba de \r\nCaptura sasas\r\nasasas\r\nasasa\r\nasasasa        ', '4491930661', 'prueba01@pruebas.com', '2022-07-01 05:00:00', '2022-07-20 05:00:00', 3),
(6, 'prueba02', 'prueba 02 de captura\r\nsasasas\r\nasasasa        ', '4491930661', 'prueba02@pruebas.com', '2022-07-23 05:00:00', '2022-09-20 05:00:00', 3),
(7, 'Consultor Java Jr', 'Conocimientos bÃ¡sicos de Java\r\nInglÃ©s intermedio\r\nCapacidad de anÃ¡lisis\r\nMedio tiempo', '4491930111', 'contacto@vacante.com', '2022-07-01 05:00:00', '2022-07-15 05:00:00', 3),
(8, 'Oracle Analyst', '        Conocimientos de Oracle a nivel Senior (mÃ­nimo 5 aÃ±os de experiencia)\r\nfecha de hoy', '123456789', '123@123.123', '2022-07-05 05:00:00', '2022-09-05 05:00:00', 3),
(9, 'Prueba Python', 'Prueba de vacante con Phyton Ingles Viajar disponibilidad        ', '123456789123', '4567897891426', '2022-07-13 05:00:00', '2022-07-29 05:00:00', 3);

-- --------------------------------------------------------

--
-- Structure for view `ponentes_v`
--
DROP TABLE IF EXISTS `ponentes_v`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin`@`%` SQL SECURITY DEFINER VIEW `ponentes_v`  AS SELECT ifnull(`pt`.`IDPONENTE`,'') AS `idponente`, ifnull(`pt`.`IDCONGRESO`,'') AS `idcongreso`, ifnull(`cn`.`NOMBRE`,'') AS `nombre`, ifnull(`pt`.`IDUSUARIO`,'') AS `idusuario`, concat(ifnull(`us`.`NOMBRE`,''),' ',ifnull(`us`.`APELLIDOS`,'')) AS `usuario`, ifnull(`pt`.`ASIGNADOPOR`,'') AS `idasignadopor`, concat(ifnull(`pn`.`NOMBRE`,''),' ',ifnull(`pn`.`APELLIDOS`,'')) AS `asignadopor`, ifnull(`pt`.`FECHAASIGNACION`,'') AS `fechaasignacion` FROM (((`ponentes` `pt` left join `congresos` `cn` on(`pt`.`IDCONGRESO` = `cn`.`IDCONGRESO`)) left join `usuarios` `us` on(`pt`.`IDUSUARIO` = `us`.`IDUSUARIO`)) left join `usuarios` `pn` on(`pt`.`ASIGNADOPOR` = `pn`.`IDUSUARIO`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`IDSESION`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indexes for table `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`IDOPCION`);

--
-- Indexes for table `congresos`
--
ALTER TABLE `congresos`
  ADD PRIMARY KEY (`IDCONGRESO`),
  ADD KEY `CREADOPOR` (`CREADOPOR`),
  ADD KEY `IDPROYECTO` (`IDPROYECTO`);

--
-- Indexes for table `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`IDIDIOMA`),
  ADD KEY `CREADOPOR` (`CREADOPOR`);

--
-- Indexes for table `logerrores`
--
ALTER TABLE `logerrores`
  ADD PRIMARY KEY (`IDREGISTRO`),
  ADD KEY `IDSESION` (`IDSESION`);

--
-- Indexes for table `lprogramacion`
--
ALTER TABLE `lprogramacion`
  ADD PRIMARY KEY (`IDLENGP`);

--
-- Indexes for table `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`IDMOVIMIENTO`),
  ADD KEY `IDSESION` (`IDSESION`);

--
-- Indexes for table `niveles`
--
ALTER TABLE `niveles`
  ADD PRIMARY KEY (`IDNIVEL`),
  ADD KEY `CREADOPOR` (`CREADOPOR`);

--
-- Indexes for table `ponentes`
--
ALTER TABLE `ponentes`
  ADD PRIMARY KEY (`IDPONENTE`),
  ADD KEY `IDCONGRESO` (`IDCONGRESO`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indexes for table `postulantes`
--
ALTER TABLE `postulantes`
  ADD KEY `IDVACANTE` (`IDVACANTE`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indexes for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`IDPROYECTO`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IDROL`),
  ADD KEY `IDSESION` (`IDSESION`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`IDSKILL`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`),
  ADD KEY `IDTECNOLOGIA` (`IDTECNOLOGIA`),
  ADD KEY `IDIDIOMA` (`IDIDIOMA`),
  ADD KEY `IDNIVEL` (`IDNIVEL`);

--
-- Indexes for table `tecnologias`
--
ALTER TABLE `tecnologias`
  ADD PRIMARY KEY (`IDTECNOLOGIA`),
  ADD KEY `CREADOPOR` (`CREADOPOR`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUSUARIO`);

--
-- Indexes for table `vacantes`
--
ALTER TABLE `vacantes`
  ADD PRIMARY KEY (`IDVACANTE`),
  ADD KEY `IDUSUARIO` (`IDUSUARIO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `IDSESION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `IDOPCION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `congresos`
--
ALTER TABLE `congresos`
  MODIFY `IDCONGRESO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `IDIDIOMA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logerrores`
--
ALTER TABLE `logerrores`
  MODIFY `IDREGISTRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lprogramacion`
--
ALTER TABLE `lprogramacion`
  MODIFY `IDLENGP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `IDMOVIMIENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `niveles`
--
ALTER TABLE `niveles`
  MODIFY `IDNIVEL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ponentes`
--
ALTER TABLE `ponentes`
  MODIFY `IDPONENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `IDPROYECTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `IDROL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `IDSKILL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tecnologias`
--
ALTER TABLE `tecnologias`
  MODIFY `IDTECNOLOGIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUSUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vacantes`
--
ALTER TABLE `vacantes`
  MODIFY `IDVACANTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `congresos`
--
ALTER TABLE `congresos`
  ADD CONSTRAINT `congresos_ibfk_1` FOREIGN KEY (`CREADOPOR`) REFERENCES `usuarios` (`IDUSUARIO`),
  ADD CONSTRAINT `congresos_ibfk_2` FOREIGN KEY (`IDPROYECTO`) REFERENCES `proyectos` (`IDPROYECTO`);

--
-- Constraints for table `idiomas`
--
ALTER TABLE `idiomas`
  ADD CONSTRAINT `idiomas_ibfk_1` FOREIGN KEY (`CREADOPOR`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `logerrores`
--
ALTER TABLE `logerrores`
  ADD CONSTRAINT `logerrores_ibfk_1` FOREIGN KEY (`IDSESION`) REFERENCES `bitacora` (`IDSESION`);

--
-- Constraints for table `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`IDSESION`) REFERENCES `bitacora` (`IDSESION`);

--
-- Constraints for table `niveles`
--
ALTER TABLE `niveles`
  ADD CONSTRAINT `niveles_ibfk_1` FOREIGN KEY (`CREADOPOR`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `ponentes`
--
ALTER TABLE `ponentes`
  ADD CONSTRAINT `ponentes_ibfk_1` FOREIGN KEY (`IDCONGRESO`) REFERENCES `congresos` (`IDCONGRESO`),
  ADD CONSTRAINT `ponentes_ibfk_2` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `postulantes`
--
ALTER TABLE `postulantes`
  ADD CONSTRAINT `postulantes_ibfk_1` FOREIGN KEY (`IDVACANTE`) REFERENCES `vacantes` (`IDVACANTE`),
  ADD CONSTRAINT `postulantes_ibfk_2` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `proyectos_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`IDSESION`) REFERENCES `bitacora` (`IDSESION`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSUARIO`),
  ADD CONSTRAINT `skills_ibfk_2` FOREIGN KEY (`IDTECNOLOGIA`) REFERENCES `tecnologias` (`IDTECNOLOGIA`),
  ADD CONSTRAINT `skills_ibfk_3` FOREIGN KEY (`IDIDIOMA`) REFERENCES `idiomas` (`IDIDIOMA`),
  ADD CONSTRAINT `skills_ibfk_4` FOREIGN KEY (`IDNIVEL`) REFERENCES `niveles` (`IDNIVEL`);

--
-- Constraints for table `tecnologias`
--
ALTER TABLE `tecnologias`
  ADD CONSTRAINT `tecnologias_ibfk_1` FOREIGN KEY (`CREADOPOR`) REFERENCES `usuarios` (`IDUSUARIO`);

--
-- Constraints for table `vacantes`
--
ALTER TABLE `vacantes`
  ADD CONSTRAINT `vacantes_ibfk_1` FOREIGN KEY (`IDUSUARIO`) REFERENCES `usuarios` (`IDUSUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
