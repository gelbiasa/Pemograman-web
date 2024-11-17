<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php
    // Mulai sesi jika belum
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Periksa apakah ada sesi username dan user_status
    if (!isset($_SESSION['username']) || !isset($_SESSION['user_status'])) {
        // Jika tidak, tampilkan pesan dan tautan ke halaman login
        echo "<p>Anda perlu login terlebih dahulu. <a href='../../index.html'>Menuju halaman Login</a></p>";
        exit(); // Pastikan kode berhenti di sini
    }
    ?>

    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_AU">
            <button id="backAU" class="btn-back_AU">Back</button>
            <!-- Pertama, kita perlu membuat koneksi ke database -->
            <?php
            $servername = "localhost";
            $username_db = "root";
            $password_db = "";
            $database = "surveypolinema";

            // Buat koneksi
            $conn = new mysqli($servername, $username_db, $password_db, $database);
            
            // Periksa koneksi
            if ($conn->connect_error) {
                die("Koneksi gagal: " . $conn->connect_error);
            }

            // Query untuk mengambil jumlah user berdasarkan user_status 'Admin'
            $query_admin = "SELECT COUNT(*) AS total_admin FROM m_user WHERE user_status = 'Admin'";

            // Eksekusi query
            $result_admin = $conn->query($query_admin);

            // Ambil hasil query
            $total_admin = $result_admin->fetch_assoc()['total_admin'];

            // Query untuk mengambil data dari tabel m_user dengan user_status 'Admin'
            $sql_m_user = "SELECT Nama AS username, user_status AS user FROM m_user WHERE user_status = 'Admin'";
            $result_m_user = $conn->query($sql_m_user);

            // Ubah hasil query menjadi array asosiatif
            $users = $result_m_user->fetch_all(MYSQLI_ASSOC);
            ?>

            <!-- Kemudian, kita akan menampilkan total user di dalam blok_AU1 -->
            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Admin</h2>
                            <p>Total: <?php echo $total_admin; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <table class="table_AU">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Variable untuk nomor urut
                    $no = 1;
                    // Loop untuk menampilkan data dari database
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>-</td> <!-- Tidak ada kolom email untuk admin -->
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['user']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="../../script.js"></script>
</body>

</html>
