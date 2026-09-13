<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="../dashboard.php"><i class="fa-solid fa-gauge me-2"></i>Admin Panel</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="../dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="../profile/index.php">Profil Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link" href="../produk/index.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="../artikel/index.php">Artikel</a></li>
        <li class="nav-item"><a class="nav-link active" href="index.php">Galeri</a></li>
      </ul>
      <a href="../logout.php" class="btn btn-danger btn-sm"><i class="fa-solid fa-power-off me-1"></i> Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="fa-solid fa-images me-2"></i>Kelola Galeri Foto</h3>
        <a href="tambah.php" class="btn btn-primary fw-semibold"><i class="fa-solid fa-plus me-1"></i> Tambah Foto</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th width="100">Foto</th>
                        <th>Judul / Keterangan</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    if (mysqli_num_rows($query) > 0):
                        while ($row = mysqli_fetch_assoc($query)): 
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td>
                                <img src="../../assets/img/<?= $row['foto']; ?>" width="70" class="rounded shadow-sm" style="height: 50px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/70'">
                            </td>
                            <td class="fw-bold"><?= $row['judul']; ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus foto ini?')"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada foto galeri.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>