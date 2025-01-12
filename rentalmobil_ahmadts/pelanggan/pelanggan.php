<?php
session_start(); // Tambahkan ini di awal file
include "../koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Rental Mobil</title>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Data Pelanggan</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal">
            <i class="fas fa-plus"></i> Tambah Pelanggan
        </button>
    </div>

    <!-- Tabel Data Pelanggan -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tabelPelanggan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan_ahmadts");
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nik_ktp_ahmadts']; ?></td>
                            <td><?php echo $data['nama_ahmadts']; ?></td>
                            <td><?php echo $data['no_hp_ahmadts']; ?></td>
                            <td><?php echo $data['alamat_ahmadts']; ?></td>
                            <td>
                                <a href="edit_pelanggan.php?nik=<?php echo $data['nik_ktp_ahmadts']; ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="javascript:void(0);" 
                                   onclick="hapusPelanggan('<?php echo $data['nik_ktp_ahmadts']; ?>')"
                                   class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pelanggan -->
    <div class="modal fade" id="tambahPelangganModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="proses_pelanggan.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="aksi" value="tambah">
                        <div class="mb-3">
                            <label class="form-label">NIK KTP</label>
                            <input type="text" class="form-control" name="nik" required 
                                   pattern="[0-9]{16}" title="NIK harus 16 digit angka">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" class="form-control" name="no_hp" required 
                                   pattern="[0-9]{10,13}" title="Nomor HP harus 10-13 digit angka">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" required rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#tabelPelanggan').DataTable();
});

function hapusPelanggan(nik) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data pelanggan akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'proses_pelanggan.php?aksi=hapus&nik=' + nik;
        }
    });
}
</script>

</body>
</html>