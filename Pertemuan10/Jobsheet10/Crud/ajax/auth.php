<!-- Praktikum 6. Tampilan CRUD dengan Ajax Langkah 5 -->
<?php
// Mulai sesi untuk penggunaan session
session_start();

// Membuat token keamanan untuk ajax request (Csrf Token)
// Jika csrf_token belum ada dalam sesi, maka buat token baru
if(empty($_SESSION['csrf_token'])){
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Menghasilkan token acak dengan panjang 32 byte dan mengubahnya menjadi string heksadesimal
}
?>