<?php
/* Upload gambar Langkah 5
// Memeriksa apakah formulir telah disubmit
if (isset($_POST["submit"])) {
    $targetDirectory = "uploadGambar/"; // Direktori tujuan untuk menyimpan file
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // Path lengkap ke file yang akan diunggah
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Mendapatkan ekstensi file

    // Ekstensi file yang diizinkan untuk diunggah
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    // Ukuran maksimum file (dalam byte)
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    // Memeriksa apakah tipe file dan ukuran file sesuai dengan kriteria yang diizinkan
    if (in_array($fileType, $allowedExtensions) && $_FILES["fileToUpload"]["size"] <= $maxFileSize) {
        // Jika sesuai, pindahkan file ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "File berhasil diunggah."; // Pesan sukses jika file berhasil diunggah
        } else {
            echo "Gagal mengunggah file."; // Pesan error jika gagal mengunggah file
        }
    } else {
        echo "File tidak valid atau melebihi ukuran maksimum yang diizinkan."; // Pesan error jika file tidak sesuai dengan kriteria yang diizinkan
    }
}
*/

// Upload Document langkah 8
// Memeriksa apakah formulir telah disubmit
if (isset($_POST['submit'])) { // Memeriksa apakah tombol submit telah ditekan
    $targetDirectory = "uploadDocument/"; // Direktori tempat file akan disimpan
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]); // Path lengkap file yang akan diunggah
    $fileExtension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION); // Mendapatkan ekstensi file
    $fileType = strtolower($fileExtension); // Mengonversi ekstensi file menjadi huruf kecil
    $allowedExtensions = array("txt", "pdf", "doc", "docx"); // Ekstensi file yang diizinkan untuk diunggah
    $maxFileSize = 10 * 1024 * 1024; // Ukuran maksimum file dalam byte (10 MB)

    // Memeriksa apakah jenis file dan ukuran file memenuhi persyaratan
    if (in_array($fileType, $allowedExtensions) && $_FILES["fileToUpload"]["size"] <= $maxFileSize) {
        // Memindahkan file yang diunggah ke direktori tujuan
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Dokumen berhasil diunggah."; // Pesan sukses jika file berhasil diunggah
        } else {
            echo "Gagal mengunggah dokumen."; // Pesan gagal jika terjadi kesalahan saat memindahkan file
        }
    } else {
        echo "Jenis dokumen tidak valid atau melebihi ukuran maksimum yang diizinkan."; // Pesan jika jenis atau ukuran file tidak sesuai
    }
}
?>