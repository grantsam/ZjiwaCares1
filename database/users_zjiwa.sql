-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Des 2024 pada 06.54
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `kategori` enum('Baca Informasi','Tonton Video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `gambar`, `url`, `kategori`) VALUES
(1, '10 Cara Menjaga Kesehatan Mental di Hari Kesehatan Mental Sedunia', 'img/artikel1.png', 'https://katadata.co.id/lifestyle/varia/6524ecbc4357e/10-cara-menjaga-kesehatan-mental-di-hari-kesehatan-mental-sedunia', 'Baca Informasi'),
(2, '11 Kiat Berkomunikasi dengan Remaja.', 'img/artikel2.png', 'https://www.unicef.org/indonesia/id/kesehatan-mental/artikel/tips-berkomunikasi-dengan-remaja', 'Baca Informasi'),
(3, 'Hari Kesehatan Mental Sedunia: Kapan Kita Harus ke Psikolog, Ya?\n                                    ', 'img/artikel3.jpg', 'https://kumparan.com/kumparanwoman/hari-kesehatan-mental-sedunia-kapan-kita-harus-ke-psikolog-ya-21MHGIRGj9e/2', 'Baca Informasi'),
(4, 'Mengenal Pentingnya Kesehatan Mental pada Remaja', 'img/artikel4.png', 'https://yankes.kemkes.go.id/view_artikel/362/mengenal-pentingnya-kesehatan-mental-pada-remaja', 'Baca Informasi'),
(5, 'Kenapa Generasi sekarang gampang Kena Gangguan Mental?', 'img/video1.png', 'https://youtu.be/6Buxdq4UioY?si=hjse2cAzUDq_W88n', 'Tonton Video'),
(6, 'Sehatkah Jiwaku?', 'img/video2.png', 'https://youtu.be/93yfxrwqGWw?si=03FvsCAceIAPhdag', 'Tonton Video'),
(7, 'Apa itu Gangguan Kecemasan?', 'img/video3.png', 'https://youtu.be/PaiBtUZ0C3Y?si=J-FNuF4LI0nO2KaL', 'Tonton Video'),
(8, 'Ketahui Ciri- Ciri BurnOut dan Cara mengatasinya', 'img/video4.png', 'https://youtu.be/PzltrPk0c0s?si=AwNbRrTp1L4eEY4e', 'Tonton Video'),
(9, '10 Cara Menjaga Kesehatan Mental di Hari Kesehatan Mental Sedunia\r\n                                 ', 'img/artikel1.png', 'https://katadata.co.id/lifestyle/varia/6524ecbc4357e/10-cara-menjaga-kesehatan-mental-di-hari-kesehatan-mental-sedunia', 'Baca Informasi'),
(10, '11 Kiat Berkomunikasi dengan Remaja.', 'img/artikel2.png', 'https://www.unicef.org/indonesia/id/kesehatan-mental/artikel/tips-berkomunikasi-dengan-remaja', 'Baca Informasi'),
(11, 'Hari Kesehatan Mental Sedunia: Kapan Kita Harus ke Psikolog, Ya?\r\n                                    ', 'img/artikel3.jpg', 'https://kumparan.com/kumparanwoman/hari-kesehatan-mental-sedunia-kapan-kita-harus-ke-psikolog-ya-21MHGIRGj9e/2', 'Baca Informasi'),
(12, 'Mengenal Pentingnya Kesehatan Mental pada Remaja', 'img/artikel4.png', 'https://yankes.kemkes.go.id/view_artikel/362/mengenal-pentingnya-kesehatan-mental-pada-remaja', 'Baca Informasi'),
(13, 'Kenapa Generasi sekarang gampang Kena Gangguan Mental?', 'img/video1.png', 'https://youtu.be/6Buxdq4UioY?si=hjse2cAzUDq_W88n', 'Tonton Video'),
(14, 'Sehatkah Jiwaku?', 'img/video2.png', 'https://youtu.be/93yfxrwqGWw?si=03FvsCAceIAPhdag', 'Tonton Video'),
(15, 'Apa itu Gangguan Kecemasan?', 'img/video3.png', 'https://youtu.be/PaiBtUZ0C3Y?si=J-FNuF4LI0nO2KaL', 'Tonton Video'),
(16, 'Ketahui Ciri- Ciri BurnOut dan Cara mengatasinya', 'img/video4.png', 'https://youtu.be/PzltrPk0c0s?si=AwNbRrTp1L4eEY4e', 'Tonton Video');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
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
  `harga` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`booking_id`, `nama`, `tanggalLahir`, `umur`, `jenisKelamin`, `pendidikan`, `alamat`, `tanggalKonsultasi`, `waktuKonsultasi`, `psikolog`, `spesialisasi`, `harga`, `user_id`) VALUES
