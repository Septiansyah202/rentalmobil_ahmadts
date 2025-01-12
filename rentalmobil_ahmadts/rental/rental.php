<?php
session_start();
include "../koneksi.php";

// Cek session dan level user
if(!isset($_SESSION['username']) || ($_SESSION['level'] != 'user' && $_SESSION['level'] != 'admin')) {
    header("location:../login.php?pesan=belum_login");
    exit;
}

// Generate nomor transaksi otomatis
$notrx = "TRX-" . date("Ymdhis");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Mobil - Rental Mobil</title>
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
        .form-group {
            margin-bottom: 1rem;
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
                    <a class="nav-link" href="../mobil/daftar_mobil.php">
                        <i class="fas fa-car"></i> Daftar Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="rental.php">
                        <i class="fas fa-book"></i> Rental Mobil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="riwayat.php">
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
    <div class="card">
        <div class="card-body">
            <form action="proses_rental.php" method="POST">
                <div class="form-group row">
                    <label class="col-sm-2">No Trx</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="no_trx" value="<?php echo $notrx; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Tanggal Ambil</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" name="tgl_rental" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Pelanggan</label>
                    <div class="col-sm-10">
                        <select name="nik_ktp" class="form-control">
                            <option value=""> -- Pilih Pelanggan -- </option>
                            <?php
                            $tampil=mysqli_query($koneksi,"SELECT * FROM tbl_pelanggan_ahmadts");
                            while($data=mysqli_fetch_array($tampil)){
                            echo"<option value='$data[nik_ktp_ahmadts]'>$data[nik_ktp_ahmadts] - 
                            $data[nama_ahmadts]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Jam Ambil</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control" name="jam_rental" value="<?php echo date('H:i'); ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Mobil</label>
                    <div class="col-sm-10">
                        <select name="no_plat" class="form-control">
                            <option value=""> -- Pilih Mobil -- </option>
                            <?php
                            $tampil=mysqli_query($koneksi,"SELECT * FROM tbl_mobil_ahmadts");
                            while($data=mysqli_fetch_array($tampil)){
                            echo"<option value='$data[no_plat_ahmadts]'>$data[no_plat_ahmadts] - 
                            $data[nama_mobil_ahmadts]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Lama Rental</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="lama_rental" min="1" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Harga Rental</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="harga_rental" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2">Total Bayar</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="total_bayar" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="button" class="btn btn-warning" onclick="window.history.back()">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
$(document).ready(function() {
    // Hitung total otomatis
    $('input[name="lama_rental"], input[name="harga_rental"]').on('input', function() {
        var lama = $('input[name="lama_rental"]').val() || 0;
        var harga = $('input[name="harga_rental"]').val() || 0;
        var total = lama * harga;
        $('input[name="total_bayar"]').val(total);
    });
});
</script>

</body>
</html>