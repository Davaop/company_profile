<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST['update'])) {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    if (!empty($_FILES['gambar']['name'])) {
        $nama_gambar_baru = uploadGambar($_FILES['gambar']);
        if ($nama_gambar_baru !== false) {
            if (!empty($data['gambar']) && file_exists("../../assets/img/" . $data['gambar'])) {
                unlink("../../assets/img/" . $data['gambar']);
            }
            $query_update = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', gambar='$nama_gambar_baru' WHERE id='$id'";
        } else {
            $error = "File gagal diunggah! Harus gambar (JPG/PNG/WEBP/GIF), maks 2MB.";
        }
    } else {
        $query_update = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi' WHERE id='$id'";
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
    <title>Edit Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Edit Produk</h4>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small mb-3"><?= $error; ?></div>
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="<?= e($data['nama_produk']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required><?= e($data['deskripsi']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Produk Saat Ini</label><br>
                        <img src="../../assets/img/<?= e($data['gambar']); ?>" width="100" class="rounded mb-2" onerror="this.src='https://via.placeholder.com/100'">
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning fw-bold">Update Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>