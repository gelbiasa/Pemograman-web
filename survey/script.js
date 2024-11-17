$(document).ready(function () {
    // Toggle visibility password
    $('#togglePassword').click(function () {
        const password = $('#password');
        const type = password.attr('type') === 'password' ? 'text' : 'password';
        password.attr('type', type);
        // Mengganti ikon mata
        $(this).find('i').toggleClass('fa-eye-slash fa-eye');
    });

    function showErrorOverlay(errorMessage) {
        var content = '<div class="overlay-content error-message">' +
            '<h2><i class="fas fa-exclamation-circle"></i> Terjadi Kesalahan/Error</h2>' +
            '<p>' + errorMessage + '</p>' +
            '<span class="close-overlay"><i class="fas fa-times"></i></span>' +
            '</div>';

        // Tampilkan overlay
        $('#overlay').fadeIn();

        // Tampilkan pesan kesalahan
        $('#overlay').html(content);

        // Tampilkan overlay content
        $('#overlay').find('.error-message').fadeIn();
    }

    // Fungsi untuk menangani submit form login
    $('#loginForm').submit(function (e) {
        e.preventDefault(); // Hindari pengiriman form
        // Mendapatkan username dan password
        var username = $('#username').val();
        var password = $('#password').val();
        // Mendapatkan user_status yang sedang aktif
        var user_status = $('.buttonUser.active').val(); // Menggunakan user_status sebagai pengganti kategori

        // Debug: Periksa apakah data yang dikirim sesuai
        console.log("Username:", username);
        console.log("Password:", password);
        console.log("User Status:", user_status);

        // Kirim data login ke login.php menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: '../Koneksi/koneksiLogin.php',
            data: {
                username: username,
                password: password,
                user_status: user_status // Mengirim user_status yang sedang aktif
            },
            success: function (response) {
                console.log("Respon dari Server:", response);
                console.log("Respon dari Server:", response);
                if (response === "success") {
                    // Jika username dan password benar, arahkan ke userPage.php yang sesuai dengan user_status
                    switch (user_status) {
                        case 'admin':
                            window.location.href = "../user/admin/userPage.php"; // Arahkan ke halaman admin
                            break;
                        case 'mahasiswa':
                            window.location.href = "../user/mahasiswa/userPage.php"; // Arahkan ke halaman mahasiswa
                            break;
                        case 'dosen':
                            window.location.href = "../user/dosen/userPage.php"; // Arahkan ke halaman dosen
                            break;
                        case 'tenaga pendidik':
                            window.location.href = "../user/tendik/userPage.php"; // Arahkan ke halaman tenaga pendidik
                            break;
                        case 'orang tua':
                            window.location.href = "../user/ortu/userPage.php"; // Arahkan ke halaman orang tua
                            break;
                        case 'alumni':
                            window.location.href = "../user/alumni/userPage.php"; // Arahkan ke halaman alumni
                            break;
                        case 'industri':
                            window.location.href = "../user/industri/userPage.php"; // Arahkan ke halaman industri
                            break;
                        default:
                            console.error("User status tidak valid:", user_status);
                            break;
                    }
                } else if (response === "wrong_password") {
                    // Jika password salah, tampilkan pesan error dalam bentuk overlay
                    showErrorOverlay("Password salah. Silakan coba lagi.");
                } else if (response === "user_not_found") {
                    // Jika pengguna tidak ditemukan, tampilkan pesan error dalam bentuk overlay
                    showErrorOverlay("Username tidak ditemukan.");
                } else {
                    // Jika ada kesalahan lain yang tidak diharapkan, tampilkan pesan error dalam bentuk overlay
                    showErrorOverlay("Terjadi kesalahan. Silakan coba lagi.");
                }
            },
            error: function (xhr, status, error) {
                // Jika terjadi kesalahan koneksi, tampilkan pesan error dalam bentuk overlay
                var errorMessage = "Terjadi kesalahan koneksi. Silakan coba lagi.";
                if (xhr.status === 0) {
                    errorMessage = "Tidak dapat terhubung. Periksa koneksi internet Anda.";
                } else if (xhr.status === 404) {
                    errorMessage = "Halaman tidak ditemukan.";
                } else if (xhr.status === 500) {
                    errorMessage = "Terjadi kesalahan server. Silakan coba lagi nanti.";
                }
                showErrorOverlay(errorMessage);
            }
        });
    });

    // Fungsi untuk menutup overlay dan pesan kesalahan saat tombol close di klik
    $('#close-overlay').click(function () {
        $('#overlay').fadeOut();
        $('#error-overlay').fadeOut();
    });

    // Fungsi untuk menangani klik tombol role (mahasiswa, admin, dosen, dst.)
    $('.buttonUser').click(function () {
        // Menghapus kelas 'active' dari semua tombol
        $('.buttonUser').removeClass('active').css('background-color', '#181e8a');
        // Menambahkan kelas 'active' ke tombol yang diklik
        $(this).addClass('active').css('background-color', '#3dc7d9');
        // Simpan user_status yang dipilih
        var selectedUserStatus = $(this).val();

        // Debug: Periksa apakah user_status terkirim dengan benar
        console.log("User Status yang Dipilih:", selectedUserStatus);

        // Isi nilai user_status pada input tersembunyi
        $('#user_status').val(selectedUserStatus);
    });

    $('#logoutButton').click(function () {
        // Kirim permintaan logout ke logout.php
        $.ajax({
            type: 'POST',
            url: '../../Koneksi/koneksiLogout.php',
            success: function (response) {
                // Redirect ke halaman login setelah logout berhasil
                window.location.href = "../../index.html";
            },
            error: function (xhr, status, error) {
                // Tampilkan pesan jika terjadi kesalahan
                console.error("Terjadi kesalahan saat logout:", error);
            }
        });
    });

    // Tambahkan event listener untuk menangani klik pada tombol Profil
    document.getElementById("profilButton").addEventListener("click", function () {
        // Arahkan pengguna ke halaman profilPage.php
        window.location.href = "profilPage.php";
    });

    $(document).on('click', '.user-name', function () {
        var username = $(this).text().trim(); // Ambil teks nama pengguna
        var user_status = $('.buttonUser.active').val();
        window.location.href = "userPage.php";
    });

    document.getElementById("surveyButton").addEventListener("click", function () {
        // Arahkan pengguna ke halaman profilPage.php
        window.location.href = "surveyPage.php";
    });

    document.getElementById("hasilButton").addEventListener("click", function () {
        // Arahkan pengguna ke halaman profilPage.php
        window.location.href = "surveyHasil.php";
    });

    // Fungsi untuk menampilkan overlay
    function showOverlay(content) {
        $('#overlay').fadeIn(); // Tampilkan overlay
        $('#overlay').html(content); // Tambahkan konten ke overlay
    }
});

