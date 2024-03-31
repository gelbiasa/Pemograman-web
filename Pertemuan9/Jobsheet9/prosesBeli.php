<!-- Praktikum 7 Jobhseet 9 Langkah 2 -->
<?php
    // Memeriksa apakah kedua input "beliNovel" dan "beliBuku" ada dalam permintaan POST
    if(isset($_POST["beliNovel"]) && isset($_POST["beliBuku"])){
        // Menyimpan nilai "beliNovel" dan "beliBuku" ke dalam cookie sesuai dengan data yang dikirimkan melalui POST
        setcookie("beliNovel", $_POST["beliNovel"]);
        setcookie("beliBuku", $_POST["beliBuku"]);
        
        // Mengalihkan pengguna ke halaman "keranjangBelanja.php"
        header("location:keranjangBelanja.php");
    }
?>