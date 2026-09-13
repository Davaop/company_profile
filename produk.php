<?php
// 1. Panggil koneksi dan header
include "config/koneksi.php";
include "includes/header.php";
?>

<!-- BANNER JUDUL HALAMAN -->
<section class="bg-primary text-white py-4 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Produk & Layanan Kami</h1>
        <p class="mb-0">Solusi Teknologi Inovatif untuk Mendukung Performa Bisnis Anda</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <?php
        // Ambil semua data produk dari database
        $query = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id DESC");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Gambar Produk -->
                        <img src="assets/img/<?= $row['gambar']; ?>" 
                             class="card-img-top" 
                             alt="<?= $row['nama_produk']; ?>" 
                             style="height: 220px; object-fit: cover;" 
                             onerror="this.src='https://via.placeholder.com/400x220?text=Produk+IT'">
                        
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-primary"><?= e($row['nama_produk']); ?></h5>
                            <p class="card-text text-secondary lh-base"><?= nl2br(e($row['deskripsi'])); ?></p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <a href="kontak.php" class="btn btn-outline-primary w-100">
                                <i class="fa-solid fa-envelope me-1"></i> Pesan Layanan Ini
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted fs-5">Belum ada produk atau layanan yang ditambahkan.</p>
            </div>';
        }
        ?>
    </div>
</div>

<?php
// 2. Panggil footer
include "includes/footer.php";
?>