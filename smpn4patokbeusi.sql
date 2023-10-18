-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2023 at 01:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smpn4patokbeusi`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_absen`
--

CREATE TABLE `data_absen` (
  `id_absen` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `nama_kelas` varchar(11) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `matapelajaran` varchar(50) NOT NULL,
  `waktu_absen` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_absen`
--

INSERT INTO `data_absen` (`id_absen`, `id_tahun`, `nama_kelas`, `nama_guru`, `matapelajaran`, `waktu_absen`) VALUES
(61, 1, '7A', 'Yoga Prasetyo', 'Matematika', '2023-09-26 09:17:08'),
(62, 1, '7A', 'Yoga Prasetyo', 'Matematika', '2023-09-26 09:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nip` int(25) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` enum('Kepala Sekolah','Wakil Kepala Sekolah','Kesiswaan','Guru','Admin/Staff TU') NOT NULL,
  `matapelajaran` varchar(50) NOT NULL,
  `foto` text NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nip`, `nama_guru`, `tanggal_lahir`, `jabatan`, `matapelajaran`, `foto`) VALUES
(4, 12210247, 'Yoga Prasetyo', '2023-08-09', 'Guru', 'Ilmu Pengetahuan Alam & Sosial', 'builderman-removebg-preview.png'),
(5, 12211125, 'Raihan Ramadhan', '2023-08-10', 'Guru', 'Matematika', 'removal_ai_tmp-64393f4f1c2f41.png'),
(6, 12210740, 'Yusup Supriatna', '2023-08-10', 'Guru', 'Pendidikan Agama Islam', 'WhatsApp_Image_2023-06-29_at_18_31_54.jpeg'),
(7, 111111, 'Ahmad Maulana', '2023-08-14', 'Guru', 'Bahasa Inggris', 'FILE_MENTAH_DAY_2.png');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `wali_kelas` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `wali_kelas`) VALUES
(9, '7A', 'Yoga Prasetyo'),
(10, '7B', 'Yoga Prasetyo'),
(11, '7C', 'Yoga Prasetyo'),
(12, '7D', 'Yoga Prasetyo'),
(13, '8A', 'Ahmad Maulana'),
(14, '8B', 'Ahmad Maulana'),
(15, '8C', 'Ahmad Maulana'),
(16, '8D', 'Ahmad Maulana'),
(17, '9A', 'Yusup Supriatna'),
(18, '9B', 'Yusup Supriatna'),
(19, '9C', 'Yusup Supriatna'),
(20, '9D', 'Raihan Ramadhan'),
(21, '9E', 'Raihan Ramadhan');

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `id_mapel` int(11) NOT NULL,
  `kd_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`id_mapel`, `kd_mapel`, `nama_mapel`) VALUES
(1, 205, 'Matematika'),
(2, 206, 'PAI'),
(3, 401, 'IPA'),
(4, 421, 'PJOK'),
(5, 503, 'Seni Budaya'),
(6, 404, 'Bahasa Inggris'),
(7, 406, 'Bahasa Sunda'),
(8, 305, 'Bahasa Indonesia'),
(9, 708, 'P5'),
(10, 603, 'BTQ'),
(12, 376, 'Informatika'),
(13, 601, 'IPS'),
(14, 470, 'Prakarya');

-- --------------------------------------------------------

--
-- Table structure for table `murid`
--

CREATE TABLE `murid` (
  `id_murid` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `nis` int(15) NOT NULL,
  `nama_murid` varchar(50) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `foto` text NOT NULL DEFAULT 'default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `murid`
--

INSERT INTO `murid` (`id_murid`, `id_tahun`, `nis`, `nama_murid`, `nama_kelas`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `no_telepon`, `foto`) VALUES
(45, 1, 12210740, 'Mubaroq Al Mushab', '7A', 'Jakarta', '2023-09-19', 'Laki-Laki', '081294684656', 'default.png'),
(46, 2, 12210104, 'Harun Kasim', '7A', 'Jakarta', '2023-09-23', 'Laki-Laki', '081294684656', 'default.png'),
(47, 1, 122101231, 'Yusup Supriatna', '7A', 'Karawang', '2023-09-23', 'Laki-Laki', '081294684656', 'default.png'),
(48, 1, 420666, 'Ncuyy', '7B', 'Karawang', '2023-09-25', 'Laki-Laki', '081294684656', 'default.png'),
(49, 1, 12210247, 'Alvin Austin', '7A', 'Jakarta', '2023-10-05', 'Laki-Laki', '081294684656', 'default.png');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `nis` varchar(25) NOT NULL,
  `nama_murid` varchar(50) NOT NULL,
  `kd_mapel` int(11) NOT NULL,
  `nilai_tugas` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL,
  `total_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_tahun`, `nis`, `nama_murid`, `kd_mapel`, `nilai_tugas`, `nilai_uts`, `nilai_uas`, `total_nilai`) VALUES
(21, 1, '12210740', 'Mubaroq Al Mushab', 205, 100, 75, 85, 87),
(22, 1, '12210247', 'Alvin Austin', 205, 87, 95, 100, 94);

-- --------------------------------------------------------

--
-- Table structure for table `submit_absen`
--

CREATE TABLE `submit_absen` (
  `id_submit` int(11) NOT NULL,
  `id_tahun` int(11) NOT NULL,
  `id_absen` int(11) NOT NULL,
  `id_murid` int(11) NOT NULL,
  `nama_murid` varchar(50) NOT NULL,
  `nama_kelas` varchar(11) NOT NULL,
  `status` enum('Tanpa Keterangan','Hadir','Izin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submit_absen`
