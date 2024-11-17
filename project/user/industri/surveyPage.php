<?php
// Mulai sesi jika belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
include '../../Koneksi/koneksi.php';

// Ambil user_id dari session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
if (empty($username)) {
    die("Error: Username tidak tersedia");
}

$query_user = "SELECT user_id FROM m_user WHERE username = '$username'";
$result_user = $conn->query($query_user);
$user_id = $result_user->fetch_assoc()['user_id'];

// Fungsi untuk mengecek apakah survey sudah diisi oleh user
function isSurveyCompleted($user_id, $survey_name, $conn) {
    $query = "SELECT s.survey_id FROM m_survey s
              JOIN t_responden_industri r ON s.survey_id = r.survey_id
              WHERE s.survey_nama = '$survey_name' AND r.responden_nama = 
              (SELECT Nama FROM m_user WHERE user_id = '$user_id')";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

$survey_SDMI_completed = isSurveyCompleted($user_id, 'Survey Sumber Daya Mahasiswa', $conn);
$survey_DPI_completed = isSurveyCompleted($user_id, 'Survey Dosen Pembimbing', $conn);
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
    <!-- Konten Anda -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
</body>

</html>

<body>
    <?php include '../TemplateUser/headerUser.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateUser/sidebarUser.php'; ?>
        
            <div class="containerKanan_SP">
                <div class="blok_SP1">
                    <div class="blok_SP_SDMI isiSurvey-buttonI <?php echo $survey_SDMI_completed ? 'completed' : ''; ?>" id="surveySDMI_button"> 
                        <div class="content_SP">
                            <img src="../../gambar/sdm.png" alt="icon_survey" class="icon_survey_SP">
                            <div class="text_SP">
                                <h2>Survey Sumber Daya Mahasiswa</h2>
                                <p>Berikan penilaian kerja atau magang dari mashasiswa POLINEMA</p>
                            </div>
                        </div>
                        <img src="../../gambar/icon_arrow.png" alt="arrow" class="icon_arrow_SP">
                    </div>
                    <div class="blok-strip_SP"></div>
                </div>
                <div class="blok_SP1">
                    <div class="blok_SP_DPI isiSurvey-buttonI <?php echo $survey_DPI_completed ? 'completed' : ''; ?>" id="surveyDPI_button">
                        <div class="content_SP">
                            <img src="../../gambar/dospem.png" alt="icon_survey" class="icon_survey_SP">
                            <div class="text_SP">
                                <h2>Survey Dosen Pembimbing</h2>
                                <p>Berikan penilaian Dosen pembimbing dari mahasiswa yang magang </p>
                            </div>
                        </div>
                        <img src="../../gambar/icon_arrow.png" alt="arrow" class="icon_arrow_SP">
                    </div>
                    <div class="blok-strip_SP"></div>
                </div>
            </div>

        
    </div>
</body>

</html>