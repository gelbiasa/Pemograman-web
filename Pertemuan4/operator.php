<?php
// Praktikum 3 (Penggunaan Operator PHP) Langkah 2 dan 3 Soal 3.1
$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Hasil penjumlahan $a + $b adalah $hasilTambah <br>";
echo "Hasil pengurangan $a - $b adalah $hasilKurang <br>";
echo "Hasil perkalian $a * $b adalah $hasilKali <br>";
echo "Hasil pembagian $a / $b adalah $hasilBagi <br>";
echo "Sisa bagi $a % $b adalah $sisaBagi <br>";
echo "Hasil pangkat $a ^ $b adalah $pangkat <br>";

// Praktikum 3 (Penggunaan Operator PHP) Langkah 5 dan 6 Soal 3.2
$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "<br>";
echo "Hasil $a sama dengan $b: ";
echo $hasilSama ? 'true' : 'false';
echo "<br>";

echo "Hasil $a tidak sama dengan $b: ";
echo $hasilTidakSama ? 'true' : 'false';
echo "<br>";

echo "Hasil $a lebih kecil dari $b: ";
echo $hasilLebihKecil ? 'true' : 'false';
echo "<br>";

echo "Hasil $a lebih besar dari $b: ";
echo $hasilLebihBesar ? 'true' : 'false';
echo "<br>";

echo "Hasil $a lebih kecil dari atau sama dengan $b: ";
echo $hasilLebihKecilSama ? 'true' : 'false';
echo "<br>";

echo "Hasil $a lebih besar dari atau sama dengan $b: ";
echo $hasilLebihBesarSama ? 'true' : 'false';
echo "<br>";

// Praktikum 3 (Penggunaan Operator PHP) Langkah 8 dan 9 Soal 3.3
$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "<br>";
echo "Hasil $a AND $b: ";
echo $hasilAnd ? 'true' : 'false';
echo "<br>";

echo "Hasil $a OR $b: ";
echo $hasilOr ? 'true' : 'false';
echo "<br>";

echo "Hasil NOT $a: ";
echo $hasilNotA ? 'true' : 'false';
echo "<br>";

echo "Hasil NOT $b: ";
echo $hasilNotB ? 'true' : 'false';
echo "<br>";

// Praktikum 3 (Penggunaan Operator PHP) Langkah 11 dan 12 Soal 3.4
echo "<br>";
echo "Nilai awal a: $a <br>";
$a += $b;
echo "Setelah ditambah b, nilai a: $a <br>";
$a -= $b;
echo "Setelah dikurangi b, nilai a: $a <br>";
$a *= $b;
echo "Setelah dikali b, nilai a: $a <br>";
$a /= $b;
echo "Setelah dibagi b, nilai a: $a <br>";
$a %= $b;
echo "Setelah sisa bagi dengan b, nilai a: $a <br>";

// Praktikum 3 (Penggunaan Operator PHP) Langkah 14 dan 15 Soal 3.5
$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "<br>";
echo "Hasil A identik dengan B: ";
echo $hasilIdentik ? 'true' : 'false';
echo "<br>";

echo "Hasil A tidak identik dengan B: ";
echo $hasilTidakIdentik ? 'true' : 'false';
echo "<br>";

// Praktikum 3 (Penggunaan Operator PHP) Langkah 17 Soal 3.6
/*Ada soal cerita : Sebuah restoran memiliki 45 kursi di dalamnya. Pada suatu malam, 
28 kursi telah ditempati oleh pelanggan. Berapa persen kursi yang masih kosong di 
restoran tersebut?*/
echo "<br>";
echo "================ STUDI KASUS ================";
echo "<br>";
// Jumlah total kursi di restoran
$total_kursi = 45;

// Jumlah kursi yang telah ditempati oleh pelanggan
$kursi_terisi = 28;

// Menghitung jumlah kursi yang masih kosong
$kursi_kosong = $total_kursi - $kursi_terisi;

// Menghitung persentase kursi yang masih kosong
$persentase_kosong = ($kursi_kosong / $total_kursi) * 100;

// Menampilkan hasil
echo "Jumlah kursi yang masih kosong: $kursi_kosong <br>";
echo "Persentase kursi yang masih kosong: " . number_format($persentase_kosong, 2) . "%";
?>