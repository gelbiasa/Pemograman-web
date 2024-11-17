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

$soal_id = isset($_GET['soal_id']) ? intval($_GET['soal_id']) : 0;
$index = isset($_GET['index']) ? intval($_GET['index']) : 0;
$survey_nama = isset($_GET['survey_nama']) ? str_replace('+', ' ', $_GET['survey_nama']) : '';
$user_status = isset($_GET['user_status']) ? str_replace('+', ' ', $_GET['user_status']) : '';

// Determine the table to be used based on user_status
switch ($user_status) {
    case 'Mahasiswa':
        $table = "t_jawaban_mahasiswa";
        break;
    case 'Dosen':
        $table = "t_jawaban_dosen";
        break;
    case 'Tenaga Pendidik':
        $table = "t_jawaban_tendik";
        break;
    case 'Alumni':
        $table = "t_jawaban_alumni";
        break;
    case 'Orang Tua':
        $table = "t_jawaban_ortu";
        break;
    case 'Industri':
        $table = "t_jawaban_industri";
        break;
    default:
        exit("User status tidak valid");
}

// Query to get the text answer at the specified index
$jawaban_text_sql = "SELECT t.jawaban 
                     FROM $table t
                     INNER JOIN m_survey_soal sv ON t.soal_id = sv.soal_id
                     INNER JOIN m_survey s ON sv.survey_id = s.survey_id
                     WHERE t.soal_id = $soal_id AND s.survey_nama = '$survey_nama' AND s.survey_jenis = '$user_status'
                     ORDER BY t.jawaban DESC LIMIT $index, 1";

$jawaban_text_result = $conn->query($jawaban_text_sql);

if ($jawaban_text_result->num_rows > 0) {
    $jawaban_text_row = $jawaban_text_result->fetch_assoc();
    echo $jawaban_text_row['jawaban'];
} else {
    // If no result, reset index to 0 and query again
    $jawaban_text_sql = "SELECT t.jawaban 
                         FROM $table t
                         INNER JOIN m_survey_soal sv ON t.soal_id = sv.soal_id
                         INNER JOIN m_survey s ON sv.survey_id = s.survey_id
                         WHERE t.soal_id = $soal_id AND s.survey_nama = '$survey_nama' AND s.survey_jenis = '$user_status'
                         ORDER BY t.jawaban DESC LIMIT 0, 1";
    $jawaban_text_result = $conn->query($jawaban_text_sql);
    if ($jawaban_text_result->num_rows > 0) {
        $jawaban_text_row = $jawaban_text_result->fetch_assoc();
        echo $jawaban_text_row['jawaban'];
    } else {
        echo "Tidak ada jawaban untuk soal ini.";
    }
}

$conn->close();
?>
