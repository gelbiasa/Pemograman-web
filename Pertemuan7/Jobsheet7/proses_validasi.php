<!-- Praktikum 7 : Validasi Form -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari formulir
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = array();

    // validasi nama
    if (empty($nama)) {
        $errors[] = "Nama harus diisi";
    }

    // validasi email
    if (empty($email)) {
        $errors[] = "Email harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    // validasi password
    if (empty($password)) {
        $errors[] = "Password harus diisi";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter";
    }

    // jika ada kesalahan variabel
    if (!empty($errors)) {
        // Menampilkan pesan kesalahan
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        // Menampilkan data yang berhasil dikirim jika tidak ada kesalahan
        echo "Data berhasil dikirim:<br> Nama = $nama <br> Email = $email<br> Password = $password";
    }
}
?>