<!-- Praktikum 4 Jobhseet 9 Langkah 3 -->
<?php
    // Mengimpor file koneksi.php yang berisi informasi koneksi ke database
    include "koneksi.php";

    // Mengambil nilai username dan password dari form yang dikirimkan melalui metode POST
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Melakukan hashing terhadap password menggunakan md5

    // Membuat query untuk melakukan seleksi data user berdasarkan username dan password
    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    
    // Menjalankan query
    $result = mysqli_query($connect, $query);
    
    // Mengambil baris hasil query sebagai array asosiatif
    $row = mysqli_fetch_assoc($result);

    // Memeriksa level user dan memberikan respon sesuai dengan level tersebut
    if ($row['level'] == 1) {
        // Jika level user adalah 1 (admin), menampilkan pesan berhasil login dan memberikan tautan menuju halaman home admin
        echo "Anda berhasil login. silahkan menuju"; ?>
        <a href="homeAdmin.html">Halaman HOME</a>
    <?php
    } else if ($row['level'] == 2) {
        // Jika level user adalah 2 (guest), menampilkan pesan berhasil login dan memberikan tautan menuju halaman home guest
        echo "Anda berhasil login. silahkan menuju"; ?>
        <a href="homeGuest.html">Halaman HOME</a>
    <?php
    } else {
        // Jika level user tidak ditemukan atau tidak valid, menampilkan pesan gagal login dan memberikan tautan untuk login kembali
        echo "Anda gagal login. silahkan "; ?>
        <a href="loginForm1.html">Login Kembali</a>
    <?php
        // Menampilkan pesan error dari MySQL jika terjadi
        echo mysqli_error($connect);
    }
?>