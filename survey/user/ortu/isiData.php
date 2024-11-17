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
        <form action="../../Koneksi/koneksiIsiDataOrangTua.php" method="post" class="form-registrasi" id="register">

            <div class="form-group">
                <img src="../../gambar/polinema.png" alt="Logo" class="logoR">
            </div>

            <div class="form-group">
                <label for="responden_nama">Nama:</label>
                <input type="text" id="responden_nama" name="responden_nama" value="<?php echo $nama; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="responden_jk">Jenis Kelamin:</label>
                <select id="responden_jk" name="responden_jk" required>
                    <option value="" disabled selected>Pilih jenis Kelamin</option>
                    <option value="Laki - laki">Laki - laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="responden_umur">Umur:</label>
                <input type="text" id="responden_umur" name="responden_umur" required>
            </div>

            <div class="form-group">
                <label for="responden_hp">No handphone:</label>
                <input type="text" id="responden_hp" name="responden_hp" required>
            </div>

            <div class="form-group">
                <label for="responden_pendidikan">Pendidikan Terakhir:</label>
                <select id="responden_pendidikan" name="responden_pendidikan" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="responden_pekerjaan">Pekerjaan:</label>
                <input type="text" id="responden_pekerjaan" name="responden_pekerjaan" required>
            </div>

            <div class="form-group">
                <label for="responden_penghasilan">Penghasilan:</label>
                <select id="responden_penghasilan" name="responden_penghasilan" required>
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="< 1.000.000">< 1.000.000</option>
                    <option value="1.000.001 - 3.000.000">1.000.001 - 3.000.000</option>
                    <option value="3.000.001 - 5.000.000">3.000.001 - 5.000.000</option>
                    <option value="> 5.000.001">> 5.000.000</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mahasiswa_nim">Mahasiswa NIM:</label>
                <input type="text" id="mahasiswa_nim" name="mahasiswa_nim" required>
            </div>

            <div class="form-group">
                <label for="mahasiswa_nama">Mahasiswa Nama:</label>
                <input type="text" id="mahasiswa_nama" name="mahasiswa_nama" required>
            </div>

            <div class="form-group">
                <label for="mahasiswa_prodi">Mahasiswa Prodi:</label>
                <select id="mahasiswa_prodi" name="mahasiswa_prodi" required>
                    <option value="" disabled selected>Mahasiswa Prodi</option>
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
