-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2020 at 06:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appkantin`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_saldo`
--

CREATE TABLE `detail_saldo` (
  `no_pelanggan` varchar(20) DEFAULT NULL,
  `saldo_tambahan` int(11) DEFAULT NULL,
  `waktu` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `kode_menu` varchar(10) DEFAULT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `harga_tenant` int(11) DEFAULT NULL,
  `laba` int(11) DEFAULT NULL,
  `nama_tenant` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `kode_menu`, `nama_menu`, `stok`, `harga`, `harga_tenant`, `laba`, `nama_tenant`) VALUES
(3, 'BRG0003', 'T1 - Nasi Padang', 62, 10000, 9000, 1000, 'Tenant1'),
(4, 'BRG0004', 'T1 - Es Teh', 73, 3000, 2000, 1000, 'Tenant1'),
(5, 'BRG0005', 'T2 - Soto', 86, 8000, 7000, 1000, 'Tenant2'),
(6, 'BRG0006', 'T2 - Es Jeruk', 68, 3000, 2000, 1000, 'Tenant2'),
(8, 'BRG0007', 'T3 - Roti', 83, 10000, 7000, 3000, 'Tenant3'),
(9, 'BRG0009', 'T4 - Pisang Goreng', 83, 12000, 8000, 4000, 'Tenant4');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `no_pelanggan` varchar(30) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL,
  `kelas` varchar(30) DEFAULT NULL,
  `unit_pendidikan` varchar(30) DEFAULT NULL,
  `pin` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `no_pelanggan`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `no_telp`, `kelas`, `unit_pendidikan`, `pin`) VALUES
(29, '4017958421', 'nabhan', 'asd', 'asd', '2020-03-18', '123', 'asd', NULL, 123456),
(30, 'SN00030', 'naufal', 'asd', 'asd', '2020-03-19', '321', 'asd', NULL, 321321),
(31, 'SN00031', 'budi', 'asd', 'asd', '2020-03-27', '123', 'asd', NULL, 123123),
(32, 'SN00032', 'rima', 'asd', 'asd', '2020-03-27', '123', 'asd', NULL, 123123),
(33, 'SN00033', 'nabby', 'asd', 'asd', '2020-06-12', '12312', '', NULL, 123123),
(37, '1132587479478400', 'Febri', 'Yogyakarta', 'Purbalingga', '2020-04-08', '09888728271', NULL, NULL, 123456),
(38, '*Bayar Tunai', 'Pelanggan', 'alamat', 'tl', '2020-05-06', '08123456789', NULL, NULL, 123456);

-- --------------------------------------------------------

--
-- Table structure for table `pengambilan_tenant`
--

CREATE TABLE `pengambilan_tenant` (
  `id_pengambilan` int(11) NOT NULL,
  `kode_menu` varchar(10) DEFAULT NULL,
  `tgl_pengambilan` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sisa_menu` int(11) DEFAULT NULL,
  `nominal_uang` int(11) DEFAULT NULL,
  `petugas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengambilan_tenant`
--

INSERT INTO `pengambilan_tenant` (`id_pengambilan`, `kode_menu`, `tgl_pengambilan`, `jumlah`, `sisa_menu`, `nominal_uang`, `petugas`) VALUES
(1, 'BRG0001', '2018-07-07', 62, 38, 155000, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `kode_penjualan` varchar(20) DEFAULT NULL,
  `tgl_penjualan` date NOT NULL,
  `kode_menu` varchar(20) DEFAULT NULL,
  `nama_menu` varchar(25) NOT NULL,
  `nama_tenant` varchar(25) NOT NULL,
  `qty` int(5) DEFAULT NULL,
  `harga` int(15) NOT NULL,
  `total_harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`kode_penjualan`, `tgl_penjualan`, `kode_menu`, `nama_menu`, `nama_tenant`, `qty`, `harga`, `total_harga`) VALUES
