<?php include 'sidebar.php'; ?>
<!-- isinya -->
<h1 class="h3 mb-0">
    Data Masyarakat
    <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahMasyarakat">Tambah Masyarakat</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Lengkap</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>RT/RW</th>
            <th>Kelurahan</th>
            <th>Kecamatan</th>
            <th>Kota/Kabupaten</th>
            <th>Provinsi</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Tanggal Daftar</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_masyarakat = mysqli_query($conn, "SELECT * FROM masyarakat ORDER BY id_masyarakat ASC");
        while ($d = mysqli_fetch_array($data_masyarakat)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($d['nik']); ?></td>
                <td><?php echo htmlspecialchars($d['nama_lengkap']); ?></td>
                <td><?php echo htmlspecialchars($d['tempat_lahir']); ?></td>
                <td><?php echo htmlspecialchars($d['tanggal_lahir']); ?></td>
                <td><?php echo htmlspecialchars($d['jenis_kelamin']); ?></td>
                <td><?php echo htmlspecialchars($d['alamat']); ?></td>
                <td><?php echo htmlspecialchars($d['rt_rw']); ?></td>
                <td><?php echo htmlspecialchars($d['kelurahan']); ?></td>
                <td><?php echo htmlspecialchars($d['kecamatan']); ?></td>
                <td><?php echo htmlspecialchars($d['kota_kabupaten']); ?></td>
                <td><?php echo htmlspecialchars($d['provinsi']); ?></td>
                <td><?php echo htmlspecialchars($d['no_hp']); ?></td>
                <td><?php echo htmlspecialchars($d['email']); ?></td>
                <td><?php echo htmlspecialchars($d['tanggal_daftar']); ?></td>
                <td>
                    <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditMasyarakat<?php echo $d['id_masyarakat']; ?>">
                        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
                    </button>
                    <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id_masyarakat']; ?>" onclick="return confirm('Yakin ingin menghapus?')">
                        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
                </td>
            </tr>
            <div class="modal fade" id="EditMasyarakat<?php echo $d['id_masyarakat']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0">
                        <form method="post">
                            <div class="modal-header bg-purple">
                                <h5 class="modal-title text-white">Edit Masyarakat</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="idmasyarakat" value="<?php echo $d['id_masyarakat']; ?>">

                                <div class="form-group">
                                    <label class="small">NIK:</label>
                                    <input type="text" name="Edit_NIK" value="<?php echo $d['nik']; ?>" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="small">Nama Lengkap:</label>
                                    <input type="text" name="Edit_Nama_Lengkap" value="<?php echo $d['nama_lengkap']; ?>" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label class="small">Tempat Lahir:</label>
                                    <input type="text" name="Edit_Tempat_Lahir" value="<?php echo $d['tempat_lahir']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Tanggal Lahir:</label>
                                    <input type="date" name="Edit_Tanggal_Lahir" value="<?php echo $d['tanggal_lahir']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Jenis Kelamin:</label>
                                    <select name="Edit_Jenis_Kelamin" class="form-control">
                                        <option value="Laki-laki" <?php if ($d['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                        <option value="Perempuan" <?php if ($d['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="small">Alamat:</label>
                                    <textarea name="Edit_Alamat" class="form-control"><?php echo $d['alamat']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="small">RT/RW:</label>
                                    <input type="text" name="Edit_RT_RW" value="<?php echo $d['rt_rw']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Kelurahan:</label>
                                    <input type="text" name="Edit_Kelurahan" value="<?php echo $d['kelurahan']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Kecamatan:</label>
                                    <input type="text" name="Edit_Kecamatan" value="<?php echo $d['kecamatan']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Kota/Kabupaten:</label>
                                    <input type="text" name="Edit_Kota_Kabupaten" value="<?php echo $d['kota_kabupaten']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Provinsi:</label>
                                    <input type="text" name="Edit_Provinsi" value="<?php echo $d['provinsi']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">No HP:</label>
                                    <input type="text" name="Edit_No_HP" value="<?php echo $d['no_hp']; ?>" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="small">Email:</label>
                                    <input type="email" name="Edit_Email" value="<?php echo $d['email']; ?>" class="form-control">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name="SimpanEditMasyarakat">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php } ?>
    </tbody>
</table>


<?php
// Tambah Masyarakat
if (isset($_POST['TambahMasyarakat'])) {
    $nik = htmlspecialchars($_POST['Tambah_NIK']);
    $nama_lengkap = htmlspecialchars($_POST['Tambah_Nama_Lengkap']);
    $tempat_lahir = htmlspecialchars($_POST['Tambah_Tempat_Lahir']);
    $tanggal_lahir = htmlspecialchars($_POST['Tambah_Tanggal_Lahir']);
    $jenis_kelamin = htmlspecialchars($_POST['Tambah_Jenis_Kelamin']);
    $alamat = htmlspecialchars($_POST['Tambah_Alamat']);
    $rt_rw = htmlspecialchars($_POST['Tambah_RT_RW']);
    $kelurahan = htmlspecialchars($_POST['Tambah_Kelurahan']);
    $kecamatan = htmlspecialchars($_POST['Tambah_Kecamatan']);
    $kota_kabupaten = htmlspecialchars($_POST['Tambah_Kota_Kabupaten']);
    $provinsi = htmlspecialchars($_POST['Tambah_Provinsi']);
    $no_hp = htmlspecialchars($_POST['Tambah_No_HP']);
    $email = htmlspecialchars($_POST['Tambah_Email']);

    $ceknik = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik'"));
    if ($ceknik > 0) {
        echo '<script>alert("Maaf! NIK sudah ada");history.go(-1);</script>';
    } else {
        $InputMasyarakat = mysqli_query($conn, "INSERT INTO masyarakat 
        (nik, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt_rw, kelurahan, kecamatan, kota_kabupaten, provinsi, no_hp, email) 
        VALUES 
        ('$nik', '$nama_lengkap', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$rt_rw', '$kelurahan', '$kecamatan', '$kota_kabupaten', '$provinsi', '$no_hp', '$email')");

        if ($InputMasyarakat) {
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Menambahkan Data Masyarakat");history.go(-1);</script>';
        }
    }
}

// Edit Masyarakat
if (isset($_POST['SimpanEditMasyarakat'])) {
    $id_masyarakat = htmlspecialchars($_POST['idmasyarakat']);
    $nik = htmlspecialchars($_POST['Edit_NIK']);
    $nama_lengkap = htmlspecialchars($_POST['Edit_Nama_Lengkap']);
    $tempat_lahir = htmlspecialchars($_POST['Edit_Tempat_Lahir']);
    $tanggal_lahir = htmlspecialchars($_POST['Edit_Tanggal_Lahir']);
    $jenis_kelamin = htmlspecialchars($_POST['Edit_Jenis_Kelamin']);
    $alamat = htmlspecialchars($_POST['Edit_Alamat']);
    $rt_rw = htmlspecialchars($_POST['Edit_RT_RW']);
    $kelurahan = htmlspecialchars($_POST['Edit_Kelurahan']);
    $kecamatan = htmlspecialchars($_POST['Edit_Kecamatan']);
    $kota_kabupaten = htmlspecialchars($_POST['Edit_Kota_Kabupaten']);
    $provinsi = htmlspecialchars($_POST['Edit_Provinsi']);
    $no_hp = htmlspecialchars($_POST['Edit_No_HP']);
    $email = htmlspecialchars($_POST['Edit_Email']);

    $CariNIK = mysqli_query($conn, "SELECT * FROM masyarakat WHERE nik='$nik' AND id_masyarakat!='$id_masyarakat'");
    $CekData = mysqli_num_rows($CariNIK);

    if ($CekData > 0) {
        echo '<script>alert("Maaf! NIK sudah ada");history.go(-1);</script>';
    } else {
        $UpdateMasyarakat = mysqli_query($conn, "UPDATE masyarakat SET 
            nik='$nik', 
            nama_lengkap='$nama_lengkap', 
            tempat_lahir='$tempat_lahir', 
            tanggal_lahir='$tanggal_lahir', 
            jenis_kelamin='$jenis_kelamin',
            alamat='$alamat',
            rt_rw='$rt_rw',
            kelurahan='$kelurahan',
            kecamatan='$kecamatan',
            kota_kabupaten='$kota_kabupaten',
            provinsi='$provinsi',
            no_hp='$no_hp',
            email='$email'
        WHERE id_masyarakat='$id_masyarakat'");

        if ($UpdateMasyarakat) {
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Edit Data Masyarakat");history.go(-1);</script>';
        }
    }
}

if (!empty($_GET['hapus'])) {
    $id_masyarakat1 = $_GET['hapus'];
    $hapus_data = mysqli_query($conn, "DELETE FROM masyarakat WHERE id_masyarakat='$id_masyarakat1'");
    if ($hapus_data) {
        echo '<script>history.go(-1);</script>';
    } else {
        echo '<script>alert("Gagal Hapus Data Pemohon");history.go(-1);</script>';
    }
};
?>

<!-- Modal Tambah Masyarakat -->
<div class="modal fade" id="TambahMasyarakat" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <form method="post">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title text-white">Tambah Masyarakat</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="small">NIK:</label>
                        <input type="text" name="Tambah_NIK" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="small">Nama Lengkap:</label>
                        <input type="text" name="Tambah_Nama_Lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="small">Tempat Lahir:</label>
                        <input type="text" name="Tambah_Tempat_Lahir" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Tanggal Lahir:</label>
                        <input type="date" name="Tambah_Tanggal_Lahir" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Jenis Kelamin:</label>
                        <select name="Tambah_Jenis_Kelamin" class="form-control">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="small">Alamat:</label>
                        <textarea name="Tambah_Alamat" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="small">RT/RW:</label>
                        <input type="text" name="Tambah_RT_RW" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Kelurahan:</label>
                        <input type="text" name="Tambah_Kelurahan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Kecamatan:</label>
                        <input type="text" name="Tambah_Kecamatan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Kota/Kabupaten:</label>
                        <input type="text" name="Tambah_Kota_Kabupaten" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Provinsi:</label>
                        <input type="text" name="Tambah_Provinsi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">No HP:</label>
                        <input type="text" name="Tambah_No_HP" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="small">Email:</label>
                        <input type="email" name="Tambah_Email" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" name="TambahMasyarakat" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Modal Masyarakat -->


<!-- end isinya -->
<?php include 'footer.php'; ?>