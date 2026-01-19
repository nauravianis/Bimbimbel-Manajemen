-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2026 at 02:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimbimbel`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `jadwal_id` bigint UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status` enum('hadir','terlambat','tidak_hadir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hadir',
  `status_bayar` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id`, `guru_id`, `jadwal_id`, `tanggal`, `jam_masuk`, `jam_keluar`, `status`, `status_bayar`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2026-01-18', '20:28:09', '22:28:26', 'hadir', 1, '2026-01-18 13:28:09', '2026-01-18 13:37:55'),
(2, 1, NULL, '2026-01-19', '07:27:49', '09:28:58', 'hadir', 0, '2026-01-19 00:27:49', '2026-01-19 00:27:49'),
(3, 2, NULL, '2026-01-19', '07:28:04', '09:29:54', 'hadir', 1, '2026-01-19 00:28:04', '2026-01-19 01:14:14'),
(4, 3, NULL, '2026-01-19', '07:28:19', '09:29:54', 'hadir', 0, '2026-01-19 00:28:19', '2026-01-19 00:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_siswas`
--

CREATE TABLE `absensi_siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `jadwal_mengajar_id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Hadir','Izin','Sakit','Alfa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hadir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensi_siswas`
--

INSERT INTO `absensi_siswas` (`id`, `jadwal_mengajar_id`, `siswa_id`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 3, '2026-01-18', 'Hadir', '2026-01-18 13:50:05', '2026-01-18 13:50:05'),
(2, 14, 1, '2026-01-19', 'Hadir', '2026-01-19 01:13:45', '2026-01-19 01:13:45'),
(3, 14, 8, '2026-01-19', 'Hadir', '2026-01-19 01:13:45', '2026-01-19 01:13:45'),
(4, 14, 13, '2026-01-19', 'Hadir', '2026-01-19 01:13:45', '2026-01-19 01:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `nominal` int NOT NULL,
  `jumlah_jam` int NOT NULL,
  `total_gaji` int NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id`, `guru_id`, `nominal`, `jumlah_jam`, `total_gaji`, `tanggal`, `bulan`, `tahun`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 50001, 3, 150003, '2026-01-18', 'January', 2026, NULL, '2026-01-18 13:37:55', '2026-01-18 13:37:55'),