(1, 'kjo', '2024-11-14', '4', 'Perempuan', 'edr', 'a', '2024-11-14', '18.00 PM', '', '', 0, NULL),
(2, 'grgr', '2024-10-29', '12', 'Laki-laki', 'S1-SI', 'jl.gggg', '2024-11-26', '10.00 AM', '', '', 0, NULL),
(3, 'gren', '2024-11-14', '13', 'Laki-laki', 'S1', 'jl.ttttt', '2024-11-30', '18.00 PM', '', '', 0, NULL),
(4, 'Maria', '2005-02-28', '19', 'Perempuan', 'sma', 'Ketintang', '2024-11-26', '16.30 PM', '', '', 0, NULL),
(5, 'Via', '2005-10-14', '19', 'Perempuan', 'sma', 'sidoarjo', '2024-12-04', '10.00 AM', '', '', 0, NULL),
(6, 'Aziz', '2005-06-14', '19', 'Laki-laki', 'sma', 'ketintang', '2025-01-11', '19.30 PM', '', '', 0, NULL),
(7, 'grant', '2005-06-10', '19', 'Laki-laki', 'sma', 'sidoarjo', '2025-02-07', '13.00 PM', '', '', 0, NULL),
(8, 'Blasius', '2009-02-03', '15', 'Perempuan', 'SMP', 'Pangururan', '2024-12-07', '16.30 PM', '', '', 0, NULL),
(9, 'kjo', '2024-10-31', '4', 'Perempuan', 'SMP', 'r2', '2024-11-08', '16.30 PM', '', '', 0, NULL),
(10, 'j', '2024-12-12', '12', 'Perempuan', 'sma', '2', '2024-12-19', '13.00 PM', '', '', 0, NULL),
(11, '2', '2024-12-05', '2', 'Laki-laki', '22', '2', '2024-12-24', '16.30 PM', '', '', 0, NULL),
(12, 'grint', '2024-12-05', '21', 'Laki-laki', 'S1', 'fdafdsadsadsa', '2024-12-27', '19.30 PM', '', '', 0, NULL),
(13, '321', '2024-11-29', '21', 'Laki-laki', '21', '21321', '2024-12-05', '10.00 AM', '', '', 0, NULL),
(14, 'ccc', '2024-12-03', '3', 'Perempuan', 'weqqwe', 'weqwq', '2024-12-31', '10.00 AM', 'Putra Aliando, M.Psi', 'Psikolog Klinis', 100000, NULL),
(15, 'der', '2024-11-28', '14', 'Laki-laki', 'S1', 'jl.trenggilis mejoyo', '2024-12-03', '16.30 PM', 'Wina Syafitri, S.Psi, M.Psi', 'Psikolog Klinis', 100000, NULL),
(16, 'sdad', '2024-12-13', '12', 'Laki-laki', 'dsa', 'dsa', '2024-12-19', '10.00 AM', 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 100000, NULL),
(17, 'granr', '2024-12-12', '100', 'Laki-laki', 'S1-SI', 'reer', '2024-12-12', '19.30 PM', 'Putra Aliando, M.Psi', 'Psikolog Klinis', 100000, NULL),
(18, 'grig', '2024-12-04', '42', 'Laki-laki', 'S1-SI', 'grgrgrgr', '2024-12-14', '19.30 PM', 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 100000, NULL),
(19, 'grant', '2024-12-17', '20', 'Laki-laki', 'S1 S1', 'jl.mojokerto', '2024-12-17', '19.30 PM', 'Putra Aliando, M.Psi', 'Psikolog Klinis', 100000, NULL),
(20, 'grantzy', '2024-12-30', '20', 'Laki-laki', 'S1', 'jl.123', '2024-12-30', '14.30 PM', 'grant sam,M.SI', 'IT consultan', 120000, NULL),
(21, 'xxxxx', '2024-12-24', '21', 'Laki-laki', 'xxxx', 'xxx', '2024-12-31', '18.00 PM', 'grant sam,M.SI', 'IT consultan', 120000, NULL),
(32, 'ttttt', '2025-01-02', '1', 'Laki-laki', '1', '1', '2024-12-30', '16.30 PM', 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 100000, 7),
(33, 'a', '2024-12-18', '1', 'Perempuan', 'a', 'a', '2024-12-25', '10.00 AM', 'Bayu Hermawan, S.Psi', 'Psikolog Klinis', 100000, 7),
(34, 'b', '2024-12-30', '2', 'Laki-laki', 'b', 'b', '2024-12-10', '18.00 PM', 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 100000, 7),
(35, 'r', '2025-01-01', '3', 'Perempuan', 'rr', 'r', '2024-12-16', '13.00 PM', 'Alexa Hidayanti, M.Psi', 'Psikolog Klinis', 100000, 7),
(36, 'v', '2024-11-26', '99', 'Laki-laki', 'zx', 'xz', '2024-12-31', '10.00 AM', 'Alexa Hidayanti, M.Psi', 'Psikolog Klinis', 100000, 7),
(37, 'das', '0002-02-22', '12', 'Laki-laki', 'dsa', 'ads', '0002-02-22', '10.00 AM', 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 100000, 7),
(38, 'das', '0222-02-22', '21', 'Laki-laki', '12', 'eda', '0121-12-21', '16.30 PM', 'Putra Aliando, M.Psi', 'Psikolog Klinis', 100000, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_transaksi` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `umur` int(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_konsultasi` date NOT NULL,
  `waktu_konsultasi` varchar(255) NOT NULL,
  `psikolog` varchar(255) NOT NULL,
  `harga` decimal(65,0) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `booking_id` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_transaksi`, `username`, `nama`, `tanggal_lahir`, `umur`, `jenis_kelamin`, `pendidikan`, `alamat`, `tanggal_konsultasi`, `waktu_konsultasi`, `psikolog`, `harga`, `metode_pembayaran`, `created_at`, `booking_id`, `status`) VALUES
('', 'ggg      ', '0000-00-00', '2024-12-04', 42, 'Laki-laki', 'S1-SI', 'grgrgrgr', '2024-12-14', '19.30 PM', 'Dr. Nova Kurniasari , M.Psi', 100000, 'mandiri', '2024-12-12 22:05:01', NULL, NULL),
('TXN-4f4c150d-c7af-494c-b9fe-6673c94a0835', 'ggg      ', 'ttttt', '2025-01-02', 1, 'Laki-laki', '1', '1', '2024-12-30', '16.30 PM', 'Dr. Nova Kurniasari , M.Psi', 100000, 'ovo', '2024-12-28 20:11:11', NULL, NULL),
('TXN-5ca17249-a703-4106-bf6a-91f869196fea', 'ggg      ', 'v', '2024-11-26', 99, 'Laki-laki', 'zx', 'xz', '2024-12-31', '10.00 AM', 'Alexa Hidayanti, M.Psi', 100000, 'mandiri', '2024-12-29 20:04:39', 36, 'berhasil'),
('TXN-7b0e9fbe-6d60-486b-8bb2-654a79b3c544', 'ggg      ', 'a', '2024-12-18', 1, 'Perempuan', 'a', 'a', '2024-12-25', '10.00 AM', 'Bayu Hermawan, S.Psi', 100000, 'bca', '2024-12-28 20:22:21', NULL, NULL),
('TXN-82754b1f-8f70-4734-b248-5f38d8cb9f1a', 'ggg      ', 'grant', '2024-12-17', 20, 'Laki-laki', 'S1 S1', 'jl.mojokerto', '2024-12-17', '19.30 PM', 'Putra Aliando, M.Psi', 100000, 'gopay', '2024-12-16 07:54:36', NULL, NULL),
('TXN-9358a4d9-58d2-41ed-a882-e852de50e1f8', 'ggg      ', 'r', '2025-01-01', 3, 'Perempuan', 'rr', 'r', '2024-12-16', '13.00 PM', 'Alexa Hidayanti, M.Psi', 100000, 'mandiri', '2024-12-28 20:30:05', 35, NULL),
('TXN-954d3010-7af5-47d5-af9b-484f968c4055', 'ggg      ', 'das', '0222-02-22', 21, 'Laki-laki', '12', 'eda', '0121-12-21', '16.30 PM', 'Putra Aliando, M.Psi', 100000, 'gopay', '2024-12-29 20:37:12', 38, 'gagal'),
('TXN-be9f6f6a-41db-4b26-8ae9-16a65c05790f', 'ggg      ', 'grig', '2024-12-04', 42, 'Laki-laki', 'S1-SI', 'grgrgrgr', '2024-12-14', '19.30 PM', 'Dr. Nova Kurniasari , M.Psi', 100000, 'bri', '2024-12-12 23:01:11', NULL, NULL),
('TXN-c6f4b581-998e-4ba6-b3c0-daa1efaeb3cd', 'ggg      ', 'das', '0222-02-22', 21, 'Laki-laki', '12', 'eda', '0121-12-21', '16.30 PM', 'Putra Aliando, M.Psi', 100000, 'bri', '2024-12-29 20:32:22', 38, 'gagal'),
('TXN-f67008d6-4ddb-4ab0-92cc-8dbae6c6762f', 'ggg      ', 'grig', '2024-12-04', 42, 'Laki-laki', 'S1-SI', 'grgrgrgr', '2024-12-14', '19.30 PM', 'Dr. Nova Kurniasari , M.Psi', 100000, 'bca', '2024-12-12 22:59:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `psychologists`
--

CREATE TABLE `psychologists` (
  `id` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `spesialisasi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `psychologists`
--

INSERT INTO `psychologists` (`id`, `nama`, `spesialisasi`, `deskripsi`, `harga`, `foto`) VALUES
(1, 'Alexa Hidayanti, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem.', 100000, 'img/dokter1.png'),
(2, 'Dr. Nova Kurniasari , M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem.', 100000, 'img/dokter3.png'),
(3, 'Aisyahra Permata, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem.', 100000, 'img/dokter2.png'),
(4, 'Putra Aliando, M.Psi', 'Psikolog Klinis', 'Hubungan Keluarga dan Romantis, Burnout, Gangguan Mood dan Kecemasan, serta Makna Hidup', 100000, 'img/dokter8.png'),
(5, 'Bayu Hermawan, S.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter10.png'),
(6, 'Wina Syafitri, S.Psi, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter17.png'),
(7, 'Gabriella Larasati, S.Psi, M.Psi', 'Psikolog Klinis', 'Hubungan Keluarga dan Romantis, Burnout, Gangguan Mood dan Kecemasan, serta Makna Hidup', 100000, 'img/dokter16.png'),
(8, 'Amanda Febrianti, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter4.png'),
(9, 'Mutiara Meinanda, M.Psi', 'Psikolog Klinis', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 100000, 'img/dokter7.png'),
(10, 'Budi Setiawan, M.Psi', 'Psikolog Klinis', 'Hubungan Keluarga dan Romantis, Burnout, Gangguan Mood dan Kecemasan, serta Makna Hidup', 100000, 'img/dokter9.png'),
(0, 'grant sam,M.SI', 'IT consultan', 'Depresi, Stress, Hubungan Romantis, Pengembangan Diri, Kesulitan Beradaptasi, Self esteem', 120000, 'img/Screenshot 2024-10-18 170415.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
  `alamat` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `name`, `contact`, `image`, `data_kelahiran`, `umur`, `jenis_kelamin`, `pendidikan_karir`, `alamat`, `role`) VALUES
(1, 'budi', '123', '2024-11-24 00:52:35', '', 0, '', '', 0, '', '', '', 'user'),
(3, 'sasa', '123', '2024-11-24 14:08:58', 'sasa', 1234, '', '', 0, '', '', '', 'user'),
(4, 'bubu@gmail.com', '123', '2024-11-24 14:18:31', 'bubu', 123456789, '', '', 0, '', '', '', 'user'),
(6, 'grant           ', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', '2024-11-24 14:44:34', 'grant            ', 1234, '', '', 0, '', '', '', 'user'),
(7, 'ggg      ', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '2024-11-28 23:59:29', 'gg       ', 1234777, '', 'siantar, 01-januari-2004', 19, 'laki-laki', 'S1 Sistem informasi', 'jl.rt rw wwww', 'user'),
(8, 'via', '8d23cf6c86e834a7aa6eded54c26ce2bb2e74903538c61bdd5d2197997ab2f72', '2024-12-30 11:56:43', 'Oktavia', 32423, '', '', 0, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `nama` (`nama`,`tanggalLahir`,`umur`,`jenisKelamin`,`pendidikan`,`alamat`,`tanggalKonsultasi`,`waktuKonsultasi`) USING HASH,
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_booking_id` (`booking_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
