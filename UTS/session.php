<?php
session_start(); // menyimpan data sesion untuk pengguna yang terhubung

function set_session($key, $value) { // Menyimpan informasi login dengan kunci usename
    $_SESSION[$key] = $value;
}

function get_session($key) {
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

function unset_session($key) {
    unset($_SESSION[$key]);
}
?>