<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "data_siswa");

// Cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
?>
