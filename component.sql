-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 30 2025 г., 21:44
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `component`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int UNSIGNED NOT NULL DEFAULT '0',
  `registered` int UNSIGNED NOT NULL,
  `last_login` int UNSIGNED DEFAULT NULL,
  `force_logout` mediumint UNSIGNED NOT NULL DEFAULT '0',
  `job` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Онлайн',
  `avatar` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`, `job`, `phone`, `address`, `state`, `avatar`, `vk`, `tg`, `inst`) VALUES
(2, 'sdfa@fds.eu', '$2y$10$KoWGluipN/tdYUDr2Mrmn.O6FOAn2AOUIMJMbiFSiGrdNqKyR0CkK', 'asdcvbvcn2312', 0, 0, 1, 0, 1745669623, NULL, 0, '', '', '', 'Не беспокоить', '../uploads/68126b171de32photo_2024-12-21_00-34-33.jpg', NULL, NULL, NULL),
(3, 'asd@asd.asd', '$2y$10$.x1m8nCIWCin3ZC5A2rtvuJdY4lrFYndrWO5Qwpk.h9W5oy2bgxb.', NULL, 0, 1, 1, 0, 1745670309, NULL, 0, NULL, NULL, NULL, 'Не беспокоить', NULL, NULL, NULL, NULL),
(5, 'qwe@qwe.qw', '$2y$10$Gd7SuMWSdapXWkDvBi.LvOyP1tDDLTaDqT3Iv6tjRPvfLEDrZIv6W', '123123', 0, 1, 1, 1, 1745670468, 1745866266, 4, '', '', '', 'Отошел', NULL, NULL, NULL, NULL),
(6, 'qwe@qwe.qwe', '$2y$10$kX5DB97mNxxnBPSWT6HcLuB5beVzwFGRUIyYWeGfhtbUoua.Ol6ke', NULL, 0, 1, 1, 0, 1745783857, NULL, 0, NULL, NULL, NULL, 'Онлайн', NULL, NULL, NULL, NULL),
(8, 'asdfg@asdfg.asdfg', '$2y$10$27FSktRe5alZTlnUqUnTaegCStJuHAe88ooPDqcwuB7R6AKo4psym', NULL, 0, 1, 1, 0, 1745848264, NULL, 0, NULL, NULL, NULL, 'Онлайн', NULL, NULL, NULL, NULL),
(12, 'zxcv@zxcv.zxcv', '$2y$10$1HhM99BbWLB37mVjA/9reeOASzxAQYs3XH8irXZtJXk6UraWRhPLS', NULL, 0, 1, 1, 0, 1745849745, NULL, 0, '', '', '', 'Не беспокоить', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `email` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_confirmations`
--

INSERT INTO `users_confirmations` (`id`, `user_id`, `email`, `selector`, `token`, `expires`) VALUES
(1, 2, 'sdfa@fds.eu', 'zCEtrNY_tTU0-bfs', '$2y$10$tAdzQNJaTDKI.8mDgLjbr.9N.GC8WVcVgTucoKNtoLHOd3aRn8ij.', 1745756023);

-- --------------------------------------------------------

--
-- Структура таблицы `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint UNSIGNED NOT NULL,
  `user` int UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `user` int UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int UNSIGNED NOT NULL,
  `expires_at` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_throttling`
--

INSERT INTO `users_throttling` (`bucket`, `tokens`, `replenished_at`, `expires_at`) VALUES
('QduM75nGblH2CDKFyk0QeukPOwuEVDAUFE54ITnHM38', 41.1515, 1745866895, 1746406895),
('PZ3qJtO_NLbJfRIP-8b4ME4WA3xxc6n9nbCORSffyQ0', 0.0479861, 1745670468, 1746102468),
('HIJQJPUQ2qyyTt0Q7_AuZA0pXm27czJnqpJsoA5IFec', 49, 1745857094, 1745929094),
('z8abmp74lulGiU6eo66Ed0Sqax-KI0ID8Ts_cfcGRSk', 29, 1745670309, 1745742309),
('M-wjGitbwAKmwX-LWLvnK1A6z6wrvj7PZsMZX7rrqAw', 29, 1745670309, 1745742309),
('UZbIME0jsFpSgSpJi8jShLqN-m7lSt6r_qH61SQa8do', 29, 1745670393, 1745742393),
('Whef-xwagckfVu_ICC4soKWpBYvSsmsL9JpiK8ACc00', 29, 1745670393, 1745742393),
('RXnH9_D3J5qon8lGSlg78-GqDVh5ii3o7JcrE7l_H34', 29, 1745670468, 1745742468),
('lNnWsFguk9AhvkIJxEfSObQ9S7qgXfzUuIkkpk8MXJs', 29, 1745670468, 1745742468),
('TvtX3TCOxjWwuHSvaEUt01Sl8iJW1bwL8mccHSRQv3E', 0.201399, 1745866971, 1746039771),
('4SIEqVSrUfbHDykIMNzQgj4bibgxQ9QnYLpxlq-85Dk', 2, 1745857094, 1746375494),
('WH6IzilVKA6CYsX0qXCyefg69ls837C7lmVV1w37oVw', 29, 1745857094, 1745929094),
('hYdWY3v7oTXqTp30C0-RpSgNzdzMGDI_m_N1XNw_rDU', 29, 1745857094, 1745929094),
('OMhkmdh1HUEdNPRi-Pe4279tbL5SQ-WMYf551VVvH8U', 19, 1745864613, 1745900613),
('owPEBdvNSA0qeBKgwaJ0jcxZwoYltJBHZXyB5RyuxRE', 499, 1745864613, 1746037413),
('h47_8SER5DSOq0Rb4fV5eQYELvrQmJCw5xEoQFxLxPw', 98.0104, 1745866895, 1746039695);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Индексы таблицы `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Индексы таблицы `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
