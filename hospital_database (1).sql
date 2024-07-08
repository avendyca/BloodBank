-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 10:18 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor_darah`
--

CREATE TABLE `donor_darah` (
  `id_donor` int(11) NOT NULL,
  `tanggal_donor` date NOT NULL,
  `nama_pendonor` varchar(50) NOT NULL,
  `kode_darah` varchar(5) NOT NULL,
  `jumlah_kantong` int(11) NOT NULL,
  `tanggal_kedaluwarsa` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor_darah`
--

INSERT INTO `donor_darah` (`id_donor`, `tanggal_donor`, `nama_pendonor`, `kode_darah`, `jumlah_kantong`, `tanggal_kedaluwarsa`, `jenis_kelamin`) VALUES
(11, '2024-04-11', 'Endah Padmasari', 'B+', 1, '2024-08-28', 'Perempuan'),
(14, '2024-06-10', 'Karen Lailasari', 'B+', 1, '2024-06-27', 'Perempuan'),
(16, '2024-06-11', 'Rahmi Handayani', 'O+', 1, '2024-07-21', 'Perempuan'),
(17, '2024-06-16', 'Padmi Palastri', 'O+', 1, '2024-06-27', 'Perempuan'),
(18, '2024-04-05', 'Ami Maryati', 'B-', 1, '2024-08-26', 'Perempuan'),
(19, '2024-06-18', 'Lalita Lestari', 'B+', 1, '2024-06-27', 'Perempuan'),
(21, '2024-05-04', 'Dalima Palastri', 'O-', 1, '2024-08-25', 'Perempuan'),
(22, '2024-05-19', 'Zahra Halimah', 'O+', 1, '2024-06-28', 'Perempuan'),
(23, '2024-05-16', 'Ophelia Agustina', 'B-', 1, '2024-06-25', 'Perempuan'),
(24, '2024-06-02', 'Fitriani Wahyuni', 'O+', 1, '2024-07-25', 'Perempuan'),
(25, '2024-05-18', 'Indah Andriani', 'AB-', 1, '2024-07-26', 'Perempuan'),
(26, '2024-04-03', 'Eva Suryatmi', 'O-', 1, '2024-06-21', 'Perempuan'),
(27, '2024-05-06', 'Salimah Aryani', 'O+', 1, '2024-08-26', 'Perempuan'),
(29, '2024-05-12', 'Zamira Rahmawati', 'AB-', 2, '2024-06-27', 'Perempuan'),
(30, '2024-06-12', 'Gina Wijayanti', 'B+', 1, '2024-06-24', 'Perempuan'),
(31, '2024-05-18', 'Ajeng Wulandari', 'B-', 1, '2024-08-28', 'Perempuan'),
(32, '2024-04-06', 'Nilam Yuniar', 'AB-', 1, '2024-08-27', 'Perempuan'),
(33, '2024-05-05', 'Ratih Safitri', 'O+', 1, '2024-06-25', 'Perempuan'),
(34, '2024-05-12', 'Salimah Prastuti', 'B+', 1, '2024-08-25', 'Perempuan'),
(35, '2024-04-20', 'Ayu Utami', 'O-', 2, '2024-07-27', 'Perempuan'),
(36, '2024-05-02', 'Umi Fujiati', 'AB-', 2, '2024-07-22', 'Perempuan'),
(37, '2024-04-06', 'Widya Mayasari', 'AB-', 1, '2024-07-27', 'Perempuan'),
(38, '2024-04-08', 'Paramita Mardhiyah', 'B+', 1, '2024-07-28', 'Perempuan'),
(39, '2024-04-13', 'Vera Melani', 'A+', 1, '2024-06-25', 'Perempuan'),
(40, '2024-04-20', 'Violet Namaga', 'A-', 1, '2024-08-27', 'Perempuan'),
(41, '2024-05-14', 'Paramita Sudiati', 'A+', 1, '2024-07-25', 'Perempuan'),
(42, '2024-04-06', 'Tania Pratiwi', 'AB+', 2, '2024-08-23', 'Perempuan'),
(44, '2024-06-19', 'Hamima Namaga', 'A+', 1, '2024-08-25', 'Perempuan'),
(45, '2024-06-09', 'Ophelia Oktaviani', 'O-', 2, '2024-08-22', 'Perempuan'),
(46, '2024-05-12', 'Ani Maryati', 'O-', 2, '2024-07-27', 'Perempuan'),
(47, '2024-05-11', 'Ciaobella Mayasari', 'AB+', 2, '2024-07-22', 'Perempuan'),
(50, '2024-04-07', 'Bella Purnawati', 'B+', 1, '2024-07-25', 'Perempuan'),
(51, '2024-04-06', 'Wirda Yolanda', 'A-', 1, '2024-08-28', 'Perempuan'),
(52, '2024-04-01', 'Mila Utami', 'B-', 2, '2024-08-26', 'Perempuan'),
(53, '2024-05-09', 'Tiara Mayasari', 'B+', 2, '2024-07-24', 'Perempuan'),
(54, '2024-04-14', 'Intan Yulianti', 'AB-', 1, '2024-08-25', 'Perempuan'),
(55, '2024-05-11', 'Samiah Hassanah', 'O-', 1, '2024-08-26', 'Perempuan'),
(56, '2024-04-20', 'Rina Halimah', 'O-', 1, '2024-07-26', 'Perempuan'),
(57, '2024-06-05', 'Ajiono Siregar', 'AB-', 1, '2024-07-28', 'Laki-Laki'),
(58, '2024-06-10', 'Maras Mangunsong', 'B-', 1, '2024-08-24', 'Laki-Laki'),
(59, '2024-04-15', 'Damar Prayoga', 'A+', 1, '2024-06-23', 'Laki-Laki'),
(62, '2024-04-05', 'Omar Suryono', 'AB+', 1, '2024-08-24', 'Laki-Laki'),
(63, '2024-05-16', 'Mitra Budiman', 'A+', 2, '2024-06-22', 'Laki-Laki'),
(64, '2024-05-04', 'Gangsa Prakasa', 'O-', 2, '2024-07-26', 'Laki-Laki'),
(65, '2024-04-04', 'Cemplunk Prayoga', 'O-', 2, '2024-06-24', 'Laki-Laki'),
(66, '2024-06-13', 'Adiarja Simanjuntak', 'A-', 1, '2024-07-23', 'Laki-Laki'),
(67, '2024-06-19', 'Prakosa Damanik', 'AB+', 1, '2024-07-21', 'Laki-Laki'),
(68, '2024-06-17', 'Unggul Siregar', 'AB-', 1, '2024-07-21', 'Laki-Laki'),
(69, '2024-05-13', 'Luthfi Manullang', 'AB-', 1, '2024-06-25', 'Laki-Laki'),
(70, '2024-06-04', 'Kayun Prasetya', 'A+', 2, '2024-08-25', 'Laki-Laki'),
(71, '2024-05-20', 'Gamblang Kuswoyo', 'B+', 1, '2024-06-24', 'Laki-Laki'),
(72, '2024-05-10', 'Kasiran Sirait', 'AB-', 2, '2024-08-28', 'Laki-Laki'),
(73, '2024-04-06', 'Kalim Maheswara', 'AB-', 2, '2024-06-25', 'Laki-Laki'),
(74, '2024-04-05', 'Adikara Thamrin', 'O+', 2, '2024-08-23', 'Laki-Laki'),
(75, '2024-05-08', 'Mahfud Suwarno', 'A-', 1, '2024-06-26', 'Laki-Laki'),
(76, '2024-04-01', 'Upik Pradana', 'A+', 2, '2024-06-21', 'Laki-Laki'),
(77, '2024-06-20', 'Murti Maryadi', 'O+', 1, '2024-06-21', 'Laki-Laki'),
(78, '2024-04-03', 'Bagus Lazuardi', 'AB-', 3, '2024-08-23', 'Laki-Laki'),
(79, '2024-06-08', 'Maras Wasita', 'O-', 1, '2024-06-27', 'Laki-Laki'),
(80, '2024-05-02', 'Cengkal Tarihoran', 'A+', 1, '2024-08-21', 'Laki-Laki'),
(81, '2024-06-17', 'Mustofa Zulkarnain', 'B-', 1, '2024-06-24', 'Laki-Laki'),
(82, '2024-05-06', 'Makuta Saefullah', 'O+', 1, '2024-06-24', 'Laki-Laki'),
(83, '2024-05-19', 'Estiono Lazuardi', 'B-', 2, '2024-08-26', 'Laki-Laki'),
(84, '2024-05-15', 'Karsa Tamba', 'B+', 1, '2024-07-22', 'Laki-Laki'),
(85, '2024-04-18', 'Mursinin Nugroho', 'O+', 1, '2024-06-24', 'Laki-Laki'),
(86, '2024-05-03', 'Embuh Mansur', 'B-', 1, '2024-07-28', 'Laki-Laki'),
(87, '2024-06-11', 'Luwes Najmudin', 'B-', 1, '2024-06-27', 'Laki-Laki'),
(88, '2024-06-18', 'Balijan Lazuardi', 'AB+', 1, '2024-08-28', 'Laki-Laki'),
(89, '2024-06-23', 'rendy pangalinga', 'O-', 1, '2024-06-26', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(11) NOT NULL,
  `kab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `kab`) VALUES
(1, 'Magelang'),
(2, 'Banyumas'),
(3, 'Banjarnegara'),
(4, 'Banten'),
(5, 'Bantul'),
(6, 'Kulon Progo'),
(7, 'Sleman');

-- --------------------------------------------------------

--
-- Table structure for table `loginadmin`
--

CREATE TABLE `loginadmin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loginadmin`
--

INSERT INTO `loginadmin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pendonor`
--

CREATE TABLE `pendonor` (
  `id_jenis` char(1) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') DEFAULT NULL,
  `jumlah_pendonor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendonor`
--

INSERT INTO `pendonor` (`id_jenis`, `jenis_kelamin`, `jumlah_pendonor`) VALUES
('0', 'Perempuan', 51),
('1', 'Laki-Laki', 48);

-- --------------------------------------------------------

--
-- Table structure for table `rs_berlangganan`
--

CREATE TABLE `rs_berlangganan` (
  `id_rs` int(11) NOT NULL,
  `nama_rs` varchar(50) NOT NULL,
  `alamat_rs` varchar(50) NOT NULL,
  `kab` varchar(50) DEFAULT NULL,
  `tanggal_regist` date NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rs_berlangganan`
--

INSERT INTO `rs_berlangganan` (`id_rs`, `nama_rs`, `alamat_rs`, `kab`, `tanggal_regist`, `durasi`, `selesai`) VALUES
(13, 'rsud sleman', 'sleman', 'Sleman', '2024-06-23', '1 tahun', '2025-07-23'),
(14, 'rsud banjarnegara', 'Banjarnegara', 'Banjarnegara', '2024-07-08', '1 tahun', '2025-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `stok_darah`
--

CREATE TABLE `stok_darah` (
  `kode_darah` varchar(5) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_darah`
--

INSERT INTO `stok_darah` (`kode_darah`, `stok`) VALUES
('A+', 11),
('A-', 4),
('AB+', 7),
('AB-', 18),
('B+', 11),
('B-', 11),
('O+', 11),
('O-', 16);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_darah`
--

CREATE TABLE `transaksi_darah` (
  `kode_darah` varchar(5) NOT NULL,
  `darah_masuk` int(11) NOT NULL,
  `darah_keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_darah`
--

INSERT INTO `transaksi_darah` (`kode_darah`, `darah_masuk`, `darah_keluar`) VALUES
('A+', 40, 29),
('A-', 38, 34),
('AB+', 46, 39),
('AB-', 35, 17),
('B+', 39, 28),
('B-', 34, 21),
('O+', 42, 31),
('O-', 47, 31);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama_rs` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `user_pp` varchar(50) NOT NULL DEFAULT 'default-image.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_rs`, `email`, `password`, `alamat`, `no_telp`, `user_pp`) VALUES
(1, 'RSUD SLEMAN', 'sleman@gmail.com', '$2y$10$EzJlEdp6AWRqFcTx8CeqneROT1pkjI.ExUFIlEpu4T0/5Q1IBMwOC', '', '', '1-profile.'),
(6, 'RSUD Banjarnegara', 'banjarnegara@gmail.com', '$2y$10$biRUHLERpIq/TlsKvXIkx.amcuNFe7OjFwloBDti4rPXanniIOv1C', 'Banjarnegara', '', 'default-image.jpeg'),
(7, ' puskesmas wanadadi', 'wanadadi@gmail.com', '$2y$10$s2pukAHtQPdeRJEjG1oF8O16ceEIyHjAb0es9afFUQatA7pgpiWae', 'Wanadadi', '', 'default-image.jpeg'),
(8, 'rs islam', 'islam@gmail.com', '$2y$10$j2YGNEXBz19gQXQPDyzdruvHrj2s69kHbIDUWXTtSQiTmVHTEgIES', 'Banjarnegara', '', 'default-image.jpeg'),
(9, 'Rumah Sakit Islam', 'rumahsakit@rsis.com', '$2y$10$hJmfipqt4ieSeMYhhjbMtOY/N.7tKxs2IEIDCWrKiBruDAap6Z2le', 'Jl. Widoro, Banjarnegara', '082314021245', '9-profile.jpeg'),
(10, 'Rsud Bantul', 'Bantul@gmail.com', '$2y$10$TIUHnOrhj33m1s7mevL6g.IvXI7qWc45NztCaxbclwUSZnYvLRHsi', '', '', '10-profile.jpg'),
(11, 'RSUD KLATEN', 'Klaten@gmail.com', '$2y$10$M1C5gnuM99pLZIA4y.pA9u.ISo5WupDXbTINxjwHoCvPM7GA65ZkO', 'klaten', '089789876', '11-profile.'),
(12, 'RSU Magelang', 'rsungl@gmail.com', '$2y$10$tqOPsbWmgGfQDzeEHACRq.gc.JyXrjCz13od0Fg92w.eFUQkZq4hi', '', '', '12-profile.jpg'),
(13, 'Rsud Bali', 'Bali@gmail.com', '$2y$10$bZoXVUNFQ4FJODZzQRjtnulorxsyGRqmMzF3AxVkDodkgrybx2XVC', 'denpasar', '23455677', '13-profile.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor_darah`
--
ALTER TABLE `donor_darah`
  ADD PRIMARY KEY (`id_donor`),
  ADD KEY `kode_darah` (`kode_darah`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `loginadmin`
--
ALTER TABLE `loginadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendonor`
--
ALTER TABLE `pendonor`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `rs_berlangganan`
--
ALTER TABLE `rs_berlangganan`
  ADD PRIMARY KEY (`id_rs`);

--
-- Indexes for table `stok_darah`
--
ALTER TABLE `stok_darah`
  ADD PRIMARY KEY (`kode_darah`);

--
-- Indexes for table `transaksi_darah`
--
ALTER TABLE `transaksi_darah`
  ADD PRIMARY KEY (`kode_darah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor_darah`
--
ALTER TABLE `donor_darah`
  MODIFY `id_donor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kabupaten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loginadmin`
--
ALTER TABLE `loginadmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rs_berlangganan`
--
ALTER TABLE `rs_berlangganan`
  MODIFY `id_rs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donor_darah`
--
ALTER TABLE `donor_darah`
  ADD CONSTRAINT `donor_darah_ibfk_1` FOREIGN KEY (`kode_darah`) REFERENCES `stok_darah` (`kode_darah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
