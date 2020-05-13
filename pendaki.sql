-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 02:52 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaki`
--

-- --------------------------------------------------------

--
-- Table structure for table `cerita`
--

CREATE TABLE `cerita` (
  `id_cerita` int(11) NOT NULL,
  `namagunung` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cerita` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cerita`
--

INSERT INTO `cerita` (`id_cerita`, `namagunung`, `cerita`, `photo_id`) VALUES
(1, 'Gunung Semeru', 'Saya kembali lagi ke Kota Malang. Tujuan saya kali ini mendatangi Kota Malang adalah untuk mendaki Gunung Semeru. Menurut saya, kota apel ini seolah menjadi gerbang masuk ke beberapa lokasi menarik yang harus dikunjungi. Terakhir kali dari kota itu, saya punya pengalaman seru saat perjalanan ke Gunung Bromo dan berjanji untuk kembali. Meski hanya menumpang lewat saja, lama-lama saya jatuh cinta juga dengan kota ini.\r\n', 'upload/semeru.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gunung`
--

CREATE TABLE `gunung` (
  `id_gunung` char(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude_gunung` double NOT NULL,
  `longitude_gunung` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gunung`
--

INSERT INTO `gunung` (`id_gunung`, `nama`, `deskripsi`, `foto`, `lokasi`, `latitude_gunung`, `longitude_gunung`) VALUES
('GSM', 'Gunung Semeru', 'Di kawasan Taman Nasional Bromo Tengger Semeru, berdiri sebuah gunung tegak berbentuk kerucut yang disebut dengan gunung Semeru.Merupakan satu dari sekian banyak Gunung di Jawa Timur dan juga Gunung tertinggi di Provinsi ini. Gunung kedua tertinggi di pulau Jawa. Gunung yang disebut dengan: “tempat tinggal para dewa”.', 'upload/foto123.jpg', 'Lumajang, Jawa Timur', -8.135009, 112.8179656);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`, `no_hp`) VALUES
('admin', 'admin', 'admin', 'admin', '099999');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cerita`
--
ALTER TABLE `cerita`
  ADD PRIMARY KEY (`id_cerita`);

--
-- Indexes for table `gunung`
--
ALTER TABLE `gunung`
  ADD PRIMARY KEY (`id_gunung`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cerita`
--
ALTER TABLE `cerita`
  MODIFY `id_cerita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
