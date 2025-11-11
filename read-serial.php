<?php
require("koneksi.php");

// Fungsi untuk membaca data dari serial port
function readSerialData($port = "COM9", $baud = 9600) {
    // Untuk Windows
    $command = "mode $port BAUD=$baud PARITY=N data=8 stop=1 xon=off";
    shell_exec($command);
    
    // Buka serial port
    $fp = fopen($port, 'r');
    if (!$fp) {
        return false;
    }
    
    // Baca data
    $data = fread($fp, 1024);
    fclose($fp);
    
    return trim($data);
}

// Coba baca data dari Arduino
$sensorData = readSerialData("COM3", 9600); // Ganti COM3 dengan port Arduino Anda

if ($sensorData !== false && is_numeric($sensorData)) {
    // Simpan ke database
    $query = "INSERT INTO datasensor (data) VALUES ('$sensorData')";
    $result = mysqli_query($koneksi, $query);
    
    if ($result) {
        echo "Data berhasil disimpan: $sensorData";
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    echo "Tidak ada data dari Arduino atau data tidak valid: " . $sensorData;
}
?>