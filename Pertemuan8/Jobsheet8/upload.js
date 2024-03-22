// Praktikum 3. Upload File dengan PHP dan Jquery Langkah 3
$(document).ready(function () {
    // Mengikat event submit pada formulir dengan ID 'upload-form'
    $('#upload-form').submit(function (e) {
        e.preventDefault(); // Mencegah pengiriman formulir secara default

        var formData = new FormData(this); // Membuat objek FormData dari formulir

        // Mengirimkan data file ke skrip PHP menggunakan AJAX
        $.ajax({
            type: 'POST', // Metode pengiriman data
            url: 'upload_ajax.php', // URL skrip PHP untuk mengelola pengunggahan file
            data: formData, // Data yang akan dikirim
            cache: false, // Menonaktifkan penyimpanan cache
            contentType: false, // Menonaktifkan tipe konten
            processData: false, // Menonaktifkan pemrosesan data
            success: function (response) { // Fungsi yang dipanggil jika pengunggahan berhasil
                $('#status').html(response); // Menampilkan respons dari skrip PHP dalam elemen dengan ID 'status'
            },
            error: function () { // Fungsi yang dipanggil jika terjadi kesalahan saat pengunggahan
                $('#status').html('Terjadi kesalahan saat mengunggah file. '); // Menampilkan pesan error
            }
        });
    });
});