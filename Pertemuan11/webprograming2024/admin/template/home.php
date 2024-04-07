<!-- Praktikum 3. Folder Template Langkah 5 home.php -->
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <!-- Mengambil data jumlah anggota dan jumlah jabatan dari database -->
        <div class="container-fluid">
            <div class="row">
                <?php
                // Memasukkan file menu.php yang berisi kode untuk menampilkan menu
                include "menu.php";

                // Query untuk mengambil jumlah anggota dari database
                $query_anggota = "SELECT count(id) as jml FROM anggota";
                $result_anggota = mysqli_query($koneksi, $query_anggota);
                $row_anggota = mysqli_fetch_Assoc($result_anggota);

                // Query untuk mengambil jumlah jabatan dari database
                $query_jabatan = "SELECT count(id) as jml FROM jabatan";
                $result_jabatan = mysqli_query($koneksi, $query_jabatan);
                $row_jabatan = mysqli_fetch_Assoc($result_jabatan);
                ?>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <!-- Judul Dashboard -->
                        <h1 class="h2">Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- Card untuk menampilkan informasi jumlah anggota -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">ANGGOTA</h5>
                                    <!-- Menampilkan jumlah anggota yang diambil dari database -->
                                    <p class="card-text">Total anggota sejumlah <?= $row_anggota['jml'] ?> orang.</p>
                                    <!-- Tombol untuk mengelola anggota -->
                                    <a href="index.php?page=anggota" class="btn btn-primary"><i class="fa fa-users" aria-hidden=
                                    "true"></i> Kelola</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- Card untuk menampilkan informasi jumlah jabatan -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">JABATAN</h5>
                                    <!-- Menampilkan jumlah jabatan yang diambil dari database -->
                                    <p class="card-text">Total jabatan sejumlah <?= $row_jabatan['jml'] ?> orang.</p>
                                    <!-- Tombol untuk mengelola jabatan -->
                                    <a href="index.php?page=jabatan" class="btn btn-primary"><i class="fa fa-puzzle-piece" aria-hidden=
                                    "true"></i> Kelola</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
