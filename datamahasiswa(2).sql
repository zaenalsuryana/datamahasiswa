-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 01:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datamahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `dosen_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `prodi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`dosen_id`, `user_id`, `prodi_id`, `nama`, `email`, `nip`, `fakultas`, `prodi`) VALUES
(1, 18, 1, 'rangga ananda', 'rangga@gmail.com', '0987483677', '', NULL),
(2, 19, 1, 'candra nugraha D', 'candra@gmail.com', '1230321', '', NULL),
(3, 20, 1, 'PUTRA D', 'putra@gmail.com', '12324374', '', NULL),
(4, 21, 1, 'Rega D', 'rega@gmail.com', '54327678', '', NULL),
(5, 22, 2, 'suryana D', 'surya@gmail.com', '86647587', '', NULL),
(6, 23, 1, 'isan akbar', 'isan@gmail.com', '435645', '', NULL),
(7, 24, 2, 'herman hermawan', 'hermawan@gmail.com', '7692374', '', NULL),
(8, 26, 2, 'daffa raihan', 'daffaraihan@gmail.com', '245336', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `fakultas_id` int(11) NOT NULL,
  `nama_fakultas` varchar(150) NOT NULL,
  `singkatan` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`fakultas_id`, `nama_fakultas`, `singkatan`, `created_at`) VALUES
