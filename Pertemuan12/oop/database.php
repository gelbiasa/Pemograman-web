<!-- Jobsheet 12 Praktikum 2. CRUD dengan OOP Langkah 2 -->
<?php
// Mengelola koneksi ke database MySQL serta menginisialisasi koneksi saat objek dibuat
class Database
{
    private $host = "localhost"; // Properti untuk menyimpan nama host MySQL
    private $username = "root"; // Properti untuk menyimpan nama pengguna MySQL
    private $password = ""; // Properti untuk menyimpan kata sandi MySQL
    private $database = "prakwebdb"; // Properti untuk menyimpan nama database MySQL
    public $conn; // Properti untuk menyimpan objek koneksi mysqli

    // Konstruktor untuk menginisialisasi koneksi ke database saat objek dibuat
    public function __construct()
    {
        // Membuat objek koneksi mysqli dengan menggunakan informasi host, pengguna, kata sandi, dan database
        $this->conn = new mysqli($this -> host, $this -> username, $this -> password, $this->database);

        // Memeriksa apakah terjadi kesalahan saat membuat koneksi
        if ($this -> conn -> connect_error) {
            // Jika terjadi kesalahan, hentikan program dan tampilkan pesan kesalahan
            die("connection failed: " . $this -> conn -> connect_error);
        }
    }
}
?>