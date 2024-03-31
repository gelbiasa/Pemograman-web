<!-- Praktikum 10 Jobhseet 9 Langkah 5 -->
<html>
    <body>
        <?php
            // Memulai sesi atau mengaktifkan sesi yang ada
            session_start();
            
            // Memeriksa apakah status login dari pengguna adalah 'login'
            if ($_SESSION['status'] == 'login') {
                // Jika sudah login, menampilkan pesan selamat datang beserta username pengguna
                echo "Selamat datang " . $_SESSION['username'];
                ?>
                <!-- Menampilkan tautan untuk logout -->
                <br><a href="sessionLogout.php">Log Out</a>
                <?php
            } else {
                // Jika belum login, menampilkan pesan yang mengarahkan pengguna untuk login
                echo "Anda belum login. Silahkan" ?>
                <!-- Menampilkan tautan untuk login -->
                <a href="sessionLoginForm.html">Log In</a>
                <?php
            }
        ?>
    </body>
</html>