<?php
include 'sidebar.php';
$query = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$uid'");
$d = mysqli_fetch_assoc($query);
?>

<!-- isinya -->
<?php
if (isset($_POST['SimpanEdit'])) {
    // Ambil dan sanitasi input
    $nik            = htmlspecialchars($_POST['nik']);
    $no_kk          = htmlspecialchars($_POST['no_kk']);
    $nama_lengkap   = htmlspecialchars($_POST['nama_lengkap']);
    $jk             = htmlspecialchars($_POST['jk']);
    $tempat_lahir   = htmlspecialchars($_POST['tempat_lahir']);
    $tanggal_lahir  = htmlspecialchars($_POST['tanggal_lahir']);
    $alamat         = htmlspecialchars($_POST['alamat']);
    $no_wa          = htmlspecialchars($_POST['no_wa']);
    $email          = htmlspecialchars($_POST['email']);
    $role           = htmlspecialchars($_POST['role']);
    $logo           = htmlspecialchars($_POST['logo']);
    $password       = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek password user
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$uid'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        // Lakukan update
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
            role='$role',
            logo='$logo'
            WHERE id_user='$uid'
        ");

        if ($update) {
            echo '<script>alert("Data berhasil diupdate.");history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal mengupdate data.");history.go(-1);</script>';
        }
    } else {
        echo '<script>alert("Password salah.");history.go(-1);</script>';
    }
};


if (isset($_POST['UpdatePass'])) {
    $old_pass = mysqli_real_escape_string($conn, $_POST['pswd1']);
    $new_pass = $_POST['pswd2'];
    $confirm_pass = $_POST['pswd3'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE id_user='$uid'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($old_pass, $user['password'])) {
        if ($new_pass === $confirm_pass) {
            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $update = mysqli_query($conn, "UPDATE users SET password='$hashed_pass' WHERE id_user='$uid'");

            if ($update) {
                echo '<script>alert("Password berhasil diupdate.");history.go(-1);</script>';
            } else {
                echo '<script>alert("Gagal mengupdate password.");history.go(-1);</script>';
            }
        } else {
            echo "<script>alert('Password baru dan konfirmasi tidak sama.');history.go(-1);</script>";
        }
    } else {
        echo '<script>alert("Password lama salah.");history.go(-1);</script>';
    }
};

?>
<h1 class="h3 mb-2">Account Settings</h1>
<!-- Profile widget -->
<div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 bg-purple" style="border-radius:0.25rem;">
        <div class="media align-items-end profile-header">
            <form method="POST" action="proses-logo.php" enctype="multipart/form-data">
                <div class="profile mr-3">
                    <label for="logo"><img src="assets/images/<?php echo $logo ?>" alt="logo" class="img-cover-profile rounded mb-2 img-thumbnail"></label>
                    <input type="file" class="d-none" id="logo" onchange="form.submit()" name="file" />
                </div>
            </form>
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-0">APLIKASI PERUBAHAN AKTA</h4>
                <p class="small mb-0"><?php echo $nik ?></p>
                <p class="small mb-4"><?php echo $nama_lengkap ?></p>
            </div>
        </div>
    </div>

    <div class="py-4 px-4 mt-5">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#PageProfile" style="letter-spacing: 1px;">
                    <i class="fa fa-user mr-1"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#PagePassword" style="letter-spacing: 1px;">
                    <i class="fa fa-lock mr-1"></i> Password</a>
            </li>
        </ul>
        <div class="tab-content py-3">
            <div id="PageProfile" class="tab-pane active">
                <form method="post">
                    <div class="row">
                        <!-- NIK -->
                        <div class="col-md-6 mb-2">
                            <label for="nik">NIK <span class="text-danger">*</span></label>
                            <input name="nik" type="text" class="form-control" id="nik" value="<?php echo $nik ?? ''; ?>" required>
                        </div>

                        <!-- NO KK -->
                        <div class="col-md-6 mb-2">
                            <label for="no_kk">No KK <span class="text-danger">*</span></label>
                            <input name="no_kk" type="text" class="form-control" id="no_kk" value="<?php echo $no_kk ?? ''; ?>" required>
                        </div>

                        <!-- NAMA LENGKAP -->
                        <div class="col-md-6 mb-2">
                            <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <input name="nama_lengkap" type="text" class="form-control" id="nama_lengkap" value="<?php echo $nama_lengkap ?? ''; ?>" required>
                        </div>

                        <!-- JENIS KELAMIN -->
                        <div class="col-md-6 mb-2">
                            <label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jk" id="jk" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="L" <?php if (($jk ?? '') == 'L') echo 'selected'; ?>>Laki-laki</option>
                                <option value="P" <?php if (($jk ?? '') == 'P') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>

                        <!-- TEMPAT LAHIR -->
                        <div class="col-md-6 mb-2">
                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                            <input name="tempat_lahir" type="text" class="form-control" id="tempat_lahir" value="<?php echo $tempat_lahir ?? ''; ?>" required>
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="col-md-6 mb-2">
                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" value="<?php echo $tanggal_lahir ?? ''; ?>" required>
                        </div>

                        <!-- ALAMAT -->
                        <div class="col-md-12 mb-2">
                            <label for="alamat">Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="2" required><?php echo $alamat ?? ''; ?></textarea>
                        </div>

                        <!-- NO WA -->
                        <div class="col-md-6 mb-2">
                            <label for="no_wa">Nomor WhatsApp <span class="text-danger">*</span></label>
                            <input name="no_wa" type="text" class="form-control" id="no_wa" value="<?php echo $no_wa ?? ''; ?>" required>
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-2">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?? ''; ?>" required>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">


                            <!-- Hidden input untuk tetap mengirimkan data role saat submit -->
                            <input type="hidden" name="role" value="<?php echo $role ?? ''; ?>">
                            <input type="hidden" name="logo" value="<?php echo $logo ?? ''; ?>">
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 text-right mt-3">
                            <div id="Ada1">
                                <button type="button" class="btn btn-primary px-4" onclick="GetVerif()">Update</button>
                            </div>
                            <div style="display:none;width: 100%;" class="cuss" id="Tambah1">
                                <div class="tengah-tengah px-3">
                                    <div class="input-group">
                                        <input name="password" type="password" placeholder="Verifikasi Password" class="form-control mr-2" required>
                                        <div class="input-group-append">
                                            <button type="submit" name="SimpanEdit" class="btn btn-primary px-3">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div id="PagePassword" class="tab-pane fade"><br>
                <form method="POST">
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Lama<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd1" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Baru<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd2" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd3" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-11 col-lg-7 text-right">
                            <button type="submit" name="UpdatePass" class="btn btn-primary px-4">Update</button>
                        </div>
                    </div>

                </form>
            </div>

        </div><!-- End tab -->
    </div>
</div><!-- End profile widget -->

<!-- end isinya -->
</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h3 class="mb-4">Apakah anda ingin keluar ?</h3>
                <button type="button" class="btn btn-secondary px-4 mr-2" data-dismiss="modal">Batal</button>
                <a href="logout.php" class="btn btn-primary px-4">Keluar</a>
            </div>
        </div>
    </div>
    <!-- end Modal Exit -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script>
        function GetVerif() {
            var x = document.getElementById("Ada1");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            var y = document.getElementById("Tambah1");
            if (y.style.display === "block") {
                y.style.display = "none";
            } else {
                y.style.display = "block";
            }
        }
    </script>
    </body>

    </html>