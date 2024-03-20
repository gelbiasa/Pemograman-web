<!-- Variabel $_SERVER -->
<?php
// Menampilkan alamat file PHP yang sedang dieksekusi oleh server
echo $_SERVER['PHP_SELF'];
echo "<br>";

// Menampilkan nama server
echo $_SERVER['SERVER_NAME'];
echo "<br>";

// Menampilkan nama host dari permintaan HTTP saat ini
echo $_SERVER['HTTP_HOST'];
echo "<br>";

// Menampilkan URL referer, yaitu URL dari halaman yang mengarahkan pengguna ke halaman saat ini
echo $_SERVER['HTTP_REFERER'];
echo "<br>";

// Menampilkan informasi tentang agen pengguna (browser) yang digunakan untuk membuat permintaan HTTP saat ini
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";

// Menampilkan nama skrip yang sedang dieksekusi
echo $_SERVER['SCRIPT_NAME'];
?>