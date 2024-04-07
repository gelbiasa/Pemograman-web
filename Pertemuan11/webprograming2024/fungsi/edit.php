<?php
session_start();
// Memeriksa apakah sesi username tidak kosong
if (!empty($_SESSION['username'])) {
    // Memasukkan file koneksi.php untuk menghubungkan ke database
    require '../config/koneksi.php';
    // Memasukkan file pesan_kilat.php yang berisi fungsi untuk menampilkan pesan kilat
    require '../fungsi/pesan_kilat.php';
    // Memasukkan file anti_injection.php yang berisi fungsi untuk mencegah serangan injection
    require '../fungsi/anti_injection.php';
    // Memeriksa apakah terdapat parameter jabatan dalam URL
    if (!empty($_GET['jabatan'])) {
        // Mengamankan id dari serangan injection
        $id = antiinjection($koneksi, $_POST['id']);
        // Mengamankan data jabatan dari serangan injection
        $jabatan = antiinjection($koneksi, $_POST['jabatan']);
        // Mengamankan keterangan jabatan dari serangan injection
        $keterangan = antiinjection($koneksi, $_POST['keterangan']);
        // Query untuk mengupdate data jabatan berdasarkan id
        $query = "UPDATE jabatan SET jabatan = '$jabatan', keterangan = '$keterangan' WHERE id = '$id'";
        // Menjalankan query dan menampilkan pesan berhasil atau gagal
        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Jabatan Telah Diubah.");
        } else {
            pesan('danger', "Mengubah Jabatan Karena: " . mysqli_error($koneksi));
        }
        // Mengarahkan pengguna kembali ke halaman jabatan setelah mengubah data
        header("Location: ../index.php?page=jabatan");
    } elseif (!empty($_GET['anggota'])) {
        // Mengamankan id anggota dari serangan injection
        $user_id = antiinjection($koneksi, $_POST['id']);
        // Mengamankan data nama anggota dari serangan injection
        $nama = antiinjection($koneksi, $_POST['nama']);
        // Mengamankan data jabatan anggota dari serangan injection
        $jabatan = antiinjection($koneksi, $_POST['jabatan']);
        // Mengamankan data jenis kelamin anggota dari serangan injection
        $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
        // Mengamankan data alamat anggota dari serangan injection
        $alamat = antiinjection($koneksi, $_POST['alamat']);
        // Mengamankan data nomor telepon anggota dari serangan injection
        $no_telp = antiinjection($koneksi, $_POST['no_telp']);
        // Mengamankan data username anggota dari serangan injection
        $username = antiinjection($koneksi, $_POST['username']);
        // Query untuk mengupdate data anggota berdasarkan id
        $query_anggota = "UPDATE anggota SET nama = '$nama', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', no_telp = '$no_telp', jabatan_id = '$jabatan' WHERE user_id = '$user_id'";
        if (mysqli_query($koneksi, $query_anggota)) {
            // Memeriksa apakah password kosong atau tidak
            if (!empty($_POST['password'])) {
                // Mengamankan password anggota dari serangan injection
                $password = $_POST['password'];
                // Generate random salt
                $salt = bin2hex(random_bytes(16));
                // Gabungkan salt dengan password
                $combined_password = $salt . $password;
                // Hash password dengan salt
                $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);
                // Query untuk mengupdate data password anggota berdasarkan id
                $query_user = "UPDATE user SET username = '$username', password = '$hashed_password', salt = '$salt' WHERE id = '$user_id'";
                if (mysqli_query($koneksi, $query_user)) {
                    pesan('success', "Anggota Telah Diubah.");
                } else {
                    pesan('warning', "Data Anggota Berhasil Diubah, Tetapi Password Gagal Diubah Karena: " . mysqli_error($koneksi));
                }
            } else {
                // Jika password kosong, hanya mengupdate username
                $query_user = "UPDATE user SET username = '$username' WHERE id = '$user_id'";
                if (mysqli_query($koneksi, $query_user)) {
                    pesan('success', "Anggota Telah Diubah.");
                } else {
                    pesan('warning', "Data Anggota Berhasil Diubah, Tetapi Username Gagal Diubah Karena: " . mysqli_error($koneksi));
                }
            }
        } else {
            pesan('danger', "Mengubah Anggota Karena: " . mysqli_error($koneksi));
        }
        // Mengarahkan pengguna kembali ke halaman anggota setelah mengubah data
        header("Location: ../index.php?page=anggota");
    }
}
?>
