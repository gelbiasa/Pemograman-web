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

                // Query untuk mengambil jumlah user berdasarkan user_status
                $query_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM m_user WHERE user_status = 'Mahasiswa'";
                $query_dosen = "SELECT COUNT(*) AS total_dosen FROM m_user WHERE user_status = 'Dosen'";
                $query_tenaga_pendidik = "SELECT COUNT(*) AS total_tenaga_pendidik FROM m_user WHERE user_status = 'Tenaga Pendidik'";
                $query_alumni = "SELECT COUNT(*) AS total_alumni FROM m_user WHERE user_status = 'Alumni'";
                $query_orang_tua = "SELECT COUNT(*) AS total_orang_tua FROM m_user WHERE user_status = 'Orang Tua'";
                $query_industri = "SELECT COUNT(*) AS total_industri FROM m_user WHERE user_status = 'Industri'";

                // Eksekusi query
                $result_mahasiswa = $conn->query($query_mahasiswa);
                $result_dosen = $conn->query($query_dosen);
                $result_tenaga_pendidik = $conn->query($query_tenaga_pendidik);
                $result_alumni = $conn->query($query_alumni);
                $result_orang_tua = $conn->query($query_orang_tua);
                $result_industri = $conn->query($query_industri);

                // Ambil hasil query
                $total_mahasiswa = $result_mahasiswa->fetch_assoc()['total_mahasiswa'];
                $total_dosen = $result_dosen->fetch_assoc()['total_dosen'];
                $total_tenaga_pendidik = $result_tenaga_pendidik->fetch_assoc()['total_tenaga_pendidik'];
                $total_alumni = $result_alumni->fetch_assoc()['total_alumni'];
                $total_orang_tua = $result_orang_tua->fetch_assoc()['total_orang_tua'];
                $total_industri = $result_industri->fetch_assoc()['total_industri'];
                

                // Query untuk mengambil data dari tabel m_user
                $sql_m_user = "SELECT Nama AS username, user_status AS user FROM m_user WHERE user_status != 'admin'";
                $result_m_user = $conn->query($sql_m_user);

                // Query untuk mengambil data dari tabel-tabel responden
                $sql_responden_mahasiswa = "SELECT responden_nama AS username, responden_email AS email FROM t_responden_mahasiswa";
                $result_responden_mahasiswa = $conn->query($sql_responden_mahasiswa);

                $sql_responden_alumni = "SELECT responden_nama AS username, responden_email AS email FROM t_responden_alumni";
                $result_responden_alumni = $conn->query($sql_responden_alumni);

                $sql_responden_industri = "SELECT responden_nama AS username, responden_email AS email FROM t_responden_industri";
                $result_responden_industri = $conn->query($sql_responden_industri);

                // Gabungkan hasil-hasil query dari m_user dan tabel responden dalam array
                $users = array();

                // Tambahkan hasil query dari m_user ke dalam array users
                while ($row_m_user = $result_m_user->fetch_assoc()) {
                    $username = $row_m_user['username']; // Ambil username dari m_user
                    $users[$username] = $row_m_user; // Gunakan username sebagai kunci dalam array asosiatif
                }

                // Tambahkan hasil query dari tabel responden ke dalam array users
                while ($row_responden_mahasiswa = $result_responden_mahasiswa->fetch_assoc()) {
                    $username = $row_responden_mahasiswa['username']; // Ambil username dari tabel responden
                    // Periksa apakah username sudah ada dalam array users
                    if (isset($users[$username])) {
                        // Jika sudah ada, gabungkan data dari tabel responden dengan data yang sudah ada
                        $users[$username]['email'] = $row_responden_mahasiswa['email']; // Tambahkan email dari tabel responden
                    } else {
                        // Jika belum ada, tambahkan data baru ke dalam array users
                        $users[$username] = $row_responden_mahasiswa;
                    }
                }

                // Tambahkan hasil query dari tabel responden alumni ke dalam array users
                while ($row_responden_alumni = $result_responden_alumni->fetch_assoc()) {
                    $username = $row_responden_alumni['username']; // Ambil username dari tabel responden
                    // Periksa apakah username sudah ada dalam array users
                    if (isset($users[$username])) {
                        // Jika sudah ada, gabungkan data dari tabel responden dengan data yang sudah ada
                        $users[$username]['email'] = $row_responden_alumni['email']; // Tambahkan email dari tabel responden
                    } else {
                        // Jika belum ada, tambahkan data baru ke dalam array users
                        $users[$username] = $row_responden_alumni;
                    }
                }

                // Tambahkan hasil query dari tabel responden industri ke dalam array users
                while ($row_responden_industri = $result_responden_industri->fetch_assoc()) {
                    $username = $row_responden_industri['username']; // Ambil username dari tabel responden
                    // Periksa apakah username sudah ada dalam array users
                    if (isset($users[$username])) {
                        // Jika sudah ada, gabungkan data dari tabel responden dengan data yang sudah ada
                        $users[$username]['email'] = $row_responden_industri['email']; // Tambahkan email dari tabel responden
                    } else {
                        // Jika belum ada, tambahkan data baru ke dalam array users
                        $users[$username] = $row_responden_industri;
                    }
                }

                // Ubah array $users menjadi array numerik agar nomor urut bisa digunakan sebagai kunci
                $users = array_values($users);

                ?>

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
