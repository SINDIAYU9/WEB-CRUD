<?php
session_start();
// Jika tidak bisa login maka balik ke login_siswa.php
if (!isset($_SESSION['siswa_login']) || !isset($_SESSION['nim'])) {
    header('location:login_siswa.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';
include "koneksi.php";

// Ambil data semua mahasiswa
$all_mahasiswa = query("SELECT * FROM siswa");

// Header file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_mahasiswa.csv');

// Buat file pointer
$output = fopen('php://output', 'w');

// Header kolom
fputcsv($output, array('NIM', 'Nama', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Umur', 'Jurusan', 'Email', 'Telepon', 'Alamat', 'Nama Ayah', 'Nama Ibu', 'NIK', 'Kelas', 'Tahun Masuk'));

// Ambil data setiap mahasiswa
foreach ($all_mahasiswa as $mahasiswa) {
    $now = time();
    $timeTahun = strtotime($mahasiswa['tgl_Lahir']);
    $setahun = 31536000;
    $umur = floor(($now - $timeTahun) / $setahun);

    fputcsv($output, array(
        $mahasiswa['nim'],
        $mahasiswa['nama'],
        $mahasiswa['tmpt_Lahir'],
        $mahasiswa['tgl_Lahir'],
        $mahasiswa['jekel'],
        $umur,
        $mahasiswa['jurusan'],
        $mahasiswa['email'],
        $mahasiswa['telpon'],
        $mahasiswa['alamat'],
        $mahasiswa['ayah'],
        $mahasiswa['ibu'],
        $mahasiswa['nik'],
        $mahasiswa['kelas'],
        $mahasiswa['tahun_masuk']
    ));
}

// Tutup file pointer
fclose($output);
exit;
?>
