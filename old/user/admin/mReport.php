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
    'Survey Kualitas Pelayanan' => 15,
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

// Fungsi untuk menghitung skor fuzzy dan menampilkan langkah-langkahnya
function hitung_fuzzy($conn, $soal_id, $bobot_jawaban, $tables) {
    $total_skor = 0;
    $total_responden = 0;
    $steps = [];

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
                    $steps[] = "Jawaban: $jawaban, Bobot: $skor";
                }
            }
        }
    }

    if ($total_responden > 0) {
        $skor_fuzzy = ($total_skor / ($total_responden * 4)) * 100; // Skor dalam persentase
        $steps[] = "Total Skor: $total_skor";
        $steps[] = "Total Responden: $total_responden";
        $steps[] = "Skor Fuzzy: $skor_fuzzy%";
    } else {
        $skor_fuzzy = 0;
        $steps[] = "Tidak ada responden";
    }

    return ['skor' => $skor_fuzzy, 'steps' => $steps];
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
</head>
<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="container_hasil_survey2">
            <h1>Laporan Hasil Survey</h1>

            <!-- Diagram Lingkaran -->
            <canvas id="surveyChart" width="300" height="300"></canvas> <!-- Ubah ukuran canvas di sini -->

            <?php
            $survey_data = [];
            $survey_labels = [];
            $survey_colors = [];

            $survey_sql = "SELECT * FROM m_survey";
            $survey_result = $conn->query($survey_sql);

            if ($survey_result->num_rows > 0):
                while($survey = $survey_result->fetch_assoc()):
                    $survey_nama = $survey['survey_nama'];
                    if (!isset($bobot_survey[$survey_nama])) {
                        continue; // Jika survey tidak ada dalam daftar bobot, lewati
                    }

                    $survey_id = $survey['survey_id'];
                    $soal_sql = "SELECT * FROM m_survey_soal WHERE survey_id = $survey_id AND soal_jenis = 'Pilihan'";
                    $soal_result = $conn->query($soal_sql);

                    if ($soal_result->num_rows > 0): // Tampilkan hanya jika ada soal
                        $total_skor_survey = 0;
                        $jumlah_soal = $soal_result->num_rows;
                        $all_steps = [];

                        while($soal = $soal_result->fetch_assoc()):
                            $soal_id = $soal['soal_id'];
                            $result = hitung_fuzzy($conn, $soal_id, $bobot_jawaban, $tables);
                            $skor_fuzzy = $result['skor'];
                            $steps = $result['steps'];
                            $total_skor_survey += $skor_fuzzy;
                            $all_steps[$soal_id] = $steps;
                        endwhile;
                        $rata_rata_skor_survey = $total_skor_survey / $jumlah_soal;
                        $nilai_akhir = ($rata_rata_skor_survey * $bobot_survey[$survey_nama]) / 100;

                        $survey_data[] = $nilai_akhir;
                        $survey_labels[] = $survey_nama;
                        $survey_colors[] = 'rgba(' . rand(0, 255) . ',' . rand(0, 255) . ',' . rand(0, 255) . ', 0.6)';
                        ?>

                        <h2>Survey: <?php echo $survey_nama; ?></h2>
                        <p>Rata-rata Skor Fuzzy: <?php echo number_format($rata_rata_skor_survey, 2); ?>%</p>
                        <p>Nilai Akhir: <?php echo number_format($nilai_akhir, 2); ?>%</p>

                        <?php if ($rata_rata_skor_survey < 60): ?>
                            <p>Rekomendasi: Mohon ditingkatkan kualitas dari <?php echo $survey_nama; ?>.</p>
                        <?php else: ?>
                            <p>Rekomendasi: Terus pertahankan kualitas dari <?php echo $survey_nama; ?>.</p>
                        <?php endif; ?>

                        <!-- Tampilkan langkah-langkah perhitungan -->
                        <h4>Langkah-langkah Perhitungan:</h4>
                        <?php foreach ($all_steps as $soal_id => $steps): ?>
                            <p><strong>Soal ID: <?php echo $soal_id; ?></strong></p>
                            <ul>
                                <?php foreach ($steps as $step): ?>
                                    <li><?php echo $step; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endforeach; ?>

                    <?php endif; // Tutup if soal_result ?>
                <?php endwhile; // Tutup while survey ?>
            <?php else: ?>
                <p>Tidak ada survey yang ditemukan.</p>
            <?php endif; ?>
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
