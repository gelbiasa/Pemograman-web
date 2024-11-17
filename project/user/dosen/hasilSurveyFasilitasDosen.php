<?php
// Mulai sesi jika belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah ada sesi username dan user_status
if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
    echo "<p>Anda perlu login terlebih dahulu. <a href='../../index.html'>Menuju halaman Login</a></p>";
    exit();
}

// Koneksi ke database
include '../../Koneksi/koneksi.php';

// Ambil username dari sesi
$username = $_SESSION['username'];

// Ambil user_id dan Nama berdasarkan username dari tabel m_user
$query_user = "SELECT user_id, Nama FROM m_user WHERE username = ?";
$stmt_user = $conn->prepare($query_user);
$stmt_user->bind_param("s", $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
    $user_id = $row_user['user_id'];
    $responden_nama = $row_user['Nama'];
} else {
    die("Error: Pengguna tidak ditemukan");
}
$stmt_user->close();

$survey_nama = 'Survey Fasilitas'; // Ubah sesuai kebutuhan

// Query untuk mengambil survey_id dari survey_nama yang diisi oleh user saat ini
$query_survey_id = "SELECT survey_id FROM m_survey WHERE survey_nama = ? AND user_id = ?";
$stmt_survey_id = $conn->prepare($query_survey_id);
$stmt_survey_id->bind_param("si", $survey_nama, $user_id);
$stmt_survey_id->execute();
$result_survey_id = $stmt_survey_id->get_result();

if ($result_survey_id->num_rows > 0) {
    $row_survey = $result_survey_id->fetch_assoc();
    $survey_id = $row_survey['survey_id'];
} else {
    die("Error: Survey tidak ditemukan untuk pengguna ini");
}
$stmt_survey_id->close();

$query_responden_id = "SELECT responden_dosen_id FROM t_responden_dosen WHERE responden_nama = ? AND survey_id = ?";
$stmt_responden_id = $conn->prepare($query_responden_id);
$stmt_responden_id->bind_param("si", $responden_nama, $survey_id);
$stmt_responden_id->execute();
$result_responden_id = $stmt_responden_id->get_result();

if ($result_responden_id->num_rows > 0) {
    $row_responden = $result_responden_id->fetch_assoc();
    $responden_id = $row_responden['responden_dosen_id'];
} else {
    die("Error: Responden tidak ditemukan");
}
$stmt_responden_id->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Survey - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php include '../TemplateUser/headerUser.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateUser/sidebarUser.php'; ?>
        <div class="container_survey">
            <button class="btn-back_survey" onclick="window.history.back()">Back</button>
            <div class="survey-nama">
                <?php echo htmlspecialchars($survey_nama); ?>
            </div>
            <div class="container_soal">
                <form>
                    <?php
                    // Query untuk mengambil pertanyaan dan jawaban
                    $query_jawaban = "SELECT ms.soal_nama, ms.soal_jenis, ms.no_urut, tj.jawaban 
                                      FROM t_jawaban_dosen tj 
                                      JOIN m_survey_soal ms ON tj.soal_id = ms.soal_id 
                                      WHERE tj.responden_dosen_id = ?";
                    $stmt_jawaban = $conn->prepare($query_jawaban);
                    $stmt_jawaban->bind_param("i", $responden_id);
                    $stmt_jawaban->execute();
                    $result_jawaban = $stmt_jawaban->get_result();

                    if ($result_jawaban->num_rows > 0) {
                        while ($row = $result_jawaban->fetch_assoc()) {
                            echo "<div class='mb-3'>";
                            echo "<label for='question" . $row['no_urut'] . "' class='form-label_survey'>" . $row['no_urut'] . ". " . $row['soal_nama'] . "</label>";
                            echo "<div class='answer-options_survey'>";
                    
                            if ($row['soal_jenis'] == "Pilihan") {
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['no_urut'] . "' id='answer" . $row['no_urut'] . "a' value='Sangat baik'" . ($row['jawaban'] == 'Sangat baik' ? ' checked disabled' : ' disabled') . ">";
                                echo "<label class='form-check-label' for='answer" . $row['no_urut'] . "a'>Sangat Baik</label>";
                                echo "</div>";
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['no_urut'] . "' id='answer" . $row['no_urut'] . "b' value='Baik'" . ($row['jawaban'] == 'Baik' ? ' checked disabled' : ' disabled') . ">";
                                echo "<label class='form-check-label' for='answer" . $row['no_urut'] . "b'>Baik</label>";
                                echo "</div>";
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['no_urut'] . "' id='answer" . $row['no_urut'] . "c' value='Cukup'" . ($row['jawaban'] == 'Cukup' ? ' checked disabled' : ' disabled') . ">";
                                echo "<label class='form-check-label' for='answer" . $row['no_urut'] . "c'>Cukup</label>";
                                echo "<div class='jarakBawahSS'></div>";
                                echo "</div>";
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['no_urut'] . "' id='answer" . $row['no_urut'] . "d' value='Kurang'" . ($row['jawaban'] == 'Kurang' ? ' checked disabled' : ' disabled') . ">";
                                echo "<label class='form-check-label' for='answer" . $row['no_urut'] . "d'>Kurang</label>";
                                echo "<div class='jarakBawahSS'></div>";
                                echo "</div>";
                            } else if ($row['soal_jenis'] == "Text") {
                                echo "<div class='jarakSS'></div>";
                                echo "<textarea class='form-control_survey' name='answer" . $row['no_urut'] . "' id='answer" . $row['no_urut'] . "' rows='4' disabled>" . htmlspecialchars($row['jawaban']) . "</textarea>";
                            }
                    
                            echo "</div>"; // penutup answer-options_survey
                            echo "</div>"; // penutup mb-3
                        }
                    } else {
                        echo "Belum ada pertanyaan yang ditambahkan.";
                    }

                    $stmt_jawaban->close();
                    $conn->close();
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
