<?php
session_start();
include "../koneksi.php";

// Cek session admin
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Ambil data dari form
$no_trx = $_POST['no_trx'];
$tgl_rental = $_POST['tgl_rental'];
$nik_ktp = $_POST['nik_ktp'];
$no_plat = $_POST['no_plat'];
$lama_rental = $_POST['lama_rental'];
$total_bayar = $_POST['total_bayar'];

// Update data rental
$query = mysqli_query($koneksi, "UPDATE tbl_rental_ahmadts SET 
    tgl_rental_ahmadts = '$tgl_rental',
    nik_ktp_ahmadts = '$nik_ktp',
    no_plat_ahmadts = '$no_plat',
    lama_ahmadts = '$lama_rental',
    total_bayar_ahmadts = '$total_bayar'
    WHERE no_trx_ahmadts = '$no_trx'");

if($query) {
    header("location:riwayat_admin.php?pesan=edit_sukses");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>