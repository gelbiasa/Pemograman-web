<?php
// Mulai sesi jika belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surveypolinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

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
              JOIN t_responden_ortu r ON s.survey_id = r.survey_id
              WHERE s.survey_nama = '$survey_name' AND r.responden_nama = 
              (SELECT Nama FROM m_user WHERE user_id = '$user_id')";
    $result = $conn->query($query);
    return $result->num_rows > 0;
}

$survey_kepuasanPelayanan_completed = isSurveyCompleted($user_id, 'Survey Kepuasan pelayanan', $conn);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
</head>


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
        <div class="containerKananPP">
            <div class="containerKanan_SP">
                <div class="blok_SP1">
                    <div class="blok_SP_HPO hasilSurvey-buttonOT <?php echo $survey_kepuasanPelayanan_completed ? 'completed' : ''; ?>" id="hasilSurveyPO_button">
                        <div class="content_SP">
                            <img src="../../gambar/pelayanan.png" alt="icon_survey" class="icon_survey_SP">
                            <div class="text_SP">
                                <h2>Survey Kualitas Pelayanan</h2>
                                <p>Berikan penilaian kualitas pelayanan yang diberikan POLINEMA</p>
                            </div>
                        </div>
                        <img src="../../gambar/icon_arrow.png" alt="arrow" class="icon_arrow_SP">
                    </div>
                    <div class="blok-strip_SP"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>