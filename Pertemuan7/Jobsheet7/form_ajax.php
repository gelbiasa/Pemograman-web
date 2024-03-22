<!-- Praktikum 6 : Form ajax Langkah 5 -->
<!DOCTYPE html>
<html>
<head>
    <title>Contoh Form dengan PHP dan jQuery</title>
    <!-- Memuat jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Form Contoh</h2>
    <!-- Formulir untuk memasukkan data -->
    <form id="myForm">
        <label for="buah">Pilih Buah:</label>
        <select name="buah" id="buah">
            <option value="apel">Apel</option>
            <option value="pisang">Pisang</option>
            <option value="mangga">Mangga</option> 
            <option value="jeruk">Jeruk</option> 
        </select>
        <br>
        <label>Pilih Warna Favorit:</label><br>
        <!-- Checkbox untuk memilih warna favorit -->
        <input type="checkbox" name="warna[]" value="merah"> Merah<br> 
        <input type="checkbox" name="warna[]" value="biru"> Biru<br> 
        <input type="checkbox" name="warna[]" value="hijau"> Hijau<br>
        <br>
        <label>Pilih Jenis Kelamin:</label><br>
        <!-- Radio button untuk memilih jenis kelamin -->
        <input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki<br> 
        <input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan<br>
        <br>
        <!-- Tombol submit untuk mengirimkan formulir -->
        <input type="submit" value="Submit">
    </form>
    <!-- Div untuk menampilkan hasil dari pengiriman form -->
    <div id="hasil">
        <!-- Hasil akan ditampilkan di sini -->
    </div>
    <script>
        // Memastikan dokumen telah dimuat sepenuhnya sebelum menjalankan skrip jQuery
        $(document).ready(function () {
            // Menangani pengiriman formulir secara asinkron saat formulir disubmit
            $("#myForm").submit(function (e) {
                e.preventDefault(); // Mencegah pengiriman form secara default

                // Mengumpulkan data formulir
                var formData = $("#myForm").serialize();

                // Kirim data ke server PHP menggunakan AJAX
                $.ajax({
                    url: "proses_lanjut.php", // URL tempat skrip PHP yang akan memproses data
                    type: "POST",
                    data: formData, // Data yang akan dikirim
                    success: function (response) {
                        // Menampilkan hasil dari server di dalam div "hasil"
                        $("#hasil").html(response);
                    }
                });

            });
        });
    </script>
</body>
</html>