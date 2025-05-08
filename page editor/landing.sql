-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2025 at 05:05 AM
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
-- Database: `landing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_ala`
--

CREATE TABLE `admin_login_ala` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin_login_ala`
--

INSERT INTO `admin_login_ala` (`id`, `username`, `password`, `time`) VALUES
(3, 'daniyal', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2021-10-03 12:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `bottommenu`
--

CREATE TABLE `bottommenu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leftmenu`
--

CREATE TABLE `leftmenu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `leftmenu`
--

INSERT INTO `leftmenu` (`id`, `name`, `link`, `head`, `pos`, `time`) VALUES
(13, 'محصولات', 'frd', 'منوی اصلی', 'منوی چپ صفحه', '2021-10-10 14:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `menuname`
--

CREATE TABLE `menuname` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menuname`
--

INSERT INTO `menuname` (`id`, `name`, `link`, `head`, `pos`, `time`) VALUES
(49, 'محصولات', 'frd', 'منوی اصلی', 'منوی چپ صفحه', '2021-10-10 14:04:44');

-- --------------------------------------------------------

--
-- Table structure for table `menu_tbl`
--

CREATE TABLE `menu_tbl` (
  `id` int(11) NOT NULL,
  `titleMenu` varchar(255) NOT NULL,
  `idMenu` varchar(255) NOT NULL,
  `placeMenu` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `menu_tbl`
--

INSERT INTO `menu_tbl` (`id`, `titleMenu`, `idMenu`, `placeMenu`, `time`) VALUES
(7, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:45'),
(8, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:45'),
(9, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:45'),
(10, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:46'),
(11, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:46'),
(12, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:46'),
(13, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:46'),
(14, 'منوی اصلی', 'main', 'left Slider Menu', '2021-10-10 14:03:55'),
(15, 'منوی اصلی', 'main menu', 'top Navigation Menu', '2021-10-12 09:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `rightmenu`
--

CREATE TABLE `rightmenu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE `sheets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `words` int(12) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `topmenu`
--

CREATE TABLE `topmenu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login_ala`
--
ALTER TABLE `admin_login_ala`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bottommenu`
--
ALTER TABLE `bottommenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leftmenu`
--
ALTER TABLE `leftmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuname`
--
ALTER TABLE `menuname`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_tbl`
--
ALTER TABLE `menu_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rightmenu`
--
ALTER TABLE `rightmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheets`
--
ALTER TABLE `sheets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topmenu`
--
ALTER TABLE `topmenu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login_ala`
--
ALTER TABLE `admin_login_ala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bottommenu`
--
ALTER TABLE `bottommenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leftmenu`
--
ALTER TABLE `leftmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menuname`
--
ALTER TABLE `menuname`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `menu_tbl`
--
ALTER TABLE `menu_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rightmenu`
--
ALTER TABLE `rightmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sheets`
--
ALTER TABLE `sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `topmenu`
--
ALTER TABLE `topmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
