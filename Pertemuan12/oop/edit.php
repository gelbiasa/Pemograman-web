<!-- Jobsheet 12 Praktikum 2. CRUD dengan OOP Langkah 8 -->
<?php
require_once 'Crud.php';

$crud = new Crud();

// Mendapatkan ID data jabatan yang akan diedit dari parameter URL
$id = $_GET['id'];

// Membaca data jabatan berdasarkan ID menggunakan metode readById dari objek Crud
$tampil = $crud->readById($id);

// Memeriksa apakah ada permintaan POST untuk memperbarui data jabatan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jabatan = $_POST['jabatan']; // Mengambil nilai jabatan dari formulir
    $keterangan = $_POST['keterangan']; // Mengambil nilai keterangan dari formulir

    // Memanggil metode update dari objek Crud untuk memperbarui data jabatan
    $crud->update($id, $jabatan, $keterangan);

    // Mengarahkan pengguna kembali ke halaman utama setelah pembaruan selesai
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jabatan</title>
    <!-- Memuat stylesheet Bootstrap untuk tampilan yang lebih baik -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <!-- Formulir untuk mengedit data jabatan -->
        <h2>Edit Jabatan</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <!-- Input untuk jabatan dengan nilai default yang diambil dari data jabatan yang sedang diedit -->
                <input type="text" name="jabatan" id="jabatan" class="form-control" value="<?php echo $tampil['jabatan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <!-- Input untuk keterangan dengan nilai default yang diambil dari data jabatan yang sedang diedit -->
                <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required><?php echo $tampil['keterangan']; ?></textarea>
            </div>
            <!-- Input tersembunyi untuk menyimpan ID data jabatan yang sedang diedit -->
            <input type="hidden" name="id" value="<?php echo $tampil['id']; ?>">
            <!-- Tombol untuk memperbarui data jabatan -->
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    <!-- Memuat script jQuery dan Bootstrap untuk fungsionalitas modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>