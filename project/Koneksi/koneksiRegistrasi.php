<?php
session_start();

// Buat koneksi ke database
include 'koneksi.php';

// Jika tombol "Next" ditekan pada registrasi.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data yang dikirimkan dari formulir registrasi
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $user_status = $_POST['user_status'];

    // Lindungi dari SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $nama = mysqli_real_escape_string($conn, $nama);
    $user_status = mysqli_real_escape_string($conn, $user_status);

    // Periksa apakah username sudah ada di salah satu tabel
    $tables = ['m_user', 't_pending_mahasiswa', 't_pending_dosen', 't_pending_alumni', 't_pending_tendik', 't_pending_ortu', 't_pending_industri'];
    $usernameExists = false;

    foreach ($tables as $table) {
        $query = "SELECT * FROM $table WHERE username='$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $usernameExists = true;
            break;
        }
    }

    if ($usernameExists) {
        // Username sudah ada, simpan data form ke session dan tampilkan pesan kesalahan
        $_SESSION['form_data'] = [
            'password' => $password,
            'nama' => $nama,
            'user_status' => $user_status
        ];
        $_SESSION['error_message'] = "Username yang anda masukkan sudah digunakan, masukkan username lain.";
        header("Location: ../Login/registrasi.php");
        exit();
    } else {
        // Simpan data registrasi ke dalam session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['nama'] = $nama;
        $_SESSION['user_status'] = $user_status;

        // Redirect ke halaman pengisian data sesuai status
        switch ($user_status) {
            case "Mahasiswa":
                header("Location: ../user/mahasiswa/isiData.php");
                exit();
            case "Dosen":
                header("Location: ../user/dosen/isiData.php");
                exit();
            case "Tenaga Pendidik":
                header("Location: ../user/tendik/isiData.php");
                exit();
            case "Orang Tua":
                header("Location: ../user/ortu/isiData.php");
                exit();
            case "Alumni":
                header("Location: ../user/alumni/isiData.php");
                exit();
            case "Industri":
                header("Location: ../user/industri/isiData.php");
                exit();
            default:
                // Jika status tidak diketahui
                $_SESSION['error_message'] = "Status pengguna tidak valid.";
                header("Location: ../Login/registrasi.php");
                exit();
        }
    }
} else {
    // Jika metode request bukan POST
    header("Location: ../Login/registrasi.php");
    exit();
}
?>
