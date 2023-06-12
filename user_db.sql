-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2023 at 01:56 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `image_path`, `product_name`, `product_price`) VALUES
(1, './assets/Images/produits/1-1.jpg', 'hp omen 17', '1999.989990234375');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image_path`, `product_name`, `product_price`) VALUES
(1, './assets/Images/produits/1-1.jpg', 'hp omen 17', 1999.99),
(2, './assets/Images/produits/2-2.jpg', 'azus ROG strix', 1999.99),
(3, './assets/Images/produits/3-3.jpg', 'MSI pulse 15', 1999.99),
(4, './assets/Images/produits/22.jpg', 'Apple 16\" mackbook pro', 3249),
(5, './assets/Images/produits/1.webp', 'supermicro MBD', 717),
(6, './assets/Images/produits/2.webp', 'supermicro MBD-X', 802),
(7, './assets/Images/produits/3.jpg', 'INTEL XEON CPU', 930),
(8, './assets/Images/produits/4.jpg', 'INTEL SSD D3-S4', 368.75),
(9, './assets/Images/produits/5.jpg', 'INTEL SSD DC-P4', 950),
(10, './assets/Images/produits/27.jpg', 'AMD Ryzen 9', 699),
(11, './assets/Images/produits/6.jpg', 'HPE P2', 339),
(12, './assets/Images/produits/7.jpg', 'seagate exos', 168),
(13, './assets/Images/produits/26.jpg', 'intel core i9-13900K', 569.99),
(14, './assets/Images/produits/8.jpg', '32G DDR4', 50),
(15, './assets/Images/produits/9.jpg', 'Lenovo 4ZC7', 78),
(16, './assets/Images/produits/10.jpg', 'DELL battery', 59.99),
(17, './assets/Images/produits/11.jpg', 'macBook air battery', 59.99),
(18, './assets/Images/produits/24.jpg', 'BTI 6-Cell battery', 92.26),
(19, './assets/Images/produits/12.jpg', 'NVIDIA QUADRO 8G', 360),
(20, './assets/Images/produits/13.jpg', 'CMP 70HX', 350),
(21, './assets/Images/produits/14.jpg', 'Laptop LCD Screen FHD 1920×1080', 109.99),
(22, './assets/Images/produits/15.jpg', 'Laptop LCD Screen FHD 1920×1080', 113.99),
(23, './assets/Images/produits/16.jpg', 'Logitch MX keyboard', 119.99),
(24, './assets/Images/produits/17.jpg', 'Logitch MX MAC keyboard', 119.99),
(25, './assets/Images/produits/23.jpg', 'apple magic keyboard', 139.99),
(26, './assets/Images/produits/18.jpg', 'logitch M510 Mouse', 27.99),
(27, './assets/Images/produits/19.jpg', 'logitch MX 3S Mouse', 95.98),
(28, './assets/Images/produits/20.jpg', 'apple magic mouse', 99),
(29, './assets/Images/produits/21.jpg', 'Gigabyte geforce RTX', 1699.99),
(30, './assets/Images/produits/28.jpg', 'HP chargeur HSTNN', 19.99);

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

DROP TABLE IF EXISTS `user_form`;
CREATE TABLE IF NOT EXISTS `user_form` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
