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

                // Query untuk mengambil jumlah user berdasarkan user_status yang memiliki informasi survey_tanggal (tidak null)
                $query_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM m_user WHERE user_status = 'Mahasiswa' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";
                $query_dosen = "SELECT COUNT(*) AS total_dosen FROM m_user WHERE user_status = 'Dosen' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";
                $query_tenaga_pendidik = "SELECT COUNT(*) AS total_tenaga_pendidik FROM m_user WHERE user_status = 'Tenaga Pendidik' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";
                $query_alumni = "SELECT COUNT(*) AS total_alumni FROM m_user WHERE user_status = 'Alumni' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";
                $query_orang_tua = "SELECT COUNT(*) AS total_orang_tua FROM m_user WHERE user_status = 'Orang Tua' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";
                $query_industri = "SELECT COUNT(*) AS total_industri FROM m_user WHERE user_status = 'Industri' AND EXISTS (SELECT 1 FROM m_survey WHERE m_user.user_id = m_survey.user_id AND survey_tanggal IS NOT NULL)";

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
                

                // Query untuk mengambil data dari tabel m_survey dan m_user
                $sql = "SELECT m_survey.survey_id, m_survey.survey_nama AS jenis_survey, m_user.Nama AS username, m_user.user_status AS user, m_survey.survey_tanggal AS date 
                        FROM m_survey 
                        INNER JOIN m_user ON m_survey.user_id = m_user.user_id 
                        WHERE m_survey.survey_tanggal IS NOT NULL";

                // Eksekusi query
                $result = $conn->query($sql);

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
                        if ($result->num_rows > 0) {
                            // Variable untuk nomor urut
                            $no = 1;

                            // Loop untuk menampilkan data dari database
                            while ($row = $result->fetch_assoc()) {
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
