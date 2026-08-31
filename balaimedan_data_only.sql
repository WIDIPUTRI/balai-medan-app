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



-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `finances`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatans`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `kerjasamas`
--



--
-- Dumping data untuk tabel `kerjasamas`
--

INSERT INTO `kerjasamas` (`id`, `jenis_kerja_sama`, `satker`, `mitra`, `kategori_mitra`, `cakupan_kerja_sama`, `status`, `no_kerja_sama`, `tentang`, `tgl_mulai`, `tgl_akhir`, `dok_scan`, `dok_fisik`, `ket`, `implementasi_evaluasi`, `created_at`, `updated_at`) VALUES
(3, 'MoU', 'Balai Mediator', 'PT Contoh Sejahtera', 'Swasta', 'Pendidikan', 'Aktif', '001/MoU/I/2025', 'Kerjasama pelatihan', '2025-01-10', '2025-12-10', 'kerjasama/dok_scan/DquFcwPIw4BnvnlyQVmDKwAN5gvpgWscz3rW2548.pdf', NULL, NULL, 'Sudah berjalan baik', '2025-11-17 23:40:41', '2025-11-18 19:08:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komponens`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--



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



-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `programs`
--



--
-- Dumping data untuk tabel `programs`
--

INSERT INTO `programs` (`id`, `kode`, `nama`, `kategori`, `pagu`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'b', '2000', '2025-11-13 01:52:57', '2025-11-18 01:04:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `purchase_items`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `sale_items`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--



--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1Pg2DTVNVptAXGroLGyfCDDEPdAXPXKFQ2dBvROf', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTZjRENhdlQ2V3RJOUN2NGhnbmJmR0plSTJPU2dacGhiU2Y5T2RnWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9rZXJqYXNhbWEiO3M6NToicm91dGUiO3M6MTU6Imtlcmphc2FtYS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1768208277);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipments`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--



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



-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kegiatans`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksis`
--



-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--



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


--
-- Indeks untuk tabel `akun_belanjas`
--


--
-- Indeks untuk tabel `cache`
--


--
-- Indeks untuk tabel `cache_locks`
--


--
-- Indeks untuk tabel `categories`
--


--
-- Indeks untuk tabel `employees`
--


--
-- Indeks untuk tabel `failed_jobs`
--


--
-- Indeks untuk tabel `finances`
--


--
-- Indeks untuk tabel `jobs`
--


--
-- Indeks untuk tabel `job_batches`
--


--
-- Indeks untuk tabel `kegiatans`
--


--
-- Indeks untuk tabel `kerjasamas`
--


--
-- Indeks untuk tabel `komponens`
--


--
-- Indeks untuk tabel `migrations`
--


--
-- Indeks untuk tabel `password_reset_tokens`
--


--
-- Indeks untuk tabel `products`
--


--
-- Indeks untuk tabel `programs`
--


--
-- Indeks untuk tabel `purchases`
--


--
-- Indeks untuk tabel `purchase_items`
--


--
-- Indeks untuk tabel `sales`
--


--
-- Indeks untuk tabel `sale_items`
--


--
-- Indeks untuk tabel `sessions`
--


--
-- Indeks untuk tabel `shipments`
--


--
-- Indeks untuk tabel `staff`
--


--
-- Indeks untuk tabel `stores`
--


--
-- Indeks untuk tabel `sub_kegiatans`
--


--
-- Indeks untuk tabel `transaksis`
--


--
-- Indeks untuk tabel `users`
--


--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_login_logs`
--


--
-- AUTO_INCREMENT untuk tabel `akun_belanjas`
--


--
-- AUTO_INCREMENT untuk tabel `categories`
--


--
-- AUTO_INCREMENT untuk tabel `employees`
--


--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--


--
-- AUTO_INCREMENT untuk tabel `finances`
--


--
-- AUTO_INCREMENT untuk tabel `jobs`
--


--
-- AUTO_INCREMENT untuk tabel `kegiatans`
--


--
-- AUTO_INCREMENT untuk tabel `kerjasamas`
--


--
-- AUTO_INCREMENT untuk tabel `komponens`
--


--
-- AUTO_INCREMENT untuk tabel `migrations`
--


--
-- AUTO_INCREMENT untuk tabel `products`
--


--
-- AUTO_INCREMENT untuk tabel `programs`
--


--
-- AUTO_INCREMENT untuk tabel `purchases`
--


--
-- AUTO_INCREMENT untuk tabel `purchase_items`
--


--
-- AUTO_INCREMENT untuk tabel `sales`
--


--
-- AUTO_INCREMENT untuk tabel `sale_items`
--


--
-- AUTO_INCREMENT untuk tabel `shipments`
--


--
-- AUTO_INCREMENT untuk tabel `staff`
--


--
-- AUTO_INCREMENT untuk tabel `stores`
--


--
-- AUTO_INCREMENT untuk tabel `sub_kegiatans`
--


--
-- AUTO_INCREMENT untuk tabel `transaksis`
--


--
-- AUTO_INCREMENT untuk tabel `users`
--


--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin_login_logs`
--


--
-- Ketidakleluasaan untuk tabel `akun_belanjas`
--


--
-- Ketidakleluasaan untuk tabel `finances`
--


--
-- Ketidakleluasaan untuk tabel `kegiatans`
--


--
-- Ketidakleluasaan untuk tabel `komponens`
--


--
-- Ketidakleluasaan untuk tabel `products`
--


--
-- Ketidakleluasaan untuk tabel `purchases`
--


--
-- Ketidakleluasaan untuk tabel `purchase_items`
--


--
-- Ketidakleluasaan untuk tabel `sales`
--


--
-- Ketidakleluasaan untuk tabel `sale_items`
--


--
-- Ketidakleluasaan untuk tabel `shipments`
--


--
-- Ketidakleluasaan untuk tabel `sub_kegiatans`
--


--
-- Ketidakleluasaan untuk tabel `transaksis`
--


--
-- Ketidakleluasaan untuk tabel `users`
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
