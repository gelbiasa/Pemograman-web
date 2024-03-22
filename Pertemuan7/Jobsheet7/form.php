<!-- Praktikum Bagian 3 : Form Input PHP Langkah 2 -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Input PHP</title> <!-- Judul halaman web -->
</head>
<body>
    <h2>Form Input PHP</h2> <!-- Heading/Formulir judul -->
    <form method="post" action="proses_form.php"> <!-- Membuat formulir dengan metode POST yang akan di-submit ke file 'proses_form.php' -->
        <label for="nama">Nama:</label> <!-- Label untuk input nama -->
        <input type="text" name="nama" id="nama" required><br><br> <!-- Input untuk nama dengan atribut required -->
        <label for="email">Email:</label> <!-- Label untuk input email -->
        <input type="email" name="email" id="email" required><br><br> <!-- Input untuk email dengan atribut required dan tipe 'email' -->
        <input type="submit" name="submit" value="Submit"> <!-- Tombol submit -->
    </form>
</body>
</html>