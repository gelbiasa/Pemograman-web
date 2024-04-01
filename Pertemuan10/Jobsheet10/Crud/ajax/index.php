<!-- Praktikum 6. Tampilan CRUD dengan Ajax -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnm0Cqb1lwilj8lyljo/mousej skC4p0pQbqy17RrhNudi9RnKkMHpvbliG9Sr"
        crossorigin="anonymous">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <title>Data Anggota</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php" style="color: #fff;">
            CRUD Dengan Ajax
        </a>
    </nav>
    <div class="container">
        <!-- Form -->
        <h2 align="center" style="margin: 30px;">Data anggota</h2>
        <form method="post" class="form-data" id="form-data">
            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama" id="nama" class="form-control" required="true">
                        <!-- Pesan error untuk nama -->
                        <p class="text-danger" id="err_nama"></p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis kelamin</label><br>
                        <input type="radio" name="jenis_kelamin" id="jenkel1" value="L" required="true"> Laki-laki
                        <input type="radio" name="jenis_kelamin" id="jenkel2" value="P"> Perempuan
                    </div>
                    <!-- Pesan error untuk jenis kelamin -->
                    <p class="text-danger" id="err_jenis_kelamin"></p>
                </div>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                <!-- Pesan error untuk alamat -->
                <p class="text-danger" id="err_alamat"></p>
            </div>
            <div class="form-group">
                <label>No Telepon</label>
                <input type="number" name="no_telp" id="no_telp" class="form-control" required="true">
                <!-- Pesan error untuk nomor telepon -->
                <p class="text-danger" id="err_no_telp"></p>
            </div>
            <div class="form-group">
                <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
        <hr>
        <!-- Tabel Data -->
        <div class="data"></div>
    </div>
    <!-- Footer -->
    <div class="text-center">&copy; <?php echo date('Y'); ?> Desain dan pemrograman web</div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- JavaScript kustom -->
    <script type="text/javascript">
        $(document).ready(function () {
            // Atur token CSRF untuk permintaan Ajax
            $.ajaxSetup({
                headers: {
                    'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Memuat data awal saat halaman dimuat
            $('.data').load("data.php");
        });
    </script>
    <!-- JavaScript kustom untuk validasi dan pengiriman formulir -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#simpan").click(function () {
                var data = $('.form-data').serialize();
                var jenkel1 = document.getElementById("jenkel1").value;
                var jenkel2 = document.getElementById("jenkel2").value;
                var nama = document.getElementById("nama").value;
                var alamat = document.getElementById("alamat").value;
                var no_telp = document.getElementById("no_telp").value;
                // Validasi untuk nama
                if (nama == "") {
                    document.getElementById("err_nama").innerHTML = "Nama harus diisi";
                } else {
                    document.getElementById("err_nama").innerHTML = "";
                }
                // Validasi untuk alamat
                if (alamat == "") {
                    document.getElementById("err_alamat").innerHTML = "Alamat harus diisi";
                } else {
                    document.getElementById("err_alamat").innerHTML = "";
                }
                // Validasi untuk jenis kelamin
                if (document.getElementById("jenkel1").checked == false && document.getElementById("jenkel2").checked == false) {
                    document.getElementById("err_jenis_kelamin").innerHTML = "Jenis kelamin harus dipilih";
                } else {
                    document.getElementById("err_jenis_kelamin").innerHTML = "";
                }
                // Validasi untuk nomor telepon
                if (no_telp == "") {
                    document.getElementById("err_no_telp").innerHTML = "No telepon harus diisi";
                } else {
                    document.getElementById("err_no_telp").innerHTML = "";
                }
                // Jika semua field diisi, kirim formulir melalui Ajax
                if (nama != "" && alamat != "" && (document.getElementById("jenkel1").checked == true || document.getElementById("jenkel2").checked == true) && no_telp != "") {
                    $.ajax({
                        type: 'POST',
                        url: "form_action.php",
                        data: data,
                        success: function () {
                            // Muat ulang tabel data setelah pengiriman berhasil
                            $('.data').load("data.php");
                            // Bersihkan field formulir
                            document.getElementById("id").value = "";
                            document.getElementById("form-data").reset();
                        },
                        error: function (response) {
                            console.log(response.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>