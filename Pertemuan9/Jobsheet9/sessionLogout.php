<!-- Praktikum 10 Jobhseet 9 Langkah 6 -->
<?php
    // Memulai sesi atau mengaktifkan sesi yang ada
    session_start();
    
    // Mengakhiri sesi pengguna dan menghapus semua data sesi yang terkait
    session_destroy();
    
    // Menampilkan pesan bahwa pengguna berhasil logout
    echo "Anda berhasil logout";
?>