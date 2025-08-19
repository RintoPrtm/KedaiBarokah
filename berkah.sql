-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2025 at 04:35 AM
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
-- Database: `berkah`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id_detail` bigint(20) UNSIGNED NOT NULL,
  `id_pesanan` bigint(20) UNSIGNED NOT NULL,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id_detail`, `id_pesanan`, `id_menu`, `jumlah`) VALUES
(1, 1, 2, 1),
(2, 1, 1, 1),
(3, 1, 5, 1),
(4, 1, 4, 1),
(10, 3, 2, 1),
(11, 3, 3, 1),
(12, 3, 1, 2),
(13, 4, 2, 1),
(14, 4, 3, 1),
(15, 2, 1, 2),
(16, 2, 2, 2),
(17, 2, 4, 1),
(18, 2, 3, 1),
(21, 5, 1, 1),
(22, 5, 2, 1),
(23, 5, 3, 1),
(24, 5, 6, 1),
(26, 6, 13, 1),
(27, 6, 11, 1),
(28, 6, 2, 1),
(29, 7, 1, 1),
(30, 7, 2, 1),
(31, 7, 3, 2),
(38, 11, 1, 2),
(39, 11, 2, 1),
(47, 14, 1, 2),
(48, 14, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Nasi Uduk'),
(2, 'Gado-Gado'),
(4, 'Lontong Sayur'),
(5, 'Minuman'),
(6, 'Karedok');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `harga` bigint(20) DEFAULT NULL,
  `deskripsi_menu` text DEFAULT NULL,
  `foto_menu` varchar(100) DEFAULT 'promo.jpg',
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `promo` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `deskripsi_menu`, `foto_menu`, `id_kategori`, `promo`) VALUES
(1, 'Nasi Uduk', 8000, 'Nasi + Bihun + Mie + Orek + Krupuk', '1752028079_vmCDBWxt.jpg', 1, 6000),
(2, 'Kentang Balado', 2000, 'Add on Kentang Balado', '1752028141_yo7TJxjQ.jpg', 1, 1500),
(3, 'Kulit Melinjo Balado', 2000, 'Add on Kulit Melinjo Balado', '1752028186_W6bKThDd.jpg', 1, NULL),
(4, 'Jengkol Balado', 4000, 'Add on Jengkol Balado', '1752028217_ibyUXV8w.jpg', 1, NULL),
(5, 'Telur Balado', 5000, 'Add on Telur Balado', '1752028267_wznmz6nJ.jpg', 1, NULL),
(6, 'Telur Semur', 5000, 'Add on Telur Semur', '1752028295_kI4kbYPk.jpg', 1, NULL),
(7, 'Telur Dadar', 5000, 'Add on Telur Dadar', '1752028350_42BbaT3Y.jpg', 1, NULL),
(8, 'Tongkol Balado', 6000, 'Add on Tongkol Balado', '1752028383_UtboHD2c.jpg', 1, NULL),
(9, 'Perkedel', 3000, 'Add on Perkedel', '1752028419_2bpwWOFk.jpg', 1, NULL),
(10, 'Tahu Semur', 3000, 'Add on Tahu Semur', '1752028456_jnVwBzPa.jpg', 1, NULL),
(11, 'Gado-Gado', 13000, 'Kangkung + Toge + Kol + Pare + Labu Siam + Timun + Jagung + Tahu + Tempe + Kerupuk', '1752028573_iWqBkHhK.jpg', 2, NULL),
(12, 'Gado-Gado Nasi', 17000, 'Gado-Gado + Nasi', '1752028615_l1DfSiKY.jpg', 2, NULL),
(13, 'Gado-Gado Lontong', 17000, 'Gado-Gado + Lontong', '1752028640_TNqOScQT.jpg', 2, NULL),
(14, 'Karedok', 13000, 'Toge + Kol + Kacang Panjang + Selada + Timun + Tahu + Tempe + Kemangi + Terong Bulat + Kerupuk', '1752028764_xRQMcMeI.jpg', 6, NULL),
(15, 'Karedok Nasi', 15000, 'Karedok + Nasi', '1752028800_h60nXpRS.jpg', 6, NULL),
(16, 'Karedok Lontong', 15000, 'Karedok + Lontong', '1752028843_j8QzMYTV.jpg', 6, NULL),
(17, 'Lontong Sayur', 10000, 'Lontong + Labu + Tahu + Kerupuk', '1752028927_NEIEYUtq.jpg', 4, NULL),
(18, 'Telur Bulat', 5000, 'Add on Telur Bulat', '1752029024_tcTsHit9.jpg', 4, NULL),
(19, 'Es Teh', 3000, 'Teh Dingin', '', 5, NULL),
(20, 'Kopi', 3000, 'Kopi Panas', '', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_users_table', 1),
(2, '2025_03_23_005438_create_kategori_table', 1),
(3, '2025_03_23_005439_create_menu_table', 1),
(4, '2025_03_23_005451_create_pesanan_table', 1),
(5, '2025_03_23_005508_create_detail_table', 1),
(6, '2025_03_23_005518_create_warung_table', 1),
(7, '2025_05_28_005455_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` bigint(20) UNSIGNED NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Diproses',
  `tanggal_pesanan` date NOT NULL,
  `jam_pesanan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_users`, `status`, `tanggal_pesanan`, `jam_pesanan`) VALUES
(1, 2, 'Selesai', '2025-07-09', '09:52:02'),
(2, 2, 'Selesai', '2025-07-21', '14:35:12'),
(3, 3, 'Selesai', '2025-07-21', '16:48:27'),
(4, 3, 'Sudah Siap', '2025-07-21', '17:06:43'),
(5, 2, 'Diproses', '2025-07-23', '16:34:59'),
(6, 2, 'Diproses', '2025-08-01', '20:57:52'),
(7, 3, 'Selesai', '2025-08-02', '15:10:38'),
(11, 2, 'Selesai', '2025-08-04', '16:23:48'),
(14, 2, 'Keranjang', '2025-08-09', '16:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pThftFUCzAzdbSnGGVd91t4ZZCwDYPkesDHhqDsm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36 Edg/139.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMW54d3hBNEc5WXkzOTNRZWdoRkFGOXIyRUFNd0lhZXlSMjNQa1ZEdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYWluIjt9fQ==', 1754735962),
('zGs0laV9Y2ZQ3oTFfyGJkftFWKx9jMK9ENlaGCFF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzhWd1Rqd0U2NmtuVHlLZXBZTjNKc0tEcE1CMUZ3NzQwQ0hXMThidyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYWluIjt9fQ==', 1754735945);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telp_user` varchar(14) NOT NULL,
  `rule` varchar(10) DEFAULT 'user',
  `current_session_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `email`, `password`, `telp_user`, `rule`, `current_session_id`) VALUES
