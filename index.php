<?php
// 1. Wajib panggil koneksi database di paling atas
include "config/koneksi.php";

// 2. Baru panggil header
include "includes/header.php";
?>

<!-- 1. HERO BANNER -->
<section class="bg-primary text-white text-center py-5">
    <div class="container py-4">
        <h1 class="display-4 fw-bold">Selamat Datang di PT Digital Solusi Nusantara</h1>
        <p class="lead">Solusi Terpercaya untuk Pengembangan Website, Jaringan, dan Konsultasi IT.</p>
        <a href="kontak.php" class="btn btn-warning btn-lg fw-bold mt-3">
            <i class="fa-solid fa-paper-plane me-2"></i>Hubungi Kami
        </a>
    </div>
</section>

<!-- 2. TENTANG PERUSAHAAN SINGKAT -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-bold text-primary mb-3">Tentang Perusahaan</h2>
                <?php
                // Ambil data profil dari database
                $query_profil = mysqli_query($koneksi, "SELECT sejarah FROM profil LIMIT 1");
                $profil = mysqli_fetch_assoc($query_profil);
                ?>
                <p class="text-secondary">
                    <?= !empty($profil['sejarah']) ? substr($profil['sejarah'], 0, 300) . '...' : 'PT Digital Solusi Nusantara adalah perusahaan yang bergerak di bidang Jasa IT...'; ?>
                </p>
                <a href="profile.php" class="btn btn-outline-primary">Baca Selengkapnya &raquo;</a>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&auto=format&fit=crop&q=60" class="img-fluid rounded shadow" alt="Tentang Perusahaan">
            </div>
        </div>
    </div>
</section>

<!-- 3. LAYANAN UNGGULAN (DINAMIS DARI DATABASE) -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Layanan Unggulan Kami</h2>
            <p class="text-muted">Kami menghadirkan solusi IT terbaik untuk mendukung bisnis Anda.</p>
        </div>

        <div class="row">
            <?php
            // Ambil maksimal 3 produk/layanan dari database
            $query_produk = mysqli_query($koneksi, "SELECT * FROM produk LIMIT 3");
            if (mysqli_num_rows($query_produk) > 0) {
                while ($produk = mysqli_fetch_assoc($query_produk)) {
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="assets/img/<?= e($produk['gambar']); ?>" class="card-img-top" alt="<?= e($produk['nama_produk']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-primary"><?= e($produk['nama_produk']); ?></h5>
                                <p class="card-text text-secondary lh-base"><?= e(substr($produk['deskripsi'], 0, 100)); ?>...</p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3">
                                <a href="produk.php" class="btn btn-primary btn-sm w-100">Detail Layanan</a>
                            </div>
                        </div>
                    </div>
            <?php 
                }
            } else {
                echo '<div class="col-12 text-center text-muted"><p>Belum ada data produk/layanan.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- 4. ARTIKEL TERBARU (DINAMIS DARI DATABASE) -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Artikel & Informasi Terbaru</h2>
            <p class="text-muted">Dapatkan wawasan terbaru seputar teknologi dan informasi perusahaan.</p>
        </div>

        <div class="row">
            <?php
            // Ambil maksimal 3 artikel terbaru dari database
            $query_artikel = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC LIMIT 3");
            if (mysqli_num_rows($query_artikel) > 0) {
                while ($artikel = mysqli_fetch_assoc($query_artikel)) {
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="assets/img/<?= e($artikel['thumbnail']); ?>" class="card-img-top" alt="<?= e($artikel['judul']); ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <small class="text-muted mb-2 d-block">
                                    <i class="fa-regular fa-calendar me-1"></i><?= date('d M Y', strtotime($artikel['tanggal'])); ?>
                                </small>
                               <h5 class="card-title fw-bold text-dark"><?= e($artikel['judul']); ?></h5>
                               <p class="card-text text-secondary lh-base"><?= e($artikel['ringkasan']); ?></p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-3">
                                <a href="artikel.php" class="btn btn-outline-primary btn-sm w-100">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
            <?php 
                }
            } else {
                echo '<div class="col-12 text-center text-muted"><p>Belum ada artikel terbaru.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<?php
// 5. Panggil footer
include "includes/footer.php";
?>