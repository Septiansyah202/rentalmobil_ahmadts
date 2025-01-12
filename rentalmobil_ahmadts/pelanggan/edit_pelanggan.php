<?php
session_start();
include "../koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Ambil data pelanggan berdasarkan NIK
$nik = $_GET['nik'];
$query = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan_ahmadts WHERE nik_ktp_ahmadts='$nik'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>
        alert('Data tidak ditemukan!');
        window.location.href='pelanggan.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggan - Rental Mobil</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-custom {
            background-color: #0d6efd;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }
        .content-wrapper {
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-light">

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
                    <a class="nav-link active" href="pelanggan.php"><i class="fas fa-users"></i> Data Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../rental/riwayat_admin.php"><i class="fas fa-book"></i> Data Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user/user.php"><i class="fas fa-user"></i> Data User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
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
                    <h5 class="card-title mb-0"><i class="fas fa-edit"></i> Edit Data Pelanggan</h5>
                </div>
                <div class="card-body">
                    <form action="proses_pelanggan.php" method="POST" onsubmit="return validateForm()">
                        <input type="hidden" name="aksi" value="edit">
                        <div class="mb-3">
                            <label class="form-label">NIK KTP</label>
                            <input type="text" class="form-control" name="nik" 
                                   value="<?php echo $data['nik_ktp_ahmadts']; ?>" readonly>
                            <small class="text-muted">NIK tidak dapat diubah</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" 
                                   value="<?php echo $data['nama_ahmadts']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp"
                                   value="<?php echo $data['no_hp_ahmadts']; ?>" required>
                            <small class="text-muted">Format: 10-13 digit angka</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?php echo $data['alamat_ahmadts']; ?></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="pelanggan.php" class="btn btn-secondary">
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
        <hr>
        <div class="text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> CV. Rental Mobil Ahmadts. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
function validateForm() {
    var noHP = document.getElementById('no_hp').value;
    
    // Validasi nomor HP
    if(!/^\d{10,13}$/.test(noHP)) {
        alert('Nomor HP harus 10-13 digit angka!');
        return false;
    }
    
    return true;
}

// Hanya memperbolehkan input angka pada field no HP
document.getElementById('no_hp').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>

</body>
</html>