--

INSERT INTO `submit_absen` (`id_submit`, `id_tahun`, `id_absen`, `id_murid`, `nama_murid`, `nama_kelas`, `status`) VALUES
(36, 1, 45, 45, 'Mubaroq Al Mushab', '7A', 'Hadir'),
(37, 1, 0, 47, 'Yusup Supriatna', '7A', 'Hadir'),
(38, 1, 45, 45, 'Mubaroq Al Mushab', '7A', 'Tanpa Keterangan'),
(39, 1, 46, 47, 'Yusup Supriatna', '7A', 'Tanpa Keterangan'),
(40, 1, 45, 45, 'Mubaroq Al Mushab', '7A', 'Tanpa Keterangan'),
(41, 1, 46, 47, 'Yusup Supriatna', '7A', 'Tanpa Keterangan');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun` int(11) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun`, `tahun_ajaran`, `semester`, `status`) VALUES
(1, '2023/2024', 'Ganjil', 'Aktif'),
(2, '2023/2024', 'Genap', 'Aktif'),
(3, '2024/2025', 'Ganjil', 'Aktif'),
(4, '2024/2025', 'Genap', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp(),
  `foto` text NOT NULL DEFAULT 'default.png',
  `role` enum('admin','guru') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `password`, `tanggal_input`, `foto`, `role`) VALUES
(3, 'Alvin Austin', 'wandesay85@gmail.com', '$2y$10$a8S6lpn2MjtysKCoiJS04uB67hOOnibqySDnJXJ35hbAIjeFCfon6', '2023-08-05', 'download.jpg', 'guru'),
(9, 'Muhammad Karifal', 'karifal@gmail.com', '$2y$10$B2H.BWI765ZlWXNUFgAYB.jMRpv6eB907FYS3ikUtzPchUmab.dvu', '2023-08-09', '800px-Gubernur_Anies2.jpg', 'guru'),
(10, 'Devi Anggraeni Saputri', 'devias@gmail.com', '$2y$10$TACm/YfNwE2wG59RjTb2DujX6YlD7EI1lYuYYr10M5F2ZFK6u6uIO', '2023-08-09', 'Depi2.jpeg', 'admin'),
(11, 'Alvin Austin', 'alvin.austin4@gmail.com', '$2y$10$Z4i94diftYUS7w8Ab.wyMOkOv9xcRwi25KNHRZM8JNk30E2WWPiia', '2023-08-09', 'IMG_20230719_1858492.jpg', 'admin'),
(12, 'Ahmad Maulana', 'xhara118@gmail.com', '$2y$10$UsPITKSKHuOSUBVWXsfR5e/WFyp3f0TRSOcshS9WEJwWQLtBd/B9O', '2023-08-14', 'Survei_-_Survei_Sekolah.png', 'guru');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_absen`
--
ALTER TABLE `data_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `murid`
--
ALTER TABLE `murid`
  ADD PRIMARY KEY (`id_murid`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `submit_absen`
--
ALTER TABLE `submit_absen`
  ADD PRIMARY KEY (`id_submit`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_absen`
--
ALTER TABLE `data_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `murid`
--
ALTER TABLE `murid`
  MODIFY `id_murid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `submit_absen`
--
ALTER TABLE `submit_absen`
  MODIFY `id_submit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
