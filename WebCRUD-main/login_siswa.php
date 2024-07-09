<?php
session_start();
// Jika sudah login maka ke index_siswa.php
if (isset($_SESSION['siswa_login'])) {
    header('location:index_siswa.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// jika tombol yang bernama login diklik
if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];

    // mengambil data dari siswa dimana nama dan nim yang diambil
    $result = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nama = '$nama' AND nim = '$nim'");

    $cek = mysqli_num_rows($result);

    // jika $cek lebih dari 0, maka berhasil login dan masuk ke index_siswa.php
    if ($cek > 0) {
        $_SESSION['siswa_login'] = true;

        header('location:index_siswa.php');
        exit;
    }
    // jika $cek adalah 0 maka tampilkan error
    $error = true;  
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

     <title>Login Siswa</title>
</head>

<body background="img/bg/bck.png">

     <div class="container">
          <div class="row my-5">
               <div class="col-md-6 text-center login bg-dark">
                    <h4 class="fw-bold" style="color: white;">Login Siswa</h4>
                    <!-- Ini Error jika tidak bisa login -->
                    <?php if (isset($error)) : ?>
                    <?php echo '<script>alert("Nama atau NIM Salah!");</script>'; ?>
                    <?php endif; ?>
                    <form action="" method="post">
                         <div class="form-group user">
                              <input type="text" class="form-control w-50" placeholder="Masukkan Nama" name="nama" autocomplete="off" required>
                         </div>
                         <div class="form-group my-5">
                              <input type="text" class="form-control w-50" placeholder="Masukkan NIM" name="nim" autocomplete="off" required>
                         </div>
                         <button class="btn btn-primary text-uppercase" type="submit" name="login">Login</button>
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
