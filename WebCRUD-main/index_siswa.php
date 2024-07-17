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

    <title>Profil Mahasiswa</title>

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Gill Sans MT', cursive;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh; /* Ensures the content takes up at least 80% of the viewport height */
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        .card-header {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
        }

        .photo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .photo-container img {
            width: 150px;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .info-table {
            width: 100%;
            margin-top: 20px;
        }

        .info-table th, .info-table td {
            padding: 10px;
            text-align: left;
        }

        .footer {
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        .footer h5 {
            margin-bottom: 10px;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index_siswa.php">Sistem Informasi Data Mahasiswa</a>
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
    <div class="container content mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h3 class="fw-bold text-uppercase">Profil Mahasiswa</h3>
            </div>
            <div class="card-body">
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
                $nim = htmlspecialchars($_SESSION['nim']);
                $siswa = query("SELECT * FROM siswa WHERE nim = '$nim'")[0];

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
                <h4 class="text-center"><?= htmlspecialchars($siswa['nama']); ?></h4>
                <p class="text-center"><?= htmlspecialchars($siswa['nim']); ?></p>
                <table class="table table-striped info-table">
                    <tbody>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td><?= htmlspecialchars($siswa['tmpt_Lahir']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?= htmlspecialchars($siswa['tgl_Lahir']); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= htmlspecialchars($siswa['jekel']); ?></td>
                        </tr>
                        <tr>
                            <?php
                            $now = time();
                            $timeTahun = strtotime($siswa['tgl_Lahir']);
                            $setahun = 31536000;
                            $hitung = ($now - $timeTahun) / $setahun;
                            ?>
                            <th>Umur</th>
                            <td><?= floor($hitung); ?> Tahun</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td><?= htmlspecialchars($siswa['jurusan']); ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= htmlspecialchars($siswa['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td><?= htmlspecialchars($siswa['telpon']); ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= htmlspecialchars($siswa['alamat']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Ayah</th>
                            <td><?= htmlspecialchars($siswa['ayah']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama Ibu</th>
                            <td><?= htmlspecialchars($siswa['ibu']); ?></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td><?= htmlspecialchars($siswa['nik']); ?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?= htmlspecialchars($siswa['kelas']); ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Masuk</th>
                            <td><?= htmlspecialchars($siswa['tahun_masuk']); ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <a href="download.php" class="btn btn-primary">Download Data Mahasiswa</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Close Container -->

    <!-- Footer -->
    <div class="footer">
        <h5 class="fw-bold text-uppercase">POLITEKNIK GAJAH TUNGGAL</h5>
        <p>
            Pembuat :
            1. Sindi Ayu Lestari (2302054)
            2. Wilson Sitompul (2302056)
            3. Haiqal Abimanyu Sutono (2302028)
        </p>
    </div>
    <!-- Close Footer -->

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>
</html>
