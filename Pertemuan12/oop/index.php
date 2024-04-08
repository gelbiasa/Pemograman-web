<!-- Jobsheet 12 Praktikum 2. CRUD dengan OOP Langkah 6 -->
<?php
// Menyertakan file Crud.php yang berisi definisi kelas Crud untuk operasi CRUD terhadap data jabatan
require_once 'Crud.php';

// Membuat objek Crud untuk melakukan operasi CRUD terhadap data jabatan
$crud = new Crud();

// Memeriksa apakah ada permintaan POST untuk menambahkan data jabatan baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jabatan = $_POST['jabatan']; // Mengambil nilai jabatan dari formulir
    $keterangan = $_POST['keterangan']; // Mengambil nilai keterangan dari formulir
    $crud->create($jabatan, $keterangan); // Memanggil metode create dari objek Crud untuk menambahkan data jabatan
}

// Memeriksa apakah ada permintaan GET untuk menghapus data jabatan
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id']; // Mengambil nilai ID data jabatan yang akan dihapus
    $crud->delete($id); // Memanggil metode delete dari objek Crud untuk menghapus data jabatan
}

// Membaca data jabatan dari database menggunakan metode read dari objek Crud
$tampil = $crud->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Jabatan</title>
    <!-- Memuat stylesheet Bootstrap untuk tampilan yang lebih baik -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <!-- Tombol untuk menampilkan modal tambah data jabatan -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahModal">Tambah</button>
        <!-- Tabel untuk menampilkan data jabatan -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jabatan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan setiap data jabatan dalam tabel
                foreach ($tampil as $show) {
                    echo "<tr>";
                    echo "<td>" . $show['id'] . "</td>";
                    echo "<td>" . $show['jabatan'] . "</td>";
                    echo "<td>" . $show['keterangan'] . "</td>";
                    echo "<td>";
                    // Tombol untuk mengedit data jabatan
                    echo "<a href='edit.php?id=" . $show['id'] . "' class='btn btn-primary btn-sm'>Edit</a>";
                    // Tombol untuk menghapus data jabatan
                    echo "<a href='index.php?action=delete&id=" . $show['id'] . "' class='btn btn-danger btn-sm'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Modal untuk menambah data jabatan -->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambah data jabatan -->
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Jabatan:</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Keterangan:</label>
                            <textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                        <!-- Tombol untuk menambahkan data jabatan -->
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Memuat script jQuery dan Bootstrap untuk fungsionalitas modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>