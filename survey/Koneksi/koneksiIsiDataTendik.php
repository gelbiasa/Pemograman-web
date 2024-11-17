<?php
session_start();

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

// Mendapatkan data yang dikirimkan dari formulir pengisian data
$responden_nama = $_POST['responden_nama'];
$responden_nopeg = $_POST['responden_nopeg'];
$responden_unit = $_POST['responden_unit'];

// Lindungi dari SQL Injection
$responden_nama = mysqli_real_escape_string($conn, $responden_nama);
$responden_nopeg = mysqli_real_escape_string($conn, $responden_nopeg);
$responden_unit = mysqli_real_escape_string($conn, $responden_unit);

// Query SQL untuk menyimpan data ke dalam database
$sql1 = "INSERT INTO m_user (username, password, Nama, user_status) 
VALUES ('".$_SESSION['username']."', '".$_SESSION['password']."', '".$_SESSION['nama']."', '".$_SESSION['user_status']."')";

if ($conn->query($sql1) === TRUE) {
    $success = true;
    for ($i = 0; $i < 2; $i++) {
        $sql2 = "INSERT INTO t_responden_tendik (responden_nama, responden_nopeg, responden_unit) 
        VALUES ('$responden_nama', '$responden_nopeg', '$responden_unit')";
        if ($conn->query($sql2) !== TRUE) {
            $success = false;
            break;
        }
    }
    if ($success) {
        echo '<link rel="stylesheet" href="../style.css">';
        echo '<div class="success-messageK">';
        echo '<h2 class="h2K">Data Berhasil Disimpan</h2>';
        echo '<p>Silakan menekan tombol di bawah ini untuk kembali ke Tampilan Awal.</p>';
        echo '<div class="spasiK"></div>';
        echo '<a href="../index.html" class="buttonK">Kembali</a>'; // Perubahan pada tombol
        echo '</div>';
    } 
} else {
    echo '<link rel="stylesheet" href="../style.css">';
    echo '<div class="error-messageK">';
    echo '<h2 class="h2K">Error</h2>';
    echo '<p>Penyimpanan data tidak berhasil. Silakan coba lagi.</p>';
    echo '<p>Error: ' . $conn->error . '</p>';
    echo '</div>';
}

$conn->close();
?>