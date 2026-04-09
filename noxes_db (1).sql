-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 02:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noxes_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(4, 8, 'Alexa Bliss', '0838 7851 1238', 'Jl. Tanah Baru RT 01 RW 02, No.17A, Jl. Kemiri Jaya No.99, Tanah Baru, Kecamatan Beji, Kota Depok, Jawa Barat 16421', '2026-03-17 10:36:46', '2026-03-17 10:36:46'),
(5, 8, 'lana', '9479276242', 'gergvergvtetg34yg3g', '2026-03-17 11:33:20', '2026-03-17 11:33:20'),
(8, 8, 'u90786895875', '0809798687547', 'ugiufkbljjjjjjjjjjjcsrtxtrx', '2026-03-30 08:24:55', '2026-03-30 08:24:55'),
(9, 12, 'namira ashya', '0899999999', 'kp.pitara', '2026-03-30 20:48:21', '2026-03-30 20:48:21'),
(10, 12, 'hani', '08977777', 'kp.jth', '2026-03-30 20:55:02', '2026-03-30 20:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_02_21_093446_create_products_table', 2),
(6, '2026_02_24_025542_create_addresses_table', 3),
(7, '2026_03_17_162049_create_orders_table', 4),
(8, '2026_03_17_162836_create_order_items_table', 4),
(9, '2026_04_08_143427_add_email_phone_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `shipping` varchar(255) NOT NULL,
  `payment` varchar(255) NOT NULL,
  `total` int(11) NOT NULL,
  `proof` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'dikemas',
  `cancel_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_notified` tinyint(1) DEFAULT 1,
  `tracking_level` int(11) NOT NULL DEFAULT 0,
  `is_received` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `user_id`, `address_id`, `shipping`, `payment`, `total`, `proof`, `status`, `cancel_reason`, `created_at`, `updated_at`, `is_notified`, `tracking_level`, `is_received`) VALUES
