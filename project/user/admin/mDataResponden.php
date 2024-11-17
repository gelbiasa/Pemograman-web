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
include 'User.php';

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
$survey_users = $user->getSurveyUsers();
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

            <!-- Kemudian, kita akan menampilkan total user di dalam blok_AU1 -->
            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Mahasiswa</h2>
                            <p>Total: <?php echo $total_mahasiswa; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Dosen</h2>
                            <p>Total: <?php echo $total_dosen; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Tenaga Pendidik</h2>
                            <p>Total: <?php echo $total_tenaga_pendidik; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Alumni</h2>
                            <p>Total: <?php echo $total_alumni; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Orang Tua</h2>
                            <p>Total: <?php echo $total_orang_tua; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <div class="blok_AU1">
                <div class="blok_AU">
                    <div class="content_AU">
                        <div class="text_AU">
                            <h2>Industri</h2>
                            <p>Total: <?php echo $total_industri; ?> user</p>
                        </div>
                    </div>
                </div>
                <div class="blok-strip_AU"></div>
            </div>

            <!-- Tampilkan tabel -->
            <table class="table_AU">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jenis Survey</th>
                        <th scope="col">Username</th>
                        <th scope="col">User</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Periksa apakah ada data yang ditampilkan
                    if ($survey_users->num_rows > 0) {
                        // Variable untuk nomor urut
                        $no = 1;

                        // Loop untuk menampilkan data dari database
                        while ($row = $survey_users->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['jenis_survey']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['user']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                            </tr>
                    <?php
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data
                        ?>
                        <tr>
                            <td colspan="5">Tidak ada responden yang telah melakukan survey</td>
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
