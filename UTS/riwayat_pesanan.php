<?php
require_once("session.php");
require_once("cookies.php");

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "PesanPertandingan");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Hapus pesanan jika tombol "Batalkan" diklik
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_pesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $sql_delete = "DELETE FROM Pesanan WHERE id = '$id_pesanan'";

    if ($conn->query($sql_delete) === TRUE) {
        echo "Pesanan berhasil dibatalkan";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
}

// Query untuk mengambil data pesanan
$sql = "SELECT id, nama_pemesan, pertandingan, kualitas_live, harga FROM Pesanan";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.js"></script>
</head>
<body>
    <div class="riwayat-container">
        <h2>Riwayat Pesanan</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>Nama Pemesan</th>
                    <th>Pertandingan</th>
                    <th>Kualitas Live</th>
                    <th>Harga</th>
                    <th></th> <!-- Kolom untuk tombol batalkan pesanan -->
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row["nama_pemesan"]; ?></td>
                    <td><?php echo $row["pertandingan"]; ?></td>
                    <td><?php echo $row["kualitas_live"]; ?></td>
                    <td><?php echo "Rp " . number_format($row["harga"], 0, ",", "."); ?></td>
                    <td>
                        <!-- Tombol untuk membatalkan pesanan -->
                        <button class="cancel-button" data-id="<?php echo $row["id"]; ?>">Batalkan</button>
                    </td>
                </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <div class="pesanan">
            <p>Anda belum membuat Pesanan.</p>
            </div>
        <?php } ?>
        <a href="home.php" class="btn-back">Kembali</a>
    </div>
    <script src="script.js"></script>
</body>
</html>

<?php
$conn->close();
?>