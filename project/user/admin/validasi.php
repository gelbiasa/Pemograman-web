<?php
session_start();

include '../../Koneksi/koneksi.php';

// Fetch data from all tables
$sql_mahasiswa = "SELECT *, 'Mahasiswa' as user_status FROM t_pending_mahasiswa";
$sql_alumni = "SELECT *, 'Alumni' as user_status FROM t_pending_alumni";
$sql_dosen = "SELECT *, 'Dosen' as user_status FROM t_pending_dosen";
$sql_tendik = "SELECT *, 'Tenaga Pendidik' as user_status FROM t_pending_tendik";
$sql_ortu = "SELECT *, 'Orang Tua' as user_status FROM t_pending_ortu";
$sql_industri = "SELECT *, 'Industri' as user_status FROM t_pending_industri";

$result_mahasiswa = $conn->query($sql_mahasiswa);
$result_alumni = $conn->query($sql_alumni);
$result_dosen = $conn->query($sql_dosen);
$result_tendik = $conn->query($sql_tendik);
$result_ortu = $conn->query($sql_ortu);
$result_industri = $conn->query($sql_industri);

$all_results = array_merge(
    $result_mahasiswa->fetch_all(MYSQLI_ASSOC),
    $result_alumni->fetch_all(MYSQLI_ASSOC),
    $result_dosen->fetch_all(MYSQLI_ASSOC),
    $result_tendik->fetch_all(MYSQLI_ASSOC),
    $result_ortu->fetch_all(MYSQLI_ASSOC),
    $result_industri->fetch_all(MYSQLI_ASSOC)
);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Registrasi - Politeknik Negeri Malang</title>
    <link rel="stylesheet" href="../../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include '../TemplateAdmin/headerAdmin.php'; ?>
    <div class="containerMain">
        <?php include '../TemplateAdmin/sidebarAdmin.php'; ?>
        <div class="containerKanan_AU">
            <div class="container_validasiluar">
                <div class="container_validasi">
                    <button id="backAU" class="btn-back_validasi">Back</button>
                    <h2 class="jarakh2validasi">Validasi Registrasi</h2>
                    
                    <?php if (empty($all_results)) { ?>
                        <p class="jarakh2norequest">Tidak ada responden yang melakukan registrasi.</p>
                    <?php } else { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>User Status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($all_results as $row) { ?>
                                    <tr>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['user_status']; ?></td>
                                        <td><button class="btn-view_V" data-id="<?php echo $row['pending_user_id']; ?>"
                                                data-status="<?php echo $row['user_status']; ?>">Lihat Selengkapnya</button>
                                        </td>
                                    </tr>
                                    <tr class="details" id="details-<?php echo $row['pending_user_id']; ?>">
                                        <td colspan="3">
                                            <?php if ($row['user_status'] == 'Mahasiswa') { ?>
                                                <p>Username: <?php echo $row['username']; ?></p>
                                                <p>Password: <?php echo $row['password']; ?></p>
                                                <p>NIM: <?php echo $row['responden_nim']; ?></p>
                                                <p>Prodi: <?php echo $row['responden_prodi']; ?></p>
                                                <p>Email: <?php echo $row['responden_email']; ?></p>
                                                <p>HP: <?php echo $row['responden_hp']; ?></p>
                                                <p>Tahun Masuk: <?php echo $row['tahun_masuk']; ?></p>
                                            <?php } elseif ($row['user_status'] == 'Alumni') { ?>
                                                <p>Username: <?php echo $row['username']; ?></p>
                                                <p>Password: <?php echo $row['password']; ?></p>
                                                <p>NIM: <?php echo $row['responden_nim']; ?></p>
                                                <p>Prodi: <?php echo $row['responden_prodi']; ?></p>
                                                <p>Email: <?php echo $row['responden_email']; ?></p>
                                                <p>HP: <?php echo $row['responden_hp']; ?></p>
                                                <p>Tahun Lulus: <?php echo $row['tahun_lulus']; ?></p>
                                            <?php } elseif ($row['user_status'] == 'Dosen') { ?>
                                                <p>Username: <?php echo $row['username']; ?></p>
                                                <p>Password: <?php echo $row['password']; ?></p>
                                                <p>NIP: <?php echo $row['responden_nip']; ?></p>
                                                <p>Unit: <?php echo $row['responden_unit']; ?></p>
                                            <?php } elseif ($row['user_status'] == 'Tenaga Pendidik') { ?>
                                                <p>Username: <?php echo $row['username']; ?></p>
                                                <p>Password: <?php echo $row['password']; ?></p>
                                                <p>No. Pegawai: <?php echo $row['responden_nopeg']; ?></p>
                                                <p>Unit: <?php echo $row['responden_unit']; ?></p>
                                            <?php } elseif ($row['user_status'] == 'Orang Tua') { ?>
                                                <p>Username: <?php echo $row['username']; ?></p>
                                                <p>Password: <?php echo $row['password']; ?></p>
                                                <p>Nama: <?php echo $row['responden_nama']; ?></p>
                                                <p>Jenis Kelamin: <?php echo $row['responden_jk']; ?></p>
                                                <p>Umur: <?php echo $row['responden_umur']; ?></p>
                                                <p>HP: <?php echo $row['responden_hp']; ?></p>
                                                <p>Pendidikan: <?php echo $row['responden_pendidikan']; ?></p>
                                                <p>Pekerjaan: <?php echo $row['responden_pekerjaan']; ?></p>
                                                <p>Penghasilan: <?php echo $row['responden_penghasilan']; ?></p>
                                                <p>NIM Mahasiswa: <?php echo $row['mahasiswa_nim']; ?></p>
                                                <p>Nama Mahasiswa: <?php echo $row['mahasiswa_nama']; ?></p>
                                                <p>Prodi Mahasiswa: <?php echo $row['mahasiswa_prodi']; ?></p>
                                            <?php } elseif ($row['user_status'] == 'Industri') { ?>
                                                <p>Username: <?php echo $row['username']; ?></p>
                                                <p>Password: <?php echo $row['password']; ?></p>
                                                <p>Nama: <?php echo $row['responden_nama']; ?></p>
                                                <p>Jabatan: <?php echo $row['responden_jabatan']; ?></p>
                                                <p>Perusahaan: <?php echo $row['responden_perusahaan']; ?></p>
                                                <p>Email: <?php echo $row['responden_email']; ?></p>
                                                <p>HP: <?php echo $row['responden_hp']; ?></p>
                                                <p>Kota: <?php echo $row['responden_kota']; ?></p>
                                            <?php } ?>
                                            <button class="btn-accept_V" data-id="<?php echo $row['pending_user_id']; ?>"
                                                data-status="<?php echo $row['user_status']; ?>">Accept</button>
                                            <button class="btn-reject_V" data-id="<?php echo $row['pending_user_id']; ?>"
                                                data-status="<?php echo $row['user_status']; ?>">Reject</button>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } ?>

                    <script>
                        $(document).ready(function () {
                            $('.btn-view_V').click(function () {
                                var id = $(this).data('id');
                                $('#details-' + id).toggle();
                                $(this).toggleClass('active');
                            });

                            $('.btn-accept_V').click(function () {
                                var id = $(this).data('id');
                                var status = $(this).data('status');
                                var url = getProcessUrl(status);
                                $.post(url, { id: id, action: 'accept' }, function (response) {
                                    location.reload();
                                });
                            });

                            $('.btn-reject_V').click(function () {
                                var id = $(this).data('id');
                                var status = $(this).data('status');
                                var url = getProcessUrl(status);
                                $.post(url, { id: id, action: 'reject' }, function (response) {
                                    location.reload();
                                });
                            });

                            function getProcessUrl(status) {
                                switch (status) {
                                    case 'Alumni':
                                        return 'prosesValidasiA.php';
                                    case 'Dosen':
                                        return 'prosesValidasiD.php';
                                    case 'Tenaga Pendidik':
                                        return 'prosesValidasiT.php';
                                    case 'Orang Tua':
                                        return 'prosesValidasiOT.php';
                                    case 'Industri':
                                        return 'prosesValidasiI.php';
                                    default:
                                        return 'prosesValidasiM.php';
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
$conn->close();
?>
