<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id='$id'"));

if ($data) {
    if (!empty($data['foto']) && file_exists("../../assets/img/" . $data['foto'])) {
        unlink("../../assets/img/" . $data['foto']);
    }
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id='$id'");
}

header("Location: index.php");
exit();
?>