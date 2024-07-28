<?php
session_start();

// Periksa sesi, jika tidak ada redirect kembali ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Sertakan file koneksi
include 'db_conn.php';

// Query untuk mengambil data penjualan dan pembelian barang
$query = "SELECT b.NamaBarang,
                 SUM(p.JumlahPenjualan) AS JumlahTerjual,
                 SUM(pb.HargaBeli) AS HargaBeli,
                 SUM(p.HargaJual) AS HargaJual,
                 SUM(p.HargaJual - pb.HargaBeli) * SUM(p.JumlahPenjualan) AS Keuntungan,
                 SUM(pb.JumlahPembelian) AS TotalPembelian,
                 SUM(p.JumlahPenjualan) AS TotalPenjualan,
                 SUM(pb.JumlahPembelian) - SUM(p.JumlahPenjualan) AS Stok
          FROM Penjualan p
          JOIN Barang b ON p.IdBarang = b.IdBarang
          JOIN Pembelian pb ON p.IdBarang = pb.IdBarang
          GROUP BY b.NamaBarang";

// Eksekusi query
$stmt = $pdo->query($query);

// Query untuk menghitung total penjualan
$queryTotalPenjualan = "SELECT SUM(JumlahPenjualan * HargaJual) AS TotalPenjualan FROM Penjualan";
$stmtTotalPenjualan = $pdo->query($queryTotalPenjualan);
$rowTotalPenjualan = $stmtTotalPenjualan->fetch(PDO::FETCH_ASSOC);
$totalPenjualan = $rowTotalPenjualan['TotalPenjualan'];

// Query untuk menghitung total pembelian
$queryTotalPembelian = "SELECT SUM(JumlahPembelian * HargaBeli) AS TotalPembelian FROM Pembelian";
$stmtTotalPembelian = $pdo->query($queryTotalPembelian);
$rowTotalPembelian = $stmtTotalPembelian->fetch(PDO::FETCH_ASSOC);
$totalPembelian = $rowTotalPembelian['TotalPembelian'];

// Hitung laba rugi
$labaRugi = $totalPembelian - $totalPenjualan;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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

    <h2>Data Penjualan dan Pembelian Barang</h2>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Jumlah Terjual</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Keuntungan</th>
            <th>Total Pembelian</th>
            <th>Total Penjualan</th>
            <th>Stok</th>
        </tr>
        <?php
        // Tampilkan data penjualan dan pembelian barang
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['NamaBarang'] . "</td>";
            echo "<td>" . $row['JumlahTerjual'] . "</td>";
            echo "<td>" . $row['HargaBeli'] . "</td>";
            echo "<td>" . $row['HargaJual'] . "</td>";
            echo "<td>" . $row['Keuntungan'] . "</td>";
            echo "<td>" . $row['TotalPembelian'] . "</td>";
            echo "<td>" . $row['TotalPenjualan'] . "</td>";
            echo "<td>" . $row['Stok'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Laporan Laba Rugi</h2>
    <div>
        <h3>Total Penjualan:</h3>
        <p><?php echo $totalPenjualan; ?></p>
    </div>
    <div>
        <h3>Total Pembelian:</h3>
        <p><?php echo $totalPembelian; ?></p>
    </div>
    <div>
        <h3>Laba Rugi:</h3>
        <p><?php echo $labaRugi; ?></p>
    </div>

    <h2>Barang yang Menguntungkan</h2>
    <table>
        <tr>
            <th>Nama Barang</th>
            <th>Total Penjualan</th>
            <th>Total Pembelian</th>
            <th>Keuntungan</th>
        </tr>
        <?php
        // Tampilkan barang yang menguntungkan
        $queryProfitableItems = "
    WITH PenjualanPembelian AS (
      SELECT p.IdBarang,
             SUM(p.JumlahPenjualan) AS TotalPenjualan,
             SUM(pb.JumlahPembelian) AS TotalPembelian
      FROM Penjualan p
      JOIN Pembelian pb ON p.IdBarang = pb.IdBarang
      GROUP BY p.IdBarang
    ),
    BarangKeuntungan AS (
      SELECT pb.IdBarang,
             SUM((p.HargaJual - pb.HargaBeli) * p.JumlahPenjualan) AS Keuntungan
      FROM Penjualan p
      JOIN Pembelian pb ON p.IdBarang = pb.IdBarang
      GROUP BY pb.IdBarang
    )
    SELECT b.NamaBarang,
           pp.TotalPenjualan,
           pp.TotalPembelian,
           bk.Keuntungan
    FROM PenjualanPembelian pp
    JOIN Barang b ON pp.IdBarang = b.IdBarang
    JOIN BarangKeuntungan bk ON pp.IdBarang = bk.IdBarang
    ORDER BY bk.Keuntungan DESC;
    ";

        $stmtProfitableItems = $pdo->query($queryProfitableItems);
        while ($row = $stmtProfitableItems->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['NamaBarang'] . "</td>";
            echo "<td>" . $row['TotalPenjualan'] . "</td>";
            echo "<td>" . $row['TotalPembelian'] . "</td>";
            echo "<td>" . $row['Keuntungan'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>