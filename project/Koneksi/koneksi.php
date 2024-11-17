<?php
// Database configuration
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "surveypolinema";

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Check connection
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>