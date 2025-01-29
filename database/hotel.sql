-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2025 pada 13.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_pemesanan`
--

CREATE TABLE `form_pemesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `nomor_identitas` int(16) NOT NULL,
  `tipe_kamar` varchar(20) NOT NULL,
  `harga` int(50) NOT NULL,
  `tanggal_pesan` varchar(20) NOT NULL,
  `durasi_menginap` int(20) NOT NULL,
  `breakfeast` varchar(1) NOT NULL,
  `total_bayar` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `nomor_identitas` varchar(16) NOT NULL,
  `tipe_kamar` enum('Standar','Deluxe','Executive') NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `durasi_menginap` int(11) NOT NULL,
  `breakfeast` tinyint(1) NOT NULL DEFAULT 0,
  `total_bayar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `nama_pemesan`, `jenis_kelamin`, `nomor_identitas`, `tipe_kamar`, `harga`, `tanggal_pesan`, `durasi_menginap`, `breakfeast`, `total_bayar`) VALUES
(18, 'ddede', 'Laki-laki', '7868678676887867', 'Standar', 500000.00, '2024-12-11', 2, 1, 1080000.00),
(19, '121212', 'Laki-laki', '3232323232323232', 'Executive', 1500000.00, '2025-01-03', 2, 0, 3000000.00),
(20, 'abdul', 'Laki-laki', '7832748947284798', 'Executive', 1500000.00, '2025-01-12', 2, 1, 3080000.00);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `form_pemesanan`
--
ALTER TABLE `form_pemesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `form_pemesanan`
--
ALTER TABLE `form_pemesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
