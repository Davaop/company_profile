<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'"));

if ($data) {
    if (!empty($data['gambar']) && file_exists("../../assets/img/" . $data['gambar'])) {
        unlink("../../assets/img/" . $data['gambar']);
    }
    mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id'");
}

header("Location: index.php");
exit();
?>