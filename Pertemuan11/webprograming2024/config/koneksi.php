<!-- Praktikum 1. Struktur Folder dan File Paling Atas Langkah 7 koneksi.php -->
<?php
// Mengatur zona waktu default menjadi "Asia/Jakarta" untuk menyesuaikan dengan lokasi pengguna
date_default_timezone_set("Asia/Jakarta");

// Menghubungkan ke database MySQL dengan parameter (host, username, password, nama database)
$koneksi = mysqli_connect("localhost", "root", "", "prakwebdb");

// Memeriksa apakah koneksi ke database gagal
if(mysqli_connect_errno()){
    // Jika koneksi gagal, program akan dihentikan dan pesan kesalahan akan ditampilkan
    die("koneksi database gagal: " . mysqli_connect_error());
}
?>