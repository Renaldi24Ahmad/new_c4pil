<?php
session_start();
include 'sidebar.php';
include 'koneksi.php';
// koneksi ke database

// Cek login
if (!isset($_SESSION['log']) || $_SESSION['log'] != "login") {
    header("location:login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

if (isset($_POST['submit'])) {
    $jenis_akta = $_POST['Jenis_Akta'];
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
        echo "<script>alert('Permohonan berhasil dikirim'); window.location='pengajuan_akta.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>





<div class="container mt-4">
    <h3 class="mb-4">Form Permohonan Perubahan Akta</h3>
    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <div class="form-group">
            <label>Jenis Akta</label>
            <select name="Jenis_Akta" class="form-control" required>
                <option value="Kelahiran">Kelahiran</option>
                <option value="Kematian">Kematian</option>
            </select>
        </div>

        <div class="form-group">
            <label>Catatan Perubahan</label>
            <textarea name="catatan_perubahan" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label>Upload KTP Pemohon</label>
            <input type="file" name="file_ktp" class="form-control-file" required>
            <p>
                Ukuran file maksimal 5MB
            </p>
        </div>

        <div class="form-group">
            <label>Upload Akta Lama</label>
            <input type="file" name="file_akta" class="form-control-file" required>
            <p>
                Ukuran file maksimal 5MB
            </p>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-2">
            <i class="fas fa-save"></i> Kirim
        </button>
    </form>
</div>

</html>
<?php include 'footer.php'; ?>