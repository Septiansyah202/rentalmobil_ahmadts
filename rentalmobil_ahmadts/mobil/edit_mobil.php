<?php
session_start();
include "../koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Ambil data mobil berdasarkan no_plat
if(!isset($_GET['no_plat'])) {
    header("location:mobil.php");
    exit;
}

$no_plat = $_GET['no_plat'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_mobil_ahmadts WHERE no_plat_ahmadts = '$no_plat'");

if (!$query) {
    echo "Error: " . mysqli_error($koneksi);
    exit;
}

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mobil - Rental Mobil</title>
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
                    <a class="nav-link" href="../index.php">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="mobil.php">
                        <i class="fas fa-car"></i> Data Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pelanggan/pelanggan.php">
                        <i class="fas fa-users"></i> Data Pelanggan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../rental/riwayat_admin.php">
                        <i class="fas fa-book"></i> Data Rental
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/user.php">
                        <i class="fas fa-user"></i> Data User
                    </a>
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

<div class="container content-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-edit"></i> Edit Data Mobil</h5>
                </div>
                <div class="card-body">
                    <form action="proses_mobil.php" method="POST">
                        <input type="hidden" name="aksi" value="edit">
                        <div class="mb-3">
                            <label class="form-label">No Plat</label>
                            <input type="text" class="form-control" name="no_plat" 
                                   value="<?php echo $data['no_plat_ahmadts']; ?>" readonly>
                            <small class="text-muted">No Plat tidak dapat diubah</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control" name="nama_mobil" 
                                   value="<?php echo $data['nama_mobil_ahmadts']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Brand</label>
                            <input type="text" class="form-control" name="brand" 
                                   value="<?php echo $data['brand_mobil_ahmadts']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Transmisi</label>
                            <select class="form-select" name="transmisi" required>
                                <option value="Manual" <?php if($data['tipe_transmisi_ahmadts']=='Manual') echo 'selected'; ?>>Manual</option>
                                <option value="Matic" <?php if($data['tipe_transmisi_ahmadts']=='Matic') echo 'selected'; ?>>Matic</option>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="mobil.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>CV. Rental Mobil Ahmadts</h5>
                <p>Sistem Informasi Manajemen Rental Mobil yang memudahkan pengelolaan data mobil, pelanggan, dan transaksi rental.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <h5>Kontak</h5>
                <p>
                    <i class="fas fa-phone"></i> +62 123 456 789<br>
                    <i class="fas fa-envelope"></i> info@rentalmobilahmadts.com<br>
                    <i class="fas fa-map-marker-alt"></i> Jl. Contoh No. 123, Kota, Indonesia
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>