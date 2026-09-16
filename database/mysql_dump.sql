-- MySQL Database Dump (Latest)
-- Project: Laravel User Management System
-- Generated: 2026-09-16 11:40:00

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
-- Records of users (Latest)
-- ----------------------------
INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', 'admin', '2026-09-16 04:19:44', '$2y$12$3Ednv5aO6aMkX..9D0vmQe.uzgqmQUGd4uUP1F/MTLY/4Q2gCwMxq', 'X72c53DXaz9loIUDX43RIPThJqMWQ5tDwV9TsOfJ6bOkJPFtJAfD06KN9hFO', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(2, 'Bernadine Predovic', 'ejones@example.net', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', 'ZkkvEEdKfD', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(3, 'Jackeline Balistreri V', 'helena89@example.com', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', '5yxsWjVCYr', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(4, 'Miss Jennyfer Ferry I', 'francisco.roob@example.com', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', '04xRldtUCU', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(5, 'Lulu Roob', 'theodora56@example.org', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', 'qJ9GiHPher', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(6, 'Filomena Crona', 'jfunk@example.net', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', 's6UcxJ8YUP', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(7, 'Dortha Hilpert', 'katheryn.lueilwitz@example.org', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', 'YlpRC7QB8Z', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(8, 'Corene Kshlerin Sr.', 'felton25@example.org', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', 'lOYIrskXE1', '2026-09-16 04:19:45', '2026-09-16 04:19:45'),
(10, 'Enrique Croner', 'yhyatt@example.test', 'user', '2026-09-16 04:19:45', '$2y$12$dsaIf//8Y.d5dRnNnqJAK.SqORUqCRJ2GHnZcmaySdMWFPKbXpsYq', 'B3hpU727rk', '2026-09-16 04:19:45', '2026-09-16 04:25:18'),
(11, 'ศุภโชติ ชมชื่น', 'mac_test@gmail.com', 'user', NULL, '$2y$12$LXJsGq/DW787qOi/erHAxu/AdKciFEx688Viy147y/f9KgX.LGNZ2', 'r9asLSKSMeyFkonZx8yj1qmUcbMZV7gBLw7fIQOm1OVu7eRu5VZU5t95uSnr', '2026-09-16 04:22:27', '2026-09-16 04:22:27'),
(12, 'user02', 'user02@gmail.com', 'user', NULL, '$2y$12$5Qjqu3ecKIwG6BhHP6v.venycozKdZDu1u7tI.1zW4Snvkn0LPTk2', NULL, '2026-09-16 04:37:41', '2026-09-16 04:38:33');

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
