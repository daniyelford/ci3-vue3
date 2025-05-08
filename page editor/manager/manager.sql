-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2022 at 06:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aladdin`
--
CREATE DATABASE IF NOT EXISTS `aladdin` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;
USE `aladdin`;
--
-- Database: `belgheys`
--
CREATE DATABASE IF NOT EXISTS `belgheys` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `belgheys`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_ala`
--

CREATE TABLE `admin_login_ala` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
--
-- Database: `ci_db`
--
CREATE DATABASE IF NOT EXISTS `ci_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_persian_ci;
USE `ci_db`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_answer`
--

CREATE TABLE `tbl_answer` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `username_answer` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `date_answer` int(11) NOT NULL,
  `content_answer` text COLLATE utf8_persian_ci NOT NULL,
  `role_answer` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_answer`
--

INSERT INTO `tbl_answer` (`id`, `ticket_id`, `username_answer`, `date_answer`, `content_answer`, `role_answer`) VALUES
(1, 6, 'سعید حجتی زاده', 1548186043, '<p style=\"direction: rtl;\">سلام مجدد</p>\r\n\r\n<p style=\"direction: rtl;\">مشکل من برطرف نشده است</p>\r\n', 'user'),
(2, 7, 'سعید حجتی زاده', 1548186097, '<p style=\"direction: rtl;\"><strong>از پاسخ شما ممنونم</strong></p>\r\n\r\n<p style=\"direction: rtl;\"><strong>مشکل رفع شد</strong></p>\r\n', 'user'),
(3, 6, 'سعید حجتی زاده', 1548186138, '<p style=\"direction: rtl;\"><strong>ممنون&nbsp;</strong></p>\r\n\r\n<p style=\"direction: rtl;\"><strong>مشکل رفع شد</strong></p>\r\n\r\n<p style=\"direction: rtl;\"><strong>سپاس از شما</strong></p>\r\n', 'user'),
(4, 6, 'سعید حجتی زاده', 1548186264, '<p style=\"direction: rtl;\"><strong>ممنون&nbsp;</strong></p>\r\n\r\n<p style=\"direction: rtl;\"><strong>مشکل رفع شد</strong></p>\r\n\r\n<p style=\"direction: rtl;\"><strong>سپاس از شما</strong></p>\r\n', 'user'),
(5, 6, 'سعید حجتی زاده', 1548186821, '<p style=\"direction: rtl;\">سلام</p>\r\n\r\n<p style=\"direction: rtl;\">باز مشکل در سایت ایجاد شده</p>\r\n\r\n<p style=\"direction: rtl;\">&nbsp;</p>\r\n', 'user'),
(6, 7, 'سعید حجتی زاده', 1548186850, '<p style=\"direction: rtl;\">خسته نباشید</p>\r\n', 'user'),
(7, 2, 'سعید حجتی زاده', 1548518870, '<p style=\"direction: rtl;\">سلام</p>\r\n\r\n<p style=\"direction: rtl;\">لطفا به طور کامل مشکل را شرح دهید</p>\r\n', 'sup'),
(8, 2, 'مسعود', 1548519138, '<p>مشکل در کند بودن سیستم در فایرفاکس می باشد</p>\r\n', 'user'),
(9, 2, 'سعید حجتی زاده', 1548519595, '<p style=\"direction: rtl;\">ما بررسی کردیم مشکلی نبود لطفا با سیستم دیگر و با مرورگر فایر فاکس آن تست کنید</p>\r\n', 'sup'),
(10, 2, 'مسعود', 1548519615, '<p>تست کردم حق با شماست</p>\r\n', 'user'),
(11, 2, 'سعید حجتی زاده', 1548520822, '<p style=\"direction: rtl;\">خواهش می کنم موفق باشید</p>\r\n', 'sup'),
(12, 4, 'سعید حجتی زاده', 1548520910, '<p style=\"direction: rtl;\">سلام</p>\r\n\r\n<p style=\"direction: rtl;\">به درستی کار میکند</p>\r\n', 'sup'),
(13, 4, 'وحید حجتی زاده', 1548520930, '<p>بله بسیار عالی</p>\r\n', 'user'),
(14, 1, '', 1548521092, '<p>سلام برشما</p>\r\n', 'sup'),
(15, 7, '', 1548521110, '<p>شما خسته نباشید</p>\r\n', 'sup'),
(16, 8, 'سعید حجتی زاده', 1548612440, '<p>سلام</p>\r\n\r\n<p>پیامک به درستی کار می کند</p>\r\n', 'sup'),
(17, 8, 'سعید حجتی زاده', 1548612500, '<p>سلام</p>\r\n\r\n<p>مجددا تست میکنم</p>\r\n', 'sup'),
(18, 11, 'دانیال', 1638565591, 'dfvfvdfv', 'admin'),
(19, 11, 'دانیال', 1638565656, 'dfvfvdfv', 'admin'),
(20, 11, 'دانیال', 1638565750, 'dfvfvdfv', 'admin'),
(21, 11, 'دانیال', 1638565845, 'dfvfvdfv', 'admin'),
(22, 11, 'دانیال', 1638565963, 'dfvfvdfv', 'admin'),
(23, 11, 'دانیال', 1638566015, 'dfvfvdfv', 'admin'),
(24, 11, 'دانیال', 1638566099, 'dfvfvdfv', 'admin'),
(25, 11, 'دانیال', 1638566393, 'dfvfvdfv', 'admin'),
(26, 11, 'دانیال', 1638566478, 'dfvfvdfv', 'admin'),
(27, 11, 'دانیال', 1638566889, 'dfvfvdfv', 'admin'),
(28, 4, 'دانیال', 1638567079, 'sdcdscsdc', 'admin'),
(29, 4, 'دانیال', 1638567226, 'sdcdscsdc', 'admin'),
(30, 4, 'دانیال', 1638567269, 'swddsd', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departemants`
--

