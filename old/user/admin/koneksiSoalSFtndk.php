<?php
// Mulai sesi jika belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah ada sesi username dan user_status
if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
    // Jika tidak, tampilkan pesan dan tautan ke halaman login
    echo "<p>Anda perlu login terlebih dahulu. <a href='../../index.html'>Menuju halaman Login</a></p>";
    exit(); // Pastikan kode berhenti di sini
}

include '../../Koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_SS">
            <div class="accSoal">
                <?php
                // Periksa apakah data dari form addSFmhs telah disubmit
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Ambil nilai-nilai dari form
                    $survey_id = $_POST['survey_id'];

                    // Pastikan banyak_soal tersedia dalam session sebelum mengaksesnya
                    if (isset($_SESSION['banyak_soal'])) {
                        $banyak_soal = $_SESSION['banyak_soal'];

                        // Variable untuk menentukan apakah ada error dalam menyimpan soal
                        $error = false;

                        // Loop untuk menyimpan setiap soal yang diinputkan
                        for ($i = 1; $i <= $banyak_soal; $i++) {
                            // Pastikan nilai-niali soal tersedia dalam $_POST sebelum mengaksesnya
                            if (!empty($_POST["soal_nomor_$i"]) && !empty($_POST["soal_jenis_$i"]) && !empty($_POST["soal_nama_$i"])) {
                                // Ambil nilai-nilai dari form untuk setiap soal
                                $soal_nomor = $_POST["soal_nomor_$i"];
                                $soal_jenis = $_POST["soal_jenis_$i"];
                                $soal_nama = $_POST["soal_nama_$i"];

                                // Query untuk menyimpan data soal ke dalam tabel m_survey_soal
                                $query_insert_soal = "INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama)
                                                    VALUES (?, 3, ?, ?, ?)";
                                $stmt = $conn->prepare($query_insert_soal);
                                $stmt->bind_param("iiss", $survey_id, $soal_nomor, $soal_jenis, $soal_nama);
                                $result = $stmt->execute();
                                $stmt->close();

                                // Periksa apakah query berhasil dieksekusi
                                if (!$result) {
                                    $error = true;
                                }
                            } else {
                                // Tampilkan pesan error jika nilai soal tidak tersedia dalam $_POST
                                echo "<p>Error: Nilai soal tidak ditemukan untuk nomor $i</p>";
                                $error = true;
                            }
                        }

                        // Tampilkan pesan sesuai dengan keberhasilan menyimpan soal
                        if (!$error) {
                            echo "<p>Soal berhasil disimpan!</p>";
                        } else {
                            echo "<p>Terjadi kesalahan saat pembuatan soal. Soal tidak berhasil tersimpan!</p>";
                        }
                    } else {
                        // Tampilkan pesan error jika nilai banyak_soal tidak tersedia dalam session
                        echo "<p>Error: Nilai banyak_soal tidak ditemukan</p>";
                    }
                    ?>
                    <!-- Tombol kembali -->
                    <button id="backSSFk">Kembali</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>

</html>
