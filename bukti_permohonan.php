<?php
include 'sidebar.php';
include "phpqrcode/qrlib.php"; // panggil library

$id_permohonan = $_GET['id']; // id dari parameter URL

// Ambil data permohonan dari database
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM permohonan_akta WHERE id_permohonan = '$id_permohonan'"));

$nama = $data['nama'];
$nik = $data['nik'];
$jenis_akta = $data['jenis_akta'];
$tanggal = $data['tanggal_permohonan'];

// Generate QR Code
$tempDir = "temp/";
if (!file_exists($tempDir)) mkdir($tempDir);

$qrText = "ID: $id_permohonan | NIK: $nik | Nama: $nama | Jenis Akta: $jenis_akta";
$fileName = 'permohonan_' . $id_permohonan . '.png';
$filepath = $tempDir . $fileName;
QRcode::png($qrText, $filepath, QR_ECLEVEL_L, 4);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bukti Permohonan</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body class="container mt-5">
    <h3>Bukti Permohonan Akta</h3>
    <table class="table table-bordered">
        <tr>
            <th>NIK</th>
            <td><?= $nik ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?= $nama ?></td>
        </tr>
        <tr>
            <th>Jenis Akta</th>
            <td><?= $jenis_akta ?></td>
        </tr>
        <tr>
            <th>Tanggal Permohonan</th>
            <td><?= $tanggal ?></td>
        </tr>
        <tr>
            <th>Barcode</th>
            <td>
                <a href="cetak_bukti.php?id=123" class="btn btn-success">Cetak Bukti</a>
            </td>
        </tr>
    </table>

    <div class="text-center">
        <div class="text-center mt-3">
            <p><strong>Scan QR untuk cek status permohonan:</strong></p>
            <img src="temp/qr_permohonan.png" width="150">
        </div>
        <h5>QR Code Bukti Permohonan</h5>
        <img src="<?= $filepath ?>" alt="QR Code">
        <p class="mt-3">Tunjukkan QR ini saat pengambilan akta di loket pelayanan.</p>
    </div>
</body>

</html>