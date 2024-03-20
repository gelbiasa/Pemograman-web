<!-- Variabel $_GET -->
<?php

$nama = @$_GET['nama']; //tanda @ agar tidak ada peringatan error ketika key-nya kosong
$usia = @$_GET['usia']; //tanda @ agar tidak ada peringatan error ketika key-nya kosong

echo "Halo {$nama}! Apakah benar anda berusia {$usia} tahun?"; // Menampilkan kalimat dengan nilai variabel $nama dan $usia
?>