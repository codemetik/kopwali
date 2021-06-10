-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2021 pada 07.52
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
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` char(15) NOT NULL,
  `id_user` char(15) NOT NULL,
  `tgl_join` date NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_sekarang` varchar(100) NOT NULL,
  `no_telpn` char(15) NOT NULL,
  `simpanan_pokok` int(15) NOT NULL,
  `tgl_entry` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `id_user`, `tgl_join`, `nama_lengkap`, `tempat_lahir`, `tgl_lahir`, `alamat_sekarang`, `no_telpn`, `simpanan_pokok`, `tgl_entry`) VALUES
('MBR0002', 'US018', '2021-06-06', 'Ahmad Bagus', 'Bandung Bandowoso', '2013-02-27', 'Bandung laut', '089888777111', 50000, '2021-06-07'),
('MBR0003', 'US016', '2021-06-08', 'Andi Liau', 'Jakarta', '1992-11-03', 'Jakarta', '089888777665', 50000, '2021-06-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_simpanan`
--

CREATE TABLE `tb_jenis_simpanan` (
  `id_jenis_simpanan` char(15) NOT NULL,
  `pokok` int(30) NOT NULL,
  `wajib` int(30) NOT NULL,
  `sukarela` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_simpanan`
--

INSERT INTO `tb_jenis_simpanan` (`id_jenis_simpanan`, `pokok`, `wajib`, `sukarela`) VALUES
('SMPN01', 50000, 3500000, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_level_user`
--

CREATE TABLE `tb_level_user` (
  `id_level_user` char(5) NOT NULL,
  `name_level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_level_user`
--

INSERT INTO `tb_level_user` (`id_level_user`, `name_level`) VALUES
('LV01', 'OWNER'),
('LV02', 'ADMINISTRATORS'),
('LV03', 'MEMBERS');

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
('R0001', 'LV02', 'US001'),
('R0002', 'LV01', 'US003'),
('R0003', 'LV01', 'US004'),
('R0004', 'LV01', 'US005'),
('R0005', 'LV01', 'US006'),
('R0006', 'LV01', 'US007'),
('R0007', 'LV02', 'US008'),
('R0008', 'LV02', 'US009'),
('R0009', 'LV02', 'US010'),
('R0015', 'LV03', 'US016'),
('R0016', 'LV03', 'US017'),
('R0017', 'LV03', 'US018'),
('R0018', 'LV03', 'US019'),
('R0019', 'LV03', 'US020'),
('R0020', 'LV03', 'US021'),
('R0021', 'LV03', 'US022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_simpanan`
--

CREATE TABLE `tb_simpanan` (
  `id_simpanan` char(15) NOT NULL,
  `tgl_simpan` date NOT NULL,
  `jenis_simpanan` varchar(15) NOT NULL,
  `jumlah_wajib` int(10) NOT NULL,
  `jumlah_sukarela` int(10) NOT NULL,
  `id_user` char(15) NOT NULL,
  `id_anggota` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_simpanan`
--

INSERT INTO `tb_simpanan` (`id_simpanan`, `tgl_simpan`, `jenis_simpanan`, `jumlah_wajib`, `jumlah_sukarela`, `id_user`, `id_anggota`) VALUES
('SIM001', '2021-06-07', 'wajib', 3500000, 0, 'US016', 'MBR0003'),
('SIM002', '2021-06-08', 'sukarela', 0, 100000, 'US016', 'MBR0003'),
('SIM003', '2021-06-08', 'sukarela', 0, 700000, 'US016', 'MBR0003'),
('SIM004', '2021-07-01', 'wajib, sukarela', 3500000, 50000, 'US016', 'MBR0003'),
('SIM005', '2021-08-01', 'wajib', 3500000, 0, 'US016', 'MBR0003');

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
('US001', 'admin', 'admin', 'admin'),
('US003', 'op', 'op', 'op'),
('US004', 'op1', 'op1', 'op1'),
('US005', 'op2', 'op2', 'op2'),
('US006', 'op3', 'op3', 'op3'),
('US007', 'op4', 'op4', 'op4'),
('US008', 'admin1', 'admin1', 'admin1'),
('US009', 'admin2', 'admin2', 'admin2'),
('US010', 'admin3', 'admin3', 'admin3'),
('US016', 'andi', 'andi', 'andi'),
('US017', 'dian', 'dian', 'dian'),
('US018', 'bagus', 'bagus', 'bagus'),
('US019', 'kali', 'kali', 'kali'),
('US020', 'kamil', 'kamil', 'kamil'),
('US021', 'bunga', 'bunga', 'bunga'),
('US022', 'dodi', 'dodi', 'dodi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_jenis_simpanan`
--
ALTER TABLE `tb_jenis_simpanan`
  ADD PRIMARY KEY (`id_jenis_simpanan`);

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
-- Indeks untuk tabel `tb_simpanan`
--
ALTER TABLE `tb_simpanan`
  ADD PRIMARY KEY (`id_simpanan`);

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
