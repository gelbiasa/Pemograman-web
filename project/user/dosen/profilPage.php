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
 
    $sql_dosen = "SELECT * FROM t_responden_dosen WHERE responden_nama = '$nama'";
    $result_dosen = $conn->query($sql_dosen);

    if ($result_dosen->num_rows > 0) {
        $row_dosen = $result_dosen->fetch_assoc();
        $nip = $row_dosen['responden_nip']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
        $unit = $row_dosen['responden_unit']; // Pastikan nama kolom sesuai dengan kolom dalam tabel
    }
}

// Tangani update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username_new = $_POST['username'];
    
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
                        $sql_update_user = "UPDATE m_user SET username = '$username_new', profile_image = '$profileImage' WHERE Nama = '$nama'";
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
    } else {
        // Update data di tabel m_user tanpa mengganti gambar profil
        $sql_update_user = "UPDATE m_user SET username = '$username_new' WHERE Nama = '$nama'";
        $conn->query($sql_update_user);
    }

    // Perbarui sesi username
    $_SESSION['username'] = $username_new;

    // Set pesan berhasil diperbarui dan redirect hanya jika tidak mengubah profile picture
    if (!$profileUpdated) {
        $_SESSION['update_success'] = true;
    }
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
            top: 10% !important; /* Jarak top 10% dengan !important */
            left: 50%;
            transform: translate(-50%, 0);
            background: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .overlay-content p {
            text-align: center; /* Pesan di tengah */
        }

        .overlay-content .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .button-container .yaTidak, .button-container .ok {
            padding: 10px 20px;
            background-color: lightblue;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container .ok {
            display: none;
        }
    </style>
</head>

<body>
    <?php include '../TemplateUser/headerUser.php'; ?>
    <div class="containerMainPP">
        <?php include '../TemplateUser/sidebarUser.php'; ?>
        <div class="containerKananPP">
        <form class="containerPP" id="profileForm" method="POST" action="profilPage.php" enctype="multipart/form-data">
                <input type="hidden" name="update_success" value="<?php echo $update_success ? 'true' : ''; ?>">
                
                <!-- Form fields -->
                
                <div class="ubahPassword">
                    <button type="button" name="ubahPassword" onclick="window.location.href='ubahPassword.php'">Ubah Password</button>
                </div>

                <div class="containerGP">
                    <div class="form-group">
                        <img src="<?php echo $profile_image_src; ?>" alt="Logo" class="logoPP" id="profilePicture">
                        <input type="file" id="profileImageInput" name="profile_image" style="display:none;" accept="image/*">
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-iconPP" onclick="document.getElementById('profileImageInput').click();">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $username; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="responden_nip">NIP:</label>
                    <input type="text" id="responden_nip" name="responden_nip" value="<?php echo $nip; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="responden_unit">Unit:</label>
                    <input type="text" id="responden_unit" name="responden_unit" value="<?php echo $unit; ?>" readonly>
                </div>

                <div class="simpan">
                    <button type="submit" name="simpan" id="simpanButton" disabled>
                        <img src="../../gambar/bookmark.png" alt="Simpan">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Overlay for confirmation and messages -->
    <div id="overlay" class="overlay">
        <div class="overlay-content">
            <p id="overlayMessage"></p>
            <div class="button-container">
                <button id="overlayConfirmButton" class="yaTidak">Ya</button>
                <button id="overlayCancelButton" class="yaTidak">Tidak</button>
                <button id="overlayOkButton" class="ok">OK</button>
            </div>
        </div>
    </div>

    <script>
        // Handle profile picture change confirmation
        document.getElementById('profileImageInput').addEventListener('change', function () {
            var overlay = document.getElementById('overlay');
            var overlayMessage = document.getElementById('overlayMessage');
            var overlayConfirmButton = document.getElementById('overlayConfirmButton');
            var overlayCancelButton = document.getElementById('overlayCancelButton');
            var overlayOkButton = document.getElementById('overlayOkButton');

            overlayMessage.textContent = 'Apakah Anda yakin ingin mengganti foto profil?';
            overlayConfirmButton.style.display = 'inline-block';
            overlayCancelButton.style.display = 'inline-block';
            overlayOkButton.style.display = 'none';
            overlay.style.display = 'block';

            overlayConfirmButton.onclick = function () {
                overlay.style.display = 'none';
                document.getElementById('profileForm').submit();
            };

            overlayCancelButton.onclick = function () {
                overlay.style.display = 'none';
                document.getElementById('profileImageInput').value = '';
            };
        });

        // Handle profile update confirmation
        function confirmProfileUpdate(event) {
            event.preventDefault();

            var overlay = document.getElementById('overlay');
            var overlayMessage = document.getElementById('overlayMessage');
            var overlayConfirmButton = document.getElementById('overlayConfirmButton');
            var overlayCancelButton = document.getElementById('overlayCancelButton');
            var overlayOkButton = document.getElementById('overlayOkButton');

            overlayMessage.textContent = 'Apakah Anda yakin ingin memperbarui profil?';
            overlayConfirmButton.style.display = 'inline-block';
            overlayCancelButton.style.display = 'inline-block';
            overlayOkButton.style.display = 'none';
            overlay.style.display = 'block';

            overlayConfirmButton.onclick = function () {
                overlay.style.display = 'none';
                document.getElementById('profileForm').submit();
            };

            overlayCancelButton.onclick = function () {
                overlay.style.display = 'none';
            };
        }

        <?php if (isset($_SESSION['response'])): ?>
            // Display overlay message for response
            document.addEventListener('DOMContentLoaded', function () {
                var overlay = document.getElementById('overlay');
                var overlayMessage = document.getElementById('overlayMessage');
                var overlayConfirmButton = document.getElementById('overlayConfirmButton');
                var overlayCancelButton = document.getElementById('overlayCancelButton');
                var overlayOkButton = document.getElementById('overlayOkButton');

                overlayMessage.textContent = '<?php echo $_SESSION['response']['message']; ?>';
                overlayConfirmButton.style.display = 'none';
                overlayCancelButton.style.display = 'none';
                overlayOkButton.style.display = 'inline-block';
                overlay.style.display = 'block';

                overlayOkButton.onclick = function () {
                    overlay.style.display = 'none';
                };
            });
            <?php unset($_SESSION['response']); ?>
        <?php endif; ?>

    </script>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>
