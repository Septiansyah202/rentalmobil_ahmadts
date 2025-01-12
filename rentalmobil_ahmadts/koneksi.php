<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "rentalmobil_ahmadts";

// Membuat koneksi
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Set charset ke utf8
mysqli_set_charset($koneksi, "utf8");

// Uncomment baris di bawah ini untuk mengecek koneksi berhasil
// echo "Koneksi berhasil";
?>