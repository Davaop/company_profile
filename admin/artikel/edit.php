<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

// 1. Ambil & validasi ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

// Jika ID tidak ditemukan di DB, kembalikan ke index.php
if (!$data) {
    header("Location: index.php");
    exit();
}

$error = "";

// 2. Proses Submit Form Update
if (isset($_POST['update'])) {
    $judul       = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $ringkasan   = mysqli_real_escape_string($koneksi, $_POST['ringkasan']);
    $isi_artikel = mysqli_real_escape_string($koneksi, $_POST['isi_artikel']);

    // Jika admin memilih file gambar baru
    if (!empty($_FILES['thumbnail']['name'])) {
        $nama_thumb_baru = uploadGambar($_FILES['thumbnail']);
        
        if ($nama_thumb_baru !== false) {
            // Hapus gambar lama jika ada
            if (!empty($data['thumbnail']) && file_exists("../../assets/img/" . $data['thumbnail'])) {
                unlink("../../assets/img/" . $data['thumbnail']);
            }
            $query_update = "UPDATE artikel SET judul='$judul', ringkasan='$ringkasan', isi_artikel='$isi_artikel', thumbnail='$nama_thumb_baru' WHERE id='$id'";
        } else {
            $error = "File thumbnail gagal diunggah! Harus berupa gambar (JPG, PNG, WEBP, GIF) dan maks 2MB.";
        }
    } else {
        // Jika tidak mengganti gambar
        $query_update = "UPDATE artikel SET judul='$judul', ringkasan='$ringkasan', isi_artikel='$isi_artikel' WHERE id='$id'";
    }

    if (empty($error)) {
        if (mysqli_query($koneksi, $query_update)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Gagal memperbarui database: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Artikel - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Artikel</h4>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small mb-3">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> <?= $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" value="<?= e($data['judul']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ringkasan Singkat</label>
                        <textarea name="ringkasan" class="form-control" rows="2" required><?= e($data['ringkasan']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Artikel Lengkap</label>
                        <textarea name="isi_artikel" class="form-control" rows="6" required><?= e($data['isi_artikel']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Thumbnail Saat Ini</label><br>
                        <img src="../../assets/img/<?= e($data['thumbnail']); ?>" width="120" class="rounded mb-2 shadow-sm" onerror="this.src='https://via.placeholder.com/120'">
                        <input type="file" name="thumbnail" class="form-control">
                        <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning fw-bold">Update Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>