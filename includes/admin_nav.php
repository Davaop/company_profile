<?php
// $base dan $current_admin harus diisi DULU di file yang manggil, sebelum include ini.
// $base = ""  -> kalau file-nya ada langsung di admin/ (contoh: dashboard.php)
// $base = "../" -> kalau file-nya ada di admin/xxx/ (contoh: admin/produk/index.php)
// $current_admin = "dashboard" | "profile" | "produk" | "artikel" | "galeri" | "pesan"
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= $base; ?>dashboard.php"><i class="fa-solid fa-gauge me-2"></i>Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navAdmin">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link <?= $current_admin == 'dashboard' ? 'active' : ''; ?>" href="<?= $base; ?>dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?= $current_admin == 'profile' ? 'active' : ''; ?>" href="<?= $base; ?>profile/index.php">Profil Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link <?= $current_admin == 'produk' ? 'active' : ''; ?>" href="<?= $base; ?>produk/index.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link <?= $current_admin == 'artikel' ? 'active' : ''; ?>" href="<?= $base; ?>artikel/index.php">Artikel</a></li>
        <li class="nav-item"><a class="nav-link <?= $current_admin == 'galeri' ? 'active' : ''; ?>" href="<?= $base; ?>galeri/index.php">Galeri</a></li>
        <li class="nav-item"><a class="nav-link <?= $current_admin == 'pesan' ? 'active' : ''; ?>" href="<?= $base; ?>pesan/index.php">Pesan Masuk</a></li>
      </ul>
      <a href="<?= $base; ?>logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin logout?')">
        <i class="fa-solid fa-power-off me-1"></i> Logout
      </a>
    </div>
  </div>
</nav>