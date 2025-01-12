<?php
session_start();
include "../koneksi.php";

// Cek session admin
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
    <title>Data User - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                    <a class="nav-link" href="../mobil/mobil.php">
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
                    <a class="nav-link active" href="user.php">
                        <i class="fas fa-user"></i> Data User
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
                    <a href="tambah_user.php" class="btn btn-primary">Tambah Data</a>
                </div>
                <div class="d-flex">
                    <form action="" method="GET" class="d-flex">
                        <input type="text" name="cari" class="form-control me-2" 
                               placeholder="Cari Username/Nama" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                        <button type="submit" class="btn btn-primary">Pencarian</button>
                    </form>
                </div>
            </div>

            <table id="tabelUser" class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query dengan pencarian
                    $query = "SELECT * FROM tbl_user_ahmadts";
                    
                    // Jika ada pencarian
                    if(isset($_GET['cari']) && $_GET['cari'] != '') {
                        $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
                        $query .= " WHERE username_ahmadts LIKE '%$cari%' 
                                  OR nama_lengkap_ahmadts LIKE '%$cari%'";
                    }

                    $result = mysqli_query($koneksi, $query);
                    while($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['username_ahmadts']; ?></td>
                        <td><?php echo $data['nama_lengkap_ahmadts']; ?></td>
                        <td><?php echo $data['level_ahmadts']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $data['username_ahmadts']; ?>" 
                               class="btn btn-primary btn-sm">Edit</a>
                            <a href="hapus_user.php?id=<?php echo $data['username_ahmadts']; ?>" 
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>