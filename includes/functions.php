<?php
// includes/functions.php

/**
 * Cek apakah admin sudah login. Panggil di baris atas tiap halaman admin.
 */
function cekLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['admin_logged_in'])) {
        header("Location: /company_profile/admin/login.php");
        exit();
    }
}

/**
 * Upload gambar dengan validasi ekstensi + validasi isi file asli.
 * Return: nama file baru kalau sukses, false kalau ditolak.
 */
function uploadGambar($file, $folderTujuan = "../../assets/img/") {
    if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Whitelist ekstensi
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt)) {
        return false; // ini yang nolak .pdf/.php walau extension dipaksa jadi .jpg tetep dicek isinya di bawah
    }

    // Cek isi file BENERAN gambar (bukan cuma nama/ekstensi doang)
    $mime = mime_content_type($file['tmp_name']);
    $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    if (!in_array($mime, $allowedMime)) {
        return false;
    }

    // Batasi ukuran, contoh max 2MB
    if ($file['size'] > 2 * 1024 * 1024) {
        return false;
    }

    $namaBaru = time() . '_' . rand(100, 999) . '.' . $ext;
    if (!move_uploaded_file($file['tmp_name'], $folderTujuan . $namaBaru)) {
        return false;
    }

    return $namaBaru;
}

/**
 * Escape output ke HTML biar aman dari XSS. Pakai tiap nge-print data DB.
 */
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}