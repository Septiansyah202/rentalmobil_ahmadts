<?php
if(isset($_GET['pesan'])) {
    $pesan = "";
    $tipe = "danger";
    
    switch($_GET['pesan']) {
        case "gagal":
            $pesan = "Username atau password salah!";
            break;
        case "logout":
            $pesan = "Anda telah berhasil logout";
            $tipe = "success";
            break;
        case "belum_login":
            $pesan = "Anda harus login terlebih dahulu";
            $tipe = "warning";
            break;
        case "kosong":
            $pesan = "Username dan password tidak boleh kosong!";
            break;
        case "error":
            $pesan = "Terjadi kesalahan sistem. Silakan coba lagi.";
            break;
    }
    
    if($pesan != "") {
        echo "<div class='alert alert-{$tipe} alert-dismissible fade show' role='alert'>
                {$pesan}
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              </div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Mobil Ahmadts</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
        }
        .login-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .login-card .card-header {
            background: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0;
            text-align: center;
            padding: 20px;
        }
        .login-icon {
            font-size: 50px;
            margin-bottom: 10px;
        }
        .btn-login {
            background: #0d6efd;
            color: white;
            padding: 10px;
        }
        .btn-login:hover {
            background: #0b5ed7;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center login-container">
        <div class="col-md-5">
            <div class="card login-card">
                <div class="card-header">
                    <div class="login-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h4 class="mb-0">CV. Rental Mobil Ahmadts</h4>
                </div>
                <div class="card-body p-4">
                    <?php
                    if(isset($_GET['pesan'])) {
                        if($_GET['pesan'] == "gagal") {
                            echo "<div class='alert alert-danger'>Username atau password salah!</div>";
                        } else if($_GET['pesan'] == "logout") {
                            echo "<div class='alert alert-success'>Anda telah berhasil logout</div>";
                        } else if($_GET['pesan'] == "belum_login") {
                            echo "<div class='alert alert-warning'>Anda harus login terlebih dahulu</div>";
                        }
                    }
                    ?>
                    <form action="cek_login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Username</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center text-muted">
                    <small>&copy; <?php echo date('Y'); ?> CV. Rental Mobil Ahmadts</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>