<!-- Praktikum 7 : Validasi Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input dengan Validasi</title>
    <!-- Memuat jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi</h1>
    <!-- Formulir untuk memasukkan data dengan validasi -->
    <form id="myForm" method="post" action="proses_validasi.php">
        <!-- Input untuk nama -->
        <label for="nama">Nama :</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br> <!-- Penanda kesalahan untuk nama -->
        
        <!-- Input untuk email -->
        <label for="email">Email :</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br> <!-- Penanda kesalahan untuk email -->
        
        <!-- Input untuk password -->
        <label for="password">Password :</label>
        <input type="password" id="password" name="password">
        <span id="password-error" style="color: red;"></span><br> <!-- Penanda kesalahan untuk password -->
        
        <!-- Tombol submit untuk mengirimkan formulir -->
        <input type="submit" value="Submit">
    </form>
    <!-- Skrip jQuery untuk validasi formulir -->
    <script>
        $(document).ready(function(){
            $("#myForm").submit(function(event){
                var nama = $("#nama").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var valid = true;

                // Validasi nama
                if (nama === ""){
                    $("#nama-error").text("Nama harus diisi");
                    valid = false;
                } else {
                    $("#nama-error").text("");
                }

                // Validasi email
                if (email === ""){
                    $("#email-error").text("Email harus diisi");
                    valid = false;
                } else {
                    $("#email-error").text("");
                }

                // Validasi password
                if (password === ""){
                    $("#password-error").text("Password harus diisi");
                    valid = false;
                } else if (password.length < 8) {
                    $("#password-error").text("Password minimal 8 karakter");
                    valid = false;
                } else {
                    $("#password-error").text("");
                }

                // Menghentikan pengiriman formulir jika validasi tidak berhasil
                if (!valid){
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
