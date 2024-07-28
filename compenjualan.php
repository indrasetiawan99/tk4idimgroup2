<?php
session_start();

// Periksa sesi, jika tidak ada redirect kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi
include 'db_conn.php';

// Query untuk mendapatkan paket penjualan dengan keuntungan tertinggi
$queryTopPackages = "
    SELECT 
        CONCAT('Paket Penjualan ', GROUP_CONCAT(b.NamaBarang SEPARATOR ' + ')) AS PaketPenjualan,
        SUM(p.HargaJual - pb.HargaBeli) AS KeuntunganTotal
    FROM 
        Penjualan p
    JOIN 
        Barang b ON p.IdBarang = b.IdBarang
    JOIN 
        Pembelian pb ON p.IdBarang = pb.IdBarang
    GROUP BY 
        p.IdPenjualan
    ORDER BY 
        KeuntunganTotal DESC
    LIMIT 
        5; -- Ambil 5 paket penjualan dengan keuntungan tertinggi
";

// Eksekusi query paket penjualan
$stmtTopPackages = $pdo->query($queryTopPackages);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compenjualan</title>

    <!-- JQuery -->
    <script src="plugins/jquery-3.5.1/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-4.6/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="plugins/bootstrap-4.6/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <h2>Selamat datang, <?php echo $_SESSION['username']; ?></h2>

    <h2>Paket Penjualan dengan Keuntungan Tertinggi</h2>
    <table>
        <tr>
            <th>Paket Penjualan</th>
            <th>Keuntungan Total</th>
        </tr>
        <?php
        // Tampilkan paket penjualan dengan keuntungan tertinggi
        while ($row = $stmtTopPackages->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['PaketPenjualan'] . "</td>";
            echo "<td>" . $row['KeuntunganTotal'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>