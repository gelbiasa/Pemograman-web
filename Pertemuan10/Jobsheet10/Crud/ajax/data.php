<!-- Praktikum 6. Tampilan CRUD dengan Ajax -->
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis kelamin</th>
            <th>Alamat</th>
            <th>No telp</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Mengimpor koneksi ke database
        include('koneksi.php');
        // Variabel untuk nomor urut
        $no = 1;
        // Query untuk mengambil data anggota
        $query = "SELECT * FROM anggota ORDER BY id DESC";
        $sql = $db1->prepare($query);
        $sql->execute();
        $res1 = $sql->get_result();
        // Jika ada hasil dari query
        if ($res1->num_rows > 0) {
            while ($row = $res1->fetch_assoc()) {
                $id = $row['id'];
                $nama = $row['nama'];
                // Konversi jenis kelamin menjadi teks
                $jenis_kelamin = ($row['jenis_kelamin'] == 'L') ? "Laki-laki" : "Perempuan";
                $alamat = $row['alamat'];
                $no_telp = $row['no_telp'];
        ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $jenis_kelamin; ?></td>
                    <td><?php echo $alamat; ?></td>
                    <td><?php echo $no_telp; ?></td>
                    <td>
                        <!-- Tombol untuk mengedit data -->
                        <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data">
                            <i class="fa fa-edit"></i>Edit
                        </button>
                        <!-- Tombol untuk menghapus data -->
                        <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data">
                            <i class="fa fa-trash"></i>Hapus
                        </button>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <!-- Jika tidak ada data ditemukan -->
            <tr>
                <td colspan="7">Tidak ada data ditemukan</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#example').DataTable();
    });

    // Fungsi untuk mereset pesan error
    function reset() {
        document.getElementById("err_nama").innerHTML = "";
        document.getElementById("err_jenis_kelamin").innerHTML = "";
        document.getElementById("err_alamat").innerHTML = "";
        document.getElementById("err_no_telp").innerHTML = "";
    }

    // Mengatur tindakan ketika tombol edit_data diklik
    $(document).on('click', '.edit_data', function() {
        // Menggulir ke atas halaman
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');
        var id = $(this).attr('id');
        // Mengambil data anggota berdasarkan ID
        $.ajax({
            type: 'POST',
            url: "get_data.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                // Mereset pesan error
                reset();
                // Menggulir ke elemen form
                $('html, body').animate({
                    scrollTop: 30
                }, 'slow');
                // Mengisi nilai pada form dengan data yang diambil
                document.getElementById("id").value = response.id;
                document.getElementById("nama").value = response.nama;
                document.getElementById("alamat").value = response.alamat;
                document.getElementById("no_telp").value = response.no_telp;
                if (response.jenis_kelamin == "L") {
                    document.getElementById("jenkel1").checked = true;
                } else {
                    document.getElementById("jenkel2").checked = true;
                }
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    });
</script>
<script>
    // Mengatur tindakan ketika tombol hapus_data diklik
    $(document).on('click', '.hapus_data', function() {
        var id = $(this).attr('id');
        // Menghapus data anggota berdasarkan ID
        $.ajax({
            type: 'POST',
            url: "hapus_data.php",
            data: {
                id: id
            },
            success: function() {
                // Memuat ulang tabel data setelah penghapusan berhasil
                $('.data').load("data.php");
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    });
</script>