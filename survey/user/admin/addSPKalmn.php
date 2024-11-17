<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
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
    ?>

    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_SS">
            <button id="backSA" class="btn-back_SS">Back</button>
            <div class="container_form_SS">
                <!-- Form membuat survey -->
                <form action="addSoalSPKalmn.php" method="POST">
                    <div class="surveyInput">
                        <label for="jumlah_survey">Jumlah Survey:</label><br>
                        <input type="number" id="jumlah_survey" name="jumlah_survey" value="" required><br>
                        <input type="hidden" name="survey_jenis" value="Alumni">
                        <label for="survey_kode">Kode Survey:</label><br>
                        <input type="text" id="survey_kode" name="survey_kode" value="" required><br>
                        <label for="survey_nama">Nama Survey:</label><br>
                        <input type="text" id="survey_nama" name="survey_nama" value="Survey Pasca Kelulusan"><br>
                        <label for="survey_deskripsi">Deskripsi Survey:</label><br>
                        <textarea id="survey_deskripsi" name="survey_deskripsi" required></textarea><br>
                        <label for="banyak_soal">Banyaknya Soal:</label><br>
                        <input type="number" id="banyak_soal" name="banyak_soal" value="" required><br>
                        <button id="nextSPKalmn" type="submit">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>

</html>
