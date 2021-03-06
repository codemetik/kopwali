-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2021 pada 19.04
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

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
('MBR0003', 'US016', '2020-11-08', 'Andi Liau', 'Jakarta', '1992-11-03', 'Jakarta', '089888777665', 50000, '2020-12-08'),
('MBR0004', 'US020', '2021-04-10', 'Akhmad Kamil Erad', 'Surabaya', '1998-06-01', 'Jakarta', '089891234232', 50000, '2021-04-10'),
('MBR0005', 'US021', '2020-01-02', 'Leo lenar', 'Pamulang', '1985-06-02', 'Pamulang', '090909898988', 50000, '2021-07-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_approv_pinjaman`
--

CREATE TABLE `tb_approv_pinjaman` (
  `id_approv_pin` int(100) NOT NULL,
  `id_pinjaman` char(15) NOT NULL,
  `tgl_approv` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_approv_pinjaman`
--

INSERT INTO `tb_approv_pinjaman` (`id_approv_pin`, `id_pinjaman`, `tgl_approv`, `status`) VALUES
(13, 'PIN001', '2021-06-29', 'approved'),
(16, 'PIN002', '2021-07-02', 'approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bunga`
--

CREATE TABLE `tb_bunga` (
  `id_bunga` int(15) NOT NULL,
  `jenis_bunga` varchar(20) NOT NULL,
  `jumlah_bunga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bunga`
--

INSERT INTO `tb_bunga` (`id_bunga`, `jenis_bunga`, `jumlah_bunga`) VALUES
(1, 'flat', '1.5'),
(2, 'efektif', '1.5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jasa_shu`
--

CREATE TABLE `tb_jasa_shu` (
  `no_jasa_shu` int(11) NOT NULL,
  `jenis_jasa_shu` varchar(25) NOT NULL,
  `presentasi_jasa` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jasa_shu`
--

INSERT INTO `tb_jasa_shu` (`no_jasa_shu`, `jenis_jasa_shu`, `presentasi_jasa`) VALUES
(1, 'Jasa Usaha Anggota', '0,070'),
(2, 'Jasa Modal Anggota', '0,105');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_pinjaman`
--

CREATE TABLE `tb_jenis_pinjaman` (
  `id_jenis_pinjaman` int(15) NOT NULL,
  `jenis_pinjaman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_pinjaman`
--

INSERT INTO `tb_jenis_pinjaman` (`id_jenis_pinjaman`, `jenis_pinjaman`) VALUES
(1, 'Utama'),
(2, 'Khusus');

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
('SMPN01', 50000, 30000, 15000);

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
-- Struktur dari tabel `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_pinjaman` char(15) NOT NULL,
  `id_anggota` char(15) NOT NULL,
  `tenor` int(10) NOT NULL,
  `tenor_ke` int(10) NOT NULL,
  `jumlah_bayar` varchar(100) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengembalian`
--

INSERT INTO `tb_pengembalian` (`id_pengembalian`, `id_pinjaman`, `id_anggota`, `tenor`, `tenor_ke`, `jumlah_bayar`, `tgl_bayar`) VALUES
(54, 'PIN001', 'MBR0003', 10, 1, '406000', '2021-06-29'),
(55, 'PIN001', 'MBR0003', 10, 2, '405400', '2021-06-29'),
(56, 'PIN001', 'MBR0003', 10, 3, '404800', '2021-07-02'),
(58, 'PIN002', 'MBR0005', 6, 1, '676667', '2021-07-03'),
(59, 'PIN002', 'MBR0005', 6, 2, '676667', '2021-07-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pinjaman`
--

CREATE TABLE `tb_pinjaman` (
  `id_pinjaman` char(15) NOT NULL,
  `id_anggota` char(15) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_entry` date NOT NULL,
  `id_bunga` char(15) NOT NULL,
  `id_jenis_pinjaman` char(15) NOT NULL,
  `jumlah_pinjaman` varchar(100) NOT NULL,
  `tenor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pinjaman`
--

INSERT INTO `tb_pinjaman` (`id_pinjaman`, `id_anggota`, `tgl_pinjam`, `tgl_entry`, `id_bunga`, `id_jenis_pinjaman`, `jumlah_pinjaman`, `tenor`) VALUES
('PIN001', 'MBR0003', '2021-06-29', '2021-06-29', '2', '1', '4000000', '10'),
('PIN002', 'MBR0005', '2021-07-02', '2021-07-02', '1', '1', '4000000', '6');

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
('R0015', 'LV03', 'US016'),
('R0019', 'LV03', 'US020'),
('R0020', 'LV03', 'US021');

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
('SIM001', '2021-04-30', 'wajib', 30000, 0, 'US020', 'MBR0004'),
('SIM002', '2021-05-31', 'wajib, sukarela', 30000, 50000, 'US020', 'MBR0004'),
('SIM003', '2020-11-30', 'wajib', 30000, 0, 'US016', 'MBR0003'),
('SIM004', '2020-12-31', 'wajib', 30000, 0, 'US016', 'MBR0003'),
('SIM005', '2021-01-31', 'wajib', 30000, 0, 'US016', 'MBR0003'),
('SIM006', '2021-02-28', 'wajib, sukarela', 30000, 20000, 'US016', 'MBR0003'),
('SIM007', '2021-03-31', 'wajib', 30000, 0, 'US016', 'MBR0003'),
('SIM008', '2021-04-30', 'wajib', 30000, 0, 'US016', 'MBR0003'),
('SIM009', '2021-05-31', 'wajib', 30000, 0, 'US016', 'MBR0003'),
('SIM010', '2020-01-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM011', '2020-02-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM012', '2020-03-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM013', '2020-04-02', 'wajib, sukarela', 30000, 100000, 'US021', 'MBR0005'),
('SIM014', '2020-05-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM015', '2020-06-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM016', '2020-07-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM017', '2020-08-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM021', '2020-12-02', 'wajib, sukarela', 30000, 50000, 'US021', 'MBR0005'),
('SIM022', '2020-10-02', 'wajib, sukarela', 30000, 50000, 'US021', 'MBR0005'),
('SIM023', '2020-11-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM024', '2020-09-02', 'wajib, sukarela', 30000, 250000, 'US021', 'MBR0005'),
('SIM025', '2021-01-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM026', '2021-02-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM027', '2021-03-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM028', '2021-04-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM029', '2021-05-02', 'wajib', 30000, 0, 'US021', 'MBR0005'),
('SIM030', '2021-06-02', 'wajib, sukarela', 30000, 100000, 'US021', 'MBR0005'),
('SIM031', '2021-07-02', 'wajib, sukarela', 30000, 100000, 'US021', 'MBR0005');

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
('US016', 'andi', 'andi', 'andi'),
('US020', 'kamil', 'kamil', 'kamil'),
('US021', 'leo', 'leo', 'leo');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_approv_pinjaman`
--
ALTER TABLE `tb_approv_pinjaman`
  ADD PRIMARY KEY (`id_approv_pin`),
  ADD KEY `id_pinjaman` (`id_pinjaman`);

--
-- Indeks untuk tabel `tb_bunga`
--
ALTER TABLE `tb_bunga`
  ADD PRIMARY KEY (`id_bunga`);

--
-- Indeks untuk tabel `tb_jasa_shu`
--
ALTER TABLE `tb_jasa_shu`
  ADD PRIMARY KEY (`no_jasa_shu`);

--
-- Indeks untuk tabel `tb_jenis_pinjaman`
--
ALTER TABLE `tb_jenis_pinjaman`
  ADD PRIMARY KEY (`id_jenis_pinjaman`);

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
-- Indeks untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indeks untuk tabel `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD PRIMARY KEY (`id_pinjaman`),
  ADD KEY `id_anggota` (`id_anggota`);

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
  ADD PRIMARY KEY (`id_simpanan`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_approv_pinjaman`
--
ALTER TABLE `tb_approv_pinjaman`
  MODIFY `id_approv_pin` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_bunga`
--
ALTER TABLE `tb_bunga`
  MODIFY `id_bunga` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_jasa_shu`
--
ALTER TABLE `tb_jasa_shu`
  MODIFY `no_jasa_shu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_pinjaman`
--
ALTER TABLE `tb_jenis_pinjaman`
  MODIFY `id_jenis_pinjaman` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD CONSTRAINT `tb_anggota_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_approv_pinjaman`
--
ALTER TABLE `tb_approv_pinjaman`
  ADD CONSTRAINT `tb_approv_pinjaman_ibfk_1` FOREIGN KEY (`id_pinjaman`) REFERENCES `tb_pinjaman` (`id_pinjaman`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pinjaman`
--
ALTER TABLE `tb_pinjaman`
  ADD CONSTRAINT `tb_pinjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_rols`
--
ALTER TABLE `tb_rols`
  ADD CONSTRAINT `tb_rols_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_rols_ibfk_2` FOREIGN KEY (`id_level_user`) REFERENCES `tb_level_user` (`id_level_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_simpanan`
--
ALTER TABLE `tb_simpanan`
  ADD CONSTRAINT `tb_simpanan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
