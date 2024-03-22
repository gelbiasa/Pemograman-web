<!-- Praktikum 5 : Penggunaan Regex Pada PHP -->
<?php
// Langkah 2: Mencocokkan apakah terdapat huruf kecil dalam teks
$pattern = '/[a-z]/'; // Pola regex untuk mencocokkan huruf kecil
$text = 'This is a sample text.';
if(preg_match($pattern,$text)){
    echo "huruf kecil ditemukan !"; // Jika ada huruf kecil, maka pesan ini ditampilkan
}else{
    echo "tidak ada huruf kecil !"; // Jika tidak ada huruf kecil, maka pesan ini ditampilkan
}
echo"<hr>";

//Langkah 6: Mencocokkan apakah terdapat angka dalam teks
$pattern = '/[0-9]+/'; // Pola regex untuk mencocokkan angka
$text = 'There are 123 apples.';
if(preg_match($pattern,$text,$matches)){
    echo "cocokan : ".$matches[0]; // Jika ada angka, maka angka tersebut ditampilkan
}else{
    echo "Tidak ada yang cocok!"; // Jika tidak ada angka, pesan ini ditampilkan
}
echo"<hr>";

//Langkah 10: Mengganti kata "apple" dengan "banana" dalam teks
$pattern = '/apple/'; // Pola regex untuk mencocokkan kata "apple"
$replacement = 'banana'; // Kata pengganti
$text = 'i like apple pie.';
$new_text = preg_replace($pattern,$replacement,$text); // Mengganti "apple" dengan "banana" dalam teks
echo $new_text; // Menampilkan teks yang sudah diganti
echo"<hr>";

//Langkah 14: Mencocokkan kata "god" atau "good" dalam teks
$pattern = '/go*d/'; // Pola regex untuk mencocokkan "god", "good", "gooood", dst.
$text = 'god is good';
if(preg_match($pattern,$text,$matches)){
    echo "cocokan : ".$matches[0]; // Jika ada yang cocok, maka kata tersebut ditampilkan
}else{
    echo "tidak ada yang cocok!"; // Jika tidak ada yang cocok, pesan ini ditampilkan
}
echo"<hr>";
?>