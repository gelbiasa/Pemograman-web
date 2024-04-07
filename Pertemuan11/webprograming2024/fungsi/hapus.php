<?php
// Memulai sesi
session_start();

// Memeriksa apakah sesi username tidak kosong
if (!empty($_SESSION['username'])) {
    // Memasukkan file koneksi database
    require '../config/koneksi.php';
    // Memasukkan file fungsi pesan kilat untuk menampilkan pesan
    require '../fungsi/pesan_kilat.php';
    // Memasukkan file fungsi anti injection untuk mencegah SQL injection
    require '../fungsi/anti_injection.php';

    // Memeriksa apakah parameter id tidak kosong
    if (!empty($_GET['id'])) {
        // Mengambil id jabatan dan mencegah SQL injection
        $id = antiinjection($koneksi, $_GET['id']);

        // Query untuk menghapus data jabatan dari database
        $query = "DELETE FROM jabatan WHERE id = '$id'";

        // Menjalankan query
        if (mysqli_query($koneksi, $query)) {
            // Jika berhasil, tampilkan pesan sukses
            pesan('success', "Jabatan Telah Terhapus.");
        } else {
            // Jika gagal, tampilkan pesan error beserta pesan error dari MySQL
            pesan('danger', "Jabatan Tidak Terhapus Karena: " . mysqli_error($koneksi));
        }
        
        // Redirect kembali ke halaman jabatan
        header("Location: ../index.php?page=jabatan");
    } elseif (!empty($_GET['anggota'])) {
        // Jika parameter id kosong tetapi parameter anggota tidak kosong
        
        // Mengambil id user dan mencegah SQL injection
        $id = antiinjection($koneksi, $_GET['id']);
        
        // Query untuk menghapus data user dari database
        $query = "DELETE FROM user WHERE id = '$id'";
        
        // Menjalankan query
        if (mysqli_query($koneksi, $query)) {
            // Jika berhasil, lanjutkan dengan menghapus data anggota terkait
            $query2 = "DELETE FROM anggota WHERE user_id = '$id'";
            
            // Menjalankan query
            if (mysqli_query($koneksi, $query2)) {
                // Jika berhasil, tampilkan pesan sukses
                pesan('success', "Anggota Telah Terhapus.");
            } else {
                // Jika gagal, tampilkan pesan warning
                pesan('warning', "Data Login Terhapus Tetapi Data Anggota Tidak Terhapus Karena: " . mysqli_error($koneksi));
            }
        } else {
            // Jika gagal, tampilkan pesan error beserta pesan error dari MySQL
            pesan('danger', "Anggota Tidak Terhapus Karena: " . mysqli_error($koneksi));
        }
        
        // Redirect kembali ke halaman anggota
        header("Location: ../index.php?page=anggota");
    }
}
?>