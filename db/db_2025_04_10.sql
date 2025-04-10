-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: vizsgaremek
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `felhasznalo`
--

DROP TABLE IF EXISTS `felhasznalo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `felhasznalo` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `jelszo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pontok` int unsigned DEFAULT '0',
  `letrehozasi_ido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `utolso_valt_ido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipus` int unsigned NOT NULL DEFAULT '0' COMMENT '0 - átlagos felhasználó extra jogok nélkül\r\n1 - moderátor\r\n2 - admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nev` (`nev`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalo`
--

LOCK TABLES `felhasznalo` WRITE;
/*!40000 ALTER TABLE `felhasznalo` DISABLE KEYS */;
INSERT INTO `felhasznalo` VALUES (8,'domebence','domebence05@gmail.com','$2y$10$Ess83oBvqpb/FNdwH03Ql.lMm4huaJqUqwkDkfdaFiH6ZlzNkSS62',700,'2024-11-03 18:54:08','2024-11-03 18:54:08',2),(9,'asdasd','asd@gmail.com','$2y$10$KJTLl7Qqkm7DnfdAtdEvNetENP4Ng9dOkDLQpHUzdLSRKW83s7wAi',NULL,'2024-11-03 19:07:18','2024-11-03 19:07:18',2),(10,'asdasda','asd@gmail.asd','$2y$10$clQg6DpD5m07xd7egr7vweZzjTUH.q5bemOVM4XJE68R/QzXFRpuK',NULL,'2024-11-03 19:08:00','2024-11-03 19:08:00',2),(11,'szalami','szalami53@gmail.com','$2y$10$dsiNf/W/YlE.wgEz/XP2W.acz/a5h5pnntz1AsJCAWMQDCQa7x2Oy',NULL,'2024-11-04 18:11:05','2024-11-04 18:11:05',2),(12,'sdkfnas','ajkdnasud@gmail.com','$2y$10$unenSCeIYKTRBy/T5hBOEug6xdA1hBkRXS7sy.I/D72kaRv2XxSJS',NULL,'2024-11-04 18:22:06','2024-11-04 18:22:06',2),(16,'dasdqwdsdasad','asd@gmail.asdasdasjhd','$2y$10$Tyae7rimLuSs2F1H2.O16OBCapzi5xKRbE5jSwb3BYYiQ7qW4DbDC',NULL,'2024-11-05 19:19:01','2024-11-05 19:19:01',2),(21,'asdasdkqwjndiqw','asdkjnqwiduwn@gmail.com','$2y$10$.TisHXizNL3qsfWaf6dMYu2YaFmVV.qeKtGXq0v89IaJSAaCAPCiC',NULL,'2024-11-05 19:36:49','2024-11-05 19:36:49',2),(24,'fghjkl','dfghj@gmail.com','$2y$10$DMPCSo9kJoaAcq1FzOBviONn1WPxQORS6sRFZ/Lca748fXByCcxZK',NULL,'2024-11-05 19:48:12','2024-11-05 19:48:12',2),(30,'asbdasujdbas','asd23@gmail.com','$2y$10$/9r9PzjGPIv.oFIol7Yiqu2uRben73HkZ0rSMv7uBjiBNg6AkDC6q',NULL,'2024-11-08 19:48:33','2024-11-08 19:48:33',2),(33,'asdasdasdasd','asdasd@asdasd.comasd','$2y$10$vZXtFU4vwV5JH743zXfpleD0QrNql9suF2p2CDTmKuQSHkYal/okW',NULL,'2024-11-08 20:06:25','2024-11-08 20:06:25',2),(35,'asdasdasdasdasd','asdasd@asdaasd.comasdqwe','$2y$10$HdhmEuL.0PMEXriuuZnSWejaLcPru1bCrhTKzncZ/GgDvPGGQHVcy',NULL,'2024-11-08 20:52:45','2024-11-08 20:52:45',2),(37,'asdwdasdasdsad','asdasd@gmail.comasdqy','$2y$10$j.jz.PTp2drrBjR6QgsyRe6.LSNh8CkaHVY4bDvWRKYEXTW5xkZB2',NULL,'2024-11-08 20:59:28','2024-11-08 20:59:28',2),(39,'qdaaxcvsqada','sxcsadcf@gmail.com','$2y$10$o0cLtam1U/s6SjhpeZlgkuA2M5iQ/iGbzP9dNxA/7GMgBGR4HuxI6',NULL,'2024-11-09 19:23:52','2024-11-09 19:23:52',2),(50,'asdasdasd','asdasd@asdasd.com','$2y$10$SddVo69rgVZpWFE.XjRQve/e2s5umxb8ih2AzUSF2QXw0YpYzCTiC',NULL,'2024-11-10 18:48:21','2024-11-10 18:48:21',2),(60,'asdadasd','asd1231@gmail.com','$2y$10$.ukcTAGhN51RbzSG3dpt6./OHXlNQZRq4a.NKlUqw3U8S9X0gXf9i',NULL,'2024-11-13 15:19:22','2024-11-13 15:19:22',2),(61,'domebence2','asdasd2@asdasd.com','$2y$10$iccKUDisibiLDtXsT4TcLOHiWcfT73NJPW5fxXlCc83htmt45C2Y2',NULL,'2024-11-13 15:20:18','2024-11-13 15:20:18',2),(62,'asdasd2','asd2@gmail.com','$2y$10$JmwK783ksOVu2/FF.hQBWe1zeWXRJ2k7NrC7tEK7aX2gWZrGNV2RW',NULL,'2024-11-13 15:28:37','2024-11-13 15:28:37',2),(63,'asd3','asd3@gmail.com','$2y$10$kPWCvgp9iDtfq8eqWzQrYux4/hGigacgeI0RbYC2E2EewRndf4bsy',NULL,'2024-11-13 15:30:20','2024-11-13 15:30:20',2),(64,'asd4','asd4@gmail.com','$2y$10$20HBQXCP/2fPTXU0w8FcTObFKygKz2yP2ggnyMFeAoCDX6cTR4XEC',NULL,'2024-11-13 15:31:52','2024-11-13 15:31:52',2),(65,'asd5','asd5@gmail.com','$2y$10$7kPGCcCe9O5cYZPAHv686.H/Qz/9KV.CQ.M.EkjUb3jQtKe9aoyTS',NULL,'2024-11-13 15:33:35','2024-11-13 15:33:35',2),(66,'asd6','asd6@gmail.com','$2y$10$NtXCs1wC9eQ97Cb6hD3/ourFyyoFvfnEZg1mrexx0poySNbRR5mNi',NULL,'2024-11-13 15:41:48','2024-11-13 15:41:48',2),(67,'asd7','asd7@gmail.com','$2y$10$LdajDoucW322q0M.Qo/f/O0soVwlh5xzxQ/25Yb0hTV25UJNakkQm',NULL,'2024-11-13 15:44:27','2024-11-13 15:44:27',2),(68,'asd8','asd8@gmail.com','$2y$10$UDXi8EPDJkr8uaDHMtUTAu5g.F6VJEBz/7XySv/C2n7jukn7hN1Fa',NULL,'2024-11-13 15:46:16','2024-11-13 15:46:16',2),(69,'asd10','asd10@gmail.com','$2y$10$pBpG0qJ5I4o.QqZg62eA3eA83Ji3nKvO.e10ZsKdWKWOp4d8XFJuO',NULL,'2024-11-14 20:29:44','2024-11-14 20:29:44',2),(73,'asdasd21','asdasd32@asdasd.com','$2y$10$qTd66uBNn20gHz00Gtk9mufGi0QbvG51lyyXJOBPHvksAKYNmRzA2',NULL,'2024-11-14 20:34:12','2024-11-14 20:34:12',2),(74,'asdasdasd23','asd13@gmail.com','$2y$10$5OnTDPQ7BvAdqeiCHMhCyeK67rrt1RME7PU9KZ8XknyAlnEdhePRS',NULL,'2024-11-14 20:34:36','2024-11-14 20:34:36',2),(75,'asdasdasd24','as32d@gmail.com','$2y$10$fm.QrkzuBRE4rEMk26cWfe2UG3EDN4jBE285ALjGDh1Uonbc3znhy',NULL,'2024-11-14 20:35:31','2024-11-14 20:35:31',2),(77,'domebence23','asd12@gmail.com','$2y$10$wXWU3vx.9yeAuUGZhjaLBOjVja0yMjlMIxlSDMu.mrAbR75rueu6e',NULL,'2024-11-15 16:38:14','2024-11-15 16:38:14',2),(78,'asd12345','asd12345@gmail.com','$2y$10$50OLWwIgHiC9gP7fOc5Dq.EpNNh98qgZIkaqjRK7I2k5W.QOQOXsG',NULL,'2024-11-16 10:45:57','2024-11-16 10:45:57',2),(79,'admin','admin@gmail.com','$2y$10$hh/F/6sm3iND/0IJk..GTunJsoUYRLuDWEHhJ3UUDdtCXoAJlnw7G',NULL,'2024-11-29 07:04:49','2024-11-29 07:04:49',2),(82,'domebence63','dome123@gmail.com','$2y$10$DkBd3FDFdpgTfQE0DDloJO1AA/IHx6iN2P37dS/20u343/lkvwS9m',NULL,'2024-12-19 16:35:31','2024-12-19 16:35:31',2),(90,'kolbasz123451','kolbi@gmail.com','$2y$10$yU7rQJucXDOYYwGQmTzMp.Ojs5/9u7YhP24T1YLiifcV86Y9fnioC',NULL,'2025-01-19 19:19:13','2025-01-19 19:19:13',2),(92,'adminqweyxdc','asasdqweyxc@gmail.com','$2y$10$JP3kNIM3WKYj1hIFynKHc.nUZGvXfLzE182tGfcRY5zHXTOe98pLC',NULL,'2025-01-19 19:29:22','2025-01-19 19:29:22',2),(94,'admin132kolbasz21','domebenc34213e05@gmail.com','$2y$10$1wopi.ZlgMziUnEydas8H.NOMnRe.l1PDC2Sbkq6tWXSNqKd4s0sm',NULL,'2025-01-19 19:36:03','2025-01-19 19:36:03',2),(98,'finomkolbasz132312','231cxc@gmail.com','$2y$10$0siGLuy5/D.2T0WDvMIHQuckrxwcY5mZeT4WkLTEFJ9i5v1cFHycu',NULL,'2025-01-19 19:38:36','2025-01-19 19:38:36',2),(109,'admin52343','domebenc431323e05@gmail.com','$2y$10$ncZw2P7mWKADvm9m87h/mOvTjS9Z5Ci07R7V/aksHbni9.LsNairy',NULL,'2025-01-19 19:44:33','2025-01-19 19:44:33',2),(112,'kolbasz4','kolb@gmail.com','$2y$10$cfVe4UQ7XIu7LmGqXXQ9MuZAU1S8dUmz5kY3R2k8T2fkl6F/QjfPO',NULL,'2025-01-19 19:45:41','2025-01-19 19:45:41',2),(113,'kolbasz5','kolb34123@gmail.com','$2y$10$Ua/hrfGqDdRMFs9vjBwzwO2pRVBBD0FcHa7QZjjlGcIL7Wy8/Qojm',NULL,'2025-01-19 19:47:37','2025-01-19 19:47:37',2),(118,'103132ys','4123dqwwe@gmail.com','$2y$10$R8oPwHXvs0gRiRWODbbu/.0WxKR6JcbRBoAjCqyZG4kWygx6hIZ2.',NULL,'2025-01-19 19:54:29','2025-01-19 19:54:29',2),(120,'admin31423','domebence053435@gmail.com','$2y$10$ER/p5elkKSAt1Y2zaj1QQ.5W94N1Rg0SgwvDxlccLjNy1MTP3ZKpa',NULL,'2025-01-19 19:55:48','2025-01-19 19:55:48',2),(125,'finomkolbasz13232412','domebencedasdqw05@gmail.coms','$2y$10$fZfBNdz0rfHagqGAzrk4ZeqPcwIIOJByNputLlJQ5iF4d/GudoBYy',NULL,'2025-01-19 20:19:52','2025-01-19 20:19:52',2),(127,'nkasjdasdjkn','jndasdnasj@gmail.com','$2y$10$fE1YRIJtJnfH1d9K.JGIR.AZev3DmbPqeRTmlkQsV5x6UAvCI1ydC',NULL,'2025-01-19 20:21:17','2025-01-19 20:21:17',2),(128,'finomkolb2344asz132','asda4323sdasdasdqwwe@gmail.com','$2y$10$V1VAYPS4xgqJRQ4i93hCruQl27u7oVaELIn845mvnVxAjtxxNQUEm',NULL,'2025-01-19 20:23:27','2025-01-19 20:23:27',2),(129,'hbjsdahbjdsa','zudasgzudaszug213@gmail.com','$2y$10$rVBeNG3FMHG1SwXpMBd47..5he6hp0UysEir.z8cXuakqPU5x15eW',NULL,'2025-01-19 20:24:16','2025-01-19 20:24:16',2),(132,'admin5','asdasdasdasdq13wwe@gmail.com','$2y$10$j4sIoGVUDWPGr5CkrSGqyeyeu7G9sE6TUYmR58Hem5uQsI8eBD2R.',NULL,'2025-01-19 20:42:51','2025-01-19 20:42:51',2),(145,'domenybence','domebence023@gmail.com','$2y$10$zqIVJQSo4J9BL1AUWikOfOoALbn1RZJGFRQNniWbO/84Ilxr1MUYK',NULL,'2025-01-20 21:08:25','2025-01-20 21:08:25',2),(146,'add122min123','domebence0dwqe5@gmail.com','$2y$10$HGwAwIsFRIyg.a9W/p/ARO57V.oVkmT1GPxNlRW6R46Ow4/hbFTKW',NULL,'2025-02-03 17:08:15','2025-02-03 17:08:15',2),(148,'admin123123','domebence321431205@gmail.com','$2y$10$yrfN03smAsrzI55CCp/vOu0AFepYJ4aJ8jln09.rtNAVwfPRBjZuC',NULL,'2025-02-03 17:10:18','2025-02-03 17:10:18',2),(150,'ujuser','user123@gmail.com','$2y$10$y8Y.aea0p.ZO9BybBvswrOtcdJYC0wNybIepq5rPrF78KRyQ.N1aq',NULL,'2025-02-24 16:38:07','2025-02-24 16:38:07',0),(151,'mxteb','mxte_b@gmail.com','$2y$10$CPD3Z9nZAoFCDAMBUc3RL.MWYL7lHk8wtgHYWMYbzoLqRysUPoc7O',NULL,'2025-03-03 17:20:32','2025-03-03 17:20:32',0),(152,'kjbdaskjndasjnk','kjnasd@gmail.com','$2y$10$svndja3xcUslZX0yiqrvc.bPTT3yaYbG./DScTLERgKpAJxPCFBc6',NULL,'2025-03-03 18:04:55','2025-03-03 18:04:55',0),(153,'tesztelek','tesztelek33@gmail.com','$2y$10$8g.lfu8b7Vfkp6lmPc.x3exKfjERZpUE/3gLQ79NbZnho6QjYh7XK',NULL,'2025-04-02 17:43:59','2025-04-02 17:43:59',0),(155,'asdfghjk','asdfghjk@gmail.com','$2y$10$ya27c3AUXOmIKv3JXAy9fufwR9zedDzgld4ogqT5FSRCHGokKLl8q',78127717,'2025-04-02 18:38:09','2025-04-02 18:38:09',0),(156,'asdfg','asdfg@gmail.com','$2y$10$xEqLQMvzoxRL.qo.Ps2V0uQDEy46l4H/aserL.FSLKexomi0Oauje',NULL,'2025-04-10 19:37:23','2025-04-10 19:37:23',0);
/*!40000 ALTER TABLE `felhasznalo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `felhasznalo_megvett`
--

DROP TABLE IF EXISTS `felhasznalo_megvett`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `felhasznalo_megvett` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `kod_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `felhasznalo_id` (`felhasznalo_id`),
  KEY `kod_id` (`kod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalo_megvett`
--

LOCK TABLES `felhasznalo_megvett` WRITE;
/*!40000 ALTER TABLE `felhasznalo_megvett` DISABLE KEYS */;
INSERT INTO `felhasznalo_megvett` VALUES (11,155,12);
/*!40000 ALTER TABLE `felhasznalo_megvett` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `felhasznalo_token`
--

DROP TABLE IF EXISTS `felhasznalo_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `felhasznalo_token` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lejarat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `felhasznalo_id` (`felhasznalo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalo_token`
--

LOCK TABLES `felhasznalo_token` WRITE;
/*!40000 ALTER TABLE `felhasznalo_token` DISABLE KEYS */;
INSERT INTO `felhasznalo_token` VALUES (1,79,'$2y$10$2.KbYP0wKSbGztENnlepQehPjGl1p09FESn98cFnSQD6HHH.VOXMW','2025-01-12 18:11:20'),(4,79,'$2y$10$04JXGh4XaKiwMs.gwAmb2uT0xCcAzgs04dI9ORy8fytKOKAkbHb6.','2025-01-12 18:24:12'),(5,79,'$2y$10$ASz7H1WaDvvV8n1ZLC5vGe7iS.782el/ygBiyD83wUJfrk/IXhHfe','2025-01-14 13:21:07'),(6,79,'$2y$10$j7dziuLGQsnpST0f15ucbuo1zlEYVoiVkFUBxhqzHDbaQSRbuA56a','2025-01-15 17:23:16'),(7,82,'$2y$10$O0BO/hEW1w..BzLXVLrMZ.Xq8F8Rf6giqbExG.vCR.Ee7si8WtpeG','2025-01-18 16:35:50'),(8,79,'$2y$10$Sdw1P6Kli9057zu4wfI3IeI.BUq7gPyPo9/mTqNXrqi6d1LhVs.Ou','2025-01-18 18:06:29'),(9,79,'$2y$10$E.iKz01WjRG3Yb49gDx/sOyFMxmK2LK38fws9WOfGqRvSfNHAVqrq','2025-01-21 13:05:44'),(10,79,'$2y$10$tytvF13PnsZU9B3d.YIGoe6yrI01SO6tqdE0I1/Vp/ay6Nj34RgQe','2025-02-09 18:05:10'),(11,79,'$2y$10$8UvzGQp8/yCe3DX2lgcrYuxlhDKIaker.eUmVBKeZF47ojS9fj3Hm','2025-02-25 16:42:09'),(12,8,'$2y$10$2wpNLKv7JikOLM4PmTaw4.z15q7RIN1SN.SyuPEgoIPW3MTLBwZaG','2025-02-25 16:43:23'),(13,8,'$2y$10$qYQEIEkfEwGYj7LtwgOY2.mOmXt3Jh0PdVQVMEyLOnkin/4EXX/2.','2025-02-26 15:31:07'),(14,79,'$2y$10$cSKq5RY/3/vLGV7zDQBy.O4Ur4.fgmfdzW3z/D2q/92AWPrGz44Pm','2025-02-26 18:18:55'),(15,79,'$2y$10$TmZ0E6AGh36YesqH1HFvmeOqXZNf/RUJTB2lY.nn3UXnQiEGgN2IG','2025-02-26 18:22:53'),(16,8,'$2y$10$rmXXy5yGSSI/C2r8jCz/Hea0G4dBefBCAgVBO.UL4X0PDb9Jyg1Ai','2025-02-26 18:34:35'),(17,8,'$2y$10$rxvSIJMX4pOsmQ20zj0FReV5d2bSLKRl5uExchKNUnK0VZa8oppQ6','2025-02-26 19:10:57'),(18,8,'$2y$10$/nEOEgcMt.q/PnBirfFs0.saZdckivm1Le/VWmpW4LF9.ZEp1vN8m','2025-03-04 08:56:09'),(19,79,'$2y$10$xZ8/wekZN3KeFkHFDodn2OTFyajgiHxVDJW3jJ0f0UGpz3GuvLZhS','2025-03-05 16:00:32'),(20,79,'$2y$10$xSuFG/5yMHhMss4YrAVKB.shHf0Rds///vFHfZOf4RC6VaOXGCePe','2025-03-05 17:01:59'),(21,79,'$2y$10$UDn3YasPvucvp9EF2.elf.6r9gl1QEp5JTOQPFmUkPADRu5qoxrDu','2025-03-05 17:02:25'),(22,79,'$2y$10$Uq2ap6IyW/G7zZRufLbwlOhhnl637NHleORXFAZotgedPBwzzrXd6','2025-03-05 17:04:42'),(23,79,'$2y$10$QiCqx3fAxD.RP1onb1qJKOJW08hO.1ihwvDI4XdngbRhmiu4D6IGi','2025-03-05 17:05:18'),(24,79,'$2y$10$i3piqldtnj8jea.xDQv3Gu7OJwuUZwz.4zwFaGOLyI8vxO5A5CMgu','2025-03-05 17:05:39'),(25,79,'$2y$10$kp4Hj9jl6zcI3asKk4Lad.SyBiexWmsCFfaWYYW6COCftg8jOBLzy','2025-03-05 17:06:52'),(26,79,'$2y$10$piMC2uzC4bPx5vNOsfOu3OG4LFCrWb2CpYrIhWSjWer41OETmS6bu','2025-03-05 17:07:23'),(27,79,'$2y$10$ZnFkoZfvBqo99ZQt/GqJxOmRS92U9tD.NMtNuDqUezcknnzniwU4e','2025-03-05 17:12:13'),(28,79,'$2y$10$xQKbBpyVHY8clf0Ad1L0R.VNUTe3.pLqsiYf6mh3aOZt9fyE1.M9y','2025-03-05 17:12:33'),(29,79,'$2y$10$H9aDsTcLbqxOaMwhwvYZvekvXBvXyCZ8NBPgGZVp1eUnfwLnl63U.','2025-03-05 17:13:43'),(30,79,'$2y$10$sRvGoQ.6xFFG5W3E2dFD3uqRN8ldT/IiezelfUrYX5XjNFJ3VWlxC','2025-03-05 17:14:43'),(31,79,'$2y$10$0RpU6gn65aIY.aI8LJTBxu.Go9a8bzru8mKh29BUoCyiRIeLlgpbK','2025-03-05 17:18:09'),(32,79,'$2y$10$Eio4I1zV/dSgBbYxwUljEuNoh1zMKr38IU0EOsTYsRxgGcG/6p..q','2025-03-05 17:19:04'),(33,79,'$2y$10$P0ILZWvGoOOfsCVhB0HCgOuyELiAdRAAUbTt34tcQDKDzzhDCftRq','2025-03-07 17:22:36'),(34,8,'$2y$10$QBkQmz7q5auYJZj3yThwMewVbN7tHrOwZbKRr31s/FK6fbFMKF3/y','2025-03-07 17:29:55'),(35,8,'$2y$10$edQC8S2sZRs.ixYCoxzLr.iVy6lldGV9yeWU4XMoyVSr6Iy9iKDiS','2025-03-09 15:34:53'),(36,79,'$2y$10$UrpGYhYSaRla4NzQrWmwtu6e6/JqYiHLeFQ0FDLlJlBESa47xb.5C','2025-03-09 16:32:59'),(37,79,'$2y$10$YUzmvSbncSI.BWOMKuqutuF23GbFXWyC2sWTsCj7rqzCPjIciC9dq','2025-03-09 16:37:00'),(38,8,'$2y$10$XC4u9McbXQ/fwsHnr.sPxewYzA2e7dNKgLmPgpSy6MqLg5jI8hYNy','2025-03-09 16:45:35'),(39,8,'$2y$10$9tY9s3DzhjPAD1FLzvDJFegyImLpnuBYWOUOIA9LRBIOMeoK5nXmC','2025-03-16 13:53:46'),(40,8,'$2y$10$ge.FtpbqANXrgySi2ZIoduSYz0GMb1Zeg3wLBaxShmwWJs1WK5t2W','2025-03-16 13:55:27'),(41,8,'$2y$10$fsdfWh60.KD.z1a76L9BSut766mH977Esnz3Wnsoi1bqaiyhGYyuO','2025-03-18 07:50:32'),(42,8,'$2y$10$THG35L0vt7FhVrffPhI/Z.8.bxZYQ00i9Ves3MihWKBvdw3gM8YZa','2025-03-19 18:57:43'),(43,79,'$2y$10$HOYYJB3wVIJDNR1SIYP5/eR0LUac5mOWzs5/9XjetAT//m6iNsz2S','2025-03-22 20:10:58'),(44,79,'$2y$10$kKbKdxiURlVrxqSgjU9voedLHJMgSCDUsojpA2ETyt/QT5f7s9Eai','2025-03-26 15:49:06'),(45,150,'$2y$10$L3UPpry3yrU/HjqITZ3s1ulXf2AqKcdgSHgKztc7939CJ8mGY7lbO','2025-03-26 16:38:16'),(46,79,'$2y$10$YcNndJTORf8BSxrMwa99VOwXKUemNiDJEVBO3TmywPH/hB.QJduem','2025-03-26 16:59:08'),(47,79,'$2y$10$4hKmtZfV.cH/FpRBUuHd1.Y/OU4Xz4VzHxxl4bsB.OyNbgAo.fWti','2025-04-01 06:56:11'),(48,151,'$2y$10$fhRMsga.ciHG6jLaBXgf5.PXASrdqvp3so4ffOTx758DVY9Pvgqsi','2025-04-02 16:20:41'),(49,152,'$2y$10$akMXlpmAuSIc4xIklQW3C.RG5l9IqC5MfD9/ZRPBhRRlKVN7xwps2','2025-04-02 17:05:02'),(50,64,'$2y$10$UzwqRi8fixk3meVxufBL7.csXwxQAxnR3lhFk6zDq5V4FECW2WjLy','2025-04-02 18:18:40'),(51,152,'$2y$10$hnU.phCfc41gRRKW/vdQGO5ey22zlpEszKjuBNBmvxsb/GFonrYJG','2025-04-02 18:50:11'),(52,79,'$2y$10$PPPQa5s3koWbPKymCzk1l.1gAUWenKwmIae5lcRMdYyhtAZ1M.i1G','2025-04-02 19:44:57'),(53,153,'$2y$10$lmrnZmgrKmifpnXdyE35z.jWE8SrDwP2FWyeCjdhT.U/4EG5AJAOS','2025-05-02 15:44:07'),(54,79,'$2y$10$J9e3ROaXoXP6IG5KHR.Foe2e8H/J.6Q6xC8CSy6Thtex/fDUiWLqG','2025-05-02 15:50:58'),(55,79,'$2y$10$3RUQnv/TDKle01UqOAINg.3JO5hM7ugHFu7hHXd7Ctak2AYprIi7u','2025-05-02 16:16:16'),(56,155,'$2y$10$g3BZ3ui/oU7utR3072TVG.nq7WvotAlC78rEuKre9ai4BaZS1CEeq','2025-05-02 16:38:19'),(57,79,'$2y$10$Y2oPd49pmjhjSZ6ii6Wdx.WywiYYIu7SDV1c9XTFEoGo/6d6j815m','2025-05-02 16:48:10'),(58,155,'$2y$10$Or0WjYcAqMNNJuDY3bl9JuwL0SA4wXcqoOcFbuvdn7LToWTqEljPW','2025-05-02 16:49:10'),(59,79,'$2y$10$nJNhgl3rY6gzvKFDs0ZFJOleQPTLjPuihSBX5nAivcu0AfKxLAg8m','2025-05-02 17:07:46'),(60,79,'$2y$10$iTlPeGqQcUQID.FKVp.hbOlk.DF1dKnDuTkI0WZMcqaUquXk81LE6','2025-05-07 13:19:36'),(61,79,'$2y$10$mt7D5/8ItggGhq7N7xOxXup0Wo7FyfoHDGwkhjU25MgNudTu2liEG','2025-05-10 17:12:53'),(62,156,'$2y$10$K7zr70Tam1nZHLrRz8gGhecqV0ZXGrY3ErN2FLRPvrN.gLMJQGQqW','2025-05-10 17:37:29');
/*!40000 ALTER TABLE `felhasznalo_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `lejart_tokenek_torlese` AFTER UPDATE ON `felhasznalo_token` FOR EACH ROW DELETE FROM felhasznalo_token WHERE lejarat < NOW() */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `felkeres`
--

