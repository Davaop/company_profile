<?php
$host     = "localhost";
$user     = "root";
$password = "";
$database = "db_companyprofile";

// Perintah untuk menyambungkan PHP ke MySQL XAMPP
$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek apakah koneksi berhasil atau gagal
if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>