$(document).ready(function () {
    // ...

    // Fungsi untuk menampilkan overlay
    function showOverlay(content) {
        $('#overlay').fadeIn(); // Tampilkan overlay
        $('#overlay').html(content); // Tambahkan konten ke overlay
    }

    // Fungsi untuk menyembunyikan overlay
    function hideOverlay() {
        $('#overlay').fadeOut(); // Sembunyikan overlay
        $('#overlay').html(''); // Kosongkan konten overlay
    }

    // Tambahkan event listener untuk menutup overlay saat tombol close diklik
    $(document).on('click', '.close-overlay', function () {
        hideOverlay();
    });

    // Fungsi untuk menampilkan halaman lupa password dalam bentuk overlay
    $('.lupa-password').click(function (e) {
        e.preventDefault(); // Hindari navigasi ke halaman baru
        var content = '<div class="overlay-content">' +
            '<h2><i class="fas fa-exclamation-circle"></i> Lupa Password</h2>' +
            '<p>Jika password lupa silahkan menghubungi Gelby Selaku Admin Survey Kepuasan</p>' +
            '<span class="close-overlay"><i class="fas fa-times"></i></span>' +
            '</div>';
        showOverlay(content);
    });
});

$(document).ready(function () {
    $("#ManajemenUser").click(function () {
        window.location.href = "mUser.php";
    });

    $("#mSurvey").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#mHasil").click(function () {
        window.location.href = "mHasil.php";
    });


    $("#mAU").click(function () {
        window.location.href = "mAllUser.php";
    });

    $("#mDA").click(function () {
        window.location.href = "mDataAdmin.php";
    });

    $("#mDR").click(function () {
        window.location.href = "mDataResponden.php";
    });

    $("#backAU").click(function () {
        window.location.href = "mUser.php";
    });

    $("#backS").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#mSmhs").click(function () {
        window.location.href = "mSmhs.php";
    });

    $("#addSFmhs").click(function () {
        window.location.href = "addSFmhs.php";
    });

    $("#addSSImhs").click(function () {
        window.location.href = "addSSImhs.php";
    });

    $("#addSDmhs").click(function () {
        window.location.href = "addSDmhs.php";
    });

    $("#backSS").click(function () {
        window.location.href = "mSmhs.php";
    });

    $("#nextSF").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSFmhs.php";
        }
    });

    $("#nextSSI").click(function () {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSSImhs.php";
        }
    });

    $("#nextSD").click(function () {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSDmhs.php";
        }
    });

    $("#backSSF").click(function () {
        window.location.href = "addSFmhs.php";
    });

    $("#backSSSI").click(function () {
        window.location.href = "addSSImhs.php";
    });

    $("#backSSD").click(function () {
        window.location.href = "addSDmhs.php";
    });

    $("#backSSFdsn").click(function () {
        window.location.href = "addSFdsn.php";
    });

    $("#backSSSIdsn").click(function () {
        window.location.href = "addSSIdsn.php";
    });

    $("#submitSSF").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });

    $("#submitSSSI").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });

    $("#submitSSD").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });

    $("#submitSSPK").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });

    $("#submitSSKP").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });

    $("#submitSSSDM").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });

    $("#submitSSDP").click(function (e) {
        // Periksa apakah semua bidang telah diisi sebelum mengirimkan formulir
        var valid = true;
        $("input[type='text'], textarea").each(function () {
            if ($(this).val() === "") {
                valid = false;
                return false; // Berhenti dari loop jika ada bidang yang kosong
            }
        });
        // Jika ada bidang yang kosong, hentikan tindakan pengiriman formulir
        if (!valid) {
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum menyimpan soal!");
        }
    });


    $("#backSSFk").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#backSSSIk").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#backSSDk").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#backSSPKk").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#backSSKPk").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#backSSSDMk").click(function () {
        window.location.href = "mSurvey.php";
    });

    $("#backSSDPk").click(function () {
        window.location.href = "mSurvey.php";
    });


    $("#mSdsn").click(function () {
        window.location.href = "mSdsn.php";
    });

    $("#addSFdsn").click(function () {
        window.location.href = "addSFdsn.php";
    });

    $("#addSSIdsn").click(function () {
        window.location.href = "addSSIdsn.php";
    });

    $("#backSD").click(function () {
        window.location.href = "mSdsn.php";
    });

    $("#backSSFdsn").click(function () {
        window.location.href = "addSFdsn.php";
    });

    $("#backSSSIdsn").click(function () {
        window.location.href = "addSSIdsn.php";
    });

    $("#nextSFdsn").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSFdsn.php";
        }
    });

    $("#nextSSIdsn").click(function () {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSSIdsn.php";
        }
    });


    $("#mStndk").click(function () {
        window.location.href = "mStndk.php";
    });

    $("#addSFtndk").click(function () {
        window.location.href = "addSFtndk.php";
    });

    $("#addSSItndk").click(function () {
        window.location.href = "addSSItndk.php";
    });

    $("#backST").click(function () {
        window.location.href = "mStndk.php";
    });

    $("#backSSFtndk").click(function () {
        window.location.href = "addSFdsn.php";
    });

    $("#backSSSItndk").click(function () {
        window.location.href = "addSSItndk.php";
    });

    $("#nextSFtndk").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSFtndk.php";
        }
    });

    $("#nextSSItndk").click(function () {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSSItndk.php";
        }
    });


    $("#mSalmn").click(function () {
        window.location.href = "mSalmn.php";
    });

    $("#addSPKalmn").click(function () {
        window.location.href = "addSPKalmn.php";
    });

    $("#backSA").click(function () {
        window.location.href = "mSalmn.php";
    });

    $("#backSSPKalmn").click(function () {
        window.location.href = "addSPKalmn.php";
    });

    $("#nextSPKalmn").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSPKalmn.php";
        }
    });


    $("#mSortu").click(function () {
        window.location.href = "mSortu.php";
    });

    $("#addSKPortu").click(function () {
        window.location.href = "addSKPortu.php";
    });

    $("#backSO").click(function () {
        window.location.href = "mSortu.php";
    });

    $("#backSSKPortu").click(function () {
        window.location.href = "addSKPortu.php";
    });

    $("#nextSKPortu").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSKPortu.php";
        }
    });


    $("#mSindustri").click(function () {
        window.location.href = "mSindustri.php";
    });

    $("#addSSDMindustri").click(function () {
        window.location.href = "addSSDMindustri.php";
    });

    $("#addSDPindustri").click(function () {
        window.location.href = "addSDPindustri.php";
    });

    $("#backSI").click(function () {
        window.location.href = "mSindustri.php";
    });

    $("#backSSSDMindustri").click(function () {
        window.location.href = "addSSDMindustri.php";
    });

    $("#backSSDPindustri").click(function () {
        window.location.href = "addSDPindustri.php";
    });

    $("#nextSSDMindustri").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSSDMindustri.php";
        }
    });

    $("#nextSDPindustri").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSDPindustri.php";
        }
    });


    // Menonaktifkan tombol "View" jika survey_tanggal null
    $("button.btn-view").each(function () {
        if ($(this).closest("tr").find("td:nth-child(4)").text().trim() == "") {
            $(this).attr("disabled", true);
        }
    });

    $("#hasilSurvey").click(function () {
        window.location.href = "hasilSurvey.php";
    });
});

