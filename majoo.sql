-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2022 at 05:46 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `majoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `kd_kategori` varchar(255) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kategori_produk`
--

INSERT INTO `kategori_produk` (`kd_kategori`, `nm_kategori`) VALUES
('7f345a94-7509-11ec-90d6-0242ac120003', 'Pro'),
('8bbf7c76-7509-11ec-90d6-0242ac120003', 'Advance'),
('93403198-7509-11ec-90d6-0242ac120003', 'Lifestyle'),
('ca2b3fd6-7509-11ec-90d6-0242ac120003', 'Dekstop');

--
-- Triggers `kategori_produk`
--
DELIMITER $$
CREATE TRIGGER `before_insert_kategori` BEFORE INSERT ON `kategori_produk` FOR EACH ROW SET new.kd_kategori = uuid()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(255) NOT NULL,
  `id_user` varchar(255) DEFAULT NULL,
  `data_lama` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `data_baru` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tgl_log` datetime(6) DEFAULT NULL,
  `jenis_log` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `nama` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `kd_kategori` varchar(522) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_produk` varchar(255) NOT NULL,
  `harga` float(255,0) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`nama`, `deskripsi`, `kd_kategori`, `id_user`, `date`, `id_produk`, `harga`, `gambar`) VALUES
('Majo Pro', '<div>Overview</div>\r\n\r\n<p>Bootstrap’s form controls expand on <a href=\"https://getbootstrap.com/docs/4.0/content/reboot/#forms\">our Rebooted form styles</a> with classes. Use these classes to opt into their customized displays for a more consistent rendering across browsers and devices.</p>\r\n\r\n<p>Be sure to use an appropriate <code>type</code> attribute on all inputs (e.g., <code>email</code> for email address or <code>number</code> for numerical information) to take advantage of newer input controls like email verification, number selection, and more.</p>\r\n\r\n<p>Here’s a quick example to demonstrate Bootstrap’s form styles. Keep reading for documentation on required classes, form layout, and more.</p>', '7f345a94-7509-11ec-90d6-0242ac120003', 0, '2022-01-16 08:33:36', 'ae1a44a6-76e1-11ec-9d0d-cc52af813725', 2700000, '');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `before_insert_mytable` BEFORE INSERT ON `product` FOR EACH ROW SET new.id_produk = uuid()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `password`, `role`, `nama`) VALUES
(34, 'diana', 'f2236cde04bd2f79f5566473614f17e7', 0, 'diana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`kd_kategori`) USING BTREE;

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_produk`,`nama`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
