<?php
$koneksi = mysqli_connect("localhost", "root", "", "catatan_sipil");
if (mysqli_connect_error()) {
    echo "Koneksi Gagal : " . mysqli_connect_error();
}
