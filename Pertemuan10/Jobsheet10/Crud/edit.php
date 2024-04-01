<!-- Praktikum 3 dan 5 --> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Data Anggota</title>
</head>

<body>
    <!-- Praktikum 3 -->
    <!-- <?php
    /*
    include('koneksi.php');
    $id = $_GET['id'];
    $query = "SELECT * FROM anggota WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($koneksi);
    */
    ?>
    <div class="container">
        <h2>Edit Data Anggota</h2>
        <form action="proses.php?aksi=ubah" method="post">
            <input type="hidden" name="id" value="<?php //echo $row['id']; 
            ?>">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?php //echo $row['nama']; 
            ?>" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <div class="radio-group">
                <input type="radio" name="jenis_kelamin" value="L" id="laki" <?php //if ($row['jenis_kelamin'] === 'L') echo 'checked'; 
                ?>>
                <label for="laki">Laki-laki</label>
                <input type="radio" name="jenis_kelamin" value="P" id="perempuan" <?php //if ($row['jenis_kelamin'] === 'P') echo 'checked'; 
                ?>>
                <label for="perempuan">Perempuan</label>
            </div>

            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" value="<?php //echo $row['alamat']; 
            ?>" required>

            <label for="no_telp">No. Telp:</label>
            <input type="text" name="no_telp" id="no_telp" value="<?php  //echo $row['no_telp']; 
            ?>" required>

            <button type="submit">Simpan Perubahan</button>
            <a href="index.php" class="btn-kembali">Kembali</a>
        </form> -->

    <!-- Praktikum 5 -->
    <?php
    // Mengambil data anggota berdasarkan ID yang diberikan
    include('koneksi.php');
    $id = $_GET['id'];
    $query = "SELECT * FROM anggota WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($koneksi);
    ?>
    <!-- Container untuk form edit data anggota -->
    <div class="container mt-4">
        <h2>Edit data anggota</h2>
        <!-- Form untuk mengubah data anggota -->
        <form action="proses.php?aksi=ubah" method="post">
            <!-- Input hidden untuk menyimpan ID anggota yang diubah -->
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <!-- Input Nama -->
            <div class="form-group">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $row['nama']; ?>"
                    required>
            </div>
            <!-- Input Jenis Kelamin -->
            <div class="form-group">
                <label for="jenis_kelamin">Jenis kelamin : </label>
                <!-- Radio button untuk pilihan jenis kelamin -->
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="L" id="laki" <?php if ($row['jenis_kelamin'] === 'L')
                        echo 'checked'; ?> required>
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="P" id="peremmpuan" <?php if ($row['jenis_kelamin'] === 'P')
                        echo 'checked'; ?> required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <!-- Input Alamat -->
            <div class="form-group">
                <label for="alamat">Alamat : </label>
                <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo $row['alamat']; ?>"
                    required>
            </div>
            <!-- Input Nomor Telepon -->
            <div class="form-group">
                <label for="no_telp">No telp : </label>
                <input type="text" class="form-control" name="no_telp" id="no_telp"
                    value="<?php echo $row['no_telp']; ?>" required>
            </div>
            <!-- Tombol untuk menyimpan perubahan -->
            <button type="submit" class="btn btn-primary">Simpan perubahan</button>
        </form>
        <!-- Tombol untuk kembali ke halaman utama -->
        <a class="btn btn-secondary mt-2" href="index.php">Kembali</a>
    </div>
    <!-- Menyisipkan Javascript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>