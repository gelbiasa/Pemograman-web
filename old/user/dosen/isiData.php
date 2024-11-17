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
        <form action="../../Koneksi/koneksiIsiDataDosen.php" method="post" class="form-registrasi" id="register">

            <div class="form-group">
                <img src="../../gambar/polinema.png" alt="Logo" class="logoR">
            </div>

            <div class="form-group">
                <label for="responden_nama">Nama:</label>
                <input type="text" id="responden_nama" name="responden_nama" value="<?php echo $nama; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="responden_nip">NIP:</label>
                <input type="text" id="responden_nip" name="responden_nip" required>
            </div>

            <div class="form-group">
                <label for="responden_unit">Unit:</label>
                <select id="responden_unit" name="responden_unit" required>
                    <option value="" disabled selected>Pilih Unit</option>
                    <option value="D4 - Sistem Informasi Bisnis">D4 - Sistem Informasi Bisnis</option>
                    <option value="D4 - Teknologi Informasi">D4 - Teknologi Informasi</option>
                    <option value="D2 - Fast Track">D2 - Fast Track</option>
                    <option value="D4 - Akutansi">D4 - Akutansi</option>
                    <option value="D4 - Teknik Sipil">D4 - Teknik Sipil</option>
                    <option value="D4 - Manajemen">D4 - Manajemen</option>
                </select>
            </div>

            <button type="submit" id="simpanButton">Simpan</button>
        </form>
    </div>
    </div>

</body>

</html>
