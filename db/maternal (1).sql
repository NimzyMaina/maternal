-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2016 at 11:33 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maternal`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `startdate` varchar(48) NOT NULL,
  `enddate` varchar(48) NOT NULL,
  `allDay` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `title`, `startdate`, `enddate`, `allDay`) VALUES
(1, 'Lolo', '2016-02-04T00:02:00+03:00', '2016-02-04T00:02:00+03:00', '0'),
(2, 'Edited', '2016-02-29T00:02:00+03:00', '2016-02-29T00:02:00+03:00', '0'),
(3, 'Lolo', '2016-03-03T00:03:00+Africa/Nairobi', '2016-03-03T00:03:00+Africa/Nairobi', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `role`, `status`) VALUES
(1, 'Lorine 2', 'Osudo 2', '0724844946', 'talonalorine@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'admin', 1),
(2, 'Kevin', 'Maina', '0724844946', 'nimzy.maina@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'patient', 1),
(3, 'willis', 'osudo', '0722828265', 'williso@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'doctor', 1),
(4, 'owour', 'ochieng', '0788455667', 'ochieng@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'patient', 1),
(5, 'owour', 'ochieng', '0788455667', 'ochieng@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'patient', 1),
(6, 'orlando', 'bluers', '0722722772', 'nochieng@strathmore.edu', '20eabe5d64b0e216796e834f52d61fd0b70332fc', 'patient', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
