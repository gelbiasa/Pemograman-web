<?php
// Praktikum 5 (Penggunaan Array Pada PHP) Langkah 2 Soal 5.1
$nilaiSiswa = [85, 92, 78, 64, 90, 55, 88, 79, 70, 96];

$nilaiLulus = [];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai >= 70) {
        $nilaiLulus[] = $nilai;
    }
}
echo "Daftar nilai siswa yang lulus: " . implode(', ', $nilaiLulus);

// Praktikum 5 (Penggunaan Array Pada PHP) Langkah 6 Soal 5.2
$daftarKaryawan = [
    ['Alice', 7],
    ['Bob', 3],
    ['Charlie', 9],
    ['David', 5],
    ['Eva', 6],
];
$karyawanPengalamanLimaTahun = [];

foreach ($daftarKaryawan as $karyawan) {
    if ($karyawan[1] > 5) {
        $karyawanPengalamanLimaTahun[] = $karyawan[0];
    }
}
echo "<br><br>";
echo "Daftar karyawan dengan pengalaman kerja lebih dari 5 tahun: " . implode(
    ', ',
    $karyawanPengalamanLimaTahun
);

// Praktikum 5 (Penggunaan Array Pada PHP) Langkah 10 Soal 5.3
$daftarNilai = [
    'Matematika' => [
        ['Alice', 85],
        ['Bob', 92],
        ['Charlie', 78],
    ],
    'Fisika' => [
        ['Alice', 90],
        ['Bob', 88],
        ['Charlie', 75],
    ],
    'Kimia' => [
        ['Alice', 92],
        ['Bob', 80],
        ['Charlie', 85],

    ],
];

$mataKuliah = 'Fisika';

echo "<br><br>";
echo "Daftar nilai mahasiswa dalam mata kuliah $mataKuliah: <br>";

foreach ($daftarNilai[$mataKuliah] as $nilai) {
    echo "Nama: {$nilai[0]}, Nilai: {$nilai[1]} <br>";
}

// Soal Cerita
/*Ada soal cerita : Seorang guru ingin mencetak daftar nilai siswa dalam ujian 
matematika. Guru tersebut memiliki data setiap siswa terdrir dari nama dan nilai. 
Bantu guru ini mencetak daftar nilai siswa yang mencapai nilai di atas rata-rata 
kelas. Dengan ketentuan nama dan nilai siswa Alice dapat 85, Bob dapat 92, Charlie 
dapat 78, David dapat 64, Eva dapat 90*/
echo "<br>";
echo "========================= Studi Kasus =========================";
// Data nilai siswa dalam array dua dimensi
$dataNilai = [
    ['Alice', 85],
    ['Bob', 92],
    ['Charlie', 78],
    ['David', 64],
    ['Eva', 90]
];

// Menghitung rata-rata nilai
$totalNilai = 0;
foreach ($dataNilai as $nilai) {
    $totalNilai += $nilai[1]; // Menambahkan nilai setiap siswa
}
$rataNilai = $totalNilai / count($dataNilai);

// Mencetak daftar siswa dengan nilai di atas rata-rata
echo "<br>";
echo "Daftar nilai siswa di atas rata-rata kelas ($rataNilai):<br>";
foreach ($dataNilai as $siswa) {
    if ($siswa[1] > $rataNilai) {
        echo "Nama: {$siswa[0]}, Nilai: {$siswa[1]}<br>";
    }
}
?>