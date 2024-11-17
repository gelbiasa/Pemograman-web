<!DOCTYPE html>
<html lang="id">

<body>
    <!-- Konten Anda -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
    <link rel="stylesheet" href="../style.css">

    <?php
    // Mulai sesi jika belum
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah ada sesi username
    if (isset($_SESSION['username'])) {
        // Simpan username yang login
        $username = $_SESSION['username'];

        // Buat koneksi ke database
        $servername = "localhost";
        $username_db = "root";
        $password_db = "";
        $database = "surveypolinema";

        // Buat koneksi
        $conn = new mysqli($servername, $username_db, $password_db, $database);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil data nama dan user_status dari database sesuai dengan username yang login
        $sql = "SELECT nama, user_status FROM m_user WHERE username = '$username'";
        $result = $conn->query($sql);

        // Periksa apakah query berhasil dieksekusi
        if ($result->num_rows > 0) {
            // Ambil data dari hasil query
            $row = $result->fetch_assoc();
            // Simpan nama dan user_status yang ditemukan
            $nama = $row['nama'];
            $user_status = $row['user_status'];
        }
        ?>

        <div class="containerUser">
            <div>
                <img src="../../gambar/userLogo.png" alt="Foto Profil" class="avatar"> <!-- Gambar Profil -->
                <h3 class="user-name"><?php echo $nama; ?></h3> <!-- Tampilkan nama -->
                <p class="user-role"><?php echo $user_status; ?></p> <!-- Tampilkan user_status -->
                <div class="line"></div> <!-- Garis -->
                <div class="buttons">
                    <button id="ManajemenUser" class="big"><img src="../../gambar/mUser.png" alt="Icon" class="icon"> Manajemen User</button>
                    <button id="mSurvey" class="big"><img src="../../gambar/surveyLogo.png" alt="Icon" class="icon"> Survey</button>
                    <button id="mHasil" class="big"><img src="../../gambar/hasilLogo.png" alt="Icon" class="icon"> Hasil</button>
                    <div class="jarakLogout">
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
