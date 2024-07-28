<?php

session_start();

// Periksa sesi, jika tidak ada redirect kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Pastikan Anda telah menyertakan file db_conn.php dan kelas Barang di sini
include 'db_conn.php';
include 'Barang.php';


$barang = new Barang($pdo);

// Check if the ID of the Barang is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect back to the main page if the Barang ID is not provided
    header("Location: BarangController.php");
    exit();
}

// Get the Barang ID from the URL
$idBarang = $_GET['id'];

// Get the Barang data from the database using the ID
$barangData = $barang->getBarangById($idBarang);

// Check if the Barang data is found
if (!$barangData) {
    // Redirect back to the main page if the Barang data is not found
    header("Location: BarangController.php");
    exit();
}

// Assign the Barang data to the $barang variable
$barang = $barangData;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a.back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a.back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>
    <h2>Edit Barang</h2>
    <form action="BarangController.php" method="post">
        <input type="hidden" name="edit_id" value="<?= $barang['IdBarang'] ?>">
        <label for="edit_nama">Nama Barang:</label><br>
        <input type="text" id="edit_nama" name="edit_nama" value="<?= $barang['NamaBarang'] ?>"><br>
        <label for="edit_keterangan">Keterangan:</label><br>
        <textarea id="edit_keterangan" name="edit_keterangan"><?= $barang['Keterangan'] ?></textarea><br>
        <label for="edit_satuan">Satuan:</label><br>
        <input type="text" id="edit_satuan" name="edit_satuan" value="<?= $barang['Satuan'] ?>"><br>
        <input type="submit" name="update_barang" value="Simpan Perubahan">
    </form>
    <a href="BarangController.php" class="back-button">Kembali ke Daftar Barang</a>
</body>
</html>