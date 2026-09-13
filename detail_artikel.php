<?php
include "config/koneksi.php";
include "includes/header.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'");
$artikel = mysqli_fetch_assoc($query);

if (!$artikel) {
    echo "<div class='container my-5 text-center'><h4>Artikel tidak ditemukan!</h4><a href='artikel.php' class='btn btn-primary mt-3'>Kembali</a></div>";
    include "includes/footer.php";
    exit();
}
?>

<div class="container my-5">
    <!-- Tombol Kembali -->
    <a href="artikel.php" class="btn btn-outline-secondary mb-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Artikel
    </a>

    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="fw-bold text-primary mb-3"><?= e($artikel['judul']); ?></h1>
            <p class="text-muted small mb-4">
                <i class="fa-regular fa-calendar me-1"></i> Dipublikasikan pada: <?= date('d F Y', strtotime($artikel['tanggal'])); ?>
            </p>
            
            <img src="assets/img/<?= e($artikel['thumbnail']); ?>" class="img-fluid rounded mb-4 w-100 shadow-sm" style="max-height: 400px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/800x400?text=Artikel'">

            <div class="lh-lg text-secondary fs-5" style="text-align: justify;">
                <?= nl2br(e($artikel['isi_artikel'])); ?>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>