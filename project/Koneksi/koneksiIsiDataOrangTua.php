<?php
session_start();

// Buat koneksi ke database
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $nama = $_SESSION['nama'];
    $user_status = $_SESSION['user_status'];
    $responden_nama = $_POST['responden_nama'];
    $responden_jk = $_POST['responden_jk'];
    $responden_umur = $_POST['responden_umur'];
    $responden_hp = $_POST['responden_hp'];
    $responden_pendidikan = $_POST['responden_pendidikan'];
    $responden_pekerjaan = $_POST['responden_pekerjaan'];
    $responden_penghasilan = $_POST['responden_penghasilan'];
    $mahasiswa_nim = $_POST['mahasiswa_nim'];
    $mahasiswa_nama = $_POST['mahasiswa_nama'];
    $mahasiswa_prodi = $_POST['mahasiswa_prodi'];

    // Lindungi dari SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $nama = mysqli_real_escape_string($conn, $nama);
    $user_status = mysqli_real_escape_string($conn, $user_status);
    $responden_jk = mysqli_real_escape_string($conn, $responden_jk);
    $responden_umur = mysqli_real_escape_string($conn, $responden_umur);
    $responden_hp = mysqli_real_escape_string($conn, $responden_hp);
    $responden_pendidikan = mysqli_real_escape_string($conn, $responden_pendidikan);
    $responden_pekerjaan = mysqli_real_escape_string($conn, $responden_pekerjaan);
    $responden_penghasilan = mysqli_real_escape_string($conn, $responden_penghasilan);
    $mahasiswa_nim = mysqli_real_escape_string($conn, $mahasiswa_nim);
    $mahasiswa_nama = mysqli_real_escape_string($conn, $mahasiswa_nama);
    $mahasiswa_prodi = mysqli_real_escape_string($conn, $mahasiswa_prodi);

    $sql = "INSERT INTO t_pending_ortu (username, password, Nama, user_status, responden_nama, responden_jk, responden_umur, responden_hp, responden_pendidikan, 
    responden_pekerjaan, responden_penghasilan, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi) 
    VALUES ('$username', '$password', '$nama', '$user_status', '$responden_nama', '$responden_jk', '$responden_umur', '$responden_hp', '$responden_pendidikan', '$responden_pekerjaan',
    '$responden_penghasilan', '$mahasiswa_nim', '$mahasiswa_nama', '$mahasiswa_prodi')";

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