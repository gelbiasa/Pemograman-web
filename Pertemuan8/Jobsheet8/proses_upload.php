<!-- Praktikum 2. Multi Upload File proses_upload -->
<?php
$targetDirectory =  "documents/"; // Direktori tujuan untuk menyimpan file

// Membuat direktori jika tidak ada
if (!file_exists($targetDirectory)){
    mkdir($targetDirectory, 0777, true);
}

// Memeriksa apakah ada file yang diunggah
if ($_FILES['files']['name'][0]){
    $totalFiles = count($_FILES['files']['name']); // Mendapatkan jumlah total file yang diunggah

    // Melakukan iterasi untuk setiap file yang diunggah
    for ($i = 0; $i < $totalFiles; $i++){
        $fileName = $_FILES['files']['name'][$i]; // Nama file
        $targetFiles = $targetDirectory . $fileName; // Path lengkap ke file yang akan diunggah

        // Memindahkan file ke direktori tujuan
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFiles)){
            echo "file $fileName berhasil diunggah.<br>"; // Pesan sukses jika file berhasil diunggah
        } else {
            echo "Gagal mengunggah file $fileName.<br>"; // Pesan error jika gagal mengunggah file
        }
    }
} else {
    echo "tidak ada file yang diunggah"; // Pesan jika tidak ada file yang diunggah
}
?>