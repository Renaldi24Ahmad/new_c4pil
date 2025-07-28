<?php
include 'sidebar.php';
include 'koneksi.php';

// Proses simpan saat form disubmit
if (isset($_POST['submit'])) {
    $id_permohonan = $_POST['id_permohonan'];
    $nama_pengambil = htmlspecialchars($_POST['nama_pengambil']);
    $nik_pengambil = htmlspecialchars($_POST['nik_pengambil']);

    // --- Validasi & Upload File KTP ---
    $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];
    $max_size = 5 * 1024 * 1024; // 5MB
    $file_tmp = $_FILES["bukti_ktp_pengambil"]["tmp_name"];
    $file_name = basename($_FILES["bukti_ktp_pengambil"]["name"]);
    $file_size = $_FILES["bukti_ktp_pengambil"]["size"];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Validasi ukuran dan ekstensi
    if ($file_size > $max_size) {
        echo "<script>alert('Ukuran file melebihi 5MB'); history.go(-1);</script>";
        exit;
    }

    if (!in_array($file_ext, $allowed_ext)) {
        echo "<script>alert('Ekstensi file tidak diizinkan. Hanya JPG, PNG, atau PDF.'); history.go(-1);</script>";
        exit;
    }

    // Proses upload
    $upload_dir = 'uploads/';
    $new_file_name = $upload_dir . time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
    move_uploaded_file($file_tmp, $new_file_name);

    // Simpan ke database
    $query = "INSERT INTO pengambilan_akta (id_permohonan, nama_pengambil, nik_pengambil, bukti_ktp_pengambil)
              VALUES ('$id_permohonan', '$nama_pengambil', '$nik_pengambil', '$new_file_name')";

    if (mysqli_query($koneksi, $query)) {
        mysqli_query($koneksi, "UPDATE permohonan_akta SET status_permohonan='Sudah Diambil' WHERE id_permohonan='$id_permohonan'");
        echo "<script>alert('Data berhasil disimpan'); window.location.href='pengambilan_akta.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data'); history.go(-1);</script>";
    }
}

// Ambil data permohonan dengan status 'Akta Selesai'

$permohonan = mysqli_query($koneksi, "
    SELECT p.id_permohonan, u.nama_lengkap, p.jenis_akta, p.jadwal_kunjungan
    FROM permohonan_akta p
    JOIN users u ON p.id_user = u.id_user
    WHERE p.status_permohonan = 'Akta Selesai'
");
?>

<!-- ===== Tampilan Form ===== -->
<div class="container mt-4">
    <h3 class="mb-4">Form Pengambilan Akta</h3>

    <form method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        <div class="form-group">
            <label for="id_permohonan">Pilih Permohonan</label>
            <select name="id_permohonan" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php while ($rows = mysqli_fetch_assoc($permohonan)) : ?>
                    <option value="<?= $rows['id_permohonan'] ?>">
                        <?= $rows['id_permohonan'] ?> - <?= $rows['nama_lengkap'] ?> - <?= $rows['jenis_akta'] ?> - (<?= $rows['jadwal_kunjungan'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="nama_pengambil">Nama Pengambil</label>
            <input type="text" name="nama_pengambil" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="nik_pengambil">NIK Pengambil</label>
            <input type="text" name="nik_pengambil" class="form-control" required maxlength="16">
        </div>

        <div class="form-group">
            <label for="bukti_ktp_pengambil">Upload KTP Pengambil</label>
            <input type="file" name="bukti_ktp_pengambil" class="form-control-file" required accept=".jpg,.jpeg,.png,.pdf">
            <small class="form-text text-muted">Ukuran maksimal 5MB (JPG, PNG, PDF)</small>
        </div>

        <button type="submit" name="submit" class="btn btn-primary mt-2">
            <i class="fas fa-save"></i> Simpan
        </button>
    </form>
</div>

<?php include 'footer.php'; ?>