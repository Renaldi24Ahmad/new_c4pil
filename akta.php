<?php include 'sidebar.php'; ?>
<!-- isinya -->
<h1 class="h3 mb-0">
    Data Perubahan Akta
    <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah-Akta">Tambah Akta</button>
    <!-- <button class="btn btn-primary btn-sm border-0 float-right mr-3" type="button" onclick="location.href='laporan-akta.php';">CETAK</button> -->
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead style="background-color: #4a83ffff;">
        <tr>
            <th>No</th>
            <th>Nama Pemilik</th>
            <th>Nomor Akta</th>
            <th>Jenis Akta</th>
            <th>Tanggal Terbit</th>
            <th>Keterangan</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_akta = mysqli_query($conn, "SELECT * FROM akta_new 
                                 LEFT JOIN jenis_keterangan ON akta_new.id_keterangan = jenis_keterangan.id_keterangan
                                 ORDER BY nomor_akta ASC");

        while ($d = mysqli_fetch_array($data_akta)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_pemilik']; ?></td>
                <td><?php echo $d['nomor_akta']; ?></td>
                <td><?php echo $d['jenis_akta']; ?></td>
                <td><?php echo $d['tanggal_terbit']; ?></td>
                <td><?php echo $d['nama_keterangan']; ?></td>
                <td>
                    <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#Edit-Akta<?php echo $d['nomor_akta']; ?>">
                        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
                    </button>
                    <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['nomor_akta']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
                </td>
            </tr>

            <!-- Modal Edit Akta -->
            <div class="modal fade" id="Edit-Akta<?php echo $d['nomor_akta']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0">
                        <form method="post">
                            <div class="modal-header bg-purple">
                                <h5 class="modal-title text-white">Edit Akta</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="small">Nama Pemilik:</label>
                                    <input type="text" name="Edit_Nama_Pemilik" value="<?php echo $d['nama_pemilik']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="small">Nomor Akta:</label>
                                    <input type="hidden" name="id" value="<?php echo $d['nomor_akta']; ?>">
                                    <input type="text" name="Edit_Nomor_Akta" value="<?php echo $d['nomor_akta']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="small">Jenis Akta:</label>
                                    <select name="Edit_Jenis_Akta" class="form-control" required>
                                        <option value="Kelahiran" <?php echo ($d['jenis_akta'] == 'Kelahiran') ? 'selected' : ''; ?>>Kelahiran</option>
                                        <option value="Kematian" <?php echo ($d['jenis_akta'] == 'Kematian') ? 'selected' : ''; ?>>Kematian</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="small">Tanggal Terbit:</label>
                                    <input type="date" name="Edit_Tanggal_Terbit" value="<?php echo $d['tanggal_terbit']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="small">Keterangan:</label>
                                    <select name="Edit_Keterangan" class="form-control" required>
                                        <?php
                                        $keterangan = mysqli_query($conn, "SELECT * FROM jenis_keterangan");
                                        while ($row = mysqli_fetch_array($keterangan)) {
                                            $selected = ($d['id_keterangan'] == $row['id_keterangan']) ? 'selected' : '';
                                            echo '<option value="' . $row['id_keterangan'] . '" ' . $selected . '>' . $row['nama_keterangan'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                  <label class="small">Status:</label>
                  <input type="text" name="Edit_Status" value="<?php echo $d['status']; ?>" class="form-control" required>
                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" name="SimpanEditAkta" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php

        if (isset($_POST['TambahAkta'])) {
            $id_permohonan = $_POST['id_permohonan'];
            $nomor_akta = htmlspecialchars($_POST['Tambah_Nomor_Akta']);
            $nama_pemilik = htmlspecialchars($_POST['Tambah_Nama_Pemilik']);
            $jenis_akta = htmlspecialchars($_POST['Tambah_Jenis_Akta']);
            $tanggal_terbit = htmlspecialchars($_POST['Tambah_Tanggal_Terbit']);
            $id_keterangan = $_POST['Tambah_Keterangan'];

            // Cek apakah nomor akta sudah ada
            $cek_akta = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM akta_new WHERE nomor_akta='$nomor_akta'"));
            if ($cek_akta > 0) {
                echo '<script>alert("Nomor Akta sudah ada");history.go(-1);</script>';
            } else {
                // Simpan data ke akta_new
                $query = "INSERT INTO akta_new (id_permohonan, nomor_akta, nama_pemilik, jenis_akta, tanggal_terbit, id_keterangan)
                  VALUES ('$id_permohonan', '$nomor_akta', '$nama_pemilik', '$jenis_akta', '$tanggal_terbit', '$id_keterangan')";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // ✅ Update status_permohonan ke "Selesai"
                    mysqli_query($conn, "UPDATE permohonan_akta SET status_permohonan = 'Akta Selesai' WHERE id_permohonan = '$id_permohonan'");

                    // ✅ Ambil nomor WA berdasarkan id_permohonan
                    $getWa = mysqli_query($conn, "
                SELECT u.no_wa, u.nama_lengkap 
                FROM users u 
                JOIN permohonan_akta p ON u.id_user = p.id_user 
                WHERE p.id_permohonan = '$id_permohonan' 
                LIMIT 1
            ");
                    $waRow = mysqli_fetch_assoc($getWa);

                    if ($waRow && !empty($waRow['no_wa'])) {
                        $nomor_wa = $waRow['no_wa']; // format: 628xxx
                        $nama_lengkap = $waRow['nama_lengkap'];
                        $pesan = "Halo *$nama_lengkap*,\n\n" .
                            "Permohonan Akta Anda dengan detail berikut:\n\n" .
                            "🔹 Nomor Akta : *$nomor_akta*\n" .
                            "🔹 Nama        : *$nama_lengkap*\n" .
                            "🔹 Jenis Akta  : *$jenis_akta*\n\n" .
                            "Telah *SELESAI DIBUAT*.\n\n" .
                            "Silakan datang ke Kantor *Disdukcapil Banjarmasin* untuk melakukan pengambilan.\n\n" .
                            "Terima kasih.";

                        // ✅ Kirim WA via Wablas
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
                                'Authorization: dDiIG1KzlOnLsTHiCj1GPAjNHUiLPPoRqN1UURFlf2BeGArQXzN16C3',
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                    }

                    echo '<script>history.go(-1);</script>';
                } else {
                    echo '<script>alert("Gagal Menambah Data Akta");history.go(-1);</script>';
                }
            }
        }



        if (isset($_POST['SimpanEditAkta'])) {
            $id_akta = htmlspecialchars($_POST['id']);
            $nomor_akta = htmlspecialchars($_POST['Edit_Nomor_Akta']);
            $nama_pemilik = htmlspecialchars($_POST['Edit_Nama_Pemilik']);
            $jenis_akta = htmlspecialchars($_POST['Edit_Jenis_Akta']);
            $tanggal_terbit = htmlspecialchars($_POST['Edit_Tanggal_Terbit']);
            $id_keterangan = $_POST['Edit_Keterangan'];
            // $status = htmlspecialchars($_POST['Edit_Status']);

            $query = "UPDATE akta_new SET nomor_akta='$nomor_akta', nama_pemilik='$nama_pemilik', jenis_akta='$jenis_akta', 
            tanggal_terbit='$tanggal_terbit', id_keterangan='$id_keterangan'
            WHERE nomor_akta='$id_akta'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                echo '<script>history.go(-1);</script>';
            } else {
                echo '<script>alert("Gagal Edit Data Akta");history.go(-1);</script>';
            }
        };
        if (!empty($_GET['hapus'])) {
            $nomor_akta = $_GET['hapus'];
            $query = mysqli_query($conn, "DELETE FROM akta_new WHERE nomor_akta='$nomor_akta'");
            if ($query) {
                echo '<script>history.go(-1);</script>';
            } else {
                echo '<script>alert("Gagal Hapus Data Akta");history.go(-1);</script>';
            }
        };
        $permohonan = mysqli_query($conn, "SELECT p.id_permohonan, p.jenis_akta, p.jadwal_kunjungan, u.nama_lengkap
    FROM permohonan_akta p
    JOIN users u ON p.id_user = u.id_user
    WHERE p.status_permohonan = 'Proses Pembuatan'");
        ?>
        <!-- Modal Tambah Akta -->
        <!-- Modal Tambah Akta -->
        <div class="modal fade" id="Tambah-Akta" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content border-0">
                    <form method="post">
                        <div class="modal-header bg-purple">
                            <h5 class="modal-title text-white">Tambah Akta</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- ID Permohonan -->
                            <div class="form-group">
                                <label>Pilih Permohonan</label>
                                <select name="id_permohonan" id="id_permohonan" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <?php while ($rows = mysqli_fetch_assoc($permohonan)) : ?>
                                        <option
                                            value="<?= $rows['id_permohonan'] ?>"
                                            data-jenis_akta="<?= $rows['jenis_akta'] ?>">
                                            <?= $rows['id_permohonan'] ?> - <?= $rows['nama_lengkap'] ?> - <?= $rows['jenis_akta'] ?> - (<?= $rows['jadwal_kunjungan'] ?>)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <!-- Nama Pemilik -->
                            <div class="form-group">
                                <label class="small">Nama Pemilik:</label>
                                <input type="text" name="Tambah_Nama_Pemilik" class="form-control" required>
                            </div>

                            <!-- Nomor Akta -->
                            <div class="form-group">
                                <label class="small">Nomor Akta:</label>
                                <input type="text" name="Tambah_Nomor_Akta" class="form-control" required>
                            </div>

                            <!-- Jenis Akta -->
                            <div class="form-group">
                                <label class="small">Jenis Akta:</label>
                                <input type="text" id="jenis_akta" name="Tambah_Jenis_Akta" class="form-control" readonly required>
                            </div>

                            <!-- Tanggal Terbit -->
                            <div class="form-group">
                                <label class="small">Tanggal Terbit:</label>
                                <input type="date" name="Tambah_Tanggal_Terbit" class="form-control" required>
                            </div>

                            <!-- Keterangan -->
                            <div class="form-group">
                                <label class="small">Keterangan:</label>
                                <select name="Tambah_Keterangan" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <?php
                                    $keterangan = mysqli_query($conn, "SELECT * FROM jenis_keterangan");
                                    while ($row = mysqli_fetch_array($keterangan)) {
                                        echo '<option value="' . $row['id_keterangan'] . '">' . $row['nama_keterangan'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="TambahAkta" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script>
            document.getElementById('id_permohonan').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const jenisAkta = selectedOption.getAttribute('data-jenis_akta');
                document.getElementById('jenis_akta').value = jenisAkta || '';
            });
        </script>


        <!-- end isinya -->
        <?php include 'footer.php'; ?>