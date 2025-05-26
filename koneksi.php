<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sistem_pakar_sapi";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($koneksi, "utf8mb4");

// Fungsi untuk escape string
function clean_input($data) {
    global $koneksi;
    return mysqli_real_escape_string($koneksi, trim($data));
}
?>