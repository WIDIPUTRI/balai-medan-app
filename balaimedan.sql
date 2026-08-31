-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Agu 2026 pada 05.16
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
-- Database: `balaimedan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_login_logs`
--

CREATE TABLE `admin_login_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `login_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `logout_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin_login_logs`
--

INSERT INTO `admin_login_logs` (`id`, `user_id`, `ip_address`, `user_agent`, `login_at`, `logout_at`, `created_at`, `updated_at`) VALUES
(1, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 01:43:56', NULL, '2025-11-13 01:43:56', '2025-11-13 01:43:56'),
(2, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 21:18:27', NULL, '2025-11-13 21:18:27', '2025-11-13 21:18:27'),
(3, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-13 21:18:45', NULL, '2025-11-13 21:18:45', '2025-11-13 21:18:45'),
(4, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-14 01:40:02', NULL, '2025-11-14 01:40:02', '2025-11-14 01:40:02'),
(5, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-16 19:32:40', NULL, '2025-11-16 19:32:40', '2025-11-16 19:32:40'),
(6, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-17 00:14:19', NULL, '2025-11-17 00:14:19', '2025-11-17 00:14:19'),
(7, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-17 18:48:42', NULL, '2025-11-17 18:48:42', '2025-11-17 18:48:42'),
(8, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-11-18 19:07:55', NULL, '2025-11-18 19:07:55', '2025-11-18 19:07:55'),
(9, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-05 01:55:28', NULL, '2025-12-05 01:55:28', '2025-12-05 01:55:28'),
(10, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-14 22:17:09', NULL, '2025-12-14 22:17:09', '2025-12-14 22:17:09'),
(11, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', '2025-12-14 22:17:31', NULL, '2025-12-14 22:17:31', '2025-12-14 22:17:31'),
(12, 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2026-01-12 01:36:38', NULL, '2026-01-12 01:36:38', '2026-01-12 01:36:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_belanjas`
--

CREATE TABLE `akun_belanjas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `komponen_id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `pagu` decimal(20,2) NOT NULL DEFAULT 0.00,
  `realisasi` decimal(20,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('P','L') DEFAULT NULL,
  `birthplace` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `finances`
--

CREATE TABLE `finances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('pemasukan','pengeluaran') NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasamas`
--

CREATE TABLE `kerjasamas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_kerja_sama` varchar(255) DEFAULT NULL,
  `satker` varchar(255) DEFAULT NULL,
  `mitra` varchar(255) DEFAULT NULL,
  `kategori_mitra` varchar(255) DEFAULT NULL,
  `cakupan_kerja_sama` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `no_kerja_sama` varchar(255) DEFAULT NULL,
  `tentang` text DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `dok_scan` varchar(255) DEFAULT NULL,
  `dok_fisik` varchar(255) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `implementasi_evaluasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kerjasamas`
--

INSERT INTO `kerjasamas` (`id`, `jenis_kerja_sama`, `satker`, `mitra`, `kategori_mitra`, `cakupan_kerja_sama`, `status`, `no_kerja_sama`, `tentang`, `tgl_mulai`, `tgl_akhir`, `dok_scan`, `dok_fisik`, `ket`, `implementasi_evaluasi`, `created_at`, `updated_at`) VALUES
(3, 'MoU', 'Balai Mediator', 'PT Contoh Sejahtera', 'Swasta', 'Pendidikan', 'Aktif', '001/MoU/I/2025', 'Kerjasama pelatihan', '2025-01-10', '2025-12-10', 'kerjasama/dok_scan/DquFcwPIw4BnvnlyQVmDKwAN5gvpgWscz3rW2548.pdf', NULL, NULL, 'Sudah berjalan baik', '2025-11-17 23:40:41', '2025-11-18 19:08:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komponens`
--

CREATE TABLE `komponens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_02_092509_create_stores_table', 1),
(5, '2025_11_02_092510_create_categories_table', 1),
(6, '2025_11_02_092511_create_products_table', 1),
(7, '2025_11_02_092520_create_sales_table', 1),
(8, '2025_11_02_092521_create_sale_items_table', 1),
(9, '2025_11_02_092522_create_purchases_table', 1),
(10, '2025_11_02_092547_create_purchase_items_table', 1),
(11, '2025_11_02_092548_create_shipments_table', 1),
(12, '2025_11_02_092549_create_admin_login_logs_table', 1),
(13, '2025_11_02_092550_add_fields_to_users_table', 1),
(14, '2025_11_02_103900_add_stock_columns_to_products', 1),
(15, '2025_11_12_091616_create_finances_table', 1),
(16, '2025_11_13_000000_create_anggaran_tables', 1),
(17, '2025_01_01_000000_create_employees_table', 2),
(18, '2025_01_01_000001_add_role_to_users_table', 2),
(19, '2025_11_17_085045_create_staff_table', 3),
(20, '2025_11_18_052524_create_kerjasamas_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `purchase_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `min_stock` int(11) NOT NULL DEFAULT 10,
  `image` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `pagu` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `programs`
--

INSERT INTO `programs` (`id`, `kode`, `nama`, `kategori`, `pagu`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'b', '2000', '2025-11-13 01:52:57', '2025-11-18 01:04:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `expired_date` date DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `sale_date` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1Pg2DTVNVptAXGroLGyfCDDEPdAXPXKFQ2dBvROf', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTZjRENhdlQ2V3RJOUN2NGhnbmJmR0plSTJPU2dacGhiU2Y5T2RnWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9rZXJqYXNhbWEiO3M6NToicm91dGUiO3M6MTU6Imtlcmphc2FtYS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1768208277);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` bigint(20) UNSIGNED NOT NULL,
  `category` enum('gojek','jne','jnt','pickup') NOT NULL,
  `shipment_date` date NOT NULL,
  `shipping_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birth_place` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `education` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`id`, `name`, `gender`, `birth_place`, `birth_date`, `education`, `rank`, `position`, `created_at`, `updated_at`) VALUES
(45, 'Dr. Christiany Juditha S.Sos., M.A.', 'Perempuan', 'Makassar', '1971-05-20', 'S-3 ILMU KOMUNIKASI', 'Pembina Tingkat I, IV/b', 'Kepala BBPSDMP Kominfo Medan', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(46, 'Yusrizal,S.Kom.,M.Eng', 'Laki-laki', 'MEDAN', '1982-07-05', 'S-2 TEKNIK ELEKTRONIKA', 'Pembina, IV/a', 'Kepala Bagian Umum', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(47, 'Budiman, S.Sos', 'Laki-laki', 'Tanjung Morawa', '1971-03-05', 'S-1 ILMU KOMUNIKASI', 'Pembina, IV/a', 'Analis Data Ilmiah Ahli Madya', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(48, 'Frans Hendra Suryanta Sembiring,ST.,M.SM.', 'Laki-laki', 'PEMATANGSIANTAR', '1977-11-06', 'S-2 ILMU MANAJEMEN', 'Pembina, IV/a', 'Pranata Humas Ahli Muda', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(49, 'Meilinia Diakonia Ginting,S.Kom.', 'Perempuan', 'Brastagi', '1981-05-03', 'S-1 ILMU KOMPUTER', 'Penata Tk.I, III/d', 'Analis Tata Usaha', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(50, 'Erwin Antonius Manurung, S.T.', 'Laki-laki', 'MEDAN', '1978-09-23', 'S-1 TEKNIK ELEKTRO', 'Penata Tingkat I, III/d', 'Fasilitator Kemitraan', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(51, 'Idawati Pandia,S.Sos.', 'Perempuan', 'Sukaraya', '1971-08-15', 'S-1 ILMU KOMUNIKASI', 'Penata Tk.I, III/d', 'Fasilitator Kemitraan', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(52, 'Jarudo Damanik,S.Kom.', 'Laki-laki', 'SIMALUNGUN', '1976-06-05', 'S-1 TEKNIK INFORMATIKA', 'Penata, III/c', 'Analis Perencanaan, Evaluasi dan Pelaporan', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(53, 'Achmad Ofanny S. Torong,S.E.', 'Laki-laki', 'MEDAN', '1985-11-08', 'S-1 MANAJEMEN', 'Penata, III/c', 'Penyusun Rencana Kebutuhan Rumah Tangga dan Perlengkapan', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(54, 'Ahirinna, S.I.Kom.', 'Perempuan', 'TAPANULI SELATAN', '1988-01-29', 'S-1 ILMU KOMUNIKASI', 'Penata muda, III/a', 'Fasilitator Kemitraan', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(55, 'Ghio Vani Debrian Soares, S.Pd.', 'Laki-laki', 'LIMA PULUH KOTA', '1994-09-24', 'S-1 TEKNOLOGI PENDIDIKAN', 'Penata muda, III/a', 'Petugas Standarisasi dan Sertifikasi', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(56, 'Ronald Rato Mangapul Limbong, SE.', 'Laki-laki', 'DILI', '1994-04-21', 'S-1 MANAJEMEN', 'Penata muda, III/a', 'Analis Penjamin Mutu', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(57, 'Eki Yoan Meydora, S.I.Kom.', 'Perempuan', 'MEDAN', '1995-05-28', 'S-2 ILMU KOMUNIKASI', 'Penata muda Tk I, III/b', 'Penyusun Bahan Informasi dan Publikasi', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(58, 'Gusmila Zulidar, SE.', 'Perempuan', 'LABUHANBATU', '1996-08-18', 'S-1 MANAJEMEN', 'Penata muda, III/a', 'Petugas Standarisasi dan Sertifikasi', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(59, 'Safrayuda Andrean, SE.', 'Laki-laki', 'BINJAI', '1996-06-22', 'S-1 MANAJEMEN', 'Penata muda, III/a', 'Perencana Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(60, 'Widia Apri Putri, S.Tr.Kom.', 'Perempuan', 'JAKARTA', '1997-04-15', 'D-IV TEKNIK INFORMATIKA', 'Penata muda, III/a', 'Pranata Komputer Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(61, 'Darliandra, S.Stat.', 'Laki-laki', 'BANDA ACEH', '1997-09-18', 'S-1 STATISTIKA', 'Penata muda, III/a', 'Statistisi Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(62, 'Delvi Windrayani, S.I.Kom.', 'Perempuan', 'LANGKAT', '1997-12-12', 'S-1 ILMU KOMUNIKASI', 'Penata muda, III/a', 'Penyusun Bahan Informasi dan Publikasi', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(63, 'Ade Gita Ellena Br. Tarigan, S.I.Kom.', 'Perempuan', '	DELI SERDANG', '1998-10-29', 'S-1 ILMU KOMUNIKASI', 'Penata muda, III/a', 'Penyusun Bahan Informasi dan Publikasi', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(64, 'Michael Hariara Simanjuntak, S.Akun', 'Laki-laki', 'MEDAN', '1998-03-12', 'S-1 AKUTANSI', 'Penata muda, III/a', 'Penata Laporan Keuangan ', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(65, 'Jesty Meliana Sibarani, S.Akun', 'Perempuan', 'SERDANG BEDAGAI', '1997-06-03', 'S-1 AKUNTANSI', ' Penata muda, III/a', 'Penata Laporan Keuangan ', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(66, 'Alex Siregar,S.Kom.', 'Laki-laki', 'PADANG SIDEMPUAN', '1986-03-15', 'S-1 INFORMATIKA', 'Penata Muda (PPPK) - IX', 'Penata Laporan Keuangan ', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(67, 'M. Prakoso Prabhaswara, S.Tr.Kom', 'Laki-laki', 'BANDUNG', '1996-01-25', 'D-IV TEKNOLOGI REKAYASA MULTIMEDIA', 'Penata Muda (PPPK) - IX', 'Ahli Pertama - Pranata Komputer', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(68, 'Ahmad Rozy,S.Kom., M.Kom.', 'Laki-laki', 'MEDAN', '1989-08-23', 'S-1 SISTEM INFORMASI', 'Penata Muda (PPPK) - IX', 'Ahli Pertama - Instruktur', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(69, 'Fachri Auliansyah,S.Kom.', 'Laki-laki', 'MEDAN', '1991-06-08', 'S-1 TEKNIK INFORMATIKA', 'Penata Muda (PPPK) - IX', 'Penata Layanan Operasional', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(70, 'Resky Datsita Sembiring Kembaren, S.Sos', 'Perempuan', 'MEDAN', '1990-12-30', 'S-1 ILMU KOMUNIKASI', 'Penata muda, III/a', 'Instruktur Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(71, 'Siti Syafitri, S.Kom.', 'Perempuan', 'LANGKAT', '2000-01-05', 'S-1 SISTEM INFORMASI', 'Penata muda, III/a', 'Instruktur Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(72, 'Aqilah Shabrina Nasution, S.Bns.', 'Perempuan', 'MEDAN', '2003-02-23', 'S-1 BISNIS DIGITAL', 'Penata muda, III/a', 'Instruktur Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(73, 'Grace Silvia Anastasia Purba, S.Bns', 'Perempuan', 'PEMATANGSIANTAR', '2001-09-27', 'S-1 BISNIS DIGITAL', 'Penata muda, III/a', 'Instruktur Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28'),
(74, 'Delpia Yesica Marpaung, S.Kom.', 'Perempuan', 'TOBA', '2001-05-13', 'S-1 SISTEM INFORMASI', 'Penata muda, III/a', 'Instruktur Ahli Pertama', '2025-11-17 21:47:28', '2025-11-17 21:47:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `year_established` year(4) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `cashier_name` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kegiatans`
--

CREATE TABLE `sub_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `akun_belanja_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `nominal` decimal(20,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('super_admin','admin','cashier') NOT NULL DEFAULT 'cashier',
  `gender` enum('male','female') DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `store_id`, `name`, `email`, `role`, `gender`, `birth_place`, `birth_date`, `education`, `address`, `phone`, `photo`, `notes`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Admin', 'admin@example.com', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$bEeoip1OIaElwxm9TtAxVeUgKDoUXi4tekOfhviVz0pmZgHmF.Uiu', 1, NULL, '2025-11-13 01:43:01', '2025-11-13 01:43:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_login_logs`
--
ALTER TABLE `admin_login_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_login_logs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `akun_belanjas`
--
ALTER TABLE `akun_belanjas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akun_belanjas_komponen_id_foreign` (`komponen_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `finances`
--
ALTER TABLE `finances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `finances_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatans_program_id_foreign` (`program_id`);

--
-- Indeks untuk tabel `kerjasamas`
--
ALTER TABLE `kerjasamas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komponens`
--
ALTER TABLE `komponens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `komponens_sub_kegiatan_id_foreign` (`sub_kegiatan_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_store_id_foreign` (`store_id`);

--
-- Indeks untuk tabel `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programs_kode_unique` (`kode`);

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_store_id_foreign` (`store_id`),
  ADD KEY `purchases_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_items_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_store_id_foreign` (`store_id`),
  ADD KEY `sales_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`),
  ADD KEY `sale_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipments_sale_id_foreign` (`sale_id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sub_kegiatans`
--
ALTER TABLE `sub_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_kegiatans_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indeks untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksis_akun_belanja_id_foreign` (`akun_belanja_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_store_id_foreign` (`store_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_login_logs`
--
ALTER TABLE `admin_login_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `akun_belanjas`
--
ALTER TABLE `akun_belanjas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `finances`
--
ALTER TABLE `finances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kerjasamas`
--
ALTER TABLE `kerjasamas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `komponens`
--
ALTER TABLE `komponens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sub_kegiatans`
--
ALTER TABLE `sub_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_login_logs`
--
ALTER TABLE `admin_login_logs`
  ADD CONSTRAINT `admin_login_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `akun_belanjas`
--
ALTER TABLE `akun_belanjas`
  ADD CONSTRAINT `akun_belanjas_komponen_id_foreign` FOREIGN KEY (`komponen_id`) REFERENCES `komponens` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `finances`
--
ALTER TABLE `finances`
  ADD CONSTRAINT `finances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD CONSTRAINT `kegiatans_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komponens`
--
ALTER TABLE `komponens`
  ADD CONSTRAINT `komponens_sub_kegiatan_id_foreign` FOREIGN KEY (`sub_kegiatan_id`) REFERENCES `sub_kegiatans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_items_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kegiatans`
--
ALTER TABLE `sub_kegiatans`
  ADD CONSTRAINT `sub_kegiatans_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksis`
--
ALTER TABLE `transaksis`
  ADD CONSTRAINT `transaksis_akun_belanja_id_foreign` FOREIGN KEY (`akun_belanja_id`) REFERENCES `akun_belanjas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
