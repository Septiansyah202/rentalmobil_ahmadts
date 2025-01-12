<?php
session_start();

// Cek apakah user sudah login
if(!isset($_SESSION['username'])){
    header("location:login.php?pesan=belum_login");
    exit;
}

// Fungsi untuk mengecek hak akses
function cek_hak_akses($allowed_levels) {
    if(!in_array($_SESSION['level'], $allowed_levels)) {
        echo "<script>
            alert('Anda tidak memiliki hak akses!');
            window.location.href='index.php';
        </script>";
        exit;
    }
}
?>