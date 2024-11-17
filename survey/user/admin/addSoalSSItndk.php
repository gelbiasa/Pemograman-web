<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
    echo "<p>Anda perlu login terlebih dahulu. <a href='../../index.html'>Menuju halaman Login</a></p>";
    exit();
}

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "surveypolinema";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah_survey = $_POST['jumlah_survey'];
    $survey_jenis = $_POST['survey_jenis'];
    $survey_kode = $_POST['survey_kode'];
    $survey_nama = $_POST['survey_nama'];
    $survey_deskripsi = $_POST['survey_deskripsi'];
    $banyak_soal = $_POST['banyak_soal'];

    $_SESSION['banyak_soal'] = $banyak_soal;

    $query_insert_survey = "INSERT INTO m_survey (survey_jenis, survey_kode, survey_nama, survey_deskripsi)
                            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query_insert_survey);

    for ($i = 0; $i < $jumlah_survey; $i++) {
        $stmt->bind_param("ssss", $survey_jenis, $survey_kode, $survey_nama, $survey_deskripsi);
        $stmt->execute();
    }
    $stmt->close();

    $survey_id = $conn->insert_id;

    header("Location: addSoalSSItndk.php?survey_id=$survey_id&banyak_soal=$banyak_soal");
    exit();
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
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_SS">
            <button id="backSSSItndk" class="btn-back_SS">Back</button>
            <div class="container_form_SS">
                <form action="koneksiSoalSSItndk.php" method="POST">
                    <?php
                    $survey_id = $_GET['survey_id'];
                    $banyak_soal = $_GET['banyak_soal'];

                    for ($i = 1; $i <= $banyak_soal; $i++) {
                        echo "<div class='surveyInput'>";
                        echo "<label for='soal_nomor_$i'>Nomor Soal $i:</label><br>";
                        echo "<input type='text' id='soal_nomor_$i' name='soal_nomor_$i'><br>";
                        echo "<label for='soal_jenis_$i'>Jenis Soal $i:</label><br>";
                        echo "<select id='soal_jenis_$i' name='soal_jenis_$i'>";
                        echo "<option value='pilihan'>Pilihan</option>";
                        echo "<option value='text'>Text</option>";
                        echo "</select><br>";
                        echo "<label for='soal_nama_$i'>Soal $i:</label><br>";
                        echo "<textarea id='soal_nama_$i' name='soal_nama_$i'></textarea><br><br>";
                        echo "</div>";
                    }
                    ?>
                    <input type="hidden" name="survey_id" value="<?php echo $survey_id; ?>">
                    <button id="submitSSSI" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
</body>
</html>
