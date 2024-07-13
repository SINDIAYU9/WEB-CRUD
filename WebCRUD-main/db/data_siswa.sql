-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Jul 2024 pada 13.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_siswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nim` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tmpt_Lahir` varchar(50) NOT NULL,
  `tgl_Lahir` date NOT NULL,
  `jekel` enum('Laki - Laki','Perempuan') NOT NULL,
  `jurusan` enum('Teknik Mesin','Teknik Elektronika','Teknik Industri') NOT NULL,
  `email` varchar(255) NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `ayah` varchar(255) NOT NULL,
  `ibu` varchar(255) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nim`, `nama`, `tmpt_Lahir`, `tgl_Lahir`, `jekel`, `jurusan`, `email`, `telpon`, `ayah`, `ibu`, `nik`, `kelas`, `tahun_masuk`, `gambar`, `alamat`) VALUES
('2302056', 'Wilson Sitompul', 'Kisaran', '2002-09-18', 'Laki - Laki', 'Teknik Elektronika', 'w@w', '1234567890', 'Ayah Wilson', 'Ibu Wilson', '1234567890123456', 'Kelas A', '2020', '668e4219b1ba3.png', 'Tangerang\r\n'),
('2303058', 'Haikal Sanjaya Wijaya', 'Ternate', '2004-12-12', 'Laki - Laki', 'Teknik Mesin', 'haikal@q', '0987654321', 'Ayah Haikal', 'Ibu Haikal', '6543210987654321', 'Kelas B', '2021', '668e42d0cb7ac.jpg', 'Bogor'),
('43', 'gfrg', 'dsg', '1222-12-12', 'Laki - Laki', 'Teknik Industri', 'w@w', '', '', '', '', '', '0000', '66905412b6402.png', 'fgf'),
('2302018', 'Dhito Adhitya', 'Sragen', '2003-05-04', 'Laki - Laki', 'Teknik Elektronika', 'dhitoadhitya@gmail.com', '', '', '', '', '', '0000', '6690cdd452d53.jpg', 'villa regency II'),
('10', 'Adit', 'dsdf', '2002-09-28', 'Laki - Laki', 'Teknik Industri', 'w@e', '', '', '', '', '', '0000', '66925ff6bf1cf.png', 'gvh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'Admin', 'admin'),
(2, 'wilson', '$2y$10$QcUjdbjKl3J1Q1Urqvh.leThXLnzu8RQYrfYDRuSokr43lhrq2V/a'),
(3, '', '$2y$10$3KnCofScxTmmMmkoZVJ5i.Fj0H8t/3sCr.Wyw9MFuZSnNADMHDoh.'),
(4, 'wilson sitompul', '$2y$10$rw528h7g6IGDrphAfwN7..GMit.uDy/aiB.OZTbnyiVZMqK7OAGky'),
(5, 'po1', '$2y$10$pKd.YqvmmPuA/zXSKsHADOQvxDju33NLg0ctdluVE4hBhHncYF6Ia');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
