<?php include 'sidebar.php'; ?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Pemohon
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahPemohon">Tambah Pemohon</button>
  <!-- <button class="btn btn-primary btn-sm border-0 float-right mr-3" type="button" onclick="location.href='laporan-pemohon.php';">CETAK</button> -->
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
  <thead style="background-color: #4a83ffff;">
    <tr>
      <th>No</th>
      <th>Nama Pemohon</th>
      <th>NIK</th>
      <th>No HP</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data_pemohon = mysqli_query($conn, "SELECT * FROM pemohon ORDER BY id_pemohon ASC");
    while ($d = mysqli_fetch_array($data_pemohon)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama_pemohon']; ?></td>
        <td><?php echo $d['nik']; ?></td>
        <td><?php echo $d['no_hp']; ?></td>
        <td>
          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditPemohon<?php echo $d['id_pemohon']; ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id_pemohon']; ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal Edit Pemohon -->
      <div class="modal fade" id="EditPemohon<?php echo $d['id_pemohon']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form method="post">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Edit Pemohon</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="small">Nama Pemohon:</label>
                  <input type="hidden" name="idpemohon" value="<?php echo $d['id_pemohon']; ?>">
                  <input type="text" name="Edit_Nama_Pemohon" value="<?php echo $d['nama_pemohon']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">NIK:</label>
                  <input type="text" name="Edit_NIK" value="<?php echo $d['nik']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">No HP:</label>
                  <input type="text" name="Edit_No_HP" value="<?php echo $d['no_hp']; ?>" class="form-control" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="SimpanEditPemohon">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- end Modal Edit Pemohon -->
    <?php } ?>
  </tbody>
</table>

<?php
if (isset($_POST['TambahPemohon'])) {
  $nama_pemohon = htmlspecialchars($_POST['Tambah_Nama_Pemohon']);
  $nik = htmlspecialchars($_POST['Tambah_NIK']);
  $no_hp = htmlspecialchars($_POST['Tambah_No_HP']);

  $ceknik = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pemohon WHERE nik='$nik'"));
  if ($ceknik > 0) {
    echo '<script>alert("Maaf! NIK sudah ada");history.go(-1);</script>';
  } else {
    $InputPemohon = mysqli_query($conn, "INSERT INTO pemohon (nama_pemohon, nik, no_hp) 
     VALUES ('$nama_pemohon', '$nik', '$no_hp')");
    if ($InputPemohon) {
      echo '<script>history.go(-1);</script>';
    } else {
      echo '<script>alert("Gagal Menambahkan Data Pemohon");history.go(-1);</script>';
    }
  }
};

if (isset($_POST['SimpanEditPemohon'])) {
  $idpemohon1 = htmlspecialchars($_POST['idpemohon']);
  $nama_pemohon1 = htmlspecialchars($_POST['Edit_Nama_Pemohon']);
  $nik1 = htmlspecialchars($_POST['Edit_NIK']);
  $no_hp1 = htmlspecialchars($_POST['Edit_No_HP']);

  $CariPemohon = mysqli_query($conn, "SELECT * FROM pemohon WHERE nik='$nik1' and id_pemohon!='$idpemohon1'");
  $HasilData = mysqli_num_rows($CariPemohon);

  if ($HasilData > 0) {
    echo '<script>alert("Maaf! NIK sudah ada");history.go(-1);</script>';
  } else {
    $cekDataUpdate =  mysqli_query($conn, "UPDATE pemohon SET nama_pemohon='$nama_pemohon1',
        nik='$nik1', no_hp='$no_hp1' WHERE id_pemohon='$idpemohon1'");
    if ($cekDataUpdate) {
      echo '<script>history.go(-1);</script>';
    } else {
      echo '<script>alert("Gagal Edit Data Pemohon");history.go(-1);</script>';
    }
  }
};

if (!empty($_GET['hapus'])) {
  $idpemohon1 = $_GET['hapus'];
  $hapus_data = mysqli_query($conn, "DELETE FROM pemohon WHERE id_pemohon='$idpemohon1'");
  if ($hapus_data) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Hapus Data Pemohon");history.go(-1);</script>';
  }
};
?>

<!-- Modal Tambah Pemohon -->
<div class="modal fade" id="TambahPemohon" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form method="post">
        <div class="modal-header bg-purple">
          <h5 class="modal-title text-white">Tambah Pemohon</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="small">Nama Pemohon:</label>
            <input type="text" name="Tambah_Nama_Pemohon" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="small">NIK:</label>
            <input type="text" name="Tambah_NIK" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="small">No HP:</label>
            <input type="text" name="Tambah_No_HP" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="TambahPemohon" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Pemohon -->

<!-- end isinya -->
<?php include 'footer.php'; ?>