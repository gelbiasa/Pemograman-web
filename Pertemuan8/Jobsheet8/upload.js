/* Praktikum 3. Upload File dengan PHP dan Jquery Langkah 3
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
*/

// Praktikum 4. Menghias Upload File Langkah 3
$(document).ready(function(){
    // Ketika input file diubah (file dipilih atau dihapus)
    $('#file').change(function(){
        // Memeriksa apakah ada file yang dipilih
        if (this.files.length > 0) {
            // Mengaktifkan tombol unggah dan mengatur opasitasnya menjadi 1
            $('#upload-button').prop('disabled', false).css('opacity', 1);
        } else {
            // Menonaktifkan tombol unggah dan mengatur opasitasnya menjadi 0.5
            $('#upload-button').prop('disabled', true).css('opacity', 0.5);
        }
    });

    // Ketika formulir unggah file disubmit
    $('#upload-form').submit(function(e){
        // Mencegah perilaku bawaan dari pengiriman formulir
        e.preventDefault();
        
        // Membuat objek FormData dari formulir
        var formData = new FormData(this);
        
        // Mengirim permintaan AJAX untuk mengunggah file
        $.ajax({
            type: 'POST',
            url: 'upload_ajax.php',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            // Ketika permintaan berhasil
            success: function(response){
                // Menampilkan respons dari server di elemen dengan id "status"
                $('#status').html(response);
            },
            // Ketika terjadi kesalahan dalam permintaan
            error: function(){
                // Menampilkan pesan kesalahan
                $('#status').html('Terjadi kesalahan saat mengunggah file.');
            }
        });
    });
});