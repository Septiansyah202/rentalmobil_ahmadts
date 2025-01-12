<?php
session_start();
include "../koneksi.php";

// Cek session
if(!isset($_SESSION['username']) || ($_SESSION['level'] != 'user' && $_SESSION['level'] != 'admin')) {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Ambil data dari form
$no_trx = $_POST['no_trx'];
$tgl_rental = $_POST['tgl_rental'];
$jam_rental = $_POST['jam_rental'];
$nik_ktp = $_POST['nik_ktp'];
$no_plat = $_POST['no_plat'];
$lama_rental = $_POST['lama_rental'];
$harga_rental = $_POST['harga_rental'];
$total_bayar = $_POST['total_bayar'];

// Proses simpan ke database
$query = mysqli_query($koneksi, "INSERT INTO tbl_rental_ahmadts (
    no_trx_ahmadts,
    tgl_rental_ahmadts,
    jam_rental_ahmadts,
    nik_ktp_ahmadts,
    no_plat_ahmadts,
    lama_ahmadts,
    harga_ahmadts,
    total_bayar_ahmadts
) VALUES (
    '$no_trx',
    '$tgl_rental',
    '$jam_rental',
    '$nik_ktp',
    '$no_plat',
    '$lama_rental',
    '$harga_rental',
    '$total_bayar'
)");

if($query) {
    // Redirect berdasarkan level user
    if($_SESSION['level'] == 'admin') {
        header("location:riwayat_admin.php?pesan=simpan_sukses");
    } else {
        header("location:riwayat.php?pesan=simpan_sukses");
    }
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>