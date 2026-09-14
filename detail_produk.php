<?php
include "config/koneksi.php";
include "includes/header.php";

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    echo "<div class='container my-5 text-center'><h4>Produk tidak ditemukan!</h4><a href='produk.php' class='btn btn-primary mt-3'>Kembali</a></div>";
    include "includes/footer.php";
    exit();
}
?>

<div class="container my-5">
    <a href="produk.php" class="btn btn-outline-secondary mb-4">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Produk
    </a>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <img src="assets/img/<?= e($produk['gambar']); ?>" class="img-fluid rounded mb-4 w-100 shadow-sm" style="max-height: 400px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/800x400?text=Produk'">

            <h1 class="fw-bold text-primary mb-3"><?= e($produk['nama_produk']); ?></h1>

            <div class="lh-lg text-secondary fs-5" style="text-align: justify;">
                <?= nl2br(e($produk['deskripsi'])); ?>
            </div>

            <a href="kontak.php" class="btn btn-primary fw-bold mt-4">
                <i class="fa-solid fa-envelope me-1"></i> Pesan Layanan Ini
            </a>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>