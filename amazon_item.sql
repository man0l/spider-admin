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
-- Структура на таблица `amazon_item`
--

CREATE TABLE IF NOT EXISTS `amazon_item` (
`id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `reviews` float DEFAULT NULL,
  `soldBy` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isFBA` tinyint(1) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `availability` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isInStock` tinyint(1) DEFAULT NULL,
  `shortDesc` text COLLATE utf8_unicode_ci,
  `longDesc` text COLLATE utf8_unicode_ci,
  `longDescRaw` text COLLATE utf8_unicode_ci,
  `asin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `upc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ean` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dimensions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviewsNum` int(11) DEFAULT NULL,
  `sellerRank` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `amazon_item`
--

INSERT INTO `amazon_item` (`id`, `title`, `reviews`, `soldBy`, `isFBA`, `price`, `availability`, `isInStock`, `shortDesc`, `longDesc`, `longDescRaw`, `asin`, `upc`, `ean`, `mpn`, `dimensions`, `reviewsNum`, `sellerRank`, `updated_at`, `created_at`) VALUES
(4, 'Little Tikes 2-in-1 Snug ''n Secure Swing Blue', 4.7, 'Amazon', 1, 21.59, 'In Stock.', 1, '<ul><li>\n        </li><li> </li><li>above to make sure this fits.</li><li> Easy-in hinged T-bar</li><li> Stay-put shoulder straps hold baby securely in place</li><li> As the child grows and doesn''t require the T-bar or straps, they store conveniently out of the way</li><li> Durable and great for outdoor or indoor swing. This product does not come with anchors.</li><li> Made in USA</li>', '<p>The Little Tikes 2-in-1 Snug Secure Swing is for children who absolutely love to swing.This baby swing from Little Tikes is the perfect combination of safety and comfort.Caring parents will love all of the different safety features found on the Little Tikes swing.</p>', '<p>The Little Tikes 2-in-1 Snug Secure Swing is for children who absolutely love to swing.This baby swing from Little Tikes is the perfect combination of safety and comfort.Caring parents will love all of the different safety features found on the Little Tikes swing.</p>', 'B003621UT4', '', NULL, ' 617973', '\n    16 x 16.3 x 17 inches\n    ', 938, NULL, '2015-08-10 15:58:54', '2015-08-10 15:58:54'),
(5, 'Earth Heavy Duty VIP Tall Aluminum Director''s Chair', 4.7, 'Amazon', 1, 90.62, 'In Stock.', 1, '<ul><li> Larger Size, Much Stronger-- More Room</li><li> Extra Heavy-Duty, w/ Wider Tubing</li><li> Reinforced Aluminum Frame w/ 8-Points of</li><li> Two Layers of 600D Fabric for Extra Strength, also Fabric is Stain Resistant</li><li> Comfortable High Back & Foot Rests</li>', '<p>Earth Heavy Duty VIP Tall Director’s Chair w/Foot Rests and Side Storage Bag - Built Larger and Stronger!</p>', '<p>Earth Heavy Duty VIP Tall Director’s Chair w/Foot Rests and Side Storage Bag - Built Larger and Stronger!</p>', 'B0026T0LB6', '', NULL, ' EP18T', '\n    17 x 21 x 44 inches ; 10 pounds\n    ', 110, NULL, '2015-08-10 15:59:02', '2015-08-10 15:59:02'),
(6, 'Nite Ize Steelie Car Mount Kit', 4.3, 'Amazon', 1, 21.84, 'In Stock.', 1, '<ul><li> The Steelie Car Mount Kit allows secure attachment for any mobile device, with or without a rigid case, to any vehicle dash with unlimited viewing angles.</li><li> Each Steelie Car Mount Kit includes one Steelie Magnetic Phone Socket, one Steelie Ball Mount, an alcohol prep pad, 3M primer, and installation instructions.</li><li> Steelie Magnetic Phone Socket features a powerful neodymium magnet and silicon center to provide a strong grip and smooth glide. The neodymium magnet is safe for use with all phones and tablets.</li><li> Features 3M Primer. We recommend it be used when attaching the Ball Mount Component to a vinyl vehicle dash to create a durable bond.</li>', '<p>FEATURES of the Nite Ize Steelie Car Mount Kit Allows secure attachment for any mobile device, with or without a rigid case, to any vehicle dash with unlimited viewing angles Includes one Steelie Magnetic Phone Socket with 3M VHB adhesive pad, one Steelie Ball Mount with 3M VHB adhesive pad, an alcohol prep pad, and installation instructions Steelie Magnetic Phone Socket features a powerful neodymium magnet and silicon center to provide a strong grip and smooth glide The neodymium magnet is safe for use with all phones and tablets Both the Magnetic Phone Socket and Ball Mount components feature 3M VHB foam adhesive tape for secure attachment 3M VHB foam adhesive tape can be removed without damage to surfaces Steelie Ball Mount is a high quality steel ball that is press fit into the machined aluminum base for security High quality 6061 Machined Aluminum Magnetic Phone Socket and Ball Mount components for an elegant look and durable functionality Adjusts and holds in any viewing angle Compatible with other Steelie system components SPECIFICATIONS of the Nite Ize Steelie Car Mount Kit Weight: 2.50 oz / 71 g Dimension: 1.14 x 1.06 x 1.06" / 28.24 x 27.10 x 27.10 mm</p>', '<p>FEATURES of the Nite Ize Steelie Car Mount Kit Allows secure attachment for any mobile device, with or without a rigid case, to any vehicle dash with unlimited viewing angles Includes one Steelie Magnetic Phone Socket with 3M VHB adhesive pad, one Steelie Ball Mount with 3M VHB adhesive pad, an alcohol prep pad, and installation instructions Steelie Magnetic Phone Socket features a powerful neodymium magnet and silicon center to provide a strong grip and smooth glide The neodymium magnet is safe for use with all phones and tablets Both the Magnetic Phone Socket and Ball Mount components feature 3M VHB foam adhesive tape for secure attachment 3M VHB foam adhesive tape can be removed without damage to surfaces Steelie Ball Mount is a high quality steel ball that is press fit into the machined aluminum base for security High quality 6061 Machined Aluminum Magnetic Phone Socket and Ball Mount components for an elegant look and durable functionality Adjusts and holds in any viewing angle Compatible with other Steelie system components SPECIFICATIONS of the Nite Ize Steelie Car Mount Kit Weight: 2.50 oz / 71 g Dimension: 1.14 x 1.06 x 1.06" / 28.24 x 27.10 x 27.10 mm</p>', 'B00MA92E2Q', '', NULL, '', '', 734, NULL, '2015-08-10 15:59:09', '2015-08-10 15:59:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amazon_item`
--
ALTER TABLE `amazon_item`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amazon_item`
--
ALTER TABLE `amazon_item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
