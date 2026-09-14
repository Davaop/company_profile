<?php
session_start();
include "../../config/koneksi.php";
include "../../includes/functions.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM pesan ORDER BY tanggal_kirim DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Masuk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body class="bg-light">

<?php $base = "../"; $current_admin = "pesan"; include "../../includes/admin_nav.php"; ?>

<div class="container my-5">
    <h4 class="fw-bold mb-4">Pesan Masuk dari Pengunjung</h4>
    <div class="table-responsive">
        <table class="table table-striped bg-white shadow-sm rounded">
            <thead class="table-dark">
                <tr><th>Tanggal</th><th>Nama</th><th>Email</th><th>Pesan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= date('d/m/Y H:i', strtotime($row['tanggal_kirim'])); ?></td>
                            <td class="fw-bold"><?= e($row['nama']); ?></td>
                            <td><?= e($row['email']); ?></td>
                            <td><?= nl2br(e($row['isi_pesan'])); ?></td>
                            <td>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus pesan ini?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesan masuk.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>