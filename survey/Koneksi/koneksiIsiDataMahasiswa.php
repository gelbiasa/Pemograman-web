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
$responden_nim = $_POST['responden_nim'];
$responden_email = $_POST['responden_email'];
$responden_hp = $_POST['responden_hp'];
$responden_prodi = $_POST['responden_prodi'];
$tahun_masuk = $_POST['tahun_masuk'];

// Lindungi dari SQL Injection
$responden_nama = mysqli_real_escape_string($conn, $responden_nama);
$responden_nim = mysqli_real_escape_string($conn, $responden_nim);
$responden_email = mysqli_real_escape_string($conn, $responden_email);
$responden_hp = mysqli_real_escape_string($conn, $responden_hp);
$responden_prodi = mysqli_real_escape_string($conn, $responden_prodi);
$tahun_masuk = mysqli_real_escape_string($conn, $tahun_masuk);

// Query SQL untuk menyimpan data ke dalam database
$sql1 = "INSERT INTO m_user (username, password, Nama, user_status) 
VALUES ('".$_SESSION['username']."', '".$_SESSION['password']."', '".$_SESSION['nama']."', '".$_SESSION['user_status']."')";

if ($conn->query($sql1) === TRUE) {
    $success = true;
    for ($i = 0; $i < 3; $i++) {
        $sql2 = "INSERT INTO t_responden_mahasiswa (responden_nama, responden_nim, responden_email, responden_hp, responden_prodi, tahun_masuk) 
        VALUES ('$responden_nama', '$responden_nim', '$responden_email', '$responden_hp', '$responden_prodi', '$tahun_masuk')";
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
