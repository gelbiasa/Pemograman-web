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

    $sql_ortu = "SELECT * FROM t_responden_ortu WHERE responden_nama = '$nama'";
    $result_ortu = $conn->query($sql_ortu);

    if ($result_ortu->num_rows > 0) {
        $row_ortu = $result_ortu->fetch_assoc();

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

    $sql_update_ortu = "UPDATE t_responden_ortu SET responden_umur = '$umur_new', responden_hp = '$hp_new', responden_pendidikan = '$pendidikan_new', 
    responden_pekerjaan = '$pekerjaan_new', responden_penghasilan = '$penghasilan_new' WHERE responden_nama = '$nama'";
    $conn->query($sql_update_ortu);

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

                <div class="ubahPassword">
                    <button type="button" name="ubahPassword" onclick="window.location.href='ubahPassword.php'">Ubah
                        Password</button>
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
                    <label for="responden_jk">Jenis Kelamin:</label>
                    <input type="text" id="responden_jk" name="responden_jk" value="<?php echo $jk; ?>" readonly>
                </div>

                <div class="input-groupPP">
                    <label for="responden_umur">Umur:</label>
                    <div class="input-container">
                        <input type="text" id="responden_umur" name="responden_umur" value="<?php echo $umur; ?>"
                            readonly>
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
                        <input type="text" id="responden_pendidikan" name="responden_pendidikan"
                            value="<?php echo $pendidikan; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_pendidikan')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_pekerjaan">Pekerjaan:</label>
                    <div class="input-container">
                        <input type="text" id="responden_pekerjaan" name="responden_pekerjaan"
                            value="<?php echo $pekerjaan; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_pekerjaan')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="responden_penghasilan">Penghasilan:</label>
                    <div class="input-container">
                        <input type="text" id="responden_penghasilan" name="responden_penghasilan"
                            value="<?php echo $penghasilan; ?>" readonly>
                        <img src="../../gambar/edit_icon.png" alt="Edit" class="edit-icon"
                            onclick="toggleEdit('responden_penghasilan')">
                    </div>
                </div>

                <div class="input-groupPP">
                    <label for="mahasiswa_nim">Mahasiswa NIM:</label>
                    <input type="text" id="mahasiswa_nim" name="mahasiswa_nim" value="<?php echo $mahasiswa_nim; ?>"
                        readonly>
                </div>

                <div class="input-groupPP">
                    <label for="mahasiswa_nama">Mahasiswa Nama:</label>
                    <input type="text" id="mahasiswa_nama" name="mahasiswa_nama" value="<?php echo $mahasiswa_nama; ?>"
                        readonly>
                </div>

                <div class="input-groupPP">
                    <label for="mahasiswa_prodi">Mahasiswa Prodi:</label>
                    <input type="text" id="mahasiswa_prodi" name="mahasiswa_prodi"
                        value="<?php echo $mahasiswa_prodi; ?>" readonly>
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