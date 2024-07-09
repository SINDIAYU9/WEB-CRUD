<?php
session_start();
// Jika tidak bisa login maka balik ke login_siswa.php
if (!isset($_SESSION['siswa_login'])) {
    header('location:login_siswa.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';
include "koneksi.php";

// Mengambil informasi siswa yang sedang login berdasarkan nim dari session
$nim = $_SESSION['nim'];
$siswa = query("SELECT * FROM siswa WHERE nim = '$nim'")[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Home Siswa</title>
</head>

<body background="img/bg/bck.png">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index_siswa.php">Sistem Informasi Data Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="text-center fw-bold text-uppercase text-light data_siswa">Informasi Siswa</h3>
                <hr>
            </div>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <table class="table table-striped table-responsive table-hover text-center" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-secondary text-dark">
                            <td><?= $siswa['nama']; ?></td>
                            <td><?= $siswa['jekel']; ?></td>
                            <?php
                            $now = time();
                            $timeTahun = strtotime($siswa['tgl_Lahir']);
                            $setahun = 31536000;
                            $hitung = ($now - $timeTahun) / $setahun;
                            ?>
                            <td><?= floor($hitung); ?> Tahun</td>
                            <td><?= $siswa['jurusan']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white text-center">
            <div class="col my-2" id="politeknik gajah tunggal">
                <h4 class="fw-bold text-uppercase">POLITEKNIK GAJAH TUNGGAL</h4>
                <br><br><br>
                <div>
                    <a href="#" class="text-white">HOME</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>
