<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Upload Gambar
    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    
    if ($filename != '') {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_gambar_baru = time() . '_' . rand(100, 999) . '.' . $ext;
        move_uploaded_file($tmp_name, "../../assets/img/" . $nama_gambar_baru);
    } else {
        $nama_gambar_baru = 'default.jpg';
    }

    $query = "INSERT INTO produk (nama_produk, deskripsi, gambar) VALUES ('$nama_produk', '$deskripsi', '$nama_gambar_baru')";
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
    <title>Tambah Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Tambah Produk Baru</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Produk</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-primary fw-bold">Simpan Produk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>