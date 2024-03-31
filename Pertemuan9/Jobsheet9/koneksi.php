<!-- Praktikum 2 Jobhseet 9 Langkah 1 -->
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
            echo "Koneksi dengan MySQL Gagal " . mysqli_connect_error(); // Pesan jika koneksi gagal
        }
    } 
    // Menangani exception jika terjadi kesalahan
    catch (Exception $e) {
        echo $e->getMessage(); // Menampilkan pesan kesalahan
    }
?>