CREATE TABLE `tbl_departemants` (
  `departemant_id` int(11) NOT NULL,
  `departemant_name` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `departemant_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_departemants`
--

INSERT INTO `tbl_departemants` (`departemant_id`, `departemant_name`, `departemant_status`) VALUES
(1, 'مالی', 1),
(5, 'فنی', 1),
(6, 'پیگیری سفارشات', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mainmenu`
--

CREATE TABLE `tbl_mainmenu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_persian_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_persian_ci NOT NULL DEFAULT '''#''',
  `pos` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `level` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `access` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_mainmenu`
--

INSERT INTO `tbl_mainmenu` (`id`, `title`, `link`, `pos`, `status`, `level`, `parent_id`, `access`) VALUES
(1, 'menu', '#', 'top', 1, 0, 0, ''),
(2, 'menu', '#', 'top', 1, 0, 0, ''),
(3, 'sdf', 'sdff', 'top', 1, 1, 1, ''),
(4, 'main', '\'#\'', 'right', 1, 0, 0, ''),
(5, 'main', '\'#\'', 'right', 1, 1, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_persian_ci NOT NULL,
  `content` text COLLATE utf8_persian_ci NOT NULL,
  `dep` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `id` int(11) NOT NULL,
  `ticket_title` varchar(100) COLLATE utf8_persian_ci NOT NULL,
  `ticket_dep_id` int(11) NOT NULL,
  `ticket_content` text COLLATE utf8_persian_ci NOT NULL,
  `ticket_date` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ticket_status` int(11) NOT NULL DEFAULT 0,
  `close_ticket` int(11) NOT NULL DEFAULT 0,
  `sender` varchar(50) COLLATE utf8_persian_ci NOT NULL DEFAULT 'show',
  `role` varchar(50) COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_tickets`
--

INSERT INTO `tbl_tickets` (`id`, `ticket_title`, `ticket_dep_id`, `ticket_content`, `ticket_date`, `user_id`, `ticket_status`, `close_ticket`, `sender`, `role`) VALUES
(1, 'تیکت اول', 1, 'سلام', 1548081596, 1, 1, 2, 'block', ''),
(2, 'مشکل سیستم', 5, 'سلام\r\nمشکلی وجود د ارد', 1548081640, 6, 2, 1, 'show', ''),
(4, 'تست ckeditro', 5, '<p>سلام</p>\r\n', 1548100155, 13, 1, 0, 'block', ''),
(5, 'تست', 5, '<h2 style=\"font-style:italic;\"><em><strong>سلام</strong></em></h2>\r\n\r\n<h2 style=\"font-style:italic;\"><em><strong>وقت بخیر</strong></em></h2>\r\n', 1548100215, 1, 1, 0, 'block', ''),
(6, 'تست', 6, '<h2 style=\"font-style:italic;\"><em><strong>سلام</strong></em></h2>\r\n\r\n<h2 style=\"font-style:italic;\"><em><strong>وقت بخیر</strong></em></h2>\r\n', 1548100357, 6, 0, 1, 'show', ''),
(7, 'تست دوم', 1, '<p style=\"direction: rtl;\">سلام</p>\r\n\r\n<ul dir=\"rtl\">\r\n	<li>نکته اول</li>\r\n</ul>\r\n', 1548100399, 6, 2, 2, 'show', ''),
(8, 'تست ارسال پیامک', 5, '<p>سلام</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1548612329, 13, 1, 0, 'block', ''),
(9, 'بر', 5, 'dfvdfv', 0, 12, 0, 3, 'block', 'admin'),
(10, 'بر', 5, 'dfvdfv', 0, 12, 0, 0, 'block', 'sup'),
(11, 'asdasd', 1, 'sdaadas', 1638564978, 15, 1, 3, 'show', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_persian_ci NOT NULL,
  `name_family` varchar(240) COLLATE utf8_persian_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8_persian_ci DEFAULT NULL,
  `pic` varchar(50) COLLATE utf8_persian_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_persian_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ticket_sender` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `name_family`, `email`, `mobile`, `pic`, `role`, `status`, `ticket_sender`) VALUES
(1, 'masoud', '654321', 'مسعود', 'hojjati@hojjati.com', '', '', 'admin', 0, 0),
(6, 'saeid', '123456', 'سعید حجتی زاده', 'hojjati@hojjati.com', '', '', 'user', 1, 1),
(11, 'shz67', '654321', 'سعید حجتی زاده', 'shz67@yahoo.com', '091914714712', '', 'sup', 0, 1),
(12, 'mhojjati', '123456', '', '', '', '', 'sup', 1, 0),
(14, 'danial', '123456', 'دانیال فرد', 'dnylfrd@gmail.com', '09336160295', '', 'admin', 1, 1),
(15, 'dani', '81dc9bdb52d04dc20036dbd8313ed055', 'دانیال', '', '', '20.jpg', 'admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_dep`
--

CREATE TABLE `tbl_user_dep` (
  `id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `tbl_user_dep`
--

INSERT INTO `tbl_user_dep` (`id`, `dep_id`, `user_id`) VALUES
(3, 5, 11),
(4, 1, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_departemants`
--
ALTER TABLE `tbl_departemants`
  ADD PRIMARY KEY (`departemant_id`);

--
-- Indexes for table `tbl_mainmenu`
--
ALTER TABLE `tbl_mainmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_dep`
--
ALTER TABLE `tbl_user_dep`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_answer`
--
ALTER TABLE `tbl_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_departemants`
--
ALTER TABLE `tbl_departemants`
  MODIFY `departemant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_mainmenu`
--
ALTER TABLE `tbl_mainmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_user_dep`
--
ALTER TABLE `tbl_user_dep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"ci_db\",\"table\":\"tbl_news\"},{\"db\":\"ci_db\",\"table\":\"tbl_tickets\"},{\"db\":\"ci_db\",\"table\":\"tbl_mainmenu\"},{\"db\":\"ci_db\",\"table\":\"tbl_users\"},{\"db\":\"ci_db\",\"table\":\"tbl_departments\"},{\"db\":\"ci_db\",\"table\":\"tbl_answer\"},{\"db\":\"aladdin\",\"table\":\"tbl_answer\"},{\"db\":\"pro\",\"table\":\"tbl_users\"},{\"db\":\"cd_database\",\"table\":\"tbl_department\"},{\"db\":\"berimkala\",\"table\":\"wp_dokan_announcement\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'ci_db', 'tbl_mainmenu', '{\"sorted_col\":\"`tbl_mainmenu`.`status` ASC\"}', '2021-11-29 08:41:29'),
('root', 'ci_db', 'tbl_tickets', '{\"sorted_col\":\"`tbl_tickets`.`sender` ASC\"}', '2021-12-04 07:42:48'),
('root', 'ci_db', 'tbl_users', '{\"sorted_col\":\"`tbl_users`.`ticket_sender` ASC\"}', '2021-12-03 20:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2022-01-12 05:36:46', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
