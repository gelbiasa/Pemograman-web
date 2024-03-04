<?php
// Praktikum 4 (Penggunaan Struktur Kontrol pada PHP) Langkah 2 Soal no 4.1
$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90) {
    echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80) {
    echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf: D";
}

// Praktikum 4 (Penggunaan Struktur Kontrol pada PHP) Langkah 6 Soal no 4.2
$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget) {
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}
echo "<br><br>";
echo "Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer.";

// Praktikum 4 (Penggunaan Struktur Kontrol pada PHP) Langkah 10 Soal no 4.3
$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) {
    $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}
echo "<br><br>";
echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah";

// Praktikum 4 (Penggunaan Struktur Kontrol pada PHP) Langkah 14 Soal no 4.4
$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}
echo "<br><br>";
echo "Total skor ujian adalah: $totalSkor";
echo "<br><br>";

// Praktikum 4 (Penggunaan Struktur Kontrol pada PHP) Langkah 18 Soal no 4.5
$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak lulus) <br>";
        continue;
    }
    echo "Nilai: $nilai (Lulus) <br>";
}

// Soal Cerita 1
/*Ada soal cerita : Ada seorang guru ingin menghitung total nilai dari 10 siswa dalam 
ujian matematika. Guru ini ingin mengabaikan dua nilai tertinggi dan dua nilai terendah. 
Bantu guru ini menghitung total nilai yang akan digunakan untuk menentukan nilai rata-rata 
setelah mengabaikan nilai tertinggi dan terendah. Berikut daftar nilai dari 10 siswa 
(85, 92, 78, 64, 90, 75, 88, 79, 70, 96)*/
// Daftar nilai dari 10 siswa
$nilai_siswa = array(85, 92, 78, 64, 90, 75, 88, 79, 70, 96);

// Mengurutkan nilai dari yang terendah ke yang tertinggi
sort($nilai_siswa);

// Menghapus dua nilai terendah dan dua nilai tertinggi
array_shift($nilai_siswa);
array_shift($nilai_siswa);
array_pop($nilai_siswa);
array_pop($nilai_siswa);

// Menghitung total nilai
$total_nilai = array_sum($nilai_siswa);

// Menghitung jumlah siswa setelah mengabaikan dua nilai tertinggi dan dua nilai terendah
$jumlah_siswa = count($nilai_siswa);

// Menghitung rata-rata nilai
$rata_rata = $total_nilai / $jumlah_siswa;

// Menampilkan hasil
echo "<br>";
echo"================= Soal Cerita 1 =================";
echo "<br>";
echo "Total nilai setelah mengabaikan dua nilai tertinggi dan dua nilai terendah: $total_nilai <br>";
echo "Jumlah siswa setelah mengabaikan dua nilai tertinggi dan dua nilai terendah: $jumlah_siswa <br>";
echo "Rata-rata nilai setelah mengabaikan dua nilai tertinggi dan dua nilai terendah: $rata_rata";

//Soal Cerita 2
/*Ada soal cerita : Seorang pelanggan ingin membeli sebuah produk dengan harga Rp 120.000. Toko tersebut 
menawarkan diskon sebesar 20% untuk pembelian di atas Rp 100.000. Bantu pelanggan ini untuk menghitung 
harga yang harus dibayar setelah mendapatkan diskon.*/
// Harga produk
$harga_produk = 120000;
// Persentase diskon
$diskon_persen = 20;
// Batas pembelian untuk mendapatkan diskon
$batas_diskon = 100000;
// Inisialisasi variabel total harga yang harus dibayar
$total_harga = 0;
// Cek apakah harga produk melebihi batas untuk mendapatkan diskon
if ($harga_produk > $batas_diskon) {
    // Hitung diskon
    $diskon = $harga_produk * ($diskon_persen / 100);
    // Kurangi diskon dari harga produk
    $total_harga = $harga_produk - $diskon;
} else {
    // Jika harga produk tidak melebihi batas diskon, tidak ada diskon yang diberikan
    $total_harga = $harga_produk;
}

// Tampilkan harga yang harus dibayar setelah mendapatkan diskon
echo "<br><br>";
echo"================= Soal Cerita 2 =================";
echo "<br>";
echo "Harga yang harus dibayar setelah mendapatkan diskon: Rp " . number_format($total_harga, 0, ',', '.') . "<br>";

//Soal Cerita 3
/*Ada soal cerita : Seorang pemain game ingin menghitung total skor mereka dalam permainan. Mereka mendapatkan 
skor berdasarkan poin yang mereka kumpulkan. Jika mereka memiliki lebih dari 500 poin, maka mereka akan mendapatkan 
hadiah tambahan. Buat tampilan baris pertama “Total skor pemain adalah: (poin)”. Dan baris kedua “Apakah pemain 
mendapatkan hadiah tambahan? (YA/TIDAK)”*/
// Total skor pemain
echo "<br>";
echo"================= Soal Cerita 3 =================";
echo "<br>";
$skor_pemain = 750;

// Tampilkan total skor pemain
echo "Total skor pemain adalah: $skor_pemain <br>";

// Inisialisasi variabel untuk menentukan apakah pemain mendapatkan hadiah tambahan
$hadiah_tambahan = ($skor_pemain > 500) ? "YA" : "TIDAK";

// Tampilkan apakah pemain mendapatkan hadiah tambahan
echo "Apakah pemain mendapatkan hadiah tambahan? $hadiah_tambahan";
?>