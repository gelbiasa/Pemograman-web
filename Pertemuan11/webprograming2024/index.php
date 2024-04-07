<!-- Praktikum 1. Struktur Folder dan File Paling Atas Langkah 2 index.php -->
<?php
// Menginisialisasi sesi
if(session_status() === PHP_SESSION_NONE)
    session_start();

// Memeriksa apakah level pengguna sudah ada dalam sesi
if(!empty($_SESSION['level'])){
    // Memuat file koneksi ke database
    require 'config/koneksi.php';
    // Memuat fungsi untuk pesan kilat (flash messages)
    require 'fungsi/pesan_kilat.php';

    // Memuat bagian header dari template admin
    include 'admin/template/header.php';

    // Memuat halaman sesuai dengan parameter GET 'page'
    if(!empty($_GET['page'])){
        // Memuat halaman dari direktori module yang sesuai dengan parameter GET 'page'
        include 'admin/module/' . $_GET['page'] . '/index.php';
    } else {
        // Jika parameter GET 'page' tidak ada, memuat halaman utama (home)
        include 'admin/template/home.php';
    }

    // Memuat bagian footer dari template admin
    include 'admin/template/footer.php';
} else {
    // Jika level pengguna tidak tersedia dalam sesi, arahkan ke halaman login
    header("Location: login.php");
}
?>