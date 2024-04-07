<!-- Praktikum 4. Folder Module – Bagian Jabatan Langkah 3 tambah.php -->
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

    // Memeriksa apakah parameter jabatan tidak kosong
    if (!empty($_GET['jabatan'])) {
        // Mengambil data jabatan dan keterangan dari form tambah jabatan, dan mencegah SQL injection
        $jabatan = antiinjection($koneksi, $_POST['jabatan']);
        $keterangan = antiinjection($koneksi, $_POST['keterangan']);

        // Query untuk menambahkan data jabatan ke database
        $query = "INSERT INTO jabatan (jabatan, keterangan) VALUES ('$jabatan', '$keterangan')";
        
        // Menjalankan query
        if (mysqli_query($koneksi, $query)) {
            // Jika berhasil, tampilkan pesan sukses
            pesan('success', "Jabatan Baru ditambahkan.");
        } else {
            // Jika gagal, tampilkan pesan error beserta pesan error dari MySQL
            pesan('danger', "Gagal Menambahkan Jabatan Karena: " . mysqli_error($koneksi));
        }
        
        // Redirect kembali ke halaman jabatan
        header("Location: ../index.php?page=jabatan");
    }
}
?>