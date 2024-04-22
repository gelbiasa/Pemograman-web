<?php
require_once("session.php");
require_once("cookies.php");

// Periksa apakah pengguna sudah login
if (!get_session("username") && !get_cookie("username")) {
    header("Location: index.html");
    exit();
}

// Jika pengguna sudah login, tetapi ingin logout
if (isset($_GET['logout'])) {
    unset_session("username");
    unset_cookie("username");
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="home-container">
        <div class="section">
            <h2>Welcome, <?php echo $_SESSION["username"]; ?></h2>
            <form action="home.php" method="GET" class="logout-form">
                <button type="submit" name="logout">Logout</button>
            </form>
        <div class="section">
            <div class="menu">
                <a href="jadwal.php">Informasi Pertandingan</a>
            </div>
            <div class="menu">
                <a href="pesan_pertandingan.php">Pesan Pertandingan</a>
            </div>
            <div class="menu">
                <a href="riwayat_pesanan.php">Riwayat Pesanan</a>
            </div>
        </div>
    </div>
    <form action="home.php" method="GET" class="logout-form">
        <button type="submit" name="logout">Logout</button>
    </form>
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
</body>
</html>