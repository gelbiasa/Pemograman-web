<!-- Praktikum 1. Upload File Langkah 3 -->
<!DOCTYPE html>
<html>
<head>
    <title>File Upload</title> <!-- Judul halaman web -->
</head>
<body>
    <!-- Formulir untuk mengunggah file -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload"> <!-- Input untuk memilih file -->
        <input type="submit" value="Upload File" name="submit"> <!-- Tombol untuk mengirim file yang dipilih -->
    </form>
</body>
</html>