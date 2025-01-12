<?php
session_start();
include 'koneksi.php';

// Cek apakah form login disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validasi input tidak boleh kosong
    if(empty($_POST['username']) || empty($_POST['password'])) {
        header("location:login.php?pesan=kosong");
        exit;
    }

    // Bersihkan input
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    try {
        $login = mysqli_query($koneksi, "SELECT * FROM tbl_user_ahmadts 
                                        WHERE username_ahmadts='$username' 
                                        AND password_ahmadts='$password'");
        
        if(!$login) {
            throw new Exception(mysqli_error($koneksi));
        }

        $cek = mysqli_num_rows($login);

        if($cek > 0){
            $data = mysqli_fetch_assoc($login);

            // Set session berdasarkan level
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $data['level_ahmadts'];
            $_SESSION['nama_lengkap'] = $data['nama_lengkap_ahmadts'];

            // Redirect berdasarkan level
            if($data['level_ahmadts'] == "admin"){
                header("location:index.php"); // Ke dashboard admin
                exit;
            } else if($data['level_ahmadts'] == "user"){
                header("location:dashboard.php"); // Ke dashboard user
                exit;
            } else {
                throw new Exception("Level user tidak valid");
            }
        } else {
            header("location:login.php?pesan=gagal");
            exit;
        }

    } catch (Exception $e) {
        // Log error (dalam praktik nyata)
        // error_log($e->getMessage());
        
        header("location:login.php?pesan=error");
        exit;
    }
} else {
    header("location:login.php");
    exit;
}
?>