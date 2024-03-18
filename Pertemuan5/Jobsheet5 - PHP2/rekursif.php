<?php
// Fungsi rekursif Langkah 1 (Soal no 6)
// Mencetak Halo dunia tanpa batas
/*
function tampilkanHaloDunia()
{
    echo "Halo dunia! <br>";

    tampilkanHaloDunia();
}
tampilkanHaloDunia();
*/

// Fungsi rekursif Langkah 3 (Soal No 6)
// Mencetak Perulangan dari 1 - 25 
/*
for ($i=1; $i <= 25; $i++){
    echo "Perulangan ke-{$i} <br>";
}
*/

// Fungsi rekursif Langkah 4 (Soal no 6)
// Mencetak Perulangan dari 1 - 25 menggunakan if
function tampilkanAngka(int $jumlah, int $indeks = 1)
{
    echo "Perulangan ke-{$indeks} <br>";

    //panggil diri sendiri selama $indeks <= $jumlah
    if ($indeks < $jumlah) {
        tampilkanAngka($jumlah, $indeks + 1);
    }
}
tampilkanAngka(20);
?>