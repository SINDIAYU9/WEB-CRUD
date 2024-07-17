<?php

require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo " <script>
            alert('User baru berhasil ditambahkan');
            window.location.href = 'login.php';
        </script> ";
    } else {
        echo mysqli_error($koneksi);
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

     <title>Form Register</title>
</head>

<body background="img/bg/bck.png">

     <div class="container">
          <div class="row my-5">
               <div class="col-md-6 text-center login bg-dark">
                    <h4 class="fw-bold" style="color: white;">Register</h4>
                    <form action="" method="post">
                         <div class="form-group my-3">
                              <label for="username" class="text-light">Username:</label>
                              <input type="text" class="form-control w-50" name="username" id="username"
                                   autocomplete="off" required>
                         </div>
                         <div class="form-group my-3">
                              <label for="password" class="text-light">Password:</label>
                              <input type="password" class="form-control w-50" name="password" id="password"
                                   autocomplete="off" required>
                         </div>
                         <div class="form-group my-3">
                              <label for="password2" class="text-light">Konfirmasi Password:</label>
                              <input type="password" class="form-control w-50" name="password2" id="password2"
                                   autocomplete="off" required>
                         </div>
                         <button class="btn btn-info btn-sm text-uppercase text-light" style="font-weight: 600;"
                              type="submit" name="register">REGISTER</button>
                         <a href="index.php" class="btn btn-secondary btn-sm text-uppercase text-light"
                              style="font-weight: 600;">CANCEL</a>
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
