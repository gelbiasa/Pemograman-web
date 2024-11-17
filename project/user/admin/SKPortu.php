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

// Koneksi ke database
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
        <div class="containerKanan_SS">
            <button id="backSO" class="btn-back_SS">Back</button>
            <div class="container_SS">
                <?php 
                // Query untuk mengambil data soal
                $survey_jenis = 'Orang Tua';
                $survey_nama = 'Survey Kualitas Pelayanan';

                $sql = "SELECT soal.soal_id, soal.soal_nama, soal.soal_jenis 
                        FROM m_survey AS survey
                        JOIN m_survey_soal AS soal ON survey.survey_id = soal.survey_id
                        WHERE survey.survey_jenis = ? AND survey.survey_nama = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $survey_jenis, $survey_nama);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
                <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th>Jenis Soal</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                    <?php
                    $no = 1;
                    while ($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($row['soal_nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['soal_jenis']); ?></td>
                        <td><a href="editSoal.php?id=<?php echo $row['soal_id']; ?>"><img src="../../gambar/edit_icon.png" alt="Edit"></a></td>
                        <td><a href="deleteSoal.php?id=<?php echo $row['soal_id']; ?>"><img src="../../gambar/delete_icon.png" alt="Hapus"></a></td>
                    </tr>
                    <?php endwhile; ?>
                </table>
                <?php else: ?>
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>Jenis Soal</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                        <tr>
                            <td colspan = "5"><p>Soal tidak tersedia, silahkan membuat soal.</p></td>
                        </tr>
                    </table>
                <?php endif; ?>
                
                <div class="add-soal">
                    <a href="addSKPortu.php"><img src="../../gambar/add_icon.png" alt="Tambah Soal"></a>
                </div>
            </div>
        </div>
    </div>

    <?php
    $stmt->close();
    $conn->close();
    ?>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>
</html>
