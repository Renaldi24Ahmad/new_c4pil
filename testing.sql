-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2025 pada 20.56
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
-- Database: `testing`
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
('6371-20022025-LT', 'Robyy', 'Kematian', '2025-02-20', 2, NULL);

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
('6371-04022025-LU', 'Fajar Saputra', 'Kelahiran', '2025-02-04', 1, 'Belum Di Ambil'),
('6371-10072025-LT', 'Udin', 'Kelahiran', '2025-07-09', 1, NULL);

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
-- Struktur dari tabel `kepuasan_pelayanan`
--

CREATE TABLE `kepuasan_pelayanan` (
  `id_kp` int(11) NOT NULL,
  `nama_masyarakat` varchar(255) NOT NULL,
  `rating` int(255) NOT NULL,
  `ulasan` text NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kepuasan_pelayanan`
--

INSERT INTO `kepuasan_pelayanan` (`id_kp`, `nama_masyarakat`, `rating`, `ulasan`, `tanggal`) VALUES
(13, 'udin', 5, 'mantap', '2025-07-10 14:18:20'),
(14, 'budi', 1, 'ok\r\n', '2025-07-14 15:06:53'),
(15, 'alfi', 2, 'bagus', '2025-07-14 15:07:09'),
(16, 'fajar', 3, 'baik', '2025-07-14 15:07:23'),
(17, 'roby', 4, 'baguus', '2025-07-14 15:07:44'),
(18, 'rusdi', 4, 'baik', '2025-07-14 15:08:00'),
(19, 'Andi Saputra', 5, 'Pelayanan sangat memuaskan dan cepat.', '2025-07-14 15:11:54'),
(20, 'Siti Rahma', 4, 'Cukup baik tapi bisa lebih cepat.', '2025-07-14 15:11:54'),
(21, 'Budi Santoso', 3, 'Pelayanan agak lama, tapi petugas ramah.', '2025-07-14 15:11:54'),
(22, 'Dewi Lestari', 5, 'Sangat profesional dan ramah.', '2025-07-14 15:11:54'),
(23, 'Rizky Maulana', 2, 'Kurang tanggap dalam melayani.', '2025-07-14 15:11:54'),
(24, 'Nina Aprilia', 4, 'Cepat dan informatif.', '2025-07-14 15:11:54'),
(25, 'Fajar Pratama', 1, 'Sangat tidak puas, harus antre lama.', '2025-07-14 15:11:54'),
(26, 'Lina Marlina', 5, 'Terbaik! Sangat membantu.', '2025-07-14 15:11:54'),
(27, 'Rian Hidayat', 3, 'Standar, tidak ada yang istimewa.', '2025-07-14 15:11:54'),
(28, 'Tari Amelia', 4, 'Cukup memuaskan.', '2025-07-14 15:11:54'),
(29, 'Ahmad Rizal', 2, 'Masih banyak kekurangan.', '2025-07-14 15:11:54'),
(30, 'Fitriani Nur', 5, 'Top, pelayanan sangat baik.', '2025-07-14 15:11:54'),
(31, 'Gilang Ramadhan', 4, 'Sudah oke, tapi ruang tunggu panas.', '2025-07-14 15:11:54'),
(32, 'Ayu Wulandari', 3, 'Lumayan, tapi bisa ditingkatkan.', '2025-07-14 15:11:54'),
(33, 'Ilham Saputra', 2, 'Terlalu lama menunggu antrian.', '2025-07-14 15:11:54'),
(34, 'Mega Putri', 5, 'Proses cepat dan efisien.', '2025-07-14 15:11:54'),
(35, 'Yoga Prasetyo', 4, 'Bagus, tapi belum sempurna.', '2025-07-14 15:11:54'),
(36, 'Rina Oktaviani', 3, 'Biasa saja.', '2025-07-14 15:11:54'),
(37, 'Samuel Adrian', 1, 'Sangat mengecewakan.', '2025-07-14 15:11:54'),
(38, 'Winda Kartika', 5, 'Luar biasa, petugasnya sangat ramah.', '2025-07-14 15:11:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masyarakat`
--

CREATE TABLE `masyarakat` (
  `id_masyarakat` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `rt_rw` varchar(20) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kota_kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tanggal_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `masyarakat`
--

INSERT INTO `masyarakat` (`id_masyarakat`, `nik`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `rt_rw`, `kelurahan`, `kecamatan`, `kota_kabupaten`, `provinsi`, `no_hp`, `email`, `tanggal_daftar`) VALUES
(1, '6371123456789001', 'Budi Santoso', 'Banjarmasin', '1990-01-15', 'Laki-laki', 'Jl. Kenanga No. 5', '03/04', 'Pelambuan', 'Banjarmasin Barat', 'Kota Banjarmasin', 'Kalimantan Selatan', '081234567890', 'budi@example.com', '2025-07-09 07:53:43'),
(2, '6371123456789002', 'Siti Aisyah', 'Martapura', '1992-03-25', 'Perempuan', 'Jl. Melati No. 8', '01/01', 'Keraton', 'Martapura Kota', 'Kabupaten Banjar', 'Kalimantan Selatan', '082112345678', 'aisyah@example.com', '2025-07-09 07:53:43'),
(3, '6371123456789003', 'Ahmad Fauzi', 'Banjarbaru', '1988-07-05', 'Laki-laki', 'Jl. Anggrek No. 12', '02/03', 'Loktabat', 'Banjarbaru Selatan', 'Kota Banjarbaru', 'Kalimantan Selatan', '085212345678', 'fauzi@example.com', '2025-07-09 07:53:43'),
(4, '6371123456789004', 'Dewi Lestari', 'Amuntai', '1995-11-18', 'Perempuan', 'Jl. Mawar No. 3', '04/05', 'Murung Sari', 'Amuntai Tengah', 'Kabupaten Hulu Sungai Utara', 'Kalimantan Selatan', '083112345678', 'dewi@example.com', '2025-07-09 07:53:43'),
(5, '6371123456789005', 'Rizky Pratama', 'Pelaihari', '1993-09-10', 'Laki-laki', 'Jl. Cendana No. 10', '05/06', 'Angsau', 'Pelaihari', 'Kabupaten Tanah Laut', 'Kalimantan Selatan', '081512345678', 'rizky@example.com', '2025-07-09 07:53:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `pesan` text NOT NULL,
  `status_kirim` enum('pending','terkirim','gagal') DEFAULT 'pending',
  `tanggal_kirim` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1010, 'Maya Sari', '3201123456780010', '081234567810'),
(1011, 'Udin', '6371041007050001', '087812341234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengambilan_akta`
--

CREATE TABLE `pengambilan_akta` (
  `id_pengambilan` int(11) NOT NULL,
  `id_permohonan` int(11) NOT NULL,
  `nama_pengambil` varchar(100) NOT NULL,
  `nik_pengambil` varchar(20) NOT NULL,
  `bukti_ktp_pengambil` varchar(255) DEFAULT NULL,
  `waktu_pengambilan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_akta`
--

CREATE TABLE `permohonan_akta` (
  `id_permohonan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_akta` varchar(100) NOT NULL,
  `catatan_perubahan` text NOT NULL,
  `file_ktp_pemohon` varchar(255) NOT NULL,
  `file_akta_lama` varchar(255) NOT NULL,
  `status_permohonan` enum('Menunggu Verifikasi','Terverifikasi','Jadwal Ditetapkan','Datang ke Capil','Proses Pembuatan','Selesai','Sudah Diambil') DEFAULT 'Menunggu Verifikasi',
  `jadwal_kunjungan` date DEFAULT NULL,
  `waktu_kunjungan_mulai` time DEFAULT NULL,
  `waktu_kunjungan_selesai` time DEFAULT NULL,
  `kode_pengambilan` varchar(50) DEFAULT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pengambilan`
--

CREATE TABLE `riwayat_pengambilan` (
  `id_riwayat` int(11) NOT NULL,
  `nomor_akta` varchar(255) DEFAULT NULL,
  `id_pemohon` int(11) DEFAULT NULL,
  `status` varchar(123) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_pengambilan`
--

INSERT INTO `riwayat_pengambilan` (`id_riwayat`, `nomor_akta`, `id_pemohon`, `status`, `id_user`) VALUES
(39, '6371-22122025-LU', 10, 'DiTolak', 1),
(40, '6371-04022025-LT', 14, 'Terverifikasi', 1),
(41, '6371-22122025-LU', 1001, 'DiTolak', 1),
(42, '6371-10072025-LT', 1011, 'Selesai', 1);

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
  `nik` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nik`, `password`, `nama_lengkap`, `role`, `logo`) VALUES
(1, 'admin', '$2y$10$1MyM7SXs.6Tcxlo1KtpCs.FX18beypcaje2na95dopkxxrcqDcoB2', 'Renaldii', 'admin', 'logo-capil-new.png'),
(2, 'kabid', '$2y$10$rTk9dDUpaCUK/G6gGw.v0u/lD6CYvX53fkOT9DDXQuj9QOK0Tu4hu', 'Kepala Bidang', 'Kepala Bidang', 'logo-capil-new.png'),
(3, 'pelayanan', '$2y$10$uy8grJ.922HrempcLKy5Q.z3Nb7/KL1gKApNhO6gIUGzSz/t0FtZW', 'Pelayanan', 'Karyawan Pelayanan', 'logo-capil-new.png'),
(6, 'udin', '$2y$10$qAM6AZ.Q75ljTmGPUiAqs.bP6PeDF5RARumcg4tQyZlGeA5GtxutW', 'udin', 'Masyarakat', 'foto-profile.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_wa` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `nik`, `no_kk`, `nama_lengkap`, `jk`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_wa`, `email`, `password`) VALUES
(1, '6371042708030001', '6371042908160005', 'Syah Renaldi Nur Ahmad', 'L', 'Banjarmasin', '2003-08-27', 'Jl. Simpang Gusti VI No.110 RT. 31', '087818479575', 'syahrenaldinur@gmail.com', '$2y$10$1MyM7SXs.6Tcxlo1KtpCs.FX18beypcaje2na95dopkxxrcqDcoB2');

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
-- Indeks untuk tabel `kepuasan_pelayanan`
--
ALTER TABLE `kepuasan_pelayanan`
  ADD PRIMARY KEY (`id_kp`);

--
-- Indeks untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`id_masyarakat`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id_pemohon`);

--
-- Indeks untuk tabel `pengambilan_akta`
--
ALTER TABLE `pengambilan_akta`
  ADD PRIMARY KEY (`id_pengambilan`),
  ADD KEY `id_permohonan` (`id_permohonan`);

--
-- Indeks untuk tabel `permohonan_akta`
--
ALTER TABLE `permohonan_akta`
  ADD PRIMARY KEY (`id_permohonan`),
  ADD KEY `id_user` (`id_user`);

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
  ADD UNIQUE KEY `username` (`nik`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_keterangan`
--
ALTER TABLE `jenis_keterangan`
  MODIFY `id_keterangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kepuasan_pelayanan`
--
ALTER TABLE `kepuasan_pelayanan`
  MODIFY `id_kp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `masyarakat`
--
ALTER TABLE `masyarakat`
  MODIFY `id_masyarakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id_pemohon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT untuk tabel `pengambilan_akta`
--
ALTER TABLE `pengambilan_akta`
  MODIFY `id_pengambilan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permohonan_akta`
--
ALTER TABLE `permohonan_akta`
  MODIFY `id_permohonan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pengambilan`
--
ALTER TABLE `riwayat_pengambilan`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `status_permohonan`
--
ALTER TABLE `status_permohonan`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Ketidakleluasaan untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengambilan_akta`
--
ALTER TABLE `pengambilan_akta`
  ADD CONSTRAINT `pengambilan_akta_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan_akta` (`id_permohonan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permohonan_akta`
--
ALTER TABLE `permohonan_akta`
  ADD CONSTRAINT `permohonan_akta_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

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
