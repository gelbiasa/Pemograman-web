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

include 'Database.php';
include 'UserAll.php';

// Inisialisasi objek database
$db = new Database();

// Inisialisasi objek user
$user = new User($db);

// Ambil total user berdasarkan status
$total_mahasiswa = $user->getTotalUsersByStatus('Mahasiswa');
$total_dosen = $user->getTotalUsersByStatus('Dosen');
$total_tenaga_pendidik = $user->getTotalUsersByStatus('Tenaga Pendidik');
$total_alumni = $user->getTotalUsersByStatus('Alumni');
$total_orang_tua = $user->getTotalUsersByStatus('Orang Tua');
$total_industri = $user->getTotalUsersByStatus('Industri');

// Ambil data user yang sudah melakukan survey
$users = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_AU">
            <button id="backAU" class="btn-back_AU">Back</button>

            <?php
            $statuses = [
                'Mahasiswa' => 'Mahasiswa',
                'Dosen' => 'Dosen',
                'Tenaga Pendidik' => 'Tenaga Pendidik',
                'Alumni' => 'Alumni',
                'Orang Tua' => 'Orang Tua',
                'Industri' => 'Industri'
            ];

            foreach ($statuses as $key => $label) {
                $total = $user->getTotalUsersByStatus($key);
                ?>
                <div class="blok_AU1">
                    <div class="blok_AU">
                        <div class="content_AU">
                            <div class="text_AU">
                                <h2><?php echo $label; ?></h2>
                                <p>Total: <?php echo $total; ?> user</p>
                            </div>
                        </div>
                    </div>
                    <div class="blok-strip_AU"></div>
                </div>
                <?php
            }
            ?>

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
                    $no = 1;
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo isset($user['email']) ? $user['email'] : '-'; ?></td>
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
