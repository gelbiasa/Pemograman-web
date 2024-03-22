<!-- Praktikum 3. Upload File dengan PHP dan Jquery Langkah 3 -->
<?php
// Memeriksa apakah ada file yang diunggah
if (isset($_FILES['file'])) {
    $errors = array(); // Inisialisasi array untuk menyimpan pesan kesalahan

    // Mendapatkan informasi file yang diunggah
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    @$file_ext = strtolower("" . end(explode('.', $_FILES['file']['name'])) . ""); // Mendapatkan ekstensi file

    // Daftar ekstensi file yang diizinkan
    $extensions = array("pdf", "doc", "docx", "txt");

    // Memeriksa apakah ekstensi file diizinkan
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "Ekstensi file yang diizinkan adalah PDF, DOC, DOCX, atau TXT.";
    }

    // Memeriksa apakah ukuran file tidak melebihi batas maksimum
    if ($file_size > 2097152) { // 2 MB (dalam byte)
        $errors[] = 'Ukuran file tidak boleh lebih dari 2 MB';
    }

    // Jika tidak ada kesalahan, pindahkan file ke direktori tujuan
    if (empty($errors)) {
        move_uploaded_file($file_tmp, "documents/" . $file_name); // Memindahkan file ke direktori 'documents'
        echo "File berhasil diunggah.";
    } else {
        echo implode(" ", $errors); // Menampilkan pesan kesalahan jika ada
    }
}
?>