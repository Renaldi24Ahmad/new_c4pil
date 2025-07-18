<?php
include 'sidebar.php';
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id_permohonan = $_POST['id_permohonan'];
    $nama_pengambil = htmlspecialchars($_POST['nama_pengambil']);
    $nik_pengambil = htmlspecialchars($_POST['nik_pengambil']);

    // Upload file KTP
    $target_dir = "uploads/";
    $file_name = basename($_FILES["bukti_ktp_pengambil"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;
    move_uploaded_file($_FILES["bukti_ktp_pengambil"]["tmp_name"], $target_file);

    // Simpan ke database
    $query = "INSERT INTO pengambilan_akta (id_permohonan, nama_pengambil, nik_pengambil, bukti_ktp_pengambil)
              VALUES ('$id_permohonan', '$nama_pengambil', '$nik_pengambil', '$target_file')";

    if (mysqli_query($koneksi, $query)) {
        // Update status permohonan
        mysqli_query($koneksi, "UPDATE permohonan_akta SET status_permohonan='Sudah Diambil' WHERE id_permohonan='$id_permohonan'");
        echo "<script>alert('Berhasil disimpan'); window.location.href='pengambilan_akta.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan');</script>";
    }
}

// Ambil permohonan yang sudah ditetapkan jadwalnya & belum diambil
$permohonan = mysqli_query($koneksi, "SELECT * FROM permohonan_akta WHERE status_permohonan='Jadwal Ditetapkan'");
?>

<h3>Form Pengambilan Akta</h3>
<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Pilih Permohonan</label>
        <select name="id_permohonan" class="form-control" required>
            <option value="">-- Pilih --</option>
            <?php while ($row = mysqli_fetch_assoc($permohonan)) : ?>
                <option value="<?= $row['id_permohonan'] ?>">
                    <?= $row['id_permohonan'] ?> - <?= $row['jenis_akta'] ?> (<?= $row['jadwal_kunjungan'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama Pengambil</label>
        <input type="text" name="nama_pengambil" class="form-control" required>
    </div>
    <div class="form-group">
        <label>NIK Pengambil</label>
        <input type="text" name="nik_pengambil" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Upload KTP Pengambil</label>
        <input type="file" name="bukti_ktp_pengambil" class="form-control-file" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include 'footer.php'; ?>