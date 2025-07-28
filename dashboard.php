<?php
include 'sidebar.php';

$sql = $conn->query("SELECT COUNT(id_permohonan) as perm FROM permohonan_akta");
$data = $sql->fetch_assoc();
$pengajuan = $data['perm'];

$sql = $conn->query("SELECT COUNT(nomor_akta) as noak FROM akta_new");
$data = $sql->fetch_assoc();
$pembuatan = $data['noak'];

$sql = $conn->query("SELECT COUNT(id_pengambilan) as ambil FROM pengambilan_akta");
$data = $sql->fetch_assoc();
$pengambilan = $data['ambil'];

$sql = $conn->query("SELECT COUNT(id_kp) as kp FROM kepuasan_pelayanan");
$data = $sql->fetch_assoc();
$kp = $data['kp'];
?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!-- AdminLTE CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
<!-- Ionicons untuk icon -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


<div class="container">
    <!-- Baris 1: 2 kolom center -->
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo $pengajuan; ?></h3>
                    <p>Daftar Permohonan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="r_pengajuan.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo $pembuatan; ?></h3>
                    <p>Daftar Pembuatan Akta</p>
                </div>
                <div class="icon">
                    <i class="ion ion-card"></i>
                </div>
                <a href="akta.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Baris 2: 2 kolom center -->
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo $pengambilan; ?></h3>
                    <p>Daftar Pengambilan Akta</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document"></i>
                </div>
                <a href="r_pengambilan.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>-</h3>
                    <p>Pengambilan Akta</p>
                </div>
                <div class="icon">
                    <i class="ion ion-document-text"></i>
                </div>
                <a href="pengambilan_akta.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Baris 3: 1 kolom center -->
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12 mb-3">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3><?php echo $kp; ?></h3>
                    <p>Kepuasan Masyarakat</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-happy"></i>
                </div>
                <a href="kepuasan.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>


<!-- jQuery & Bootstrap Bundle -->
<script type="module" src="https://esm.sh/ionicons@latest/loader"></script>
<script nomodule src="https://esm.sh/ionicons@latest/loader"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE JS -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<?php
include 'footer.php';
?>