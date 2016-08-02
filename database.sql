-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2016 at 11:05 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `dayvids`
--
CREATE DATABASE IF NOT EXISTS `dayvids` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dayvids`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `topic_id`) VALUES
(1, 'Cats', 1),
(2, 'Dogs', 1),
(3, 'Monkeys', 1),
(4, 'Mixed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_videos`
--

CREATE TABLE `category_videos` (
  `category_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_videos`
--

INSERT INTO `category_videos` (`category_id`, `video_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(4, 19),
(4, 20),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 25),
(4, 26),
(4, 27);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `feature_video_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `feature_video_id`, `name`, `date`) VALUES
(1, 1, 'Funny Animal Videos', '2016-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `youtubeID` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `youtubeID`) VALUES
(1, 'Sail', 'Awf45u6zrP0'),
(2, 'Cats Acting Like Humans', 'PHAc3_MEjgQ'),
(3, 'Cats Being Jerks', 'ttKdGMgf8y8'),
(4, 'Stalking Cats', 'b7debB7Nsok'),
(5, 'Cats vs Laser Pointers', 'ebLaWzjQ2Xg'),
(6, 'Funny Cat Meowing', 'DXUAyRRkI6k'),
(7, 'Scared Cats', '1Kl4rNUTWCA'),
(8, 'Talking Dog', '2c8MMiytwNs'),
(9, 'Funny Dogs', 'GF60Iuh643I'),
(10, 'Dog Vs Monkey', 'qYvdEkBPzIU'),
(11, 'Puppies', 'PGLz4Dgzc54'),
(12, 'Snowman Scares Dog', '5jg6JXJeTu8'),
(13, 'Monkey Helps Dog', 'D53OBy0_9Qo'),
(14, 'Monkey Compilcation', '62OL7SC5_A8'),
(15, 'Annoying Monkeys', 'AoeeMzzsTbI'),
(16, 'Monkey vs Ice', 'yFcXJAP851I'),
(17, 'KoKo, Talking Gorilla', 'SNuZ4OE6vCk'),
(18, 'Drunk Monkeys', 'pmnzIhbX2bg'),
(19, 'Lions Bites Car', '7iyPHTm44Q'),
(20, 'Angry Elephant', 'nxpBObXjsnc'),
(21, 'Bear Compilcation', 'J5_Ho6JQU7w'),
(22, 'Penguin Fails', 'Tcx6YyXvvRI'),
(23, 'Animal Compilation', 'm0_MNGa9RYI'),
(24, 'Ostrich Chases Cyclist', 'kotWv4MCxNI'),
(25, 'Confused Leopard Geckos', 'kkJO1KAD1Ng'),
(26, 'Tiger Cubs Playing', 'kmCXDJFBexM'),
(27, 'Horse Races Alone', '4TAUdHjYB1U');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `category_videos`
--
ALTER TABLE `category_videos`
  ADD PRIMARY KEY (`category_id`,`video_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
