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
?>

<!DOCTYPE html>
<html lang="id">

<body>
    <!-- Konten Anda -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
    <link rel="stylesheet" href="../../style.css">

    <?php
    // Periksa apakah ada sesi username
    if (isset($_SESSION['username'])) {
        // Simpan username yang login
        $username = $_SESSION['username'];

        // Buat koneksi ke database
        include '../../Koneksi/koneksi.php';

        // Query untuk mengambil data nama dan user_status dari database sesuai dengan username yang login
        $sql = "SELECT nama, user_status, profile_image FROM m_user WHERE username = '$username'";
        $result = $conn->query($sql);

        // Periksa apakah query berhasil dieksekusi
        if ($result->num_rows > 0) {
            // Ambil data dari hasil query
            $row = $result->fetch_assoc();
            // Simpan nama dan user_status yang ditemukan
            $nama = $row['nama'];
            $user_status = $row['user_status'];
            $profile_image = $row['profile_image'];
            
            // Default profile image if not set
            $profile_image_src = "../../gambar/userLogo.png";
            if ($profile_image) {
                $profile_image_src = "../../uploadGambarProfil/" . $profile_image;
            }
        }
        ?>

        <div class="containerUser">
            <div>
                <img src="<?php echo $profile_image_src; ?>" alt="Foto Profil" class="avatar"> <!-- Gambar Profil -->
                <h3 class="user-name"><?php echo $nama; ?></h3> <!-- Tampilkan nama -->
                <p class="user-role"><?php echo $user_status; ?></p> <!-- Tampilkan user_status -->
                <div class="line"></div> <!-- Garis -->
                <div class="buttons">
                    <button id="profilButton" class="big"><img src="../../gambar/profilLogo.png" alt="Icon" class="icon"> Profil</button>
                    <button id="surveyButton" class="big"><img src="../../gambar/surveyLogo.png" alt="Icon" class="icon"> Survey</button>
                    <button id="hasilButton" class="big"><img src="../../gambar/hasilLogo.png" alt="Icon" class="icon"> Hasil</button>
                    <div class="jarakLogoutTU">
                        <button class="logout" id="logoutButton">Logout</button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
        // Jika tidak ada sesi, munculkan pesan
        echo "Anda perlu login terlebih dahulu.";
    }
    ?>

</body>

</html>
