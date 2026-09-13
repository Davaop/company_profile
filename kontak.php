<?php
// 1. Panggil koneksi dan header
include "config/koneksi.php";
include "includes/header.php";

// 2. Ambil data profil perusahaan dari database
$query = mysqli_query($koneksi, "SELECT * FROM profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);
?>

<!-- BANNER JUDUL HALAMAN -->
<section class="bg-primary text-white py-4 mb-5">
    <div class="container text-center">
        <h1 class="fw-bold">Hubungi Kami</h1>
        <p class="mb-0">Kami Siap Membantu Kebutuhan Teknologi dan Informasi Perusahaan Anda</p>
    </div>
</section>

<div class="container mb-5">
    <div class="row g-4">
        <!-- INFORMASI KONTAK & FORM -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-4 h-100">
                <h4 class="fw-bold text-primary mb-4"><i class="fa-solid fa-headset me-2"></i>Informasi Kontak</h4>
                
                <div class="d-flex mb-3">
                    <i class="fa-solid fa-location-dot text-primary fa-lg me-3 mt-2"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Kantor</h6>
                        <p class="text-secondary mb-0"><?= !empty($profil['alamat']) ? nl2br(e($profil['alamat'])) : 'Alamat belum diatur.'; ?></p>
                    </div>
                </div>

                <div class="d-flex mb-3">
                    <i class="fa-solid fa-phone text-primary fa-lg me-3 mt-2"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon / WhatsApp</h6>
                        <p class="text-secondary mb-0"><?= !empty($profil['telepon']) ? e($profil['telepon']) : 'Nomor belum diatur.'; ?></p>
                    </div>
                </div>

                <div class="d-flex mb-4">
                    <i class="fa-solid fa-envelope text-primary fa-lg me-3 mt-2"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Email Resmi</h6>
                        <p class="text-secondary mb-0"><?= !empty($profil['email']) ? e($profil['email']) : 'Email belum diatur.'; ?></p>
                    </div>
                </div>

                <hr>

                <!-- FORM KIRIM PESAN (STATIS / FRONTEND) -->
                <h5 class="fw-bold text-dark mt-2 mb-3">Kirim Pesan</h5>
                <form action="" method="POST" onsubmit="alert('Pesan berhasil terkirim!'); return false;">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Alamat Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="3" placeholder="Pesan Anda..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">
                        <i class="fa-solid fa-paper-plane me-1"></i> Kirim
                    </button>
                </form>
            </div>
        </div>

        <!-- GOOGLE MAPS EMBED -->
        <div class="col-md-7">
            <div class="card shadow-sm border-0 p-3 h-100">
                <h4 class="fw-bold text-primary mb-3"><i class="fa-solid fa-map-location-dot me-2"></i>Lokasi Kami</h4>
                <div class="rounded overflow-hidden h-100">
                    <?php 
                    if (!empty($profil['maps_embed'])) {
                        echo $profil['maps_embed'];
                    } else {
                        echo '<div class="alert alert-secondary text-center my-auto py-5">Peta Lokasi Belum Diatur.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// 3. Panggil footer
include "includes/footer.php";
?>