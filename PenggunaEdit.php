<?php
session_start();

// Periksa sesi, jika tidak ada redirect kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Pastikan Anda telah menyertakan file db_conn.php dan kelas Pengguna di sini
include 'db_conn.php';
include 'Pengguna.php';

$pengguna = new Pengguna($pdo);

// Check if the ID of the Pengguna is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect back to the main page if the Pengguna ID is not provided
    header("Location: UserController.php");
    exit();
}

// Get the Pengguna ID from the URL
$idPengguna = $_GET['id'];

// Get the Pengguna data from the database using the ID
$penggunaData = $pengguna->getPenggunaById($idPengguna);

// Check if the Pengguna data is found
if (!$penggunaData) {
    // Redirect back to the main page if the Pengguna data is not found
    header("Location: UserController.php");
    exit();
}

// Assign the Pengguna data to the $pengguna variable
$pengguna = $penggunaData;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="styles.css"> <!-- Hubungkan ke file CSS -->
</head>
<body>
<?php include 'navbar.php'; ?>
    <h2>Edit Pengguna</h2>
    <form action="PenggunaController.php" method="post">
    <input type="hidden" name="edit_id" value="<?= $pengguna['IdPengguna'] ?>">
    <label for="edit_nama_pengguna">Nama Pengguna:</label><br>
    <input type="text" id="edit_nama_pengguna" name="edit_nama_pengguna" value="<?= $pengguna['NamaPengguna'] ?>"><br>
    <label for="edit_password">Password:</label><br>
    <input type="password" id="edit_password" name="edit_password" value="<?= $pengguna['Password'] ?>"><br>
    <label for="edit_nama_depan">Nama Depan:</label><br>
    <input type="text" id="edit_nama_depan" name="edit_nama_depan" value="<?= $pengguna['NamaDepan'] ?>"><br>
    <label for="edit_nama_belakang">Nama Belakang:</label><br>
    <input type="text" id="edit_nama_belakang" name="edit_nama_belakang" value="<?= $pengguna['NamaBelakang'] ?>"><br>
    <label for="edit_no_hp">Nomor HP:</label><br>
    <input type="text" id="edit_no_hp" name="edit_no_hp" value="<?= $pengguna['NoHP'] ?>"><br>
    <label for="edit_alamat">Alamat:</label><br>
    <textarea id="edit_alamat" name="edit_alamat"><?= $pengguna['Alamat'] ?></textarea><br>
    <!-- Jika menggunakan select untuk memilih IdAkses, tambahkan opsi sesuai dengan data di tabel HakAkses -->
   <label for="edit_id_akses">Hak Akses:</label><br>
    <select id="edit_id_akses" name="edit_id_akses">
    <option value="1" <?= ($pengguna['IdAkses'] == 1) ? 'selected' : '' ?>>Admin</option> 
    <option value="2" <?= ($pengguna['IdAkses'] == 2) ? 'selected' : '' ?>>User</option>
    <option value="3" <?= ($pengguna['IdAkses'] == 3) ? 'selected' : '' ?>>Guest</option>  
  </select><br>
    <input type="submit" name="update_pengguna" value="Simpan Perubahan">
</form>

    <a href="PenggunaController.php" class="back-button">Kembali ke Daftar Pengguna</a>
</body>
</html>
