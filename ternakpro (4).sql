-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2025 at 12:43 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ternakpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `id_kandang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_aktivitas_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `status` enum('on schedule','on process','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on schedule',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `id_kandang`, `jenis_aktivitas_id`, `tanggal`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(5, 'KD-A01', 1, '2025-08-29', 'vaksin cacar', 'completed', '2025-08-27 20:28:35', '2025-09-04 00:11:08'),
(10, 'KD-A01', 1, '2025-08-28', 'vaksin hjc', 'completed', '2025-08-28 09:53:49', '2025-08-28 09:54:23'),
(16, 'KD-A01', 2, '2025-09-25', 'memandikan ternak', 'completed', '2025-09-25 01:50:56', '2025-09-25 01:51:43'),
(20, 'KD-C01', 2, '2025-11-29', 'cukur bulu domba', 'completed', '2025-11-28 21:23:29', '2025-11-28 21:23:45'),
(21, 'KD-C01', 1, '2025-12-06', 'vaksin booster', 'on schedule', '2025-11-28 21:24:26', '2025-11-28 21:24:26'),
(22, 'KD-A01', 3, '2025-11-29', 'cek kondisi kambing', 'on process', '2025-11-28 21:28:30', '2025-11-28 21:28:47'),
(23, 'KD-A01', 2, '2025-12-06', 'perawatan kaki kambing', 'completed', '2025-12-06 04:48:01', '2025-12-06 04:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas_ternak`
--

