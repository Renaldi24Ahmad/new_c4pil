<?php
include 'koneksi.php';

$step = 1; // default step

if (isset($_POST['verifikasi'])) {
    $nik = $_POST['nik'];
    $no_kk = $_POST['no_kk'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE nik='$nik' AND no_kk='$no_kk'");
    if (mysqli_num_rows($cek) > 0) {
        $step = 2;
        $user = mysqli_fetch_assoc($cek);
        $id_user = $user['id_user'];
    } else {
        $error = "Data tidak cocok. Pastikan NIK & No KK benar.";
    }
}

if (isset($_POST['reset_password'])) {
    $id_user = $_POST['id_user'];
    $password_baru = password_hash($_POST['password_baru'], PASSWORD_DEFAULT);
    $update = mysqli_query($koneksi, "UPDATE users SET password='$password_baru' WHERE id_user='$id_user'");

    if ($update) {
        echo "<script>alert('Password berhasil direset. Silakan login.'); window.location='login.php';</script>";
        exit;
    } else {
        $error = "Gagal mengupdate password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card p-4 shadow-sm col-md-6 mx-auto">
            <h4 class="text-center mb-3">Lupa Password</h4>

            <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>

            <?php if ($step == 1): ?>
                <form method="post">
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No KK</label>
                        <input type="text" name="no_kk" class="form-control" required>
                    </div>
                    <button type="submit" name="verifikasi" class="btn btn-primary btn-block">Verifikasi</button>
                </form>

            <?php elseif ($step == 2): ?>
                <form method="post">
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" required>
                    </div>
                    <button type="submit" name="reset_password" class="btn btn-success btn-block">Reset Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>