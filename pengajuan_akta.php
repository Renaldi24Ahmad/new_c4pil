<?php
session_start();
include 'sidebar.php'; // koneksi ke database

// Cek login
if (!isset($_SESSION['log']) || $_SESSION['log'] != "login") {
    header("location:login.php");
    exit;
}

$id_user = $_SESSION['id_users'];

if (isset($_POST['submit'])) {
    $jenis_akta = $_POST['jenis_akta'];
    $catatan_perubahan = $_POST['catatan_perubahan'];

    // Upload file
    $ktp = $_FILES['file_ktp']['name'];
    $akta = $_FILES['file_akta']['name'];
    $tmp_ktp = $_FILES['file_ktp']['tmp_name'];
    $tmp_akta = $_FILES['file_akta']['tmp_name'];

    $folder = "uploads/";
    move_uploaded_file($tmp_ktp, $folder . $ktp);
    move_uploaded_file($tmp_akta, $folder . $akta);

    // Simpan data ke database
    $query = mysqli_query($koneksi, "INSERT INTO permohonan_akta 
    (id_user, jenis_akta, catatan_perubahan, file_ktp_pemohon, file_akta_lama) 
    VALUES ('$id_user', '$jenis_akta', '$catatan_perubahan', '$ktp', '$akta')");

    if ($query) {
        echo "<script>alert('Permohonan berhasil dikirim'); window.location='dashboard_user.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Permohonan Akta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="container mt-4">
    <h3><b>Form Permohonan Perubahan Akta</b></h3>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Jenis Akta</label>
            <input type="text" name="jenis_akta" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Catatan Perubahan</label>
            <textarea name="catatan_perubahan" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Upload KTP Pemohon</label>
            <input type="file" name="file_ktp" class="form-control-file" required>
        </div>

        <div class="form-group">
            <label>Upload Akta Lama</label>
            <input type="file" name="file_akta" class="form-control-file" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Kirim Permohonan</button>
    </form>
</body>

</html>