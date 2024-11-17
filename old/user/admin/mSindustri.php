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
            <button id="backS" class="btn-back_SS">Back</button>
            <div class="blok_SS1">
                <div id="SSDMindustri" class="blok_SS">
                    <div class="content_SS">
                        <img src="../../gambar/icon_alumni.png" alt="icon_survey" class="icon_survey_SS">
                        <div class="text_SS">
                            <h2>Buat Survey Sumber Daya Mahasiswa</h2>
                            <p>Survey penilaian kualitas mahasiswa POLINEMA untuk industri</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_SS"></div>
            </div>
            <div class="blok_SS1">
                <div id="SDPindustri" class="blok_SS">
                    <div class="content_SS">
                        <img src="../../gambar/dospem.png" alt="icon_survey" class="icon_survey_SS">
                        <div class="text_SS">
                            <h2>Buat Survey Dosen Pembimbing</h2>
                            <p>Survey penilaian kualitas dosen pembimbing POLINEMA untuk industri</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_SS"></div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>

</html>
