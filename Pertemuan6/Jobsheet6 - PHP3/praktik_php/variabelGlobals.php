<!-- Variabel $GLOBALS adalah array asosiatif yang menyimpan semua variabel global yang didefinisikan saat 
program dijalankan. Variabel $GLOBALS merupakan variabel super global PHP yang digunakan untuk 
mengakses variabel global dari mana saja dalam scrip PHP (juga dari dalam fungsi atau metode). -->
<?php
$x = 75; // Mendefinisikan variabel $x dengan nilai 75
$y = 25; // Mendefinisikan variabel $y dengan nilai 25

// Definisi fungsi addition
function addition() {
    $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y']; // Menambahkan nilai variabel global $x dan $y dan menyimpannya dalam variabel global $z
}

addition(); // Memanggil fungsi addition untuk menjalankan penambahan

echo $z; // Mencetak nilai dari variabel global $z
?>