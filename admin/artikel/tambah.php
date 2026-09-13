<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$error = "";

if (isset($_POST['simpan'])) {
    $judul       = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $ringkasan   = mysqli_real_escape_string($koneksi, $_POST['ringkasan']);
    $isi_artikel = mysqli_real_escape_string($koneksi, $_POST['isi_artikel']);
    $tanggal     = date('Y-m-d');

    if (!empty($_FILES['thumbnail']['name'])) {
        $nama_thumb_baru = uploadGambar($_FILES['thumbnail']);
        if ($nama_thumb_baru === false) {
            $error = "File gagal diunggah! Harus berupa gambar (JPG, PNG, WEBP, GIF) dan maksimal 2MB.";
        }
    } else {
        $nama_thumb_baru = 'default_artikel.jpg';
    }

    if (empty($error)) {
        $query = "INSERT INTO artikel (judul, ringkasan, isi_artikel, thumbnail, tanggal) 
                  VALUES ('$judul', '$ringkasan', '$isi_artikel', '$nama_thumb_baru', '$tanggal')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Artikel - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Tambah Artikel Baru</h4>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small mb-3">
                        <?= $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Artikel</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ringkasan Singkat</label>
                        <textarea name="ringkasan" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Artikel Lengkap</label>
                        <textarea name="isi_artikel" class="form-control" rows="6" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary fw-bold">Simpan Artikel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>