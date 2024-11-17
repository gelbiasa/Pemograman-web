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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Survey - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="container_hasil_survey">
            <div class="container_hasil_survey2">
                <button id="backV" class="btn-back_hSurvey">Back</button>

                <?php 
                // Get parameters from URL
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

                // Verify if the table has been determined
                if (!isset($table)) {
                    exit("Tabel jawaban tidak ditemukan");
                }

                // Query to get question and answer data from the database based on user_status and survey_nama
                $sql = "SELECT s.soal_id, s.no_urut, s.soal_nama, s.soal_jenis
                        FROM m_survey_soal s
                        INNER JOIN m_survey sv ON s.survey_id = sv.survey_id
                        WHERE sv.survey_nama = '$survey_nama' AND sv.survey_jenis = '$user_status'";

                $result = $conn->query($sql);

                // Get the query result
                if ($result->num_rows > 0) {
                    echo "<h1>Hasil Survey: $survey_nama ($user_status)</h1>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<h2>Soal " . $row['no_urut'] . ": " . $row['soal_nama'] . "</h2>";
                        
                        // Display answers based on question type
                        if ($row['soal_jenis'] == "Pilihan") {
                            // Query to get the count of answers for each option in the multiple-choice question
                            $jawaban_sql = "SELECT t.jawaban, COUNT(t.jawaban) AS jumlah_jawaban 
                                            FROM $table t
                                            INNER JOIN m_survey_soal sv ON t.soal_id = sv.soal_id
                                            INNER JOIN m_survey s ON sv.survey_id = s.survey_id
                                            WHERE t.soal_id = " . $row['soal_id'] . " AND s.survey_nama = '$survey_nama' AND s.survey_jenis = '$user_status'
                                            GROUP BY t.jawaban";

                            $jawaban_result = $conn->query($jawaban_sql);

                            if ($jawaban_result->num_rows > 0) {
                                $jawaban_data = [];
                                $jumlah_data = [];
                                $total_responden = 0;
                                $kesimpulan = "";
                                $max_jawaban = 0;

                                echo "<ul>";
                                while ($jawaban_row = $jawaban_result->fetch_assoc()) {
                                    echo "<li>" . $jawaban_row['jawaban'] . ": " . $jawaban_row['jumlah_jawaban'] . "</li>";
                                    $jawaban_data[] = $jawaban_row['jawaban'];
                                    $jumlah_data[] = $jawaban_row['jumlah_jawaban'];
                                    $total_responden += $jawaban_row['jumlah_jawaban'];

                                    if ($jawaban_row['jumlah_jawaban'] > $max_jawaban) {
                                        $max_jawaban = $jawaban_row['jumlah_jawaban'];
                                        $kesimpulan = $jawaban_row['jawaban'];
                                    }
                                }
                                echo "</ul>";

                                // Display chart
                                ?>
                                <canvas id="chart-<?php echo $row['soal_id']; ?>" width="400" height="200"></canvas>
                                <script>
                                    var ctx = document.getElementById('chart-<?php echo $row['soal_id']; ?>').getContext('2d');
                                    var chart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: <?php echo json_encode($jawaban_data); ?>,
                                            datasets: [{
                                                label: 'Jumlah Jawaban',
                                                data: <?php echo json_encode($jumlah_data); ?>,
                                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                                borderColor: 'rgba(54, 162, 235, 1)',
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        }
                                    });
                                </script>
                                <?php
                                // Display conclusion
                                echo "<p>Kesimpulan: Jawaban paling banyak dipilih adalah '$kesimpulan' dengan $max_jawaban responden.</p>";
                            } else {
                                echo "Tidak ada jawaban untuk soal ini.";
                            }
                        } elseif ($row['soal_jenis'] == "Text") {
                            // Query to get all text answers and the date when the answer was provided
                            $jawaban_text_sql = "SELECT t.jawaban
                                                FROM $table t
                                                INNER JOIN m_survey_soal sv ON t.soal_id = sv.soal_id
                                                INNER JOIN m_survey s ON sv.survey_id = s.survey_id
                                                WHERE t.soal_id = " . $row['soal_id'] . " AND s.survey_nama = '$survey_nama' AND s.survey_jenis = '$user_status'";

                            $jawaban_text_result = $conn->query($jawaban_text_sql);

                            if ($jawaban_text_result->num_rows > 0) {
                                echo "<ul>";
                                while ($jawaban_text_row = $jawaban_text_result->fetch_assoc()) {
                                    echo "<li>" . $jawaban_text_row['jawaban'] . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "Tidak ada jawaban untuk soal ini.";
                            }
                        }
                    }
                } else {
                    echo "Tidak ada data yang ditemukan.";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript -->
    <script src="../../script.js"></script>
</body>
</html>

<?php
$conn->close();
?>