$(document).ready(function () {
    $("#mStndk").click(function () {
        window.location.href = "mStndk.php";
    });

    $("#addSFtndk").click(function () {
        window.location.href = "addSFtndk.php";
    });

    $("#addSSItndk").click(function () {
        window.location.href = "addSSItndk.php";
    });

    $("#backST").click(function () {
        window.location.href = "mStndk.php";
    });

    $("#backSSSItndk").click(function () {
        window.location.href = "addSSItndk.php";
    });

    $("#nextSFtndk").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSFtndk.php";
        }
    });

    $("#nextSSItndk").click(function () {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSSItndk.php";
        }
    });

    $("#backSSFtndk").click(function () {
        window.location.href = "addSFdsn.php";
    });


    $("#mSalmn").click(function () {
        window.location.href = "mSalmn.php";
    });

    $("#addSPKalmn").click(function () {
        window.location.href = "addSPKalmn.php";
    });

    $("#backSA").click(function () {
        window.location.href = "mSalmn.php";
    });

    $("#backSSPKalmn").click(function () {
        window.location.href = "addSPKalmn.php";
    });

    $("#nextSPKalmn").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSPKalmn.php";
        }
    });

    $("#mSortu").click(function () {
        window.location.href = "mSortu.php";
    });

    $("#addSKPortu").click(function () {
        window.location.href = "addSKPortu.php";
    });

    $("#backSO").click(function () {
        window.location.href = "mSortu.php";
    });

    $("#backSSKPortu").click(function () {
        window.location.href = "addSKPortu.php";
    });

    $("#nextSKPortu").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSKPortu.php";
        }
    });


    $("#mSindustri").click(function () {
        window.location.href = "mSindustri.php";
    });

    $("#addSSDMindustri").click(function () {
        window.location.href = "addSSDMindustri.php";
    });

    $("#addSDPindustri").click(function () {
        window.location.href = "addSDPindustri.php";
    });

    $("#backSI").click(function () {
        window.location.href = "mSindustri.php";
    });

    $("#backSSSDMindustri").click(function () {
        window.location.href = "addSSDMindustri.php";
    });

    $("#backSSDPindustri").click(function () {
        window.location.href = "addSDPindustri.php";
    });

    $("#nextSSDMindustri").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSSDMindustri.php";
        }
    });

    $("#nextSDPindustri").click(function (e) {
        // Periksa apakah semua bidang form telah diisi
        var kodeSurvey = $('#survey_kode').val();
        var namaSurvey = $('#survey_nama').val();
        var deskripsiSurvey = $('#survey_deskripsi').val();
        var banyakSoal = $('#banyak_soal').val();

        if (kodeSurvey === '' || namaSurvey === '' || deskripsiSurvey === '' || banyakSoal === '') {
            // Jika ada bidang yang belum diisi, hentikan tindakan default
            e.preventDefault();
            // Tampilkan pesan atau lakukan tindakan lain sesuai kebutuhan
            alert("Harap isi semua bidang sebelum melanjutkan!");
        } else {
            // Jika semua bidang telah diisi, arahkan pengguna ke halaman berikutnya
            window.location.href = "addSoalSDPindustri.php";
        }
    });
})

