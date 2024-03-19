<!DOCTYPE html>
<!-- Praktikum Bagian 2. Associative Array Langkah 1 -->
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body>
    <?php
    // Mendefinisikan array asosiatif $Dosen dengan detail nama, domisili, dan jenis kelamin
    $Dosen = [
        'nama' => 'Elok Nur Hamdana',
        'domisili' => 'Malang',
        'jenis_kelamin' => 'Perempuan'
    ];

    // Menampilkan nama dosen
    echo "Nama : {$Dosen['nama']} <br>";
    
    // Menampilkan domisili dosen
    echo "Domisili : {$Dosen['domisili']} <br>";
    
    // Menampilkan jenis kelamin dosen
    echo "Jenis Kelamin : {$Dosen['jenis_kelamin']} <br>";

    ?>

</body>

</html>