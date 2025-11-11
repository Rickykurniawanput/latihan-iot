<?php
require("koneksi.php");

echo "<h2>Test Connection & Last Data</h2>";

// Test koneksi database
if ($koneksi) {
    echo "✅ Database connected successfully<br>";
} else {
    echo "❌ Database connection failed<br>";
}

// Get last 5 records
$sql = mysqli_query($koneksi, "SELECT * FROM datasensor ORDER BY id DESC LIMIT 5");
echo "<h3>Last 5 Records:</h3>";
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>ID</th><th>Data</th><th>Waktu</th></tr>";

if(mysqli_num_rows($sql) == 0) {
    echo "<tr><td colspan='3'>No data found</td></tr>";
} else {
    while($row = mysqli_fetch_assoc($sql)) {
        echo "<tr>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['data']."</td>";
        echo "<td>".$row['waktu']."</td>";
        echo "</tr>";
    }
}
echo "</table>";

// Count total records
$count_sql = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM datasensor");
$count = mysqli_fetch_assoc($count_sql);
echo "<p>Total records in database: ".$count['total']."</p>";

// Check for 1024 values
$fixed_sql = mysqli_query($koneksi, "SELECT COUNT(*) as fixed FROM datasensor WHERE data = '1024'");
$fixed = mysqli_fetch_assoc($fixed_sql);
echo "<p>Records with value 1024: ".$fixed['fixed']."</p>";
?>