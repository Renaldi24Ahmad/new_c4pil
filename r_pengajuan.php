<?php

include 'sidebar.php';



// Jika ada aksi verifikasi
if (isset($_POST['verifikasi'])) {
    $id = $_POST['id_permohonan'];
    mysqli_query($conn, "UPDATE permohonan_akta SET status_permohonan='Terverifikasi' WHERE id_permohonan='$id'");
}

if (isset($_POST['tolak'])) {
    $id = $_POST['id_permohonan'];

    // Ambil data pengguna dari permohonan
    $getUser = mysqli_query($conn, "
        SELECT u.nama_lengkap, u.no_wa
        FROM permohonan_akta p
        JOIN users u ON p.id_user = u.id_user
        WHERE p.id_permohonan = '$id'
        LIMIT 1
    ");

    $user = mysqli_fetch_assoc($getUser);

    // Update status permohonan
    $update = mysqli_query($conn, "UPDATE permohonan_akta SET status_permohonan='Di Tolak' WHERE id_permohonan='$id'");

    if ($update && $user) {
        $nama = $user['nama_lengkap'];
        $nomor_wa = $user['no_wa']; // Format harus 62xxx

        $pesan = "Halo *$nama*,\n\nMaaf, Permohonan Perubahan Akta Anda Telah *DITOLAK*.\nSilakan Ajukan Permohonan Lagi dengan *Benar* dan Pastikan Berkas Yang Di Uploud *Jelas* dan *Tidak Buram*.\n\nTerima kasih.";

        // Kirim pesan WA
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://bdg.wablas.com/api/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query(array(
                'phone' => $nomor_wa,
                'message' => $pesan
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: dDiIG1KzlOnLsTHiCj1GPAjNHUiLPPoRqN1UURFlf2BeGArQXzN16C3', // Ganti dengan token API kamu
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        echo "<script>alert('Permohonan ditolak & notifikasi dikirim.'); window.location.href='r_pengajuan.php';</script>";
    } else {
        echo "<script>alert('Gagal menolak permohonan');history.go(-1);</script>";
    }
}


if (isset($_POST['atur_jadwal'])) {
    $id = $_POST['id_permohonan'];
    $jadwal = $_POST['jadwal_kunjungan'];
    $mulai = $_POST['waktu_kunjungan_mulai'];
    $selesai = $_POST['waktu_kunjungan_selesai'];

    $update = mysqli_query($conn, "UPDATE permohonan_akta 
        SET status_permohonan='Jadwal Ditetapkan', 
            jadwal_kunjungan='$jadwal', 
            waktu_kunjungan_mulai='$mulai', 
            waktu_kunjungan_selesai='$selesai' 
        WHERE id_permohonan='$id'");

    if ($update) {
        // Ambil info pemohon
        $getUser = mysqli_query($conn, "
            SELECT u.no_wa, u.nama_lengkap 
            FROM users u 
            JOIN permohonan_akta p ON u.id_user = p.id_user 
            WHERE p.id_permohonan = '$id' 
            LIMIT 1
        ");
        $data = mysqli_fetch_assoc($getUser);

        if ($data && !empty($data['no_wa'])) {
            $nomor_wa = $data['no_wa'];
            $nama = $data['nama_lengkap'];

            $pesan = "Halo *$nama*,\n\nPermohonan akta Anda telah *Terverifikasi* dan Anda Bisa Datang ke Kantor Disdukcapil Banjarmasin.\n\n"
                . "📅 Tanggal: $jadwal\n"
                . "⏰ Jam: $mulai - $selesai\n\n"
                . "Silakan hadir sesuai jadwal di kantor Disdukcapil Banjarmasin.\nTerima kasih.";

            // Kirim WA
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://bdg.wablas.com/api/send-message',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query(array(
                    'phone' => $nomor_wa,
                    'message' => $pesan
                )),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: dDiIG1KzlOnLsTHiCj1GPAjNHUiLPPoRqN1UURFlf2BeGArQXzN16C3' // Ganti dengan tokenmu
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
        }
    }
}


if (isset($_POST['proses'])) {
    $id = $_POST['id_permohonan'];
    mysqli_query($conn, "UPDATE permohonan_akta SET status_permohonan='Proses Pembuatan' WHERE id_permohonan='$id'");
}

$result = mysqli_query($conn, "SELECT p.*, u.nama_lengkap FROM permohonan_akta p JOIN users u ON p.id_user = u.id_user ORDER BY id_permohonan DESC");
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
                            <form method="post">
                                <input type="hidden" name="id_permohonan" value="<?= $row['id_permohonan'] ?>">
                                <button name="verifikasi" class="btn btn-success btn-sm">Verifikasi</button>
                                <button name="tolak" class="btn btn-danger btn-sm">Di Tolak</button>
                            </form>
                        <?php elseif ($row['status_permohonan'] == 'Terverifikasi'): ?>
                            <form method="post">
                                <input type="hidden" name="id_permohonan" value="<?= $row['id_permohonan'] ?>">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="jadwal_kunjungan" class="form-control" required>
                                    <label>Waktu Mulai</label>
                                    <input type="time" name="waktu_kunjungan_mulai" value="08:00" class="form-control" required>
                                    <label>Waktu Selesai</label>
                                    <input type="time" name="waktu_kunjungan_selesai" value="15:00" class="form-control" required>
                                </div>
                                <button name="atur_jadwal" class="btn btn-primary btn-sm">Atur Jadwal</button>
                            </form>
                        <?php elseif ($row['status_permohonan'] == 'Jadwal Ditetapkan'): ?>
                            <form method="post">
                                <input type="hidden" name="id_permohonan" value="<?= $row['id_permohonan'] ?>">
                                <button name="proses" class="btn btn-success btn-sm">Proses Pembuatan Akta</button>
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