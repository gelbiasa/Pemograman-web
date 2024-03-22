<!-- Praktikum 3. Upload File dengan PHP dan Jquery Langkah 3 -->
<!DOCTYPE html>
<html>

<head>
    <title>Unggah File Dokumen</title> <!-- Judul halaman web -->
</head>

<body>
    <!-- Formulir untuk mengunggah file dokumen -->
    <form id="upload-form" action="upload_ajax.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file"> <!-- Input untuk memilih file dokumen -->
        <input type="submit" name="submit" value="Unggah"> <!-- Tombol untuk mengunggah file -->
    </form>
    <div id="status"></div> <!-- Div untuk menampilkan status pengunggahan -->

    <!-- Memuat jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Memuat skrip JavaScript untuk mengelola pengunggahan file secara asinkron -->
    <script src="upload.js"></script>
</body>

</html>