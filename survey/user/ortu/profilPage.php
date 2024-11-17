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

// Sambungkan ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "surveypolinema";
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan username yang sedang login
$username = $_SESSION['username'];

// Query untuk mengambil informasi pengguna dari tabel m_user
$sql_user = "SELECT * FROM m_user WHERE username = '$username'";
$result_user = $conn->query($sql_user);

// Periksa apakah data pengguna ditemukan
if ($result_user->num_rows > 0) {
    // Ambil data pengguna
    $row_user = $result_user->fetch_assoc();

    // Simpan data pengguna
    $nama = $row_user['Nama']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
    $user_status = $row_user['user_status']; // Pastikan nama kolom sesuai dengan kolom dalam tabel

    // Jika user adalah mahasiswa, ambil informasi mahasiswa dari tabel t_responden_mahasiswa

    // Query untuk mengambil informasi mahasiswa
    $sql_ortu = "SELECT * FROM t_responden_ortu WHERE responden_nama = '$nama'";
    $result_ortu = $conn->query($sql_ortu);

    // Periksa apakah data mahasiswa ditemukan
    if ($result_ortu->num_rows > 0) {
        // Ambil data mahasiswa
        $row_ortu = $result_ortu->fetch_assoc();

        // Simpan data mahasiswa
        $jk = $row_ortu['responden_jk']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
        $umur = $row_ortu['responden_umur'];
        $hp = $row_ortu['responden_hp']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
        $pendidikan = $row_ortu['responden_pendidikan'];
        $pekerjaan = $row_ortu['responden_pekerjaan'];
        $penghasilan = $row_ortu['responden_penghasilan'];
        $mahasiswa_nim = $row_ortu['mahasiswa_nim']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
        $mahasiswa_nama = $row_ortu['mahasiswa_nama']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
        $mahasiswa_prodi = $row_ortu['mahasiswa_prodi']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
    }
}
// Tangani update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username_new = $_POST['username'];
    $hp_new = $_POST['responden_hp'];
    $umur_new = $_POST['responden_umur'];
    $pendidikan_new = $_POST['responden_pendidikan'];
    $pekerjaan_new = $_POST['responden_pekerjaan'];
    $penghasilan_new = $_POST['responden_penghasilan'];

    // Update data di tabel m_user
    $sql_update_user = "UPDATE m_user SET username = '$username_new' WHERE Nama = '$nama'";
    if ($conn->query($sql_update_user) === TRUE) {
        // Perbarui sesi username
        $_SESSION['username'] = $username_new;
    }

    // Update data di tabel t_responden_mahasiswa
    $sql_update_ortu = "UPDATE t_responden_ortu SET responden_umur = '$umur_new', responden_hp = '$hp_new', responden_pendidikan = '$pendidikan_new', 
    responden_pekerjaan = '$pekerjaan_new', responden_penghasilan = '$penghasilan_new' WHERE responden_nama = '$nama'";
    $conn->query($sql_update_ortu);

    // Set pesan berhasil diperbarui dan redirect
    $_SESSION['update_success'] = true;
    header("Location: profilPage.php");
    exit();
}

$update_success = false;
if (isset($_SESSION['update_success'])) {
    $update_success = $_SESSION['update_success'];
    unset($_SESSION['update_success']);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="../../script.js"></script>
</head>

<body>
    <?php include '../TemplateUser/headerUser.php'; ?>
    <div class="containerMainPP">
        <?php include '../TemplateUser/sidebarUser.php'; ?>
        <div class="containerKananPP">
            <form class="containerPP" id="profileForm" method="POST" action="profilPage.php">
                <input type="hidden" name="update_success" value="<?php echo $update_success ? 'true' : ''; ?>">

                <div class="form-group">
                    <img src="../../gambar/userLogo.png" alt="Logo" class="logoPP">
                </div>

                <div class="input-groupPP">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="username">Username:</label>
                    <div class="input-container">
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('username')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_jk">Jenis Kelamin:</label>
                    <input type="text" id="responden_jk" name="responden_jk" value="<?php echo $jk; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="responden_umur">Umur:</label>
                    <div class="input-container">
                        <input type="text" id="responden_umur" name="responden_umur" value="<?php echo $umur; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_umur')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_hp">No. Handphone:</label>
                    <div class="input-container">
                        <input type="text" id="responden_hp" name="responden_hp" value="<?php echo $hp; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_hp')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_pendidikan">Riwayat Pendidikan Terakhir:</label>
                    <div class="input-container">
                        <input type="text" id="responden_pendidikan" name="responden_pendidikan" value="<?php echo $pendidikan; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_pendidikan')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_pekerjaan">Pekerjaan:</label>
                    <div class="input-container">
                        <input type="text" id="responden_pekerjaan" name="responden_pekerjaan" value="<?php echo $pekerjaan; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_pekerjaan')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_penghasilan">Penghasilan:</label>
                    <div class="input-container">
                        <input type="text" id="responden_penghasilan" name="responden_penghasilan" value="<?php echo $penghasilan; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_penghasilan')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="mahasiswa_nim">Mahasiswa NIM:</label>
                    <input type="text" id="mahasiswa_nim" name="mahasiswa_nim" value="<?php echo $mahasiswa_nim; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="mahasiswa_nama">Mahasiswa Nama:</label>
                    <input type="text" id="mahasiswa_nama" name="mahasiswa_nama" value="<?php echo $mahasiswa_nama; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="mahasiswa_prodi">Mahasiswa Prodi:</label>
                    <input type="text" id="mahasiswa_prodi" name="mahasiswa_prodi" value="<?php echo $mahasiswa_prodi; ?>" readonly>
                </div>

                <div class="simpan">
                <div class="simpan">
                    <button type="submit" name="simpan" id="simpanButton" disabled>
                        <img src="../../gambar/bookmark.png" alt="Simpan">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>