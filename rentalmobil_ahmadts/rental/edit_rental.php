<?php
session_start();
include "../koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Ambil data rental berdasarkan no_trx
if(!isset($_GET['id'])) {
    header("location:riwayat_admin.php");
    exit;
}

$no_trx = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_rental_ahmadts 
        INNER JOIN tbl_pelanggan_ahmadts ON tbl_rental_ahmadts.nik_ktp_ahmadts = tbl_pelanggan_ahmadts.nik_ktp_ahmadts 
        INNER JOIN tbl_mobil_ahmadts ON tbl_rental_ahmadts.no_plat_ahmadts = tbl_mobil_ahmadts.no_plat_ahmadts 
        WHERE no_trx_ahmadts = '$no_trx'");

if (!$query) {
    echo "Error: " . mysqli_error($koneksi);
    exit;
}

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Query untuk dropdown mobil
$query_mobil = mysqli_query($koneksi, "SELECT * FROM tbl_mobil_ahmadts");
// Query untuk dropdown pelanggan
$query_pelanggan = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan_ahmadts");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rental - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-custom {
            background-color: #0d6efd;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <i class="fas fa-car"></i> CV. Rental Mobil Ahmadts
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../mobil/mobil.php"><i class="fas fa-car"></i> Data Mobil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pelanggan/pelanggan.php"><i class="fas fa-users"></i> Data Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="riwayat_admin.php"><i class="fas fa-book"></i> Data Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/user.php"><i class="fas fa-user"></i> Data User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout (<?php echo $_SESSION['nama_lengkap']; ?>)
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Edit Data Rental</h4>
        </div>
        <div class="card-body">
            <form action="proses_edit_rental.php" method="POST">
                <input type="hidden" name="no_trx" value="<?php echo $data['no_trx_ahmadts']; ?>">
                
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">No Transaksi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $data['no_trx_ahmadts']; ?>" disabled>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Pelanggan</label>
                    <div class="col-sm-10">
                        <select name="nik_ktp" class="form-control" required>
                            <?php while($pelanggan = mysqli_fetch_array($query_pelanggan)) { ?>
                                <option value="<?php echo $pelanggan['nik_ktp_ahmadts']; ?>" 
                                    <?php if($pelanggan['nik_ktp_ahmadts'] == $data['nik_ktp_ahmadts']) echo 'selected'; ?>>
                                    <?php echo $pelanggan['nama_ahmadts']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Mobil</label>
                    <div class="col-sm-10">
                        <select name="no_plat" class="form-control" required>
                            <?php while($mobil = mysqli_fetch_array($query_mobil)) { ?>
                                <option value="<?php echo $mobil['no_plat_ahmadts']; ?>" 
                                    <?php if($mobil['no_plat_ahmadts'] == $data['no_plat_ahmadts']) echo 'selected'; ?>>
                                    <?php echo $mobil['nama_mobil_ahmadts']; ?> - <?php echo $mobil['no_plat_ahmadts']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Tanggal Rental</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_rental" 
                               value="<?php echo $data['tgl_rental_ahmadts']; ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Jam Rental</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="jam_rental" 
                               value="<?php echo $data['jam_rental_ahmadts']; ?>" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Lama</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="lama_rental" id="lama_rental"
                               value="<?php echo $data['lama_ahmadts']; ?>" required 
                               onchange="hitungTotal()">
                        <small class="text-muted">Hari</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Harga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="harga" 
                               value="<?php echo $data['harga_ahmadts']; ?>" disabled>
                        <small class="text-muted">Rupiah</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Total Bayar</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="total_bayar" name="total_bayar"
                               value="<?php echo $data['total_bayar_ahmadts']; ?>" readonly>
                        <small class="text-muted">Rupiah</small>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="riwayat_admin.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function hitungTotal() {
    var lama = document.getElementById('lama_rental').value;
    var harga = document.getElementById('harga').value;
    var total = lama * harga;
    document.getElementById('total_bayar').value = total;
}
</script>
</body>
</html>