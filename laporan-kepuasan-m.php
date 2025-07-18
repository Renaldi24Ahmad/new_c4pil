<?php
include "config.php";
session_start();
if (!isset($_SESSION['log']) || $_SESSION['log'] != "login") {
    header("location:login.php");
    exit;
}
include "koneksi.php";

$tgl = date("d F Y");

// Ambil data untuk grafik
$dataRating = mysqli_query($koneksi, "SELECT rating, COUNT(*) as total FROM kepuasan_pelayanan GROUP BY rating");
$ratings = [];
$jumlah = [];
while ($row = mysqli_fetch_assoc($dataRating)) {
    $ratings[] = $row['rating'];
    $jumlah[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Kepuasan Pelayanan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            body {
                font-size: 12pt;
            }

            .table th,
            .table td {
                padding: 5px;
            }

            canvas {
                max-width: 100% !important;
                max-height: 400px !important;
            }
        }
    </style>
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
                <p>Jalan Sultan Adam NO.18 RT.26 Banjarmasin 70122<br>
                    Telepon 0511-3307293<br>
                    www.disdukcapil.banjarmasinkota.go.id</p>
            </td>
        </tr>
    </table>

    <hr style="border:1px solid black;">

    <div class="container mt-3">
        <h5 class="text-center mb-3"><b>Grafik Kepuasan Pelayanan</b></h5>
        <canvas id="grafikKepuasan"></canvas>
    </div>

    <div class="container mt-4">
        <h5 class="text-center mb-3"><b>Data Kepuasan Pelayanan</b></h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Masyarakat</th>
                    <th>Rating</th>
                    <th>Ulasan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi, "SELECT * FROM kepuasan_pelayanan");
                while ($d = mysqli_fetch_assoc($data)) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($d['nama_masyarakat']); ?></td>
                        <td><?= htmlspecialchars($d['rating']); ?></td>
                        <td><?= htmlspecialchars($d['ulasan']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <table width="100%" class="mt-5">
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

    <script>
        const ctx = document.getElementById('grafikKepuasan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($ratings); ?>,
                datasets: [{
                    label: 'Jumlah Responden',
                    data: <?= json_encode($jumlah); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        window.print();
    </script>

</body>

</html>