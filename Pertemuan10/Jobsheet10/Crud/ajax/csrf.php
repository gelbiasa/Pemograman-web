<!-- Praktikum 6. Tampilan CRUD dengan Ajax -->
<?php
// Mengatur tipe konten sebagai JSON
header('Content-Type: application/json');

// Mengirimkan Token Keamanan
if (empty($_SESSION['csrf_token'])) {
    // Generate CSRF token jika belum ada
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Mendapatkan header HTTP
$headers = apache_request_headers();

// Memeriksa apakah header CSRF-Token ada
if (isset($headers['csrf-Token'])) {
    // Memeriksa kesesuaian CSRF token dari header dengan yang disimpan di sesi
    if ($headers['csrf-Token'] !== $_SESSION['csrf_token']) {
        // Jika token tidak cocok, keluarkan pesan kesalahan JSON
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
} else {
    // Jika header CSRF-Token tidak ada, keluarkan pesan kesalahan JSON
    exit(json_encode(['error' => 'No CSRF token.']));
}
?>