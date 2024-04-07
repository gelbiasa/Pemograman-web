<!-- Praktikum 4. Folder Module – Bagian Jabatan Langkah 6 hapus.php -->
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
    }
}
?>