<!-- Jobsheet 10 Praktikum 1. CRUD Bagian Read Langkah 3 -->
<?php
// Menghubungkan ke database MySQL dengan mysqli_connect
$koneksi = mysqli_connect("localhost","root","","prakwebdb");

// Memeriksa apakah koneksi berhasil
if (mysqli_connect_errno()){
    // Menampilkan pesan kesalahan jika koneksi gagal
    die("Koneksi Database gagal : " . mysqli_connect_error());
}
?>