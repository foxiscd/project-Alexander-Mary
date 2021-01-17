-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2021 at 09:22 PM
-- Server version: 5.7.25
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suite_maru`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_setting`
--

CREATE TABLE `account_setting` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `about_me` varchar(150) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_setting`
--

INSERT INTO `account_setting` (`id`, `user_id`, `avatar`, `about_me`, `phone`, `address`) VALUES
(1, 37, '', 'its me', NULL, 'cheliab');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1604335434),
('m201102_163439_create_user_table', 1604598124),
('m201115_113028_create_admin_column', 1605440269),
('m201115_114619_create_photo_table', 1605454727),
('m201128_101348_create_post_table', 1606558799),
('m210117_134823_create_account_setting_table', 1610891971);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  `picture` varchar(255) NOT NULL,
  `directions` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `created_at`, `updated_at`, `picture`, `directions`, `description`, `title`) VALUES
(48, '2020-11-16', '2021-01-17', '/image/uploads/portfolio/21JX9oy3PpU.jpg', 'child', 'Описание', 'Картинкаjdf'),
(50, '2020-11-22', '2020-11-28', '/image/uploads/portfolio/s3.jpg', 'child', 'Здесть описание блока', 'Здарова я бродяга'),
(53, '2020-11-23', '2020-11-28', '/image/uploads/portfolio/bg1.jpg', 'love-story', '1234', 'google 1'),
(54, '2021-01-15', '2021-01-15', '/image/uploads/portfolio/1.jpg', 'love-story', 'Описание', 'google 1'),
(57, '2021-01-17', '2021-01-17', '/image/uploads/portfolio/3NhUz2EDlXc.jpg', 'love-story', 'Описание', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `picture`, `title`, `description`, `theme`, `author_id`, `created_at`, `updated_at`) VALUES
(1, '/image/uploads/portfolio/google (1).png', '1234', 'Тут текст сообщения обновляющийся автоматически', 'Тема сообщения', 39, '2020-11-28', '2021-01-17'),
(2, '/image/uploads/post/bb4.jpg', 'Сообщение 2', 'Тут текст номер 2', 'Обучение', 39, '2020-11-28', '2020-11-28'),
(3, '/image/uploads/post/blog1.jpg', 'Сообщение 1', 'Тут текст номер 2', 'Тема сообщения', 39, '2020-11-28', '2020-11-28'),
(4, '/image/uploads/post/bbb3.jpg', 'Сообщение 3', 'Тут текст номер 3', 'Тема сообщения 2', 39, '2020-11-28', '2020-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `auth_token` varchar(255) DEFAULT '0',
  `activate_status` int(11) NOT NULL DEFAULT '0',
  `activate_code` varchar(255) DEFAULT NULL,
  `create_at` date NOT NULL,
  `update_at` date NOT NULL,
  `role` varchar(64) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password_hash`, `nickname`, `auth_token`, `activate_status`, `activate_code`, `create_at`, `update_at`, `role`) VALUES
(3, 'foxiscd123@mail.ru', '$2y$13$.x3VJsPJLVxPLMPpaF4P7.Bd5kX6Pc537lrmcKzc3bJKntDyBrnZ.', 'Grigory', 'TeOIYswL0yQfxxIJwfc0rBmLFfotKKOR', 0, '0Z8F8gG8bSARGJy5RKs4ADfqu9z_65MC', '2020-11-06', '2020-11-06', 'user'),
(7, 'gaga@mail.ru', '$2y$13$G94EXX5vcY96XdVfuXvyCexmaC4FsrwQpY6qB44aMsvuBPo6nvkMC', 'gaga', 'rT2nSzaQXSFfBASL1ZIVkNMBG2VA4XFl', 0, 'a5eCLFP7pHneuEZX7_i_XawUXVB-tr9H', '2020-11-07', '2020-11-07', 'user'),
(8, 'shelestov.serezha@mail.ru', '$2y$13$Unsu8UU.6iE9Yt49yB81GugfXMi7/8oTxl9pquGakJYg7Wck5IO9.', 'Сергей', '483572d646a517cd75cd3125858bb12398b3fbd9299cf1687737c6f1365cb1e05852d67b2dda30ca36674', 2, NULL, '2020-11-07', '2020-11-07', 'user'),
(9, 'eebo@mail.ru', '$2y$13$k9KOLIaCEh2N.wuiwsqloOOAatfnHx0O.gf/Qrqglgtd.Ohx8Kjbm', 'Владимир', 'c632c44886a3ffa9200d30b6f70d28ff3f16184cd209d4bdb6c4feeb0aee7c82ad2d448668cc5d708e124', 2, NULL, '2020-11-08', '2020-11-08', 'user'),
(37, 'foxiscd174@mail.ru', '$2y$13$NBCP8rIFBv2zKmwMd8HCw.zFwM282RDJTP/.Ugl9qH20ST6lWykUa', 'foxiscd174@mail.ru', 'PJGiuv4QCeCCaBl2L7ac-J5opULcF6qM', 1, 'yuQAMZioFzGmCwbtK8h1RiqvcTeOn413', '2020-11-14', '2020-11-14', 'user'),
(39, 'foxiscd@mail.ru', '$2y$13$J0eSorsoqngWagJuCcscx./RRBQXOowXbl9VTDCBO3oUJrxUKFoo2', 'foxiscd@mail.ru', 'lXfaYX2salA8uWRT0UqwysRSBU9PbAxd', 1, 'Xolcz5XpQ9oChK3mKmn92FRZc7fOSsY6', '2020-11-14', '2020-11-14', 'admin'),
(45, 'foxiscd@gmail.ru', '$2y$13$k4p6fZYA/FNMIRVzpyFJpO3evv53F.L.GYpv6L7mYvx3Gv0n2R7Dy', 'foxiscd@gmail.ru', '9uJbpgvEcKGHP0ZetmKoJJEFtKRa18yW', 0, 'tju4vOcbpD6pkuT990ad2FhoasNei8R9', '2021-01-15', '2021-01-15', 'user'),
(46, 'foxiscd74@gmail.com', '$2y$13$4wdy/kXBgLUKdW1ptok62OQlqjh2N/sNJgsscXcv7d2H6PnsJ5IW6', 'foxiscd74@gmail.com', 'E57GsXxnCS2-fYHjiwtxYKlvfE4ngs4J', 0, 'tBpvMaygZECDwfyBa7AvVRiDxcD7K06n', '2021-01-15', '2021-01-15', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_setting`
--
ALTER TABLE `account_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_setting`
--
ALTER TABLE `account_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
