<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari nim dengan fungsi get
$nim = $_GET['nim'];

// Mengambil data dari table siswa dari nim yang tidak sama dengan 0
$siswa = query("SELECT * FROM siswa WHERE nim = $nim")[0];

// Jika fungsi ubah lebih dari 0/data terubah, maka munculkan alert dibawah
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data siswa berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        // Jika fungsi ubah dibawah dari 0/data tidak terubah, maka munculkan alert dibawah
        echo "<script>
                alert('Data siswa gagal diubah!');
            </script>";
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
     <!-- Bootstrap Icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
     <!-- Font Google -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
     <!-- animasi CSS Aos -->
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
     <!-- My CSS -->
     <link rel="stylesheet" href="css/style.css">

     <title>Update Data</title>
</head>

<body background="img/bg/bck.png">
     <!-- Navbar -->
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
          <div class="container">
               <a class="navbar-brand" href="index.php">Sistem Admin Data Mahasiswa</a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="index.php">Home</a>
                         </li>
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
          <div class="row my-2 text-light">
               <div class="col-md">
                    <h3 class="fw-bold text-uppercase ubah_data"></h3>
               </div>
               <hr>
          </div>
          <div class="row my-2 text-light">
               <div class="col-md">
                    <form action="" method="post" enctype="multipart/form-data">
                         <input type="hidden" name="gambarLama" value="<?= $siswa['gambar']; ?>">
                         <div class="mb-3">
                              <label for="nim" class="form-label">NIM</label>
                              <input type="number" class="form-control w-50" id="nim" value="<?= $siswa['nim']; ?>"
                                   name="nim" readonly>
                         </div>
                         <div class="mb-3">
                              <label for="nama" class="form-label">Nama</label>
                              <input type="text" class="form-control w-50" id="nama" value="<?= $siswa['nama']; ?>"
                                   name="nama" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tmpt_Lahir" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control w-50" id="tmpt_Lahir"
                                   value="<?= $siswa['tmpt_Lahir']; ?>" name="tmpt_Lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tgl_Lahir" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control w-50" id="tgl_Lahir"
                                   value="<?= $siswa['tgl_Lahir']; ?>" name="tgl_Lahir" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label>Jenis Kelamin</label>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Laki - Laki"
                                        value="Laki - Laki" <?php if ($siswa['jekel'] == 'Laki - Laki') { ?> checked=''
                                        <?php } ?>>
                                   <label class="form-check-label" for="Laki - Laki">Laki - Laki</label>
                              </div>
                              <div class="form-check">
                                   <input class="form-check-input" type="radio" name="jekel" id="Perempuan"
                                        value="Perempuan" <?php if ($siswa['jekel'] == 'Perempuan') { ?> checked=''
                                        <?php } ?>>
                                   <label class="form-check-label" for="Perempuan">Perempuan</label>
                              </div>
                         </div>
                         <div class="mb-3">
                              <label for="jurusan" class="form-label">Jurusan</label>
                              <select class="form-select w-50" id="jurusan" name="jurusan">
                                   <option disabled selected value>--------------------------------------------Pilih
                                        Jurusan--------------------------------------------</option>
                                   <option value="Teknik Mesin" <?php if ($siswa['jurusan'] == 'Teknik Mesin') { ?>
                                        selected='' <?php } ?>>Teknik Mesin</option>
                                   <option value="Teknik Elektronika" <?php if ($siswa['jurusan'] == 'Teknik Elektronika') { ?>
                                        selected='' <?php } ?>>Teknink Elektronika</option>
                                   <option value="Teknik Industri" <?php if ($siswa['jurusan'] == 'Teknologi Industri') { ?> selected=''
                                        <?php } ?>>Teknologi Industri</option>
                              </select>
                         </div>
                         <div class="mb-3">
                              <label for="email" class="form-label">E-Mail</label>
                              <input type="email" class="form-control w-50" id="email" value="<?= $siswa['email']; ?>"
                                   name="email" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="telpon" class="form-label">Nomor Telepon</label>
                              <input type="tel" class="form-control w-50" id="telpon"
                                   value="<?= $siswa['telpon']; ?>" name="telpon" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="ayah" class="form-label">Nama Ayah</label>
                              <input type="text" class="form-control w-50" id="ayah"
                                   value="<?= $siswa['ayah']; ?>" name="ayah" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="ibu" class="form-label">Nama Ibu</label>
                              <input type="text" class="form-control w-50" id="ibu"
                                   value="<?= $siswa['ibu']; ?>" name="ibu" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="nik" class="form-label">NIK</label>
                              <input type="number" class="form-control w-50" id="nik"
                                   value="<?= $siswa['nik']; ?>" name="nik" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="kelas" class="form-label">Kelas</label>
                              <input type="text" class="form-control w-50" id="kelas"
                                   value="<?= $siswa['kelas']; ?>" name="kelas" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="tahun_masuk" class="form-label">Angkatan</label>
                              <input type="number" class="form-control w-50" id="tahun_masuk"
                                   value="<?= $siswa['tahun_masuk']; ?>" name="tahun_masuk" autocomplete="off" required>
                         </div>
                         <div class="mb-3">
                              <label for="alamat" class="form-label">Alamat</label>
                              <textarea class="form-control w-50" id="alamat" name="alamat" rows="5"
                                   autocomplete="off" required><?= $siswa['alamat']; ?></textarea>
                         </div>
                         <div class="mb-3">
                              <label for="gambar" class="form-label">Gambar</label>
                              <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                         </div>
                         <div class="col-md">
                              <button class="btn btn-primary" type="submit" name="ubah">Update</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <!-- Close Container -->

     <!-- Bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
          integrity="sha384-KsvD5xa6lql6n/6uHEbPHEbKkz0FEIsvFwD9OOEepADe7Jy7iEXp4COmfLFlG4b5"
          crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
          integrity="sha384-pzjw8f+ua7Kw1TIqK4a6B95e5g2QFI5g1R4D6dVo0nFD4LZ3N5VPlkKsF++lyqa" crossorigin="anonymous">
     </script>
     <!-- animasi Aos -->
     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
     <script>
          AOS.init();
     </script>
</body>

</html>
