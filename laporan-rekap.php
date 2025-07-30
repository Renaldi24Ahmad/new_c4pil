<?php
include "config.php";
session_start();
if ($_SESSION['log'] != "login") {
  header("location:login.php");
}
include "koneksi.php";
$tgl = date("d F Y");

// Rekapan
$permohonan_all = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta"))['jumlah'];
$permohonan_ditolak = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta WHERE status_permohonan = 'Di Tolak'"))['jumlah'];
$permohonan_diterima = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta WHERE status_permohonan != 'Di Tolak'"))['jumlah'];
$akta_belum_selesai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta WHERE status_permohonan != 'Akta Selesai'"))['jumlah'];
$akta_selesai = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta WHERE status_permohonan = 'Akta Selesai'"))['jumlah'];
$akta_belum_diambil = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta p LEFT JOIN pengambilan_akta a ON p.id_permohonan = a.id_permohonan WHERE p.status_permohonan = 'Akta Selesai' AND a.waktu_pengambilan IS NULL"))['jumlah'];
$akta_sudah_diambil = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM permohonan_akta p JOIN pengambilan_akta a ON p.id_permohonan = a.id_permohonan WHERE p.status_permohonan = 'Akta Selesai' AND a.waktu_pengambilan IS NOT NULL"))['jumlah'];
$terbit_baru = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM akta_new an JOIN jenis_keterangan jk ON an.id_keterangan = jk.id_keterangan WHERE jk.nama_keterangan = 'Terbit Baru'"))['jumlah'];
$cetak_ulang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM akta_new an JOIN jenis_keterangan jk ON an.id_keterangan = jk.id_keterangan WHERE jk.nama_keterangan = 'Cetak Ulang'"))['jumlah'];
$perubahan_biasa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM akta_new an JOIN jenis_keterangan jk ON an.id_keterangan = jk.id_keterangan WHERE jk.nama_keterangan = 'Perubahan Akta Biasa'"))['jumlah'];
$perubahan_pn = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM akta_new an JOIN jenis_keterangan jk ON an.id_keterangan = jk.id_keterangan WHERE jk.nama_keterangan = 'Perubahan Akta (PN)'"))['jumlah'];
$kepuasan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM kepuasan_pelayanan WHERE MONTH(tanggal) = MONTH(CURDATE()) AND YEAR(tanggal) = YEAR(CURDATE())"))['jumlah'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Laporan Rekap Bulanan | <?php echo $tgl; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    h2,
    h3 {
      margin-bottom: 0;
    }

    .table td,
    .table th {
      vertical-align: middle;
    }
  </style>
</head>

<body onload="window.print()">
  <div class="container">
    <div class="text-center mb-4">
      <img src="assets/images/logo-bjm.png" width="100">
      <h2>PEMERINTAH KOTA BANJARMASIN</h2>
      <h3>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h3>
      <p>Jalan Sultan Adam NO.18 RT.26 Banjarmasin 70122 | Telepon 0511-3307293</p>
      <hr>
      <h4>LAPORAN REKAP BULANAN</h4>
      <p>Per: <?php echo $tgl; ?></p>
    </div>

    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Total Permohonan Akta</td>
          <td><?php echo $permohonan_all; ?></td>
        </tr>
        <tr>
          <td>2</td>
          <td>Permohonan Ditolak</td>
          <td><?php echo $permohonan_ditolak; ?></td>
        </tr>
        <tr>
          <td>3</td>
          <td>Permohonan Diterima</td>
          <td><?php echo $permohonan_diterima; ?></td>
        </tr>
        <tr>
          <td>4</td>
          <td>Akta Belum Selesai</td>
          <td><?php echo $akta_belum_selesai; ?></td>
        </tr>
        <tr>
          <td>5</td>
          <td>Akta Sudah Selesai</td>
          <td><?php echo $akta_selesai; ?></td>
        </tr>
        <tr>
          <td>6</td>
          <td>Akta Belum Diambil</td>
          <td><?php echo $akta_belum_diambil; ?></td>
        </tr>
        <tr>
          <td>7</td>
          <td>Akta Sudah Diambil</td>
          <td><?php echo $akta_sudah_diambil; ?></td>
        </tr>
        <tr>
          <td>8</td>
          <td>Akta Terbit Baru</td>
          <td><?php echo $terbit_baru; ?></td>
        </tr>
        <tr>
          <td>9</td>
          <td>Akta Cetak Ulang</td>
          <td><?php echo $cetak_ulang; ?></td>
        </tr>
        <tr>
          <td>10</td>
          <td>Akta Perubahan Biasa</td>
          <td><?php echo $perubahan_biasa; ?></td>
        </tr>
        <tr>
          <td>11</td>
          <td>Akta Perubahan (PN)</td>
          <td><?php echo $perubahan_pn; ?></td>
        </tr>
        <tr>
          <td>12</td>
          <td>Ulasan Kepuasan Masyarakat Bulan Ini</td>
          <td><?php echo $kepuasan; ?></td>
        </tr>
      </tbody>
    </table>


  </div>
</body>
<table width="100%">
  <tr>
    <td width="70%"></td>
    <td align="center">
      <div class="signature">
        <div class="date">Banjarmasin, <?php echo $tgl; ?></div>
        <div class="title"><b>KEPALA DINAS</b></div>
        <br><br><br><br>
        <div class="name"><b>YUSNA IRAWAN, SE, M.ENG</b></div>
        <div class="name">Pembina Utama Muda</div>
        <div class="nip">NIP 19721222 200003 1 004</div>
      </div>
    </td>
  </tr>
</table>

</html>