CREATE TABLE `aktivitas_ternak` (
  `id` bigint UNSIGNED NOT NULL,
  `aktivitas_id` bigint UNSIGNED NOT NULL,
  `id_ternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ada` enum('ada','tidak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ada',
  `kondisi` enum('sehat','sakit','lainnya','dijual','mati') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sehat',
  `status_detail` enum('sudah','belum') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aktivitas_ternak`
--

INSERT INTO `aktivitas_ternak` (`id`, `aktivitas_id`, `id_ternak`, `ada`, `kondisi`, `status_detail`, `keterangan`, `created_at`, `updated_at`) VALUES
(16, 23, 'KMB001', 'tidak', 'dijual', 'belum', 'dijual', '2025-12-06 04:48:31', '2025-12-06 04:48:31'),
(17, 23, 'KMB002', 'ada', 'sehat', 'sudah', NULL, '2025-12-06 04:48:32', '2025-12-06 04:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_aktivitas`
--

CREATE TABLE `jenis_aktivitas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_aktivitas`
--

INSERT INTO `jenis_aktivitas` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Vaksin', 'Pemberian vaksin ke ternak', '2025-08-15 01:19:52', '2025-08-15 01:19:52'),
(2, 'Perawatan', 'Perawatan wajib ternak', '2025-08-20 08:14:27', '2025-08-20 08:14:27'),
(3, 'Stock opname bulanan', 'Mengecek jumlah ternak, mengecek kondisi ternak', '2025-08-20 21:02:48', '2025-08-20 21:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kandang`
--

CREATE TABLE `kandang` (
  `id_kandang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penanggung_jawab` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_ternak` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kandang`
--

INSERT INTO `kandang` (`id_kandang`, `nama`, `lokasi`, `penanggung_jawab`, `jenis_ternak`, `created_at`, `updated_at`) VALUES
('KD-A01', 'Kandang A', 'Desa Wanatirta', 'Novi', 'Kambing', '2025-08-13 23:26:44', '2025-08-20 21:33:13'),
('KD-C01', 'Kandang C', 'Banjarnegara', 'Robi', 'Domba', '2025-11-28 20:17:09', '2025-11-28 20:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_ternak`
--

CREATE TABLE `kategori_ternak` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_ternak`
--

INSERT INTO `kategori_ternak` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Kambing', '2025-08-13 22:13:06', '2025-08-13 23:24:22'),
(5, 'Domba', '2025-09-28 19:56:28', '2025-09-28 19:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_08_05_033613_add_job_and_phone_to_users_table', 2),
(5, '2025_08_05_034129_create_ternak_table', 2),
(6, '2025_08_05_034150_create_aktivitas_table', 2),
(7, '2025_08_05_034209_create_laporan_table', 2),
(8, '2025_08_05_085507_add_photo_to_users_table', 3),
(9, '2025_08_12_043507_create_ternak_table', 4),
(11, '2025_08_12_064633_add_kategori_lokasi_to_ternak_table', 5),
(12, '2025_08_12_091143_create_pemasok_table', 1),
(13, '2025_08_13_135816_create_kandang_table', 6),
(14, '2025_08_13_170022_create_kategori_ternak_table', 7),
(15, '2025_08_14_024611_create_kategori_ternak_table', 8),
(16, '2025_08_15_055944_create_jenis_aktivitas_table', 9),
(17, '2025_08_15_084947_create_aktivitas_table', 10),
(18, '2025_08_25_092511_create_aktivitas_table', 11),
(19, '2025_08_25_093550_create_aktivitas_table', 12),
(20, '2025_08_26_051615_create_aktivitas_table', 13),
(21, '2025_08_26_051734_create_aktivitas_ternak_table', 14),
(22, '2025_09_02_062604_create_mitra_table', 15),
(23, '2025_09_02_062826_create_pelanggan_table', 16),
(24, '2025_09_02_091704_create_penjualan_ternak_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id`, `nama`, `alamat`, `telepon`, `email`, `hubungan`, `created_at`, `updated_at`) VALUES
(1, 'Dinda', 'Purbalingga', '087890871230', 'dinda80@gmail.com', 'Pihak Berelasi', '2025-09-01 23:37:17', '2025-09-02 01:53:00'),
(3, 'Gito', 'Bandung', '088890709345', 'gito@gmail.com', 'Pihak Berelasi', '2025-09-03 01:30:02', '2025-09-03 01:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telepon`, `email`, `hubungan`, `created_at`, `updated_at`) VALUES
(1, 'Hafiz', 'Jakarta', '087816330987', 'hfzd@gmail.com', 'Pihak Berelasi', '2025-09-02 01:55:14', '2025-09-02 01:55:30'),
(2, 'Rina', 'Jakarta', '085000781230', 'rina@gmail.com', 'Pihak Ketiga', '2025-09-25 01:54:59', '2025-09-25 01:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id`, `nama`, `alamat`, `telepon`, `email`, `hubungan`, `created_at`, `updated_at`) VALUES
(1, 'Rey', 'Purbalingga', '087890871230', 'reym80@gmail.com', 'Pihak Ketiga', '2025-08-13 06:05:10', '2025-09-01 21:06:07'),
(2, 'Nisa', 'Cilacap', '088097653456', 'nisa45@gmail.com', 'Pihak Berelasi', '2025-08-12 23:14:00', '2025-09-01 21:05:20'),
(4, 'Nisa', 'Sirampog', '088890709345', 'nisa45@gmail.com', 'Pihak Ketiga', '2025-08-12 23:17:10', '2025-09-01 21:02:43'),
(5, 'Nurul', 'Brebes', '087816330987', 'uyung12@gmail.com', 'Pihak Ketiga', '2025-08-13 00:29:45', '2025-09-01 21:02:12'),
(6, 'Fahri', 'Karanglewas', '085800781231', 'fahri3@gmail.com', 'Pihak Berelasi', '2025-08-20 21:30:53', '2025-09-01 21:01:27'),
(7, 'Retno', 'Jakarta', '085000781230', 'retno@gmail.com', 'Pihak Berelasi', '2025-09-01 20:59:30', '2025-09-01 20:59:30'),
(11, 'Fahri', 'Karanglewas', '085800781231', NULL, 'Pihak Berelasi', '2025-11-28 21:35:34', '2025-11-28 21:35:34'),
(12, 'Nisa', 'Cilacap', '088097653456', NULL, 'Pihak Berelasi', '2025-11-28 22:13:58', '2025-11-28 22:13:58'),
(13, 'Retno', 'Jakarta', '085000781230', NULL, 'Pihak Berelasi', '2025-11-28 22:18:20', '2025-11-28 22:18:20'),
(14, 'Fahri', 'Karanglewas', '085800781231', NULL, 'Pihak Berelasi', '2025-12-02 01:30:22', '2025-12-02 01:30:22'),
(15, 'Fahri', 'Karanglewas', '085800781231', NULL, 'Pihak Berelasi', '2025-12-06 04:40:20', '2025-12-06 04:40:20'),
(16, 'Retno', 'Jakarta', '085000781230', NULL, 'Pihak Berelasi', '2025-12-06 04:43:09', '2025-12-06 04:43:09'),
(17, 'Nurul', 'Brebes', '087816330987', NULL, 'Pihak Ketiga', '2025-12-06 04:44:22', '2025-12-06 04:44:22'),
(18, 'Retno', 'Jakarta', '085000781230', NULL, 'Pihak Berelasi', '2025-12-06 04:51:24', '2025-12-06 04:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_ternak`
--

CREATE TABLE `penjualan_ternak` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `id_ternak` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pelanggan` bigint UNSIGNED NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan_ternak`
--

INSERT INTO `penjualan_ternak` (`id`, `tanggal`, `id_ternak`, `id_pelanggan`, `harga_jual`, `created_at`, `updated_at`) VALUES
(6, '2025-12-06', 'KMB001', 1, 4000000, '2025-12-06 04:45:47', '2025-12-06 04:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('H8xj3zIezzGy4MtJ4qHENnKdBMuG6AcQ7x0lXQqr', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiakF5TmFka1g4MVNkQmFtZDhlb1VsQmo3NVA2V2Nya3M3S0RGMlpmOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZXJuYWsiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765023386);

-- --------------------------------------------------------

--
-- Table structure for table `ternak`
--

CREATE TABLE `ternak` (
  `id_ternak` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `umur` int NOT NULL DEFAULT '0',
  `jenis_kelamin` enum('Jantan','Betina') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` decimal(12,2) NOT NULL DEFAULT '0.00',
  `kondisi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaksinasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cek_medis_terakhir` date DEFAULT NULL,
  `pemasok_id` bigint UNSIGNED DEFAULT NULL,
  `penanggung_jawab` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_masuk` date NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ternak`
--

INSERT INTO `ternak` (`id_ternak`, `kategori`, `jenis`, `umur`, `jenis_kelamin`, `lokasi`, `harga_beli`, `kondisi`, `vaksinasi`, `cek_medis_terakhir`, `pemasok_id`, `penanggung_jawab`, `tanggal_masuk`, `foto`, `created_at`, `updated_at`) VALUES
('DMB001', 'Domba', 'Domba Garut', 3, 'Jantan', 'Kandang C', '300000.00', 'Sehat', 'Vaksin Cacar', '2025-12-06', 15, 'PT', '2025-12-06', 'foto_ternak/qdPru7YlT6tZR1Pb82DJlN3O5tNbmNXsycwdmCFI.png', '2025-12-06 04:40:20', '2025-12-06 04:40:20'),
('DMB003', 'Domba', 'Domba merino', 1, 'Jantan', 'Kandang C', '300000.00', 'Sehat', 'Vaksin Cacar', '2025-12-02', 14, 'PT', '2025-12-02', 'foto_ternak/Xmeuw6lrN40F9lYf2ER5PVkuugaBJP3h6ET0t96v.png', '2025-12-02 01:30:23', '2025-12-02 01:30:23'),
('KMB001', 'Kambing', 'Kambing Etawa', 4, 'Jantan', 'Kandang A', '400000.00', 'Sehat', 'Rabies', '2025-12-06', 16, 'PT', '2025-12-06', 'foto_ternak/1RqpRa2b0WDos1uXLFYpezgJXn7fThvn8vRljmhI.jpg', '2025-12-06 04:43:10', '2025-12-06 04:43:10'),
('KMB002', 'Kambing', 'Kambing jawa', 3, 'Betina', 'Kandang A', '400000.00', 'Sehat', 'Rabies', '2025-12-06', 17, 'mitra-1', '2025-12-06', 'foto_ternak/VNeN6f293QrZX2MG3FD9S6BOtnqznirn0m96rIVx.jpg', '2025-12-06 04:44:22', '2025-12-06 04:44:22'),
('KMB003', 'Kambing', 'Kambing Biasa', 3, 'Betina', 'Kandang A', '200000.00', 'Sehat', 'Vaksin Cacar', '2025-12-06', 18, 'PT', '2025-12-06', 'foto_ternak/w43tbGSFM97WpQPg9sviJP40Bjx8ZxECGO6TCP1Q.jpg', '2025-12-06 04:51:24', '2025-12-06 04:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `job` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `job`, `telepon`, `foto`, `email_verified_at`, `password`, `remember_token`, `last_login_at`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Retno M', 'retno4@gmail.com', 'peternak', '087890871230', 'profile/aK0LamwnjWfnlLNt4DG4remJ8DMa9jesH3GiosW7.jpg', NULL, '$2y$12$QxOQm8Jw.4LHS/FANaRIX.SEL.CDvNTMsEV0cTBxsfbO7UgGCsibG', NULL, '2025-12-06 05:10:06', '2025-08-04 20:09:44', '2025-12-06 05:10:06', 'user'),
(2, 'Admin', 'admin1122@gmail.com', 'Admin', '087816330987', NULL, NULL, '$2y$12$pFRATq6HqRtbWeMYrbitlumSanYJaczctahP1lzyun6QQ42.xH4YK', NULL, '2025-12-06 05:09:00', '2025-09-09 22:07:24', '2025-12-06 05:09:00', 'admin'),
(3, 'wildan m', 'wildan@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$8g.or3xe9F/L.19Bkg8cmeauAa6L3PFanQJ83Fc2ZkA1q7sQO.RtS', NULL, '2025-09-29 00:55:10', '2025-09-29 00:26:30', '2025-09-29 00:55:10', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aktivitas_id_kandang_foreign` (`id_kandang`),
  ADD KEY `aktivitas_jenis_aktivitas_id_foreign` (`jenis_aktivitas_id`);

--
-- Indexes for table `aktivitas_ternak`
--
ALTER TABLE `aktivitas_ternak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aktivitas_ternak_aktivitas_id_foreign` (`aktivitas_id`),
  ADD KEY `aktivitas_ternak_id_ternak_foreign` (`id_ternak`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_aktivitas`
--
ALTER TABLE `jenis_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kandang`
--
ALTER TABLE `kandang`
  ADD PRIMARY KEY (`id_kandang`);

--
-- Indexes for table `kategori_ternak`
--
ALTER TABLE `kategori_ternak`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_ternak_nama_unique` (`nama`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_ternak`
--
ALTER TABLE `penjualan_ternak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_ternak_id_ternak_foreign` (`id_ternak`),
  ADD KEY `penjualan_ternak_id_pelanggan_foreign` (`id_pelanggan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ternak`
--
ALTER TABLE `ternak`
  ADD PRIMARY KEY (`id_ternak`),
  ADD KEY `ternak_pemasok_id_foreign` (`pemasok_id`);

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
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `aktivitas_ternak`
--
ALTER TABLE `aktivitas_ternak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_aktivitas`
--
ALTER TABLE `jenis_aktivitas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_ternak`
--
ALTER TABLE `kategori_ternak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penjualan_ternak`
--
ALTER TABLE `penjualan_ternak`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD CONSTRAINT `aktivitas_id_kandang_foreign` FOREIGN KEY (`id_kandang`) REFERENCES `kandang` (`id_kandang`) ON DELETE CASCADE,
  ADD CONSTRAINT `aktivitas_jenis_aktivitas_id_foreign` FOREIGN KEY (`jenis_aktivitas_id`) REFERENCES `jenis_aktivitas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aktivitas_ternak`
--
ALTER TABLE `aktivitas_ternak`
  ADD CONSTRAINT `aktivitas_ternak_aktivitas_id_foreign` FOREIGN KEY (`aktivitas_id`) REFERENCES `aktivitas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aktivitas_ternak_id_ternak_foreign` FOREIGN KEY (`id_ternak`) REFERENCES `ternak` (`id_ternak`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan_ternak`
--
ALTER TABLE `penjualan_ternak`
  ADD CONSTRAINT `penjualan_ternak_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ternak`
--
ALTER TABLE `ternak`
  ADD CONSTRAINT `ternak_pemasok_id_foreign` FOREIGN KEY (`pemasok_id`) REFERENCES `pemasok` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
