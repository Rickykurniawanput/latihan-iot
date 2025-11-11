<?php 
require("koneksi.php");

// Cek apakah parameter data dikirim lewat URL
if (!isset($_GET["data"])) {
    die("Parameter 'data' belum dikirim. Gunakan format: write-data.php?data=nilai");
}

$data = $_GET["data"];

// Tampilkan dulu untuk memastikan data diterima
echo "Menerima data: $data <br>";

// Query simpan ke tabel datasensor
$query = "INSERT INTO datasensor (`data`) VALUES ('$data')";
$result = mysqli_query($koneksi, $query);

// Cek hasil query
if (!$result) { 
    die('Query gagal: ' . mysqli_error($koneksi)); 
}   

echo "✅ Data berhasil disimpan ke database!";
?>
