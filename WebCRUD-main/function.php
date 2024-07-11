<?php
include "koneksi.php";

// Membuat fungsi query dalam bentuk array
function query($query)
{
    global $pdo;
    try {
        $stmt = $pdo->query($query);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}

// Membuat fungsi tambah
function tambah($data)
{
    global $pdo;
    $nim = htmlspecialchars($data['nim']);
    $nama = htmlspecialchars($data['nama']);
    $tmpt_Lahir = htmlspecialchars($data['tmpt_Lahir']);
    $tgl_Lahir = $data['tgl_Lahir'];
    $jekel = $data['jekel'];
    $jurusan = $data['jurusan'];
    $email = htmlspecialchars($data['email']);
    $gambar = upload();
    $alamat = htmlspecialchars($data['alamat']);

    if (!$gambar) {
        return false;
    }

    $sql = "INSERT INTO siswa (nim, nama, tmpt_Lahir, tgl_Lahir, jekel, jurusan, email, gambar, alamat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nim, $nama, $tmpt_Lahir, $tgl_Lahir, $jekel, $jurusan, $email, $gambar, $alamat]);

    return $stmt->rowCount();
}

// Membuat fungsi hapus
function hapus($nim)
{
    global $pdo;
    $sql = "DELETE FROM siswa WHERE nim = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nim]);
    return $stmt->rowCount();
}

// Membuat fungsi ubah
function ubah($data)
{
    global $pdo;
    $nim = $data['nim'];
    $nama = htmlspecialchars($data['nama']);
    $tmpt_Lahir = htmlspecialchars($data['tmpt_Lahir']);
    $tgl_Lahir = $data['tgl_Lahir'];
    $jekel = $data['jekel'];
    $jurusan = $data['jurusan'];
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    $gambarLama = $data['gambarLama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $sql = "UPDATE siswa SET nama = ?, tmpt_Lahir = ?, tgl_Lahir = ?, jekel = ?, jurusan = ?, email = ?, gambar = ?, alamat = ? WHERE nim = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nama, $tmpt_Lahir, $tgl_Lahir, $jekel, $jurusan, $email, $gambar, $alamat, $nim]);

    return $stmt->rowCount();
}

// Membuat fungsi upload gambar
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// Membuat fungsi registrasi
function registrasi($data)
{
    global $pdo;
    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $password2 = $data["password2"];

    $stmt = $pdo->prepare("SELECT username FROM user WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        echo "<script>alert('Username sudah terdaftar');</script>";
        return false;
    }

    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password]);

    return $stmt->rowCount();
}
?>
