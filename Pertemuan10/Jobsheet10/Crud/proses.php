<!-- Praktikum 2 -->
<?php
// Menghubungkan dengan database
include('koneksi.php');

// Mendapatkan aksi yang dikirimkan melalui parameter GET
$aksi = $_GET['aksi'];

// Mendapatkan data dari form tambah/ubah
$nama = $_POST['nama'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$no_telp = $_POST['no_telp'];

// Jika aksi adalah tambah
if ($aksi == 'tambah'){
    // Query untuk menambah data anggota ke dalam database
    $query = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp) 
              VALUES ('$nama', '$jenis_kelamin', '$alamat', '$no_telp')";
            
    // Menjalankan query dan mengecek apakah berhasil
    if (mysqli_query($koneksi, $query)){
        // Jika berhasil, redirect ke halaman utama
        header("Location: index.php");
        exit();
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Gagal menambahkan data: " . mysqli_error($koneksi);
    }
    // Praktikum 3
} else if ($aksi == 'ubah'){
    // Jika aksi adalah ubah
    if (isset($_POST['id'])) {
        // Mendapatkan ID data yang akan diubah
        $id = $_POST['id'];

        // Query untuk mengubah data anggota dalam database
        $query = "UPDATE anggota SET nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat', no_telp='$no_telp' WHERE id='$id'";
        
        // Menjalankan query dan mengecek apakah berhasil
        if (mysqli_query($koneksi, $query)){
            // Jika berhasil, redirect ke halaman utama
            header("Location: index.php");
            exit();
        } else {
            // Jika gagal, tampilkan pesan error
            echo "Gagal mengupdate data: " . mysqli_error($koneksi);
        }
    } else {
        // Jika ID tidak valid, tampilkan pesan
        echo "ID tidak valid.";
    } 
    // Praktikum 4
} else if ($aksi == 'hapus'){
    // Jika aksi adalah hapus
    if (isset($_GET['id'])) {
        // Mendapatkan ID data yang akan dihapus
        $id = $_GET['id'];

        // Query untuk menghapus data anggota dari database
        $query = "DELETE FROM anggota WHERE id='$id'";

        // Menjalankan query dan mengecek apakah berhasil
        if (mysqli_query($koneksi, $query)){
            // Jika berhasil, redirect ke halaman utama
            header("Location: index.php");
            exit();
        } else {
            // Jika gagal, tampilkan pesan error
            echo "Gagal menghapus data: " . mysqli_error($koneksi);
        }
        // Jika ID tidak valid, tampilkan pesan
        echo "ID tidak valid.";
    }
} else {
    // Jika aksi tidak valid, redirect ke halaman utama
    header("Location: index.php");
}

// Menutup koneksi dengan database
mysqli_close($koneksi);
?>
