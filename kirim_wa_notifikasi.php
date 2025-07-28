<?php

function kirim_wa($phone, $message)
{
    $token = "dDiIG1KzlOnLsTHiCj1GPAjNHUiLPPoRqN1UURFlf2BeGArQXzN16C3";
    $url = 'https://bdg.wablas.com/api/send-message';

    $data = [
        "phone" => $phone,
        "message" => $message,
        "secret" => false,
        "priority" => false,
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: $token",
        "Content-Type: application/json"
    ]);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Curl error: ' . curl_error($curl);
    }

    curl_close($curl);
    echo $response;
}

// Uji coba kirim WA
$no_hp = "6287777540612"; // ← Ganti dengan nomor WA kamu
$pesan = "";

kirim_wa($no_hp, $pesan);
