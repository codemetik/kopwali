-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Apr 2021 pada 11.06
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level_user`
--

CREATE TABLE `tb_level_user` (
  `id_level_user` char(5) NOT NULL,
  `name_level` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_level_user`
--

INSERT INTO `tb_level_user` (`id_level_user`, `name_level`) VALUES
('LV01', 'PEMIL'),
('LV02', 'ADMIN'),
('LV03', 'NIK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_rols`
--

CREATE TABLE `tb_rols` (
  `id_rolsuser` char(5) NOT NULL,
  `id_level_user` char(5) NOT NULL,
  `id_user` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_rols`
--

INSERT INTO `tb_rols` (`id_rolsuser`, `id_level_user`, `id_user`) VALUES
('R0001', 'LV02', 'US1'),
('R0002', 'LV01', 'US3'),
('R0003', 'LV03', 'US2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` char(5) NOT NULL,
  `user` varchar(10) NOT NULL,
  `pass` varchar(225) NOT NULL,
  `confirm_pass` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `user`, `pass`, `confirm_pass`) VALUES
('US1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '21232f297a57a5a743894a0e4a801fc3'),
('US2', 'nik', 'f64609172efea86a5a6fbae12ab86d33', 'f64609172efea86a5a6fbae12ab86d33'),
('US3', 'op', '11d8c28a64490a987612f2332502467f', '11d8c28a64490a987612f2332502467f');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_level_user`
--
ALTER TABLE `tb_level_user`
  ADD PRIMARY KEY (`id_level_user`);

--
-- Indeks untuk tabel `tb_rols`
--
ALTER TABLE `tb_rols`
  ADD PRIMARY KEY (`id_rolsuser`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_level_user` (`id_level_user`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_rols`
--
ALTER TABLE `tb_rols`
  ADD CONSTRAINT `tb_rols_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rols_ibfk_2` FOREIGN KEY (`id_level_user`) REFERENCES `tb_level_user` (`id_level_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
