-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2024 at 11:03 PM
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
-- Database: `vizsgaremek`
--
CREATE DATABASE IF NOT EXISTS `vizsgaremek` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `vizsgaremek`;

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `pontok` int(20) UNSIGNED DEFAULT NULL,
  `letrehozasi_ido` timestamp NULL DEFAULT current_timestamp(),
  `utolso_valt_ido` timestamp NULL DEFAULT current_timestamp(),
  `tipus` int(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 - átlagos felhasználó extra jogok nélkül\r\n1 - moderátor\r\n2 - admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `nev`, `email`, `jelszo`, `pontok`, `letrehozasi_ido`, `utolso_valt_ido`, `tipus`) VALUES
(8, 'domebence', 'domebence05@gmail.com', '$2y$10$Ess83oBvqpb/FNdwH03Ql.lMm4huaJqUqwkDkfdaFiH6ZlzNkSS62', NULL, '2024-11-03 18:54:08', '2024-11-03 18:54:08', 0),
(9, 'asdasd', 'asd@gmail.com', '$2y$10$KJTLl7Qqkm7DnfdAtdEvNetENP4Ng9dOkDLQpHUzdLSRKW83s7wAi', NULL, '2024-11-03 19:07:18', '2024-11-03 19:07:18', 0),
(10, 'asdasda', 'asd@gmail.asd', '$2y$10$clQg6DpD5m07xd7egr7vweZzjTUH.q5bemOVM4XJE68R/QzXFRpuK', NULL, '2024-11-03 19:08:00', '2024-11-03 19:08:00', 0),
(11, 'szalami', 'szalami53@gmail.com', '$2y$10$dsiNf/W/YlE.wgEz/XP2W.acz/a5h5pnntz1AsJCAWMQDCQa7x2Oy', NULL, '2024-11-04 18:11:05', '2024-11-04 18:11:05', 0),
(12, 'sdkfnas', 'ajkdnasud@gmail.com', '$2y$10$unenSCeIYKTRBy/T5hBOEug6xdA1hBkRXS7sy.I/D72kaRv2XxSJS', NULL, '2024-11-04 18:22:06', '2024-11-04 18:22:06', 0),
(16, 'dasdqwdsdasad', 'asd@gmail.asdasdasjhd', '$2y$10$Tyae7rimLuSs2F1H2.O16OBCapzi5xKRbE5jSwb3BYYiQ7qW4DbDC', NULL, '2024-11-05 19:19:01', '2024-11-05 19:19:01', 0),
(21, 'asdasdkqwjndiqw', 'asdkjnqwiduwn@gmail.com', '$2y$10$.TisHXizNL3qsfWaf6dMYu2YaFmVV.qeKtGXq0v89IaJSAaCAPCiC', NULL, '2024-11-05 19:36:49', '2024-11-05 19:36:49', 0),
(24, 'fghjkl', 'dfghj@gmail.com', '$2y$10$DMPCSo9kJoaAcq1FzOBviONn1WPxQORS6sRFZ/Lca748fXByCcxZK', NULL, '2024-11-05 19:48:12', '2024-11-05 19:48:12', 0),
(30, 'asbdasujdbas', 'asd23@gmail.com', '$2y$10$/9r9PzjGPIv.oFIol7Yiqu2uRben73HkZ0rSMv7uBjiBNg6AkDC6q', NULL, '2024-11-08 19:48:33', '2024-11-08 19:48:33', 0),
(32, 'asdasdasdasd', 'asdasd@asdasd.comasd', '$2y$10$vZXtFU4vwV5JH743zXfpleD0QrNql9suF2p2CDTmKuQSHkYal/okW', NULL, '2024-11-08 20:06:25', '2024-11-08 20:06:25', 0),
(35, 'asdasdasdasdasd', 'asdasd@asdaasd.comasdqwe', '$2y$10$HdhmEuL.0PMEXriuuZnSWejaLcPru1bCrhTKzncZ/GgDvPGGQHVcy', NULL, '2024-11-08 20:52:45', '2024-11-08 20:52:45', 0),
(37, 'asdwdasdasdsad', 'asdasd@gmail.comasdqy', '$2y$10$j.jz.PTp2drrBjR6QgsyRe6.LSNh8CkaHVY4bDvWRKYEXTW5xkZB2', NULL, '2024-11-08 20:59:28', '2024-11-08 20:59:28', 0),
(39, 'qdaaxcvsqada', 'sxcsadcf@gmail.com', '$2y$10$o0cLtam1U/s6SjhpeZlgkuA2M5iQ/iGbzP9dNxA/7GMgBGR4HuxI6', NULL, '2024-11-09 19:23:52', '2024-11-09 19:23:52', 0),
(50, 'asdasdasd', 'asdasd@asdasd.com', '$2y$10$SddVo69rgVZpWFE.XjRQve/e2s5umxb8ih2AzUSF2QXw0YpYzCTiC', NULL, '2024-11-10 18:48:21', '2024-11-10 18:48:21', 0),
(60, 'asdadasd', 'asd1231@gmail.com', '$2y$10$.ukcTAGhN51RbzSG3dpt6./OHXlNQZRq4a.NKlUqw3U8S9X0gXf9i', NULL, '2024-11-13 15:19:22', '2024-11-13 15:19:22', 0),
(61, 'domebence2', 'asdasd2@asdasd.com', '$2y$10$iccKUDisibiLDtXsT4TcLOHiWcfT73NJPW5fxXlCc83htmt45C2Y2', NULL, '2024-11-13 15:20:18', '2024-11-13 15:20:18', 0),
(62, 'asdasd2', 'asd2@gmail.com', '$2y$10$JmwK783ksOVu2/FF.hQBWe1zeWXRJ2k7NrC7tEK7aX2gWZrGNV2RW', NULL, '2024-11-13 15:28:37', '2024-11-13 15:28:37', 0),
(63, 'asd3', 'asd3@gmail.com', '$2y$10$kPWCvgp9iDtfq8eqWzQrYux4/hGigacgeI0RbYC2E2EewRndf4bsy', NULL, '2024-11-13 15:30:20', '2024-11-13 15:30:20', 0),
(64, 'asd4', 'asd4@gmail.com', '$2y$10$20HBQXCP/2fPTXU0w8FcTObFKygKz2yP2ggnyMFeAoCDX6cTR4XEC', NULL, '2024-11-13 15:31:52', '2024-11-13 15:31:52', 0),
(65, 'asd5', 'asd5@gmail.com', '$2y$10$7kPGCcCe9O5cYZPAHv686.H/Qz/9KV.CQ.M.EkjUb3jQtKe9aoyTS', NULL, '2024-11-13 15:33:35', '2024-11-13 15:33:35', 0),
(66, 'asd6', 'asd6@gmail.com', '$2y$10$NtXCs1wC9eQ97Cb6hD3/ourFyyoFvfnEZg1mrexx0poySNbRR5mNi', NULL, '2024-11-13 15:41:48', '2024-11-13 15:41:48', 0),
(67, 'asd7', 'asd7@gmail.com', '$2y$10$LdajDoucW322q0M.Qo/f/O0soVwlh5xzxQ/25Yb0hTV25UJNakkQm', NULL, '2024-11-13 15:44:27', '2024-11-13 15:44:27', 0),
(68, 'asd8', 'asd8@gmail.com', '$2y$10$UDXi8EPDJkr8uaDHMtUTAu5g.F6VJEBz/7XySv/C2n7jukn7hN1Fa', NULL, '2024-11-13 15:46:16', '2024-11-13 15:46:16', 0),
(69, 'asd10', 'asd10@gmail.com', '$2y$10$pBpG0qJ5I4o.QqZg62eA3eA83Ji3nKvO.e10ZsKdWKWOp4d8XFJuO', NULL, '2024-11-14 20:29:44', '2024-11-14 20:29:44', 0),
(73, 'asdasd21', 'asdasd32@asdasd.com', '$2y$10$qTd66uBNn20gHz00Gtk9mufGi0QbvG51lyyXJOBPHvksAKYNmRzA2', NULL, '2024-11-14 20:34:12', '2024-11-14 20:34:12', 0),
(74, 'asdasdasd23', 'asd13@gmail.com', '$2y$10$5OnTDPQ7BvAdqeiCHMhCyeK67rrt1RME7PU9KZ8XknyAlnEdhePRS', NULL, '2024-11-14 20:34:36', '2024-11-14 20:34:36', 0),
(75, 'asdasdasd24', 'as32d@gmail.com', '$2y$10$fm.QrkzuBRE4rEMk26cWfe2UG3EDN4jBE285ALjGDh1Uonbc3znhy', NULL, '2024-11-14 20:35:31', '2024-11-14 20:35:31', 0),
(77, 'domebence23', 'asd12@gmail.com', '$2y$10$wXWU3vx.9yeAuUGZhjaLBOjVja0yMjlMIxlSDMu.mrAbR75rueu6e', NULL, '2024-11-15 16:38:14', '2024-11-15 16:38:14', 0),
(78, 'asd12345', 'asd12345@gmail.com', '$2y$10$50OLWwIgHiC9gP7fOc5Dq.EpNNh98qgZIkaqjRK7I2k5W.QOQOXsG', NULL, '2024-11-16 10:45:57', '2024-11-16 10:45:57', 0),
(79, 'admin', 'admin@gmail.com', '$2y$10$hh/F/6sm3iND/0IJk..GTunJsoUYRLuDWEHhJ3UUDdtCXoAJlnw7G', NULL, '2024-11-29 07:04:49', '2024-11-29 07:04:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo_token`
--

CREATE TABLE `felhasznalo_token` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `lejarat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felhasznalo_token`
--

INSERT INTO `felhasznalo_token` (`id`, `felhasznalo_id`, `token`, `lejarat`) VALUES
(1, 79, '$2y$10$2.KbYP0wKSbGztENnlepQehPjGl1p09FESn98cFnSQD6HHH.VOXMW', '2025-01-12 18:11:20'),
(4, 79, '$2y$10$04JXGh4XaKiwMs.gwAmb2uT0xCcAzgs04dI9ORy8fytKOKAkbHb6.', '2025-01-12 18:24:12'),
(5, 79, '$2y$10$ASz7H1WaDvvV8n1ZLC5vGe7iS.782el/ygBiyD83wUJfrk/IXhHfe', '2025-01-14 13:21:07'),
(6, 79, '$2y$10$j7dziuLGQsnpST0f15ucbuo1zlEYVoiVkFUBxhqzHDbaQSRbuA56a', '2025-01-15 17:23:16');

--
-- Triggers `felhasznalo_token`
--
DELIMITER $$
CREATE TRIGGER `lejart_tokenek_torlese` AFTER UPDATE ON `felhasznalo_token` FOR EACH ROW DELETE FROM felhasznalo_token WHERE lejarat < NOW()
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `felkeres`
--

CREATE TABLE `felkeres` (
  `id` int(10) UNSIGNED NOT NULL,
  `cim` varchar(50) NOT NULL,
  `szoveg` varchar(255) NOT NULL,
  `feltoltesi_ido` timestamp NULL DEFAULT NULL,
  `jovahagyott` tinyint(1) NOT NULL,
  `ar` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `felkeres_elvallal_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `felkeres_elvallal`
--

CREATE TABLE `felkeres_elvallal` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `elvallalasi_ido` timestamp NULL DEFAULT NULL,
  `elvallalt` tinyint(1) NOT NULL,
  `felkeres_teljesit_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `felkeres_teljesit`
--

CREATE TABLE `felkeres_teljesit` (
  `id` int(10) UNSIGNED NOT NULL,
  `befejezesi_ido` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `nev`) VALUES
(1, 'php');

-- --------------------------------------------------------

--
-- Table structure for table `kod`
--

CREATE TABLE `kod` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `kategoria_id` int(10) UNSIGNED NOT NULL,
  `kod_eleresi_ut` varchar(30) NOT NULL,
  `feltoltesi_ido` timestamp NULL DEFAULT current_timestamp(),
  `jovahagyott` tinyint(1) DEFAULT NULL,
  `like_szam` int(10) UNSIGNED DEFAULT NULL,
  `dislike_szam` int(10) UNSIGNED DEFAULT NULL,
  `kod_komment_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kod`
--

INSERT INTO `kod` (`id`, `felhasznalo_id`, `kategoria_id`, `kod_eleresi_ut`, `feltoltesi_ido`, `jovahagyott`, `like_szam`, `dislike_szam`, `kod_komment_id`) VALUES
(3, 30, 1, './asd', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kodellenorzes`
--

CREATE TABLE `kodellenorzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `kod_id` int(10) UNSIGNED NOT NULL,
  `jovahagyasi_ido` timestamp NULL DEFAULT NULL,
  `folyamatban` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kod_komment`
--

CREATE TABLE `kod_komment` (
  `id` int(10) UNSIGNED NOT NULL,
  `kod_id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `szoveg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kod_like`
--

CREATE TABLE `kod_like` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `kod_id` int(10) UNSIGNED NOT NULL,
  `ertek` tinyint(1) NOT NULL COMMENT '0 = dislike\r\n1 = like',
  `idopont` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kod_like`
--

INSERT INTO `kod_like` (`id`, `felhasznalo_id`, `kod_id`, `ertek`, `idopont`) VALUES
(1, 32, 3, 0, '2024-12-15 13:36:40'),
(2, 30, 3, 0, '2024-12-15 13:18:52'),
(4, 32, 3, 1, '2024-12-15 14:01:52'),
(15, 8, 3, 1, '2024-12-16 22:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `moderator_ellenorzes`
--

CREATE TABLE `moderator_ellenorzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `ugyfelszolgalat_id` int(10) UNSIGNED NOT NULL,
  `felkeres_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ugyfelszolgalat`
--

CREATE TABLE `ugyfelszolgalat` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `uzenet` varchar(255) NOT NULL,
  `feltoltesi_ido` timestamp NULL DEFAULT NULL,
  `folyamatban` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nev` (`nev`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `felhasznalo_token`
--
ALTER TABLE `felhasznalo_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- Indexes for table `felkeres`
--
ALTER TABLE `felkeres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `felkeres_elvallal_id` (`felkeres_elvallal_id`);

--
-- Indexes for table `felkeres_elvallal`
--
ALTER TABLE `felkeres_elvallal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `felkeres_teljesit_id` (`felkeres_teljesit_id`);

--
-- Indexes for table `felkeres_teljesit`
--
ALTER TABLE `felkeres_teljesit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kod`
--
ALTER TABLE `kod`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `kod_komment_id` (`kod_komment_id`);

--
-- Indexes for table `kodellenorzes`
--
ALTER TABLE `kodellenorzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `kod_id` (`kod_id`);

--
-- Indexes for table `kod_komment`
--
ALTER TABLE `kod_komment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `kod_id` (`kod_id`);

--
-- Indexes for table `kod_like`
--
ALTER TABLE `kod_like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `kod_id` (`kod_id`);

--
-- Indexes for table `moderator_ellenorzes`
--
ALTER TABLE `moderator_ellenorzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderator_id` (`felhasznalo_id`),
  ADD KEY `ugyfelszolgalat_id` (`ugyfelszolgalat_id`),
  ADD KEY `felkeres_id` (`felkeres_id`);

--
-- Indexes for table `ugyfelszolgalat`
--
ALTER TABLE `ugyfelszolgalat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `felhasznalo_token`
--
ALTER TABLE `felhasznalo_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `felkeres`
--
ALTER TABLE `felkeres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `felkeres_elvallal`
--
ALTER TABLE `felkeres_elvallal`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `felkeres_teljesit`
--
ALTER TABLE `felkeres_teljesit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kod`
--
ALTER TABLE `kod`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kodellenorzes`
--
ALTER TABLE `kodellenorzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kod_komment`
--
ALTER TABLE `kod_komment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kod_like`
--
ALTER TABLE `kod_like`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `moderator_ellenorzes`
--
ALTER TABLE `moderator_ellenorzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ugyfelszolgalat`
--
ALTER TABLE `ugyfelszolgalat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `felhasznalo_token`
--
ALTER TABLE `felhasznalo_token`
  ADD CONSTRAINT `felhasznalo_token_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `felkeres`
--
ALTER TABLE `felkeres`
  ADD CONSTRAINT `felkeres_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `felkeres_ibfk_2` FOREIGN KEY (`felkeres_elvallal_id`) REFERENCES `felkeres_elvallal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `felkeres_elvallal`
--
ALTER TABLE `felkeres_elvallal`
  ADD CONSTRAINT `felkeres_elvallal_ibfk_1` FOREIGN KEY (`felkeres_teljesit_id`) REFERENCES `felkeres_teljesit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `felkeres_elvallal_ibfk_2` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kod`
--
ALTER TABLE `kod`
  ADD CONSTRAINT `kod_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kod_ibfk_2` FOREIGN KEY (`kod_komment_id`) REFERENCES `kod_komment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kodellenorzes`
--
ALTER TABLE `kodellenorzes`
  ADD CONSTRAINT `kodellenorzes_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kodellenorzes_ibfk_2` FOREIGN KEY (`kod_id`) REFERENCES `kod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kod_komment`
--
ALTER TABLE `kod_komment`
  ADD CONSTRAINT `kod_komment_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kod_komment_ibfk_2` FOREIGN KEY (`kod_id`) REFERENCES `kod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kod_like`
--
ALTER TABLE `kod_like`
  ADD CONSTRAINT `kod_like_ibfk_1` FOREIGN KEY (`kod_id`) REFERENCES `kod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `moderator_ellenorzes`
--
ALTER TABLE `moderator_ellenorzes`
  ADD CONSTRAINT `moderator_ellenorzes_ibfk_1` FOREIGN KEY (`ugyfelszolgalat_id`) REFERENCES `ugyfelszolgalat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moderator_ellenorzes_ibfk_2` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moderator_ellenorzes_ibfk_3` FOREIGN KEY (`felkeres_id`) REFERENCES `felkeres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ugyfelszolgalat`
--
ALTER TABLE `ugyfelszolgalat`
  ADD CONSTRAINT `ugyfelszolgalat_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
