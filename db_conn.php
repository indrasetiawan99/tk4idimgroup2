<?php
// Koneksi ke database
$host = 'localhost'; // Ganti dengan host Anda
$dbname = 'db_penjualan'; // Nama database
$username = 'root'; // Ganti dengan username Anda
$password = ''; // Ganti dengan password Anda

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Include file yang berisi definisi kelas Pengguna
//include 'Pengguna_A.php'; // Ubah sesuai dengan path yang benar

// Kemudian, Anda dapat membuat objek Pengguna dan menggunakannya di sini
//$pengguna = new \Aplikasi\Pengguna($pdo);
?>
