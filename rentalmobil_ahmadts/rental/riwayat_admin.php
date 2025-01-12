<?php
session_start();
include "../koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || $_SESSION['level'] != 'admin') {
    header("location:../login.php?pesan=belum_login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rental - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-custom {
            background-color: #0d6efd;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white !important;
        }
        .dataTables_filter {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 1rem;
        }
        .dataTables_filter input {
            margin-right: 10px;
        }
        .search-button {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
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
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../mobil/mobil.php">
                        <i class="fas fa-car"></i> Daftar Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../pelanggan/pelanggan.php"><i class="fas fa-users"></i> Data Pelanggan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="riwayat_admin.php">
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

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <label class="me-2">Show</label>
                        <select class="form-select form-select-sm me-2" style="width: auto;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label>entries</label>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <a href="rental.php" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="d-flex">
                    <form action="" method="GET" class="d-flex">
                        <input type="text" name="cari" class="form-control me-2" 
                               placeholder="Masukkan No TRX" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                        <button type="submit" class="btn btn-primary">Pencarian</button>
                    </form>
                </div>
            </div>

            <table id="tabelRental" class="table">
                <thead>
                    <tr>
                        <th>No TRX</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Mobil</th>
                        <th>Lama</th>
                        <th>Harga</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query dengan pencarian
                    $query = "SELECT * FROM tbl_rental_ahmadts 
                             INNER JOIN tbl_pelanggan_ahmadts ON tbl_rental_ahmadts.nik_ktp_ahmadts = tbl_pelanggan_ahmadts.nik_ktp_ahmadts 
                             INNER JOIN tbl_mobil_ahmadts ON tbl_rental_ahmadts.no_plat_ahmadts = tbl_mobil_ahmadts.no_plat_ahmadts";
                    
                    // Jika ada pencarian
                    if(isset($_GET['cari']) && $_GET['cari'] != '') {
                        $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
                        $query .= " WHERE no_trx_ahmadts LIKE '%$cari%'";
                    }

                    $result = mysqli_query($koneksi, $query);
                    while($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['no_trx_ahmadts']; ?></td>
                        <td><?php echo $data['tgl_rental_ahmadts']; ?></td>
                        <td><?php echo $data['nama_ahmadts']; ?></td>
                        <td><?php echo $data['nama_mobil_ahmadts']; ?></td>
                        <td><?php echo $data['lama_ahmadts']; ?> Hari</td>
                        <td><?php echo number_format($data['harga_ahmadts'], 0, ',', '.'); ?></td>
                        <td><?php echo number_format($data['total_bayar_ahmadts'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="edit_rental.php?id=<?php echo $data['no_trx_ahmadts']; ?>" 
                               class="btn btn-primary btn-sm">Edit</a>
                            <a href="hapus_rental.php?id=<?php echo $data['no_trx_ahmadts']; ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#tabelRental').DataTable({
        "pageLength": 10,
        "lengthChange": false,  // Menonaktifkan dropdown default
        "searching": false      // Menonaktifkan search default
    });
});
</script>

</body>
</html>