$(document).on('click', '.user-name', function () {
    var username = $(this).text().trim(); // Ambil teks nama pengguna
    var user_status = $('.buttonUser.active').val();
    window.location.href = "userPage.php";
});

$(document).ready(function () {
    if (!$('.blok_SP_FM').hasClass('completed')) {
        document.getElementById("surveyFasilitasButton").addEventListener("click", function () {
            window.location.href = "isiSurveyFasilitasMahasiswa.php?survey_nama=Survey Fasilitas";
        });
    }

    if (!$('.blok_SP_SM').hasClass('completed')) {
        document.getElementById("surveySistemButton").addEventListener("click", function () {
            window.location.href = "isiSurveySistemMahasiswa.php?survey_nama=Survey Sistem Informasi";
        });
    }

    if (!$('.blok_SP_DM').hasClass('completed')) {
        document.getElementById("surveyDosenButton").addEventListener("click", function () {
            window.location.href = "isiSurveyDosenMahasiswa.php?survey_nama=Survey Dosen";
        });
    }

    if (!$('.blok_SP_FD').hasClass('completed')) {
        document.getElementById("surveyFD_button").addEventListener("click", function () {
            window.location.href = "isiSurveyFasilitasDosen.php?survey_nama=Survey Fasilitas";
        });
    }

    if (!$('.blok_SP_SD').hasClass('completed')) {
        document.getElementById("surveySD_button").addEventListener("click", function () {
            window.location.href = "isiSurveySistemDosen.php?survey_nama=Survey Sistem Informasi";
        });
    }

    if (!$('.blok_SP_FT').hasClass('completed')) {
        document.getElementById("surveyFT_button").addEventListener("click", function () {
            window.location.href = "isiSurveyFasilitasTendik.php?survey_nama=Survey Fasilitas";
        });
    }

    if (!$('.blok_SP_ST').hasClass('completed')) {
        document.getElementById("surveyST_button").addEventListener("click", function () {
            window.location.href = "isiSurveySistemTendik.php?survey_nama=Survey Sistem Informasi";
        });
    }

    if (!$('.blok_SP_PK').hasClass('completed')) {
        document.getElementById("survey_PK_AlumniButton").addEventListener("click", function () {
            window.location.href = "isiSurvey_PK_Alumni.php?survey_nama=Survey Pasca Kelulusan";
        });
    }

    if (!$('.blok_SP_PO').hasClass('completed')) {
        document.getElementById("surveyPO_button").addEventListener("click", function () {
            window.location.href = "isiSurveyPelayananOrtu.php?survey_nama=Survey Kepuasan Pelayanan";
        });
    }

    if (!$('.blok_SP_SDMI').hasClass('completed')) {
        document.getElementById("surveySDMI_button").addEventListener("click", function () {
            window.location.href = "isiSurveySDMIndustri.php?survey_nama=Survey Sumber Daya Mahasiswa";
        });
    }

    if (!$('.blok_SP_DPI').hasClass('completed')) {
        document.getElementById("surveyDPI_button").addEventListener("click", function () {
            window.location.href = "isiSurveyDPIndustri.php?survey_nama=Survey Dosen Pembimbing";
        });
    }

    if (!$('.blok_SP_HFM').hasClass('completed')) {
        document.getElementById("hasilSurveyFasilitasButton").addEventListener("click", function () {
            window.location.href = "hasilSurveyFasilitasMahasiswa.php?survey_nama=Survey Fasilitas";
        });
    }

    if (!$('.blok_SP_HSM').hasClass('completed')) {
        document.getElementById("hasilSurveySistemButton").addEventListener("click", function () {
            window.location.href = "hasilSurveySistemMahasiswa.php?survey_nama=Survey Sistem Informasi";
        });
    }

    if (!$('.blok_SP_HDM').hasClass('completed')) {
        document.getElementById("hasilSurveyDosenButton").addEventListener("click", function () {
            window.location.href = "hasilSurveyDosenMahasiswa.php?survey_nama=Survey Dosen";
        });
    }

    if (!$('.blok_SP_HFD').hasClass('completed')) {
        document.getElementById("hasilSurveyFD_button").addEventListener("click", function () {
            window.location.href = "hasilSurveyFasilitasDosen.php?survey_nama=Survey Fasilitas";
        });
    }

    if (!$('.blok_SP_HSD').hasClass('completed')) {
        document.getElementById("hasilSurveySD_button").addEventListener("click", function () {
            window.location.href = "hasilSurveySistemDosen.php?survey_nama=Survey Sistem Informasi";
        });
    }

    if (!$('.blok_SP_HFT').hasClass('completed')) {
        document.getElementById("hasilSurveyFT_button").addEventListener("click", function () {
            window.location.href = "hasilSurveyFasilitasTendik.php?survey_nama=Survey Fasilitas";
        });
    }

    if (!$('.blok_SP_HST').hasClass('completed')) {
        document.getElementById("hasilSurveyST_button").addEventListener("click", function () {
            window.location.href = "hasilSurveySistemTendik.php?survey_nama=Survey Sistem Informasi";
        });
    }

    if (!$('.blok_SP_HPK').hasClass('completed')) {
        document.getElementById("hasilSurvey_PK_AlumniButton").addEventListener("click", function () {
            window.location.href = "hasilSurvey_PK_Alumni.php?survey_nama=Survey Pasca Kelulusan";
        });
    }

    if (!$('.blok_SP_HPO').hasClass('completed')) {
        document.getElementById("hasilSurveyPO_button").addEventListener("click", function () {
            window.location.href = "hasilSurveyPelayananOrtu.php?survey_nama=Survey Kepuasan Pelayanan";
        });
    }

    if (!$('.blok_SP_HSDMI').hasClass('completed')) {
        document.getElementById("hasilSurveySDMI_button").addEventListener("click", function () {
            window.location.href = "hasilSurveySDMIndustri.php?survey_nama=Survey Sumber Daya Mahasiswa";
        });
    }

    if (!$('.blok_SP_HDPI').hasClass('completed')) {
        document.getElementById("hasilSurveyDPI_button").addEventListener("click", function () {
            window.location.href = "hasilSurveyDPIndustri.php?survey_nama=Survey Dosen Pembimbing";
        });
    }

});

