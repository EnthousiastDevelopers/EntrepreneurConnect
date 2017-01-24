-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2017 at 08:25 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `startupdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `ID` int(11) NOT NULL,
  `Title` varchar(15) NOT NULL,
  `Value` text NOT NULL,
  `Parent` int(11) NOT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Category` varchar(600) NOT NULL,
  `Author` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`ID`, `Title`, `Value`, `Parent`, `Timestamp`, `Category`, `Author`) VALUES
(1, 'Creativity', '5', 1, '2017-01-17 17:24:42', 'ratings', NULL),
(2, 'Courage', '4', 1, '2017-01-17 17:24:42', 'ratings', NULL),
(3, 'Honnesty', '4', 1, '2017-01-17 17:24:42', 'ratings', NULL),
(4, 'Ambition', '3', 1, '2017-01-17 17:24:42', 'ratings', NULL),
(5, 'Integrity', '4', 1, '2017-01-17 17:24:42', 'ratings', NULL),
(6, 'Surname', 'Tolotra Samuel', 1, '2017-01-17 18:22:55', 'bio', NULL),
(7, 'First Name', 'Randriakotonjanajary', 1, '2017-01-17 18:23:42', 'bio', NULL),
(24, 'core', 'Love of Earth', 1, '2017-01-18 22:15:50', 'bio', NULL),
(9, 'core', 'Business', 1, '2017-01-17 18:23:42', 'bio', NULL),
(10, 'core', 'Electronic Gadget', 1, '2017-01-17 18:22:55', 'bio', NULL),
(104, 'PictureUrl', 'uploads/WIN_20151118_164123.JPG', 1, '2017-01-19 19:26:25', 'bio', NULL),
(12, 'skills', 'Programming', 1, '2017-01-17 18:22:55', 'bio', NULL),
(13, 'skills', 'Dedicated when I am doing things in line with my core values', 1, '2017-01-17 18:23:42', 'bio', NULL),
(14, 'skills', 'Data Analytics', 1, '2017-01-17 18:22:55', 'bio', NULL),
(15, 'skills', 'Philosophy', 1, '2017-01-17 18:23:42', 'bio', NULL),
(16, 'product', '3 computers', 1, '2017-01-17 18:22:55', 'bio', NULL),
(37, 'core', 'The richest Man in the world', 1, '2017-01-18 23:06:22', 'bio', NULL),
(18, 'product', 'High speed internet connection', 1, '2017-01-17 18:22:55', 'bio', NULL),
(19, 'product', 'Guitare', 1, '2017-01-17 18:23:42', 'bio', NULL),
(20, 'service', 'Data Analysis', 1, '2017-01-17 18:22:55', 'bio', NULL),
(21, 'service', 'Market research', 1, '2017-01-17 18:23:42', 'bio', NULL),
(22, 'service', 'Fund Raising', 1, '2017-01-17 18:22:55', 'bio', NULL),
(23, 'service', 'Business Plan', 1, '2017-01-17 18:23:42', 'bio', NULL),
(35, 'core', 'Electronics', 1, '2017-01-18 22:34:10', 'bio', NULL),
(27, 'core', 'Passion of love', 1, '2017-01-18 22:25:27', 'bio', NULL),
(28, 'core', 'Being rich', 1, '2017-01-18 22:26:22', 'bio', NULL),
(38, 'skills', 'Volleyball', 1, '2017-01-18 23:07:22', 'bio', NULL),
(39, 'core', 'new rich', 1, '2017-01-19 11:06:43', 'bio', NULL),
(40, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 13:35:11', 'bio', NULL),
(41, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 13:37:07', 'bio', NULL),
(42, 'core', 'very rich', 1, '2017-01-19 13:38:19', 'bio', NULL),
(43, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 13:38:30', 'bio', NULL),
(44, 'PictureUrl', 'uploads/WIN_20151110_145833.JPG', 1, '2017-01-19 13:41:14', 'bio', NULL),
(45, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 13:42:03', 'bio', NULL),
(46, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 13:42:20', 'bio', NULL),
(47, 'PictureUrl', 'uploads/WIN_20151104_130412.JPG', 1, '2017-01-19 13:42:48', 'bio', NULL),
(48, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 13:44:25', 'bio', NULL),
(49, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 13:45:00', 'bio', NULL),
(50, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 13:45:20', 'bio', NULL),
(51, 'PictureUrl', 'uploads/WIN_20151110_145836.JPG', 1, '2017-01-19 13:46:17', 'bio', NULL),
(52, 'PictureUrl', 'uploads/WIN_20151111_172620.JPG', 1, '2017-01-19 13:48:55', 'bio', NULL),
(53, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 13:49:50', 'bio', NULL),
(54, 'PictureUrl', 'uploads/WIN_20151104_130412.JPG', 1, '2017-01-19 13:50:43', 'bio', NULL),
(55, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 13:51:11', 'bio', NULL),
(56, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 13:53:03', 'bio', NULL),
(57, 'PictureUrl', 'uploads/WIN_20151118_164123.JPG', 1, '2017-01-19 13:55:07', 'bio', NULL),
(58, 'PictureUrl', 'uploads/WIN_20151110_145836.JPG', 1, '2017-01-19 14:05:28', 'bio', NULL),
(59, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 14:05:54', 'bio', NULL),
(60, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 14:07:09', 'bio', NULL),
(61, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 14:08:06', 'bio', NULL),
(62, 'PictureUrl', 'uploads/WIN_20151104_130316.JPG', 1, '2017-01-19 14:08:31', 'bio', NULL),
(63, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 14:08:37', 'bio', NULL),
(64, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 14:09:18', 'bio', NULL),
(65, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 14:09:45', 'bio', NULL),
(66, 'PictureUrl', 'uploads/WIN_20151111_172620.JPG', 1, '2017-01-19 14:10:03', 'bio', NULL),
(67, 'PictureUrl', 'uploads/WIN_20151204_003104.JPG', 1, '2017-01-19 14:10:10', 'bio', NULL),
(68, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 14:12:06', 'bio', NULL),
(69, 'PictureUrl', 'uploads/WIN_20151204_003104.JPG', 1, '2017-01-19 14:12:15', 'bio', NULL),
(70, 'PictureUrl', 'uploads/WIN_20151119_145147.JPG', 1, '2017-01-19 14:12:46', 'bio', NULL),
(71, 'PictureUrl', 'uploads/WIN_20151115_182315.JPG', 1, '2017-01-19 14:14:14', 'bio', NULL),
(72, 'PictureUrl', 'uploads/WIN_20151115_182351.JPG', 1, '2017-01-19 14:14:53', 'bio', NULL),
(73, 'PictureUrl', 'uploads/WIN_20151116_141309 (2).JPG', 1, '2017-01-19 14:15:02', 'bio', NULL),
(74, 'PictureUrl', 'uploads/WIN_20151116_191152.JPG', 1, '2017-01-19 14:15:30', 'bio', NULL),
(75, 'PictureUrl', 'uploads/WIN_20151110_145820.JPG', 1, '2017-01-19 14:16:01', 'bio', NULL),
(76, 'PictureUrl', 'uploads/WIN_20151119_145216.JPG', 1, '2017-01-19 14:16:12', 'bio', NULL),
(77, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 14:17:05', 'bio', NULL),
(78, 'PictureUrl', 'uploads/WIN_20151104_130316.JPG', 1, '2017-01-19 14:19:38', 'bio', NULL),
(79, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 14:20:04', 'bio', NULL),
(80, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 14:20:46', 'bio', NULL),
(81, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 16:53:33', 'bio', NULL),
(82, 'PictureUrl', 'uploads/WIN_20151111_172620.JPG', 1, '2017-01-19 17:01:38', 'bio', NULL),
(83, 'core', 'very very very rich', 1, '2017-01-19 17:41:02', 'bio', NULL),
(84, 'PictureUrl', 'uploads/WIN_20151110_145836.JPG', 1, '2017-01-19 18:12:21', 'bio', NULL),
(85, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 18:13:55', 'bio', NULL),
(86, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 18:23:33', 'bio', NULL),
(87, 'PictureUrl', 'uploads/WIN_20151107_192904.JPG', 1, '2017-01-19 18:23:55', 'bio', NULL),
(88, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 1, '2017-01-19 18:24:52', 'bio', NULL),
(89, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 18:25:23', 'bio', NULL),
(90, 'PictureUrl', 'uploads/WIN_20151204_002423.JPG', 1, '2017-01-19 18:27:33', 'bio', NULL),
(91, 'PictureUrl', 'uploads/WIN_20151204_000513.JPG', 1, '2017-01-19 18:28:07', 'bio', NULL),
(92, 'PictureUrl', 'uploads/WIN_20151204_020332.JPG', 1, '2017-01-19 18:28:43', 'bio', NULL),
(93, 'PictureUrl', 'uploads/WIN_20151204_085459.JPG', 1, '2017-01-19 18:30:06', 'bio', NULL),
(94, 'PictureUrl', 'uploads/WIN_20151204_011217.JPG', 1, '2017-01-19 18:31:07', 'bio', NULL),
(95, 'PictureUrl', 'uploads/WIN_20151204_003101.JPG', 1, '2017-01-19 18:33:19', 'bio', NULL),
(103, 'status', 'my status', 1, '2017-01-19 19:18:50', 'bio', NULL),
(97, 'vision', 'being rich', 1, '2017-01-19 18:40:01', 'bio', NULL),
(98, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 1, '2017-01-19 18:43:30', 'bio', NULL),
(99, 'PictureUrl', 'uploads/WIN_20151125_224844.JPG', 1, '2017-01-19 18:43:46', 'bio', NULL),
(100, 'PictureUrl', 'uploads/WIN_20151204_020319.JPG', 1, '2017-01-19 18:43:59', 'bio', NULL),
(101, 'PictureUrl', 'uploads/WIN_20151204_020319.JPG', 1, '2017-01-19 18:44:11', 'bio', NULL),
(105, 'Surname', 'Tolotra', 18, '2017-01-17 18:22:55', 'bio', NULL),
(106, 'First Name', 'Super', 18, '2017-01-17 18:23:42', 'bio', NULL),
(107, 'status', 'New user', 18, '2017-01-19 22:06:45', 'bio', NULL),
(108, 'core', 'Singing', 18, '2017-01-19 22:06:58', 'bio', NULL),
(109, 'core', 'Nature', 18, '2017-01-19 22:07:06', 'bio', NULL),
(110, 'vision', 'Being rich one day', 18, '2017-01-19 22:07:17', 'bio', NULL),
(111, 'vision', 'Being the president of Madagascar', 18, '2017-01-19 22:07:36', 'bio', NULL),
(112, 'product', 'Money of 1M dollar', 18, '2017-01-19 22:07:58', 'bio', NULL),
(113, 'product', 'Nice2', 18, '2017-01-19 22:08:17', 'bio', NULL),
(115, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 18, '2017-01-19 22:12:31', 'bio', NULL),
(116, 'PictureUrl', 'uploads/WIN_20151127_225304.JPG', 18, '2017-01-19 22:12:44', 'bio', NULL),
(117, 'vision', 'new vision', 18, '2017-01-19 22:12:51', 'bio', NULL),
(119, 'vision', 'new love', 18, '2017-01-19 22:14:35', 'bio', NULL),
(120, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 18, '2017-01-19 22:15:25', 'bio', NULL),
(121, 'PictureUrl', 'uploads/WIN_20151125_224844.JPG', 1, '2017-01-19 22:15:38', 'bio', NULL),
(122, 'PictureUrl', 'uploads/WIN_20151110_145836.JPG', 18, '2017-01-19 22:15:57', 'bio', NULL),
(123, 'PictureUrl', 'uploads/WIN_20151120_190357.JPG', 18, '2017-01-19 22:16:12', 'bio', NULL),
(124, 'PictureUrl', 'uploads/WIN_20151204_002418.JPG', 18, '2017-01-19 22:16:24', 'bio', NULL),
(125, 'PictureUrl', 'uploads/WIN_20151111_172617.JPG', 18, '2017-01-19 22:57:06', 'bio', NULL),
(126, 'PictureUrl', 'uploads/WIN_20151110_145846.JPG', 18, '2017-01-19 22:59:14', 'bio', NULL),
(127, 'PictureUrl', 'uploads/WIN_20151118_164123.JPG', 1, '2017-01-19 23:15:25', 'bio', NULL),
(128, '', '', 1, '2017-01-20 15:47:41', 'rating', NULL),
(129, '', '', 1, '2017-01-20 15:48:15', 'rating', NULL),
(130, 'Creativity', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(131, 'Courage', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(132, 'Honnesty', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(133, 'Ambition', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(134, 'Integrity', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(135, 'Creativity', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(136, 'Courage', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(137, 'Honnesty', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(138, 'Ambition', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(139, 'Integrity', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(140, 'Creativity', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(141, 'Courage', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(142, 'Honnesty', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(143, 'Ambition', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(144, 'Integrity', '1', 1, '2017-01-20 16:40:58', 'rating', NULL),
(145, 'Creativity', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(146, 'Courage', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(147, 'Honnesty', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(148, 'Ambition', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(149, 'Integrity', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(150, 'Creativity', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(151, 'Courage', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(152, 'Honnesty', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(153, 'Ambition', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(154, 'Integrity', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(155, 'Creativity', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(156, 'Courage', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(157, 'Honnesty', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(158, 'Ambition', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(159, 'Integrity', '1', 1, '2017-01-20 16:41:58', 'rating', 18),
(160, 'Creativity', '5', 1, '2017-01-20 16:41:58', 'rating', 18),
(161, 'Courage', '5', 1, '2017-01-20 16:41:58', 'rating', 18),
(162, 'Honnesty', '5', 1, '2017-01-20 16:41:58', 'rating', 18),
(163, 'Ambition', '5', 1, '2017-01-20 16:41:58', 'rating', 18),
(164, 'Integrity', '5', 1, '2017-01-20 16:41:58', 'rating', 18),
(165, 'Creativity', '4', 1, '2017-01-20 17:12:25', 'ratings', 18),
(166, 'Courage', '4', 1, '2017-01-20 17:12:25', 'ratings', 18),
(167, 'Honnesty', '2', 1, '2017-01-20 17:12:25', 'ratings', 18),
(168, 'Ambition', '3', 1, '2017-01-20 17:12:25', 'ratings', 18),
(169, 'Integrity', '2', 1, '2017-01-20 17:12:25', 'ratings', 18),
(170, 'Creativity', '4', 1, '2017-01-20 17:16:53', 'ratings', 18),
(171, 'Courage', '4', 1, '2017-01-20 17:16:53', 'ratings', 18),
(172, 'Honnesty', '5', 1, '2017-01-20 17:16:53', 'ratings', 18),
(173, 'Ambition', '3', 1, '2017-01-20 17:16:53', 'ratings', 18),
(174, 'Integrity', '5', 1, '2017-01-20 17:16:53', 'ratings', 18),
(175, 'Creativity', '4', 1, '2017-01-20 21:23:19', 'ratings', 18),
(176, 'Courage', '5', 1, '2017-01-20 21:23:19', 'ratings', 18),
(177, 'Honnesty', '5', 1, '2017-01-20 21:23:19', 'ratings', 18),
(178, 'Ambition', '5', 1, '2017-01-20 21:23:19', 'ratings', 18),
(179, 'Integrity', '5', 1, '2017-01-20 21:23:19', 'ratings', 18),
(180, 'Creativity', '5', 17, '2017-01-20 21:33:54', 'ratings', 18),
(181, 'Courage', '5', 17, '2017-01-20 21:33:54', 'ratings', 18),
(182, 'Honnesty', '4', 17, '2017-01-20 21:33:54', 'ratings', 18),
(183, 'Ambition', '4', 17, '2017-01-20 21:33:54', 'ratings', 18),
(184, 'Integrity', '4', 17, '2017-01-20 21:33:54', 'ratings', 18),
(185, 'Creativity', '5', 16, '2017-01-20 22:26:30', 'ratings', 18),
(186, 'Courage', '5', 16, '2017-01-20 22:26:30', 'ratings', 18),
(187, 'Honnesty', '5', 16, '2017-01-20 22:26:30', 'ratings', 18),
(188, 'Ambition', '5', 16, '2017-01-20 22:26:30', 'ratings', 18),
(189, 'Integrity', '5', 16, '2017-01-20 22:26:30', 'ratings', 18),
(190, 'Creativity', '5', 15, '2017-01-21 10:49:47', 'ratings', 18),
(191, 'Courage', '5', 15, '2017-01-21 10:49:47', 'ratings', 18),
(192, 'Honnesty', '5', 15, '2017-01-21 10:49:47', 'ratings', 18),
(193, 'Ambition', '5', 15, '2017-01-21 10:49:47', 'ratings', 18),
(194, 'Integrity', '5', 15, '2017-01-21 10:49:47', 'ratings', 18),
(195, 'Creativity', '5', 14, '2017-01-21 11:36:07', 'ratings', 18),
(196, 'Courage', '4', 14, '2017-01-21 11:36:07', 'ratings', 18),
(197, 'Honnesty', '3', 14, '2017-01-21 11:36:07', 'ratings', 18),
(198, 'Ambition', '2', 14, '2017-01-21 11:36:07', 'ratings', 18),
(199, 'Integrity', '1', 14, '2017-01-21 11:36:07', 'ratings', 18),
(200, 'PictureUrl', 'uploads/black_goku_super_saiyan.jpg', 16, '2017-01-21 16:56:16', 'bio', NULL),
(201, 'Creativity', '4', 18, '2017-01-21 16:56:51', 'ratings', 16),
(202, 'Courage', '4', 18, '2017-01-21 16:56:51', 'ratings', 16),
(203, 'Honnesty', '4', 18, '2017-01-21 16:56:51', 'ratings', 16),
(204, 'Ambition', '4', 18, '2017-01-21 16:56:51', 'ratings', 16),
(205, 'Integrity', '1', 18, '2017-01-21 16:56:51', 'ratings', 16),
(206, 'Creativity', '4', 1, '2017-01-21 17:17:27', 'ratings', 21),
(207, 'Courage', '4', 1, '2017-01-21 17:17:27', 'ratings', 21),
(208, 'Honnesty', '3', 1, '2017-01-21 17:17:27', 'ratings', 21),
(209, 'Ambition', '3', 1, '2017-01-21 17:17:27', 'ratings', 21),
(210, 'Integrity', '4', 1, '2017-01-21 17:17:27', 'ratings', 21),
(211, 'PictureUrl', 'uploads/13112887_812661822199838_5694101685019041185_o.jpg', 21, '2017-01-21 17:22:18', 'bio', NULL),
(212, 'PictureUrl', 'uploads/counselling.png', 20, '2017-01-21 17:36:22', 'bio', NULL),
(213, 'core', 'I love singing', 20, '2017-01-21 17:37:00', 'bio', NULL),
(214, 'PictureUrl', 'uploads/48e1ba903516bb0713cfc19e3431ef34.jpg', 20, '2017-01-21 17:49:57', 'bio', NULL),
(215, 'PictureUrl', 'uploads/counselling.png', 20, '2017-01-21 17:50:10', 'bio', NULL),
(216, 'PictureUrl', 'uploads/12439409_987676507986690_2884043100795571697_n.jpg', 20, '2017-01-21 18:55:17', 'bio', NULL),
(217, 'Creativity', '5', 21, '2017-01-21 18:57:34', 'ratings', 20),
(218, 'Courage', '3', 21, '2017-01-21 18:57:34', 'ratings', 20),
(219, 'Honnesty', '5', 21, '2017-01-21 18:57:34', 'ratings', 20),
(220, 'Ambition', '4', 21, '2017-01-21 18:57:34', 'ratings', 20),
(221, 'Integrity', '2', 21, '2017-01-21 18:57:34', 'ratings', 20),
(222, 'Creativity', '4', 16, '2017-01-21 18:58:08', 'ratings', 20),
(223, 'Courage', '4', 16, '2017-01-21 18:58:08', 'ratings', 20),
(224, 'Honnesty', '4', 16, '2017-01-21 18:58:08', 'ratings', 20),
(225, 'Ambition', '5', 16, '2017-01-21 18:58:08', 'ratings', 20),
(226, 'Integrity', '5', 16, '2017-01-21 18:58:08', 'ratings', 20),
(227, 'Creativity', '3', 19, '2017-01-21 19:01:33', 'ratings', 20),
(228, 'Courage', '5', 19, '2017-01-21 19:01:33', 'ratings', 20),
(229, 'Honnesty', '4', 19, '2017-01-21 19:01:33', 'ratings', 20),
(230, 'Ambition', '5', 19, '2017-01-21 19:01:33', 'ratings', 20),
(231, 'Integrity', '4', 19, '2017-01-21 19:01:33', 'ratings', 20),
(232, 'Creativity', '2', 13, '2017-01-21 19:01:55', 'ratings', 20),
(233, 'Courage', '5', 13, '2017-01-21 19:01:55', 'ratings', 20),
(234, 'Honnesty', '5', 13, '2017-01-21 19:01:55', 'ratings', 20),
(235, 'Ambition', '4', 13, '2017-01-21 19:01:55', 'ratings', 20),
(237, 'Integrity', '5', 13, '2017-01-21 19:57:41', 'ratings', 20),
(238, 'PictureUrl', 'uploads/world wonder.jpg', 16, '2017-01-21 20:18:08', 'bio', NULL),
(239, 'PictureUrl', 'uploads/WIN_20151111_172620.JPG', 15, '2017-01-21 20:19:09', 'bio', NULL),
(240, 'Creativity', '5', 1, '2017-01-21 20:20:53', 'ratings', 15),
(241, 'Courage', '5', 1, '2017-01-21 20:20:53', 'ratings', 15),
(242, 'Honnesty', '5', 1, '2017-01-21 20:20:53', 'ratings', 15),
(243, 'Ambition', '5', 1, '2017-01-21 20:20:53', 'ratings', 15),
(244, 'Integrity', '5', 1, '2017-01-21 20:20:53', 'ratings', 15),
(245, 'Creativity', '4', 15, '2017-01-21 20:33:08', 'ratings', 24),
(246, 'Courage', '5', 15, '2017-01-21 20:33:08', 'ratings', 24),
(247, 'Honnesty', '4', 15, '2017-01-21 20:33:08', 'ratings', 24),
(248, 'Ambition', '4', 15, '2017-01-21 20:33:08', 'ratings', 24),
(249, 'Integrity', '5', 15, '2017-01-21 20:33:08', 'ratings', 24),
(250, 'Creativity', '4', 24, '2017-01-21 20:35:32', 'ratings', 20),
(251, 'Courage', '3', 24, '2017-01-21 20:35:32', 'ratings', 20),
(252, 'Honnesty', '5', 24, '2017-01-21 20:35:32', 'ratings', 20),
(253, 'Ambition', '3', 24, '2017-01-21 20:35:32', 'ratings', 20),
(254, 'Integrity', '5', 24, '2017-01-21 20:35:32', 'ratings', 20),
(255, 'status', 'Seeking for partnership', 24, '2017-01-21 20:45:54', 'bio', NULL),
(256, 'core', 'Good Education', 24, '2017-01-21 20:46:34', 'bio', NULL),
(258, 'vision', 'ssdf', 20, '2017-01-23 20:43:23', 'bio', NULL),
(259, 'vision', 'sdfgsdfg', 20, '2017-01-23 20:43:28', 'bio', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `PictureID` int(11) NOT NULL,
  `Creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Column1` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Email`, `FirstName`, `LastName`, `Password`, `PictureID`, `Creation`, `Timestamp`, `Column1`) VALUES
(1, 'tolotrasamuel.randriakotonjanahary', 'tolotrasam@gmail.com', 'Tolotra Samuel', 'Randriakotonjanary', '12345678', 104, '2017-01-19 17:07:54', '2017-01-19 17:07:54', NULL),
(20, '', '', 'Marco', 'Victor (Test)', '', 216, '2017-01-21 17:02:10', '2017-01-21 17:02:10', NULL),
(19, 'ohoh', 'test', 'Vanessa', 'Emma (Test)', 'asdf', 1, '2017-01-21 17:00:14', '2017-01-21 17:00:14', NULL),
(18, 'ok', 'tolotra.com', 'Tolotra', 'Samuel (Test)', 'paspas', 126, '2017-01-19 21:41:43', '2017-01-19 21:41:43', NULL),
(17, 'NiceSuper', 'rtolotra@tolotra.com', 'Miriana', 'Eleanor (Test)', '123456', 1, '2017-01-19 21:38:29', '2017-01-19 21:38:29', NULL),
(16, 'sdf', 'asdfasdf1', 'Jessica', 'Lavigne (Test)', 'asdf', 238, '2017-01-19 21:33:22', '2017-01-19 21:33:22', NULL),
(15, 'asdf1', 'asdfasdf2', 'Mark', 'Van Busquet (Test)', 'asdf', 239, '2017-01-19 21:18:32', '2017-01-19 21:18:32', NULL),
(14, 'asdf2', 'asdfasdf3', 'Pablo', 'Smith (Test)', 'asdf', 1, '2017-01-19 21:16:44', '2017-01-19 21:16:44', NULL),
(13, 'asdf3', 'asdfasdf3', 'Angella', 'Corine (Test)', 'asdf', 1, '2017-01-19 21:16:32', '2017-01-19 21:16:32', NULL),
(21, 'asdfqq.asdfrrr', 'ttoott', 'Annie', 'Lisa (Test)', 'qqqq', 211, '2017-01-21 17:06:04', '2017-01-21 17:06:04', NULL),
(24, 'Eli', 'eli', 'Eli', 'Edilson', '123456', 1, '2017-01-21 20:29:49', '2017-01-21 20:29:49', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
