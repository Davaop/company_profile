<?php
// Deteksi nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Digital Solusi Nusantara</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVBAR NAVIGASI -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
  <div class="container">
    <a class="navbar-brand fw-bold text-warning" href="index.php">
        <i class="fa-solid fa-building me-2"></i>PT Digital Solusi
    </a>
    
    <!-- Tombol Responsive Mobile -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'index.php') ? 'active fw-bold text-warning' : ''; ?>" href="index.php">
            <i class="fa-solid fa-house me-1"></i> Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'profile.php') ? 'active fw-bold text-warning' : ''; ?>" href="profile.php">
            <i class="fa-solid fa-user me-1"></i> Profil
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'produk.php' || $current_page == 'detail_produk.php') ? 'active fw-bold text-warning' : ''; ?>" href="produk.php">
            <i class="fa-solid fa-box me-1"></i> Produk
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'artikel.php' || $current_page == 'detail_artikel.php') ? 'active fw-bold text-warning' : ''; ?>" href="artikel.php">
            <i class="fa-solid fa-newspaper me-1"></i> Artikel
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'galeri.php') ? 'active fw-bold text-warning' : ''; ?>" href="galeri.php">
            <i class="fa-solid fa-images me-1"></i> Galeri
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'kontak.php') ? 'active fw-bold text-warning' : ''; ?>" href="kontak.php">
            <i class="fa-solid fa-phone me-1"></i> Kontak
          </a>
        </li>
        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
          <a class="btn btn-warning btn-sm text-dark fw-bold px-3 w-100" href="admin/login.php">
            <i class="fa-solid fa-right-to-bracket me-1"></i> Login Admin
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>