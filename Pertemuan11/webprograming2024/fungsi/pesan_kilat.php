<!-- Praktikum 2. Folder Fungsi Langkah 4 pesan_kilat.php -->
<?php
    // Fungsi untuk menetapkan pesan flash data ke dalam sesi
    function set_flashdata($key="", $value=""){
        if(!empty($key) && !empty($value)){
            $_SESSION['_flashdata'][$key] = $value;
            return true;
        }
        return false;
    }

    // Fungsi untuk mengambil pesan flash data dari sesi dan menghapusnya setelah diambil
    function get_flashdata($key = ""){
        if (!empty($key) && isset($_SESSION['_flashdata'][$key])) {
            $data = $_SESSION['_flashdata'][$key];
            unset($_SESSION['_flashdata'][$key]);
            return $data;
        } else {
            // Menampilkan pesan peringatan jika pesan flash data tidak didefinisikan
            echo "<script>alert(' Flash Message \'{$key}\' is not defined.')</script>";
        }
    }

    // Fungsi untuk menampilkan pesan dengan gaya yang berbeda tergantung pada jenisnya
    function pesan($key = "", $pesan = ""){
        // Menentukan jenis pesan dan menetapkan pesan flash data sesuai
        if ($key == "info") {
            set_flashdata("info", "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
            <strong>Info!</strong> {$pesan}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
        } elseif ($key == "success") {
            set_flashdata("success", "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> {$pesan}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
        } elseif ($key == "danger") {
            set_flashdata("danger", "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> {$pesan}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
        } elseif ($key == "warning") {
            set_flashdata("warning", "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Peringatan!</strong> {$pesan}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
        }
    }
?>