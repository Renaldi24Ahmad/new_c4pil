-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2025 pada 10.27
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catatan_sipil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_b`
--

CREATE TABLE `akta_b` (
  `nomor_akta` varchar(255) NOT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `jenis_akta` varchar(100) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `id_keterangan` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akta_b`
--

INSERT INTO `akta_b` (`nomor_akta`, `nama_pemilik`, `jenis_akta`, `tanggal_terbit`, `id_keterangan`, `status`) VALUES
('6371-02122005-LU', 'Budi Doremi', 'Kelahiran', '2025-02-10', 3, 'Belum Diambil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_cu`
--

CREATE TABLE `akta_cu` (
  `nomor_akta` varchar(255) NOT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `jenis_akta` varchar(100) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `id_keterangan` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akta_cu`
--

INSERT INTO `akta_cu` (`nomor_akta`, `nama_pemilik`, `jenis_akta`, `tanggal_terbit`, `id_keterangan`, `status`) VALUES
('6371-02122025-LU', 'Udin Sedunia', 'Kelahiran', '2025-02-10', 2, 'Belum Diambil'),
('6371-20022025-LT', 'Robyy', 'Kelahiran', '2025-02-20', 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_pn`
--

CREATE TABLE `akta_pn` (
  `nomor_akta` varchar(255) NOT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `jenis_akta` varchar(100) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `id_keterangan` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akta_pn`
--

INSERT INTO `akta_pn` (`nomor_akta`, `nama_pemilik`, `jenis_akta`, `tanggal_terbit`, `id_keterangan`, `status`) VALUES
('6371-04022025-LT', 'Robby', 'Kelahiran', '2025-02-19', 4, NULL),
('6371-22122025-LU', 'Anwar', 'Kelahiran', '2025-02-03', 4, 'Belum Diambil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_terbit`
--

CREATE TABLE `akta_terbit` (
  `nomor_akta` varchar(255) NOT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `jenis_akta` varchar(100) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `id_keterangan` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akta_terbit`
--

INSERT INTO `akta_terbit` (`nomor_akta`, `nama_pemilik`, `jenis_akta`, `tanggal_terbit`, `id_keterangan`, `status`) VALUES
('6371-04022025-LU', 'Fajar Saputra', 'Kelahiran', '2025-02-04', 1, 'Belum Di Ambil');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_keterangan`
--

CREATE TABLE `jenis_keterangan` (
  `id_keterangan` int(11) NOT NULL,
  `nama_keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_keterangan`
--

INSERT INTO `jenis_keterangan` (`id_keterangan`, `nama_keterangan`) VALUES
(1, 'Terbit Baru'),
(2, 'Cetak Ulang (Hilang)'),
(3, 'Perubahan Akta (Biasa)'),
(4, 'Perubahan Akta (pengadilan Negeri)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemohon`
--

CREATE TABLE `pemohon` (
  `id_pemohon` int(11) NOT NULL,
  `nama_pemohon` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemohon`
--

INSERT INTO `pemohon` (`id_pemohon`, `nama_pemohon`, `nik`, `no_hp`) VALUES
(4, 'Ahmad Fauzi', '3201012001010001', '081234567890'),
(5, 'Siti Aisyah', '3201022002020002', '082345678901'),
(6, 'Budi Santoso', '3201032003030003', '083456789012'),
(7, 'Dewi Lestari', '3201042004040004', '084567890123'),
(8, 'Joko Widodo', '3201052005050005', '085678901234'),
(10, 'Andi Pratama', '3201072007070007', '087890123456'),
(11, 'Lina Marlina', '3201082008080008', '088901234567'),
(12, 'Rizky Ramadhan', '3201092009090009', '089012345678'),
(13, 'Nur Hidayat', '3201102010100010', '081345678912'),
(14, 'Robyy', '63710420022026', '0878673667894'),
(1001, 'Ahmad Fauzi', '3201123456780001', '081234567801'),
(1002, 'Siti Aisyah', '3201123456780002', '081234567802'),
(1003, 'Budi Santoso', '3201123456780003', '081234567803'),
(1004, 'Dewi Lestari', '3201123456780004', '081234567804'),
(1005, 'Rudi Hartono', '3201123456780005', '081234567805'),
(1006, 'Lina Marlina', '3201123456780006', '081234567806'),
(1007, 'Dedi Gunawan', '3201123456780007', '081234567807'),
(1008, 'Fitri Handayani', '3201123456780008', '081234567808'),
(1009, 'Agus Pratama', '3201123456780009', '081234567809'),
(1010, 'Maya Sari', '3201123456780010', '081234567810');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengambilan`
--

CREATE TABLE `riwayat_pengambilan` (
  `id_riwayat` int(11) NOT NULL,
  `nomor_akta` varchar(255) DEFAULT NULL,
  `id_pemohon` int(11) DEFAULT NULL,
  `waktu_pengambilan` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_pengambilan`
--

INSERT INTO `riwayat_pengambilan` (`id_riwayat`, `nomor_akta`, `id_pemohon`, `waktu_pengambilan`, `id_user`) VALUES
(32, '6371-02122005-LU', 8, '2025-02-11 10:00:00', 1),
(35, '6371-22122025-LU', 10, '2025-01-01 12:00:00', 1),
(37, '6371-04022025-LT', 8, '2025-02-20 10:00:00', 1),
(38, '6371-04022025-LT', 1006, '2025-06-24 12:00:00', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_permohonan`
--

CREATE TABLE `status_permohonan` (
  `id_status` int(11) NOT NULL,
  `nomor_akta` int(11) DEFAULT NULL,
  `id_pemohon` int(11) DEFAULT NULL,
  `status_permohonan` enum('Di Tolak','Selesai','Proses') DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `role`, `logo`) VALUES
(1, 'admin', '$2y$10$1MyM7SXs.6Tcxlo1KtpCs.FX18beypcaje2na95dopkxxrcqDcoB2', 'Renaldi', 'admin', 'logo-capil-new.png'),
(2, 'kabid', '$2y$10$rTk9dDUpaCUK/G6gGw.v0u/lD6CYvX53fkOT9DDXQuj9QOK0Tu4hu', 'Kepala Bidang', 'Kepala Bidang', 'logo-capil-new.png'),
(3, 'pelayanan', '$2y$10$uy8grJ.922HrempcLKy5Q.z3Nb7/KL1gKApNhO6gIUGzSz/t0FtZW', 'Pelayanan', 'Karyawan Pelayanan', 'logo-capil-new.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akta_b`
--
ALTER TABLE `akta_b`
  ADD PRIMARY KEY (`nomor_akta`),
  ADD KEY `id_keterangan` (`id_keterangan`);

--
-- Indeks untuk tabel `akta_cu`
--
ALTER TABLE `akta_cu`
  ADD PRIMARY KEY (`nomor_akta`),
  ADD KEY `id_keterangan` (`id_keterangan`);

--
-- Indeks untuk tabel `akta_pn`
--
ALTER TABLE `akta_pn`
  ADD PRIMARY KEY (`nomor_akta`),
  ADD KEY `id_keterangan` (`id_keterangan`);

--
-- Indeks untuk tabel `akta_terbit`
--
ALTER TABLE `akta_terbit`
  ADD PRIMARY KEY (`nomor_akta`),
  ADD KEY `id_keterangan` (`id_keterangan`);

--
-- Indeks untuk tabel `jenis_keterangan`
--
ALTER TABLE `jenis_keterangan`
  ADD PRIMARY KEY (`id_keterangan`);

--
-- Indeks untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id_pemohon`);

--
-- Indeks untuk tabel `riwayat_pengambilan`
--
ALTER TABLE `riwayat_pengambilan`
  ADD PRIMARY KEY (`id_riwayat`),
  ADD KEY `nomor_akta` (`nomor_akta`),
  ADD KEY `id_pemohon` (`id_pemohon`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `status_permohonan`
--
ALTER TABLE `status_permohonan`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `nomor_akta` (`nomor_akta`),
  ADD KEY `id_pemohon` (`id_pemohon`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_keterangan`
--
ALTER TABLE `jenis_keterangan`
  MODIFY `id_keterangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengambilan`
--
ALTER TABLE `riwayat_pengambilan`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `status_permohonan`
--
ALTER TABLE `status_permohonan`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akta_b`
--
ALTER TABLE `akta_b`
  ADD CONSTRAINT `akta_b_ibfk_1` FOREIGN KEY (`id_keterangan`) REFERENCES `jenis_keterangan` (`id_keterangan`);

--
-- Ketidakleluasaan untuk tabel `akta_cu`
--
ALTER TABLE `akta_cu`
  ADD CONSTRAINT `akta_cu_ibfk_1` FOREIGN KEY (`id_keterangan`) REFERENCES `jenis_keterangan` (`id_keterangan`);

--
-- Ketidakleluasaan untuk tabel `akta_pn`
--
ALTER TABLE `akta_pn`
  ADD CONSTRAINT `akta_pn_ibfk_1` FOREIGN KEY (`id_keterangan`) REFERENCES `jenis_keterangan` (`id_keterangan`);

--
-- Ketidakleluasaan untuk tabel `akta_terbit`
--
ALTER TABLE `akta_terbit`
  ADD CONSTRAINT `akta_terbit_ibfk_1` FOREIGN KEY (`id_keterangan`) REFERENCES `jenis_keterangan` (`id_keterangan`);

--
-- Ketidakleluasaan untuk tabel `riwayat_pengambilan`
--
ALTER TABLE `riwayat_pengambilan`
  ADD CONSTRAINT `riwayat_pengambilan_ibfk_5` FOREIGN KEY (`id_pemohon`) REFERENCES `pemohon` (`id_pemohon`),
  ADD CONSTRAINT `riwayat_pengambilan_ibfk_6` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `status_permohonan`
--
ALTER TABLE `status_permohonan`
  ADD CONSTRAINT `status_permohonan_ibfk_1` FOREIGN KEY (`id_pemohon`) REFERENCES `pemohon` (`id_pemohon`),
  ADD CONSTRAINT `status_permohonan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
