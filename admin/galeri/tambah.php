<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$error = "";

if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);

    if (!empty($_FILES['foto']['name'])) {
        $nama_foto_baru = uploadGambar($_FILES['foto']);
        if ($nama_foto_baru === false) {
            $error = "File gagal diunggah! Harus berupa gambar (JPG, PNG, WEBP, GIF) dan maksimal 2MB.";
        }
    } else {
        $error = "File foto wajib diisi!";
    }

    if (empty($error)) {
        $query = "INSERT INTO galeri (judul, foto) VALUES ('$judul', '$nama_foto_baru')";
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
    <title>Tambah Foto Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Tambah Foto Galeri</h4>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small mb-3">
                        <?= $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul / Keterangan Foto</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">File Foto</label>
                        <input type="file" name="foto" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary fw-bold">Simpan Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>