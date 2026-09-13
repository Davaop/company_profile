<?php
session_start();
include "../config/koneksi.php";

// Jika admin sudah login, langsung lempar ke dashboard
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: dashboard.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query  = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
    $admin  = mysqli_fetch_assoc($query);

    // HANYA MENGGUNAKAN PASSWORD_VERIFY (AMAN XSS & PLAINTEXT HACK)
    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id']        = $admin['id'];
        $_SESSION['admin_nama']      = $admin['nama_lengkap'];
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Company Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light d-flex align-items-center vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="fa-solid fa-user-shield fa-3x text-primary mb-2"></i>
                        <h4 class="fw-bold">Login Admin</h4>
                        <p class="text-muted small">Masuk untuk mengelola isi website</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger py-2 small" role="alert">
                            <i class="fa-solid fa-circle-exclamation me-1"></i> <?= $error; ?>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100 fw-bold py-2 mt-2">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <a href="../index.php" class="text-decoration-none small text-secondary">
                            &laquo; Kembali ke Halaman Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>