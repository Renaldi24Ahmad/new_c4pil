<?php
include 'sidebar.php';
include 'config.php';
?>

<?php
// koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "testing");

// proses simpan data kalau form disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama_masyarakat'];
    $rating = $_POST['rating'];
    $ulasan = $_POST['ulasan'];

    $query = mysqli_query($koneksi, "INSERT INTO kepuasan_pelayanan (nama_masyarakat, rating, ulasan) VALUES ('$nama', '$rating', '$ulasan')");

    if ($query) {
        // Jika berhasil, redirect ke kepuasan.php
        echo '<script>history.go(-1);</script>';
    } else {
        // Jika gagal simpan, munculkan alert
        echo '<script>alert("Gagal menyimpan data!");history.go(-1);</script>';
    }
}
?>

<div class="container mt-4 d-flex justify-content-center">
    <div class="card shadow-sm p-3 mb-5 bg-white rounded" style="width: 400px;">
        <h5 class="card-title text-center">Form Ulasan Kepuasan</h5>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Masyarakat:</label>
                <input type="text" name="nama_masyarakat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rating Kepuasan:</label><br>
                <div class="rating">
                    <input type="radio" name="rating" value="5" id="star5"><label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="4" id="star4"><label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="3" id="star3"><label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="2" id="star2"><label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" name="rating" value="1" id="star1"><label for="star1"><i class="fas fa-star"></i></label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Ulasan:</label>
                <textarea name="ulasan" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap 5 & Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">




<hr>

<!-- Tampil Data
<div class="container mt-4">
    <h4>Data Kepuasan Pelayanan</h4>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Rating</th>
            <th>Ulasan</th>
            <th>Tanggal</th>
            <th>Opsi</th>
        </tr>

        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM kepuasan_pelayanan ORDER BY tanggal DESC");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= htmlspecialchars($d['nama_masyarakat']) ?></td>
                <td><?= str_repeat('⭐', $d['rating']); ?></td>
                <td><?= htmlspecialchars($d['ulasan']) ?></td>
                <td><?= $d['tanggal'] ?></td>
                <td>
                    <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id_kp']; ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <i class=" fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php
if (!empty($_GET['hapus'])) {
    $id_kp = $_GET['hapus'];
    $query = mysqli_query($conn, "DELETE FROM kepuasan_pelayanan WHERE id_kp='$id_kp'");
    if ($query) {
        echo '<script>history.go(-1);</script>';
    } else {
        echo '<script>alert("Gagal Hapus Data Riwayat Pengambilan.");history.go(-1);</script>';
    }
}
?> -->

<!-- CSS Rating -->
<style>
    .rating input {
        display: none;
    }

    .rating label {
        font-size: 30px;
        color: #ddd;
        cursor: pointer;
        margin-right: 5px;
    }

    .rating input:checked~label i,
    .rating label:hover~label i,
    .rating label:hover i,
    .rating input:checked+label i {
        color: gold;
    }
</style>
<?php include 'footer.php'; ?>