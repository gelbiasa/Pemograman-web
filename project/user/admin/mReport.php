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

include '../../Koneksi/koneksi.php';

// Bobot survey
$bobot_survey = [
    'Survey Fasilitas' => 20,
    'Survey Sistem Informasi' => 20,
    'Survey Dosen' => 10,
    'Survey Pasca Kelulusan' => 15,
    'Survey Kepuasan Pelayanan' => 15,
    'Survey Sumber Daya Mahasiswa' => 10,
    'Survey Dosen Pembimbing' => 10
];

// Bobot jawaban
$bobot_jawaban = [
    'Sangat Baik' => 4,
    'Baik' => 3,
    'Cukup' => 2,
    'Kurang' => 1
];

// Fungsi untuk menghitung skor fuzzy
function hitung_fuzzy($conn, $soal_id, $bobot_jawaban, $tables) {
    $total_skor = 0;
    $total_responden = 0;

    foreach ($tables as $table) {
        $jawaban_sql = "SELECT jawaban FROM $table WHERE soal_id = $soal_id";
        $jawaban_result = $conn->query($jawaban_sql);

        if ($jawaban_result->num_rows > 0) {
            while ($jawaban_row = $jawaban_result->fetch_assoc()) {
                $jawaban = $jawaban_row['jawaban'];
                if (isset($bobot_jawaban[$jawaban])) {
                    $skor = $bobot_jawaban[$jawaban];
                    $total_skor += $skor;
                    $total_responden++;
                }
            }
        }
    }

    if ($total_responden > 0) {
        $skor_fuzzy = ($total_skor / ($total_responden * 4)) * 100; // Skor dalam persentase
    } else {
        $skor_fuzzy = 0;
    }

    return $skor_fuzzy;
}

$tables = ['t_jawaban_mahasiswa', 't_jawaban_dosen', 't_jawaban_tendik', 't_jawaban_alumni', 't_jawaban_ortu', 't_jawaban_industri'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: min-content;
            margin-left: -15%;
        }
    </style>
</head>
<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="container_hasil_survey">
            <div class="container_hasil_survey2">
                <h1>Laporan Hasil Survey</h1>

                <!-- Diagram Lingkaran -->
                <div class="chart-container">
                    <canvas id="surveyChart" width="300" height="300"></canvas>
                </div>

                <?php
                $survey_data = [];
                $survey_labels = [];
                $survey_colors = [];

                foreach ($bobot_survey as $survey_nama => $bobot) {
                    $soal_sql = "SELECT * FROM m_survey_soal ss
                                    JOIN 
                                    m_survey s
                                    ON s.survey_id = ss.survey_id 
                                    WHERE s.survey_nama = '$survey_nama' AND ss.soal_jenis = 'Pilihan'";
                    $soal_result = $conn->query($soal_sql);

                    if ($soal_result->num_rows > 0): // Tampilkan hanya jika ada soal
                        $total_skor_survey = 0;
                        $jumlah_soal = $soal_result->num_rows;

                        while($soal = $soal_result->fetch_assoc()):
                            $soal_id = $soal['soal_id'];
                            $skor_fuzzy = hitung_fuzzy($conn, $soal_id, $bobot_jawaban, $tables);
                            $total_skor_survey += $skor_fuzzy;
                        endwhile;
                        $rata_rata_skor_survey = $total_skor_survey / $jumlah_soal;
                        $nilai_akhir = ($rata_rata_skor_survey * $bobot) / 100;

                        $survey_data[] = $nilai_akhir;
                        $survey_labels[] = $survey_nama;
                        $survey_colors[] = 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.6)';
                        ?>

                        <h2>Survey: <?php echo $survey_nama; ?></h2>
                        <p>Jumlah Soal: <?php echo $jumlah_soal ?></p>
                        <p>Rata-rata: <?php echo number_format($rata_rata_skor_survey, 2); ?>%</p>
                        <p>Nilai Akhir: <?php echo number_format($nilai_akhir, 2); ?>%</p>

                        <?php if ($rata_rata_skor_survey < 60): ?>
                            <p>Rekomendasi: Mohon ditingkatkan kualitas dari <?php echo $survey_nama; ?>.</p>
                        <?php else: ?>
                            <p>Rekomendasi: Terus pertahankan kualitas dari <?php echo $survey_nama; ?>.</p>
                        <?php endif; ?>

                    <?php endif; // Tutup if soal_result ?>
                <?php } // Tutup foreach survey_nama ?>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
    <script>
        const ctx = document.getElementById('surveyChart').getContext('2d');
        const surveyChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($survey_labels); ?>,
                datasets: [{
                    label: 'Nilai Akhir Survey',
                    data: <?php echo json_encode($survey_data); ?>,
                    backgroundColor: <?php echo json_encode($survey_colors); ?>,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Hasil Survey'
                    }
                }
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
