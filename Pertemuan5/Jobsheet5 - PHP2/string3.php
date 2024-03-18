<?php

// Membalik String menggunakan perintah strrev() Langkah 5 (Soal 11)
$pesan = "saya arek malang";
// Membalik String menggunakan perintah strrev() Langkah 8 (Soal 12)
# ubah variabel $pesan menjadi array dengan perintah explode
$pesanPerKata = explode(" ", $pesan);
# ubah setiap kata dalam array menjadi kebalikannya
$pesanPerKata = array_map(fn($pesan) => strrev($pesan), $pesanPerKata);
# gabungkan kembali array menjadi string
$pesan = implode(" ", $pesanPerKata);

echo $pesan . "<br>";
?>