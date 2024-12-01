-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 08:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users_zjiwa`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `nama` varchar(100) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `umur` varchar(10) NOT NULL,
  `jenisKelamin` text NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggalKonsultasi` date NOT NULL,
  `waktuKonsultasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`nama`, `tanggalLahir`, `umur`, `jenisKelamin`, `pendidikan`, `alamat`, `tanggalKonsultasi`, `waktuKonsultasi`) VALUES
('kjo', '2024-11-14', '4', 'Perempuan', 'edr', 'a', '2024-11-14', '18.00 PM'),
('grgr', '2024-10-29', '12', 'Laki-laki', 'S1-SI', 'jl.gggg', '2024-11-26', '10.00 AM'),
('gren', '2024-11-14', '13', 'Laki-laki', 'S1', 'jl.ttttt', '2024-11-30', '18.00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `contact` int(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `data_kelahiran` varchar(255) NOT NULL,
  `umur` int(11) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `pendidikan_karir` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `name`, `contact`, `image`, `data_kelahiran`, `umur`, `jenis_kelamin`, `pendidikan_karir`, `alamat`) VALUES
(1, 'budi', '123', '2024-11-24 00:52:35', '', 0, '', '', 0, '', '', ''),
(3, 'sasa', '123', '2024-11-24 14:08:58', 'sasa', 1234, '', '', 0, '', '', ''),
(4, 'bubu@gmail.com', '123', '2024-11-24 14:18:31', 'bubu', 123456789, '', '', 0, '', '', ''),
(6, 'grant           ', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2024-11-24 14:44:34', 'grant            ', 1234, '', '', 0, '', '', ''),
(7, 'ggg      ', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '2024-11-28 23:59:29', 'gg       ', 1234777, '', 'siantar, 01-januari-2004', 19, 'laki-laki', 'S1 Sistem informasi', 'jl.rt rw wwww');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD UNIQUE KEY `nama` (`nama`,`tanggalLahir`,`umur`,`jenisKelamin`,`pendidikan`,`alamat`,`tanggalKonsultasi`,`waktuKonsultasi`) USING HASH;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