(2, 2, 150000, 3, 450000, '2026-01-19', 'January', 2026, NULL, '2026-01-19 01:14:14', '2026-01-19 01:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif_per_jam` int NOT NULL DEFAULT '50000',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `tarif_per_jam`, `email`, `nomor_telp`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `qr_token`, `created_at`, `updated_at`) VALUES
(1, 'Naura  Okta Vianis', 100000, 'nauraokt@gmail.com', '0838675479233', '2004-10-26', 'Perempuan', 'Puri', 'x8QB7jBAO1TsiqulkPa3RcSafrkt7WKx5BqLf2m7FkibLUpZcM', '2026-01-18 10:42:22', '2026-01-19 01:02:24'),
(2, 'Daniel Firmansyah', 150000, 'dandaniel@gmail.com', '0838675479233', '2004-07-10', 'Laki-laki', 'Sooko', 'gZq7WxsRBH4SdhczT9pkfT5RI0eheYJQsC5pspuUtZtXELJthP', '2026-01-18 10:43:47', '2026-01-19 01:14:06'),
(3, 'Devano Putra', 100000, 'nauravianis@gmail.com', '0838675479233', '2004-07-10', 'Laki-laki', 'Sooko', 'zJqGGj6eXGtI5bugQw84Nm6WBgswLhULBXAXNHClUGXZtYpljc', '2026-01-18 10:44:42', '2026-01-19 01:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_bimbel`
--

CREATE TABLE `jadwal_bimbel` (
  `id` bigint UNSIGNED NOT NULL,
  `paket_siswa_id` bigint UNSIGNED NOT NULL,
  `jadwal_mengajar_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Terjadwal','Selesai','Batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Terjadwal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id` bigint UNSIGNED NOT NULL,
  `guru_id` bigint UNSIGNED NOT NULL,
  `mapel_id` bigint UNSIGNED NOT NULL,
  `paket_bimbel_id` bigint UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id`, `guru_id`, `mapel_id`, `paket_bimbel_id`, `hari`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Selasa', '15:30:00', '17:30:00', '2026-01-18 10:47:07', '2026-01-18 10:53:47'),
(2, 2, 2, 2, 'Selasa', '18:15:00', '20:15:00', '2026-01-18 10:48:26', '2026-01-18 10:53:57'),
(3, 3, 3, 7, 'Selasa', '18:30:00', '20:30:00', '2026-01-18 10:49:30', '2026-01-18 10:54:07'),
(4, 1, 1, 1, 'Rabu', '15:30:00', '17:30:00', '2026-01-18 10:55:05', '2026-01-18 10:55:05'),
(5, 2, 2, 2, 'Rabu', '18:15:00', '20:15:00', '2026-01-18 10:55:55', '2026-01-18 10:55:55'),
(6, 3, 3, 7, 'Rabu', '18:30:00', '20:30:00', '2026-01-18 10:56:42', '2026-01-18 10:56:42'),
(7, 1, 1, 1, 'Kamis', '15:30:00', '17:30:00', '2026-01-18 10:57:56', '2026-01-18 10:57:56'),
(8, 2, 2, 2, 'Kamis', '18:15:00', '20:15:00', '2026-01-18 10:58:49', '2026-01-18 10:58:49'),
(9, 3, 3, 7, 'Kamis', '18:30:00', '20:30:00', '2026-01-18 10:59:40', '2026-01-18 10:59:40'),
(10, 1, 1, 1, 'Jumat', '15:15:00', '17:15:00', '2026-01-18 11:00:55', '2026-01-18 11:00:55'),
(11, 2, 2, 2, 'Jumat', '18:15:00', '20:15:00', '2026-01-18 11:01:39', '2026-01-18 11:01:39'),
(12, 1, 4, 8, 'Sabtu', '09:00:00', '13:00:00', '2026-01-18 11:12:19', '2026-01-18 11:12:19'),
(13, 3, 4, 8, 'Minggu', '12:00:00', '16:00:00', '2026-01-18 11:13:04', '2026-01-18 11:13:04'),
(14, 1, 1, 1, 'Senin', '08:00:00', '10:00:00', '2026-01-19 01:13:21', '2026-01-19 01:13:21');

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
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `nama_mapel`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Inggris Pemula', NULL, NULL),
(2, 'Bahasa Inggris Menengah', NULL, NULL),
(3, 'Bahasa Inggris Lanjutan', NULL, NULL),
(4, 'Bahasa Inggris Umum', NULL, NULL);

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
(4, '2025_11_21_102307_create_paket_bimbel_table', 1),
(5, '2025_11_22_052628_create_admin_table', 1),
(6, '2025_11_22_052717_create_guru_table', 1),
(7, '2025_11_22_052726_create_siswa_table', 1),
(8, '2025_11_22_052753_create_mapel_table', 1),
(9, '2025_11_22_052800_create_jadwal_mengajar_table', 1),
(10, '2025_11_22_052818_create_gaji_table', 1),
(11, '2026_01_07_112218_create_pemasukans_table', 1),
(12, '2026_01_07_112319_create_pengeluarans_table', 1),
(13, '2026_01_07_133709_create_transaksi_table', 1),
(14, '2026_01_07_141351_create_absensi_guru_table', 1),
(15, '2026_01_09_093855_create_pembayaran_siswa_table', 1),
(16, '2026_01_09_102645_create_paket_siswa_table', 1),
(17, '2026_01_09_102748_create_jadwal_bimbel_table', 1),
(18, '2026_01_10_160612_change_default_status_siswa', 1),
(19, '2026_01_11_092354_fix_absensi_table', 1),
(20, '2026_01_14_202727_create_absensi_siswas_table', 1),
(21, '2026_01_14_210323_change_status_in_paket_siswa_table', 1),
(22, '2026_01_16_093726_update_gaji_table', 1),
(23, '2026_01_16_102105_add_tarif_to_guru_table', 1),
(24, '2026_01_16_110725_add_status_bayar_to_absensi_guru', 1),
(25, '2026_01_18_200158_absensi', 2),
(26, '2025_11_22_200328_absensi_guru', 3),
(27, '2026_01_18_201220_absensi_guru', 4),
(28, '2025_11_22_201220_absensi_guru', 5),
(29, '2026_01_18_201404_gaji', 6),
(30, '2025_11_22_201404_gaji', 7);

-- --------------------------------------------------------

--
-- Table structure for table `paket_bimbel`
--

CREATE TABLE `paket_bimbel` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_paket` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('Pemula','Menengah','Lanjutan','Umum') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Umum',
  `jumlah_pertemuan` int NOT NULL,
  `harga` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_bimbel`
--

INSERT INTO `paket_bimbel` (`id`, `nama_paket`, `level`, `jumlah_pertemuan`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'Bahasa Inggris Pemula - 6 bulan', 'Pemula', 72, 1200000, NULL, NULL),
(2, 'Bahasa Inggris Menengah - 6 bulan', 'Menengah', 72, 1400000, NULL, NULL),
(7, 'Bahasa Inggris Lanjutan - 6 Bulan', 'Lanjutan', 72, 1500000, NULL, NULL),
(8, 'Bahasa Inggris Umum - 6 Bulan', 'Umum', 32, 1500000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paket_siswa`
--

CREATE TABLE `paket_siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `paket_bimbel_id` bigint UNSIGNED NOT NULL,
  `transaksi_id` bigint UNSIGNED NOT NULL,
  `sisa_pertemuan` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paket_siswa`
--

INSERT INTO `paket_siswa` (`id`, `siswa_id`, `paket_bimbel_id`, `transaksi_id`, `sisa_pertemuan`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1, 72, 'aktif', '2026-01-18 13:36:26', '2026-01-18 13:36:26'),
(2, 3, 8, 2, 31, 'aktif', '2026-01-18 13:49:40', '2026-01-18 13:50:05'),
(3, 1, 1, 3, 71, 'aktif', '2026-01-19 00:48:49', '2026-01-19 01:13:45'),
(4, 7, 2, 4, 72, 'aktif', '2026-01-19 00:49:35', '2026-01-19 00:49:35'),
(5, 4, 7, 5, 72, 'aktif', '2026-01-19 00:54:22', '2026-01-19 00:54:22'),
(6, 8, 1, 6, 71, 'aktif', '2026-01-19 00:54:42', '2026-01-19 01:13:45'),
(7, 6, 2, 7, 72, 'aktif', '2026-01-19 00:54:57', '2026-01-19 00:54:57'),
(8, 11, 7, 8, 72, 'aktif', '2026-01-19 00:55:12', '2026-01-19 00:55:12'),
(9, 12, 2, 9, 72, 'aktif', '2026-01-19 00:55:29', '2026-01-19 00:55:29'),
(10, 18, 7, 10, 72, 'aktif', '2026-01-19 00:55:51', '2026-01-19 00:55:51'),
(11, 16, 8, 11, 32, 'aktif', '2026-01-19 00:56:14', '2026-01-19 00:56:14'),
(12, 13, 1, 12, 71, 'aktif', '2026-01-19 00:56:29', '2026-01-19 01:13:45'),
(13, 10, 2, 13, 72, 'aktif', '2026-01-19 00:56:42', '2026-01-19 00:56:42'),
(14, 14, 8, 14, 32, 'aktif', '2026-01-19 00:57:18', '2026-01-19 00:57:18'),
(15, 15, 7, 15, 72, 'aktif', '2026-01-19 00:57:33', '2026-01-19 00:57:33'),
(16, 17, 2, 16, 72, 'aktif', '2026-01-19 00:57:46', '2026-01-19 00:57:46'),
(17, 19, 8, 17, 32, 'aktif', '2026-01-19 00:59:05', '2026-01-19 00:59:05'),
(18, 9, 7, 18, 72, 'aktif', '2026-01-19 00:59:33', '2026-01-19 00:59:33');

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
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `siswa_id`, `tanggal`, `jumlah`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, '2026-01-18', 1400000, 'Pembayaran Paket: Bahasa Inggris Menengah - 6 bulan', '2026-01-18 13:36:26', '2026-01-18 13:36:26'),
(2, 3, '2026-01-18', 1500000, 'Pembayaran Paket: Bahasa Inggris Umum - 6 Bulan', '2026-01-18 13:49:40', '2026-01-18 13:49:40'),
(3, 1, '2026-01-19', 1200000, 'Pembayaran Paket: Bahasa Inggris Pemula - 6 bulan', '2026-01-19 00:48:49', '2026-01-19 00:48:49'),
(4, 7, '2026-01-19', 1400000, 'Pembayaran Paket: Bahasa Inggris Menengah - 6 bulan', '2026-01-19 00:49:35', '2026-01-19 00:49:35'),
(5, 4, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Lanjutan - 6 Bulan', '2026-01-19 00:54:22', '2026-01-19 00:54:22'),
(6, 8, '2026-01-19', 1200000, 'Pembayaran Paket: Bahasa Inggris Pemula - 6 bulan', '2026-01-19 00:54:42', '2026-01-19 00:54:42'),
(7, 6, '2026-01-19', 1400000, 'Pembayaran Paket: Bahasa Inggris Menengah - 6 bulan', '2026-01-19 00:54:57', '2026-01-19 00:54:57'),
(8, 11, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Lanjutan - 6 Bulan', '2026-01-19 00:55:12', '2026-01-19 00:55:12'),
(9, 12, '2026-01-19', 1400000, 'Pembayaran Paket: Bahasa Inggris Menengah - 6 bulan', '2026-01-19 00:55:29', '2026-01-19 00:55:29'),
(10, 18, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Lanjutan - 6 Bulan', '2026-01-19 00:55:51', '2026-01-19 00:55:51'),
(11, 16, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Umum - 6 Bulan', '2026-01-19 00:56:14', '2026-01-19 00:56:14'),
(12, 13, '2026-01-19', 1200000, 'Pembayaran Paket: Bahasa Inggris Pemula - 6 bulan', '2026-01-19 00:56:29', '2026-01-19 00:56:29'),
(13, 10, '2026-01-19', 1400000, 'Pembayaran Paket: Bahasa Inggris Menengah - 6 bulan', '2026-01-19 00:56:42', '2026-01-19 00:56:42'),
(14, 14, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Umum - 6 Bulan', '2026-01-19 00:57:18', '2026-01-19 00:57:18'),
(15, 15, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Lanjutan - 6 Bulan', '2026-01-19 00:57:33', '2026-01-19 00:57:33'),
(16, 17, '2026-01-19', 1400000, 'Pembayaran Paket: Bahasa Inggris Menengah - 6 bulan', '2026-01-19 00:57:46', '2026-01-19 00:57:46'),
(17, 19, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Umum - 6 Bulan', '2026-01-19 00:59:05', '2026-01-19 00:59:05'),
(18, 9, '2026-01-19', 1500000, 'Pembayaran Paket: Bahasa Inggris Lanjutan - 6 Bulan', '2026-01-19 00:59:33', '2026-01-19 00:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_siswa`
--

CREATE TABLE `pembayaran_siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `jenis_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `tanggal` date NOT NULL,
  `metode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('IBcWk9cECLDKpVFDyBJyQXjG8EZd4cL0nkLTZvU5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36 Edg/144.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMXc2cUZRSEdLd0lKbVBWU2x0Y01xQWdsUmpiYWxpWnIybnRJb0V2dSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZXVhbmdhbi9yaXdheWF0IjtzOjU6InJvdXRlIjtzOjE2OiJrZXVhbmdhbi5yaXdheWF0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1768785271);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp_ortu` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `nama`, `sekolah`, `no_telp_ortu`, `tanggal_lahir`, `jk`, `alamat`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Damian', 'SD Pelita', '0838675479233', '2019-12-20', 'Laki-laki', 'kedung bendo gemekan sooko mojokerto', 'Aktif', '2026-01-18 10:40:17', '2026-01-19 00:48:49'),
(2, 'Nina Azalea', 'SMP Harapan', '0838675479233', '2010-08-12', 'Perempuan', 'kedung bendo gemekan sooko mojokerto', 'Aktif', '2026-01-18 10:40:57', '2026-01-18 13:36:26'),
(3, 'Naura Vianis', 'SMA Mentari', '083839568322', '2007-10-26', 'Perempuan', 'brangkal', 'Aktif', '2026-01-18 10:42:02', '2026-01-18 13:49:40'),
(4, 'Muhammad Al Fatih', 'SMA Mentari', '08657864566', '2007-12-05', 'Laki-laki', 'Sooko', 'Aktif', '2026-01-19 00:32:27', '2026-01-19 00:54:22'),
(5, 'Muhammad Rayyan', 'SD Pelita', '08764564366', '2019-09-11', 'Laki-laki', 'Sooko', 'Nonaktif', '2026-01-19 00:33:17', '2026-01-19 00:33:17'),
(6, 'Muhammad Rayyan', 'SD Pelita', '08764564366', '2019-09-11', 'Laki-laki', 'Sooko', 'Aktif', '2026-01-19 00:33:18', '2026-01-19 00:54:57'),
(7, 'Aqeela Mahendra', 'SMA Nusa', '08754567655', '2008-01-01', 'Perempuan', 'Puri', 'Aktif', '2026-01-19 00:34:10', '2026-01-19 00:49:35'),
(8, 'Vino Neonda', 'SDN 1 Mojokerto', '084565789655', '2020-08-12', 'Laki-laki', 'Meri', 'Aktif', '2026-01-19 00:35:11', '2026-01-19 00:54:42'),
(9, 'Seandero Alfero', 'SMP Pelita', '08657864566', '2012-10-20', 'Laki-laki', 'Sooko', 'Aktif', '2026-01-19 00:36:30', '2026-01-19 00:59:33'),
(10, 'Andreano', 'SMP Tunas', '08657864566', '2011-12-10', 'Laki-laki', 'Sooko', 'Aktif', '2026-01-19 00:37:40', '2026-01-19 00:56:42'),
(11, 'Kanina', 'SMP Tunas', '08657864566', '2011-10-12', 'Perempuan', 'Sooko', 'Aktif', '2026-01-19 00:38:48', '2026-01-19 00:55:12'),
(12, 'Nayla Najla', 'SMP Bangsa', '08657864566', '2011-09-12', 'Perempuan', 'Puri', 'Aktif', '2026-01-19 00:39:23', '2026-01-19 00:55:29'),
(13, 'Nafila Azzahra', 'SDN 2 Mojokerto', '08657864566', '2016-09-11', 'Perempuan', 'Puri', 'Aktif', '2026-01-19 00:41:12', '2026-01-19 00:56:29'),
(14, 'Ezardio', 'SMA Nusa', '086654668854', '2009-09-10', 'Laki-laki', 'Meri', 'Aktif', '2026-01-19 00:42:41', '2026-01-19 00:57:18'),
(15, 'Elfaza', 'SMA Mentari', '08657864566', '2009-06-12', 'Perempuan', 'Sooko', 'Aktif', '2026-01-19 00:43:11', '2026-01-19 00:57:33'),
(16, 'Fadhila', '-', '08765687543', '2005-06-09', 'Perempuan', 'Brangkal', 'Aktif', '2026-01-19 00:45:00', '2026-01-19 00:56:14'),
(17, 'Fifi anggraini', '-', '08764567877', '2004-07-12', 'Perempuan', 'Sooko', 'Aktif', '2026-01-19 00:45:48', '2026-01-19 00:57:46'),
(18, 'Diana Nur', '-', '08657864566', '2006-02-18', 'Perempuan', 'Sooko', 'Aktif', '2026-01-19 00:46:33', '2026-01-19 00:55:51'),
(19, 'Syifa', '-', '08675435744', '2005-09-12', 'Perempuan', 'Puri', 'Aktif', '2026-01-19 00:47:21', '2026-01-19 00:59:05');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `paket_bimbel_id` bigint UNSIGNED NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` int NOT NULL,
  `metode` enum('Cash','Transfer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Lunas','Belum Lunas') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lunas',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_pembayaran`, `siswa_id`, `paket_bimbel_id`, `tanggal_transaksi`, `total`, `metode`, `status`, `created_at`, `updated_at`) VALUES
(1, 'INV-2026-0001', 2, 2, '2026-01-18', 1400000, 'Cash', 'Lunas', '2026-01-18 13:36:26', '2026-01-18 13:36:26'),
(2, 'INV-2026-0002', 3, 8, '2026-01-18', 1500000, 'Cash', 'Lunas', '2026-01-18 13:49:40', '2026-01-18 13:49:40'),
(3, 'INV-2026-0003', 1, 1, '2026-01-19', 1200000, 'Cash', 'Lunas', '2026-01-19 00:48:49', '2026-01-19 00:48:49'),
(4, 'INV-2026-0004', 7, 2, '2026-01-19', 1400000, 'Transfer', 'Lunas', '2026-01-19 00:49:35', '2026-01-19 00:49:35'),
(5, 'INV-2026-0005', 4, 7, '2026-01-19', 1500000, 'Cash', 'Lunas', '2026-01-19 00:54:22', '2026-01-19 00:54:22'),
(6, 'INV-2026-0006', 8, 1, '2026-01-19', 1200000, 'Cash', 'Lunas', '2026-01-19 00:54:42', '2026-01-19 00:54:42'),
(7, 'INV-2026-0007', 6, 2, '2026-01-19', 1400000, 'Transfer', 'Lunas', '2026-01-19 00:54:57', '2026-01-19 00:54:57'),
(8, 'INV-2026-0008', 11, 7, '2026-01-19', 1500000, 'Cash', 'Lunas', '2026-01-19 00:55:12', '2026-01-19 00:55:12'),
(9, 'INV-2026-0009', 12, 2, '2026-01-19', 1400000, 'Cash', 'Lunas', '2026-01-19 00:55:29', '2026-01-19 00:55:29'),
(10, 'INV-2026-0010', 18, 7, '2026-01-19', 1500000, 'Transfer', 'Lunas', '2026-01-19 00:55:51', '2026-01-19 00:55:51'),
(11, 'INV-2026-0011', 16, 8, '2026-01-19', 1500000, 'Cash', 'Lunas', '2026-01-19 00:56:14', '2026-01-19 00:56:14'),
(12, 'INV-2026-0012', 13, 1, '2026-01-19', 1200000, 'Cash', 'Lunas', '2026-01-19 00:56:28', '2026-01-19 00:56:28'),
(13, 'INV-2026-0013', 10, 2, '2026-01-19', 1400000, 'Cash', 'Lunas', '2026-01-19 00:56:42', '2026-01-19 00:56:42'),
(14, 'INV-2026-0014', 14, 8, '2026-01-19', 1500000, 'Transfer', 'Lunas', '2026-01-19 00:57:18', '2026-01-19 00:57:18'),
(15, 'INV-2026-0015', 15, 7, '2026-01-19', 1500000, 'Cash', 'Lunas', '2026-01-19 00:57:33', '2026-01-19 00:57:33'),
(16, 'INV-2026-0016', 17, 2, '2026-01-19', 1400000, 'Cash', 'Lunas', '2026-01-19 00:57:46', '2026-01-19 00:57:46'),
(17, 'INV-2026-0017', 19, 8, '2026-01-19', 1500000, 'Cash', 'Lunas', '2026-01-19 00:59:05', '2026-01-19 00:59:05'),
(18, 'INV-2026-0018', 9, 7, '2026-01-19', 1500000, 'Cash', 'Lunas', '2026-01-19 00:59:33', '2026-01-19 00:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'bimbimbelajar@gmail.com', NULL, '$2y$12$NA8M6TFO5ouYTgJbihwio.zCGM3Z1TjZbDFrvlEkb7mKwcYKy2Yhy', NULL, '2026-01-18 10:25:31', '2026-01-18 10:25:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensi_guru_guru_id_foreign` (`guru_id`),
  ADD KEY `absensi_guru_jadwal_id_foreign` (`jadwal_id`);

--
-- Indexes for table `absensi_siswas`
--
ALTER TABLE `absensi_siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `absen_unique` (`jadwal_mengajar_id`,`siswa_id`,`tanggal`),
  ADD KEY `absensi_siswas_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

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
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gaji_guru_id_foreign` (`guru_id`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_email_unique` (`email`),
  ADD UNIQUE KEY `guru_qr_token_unique` (`qr_token`);

--
-- Indexes for table `jadwal_bimbel`
--
ALTER TABLE `jadwal_bimbel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_bimbel_paket_siswa_id_foreign` (`paket_siswa_id`),
  ADD KEY `jadwal_bimbel_jadwal_mengajar_id_foreign` (`jadwal_mengajar_id`);

--
-- Indexes for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_mengajar_guru_id_foreign` (`guru_id`),
  ADD KEY `jadwal_mengajar_mapel_id_foreign` (`mapel_id`),
  ADD KEY `jadwal_mengajar_paket_bimbel_id_foreign` (`paket_bimbel_id`);

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
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_bimbel`
--
ALTER TABLE `paket_bimbel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_siswa`
--
ALTER TABLE `paket_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_siswa_siswa_id_foreign` (`siswa_id`),
  ADD KEY `paket_siswa_paket_bimbel_id_foreign` (`paket_bimbel_id`),
  ADD KEY `paket_siswa_transaksi_id_foreign` (`transaksi_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemasukan_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `pembayaran_siswa`
--
ALTER TABLE `pembayaran_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_siswa_siswa_id_foreign` (`siswa_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_siswa_id_foreign` (`siswa_id`),
  ADD KEY `transaksi_paket_bimbel_id_foreign` (`paket_bimbel_id`);

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
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `absensi_siswas`
--
ALTER TABLE `absensi_siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jadwal_bimbel`
--
ALTER TABLE `jadwal_bimbel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `paket_bimbel`
--
ALTER TABLE `paket_bimbel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paket_siswa`
--
ALTER TABLE `paket_siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pembayaran_siswa`
--
ALTER TABLE `pembayaran_siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD CONSTRAINT `absensi_guru_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_guru_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal_mengajar` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `absensi_siswas`
--
ALTER TABLE `absensi_siswas`
  ADD CONSTRAINT `absensi_siswas_jadwal_mengajar_id_foreign` FOREIGN KEY (`jadwal_mengajar_id`) REFERENCES `jadwal_mengajar` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `absensi_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`);

--
-- Constraints for table `jadwal_bimbel`
--
ALTER TABLE `jadwal_bimbel`
  ADD CONSTRAINT `jadwal_bimbel_jadwal_mengajar_id_foreign` FOREIGN KEY (`jadwal_mengajar_id`) REFERENCES `jadwal_mengajar` (`id`),
  ADD CONSTRAINT `jadwal_bimbel_paket_siswa_id_foreign` FOREIGN KEY (`paket_siswa_id`) REFERENCES `paket_siswa` (`id`);

--
-- Constraints for table `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD CONSTRAINT `jadwal_mengajar_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `guru` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_mengajar_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_mengajar_paket_bimbel_id_foreign` FOREIGN KEY (`paket_bimbel_id`) REFERENCES `paket_bimbel` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paket_siswa`
--
ALTER TABLE `paket_siswa`
  ADD CONSTRAINT `paket_siswa_paket_bimbel_id_foreign` FOREIGN KEY (`paket_bimbel_id`) REFERENCES `paket_bimbel` (`id`),
  ADD CONSTRAINT `paket_siswa_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`),
  ADD CONSTRAINT `paket_siswa_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran_siswa`
--
ALTER TABLE `pembayaran_siswa`
  ADD CONSTRAINT `pembayaran_siswa_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_paket_bimbel_id_foreign` FOREIGN KEY (`paket_bimbel_id`) REFERENCES `paket_bimbel` (`id`),
  ADD CONSTRAINT `transaksi_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
