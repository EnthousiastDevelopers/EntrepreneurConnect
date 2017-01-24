-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2017 at 08:25 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `position` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pm`
--

CREATE TABLE `pm` (
  `id` bigint(20) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `parent` smallint(6) NOT NULL,
  `id` int(11) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` longtext NOT NULL,
  `authorid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `timestamp2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`parent`, `id`, `id2`, `title`, `message`, `authorid`, `timestamp`, `timestamp2`) VALUES
(2, 1, 1, 'Technology', 'Hello guys, I really hope you are doing well and everything has been done. Today our topic is about computer science. If you like try it.', 7, 2016, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` text NOT NULL,
  `signup_date` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `signup_date`) VALUES
(1, 'Eli', 'chipuila2014', 'elichipuila@gmail.com', '', 2016),
(2, 'Maria', '7c222fb2927d828af22f592134e8932480637c0d', 'maria@gail.cpm', '', 1483904967),
(3, 'Abel', '7c222fb2927d828af22f592134e8932480637c0d', 'abel@gmail.com', '', 1483905414),
(4, 'Saimon', '7c222fb2927d828af22f592134e8932480637c0d', 'saimon@gmail.com', '', 1483953321),
(5, 'Kone', '7c222fb2927d828af22f592134e8932480637c0d', 'kone@gmail.com', '', 1483983190),
(6, 'Paul', '7c222fb2927d828af22f592134e8932480637c0d', 'paul@gmail.com', '', 1484072283),
(7, 'Marcos', '7c222fb2927d828af22f592134e8932480637c0d', 'maga@hotmail.com', '', 1484595457),
(8, 'Fanhatcha', '7c222fb2927d828af22f592134e8932480637c0d', 'kone@gmail.com', '', 1484663162),
(9, 'Tolotra', '7c222fb2927d828af22f592134e8932480637c0d', 'tolotra@gmail.com', '', 1484678978),
(10, 'TolotraSamuel', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'tolotrasam@gmail.com', 'Samuel', 1484764603);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`,`id2`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
