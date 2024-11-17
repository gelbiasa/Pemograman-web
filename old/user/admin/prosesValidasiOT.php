<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "surveypolinema";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'accept') {
        $sql = "SELECT * FROM t_pending_ortu WHERE pending_user_id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['username'];
            $password = $row['password'];
            $nama = $row['nama'];
            $user_status = $row['user_status'];
            $responden_jk = $row['responden_jk'];
            $responden_umur = $row['responden_umur'];
            $responden_hp = $row['responden_hp'];
            $responden_pendidikan = $row['responden_pendidikan'];
            $responden_pekerjaan = $row['responden_pekerjaan'];
            $responden_penghasilan = $row['responden_penghasilan'];
            $mahasiswa_nim = $row['mahasiswa_nim'];
            $mahasiswa_nama = $row['mahasiswa_nama'];
            $mahasiswa_prodi = $row['mahasiswa_prodi'];

            $sql1 = "INSERT INTO m_user (username, password, Nama, user_status) 
                     VALUES ('$username', '$password', '$nama', '$user_status')";

            if ($conn->query($sql1) === TRUE) {
                $success = true;
                for ($i = 0; $i < 1; $i++) {
                    $sql2 = "INSERT INTO t_responden_ortu (responden_nama, responden_jk, responden_umur, responden_hp, responden_pendidikan, responden_pekerjaan,
                    responden_penghasilan, mahasiswa_nim, mahasiswa_nama, mahasiswa_prodi) 
                VALUES ('$nama', '$responden_jk', '$responden_umur', '$responden_hp', '$responden_pendidikan', '$responden_pekerjaan', '$responden_penghasilan',
                '$mahasiswa_nim', '$mahasiswa_nama', '$mahasiswa_prodi')";
                    if ($conn->query($sql2) !== TRUE) {
                        $success = false;
                        break;

                    }
                }
                if ($success) {
                    $conn->query("DELETE FROM t_pending_ortu WHERE pending_user_id = $id");
                    echo "Accepted";
                } else {
                    echo "Error: " . $conn->error;
                }
            }
        } 
    } else if ($action === 'reject') {
        $conn->query("DELETE FROM t_pending_ortu WHERE pending_user_id = $id");
        echo "Rejected";
    }
}

$conn->close();
?>