<?php
session_start();

// Periksa sesi, jika tidak ada redirect kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include file yang berisi koneksi ke database dan definisi kelas Pengguna
include 'db_conn.php';
include 'Pengguna.php';

// Buat objek Pengguna
$pengguna = new Pengguna($pdo);

// Tangani permintaan penghapusan pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_pengguna'])) {
    // Periksa apakah pengguna mengonfirmasi penghapusan
    if (isset($_POST['hapus_id']) && isset($_POST['konfirmasi_hapus']) && $_POST['konfirmasi_hapus'] === 'yes') {
        $idPengguna = $_POST['hapus_id'];
        $pengguna->hapusPengguna($idPengguna);
        // Redirect kembali ke halaman utama atau halaman yang sesuai
        header("Location: PenggunaController.php?alert=deleted");
        exit(); // Pastikan untuk keluar setelah melakukan redirect
    } else {
        // Jika pengguna tidak mengonfirmasi penghapusan, arahkan kembali ke halaman utama
        header("Location: PenggunaController.php");
        exit();
    }
}

// Tangani pembaruan data pengguna jika permintaan POST diterima
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_pengguna'])) {
    // Ambil data dari form
    $idPengguna = $_POST['edit_id']; // ID Pengguna
    $namaPengguna = $_POST['edit_nama_pengguna'];
    $password = $_POST['edit_password'];
    $namaDepan = $_POST['edit_nama_depan'];
    $namaBelakang = $_POST['edit_nama_belakang'];
    $noHP = $_POST['edit_no_hp'];
    $alamat = $_POST['edit_alamat'];
    $idAkses = $_POST['edit_id_akses'];

    // Perbarui data pengguna di database
    $rowCount = $pengguna->updatePengguna($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHP, $alamat, $idAkses);

    // Periksa apakah perubahan berhasil disimpan
    if (isset($rowCount)) {
        // Jika berhasil, redirect ke halaman utama dan tampilkan alert
        header("Location: PenggunaController.php?alert=updated&id=$idPengguna");
        exit();
    } else {
        // Jika terjadi kesalahan atau tidak ada perubahan, tampilkan pesan kesalahan
        echo "Gagal menyimpan perubahan. Silakan coba lagi.";
    }
}

// Tangani permintaan penambahan pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_pengguna'])) {
    // Ambil data dari form
    $namaPengguna = $_POST['nama_pengguna'];
    $password = $_POST['password'];
    $namaDepan = $_POST['nama_depan'];
    $namaBelakang = $_POST['nama_belakang'];
    $noHP = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $idAkses = $_POST['id_akses'];

    if (empty($namaPengguna) || empty($password) || empty($namaDepan) || empty($namaBelakang) || empty($noHP) || empty($alamat) || empty($idAkses)) {
        echo "<script>alert('Kolom tidak boleh kosong!'); window.location='PenggunaController.php';</script>";
        exit();
    }
    // Tambahkan pengguna ke database
    $pengguna->tambahPengguna($namaPengguna, $password, $namaDepan, $namaBelakang, $noHP, $alamat, $idAkses);
    header("Location: PenggunaController.php?alert=added");
    exit(); // Pastikan untuk keluar setelah melakukan redirect
}

// Ambil daftar pengguna dari database
$daftarPengguna = $pengguna->semuaPengguna();

// Tampilkan view
include 'PenggunaView.php';
?>
