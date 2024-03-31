<!-- Praktikum 10 Jobhseet 9 Langkah 4 -->
<?php
    // Mengimpor file koneksi.php yang berisi informasi koneksi ke database
    include 'koneksi.php';
    
    // Mengambil nilai username dan password dari form yang dikirimkan melalui metode POST
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Melakukan hashing terhadap password menggunakan md5
    
    // Membuat query untuk melakukan seleksi data user berdasarkan username dan password
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    
    // Menjalankan query
    $result = mysqli_query($connect, $sql);
    
    // Menghitung jumlah baris hasil query
    $cek = mysqli_num_rows($result);
    
    // Memeriksa apakah terdapat baris yang sesuai dengan username dan password yang dimasukkan
    if ($cek > 0) {
        // Jika ada, memulai sesi dan menyimpan informasi username serta status login dalam variabel sesi
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        ?>
        <!-- Menampilkan pesan berhasil login dan memberikan tautan menuju halaman home -->
        Anda berhasil Login, silahkan menuju
        <a href="homeSession.php">Halaman Home</a>
        <?php
    } else {
        ?>
        <!-- Menampilkan pesan gagal login dan memberikan tautan untuk login kembali -->
        Gagal login, silahkan login lagi
        <a href="sessionLoginForm.html">Halaman Login</a>
        <?php
        // Menampilkan pesan error dari MySQL jika terjadi
        echo mysqli_error($connect);
    }
?>