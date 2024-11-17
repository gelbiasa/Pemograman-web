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
        <div class="containerKanan_SP2">
            <div id="mSmhs" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/user.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Survey Mahasiswa</h2>
                            <p>Buat Survey untuk Mahasiswa</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mSdsn" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/dosen.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Survey Dosen</h2>
                            <p>Buat Survey untuk Dosen</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mStndk" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/user.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Survey Tendik</h2>
                            <p>Buat Survey untuk Tendik</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mSalmn" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/alumni.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Survey Alumni</h2>
                            <p>Buat Survey untuk Alumni</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mSortu" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/user.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Survey Ortu/Wali</h2>
                            <p>Buat Survey untuk Ortu/Wali</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mSindustri" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/industri.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Survey Industri</h2>
                            <p>Buat Survey untuk Industri</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>

</html>
