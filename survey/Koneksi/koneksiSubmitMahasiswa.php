<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "surveypolinema";

// Buat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil username dari sesi
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

if (empty($username)) {
    die("Error: Username tidak tersedia");
}

// Ambil survey_nama dari POST
$survey_nama = isset($_POST['survey_nama']) ? $conn->real_escape_string($_POST['survey_nama']) : '';
if (empty($survey_nama)) {
    die("Error: Nama survey tidak valid");
}

// Query SQL untuk mendapatkan Nama dan user_id berdasarkan username
$sql_user = "SELECT user_id, Nama FROM m_user WHERE username = '$username'";
$result = $conn->query($sql_user);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['user_id'];
    $nama = $row['Nama'];

    // Cek apakah ada survei jenis dosen yang belum diisi oleh user lain
    $sql_check_survey = "SELECT survey_id FROM m_survey WHERE survey_jenis = 'Mahasiswa' AND survey_nama = '$survey_nama' AND user_id IS NULL LIMIT 1";
    $result_check_survey = $conn->query($sql_check_survey);

    if ($result_check_survey->num_rows > 0) {
        $row_survey = $result_check_survey->fetch_assoc();
        $available_survey_id = $row_survey['survey_id'];

        // Perbarui data survei dengan user_id dan tanggal
        $sql_update_survey = "UPDATE m_survey SET survey_tanggal = NOW(), user_id = '$user_id' WHERE survey_id = $available_survey_id";
        if ($conn->query($sql_update_survey) === TRUE) {
            // Ambil ID responden berdasarkan nama
            $sql_responden_id = "SELECT responden_mahasiswa_id, survey_id FROM t_responden_mahasiswa WHERE responden_nama = '$nama' ORDER BY responden_mahasiswa_id ASC";
            $result_responden_id = $conn->query($sql_responden_id);

            if ($result_responden_id->num_rows > 0) {
                $found_empty = false;
                while ($row_responden = $result_responden_id->fetch_assoc()) {
                    $responden_id = $row_responden['responden_mahasiswa_id'];
                    if ($row_responden['survey_id'] == null) {
                        // Update responden kosong dengan survey_id baru
                        $sql_update_responden = "UPDATE t_responden_mahasiswa SET survey_id = '$available_survey_id', responden_tanggal = NOW() WHERE responden_mahasiswa_id = '$responden_id'";
                        if ($conn->query($sql_update_responden) === TRUE) {
                            $found_empty = true;
                            break;
                        } else {
                            echo "Error updating record: " . $conn->error;
                        }
                    }
                }

                // Jika tidak ada responden kosong, tampilkan pesan bahwa responden sudah mengisi semua survei
                if (!$found_empty) {
                    echo '<link rel="stylesheet" href="../style.css">';
                    echo '<div class="info-messageK">';
                    echo '<h2 class="h2K">Informasi</h2>';
                    echo '<p>Anda sudah mengisi semua survei yang tersedia.</p>';
                    echo '<a href="../index.html" class="buttonK">Kembali</a>'; // Perubahan pada tombol
                    echo '</div>';
                } else {
                    // Insert jawaban ke tabel t_jawaban_mahasiswa
                    foreach ($_POST as $key => $value) {
                        if (substr($key, 0, 6) === 'answer') { // Jika input adalah jawaban
                            $soal_id = intval(substr($key, 6)); // Ambil ID soal dari nama input
                            $jawaban = $conn->real_escape_string($value);

                            // Query SQL untuk menyimpan jawaban
                            $sql_insert_jawaban = "INSERT INTO t_jawaban_mahasiswa (responden_mahasiswa_id, soal_id, jawaban) VALUES ('$responden_id', '$soal_id', '$jawaban')";
                            if (!$conn->query($sql_insert_jawaban)) { // Eksekusi query
                                echo "Error: " . $sql_insert_jawaban . "<br>" . $conn->error;
                            }
                        }
                    }

                    // Tampilkan pesan sukses
                    echo '<link rel="stylesheet" href="../style.css">';
                    echo '<div class="success-messageK">';
                    echo '<h2 class="h2K">Survey Berhasil Disimpan</h2>';
                    echo '<p>Silakan menekan tombol di bawah ini untuk kembali ke Menu Survey.</p>';
                    echo '<div class="spasiK"></div>';
                    echo '<a href="../user/mahasiswa/surveyPage.php" class="buttonK">Kembali</a>'; // Perubahan pada tombol
                    echo '</div>';
                }
            } else {
                echo '<link rel="stylesheet" href="../style.css">';
                echo '<div class="error-messageK">';
                echo '<h2 class="h2K">Error</h2>';
                echo '<p>ID responden tidak ditemukan. Silakan coba lagi.</p>';
                echo '</div>';
            }
        } else {
            echo '<link rel="stylesheet" href="../style.css">';
            echo '<div class="error-messageK">';
            echo '<h2 class="h2K">Error</h2>';
            echo '<p>Penyimpanan data survei tidak berhasil. Silakan coba lagi.</p>';
            echo '<p>Error: ' . $conn->error . '</p>';
            echo '</div>';
        }
    } else {
        echo '<link rel="stylesheet" href="../style.css">';
        echo '<div class="error-messageK">';
        echo '<h2 class="h2K">Error</h2>';
        echo '<p>Survey yang anda pilih sudah terisi yang tersedia untuk diisi.</p>';
        echo '</div>';
    }
} else {
    echo "Error: Nama pengguna tidak ditemukan";
}

$conn->close();
?>
