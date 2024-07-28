<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>

    <!-- JQuery -->
    <script src="plugins/jquery-3.5.1/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-4.6/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="plugins/bootstrap-4.6/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h2>Daftar Barang</h2>
    <table>
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Keterangan</th>
            <th>Satuan</th>
            <th>ID Pengguna</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($daftarBarang as $barang) : ?>
            <tr>
                <td><?= $barang['IdBarang'] ?></td>
                <td><?= $barang['NamaBarang'] ?></td>
                <td><?= $barang['Keterangan'] ?></td>
                <td><?= $barang['Satuan'] ?></td>
                <td><?= $barang['IdPengguna'] ?></td>
                <td class="action-buttons">
                    <a href="BarangEdit.php?id=<?= $barang['IdBarang'] ?>">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <form action="BarangController.php" method="post">
                        <input type="hidden" name="hapus_id" value="<?= $barang['IdBarang'] ?>">
                        <button type="submit" class="btn btn-danger" name="hapus_barang" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">Hapus</button>
                        <input type="hidden" name="konfirmasi_hapus" value="yes">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Tambahkan Barang</h2>
    <form action="BarangController.php" method="post">
        <label for="nama">Nama Barang:</label>
        <input type="text" id="nama" name="nama" required><br>
        <label for="keterangan">Keterangan:</label>
        <textarea id="keterangan" name="keterangan" required></textarea><br>
        <label for="satuan">Satuan:</label>
        <input type="text" id="satuan" name="satuan" required><br>
        <input type="submit" name="tambah_barang" value="Tambahkan Barang">
    </form>

    <script>
        // Ambil nilai parameter alert dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const alertType = urlParams.get('alert');
        const barangId = urlParams.get('id');

        // Cek apakah terdapat parameter alert=updated di URL
        if (alertType === 'updated' && barangId) {
            // Tampilkan alert bahwa barang telah diupdate
            alert(`Barang dengan ID ${barangId} telah diperbarui.`);
            window.history.replaceState({}, document.title, "BarangController.php");
        }

        if (alertType === 'added') {
            // Tampilkan alert bahwa barang telah diupdate
            alert(`Barang ditambahkan`);
            window.history.replaceState({}, document.title, "BarangController.php");
        }

        if (alertType === 'deleted') {
            // Tampilkan alert bahwa barang telah diupdate
            alert(`Barang dihapus`);
            window.history.replaceState({}, document.title, "BarangController.php");
        }
    </script>
</body>

</html>