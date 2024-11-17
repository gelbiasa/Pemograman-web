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
include '../../Koneksi/koneksi.php';

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
    $profile_image = $row_user['profile_image']; // Tambahkan kolom profile_image

    // Default profile image if not set
    $profile_image_src = "../../gambar/userLogo.png";
    if ($profile_image) {
        $profile_image_src = "../../uploadGambarProfil/" . $profile_image;
    }
}

// Tangani update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profileUpdated = false; // Flag untuk mendeteksi apakah profile picture diupdate

    // Upload gambar profil jika ada
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../../uploadGambarProfil/';
        $uploadFile = $uploadDir . basename($_FILES['profile_image']['name']);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['profile_image']['tmp_name']);
        if ($check !== false) {
            // Check file size (limit to 5MB)
            if ($_FILES['profile_image']['size'] <= 5000000) {
                // Allow certain file formats
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
                        // Save file path to database
                        $profileImage = basename($_FILES['profile_image']['name']);
                        $sql_update_user = "UPDATE m_user SET profile_image = '$profileImage' WHERE username = '$username'";
                        if ($conn->query($sql_update_user) === TRUE) {
                            $_SESSION['response'] = [
                                'status' => 'success',
                                'message' => 'Foto Profil Berhasil Diperbaharui.'
                            ];
                            $profileUpdated = true; // Set flag saat profile picture berhasil diupdate
                        } else {
                            $_SESSION['response'] = [
                                'status' => 'error',
                                'message' => 'Kesalahan saat memperbarui foto Profil.' . $conn->error
                            ];
                            $profileUpdated = true; // Set flag saat profile picture berhasil diupdate
                        }
                    } else {
                        $_SESSION['response'] = [
                            'status' => 'error',
                            'message' => 'Terjadi kesalahan saat memindahkan file yang diunggah.'
                        ];
                        $profileUpdated = true; // Set flag saat profile picture berhasil diupdate
                    }
                } else {
                    $_SESSION['response'] = [
                        'status' => 'error',
                        'message' => 'Maaf, hanya file JPG, JPEG, & PNG yang diperbolehkan.'
                    ];
                    $profileUpdated = true; // Set flag saat profile picture berhasil diupdate
                }
            } else {
                $_SESSION['response'] = [
                    'status' => 'error',
                    'message' => 'Maaf, file Anda terlalu besar. maksimal hanya 5 MB'
                ];
                $profileUpdated = true; // Set flag saat profile picture berhasil diupdate
            }
        } else {
            $_SESSION['response'] = [
                'status' => 'error',
                'message' => 'File yang anda unggah bukan berupa gambar.'
            ];
            $profileUpdated = true; // Set flag saat profile picture berhasil diupdate
        }
    }

    // Redirect hanya jika profile picture berhasil diupdate
    if ($profileUpdated) {
        header("Location: ../admin/userPage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
    <style>
        .overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 2;
            cursor: pointer;
        }

        .overlay-content {
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .yaTidak {
            height: 20%;
            width: 20%;
            background-color: lightblue;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        include '../../Koneksi/koneksi.php';

        $sql = "SELECT nama, user_status, profile_image FROM m_user WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nama = $row['nama'];
            $user_status = $row['user_status'];
            $profile_image = $row['profile_image'];

            $profile_image_src = "../../gambar/userLogo.png";
            if ($profile_image) {
                $profile_image_src = "../../uploadGambarProfil/" . $profile_image;
            }
        }
        ?>

        <div class="containerUser">
            <div>
                <div class="form-group">
                    <img src="<?php echo $profile_image_src; ?>" alt="Foto Profil" class="avatar" id="profilePicture">
                    <form method="post" enctype="multipart/form-data" id="profileImageForm">
                        <input type="file" id="profileImageInput" name="profile_image" style="display:none;" accept="image/*">
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-iconAdmin" onclick="document.getElementById('profileImageInput').click();">
                    </form>
                </div>
                <h3 class="user-name"><?php echo $nama; ?></h3>
                <p class="user-role"><?php echo $user_status; ?></p>
                <div class="line"></div>
                <div class="buttons">
                    <button id="ManajemenUser" class="big"><img src="../../gambar/mUser.png" alt="Icon" class="icon"> Manajemen User</button>
                    <button id="mSurvey" class="big"><img src="../../gambar/surveyLogo.png" alt="Icon" class="icon"> Manajemen Survey</button>
                    <button id="mHasil" class="big"><img src="../../gambar/hasilLogo.png" alt="Icon" class="icon"> Proses Survey</button>
                    <button id="mReport" class="big"><img src="../../gambar/icon_sistem.png" alt="Icon" class="icon"> Laporan Survey</button>
                    <div class="jarakLogout">
                        <button class="logout" id="logoutButton">Logout</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overlay Konfirmasi -->
        <div id="confirmOverlay" class="overlay">
            <div class="overlay-content">
                <p>Apakah anda yakin ingin mengganti foto?</p>
                <button id="confirmYes" class ="yaTidak">Ya</button>
                <button id="confirmNo" class ="yaTidak">Tidak</button>
            </div>
        </div>

        <!-- Overlay Pesan -->
        <div id="messageOverlay" class="overlay">
            <div class="overlay-content" id="messageContent">
            </div>
        </div>

        <?php
        // Display any response message
        if (isset($_SESSION['response'])) {
            $response = $_SESSION['response'];
            echo "<script>
                var messageOverlay = document.getElementById('messageOverlay');
                var messageContent = document.getElementById('messageContent');
                messageContent.innerHTML = '<p>" . $response['message'] . "</p><button onclick=\"document.getElementById(\'messageOverlay\').style.display=\'none\';\">OK</button>';
                messageOverlay.style.display = 'block';
            </script>";
            // Clear the message
            unset($_SESSION['response']);
        }
    } else {
        echo "Anda perlu login terlebih dahulu.";
    }
    ?>

    <script>
        var selectedFile;

        document.getElementById('profileImageInput').onchange = function (event) {
            selectedFile = event.target.files[0];
            document.getElementById('confirmOverlay').style.display = 'block';
        };

        document.getElementById('confirmYes').onclick = function () {
            document.getElementById('confirmOverlay').style.display = 'none';
            document.getElementById('profileImageForm').submit();
        };

        document.getElementById('confirmNo').onclick = function () {
            document.getElementById('confirmOverlay').style.display = 'none';
            document.getElementById('profileImageInput').value = ''; // Reset input file
        };
    </script>
</body>

</html>