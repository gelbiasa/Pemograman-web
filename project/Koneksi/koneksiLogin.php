<?php
include 'koneksi.php';

// Mendapatkan data yang dikirimkan dari JavaScript
$username = $_POST['username'];
$password = $_POST['password'];
$user_status = $_POST['user_status']; // Ubah dari kategori menjadi user_status

// Melindungi dari SQL Injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);
$user_status = mysqli_real_escape_string($conn, $user_status); // Ubah dari kategori menjadi user_status

// Mencari pengguna dengan username tertentu di database
$sql = "SELECT * FROM m_user WHERE username = '$username' AND user_status = '$user_status'"; // Ubah dari kategori menjadi user_status
$result = $conn->query($sql);

// Periksa apakah username dan password cocok
if ($result->num_rows > 0) {
    // Pengguna ditemukan, ambil data dari database
    $row = $result->fetch_assoc();
    
    // Periksa apakah password yang dimasukkan sesuai dengan password di database
    if ($password === $row['password']) {
        // Password cocok, login berhasil
        session_start(); // Memulai sesi
        $_SESSION['username'] = $username; // Simpan username ke sesi
        $_SESSION['user_status'] = $user_status; // Simpan user_status ke sesi
        echo "success";
    } else {
        // Password salah
        echo "wrong_password";
    }
} else {
    // Pengguna tidak ditemukan
    echo "user_not_found";
}

$conn->close();
?>
