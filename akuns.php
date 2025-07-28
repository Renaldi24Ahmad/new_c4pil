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
      <th>NIK</th>
      <th>No KK</th>
      <th>Nama Lengkap</th>
      <th>JK</th>
      <th>Tempat Lahir</th>
      <th>Tanggal Lahir</th>
      <th>Alamat</th>
      <th>No WA</th>
      <th>Email</th>
      <th>Role</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data_user = mysqli_query($conn, "SELECT * FROM users ORDER BY id_user ASC");
    while ($d = mysqli_fetch_array($data_user)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nik']; ?></td>
        <td><?php echo $d['no_kk']; ?></td>
        <td><?php echo $d['nama_lengkap']; ?></td>
        <td><?php echo $d['jk']; ?></td>
        <td><?php echo $d['tempat_lahir']; ?></td>
        <td><?php echo $d['tanggal_lahir']; ?></td>
        <td><?php echo $d['alamat']; ?></td>
        <td><?php echo $d['no_wa']; ?></td>
        <td><?php echo $d['email']; ?></td>
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
                <input type="hidden" name="iduser" value="<?php echo $d['id_user']; ?>">
                <div class="form-group">
                  <label class="small">NIK:</label>
                  <input type="text" name="nik" value="<?php echo $d['nik']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">No KK:</label>
                  <input type="text" name="no_kk" value="<?php echo $d['no_kk']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">Nama Lengkap:</label>
                  <input type="text" name="nama_lengkap" value="<?php echo $d['nama_lengkap']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="small">Jenis Kelamin:</label>
                  <select name="jk" class="form-control" required>
                    <option value="L" <?php echo ($d['jk'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo ($d['jk'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="small">Tempat Lahir:</label>
                  <input type="text" name="tempat_lahir" value="<?php echo $d['tempat_lahir']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label class="small">Tanggal Lahir:</label>
                  <input type="date" name="tanggal_lahir" value="<?php echo $d['tanggal_lahir']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label class="small">Alamat:</label>
                  <textarea name="alamat" class="form-control"><?php echo $d['alamat']; ?></textarea>
                </div>
                <div class="form-group">
                  <label class="small">No WA:</label>
                  <input type="text" name="no_wa" value="<?php echo $d['no_wa']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label class="small">Email:</label>
                  <input type="email" name="email" value="<?php echo $d['email']; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label class="small">Role:</label>
                  <select name="role" class="form-control" required>
                    <option value="Karyawan Pelayanan" <?php echo ($d['role'] == 'Karyawan Pelayanan') ? 'selected' : ''; ?>>Karyawan Pelayanan</option>
                    <option value="Kepala Bidang" <?php echo ($d['role'] == 'Kepala Bidang') ? 'selected' : ''; ?>>Kepala Bidang</option>
                    <option value="Masyarakat" <?php echo ($d['role'] == 'Masyarakat') ? 'selected' : ''; ?>>Masyarakat</option>
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
    <?php } ?>
  </tbody>
</table>


<?php
if (isset($_POST['TambahUser'])) {
  $nik = htmlspecialchars($_POST['nik']);
  $no_kk = htmlspecialchars($_POST['no_kk']);
  $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
  $jk = htmlspecialchars($_POST['jk']);
  $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_wa = htmlspecialchars($_POST['no_wa']);
  $email = htmlspecialchars($_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = htmlspecialchars($_POST['role']);
  $logo = 'foto-profile.png';

  $cekuser = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'"));
  if ($cekuser > 0) {
    echo '<script>alert("Maaf! NIK sudah ada");history.go(-1);</script>';
  } else {
    $query = mysqli_query($conn, "INSERT INTO users (nik, no_kk, nama_lengkap, jk, tempat_lahir, tanggal_lahir, alamat, no_wa, email, password, role, logo) VALUES ('$nik','$no_kk','$nama_lengkap','$jk','$tempat_lahir','$tanggal_lahir','$alamat','$no_wa','$email','$password','$role','$logo')");
    if ($query) {
      echo '<script>location.reload();</script>';
    } else {
      echo '<script>alert("Gagal menambahkan user");history.go(-1);</script>';
    }
  }
}

if (isset($_POST['SimpanEditUser'])) {
  $id = $_POST['iduser'];
  $nik = htmlspecialchars($_POST['nik']);
  $no_kk = htmlspecialchars($_POST['no_kk']);
  $nama_lengkap = htmlspecialchars($_POST['nama_lengkap']);
  $jk = htmlspecialchars($_POST['jk']);
  $tempat_lahir = htmlspecialchars($_POST['tempat_lahir']);
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = htmlspecialchars($_POST['alamat']);
  $no_wa = htmlspecialchars($_POST['no_wa']);
  $email = htmlspecialchars($_POST['email']);
  $role = htmlspecialchars($_POST['role']);

  // Anda bisa tambahkan pengelolaan logo dan password jika diperlukan

  $update = mysqli_query($conn, "UPDATE users SET 
    nik='$nik',
    no_kk='$no_kk',
    nama_lengkap='$nama_lengkap',
    jk='$jk',
    tempat_lahir='$tempat_lahir',
    tanggal_lahir='$tanggal_lahir',
    alamat='$alamat',
    no_wa='$no_wa',
    email='$email',
    role='$role'
    WHERE id_user='$id'");

  if ($update) {
    echo '<script>location.reload();</script>';
  } else {
    echo '<script>alert("Gagal Edit Data User");history.go(-1);</script>';
  }
}


if (!empty($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $hapus = mysqli_query($conn, "DELETE FROM users WHERE id_user='$id'");
  if ($hapus) {
    echo '<script>location.reload();</script>';
  } else {
    echo '<script>alert("Gagal Hapus Data User");history.go(-1);</script>';
  }
}
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
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" required>
          </div>
          <div class="form-group">
            <label>No KK</label>
            <input type="text" name="no_kk" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jk" class="form-control">
              <option value="L">Laki-laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control">
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>No WA</label>
            <input type="text" name="no_wa" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
              <option value="Karyawan Pelayanan">Karyawan Pelayanan</option>
              <option value="Kepala Bidang">Kepala Bidang</option>
              <option value="Masyarakat">Masyarakat</option>
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