$(document).ready(function () {
    $('.hasilSurvey-buttonM').on('click', function (event) {
        event.stopImmediatePropagation(); // Mencegah event bubbling

        if ($(this).hasClass('completed')) {
            const surveyType = $(this).attr('id');
            let targetPage = '';
            switch (surveyType) {
                case 'hasilSurveyFasilitasButton':
                    targetPage = 'hasilSurveyFasilitasMahasiswa.php?survey_nama=Survey Fasilitas';
                    break;
                case 'hasilSurveySistemButton':
                    targetPage = 'hasilSurveySistemMahasiswa.php?survey_nama=Survey Sistem Informasi';
                    break;
                case 'hasilSurveyDosenButton':
                    targetPage = 'hasilSurveyDosenMahasiswa.php?survey_nama=Survey Dosen';
                    break;
                default:
                    return;
            }
            window.location.href = targetPage;
        } else {
            alert('Tidak ada hasil, Anda belum mengisi survey');
        }
    });
});

$(document).ready(function () {
    $('.hasilSurvey-buttonD').on('click', function (event) {
        event.stopImmediatePropagation(); // Mencegah event bubbling

        if ($(this).hasClass('completed')) {
            const surveyType = $(this).attr('id');
            let targetPage = '';
            switch (surveyType) {
                case 'hasilSurveyFD_button':
                    targetPage = 'hasilSurveyFasilitasDosen.php?survey_nama=Survey Fasilitas';
                    break;
                case 'hasilSurveySD_button':
                    targetPage = 'hasilSurveySistemDosen.php?survey_nama=Survey Sistem Informasi';
                    break;
                default:
                    return;
            }
            window.location.href = targetPage;
        } else {
            alert('Tidak ada hasil, Anda belum mengisi survey');
        }
    });
});

