<!-- Menggabungkan HTML dan PHP Langkah 1 -->
<!-- Cara pertama adalah PHP di dalam HTML -->
<html>

<head>
    <title>Cara 01</title>
</head>

<body>
    <p>Tanggal Hari ini : <?php echo date("d M Y") ?> <!-- Menampilkan tanggal hari ini menggunakan fungsi date() dalam PHP -->
    </p>
</body>

</html>

<hr>

<!-- Menggabungkan HTML dan PHP Langkah 3 -->
<!-- Cara kedua adalah HTML di dalam PHP -->
<?php
echo '<html>'; // Memulai bagian HTML
echo '<head><title>Cara02</title></head>'; // Menambahkan tag judul HTML
echo '<body>'; // Memulai bagian body HTML
echo '<p>Tanggal Hari ini : ' . date('d M Y') . '</p>'; // Menampilkan tanggal hari ini dalam HTML menggunakan fungsi date() dalam PHP
echo '</body>'; // Menutup bagian body HTML
echo '</html>'; // Menutup tag HTML
?>