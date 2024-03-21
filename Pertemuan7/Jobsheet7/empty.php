<!-- Praktikum 2 Function Empty -->
<?php
$myArray = array(); // Mendefinisikan variabel $myArray sebagai array kosong.

// Memeriksa apakah $myArray kosong atau tidak.
if (empty($myArray)){
    echo "array tidak teridentifikasi atau kosong."; // Menampilkan pesan jika $myArray kosong.
} else {
    echo "Array teridentifikasi dan tidak kosong."; // Menampilkan pesan jika $myArray tidak kosong.
}

echo "<br>";

// Memeriksa apakah variabel $nonExistentVar kosong atau tidak.
if (empty($nonExistentVar)){
    echo "array tidak teridentifikasi atau kosong."; // Menampilkan pesan jika $nonExistentVar tidak teridentifikasi atau kosong.
} else {
    echo "Array teridentifikasi dan tidak kosong."; // Menampilkan pesan jika $nonExistentVar teridentifikasi dan tidak kosong.
}
?>