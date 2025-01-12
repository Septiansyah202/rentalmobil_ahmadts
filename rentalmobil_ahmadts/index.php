<?php
include "koneksi.php";

include "cek_session.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV. Rental Mobil Ahmadts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .card-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
        .navbar-custom {
            background-color: #0d6efd;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/img/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-car"></i> CV. Rental Mobil Ahmadts
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="mobil/mobil.php"><i class="fas fa-car"></i> Data Mobil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pelanggan/pelanggan.php"><i class="fas fa-users"></i> Data Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rental/riwayat_admin.php"><i class="fas fa-book"></i> Data Rental</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user/user.php"><i class="fas fa-user"></i> Data User</a>
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

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4">Selamat Datang di CV. Rental Mobil Ahmadts</h1>
        <p class="lead">Sistem Informasi Manajemen Rental Mobil</p>
    </div>
</section>

<!-- Menu Cards Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Data Mobil Card -->
            <div class="col-md-6 col-lg-3">
                <a href="mobil/mobil.php" class="text-decoration-none">
                    <div class="card h-100 feature-card shadow">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-car"></i>
                            </div>
                            <h5 class="card-title text-dark">Data Mobil</h5>
                            <?php
                            $query_mobil = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_mobil_ahmadts");
                            $jumlah_mobil = mysqli_fetch_assoc($query_mobil)['total'];
                            ?>
                            <h3 class="text-primary"><?php echo $jumlah_mobil; ?></h3>
                            <p class="card-text text-muted">Kelola data mobil yang tersedia untuk rental</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Data Pelanggan Card -->
            <div class="col-md-6 col-lg-3">
                <a href="pelanggan/pelanggan.php" class="text-decoration-none">
                    <div class="card h-100 feature-card shadow">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="card-title text-dark">Data Pelanggan</h5>
                            <?php
                            $query_pelanggan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_pelanggan_ahmadts");
                            $jumlah_pelanggan = mysqli_fetch_assoc($query_pelanggan)['total'];
                            ?>
                            <h3 class="text-primary"><?php echo $jumlah_pelanggan; ?></h3>
                            <p class="card-text text-muted">Kelola informasi pelanggan rental</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Data Rental Card -->
            <div class="col-md-6 col-lg-3">
                <a href="rental/rental.php" class="text-decoration-none">
                    <div class="card h-100 feature-card shadow">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-book"></i>
                            </div>
                            <h5 class="card-title text-dark">Data Rental</h5>
                            <?php
                            $query_rental = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_rental_ahmadts");
                            $jumlah_rental = mysqli_fetch_assoc($query_rental)['total'];
                            ?>
                            <h3 class="text-primary"><?php echo $jumlah_rental; ?></h3>
                            <p class="card-text text-muted">Kelola transaksi rental mobil</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Data User Card -->
            <div class="col-md-6 col-lg-3">
                <a href="user/user.php" class="text-decoration-none">
                    <div class="card h-100 feature-card shadow">
                        <div class="card-body text-center">
                            <div class="card-icon mb-3">
                                <i class="fas fa-user"></i>
                            </div>
                            <h5 class="card-title text-dark">Data User</h5>
                            <?php
                            $query_user = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tbl_user_ahmadts");
                            $jumlah_user = mysqli_fetch_assoc($query_user)['total'];
                            ?>
                            <h3 class="text-primary"><?php echo $jumlah_user; ?></h3>
                            <p class="card-text text-muted">Kelola pengguna sistem</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-4">
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>