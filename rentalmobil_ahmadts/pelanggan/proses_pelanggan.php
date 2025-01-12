<?php
include "../koneksi.php";

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $koneksi;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($koneksi, $data);
}

// Proses Tambah Data
if(isset($_POST['aksi']) && $_POST['aksi'] == "tambah") {
    $nik = clean_input($_POST['nik']);
    $nama = clean_input($_POST['nama']);
    $no_hp = clean_input($_POST['no_hp']);
    $alamat = clean_input($_POST['alamat']);

    // Validasi NIK
    if(strlen($nik) != 16 || !is_numeric($nik)) {
        echo "<script>
            alert('NIK harus 16 digit angka!');
            window.location.href='pelanggan.php';
        </script>";
        exit;
    }

    // Validasi No HP
    if(strlen($no_hp) < 10 || strlen($no_hp) > 13 || !is_numeric($no_hp)) {
        echo "<script>
            alert('Nomor HP harus 10-13 digit angka!');
            window.location.href='pelanggan.php';
        </script>";
        exit;
    }

    // Cek apakah NIK sudah ada
    $cek_nik = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan_ahmadts WHERE nik_ktp_ahmadts='$nik'");
    if(mysqli_num_rows($cek_nik) > 0) {
        echo "<script>
            alert('NIK sudah terdaftar!');
            window.location.href='pelanggan.php';
        </script>";
        exit;
    }

    // Proses simpan data
    $query = mysqli_query($koneksi, "INSERT INTO tbl_pelanggan_ahmadts 
            (nik_ktp_ahmadts, nama_ahmadts, no_hp_ahmadts, alamat_ahmadts) 
            VALUES ('$nik', '$nama', '$no_hp', '$alamat')");

    if($query) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            window.location.href='pelanggan.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');
            window.location.href='pelanggan.php';
        </script>";
    }
}

// Proses Edit Data
else if(isset($_POST['aksi']) && $_POST['aksi'] == "edit") {
    $nik = clean_input($_POST['nik']);
    $nama = clean_input($_POST['nama']);
    $no_hp = clean_input($_POST['no_hp']);
    $alamat = clean_input($_POST['alamat']);

    // Validasi No HP
    if(strlen($no_hp) < 10 || strlen($no_hp) > 13 || !is_numeric($no_hp)) {
        echo "<script>
            alert('Nomor HP harus 10-13 digit angka!');
            window.location.href='edit_pelanggan.php?nik=" . $nik . "';
        </script>";
        exit;
    }

    // Proses update data
    $query = mysqli_query($koneksi, "UPDATE tbl_pelanggan_ahmadts SET 
            nama_ahmadts='$nama',
            no_hp_ahmadts='$no_hp',
            alamat_ahmadts='$alamat'
            WHERE nik_ktp_ahmadts='$nik'");

    if($query) {
        echo "<script>
            alert('Data berhasil diupdate!');
            window.location.href='pelanggan.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mengupdate data: " . mysqli_error($koneksi) . "');
            window.location.href='edit_pelanggan.php?nik=" . $nik . "';
        </script>";
    }
}

// Proses Hapus Data
else if(isset($_GET['aksi']) && $_GET['aksi'] == "hapus") {
    $nik = clean_input($_GET['nik']);

    // Cek apakah pelanggan memiliki data rental
    $cek_rental = mysqli_query($koneksi, "SELECT * FROM tbl_rental_ahmadts WHERE nik_ktp_ahmadts='$nik'");
    if(mysqli_num_rows($cek_rental) > 0) {
        echo "<script>
            alert('Pelanggan tidak dapat dihapus karena memiliki data rental!');
            window.location.href='pelanggan.php';
        </script>";
        exit;
    }

    // Proses hapus data
    $query = mysqli_query($koneksi, "DELETE FROM tbl_pelanggan_ahmadts WHERE nik_ktp_ahmadts='$nik'");

    if($query) {
        echo "<script>
            alert('Data berhasil dihapus!');
            window.location.href='pelanggan.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($koneksi) . "');
            window.location.href='pelanggan.php';
        </script>";
    }
}

// Jika tidak ada aksi yang sesuai
else {
    echo "<script>
        alert('Aksi tidak valid!');
        window.location.href='pelanggan.php';
    </script>";
}
?>