<?php
$ch = curl_init('http://127.0.0.1:8000/pegawai/export/pdf');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
$response = curl_exec($ch);
if ($response === false) {
    echo "CURL Error: " . curl_error($ch);
} else {
    echo $response;
}
curl_close($ch);
