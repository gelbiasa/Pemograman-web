<!-- Date Langkah 1 -->
<!DOCTYPE HTML>
<html>

<head>
</head>

<body>
    <h3> Date </h3>
    <?php
    // Menampilkan tanggal hari ini dalam format "YYYY/MM/DD"
    echo "Today is " . date("Y/m/d") . "<br>";

    // Menampilkan tanggal hari ini dalam format "YYYY.MM.DD"
    echo "Today is " . date("Y.m.d") . "<br>";

    // Menampilkan tanggal hari ini dalam format "YYYY-MM-DD"
    echo "Today is " . date("Y-m-d") . "<br>";

    // terdapat kesalahan pada format tanggal yang dimaksud untuk "l" pada baris ini
    echo "Today is " . date("1");
    ?>
</body>

</html>