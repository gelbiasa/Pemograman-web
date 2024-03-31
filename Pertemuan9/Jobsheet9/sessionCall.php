<!-- Praktikum 8 Jobhseet 9 Langkah 2 -->
<?php
    // Memulai sesi atau mengaktifkan sesi yang ada
    session_start();
?>

<html>
    <body>
        <?php
            // Menampilkan nilai dari variabel sesi favcolor dan favanimal
            echo "Favorite color: ".$_SESSION["favcolor"]."<br>";
            echo "Favorite animal: ".$_SESSION["favanimal"]."<br>";
        ?> 
    </body>
</html>