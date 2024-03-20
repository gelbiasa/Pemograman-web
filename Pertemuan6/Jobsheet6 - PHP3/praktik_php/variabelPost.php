<!-- Variabel $_POST mirip dengan variabel $_GET. Hanya saja data yang di-passing 
tidaklah melalui query string pada URL, akan tetapi pada body request. Dan request 
method yang dilakukan haruslah dengan metode POST. -->
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
        // Mengumpulkan nilai input field
        $name = $_POST['fname'];
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