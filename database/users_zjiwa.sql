-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 09:59 AM
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
  `waktuKonsultasi` text NOT NULL,
  `psikolog` varchar(255) NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`nama`, `tanggalLahir`, `umur`, `jenisKelamin`, `pendidikan`, `alamat`, `tanggalKonsultasi`, `waktuKonsultasi`, `psikolog`, `spesialisasi`, `harga`) VALUES
('kjo', '2024-11-14', '4', 'Perempuan', 'edr', 'a', '2024-11-14', '18.00 PM', '', '', 0),
('grgr', '2024-10-29', '12', 'Laki-laki', 'S1-SI', 'jl.gggg', '2024-11-26', '10.00 AM', '', '', 0),
('gren', '2024-11-14', '13', 'Laki-laki', 'S1', 'jl.ttttt', '2024-11-30', '18.00 PM', '', '', 0),
('Maria', '2005-02-28', '19', 'Perempuan', 'sma', 'Ketintang', '2024-11-26', '16.30 PM', '', '', 0),
('Via', '2005-10-14', '19', 'Perempuan', 'sma', 'sidoarjo', '2024-12-04', '10.00 AM', '', '', 0),
('Aziz', '2005-06-14', '19', 'Laki-laki', 'sma', 'ketintang', '2025-01-11', '19.30 PM', '', '', 0),
('grant', '2005-06-10', '19', 'Laki-laki', 'sma', 'sidoarjo', '2025-02-07', '13.00 PM', '', '', 0),
('Blasius', '2009-02-03', '15', 'Perempuan', 'SMP', 'Pangururan', '2024-12-07', '16.30 PM', '', '', 0),
('kjo', '2024-10-31', '4', 'Perempuan', 'SMP', 'r2', '2024-11-08', '16.30 PM', '', '', 0),
('j', '2024-12-12', '12', 'Perempuan', 'sma', '2', '2024-12-19', '13.00 PM', '', '', 0),
('2', '2024-12-05', '2', 'Laki-laki', '22', '2', '2024-12-24', '16.30 PM', '', '', 0),
('grint', '2024-12-05', '21', 'Laki-laki', 'S1', 'fdafdsadsadsa', '2024-12-27', '19.30 PM', '', '', 0),
('321', '2024-11-29', '21', 'Laki-laki', '21', '21321', '2024-12-05', '10.00 AM', '', '', 0),
('ccc', '2024-12-03', '3', 'Perempuan', 'weqqwe', 'weqwq', '2024-12-31', '10.00 AM', 'Putra Aliando, M.Psi', 'Psikolog Klinis', 100000),
('der', '2024-11-28', '14', 'Laki-laki', 'S1', 'jl.trenggilis mejoyo', '2024-12-03', '16.30 PM', 'Wina Syafitri, S.Psi, M.Psi', 'Psikolog Klinis', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `psychologists`
--

CREATE TABLE `psychologists` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `booking_url` varchar(255) DEFAULT NULL,
  `chat_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `psychologists`
--

INSERT INTO `psychologists` (`id`, `nama`, `spesialisasi`, `deskripsi`, `harga`, `foto`, `booking_url`, `chat_url`) VALUES
(1, 'Alexa Hidayanti, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter1.png', 'booking.html', 'chat.html'),
(2, 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter3.png', 'booking.html', 'chat.html'),
(3, 'Aisyahra Permata, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem.', 100000, 'img/dokter2.png', 'booking.html', 'chat.html'),
(4, 'Putra Aliando, M.Psi', 'Psikolog Klinis', 'Hubungan Keluarga dan Romantis, Burnout, Gangguan Mood dan Kecemasan, serta Makna Hidup', 100000, 'img/dokter8.png', 'booking.html', 'chat.html'),
(5, 'Bayu Hermawan, S.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter10.png', 'booking.html', 'chat.html'),
(6, 'Wina Syafitri, S.Psi, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter17.png', 'booking.html', 'chat.html'),
(7, 'Gabriella Larasati, S.Psi, M.Psi', 'Psikolog Klinis', 'Hubungan Keluarga dan Romantis, Burnout, Gangguan Mood dan Kecemasan, serta Makna Hidup', 100000, 'img/dokter16.png', 'booking.html', 'chat.html'),
(8, 'Amanda Febrianti, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter4.png', 'booking.html', 'chat.html'),
(9, 'Mutiara Meinanda, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter7.png', 'booking.html', 'chat.html'),
(10, 'Budi Setiawan, M.Psi', 'Psikolog Klinis', 'Hubungan Keluarga dan Romantis, Burnout, Gangguan Mood dan Kecemasan, serta Makna Hidup', 100000, 'img/dokter9.png', 'booking.html', 'chat.html');

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