(1, 'admin', 'admin123@gmail.com', '$2y$12$jSDycnj0T.QCARkTQJs8Ae3c2/GIO5EqSgr33FLUYbdoKzBD80jRG', '081234567890', 'admin', 'yhkserhHcBJZJikbuV3pws3IwjDZhwtKXGsteV3w'),
(2, 'Joko', 'joko@gmail.com', '$2y$12$UcZwiq08bH/G.v15KPGwJurbYN.BvE4RWmSq9BqjLWh8pUiBsAftu', '1002312371', 'user', '0twEFFje6xW5WXyE4mHgenuXXUdHzHXls19aHQ8A'),
(3, 'farhan', 'farhan123@gmail.com', '$2y$12$IyQrTaFoQFdgATSaqGuFRuSqH4NDdtCQhTRprx9dT8J740yVY00I6', '0812476124921', 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warung`
--

CREATE TABLE `warung` (
  `id_warung` bigint(20) UNSIGNED NOT NULL,
  `nama_warung` varchar(100) NOT NULL,
  `alamat_warung` text NOT NULL,
  `foto_warung` varchar(100) NOT NULL,
  `deskripsi_warung` text NOT NULL,
  `flayer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warung`
--

INSERT INTO `warung` (`id_warung`, `nama_warung`, `alamat_warung`, `foto_warung`, `deskripsi_warung`, `flayer`) VALUES
(1, 'Kedai Barokah Jl M', 'Jl. Cipinang Muara Raya 14-16, RT.16/RW.3, Cipinang Muara, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13420', '1754729598_S61IzUjc.jpg', 'Warung Barokah adalah warung makan yang terletak di Kelurahan Cipinang Muara, Jakarta Timur, yang telah melayani masyarakat dengan masakan tradisional sejak tahun 2016. Dengan cita rasa yang khas dan kualitas yang terjaga, Kedai Berkah telah menjadi pilihan favorit bagi pelanggan lokal.', '1754729598_JcDsuO3M.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `detail_id_pesanan_foreign` (`id_pesanan`),
  ADD KEY `detail_id_menu_foreign` (`id_menu`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `menu_id_kategori_foreign` (`id_kategori`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `pesanan_id_users_foreign` (`id_users`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warung`
--
ALTER TABLE `warung`
  ADD PRIMARY KEY (`id_warung`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warung`
--
ALTER TABLE `warung`
  MODIFY `id_warung` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_id_pesanan_foreign` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_id_kategori_foreign` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
