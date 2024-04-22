<?php
function set_cookie($name, $value, $expiry, $path) {
    setcookie($name, $value, $expiry, $path);
}

// Memeriksa apakah pengguna sudah login. Ini dilakukan dengan cara memeriksa apakah cookie yang berisi informasi login telah disimpan. 
function get_cookie($name) { 
    return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
}

function unset_cookie($name) {
    setcookie($name, "", time() - 3600); // Set waktu kedaluwarsa ke belakang
}
?>