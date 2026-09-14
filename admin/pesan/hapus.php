<?php
session_start();
include "../../config/koneksi.php";

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit();
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
mysqli_query($koneksi, "DELETE FROM pesan WHERE id='$id'");

header("Location: index.php");
exit();
?>