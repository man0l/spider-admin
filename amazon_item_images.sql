-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 11 авг 2015 в 16:37
-- Версия на сървъра: 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ebay`
--

-- --------------------------------------------------------

--
-- Структура на таблица `amazon_item_images`
--

CREATE TABLE IF NOT EXISTS `amazon_item_images` (
`id` int(11) NOT NULL,
  `amazon_id` int(11) NOT NULL,
  `asin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `amazon_item_images`
--

INSERT INTO `amazon_item_images` (`id`, `amazon_id`, `asin`, `path`, `image_url`, `display_order`, `updated_at`, `created_at`) VALUES
(1, 4, 'B003621UT4', 'full/f0c1cd10a55218cea157bd413e5e74d9806ed378.jpg', 'http://ecx.images-amazon.com/images/I/714SMuzBY3L._SL1500_.jpg', 0, '2015-08-10 16:50:41', '2015-08-10 16:50:41'),
(2, 4, 'B003621UT4', 'full/5ebd08d8c1d588c4f8a2c22696c6eedc1f383afe.jpg', 'http://ecx.images-amazon.com/images/I/A18J1tXphmL._SL1500_.jpg', 0, '2015-08-10 16:50:41', '2015-08-10 16:50:41'),
(3, 4, 'B003621UT4', 'full/259cc81d69498b3927fed54ec9c9d0042fe07060.jpg', 'http://ecx.images-amazon.com/images/I/91VeQjQ226L._SL1500_.jpg', 0, '2015-08-10 16:50:41', '2015-08-10 16:50:41'),
(4, 4, 'B003621UT4', 'full/14b90bca56fb425a862e05587eb688c8d891744f.jpg', 'http://ecx.images-amazon.com/images/I/A1s0h-FE%2BEL._SL1500_.jpg', 0, '2015-08-10 16:50:41', '2015-08-10 16:50:41'),
(5, 4, 'B003621UT4', 'full/2024e191f26249c8a91bf8bac99346b3dba64f73.jpg', 'http://ecx.images-amazon.com/images/I/91H6JW2BnDL._SL1500_.jpg', 0, '2015-08-10 16:50:41', '2015-08-10 16:50:41'),
(6, 6, 'B00MA92E2Q', 'full/e91d1a25291eb9d705fe472041fa9ea80a45a689.jpg', 'http://ecx.images-amazon.com/images/I/61P%2BS2kl1NL._SL1200_.jpg', 0, '2015-08-10 16:50:58', '2015-08-10 16:50:58'),
(7, 6, 'B00MA92E2Q', 'full/6146907a7f8195aab675a25ca11d5d07da7967ff.jpg', 'http://ecx.images-amazon.com/images/I/61cWFF-jCBL._SL1500_.jpg', 0, '2015-08-10 16:50:58', '2015-08-10 16:50:58'),
(8, 6, 'B00MA92E2Q', 'full/856d68422915f04169e5798ecbe969aaaedfdb87.jpg', 'http://ecx.images-amazon.com/images/I/81hwEAhQlUL._SL1500_.jpg', 0, '2015-08-10 16:50:58', '2015-08-10 16:50:58'),
(9, 6, 'B00MA92E2Q', 'full/ceef099d952e4fe250211a291993d7435e47d6e1.jpg', 'http://ecx.images-amazon.com/images/I/91xLklOsGSL._SL1500_.jpg', 0, '2015-08-10 16:50:58', '2015-08-10 16:50:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amazon_item_images`
--
ALTER TABLE `amazon_item_images`
 ADD PRIMARY KEY (`id`), ADD KEY `asin` (`asin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amazon_item_images`
--
ALTER TABLE `amazon_item_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
