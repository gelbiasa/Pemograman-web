<?php
session_start();

// Mendapatkan data dari session jika ada
$username_value = isset($_SESSION['form_data']['username']) ? $_SESSION['form_data']['username'] : '';
$password_value = isset($_SESSION['form_data']['password']) ? $_SESSION['form_data']['password'] : '';
$nama_value = isset($_SESSION['form_data']['nama']) ? $_SESSION['form_data']['nama'] : '';
$user_status_value = isset($_SESSION['form_data']['user_status']) ? $_SESSION['form_data']['user_status'] : '';
$is_username_error = isset($_SESSION['username_error']) ? $_SESSION['username_error'] : false;

unset($_SESSION['form_data']);
unset($_SESSION['username_error']);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Sertakan jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Sertakan script.js -->
    <script src="../script.js"></script>
</head>

<body class="backgroundRegister">
    <!-- Konten Anda -->
    <?php include '../Template/header.php'; ?>

    <div class="Register-container">
        <button class="btn-back_regis" onclick="window.location.href='../index.html'">Back</button>
        <h2 class="h2R">Registrasi</h2>
        <p>Silakan isi formulir registrasi di sini.</p>

        <!-- Formulir Registrasi -->
        <form action="../Koneksi/koneksiRegistrasi.php" method="post" class="form-registrasi" id="register">

            <div class="form-group">
                <img src="../gambar/polinema.png" alt="Logo" class="logoR">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username_value); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password_value); ?>" required>
                    <span class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama_value); ?>" required>
            </div>

            <div class="form-group">
                <label for="user_status">Status:</label>
                <select id="user_status" name="user_status" required>
                    <option value="" disabled <?php echo empty($user_status_value) ? 'selected' : ''; ?>>Pilih Status</option>
                    <option value="Mahasiswa" <?php echo $user_status_value == 'Mahasiswa' ? 'selected' : ''; ?>>Mahasiswa</option>
                    <option value="Dosen" <?php echo $user_status_value == 'Dosen' ? 'selected' : ''; ?>>Dosen</option>
                    <option value="Tenaga Pendidik" <?php echo $user_status_value == 'Tenaga Pendidik' ? 'selected' : ''; ?>>Tenaga Pendidik</option>
                    <option value="Orang Tua" <?php echo $user_status_value == 'Orang Tua' ? 'selected' : ''; ?>>Orang Tua</option>
                    <option value="Alumni" <?php echo $user_status_value == 'Alumni' ? 'selected' : ''; ?>>Alumni</option>
                    <option value="Industri" <?php echo $user_status_value == 'Industri' ? 'selected' : ''; ?>>Industri</option>
                </select>
            </div>
            <div class="registrasi button">
                <button type="submit" id="registerButton">Next</button>
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
            function showOverlayRegis(message, isError = true) {
                var content = '<div class="overlay-content ' + (isError ? 'error-messageRegis' : 'success-message') + '">' +
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
                showOverlayRegis("<?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>", true);
            <?php endif; ?>
            <?php if (isset($_SESSION['success_message'])) : ?>
                showOverlayRegis("<?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>", false);
            <?php endif; ?>
        });
    </script>
</body>

</html>
