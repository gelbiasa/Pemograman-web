<!-- Praktikum 2 Jobhseet 9 Langkah 3 -->
<?php
    // Mengimpor file koneksi.php yang berisi informasi koneksi ke database
    include "koneksi.php";

    // Mengambil nilai username dan password dari form yang dikirimkan melalui metode POST
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Melakukan hashing terhadap password menggunakan md5
    
    // Membuat query untuk melakukan seleksi data user berdasarkan username dan password
    $query = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
    
    // Menjalankan query
    $result = mysqli_query($connect, $query);
    
    // Menghitung jumlah baris hasil query
    $cek = mysqli_num_rows($result);
    
    // Memeriksa apakah ada hasil dari query
    if ($cek) {
        // Jika ada hasil dari query, menampilkan pesan berhasil login dan memberikan tautan menuju halaman home
        echo "Anda berhasil login. Silahkan menuju "; 
?>
        <a href="homeAdmin.html">Halaman HOME</a>
<?php
    } else {
        // Jika tidak ada hasil dari query, menampilkan pesan gagal login dan memberikan tautan menuju halaman login kembali
        echo "Anda gagal login. Silahkan "; 
?>
        <a href="loginForm.html">Login kembali</a>
<?php
        // Menampilkan pesan error dari MySQL jika terjadi
        echo mysqli_error($connect);
    }    
?>