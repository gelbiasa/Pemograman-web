<!-- Praktikum 1. Function Isset -->
<?php
$umur; // Mendefinisikan variabel umur tanpa memberikan nilai

if (isset ($umur) && $umur >= 18) { // Memeriksa apakah variabel umur sudah didefinisikan dan nilainya lebih besar atau sama dengan 18
    echo "Anda sudah dewasa"; // Jika memenuhi syarat, cetak pesan bahwa pengguna sudah dewasa
} else {
    echo "Anda belum dewasa atau variabel 'umur' tidak ditemukan <br>"; // Jika tidak memenuhi syarat, cetak pesan bahwa pengguna belum dewasa atau variabel umur tidak ditemukan
}

$data = array("nama" => "Jane", "usia" => 25); // Mendefinisikan array data dengan kunci 'nama' dan 'usia'
if (isset ($data["nama"])) { // Memeriksa apakah kunci 'nama' ada dalam array data
    echo "nama : " . $data["nama"]; // Jika kunci 'nama' ada, cetak nilai yang terkait dengan kunci tersebut
} else {
    echo "variabel data tidak ditemukan dalam array."; // Jika kunci 'nama' tidak ada, cetak pesan bahwa variabel data tidak ditemukan dalam array
}
?>