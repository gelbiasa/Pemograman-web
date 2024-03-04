<?php
/*Praktikum 2 (Penggunaan Tipe Data) Langkah 2*/
$a = 10;
$b = 5;
$c = $a + 5;
$d = $b + (10 * 5);
$e = $d - $c;

echo "Variabel a: {$a} <br>";
echo "Variabel b: {$b} <br>";
echo "Variabel c: {$c} <br>";
echo "Variabel d: {$d} <br>";
echo "Variabel e: {$e} <br>";

var_dump($e);

/*Praktikum 2 (Penggunaan Tipe Data) Langkah 5*/
$nilaiMatematika = 5.1;
$nilaiIPA = 6.7;
$nilaiBahasaIndonesia = 9.3;

$rataRata = ($nilaiMatematika + $nilaiIPA + $nilaiBahasaIndonesia) / 3;

echo "Matematika: {$nilaiMatematika} <br>";
echo "IPA: {$nilaiIPA} <br>";
echo "Bahasa Indonesia: {$nilaiBahasaIndonesia} <br>";
echo "Rata-rata: {$rataRata} <br>";

var_dump($rataRata);

/*Praktikum 2 (Penggunaan Tipe Data) Langkah 8*/
$apakahSiswaLulus = true;
$apakahSiswaSudahUjian = false;

var_dump($apakahSiswaLulus);
echo "<br>";
var_dump($apakahSiswaSudahUjian);

/*Praktikum 2 (Penggunaan Tipe Data) Langkah 11*/
$namaDepan = "Ibnu";
$namaBelakang = "Jakaria";

$namaLengkap = "{$namaDepan} {$namaBelakang}";

echo "Nama Depan: {$namaDepan} <br>";
echo "Nama Belakang: {$namaBelakang} <br>";

echo $namaLengkap;

/*Praktikum 2 (Penggunaan Tipe Data) Langkah 14*/
$listMahasiswa = ["Wahid Abdullah", "Elmo Bachitiar", "Lendis Fabri"];
echo $listMahasiswa[0];
?>