<!-- Praktikum Bagian 3 : Form Input PHP Langkah 5 -->
<!DOCTYPE html>
<html>
<head>
    <title>Form Input PHP</title> <!-- Judul halaman web -->
</head>
<body>
    <h2>Form Input PHP</h2> <!-- Judul formulir -->
    <?php
    // Inisialisasi variabel
    $namaErr = ""; // Variabel untuk menyimpan pesan kesalahan nama
    $nama = ""; // Variabel untuk menyimpan nilai nama

    // Cek apakah formulir sudah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validasi nama (contoh: pastikan nama tidak kosong)
        if (empty($_POST["nama"])) {
            $namaErr = "Nama harus diisi!"; // Mengatur pesan kesalahan jika nama kosong
        } else {
            $nama = $_POST["nama"]; // Menyimpan nilai nama dari formulir
            echo "Data berhasil disimpan!"; // Menampilkan pesan jika data berhasil disimpan
        }
    }
    ?>
    <!-- Formulir untuk menginputkan nama -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
        <label for="nama">Nama: </label>
        <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>"> <!-- Input untuk nama dengan nilai default yang diambil dari variabel $nama -->
        <span class="error"><?php echo $namaErr; ?></span><br><br> <!-- Menampilkan pesan kesalahan nama (jika ada) -->
        <input type="submit" name="submit" value="Submit"> <!-- Tombol submit untuk mengirimkan formulir -->
    </form>
</body>
</html>