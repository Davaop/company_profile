<?php
// Memanggil koneksi database
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Digital Solusi Nusantara</title>

    <!-- Bootstrap 5 CSS (Sesuai Syarat Jobsheet) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome untuk Ikon (Sesuai Syarat Jobsheet) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS Sendiri -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- NAVIGATION BAR (RESPONSIF DESKTOP & HP) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
        <i class="fa-solid fa-building-columns me-2"></i>PT DSN
    </a>
    
    <!-- Tombol Hamburger untuk Tampilan HP -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Menu Navigasi -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php">Profil</a></li>
        <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="artikel.php">Artikel</a></li>
        <li class="nav-item"><a class="nav-link" href="galeri.php">Galeri</a></li>
        <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
        <li class="nav-item ms-lg-2">
            <a class="btn btn-light text-primary fw-semibold px-3" href="admin/login.php">
                <i class="fa-solid fa-right-to-bracket me-1"></i> Login Admin
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>