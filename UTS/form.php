<?php
require_once("session.php");
require_once("cookies.php");

// Simulasi database
$valid_username = "Gelby";
$valid_password = "321";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $valid_username && $password === $valid_password) {
        // Set cookie untuk menyimpan informasi login
        // berarti pengguna akan tetap login selama 30 hari ke depan,
        set_cookie("username", $username, time() + (86400 * 30), "/");

        // Set session untuk menyimpan informasi login
        // akan menyimpan nama pengguna dalam sesi server dengan kunci "username".
        set_session("username", $username);

        // Redirect ke halaman beranda setelah login berhasil
        echo "home.php";
    } else {
        http_response_code(401);
    }
}
?>