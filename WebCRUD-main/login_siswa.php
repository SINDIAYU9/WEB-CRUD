<?php
session_start();
// Jika sudah login maka redirect ke index_siswa.php
if (isset($_SESSION['siswa_login'])) {
    header('location:index_siswa.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';
include "koneksi.php";

// Jika tombol login diklik
if (isset($_POST['login'])) {
    $nim = $_POST['nim'];
    $password = md5($_POST['password']); // Gunakan md5 untuk password

    // Mengambil data siswa berdasarkan nim
    $result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nim = '$nim'");
    $row = mysqli_fetch_assoc($result);
    $cek = mysqli_num_rows($result);

    // Jika nim ditemukan dan password sesuai
    if ($cek > 0 && $row['password'] == $password) {
        $_SESSION['siswa_login'] = true;
        $_SESSION['nim'] = $nim; // Simpan nim dalam session

        header('location:index_siswa.php');
        exit;
    } else {
        // Jika nim atau password salah
        $error = true;
    }
}

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
    <link rel="stylesheet" href="css/login.css">

    <title>Form Login Siswa</title>
</head>

<body background="img/bg/bck.png">

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 text-center login bg-dark">
                <h4 class="fw-bold" style="color: white;">Login Siswa</h4>
                <!-- Pesan error jika login gagal -->
                <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert">
                    NIM atau Password salah!
                </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="form-group user">
                        <input type="text" class="form-control w-75 mx-auto" placeholder="Masukkan NIM"
                            name="nim" autocomplete="off" required>
                    </div>
                    <div class="form-group my-4">
                        <input type="password" class="form-control w-75 mx-auto" placeholder="Masukkan Password"
                            name="password" autocomplete="off" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg text-uppercase" type="submit" name="login">Login</button>
                    </div>
                    <div class="text-center mt-3">
                        <a href="registrasi_siswa.php" class="btn btn-danger text-uppercase"><i
                                class="bi bi-pencil-square"></i> Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>
