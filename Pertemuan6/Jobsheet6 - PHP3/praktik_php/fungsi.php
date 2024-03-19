<?php
// Fungsi dapat dibuat dngan kata kunci function, lalu diikuti dengan nama fungsinya.
function perkenalan($nama, $salam = "Assalamualikum")
{ //Parameter dengan nilai default 
    echo $salam . ", ";
    echo "Perkenalkan, nama saya " . $nama . "<br/>"; //Menuliskan sesuai nama

    // Memanggil fungsi di dalam fungsi 
    echo "Saya berusia ". hitungUmur(2004, 2024) . " tahun<br/>"; 
    echo "Senang berkenalan dengan Anda<br/>";
    // isi sesuai dengan tahun lahir kalian
}

// Fungsi mengembalikan nilai 
//membuat fungsi
function hitungUmur($thn_lahir, $thn_sekarang)
{
    $umur = $thn_sekarang - $thn_lahir;
    return $umur;
}

// Fungsi dengan parameter 
//Memanggil fungsi yang sudah dibuat
perkenalan("Hamdana", "Hallo");

echo "<hr>";

$saya = "Gelby";
$ucapanSalam = "Selamat pagi";

//memanggil lagi tanpa mengisi parameter salam
perkenalan($saya);
?>