(1, 'Teknik', 'FT', '2025-06-30 03:04:52'),
(2, 'Ekonomi dan Bisnis ', 'FEB', '2025-06-30 14:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `krs_id` int(11) NOT NULL,
  `mhs_id` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `status` enum('diajukan','disetujui','ditolak') DEFAULT 'diajukan',
  `alasan_penolakan` varchar(255) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL,
  `nilai_huruf` varchar(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `jadwal_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`krs_id`, `mhs_id`, `semester`, `tahun_ajaran`, `status`, `alasan_penolakan`, `nilai`, `nilai_huruf`, `created_at`, `jadwal_id`) VALUES
(9, 10, '1', '2025/2026', 'disetujui', NULL, '', '', '2025-07-01 08:57:15', 7),
(10, 10, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-01 08:57:15', 8),
(11, 10, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-01 08:57:15', 9),
(16, 7, '1', '2025/2026', 'disetujui', NULL, '70', '', '2025-07-08 12:03:12', 7),
(17, 12, '1', '2025/2026', 'disetujui', NULL, '90', '', '2025-07-08 16:37:21', 7),
(18, 12, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-08 16:37:21', 8),
(19, 12, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-08 16:37:21', 9),
(23, 11, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-15 14:09:16', 8),
(24, 11, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-15 14:09:16', 9),
(25, 11, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-15 14:09:16', 10),
(26, 11, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-15 14:09:16', 7),
(27, 11, '1', '2025/2026', 'disetujui', NULL, NULL, '', '2025-07-15 14:09:16', 12),
(36, 7, '2', '2025/2026', 'diajukan', NULL, NULL, '', '2025-07-15 14:13:00', 8),
(37, 7, '2', '2025/2026', 'diajukan', NULL, NULL, '', '2025-07-15 14:13:00', 9),
(38, 7, '2', '2025/2026', 'diajukan', NULL, NULL, '', '2025-07-15 14:13:00', 7),
(39, 13, '1', '2025/2026', 'diajukan', NULL, NULL, '', '2025-07-16 08:06:49', 7),
(40, 13, '1', '2025/2026', 'diajukan', NULL, NULL, '', '2025-07-16 08:06:49', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mhs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `npm` varchar(20) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `angkatan` year(4) NOT NULL,
  `semester` int(2) NOT NULL,
  `alamat` text NOT NULL,
  `status` enum('aktif','cuti','non-aktif','lulus') DEFAULT 'aktif',
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`mhs_id`, `user_id`, `prodi_id`, `nama`, `npm`, `kelas`, `angkatan`, `semester`, `alamat`, `status`, `email`, `telepon`) VALUES
(7, 14, 1, 'Candra Nugraha', '41155050230047', 'a2', '2023', 2, 'Kerinci', 'aktif', 'candra1@gmail.com', '1230234857'),
(10, 15, 1, 'Rengoku', '411529234', 'a2', '2023', 1, 'bangkok', 'aktif', 'rengoku@gmail.com', '245653442'),
(11, 16, 1, 'wertyu', '3546576873', 'c', '2023', 1, 'hgf', 'aktif', 'wertyu@gmail.com', '74434254'),
(12, 10, 1, 'qaz wrt', '112233440001', 'a2', '2025', 1, 'bandung', 'aktif', 'qaz@gmail.com', '86545345'),
(13, 2, 1, 'suryana suryani', '5435243435', 'A', '2025', 1, 'Bandung timur', 'aktif', 'suryana@gmail.com', '294357384');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `mk_id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `kode_mk` varchar(20) NOT NULL,
  `nama_mk` varchar(100) NOT NULL,
  `sks` tinyint(4) NOT NULL,
  `semester` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`mk_id`, `prodi_id`, `kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
(1, 1, 'MK001', 'Pemrograman Web Framework', 2, 1),
(2, 2, 'MK002', 'Praktikum Pemrograman Web Framework', 1, 2),
(3, 1, 'MK003', 'Implementasi dan Pengujian Perangkat Lunak', 3, 1),
(4, 1, 'MK004', 'Pemrograman Berbasis Desktop', 3, 4),
(5, 1, 'MK005', 'Praktikum Pemrograman Berbasis Desktop', 1, 4),
(6, 1, 'MK006', 'Manajemen Proyek', 3, 4),
(7, 1, 'MK007', 'Jaringan Komputer', 3, 4),
(8, 1, 'MK008', 'Praktikum Jaringan Komputer', 1, 4),
(9, 1, 'MK009', 'Kewirausahaan', 2, 4),
(10, 2, 'MKPM1 ', 'Pengantar Manajemen', 2, 1),
(11, 2, 'MKPA1', 'Pengantar Akuntansi', 2, 1),
(12, 2, 'MKME1', 'Matematika Ekonomi', 2, 1),
(13, 2, 'MKPEM1', 'Pengantar Ekonomi Mikro', 2, 1),
(14, 2, 'MKBI1', 'Bahasa Indonesia', 2, 1),
(15, 2, 'MKPP1', 'Pendidikan Pancasila', 2, 1),
(16, 2, 'MKMP2', 'Manajemen Pemasaran', 2, 2),
(17, 1, 'MKDDP1', 'Dasar-Dasar Pemrograman', 3, 1),
(18, 1, 'MKMD1', 'Matematika Dasar', 2, 1),
(19, 1, 'MKSD1', 'Struktur Data', 2, 2),
(20, 1, 'MKPBO2', 'Pemrograman Berorientasi Objek ', 2, 2),
(21, 1, 'MKBIT', 'Bahasa Inggris Teknis', 2, 2),
(22, 1, 'MKPWFS2', 'Pemrograman Web framework', 3, 2),
(23, 3, 'Kewirausahaan', 'K234', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `nilai_id` int(11) NOT NULL,
  `mhs_id` int(11) NOT NULL,
  `mk_id` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `nilai_angka` decimal(5,2) NOT NULL,
  `nilai_huruf` varchar(1) NOT NULL,
  `grade` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`nilai_id`, `mhs_id`, `mk_id`, `semester`, `nilai_angka`, `nilai_huruf`, `grade`) VALUES
(1, 1, 0, '', 80.00, 'B', '3');

-- --------------------------------------------------------

--
-- Table structure for table `pengampu`
--

CREATE TABLE `pengampu` (
  `pengampu_id` int(11) NOT NULL,
  `dosen_id` int(11) NOT NULL,
  `mk_id` int(11) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `periode` enum('Ganjil','Genap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengampu`
--

INSERT INTO `pengampu` (`pengampu_id`, `dosen_id`, `mk_id`, `tahun_ajaran`, `semester`, `prodi_id`, `periode`) VALUES
(9, 4, 19, '2025/2026', 1, 1, 'Ganjil'),
(10, 1, 1, '2025/2026', 1, 1, 'Ganjil'),
(11, 2, 3, '2025/2026', 1, 1, 'Ganjil'),
(12, 3, 8, '2025/2026', 1, 1, 'Ganjil'),
(13, 5, 10, '2025/2026', 1, 2, 'Ganjil'),
(14, 3, 1, '2025/2026', 2, 1, 'Genap'),
(15, 8, 13, '2025/2026', 1, 2, 'Ganjil');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `pengumuman_id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`pengumuman_id`, `judul`, `isi`, `tanggal`) VALUES
(1, 'Pengumuman', 'Kepada seluruh mahasiswa dan dosen Universitas Langlangbuana,\r\n\r\nDiberitahukan bahwa Sistem Informasi Akademik Kampus (SIAK) akan mengalami pemeliharaan sistem pada:\r\n\r\n???? Hari/Tanggal: Sabtu, 7 Juni 2025\r\n???? Waktu: Pukul 22.00 WIB – 06.00 WIB (Minggu, 8 Juni 2025)\r\n\r\nSelama waktu tersebut, seluruh layanan SIAK tidak dapat diakses, termasuk:\r\n\r\nPengisian KRS\r\n\r\nAkses nilai akademik\r\n\r\nInformasi jadwal perkuliahan\r\n\r\nData kehadiran dan lainnya\r\n\r\nKami menghimbau kepada seluruh pengguna untuk menyelesaikan seluruh aktivitas akademik yang berkaitan dengan SIAK sebelum waktu pemeliharaan dimulai.\r\n\r\nDemikian informasi ini disampaikan. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.', '2025-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `penjadwalan`
--

CREATE TABLE `penjadwalan` (
  `jadwal_id` int(11) NOT NULL,
  `pengampu_id` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `ruang` varchar(50) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjadwalan`
--

INSERT INTO `penjadwalan` (`jadwal_id`, `pengampu_id`, `hari`, `jam_mulai`, `jam_selesai`, `ruang`, `semester`, `tahun_ajaran`) VALUES
(6, 13, 'Senin', '07:00:00', '08:00:00', 'l2r1', '', ''),
(7, 9, 'Senin', '07:00:00', '08:00:00', 'l1r2', '', ''),
(8, 10, 'Senin', '07:00:00', '08:30:00', 'l3r1', '', ''),
(9, 11, 'Senin', '10:00:00', '12:00:00', 'l3r1', '', ''),
(10, 12, 'Selasa', '07:00:00', '09:00:00', 'j12', '', ''),
(11, 13, 'Senin', '07:00:00', '09:00:00', 'r6', '', ''),
(12, 14, 'Senin', '08:00:00', '11:30:00', 'j64', '', ''),
(13, 15, 'Senin', '07:30:00', '10:30:00', 'd1238', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `prodi_id` int(11) NOT NULL,
  `kode_prodi` varchar(20) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `jenjang` enum('D1','D2','D3','D4','S1','S2','S3') NOT NULL,
  `fakultas_id` int(100) NOT NULL,
  `akreditasi` enum('A','B','C','Tidak Terakreditasi') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`prodi_id`, `kode_prodi`, `nama_prodi`, `jenjang`, `fakultas_id`, `akreditasi`, `created_at`, `updated_at`) VALUES
(1, 'TI', 'Informatika', 'S1', 1, 'A', '2025-06-30 03:14:27', '2025-06-30 03:14:54'),
(2, 'MJ', 'Manajemen', 'S1', 2, 'B', '2025-06-30 14:47:42', '2025-06-30 14:47:42'),
(3, 'TE', 'Teknik Elektro', 'S1', 1, 'B', '2025-07-16 07:38:33', '2025-07-16 07:38:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa','dosen') NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `fullname`, `photo`, `created_at`) VALUES
(2, 'suryana', '$2y$10$7UL1/d.BXjTacJCFj94nAer8pWQwtEhlbG.EQbHgS.4n.5zdGn0ve', 'mahasiswa', 'suryana3', 'default.png', '2025-05-28 04:02:12'),
(4, 'zaenal', '$2y$10$K7cYq9FH5r2ncS0DTjV2beCpMhH4RVYbrLwJipWBriAG4G5JmwfXC', 'admin', 'suryana3', 'default.png', '2025-06-04 06:31:38'),
(6, 'candra', '$2y$10$jSTyLtanON/g0nFFyKsaCeXFRu8h0NCys7iTGoT8V4Y6g6TuCgtJK', 'admin', 'admin candra nugraha', 'default.png', '2025-06-18 05:02:37'),
(7, 'admin1', '$2y$10$TdyPdrqBViMy4WGydXGK5equCphHHRkalFWOV/8rAwZ2G2t2rNrA6', 'admin', 'admin zaenal', 'Cuplikan_layar_2025-06-22_082737.png', '2025-06-30 01:38:25'),
(10, 'qaz', '$2y$10$wUu7JiNzMi9INx.z7MfDcOVPp8hYWI.UnU.6/gn3Y7xS6TEShVyVK', 'mahasiswa', 'qaz wrt', 'default.png', '2025-06-30 13:43:02'),
(14, 'candra1', '$2y$10$2rd6hyWmzIWVWqpIyro9teSnc7JRFmCFi.aoaz3Pkl.HisVxHsj4S', 'mahasiswa', 'candra nugraha', 'default.png', '2025-07-01 02:13:08'),
(15, 'rengoku', '$2y$10$qtr1Xr7Yij1xidfBl9WA8.C9C/Xx8DiMaGO2JTUuRt.ZN/UmQMpOi', 'mahasiswa', 'renguku agatama', 'default.png', '2025-07-01 02:20:31'),
(16, 'wertyu', '$2y$10$1xQ7F0RWYOxeLuGky3ogdeUFfwHiIJWSBeT1GFEtHbOY16CudKtBO', 'mahasiswa', 'wertyu anindita', 'Cuplikan_layar_2025-07-04_152658.png', '2025-07-01 02:26:20'),
(18, 'rangga', '$2y$10$SLn8JAgnnDD1sbMm8I9Ja.IxHu297Je.xtgTngccHLTabJT173JVi', 'dosen', 'rangga ananda', 'default.png', '2025-07-08 22:32:38'),
(19, 'Candra D', '$2y$10$gX2CVvbfbKV//D0qdGyrhOQnzQwXnIOEr/wr6cknGy85bLGSyh8yG', 'dosen', 'candra nugraha D', 'default.png', '2025-07-08 22:41:45'),
(20, 'putra d', '$2y$10$wNDpHBOpe/47537fcwANEeTGdpGrKXb3k7DmzJ85nHEENiWr8UpfO', 'dosen', 'PUTRA D', 'default.png', '2025-07-08 22:42:34'),
(21, 'rega d', '$2y$10$w7bGfJgQWFl4SV7u.Y8CcuQVc5LqWat5D7SiddAQ7bbyeCDNGbgIK', 'dosen', 'Rega D', 'default.png', '2025-07-08 22:43:16'),
(22, 'suryana', '$2y$10$TknqNbAP1aU1e6frUGIPlehlAJrdCeDLHy7csn4DkiAvAyvTxFi/W', 'dosen', 'suryana D', 'default.png', '2025-07-08 22:43:43'),
(23, 'isan', '$2y$10$1D3/VfkIpH/g5S0RSshMDe12GA9iUtV85U0PNLvi4dOjOozWY.nLS', 'dosen', 'isan akbar', 'default.png', '2025-07-08 22:44:22'),
(24, 'herman d', '$2y$10$G.EcBLH1K0fkXu7I82LqZuGe.uohKZugQ4lmBoQsQgIcf1YjAIxzu', 'dosen', 'HERMAN D', 'default.png', '2025-07-08 22:46:28'),
(25, 'ajona', '$2y$10$wUu7JiNzMi9INx.z7MfDcOVPp8hYWI.UnU.6/gn3Y7xS6TEShVyVK', 'mahasiswa', 'ajona ajona', 'default.png', '2025-07-09 04:35:36'),
(26, 'daffa', '$2y$10$G/AwwIEBqS0OZGo3GPLGWuxfV60YQc3PlSATPO8v1lt8WfNtQo3dy', 'dosen', 'daffa raihan', 'default.png', '2025-07-16 07:05:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`dosen_id`),
  ADD KEY `fk_dosen_prodi` (`prodi_id`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`fakultas_id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`krs_id`),
  ADD KEY `idx_mhs_id` (`mhs_id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`mhs_id`),
  ADD KEY `idx_npm` (`npm`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`mk_id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`nilai_id`),
  ADD KEY `idx_mhs_id` (`mhs_id`),
  ADD KEY `idx_mk_id` (`mk_id`);

--
-- Indexes for table `pengampu`
--
ALTER TABLE `pengampu`
  ADD PRIMARY KEY (`pengampu_id`),
  ADD KEY `dosen_id` (`dosen_id`),
  ADD KEY `mk_id` (`mk_id`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`pengumuman_id`);

--
-- Indexes for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`prodi_id`),
  ADD KEY `idx_kode_prodi` (`kode_prodi`),
  ADD KEY `idx_nama_prodi` (`nama_prodi`),
  ADD KEY `idx_fakultas` (`fakultas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `dosen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `fakultas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `krs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `mhs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `mk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `nilai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengampu`
--
ALTER TABLE `pengampu`
  MODIFY `pengampu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `pengumuman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `prodi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`prodi_id`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`prodi_id`),
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`prodi_id`) REFERENCES `prodi` (`prodi_id`);

--
-- Constraints for table `pengampu`
--
ALTER TABLE `pengampu`
  ADD CONSTRAINT `pengampu_ibfk_1` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`dosen_id`),
  ADD CONSTRAINT `pengampu_ibfk_2` FOREIGN KEY (`mk_id`) REFERENCES `matakuliah` (`mk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
