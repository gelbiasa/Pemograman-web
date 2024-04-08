<!-- Jobsheet 12 Praktikum 2. CRUD dengan OOP Langkah 4 -->
<?php
// Menyediakan operasi CRUD untuk entitas 'jabatan' dalam database menggunakan objek Database untuk koneksi
require_once 'Database.php'; // Memasukkan file Database.php yang berisi kelas Database untuk koneksi ke database

class Crud
{
    private $db; // Properti untuk menyimpan objek Database untuk koneksi ke database

    // Konstruktor untuk menginisialisasi objek Database saat objek Crud dibuat
    public function __construct()
    {
        $this->db = new Database(); // Membuat objek Database untuk koneksi ke database
    }

    // Operasi Create: Menambahkan data jabatan baru ke dalam database
    public function create($jabatan, $keterangan)
    {
        // Query untuk menambahkan data baru ke dalam tabel 'jabatan'
        $query = "INSERT INTO jabatan (jabatan, keterangan) VALUES ('$jabatan', '$keterangan')";
        $result = $this->db->conn->query($query); // Menjalankan query menggunakan objek koneksi Database
        return $result; // Mengembalikan hasil eksekusi query
    }

    // Operasi Read: Membaca semua data jabatan dari database
    public function read()
    {
        // Query untuk membaca semua data dari tabel 'jabatan'
        $query = "SELECT * FROM jabatan";
        $result = $this->db->conn->query($query); // Menjalankan query menggunakan objek koneksi Database

        $data = []; // Array untuk menyimpan hasil data
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row; // Menambahkan setiap baris data ke dalam array $data
            }
        }
        return $data; // Mengembalikan data yang telah dibaca
    }

    // Operasi Read By Id: Membaca data jabatan berdasarkan ID dari database
    public function readById($id)
    {
        // Query untuk membaca data jabatan berdasarkan ID
        $query = "SELECT * FROM jabatan WHERE id = $id";
        $result = $this->db->conn->query($query); // Menjalankan query menggunakan objek koneksi Database
        if ($result->num_rows == 1) {
            return $result->fetch_assoc(); // Mengembalikan hasil data dalam bentuk array jika data ditemukan
        } else {
            return null; // Mengembalikan null jika data tidak ditemukan
        }
    }

    // Operasi Update: Memperbarui data jabatan berdasarkan ID di dalam database
    public function update($id, $jabatan, $keterangan)
    {
        // Query untuk memperbarui data jabatan berdasarkan ID
        $query = "UPDATE jabatan SET jabatan = '$jabatan', keterangan = '$keterangan' WHERE id = $id";
        $result = $this->db->conn->query($query); // Menjalankan query menggunakan objek koneksi Database

        return $result; // Mengembalikan hasil eksekusi query
    }

    // Operasi Delete: Menghapus data jabatan berdasarkan ID dari database
    public function delete($id)
    {
        // Query untuk menghapus data jabatan berdasarkan ID
        $query = "DELETE FROM jabatan WHERE id = $id";
        $result = $this->db->conn->query($query); // Menjalankan query menggunakan objek koneksi Database
    }
}
?>