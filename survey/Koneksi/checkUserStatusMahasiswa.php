<?php
// Mulai sesi jika belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah ada sesi username dan user_status
if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
    echo "error";
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "surveypolinema";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "error";
    exit();
}

// Ambil survey_nama dari POST
$survey_nama = isset($_POST['survey_nama']) ? $conn->real_escape_string($_POST['survey_nama']) : '';
if (empty($survey_nama)) {
    echo "error";
    exit();
}

// Ambil username dari sesi
$username = $_SESSION['username'];

// Query SQL untuk memeriksa apakah survei sudah diisi oleh pengguna tertentu
$sql_check_survey = "SELECT COUNT(*) AS filled FROM t_responden_mahasiswa rm INNER JOIN m_survey s ON rm.survey_id = s.survey_id INNER JOIN m_user u ON u.user_id = s.user_id WHERE u.username = '$username' AND s.survey_nama = '$survey_nama'";
$result_check_survey = $conn->query($sql_check_survey);

if ($result_check_survey->num_rows > 0) {
    $row = $result_check_survey->fetch_assoc();
    if ($row['filled'] > 0) {
        echo "already_filled";
    } else {
        echo "not_filled";
    }
} else {
    echo "error";
}

$conn->close();
?>
