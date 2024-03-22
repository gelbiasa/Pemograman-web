<!-- Praktikum Bagian 3 : Form Input PHP Langkah 3 -->
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){ // Memeriksa apakah permintaan HTTP adalah metode POST
    $nama = $_POST["nama"]; // Mengambil nilai input 'nama' dari formulir sebelumnya
    $email = $_POST["email"]; // Mengambil nilai input 'email' dari formulir sebelumnya

    // Menampilkan nilai nama dan email yang diterima dari formulir
    echo "Nama : ". $nama. "<br>"; // Menampilkan nama
    echo "Email : ". $email; // Menampilkan email
}
?>