DROP TABLE IF EXISTS `felkeres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `felkeres` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `leiras` text COLLATE utf8mb4_general_ci,
  `kod_id` int unsigned DEFAULT NULL,
  `kategoria_id` int unsigned DEFAULT NULL,
  `feltoltesi_ido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jovahagyott` tinyint(1) NOT NULL DEFAULT '0',
  `statusz` enum('nyitott','folyamatban','teljesitve','elutasitva','jóváhagyott') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'nyitott',
  `ar` int unsigned NOT NULL,
  `felhasznalo_id` int unsigned NOT NULL,
  `elvallalo_felhasznalo_id` int unsigned DEFAULT NULL,
  `befejezesi_ido` timestamp NULL DEFAULT NULL,
  `hatarido` datetime DEFAULT NULL,
  `kod_eleresi_ut` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `beadas_ideje` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `felhasznalo_id` (`felhasznalo_id`),
  KEY `kod_id` (`kod_id`),
  KEY `elvallalo_felhasznalo_id` (`elvallalo_felhasznalo_id`),
  KEY `felkeres_ibfk_4` (`kategoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felkeres`
--

LOCK TABLES `felkeres` WRITE;
/*!40000 ALTER TABLE `felkeres` DISABLE KEYS */;
INSERT INTO `felkeres` VALUES (11,'Új felkérés','Placeholder szöveg',NULL,2,'2025-04-10 19:36:39',0,'nyitott',5000,79,NULL,NULL,'2025-04-12 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `felkeres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategoria`
--

DROP TABLE IF EXISTS `kategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategoria` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nev` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `compiler_azonosito` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `kep` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategoria`
--

LOCK TABLES `kategoria` WRITE;
/*!40000 ALTER TABLE `kategoria` DISABLE KEYS */;
INSERT INTO `kategoria` VALUES (1,'CSS','css','CSS.jpg'),(2,'PHP','php','PHP.jpg'),(3,'JavaScript','javascript','JavaScript.jpg'),(4,'Python','python','Python.jpg'),(5,'C#','csharp','CS.jpg'),(6,'SQL','sql','SQL.jpg');
/*!40000 ALTER TABLE `kategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kod`
--

DROP TABLE IF EXISTS `kod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kod` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `kategoria_id` int unsigned NOT NULL,
  `nev` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ar` int DEFAULT '0',
  `eleresi_ut` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `feltoltesi_ido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jovahagyott` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kategoria_id` (`kategoria_id`),
  KEY `felhasznalo_id` (`felhasznalo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kod`
--

LOCK TABLES `kod` WRITE;
/*!40000 ALTER TABLE `kod` DISABLE KEYS */;
INSERT INTO `kod` VALUES (12,78,1,'Signup Form',120,'signup-form.css','2025-03-02 11:30:50',1),(13,33,1,'Contact Form',80,'contact-form.css','2025-03-03 14:05:15',1),(14,120,1,'Survey Form',200,'survey-form.css','2025-03-04 16:20:45',1),(15,90,1,'Feedback Form',300,'feedback-form.css','2025-03-05 18:40:10',1),(16,12,2,'Simple Navbar',150,'simple-navbar.php','2025-03-01 12:50:25',1),(17,143,2,'Dropdown Menu',220,'dropdown-menu.php','2025-03-02 14:35:55',1),(18,60,2,'Sidebar Navigation',275,'sidebar-navigation.php','2025-03-03 16:10:40',1),(19,99,2,'Mega Menu',350,'mega-menu.php','2025-03-04 17:45:20',1),(20,23,2,'Sticky Header',180,'sticky-header.php','2025-03-05 19:00:05',1),(21,87,3,'Dashboard UI',500,'dashboard-ui.js','2025-03-01 09:30:15',1),(22,56,3,'Admin Panel',750,'admin-panel.js','2025-03-02 10:50:25',1),(23,142,3,'Analytics Dashboard',650,'analytics-dashboard.js','2025-03-03 13:15:40',1),(24,101,3,'User Management',400,'user-management.js','2025-03-04 15:20:10',1),(25,33,3,'Project Management',550,'project-management.js','2025-03-05 17:35:55',1),(26,98,4,'Image Gallery',250,'image-gallery.py','2025-03-01 11:45:30',1),(27,76,4,'Video Player',600,'video-player.py','2025-03-02 12:55:50',1),(28,41,4,'Music Player',500,'music-player.py','2025-03-03 14:25:15',1),(29,67,4,'Slideshow',350,'slideshow.py','2025-03-04 16:10:45',1),(30,115,4,'Interactive Map',700,'interactive-map.py','2025-03-05 18:25:10',1),(31,88,5,'Portfolio Website',800,'portfolio-website.cs','2025-03-01 10:15:30',1),(32,54,5,'Business Landing Page',900,'business-landing.cs','2025-03-02 11:40:50',1),(33,124,5,'Blog Template',350,'blog-template.cs','2025-03-03 13:55:15',1),(34,99,5,'E-commerce Store',950,'ecommerce-store.cs','2025-03-04 15:10:45',1),(35,73,5,'Personal Resume',500,'personal-resume.cs','2025-03-05 17:30:10',1),(36,123,6,'Task Manager',600,'task-manager.sql','2025-03-01 12:10:25',1),(37,132,6,'To-Do List',200,'todo-list.sql','2025-03-02 13:45:55',1),(38,85,6,'Expense Tracker',450,'expense-tracker.sql','2025-03-03 15:20:40',1),(39,140,6,'Fitness Tracker',700,'fitness-tracker.sql','2025-03-04 16:50:20',1),(40,77,6,'Event Calendar',300,'event-calendar.sql','2025-03-05 18:15:05',1);
/*!40000 ALTER TABLE `kod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kod_komment`
--

DROP TABLE IF EXISTS `kod_komment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kod_komment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kod_id` int unsigned NOT NULL,
  `felhasznalo_id` int unsigned NOT NULL,
  `szoveg` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `felhasznalo_id` (`felhasznalo_id`),
  KEY `kod_id` (`kod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kod_komment`
--

LOCK TABLES `kod_komment` WRITE;
/*!40000 ALTER TABLE `kod_komment` DISABLE KEYS */;
/*!40000 ALTER TABLE `kod_komment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kod_like`
--

DROP TABLE IF EXISTS `kod_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kod_like` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `kod_id` int unsigned NOT NULL,
  `ertek` tinyint(1) NOT NULL COMMENT '0 = dislike\r\n1 = like',
  `idopont` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `aktiv` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `felhasznalo_id` (`felhasznalo_id`),
  KEY `kod_id` (`kod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kod_like`
--

LOCK TABLES `kod_like` WRITE;
/*!40000 ALTER TABLE `kod_like` DISABLE KEYS */;
INSERT INTO `kod_like` VALUES (6,12,16,1,'2025-04-02 17:04:23',0),(7,90,15,1,'2025-04-02 17:05:55',1),(8,33,13,1,'2025-04-02 17:38:04',0),(9,79,55,1,'2025-04-02 19:08:45',0),(10,79,12,1,'2025-04-10 19:29:02',0);
/*!40000 ALTER TABLE `kod_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kodellenorzes`
--

DROP TABLE IF EXISTS `kodellenorzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kodellenorzes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `kod_id` int unsigned NOT NULL,
  `jovahagyasi_ido` timestamp NULL DEFAULT NULL,
  `folyamatban` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `felhasznalo_id` (`felhasznalo_id`),
  KEY `kod_id` (`kod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kodellenorzes`
--

LOCK TABLES `kodellenorzes` WRITE;
/*!40000 ALTER TABLE `kodellenorzes` DISABLE KEYS */;
/*!40000 ALTER TABLE `kodellenorzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderator_ellenorzes`
--

DROP TABLE IF EXISTS `moderator_ellenorzes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `moderator_ellenorzes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `ugyfelszolgalat_id` int unsigned NOT NULL,
  `felkeres_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `moderator_id` (`felhasznalo_id`),
  KEY `ugyfelszolgalat_id` (`ugyfelszolgalat_id`),
  KEY `felkeres_id` (`felkeres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator_ellenorzes`
--

LOCK TABLES `moderator_ellenorzes` WRITE;
/*!40000 ALTER TABLE `moderator_ellenorzes` DISABLE KEYS */;
/*!40000 ALTER TABLE `moderator_ellenorzes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pont_ar`
--

DROP TABLE IF EXISTS `pont_ar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pont_ar` (
  `ar` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pont_ar`
--

LOCK TABLES `pont_ar` WRITE;
/*!40000 ALTER TABLE `pont_ar` DISABLE KEYS */;
INSERT INTO `pont_ar` VALUES (0.5);
/*!40000 ALTER TABLE `pont_ar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ugyfelszolgalat`
--

DROP TABLE IF EXISTS `ugyfelszolgalat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ugyfelszolgalat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `felhasznalo_id` int unsigned NOT NULL,
  `uzenet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `feltoltesi_ido` timestamp NULL DEFAULT NULL,
  `folyamatban` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `felhasznalo_id` (`felhasznalo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ugyfelszolgalat`
--

LOCK TABLES `ugyfelszolgalat` WRITE;
/*!40000 ALTER TABLE `ugyfelszolgalat` DISABLE KEYS */;
/*!40000 ALTER TABLE `ugyfelszolgalat` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-10 21:48:44
