<?php
session_start();

// Buat koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "surveypolinema";

// Buat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

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
            echo "Pilih status terlebih dahulu.";
            exit();
    }
}
?>
