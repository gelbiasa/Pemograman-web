<?php
class Database {
    private $servername = "localhost";
    private $username_db = "root";
    private $password_db = "";
    private $database = "surveypolinema";
    public $conn;

    public function __construct() {
        // Buat koneksi
        $this->conn = new mysqli($this->servername, $this->username_db, $this->password_db, $this->database);

        // Periksa koneksi
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function fetchAssoc($result) {
        return $result->fetch_assoc();
    }

    public function close() {
        $this->conn->close();
    }
}
?>
