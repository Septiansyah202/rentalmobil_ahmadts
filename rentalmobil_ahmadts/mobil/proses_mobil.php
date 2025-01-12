<?php
include "../koneksi.php";

if(isset($_POST['aksi'])) {
    if($_POST['aksi'] == "tambah") {
        $no_plat = $_POST['no_plat'];
        $nama_mobil = $_POST['nama_mobil'];
        $brand = $_POST['brand'];
        $transmisi = $_POST['transmisi'];

        $query = mysqli_query($koneksi, "INSERT INTO tbl_mobil_ahmadts VALUES 
                ('$no_plat', '$nama_mobil', '$brand', '$transmisi')");

        if($query) {
            echo "<script>
                alert('Data berhasil ditambahkan!');
                window.location.href='mobil.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menambahkan data!');
                window.location.href='mobil.php';
            </script>";
        }
    } else if($_POST['aksi'] == "edit") {
        $no_plat = $_POST['no_plat'];
        $nama_mobil = $_POST['nama_mobil'];
        $brand = $_POST['brand'];
        $transmisi = $_POST['transmisi'];

        $query = mysqli_query($koneksi, "UPDATE tbl_mobil_ahmadts SET 
                nama_mobil_ahmadts='$nama_mobil',
                brand_mobil_ahmadts='$brand',
                tipe_transmisi_ahmadts='$transmisi'
                WHERE no_plat_ahmadts='$no_plat'");

        if($query) {
            echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href='mobil.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal mengupdate data!');
                window.location.href='mobil.php';
            </script>";
        }
    }
}

if(isset($_GET['aksi'])) {
    if($_GET['aksi'] == "hapus") {
        $no_plat = $_GET['no_plat'];

        $query = mysqli_query($koneksi, "DELETE FROM tbl_mobil_ahmadts WHERE no_plat_ahmadts='$no_plat'");

        if($query) {
            echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href='mobil.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus data!');
                window.location.href='mobil.php';
            </script>";
        }
    }
}
?>