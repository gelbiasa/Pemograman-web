<!-- Praktikum 4 : HTML Injection -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input PHP</title> <!-- Judul halaman web -->
</head>
<body>
    <?php
    // Memeriksa apakah permintaan HTTP adalah metode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Mengambil nilai dari input nama dan email
        $nama = $_POST['nama'];
        $email = $_POST['email'];

        // Menghindari serangan XSS dengan mengkonversi karakter khusus menjadi entitas HTML
        $nama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        // Pengecekan alamat email yang valid menggunakan filter_var()
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Menampilkan nama dan email jika alamat email valid
            echo "Nama: " . $nama . "<br>";
            echo "Email: " . $email;
        } else {
            // Menampilkan pesan jika alamat email tidak valid
            echo "Alamat email tidak valid!";
        }
    }
    ?>
    <h2>Form Input PHP</h2> <!-- Judul formulir -->
    <!-- Formulir untuk memasukkan nama dan email -->
    <form method="post" action="">
        <label for="nama">Nama : </label>
        <input type="text" name="nama" id="nama" required> <br> <!-- Input untuk nama -->
        <label for="email">Email : </label>
        <input type="email" name="email" id="email" required><br> <!-- Input untuk email dengan tipe 'email' -->
        <input type="submit" name="submit" value="Submit"> <!-- Tombol submit untuk mengirimkan formulir -->
    </form>
</body>
</html>