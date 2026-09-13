<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'"));

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);

    $filename = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];

    if ($filename != '') {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $nama_foto_baru = time() . '_' . rand(100, 999) . '.' . $ext;
        move_uploaded_file($tmp_name, "../../assets/img/" . $nama_foto_baru);

        if (file_exists("../../assets/img/" . $data['foto'])) {
            unlink("../../assets/img/" . $data['foto']);
        }

        $query = "UPDATE galeri SET judul='$judul', foto='$nama_foto_baru' WHERE id='$id'";
    } else {
        $query = "UPDATE galeri SET judul='$judul' WHERE id='$id'";
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
    <title>Edit Foto Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="fw-bold mb-4">Edit Foto Galeri</h4>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul / Keterangan Foto</label>
                        <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto Saat Ini</label><br>
                        <img src="../../assets/img/<?= $data['foto']; ?>" width="120" class="rounded mb-2" onerror="this.src='https://via.placeholder.com/120'">
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">*Biarkan kosong jika tidak diganti.</small>
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