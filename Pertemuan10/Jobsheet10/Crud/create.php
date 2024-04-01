<!-- Praktikum 2 dan 5 --> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Anggota</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<!-- Praktikum 2 -->
<!-- <head>
    <title>Tambah Data Anggota</title>
    <link rel="stylesheet" href="style.css"> 
</head> -->
<body>
    <!-- <div class="container">
        <h2>Tambah Data Anggota</h2>
        <form action="proses.php?aksi=tambah" method="post">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <div class="radio-group">
                <label for="perempuan">Perempuan</label>
                <input type="radio" name="jenis_kelamin" value="L" id="laki" required>
                <label for="laki">Laki-laki</label>
                <input type="radio" name="jenis_kelamin" value="P" id="perempuan" required>
                <label for="perempuan"></label>
            </div>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" required>

            <label for="no_telp">No. Telp:</label>
            <input type="text" name="no_telp" id="no_telp" required>

            <button type="submit">Simpan Data</button>
            <a href="index.php" class="btn-kembali">Kembali</a>
        </form>
    </div> -->

    <!-- Praktikum 5 -->
    <!-- Konten Form Tambah Data Anggota -->
    <div class="container mt-4">
        <h2>Tambah data anggota</h2>
        <!-- Form untuk menambahkan data anggota -->
        <form action="proses.php?aksi=tambah" method="post">
            <!-- Input Nama -->
            <div class="form-group">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <!-- Input Jenis Kelamin -->
            <div class="form-group">
                <label for="jenis_kelamin">Jenis kelamin : </label>
                <!-- Radio button untuk pilihan jenis kelamin -->
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="L" id="laki" required>
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="P" id="perempuan" required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <!-- Input Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat : </label>
                <input type="text" class="form-control" name="alamat" id="alamat" required>
            </div>
            <!-- Input Nomor Telepon -->
            <div class="form-group">
                <label for="no_telp">No telp : </label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" required>
            </div>
            <!-- Tombol untuk menyimpan data -->
            <button type="submit" class="btn btn-primary">Simpan data</button>
        </form>
        <!-- Tombol untuk kembali ke halaman utama -->
        <a class="btn btn-secondary" href="index.php">Kembali</a>
    </div>
    <!-- Menyisipkan Javascript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>