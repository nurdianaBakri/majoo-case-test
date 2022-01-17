-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2022 pada 09.03
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `kd_kategori` varchar(255) NOT NULL,
  `nm_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`kd_kategori`, `nm_kategori`) VALUES
('7f345a94-7509-11ec-90d6-0242ac120003', 'Pro'),
('8bbf7c76-7509-11ec-90d6-0242ac120003', 'Advance'),
('93403198-7509-11ec-90d6-0242ac120003', 'Lifestyle'),
('ca2b3fd6-7509-11ec-90d6-0242ac120003', 'Dekstop');

--
-- Trigger `kategori_produk`
--
DELIMITER $$
CREATE TRIGGER `before_insert_kategori` BEFORE INSERT ON `kategori_produk` FOR EACH ROW SET new.kd_kategori = uuid()
;
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
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
-- Struktur dari tabel `product`
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
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`nama`, `deskripsi`, `kd_kategori`, `id_user`, `date`, `id_produk`, `harga`, `gambar`) VALUES
('Majo Advance', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '8bbf7c76-7509-11ec-90d6-0242ac120003', 0, '2022-01-17 00:43:36', '292c42ef-7769-11ec-a087-74852a1cb96f', 2700000, '1642405503264_.png'),
('Majoo Lifestyle', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '93403198-7509-11ec-90d6-0242ac120003', 0, '2022-01-17 00:45:50', '791d204e-7769-11ec-a087-74852a1cb96f', 2700000, '1642405558096_.png'),
('Majoo Dekstop', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 'ca2b3fd6-7509-11ec-90d6-0242ac120003', 0, '2022-01-17 07:57:03', '8ed1ebfb-7769-11ec-a087-74852a1cb96f', 2700000, '1642405600009_.png'),
('Majo Pro', '<div>Overview</div>\r\n\r\n<p>Bootstrap’s form controls expand on <a href=\"https://getbootstrap.com/docs/4.0/content/reboot/#forms\">our Rebooted form styles</a> with classes. Use these classes to opt into their customized displays for a more consistent rendering across browsers and devices.</p>\r\n\r\n<p>Be sure to use an appropriate <code>type</code> attribute on all inputs (e.g., <code>email</code> for email address or <code>number</code> for numerical information) to take advantage of newer input controls like email verification, number selection, and more.</p>\r\n\r\n<p>Here’s a quick example to demonstrate Bootstrap’s form styles. Keep reading for documentation on required classes, form layout, and more.</p>', '7f345a94-7509-11ec-90d6-0242ac120003', 0, '2022-01-16 08:33:36', 'ae1a44a6-76e1-11ec-9d0d-cc52af813725', 2700000, '1642405658289_.png');

--
-- Trigger `product`
--
DELIMITER $$
CREATE TRIGGER `before_insert_mytable` BEFORE INSERT ON `product` FOR EACH ROW SET new.id_produk = uuid()
;
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_login`
--

CREATE TABLE `user_login` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user_login`
--

INSERT INTO `user_login` (`id`, `username`, `password`, `role`, `nama`) VALUES
(34, 'diana', 'f2236cde04bd2f79f5566473614f17e7', 0, 'diana');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`kd_kategori`) USING BTREE;

--
-- Indeks untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`) USING BTREE;

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_produk`,`nama`);

--
-- Indeks untuk tabel `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT untuk tabel `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
