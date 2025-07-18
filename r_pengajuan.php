<?php

include 'sidebar.php';



// Jika ada aksi verifikasi
if (isset($_POST['verifikasi'])) {
    $id = $_POST['id_permohonan'];
    mysqli_query($conn, "UPDATE permohonan_akta SET status_permohonan='Terverifikasi' WHERE id_permohonan='$id'");
}

// Jika ada aksi jadwal
if (isset($_POST['atur_jadwal'])) {
    $id = $_POST['id_permohonan'];
    $jadwal = $_POST['jadwal_kunjungan'];
    $mulai = $_POST['waktu_kunjungan_mulai'];
    $selesai = $_POST['waktu_kunjungan_selesai'];

    mysqli_query($conn, "UPDATE permohonan_akta 
        SET status_permohonan='Jadwal Ditetapkan', 
        jadwal_kunjungan='$jadwal', 
        waktu_kunjungan_mulai='$mulai', 
        waktu_kunjungan_selesai='$selesai' 
        WHERE id_permohonan='$id'");
}

$result = mysqli_query($conn, "SELECT p.*, u.nama_lengkap FROM permohonan_akta p JOIN users u ON p.id_user = u.id_user ORDER BY id_permohonan DESC");
?>



<body>
    <h1 class="h3 mb-0">Verifikasi Permohonan Akta</h1>
    <hr>
    <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
        <thead style="background-color: #4a83ffff;">
            <tr>
                <th>Nama</th>
                <th>Jenis Akta</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_akta']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['catatan_perubahan'])) ?></td>
                    <td><?= $row['status_permohonan'] ?></td>
                    <td>
                        <a href="uploads/<?= $row['file_ktp_pemohon'] ?>" target="_blank">KTP</a> |
                        <a href="uploads/<?= $row['file_akta_lama'] ?>" target="_blank">Akta</a>
                    </td>
                    <td>
                        <?php if ($row['status_permohonan'] == 'Menunggu Verifikasi'): ?>
                            <form method="post">
                                <input type="hidden" name="id_permohonan" value="<?= $row['id_permohonan'] ?>">
                                <button name="verifikasi" class="btn btn-success btn-sm">Verifikasi</button>
                            </form>
                        <?php elseif ($row['status_permohonan'] == 'Terverifikasi'): ?>
                            <form method="post">
                                <input type="hidden" name="id_permohonan" value="<?= $row['id_permohonan'] ?>">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="jadwal_kunjungan" class="form-control" required>
                                    <label>Waktu Mulai</label>
                                    <input type="time" name="waktu_kunjungan_mulai" class="form-control" required>
                                    <label>Waktu Selesai</label>
                                    <input type="time" name="waktu_kunjungan_selesai" class="form-control" required>
                                </div>
                                <button name="atur_jadwal" class="btn btn-primary btn-sm">Atur Jadwal</button>
                            </form>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>
<?php
include 'footer.php';
?>