$(document).ready(function () {
    $('.hasilSurvey-buttonT').on('click', function (event) {
        event.stopImmediatePropagation(); // Mencegah event bubbling

        if ($(this).hasClass('completed')) {
            const surveyType = $(this).attr('id');
            let targetPage = '';
            switch (surveyType) {
                case 'hasilSurveyFT_button':
                    targetPage = 'hasilSurveyFasilitasTendik.php?survey_nama=Survey Fasilitas';
                    break;
                case 'hasilSurveyST_button':
                    targetPage = 'hasilSurveySistemTendik.php?survey_nama=Survey Informasi';
                    break;
                default:
                    return;
            }
            window.location.href = targetPage;
        } else {
            alert('Tidak ada hasil, Anda belum mengisi survey');
        }
    });
});

$(document).ready(function () {
    $('.hasilSurvey-buttonI').on('click', function (event) {
        event.stopImmediatePropagation(); // Mencegah event bubbling

        if ($(this).hasClass('completed')) {
            const surveyType = $(this).attr('id');
            let targetPage = '';
            switch (surveyType) {
                case 'hasilSurveySDMI_button':
                    targetPage = 'hasilSurveySDMIndustri.php?survey_nama=Survey Sumber Daya Mahasiswa';
                    break;
                case 'hasilSurveyDPI_button':
                    targetPage = 'hasilSurveyDPIndustri.php?survey_nama=Survey Dosen Pembimbing';
                    break;
                default:
                    return;
            }
            window.location.href = targetPage;
        } else {
            alert('Tidak ada hasil, Anda belum mengisi survey');
        }
    });
});

