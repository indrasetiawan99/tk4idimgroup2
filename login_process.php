<?php
session_start();

include 'db_conn.php'; // Koneksi ke database

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk memeriksa username di database
$stmt = $pdo->prepare("SELECT * FROM pengguna WHERE NamaPengguna = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

// Periksa apakah pengguna ditemukan
if ($user) {
    // Verifikasi kata sandi
    if ($password === $user['Password']) {
        // Kata sandi sesuai, buat sesi dan arahkan pengguna ke halaman dashboard
        $_SESSION['username'] = $username;
        $_SESSION['id_pengguna'] = $user['IdPengguna'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Password tidak cocok
        header("Location: login.php?error=2");
        exit();
    }
} else {
    // Pengguna tidak ditemukan
    header("Location: login.php?error=1");
    exit();
}

?>
