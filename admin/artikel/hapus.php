<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM artikel WHERE id='$id'"));

if ($data) {
    if (file_exists("../../assets/img/" . $data['thumbnail'])) {
        unlink("../../assets/img/" . $data['thumbnail']);
    }
    mysqli_query($koneksi, "DELETE FROM artikel WHERE id='$id'");
}

header("Location: index.php");
exit();
?>