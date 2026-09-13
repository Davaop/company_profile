<?php
// 1. Panggil koneksi dan header
include "config/koneksi.php";
include "includes/header.php";
?>

<!-- BANNER JUDUL HALAMAN -->
<section class="bg-primary text-white py-4 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Artikel & Berita Terbaru</h1>
        <p class="mb-0">Dapatkan Informasi dan Wawasan Terbaru Seputar Perkembangan Teknologi</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <?php
        // Ambil semua data artikel dari database (urutkan dari yang terbaru)
        $query = mysqli_query($koneksi, "SELECT * FROM artikel ORDER BY tanggal DESC");

        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
        ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Thumbnail Artikel -->
                        <img src="assets/img/<?= $row['thumbnail']; ?>" 
                             class="card-img-top" 
                             alt="<?= $row['judul']; ?>" 
                             style="height: 200px; object-fit: cover;" 
                             onerror="this.src='https://via.placeholder.com/400x200?text=Artikel+IT'">
                        
                        <div class="card-body">
                            <small class="text-muted d-block mb-2">
                                <i class="fa-regular fa-calendar me-1"></i><?= date('d M Y', strtotime($row['tanggal'])); ?>
                            </small>
                            <h5 class="card-title fw-bold text-primary"><?= $row['judul']; ?></h5>
                            <p class="card-text text-secondary lh-base">
                                <?= substr($row['ringkasan'], 0, 120); ?>...
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 pb-3">
                            <!-- Link ke modal / detail artikel -->
                            <button type="button" class="btn btn-outline-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#modalArtikel<?= $row['id']; ?>">
                                <i class="fa-solid fa-eye me-1"></i> Baca Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MODAL POPUP UNTUK DETAIL ISINIYA -->
                <div class="modal fade" id="modalArtikel<?= $row['id']; ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold text-primary"><?= $row['judul']; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted small">
                                    <i class="fa-regular fa-calendar me-1"></i> Dipublikasikan pada: <?= date('d F Y', strtotime($row['tanggal'])); ?>
                                </p>
                                <img src="assets/img/<?= $row['thumbnail']; ?>" class="img-fluid rounded mb-3 w-100" style="max-height: 350px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/800x350?text=Artikel+IT'">
                                <div class="lh-lg text-secondary">
                                    <?= nl2br($row['isi_artikel']); ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo '
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-newspaper fa-3x text-muted mb-3"></i>
                <p class="text-muted fs-5">Belum ada artikel yang dipublikasikan.</p>
            </div>';
        }
        ?>
    </div>
</div>

<?php
// 2. Panggil footer
include "includes/footer.php";
?>