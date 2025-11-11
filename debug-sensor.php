<?php
require("koneksi.php");

// Ambil 5 data terbaru
$sql = mysqli_query($koneksi, "SELECT * FROM datasensor ORDER BY id DESC LIMIT 5");

echo "<h2>Debug Sensor Data</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Data</th><th>Waktu</th><th>Status</th></tr>";

while($row = mysqli_fetch_assoc($sql)) {
    $status = ($row['data'] == 1024) ? "⚠️ FIXED 1024" : "✅ NORMAL";
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['data']."</td>";
    echo "<td>".$row['waktu']."</td>";
    echo "<td>".$status."</td>";
    echo "</tr>";
}
echo "</table>";

// Cek jika semua data 1024
$check = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM datasensor WHERE data = 1024");
$result = mysqli_fetch_assoc($check);
echo "<p>Data dengan nilai 1024: ".$result['total']." records</p>";
?>