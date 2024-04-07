<!-- Praktikum 4. Folder Module – Bagian Jabatan Langkah 10 edit.php -->
<?php
session_start();
// Memeriksa apakah sesi username tidak kosong
if(!empty($_SESSION['username'])){
    // Memasukkan file koneksi.php untuk menghubungkan ke database
    require '../config/koneksi.php';
    // Memasukkan file pesan_kilat.php yang berisi fungsi untuk menampilkan pesan kilat
    require '../fungsi/pesan_kilat.php';
    // Memasukkan file anti_injection.php yang berisi fungsi untuk mencegah serangan injection
    require '../fungsi/anti_injection.php';
    // Memeriksa apakah terdapat parameter jabatan dalam URL
    if(!empty($_GET['jabatan'])){
        // Mengamankan id dari serangan injection
        $id = antiinjection($koneksi, $_POST['id']);
        // Mengamankan data jabatan dari serangan injection
        $jabatan = antiinjection($koneksi, $_POST['jabatan']);
        // Mengamankan keterangan jabatan dari serangan injection
        $keterangan = antiinjection($koneksi, $_POST['keterangan']);
        // Query untuk mengupdate data jabatan berdasarkan id
        $query = "UPDATE jabatan SET jabatan = '$jabatan',keterangan = '$keterangan' WHERE id = '$id'";
        // Menjalankan query dan menampilkan pesan berhasil atau gagal
        if(mysqli_query($koneksi, $query)){
            pesan('success', "Jabatan Telah Diubah.");
        } else {
            pesan('danger', "Mengubah Jabatan Karena: " .mysqli_error($koneksi));
        }
        // Mengarahkan pengguna kembali ke halaman jabatan setelah mengubah data
        header("Location: ../index.php?page=jabatan");
    }
}
?>