('PJ00001', '2020-03-25', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 5, 10000, 50000),
('PJ00001', '2020-03-25', 'BRG0004', 'T1 - Es Teh', 'Tenant1', 5, 3000, 15000),
('PJ00002', '2020-03-25', 'BRG0005', 'T2 - Soto', 'Tenant2', 3, 8000, 24000),
('PJ00002', '2020-03-25', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 3, 3000, 9000),
('PJ00003', '2020-03-25', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 1, 10000, 10000),
('PJ00003', '2020-03-25', 'BRG0005', 'T2 - Soto', 'Tenant2', 2, 8000, 16000),
('PJ00003', '2020-03-25', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 3, 3000, 9000),
('PJ00004', '2020-03-27', 'BRG0005', 'T2 - Soto', 'Tenant2', 2, 8000, 16000),
('PJ00004', '2020-03-27', 'BRG0004', 'T1 - Es Teh', 'Tenant1', 1, 3000, 3000),
('PJ00005', '2020-03-30', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 1, 3000, 3000),
('PJ00006', '2020-03-31', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 1, 10000, 10000),
('PJ00006', '2020-03-31', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 2, 3000, 6000),
('PJ00007', '2020-04-04', 'BRG0004', 'T1 - Es Teh', 'Tenant1', 10, 3000, 30000),
('PJ00007', '2020-04-04', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 10, 3000, 30000),
('PJ00008', '2020-04-05', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 3, 10000, 30000),
('PJ00008', '2020-04-05', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 3, 3000, 9000),
('PJ00009', '2020-04-07', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 1, 3000, 3000),
('PJ00010', '2020-04-07', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 1, 10000, 10000),
('PJ00010', '2020-04-07', 'BRG0005', 'T2 - Soto', 'Tenant2', 1, 8000, 8000),
('PJ00011', '2020-04-08', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 2, 10000, 20000),
('PJ00011', '2020-04-08', 'BRG0007', 'T3 - Roti', 'Tenant3', 2, 10000, 20000),
('PJ00013', '2020-04-08', 'BRG0005', 'T2 - Soto', 'Tenant2', 3, 8000, 24000),
('PJ00013', '2020-04-08', 'BRG0007', 'T3 - Roti', 'Tenant3', 10, 10000, 100000),
('PJ00014', '2020-04-08', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 2, 10000, 20000),
('PJ00015', '2020-04-26', 'BRG0007', 'T3 - Roti', 'Tenant3', 3, 10000, 30000),
('PJ00016', '2020-04-26', 'BRG0009', 'T4 - Pisang Goreng', 'Tenant4', 12, 12000, 144000),
('PJ00017', '2020-05-03', 'BRG0004', 'T1 - Es Teh', 'Tenant1', 2, 3000, 6000),
('PJ00017', '2020-05-03', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 3, 3000, 9000),
('PJ00018', '2020-05-04', 'BRG0009', 'T4 - Pisang Goreng', 'Tenant4', 2, 12000, 24000),
('PJ00019', '2020-05-05', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 1, 10000, 10000),
('PJ00020', '2020-05-05', 'BRG0003', 'T1 - Nasi Padang', 'Tenant1', 10, 10000, 100000),
('PJ00020', '2020-05-05', 'BRG0009', 'T4 - Pisang Goreng', 'Tenant4', 2, 12000, 24000),
('PJ00021', '2020-05-05', 'BRG0007', 'T3 - Roti', 'Tenant3', 2, 10000, 20000),
('PJ00022', '2020-05-05', 'BRG0004', 'T1 - Es Teh', 'Tenant1', 2, 3000, 6000),
('PJ00023', '2020-05-05', 'BRG0004', 'T1 - Es Teh', 'Tenant1', 3, 3000, 9000),
('PJ00024', '2020-05-07', 'BRG0009', 'T4 - Pisang Goreng', 'Tenant4', 1, 12000, 12000),
('PJ00025', '2020-05-08', 'BRG0006', 'T2 - Es Jeruk', 'Tenant2', 1, 3000, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_header`
--

CREATE TABLE `penjualan_header` (
  `id_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(20) DEFAULT NULL,
  `no_pelanggan` varchar(30) DEFAULT NULL,
  `harga_total` int(11) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `kasir` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_header`
--

INSERT INTO `penjualan_header` (`id_penjualan`, `kode_penjualan`, `no_pelanggan`, `harga_total`, `tgl_penjualan`, `kasir`) VALUES
(1, 'PJ00001', '4017958421', 65000, '2020-03-25', 'Administrator'),
(2, 'PJ00002', 'SN00030', 33000, '2020-03-25', 'Administrator'),
(3, 'PJ00003', 'SN00030', 35000, '2020-03-25', 'Administrator'),
(4, 'PJ00004', 'SN00031', 19000, '2020-03-27', 'Administrator'),
(5, 'PJ00005', 'SN00031', 3000, '2020-03-30', 'Administrator'),
(6, 'PJ00006', 'SN00033', 16000, '2020-03-31', 'Administrator'),
(7, 'PJ00007', '4017958421', 60000, '2020-04-04', 'Administrator'),
(8, 'PJ00008', '4017958421', 39000, '2020-04-05', 'Administrator'),
(9, 'PJ00009', '4017958421', 3000, '2020-04-07', 'Administrator'),
(10, 'PJ00010', '4017958421', 18000, '2020-04-07', 'Administrator'),
(12, 'PJ00011', '1132587479478400', 40000, '2020-04-08', 'Administrator'),
(13, 'PJ00013', '4017958421', 124000, '2020-04-08', 'Administrator'),
(14, 'PJ00014', '4017958421', 20000, '2020-04-08', 'Administrator'),
(15, 'PJ00015', '1132587479478400', 30000, '2020-04-26', 'Administrator'),
(16, 'PJ00016', '1132587479478400', 144000, '2020-04-26', 'Administrator'),
(17, 'PJ00017', '1132587479478400', 15000, '2020-05-03', 'Administrator'),
(18, 'PJ00018', '1132587479478400', 24000, '2020-05-04', 'Administrator'),
(19, 'PJ00019', '1132587479478400', 10000, '2020-05-05', 'Administrator'),
(20, 'PJ00020', '1132587479478400', 124000, '2020-05-05', 'Administrator'),
(21, 'PJ00021', '1132587479478400', 20000, '2020-05-05', 'Administrator'),
(22, 'PJ00022', '*Bayar Tunai', 6000, '2020-05-05', 'Administrator'),
(23, 'PJ00023', '*Bayar Tunai', 9000, '2020-05-05', 'Administrator'),
(24, 'PJ00024', 'Bayar Tunai', 12000, '2020-05-07', 'Administrator'),
(25, 'PJ00025', '*Bayar Tunai', 3000, '2020-05-08', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `no_pelanggan` varchar(30) DEFAULT NULL,
  `saldo` int(10) DEFAULT 0,
  `pengeluaran` int(10) DEFAULT 0,
  `waktu` varchar(50) DEFAULT NULL,
  `saldo_tambahan` int(10) DEFAULT 0,
  `tarik_tunai` int(16) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `no_pelanggan`, `saldo`, `pengeluaran`, `waktu`, `saldo_tambahan`, `tarik_tunai`) VALUES
(23, '4017958421', 601000, 329000, '07-04-2020 14:46:35', 1050000, 120000),
(24, 'SN00030', 82000, 68000, '27-03-2020 22:03:13', 200000, 50000),
(25, 'SN00031', 778000, 22000, '27-03-2020 22:02:39', 1000000, 200000),
(26, 'SN00033', 984000, 16000, '31-03-2020 18:29:54', 1000000, 0),
(29, '1132587479478400', 593000, 407000, '08-04-2020 14:44:28', 1000000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setoran_tenant`
--

CREATE TABLE `setoran_tenant` (
  `id_setoran` int(11) NOT NULL,
  `kode_menu` varchar(10) DEFAULT NULL,
  `tgl_setoran` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `petugas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setoran_tenant`
--

INSERT INTO `setoran_tenant` (`id_setoran`, `kode_menu`, `tgl_setoran`, `jumlah`, `petugas`) VALUES
(1, 'BRG0001', '2018-07-10', 100, 'Administrator'),
(2, 'BRG0002', '2018-07-19', 100, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id_tenant` int(11) NOT NULL,
  `kode_menu` varchar(50) DEFAULT NULL,
  `nama_tenant` varchar(50) DEFAULT NULL,
  `jumlah_storan` int(10) DEFAULT NULL,
  `tgl_penyetoran` date DEFAULT NULL,
  `jumlah_terjual` int(5) DEFAULT NULL,
  `sisa_menu` int(5) DEFAULT NULL,
  `nominal_uang` int(11) DEFAULT NULL,
  `tgl_pengambilan` date DEFAULT NULL,
  `petugas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `level` varchar(20) DEFAULT NULL,
  `no_pelanggan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `foto`, `level`, `no_pelanggan`) VALUES
(1, 'Administrator', 'admin', 'admin', 'user_1521020506.png', 'admin', '0'),
(6, 'Tenant1', 'tenant1', 'tenant1', 'user_1521020506.png', 'tenant', '0'),
(7, 'Tenant2', 'tenant2', 'tenant2', 'user_1521020506.png', 'tenant', '0'),
(8, 'budi', 'budi', 'budi', 'user_1521020506.png', 'pelanggan', 'SN00031'),
(10, 'nabhan', 'nabhan', 'nabhan', 'user_1521461555.png', 'pelanggan', '4017958421'),
(11, 'naufal', 'naufal', 'naufal', 'user_1521461555.png', 'admin', 'SN00030'),
(12, 'nabby', 'nabby', 'nabby', 'user_1521020506.png', 'pelanggan', 'SN00033'),
(17, 'Febri', 'febri', 'febri', 'user_1521020506.png', 'pelanggan', '1132587479478400'),
(18, 'Tenant3', 'tenant3', 'tenant3', 'user_1521020506.png', 'tenant', ''),
(19, 'Tenant4', 'tenant4', 'tenant4', 'user_1521020506.png', 'tenant', ''),
(20, 'Kasir Kasir', 'kasir1', 'kasir1', 'user_1588670863.png', 'kasir', ''),
(21, 'Bayar Tunai', 'bayar tunai', 'bayar tunai', 'user_1521020506.png', 'pelanggan', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pengambilan_tenant`
--
ALTER TABLE `pengambilan_tenant`
  ADD PRIMARY KEY (`id_pengambilan`);

--
-- Indexes for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indexes for table `setoran_tenant`
--
ALTER TABLE `setoran_tenant`
  ADD PRIMARY KEY (`id_setoran`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id_tenant`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pengambilan_tenant`
--
ALTER TABLE `pengambilan_tenant`
  MODIFY `id_pengambilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penjualan_header`
--
ALTER TABLE `penjualan_header`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `setoran_tenant`
--
ALTER TABLE `setoran_tenant`
  MODIFY `id_setoran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id_tenant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
