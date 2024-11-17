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

// Tangani update password jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $verifikasi_password_baru = $_POST['verifikasi_password_baru'];

    // Ambil password pengguna dari database
    $sql_user = "SELECT * FROM m_user WHERE username = '$username'";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows > 0) {
        $row_user = $result_user->fetch_assoc();
        $password_db = $row_user['password'];

        // Verifikasi password lama
        if ($password_lama !== $password_db) {
            $_SESSION['error_message'] = "Password lama anda salah.";
        } elseif ($password_baru !== $verifikasi_password_baru) {
            $_SESSION['error_message'] = "Verifikasi password tidak sesuai.";
        } else {
            // Update password baru
            $sql_update_password = "UPDATE m_user SET password = '$password_baru' WHERE username = '$username'";
            if ($conn->query($sql_update_password) === TRUE) {
                $_SESSION['success_message'] = "Password berhasil diperbaharui.";
            } else {
                $_SESSION['error_message'] = "Terjadi kesalahan saat memperbarui password.";
            }
        }
    }

    // Redirect ke halaman yang sama untuk mencegah form resubmission
    header("Location: ubahPassword.php");
    exit();
}

// Tutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../script.js"></script>
</head>
<body class="backgroundRegister">
    <!-- Konten Anda -->
    <?php include '../TemplateUser/headerUser.php'; ?>

    <div class="Register-container">
        <button type="button" class="btn-back_regis" onclick="window.history.back();">Back</button>
        <h2 class="UB">Perbaharuan Password</h2>
        <form method="POST" action="ubahPassword.php">
            <div class="form-group">
                <label for="password_lama">Masukkan Password Lama:</label>
                <div class="password-wrapper">
                    <input type="password" id="password_lama" name="password_lama" required>
                    <span class="password-toggle" onclick="togglePasswordUP('password_lama')">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="password_baru">Masukkan Password Baru:</label>
                <div class="password-wrapper">
                    <input type="password" id="password_baru" name="password_baru" required>
                    <span class="password-toggle" onclick="togglePasswordUP('password_baru')">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="verifikasi_password_baru">Verifikasi Password Baru:</label>
                <div class="password-wrapper">
                    <input type="password" id="verifikasi_password_baru" name="verifikasi_password_baru" required>
                    <span class="password-toggle" onclick="togglePasswordUP('verifikasi_password_baru')">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="simpanPassword">
                <button type="submit" name="simpan" id="simpanButton" disabled>
                    <img src="../../gambar/bookmark.png" alt="Simpan">Simpan Password
                </button>
            </div>
        </form>
    </div>

    <!-- Overlay untuk pesan -->
    <div id="overlay">
        <div class="overlay-content">
            <span class="close-overlay"><i class="fas fa-times"></i></span>
            <div id="overlay-message"></div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Fungsi untuk menampilkan overlay pesan kesalahan atau berhasil
            function showOverlay(message, isError = true) {
                var content = '<div class="overlay-content ' + (isError ? 'error-message' : 'success-message') + '">' +
                    '<h2><i class="fas ' + (isError ? 'fa-exclamation-circle' : 'fa-check-circle') + '"></i> ' + (isError ? 'Terjadi Kesalahan/Error' : 'Berhasil') + '</h2>' +
                    '<p>' + message + '</p>' +
                    '<span class="close-overlay"><i class="fas fa-times"></i></span>' +
                    '</div>';

                $('#overlay').fadeIn();
                $('#overlay').html(content);
                $('#overlay').find('.overlay-content').fadeIn();
            }

            // Fungsi untuk menutup overlay saat tombol close di klik
            $(document).on('click', '.close-overlay', function () {
                $('#overlay').fadeOut();
            });

            // Tampilkan pesan kesalahan atau berhasil jika ada
            <?php if (isset($_SESSION['error_message'])) : ?>
                showOverlay("<?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>", true);
            <?php endif; ?>
            <?php if (isset($_SESSION['success_message'])) : ?>
                showOverlay("<?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>", false);
                setTimeout(function () {
                    window.location.href = 'profilPage.php';
                }, 3000);
            <?php endif; ?>
        });
    </script>
</body>
</html>
