<!-- Time Langkah 4 -->
<!DOCTYPE HTML>
<html>

<head>
</head>

<body>
    <h3> Time </h3>
    <?php
    // Mengatur zona waktu menjadi "Asia/Jakarta"
    date_default_timezone_set("Asia/Jakarta");
    
    // Menampilkan waktu saat ini dalam format jam:menit:detik AM/PM
    echo date("h:i:sa");
    ?>
</body>

</html>