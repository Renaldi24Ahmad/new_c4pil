<?php
@ob_start();
session_start();
include 'config.php';

if (isset($_SESSION['log'])) {
  header('location:riwayat.php');
};

if (isset($_POST['login'])) {
  $nik = mysqli_real_escape_string($conn, $_POST['nik']);
  $pass = mysqli_real_escape_string($conn, $_POST['password']);

  // Query untuk mengambil data user berdasarkan username
  $queryuser = mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
  $cariuser = mysqli_fetch_assoc($queryuser);

  // Verifikasi password
  if ($cariuser && password_verify($pass, $cariuser['password'])) {
    $_SESSION['id_user'] = $cariuser['id_user'];
    $_SESSION['nik'] = $cariuser['nik'];
    $_SESSION['nama_lengkap'] = $cariuser['nama_lengkap'];
    $_SESSION['role'] = $cariuser['role'];
    $_SESSION['log'] = "login";

    echo '<script>alert("Selamat datang, ' . $cariuser['nama_lengkap'] . '!");window.location="pengaturan.php";</script>';
  } else {
    echo '<script>alert("Username atau password salah!");history.go(-1);</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Aplikasi Samsat</title>
  <link rel="icon" href="assets/images/logo-capil-new.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <style>
    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background: #4c6ef8;
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }

    .form-signin .form-control {
      position: relative;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }

    .form-signin input[type="text"],
    .form-signin input[type="password"] {
      margin-bottom: -1px;
      border-radius: 0;
    }

    .form-signin button {
      font-weight: 700;
    }

    .form-signin .text-white {
      color: white;
    }
  </style>
</head>

<body class="text-center">

  <form class="form-signin" method="POST">
    <img class="mb-4" src="assets/images/logo-capil-new.png" alt="Logo" width="150" height="150">
    <div class="form-group mb-2">
      <label for="inputuser" class="sr-only">Nik</label>
      <input type="text" id="inputuser" name="nik" class="form-control" placeholder="Masukan Nik..." required autofocus>
    </div>
    <div class="form-group mb-2">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Masukan Password..." required>
    </div>
    <button class="btn btn-warning btn-block" name="login" type="submit">Sign in</button>
    <p class="mt-3 mb-3 text-white">&copy; Selamat Datang di Aplikasi Catatan Sipil - <a target="_blank" rel="noopener noreferrer" href="#" class="text-white">BANJARMASIN</a></p>
  </form>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>