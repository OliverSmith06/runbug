-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2019 at 03:40 PM
-- Server version: 5.7.26
-- PHP Version: 7.0.33-0+deb9u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `runbug`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `entered_user` varchar(300) DEFAULT NULL,
  `firstLocation` int(11) NOT NULL,
  `secondLocation` int(11) NOT NULL,
  `thirdLocation` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `img` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `info` varchar(50) NOT NULL,
  `length` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `entered_user`, `firstLocation`, `secondLocation`, `thirdLocation`, `title`, `img`, `date`, `info`, `length`) VALUES
(4, '0,3,4,6,5', 1, 1, 1, 'C2K', '3_kosciuszko.jpg', '2019-03-08', 'Its long', 12),
(5, '0,3,1,2', 1, 1, 1, 'Ring of Fire', '5_ruapehu.jpg', '2019-03-08', 'Its long', 12),
(6, '0,1,3,5', 1, 1, 1, 'Auckland Circuit Run', '6_auckland.jpg', '2019-03-08', 'Its long', 12),
(7, '0,1', 1, 1, 1, 'Wellington Marathon', '4_wellington.jpg', '2019-03-08', 'Its long', 12),
(10, '0,1', 3, 7, 21, 'Waikato Marathon', '2_waikato.jpg', '2019-08-11', 'Its Long', 42),
(14, '0,1', 2, 5, 14, 'Coast to Coast', '1_coasttocoast', '2019-07-21', 'Out of ideas', 42),
(22, '0', 1, 2, 5, 'dateTestUpcoming', 'placeholder.jpg', '2023-06-16', 'Its Long', 42),
(24, '0', 2, 5, 14, 'dateTestError', 'placeholder.jpg', '2019-09-28', 'Its Long', 42),
(25, '0', 2, 4, 10, 'dateTestRecent', 'placeholder.jpg', '2019-09-24', 'Its Long', 42);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `title2` varchar(100) DEFAULT NULL,
  `para1` text NOT NULL,
  `para2` text,
  `img` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `title2`, `para1`, `para2`, `img`) VALUES
