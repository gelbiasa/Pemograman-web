// Isi dari script.js

// Kode dari file index.html
$(document).ready(function(){
    $("#loginForm").submit(function(event){
        event.preventDefault();
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(data){
                window.location.href = data;
            },
            error: function(xhr, status, error){
                alert("Username atau password Anda Salah, Silakah Coba Lagi");
            }
        });
    });
});

// Kode dari file home.php
$(document).ready(function(){
    $(".menu a").click(function(event){
        event.preventDefault();
        var href = $(this).attr('href');
        $.get(href, function(data){
            $("body").html(data);
        });
    });
});

$(document).ready(function(){
    $(".btn-back").click(function(){
        window.history.back();
    });
});

// Kode dari file pesan_pertandingan.php
$(document).ready(function(){
    // Mengatur harga sesuai dengan kualitas live yang dipilih
    $('#kualitas_live').change(function(){
        var kualitasLive = $(this).val();
        var harga;
        if (kualitasLive === "HD") {
            harga = 7000;
        } else if (kualitasLive === "2K") {
            harga = 15000;
        }
        $('#harga').val(harga);
    });
});

// Kode dari file riwayat_pesanan.php
$(document).ready(function () {
    // Tangani klik tombol Batalkan
    $('.cancel-button').click(function () {
        // Dapatkan ID pesanan dari atribut data
        var idPesanan = $(this).data('id');

        // Tampilkan dialog konfirmasi
        var confirmation = confirm("Apakah anda yakin ingin membatalkan pesanan?");
        if (confirmation) {
            // Kirim permintaan AJAX ke server untuk membatalkan pesanan
            $.ajax({
                method: 'POST',
                url: 'riwayat_pesanan.php', // Gunakan halaman ini sendiri untuk menangani pembatalan
                data: { id_pesanan: idPesanan },
                success: function (response) {
                    // Tampilkan pesan bahwa pesanan telah dibatalkan
                    alert('Pesanan berhasil dibatalkan');
                    // Muat ulang halaman untuk menampilkan pesanan yang diperbarui
                    window.location.reload();
                },
                error: function () {
                    // Tampilkan pesan jika terjadi kesalahan
                    alert('Terjadi kesalahan saat membatalkan pesanan');
                }
            });
        } else {
            // Tidak melakukan apa-apa jika pengguna memilih untuk tidak membatalkan pesanan
        }
    });
});