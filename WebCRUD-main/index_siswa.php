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

    <style>
        .photo-container {
            display: inline-block;
            border: 2px solid #ffffff;
            padding: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: #ffffff;
        }

        .photo-container img {
            width: 150px;
            height: 200px;
            object-fit: cover;
        }
    </style>
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-dark text-white">
                    <div class="card-header text-center">
                        <h3 class="fw-bold text-uppercase">Profil Siswa</h3>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        // Tentukan jalur gambar default jika tidak ada gambar
                        $default_image = "img/foto/default.png";
                        $image_path = "img/" . htmlspecialchars($siswa['gambar']);
                        // Jika file gambar tidak ada, gunakan gambar default
                        if (!file_exists($image_path) || empty($siswa['gambar'])) {
                            $image_path = $default_image;
                        }
                        ?>
                        <div class="photo-container">
                            <img src="<?= $image_path; ?>" alt="Foto Siswa">
                        </div>
                        <h4><?= htmlspecialchars($siswa['nama']); ?></h4>
                        <p><?= htmlspecialchars($siswa['nim']); ?></p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Jenis Kelamin:</strong> <?= htmlspecialchars($siswa['jekel']); ?></p>
                            </div>
                            <div class="col-md-6">
                                <?php
                                $now = time();
                                $timeTahun = strtotime($siswa['tgl_Lahir']);
                                $setahun = 31536000;
                                $hitung = ($now - $timeTahun) / $setahun;
                                ?>
                                <p><strong>Umur:</strong> <?= floor($hitung); ?> Tahun</p>
                            </div>
                            <div class="col-md-12">
                                <p><strong>Jurusan:</strong> <?= htmlspecialchars($siswa['jurusan']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="container-fluid">
          <div class="row bg-dark text-white text-center">
               <div class="col my-2" id="politeknik gajah tunggal">
                    <br><br><br>
                    <h4 class="fw-bold text-uppercase">POLITEKNIK GAJAH TUNGGAL</h4>

                    <p>
                         Pembuat :
                         1. Sindi Ayu Lestari (2302054)
                         2. Wilson Sitompul (2302057)
                         3. Haiqal Abimanyu Sutono (2302028)
                    </p>
               </div>
          </div>
     </div>    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>
