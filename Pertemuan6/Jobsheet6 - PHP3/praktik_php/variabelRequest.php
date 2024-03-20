<!-- Variabel $_REQUEST adalah array asosiatif yang menyimpan gabungan nilai dari 
variabel $_GET, $_POST, dan $_COOKIE yang kesemuanya berhubungan dengan data yang dikirim 
bersamaan dengan request user. -->

<html>

<body>
    <!-- Formulir untuk memasukkan nama -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Name: <input type="text" name="fname"> <!-- Input field untuk nama -->
        <input type="submit"> <!-- Tombol submit untuk mengirimkan formulir -->
    </form>

    <?php
    // Memeriksa apakah formulir telah di-submit dengan metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mengumpulkan nilai input field menggunakana metode REQUEST
        $name = $_REQUEST['fname'];
        // Memeriksa apakah input kosong atau tidak
        if (empty($name)) {
            echo "Name is empty"; // Menampilkan pesan jika input kosong
        } else {
            echo $name; // Menampilkan nama yang dimasukkan jika tidak kosong
        }
    }
    ?>
</body>

</html>