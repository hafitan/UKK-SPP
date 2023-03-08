-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 10:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikomhafitan`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kompetensi_keahlian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`, `kompetensi_keahlian`, `created_at`, `updated_at`) VALUES
(1, 'XII RPL', 'Rekayasa Perangkat Lunak', '2023-03-07 19:52:51', '2023-03-07 19:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_03_03_080649_create_siswa_table', 1),
(6, '2023_03_03_080714_create_pembayaran_table', 1),
(7, '2023_03_03_080733_create_kelas_table', 1),
(8, '2023_03_04_034414_create_petugas_table', 1),
(9, '2023_03_04_034429_create_spp_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bulan_dibayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_dibayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `kembali` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_petugas`, `nisn`, `tanggal_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `kembali`, `created_at`, `updated_at`) VALUES
(1, 6, '12938923', '2023-03-08', 'juli', '2020', 2, 100000, NULL, '2023-03-08 00:19:43', '2023-03-08 00:19:43'),
(2, 6, '12938923', '2023-03-08', 'agustus', '2020', 2, 100000, NULL, '2023-03-08 00:19:44', '2023-03-08 00:19:44'),
(3, 6, '12938923', '2023-03-08', 'september', '2020', 2, 100000, NULL, '2023-03-08 00:19:44', '2023-03-08 00:19:44'),
(4, 6, '12938923', '2023-03-08', 'oktober', '2020', 2, 100000, NULL, '2023-03-08 00:19:44', '2023-03-08 00:19:44'),
(5, 6, '12938923', '2023-03-08', 'november', '2020', 2, 100000, NULL, '2023-03-08 00:19:44', '2023-03-08 00:19:44'),
(6, 6, '12938923', '2023-03-08', 'desember', '2020', 2, 100000, NULL, '2023-03-08 00:20:10', '2023-03-08 00:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_petugas` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','petugas','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `email`, `password`, `nama_petugas`, `level`, `created_at`, `updated_at`) VALUES
(1, 'webowo', 'webowo@gmail.com', '$2y$10$4xDfa7AA7AwxrI4b183.GuMp2rtE0JHKxIq..7eGcNB/LUKiXev3G', 'wibowo', 'petugas', '2023-03-07 20:22:03', '2023-03-07 20:22:03'),
(3, 'robet', 'robert@gmail.com', '$2y$10$UFKPxL5lUTM/hzLHXDJZJ.f30FwIxZDFTnesOf1m5P9N73u0ZP15G', 'robert', 'petugas', '2023-03-07 20:29:10', '2023-03-07 20:30:25'),
(6, 'hafitan', 'admin@gmail.com', '$2y$10$JHFrO913sM4CfA6niFNiSu7ntp9BbiGAQpiau2dbPUuXHm7cUwb1G', 'hafitan', 'admin', '2023-03-07 21:37:34', '2023-03-07 21:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_spp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nisn`, `nis`, `nama`, `email`, `id_kelas`, `alamat`, `no_telp`, `id_spp`, `created_at`, `updated_at`) VALUES
(1, '12938923', '12000687', 'Muhamad Anval Hafitansyah', '12000687@gmail.com', 1, 'kp.peundeuy', '08381927329', 2, '2023-03-07 21:20:16', '2023-03-07 21:25:44'),
(2, '12331236', '12000328', 'alberto robert', '12000328@gmail.com', 1, 'kambangan', '08342098', 2, '2023-03-07 23:16:50', '2023-03-08 02:29:51'),
(3, '120821939', '12000666', 'mada dwi', '12000666', 1, 'ciawi', '0823882', 2, '2023-03-08 02:30:25', '2023-03-08 02:30:25'),
(4, '1323451221', '12000688', 'abi naufal', '12000688@gmail.com', 1, 'cipayung', '0832487283', 2, '2023-03-08 02:31:44', '2023-03-08 02:31:44'),
(5, '123987872', '12000689', 'umar wibowo', '12000689@gmail.com', 1, 'citapen', '084294267', 2, '2023-03-08 02:37:06', '2023-03-08 02:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id`, `tahun`, `nominal`, `created_at`, `updated_at`) VALUES
(2, 20202022, 100000, '2023-03-07 19:40:14', '2023-03-07 19:40:14'),
(3, 20212023, 200000, '2023-03-07 19:40:28', '2023-03-07 19:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','petugas','siswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'hafitan', 'admin@gmail.com', '$2y$10$b/QxvhSotIL4qTnhwY4U5O3cOfL034YrKGAoqPoo.lwH2bPjNb8Ji', 'admin', NULL, '2023-03-07 18:56:42', '2023-03-07 18:56:42'),
(2, 'webowo', 'webowo@gmail.com', '$2y$10$tu2jD8I/gbxyCxJMpKabRucn7yw773vQXQBHCKoIU7XcPUZry55pq', 'petugas', NULL, '2023-03-07 20:22:03', '2023-03-07 20:22:03'),
(6, 'robet', 'robert@gmail.com', '$2y$10$9cuwHr7/qoWg7oX8YBgfm.nc0gTtIQLYtsxX5lFfq9u7kGwBeGFtW', 'petugas', NULL, '2023-03-07 20:29:31', '2023-03-07 20:30:25'),
(7, 'Muhamad Anval Hafitansyah', '12000687@gmail.com', '$2y$10$TJ6H88ufqp2iAtQWYjHzHeyyO9nZzrjESuyHTLpUIkv.wIyfrQyx.', 'siswa', NULL, '2023-03-07 21:20:16', '2023-03-07 21:20:16'),
(8, 'albret', '12000328@gmail.com', '$2y$10$JNR5r5oJlLiangxeV3lccOwvidYH.FIzGtLvmeco5IVoV5jOrRIC.', 'siswa', NULL, '2023-03-07 23:16:50', '2023-03-07 23:16:50'),
(9, 'mada dwi', '12000666@gmail.com', '$2y$10$9HZci8TAu3eNd2.VvJCx9.sNWgaiX2u7m1ZG2WTvmZNahiej2gyQm', 'siswa', NULL, '2023-03-08 02:30:25', '2023-03-08 02:30:25'),
(10, 'abi naufal', '12000688@gmail.com', '$2y$10$FWZV7tn2WV.O0M8MiWX5iu2bQmWn1HUred3AI7xbucrWDxSJNUoC2', 'siswa', NULL, '2023-03-08 02:31:44', '2023-03-08 02:31:44'),
(11, 'umar wibowo', '12000689@gmail.com', '$2y$10$F1hfaVp7gfYPA.jKEz/qIOieCU3XWyhL3n1gE4YNyjknbLqeR2lTa', 'siswa', NULL, '2023-03-08 02:37:07', '2023-03-08 02:37:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_nisn_unique` (`nisn`),
  ADD UNIQUE KEY `siswa_nis_unique` (`nis`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
