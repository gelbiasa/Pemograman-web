<?php
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
?>