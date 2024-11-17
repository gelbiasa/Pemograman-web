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
        <div class="containerKanan_SP">
            <div id="mAU" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/aUser.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>All User</h2>
                            <p>Data User</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mDA" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/admin.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Admin</h2>
                            <p>Data Admin</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div id="mDR" class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/profilLogo.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Responden</h2>
                            <p>Data Responden</p>
                        </div>
                    </div>
                    <img src="../../gambar/iconArrow.png" alt="arrow" class="icon_arrow_SP">
                </div>
                <div class="blok-strip_SP"></div>
            </div>
            <div class="blok_SP1">
                <div class="blok_SP">
                    <div class="content_SP">
                        <img src="../../gambar/profilLogo.png" alt="icon_survey" class="icon_survey_SP">
                        <div class="text_SP">
                            <h2>Request</h2>
                            <p>Data request user</p>
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
