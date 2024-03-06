<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa Array Multidimensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .student-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            border: 1px solid blue; 
            padding: 10px; 
            max-width: 300px;
        }
        .student-avatar {
            width: 100px;
            height: 130px; 
            object-fit: cover; 
            margin-right: 20px;
        }
        .student-details {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
        }
        .student-details p {
            margin: 0;
        }
        .symbol {
            font-size: 10px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Data Mahasiswa Array Multidimensi</h2>

    <?php
    // Array multidimensi untuk data mahasiswa
    $mahasiswa = array(
        array (
        "Nama" => "Billie Eilis", 
        "NIM" => "222222", 
        "Jurusan" => 
        "Teknik Informatika", 
        "Email" => "billieeilis@gmail.com", 
        "Avatar" => "img/avatar1.jpg"
        ),
        array (
        "Nama" => "Bruno Mars", 
        "NIM" => "444444", 
        "Jurusan" => "Teknik Informatika", 
        "Email" => "brunomars@gmail.com", 
        "Avatar" => "img/avatar2.jpg"
        ),
        array (
        "Nama" => "Madison Beer", 
        "NIM" => "666666", 
        "Jurusan" => "Teknik Kimia", 
        "Email" => "madisonbeer@gmail.com", 
        "Avatar" => "img/avatar3.jpg"
        ),
        array (
        "Nama" => "Hector Bellerin", 
        "NIM" => "888888", 
        "Jurusan" => "Teknik Listrik", 
        "Email" => "hectorbellerin@gmail.com", 
        "Avatar" => "img/avatar4.jpg"
        ),
        array (
        "Nama" => "Emilia Clarke", 
        "NIM" => "101010", 
        "Jurusan" => "Teknik Sipil", 
        "Email" => "emiliaclarke@gmail.com", 
        "Avatar" => "img/avatar5.jpg"
        )
    );

    // Loop melalui array untuk menampilkan data mahasiswa
    foreach ($mahasiswa as $data) {
        echo '<div class="student-container">';
        echo '<img src="' . $data["Avatar"] . '" alt="Avatar" class="student-avatar">';
        echo '<div class="student-details">';
        echo '<p><span class="symbol">◉</span> Nama: ' . $data["Nama"] . '</p>';
        echo '<p><span class="symbol">◉</span> NIM: ' . $data["NIM"] . '</p>';
        echo '<p><span class="symbol">◉</span> Jurusan: ' . $data["Jurusan"] . '</p>';
        echo '<p><span class="symbol">◉</span> Email: ' . $data["Email"] . '</p>';
        echo '</div>';
        echo '</div>';
    }
    ?>

</body>
</html>