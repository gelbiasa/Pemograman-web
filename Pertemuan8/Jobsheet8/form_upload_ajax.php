<!-- Praktikum 3. Upload File dengan PHP dan Jquery Langkah 3

<!DOCTYPE html>
<html> 
<head>
    <title>Unggah File Dokumen</title> 
</head>

<body>
    <form id="upload-form" action="upload_ajax.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file"> 
        <input type="submit" name="submit" value="Unggah"> 
    </form> 
    <div id="status"></div> 

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="upload.js"></script>
</body>

</html>
-->


<!-- Praktikum 4. Menghias Upload File Langkah 3 -->
<!DOCTYPE html>
<html>
<head>
    <!-- Menghubungkan file CSS untuk tata letak -->
    <link rel="stylesheet" type="text/css" href="upload.css">
    <!-- Menentukan judul halaman -->
    <title>Unggah File Dokumen</title>
</head>

<body>
    <!-- Container untuk formulir unggah file -->
    <div class="upload-form-container">
        <!-- Judul formulir -->
        <h2>Unggah File Dokumen</h2>
        <!-- Formulir unggah file -->
        <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data">
            <!-- Container untuk input file -->
            <div class="file-input-container">
                <!-- Input untuk memilih file -->
                <input type="file" name="file" id="file" class="file-input">
                <!-- Label untuk tombol memilih file -->
                <label for="file" class="file-label">Pilih File</label>
            </div>
            <!-- Tombol unggah file -->
            <button type="submit" name="submit" class="upload-button" id="upload-button" disabled>Unggah</button>
        </form>
        <!-- Div untuk menampilkan status unggahan -->
        <div id="status" class="upload-status"></div>
    </div>

    <!-- Memuat jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Memuat skrip JavaScript untuk mengelola pengunggahan file -->
    <script src="upload.js"></script>
</body>
</html>