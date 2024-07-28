-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 05:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `IdBarang` int(11) NOT NULL,
  `NamaBarang` varchar(100) NOT NULL,
  `Keterangan` text DEFAULT NULL,
  `Satuan` varchar(20) DEFAULT NULL,
  `IdPengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`IdBarang`, `NamaBarang`, `Keterangan`, `Satuan`, `IdPengguna`) VALUES
(1, 'Samsung Galaxy S23 Ultra', 'Smartphone', 'unit', 1),
(2, 'Apple MacBook Pro M2', 'Laptop	', 'unit', 1),
(3, 'Apple iPad Pro 11-inch', 'Tablet', 'unit', 2),
(4, 'Logitech B100', 'Business Mouse', 'unit', 2),
(5, '	Garmin Fenix 7', 'Smartwatch	', 'unit', 2),
(6, '	Sony WF-1000XM4', 'Wireless Earbuds	', 'pcs', 2),
(7, '	JBL Charge 5', 'Bluetooth Speaker	', 'unit', 2),
(8, 'Kindle Paperwhite', 'E-Reader	', 'unit', 1),
(9, 'GoPro HERO11 Black', 'Action Camera	', 'unit', 1),
(10, '	Canon EOS R6', 'Digital Camera	', 'unit', 2),
(11, '	Samsung T7', 'Portable SSD	', 'unit', 1),
(14, 'Printer Epson', 'Dot Matrix', 'unit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hakakses`
--

CREATE TABLE `hakakses` (
  `IdAkses` int(11) NOT NULL,
  `NamaAkses` varchar(50) NOT NULL,
  `Keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hakakses`
--

INSERT INTO `hakakses` (`IdAkses`, `NamaAkses`, `Keterangan`) VALUES
(1, 'Admin', 'Full Access'),
(2, 'User', 'Write and Read Access'),
(3, 'Visitor', 'Read-Only Access');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `IdPembelian` int(11) NOT NULL,
  `JumlahPembelian` int(11) DEFAULT NULL,
  `HargaBeli` decimal(10,2) DEFAULT NULL,
  `IdPengguna` int(11) DEFAULT NULL,
  `IdBarang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`IdPembelian`, `JumlahPembelian`, `HargaBeli`, `IdPengguna`, `IdBarang`) VALUES
(1, 10, '35000.00', 2, 1),
(2, 13, '1000.00', 2, 2),
(3, 4, '550.00', 2, 3),
(4, 5, '25.00', 2, 4),
(5, 4, '550.00', 2, 5),
(6, 12, '5000.00', 2, 6),
(7, 10, '8.00', 2, 7),
(8, 6, '500.00', 2, 8),
(9, 5, '90.00', 2, 9),
(10, 10, '500.00', 2, 10),
(11, 10, '60005.00', 2, 11),
(12, 6, '5000.00', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `IdPengguna` int(11) NOT NULL,
  `NamaPengguna` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `NamaDepan` varchar(50) NOT NULL,
  `NamaBelakang` varchar(50) NOT NULL,
  `NoHp` varchar(20) DEFAULT NULL,
  `Alamat` varchar(255) DEFAULT NULL,
  `IdAkses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`IdPengguna`, `NamaPengguna`, `Password`, `NamaDepan`, `NamaBelakang`, `NoHp`, `Alamat`, `IdAkses`) VALUES
(1, 'messi07', 'P@ssw0rd07', 'Lionel', 'Messi', '082233445566', 'Jl. Melinjo No 01', 1),
(2, 'ronaldo10', 'P@ssw0rd10', 'Cristiano', 'Ronaldo', '082233445577', 'Jl. Ketupat No 04', 2),
(3, 'rashy08', 'P@ssw0rd08', 'Marcus', 'Rashford', '082233445511', 'Jl. Opor No 23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `IdPenjualan` int(11) NOT NULL,
  `JumlahPenjualan` int(11) DEFAULT NULL,
  `HargaJual` decimal(10,2) DEFAULT NULL,
  `IdPengguna` int(11) DEFAULT NULL,
  `IdBarang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`IdPenjualan`, `JumlahPenjualan`, `HargaJual`, `IdPengguna`, `IdBarang`) VALUES
(1, 5, '50000.00', 2, 1),
(2, 8, '55000.00', 2, 2),
(3, 1, '600.00', 2, 3),
(4, 5, '30.00', 2, 4),
(5, 2, '600.00', 2, 5),
(6, 3, '70000.00', 2, 11),
(7, 1, '555.00', 2, 8),
(8, 2, '6000.00', 2, 6),
(9, 3, '110.00', 2, 9),
(10, 6, '28.00', 2, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`IdBarang`),
  ADD KEY `IdPengguna` (`IdPengguna`);

--
-- Indexes for table `hakakses`
--
ALTER TABLE `hakakses`
  ADD PRIMARY KEY (`IdAkses`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`IdPembelian`),
  ADD KEY `IdPengguna` (`IdPengguna`),
  ADD KEY `IdBarang` (`IdBarang`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`IdPengguna`),
  ADD KEY `IdAkses` (`IdAkses`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`IdPenjualan`),
  ADD KEY `IdPengguna` (`IdPengguna`),
  ADD KEY `IdBarang` (`IdBarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `IdBarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`IdPengguna`) REFERENCES `pengguna` (`IdPengguna`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`IdPengguna`) REFERENCES `pengguna` (`IdPengguna`),
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`IdBarang`) REFERENCES `barang` (`IdBarang`);

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`IdAkses`) REFERENCES `hakakses` (`IdAkses`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`IdPengguna`) REFERENCES `pengguna` (`IdPengguna`),
  ADD CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`IdBarang`) REFERENCES `barang` (`IdBarang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
