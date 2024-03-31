<!-- Praktikum 8 Jobhseet 9 Langkah 1 -->
<?php
    // Memulai sesi atau mengaktifkan sesi yang ada
    session_start();
?>

<html>
    <body>
        <?php
            // Mengatur nilai variabel sesi favcolor dan favanimal
            $_SESSION["favcolor"] = "green";
            $_SESSION["favanimal"] = "set";
            
            // Menampilkan pesan bahwa variabel sesi telah diatur
            echo "Session variables are set.";
        ?> 
    </body>
</html>