<?php

include 'sidebar.php';

$result = mysqli_query($conn, "SELECT p.*, u.nama_lengkap 
          FROM permohonan_akta p 
          JOIN users u ON p.id_user = u.id_user 
          WHERE u.nama_lengkap = '$nama_lengkap' 
          ORDER BY p.id_permohonan DESC");
?>



<body>
    <h1 class="h3 mb-0">Verifikasi Permohonan Akta</h1>
    <hr>
    <table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
        <thead style="background-color: #4a83ffff;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Akta</th>
                <th>Catatan</th>
                <th>Status</th>
                <th>Dokumen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
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
                            Harap Tunggu
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