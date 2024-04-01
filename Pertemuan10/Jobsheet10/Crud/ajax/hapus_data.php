<!-- Praktikum 6. Tampilan CRUD dengan Ajax -->
<?php
// Memulai sesi PHP
session_start();

// Mengimpor koneksi database dan skrip CSRF protection
include 'koneksi.php'; 
include 'csrf.php';

// Mengambil ID dari data yang akan dihapus dari database
$id = $_POST['id'];

// Query untuk menghapus data anggota berdasarkan ID
$query = "DELETE FROM anggota WHERE id=?"; 

// Persiapan query
$sql = $db1->prepare($query);
$sql->bind_param("i", $id); 
$sql->execute();

// Mengembalikan respons sukses dalam format JSON
echo json_encode(['success' => 'Sukses']);

// Menutup koneksi database
$db1->close();
?>