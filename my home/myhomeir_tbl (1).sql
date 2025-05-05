-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 05, 2025 at 07:09 PM
-- Server version: 8.0.42
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhomeir_tbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--
CREATE TABLE `category` (
  `id` int NOT NULL,
  `icon` text,
  `title` varchar(255) NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `description` text,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `click_action`
--
CREATE TABLE `click_action` (
  `id` int NOT NULL,
  `type` text NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company`
--
CREATE TABLE `company` (
  `id` int NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` int NOT NULL DEFAULT '0',
  `url` text,
  `qr_code` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '1',
  `deleted_at` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_category_product_position`
--
CREATE TABLE `company_category_product_position` (
  `id` int NOT NULL,
  `product_id` int NOT NULL DEFAULT '0' COMMENT 'user product info save from in site pages',
  `company_id` int NOT NULL DEFAULT '0',
  `position_id` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL DEFAULT '0' COMMENT 'در صورت صفر بودن در صفحه اول نمایش می دهد',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_map`
--
CREATE TABLE `company_map` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lat` text NOT NULL,
  `lon` text NOT NULL,
  `description` text,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_meet`
--
CREATE TABLE `company_meet` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `result` text,
  `status` int NOT NULL DEFAULT '0' COMMENT 'بررسی اجرایی شدن یا در حال اجرا شدن',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `run_time` datetime DEFAULT NULL COMMENT 'تاریخ فراخوان دسته جمعی'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_meet_user`
--
CREATE TABLE `company_meet_user` (
  `id` int NOT NULL,
  `company_meet_id` int NOT NULL,
  `request_company_user_id` int NOT NULL COMMENT 'کسی که ازش درخواست جلسه شده',
  `from_company_user_id` int NOT NULL COMMENT 'کسی که از بقیه تقاضای جلسه داره',
  `status` int NOT NULL DEFAULT '0' COMMENT 'قبول وضعیت از سمت گیرنده که در صورت صفر بودن از سمت فرستنده زمان تایید شده است و در صورت دو بودن از سمت گیرنده زمان تایید شده است و در صورت سه بودن مورد تایید تنظیم کننده جلسات است',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `run_time` datetime DEFAULT NULL COMMENT 'تاریخ جلسه انفرادی'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_role`
--
CREATE TABLE `company_role` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `company_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_role_request`
--
CREATE TABLE `company_role_request` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `role_id` int NOT NULL,
  `text` text COMMENT 'توضیحات تکمیلی',
  `status` int NOT NULL DEFAULT '1',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_task`
--
CREATE TABLE `company_task` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `result` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL DEFAULT '0',
  `dead_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_task_user`
--
CREATE TABLE `company_task_user` (
  `id` int NOT NULL,
  `company_task_id` int NOT NULL,
  `request_company_user_id` int NOT NULL,
  `from_company_user_id` int NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `run_time` datetime DEFAULT NULL,
  `suggest_time` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT 'وصعیت قبول کردن یا رد کردن که در صورت دو بودن کارمند رد درخواست کرده است'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_user`
--
CREATE TABLE `company_user` (
  `id` int NOT NULL,
  `company_role_id` int NOT NULL,
  `company_role_parent_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT 'در صورت صفر بودن اینشغل در انتظار تایید میباشد وفقط درخواست ارسال شده ودر صورت یک بودن درخواست پذیرفته شده و در صورت دو بودن کاربر درانتظار کارگزینی می باشد',
  `deleted_at` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `company_user_access`
--
CREATE TABLE `company_user_access` (
  `id` int NOT NULL,
  `company_user_id` int NOT NULL,
  `company_category_product` int NOT NULL,
  `is_position` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `notification`
--
CREATE TABLE `notification` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `wallet_payment_id` int NOT NULL DEFAULT '0',
  `package_company_order_id` int NOT NULL DEFAULT '0',
  `seen` int NOT NULL DEFAULT '0',
  `time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `package`
--  
CREATE TABLE `package` (
  `id` int NOT NULL,
  `logo` text,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int NOT NULL,
  `off_code` text,
  `off_date` date DEFAULT NULL,
  `exp_time_count` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `package_company_order`
--
CREATE TABLE `package_company_order` (
  `id` int NOT NULL,
  `company_id` int NOT NULL,
  `package` int NOT NULL,
  `payment` int NOT NULL DEFAULT '0' COMMENT 'Payment id in payment table value\r\nدر صورت صفر بودن مقدار این فیلد پرداخت انجام نشده یا این پکیج رایگان است',
  `factor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'وضعیت فاکتور که در زمان نداشتن مقدار پرداخت نشده است',
  `end_time` datetime DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'زمان ثبت فاکتور'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `payment`
--
CREATE TABLE `payment` (
  `id` int NOT NULL,
  `user_id_buier` int NOT NULL DEFAULT '0' COMMENT 'آیدی کیف پولی که باید مبلغ از آن کم شود و برای پکیج های شرکتی خریداری شده آیدی کیف پول خودم اعمال میشه و در صورت صفر بودن،افزایش موجودی کیف پول شخص در حال انجام است',
  `user_id_seller` int NOT NULL DEFAULT '0' COMMENT 'در صورت صفر بودن عملیات تسویه حساب انجام شده است',
  `pay_value` text NOT NULL,
  `factor_api_token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'جواب مثبت ارسالی توسط درگاه که رسید پرداخت است\r\nدر صورت جابجایی موجودی درون برنامه این مقدار خالی می شود',
  `status` int NOT NULL DEFAULT '0' COMMENT 'تاییدیه نهایی که از اشخاص برای پرداخت گرفته می شود'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position`
--
CREATE TABLE `position` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` text,
  `qr_code` text,
  `description` text,
  `position_type` int NOT NULL DEFAULT '0',
  `count_reserve` int NOT NULL DEFAULT '0' COMMENT 'تعداد مجاز رزرو جایگاه در روز که در صورت صفر بودن نا محدود است',
  `price` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT 'درصورت صفر بودن پر است و در صورت یک بودن خالی است',
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_chat`
--
CREATE TABLE `position_chat` (
  `id` int NOT NULL,
  `position_id` int NOT NULL,
  `position_user_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL,
  `text` text NOT NULL,
  `parent_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_form`
--
CREATE TABLE `position_form` (
  `id` int NOT NULL,
  `position_id` int NOT NULL,
  `position_form_question_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_form_question`
--
CREATE TABLE `position_form_question` (
  `id` int NOT NULL,
  `question` varchar(255) NOT NULL,
  `type_question` varchar(255) NOT NULL COMMENT 'مشخص کردن type برای input',
  `required` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_form_question_answer`
--
CREATE TABLE `position_form_question_answer` (
  `id` int NOT NULL,
  `position_form_question_id` int NOT NULL,
  `position_user_id` int NOT NULL,
  `user_answer_value` text NOT NULL,
  `user_id` int NOT NULL,
  `time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_image`
--
CREATE TABLE `position_image` (
  `id` int NOT NULL,
  `position_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_map`
--
CREATE TABLE `position_map` (
  `id` int NOT NULL,
  `title` text,
  `lat` text NOT NULL,
  `lng` text NOT NULL,
  `position_id` int NOT NULL,
  `description` text,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_product_order`
--
CREATE TABLE `position_product_order` (
  `id` int NOT NULL,
  `position_user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `payment_id` int NOT NULL DEFAULT '0' COMMENT 'payment id value in payment table\r\nدر صورت صفر بودن پرداخت انجام نشده',
  `count` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '0' COMMENT 'وضعیت پرداخت که در صورت صفر بودن پرداخت انجام نشده',
  `time` text COMMENT 'زمان پرداخت فاکتور که در صورت نداشتن مقدار پرداخت انجام نشده'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_tel`
--
CREATE TABLE `position_tel` (
  `id` int NOT NULL,
  `position_id` int NOT NULL,
  `tel` varchar(255) NOT NULL,
  `description` text,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_user`
--
CREATE TABLE `position_user` (
  `id` int NOT NULL,
  `position_id` int NOT NULL DEFAULT '0' COMMENT 'در صورت صفر بودن کاربر در حال خرید فوری است',
  `user_id` int NOT NULL,
  `time_reserve` time NOT NULL DEFAULT '00:00:00',
  `date_reserve` datetime DEFAULT NULL,
  `factor` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci COMMENT 'در صورت null بودن هزینه ی جایگاه پرداخت نشده است و در صورت انجام شدن خرید محصول فرایند خرید فوری اتفاق افتاده است',
  `status` int NOT NULL DEFAULT '0' COMMENT 'در صورت صفر بودن مشتری وارد جایگاه نشده است و در صورت یک بودن مشتری وارد جایگاه شده است و در صورت بدهکار بودن مشتری و دریافت وجه نقد مقدار دو می باشد و در صورت 3 بودن مشتری پرداخت محصولات را کامل انجام داده است و در صورت 4 بودن خدمات به پایان رسیده است و در صورت 5 بودن خدمات به مشکل خورده است و در صورت 6 بودن جایگاه با رضایت خالی شده است',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `position_video`
--
CREATE TABLE `position_video` (
  `id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `position_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `products`
--
CREATE TABLE `products` (
  `id` int NOT NULL,
  `icon` text,
  `qr_code` text,
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` text,
  `price` text,
  `status` int NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_change_value`
--
CREATE TABLE `product_change_value` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `is_costum` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `product_key_id` int NOT NULL DEFAULT '0',
  `product_value_id` int NOT NULL DEFAULT '0',
  `old_value` text NOT NULL,
  `new_value` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_chat`
--
CREATE TABLE `product_chat` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `text` text NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_images`
--
CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `address` text NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_keys`
--
CREATE TABLE `product_keys` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `key` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `responsive` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_map`
--
CREATE TABLE `product_map` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lat` text NOT NULL,
  `lon` text NOT NULL,
  `description` text,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_price_relations`
--
CREATE TABLE `product_price_relations` (
  `id` int NOT NULL,
  `description` text,
  `product_id` int NOT NULL,
  `price` varchar(255) DEFAULT NULL COMMENT 'مقدار ثابتی که با بقیه مقادیر جمع می شود',
  `product_price_id` int DEFAULT NULL COMMENT 'product id محصولی که قیمت آن مورد نیاز است',
  `zarib` float NOT NULL DEFAULT '1',
  `auto_change` int NOT NULL DEFAULT '0' COMMENT 'در صورت یک بودن هر بار با قیمت محصول دیگر به روز می شود',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_tel`
--
CREATE TABLE `product_tel` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `tel` varchar(50) NOT NULL,
  `description` text,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_values`
--
CREATE TABLE `product_values` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_key_id` int NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `product_videos`
--
CREATE TABLE `product_videos` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `address` text NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `roles`
--
CREATE TABLE `roles` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `site_api`
--
CREATE TABLE `site_api` (
  `id` int NOT NULL,
  `url` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `company_id` int NOT NULL,
  `api_key` text NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `id` int NOT NULL,
  `auth_info_id` int DEFAULT NULL,
  `user_info_id` int NOT NULL,
  `gmail_user_id` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `status` int NOT NULL DEFAULT '1',
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_auth_info`
--
CREATE TABLE `user_auth_info` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_cart`
--
CREATE TABLE `user_cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `cart_number` text NOT NULL,
  `cart_info` text,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_chat`
--
CREATE TABLE `user_chat` (
  `id` int NOT NULL,
  `user_sender_id` int DEFAULT NULL,
  `user_reciver_id` int DEFAULT NULL,
  `text` text NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_info`
--
CREATE TABLE `user_info` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL COMMENT 'در صورت کاربر مجازی بودن درخواست کاری ارسال شده است',
  `family` varchar(255) NOT NULL,
  `birthday` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `image` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `mely_code` text,
  `cart_mely_picture` text,
  `posty_code` text,
  `address` text,
  `phone` varchar(50) DEFAULT NULL,
  `gmail` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `home_tel` varchar(50) DEFAULT NULL,
  `robika_link` text,
  `telegram_link` text,
  `whatsapp_link` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_login`
--
CREATE TABLE `user_login` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `login` int NOT NULL,
  `ip` text NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_resume`
--
CREATE TABLE `user_resume` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `text` text NOT NULL COMMENT 'توضیحات سابقه کاری و میزان توانایی',
  `role_id` int NOT NULL COMMENT 'موقیت شغلی درخواستی',
  `status` int NOT NULL DEFAULT '1' COMMENT 'غیر فعال کردن رزومه توسط کاربر'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `user_resume_company_role_request`
--
CREATE TABLE `user_resume_company_role_request` (
  `id` int NOT NULL,
  `user_resume_id` int NOT NULL,
  `company_role_request_id` int NOT NULL,
  `role_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT 'در صورت صفر بودن توسط کاربر ارسال شده و در صورت یک بودن رزومه ی کاربر قبول شده و در صورت 2 بودن درخواست رد شده است',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `wallet`
--
CREATE TABLE `wallet` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `old_value` text,
  `value` text,
  `change_value` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Table structure for table `wallet_payment`
--
CREATE TABLE `wallet_payment` (
  `id` int NOT NULL,
  `wallet_id` int NOT NULL,
  `seller_wallet_id` int DEFAULT '0',
  `payment_id` int NOT NULL,
  `position_user_id` int NOT NULL DEFAULT '0',
  `position_product_order` int NOT NULL DEFAULT '0',
  `package_company_order` int NOT NULL DEFAULT '0',
  `self_wallet_action` int NOT NULL DEFAULT '0',
  `cart_id` int NOT NULL DEFAULT '0',
  `cart_action_status` int DEFAULT NULL COMMENT 'در صورت صفر بودن از طرف من پرداخت انجام نشده و در صورت یک بودن انجام شده و در صورت نال بودن تراکنش تسویه حساب نیست'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `click_action`
--
ALTER TABLE `click_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_category_product_position`
--
ALTER TABLE `company_category_product_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_map`
--
ALTER TABLE `company_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_meet`
--
ALTER TABLE `company_meet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_meet_user`
--
ALTER TABLE `company_meet_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_role`
--
ALTER TABLE `company_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_role_request`
--
ALTER TABLE `company_role_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_task`
--
ALTER TABLE `company_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_task_user`
--
ALTER TABLE `company_task_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_user`
--
ALTER TABLE `company_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_user_access`
--
ALTER TABLE `company_user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_company_order`
--
ALTER TABLE `package_company_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_chat`
--
ALTER TABLE `position_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_form`
--
ALTER TABLE `position_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_form_question`
--
ALTER TABLE `position_form_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_form_question_answer`
--
ALTER TABLE `position_form_question_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_image`
--
ALTER TABLE `position_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_map`
--
ALTER TABLE `position_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_product_order`
--
ALTER TABLE `position_product_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_tel`
--
ALTER TABLE `position_tel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_user`
--
ALTER TABLE `position_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_video`
--
ALTER TABLE `position_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_change_value`
--
ALTER TABLE `product_change_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_chat`
--
ALTER TABLE `product_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_keys`
--
ALTER TABLE `product_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_map`
--
ALTER TABLE `product_map`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_price_relations`
--
ALTER TABLE `product_price_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tel`
--
ALTER TABLE `product_tel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_values`
--
ALTER TABLE `product_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_videos`
--
ALTER TABLE `product_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_api`
--
ALTER TABLE `site_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_auth_info`
--
ALTER TABLE `user_auth_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_resume`
--
ALTER TABLE `user_resume`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_resume_company_role_request`
--
ALTER TABLE `user_resume_company_role_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_payment`
--
ALTER TABLE `wallet_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `click_action`
--
ALTER TABLE `click_action`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1294;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `company_category_product_position`
--
ALTER TABLE `company_category_product_position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1044;

--
-- AUTO_INCREMENT for table `company_map`
--
ALTER TABLE `company_map`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `company_meet`
--
ALTER TABLE `company_meet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `company_meet_user`
--
ALTER TABLE `company_meet_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `company_role`
--
ALTER TABLE `company_role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `company_role_request`
--
ALTER TABLE `company_role_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `company_task`
--
ALTER TABLE `company_task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `company_task_user`
--
ALTER TABLE `company_task_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `company_user`
--
ALTER TABLE `company_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `company_user_access`
--
ALTER TABLE `company_user_access`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_company_order`
--
ALTER TABLE `package_company_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `position_chat`
--
ALTER TABLE `position_chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `position_form`
--
ALTER TABLE `position_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `position_form_question`
--
ALTER TABLE `position_form_question`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `position_form_question_answer`
--
ALTER TABLE `position_form_question_answer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `position_image`
--
ALTER TABLE `position_image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `position_map`
--
ALTER TABLE `position_map`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `position_product_order`
--
ALTER TABLE `position_product_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `position_tel`
--
ALTER TABLE `position_tel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `position_user`
--
ALTER TABLE `position_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `position_video`
--
ALTER TABLE `position_video`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2323;

--
-- AUTO_INCREMENT for table `product_change_value`
--
ALTER TABLE `product_change_value`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242986;

--
-- AUTO_INCREMENT for table `product_chat`
--
ALTER TABLE `product_chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `product_keys`
--
ALTER TABLE `product_keys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20434;

--
-- AUTO_INCREMENT for table `product_map`
--
ALTER TABLE `product_map`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `product_price_relations`
--
ALTER TABLE `product_price_relations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `product_tel`
--
ALTER TABLE `product_tel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_values`
--
ALTER TABLE `product_values`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54225;

--
-- AUTO_INCREMENT for table `product_videos`
--
ALTER TABLE `product_videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `site_api`
--
ALTER TABLE `site_api`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `user_auth_info`
--
ALTER TABLE `user_auth_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=896;

--
-- AUTO_INCREMENT for table `user_resume`
--
ALTER TABLE `user_resume`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_resume_company_role_request`
--
ALTER TABLE `user_resume_company_role_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;

--
-- AUTO_INCREMENT for table `wallet_payment`
--
ALTER TABLE `wallet_payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
