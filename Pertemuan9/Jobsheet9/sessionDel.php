<!-- Praktikum 9 Jobhseet 9 Langkah 1 -->
<?php
    // Memulai sesi atau mengaktifkan sesi yang ada
    session_start();
?>
<html>
    <body>
        <?php
            // Menghapus semua variabel sesi yang diset sebelumnya
            session_unset();
            
            // Menghancurkan sesi
            session_destroy();
            
            // Menampilkan pesan bahwa semua variabel sesi telah dihapus dan sesi telah dihancurkan
            echo "All session variables are now removed, and the session is destroyed.";
        ?> 
    </body>
</html>
