<?php
$koneksi = mysqli_connect("localhost", "root", "", "testing");
if (mysqli_connect_error()) {
    echo "Koneksi Gagal : " . mysqli_connect_error();
}
