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
        <form action="../../Koneksi/koneksiIsiDataTendik.php" method="post" class="form-registrasi" id="register">

            <div class="form-group">
                <img src="../../gambar/polinema.png" alt="Logo" class="logoR">
            </div>

            <div class="form-group">
                <label for="responden_nama">Nama:</label>
                <input type="text" id="responden_nama" name="responden_nama" value="<?php echo $nama; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="responden_nopeg">Nomor Pegawai:</label>
                <input type="text" id="responden_nopeg" name="responden_nopeg" required>
            </div>

            <div class="form-group">
                <label for="responden_unit">Unit:</label>
                <select id="responden_unit" name="responden_unit" required>
                    <option value="" disabled selected>Pilih Unit</option>
                    <option value="Tata Usaha">Tata Usaha</option>
                    <option value="Administrasi">Administrasi</option>
                    <option value="Staff">Staff</option>
                    <option value="Manajemen">Manajemen</option>
                    <option value="Office Boy">Office Boy</option>
                </select>
            </div>

            <button type="submit" id="simpanButton">Simpan</button>
        </form>
    </div>
    </div>

</body>

</html>
