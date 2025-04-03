-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2025 at 09:55 PM
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
  `pontok` int(20) UNSIGNED DEFAULT 0,
  `letrehozasi_ido` timestamp NULL DEFAULT current_timestamp(),
  `utolso_valt_ido` timestamp NULL DEFAULT current_timestamp(),
  `tipus` int(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 - átlagos felhasználó extra jogok nélkül\r\n1 - moderátor\r\n2 - admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felhasznalo`
--

INSERT INTO `felhasznalo` (`id`, `nev`, `email`, `jelszo`, `pontok`, `letrehozasi_ido`, `utolso_valt_ido`, `tipus`) VALUES
(8, 'domebence', 'domebence05@gmail.com', '$2y$10$Ess83oBvqpb/FNdwH03Ql.lMm4huaJqUqwkDkfdaFiH6ZlzNkSS62', 650, '2024-11-03 18:54:08', '2024-11-03 18:54:08', 2),
(9, 'asdasd', 'asd@gmail.com', '$2y$10$KJTLl7Qqkm7DnfdAtdEvNetENP4Ng9dOkDLQpHUzdLSRKW83s7wAi', NULL, '2024-11-03 19:07:18', '2024-11-03 19:07:18', 2),
(10, 'asdasda', 'asd@gmail.asd', '$2y$10$clQg6DpD5m07xd7egr7vweZzjTUH.q5bemOVM4XJE68R/QzXFRpuK', NULL, '2024-11-03 19:08:00', '2024-11-03 19:08:00', 2),
(11, 'szalami', 'szalami53@gmail.com', '$2y$10$dsiNf/W/YlE.wgEz/XP2W.acz/a5h5pnntz1AsJCAWMQDCQa7x2Oy', NULL, '2024-11-04 18:11:05', '2024-11-04 18:11:05', 2),
(12, 'sdkfnas', 'ajkdnasud@gmail.com', '$2y$10$unenSCeIYKTRBy/T5hBOEug6xdA1hBkRXS7sy.I/D72kaRv2XxSJS', NULL, '2024-11-04 18:22:06', '2024-11-04 18:22:06', 2),
(16, 'dasdqwdsdasad', 'asd@gmail.asdasdasjhd', '$2y$10$Tyae7rimLuSs2F1H2.O16OBCapzi5xKRbE5jSwb3BYYiQ7qW4DbDC', NULL, '2024-11-05 19:19:01', '2024-11-05 19:19:01', 2),
(21, 'asdasdkqwjndiqw', 'asdkjnqwiduwn@gmail.com', '$2y$10$.TisHXizNL3qsfWaf6dMYu2YaFmVV.qeKtGXq0v89IaJSAaCAPCiC', NULL, '2024-11-05 19:36:49', '2024-11-05 19:36:49', 2),
(24, 'fghjkl', 'dfghj@gmail.com', '$2y$10$DMPCSo9kJoaAcq1FzOBviONn1WPxQORS6sRFZ/Lca748fXByCcxZK', NULL, '2024-11-05 19:48:12', '2024-11-05 19:48:12', 2),
(30, 'asbdasujdbas', 'asd23@gmail.com', '$2y$10$/9r9PzjGPIv.oFIol7Yiqu2uRben73HkZ0rSMv7uBjiBNg6AkDC6q', NULL, '2024-11-08 19:48:33', '2024-11-08 19:48:33', 2),
(32, 'asdasdasdasd', 'asdasd@asdasd.comasd', '$2y$10$vZXtFU4vwV5JH743zXfpleD0QrNql9suF2p2CDTmKuQSHkYal/okW', NULL, '2024-11-08 20:06:25', '2024-11-08 20:06:25', 2),
(35, 'asdasdasdasdasd', 'asdasd@asdaasd.comasdqwe', '$2y$10$HdhmEuL.0PMEXriuuZnSWejaLcPru1bCrhTKzncZ/GgDvPGGQHVcy', NULL, '2024-11-08 20:52:45', '2024-11-08 20:52:45', 2),
(37, 'asdwdasdasdsad', 'asdasd@gmail.comasdqy', '$2y$10$j.jz.PTp2drrBjR6QgsyRe6.LSNh8CkaHVY4bDvWRKYEXTW5xkZB2', NULL, '2024-11-08 20:59:28', '2024-11-08 20:59:28', 2),
(39, 'qdaaxcvsqada', 'sxcsadcf@gmail.com', '$2y$10$o0cLtam1U/s6SjhpeZlgkuA2M5iQ/iGbzP9dNxA/7GMgBGR4HuxI6', NULL, '2024-11-09 19:23:52', '2024-11-09 19:23:52', 2),
(50, 'asdasdasd', 'asdasd@asdasd.com', '$2y$10$SddVo69rgVZpWFE.XjRQve/e2s5umxb8ih2AzUSF2QXw0YpYzCTiC', NULL, '2024-11-10 18:48:21', '2024-11-10 18:48:21', 2),
(60, 'asdadasd', 'asd1231@gmail.com', '$2y$10$.ukcTAGhN51RbzSG3dpt6./OHXlNQZRq4a.NKlUqw3U8S9X0gXf9i', NULL, '2024-11-13 15:19:22', '2024-11-13 15:19:22', 2),
(61, 'domebence2', 'asdasd2@asdasd.com', '$2y$10$iccKUDisibiLDtXsT4TcLOHiWcfT73NJPW5fxXlCc83htmt45C2Y2', NULL, '2024-11-13 15:20:18', '2024-11-13 15:20:18', 2),
(62, 'asdasd2', 'asd2@gmail.com', '$2y$10$JmwK783ksOVu2/FF.hQBWe1zeWXRJ2k7NrC7tEK7aX2gWZrGNV2RW', NULL, '2024-11-13 15:28:37', '2024-11-13 15:28:37', 2),
(63, 'asd3', 'asd3@gmail.com', '$2y$10$kPWCvgp9iDtfq8eqWzQrYux4/hGigacgeI0RbYC2E2EewRndf4bsy', NULL, '2024-11-13 15:30:20', '2024-11-13 15:30:20', 2),
(64, 'asd4', 'asd4@gmail.com', '$2y$10$20HBQXCP/2fPTXU0w8FcTObFKygKz2yP2ggnyMFeAoCDX6cTR4XEC', NULL, '2024-11-13 15:31:52', '2024-11-13 15:31:52', 2),
(65, 'asd5', 'asd5@gmail.com', '$2y$10$7kPGCcCe9O5cYZPAHv686.H/Qz/9KV.CQ.M.EkjUb3jQtKe9aoyTS', NULL, '2024-11-13 15:33:35', '2024-11-13 15:33:35', 2),
(66, 'asd6', 'asd6@gmail.com', '$2y$10$NtXCs1wC9eQ97Cb6hD3/ourFyyoFvfnEZg1mrexx0poySNbRR5mNi', NULL, '2024-11-13 15:41:48', '2024-11-13 15:41:48', 2),
(67, 'asd7', 'asd7@gmail.com', '$2y$10$LdajDoucW322q0M.Qo/f/O0soVwlh5xzxQ/25Yb0hTV25UJNakkQm', NULL, '2024-11-13 15:44:27', '2024-11-13 15:44:27', 2),
(68, 'asd8', 'asd8@gmail.com', '$2y$10$UDXi8EPDJkr8uaDHMtUTAu5g.F6VJEBz/7XySv/C2n7jukn7hN1Fa', NULL, '2024-11-13 15:46:16', '2024-11-13 15:46:16', 2),
(69, 'asd10', 'asd10@gmail.com', '$2y$10$pBpG0qJ5I4o.QqZg62eA3eA83Ji3nKvO.e10ZsKdWKWOp4d8XFJuO', NULL, '2024-11-14 20:29:44', '2024-11-14 20:29:44', 2),
(73, 'asdasd21', 'asdasd32@asdasd.com', '$2y$10$qTd66uBNn20gHz00Gtk9mufGi0QbvG51lyyXJOBPHvksAKYNmRzA2', NULL, '2024-11-14 20:34:12', '2024-11-14 20:34:12', 2),
(74, 'asdasdasd23', 'asd13@gmail.com', '$2y$10$5OnTDPQ7BvAdqeiCHMhCyeK67rrt1RME7PU9KZ8XknyAlnEdhePRS', NULL, '2024-11-14 20:34:36', '2024-11-14 20:34:36', 2),
(75, 'asdasdasd24', 'as32d@gmail.com', '$2y$10$fm.QrkzuBRE4rEMk26cWfe2UG3EDN4jBE285ALjGDh1Uonbc3znhy', NULL, '2024-11-14 20:35:31', '2024-11-14 20:35:31', 2),
(77, 'domebence23', 'asd12@gmail.com', '$2y$10$wXWU3vx.9yeAuUGZhjaLBOjVja0yMjlMIxlSDMu.mrAbR75rueu6e', NULL, '2024-11-15 16:38:14', '2024-11-15 16:38:14', 2),
(78, 'asd12345', 'asd12345@gmail.com', '$2y$10$50OLWwIgHiC9gP7fOc5Dq.EpNNh98qgZIkaqjRK7I2k5W.QOQOXsG', NULL, '2024-11-16 10:45:57', '2024-11-16 10:45:57', 2),
(79, 'admin', 'admin@gmail.com', '$2y$10$hh/F/6sm3iND/0IJk..GTunJsoUYRLuDWEHhJ3UUDdtCXoAJlnw7G', NULL, '2024-11-29 07:04:49', '2024-11-29 07:04:49', 2),
(82, 'domebence63', 'dome123@gmail.com', '$2y$10$DkBd3FDFdpgTfQE0DDloJO1AA/IHx6iN2P37dS/20u343/lkvwS9m', NULL, '2024-12-19 16:35:31', '2024-12-19 16:35:31', 2),
(90, 'kolbasz123451', 'kolbi@gmail.com', '$2y$10$yU7rQJucXDOYYwGQmTzMp.Ojs5/9u7YhP24T1YLiifcV86Y9fnioC', NULL, '2025-01-19 19:19:13', '2025-01-19 19:19:13', 2),
(92, 'adminqweyxdc', 'asasdqweyxc@gmail.com', '$2y$10$JP3kNIM3WKYj1hIFynKHc.nUZGvXfLzE182tGfcRY5zHXTOe98pLC', NULL, '2025-01-19 19:29:22', '2025-01-19 19:29:22', 2),
(94, 'admin132kolbasz21', 'domebenc34213e05@gmail.com', '$2y$10$1wopi.ZlgMziUnEydas8H.NOMnRe.l1PDC2Sbkq6tWXSNqKd4s0sm', NULL, '2025-01-19 19:36:03', '2025-01-19 19:36:03', 2),
(98, 'finomkolbasz132312', '231cxc@gmail.com', '$2y$10$0siGLuy5/D.2T0WDvMIHQuckrxwcY5mZeT4WkLTEFJ9i5v1cFHycu', NULL, '2025-01-19 19:38:36', '2025-01-19 19:38:36', 2),
(109, 'admin52343', 'domebenc431323e05@gmail.com', '$2y$10$ncZw2P7mWKADvm9m87h/mOvTjS9Z5Ci07R7V/aksHbni9.LsNairy', NULL, '2025-01-19 19:44:33', '2025-01-19 19:44:33', 2),
(112, 'kolbasz4', 'kolb@gmail.com', '$2y$10$cfVe4UQ7XIu7LmGqXXQ9MuZAU1S8dUmz5kY3R2k8T2fkl6F/QjfPO', NULL, '2025-01-19 19:45:41', '2025-01-19 19:45:41', 2),
(113, 'kolbasz5', 'kolb34123@gmail.com', '$2y$10$Ua/hrfGqDdRMFs9vjBwzwO2pRVBBD0FcHa7QZjjlGcIL7Wy8/Qojm', NULL, '2025-01-19 19:47:37', '2025-01-19 19:47:37', 2),
(118, '103132ys', '4123dqwwe@gmail.com', '$2y$10$R8oPwHXvs0gRiRWODbbu/.0WxKR6JcbRBoAjCqyZG4kWygx6hIZ2.', NULL, '2025-01-19 19:54:29', '2025-01-19 19:54:29', 2),
(120, 'admin31423', 'domebence053435@gmail.com', '$2y$10$ER/p5elkKSAt1Y2zaj1QQ.5W94N1Rg0SgwvDxlccLjNy1MTP3ZKpa', NULL, '2025-01-19 19:55:48', '2025-01-19 19:55:48', 2),
(125, 'finomkolbasz13232412', 'domebencedasdqw05@gmail.coms', '$2y$10$fZfBNdz0rfHagqGAzrk4ZeqPcwIIOJByNputLlJQ5iF4d/GudoBYy', NULL, '2025-01-19 20:19:52', '2025-01-19 20:19:52', 2),
(127, 'nkasjdasdjkn', 'jndasdnasj@gmail.com', '$2y$10$fE1YRIJtJnfH1d9K.JGIR.AZev3DmbPqeRTmlkQsV5x6UAvCI1ydC', NULL, '2025-01-19 20:21:17', '2025-01-19 20:21:17', 2),
(128, 'finomkolb2344asz132', 'asda4323sdasdasdqwwe@gmail.com', '$2y$10$V1VAYPS4xgqJRQ4i93hCruQl27u7oVaELIn845mvnVxAjtxxNQUEm', NULL, '2025-01-19 20:23:27', '2025-01-19 20:23:27', 2),
(129, 'hbjsdahbjdsa', 'zudasgzudaszug213@gmail.com', '$2y$10$rVBeNG3FMHG1SwXpMBd47..5he6hp0UysEir.z8cXuakqPU5x15eW', NULL, '2025-01-19 20:24:16', '2025-01-19 20:24:16', 2),
(132, 'admin5', 'asdasdasdasdq13wwe@gmail.com', '$2y$10$j4sIoGVUDWPGr5CkrSGqyeyeu7G9sE6TUYmR58Hem5uQsI8eBD2R.', NULL, '2025-01-19 20:42:51', '2025-01-19 20:42:51', 2),
(145, 'domenybence', 'domebence023@gmail.com', '$2y$10$zqIVJQSo4J9BL1AUWikOfOoALbn1RZJGFRQNniWbO/84Ilxr1MUYK', NULL, '2025-01-20 21:08:25', '2025-01-20 21:08:25', 2),
(146, 'add122min123', 'domebence0dwqe5@gmail.com', '$2y$10$HGwAwIsFRIyg.a9W/p/ARO57V.oVkmT1GPxNlRW6R46Ow4/hbFTKW', NULL, '2025-02-03 17:08:15', '2025-02-03 17:08:15', 2),
(148, 'admin123123', 'domebence321431205@gmail.com', '$2y$10$yrfN03smAsrzI55CCp/vOu0AFepYJ4aJ8jln09.rtNAVwfPRBjZuC', NULL, '2025-02-03 17:10:18', '2025-02-03 17:10:18', 2),
(150, 'ujuser', 'user123@gmail.com', '$2y$10$y8Y.aea0p.ZO9BybBvswrOtcdJYC0wNybIepq5rPrF78KRyQ.N1aq', NULL, '2025-02-24 16:38:07', '2025-02-24 16:38:07', 0),
(151, 'mxteb', 'mxte_b@gmail.com', '$2y$10$CPD3Z9nZAoFCDAMBUc3RL.MWYL7lHk8wtgHYWMYbzoLqRysUPoc7O', NULL, '2025-03-03 17:20:32', '2025-03-03 17:20:32', 0),
(152, 'kjbdaskjndasjnk', 'kjnasd@gmail.com', '$2y$10$svndja3xcUslZX0yiqrvc.bPTT3yaYbG./DScTLERgKpAJxPCFBc6', NULL, '2025-03-03 18:04:55', '2025-03-03 18:04:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `felhasznalo_megvett`
--

CREATE TABLE `felhasznalo_megvett` (
  `id` int(11) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `kod_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felhasznalo_megvett`
--


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
(6, 79, '$2y$10$j7dziuLGQsnpST0f15ucbuo1zlEYVoiVkFUBxhqzHDbaQSRbuA56a', '2025-01-15 17:23:16'),
(7, 82, '$2y$10$O0BO/hEW1w..BzLXVLrMZ.Xq8F8Rf6giqbExG.vCR.Ee7si8WtpeG', '2025-01-18 16:35:50'),
(8, 79, '$2y$10$Sdw1P6Kli9057zu4wfI3IeI.BUq7gPyPo9/mTqNXrqi6d1LhVs.Ou', '2025-01-18 18:06:29'),
(9, 79, '$2y$10$E.iKz01WjRG3Yb49gDx/sOyFMxmK2LK38fws9WOfGqRvSfNHAVqrq', '2025-01-21 13:05:44'),
(10, 79, '$2y$10$tytvF13PnsZU9B3d.YIGoe6yrI01SO6tqdE0I1/Vp/ay6Nj34RgQe', '2025-02-09 18:05:10'),
(11, 79, '$2y$10$8UvzGQp8/yCe3DX2lgcrYuxlhDKIaker.eUmVBKeZF47ojS9fj3Hm', '2025-02-25 16:42:09'),
(12, 8, '$2y$10$2wpNLKv7JikOLM4PmTaw4.z15q7RIN1SN.SyuPEgoIPW3MTLBwZaG', '2025-02-25 16:43:23'),
(13, 8, '$2y$10$qYQEIEkfEwGYj7LtwgOY2.mOmXt3Jh0PdVQVMEyLOnkin/4EXX/2.', '2025-02-26 15:31:07'),
(14, 79, '$2y$10$cSKq5RY/3/vLGV7zDQBy.O4Ur4.fgmfdzW3z/D2q/92AWPrGz44Pm', '2025-02-26 18:18:55'),
(15, 79, '$2y$10$TmZ0E6AGh36YesqH1HFvmeOqXZNf/RUJTB2lY.nn3UXnQiEGgN2IG', '2025-02-26 18:22:53'),
(16, 8, '$2y$10$rmXXy5yGSSI/C2r8jCz/Hea0G4dBefBCAgVBO.UL4X0PDb9Jyg1Ai', '2025-02-26 18:34:35'),
(17, 8, '$2y$10$rxvSIJMX4pOsmQ20zj0FReV5d2bSLKRl5uExchKNUnK0VZa8oppQ6', '2025-02-26 19:10:57'),
(18, 8, '$2y$10$/nEOEgcMt.q/PnBirfFs0.saZdckivm1Le/VWmpW4LF9.ZEp1vN8m', '2025-03-04 08:56:09'),
(19, 79, '$2y$10$xZ8/wekZN3KeFkHFDodn2OTFyajgiHxVDJW3jJ0f0UGpz3GuvLZhS', '2025-03-05 16:00:32'),
(20, 79, '$2y$10$xSuFG/5yMHhMss4YrAVKB.shHf0Rds///vFHfZOf4RC6VaOXGCePe', '2025-03-05 17:01:59'),
(21, 79, '$2y$10$UDn3YasPvucvp9EF2.elf.6r9gl1QEp5JTOQPFmUkPADRu5qoxrDu', '2025-03-05 17:02:25'),
(22, 79, '$2y$10$Uq2ap6IyW/G7zZRufLbwlOhhnl637NHleORXFAZotgedPBwzzrXd6', '2025-03-05 17:04:42'),
(23, 79, '$2y$10$QiCqx3fAxD.RP1onb1qJKOJW08hO.1ihwvDI4XdngbRhmiu4D6IGi', '2025-03-05 17:05:18'),
(24, 79, '$2y$10$i3piqldtnj8jea.xDQv3Gu7OJwuUZwz.4zwFaGOLyI8vxO5A5CMgu', '2025-03-05 17:05:39'),
(25, 79, '$2y$10$kp4Hj9jl6zcI3asKk4Lad.SyBiexWmsCFfaWYYW6COCftg8jOBLzy', '2025-03-05 17:06:52'),
(26, 79, '$2y$10$piMC2uzC4bPx5vNOsfOu3OG4LFCrWb2CpYrIhWSjWer41OETmS6bu', '2025-03-05 17:07:23'),
(27, 79, '$2y$10$ZnFkoZfvBqo99ZQt/GqJxOmRS92U9tD.NMtNuDqUezcknnzniwU4e', '2025-03-05 17:12:13'),
(28, 79, '$2y$10$xQKbBpyVHY8clf0Ad1L0R.VNUTe3.pLqsiYf6mh3aOZt9fyE1.M9y', '2025-03-05 17:12:33'),
(29, 79, '$2y$10$H9aDsTcLbqxOaMwhwvYZvekvXBvXyCZ8NBPgGZVp1eUnfwLnl63U.', '2025-03-05 17:13:43'),
(30, 79, '$2y$10$sRvGoQ.6xFFG5W3E2dFD3uqRN8ldT/IiezelfUrYX5XjNFJ3VWlxC', '2025-03-05 17:14:43'),
(31, 79, '$2y$10$0RpU6gn65aIY.aI8LJTBxu.Go9a8bzru8mKh29BUoCyiRIeLlgpbK', '2025-03-05 17:18:09'),
(32, 79, '$2y$10$Eio4I1zV/dSgBbYxwUljEuNoh1zMKr38IU0EOsTYsRxgGcG/6p..q', '2025-03-05 17:19:04'),
(33, 79, '$2y$10$P0ILZWvGoOOfsCVhB0HCgOuyELiAdRAAUbTt34tcQDKDzzhDCftRq', '2025-03-07 17:22:36'),
(34, 8, '$2y$10$QBkQmz7q5auYJZj3yThwMewVbN7tHrOwZbKRr31s/FK6fbFMKF3/y', '2025-03-07 17:29:55'),
(35, 8, '$2y$10$edQC8S2sZRs.ixYCoxzLr.iVy6lldGV9yeWU4XMoyVSr6Iy9iKDiS', '2025-03-09 15:34:53'),
(36, 79, '$2y$10$UrpGYhYSaRla4NzQrWmwtu6e6/JqYiHLeFQ0FDLlJlBESa47xb.5C', '2025-03-09 16:32:59'),
(37, 79, '$2y$10$YUzmvSbncSI.BWOMKuqutuF23GbFXWyC2sWTsCj7rqzCPjIciC9dq', '2025-03-09 16:37:00'),
(38, 8, '$2y$10$XC4u9McbXQ/fwsHnr.sPxewYzA2e7dNKgLmPgpSy6MqLg5jI8hYNy', '2025-03-09 16:45:35'),
(39, 8, '$2y$10$9tY9s3DzhjPAD1FLzvDJFegyImLpnuBYWOUOIA9LRBIOMeoK5nXmC', '2025-03-16 13:53:46'),
(40, 8, '$2y$10$ge.FtpbqANXrgySi2ZIoduSYz0GMb1Zeg3wLBaxShmwWJs1WK5t2W', '2025-03-16 13:55:27'),
(41, 8, '$2y$10$fsdfWh60.KD.z1a76L9BSut766mH977Esnz3Wnsoi1bqaiyhGYyuO', '2025-03-18 07:50:32'),
(42, 8, '$2y$10$THG35L0vt7FhVrffPhI/Z.8.bxZYQ00i9Ves3MihWKBvdw3gM8YZa', '2025-03-19 18:57:43'),
(43, 79, '$2y$10$HOYYJB3wVIJDNR1SIYP5/eR0LUac5mOWzs5/9XjetAT//m6iNsz2S', '2025-03-22 20:10:58'),
(44, 79, '$2y$10$kKbKdxiURlVrxqSgjU9voedLHJMgSCDUsojpA2ETyt/QT5f7s9Eai', '2025-03-26 15:49:06'),
(45, 150, '$2y$10$L3UPpry3yrU/HjqITZ3s1ulXf2AqKcdgSHgKztc7939CJ8mGY7lbO', '2025-03-26 16:38:16'),
(46, 79, '$2y$10$YcNndJTORf8BSxrMwa99VOwXKUemNiDJEVBO3TmywPH/hB.QJduem', '2025-03-26 16:59:08'),
(47, 79, '$2y$10$4hKmtZfV.cH/FpRBUuHd1.Y/OU4Xz4VzHxxl4bsB.OyNbgAo.fWti', '2025-04-01 06:56:11'),
(48, 151, '$2y$10$fhRMsga.ciHG6jLaBXgf5.PXASrdqvp3so4ffOTx758DVY9Pvgqsi', '2025-04-02 16:20:41'),
(49, 152, '$2y$10$akMXlpmAuSIc4xIklQW3C.RG5l9IqC5MfD9/ZRPBhRRlKVN7xwps2', '2025-04-02 17:05:02'),
(50, 64, '$2y$10$UzwqRi8fixk3meVxufBL7.csXwxQAxnR3lhFk6zDq5V4FECW2WjLy', '2025-04-02 18:18:40'),
(51, 152, '$2y$10$hnU.phCfc41gRRKW/vdQGO5ey22zlpEszKjuBNBmvxsb/GFonrYJG', '2025-04-02 18:50:11'),
(52, 79, '$2y$10$PPPQa5s3koWbPKymCzk1l.1gAUWenKwmIae5lcRMdYyhtAZ1M.i1G', '2025-04-02 19:44:57');

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
  `nev` varchar(50) NOT NULL,
  `leiras` text DEFAULT NULL,
  `kod_id` int(10) UNSIGNED DEFAULT NULL,
  `kategoria_id` int(10) UNSIGNED DEFAULT NULL,
  `feltoltesi_ido` timestamp NOT NULL DEFAULT current_timestamp(),
  `jovahagyott` tinyint(1) NOT NULL,
  `statusz` enum('nyitott','folyamatban','teljesitve','elutasitva','jóváhagyott') NOT NULL DEFAULT 'nyitott',
  `ar` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `elvallalo_felhasznalo_id` int(10) UNSIGNED DEFAULT NULL,
  `befejezesi_ido` timestamp NULL DEFAULT NULL,
  `hatarido` datetime DEFAULT NULL,
  `kod_eleresi_ut` varchar(255) DEFAULT NULL,
  `beadas_ideje` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `felkeres`
--

INSERT INTO `felkeres` (`id`, `nev`, `leiras`, `kod_id`, `kategoria_id`, `feltoltesi_ido`, `jovahagyott`, `statusz`, `ar`, `felhasznalo_id`, `elvallalo_felhasznalo_id`, `befejezesi_ido`, `hatarido`, `kod_eleresi_ut`, `beadas_ideje`) VALUES
(4, 'test', 'ddsasadsadsadadsadas', NULL, 2, '2025-02-17 18:55:02', 1, 'folyamatban', 200, 118, 151, NULL, NULL, '4-test-r.uqw', NULL),
(5, 'teszt3', 'blablabla', NULL, 5, '2025-02-24 17:16:47', 0, 'nyitott', 100, 79, 8, NULL, '2025-11-20 00:00:00', 'asdads', NULL),
(8, 'bigyo', 'asd', NULL, 1, '2025-02-24 17:18:14', 1, 'nyitott', 20, 78, 92, NULL, '2025-02-28 18:17:17', 'asd', NULL),
(10, 'asd', 'teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt teszt', NULL, 3, '2025-03-03 18:11:28', 1, 'teljesitve', 0, 152, 79, NULL, '2025-03-21 00:00:00', 'asd-10.uqw', '2025-03-03 20:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(50) NOT NULL,
  `compiler_azonosito` varchar(50) NOT NULL,
  `kep` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategoria`
--

INSERT INTO `kategoria` (`id`, `nev`, `compiler_azonosito`,`kep`) VALUES
(1, 'CSS', 'css', 'CSS.jpg'),
(2, 'PHP', 'php', 'PHP.jpg'),
(3, 'JavaScript', 'javascript', 'JavaScript.jpg'),
(4, 'Python', 'python', 'Python.jpg'),
(5, 'C#', 'csharp', 'CS.jpg'),
(6, 'SQL', 'sql', 'SQL.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kod`
--

CREATE TABLE `kod` (
  `id` int(10) UNSIGNED NOT NULL,
  `felhasznalo_id` int(10) UNSIGNED NOT NULL,
  `kategoria_id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(255) NOT NULL,
  `ar` int(10) DEFAULT 0,
  `eleresi_ut` varchar(255) NOT NULL,
  `feltoltesi_ido` timestamp NULL DEFAULT current_timestamp(),
  `jovahagyott` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kod`
--

INSERT INTO `kod` (`id`, `felhasznalo_id`, `kategoria_id`, `nev`, `ar`, `eleresi_ut`, `feltoltesi_ido`, `jovahagyott`) VALUES
(11, 45, 1, 'Login Form', 50, 'login-form.css', '2025-03-01 10:15:30', 1),
(12, 78, 1, 'Signup Form', 120, 'signup-form.css', '2025-03-02 11:30:50', 1),
(13, 33, 1, 'Contact Form', 80, 'contact-form.css', '2025-03-03 14:05:15', 1),
(14, 120, 1, 'Survey Form', 200, 'survey-form.css', '2025-03-04 16:20:45', 1),
(15, 90, 1, 'Feedback Form', 300, 'feedback-form.css', '2025-03-05 18:40:10', 1),

(16, 12, 2, 'Simple Navbar', 150, 'simple-navbar.php', '2025-03-01 12:50:25', 1),
(17, 143, 2, 'Dropdown Menu', 220, 'dropdown-menu.php', '2025-03-02 14:35:55', 1),
(18, 60, 2, 'Sidebar Navigation', 275, 'sidebar-navigation.php', '2025-03-03 16:10:40', 1),
(19, 99, 2, 'Mega Menu', 350, 'mega-menu.php', '2025-03-04 17:45:20', 1),
(20, 23, 2, 'Sticky Header', 180, 'sticky-header.php', '2025-03-05 19:00:05', 1),

(21, 87, 3, 'Dashboard UI', 500, 'dashboard-ui.js', '2025-03-01 09:30:15', 1),
(22, 56, 3, 'Admin Panel', 750, 'admin-panel.js', '2025-03-02 10:50:25', 1),
(23, 142, 3, 'Analytics Dashboard', 650, 'analytics-dashboard.js', '2025-03-03 13:15:40', 1),
(24, 101, 3, 'User Management', 400, 'user-management.js', '2025-03-04 15:20:10', 1),
(25, 33, 3, 'Project Management', 550, 'project-management.js', '2025-03-05 17:35:55', 1),

(26, 98, 4, 'Image Gallery', 250, 'image-gallery.py', '2025-03-01 11:45:30', 1),
(27, 76, 4, 'Video Player', 600, 'video-player.py', '2025-03-02 12:55:50', 1),
(28, 41, 4, 'Music Player', 500, 'music-player.py', '2025-03-03 14:25:15', 1),
(29, 67, 4, 'Slideshow', 350, 'slideshow.py', '2025-03-04 16:10:45', 1),
(30, 115, 4, 'Interactive Map', 700, 'interactive-map.py', '2025-03-05 18:25:10', 1),

(31, 88, 5, 'Portfolio Website', 800, 'portfolio-website.cs', '2025-03-01 10:15:30', 1),
(32, 54, 5, 'Business Landing Page', 900, 'business-landing.cs', '2025-03-02 11:40:50', 1),
(33, 124, 5, 'Blog Template', 350, 'blog-template.cs', '2025-03-03 13:55:15', 1),
(34, 99, 5, 'E-commerce Store', 950, 'ecommerce-store.cs', '2025-03-04 15:10:45', 1),
(35, 73, 5, 'Personal Resume', 500, 'personal-resume.cs', '2025-03-05 17:30:10', 1),

(36, 123, 6, 'Task Manager', 600, 'task-manager.sql', '2025-03-01 12:10:25', 1),
(37, 132, 6, 'To-Do List', 200, 'todo-list.sql', '2025-03-02 13:45:55', 1),
(38, 85, 6, 'Expense Tracker', 450, 'expense-tracker.sql', '2025-03-03 15:20:40', 1),
(39, 140, 6, 'Fitness Tracker', 700, 'fitness-tracker.sql', '2025-03-04 16:50:20', 1),
(40, 77, 6, 'Event Calendar', 300, 'event-calendar.sql', '2025-03-05 18:15:05', 1);

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
  `idopont` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aktiv` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `pont_ar`
--

CREATE TABLE `pont_ar` (
  `ar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pont_ar`
--

INSERT INTO `pont_ar` (`ar`) VALUES
(0.5);

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
-- Indexes for table `felhasznalo_megvett`
--
ALTER TABLE `felhasznalo_megvett`
  ADD PRIMARY KEY (`id`),
  ADD KEY `felhasznalo_id` (`felhasznalo_id`),
  ADD KEY `kod_id` (`kod_id`);

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
  ADD KEY `kod_id` (`kod_id`),
  ADD KEY `elvallalo_felhasznalo_id` (`elvallalo_felhasznalo_id`),
  ADD KEY `felkeres_ibfk_4` (`kategoria_id`);

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
  ADD KEY `felhasznalo_id` (`felhasznalo_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `felhasznalo_megvett`
--
ALTER TABLE `felhasznalo_megvett`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `felhasznalo_token`
--
ALTER TABLE `felhasznalo_token`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `felkeres`
--
ALTER TABLE `felkeres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategoria`
--
ALTER TABLE `kategoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kod`
--
ALTER TABLE `kod`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- Constraints for table `felhasznalo_megvett`
--
ALTER TABLE `felhasznalo_megvett`
  ADD CONSTRAINT `felhasznalo_megvett_ibfk_1` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `felhasznalo_megvett_ibfk_2` FOREIGN KEY (`kod_id`) REFERENCES `kod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `felkeres_ibfk_2` FOREIGN KEY (`kod_id`) REFERENCES `kod` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `felkeres_ibfk_3` FOREIGN KEY (`elvallalo_felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `felkeres_ibfk_4` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `kod`
--
ALTER TABLE `kod`
  ADD CONSTRAINT `kod_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `kod_like_ibfk_1` FOREIGN KEY (`kod_id`) REFERENCES `kod` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kod_like_ibfk_2` FOREIGN KEY (`felhasznalo_id`) REFERENCES `felhasznalo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
