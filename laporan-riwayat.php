<?php
include "config.php";
// Mulai Sesi 
session_start();
if ($_SESSION['log'] != "login") {
  header("location:login.php");
}
function ribuan($nilai)
{
  return number_format($nilai, 0, ',', '.');
}

// KONEKSI DB 
include "koneksi.php";
$tanggal = date("m/Y");
$tgl = date("d F Y");
?>
<html>

<head>
  <title>DATA RIWAYAT PENGAMBILAN | PER : <?php echo $tgl; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
  <table border="0" align="left" width="90%" class="">
    <tr>
      <td width="100px">
        <img src="assets/images/logo-bjm.png" width="150">
      </td>
      <td align="center">
        <h2><b>PEMERINTAH KOTA BANJARMASIN</b></h2>
        <h3><b>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</b></h3>
        <p>
          Jalan Sultan Adam NO.18 RT.26 Banjarmasin 70122<br>
          Telepon 0511-3307293<br>
          www.disdukcapil.banjarmasinkota.go.id</p>
      </td>
    </tr>
  </table>

  <table border="1" id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Akta</th>
        <th>Nama Pemilik</th>
        <th>Nama Pemohon</th>
        <th>Status</th>
        <th>Modif By</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $sql = $koneksi->query("
      SELECT rp.id_riwayat, rp.nomor_akta, rp.id_pemohon, rp.status, u.username, 

             COALESCE(a.nama_pemilik, b.nama_pemilik, c.nama_pemilik, d.nama_pemilik) AS nama_pemilik,

             p.nama_pemohon

      FROM riwayat_pengambilan rp

      LEFT JOIN akta_b a ON rp.nomor_akta = a.nomor_akta

      LEFT JOIN akta_cu b ON rp.nomor_akta = b.nomor_akta

      LEFT JOIN akta_pn c ON rp.nomor_akta = c.nomor_akta

      LEFT JOIN akta_terbit d ON rp.nomor_akta = d.nomor_akta

      JOIN pemohon p ON rp.id_pemohon = p.id_pemohon

      JOIN user u ON rp.id_user = u.id_user

      ORDER BY rp.id_riwayat ASC
      ");
      while ($data = $sql->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $data['nomor_akta']; ?></td>
          <td><?php echo $data['nama_pemilik']; ?></td>
          <td><?php echo $data['nama_pemohon']; ?></td>
          <td><?php echo $data['status']; ?></td>
          <td><?php echo $data['username']; ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <table width="100%">
    <tr>
      <td width="70%"></td>
      <td align="center">
        <div class="signature">
          <div class="date">Banjarmasin, <?php echo $tgl; ?></div>
          <div class="title">KEPALA DINAS</div>
          <br><br><br><br>
          <div class="name"><b>YUSNA IRAWAN, SE, M.ENG</b></div>
          <div class="name">Pembina Utama Muda</div>
          <div class="nip">NIP 19721222 200003 1 004</div>
        </div>
      </td>
    </tr>
  </table>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example1').DataTable();
      window.print();
    });
  </script>
</body>

</html>