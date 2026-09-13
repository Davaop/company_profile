<?php
session_start();
include "../config/koneksi.php";

// Keamanan: Cek apakah user sudah login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Hitung total data untuk statistik ringkas
$count_produk  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
$count_artikel = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM artikel"));
$count_galeri  = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM galeri"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

<!-- NAVBAR ADMIN -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="dashboard.php"><i class="fa-solid fa-gauge me-2"></i>Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navAdmin">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="profile/index.php">Profil Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link" href="produk/index.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="artikel/index.php">Artikel</a></li>
        <li class="nav-item"><a class="nav-link" href="galeri/index.php">Galeri</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <span class="text-white small">Halo, <b><?= $_SESSION['admin_nama']; ?></b></span>
        <a href="logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin logout?')">
            <i class="fa-solid fa-power-off me-1"></i> Logout
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- CONTENT DASHBOARD -->
<div class="container my-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Selamat Datang, <?= $_SESSION['admin_nama']; ?>!</h2>
            <p class="text-secondary">Silakan pilih menu di bawah ini untuk mengelola konten website Company Profile.</p>
        </div>
    </div>

    <!-- STATISTIK CARD -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Produk</h6>
                        <h2 class="fw-bold mb-0"><?= $count_produk; ?></h2>
                    </div>
                    <i class="fa-solid fa-box fa-3x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Artikel</h6>
                        <h2 class="fw-bold mb-0"><?= $count_artikel; ?></h2>
                    </div>
                    <i class="fa-solid fa-newspaper fa-3x opacity-50"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark p-3 rounded-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1">Total Galeri</h6>
                        <h2 class="fw-bold mb-0"><?= $count_galeri; ?></h2>
                    </div>
                    <i class="fa-solid fa-images fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>