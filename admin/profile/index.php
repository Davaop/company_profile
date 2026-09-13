<?php
session_start();
include "../../config/koneksi.php";
include "../../includes/functions.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$message = "";

// Cek apakah data profil sudah ada di database
$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);

// Proses Update Profil
if (isset($_POST['simpan'])) {
    $sejarah          = mysqli_real_escape_string($koneksi, $_POST['sejarah']);
    $visi             = mysqli_real_escape_string($koneksi, $_POST['visi']);
    $misi             = mysqli_real_escape_string($koneksi, $_POST['misi']);
    $nilai_perusahaan = mysqli_real_escape_string($koneksi, $_POST['nilai_perusahaan']);
    $alamat           = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $telepon          = mysqli_real_escape_string($koneksi, $_POST['telepon']);
    $email            = mysqli_real_escape_string($koneksi, $_POST['email']);
    $maps_embed       = mysqli_real_escape_string($koneksi, $_POST['maps_embed']);

    if ($profil) {
        // Update data jika sudah ada
        $id = $profil['id'];
        $sql = "UPDATE profil SET 
                sejarah='$sejarah', visi='$visi', misi='$misi', nilai_perusahaan='$nilai_perusahaan', 
                alamat='$alamat', telepon='$telepon', email='$email', maps_embed='$maps_embed' 
                WHERE id='$id'";
    } else {
        // Insert data jika tabel masih kosong
        $sql = "INSERT INTO profil (sejarah, visi, misi, nilai_perusahaan, alamat, telepon, email, maps_embed) 
                VALUES ('$sejarah', '$visi', '$misi', '$nilai_perusahaan', '$alamat', '$telepon', '$email', '$maps_embed')";
    }

    if (mysqli_query($koneksi, $sql)) {
        $message = "Data profil berhasil diperbarui!";
        // Refresh data profil
        $query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
        $profil = mysqli_fetch_assoc($query);
    } else {
        $message = "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Profil Perusahaan - Admin</title>
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
        <li class="nav-item"><a class="nav-link active" href="index.php">Profil Perusahaan</a></li>
        <li class="nav-item"><a class="nav-link" href="../produk/index.php">Produk</a></li>
        <li class="nav-item"><a class="nav-link" href="../artikel/index.php">Artikel</a></li>
        <li class="nav-item"><a class="nav-link" href="../galeri/index.php">Galeri</a></li>
      </ul>
      <a href="../logout.php" class="btn btn-danger btn-sm"><i class="fa-solid fa-power-off me-1"></i> Logout</a>
    </div>
  </div>
</nav>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="fw-bold mb-4"><i class="fa-solid fa-building me-2"></i>Kelola Profil & Informasi Perusahaan</h3>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i><?= $message; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sejarah Perusahaan</label>
                        <textarea name="sejarah" class="form-control" rows="4" required><?= e($profil['sejarah'] ?? ''); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Visi</label>
                            <textarea name="visi" class="form-control" rows="4" required><?= e($profil['visi'] ?? ''); ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Misi</label>
                            <textarea name="misi" class="form-control" rows="4" required><?= e($profil['misi'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nilai-Nilai Utama Perusahaan</label>
                        <textarea name="nilai_perusahaan" class="form-control" rows="3" required><?= e($profil['nilai_perusahaan'] ?? ''); ?></textarea>
                    </div>

                    <hr class="my-4">
                    <h5 class="fw-bold text-primary mb-3">Informasi Kontak & Lokasi</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap Kantor</label>
                        <textarea name="alamat" class="form-control" rows="2" required><?= e($profil['alamat'] ?? ''); ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="telepon" class="form-control" value="<?= e($profil['telepon'] ?? ''); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Email Resmi</label>
                            <input type="email" name="email" class="form-control" value="<?= e($profil['email'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Google Maps Embed Code (HTML Tag `&lt;iframe&gt;`)</label>
                        <textarea name="maps_embed" class="form-control" rows="3" placeholder="Contoh: <iframe src='...'></iframe>"><?= e($profil['maps_embed'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary fw-bold px-4 py-2">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan Profil
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>