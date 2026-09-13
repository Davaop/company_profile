<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);

    if (!empty($_FILES['foto']['name'])) {
        $nama_foto_baru = uploadGambar($_FILES['foto']);
        if ($nama_foto_baru !== false) {
            if (!empty($data['foto']) && file_exists("../../assets/img/" . $data['foto'])) {
                unlink("../../assets/img/" . $data['foto']);
            }
            $query_update = "UPDATE galeri SET judul='$judul', foto='$nama_foto_baru' WHERE id='$id'";
        } else {
            $error = "File gagal diunggah! Harus gambar (JPG/PNG/WEBP/GIF), maks 2MB.";
        }
    } else {
        $query_update = "UPDATE galeri SET judul='$judul' WHERE id='$id'";
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
    <title>Edit Foto Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Edit Foto Galeri</h4>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small mb-3"><?= $error; ?></div>
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul / Keterangan Foto</label>
                        <input type="text" name="judul" class="form-control" value="<?= e($data['judul']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Saat Ini</label><br>
                        <img src="../../assets/img/<?= e($data['foto']); ?>" width="120" class="rounded mb-2" onerror="this.src='https://via.placeholder.com/120'">
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">*Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-warning fw-bold">Update Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>