(15, 'NXS-69D3567C0E1FE', 8, 4, 'jnt', 'qris', 515000, 'proofs/1775457916_2e22251e66969dcc4e3ee83a9ddb859e.jpg', 'tertunda', NULL, '2026-04-05 23:45:16', '2026-04-06 23:07:36', 1, 1, 0),
(16, 'NXS-69D45820DE1EB', 8, 4, 'jne', 'bank', 265000, 'proofs/1775523872_598723C5-206B-4B7D-B628-AC26C23F9F96-e1634692818241.jpeg', 'dibatalkan', 'Maaf Stok sudah habis', '2026-04-06 18:04:32', '2026-04-06 18:25:47', 1, 0, 0),
(17, 'NXS-69D48277E0407', 8, 4, 'jne', 'qris', 265000, 'proofs/1775534711_598723C5-206B-4B7D-B628-AC26C23F9F96-e1634692818241.jpeg', 'tertunda', NULL, '2026-04-06 21:05:11', '2026-04-06 21:05:11', 1, 0, 0),
(18, 'NXS-69D4884A9DB9F', 8, 4, 'jne', 'bank', 265000, 'proofs/1775536202_jansss1.jpg', 'dikemas', NULL, '2026-04-06 21:30:02', '2026-04-07 17:38:09', 1, 2, 0),
(19, 'NXS-69D4A564DED30', 8, 4, 'jne', 'bank', 515000, 'proofs/1775543652_2e22251e66969dcc4e3ee83a9ddb859e.jpg', 'selesai', NULL, '2026-04-06 23:34:12', '2026-04-06 23:46:16', 1, 5, 1),
(20, 'NXS-69D4A95F98FE3', 8, 4, 'jne', 'bank', 1265000, 'proofs/1775544671_598723C5-206B-4B7D-B628-AC26C23F9F96-e1634692818241.jpeg', 'selesai', NULL, '2026-04-06 23:51:11', '2026-04-06 23:56:19', 1, 5, 1),
(21, 'NXS-69D5C797CBF94', 8, 4, 'jne', 'qris', 265000, NULL, 'tertunda', NULL, '2026-04-07 20:12:23', '2026-04-07 20:12:23', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(15, 15, 9, 2, 250000, '2026-04-05 23:45:17', '2026-04-05 23:45:17'),
(16, 16, 9, 1, 250000, '2026-04-06 18:04:33', '2026-04-06 18:04:33'),
(17, 17, 9, 1, 250000, '2026-04-06 21:05:12', '2026-04-06 21:05:12'),
(18, 18, 10, 1, 250000, '2026-04-06 21:30:02', '2026-04-06 21:30:02'),
(19, 19, 17, 1, 250000, '2026-04-06 23:34:13', '2026-04-06 23:34:13'),
(20, 19, 11, 1, 250000, '2026-04-06 23:34:13', '2026-04-06 23:34:13'),
(21, 20, 15, 2, 250000, '2026-04-06 23:51:11', '2026-04-06 23:51:11'),
(22, 20, 16, 1, 250000, '2026-04-06 23:51:11', '2026-04-06 23:51:11'),
(23, 20, 11, 2, 250000, '2026-04-06 23:51:12', '2026-04-06 23:51:12'),
(24, 21, 13, 1, 250000, '2026-04-07 20:12:24', '2026-04-07 20:12:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `series` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `spesifikasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `series`, `price`, `stock`, `image`, `description`, `spesifikasi`, `created_at`, `updated_at`) VALUES
(9, 'Bone Wave Backpack', 'V1 Series', 250000, 10, '1775446321.jpg', 'Motif hitam putih dengan pola abstrak bergelombang, menghadirkan tampilan kontras yang unik dan artistik.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-05 20:32:01', '2026-04-06 20:22:07'),
(10, 'Cyber Camo Backpack', 'V1 Series', 250000, 10, '1775446471.jpg', 'Perpaduan camouflage dengan elemen digital, menciptakan gaya futuristik yang modern dan berani.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-05 20:34:31', '2026-04-06 20:21:52'),
(11, 'Frost Map Backpack', 'V1 Series', 250000, 10, '1775446579.jpg', 'Motif bernuansa dingin dengan tampilan seperti peta es, memberikan kesan tenang dan elegan.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-05 20:36:19', '2026-04-06 20:22:39'),
(12, 'Ice Storm Backpack', 'V1 Series', 250000, 10, '1775446654.jpg', 'Desain biru dengan efek badai es, menghadirkan tampilan kuat dan penuh karakter.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-05 20:37:34', '2026-04-06 20:23:44'),
(13, 'Nightcode Backpack', 'V2 Series', 250000, 10, '1775532920.jpg', 'Backpack bernuansa hitam dengan motif abstrak futuristik yang menghadirkan kesan modern, sleek, dan berkelas. Cocok untuk tampilan minimalis dengan sentuhan edgy.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-06 20:35:20', '2026-04-06 20:36:27'),
(15, 'Heartpunk', 'V2 Series', 250000, 10, '1775533129.jpg', 'untuk di halaman tambah produk admin dan petugas tambahkan label isi untuk spesifikasi produk seperti halaman ubah produk', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-06 20:38:49', '2026-04-06 20:39:22'),
(16, 'Soft Cherry Backpack', 'V2 Series', 250000, 10, '1775535462.webp', 'Tampilan feminin dengan warna pink lembut dan aksen cherry kecil, memberikan kesan manis, fresh, dan stylish.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-06 21:17:42', '2026-04-06 21:17:42'),
(17, 'Streetbite', 'V2 Series', 250000, 10, '1775535626.webp', 'Motif grafis berwarna kontras dengan nuansa streetwear yang kuat, cocok untuk kamu yang ingin tampil bold dan standout.', 'Brand: La Primera\r\nTipe: Backpack / Tas Ransel\r\nSeries: V1 & V2\r\nUkuran: ± 43 x 30 x 13 cm\r\nKapasitas: ± 20–25 Liter\r\nBerat: ± 500–700 gram\r\nMaterial Utama: Polyester Premium (kuat & tahan lama)\r\nLapisan Dalam: Nylon lining\r\nTipe Penutup: Resleting (Zipper)\r\nKompartemen:\r\n1 kompartemen utama\r\n1 kantong depan (front pocket)\r\n2 kantong samping (botol minum)\r\nSlot laptop (hingga 14 inch)', '2026-04-06 21:20:26', '2026-04-06 21:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Loly Cafe', 'lolycafe123', NULL, NULL, '$2y$10$Z/Bp7cKgGwx33i3PJIC76e9f9oOjxA0Mx.m1ur5ikzSELRuHWlXt6', 'user', '2026-02-19 02:04:24', '2026-02-19 02:04:24'),
(2, 'Admin', 'admin', NULL, NULL, '$2y$10$P/u5deDSn86DXhR9V0vu9eFeIssmhpLK0XKo/GKSIUCPJaYa1PLDi', 'admin', '2026-02-19 02:51:37', '2026-02-19 02:51:37'),
(7, 'Nargis Rumaisha', 'nargis123', NULL, NULL, '$2y$10$dF9DjQ1p3NgnCN6.uCwUD.ROMA6r1yHhRTdGYmt0nN0KbXdp9ni/6', 'user', '2026-02-22 23:25:18', '2026-02-22 23:25:18'),
(8, 'Alexa Bliss', 'alexa123', 'faizdelrey2007@gmail.com', '083896350280', '$2y$10$IbQJYnAFCkd9CxZxl1n2KefW0YO33c/Q2pQtWed.tvxl8D35adfMG', 'user', '2026-02-23 19:31:50', '2026-04-08 08:16:15'),
(11, 'alexa petugas', 'petugas', NULL, NULL, '$2y$10$fSVf3O.97uOKThse9Kxd4.ybHNk3Y0wxZ2x/cgZIK5FU/yAeg7oIS', 'petugas', '2026-03-29 03:39:41', '2026-03-29 03:39:41'),
(12, 'namira ashya', 'namira', NULL, NULL, '$2y$10$VaIpBHtDz5VxVj6m2AfJueKK1GLmiCZA/9E6FcwaJYB6aXnNz4DUK', 'user', '2026-03-30 20:46:48', '2026-03-30 20:46:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
