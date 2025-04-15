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
  `jelszo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `pontok` int unsigned NOT NULL DEFAULT '0',
  `letrehozasi_ido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `utolso_valt_ido` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tipus` int unsigned NOT NULL DEFAULT '0' COMMENT '0 - átlagos felhasználó extra jogok nélkül\r\n1 - moderátor\r\n2 - admin',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nev` (`nev`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalo`
--

LOCK TABLES `felhasznalo` WRITE;
/*!40000 ALTER TABLE `felhasznalo` DISABLE KEYS */;
INSERT INTO `felhasznalo` VALUES (0,'admin','admin@codeoverflow.hu','$2y$10$ahdPaWWNynijcnSRAvE0kuYvmh0UVm4NQZBbQdiK0D1u0UVtSAjYq',0,'2025-04-13 17:27:11','2025-04-13 17:27:11',2),(1,'domebence','domebence05@gmail.com','$2y$10$U2PguawX01AsH2T9Zc9DFOqSI2f87.fmOU66ZFsJGY8xrjWYPR3aG',500,'2025-04-13 17:28:30','2025-04-13 17:28:30',2);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalo_megvett`
--

LOCK TABLES `felhasznalo_megvett` WRITE;
/*!40000 ALTER TABLE `felhasznalo_megvett` DISABLE KEYS */;
INSERT INTO `felhasznalo_megvett` VALUES (11,155,12),(12,79,56);
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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felhasznalo_token`
--

LOCK TABLES `felhasznalo_token` WRITE;
/*!40000 ALTER TABLE `felhasznalo_token` DISABLE KEYS */;
INSERT INTO `felhasznalo_token` VALUES (1,79,'$2y$10$2.KbYP0wKSbGztENnlepQehPjGl1p09FESn98cFnSQD6HHH.VOXMW','2025-01-12 18:11:20'),(4,79,'$2y$10$04JXGh4XaKiwMs.gwAmb2uT0xCcAzgs04dI9ORy8fytKOKAkbHb6.','2025-01-12 18:24:12'),(5,79,'$2y$10$ASz7H1WaDvvV8n1ZLC5vGe7iS.782el/ygBiyD83wUJfrk/IXhHfe','2025-01-14 13:21:07'),(6,79,'$2y$10$j7dziuLGQsnpST0f15ucbuo1zlEYVoiVkFUBxhqzHDbaQSRbuA56a','2025-01-15 17:23:16'),(7,82,'$2y$10$O0BO/hEW1w..BzLXVLrMZ.Xq8F8Rf6giqbExG.vCR.Ee7si8WtpeG','2025-01-18 16:35:50'),(8,79,'$2y$10$Sdw1P6Kli9057zu4wfI3IeI.BUq7gPyPo9/mTqNXrqi6d1LhVs.Ou','2025-01-18 18:06:29'),(9,79,'$2y$10$E.iKz01WjRG3Yb49gDx/sOyFMxmK2LK38fws9WOfGqRvSfNHAVqrq','2025-01-21 13:05:44'),(10,79,'$2y$10$tytvF13PnsZU9B3d.YIGoe6yrI01SO6tqdE0I1/Vp/ay6Nj34RgQe','2025-02-09 18:05:10'),(11,79,'$2y$10$8UvzGQp8/yCe3DX2lgcrYuxlhDKIaker.eUmVBKeZF47ojS9fj3Hm','2025-02-25 16:42:09'),(12,8,'$2y$10$2wpNLKv7JikOLM4PmTaw4.z15q7RIN1SN.SyuPEgoIPW3MTLBwZaG','2025-02-25 16:43:23'),(13,8,'$2y$10$qYQEIEkfEwGYj7LtwgOY2.mOmXt3Jh0PdVQVMEyLOnkin/4EXX/2.','2025-02-26 15:31:07'),(14,79,'$2y$10$cSKq5RY/3/vLGV7zDQBy.O4Ur4.fgmfdzW3z/D2q/92AWPrGz44Pm','2025-02-26 18:18:55'),(15,79,'$2y$10$TmZ0E6AGh36YesqH1HFvmeOqXZNf/RUJTB2lY.nn3UXnQiEGgN2IG','2025-02-26 18:22:53'),(16,8,'$2y$10$rmXXy5yGSSI/C2r8jCz/Hea0G4dBefBCAgVBO.UL4X0PDb9Jyg1Ai','2025-02-26 18:34:35'),(17,8,'$2y$10$rxvSIJMX4pOsmQ20zj0FReV5d2bSLKRl5uExchKNUnK0VZa8oppQ6','2025-02-26 19:10:57'),(18,8,'$2y$10$/nEOEgcMt.q/PnBirfFs0.saZdckivm1Le/VWmpW4LF9.ZEp1vN8m','2025-03-04 08:56:09'),(19,79,'$2y$10$xZ8/wekZN3KeFkHFDodn2OTFyajgiHxVDJW3jJ0f0UGpz3GuvLZhS','2025-03-05 16:00:32'),(20,79,'$2y$10$xSuFG/5yMHhMss4YrAVKB.shHf0Rds///vFHfZOf4RC6VaOXGCePe','2025-03-05 17:01:59'),(21,79,'$2y$10$UDn3YasPvucvp9EF2.elf.6r9gl1QEp5JTOQPFmUkPADRu5qoxrDu','2025-03-05 17:02:25'),(22,79,'$2y$10$Uq2ap6IyW/G7zZRufLbwlOhhnl637NHleORXFAZotgedPBwzzrXd6','2025-03-05 17:04:42'),(23,79,'$2y$10$QiCqx3fAxD.RP1onb1qJKOJW08hO.1ihwvDI4XdngbRhmiu4D6IGi','2025-03-05 17:05:18'),(24,79,'$2y$10$i3piqldtnj8jea.xDQv3Gu7OJwuUZwz.4zwFaGOLyI8vxO5A5CMgu','2025-03-05 17:05:39'),(25,79,'$2y$10$kp4Hj9jl6zcI3asKk4Lad.SyBiexWmsCFfaWYYW6COCftg8jOBLzy','2025-03-05 17:06:52'),(26,79,'$2y$10$piMC2uzC4bPx5vNOsfOu3OG4LFCrWb2CpYrIhWSjWer41OETmS6bu','2025-03-05 17:07:23'),(27,79,'$2y$10$ZnFkoZfvBqo99ZQt/GqJxOmRS92U9tD.NMtNuDqUezcknnzniwU4e','2025-03-05 17:12:13'),(28,79,'$2y$10$xQKbBpyVHY8clf0Ad1L0R.VNUTe3.pLqsiYf6mh3aOZt9fyE1.M9y','2025-03-05 17:12:33'),(29,79,'$2y$10$H9aDsTcLbqxOaMwhwvYZvekvXBvXyCZ8NBPgGZVp1eUnfwLnl63U.','2025-03-05 17:13:43'),(30,79,'$2y$10$sRvGoQ.6xFFG5W3E2dFD3uqRN8ldT/IiezelfUrYX5XjNFJ3VWlxC','2025-03-05 17:14:43'),(31,79,'$2y$10$0RpU6gn65aIY.aI8LJTBxu.Go9a8bzru8mKh29BUoCyiRIeLlgpbK','2025-03-05 17:18:09'),(32,79,'$2y$10$Eio4I1zV/dSgBbYxwUljEuNoh1zMKr38IU0EOsTYsRxgGcG/6p..q','2025-03-05 17:19:04'),(33,79,'$2y$10$P0ILZWvGoOOfsCVhB0HCgOuyELiAdRAAUbTt34tcQDKDzzhDCftRq','2025-03-07 17:22:36'),(34,8,'$2y$10$QBkQmz7q5auYJZj3yThwMewVbN7tHrOwZbKRr31s/FK6fbFMKF3/y','2025-03-07 17:29:55'),(35,8,'$2y$10$edQC8S2sZRs.ixYCoxzLr.iVy6lldGV9yeWU4XMoyVSr6Iy9iKDiS','2025-03-09 15:34:53'),(36,79,'$2y$10$UrpGYhYSaRla4NzQrWmwtu6e6/JqYiHLeFQ0FDLlJlBESa47xb.5C','2025-03-09 16:32:59'),(37,79,'$2y$10$YUzmvSbncSI.BWOMKuqutuF23GbFXWyC2sWTsCj7rqzCPjIciC9dq','2025-03-09 16:37:00'),(38,8,'$2y$10$XC4u9McbXQ/fwsHnr.sPxewYzA2e7dNKgLmPgpSy6MqLg5jI8hYNy','2025-03-09 16:45:35'),(39,8,'$2y$10$9tY9s3DzhjPAD1FLzvDJFegyImLpnuBYWOUOIA9LRBIOMeoK5nXmC','2025-03-16 13:53:46'),(40,8,'$2y$10$ge.FtpbqANXrgySi2ZIoduSYz0GMb1Zeg3wLBaxShmwWJs1WK5t2W','2025-03-16 13:55:27'),(41,8,'$2y$10$fsdfWh60.KD.z1a76L9BSut766mH977Esnz3Wnsoi1bqaiyhGYyuO','2025-03-18 07:50:32'),(42,8,'$2y$10$THG35L0vt7FhVrffPhI/Z.8.bxZYQ00i9Ves3MihWKBvdw3gM8YZa','2025-03-19 18:57:43'),(43,79,'$2y$10$HOYYJB3wVIJDNR1SIYP5/eR0LUac5mOWzs5/9XjetAT//m6iNsz2S','2025-03-22 20:10:58'),(44,79,'$2y$10$kKbKdxiURlVrxqSgjU9voedLHJMgSCDUsojpA2ETyt/QT5f7s9Eai','2025-03-26 15:49:06'),(45,150,'$2y$10$L3UPpry3yrU/HjqITZ3s1ulXf2AqKcdgSHgKztc7939CJ8mGY7lbO','2025-03-26 16:38:16'),(46,79,'$2y$10$YcNndJTORf8BSxrMwa99VOwXKUemNiDJEVBO3TmywPH/hB.QJduem','2025-03-26 16:59:08'),(47,79,'$2y$10$4hKmtZfV.cH/FpRBUuHd1.Y/OU4Xz4VzHxxl4bsB.OyNbgAo.fWti','2025-04-01 06:56:11'),(48,151,'$2y$10$fhRMsga.ciHG6jLaBXgf5.PXASrdqvp3so4ffOTx758DVY9Pvgqsi','2025-04-02 16:20:41'),(49,152,'$2y$10$akMXlpmAuSIc4xIklQW3C.RG5l9IqC5MfD9/ZRPBhRRlKVN7xwps2','2025-04-02 17:05:02'),(50,64,'$2y$10$UzwqRi8fixk3meVxufBL7.csXwxQAxnR3lhFk6zDq5V4FECW2WjLy','2025-04-02 18:18:40'),(51,152,'$2y$10$hnU.phCfc41gRRKW/vdQGO5ey22zlpEszKjuBNBmvxsb/GFonrYJG','2025-04-02 18:50:11'),(52,79,'$2y$10$PPPQa5s3koWbPKymCzk1l.1gAUWenKwmIae5lcRMdYyhtAZ1M.i1G','2025-04-02 19:44:57'),(53,153,'$2y$10$lmrnZmgrKmifpnXdyE35z.jWE8SrDwP2FWyeCjdhT.U/4EG5AJAOS','2025-05-02 15:44:07'),(54,79,'$2y$10$J9e3ROaXoXP6IG5KHR.Foe2e8H/J.6Q6xC8CSy6Thtex/fDUiWLqG','2025-05-02 15:50:58'),(55,79,'$2y$10$3RUQnv/TDKle01UqOAINg.3JO5hM7ugHFu7hHXd7Ctak2AYprIi7u','2025-05-02 16:16:16'),(56,155,'$2y$10$g3BZ3ui/oU7utR3072TVG.nq7WvotAlC78rEuKre9ai4BaZS1CEeq','2025-05-02 16:38:19'),(57,79,'$2y$10$Y2oPd49pmjhjSZ6ii6Wdx.WywiYYIu7SDV1c9XTFEoGo/6d6j815m','2025-05-02 16:48:10'),(58,155,'$2y$10$Or0WjYcAqMNNJuDY3bl9JuwL0SA4wXcqoOcFbuvdn7LToWTqEljPW','2025-05-02 16:49:10'),(59,79,'$2y$10$nJNhgl3rY6gzvKFDs0ZFJOleQPTLjPuihSBX5nAivcu0AfKxLAg8m','2025-05-02 17:07:46'),(60,79,'$2y$10$iTlPeGqQcUQID.FKVp.hbOlk.DF1dKnDuTkI0WZMcqaUquXk81LE6','2025-05-07 13:19:36'),(61,79,'$2y$10$mt7D5/8ItggGhq7N7xOxXup0Wo7FyfoHDGwkhjU25MgNudTu2liEG','2025-05-10 17:12:53'),(62,156,'$2y$10$K7zr70Tam1nZHLrRz8gGhecqV0ZXGrY3ErN2FLRPvrN.gLMJQGQqW','2025-05-10 17:37:29'),(63,156,'$2y$10$KXeXt36m7oFXy7x849Dhnuy71C7F1dcWiNQKEpGKwrTGqIA59DvX6','2025-05-13 15:03:04'),(64,79,'$2y$10$tcniI2brehMkqHRWz424XObevZ2Z.iI.SmvjcOAyT.iCMCDKkbwpC','2025-05-13 15:06:25'),(65,157,'$2y$10$lUA55.aj9bum2JQBEvH0sOmLurDxIqt4LnJs6CfiNTShQTDGs4Kdi','2025-05-13 15:27:47'),(66,158,'$2y$10$g7NTt9lahDCVjL3s5v5BJOkk1Yq/zpOEyfRlA/7z4Bxh0u83vyEy6','2025-05-13 15:28:38'),(67,1,'$2y$10$PhKvSGmxWj/xRtnHCXzvHORS1VFimF3qcse7vOXOVfWtk52ql2wFy','2025-05-13 16:37:12');
/*!40000 ALTER TABLE `felhasznalo_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `felkeres`
--

LOCK TABLES `felkeres` WRITE;
/*!40000 ALTER TABLE `felkeres` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kod`
--

LOCK TABLES `kod` WRITE;
/*!40000 ALTER TABLE `kod` DISABLE KEYS */;
INSERT INTO `kod` VALUES (0,1,1,'Színátmenetes Gomb Hover',320,'linear-gradient-button.css','2025-04-13 17:46:14',1),(1,1,1,'Üveg Hatású Kártya',480,'glassy-card.css','2025-04-13 17:52:28',1),(2,1,1,'Sötét Mód',250,'dark-mode.css','2025-04-13 17:53:41',1),(3,1,1,'Szövegárnyékolás',0,'text-shadow.css','2025-04-13 17:54:47',1),(4,1,2,'Kapcsolatfelvételi Űrlap',400,'contact-form.php','2025-04-13 18:11:51',1),(5,1,2,'Látogatószámláló',350,'visitor-counter.php','2025-04-13 18:12:55',1),(6,1,2,'Egyszerű bejelentkezés ellenőrzés',500,'login-validator.php','2025-04-13 18:14:03',1),(7,1,2,'Dátum- és idő kiíró',0,'datetime-display.php','2025-04-13 18:15:09',1),(8,1,3,'Gombnyomás számláló',300,'click-counter.js','2025-04-13 18:19:08',1),(9,1,3,'Sötét/Világos Mód Kapcsoló',0,'light-darkmode-switch.js','2025-04-13 18:19:53',1),(10,1,3,'Egér Pozíció Követő',150,'mouse-position-tracker.js','2025-04-13 18:20:12',1),(11,1,4,'Számkitaláló játék',500,'number-guesser.py','2025-04-13 18:24:27',1),(12,1,4,'Szófordító',450,'dictionary.py','2025-04-13 18:25:14',1),(13,1,4,'Szöveg megfordító',0,'text-reverser.py','2025-04-13 18:25:31',1),(14,1,5,'Összeadó',300,'additioner.cs','2025-04-13 18:27:58',1),(15,1,5,'Dátum- és idő megjelenítő',250,'actual-time-display.cs','2025-04-13 18:28:46',1),(16,1,5,'Véletlenszám generátor',0,'random-num-generator.cs','2025-04-13 18:29:34',1),(17,1,6,'Felhasználói tábla létrehozása',300,'create-user-table.sql','2025-04-13 18:31:47',1),(18,1,6,'Összes felhasználói adat lekérdezése',250,'get-all-users.sql','2025-04-13 18:33:58',1),(19,1,6,'Új felhasználó létrehozás',350,'insert-new-user.sql','2025-04-13 18:34:25',1),(20,1,6,'Felhasználók számának lekérése',0,'get-user-count.sql','2025-04-13 18:35:22',1);
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
INSERT INTO `kod_like` VALUES (6,12,16,1,'2025-04-02 17:04:23',0),(7,90,15,1,'2025-04-02 17:05:55',1),(8,33,13,1,'2025-04-02 17:38:04',0),(9,79,55,1,'2025-04-02 19:08:45',0),(10,79,12,1,'2025-04-13 17:07:24',0);
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

-- Dump completed on 2025-04-15 22:14:10
