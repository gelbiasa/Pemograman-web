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

// Ambil survey_nama dari URL
$survey_nama = isset($_GET['survey_nama']) ? $conn->real_escape_string($_GET['survey_nama']) : '';
if (empty($survey_nama)) {
    die("Error: Nama survey tidak valid");
}

// Query untuk mendapatkan survey_id dari survey_nama
$query_survey_id = "SELECT survey_id FROM m_survey WHERE survey_nama = '$survey_nama'";
$result_survey_id = $conn->query($query_survey_id);
if ($result_survey_id->num_rows > 0) {
    $row_survey = $result_survey_id->fetch_assoc();
    $survey_id = $row_survey['survey_id'];
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
    <?php include '../TemplateUser/headerUser.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateUser/sidebarUser.php'; ?>
        <div class="container_survey">
            <button class="btn-back_survey" onclick="window.history.back()">Back</button>
            <div class="survey-nama">
                <?php echo htmlspecialchars($survey_nama); ?>
            </div>
            <div class="container_soal">
                <form action="../../Koneksi/koneksiSubmitAlumni.php" method="POST">
                    <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
                    <input type="hidden" name="survey_nama" value="<?php echo htmlspecialchars($survey_nama); ?>">
                    <?php
                    // Query untuk mengambil soal dari database berdasarkan survey_nama
                    $query = "SELECT * FROM m_survey_soal ms INNER JOIN m_survey s ON ms.survey_id = s.survey_id WHERE s.survey_jenis = 'Alumni' AND s.survey_nama = '$survey_nama'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='mb-3'>";
                            echo "<label for='question" . $row['soal_id'] . "' class='form-label_survey'>" . $row['no_urut'] . ". " . $row['soal_nama'] . "</label>";
                            echo "<div class='answer-options_survey'>";

                            if ($row['soal_jenis'] == "Pilihan") {
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['soal_id'] . "' id='answer" . $row['soal_id'] . "a' value='Sangat baik'>";
                                echo "<label class='form-check-label' for='answer" . $row['soal_id'] . "a'>Sangat Baik</label>";
                                echo "</div>";
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['soal_id'] . "' id='answer" . $row['soal_id'] . "b' value='Baik'>";
                                echo "<label class='form-check-label' for='answer" . $row['soal_id'] . "b'>Baik</label>";
                                echo "</div>";
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['soal_id'] . "' id='answer" . $row['soal_id'] . "c' value='Cukup'>";
                                echo "<label class='form-check-label' for='answer" . $row['soal_id'] . "c'>Cukup</label>";
                                echo "<div class='jarakBawahSS'></div>";
                                echo "</div>";
                                echo "<div class='form-check_survey'>";
                                echo "<input class='form-check-input_survey' type='radio' name='answer" . $row['soal_id'] . "' id='answer" . $row['soal_id'] . "d' value='Kurang'>";
                                echo "<label class='form-check-label' for='answer" . $row['soal_id'] . "d'>Kurang</label>";
                                echo "<div class='jarakBawahSS'></div>";
                                echo "</div>";
                            } else if ($row['soal_jenis'] == "Text") {
                                echo "<div class='jarakSS'></div>";
                                echo "<textarea class='form-control_survey' name='answer" . $row['soal_id'] . "' id='answer" . $row['soal_id'] . "' rows='4'></textarea>";
                            }

                            echo "</div>"; // penutup answer-options_survey
                            echo "</div>"; // penutup mb-3
                        }
                        echo "<div class='jarakSS'>
                                <button type='submit' class='btn-primary_survey' name='submit'>Submit</button>
                            </div>";
                    } else {
                        echo "<div class = 'jarakh2norequest'>";
                        echo "Belum ada pertanyaan yang ditambahkan.";
                        echo "</div>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>