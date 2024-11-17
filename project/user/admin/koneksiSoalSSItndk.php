<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
    echo "<p>Anda perlu login terlebih dahulu. <a href='../../index.html'>Menuju halaman Login</a></p>";
    exit();
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
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $survey_id = $_POST['survey_id'];

                    if (isset($_SESSION['banyak_soal'])) {
                        $banyak_soal = $_SESSION['banyak_soal'];
                        $error = false;

                        for ($i = 1; $i <= $banyak_soal; $i++) {
                            if (!empty($_POST["soal_nomor_$i"]) && !empty($_POST["soal_jenis_$i"]) && !empty($_POST["soal_nama_$i"])) {
                                $soal_nomor = $_POST["soal_nomor_$i"];
                                $soal_jenis = $_POST["soal_jenis_$i"];
                                $soal_nama = $_POST["soal_nama_$i"];

                                $query_insert_soal = "INSERT INTO m_survey_soal (survey_id, kategori_id, no_urut, soal_jenis, soal_nama)
                                                    VALUES (?, 3, ?, ?, ?)";
                                $stmt = $conn->prepare($query_insert_soal);
                                $stmt->bind_param("iiss", $survey_id, $soal_nomor, $soal_jenis, $soal_nama);
                                $result = $stmt->execute();
                                $stmt->close();

                                if (!$result) {
                                    $error = true;
                                }
                            } else {
                                echo "<p>Error: Nilai soal tidak ditemukan untuk nomor $i</p>";
                                $error = true;
                            }
                        }

                        if (!$error) {
                            echo "<p>Soal berhasil disimpan!</p>";
                        } else {
                            echo "<p>Terjadi kesalahan saat pembuatan soal. Soal tidak berhasil tersimpan!</p>";
                        }
                    } else {
                        echo "<p>Error: Nilai banyak_soal tidak ditemukan</p>";
                    }
                    ?>
                    <button id="backSSSIk">Kembali</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
</body>
</html>
