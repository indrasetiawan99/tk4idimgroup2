<?php
session_start();


// Periksa sesi, jika tidak ada redirect kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Include file yang berisi koneksi ke database dan definisi kelas Barang
include 'db_conn.php';
include 'Barang.php';

// Buat objek Barang
$barang = new Barang($pdo);


// Tangani permintaan penghapusan barang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_barang'])) {
    // Periksa apakah pengguna mengonfirmasi penghapusan
    if (isset($_POST['hapus_id']) && isset($_POST['konfirmasi_hapus']) && $_POST['konfirmasi_hapus'] === 'yes') {
        $idBarang = $_POST['hapus_id'];
        $barang->hapusBarang($idBarang);
        // Redirect kembali ke halaman utama atau halaman yang sesuai
        header("Location: BarangController.php?alert=deleted");
        exit(); // Pastikan untuk keluar setelah melakukan redirect
    } else {
        // Jika pengguna tidak mengonfirmasi penghapusan, arahkan kembali ke halaman utama
        header("Location: BarangController.php");
        exit();
    }
}

// BarangController.php

// Tangani pembaruan data barang jika permintaan POST diterima
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_barang'])) {
    // Ambil data dari form
    $idBarang = $_POST['edit_id']; // ID Barang
    $namaBarang = $_POST['edit_nama'];
    $keterangan = $_POST['edit_keterangan'];
    $satuan = $_POST['edit_satuan'];
    $idPengguna = $_SESSION['id_pengguna']; 
    // Perbarui data barang di database
    $rowCount = $barang->updateBarang($idBarang, $namaBarang, $keterangan, $satuan,$idPengguna);

    // Periksa apakah perubahan berhasil disimpan
    if (isset($rowCount)) {
        // Jika berhasil, redirect ke halaman utama dan tampilkan alert
        header("Location: BarangController.php?alert=updated&id=$idBarang");
        exit();
    } else {
        // Jika terjadi kesalahan atau tidak ada perubahan, tampilkan pesan kesalahan
        echo "Gagal menyimpan perubahan. Silakan coba lagi.";
    }
}


// Tangani permintaan penambahan barang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_barang'])) {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $satuan = $_POST['satuan'];
    // Misalnya, Anda bisa mengambil ID Pengguna dari sesi atau variabel lainnya
    $idPengguna = $_SESSION['id_pengguna'];

    if (empty($nama) || empty($keterangan) || empty($satuan)) {
        echo "<script>alert('Kolom tidak boleh kosong!'); window.location='BarangController.php';</script>";
    exit();
        //die();
        //header("Location: BarangController.php");
    }
    // Tambahkan barang ke database
    $barang->tambahBarang($nama, $keterangan, $satuan, $idPengguna);
    header("Location: BarangController.php?alert=added");
    exit(); // Pastikan untuk keluar setelah melakukan redirect
}

// Ambil daftar barang dari database
$daftarBarang = $barang->semuaBarang();

// Tampilkan view
include 'BarangView.php';
?>