$(document).ready(function () {
    $('.hasilSurvey-buttonOT').on('click', function (event) {
        event.stopImmediatePropagation(); // Mencegah event bubbling

        if ($(this).hasClass('completed')) {
            const surveyType = $(this).attr('id');
            let targetPage = '';
            switch (surveyType) {
                case 'hasilSurveyPO_button':
                    targetPage = 'hasilSurveyPelayananOrtu.php?survey_nama=Survey Kepuasan Pelayanan';
                    break;
                default:
                    return;
            }
            window.location.href = targetPage;
        } else {
            alert('Tidak ada hasil, Anda belum mengisi survey');
        }
    });
});

$(document).ready(function () {
    $('.hasilSurvey-buttonA').on('click', function (event) {
        event.stopImmediatePropagation(); // Mencegah event bubbling

        if ($(this).hasClass('completed')) {
            const surveyType = $(this).attr('id');
            let targetPage = '';
            switch (surveyType) {
                case 'hasilSurvey_PK_AlumniButton':
                    targetPage = 'hasilSurvey_PK_Alumni.php?survey_nama=Survey Pasca Kelulusan';
                    break;
                default:
                    return;
            }
            window.location.href = targetPage;
        } else {
            alert('Tidak ada hasil, Anda belum mengisi survey');
        }
    });
});



$(document).ready(function () {
    $('.isiSurvey-buttonM').on('click', function (event) {
        // Cegah aksi default dan hentikan bubbling dari event
        event.preventDefault();
        event.stopImmediatePropagation();

        // Periksa apakah tombol memiliki kelas 'completed'
        if ($(this).hasClass('completed')) {
            alert('Anda sudah mengisi survey ini');
            return; // Hentikan eksekusi lebih awal dan jangan alihkan halaman
        }

        // Tentukan halaman target berdasarkan ID tombol yang diklik
        const surveyType = $(this).attr('id');
        let targetPage = '';
        switch (surveyType) {
            case 'surveyFasilitasButton':
                targetPage = 'isiSurveyFasilitasMahasiswa.php?survey_nama=Survey Fasilitas';
                break;
            case 'surveySistemButton':
                targetPage = 'isiSurveySistemMahasiswa.php?survey_nama=Survey Sistem Informasi';
                break;
            case 'surveyDosenButton':
                targetPage = 'isiSurveyDosenMahasiswa.php?survey_nama=Survey Dosen';
                break;
            default:
                return;
        }
        // Arahkan ke halaman target
        window.location.href = targetPage;
    });
});

$(document).ready(function () {
    $('.isiSurvey-buttonD').on('click', function (event) {
        // Cegah aksi default dan hentikan bubbling dari event
        event.preventDefault();
        event.stopImmediatePropagation();

        // Periksa apakah tombol memiliki kelas 'completed'
        if ($(this).hasClass('completed')) {
            alert('Anda sudah mengisi survey ini');
            return; // Hentikan eksekusi lebih awal dan jangan alihkan halaman
        }

        // Tentukan halaman target berdasarkan ID tombol yang diklik
        const surveyType = $(this).attr('id');
        let targetPage = '';
        switch (surveyType) {
            case 'surveyFD_button':
                targetPage = 'isiSurveySistemDosen.php?survey_nama=Survey Fasilitas';
                break;
            case 'surveySD_button':
                targetPage = 'isiSurveySistemDosen.php?survey_nama=Survey Sistem Informasi';
                break;
            default:
                return;
        }
        // Arahkan ke halaman target
        window.location.href = targetPage;
    });
});

$(document).ready(function () {
    $('.isiSurvey-buttonT').on('click', function (event) {
        // Cegah aksi default dan hentikan bubbling dari event
        event.preventDefault();
        event.stopImmediatePropagation();

        // Periksa apakah tombol memiliki kelas 'completed'
        if ($(this).hasClass('completed')) {
            alert('Anda sudah mengisi survey ini');
            return; // Hentikan eksekusi lebih awal dan jangan alihkan halaman
        }

        // Tentukan halaman target berdasarkan ID tombol yang diklik
        const surveyType = $(this).attr('id');
        let targetPage = '';
        switch (surveyType) {
            case 'surveyFT_button':
                targetPage = 'isiSurveyFasilitasTendik.php?survey_nama=Survey Fasilitas';
                break;
            case 'surveyST_button':
                targetPage = 'isiSurveySistemTendik.php?survey_nama=Survey Sistem Informasi';
                break;
            default:
                return;
        }
        // Arahkan ke halaman target
        window.location.href = targetPage;
    });
});

