<?php
// Fungsi Langkah (Soal 1)
function perkenalan($nama, $salam = "Assalamualikum")
{ //Parameter dengan nilai default Langkah 7 (Soal 3)
    echo $salam . ", ";
    echo "Perkenalkan, nama saya " . $nama . "<br/>"; //Menuliskan sesuai nama

    // Memanggil fungsi di dalam fungsi Langkah 13 (Soal 5)
    echo "Saya berusia ". hitungUmur(2004, 2024) . " tahun<br/>"; 
    echo "Senang berkenalan dengan Anda<br/>";
    // isi sesuai dengan tahun lahir kalian
}

// Fungsi mengembalikan nilai Langkah 10 (Soal 4)
//membuat fungsi
function hitungUmur($thn_lahir, $thn_sekarang)
{
    $umur = $thn_sekarang - $thn_lahir;
    return $umur;
}

// Fungsi dengan parameter Langkah 3 (Soal 2)
//Memanggil fungsi yang sudah dibuat
perkenalan("Hamdana", "Hallo");

echo "<hr>";

$saya = "Gelby";
$ucapanSalam = "Selamat pagi";

//memanggil lagi tanpa mengisi parameter salam
perkenalan($saya);
?>