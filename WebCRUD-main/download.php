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
$all_mahasiswa = query("SELECT * FROM siswa ORDER BY nim DESC");

// Membuat nama file
$filename = "data_siswa-" . date('Ymd') . ".xls";

// Set header untuk download file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$filename");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tempat dan Tanggal Lahir</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Jurusan</th>
            <th>E-Mail</th>
            <th>Alamat</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th style="width: 150px;">NIK</th> <!-- Mengatur lebar kolom NIK -->
            <th>Kelas</th>
            <th>Tahun Masuk</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($all_mahasiswa as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nim']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['tmpt_Lahir']; ?>, <?= $row['tgl_Lahir']; ?></td>
                <?php
                $now = time();
                $timeTahun = strtotime($row['tgl_Lahir']);
                $setahun = 31536000;
                $hitung = ($now - $timeTahun) / $setahun;
                ?>
                <td><?= floor($hitung); ?> Tahun</td>
                <td><?= $row['jekel']; ?></td>
                <td><?= $row['jurusan']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['ayah']; ?></td>
                <td><?= $row['ibu']; ?></td>
                <!-- Menggunakan sprintf untuk memastikan NIK ditampilkan sebagai teks dan mengatur lebar kolom -->
                <td style="width: 150px;"><?= sprintf('="%s"', $row['nik']); ?></td>
                <td><?= $row['kelas']; ?></td>
                <td><?= $row['tahun_masuk']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
