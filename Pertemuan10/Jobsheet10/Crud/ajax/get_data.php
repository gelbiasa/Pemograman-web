<!-- Praktikum 6. Tampilan CRUD dengan Ajax -->
<?php
// Memulai sesi PHP
session_start();

// Mengimpor koneksi database dan skrip CSRF protection
include 'koneksi.php';
include 'csrf.php';

// Mengambil ID dari data yang akan diambil dari database
$id = $_POST['id'];

// Query untuk mengambil data anggota berdasarkan ID
$query = "SELECT * FROM anggota WHERE id=? ORDER BY id DESC";

// Persiapan query
$sql = $db1->prepare($query);
$sql->bind_param('i', $id);
$sql->execute();

// Mendapatkan hasil query dalam bentuk result set
$res1 = $sql->get_result();

// Menginisialisasi array asosiatif untuk menampung data anggota
$h = array();

// Mengambil data dari result set dan menyimpannya dalam array asosiatif
while ($row = $res1->fetch_assoc()) {
    $h['id'] = $row["id"];
    $h['nama'] = $row["nama"];
    $h['jenis_kelamin'] = $row["jenis_kelamin"];
    $h['alamat'] = $row["alamat"];
    $h['no_telp'] = $row["no_telp"];
}

// Mengembalikan data dalam format JSON
echo json_encode($h);

// Menutup koneksi database
$db1->close();
?>