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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $nama = $_SESSION['nama'];
    $user_status = $_SESSION['user_status'];
    $responden_nama = $_POST['responden_nama'];
    $responden_jabatan = $_POST['responden_jabatan'];
    $responden_perusahaan = $_POST['responden_perusahaan'];
    $responden_email = $_POST['responden_email'];
    $responden_hp = $_POST['responden_hp'];
    $responden_kota = $_POST['responden_kota'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $nama = mysqli_real_escape_string($conn, $nama);
    $user_status = mysqli_real_escape_string($conn, $user_status);
    $responden_jabatan = mysqli_real_escape_string($conn, $responden_jabatan);
    $responden_perusahaan = mysqli_real_escape_string($conn, $responden_perusahaan);
    $responden_email = mysqli_real_escape_string($conn, $responden_email);
    $responden_hp = mysqli_real_escape_string($conn, $responden_hp);
    $responden_kota = mysqli_real_escape_string($conn, $responden_kota);

    $sql = "INSERT INTO t_pending_industri (username, password, Nama, user_status, responden_nama, responden_jabatan, responden_perusahaan, responden_email, responden_hp, responden_kota) 
    VALUES ('$username', '$password', '$nama', '$user_status', '$responden_nama', '$responden_jabatan', '$responden_perusahaan', '$responden_email', '$responden_hp', '$responden_kota')";

    if ($conn->query($sql) === TRUE) {
        echo '<link rel="stylesheet" href="../style.css">';
        echo '<div class="success-messageK">';
        echo '<h2 class="h2K">Registrasi berhasil, menunggu validasi admin. Tunggu paling lambat 3 hari</h2>';
        echo '<p>Silakan menekan tombol di bawah ini untuk kembali ke Tampilan Awal.</p>';
        echo '<div class="spasiK"></div>';
        echo '<a href="../index.html" class="buttonK">Kembali</a>'; // Perubahan pada tombol
        echo '</div>';
    } else {
        echo '<link rel="stylesheet" href="../style.css">';
        echo '<div class="error-messageK">';
        echo '<h2 class="h2K">Error</h2>';
        echo '<p>Registrasi tidak berhasil. Silakan coba lagi.</p>';
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo '</div>';
    }

    $conn->close();
}
?>