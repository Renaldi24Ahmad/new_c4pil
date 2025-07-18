<?php
include "config.php"; // koneksi dan session
session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] != "login") {
  header("location:login.php");
  exit;
}

include "koneksi.php";

// Format tanggal
$tgl = date("d F Y");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>DATA MASYARAKAT | PER : <?php echo $tgl; ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>

  <table border="0" align="left" width="90%">
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
          www.disdukcapil.banjarmasinkota.go.id
        </p>
      </td>
    </tr>
  </table>

  <div class="mt-4">
    <!-- <table border="1" class="table table-bordered table-striped"> -->
    <table border="1" id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>NIK</th>
          <th>Nama Lengkap</th>
          <th>Tempat / Tanggal Lahir</th>
          <th>Jenis Kelamin</th>
          <th>Alamat</th>
          <th>No HP</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = $koneksi->query("SELECT * FROM masyarakat ORDER BY id_masyarakat ASC");
        while ($data = $query->fetch_assoc()) {
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['nik']); ?></td>
            <td><?= htmlspecialchars($data['nama_lengkap']); ?></td>
            <td><?= htmlspecialchars($data['tempat_lahir']) . ', ' . date('d-m-Y', strtotime($data['tanggal_lahir'])); ?></td>
            <td><?= htmlspecialchars($data['jenis_kelamin']); ?></td>
            <td><?= htmlspecialchars($data['alamat']); ?></td>
            <td><?= htmlspecialchars($data['no_hp']); ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
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