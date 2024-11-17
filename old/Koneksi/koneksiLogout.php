<?php
session_start(); // Mulai sesi jika belum

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Kembalikan respon untuk menunjukkan bahwa logout berhasil
echo "logout_success";
?>
