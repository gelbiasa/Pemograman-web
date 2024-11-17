<?php
session_start();
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
    <script src="/../script.js"></script>
</head>

<body class="backgroundRegister">
    <!-- Konten Anda -->
    <?php include '../Template/header.php'; ?>

    <div class="Register-container">
        <h2 class="h2R">Registrasi</h2>
        <p>Silakan isi formulir registrasi di sini.</p>

        <!-- Formulir Registrasi -->
        <form action="../Koneksi/koneksiRegistrasi.php" method="post" class="form-registrasi" id="register">

            <div class="form-group">
                <img src="../gambar/polinema.png" alt="Logo" class="logoR">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required>
                    <span class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="user_status">Status:</label>
                <select id="user_status" name="user_status" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                    <option value="Orang Tua">Orang Tua</option>
                    <option value="Alumni">Alumni</option>
                    <option value="Industri">Industri</option>
                </select>
            </div>

            <button type="submit" id="registerButton">Next</button>
        </form>
    </div>
    </div>

</body>

</html>
