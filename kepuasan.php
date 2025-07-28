<?php include 'sidebar.php'; ?>

<h1 class="h3 mb-0">
    Data Ulasan Kepuasan
    <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#kepuasanModal">Tambah Ulasan</button>
</h1>
<hr>

<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead style="background-color: #4a83ffff;">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Rating</th>
            <th>Ulasan</th>
            <th>Tanggal</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data = mysqli_query($conn, "SELECT * FROM kepuasan_pelayanan ORDER BY tanggal DESC");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($d['nama_masyarakat']) ?></td>
                <td><?= str_repeat('⭐', $d['rating']); ?></td>
                <td><?= htmlspecialchars($d['ulasan']) ?></td>
                <td><?= $d['tanggal'] ?></td>
                <td>
                    <a class="btn btn-danger btn-xs" href="?hapus=<?= $d['id_kp']; ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Tambah -->
<div class="modal fade" id="kepuasanModal" tabindex="-1" aria-labelledby="kepuasanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Ulasan Kepuasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama Masyarakat:</label>
                        <input type="text" name="nama_masyarakat" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Rating Kepuasan:</label><br>
                        <div class="rating">
                            <?php for ($i = 5; $i >= 1; $i--) : ?>
                                <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>">
                                <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Ulasan:</label>
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
// Proses Simpan
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_masyarakat']);
    $rating = (int) $_POST['rating'];
    $ulasan = mysqli_real_escape_string($conn, $_POST['ulasan']);

    $query = mysqli_query($conn, "INSERT INTO kepuasan_pelayanan (nama_masyarakat, rating, ulasan) VALUES ('$nama', '$rating', '$ulasan')");
    echo $query
        ? "<script>location.href='kepuasan.php';</script>"
        : "<script>alert('Gagal menyimpan data!');history.go(-1);</script>";
}

// Proses Hapus
if (!empty($_GET['hapus'])) {
    $id_kp = (int) $_GET['hapus'];
    $query = mysqli_query($conn, "DELETE FROM kepuasan_pelayanan WHERE id_kp='$id_kp'");
    echo $query
        ? "<script>location.href='kepuasan.php';</script>"
        : "<script>alert('Gagal hapus data!');history.go(-1);</script>";
}
?>

<!-- Styling Rating -->
<style>
    .rating input {
        display: none;
    }

    .rating label {
        font-size: 25px;
        color: #ccc;
        cursor: pointer;
        transition: color 0.2s;
    }

    .rating input:checked~label i,
    .rating label:hover~label i,
    .rating label:hover i,
    .rating input:checked+label i {
        color: gold;
    }
</style>

<?php include 'footer.php'; ?>