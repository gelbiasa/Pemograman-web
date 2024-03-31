<!-- Praktikum 7 Jobhseet 9 Langkah 3 -->
<html>
    <body>
        <!-- Menampilkan judul "Keranjang Belanja" -->
        <h2>Keranjang Belanja</h2>
        
        <?php
            // Mengambil nilai "beliNovel" dan "beliBuku" dari cookie
            $beliNovel = $_COOKIE['beliNovel'];
            $beliBuku = $_COOKIE['beliBuku'];
            
            // Menampilkan jumlah novel dan jumlah buku yang ada dalam keranjang belanja
            echo "Jumlah Novel: " . $beliNovel . "<br>";
            echo "Jumlah Buku: " . $beliBuku . "<br>";
        ?>
    </body>
</html>