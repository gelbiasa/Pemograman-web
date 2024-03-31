<!-- Praktikum 1 Jobsheet9 Soal 2 --> 
<?php
    // Informasi untuk koneksi database
    $namaHost = "localhost"; // Nama host database (biasanya localhost)
    $username = "root"; // Username untuk mengakses database
    $password = ""; // Password untuk mengakses database
    $database = "prakwebdb"; // Nama database yang akan digunakan

    try {
        // Melakukan koneksi ke database
        $connect = mysqli_connect($namaHost, $username, $password, $database);
        
        // Memeriksa apakah koneksi berhasil atau gagal
        if ($connect) {
            echo "Koneksi dengan MySQL Berhasil <br>"; // Pesan jika koneksi berhasil
        } else {
            echo "Koneksi dengan MySQL Gagal. <br>" . mysqli_connect_error(); // Pesan jika koneksi gagal
        }

        // Query untuk membuat tabel 'user' jika belum ada
        $sql = "CREATE TABLE user(
            id INT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            password VARCHAR(50) NOT NULL)";
        
        // Mengeksekusi query
        if (mysqli_query($connect, $sql)) {
            echo "Table Berhasil Ditambahkan"; // Pesan jika tabel berhasil ditambahkan
        } else {
            throw new Exception("Record Gagal Ditambahkan: " . mysqli_error($connect)); // Pesan jika terjadi kesalahan saat menambahkan tabel
        }
        
        // Menutup koneksi ke database
        mysqli_close($connect);
    }
    // Menangani exception jika terjadi kesalahan
    catch (Exception $e) {
        echo $e->getMessage(); // Menampilkan pesan kesalahan
    }
?>
