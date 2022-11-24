-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2022 at 10:02 AM
-- Server version: 5.7.36
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_12_17_102544_create-user-table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `email`, `gender`, `location`, `picture`, `created_at`, `updated_at`) VALUES
(1, 'Ms Victoria Lévesque', 'B19 H88-2360', 'victoria.levesque@example.com', 'female', 'Simcoe St,Greenwood,Newfoundland and Labrador,Canada,O4H 5P0', 'https://randomuser.me/api/portraits/women/19.jpg', '2022-11-24 04:29:12', '2022-11-24 04:29:12'),
(2, 'Miss Jocenira da Cruz', '(58) 5709-7232', 'jocenira.dacruz@example.com', 'female', 'Rua São Pedro ,Serra,Amapá,Brazil,83858', 'https://randomuser.me/api/portraits/women/12.jpg', '2022-11-24 04:29:30', '2022-11-24 04:29:30'),
(3, 'Miss Nella Wuori', '06-842-0556', 'nella.wuori@example.com', 'Male', 'Suvantokatu,Lieto,Northern Savonia,Finland,95303', 'https://randomuser.me/api/portraits/women/14.jpg', '2022-11-24 04:29:39', '2022-11-24 04:31:25'),
(4, 'Mr Frederik Sørensen', '88728923', 'frederik.sorensen@example.com', 'male', 'Vordingborgvej,Ansager,Syddanmark,Denmark,18689', 'https://randomuser.me/api/portraits/men/29.jpg', '2022-11-24 04:29:44', '2022-11-24 04:29:44'),
(5, 'Mr Joachim Derks', '(0450) 562486', 'joachim.derks@example.com', 'male', 'Kruiswater,Geijsteren,Friesland,Netherlands,6701 OB', 'https://randomuser.me/api/portraits/men/49.jpg', '2022-11-24 04:29:54', '2022-11-24 04:29:54'),
(6, 'Miss Amparo Cano', '927-578-422', 'amparo.cano@example.com', 'female', 'Calle de Argumosa,Granada,Navarra,Spain,74414', 'https://randomuser.me/api/portraits/women/50.jpg', '2022-11-24 04:30:00', '2022-11-24 04:30:00'),
(7, 'Mrs Poppy Williams', '(178)-679-5365', 'poppy.williams@example.com', 'female', 'Penrose Road,Lower Hutt,Waikato,New Zealand,35429', 'https://randomuser.me/api/portraits/women/88.jpg', '2022-11-24 04:30:10', '2022-11-24 04:30:10'),
(8, 'Ms Kate Wang', '(105)-968-2270', 'kate.wang@example.com', 'female', 'Dyers Road,Masterton,Wellington,New Zealand,62212', 'https://randomuser.me/api/portraits/women/55.jpg', '2022-11-24 04:30:19', '2022-11-24 04:30:19'),
(9, 'Mr Steinar Roksvåg', '26398121', 'steinar.roksvag@example.com', 'male', 'Gangstuveien,Tanem,Trøndelag,Norway,0442', 'https://randomuser.me/api/portraits/men/48.jpg', '2022-11-24 04:30:42', '2022-11-24 04:30:42'),
(10, 'Miss Salma Pulido', '(676) 230 7253', 'salma.pulido@example.com', 'female', 'Prolongación Puebla,Chamula,Campeche,Mexico,84865', 'https://randomuser.me/api/portraits/women/50.jpg', '2022-11-24 04:30:50', '2022-11-24 04:30:50'),
(11, 'Mr Luukas Kinnunen', '02-474-638', 'luukas.kinnunen@example.com', 'male', 'Mechelininkatu,Vaala,South Karelia,Finland,89073', 'https://randomuser.me/api/portraits/men/10.jpg', '2022-11-24 04:30:55', '2022-11-24 04:30:55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
