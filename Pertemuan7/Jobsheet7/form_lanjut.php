<!-- Praktikum 6 : Form Lanjut Langkah 2 -->
<!DOCTYPE html>
<html>

<head>
    <title>Contoh Form dengan PHP</title>
</head>

<body>
    <h2>Form Contoh</h2>
    <!-- Formulir untuk mengumpulkan data pengguna -->
    <form method="POST" action="proses_lanjut.php">
        <label for="buah">Pilih Buah:</label>
        <select name="buah" id="buah">
            <option value="apel">Apel</option>
            <option value="pisang">Pisang</option>
            <option value="mangga">Mangga</option>
            <option value="jeruk">Jeruk</option>
        </select>
        <br>
        <!-- Checkbox untuk memilih warna favorit -->
        <label>Pilih Warna Favorit:</label><br>
        <input type="checkbox" name="warna[]" value="merah"> Merah<br>
        <input type="checkbox" name="warna[]" value="biru"> Biru<br>
        <input type="checkbox" name="warna[]" value="hijau"> Hijau<br>
        <br>
        <!-- Radio button untuk memilih jenis kelamin -->
        <label>Pilih Jenis Kelamin:</label><br>
        <input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki<br>
        <input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan<br>
        <br>
        <input type="submit" value="Submit">
    </form>
    <?php
    // Memeriksa apakah permintaan adalah metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mendapatkan nilai yang dikirimkan dari formulir
        $selectedBuah = $_POST['buah']; // Memilih buah
        if (isset($_POST['warna'])) {
            $selectedWarna = $_POST['warna']; // Memilih warna favorit
        } else {
            $selectedWarna = []; // Jika tidak ada warna yang dipilih
        }
        $selectedJenisKelamin = $_POST['jenis_kelamin']; // Memilih jenis kelamin

        // Menampilkan hasil pemilihan
        echo "Anda memilih buah: " . $selectedBuah . "<br>";

        if (!empty($selectedWarna)) {
            echo "Warna favorit Anda: " . implode(", ", $selectedWarna) . "<br>";
        } else {
            echo "Anda tidak memilih warna favorit.<br>";
        }
        echo "Jenis kelamin Anda: " . $selectedJenisKelamin;
    }
    ?>
</body>

</html>
