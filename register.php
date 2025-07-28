<?php
include 'koneksi.php'; // Pastikan koneksi database di-include

if (isset($_POST['register'])) {
    $nik            = $_POST['nik'];
    $no_kk          = $_POST['no_kk'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $jk             = $_POST['jk'];
    $tempat_lahir   = $_POST['tempat_lahir'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];
    $no_wa          = $_POST['no_wa'];
    $email          = $_POST['email'];
    $password       = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role           = 'Masyarakat'; // default
    $logo           = 'foto-profile.png'; // default image/logo

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE nik = '$nik'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('NIK sudah terdaftar!');</script>";
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO users 
            (nik, no_kk, nama_lengkap, jk, tempat_lahir, tanggal_lahir, alamat, no_wa, email, password, role, logo)
            VALUES
            ('$nik', '$no_kk', '$nama_lengkap', '$jk', '$tempat_lahir', '$tanggal_lahir', '$alamat', '$no_wa', '$email', '$password', '$role', '$logo')");

        if ($simpan) {
            echo "<script>alert('Registrasi berhasil, silakan login!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrasi Akun</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-register {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="form-register bg-white p-4 shadow rounded">
            <h3 class="mb-4 text-center">Form Registrasi Akun</h3>
            <form method="POST">
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label>No KK</label>
                    <input type="text" name="no_kk" class="form-control" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="L" required>
                        <label class="form-check-label">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jk" value="P">
                        <label class="form-check-label">Perempuan</label>
                    </div>
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
                    <textarea name="alamat" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>No WhatsApp</label>
                    <input type="text" name="no_wa" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email Aktif</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    <small><input type="checkbox" onclick="togglePassword()"> Tampilkan Password</small>
                </div>
                <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button>
                <div class="text-center mt-3">
                    Sudah punya akun? <a href="login.php">Login di sini</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            var input = document.getElementById("password");
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>