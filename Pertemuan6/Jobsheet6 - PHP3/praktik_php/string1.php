<?php

// String 1 Langkah 1 
$loremIpsum = "Lorem ipsum dolor sit amet consectetur adipisicing elit.
Voluptatem reprehenderit nobis veritatis commodi fugiat molestias
impedit unde ipsum voluptatum, corrupti minus sit excepturi nostrum
quisquam? Quos impedit eum nulla optio.";

echo "<p>{$loremIpsum}</p>"; //Mencetak teks
echo "Panjang karakter: " . strlen($loremIpsum) . "<br>"; //mencatat jumlah karakter pada teks
echo "Panjang kata: " . str_word_count($loremIpsum) . "<br>"; //mencatat jumlah kata pada teks
echo "<p>" . strtoupper($loremIpsum) . "</p>"; //Mencetak teks dengan huruf besar
echo "<p>" . strtolower($loremIpsum) . "</p>"; //Mencetak teks dengan huruf kecil

?>