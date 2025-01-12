<?php
session_start();
include "../koneksi.php";

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
    <title>Daftar Mobil - Rental Mobil</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
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
                    <a class="nav-link" href="../dashboard.php">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="daftar_mobil.php">
                        <i class="fas fa-car"></i> Daftar Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../rental/rental.php">
                        <i class="fas fa-book"></i> Rental Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../rental/riwayat.php">
                        <i class="fas fa-history"></i> Riwayat Rental
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container content-wrapper">
    <div class="row mb-4">
        <div class="col">
            <h2>Daftar Mobil</h2>
            <p>Berikut adalah daftar mobil yang tersedia.</p>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tabelMobil">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Plat</th>
                            <th>Nama Mobil</th>
                            <th>Brand</th>
                            <th>Transmisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM tbl_mobil_ahmadts");
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['no_plat_ahmadts']; ?></td>
                            <td><?php echo $data['nama_mobil_ahmadts']; ?></td>
                            <td><?php echo $data['brand_mobil_ahmadts']; ?></td>
                            <td><?php echo $data['tipe_transmisi_ahmadts']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#tabelMobil').DataTable();
});
</script>

</body>
</html>