<?php
include "config.php";
session_start();
if ($_SESSION['log'] != "login") {
  header("location:login.php");
}
function ribuan($nilai)
{
  return number_format($nilai, 0, ',', '.');
}
$uid = $_SESSION['id_user'];
$DataLogin = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id_user='$uid'"));
$nik = $DataLogin['nik'];
$no_kk = $DataLogin['no_kk'];
$nama_lengkap = $DataLogin['nama_lengkap'];
$jk = $DataLogin['jk'];
$tempat_lahir = $DataLogin['tempat_lahir'];
$tanggal_lahir = $DataLogin['tanggal_lahir'];
$alamat = $DataLogin['alamat'];
$no_wa = $DataLogin['no_wa'];
$email = $DataLogin['email'];
$role = $DataLogin['role'];
$logo = $DataLogin['logo'];
$ididid_user = $DataLogin['id_user'];
$data_level = $_SESSION["role"];
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Capil</title>
  <link rel="icon" href="assets/images/logo-capil-new.png">
  <link rel="icon" href="assets/images/logo-capil-new.png" type="image/ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-primary border-0" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper" style="width: 290px">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="dashboard.php"><i class="fas fa-building mr-1"></i><?php echo $toko ?>DISDUKCAPIL</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic" style="height:70px;width:70px;">
            <img class="img-responsive img-rounded" src="assets/images/<?php echo $logo ?>"
              alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name">APLIKASI
            </span>
            <span class="user-name">PERUBAHAN AKTA
            </span>
            <span class="user-role"><?php echo $role ?></span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-header  -->
        <?php
        if ($data_level == "admin") {
        ?>
          <div class="sidebar-menu">
            <ul>
              <li class="header-menu">
                <a href="dashboard.php">
                  <b>Dashboard</b>
                </a>
              </li>
              <!-- <li>

                <a href="#aktaDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                  <i class="fas fa-file-alt"></i>

                  <span>Akta</span>

                </a>

                <div class="collapse" id="aktaDropdown">

                  <ul class="nav flex-column ml-3">

                    <li class="nav-item">

                      <a class="nav-link" href="akta_terbit.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Terbit</span>

                      </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" href="akta_cu.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Cetak Ulang</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="akta_pn.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (PN)</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="akta_b.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (Biasa)</span>

                      </a>

                    </li>

                  </ul>

                </div>

              </li> -->
              <li>
                <a href="akta.php">
                  <i class="fas fa-archive"></i>
                  <span>Akta</span>
                </a>
              </li>
              <li>
                <a href="pengajuan_akta.php">
                  <i class="fas fa-tv"></i>
                  <span>Pengajuan Akta</span>
                </a>
              </li>
              <li>
                <a href="r_pengajuan.php">
                  <i class="fas fa-tv"></i>
                  <span>Pengajuan R</span>
                </a>
              </li>
              <li>
                <a href="pengambilan_akta.php">
                  <i class="fas fa-tv"></i>
                  <span>Pengambilan Akta</span>
                </a>
              </li>
              <li>
                <a href="r_pengambilan.php">
                  <i class="fas fa-tv"></i>
                  <span>Pengambilan R</span>
                </a>
              </li>
              <!-- <li>
                <a href="riwayat.php">
                  <i class="fas fa-tv"></i>
                  <span>Permohonan Pengambilan</span>
                </a>
              </li> -->
              <li>
                <a href="kepuasan.php">
                  <i class="fas fa-tv"></i>
                  <span>Kepuasan Masyarakat</span>
                </a>
              </li>
              <!-- <li>
                <a href="masyarakat.php">
                  <i class="fas fa-tv"></i>
                  <span>Masyarakat</span>
                </a>
              </li> -->
              <li>

                <a href="#reportsDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                  <i class="fas fa-file-alt"></i>

                  <span>Cetak</span>

                </a>

                <div class="collapse" id="reportsDropdown">

                  <ul class="nav flex-column ml-3">

                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-terbit.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Terbit Baru</span>

                      </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-cu.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Cetak Ulang</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-b.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-pn.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (PN)</span>

                      </a>

                    </li>
                    <!-- <li class="nav-item">

                      <a class="nav-link" href="laporan-masyarakat.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Masyarakat</span>

                      </a>

                    </li> -->
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-kepuasan-m.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Kepuasan Masyarakat</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-pemohon.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Pemohon</span>

                      </a>

                    </li>
                    <!-- <li class="nav-item">

                      <a class="nav-link" href="laporan-riwayat.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Permohonan Pengambilan</span>

                      </a>

                    </li> -->

                  </ul>

                </div>

              </li>
              <li>
                <a href="akuns.php">
                  <i class="fa fa-chart-line"></i>
                  <span>Akun</span>
                </a>
              </li>
              <li>
                <a href="pengaturan.php">
                  <i class="fa fa-cog"></i>
                  <span>Pengaturan</span>
                </a>
              </li>
              <li>
                <a href="#Exit" data-toggle="modal">
                  <i class="fa fa-power-off"></i>
                  <span>Keluar</span>
                </a>
              </li>
            </ul>
          </div>
        <?php
        } elseif ($data_level == "Karyawan Pelayanan") {
        ?>
          <div class="sidebar-menu">
            <ul>
              <li class="header-menu">
                <span>Dashboard</span>
              </li>
              <li>

                <a href="#aktaDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                  <i class="fas fa-file-alt"></i>

                  <span>Akta</span>

                </a>

                <div class="collapse" id="aktaDropdown">

                  <ul class="nav flex-column ml-3">

                    <li class="nav-item">

                      <a class="nav-link" href="akta_terbit.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Terbit</span>

                      </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" href="akta_cu.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Cetak Ulang</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="akta_pn.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (PN)</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="akta_b.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (Biasa)</span>

                      </a>

                    </li>

                  </ul>

                </div>

              </li>
              <li>
                <a href="pemohon.php">
                  <i class="fas fa-archive"></i>
                  <span>Pemohon</span>
                </a>
              </li>
              <li>
                <a href="riwayat.php">
                  <i class="fas fa-tv"></i>
                  <span>Permohonan Pengambilan</span>
                </a>
              </li>
              <!-- <li>
                <a href="akuns.php">
                  <i class="fa fa-chart-line"></i>
                  <span>Akun</span>
                </a>
              </li> -->
              <li>
                <a href="pengaturan.php">
                  <i class="fa fa-cog"></i>
                  <span>Pengaturan</span>
                </a>
              </li>
              <li>
                <a href="#Exit" data-toggle="modal">
                  <i class="fa fa-power-off"></i>
                  <span>Keluar</span>
                </a>
              </li>
            </ul>
          </div>
        <?php
        } elseif ($data_level == "Kepala Bidang") {
        ?>
          <div class="sidebar-menu">
            <ul>
              <li class="header-menu">
                <span>Dashboard</span>
              </li>
              <li>

                <a href="#aktaDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                  <i class="fas fa-file-alt"></i>

                  <span>Akta</span>

                </a>

                <div class="collapse" id="aktaDropdown">

                  <ul class="nav flex-column ml-3">

                    <li class="nav-item">

                      <a class="nav-link" href="akta_terbit_kabid.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Terbit</span>

                      </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" href="akta_cu_kabid.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Cetak Ulang</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="akta_pn_kabid.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (PN)</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="akta_b_kabid.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (Biasa)</span>

                      </a>

                    </li>

                  </ul>

                </div>

              </li>
              <li>
                <a href="pemohon_kabid.php">
                  <i class="fas fa-archive"></i>
                  <span>Pemohon</span>
                </a>
              </li>
              <li>
                <a href="riwayat_kabid.php">
                  <i class="fas fa-tv"></i>
                  <span>Permohonan Pengambilan</span>
                </a>
              </li>
              <!-- <li>
                <a href="akuns.php">
                  <i class="fa fa-chart-line"></i>
                  <span>Akun</span>
                </a>
              </li> -->
              <li>

                <a href="#reportsDropdown" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                  <i class="fas fa-file-alt"></i>

                  <span>Cetak</span>

                </a>

                <div class="collapse" id="reportsDropdown">

                  <ul class="nav flex-column ml-3">

                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-terbit.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Terbit Baru</span>

                      </a>

                    </li>

                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-cu.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Cetak Ulang</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-b.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-akta-pn.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Perubahan Akta (PN)</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-pemohon.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Pemohon</span>

                      </a>

                    </li>
                    <li class="nav-item">

                      <a class="nav-link" href="laporan-riwayat.php">

                        <i class="fas fa-calendar-alt"></i>

                        <span>Permohonan Pengambilan</span>

                      </a>

                    </li>

                  </ul>

                </div>

              </li>
              <li>
                <a href="pengaturan.php">
                  <i class="fa fa-cog"></i>
                  <span>Pengaturan</span>
                </a>
              </li>
              <li>
                <a href="#Exit" data-toggle="modal">
                  <i class="fa fa-power-off"></i>
                  <span>Keluar</span>
                </a>
              </li>
            </ul>
          </div>
        <?php
        } elseif ($data_level == "Masyarakat") {
        ?>
          <div class="sidebar-menu">
            <ul>
              <li class="header-menu">
                <span>Dashboard</span>
              </li>
              <li>
                <a href="pengajuan_akta.php">
                  <i class="fas fa-tv"></i>
                  <span>Pengajuan Akta</span>
                </a>
              </li>
              <li>
                <a href="t_status_m.php">
                  <i class="fas fa-tv"></i>
                  <span>Status Permohonan</span>
                </a>
              </li>
              <li>
                <a href="t_ulasan_m.php">
                  <i class="fas fa-tv"></i>
                  <span>Ulasan Pelayanan</span>
                </a>
              </li>
              <li>
                <a href="pengaturan.php">
                  <i class="fa fa-cog"></i>
                  <span>Pengaturan</span>
                </a>
              </li>
              <li>
                <a href="#Exit" data-toggle="modal">
                  <i class="fa fa-power-off"></i>
                  <span>Keluar</span>
                </a>
              </li>
            </ul>
          </div>
        <?php
        }
        ?>

        <!-- sidebar-menu  -->
      </div>
      <div class="sidebar-footer" style="background-color :#4565e6;">
        © Selamat Datang di Aplikasi Catatan Sipil - Banjarmasin
        <a target="_blank" rel="noopener noreferrer" href="#">
        </a>
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content ml-4">
      <div class="container-fluid">

        <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>