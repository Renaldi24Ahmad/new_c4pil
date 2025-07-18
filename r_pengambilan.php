<?php
include 'sidebar.php';
include 'koneksi.php';

// Ambil data dari pengambilan_akta JOIN permohonan_akta JOIN users
$query = mysqli_query($koneksi, "
    SELECT pa.*, p.jenis_akta, u.nama_lengkap 
    FROM pengambilan_akta pa
    JOIN permohonan_akta p ON pa.id_permohonan = p.id_permohonan
    JOIN users u ON p.id_user = u.id_user
    ORDER BY pa.waktu_pengambilan DESC
");
?>

<div class="container mt-4">
    <h3>Daftar Pengambilan Akta</h3>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Nama Pemohon</th>
                <th>Jenis Akta</th>
                <th>Nama Pengambil</th>
                <th>NIK</th>
                <th>Bukti KTP</th>
                <th>Waktu Pengambilan</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_akta']) ?></td>
                    <td><?= htmlspecialchars($row['nama_pengambil']) ?></td>
                    <td><?= htmlspecialchars($row['nik_pengambil']) ?></td>
                    <td>
                        <?php if ($row['bukti_ktp_pengambil']) : ?>
                            <a href="<?= $row['bukti_ktp_pengambil'] ?>" target="_blank">Lihat</a>
                        <?php else : ?>
                            Tidak ada
                        <?php endif; ?>
                    </td>
                    <td><?= date("d-m-Y H:i", strtotime($row['waktu_pengambilan'])) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>