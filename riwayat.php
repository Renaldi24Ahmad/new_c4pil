<?php
include 'sidebar.php';
include 'config.php'; // Koneksi ke database
?>

<h1 class="h3 mb-0">
  Permohonan Pengambilan Akta
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah-Riwayat">Tambah Riwayat</button>
  <!-- <button class="btn btn-primary btn-sm border-0 float-right mr-3" type="button" onclick="location.href='laporan-riwayat.php';">CETAK</button> -->
</h1>
<hr>

<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nomor Akta</th>
      <th>Nama Pemilik</th>
      <th>Nama Pemohon</th>
      <th>Status</th>
      <th>Modif By</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data_riwayat = mysqli_query($conn, "
      SELECT rp.id_riwayat, rp.nomor_akta, rp.id_pemohon, rp.status, u.username, 

             COALESCE(a.nama_pemilik, b.nama_pemilik, c.nama_pemilik, d.nama_pemilik) AS nama_pemilik,

             p.nama_pemohon

      FROM riwayat_pengambilan rp

      LEFT JOIN akta_b a ON rp.nomor_akta = a.nomor_akta

      LEFT JOIN akta_cu b ON rp.nomor_akta = b.nomor_akta

      LEFT JOIN akta_pn c ON rp.nomor_akta = c.nomor_akta

      LEFT JOIN akta_terbit d ON rp.nomor_akta = d.nomor_akta

      JOIN pemohon p ON rp.id_pemohon = p.id_pemohon

      JOIN user u ON rp.id_user = u.id_user

      ORDER BY rp.id_riwayat ASC
    ");

    while ($d = mysqli_fetch_array($data_riwayat)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nomor_akta']; ?></td>
        <td><?php echo $d['nama_pemilik']; ?></td>
        <td><?php echo $d['nama_pemohon']; ?></td>
        <td>

          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditStatus<?php echo $d['id_riwayat']; ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i><?php echo $d['status']; ?>
          </button>
        </td>
        <td><?php echo $d['username']; ?></td>
        <td>
          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditRiwayat<?php echo $d['id_riwayat']; ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs" href="?hapus=<?php echo $d['id_riwayat']; ?>" onclick="return confirm('Yakin ingin menghapus?')">
            <i class=" fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>

      <!-- Modal Edit -->
      <div class="modal fade" id="EditStatus<?php echo $d['id_riwayat']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Edit Status</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_riwayat" value="<?php echo $d['id_riwayat']; ?>">

                <div class="form-group">
                  <label>Status:</label>
                  <select name="Edit_Status" class="form-control" required>
                    <option value="Terverifikasi" <?php if ($d['status'] == 'Terverifikasi') echo 'selected'; ?>>Terverifikasi</option>
                    <option value="DiTolak" <?php if ($d['status'] == 'DiTolak') echo 'selected'; ?>>DiTolak</option>
                    <option value="Selesai" <?php if ($d['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                  </select>
                  <input type="hidden" name="Edit_id_username" value="<?php echo $ididid_user; ?>">
                </div>

              </div>
              <div class="modal-footer">
                <button type="submit" name="SimpanEditStatus" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <!-- Modal Edit -->
      <div class="modal fade" id="EditRiwayat<?php echo $d['id_riwayat']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Edit Riwayat</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_riwayat" value="<?php echo $d['id_riwayat']; ?>">

                <div class="form-group">
                  <label>Nomor Akta:</label>
                  <select name="Edit_Nomor_Akta" class="form-control" required>
                    <?php
                    // Ambil data dari tabel akta_b
                    $data_akta_b = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_b");
                    while ($row = mysqli_fetch_array($data_akta_b)) {
                      $selected = ($row['nomor_akta'] == $d['nomor_akta']) ? 'selected' : '';
                      echo '<option value="' . $row['nomor_akta'] . '" ' . $selected . '>' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta B)</option>';
                    }

                    // Ambil data dari tabel akta_cu
                    $data_akta_cu = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_cu");
                    while ($row = mysqli_fetch_array($data_akta_cu)) {
                      $selected = ($row['nomor_akta'] == $d['nomor_akta']) ? 'selected' : '';
                      echo '<option value="' . $row['nomor_akta'] . '" ' . $selected . '>' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta CU)</option>';
                    }

                    // Ambil data dari tabel akta_pn
                    $data_akta_pn = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_pn");
                    while ($row = mysqli_fetch_array($data_akta_pn)) {
                      $selected = ($row['nomor_akta'] == $d['nomor_akta']) ? 'selected' : '';
                      echo '<option value="' . $row['nomor_akta'] . '" ' . $selected . '>' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta PN)</option>';
                    }

                    // Ambil data dari tabel akta_terbit
                    $data_akta_terbit = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_terbit");
                    while ($row = mysqli_fetch_array($data_akta_terbit)) {
                      $selected = ($row['nomor_akta'] == $d['nomor_akta']) ? 'selected' : '';
                      echo '<option value="' . $row['nomor_akta'] . '" ' . $selected . '>' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta Terbit)</option>';
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Nama Pemohon:</label>
                  <select name="Edit_Id_Pemohon" class="form-control" required>
                    <?php
                    $data_pemohon = mysqli_query($conn, "SELECT * FROM pemohon");
                    while ($rowss = mysqli_fetch_array($data_pemohon)) {
                      $selected = ($rowss['id_pemohon'] == $d['id_pemohon']) ? 'selected' : '';
                      echo '<option value="' . $rowss['id_pemohon'] . '" ' . $selected . '>' . $rowss['nama_pemohon'] . ' - ' . $rowss['id_pemohon'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Status:</label>
                  <select name="Edit_Status" class="form-control" required>
                    <option value="<?php echo $d['status']; ?>"><?php echo $d['status']; ?></option>
                  </select>
                  <input type="hidden" name="Edit_id_username" value="<?php echo $ididid_user; ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="SimpanEditRiwayat" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php } ?>
  </tbody>
</table>

<!-- Modal Tambah Riwayat -->
<div class="modal fade" id="Tambah-Riwayat">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header bg-purple">
          <h5 class="modal-title text-white">Tambah Riwayat</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nomor Akta:</label>
            <select name="Tambah_Nomor_Akta" class="form-control" required>
              <?php
              // Ambil data dari tabel akta_b
              $data_akta_b = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_b");
              while ($row = mysqli_fetch_array($data_akta_b)) {
                echo '<option value="' . $row['nomor_akta'] . '">' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta B)</option>';
              }

              // Ambil data dari tabel akta_cu
              $data_akta_cu = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_cu");
              while ($row = mysqli_fetch_array($data_akta_cu)) {
                echo '<option value="' . $row['nomor_akta'] . '">' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta CU)</option>';
              }

              // Ambil data dari tabel akta_pn
              $data_akta_pn = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_pn");
              while ($row = mysqli_fetch_array($data_akta_pn)) {
                echo '<option value="' . $row['nomor_akta'] . '">' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta PN)</option>';
              }

              // Ambil data dari tabel akta_terbit
              $data_akta_terbit = mysqli_query($conn, "SELECT nomor_akta, nama_pemilik FROM akta_terbit");
              while ($row = mysqli_fetch_array($data_akta_terbit)) {
                echo '<option value="' . $row['nomor_akta'] . '">' . $row['nama_pemilik'] . ' - ' . $row['nomor_akta'] . ' (Akta Terbit)</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Pemohon:</label>
            <select name="Tambah_Id_Pemohon" class="form-control" required>
              <?php
              $data_pemohon = mysqli_query($conn, "SELECT * FROM pemohon");
              while ($row = mysqli_fetch_array($data_pemohon)) {
                echo '<option value="' . $row['id_pemohon'] . '">' . $row['nama_pemohon'] . ' - ' . $row['id_pemohon'] . '</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Status:</label>
            <select name="Tambah_Status" class="form-control" required>
              <option value="Terverifikasi">Terverifikasi</option>
              <!-- <option value="Di Tolak">Di Tolak</option>
              <option value="Selesai">Selesai</option> -->
            </select>
            <input type="hidden" name="id_username" value="<?php echo $ididid_user ?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="TambahRiwayat" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Backend Tambah Data -->
<?php
// Backend Tambah Data
if (isset($_POST['TambahRiwayat'])) {
  $nomor_akta = htmlspecialchars($_POST['Tambah_Nomor_Akta']);
  $id_pemohon = htmlspecialchars($_POST['Tambah_Id_Pemohon']);
  $status = htmlspecialchars($_POST['Tambah_Status']);
  $idusername = htmlspecialchars($_POST['id_username']);

  // Cek apakah nomor akta sudah ada di riwayat
  $cek_riwayat = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM riwayat_pengambilan WHERE nomor_akta='$nomor_akta' AND id_pemohon='$id_pemohon'"));
  if ($cek_riwayat > 0) {
    echo '<script>alert("Riwayat untuk nomor akta ini sudah ada.");history.go(-1);</script>';
  } else {
    $query = "INSERT INTO riwayat_pengambilan (nomor_akta, id_pemohon, status, id_user) VALUES ('$nomor_akta', '$id_pemohon', '$status', '$idusername')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      echo '<script>history.go(-1);</script>';
    } else {
      echo '<script>alert("Gagal Menambah Data Riwayat Pengambilan.");history.go(-1);</script>';
    }
  }
}

// Backend Edit Data
if (isset($_POST['SimpanEditStatus'])) {
  $id_riwayat = $_POST['id_riwayat'];
  $status = $_POST['Edit_Status'];
  $id_user = $_POST['Edit_id_username'];

  // Update query
  $update_query = "UPDATE riwayat_pengambilan SET 
        status = '$status', 
        id_user = '$id_user'
        WHERE id_riwayat = $id_riwayat";

  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Data riwayat berhasil diperbarui!');</script>";
    echo "<script>window.location.href='riwayat.php';</script>"; // Ganti dengan halaman yang sesuai
  } else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
  }
}

