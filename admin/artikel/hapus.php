<?php
include "../../config/koneksi.php";
include "../../includes/functions.php";
cekLogin();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'"));

if ($data) {
    if (!empty($data['thumbnail']) && file_exists("../../assets/img/" . $data['thumbnail'])) {
        unlink("../../assets/img/" . $data['thumbnail']);
    }
    mysqli_query($koneksi, "DELETE FROM artikel WHERE id='$id'");
}

header("Location: index.php");
exit();
?>