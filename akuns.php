<?php include 'sidebar.php'; ?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data User
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahUser">Tambah User</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Username</th>
      <th>Nama Lengkap</th>
      <th>Role</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data_user = mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC");
    while ($d = mysqli_fetch_array($data_user)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['username']; ?></td>
        <td><?php echo $d['nama_lengkap']; ?></td>
        <td><?php echo $d['role']; ?></td>
        <td>
          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditUser<?php echo $d['id_user']; ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id_user']; ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal Edit User -->
      <div class="modal fade" id="EditUser<?php echo $d['id_user']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form method="post">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Edit User</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="small">Username:</label>
                  <input type="hidden" name="iduser" value="<?php echo $d['id_user']; ?>">
                  <input type="text" name="Edit_Username" value="<?php echo $d['username']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">Nama Lengkap:</label>
                  <input type="text" name="Edit_Nama_Lengkap" value="<?php echo $d['nama_lengkap']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">Role:</label>
                  <select name="Edit_Role" class="form-control" required>
                    <option value="Karyawan Pelayanan" <?php echo ($d['role'] == 'Karyawan Pelayanan') ? 'selected' : ''; ?>>Karyawan Pelayanan</option>
                    <option value="Kepala Bidang" <?php echo ($d['role'] == 'Kepala Bidang') ? 'selected' : ''; ?>>Kepala Bidang</option>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="SimpanEditUser">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- end Modal Edit User -->
    <?php } ?>
  </tbody>
</table>

<?php
if (isset($_POST['TambahUser'])) {
  $username = htmlspecialchars($_POST['Tambah_Username']);
  $password = password_hash($_POST['Tambah_Password'], PASSWORD_DEFAULT);
  $nama_lengkap = htmlspecialchars($_POST['Tambah_Nama_Lengkap']);
  $role = htmlspecialchars($_POST['Tambah_Role']);

  $cekuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE username='$username'"));
  if ($cekuser > 0) {
    echo '<script>alert("Maaf! Username sudah ada");history.go(-1);</script>';
  } else {
    $InputUser = mysqli_query($conn, "INSERT INTO user (username, password, nama_lengkap, role) 
     VALUES ('$username', '$password', '$nama_lengkap', '$role')");
    if ($InputUser) {
      echo '<script>history.go(-1);</script>';
    } else {
      echo '<script>alert("Gagal Menambahkan Data User");history.go(-1);</script>';
    }
  }
};

if (isset($_POST['SimpanEditUser'])) {
  $iduser = htmlspecialchars($_POST['iduser']);
  $username = htmlspecialchars($_POST['Edit_Username']);
  $nama_lengkap = htmlspecialchars($_POST['Edit_Nama_Lengkap']);
  $role = htmlspecialchars($_POST['Edit_Role']);

  $cekDataUpdate = mysqli_query($conn, "UPDATE user SET username='$username', nama_lengkap='$nama_lengkap', role='$role' WHERE id_user='$iduser'");
  if ($cekDataUpdate) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Edit Data User");history.go(-1);</script>';
  }
};

if (!empty($_GET['hapus'])) {
  $iduser = $_GET['hapus'];
  $hapus_data = mysqli_query($conn, "DELETE FROM user WHERE id_user='$iduser'");
  if ($hapus_data) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Hapus Data User");history.go(-1);</script>';
  }
};
?>

<!-- Modal Tambah User -->
<div class="modal fade" id="TambahUser" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form method="post">
        <div class="modal-header bg-purple">
          <h5 class="modal-title text-white">Tambah User</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="small">Username:</label>
            <input type="text" name="Tambah_Username" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="small">Password:</label>
            <input type="password" name="Tambah_Password" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="small">Nama Lengkap:</label>
            <input type="text" name="Tambah_Nama_Lengkap" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="small">Role:</label>
            <select name="Tambah_Role" class="form-control" required>
              <!-- Tampilkan daftar keterangan dari tabel jenis_keterangan -->
              <option value="">-- Pilih --</option>
              <option value="Karyawan Pelayanan">Karyawan Pelayanan</option>
              <option value="Kepala Bidang">Kepala Bidang</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="TambahUser" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal User -->

<?php include 'footer.php'; ?>