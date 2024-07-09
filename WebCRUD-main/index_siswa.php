<?php
session_start();

// Jika siswa belum login, alihkan ke halaman login
if (!isset($_SESSION['siswa_login'])) {
    header('location:login_siswa.php');
    exit;
}

echo "Selamat datang, Siswa!";
?>

<a href="logout.php">Logout</a>
