<!DOCTYPE html> 
<html> 
<head> 
    <title>Monitoring Potensiometer</title>
    <meta http-equiv="refresh" content="2"> <!-- Refresh setiap 2 detik -->
    <style> 
        #wntable { 
            border-collapse: collapse; 
            width: 50%; 
        } 
        #wntable td, #wntable th { 
            border: 1px solid #ddd; 
            padding: 8px; 
        } 
        #wntable tr:nth-child(even){background-color: #f2f2f2;} 
        #wntable tr:hover {background-color: #ddd;} 
        #wntable th { 
            padding-top: 12px; 
            padding-bottom: 12px; 
            text-align: left; 
            background-color: #00A8A9; 
            color: white; 
        }
        .current-value {
            font-size: 24px;
            font-weight: bold;
            color: #ff0000;
            margin: 20px;
        }
    </style> 
</head> 
<body> 
    <div align="center"> 
        <h1>Data Sensor Potensio</h1>
        
        <?php
        require("koneksi.php");
        // Ambil data terbaru
        $sql = mysqli_query($koneksi, "SELECT data FROM datasensor ORDER BY id DESC LIMIT 1");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            echo '<div class="current-value">Nilai Saat Ini: '.$row['data'].'</div>';
        }
        ?>
        
        <table id="wntable"> 
            <tr> 
                <th>No</th> 
                <th>Data</th> 
                <th>Waktu</th> 
            </tr> 
            <?php 
            $sql = mysqli_query($koneksi, "SELECT * FROM datasensor ORDER BY id DESC LIMIT 10"); 
            
            if(mysqli_num_rows($sql) == 0){  
                echo '<tr><td colspan="3">Data Tidak Ada.</td></tr>';
            }else{ 
                $no = 1; 
                while($row = mysqli_fetch_assoc($sql)){ 
                    echo '<tr> 
                            <td>'.$no.'</td> 
                            <td>'.$row['data'].'</td> 
                            <td>'.$row['waktu'].'</td> 
                          </tr>'; 
                    $no++; 
                } 
            } 
            ?> 
        </table> 
    </div> 
</body> 
</html>