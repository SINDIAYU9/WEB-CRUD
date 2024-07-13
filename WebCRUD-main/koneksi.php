<?php
$host = 'localhost';
$db   = 'data_siswa';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Menggunakan MySQLi
$koneksi = new mysqli($host, $user, $pass, $db);

// Periksa koneksi MySQLi
if ($koneksi->connect_error) {
    die("Koneksi MySQLi gagal: " . $koneksi->connect_error);
}

// Menggunakan PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>
