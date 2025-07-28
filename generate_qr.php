<?php
include "phpqrcode/qrlib.php";

// Data yang ingin dimasukkan ke dalam QR
$data = 'https://domainmu.com/cek_permohonan.php?id=123';

// Simpan sebagai file PNG
$file = 'temp/qr_permohonan.png'; // pastikan folder temp/ bisa ditulis
QRcode::png($data, $file, QR_ECLEVEL_L, 5);

// Atau langsung tampilkan di browser
// header('Content-Type: image/png');
// QRcode::png($data);
