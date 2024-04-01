<!-- Praktikum 6. Tampilan CRUD dengan Ajax -->
<?php
// Memulai sesi PHP
session_start();

// Mengimpor koneksi database dan skrip CSRF protection
include 'koneksi.php';
include 'csrf.php';

// Mengambil data dari form dan membersihkannya dari karakter khusus
$id = stripslashes(strip_tags(htmlspecialchars($_POST['id'], ENT_QUOTES)));
$nama = stripslashes(strip_tags(htmlspecialchars($_POST['nama'], ENT_QUOTES)));
$jenis_kelamin = stripslashes(strip_tags(htmlspecialchars($_POST['jenis_kelamin'], ENT_QUOTES)));
$alamat = stripslashes(strip_tags(htmlspecialchars($_POST['alamat'], ENT_QUOTES)));
$no_telp = stripslashes(strip_tags(htmlspecialchars($_POST['no_telp'], ENT_QUOTES)));

// Memeriksa apakah ID kosong, jika iya maka melakukan operasi INSERT, jika tidak maka melakukan operasi UPDATE
if ($id == "") {
    // Query untuk INSERT data baru
    $query = "INSERT into anggota (nama, jenis_kelamin, alamat, no_telp) VALUES (?, ?, ?, ?)";
    // Persiapan query
    $sql = $db1->prepare($query);
    // Binding parameter dan eksekusi query
    $sql->bind_param("ssss", $nama, $jenis_kelamin, $alamat, $no_telp);
    $sql->execute();
} else {
    // Query untuk UPDATE data yang sudah ada
    $query = "UPDATE anggota SET nama=?, jenis_kelamin=?, alamat=?, no_telp=? WHERE id=?";
    // Persiapan query
    $sql = $db->prepare($query);
    // Binding parameter dan eksekusi query
    $sql->bind_param("ssssi", $nama, $jenis_kelamin, $alamat, $no_telp, $id);
    $sql->execute();
}

// Mengembalikan respon sukses dalam format JSON
echo json_encode(['success' => 'Sukses']);

// Menutup koneksi database
$db1->close();
?>