$(document).ready(function () {
    $('.isiSurvey-buttonI').on('click', function (event) {
        // Cegah aksi default dan hentikan bubbling dari event
        event.preventDefault();
        event.stopImmediatePropagation();

        // Periksa apakah tombol memiliki kelas 'completed'
        if ($(this).hasClass('completed')) {
            alert('Anda sudah mengisi survey ini');
            return; // Hentikan eksekusi lebih awal dan jangan alihkan halaman
        }

        // Tentukan halaman target berdasarkan ID tombol yang diklik
        const surveyType = $(this).attr('id');
        let targetPage = '';
        switch (surveyType) {
            case 'surveySDMI_button':
                targetPage = 'isiSurveySDMIndustri.php?survey_nama=Survey Sumber Daya Mahasiswa';
                break;
            case 'surveyDPI_button':
                targetPage = 'isiSurveyDPIndustri.php?survey_nama=Survey Dosen Pembimbing';
                break;
            default:
                return;
        }
        // Arahkan ke halaman target
        window.location.href = targetPage;
    });
});

$(document).ready(function () {
    $('.isiSurvey-buttonOT').on('click', function (event) {
        // Cegah aksi default dan hentikan bubbling dari event
        event.preventDefault();
        event.stopImmediatePropagation();

        // Periksa apakah tombol memiliki kelas 'completed'
        if ($(this).hasClass('completed')) {
            alert('Anda sudah mengisi survey ini');
            return; // Hentikan eksekusi lebih awal dan jangan alihkan halaman
        }

        // Tentukan halaman target berdasarkan ID tombol yang diklik
        const surveyType = $(this).attr('id');
        let targetPage = '';
        switch (surveyType) {
            case 'surveyPO_button':
                targetPage = 'isiSurveyPelayananOrtu.php?survey_nama=Survey Kepuasan Pelayanan';
                break;
            default:
                return;
        }
        // Arahkan ke halaman target
        window.location.href = targetPage;
    });
});

$(document).ready(function () {
    $('.isiSurvey-buttonA').on('click', function (event) {
        // Cegah aksi default dan hentikan bubbling dari event
        event.preventDefault();
        event.stopImmediatePropagation();

        // Periksa apakah tombol memiliki kelas 'completed'
        if ($(this).hasClass('completed')) {
            alert('Anda sudah mengisi survey ini');
            return; // Hentikan eksekusi lebih awal dan jangan alihkan halaman
        }

        // Tentukan halaman target berdasarkan ID tombol yang diklik
        const surveyType = $(this).attr('id');
        let targetPage = '';
        switch (surveyType) {
            case 'survey_PK_AlumniButton':
                targetPage = 'isiSurvey_PK_Alumni.php?survey_nama=Survey Pasca Kelulusan';
                break;
            default:
                return;
        }
        // Arahkan ke halaman target
        window.location.href = targetPage;
    });
});

$(document).ready(function () {
    // Fungsi untuk toggle edit
    function toggleEdit(fieldId) {
        var inputField = document.getElementById(fieldId);
        if (inputField.hasAttribute('readonly')) {
            inputField.removeAttribute('readonly');
            inputField.style.backgroundColor = '#8cdce7'; // Biru Muda
            document.getElementById('simpanButton').disabled = false;
        } else {
            inputField.setAttribute('readonly', true);
            inputField.style.backgroundColor = ''; // Kembali ke warna asli
            // Disable save button only if no other fields are editable
            var inputs = document.querySelectorAll('.input-groupPP input');
            var disableButton = true;
            inputs.forEach(function (input) {
                if (!input.hasAttribute('readonly')) {
                    disableButton = false;
                }
            });
            document.getElementById('simpanButton').disabled = disableButton;
        }
    }

    // Assign toggleEdit to global scope
    window.toggleEdit = toggleEdit;

    // Menangani alert pada window load
    window.onload = function () {
        var updateSuccessValue = document.querySelector('input[name="update_success"]').value;
        console.log("Update Success Value:", updateSuccessValue);
        if (updateSuccessValue === 'true') {
            alert('Data anda telah diperbaharui');
        }
    }
});



$(document).ready(function () {
    window.togglePasswordUP = function (fieldId) {
        const passwordField = document.getElementById(fieldId);
        const passwordToggle = passwordField.nextElementSibling;
        const icon = passwordToggle.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    // Periksa apakah ada perubahan pada form
    document.querySelectorAll('.password-wrapper input').forEach(input => {
        input.addEventListener('input', function () {
            const oldPassword = document.getElementById('password_lama').value;
            const newPassword = document.getElementById('password_baru').value;
            const confirmPassword = document.getElementById('verifikasi_password_baru').value;
            if (oldPassword && newPassword && confirmPassword) {
                document.getElementById('simpanButton').disabled = false;
            } else {
                document.getElementById('simpanButton').disabled = true;
            }
        });
    });
});

