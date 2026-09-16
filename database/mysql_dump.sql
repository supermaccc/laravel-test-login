-- MySQL Database Dump
-- Project: Laravel User Management System
-- Generated: 2026-09-16

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', '2026-09-16 03:57:04', '$2y$12$bqGcjvb5E8LQgn6Cpfjcou6Dr0RiztEdQjBDCJxTsjISfoIqjxgJy', 'e3rMwr6QrOvghLzVIqvPvyVHoZyHWBlM6ZoLUAXhwEA2KAwHfb8LGRfjnSAd', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(2, 'Margarita Blanda', 'stanton.tina@example.net', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'S0Qq7CrzP6', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(3, 'Alexie Wehner', 'jessy.flatley@example.org', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'Pw0UlVr8eQ', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(4, 'Claudia O\'Hara', 'margaret.hickle@example.com', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'QWWCVJos4j', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(5, 'Vallie Haag', 'jaeden33@example.com', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'dWS7h0g9AB', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(6, 'Saul Hills I', 'eheaney@example.com', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'tmhgyf8X8e', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(7, 'Linnea Bernhard IV', 'izabella.rodriguez@example.com', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', '7HJRfgaUxV', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(8, 'Cora Lind', 'tillman.idell@example.com', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'AmDKbEnAIP', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(9, 'Alexanne Marquardt III', 'winona.braun@example.net', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', 'e6iCfJYTR3', '2026-09-16 03:57:05', '2026-09-16 03:57:05'),
(10, 'Cristobal Daniel', 'phoebe55@example.org', 'user', '2026-09-16 03:57:05', '$2y$12$qGj5pErEYk6aadGv.RcBKuxi0lyvcdHbPKqSAv9It0gezt4P4KeDe', '3GLbk46VWz', '2026-09-16 03:57:05', '2026-09-16 03:57:05');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

SET FOREIGN_KEY_CHECKS=1;
