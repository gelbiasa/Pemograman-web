<?php
// Pastikan session dimulai
require_once("session.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika tidak, arahkan ke halaman login atau halaman lainnya
    header("Location: index.html");
    exit(); // Pastikan untuk keluar setelah melakukan pengalihan header
}

// Set nama pengguna
$nama_pemesan = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Pertandingan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="pesan-container">
        <h2>Pesan Pertandingan</h2>
        <form id="pesanForm" action="koneksi.php" method="POST">
            <div class="input-group">
                <label for="nama_pemesan">Nama Pemesan:</label>
                <input type="text" id="nama_pemesan" name="nama_pemesan" value="<?php echo $nama_pemesan; ?>" readonly>
            </div>
            <div class="input-group">
                <label for="pertandingan">Pilih Pertandingan:</label>
                <select id="pertandingan" name="pertandingan">
                    <option value="Paris Saint Germain VS Borusia Dortmund">Paris Saint Germain VS Borusia Dortmund</option>
                    <option value="Real Madrid VS Bayern Munchen">Real Madrid VS Persebaya </option>
                </select>
            </div>
            <div class="input-group">
                <label for="kualitas_live">Kualitas Live:</label>
                <select id="kualitas_live" name="kualitas_live">
                    <option value="HD">HD</option>
                    <option value="2K">2K</option>
                </select>
            </div>
            <div class="input-group">
                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" readonly>
            </div>
            <div class="input-group">
                <label for="pembayaran">Metode Pembayaran:</label>
                <select id="pembayaran" name="pembayaran">
                    <option value="Bank BRI">Bank BRI</option>
                    <option value="Bank BCA">Bank BCA</option>
                    <option value="QRIS">QRIS</option>
                </select>
            </div>
            <div class="input-group">
                <button type="submit">Simpan</button>
            </div>
        </form>
        <a href="home.php" class="btn-back">Kembali</a>
    </div>
    <script src="jquery-3.7.1.js"></script>
    <script src="script.js"></script>
</body>
</html>