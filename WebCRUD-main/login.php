<?php
session_start();

// Jika sudah login, redirect ke index.php
if (isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

require 'function.php';
require 'koneksi.php'; // Menyertakan koneksi ke database

// Jika tombol login diklik
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Ambil data user dari database berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $row = $stmt->fetch();

    // Jika user ditemukan
    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['login'] = true;

        // Cek remember me
        if (isset($_POST['remember'])) {
            // Buat cookie dan acak cookie
            setcookie('id', $row['id'], time() + 86400, "/"); // Cookie expires in 1 day
            // Mengacak username dengan algoritma 'sha256'
            setcookie('key', hash('sha256', $row['username']), time() + 86400, "/"); // Cookie expires in 1 day
        }

        header('location:index.php');
        exit;
    } else {
        // Jika login gagal
        $error = 'Username atau Password Salah!';
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
    <title>Form Login</title>
    <script>
        <?php if (isset($error)) : ?>
        alert('<?php echo htmlspecialchars($error); ?>');
        <?php endif; ?>
    </script>
</head>

<body background="img/bg/bck.png">

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 text-center login bg-dark">
                <h4 class="fw-bold" style="color: white;">Login Admin</h4>
                <form action="" method="post">
                    <div class="form-group user">
                        <input type="text" class="form-control w-50 mx-auto" placeholder="Masukkan Username"
                               name="username" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="password" class="form-control w-50 mx-auto" placeholder="Masukkan Password"
                               name="password" autocomplete="off" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" name="remember" id="remember" autocomplete="off">
                        <label class="btn btn-outline-primary" for="remember">Remember Me</label>
                    </div>
                    <button class="btn btn-primary text-uppercase" type="submit" name="login">Login</button>
                    <a href="login_siswa.php" class="btn btn-warning text-uppercase">Login Siswa</a>
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
