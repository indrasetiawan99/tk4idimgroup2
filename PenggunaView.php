<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>

    <!-- JQuery -->
    <script src="plugins/jquery-3.5.1/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="plugins/bootstrap-4.6/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="plugins/bootstrap-4.6/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h2>Daftar Pengguna</h2>

    <table>
        <tr>
            <th>ID Pengguna</th>
            <th>Nama Pengguna</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>ID Akses</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($daftarPengguna as $pengguna) : ?>
            <tr>
                <td><?= $pengguna['IdPengguna'] ?></td>
                <td><?= $pengguna['NamaPengguna'] ?></td>
                <td><?= $pengguna['NamaDepan'] ?></td>
                <td><?= $pengguna['NamaBelakang'] ?></td>
                <td><?= $pengguna['NoHp'] ?></td>
                <td><?= $pengguna['Alamat'] ?></td>
                <td><?= $pengguna['IdAkses'] ?></td>
                <td class="action-buttons">
                    <a href="PenggunaEdit.php?id=<?= $pengguna['IdPengguna'] ?>">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <form action="PenggunaController.php" method="post">
                        <input type="hidden" name="hapus_id" value="<?= $pengguna['IdPengguna'] ?>">
                        <button type="submit" class="btn btn-danger" name="hapus_pengguna" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                        <input type="hidden" name="konfirmasi_hapus" value="yes">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Tambahkan Pengguna</h2>

    <form action="PenggunaController.php" method="post">
        <label for="nama_pengguna">Nama Pengguna:</label>
        <input type="text" id="nama_pengguna" name="nama_pengguna" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="nama_depan">Nama Depan:</label>
        <input type="text" id="nama_depan" name="nama_depan" required><br>
        <label for="nama_belakang">Nama Belakang:</label>
        <input type="text" id="nama_belakang" name="nama_belakang" required><br>
        <label for="no_hp">No. HP:</label>
        <input type="text" id="no_hp" name="no_hp" required><br>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea><br>
        <label for="id_akses">Hak Akses:</label><br>
        <select id="id_akses" name="id_akses">
            <option value="1" <?= ($pengguna['IdAkses'] == 1) ? 'selected' : '' ?>>Admin</option>
            <option value="2" <?= ($pengguna['IdAkses'] == 2) ? 'selected' : '' ?>>User</option>
            <option value="3" <?= ($pengguna['IdAkses'] == 3) ? 'selected' : '' ?>>Guest</option>
        </select><br>
        <input type="submit" name="tambah_pengguna" value="Tambahkan Pengguna">
    </form>

    <script>
        // Ambil nilai parameter alert dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const alertType = urlParams.get('alert');
        const penggunaId = urlParams.get('id');

        // Cek apakah terdapat parameter alert=updated di URL
        if (alertType === 'updated' && penggunaId) {
            // Tampilkan alert bahwa pengguna telah diupdate
            alert(`Pengguna dengan ID ${penggunaId} telah diperbarui.`);
            window.history.replaceState({}, document.title, "PenggunaController.php");
        }

        if (alertType === 'added') {
            // Tampilkan alert bahwa pengguna telah ditambahkan
            alert(`Pengguna ditambahkan`);
            window.history.replaceState({}, document.title, "PenggunaController.php");
        }

        if (alertType === 'deleted') {
            // Tampilkan alert bahwa pengguna telah dihapus
            alert(`Pengguna dihapus`);
            window.history.replaceState({}, document.title, "PenggunaController.php");
        }
    </script>
</body>

</html>