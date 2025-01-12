<?php
session_start();
include "koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'user') {
    header("location:../login.php?pesan=belum_login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Rental Mobil</title>
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
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">
            <i class="fas fa-car"></i> CV. Rental Mobil Ahmadts
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mobil/daftar_mobil.php">
                        <i class="fas fa-car"></i> Daftar Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rental/rental.php">
                        <i class="fas fa-book"></i> Rental Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rental/riwayat.php">
                        <i class="fas fa-history"></i> Riwayat Rental
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row mb-4">
        <div class="col">
            <h2>Selamat Datang, <?php echo $_SESSION['nama_lengkap']; ?></h2>
            <p>Silakan pilih menu yang tersedia untuk melakukan rental mobil.</p>
        </div>
    </div>

    <div class="row">
        <!-- Daftar Mobil Card -->
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-car fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Daftar Mobil</h5>
                    <p class="card-text">Lihat daftar mobil yang tersedia untuk disewa</p>
                    <a href="mobil/daftar_mobil.php" class="btn btn-primary">Lihat Mobil</a>
                </div>
            </div>
        </div>

        <!-- Rental Mobil Card -->
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Rental Mobil</h5>
                    <p class="card-text">Lakukan pemesanan rental mobil</p>
                    <a href="rental/rental.php" class="btn btn-primary">Rental Sekarang</a>
                </div>
            </div>
        </div>

        <!-- Riwayat Rental Card -->
        <div class="col-md-4 mb-4">
            <div class="card feature-card h-100">
                <div class="card-body text-center">
                    <i class="fas fa-history fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Riwayat Rental</h5>
                    <p class="card-text">Lihat riwayat transaksi rental Anda</p>
                    <a href="rental/riwayat.php" class="btn btn-primary">Lihat Riwayat</a>
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

</body>
</html>