// Backend Edit Data
if (isset($_POST['SimpanEditRiwayat'])) {
  $id_riwayat = $_POST['id_riwayat'];
  $nomor_akta = $_POST['Edit_Nomor_Akta'];
  $id_pemohon = $_POST['Edit_Id_Pemohon'];
  $status = $_POST['Edit_Status'];
  $id_user = $_POST['Edit_id_username'];

  // Update query
  $update_query = "UPDATE riwayat_pengambilan SET 
        nomor_akta = '$nomor_akta', 
        id_pemohon = '$id_pemohon', 
        status = '$status', 
        id_user = '$id_user' 
        WHERE id_riwayat = $id_riwayat";

  if (mysqli_query($conn, $update_query)) {
    echo "<script>alert('Data riwayat berhasil diperbarui!');</script>";
    echo "<script>window.location.href='riwayat.php';</script>"; // Ganti dengan halaman yang sesuai
  } else {
    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
  }
}

// Backend Hapus Data
if (!empty($_GET['hapus'])) {
  $id_riwayat = $_GET['hapus'];
  $query = mysqli_query($conn, "DELETE FROM riwayat_pengambilan WHERE id_riwayat='$id_riwayat'");
  if ($query) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Hapus Data Riwayat Pengambilan.");history.go(-1);</script>';
  }
}
?>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Untuk form Tambah
    document.getElementById("nomor_akta").addEventListener("change", function() {
      let selectedOption = this.options[this.selectedIndex];
      document.getElementById("nama_pemilik").value = selectedOption.getAttribute("data-nama-pemilik");
    });

    document.getElementById("id_pemohon").addEventListener("change", function() {
      let selectedOption = this.options[this.selectedIndex];
      document.getElementById("nama_pemohon").value = selectedOption.getAttribute("data-nama-pemohon");
    });

    // Untuk form Edit (karena ID dinamis, perlu loop)
    document.querySelectorAll("[id^=edit_nomor_akta_]").forEach(function(selectElement) {
      selectElement.addEventListener("change", function() {
        let id = this.id.split("_").pop(); // Ambil ID dari elemen
        let selectedOption = this.options[this.selectedIndex];
        document.getElementById("edit_nama_pemilik_" + id).value = selectedOption.getAttribute("data-nama-pemilik");
      });
    });

    document.querySelectorAll("[id^=edit_id_pemohon_]").forEach(function(selectElement) {
      selectElement.addEventListener("change", function() {
        let id = this.id.split("_").pop(); // Ambil ID dari elemen
        let selectedOption = this.options[this.selectedIndex];
        document.getElementById("edit_nama_pemohon_" + id).value = selectedOption.getAttribute("data-nama-pemohon");
      });
    });
  });
</script>

<?php include 'footer.php'; ?>