(1, 'overview', NULL, '<h4>Who are we?</h4>\r\n               Runbug will be your goto place to find all running events in one convenient place. \r\n               <h4>Why?</h4>\r\n               Opposed to trying to find information for an event on a specific website, runbug will give you an overview on all significant running events.\r\n               <h4>Who are we?</h4>\r\n               Runbug is a event tracking website built with ease of use in mind. We know here at runbug that it can be very time consuming to find the events you want, and to keep them there for future use. Because of this we have created.', NULL, 'shoe.png'),
(2, 'Add Event', NULL, 'On this webpage you will be able to add any events that are not yet in our database.  All you have to do is fill out all the fields marked * and your event will be entered into our database that will be able to be viewed on our main page', NULL, 'pencil.png'),
(3, 'View Events', 'Recent Events', 'Below are all upcoming events that we have currently available in our database. If you wish to view an event that has already occurred for any reason please hover over the events option in the navigation and select recent events', 'Below are listed all the events that have already occurred. if you wish to view events that have not yet occurred please select the upcoming events option when hovering over the events option in the navigation.', 'calendar_nc.jpg'),
(4, 'Favourites', NULL, 'Below are listed all the events that you have favourited. for the time being, if you would like to unfavourite an event or leave an event please do so on either of the events pages.', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `primarylocation`
--

CREATE TABLE `primarylocation` (
  `id` int(11) NOT NULL,
  `location1` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `primarylocation`
--

INSERT INTO `primarylocation` (`id`, `location1`) VALUES
(0, ''),
(1, 'Northland'),
(2, 'Auckland'),
(3, 'Waikato');

-- --------------------------------------------------------

--
-- Table structure for table `secondarylocation`
--

CREATE TABLE `secondarylocation` (
  `id` int(11) NOT NULL,
  `location2` varchar(50) NOT NULL,
  `upperLocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `secondarylocation`
--

INSERT INTO `secondarylocation` (`id`, `location2`, `upperLocation`) VALUES
(1, 'Far North', 1),
(2, 'Kaipara', 1),
(3, 'Whangarei', 1),
(4, 'Auckland City', 2),
(5, 'Franklin', 2),
(6, 'Rodney', 2),
(7, 'Hamilton', 3),
(8, 'Hauraki', 3),
(9, 'Matamata-Piako', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tertiarylocation`
--

CREATE TABLE `tertiarylocation` (
  `id` int(11) NOT NULL,
  `location3` varchar(50) NOT NULL,
  `upperLocation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tertiarylocation`
--

INSERT INTO `tertiarylocation` (`id`, `location3`, `upperLocation`) VALUES
(1, 'Ahipara', 1),
(2, 'Cable Bay', 1),
(3, 'Taipa', 1),
(4, 'Hakaru', 2),
(5, 'Mangawhai', 2),
(6, 'Pahi', 2),
(7, 'Bream Bay', 3),
(8, 'Kamo', 3),
(9, 'Mairtown', 3),
(10, 'Avondale', 4),
(11, 'Grafton', 4),
(12, 'Mission Bay', 4),
(13, 'Bombay', 5),
(14, 'Pokeno', 5),
(15, 'Hunua', 5),
(16, 'Albany Heights', 6),
(17, 'Warkworth', 6),
(18, 'Matakana', 6),
(19, 'Bader', 7),
(20, 'Fairfield', 7),
(21, 'Nawton', 7),
(22, 'Turua', 8),
(23, 'Kerepehi', 8),
(24, 'Waihi', 8),
(25, 'Matamata', 9),
(26, 'Waihou', 9),
(27, 'Springdale', 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `age` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fav` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `org` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `created`, `modified`, `status`, `age`, `fav`, `admin`, `org`) VALUES
(0, 'First Name', 'Last Name', 'Email', '81dc9bdb52d04dc20036dbd8313ed055', 'Phone', '2019-04-11 12:00:13', '2019-04-11 12:00:13', '1', 'Age', NULL, 0, 0),
(1, 'Oliver', 'Smith', 'oliver@5smiths.org', '81dc9bdb52d04dc20036dbd8313ed055', '021990468', '2019-04-05 02:04:12', '2019-04-05 02:04:12', '1', '17', '10,20,14,', 1, 1),
(2, 'Dimma', 'Tyulyakov', 'dimma@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '049904681', '2019-04-11 11:58:24', '2019-04-11 11:58:24', '1', '17', '5,', 0, 1),
(3, 'Nick', 'Smith', 'nick@5smiths.org', '81dc9bdb52d04dc20036dbd8313ed055', '021990479', '2019-04-11 11:58:57', '2019-04-11 11:58:57', '1', '42', '5,4,4,4,', 0, 1),
(4, 'Jamie', 'Chalmers', 'jamie@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '044206969', '2019-04-12 04:36:38', '2019-04-12 04:36:38', '1', NULL, '14,4,', 0, 1),
(5, 'Callym', 'Smith', 'callym@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '021990461', '2019-04-14 05:34:48', '2019-04-14 05:34:48', '1', NULL, '', 0, 1),
(6, 'Matthew', 'Smith', 'matthew@5smiths.org', '81dc9bdb52d04dc20036dbd8313ed055', '021990488', '2019-04-25 11:55:23', '2019-04-25 11:55:23', '1', NULL, '5,', 0, 0),
(7, 'Lars', 'Noordhoek', 'lars@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '021654357', '2019-07-02 05:12:50', '2019-07-02 05:12:50', '1', NULL, NULL, 0, 0),
(8, 'Daniel', 'Tyulyakov', 'daniel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0456337835', '2019-07-20 07:00:26', '2019-07-20 07:00:26', '1', NULL, NULL, 0, 0),
(9, 'a', 'a', 'asdf@asdf.asdf', '81dc9bdb52d04dc20036dbd8313ed055', 'asdf', '2019-07-20 16:25:50', '2019-07-20 16:25:50', '1', NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `entered_user` (`entered_user`(255)),
  ADD KEY `firstLocation` (`firstLocation`,`secondLocation`,`thirdLocation`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `primarylocation`
--
ALTER TABLE `primarylocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `secondarylocation`
--
ALTER TABLE `secondarylocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upperLocation` (`upperLocation`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tertiarylocation`
--
ALTER TABLE `tertiarylocation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upperLocation` (`upperLocation`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `primarylocation`
--
ALTER TABLE `primarylocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `secondarylocation`
--
ALTER TABLE `secondarylocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tertiarylocation`
--
ALTER TABLE `tertiarylocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`firstLocation`) REFERENCES `primarylocation` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
