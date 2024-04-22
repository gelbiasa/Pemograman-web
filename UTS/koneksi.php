<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Pertandingan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Konfigurasi koneksi database
$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda, jika ada
$dbname = "pesanpertandingan"; // Ganti dengan nama database Anda

// Buat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$nama_pemesan = $_POST['nama_pemesan'];
$pertandingan = $_POST['pertandingan'];
$kualitas_live = $_POST['kualitas_live'];
$harga = $_POST['harga'];
$pembayaran = $_POST['pembayaran'];

// Siapkan pernyataan SQL untuk menyimpan data ke database
$sql = "INSERT INTO Pesanan (nama_pemesan, pertandingan, kualitas_live, harga, pembayaran) 
        VALUES ('$nama_pemesan', '$pertandingan', '$kualitas_live', '$harga', '$pembayaran')";

// Jalankan pernyataan SQL dan periksa apakah berhasil

if ($koneksi->query($sql) === TRUE) {
    // Tampilkan pesan dan tombol kembali
    echo "<div class='pesanan'><h2>Pemesanan berhasil disimpan</h2>. <br>";
    echo "<a href='home.php' class='btn-back'>Kembali</a>";
    echo "</div>";
} else {
    echo "Error: " . $sql . "<br>" . $koneksi->error;
}

// Tutup koneksi database
$koneksi->close();
?>
</body>
</html>