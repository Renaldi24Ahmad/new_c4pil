-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jul 2025 pada 21.55
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
-- Struktur dari tabel `akta_new`
--

CREATE TABLE `akta_new` (
  `nomor_akta` varchar(255) NOT NULL,
  `id_permohonan` int(255) DEFAULT NULL,
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `jenis_akta` varchar(100) DEFAULT NULL,
  `tanggal_terbit` date DEFAULT NULL,
  `id_keterangan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'Perubahan Akta (Pengadilan Negeri)');

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
(38, 'Winda Kartika', 5, 'Luar biasa, petugasnya sangat ramah.', '2025-07-14 15:11:54'),
(39, 'Budi', 5, 'Top', '2025-07-30 15:33:09');

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
  `status_permohonan` enum('Menunggu Verifikasi','Terverifikasi','Jadwal Ditetapkan','Datang ke Capil','Proses Pembuatan','Akta Selesai','Sudah Diambil','DI Tolak') DEFAULT 'Menunggu Verifikasi',
  `jadwal_kunjungan` date DEFAULT NULL,
  `waktu_kunjungan_mulai` time DEFAULT NULL,
  `waktu_kunjungan_selesai` time DEFAULT NULL,
  `kode_pengambilan` varchar(50) DEFAULT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permohonan_akta`
--

INSERT INTO `permohonan_akta` (`id_permohonan`, `id_user`, `jenis_akta`, `catatan_perubahan`, `file_ktp_pemohon`, `file_akta_lama`, `status_permohonan`, `jadwal_kunjungan`, `waktu_kunjungan_mulai`, `waktu_kunjungan_selesai`, `kode_pengambilan`, `tanggal_pengajuan`, `tanggal_selesai`) VALUES
(17, 1, 'Kelahiran', 'nama', 'AAA.jpg', 'BBB.jpg', 'Proses Pembuatan', '2025-07-28', '08:00:00', '15:00:00', NULL, '2025-07-27 22:18:01', NULL),
(18, 1, 'Kelahiran', 'tttl', 'AAA.jpg', 'BBB.jpg', 'Jadwal Ditetapkan', '2025-07-28', '08:00:00', '15:00:00', NULL, '2025-07-27 22:37:49', NULL),
(19, 2, 'Kelahiran', 'nama', 'AAA.jpg', 'BBB.jpg', 'Terverifikasi', NULL, NULL, NULL, NULL, '2025-07-29 15:52:38', NULL),
(20, 5, 'Kelahiran', 'tempat lahir', '1TEST.jpg', 'download (1).jpg', 'Menunggu Verifikasi', NULL, NULL, NULL, NULL, '2025-07-30 15:29:13', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_wa` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nik`, `no_kk`, `nama_lengkap`, `jk`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_wa`, `email`, `password`, `role`, `logo`) VALUES
(1, '6371042708030001', '6371042908160005', 'Syah Renaldi Nur Ahmad', 'L', 'Banjarmasin', '2003-08-27', 'Jl. Simpang Gusti VI No.110 RT. 31', '6287818479575', 'syahrenaldinur@gmail.com', '$2y$10$1MyM7SXs.6Tcxlo1KtpCs.FX18beypcaje2na95dopkxxrcqDcoB2', 'admin', 'logo-capil-new.png'),
(2, '1111111111111111', '1111111111111111', 'udin', 'L', 'bjm', '2025-07-15', 'bjm', '6287818479575', 'udins@gmail.com', '$2y$10$UAFY1jHNh/ikONJFJGikMOgFHf4lct5CVd7G2riEbRewbVasbxae6', 'Masyarakat', 'foto-profile.png'),
(3, '2222222222222222', '2222222222222222', 'Kabid', 'P', 'Banjarmasin', '2025-07-28', 'bjm', '6287818479575', 'kabid@gmail.com', '$2y$10$U4rj3w7OeXSmblwYfEBR9O.uoKURahEdolem46VNwq91uBKvXgfcy', 'Kepala Bidang', 'foto-profile.png'),
(4, '4444444444444444', '4444444444444444', 'Pelayanan', 'L', 'Banjarmasin', '2025-07-09', 'BJM', '6287818479575', 'pelayanan@gmail.com', '$2y$10$HY.fa0HoMOEiND9Fp/5JHOy94yXIssaYgcOB7lB9jHuJi/FzF/Slq', 'Karyawan Pelayanan', 'foto-profile.png'),
(5, '3333333333333333', '3333333333333333', 'Budi', 'L', 'Martapura', '2025-07-01', 'jln martapura', '6287818479575', 'budi@gmail.com', '$2y$10$OR6w45uJAHW0i.7GnMM0du/RK6YBSF6ztQVmTHukjme7o8.1LATeS', 'Masyarakat', 'foto-profile.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akta_new`
--
ALTER TABLE `akta_new`
  ADD PRIMARY KEY (`nomor_akta`),
  ADD UNIQUE KEY `id_permohonan` (`id_permohonan`),
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
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
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
  MODIFY `id_kp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `pengambilan_akta`
--
ALTER TABLE `pengambilan_akta`
  MODIFY `id_pengambilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `permohonan_akta`
--
ALTER TABLE `permohonan_akta`
  MODIFY `id_permohonan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akta_new`
--
ALTER TABLE `akta_new`
  ADD CONSTRAINT `akta_new_ibfk_1` FOREIGN KEY (`id_keterangan`) REFERENCES `jenis_keterangan` (`id_keterangan`),
  ADD CONSTRAINT `akta_new_ibfk_2` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan_akta` (`id_permohonan`);

--
-- Ketidakleluasaan untuk tabel `pengambilan_akta`
--
ALTER TABLE `pengambilan_akta`
  ADD CONSTRAINT `pengambilan_akta_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan_akta` (`id_permohonan`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permohonan_akta`
--
ALTER TABLE `permohonan_akta`
  ADD CONSTRAINT `permohonan_akta_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
