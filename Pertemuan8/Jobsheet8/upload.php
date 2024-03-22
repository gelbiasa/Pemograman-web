<?php
/* Upload gambar Langkah 5
// Memeriksa apakah formulir telah disubmit
if (isset($_POST["submit"])) {
    $targetDirectory = "uploads/"; // Direktori tujuan untuk menyimpan file
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
if (isset($_POST["submit"])) {
    $targetDirectory = "documents/"; // Direktori tujuan untuk menyimpan dokumen
    $targetFile = $targetDirectory . basename($_FILES["documentToUpload"]["name"]); // Path lengkap ke dokumen yang akan diunggah
    $documentFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Mendapatkan ekstensi dokumen

    // Ekstensi dokumen yang diizinkan untuk diunggah
    $allowedExtension = array("txt", "pdf", "doc", "docx");

    // Ukuran maksimum dokumen (dalam byte)
    $maxFileSize = 10 * 1024* 1024; // 10 MB

    // Memeriksa apakah tipe dokumen dan ukuran dokumen sesuai dengan kriteria yang diizinkan
    if (in_array($documentFileType, $allowedExtension) && $_FILES["documentToUpload"]["size"] <= $maxFileSize) {
        // Jika sesuai, pindahkan dokumen ke direktori yang ditentukan
        if (move_uploaded_file($_FILES["documentToUpload"]["tmp_name"], $targetFile)) {
            echo "Dokumen berhasil diunggah."; // Pesan sukses jika dokumen berhasil diunggah
        } else {
            echo "Gagal mengunggah dokumen."; // Pesan error jika gagal mengunggah dokumen
        }
    } else {
        echo "Jenis dokumen tidak valid atau melebihi ukuran maksimum yang diizinkan"; // Pesan error jika dokumen tidak sesuai dengan kriteria yang diizinkan
    }
}
?>