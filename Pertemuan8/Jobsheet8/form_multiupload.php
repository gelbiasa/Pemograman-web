<!-- Praktikum 2. Multi Upload File from_multiupload -->
<!DOCTYPE html>
<html>
<head>
    <title>Multiupload Dokumen</title> <!-- Judul halaman web -->
</head>
<body>
    <h2>Unggah Dokumen</h2> <!-- Judul formulir -->
    <form action="proses_upload.php" method="post" enctype="multipart/form-data"> <!-- Formulir untuk mengunggah dokumen -->
        <input type="file" name="files[]" multiple="multiple" accept=".pdf, .doc, .docx"/> <!-- Input untuk memilih beberapa file dokumen, dengan batasan tipe file yang diizinkan -->
        <input type="submit" value="Unggah" /> <!-- Tombol untuk mengunggah dokumen -->
    </form>
</body>
</html>
