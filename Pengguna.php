<?php

class Pengguna {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fungsi untuk menambah pengguna baru
    public function tambahPengguna($namaPengguna, $password, $namaDepan, $namaBelakang, $noHP, $alamat, $idAkses) {
        $stmt = $this->pdo->prepare("INSERT INTO Pengguna (NamaPengguna, Password, NamaDepan, NamaBelakang, NoHP, Alamat, IdAkses) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$namaPengguna, $password, $namaDepan, $namaBelakang, $noHP, $alamat, $idAkses]);
        return $stmt->rowCount();
    }

    // Fungsi untuk mengambil semua pengguna
    public function semuaPengguna() {
        $stmt = $this->pdo->query("SELECT * FROM Pengguna");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengambil detail pengguna berdasarkan ID
    public function detailPengguna($idPengguna) {
        $stmt = $this->pdo->prepare("SELECT * FROM Pengguna WHERE IdPengguna = ?");
        $stmt->execute([$idPengguna]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fungsi untuk mengupdate data pengguna
    public function updatePengguna($idPengguna, $namaPengguna, $password, $namaDepan, $namaBelakang, $noHP, $alamat, $idAkses) {
        $stmt = $this->pdo->prepare("UPDATE Pengguna SET NamaPengguna = ?, Password = ?, NamaDepan = ?, NamaBelakang = ?, NoHP = ?, Alamat = ?, IdAkses = ? WHERE IdPengguna = ?");
        $stmt->execute([$namaPengguna, $password, $namaDepan, $namaBelakang, $noHP, $alamat, $idAkses, $idPengguna]);
        return $stmt->rowCount();
    }
    

    // Fungsi untuk menghapus pengguna
    public function hapusPengguna($idPengguna) {
        $stmt = $this->pdo->prepare("DELETE FROM Pengguna WHERE IdPengguna = ?");
        $stmt->execute([$idPengguna]);
        return $stmt->rowCount();
    }

    // Fungsi untuk mengambil pengguna berdasarkan nama pengguna
    public function getPenggunaByNama($namaPengguna) {
        $stmt = $this->pdo->prepare("SELECT * FROM Pengguna WHERE NamaPengguna = :namaPengguna");
        $stmt->execute([':namaPengguna' => $namaPengguna]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Fungsi untuk mengambil pengguna berdasarkan ID akses
    public function getPenggunaByIdAkses($idAkses) {
        $stmt = $this->pdo->prepare("SELECT * FROM Pengguna WHERE IdAkses = :idAkses");
        $stmt->execute([':idAkses' => $idAkses]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPenggunaById($idPengguna) {
        $stmt = $this->pdo->prepare("SELECT * FROM Pengguna WHERE IdPengguna = ?");
        $stmt->execute([$idPengguna]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
