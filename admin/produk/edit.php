<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'"));

if (isset($_POST['update'])) {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    if ($filename != '') {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_gambar_baru = time() . '_' . rand(100, 999) . '.' . $ext;
        move_uploaded_file($tmp_name, "../../assets/img/" . $nama_gambar_baru);

        // Hapus gambar lama jika ada
        if (file_exists("../../assets/img/" . $data['gambar'])) {
            unlink("../../assets/img/" . $data['gambar']);
        }

        $query = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', gambar='$nama_gambar_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi' WHERE id='$id'";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
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
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="<?= $data['nama_produk']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required><?= $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gambar Produk Saat Ini</label><br>
                        <img src="../../assets/img/<?= $data['gambar']; ?>" width="100" class="rounded mb-2" onerror="this.src='https://via.placeholder.com/100'">
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