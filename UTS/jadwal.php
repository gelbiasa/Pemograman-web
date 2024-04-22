<?php
require_once ("session.php");
require_once ("cookies.php");

// Periksa apakah pengguna sudah login
if (!get_session("username") && !get_cookie("username")) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pertandingan</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Informasi Pertandingan</h2>
    <div class="match">
        <div class="team-logo">
            <img src="gambar/logoPSG.png" alt="Paris Saint Germain Logo">
        </div>
        <div class="match-details">
            <p>Paris Saint Germain VS Borusia Dortmund</p>
            <p>Stadium: Parc des Princes</p>
            <p>Tanggal: Kamis, 3 Mei 2024 Waktu: 02:00 WIB</p>
        </div>
        <div class="team-logo">
            <img src="gambar/logoDortmund.png" alt="Borusia Dortmund Logo">
        </div>
    </div>
    <div class="match">
        <div class="team-logo">
            <img src="gambar/logoMadrid.png" alt="Real Madrid Logo">
        </div>
        <div class="match-details">
            <p>Real Madrid VS Surabaya</p>
            <p>Stadium: Santiago Bernabéu</p>
            <p>Tanggal: Rabu, 2 Mei 2024 Waktu: 02:00 WIB</p>
        </div>
        <div class="team-logo">
            <img src="gambar/Sura.png" alt="Bayern Munchen Logo">
        </div>
    </div>
    <a href="home.php" class="btn-back">
        <span class="icon"></span> Kembali
    </a>

    <script src="script.js"></script>
</body>

</html>