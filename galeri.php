<?php
// 1. Panggil koneksi dan header
include "config/koneksi.php";
include "includes/header.php";
?>

<!-- BANNER JUDUL HALAMAN -->
<section class="bg-primary text-white py-4 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Galeri Kegiatan</h1>
        <p class="mb-0">Dokumentasi Aktivitas dan Aset PT Digital Solusi Nusantara</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <?php
        // Ambil semua data galeri dari database
        $query = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY id DESC");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        <!-- Foto Galeri -->
                        <img src="assets/img/<?= $row['foto']; ?>" 
                             class="card-img-top img-fluid" 
                             alt="<?= $row['judul']; ?>" 
                             style="height: 250px; object-fit: cover;" 
                             onerror="this.src='https://via.placeholder.com/400x250?text=Galeri+Foto'">
                        
                        <div class="card-body bg-white text-center">
                            <h6 class="card-title fw-bold text-dark mb-0"><?= e($row['judul']); ?></h6>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-images fa-3x text-muted mb-3"></i>
                <p class="text-muted fs-5">Belum ada foto galeri yang diunggah.</p>
            </div>';
        }
        ?>
    </div>
</div>

<?php
// 2. Panggil footer
include "includes/footer.php";
?>