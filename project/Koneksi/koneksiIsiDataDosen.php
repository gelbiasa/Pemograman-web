<?php
session_start();

// Buat koneksi ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $nama = $_SESSION['nama'];
    $user_status = $_SESSION['user_status'];
    $responden_nip = $_POST['responden_nip'];
    $responden_nama = $_POST['responden_nama'];
    $responden_unit = $_POST['responden_unit'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $nama = mysqli_real_escape_string($conn, $nama);
    $user_status = mysqli_real_escape_string($conn, $user_status);
    $responden_nip = mysqli_real_escape_string($conn, $responden_nip);
    $responden_unit = mysqli_real_escape_string($conn, $responden_unit);

    $sql = "INSERT INTO t_pending_dosen (username, password, Nama, user_status, responden_nip, responden_nama, responden_unit) 
    VALUES ('$username', '$password', '$nama', '$user_status', '$responden_nip', '$responden_nama', '$responden_unit')";

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