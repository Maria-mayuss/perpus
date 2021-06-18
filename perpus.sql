-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 09:43 AM
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
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(3) NOT NULL,
  `nama_depan` varchar(30) NOT NULL,
  `nama_belakang` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_rumah` varchar(4) NOT NULL,
  `tempat` text NOT NULL,
  `ttl` date NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `telepon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_depan`, `nama_belakang`, `alamat`, `nomor_rumah`, `tempat`, `ttl`, `jenis_kelamin`, `telepon`) VALUES
(1, 'Shereen Beatrix ', 'Adhiwidjaja', 'Jln. Rappocini Raya Lrg. V No. ', '335 ', 'Ujung Pandang', '1999-08-18', 'Wanita', '082340626869'),
(2, 'Maria Yustina ', 'Tuga', 'Manunggal 31 No.', '98', 'Makassar', '2000-06-17', 'Wanita', '081342476509'),
(3, 'Meilanie Irene Lumme', 'Turandan', 'Perumahan Tamanlanrea (BTP)', '12', 'Makassar', '2000-11-10', 'Wanita', '089765467566'),
(4, 'Kartorius Walker ', 'Gozali', 'Jl.Macini Sawah No.', '20', 'Makassar', '2001-06-15', 'Pria', '089765432123'),
(5, 'Yulen Anse ', 'Pariury', 'Tanjung Alang lr. Tomo', '27', 'Kamarian', '2001-10-11', 'Wanita', '085345678908'),
(6, 'Fetriani ', 'Agatha', 'Tanjung Alang lr. Tomo', '27', 'Toraja', '2001-01-11', 'Wanita', '081235676781'),
(11, 'Riki', 'Rezki', 'Berua Indah', '23', 'Jepang', '2021-06-15', 'Pria', '085345678908');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(3) NOT NULL,
  `judul_buku` varchar(30) NOT NULL,
  `pengarang` text NOT NULL,
  `penerbit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`) VALUES
(1, 'Dasar Teknologi Informasi', 'Kadek', 'Erlangga');

-- --------------------------------------------------------

--
-- Table structure for table `meminjam`
--

CREATE TABLE `meminjam` (
  `id_pinjam` int(3) NOT NULL,
  `tgl_pinjam` datetime NOT NULL,
  `tgl_kembali` datetime(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meminjam`
--

INSERT INTO `meminjam` (`id_pinjam`, `tgl_pinjam`, `tgl_kembali`) VALUES
(2, '2021-06-17 17:17:16', '2021-06-17 18:35:27.0'),
(3, '2021-06-17 18:33:25', '2021-06-17 18:35:31.0'),
(4, '2021-06-17 18:33:40', '2021-06-17 18:35:47.0'),
(5, '2021-06-17 18:37:07', '2021-06-17 18:37:12.0'),
(7, '2021-06-17 18:46:22', '0000-00-00 00:00:00.0');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_detail_pinjam`
--

CREATE TABLE `tabel_detail_pinjam` (
  `id_pinjam` int(3) NOT NULL,
  `id_login` int(3) NOT NULL,
  `id_buku` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_detail_pinjam`
--

INSERT INTO `tabel_detail_pinjam` (`id_pinjam`, `id_login`, `id_buku`) VALUES
(2, 2, 1),
(3, 2, 1),
(4, 2, 1),
(5, 2, 1),
(7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_login`
--

CREATE TABLE `tabel_login` (
  `id_login` int(3) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_login`
--

INSERT INTO `tabel_login` (`id_login`, `email`, `password`) VALUES
(2, 'yustina.tuga17@gmail.com', '12345'),
(11, 'ian@ian.ian', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_login_level`
--

CREATE TABLE `tabel_login_level` (
  `id_anggota` int(3) NOT NULL,
  `level` enum('user','admin') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabel_login_level`
--

INSERT INTO `tabel_login_level` (`id_anggota`, `level`) VALUES
(2, 'admin'),
(11, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `meminjam`
--
ALTER TABLE `meminjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `tabel_detail_pinjam`
--
ALTER TABLE `tabel_detail_pinjam`
  ADD KEY `meminjam_id_pinjam_fk` (`id_pinjam`),
  ADD KEY `anggota_id_anggota_fk3` (`id_login`),
  ADD KEY `buku_id_buku_fk` (`id_buku`);

--
-- Indexes for table `tabel_login`
--
ALTER TABLE `tabel_login`
  ADD KEY `anggota_id_anggota_fk` (`id_login`);

--
-- Indexes for table `tabel_login_level`
--
ALTER TABLE `tabel_login_level`
  ADD KEY `anggota_id_anggota_fk1` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meminjam`
--
ALTER TABLE `meminjam`
  MODIFY `id_pinjam` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tabel_detail_pinjam`
--
ALTER TABLE `tabel_detail_pinjam`
  ADD CONSTRAINT `anggota_id_anggota_fk3` FOREIGN KEY (`id_login`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `buku_id_buku_fk` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `meminjam_id_pinjam_fk` FOREIGN KEY (`id_pinjam`) REFERENCES `meminjam` (`id_pinjam`);

--
-- Constraints for table `tabel_login`
--
ALTER TABLE `tabel_login`
  ADD CONSTRAINT `anggota_id_anggota_fk` FOREIGN KEY (`id_login`) REFERENCES `anggota` (`id_anggota`);

--
-- Constraints for table `tabel_login_level`
--
ALTER TABLE `tabel_login_level`
  ADD CONSTRAINT `anggota_id_anggota_fk1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
