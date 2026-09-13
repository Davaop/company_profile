<?php
// 1. Panggil koneksi dan header
include "config/koneksi.php";
include "includes/header.php";

// 2. Ambil data profil dari database
$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);
?>

<!-- BANNER JUDUL HALAMAN -->
<section class="bg-primary text-white py-4 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Profil Perusahaan</h1>
        <p class="mb-0">Mengenal Lebih Dekat PT Digital Solusi Nusantara</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <!-- SEJARAH PERUSAHAAN -->
        <div class="col-12">
            <div class="card shadow-sm border-0 p-4">
                <h3 class="fw-bold text-primary mb-3"><i class="fa-solid fa-history me-2"></i>Sejarah Perusahaan</h3>
                <p class="text-secondary lh-lg" style="text-align: justify;">
                    <?= !empty($profil['sejarah']) ? nl2br($profil['sejarah']) : 'Data sejarah perusahaan belum diisi.'; ?>
                </p>
            </div>
        </div>

        <!-- VISI & MISI -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 p-4">
                <h3 class="fw-bold text-primary mb-3"><i class="fa-solid fa-eye me-2"></i>Visi</h3>
                <p class="text-secondary lh-lg">
                    <?= !empty($profil['visi']) ? nl2br($profil['visi']) : 'Data visi belum diisi.'; ?>
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0 p-4">
                <h3 class="fw-bold text-primary mb-3"><i class="fa-solid fa-bullseye me-2"></i>Misi</h3>
                <p class="text-secondary lh-lg">
                    <?= !empty($profil['misi']) ? nl2br($profil['misi']) : 'Data misi belum diisi.'; ?>
                </p>
            </div>
        </div>

        <!-- NILAI-NILAI PERUSAHAAN -->
        <div class="col-12">
            <div class="card shadow-sm border-0 p-4 bg-light">
                <h3 class="fw-bold text-primary mb-3"><i class="fa-solid fa-star me-2"></i>Nilai-Nilai Utama</h3>
                <p class="text-secondary lh-lg mb-0">
                    <?= !empty($profil['nilai_perusahaan']) ? nl2br($profil['nilai_perusahaan']) : 'Data nilai perusahaan belum diisi.'; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<?php
// 3. Panggil footer
include "includes/footer.php";
?>