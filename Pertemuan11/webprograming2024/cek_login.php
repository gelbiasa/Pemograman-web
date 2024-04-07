<!-- Praktikum 1. Struktur Folder dan File Paling Atas Langkah 5 cek_login.php -->
<?php
// Memulai atau melanjutkan sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE)
    session_start();

// Memuat file koneksi ke database dan fungsi pesan kilat
include 'config/koneksi.php';
include 'fungsi/pesan_kilat.php';

// Memuat fungsi anti_injection untuk mencegah serangan SQL injection
include 'fungsi/anti_injection.php';

// Mendapatkan nilai dari input username dan password, dan mencegah SQL injection
$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

// Membuat query untuk mendapatkan informasi pengguna dari database
$query = "SELECT username,level,salt, password as hashed_password FROM user WHERE username='$username'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
mysqli_close($koneksi);

// Mendapatkan salt dan hashed password dari hasil query
$salt = $row['salt'];
$hashed_password = $row['hashed_password'];

// Memeriksa apakah salt dan hashed password tidak null
if ($salt !== null && $hashed_password !== null) {
    // Menggabungkan salt dengan password yang dimasukkan pengguna
    $combined_password = $salt . $password;
    // Memeriksa apakah password yang dimasukkan sesuai dengan hashed password dalam database
    if (password_verify($combined_password, $hashed_password)) {
        // Jika password benar, menyimpan username dan level pengguna dalam sesi
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        // Mengarahkan pengguna ke halaman utama (index.php)
        header("location:index.php");
    } else {
        // Jika password salah, menampilkan pesan kesalahan dan mengarahkan kembali ke halaman login
        pesan('danger', "Login gagal. Password Anda Salah.");
        header("location:login.php");
    }
} else {
    // Jika username tidak ditemukan dalam database, menampilkan pesan kesalahan dan mengarahkan kembali ke halaman login
    pesan('warning', "Username tidak ditemukan.");
    header("location:login.php");
}

// Menghentikan eksekusi kode selanjutnya
die();
?>