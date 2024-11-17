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
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <?php
        // Query untuk mengambil data dari tabel m_survey dan m_user
        $sql = "SELECT s.survey_nama, u.user_status, s.survey_tanggal
                FROM m_survey s
                INNER JOIN m_user u ON s.user_id = u.user_id
                INNER JOIN (
                    SELECT survey_nama, MAX(survey_tanggal) AS latest_date
                    FROM m_survey
                    GROUP BY survey_nama
                ) latest_survey ON s.survey_nama = latest_survey.survey_nama AND s.survey_tanggal = latest_survey.latest_date";

        $result = $conn->query($sql);

        // Periksa apakah query berhasil dieksekusi
        if ($result->num_rows > 0) {
            ?>
            <div class="container_hasil_survey">
                <div class="container_hSurvey">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis Survey</th>
                                <th scope="col">User</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">View</th> <!-- Kolom tambahan untuk tombol View -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Variable untuk nomor urut
                            $no = 1;
                            // Loop untuk menampilkan data dari database
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $no; ?></th>
                                    <td><?php echo $row['survey_nama']; ?></td>
                                    <td><?php echo $row['user_status']; ?></td>
                                    <td><?php echo $row['survey_tanggal']; ?></td>
                                    <td><button class="btn-view" data-survey-nama="<?php echo urlencode($row['survey_nama']); ?>" data-user-status="<?php echo urlencode($row['user_status']); ?>" <?php if ($row['survey_tanggal'] == null) echo "disabled"; ?>>View</button></td>
                                </tr>
                                <?php
                                // Increment nomor urut
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="container_hasil_survey">
                <button class="btn-back_hSurvey">Back</button>
                <div class="container_hSurvey">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jenis Survey</th>
                                <th scope="col">User</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">View</th> <!-- Kolom tambahan untuk tombol View -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">Tidak ada data yang ditemukan.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>

</html>
