<?php
include 'sidebar.php';
?>

<h1 class="h3 mb-0">
    Data Ulasan Kepuasan
    <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#kepuasanModal">Tambah Ulasan</button>
</h1>
<hr>

<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Rating</th>
            <th>Ulasan</th>
            <th>Tanggal</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $data = mysqli_query($conn, "SELECT * FROM kepuasan_pelayanan ORDER BY tanggal DESC");
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
    </tbody>
<?php } ?>
</table>
<!-- Modal -->
<div class="modal fade" id="kepuasanModal" tabindex="-1" aria-labelledby="kepuasanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kepuasanModalLabel">Form Ulasan Kepuasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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

if (!empty($_GET['hapus'])) {
    $id_kp = $_GET['hapus'];
    $query = mysqli_query($conn, "DELETE FROM kepuasan_pelayanan WHERE id_kp='$id_kp'");
    if ($query) {
        echo '<script>history.go(-1);</script>';
    } else {
        echo '<script>alert("Gagal Hapus Data Riwayat Pengambilan.");history.go(-1);</script>';
    }
}
?>

<hr>
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