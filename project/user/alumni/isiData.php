<?php
session_start();

// Periksa apakah ada session username yang tersimpan
if (isset($_SESSION['username'])) {
    // Jika ada, simpan nilai session tersebut ke dalam variabel
    $username = $_SESSION['username'];
    $nama = $_SESSION['nama'];
} else {
    // Jika tidak ada, redirect ke halaman registrasi
    header("Location: ../../registrasi.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Sertakan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sertakan script.js -->
    <script src="../../script.js"></script>
</head>

<body class="backgroundRegister">
    <!-- Konten Anda -->
    <?php include '../TemplateUser/headerUser.php'; ?>

    <div class="Register-container">
        <h2 class="h2R">Pengisan Data</h2>
        <p>Silakan isi Data anda sesuai status anda.</p>

        <!-- Formulir Registrasi -->
        <form action="../../Koneksi/koneksiIsiDataAlumni.php" method="post" class="form-registrasi" id="register">

            <div class="form-group">
                <img src="../../gambar/polinema.png" alt="Logo" class="logoR">
            </div>

            <div class="form-group">
                <label for="responden_nama">Nama:</label>
                <input type="text" id="responden_nama" name="responden_nama" value="<?php echo $nama; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="responden_nim">NIM:</label>
                <input type="text" id="responden_nim" name="responden_nim" required>
            </div>

            <div class="form-group">
                <label for="responden_email">Email:</label>
                <input type="text" id="responden_email" name="responden_email" required>
            </div>

            <div class="form-group">
                <label for="responden_hp">No handphone:</label>
                <input type="text" id="responden_hp" name="responden_hp" required>
            </div>

            <div class="form-group">
                <label for="responden_prodi">Prodi:</label>
                <select id="responden_prodi" name="responden_prodi" required>
                    <option value="" disabled selected>Pilih Prodi</option>
                    <option value="D4 - Sistem Informasi Bisnis">D4 - Sistem Informasi Bisnis</option>
                    <option value="D4 - Teknologi Informasi">D4 - Teknologi Informasi</option>
                    <option value="D2 - Fast Track">D2 - Fast Track</option>
                    <option value="D4 - Akutansi">D4 - Akutansi</option>
                    <option value="D4 - Teknik Sipil">D4 - Teknik Sipil</option>
                    <option value="D4 - Manajemen">D4 - Manajemen</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tahun_masuk">Tahun Lulus:</label>
                <input type="text" id="tahun_lulus" name="tahun_lulus" required>
            </div>

            <div class = "registrasi button">
            <button type="submit" id="simpanButton">Simpan</button>
            </div>
        </form>
    </div>
    </div>

</body>

</html>
