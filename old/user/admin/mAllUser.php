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

include '../../Koneksi/koneksi.php';

class UserStatistics {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getTotalUsersByStatus($status) {
        $query = "SELECT COUNT(*) AS total FROM m_user WHERE user_status = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }

    public function getUsers() {
        $users = array();

        // Query untuk mengambil data dari tabel m_user
        $sql_m_user = "SELECT Nama AS username, user_status AS user FROM m_user WHERE user_status != 'admin'";
        $result_m_user = $this->conn->query($sql_m_user);

        while ($row_m_user = $result_m_user->fetch_assoc()) {
            $username = $row_m_user['username'];
            $users[$username] = $row_m_user;
        }

        // Query untuk mengambil data dari tabel responden
        $responden_tables = ['t_responden_mahasiswa', 't_responden_alumni', 't_responden_industri'];
        foreach ($responden_tables as $table) {
            $sql_responden = "SELECT responden_nama AS username, responden_email AS email FROM $table";
            $result_responden = $this->conn->query($sql_responden);

            while ($row_responden = $result_responden->fetch_assoc()) {
                $username = $row_responden['username'];
                if (isset($users[$username])) {
                    $users[$username]['email'] = $row_responden['email'];
                } else {
                    $users[$username] = $row_responden;
                }
            }
        }

        // Ubah array $users menjadi array numerik agar nomor urut bisa digunakan sebagai kunci
        return array_values($users);
    }
}

$userStats = new UserStatistics($conn);
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
                $total = $userStats->getTotalUsersByStatus($key);
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

            $users = $userStats->getUsers();
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
