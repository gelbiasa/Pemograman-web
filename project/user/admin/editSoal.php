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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_SS">
            <button id="backSS" class="btn-back_SS">Back</button>
            <div class="container_SS">
                <?php 
                // Periksa apakah id soal sudah diterima
                if (isset($_GET['id'])) {
                    $soal_id = $_GET['id'];

                    // Query untuk mendapatkan data soal
                    $sql = "SELECT soal_nama, soal_jenis FROM m_survey_soal WHERE soal_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $soal_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $soal_nama = $row['soal_nama'];
                        $soal_jenis = $row['soal_jenis'];
                    } else {
                        echo "<p>Soal tidak ditemukan.</p>";
                        exit();
                    }
                } else {
                    echo "<p>ID soal tidak ditemukan.</p>";
                    exit();
                }

                // Proses update data soal
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $soal_nama = $_POST['soal_nama'];
                    $soal_jenis = $_POST['soal_jenis'];

                    $sql = "UPDATE m_survey_soal SET soal_nama = ?, soal_jenis = ? WHERE soal_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ssi", $soal_nama, $soal_jenis, $soal_id);

                    if ($stmt->execute()) {
                        $successMessage = "Soal berhasil diperbarui.";
                    } else {
                        $errorMessage = "Gagal memperbarui soal: " . $stmt->error;
                    }
                }
                ?>
                <form action="" method="post">
                    <label for="soal_nama">Nama Soal:</label>
                    <input type="text" id="soal_nama" name="soal_nama" value="<?php echo htmlspecialchars($soal_nama); ?>" required>
                    
                    <label for="soal_jenis">Jenis Soal:</label>
                    <input type="text" id="soal_jenis" name="soal_jenis" value="<?php echo htmlspecialchars($soal_jenis); ?>" required>
                    
                    <input type="submit" value="Update Soal">
                </form>
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

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        window.location.href = '<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'mSurvey.php'; ?>';
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = '<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'mSurvey.php'; ?>';
        }
    }

    // Function to show modal with message
    function showModal(message) {
        document.getElementById("modalMessage").innerText = message;
        modal.style.display = "block";
    }

    // If there is a success or error message, show the modal
    <?php if (isset($successMessage)) { ?>
        showModal("<?php echo $successMessage; ?>");
    <?php } elseif (isset($errorMessage)) { ?>
        showModal("<?php echo $errorMessage; ?>");
    <?php } ?>
    </script>
</body>
</html>
