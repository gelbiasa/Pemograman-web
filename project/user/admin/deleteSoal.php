<?php
// Mulai sesi jika belum
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah ada sesi username dan user_status
if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
    echo "<p>Anda perlu login terlebih dahulu. <a href='../../index.html'>Menuju halaman Login</a></p>";
    exit();
}

// Koneksi ke database
include '../../Koneksi/koneksi.php';

// Periksa apakah id soal sudah diterima
if (isset($_GET['id'])) {
    $soal_id = $_GET['id'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Hapus data terkait di t_jawaban_mahasiswa
        $sql = "DELETE FROM t_jawaban_mahasiswa WHERE soal_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $soal_id);
        $stmt->execute();
        $stmt->close();

        // Hapus data soal di m_survey_soal
        $sql = "DELETE FROM m_survey_soal WHERE soal_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $soal_id);
        $stmt->execute();
        $stmt->close();

        // Commit transaksi
        $conn->commit();

        echo "<p>Soal berhasil dihapus.</p>";
        $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'mSurvey.php';
        header("Location: $previous_page");
        exit();
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();

        echo "<p>Gagal menghapus soal: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>ID soal tidak ditemukan.</p>";
    exit();
}

// Tutup koneksi
$conn->close();
?>