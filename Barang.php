<?php

class Barang {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah barang baru
    public function tambahBarang($namaBarang, $keterangan, $satuan, $idPengguna) {
        $stmt = $this->pdo->prepare("INSERT INTO Barang (NamaBarang, Keterangan, Satuan, IdPengguna) VALUES (?, ?, ?, ?)");
        $stmt->execute([$namaBarang, $keterangan, $satuan, $idPengguna]);
        return $stmt->rowCount();
    }

    // Fungsi untuk mengambil semua barang
    public function semuaBarang() {
        $stmt = $this->pdo->query("SELECT * FROM Barang");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengambil detail barang berdasarkan ID
    public function detailBarang($idBarang) {
        $stmt = $this->pdo->prepare("SELECT * FROM Barang WHERE IdBarang = ?");
        $stmt->execute([$idBarang]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengupdate data barang
    public function updateBarang($idBarang, $namaBarang, $keterangan, $satuan, $idPengguna) {
        $stmt = $this->pdo->prepare("UPDATE Barang SET NamaBarang = ?, Keterangan = ?, Satuan = ?, IdPengguna = ? WHERE IdBarang = ?");
        $stmt->execute([$namaBarang, $keterangan, $satuan, $idPengguna, $idBarang]);
        return $stmt->rowCount();
    }

    public function editBarang($idBarang, $namaBarang, $keterangan, $satuan) {
        $stmt = $this->pdo->prepare("UPDATE Barang SET NamaBarang = ?, Keterangan = ?, Satuan = ? WHERE IdBarang = ?");
        $stmt->execute([$namaBarang, $keterangan, $satuan, $idBarang]);
        // return jumlah baris yang terpengaruh, atau sesuaikan jika diperlukan
        return $stmt->rowCount();
    }
    

    // Fungsi untuk menghapus barang
    public function hapusBarang($idBarang) {
        $stmt = $this->pdo->prepare("DELETE FROM Barang WHERE IdBarang = ?");
        $stmt->execute([$idBarang]);
        return $stmt->rowCount();

        
    }
    public function getBarangById($idBarang) {
        $stmt = $this->pdo->prepare("SELECT * FROM Barang WHERE IdBarang = :idBarang");
        $stmt->execute([':idBarang' => $idBarang]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
