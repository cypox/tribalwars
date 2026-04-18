-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: tribalwars_main
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.24.04.1

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
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `link` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `graphic` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anuncio_global`
--

DROP TABLE IF EXISTS `anuncio_global`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anuncio_global` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('1','2','3') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `text` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` enum('1','0') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncio_global`
--

LOCK TABLES `anuncio_global` WRITE;
/*!40000 ALTER TABLE `anuncio_global` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncio_global` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buy_logs`
--

DROP TABLE IF EXISTS `buy_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buy_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `world` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `qtn` int DEFAULT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buy_logs`
--

LOCK TABLES `buy_logs` WRITE;
/*!40000 ALTER TABLE `buy_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `buy_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `change_mail`
--

DROP TABLE IF EXISTS `change_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `change_mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `username` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `new_mail` varchar(600) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `second_mail` varchar(600) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `cod` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `change_mail`
--

LOCK TABLES `change_mail` WRITE;
/*!40000 ALTER TABLE `change_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `change_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `style` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `support_lang` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES (2,'localhost','','PT','2'),(3,'127.0.0.1','','','1');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `confirmations`
--

DROP TABLE IF EXISTS `confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `confirmations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `package` int NOT NULL DEFAULT '0',
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `admin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `resolved_on` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confirmations`
--

LOCK TABLES `confirmations` WRITE;
/*!40000 ALTER TABLE `confirmations` DISABLE KEYS */;
/*!40000 ALTER TABLE `confirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_gms`
--

DROP TABLE IF EXISTS `log_gms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_gms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `admin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `horario` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_gms`
--

LOCK TABLES `log_gms` WRITE;
/*!40000 ALTER TABLE `log_gms` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_gms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `login_locked` enum('yes','no') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'no',
  `start` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `first_visit` tinyint(1) NOT NULL DEFAULT '0',
  `extern_auth` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logins`
--

DROP TABLE IF EXISTS `logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `userid` int NOT NULL,
  `uv` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (1,'Mugaru',1416476603,'83.81.200.141',1,'',''),(2,'Mugaru',1416494911,'83.81.200.141',1,'',''),(3,'Mugaru',1416497307,'83.81.200.141',1,'',''),(4,'Mugaru',1416559513,'83.81.200.141',1,'',''),(5,'Ukiraki',1416566632,'83.81.212.175',2,'',''),(6,'Mugaru',1416588550,'84.85.223.71',1,'',''),(7,'Mugaru',1416591296,'84.85.223.71',1,'',''),(8,'Mugaru',1416592088,'84.85.223.71',1,'',''),(9,'Mugaru',1416592258,'84.85.223.71',1,'',''),(10,'Mugaru',1416592270,'84.85.223.71',1,'',''),(11,'Mugaru',1416593060,'84.85.223.71',1,'',''),(12,'Mugaru',1416759792,'84.85.223.71',1,'',''),(13,'Mugaru',1416818672,'83.81.200.141',1,'',''),(14,'Mugaru',1416819291,'83.81.200.141',1,'',''),(15,'Mugaru',1416820583,'83.81.200.141',1,'',''),(16,'Mugaru',1416825275,'83.81.200.141',1,'',''),(17,'Mugaru',1416847466,'84.85.223.71',1,'',''),(18,'Mugaru',1416908160,'83.81.200.141',1,'',''),(19,'Mugaru',1416910859,'83.81.200.141',1,'',''),(20,'Mugaru',1416911229,'83.81.200.141',1,'',''),(21,'Mugaru',1416921829,'83.81.200.141',1,'',''),(22,'admin',1695435244,'168.121.102.166',3,'',''),(23,'admin',1695435307,'168.121.102.166',3,'',''),(24,'admin',1695435335,'168.121.102.166',3,'',''),(25,'admin',1695435366,'168.121.102.166',3,'',''),(26,'admin',1695435373,'168.121.102.166',3,'',''),(27,'admin',1695435391,'168.121.102.166',3,'',''),(28,'admin',1695435474,'168.121.102.166',3,'',''),(29,'admin',1695435716,'168.121.102.166',3,'',''),(30,'admin',1695435845,'168.121.102.166',3,'',''),(31,'admin',1695436078,'168.121.102.166',3,'',''),(32,'Mugaru',1695436457,'168.121.102.166',1,'',''),(33,'Mugaru',1695436509,'168.121.102.166',1,'',''),(34,'Mugaru',1695436534,'168.121.102.166',1,'',''),(35,'admin',1695436631,'127.0.0.1',3,'',''),(36,'Mugaru',1695438554,'127.0.0.1',1,'',''),(37,'admin',1695438588,'127.0.0.1',3,'',''),(38,'admin',1695439074,'127.0.0.1',3,'',''),(39,'Mugaru',1695444406,'168.121.102.166',1,'',''),(40,'Mugaru',1695444573,'168.121.102.166',1,'',''),(41,'admin',1695444647,'168.121.102.166',3,'',''),(42,'admin',1695466830,'168.121.102.166',3,'',''),(43,'Mugaru',1695467246,'127.0.0.1',1,'',''),(44,'admin',1695467433,'127.0.0.1',3,'',''),(45,'Bruno',1695473643,'191.245.68.246',4,'',''),(46,'admin',1695494903,'168.121.102.166',3,'',''),(47,'admin',1695498740,'168.121.102.166',3,'',''),(48,'admin',1695498769,'168.121.102.166',3,'',''),(49,'admin',1695498798,'168.121.102.166',3,'',''),(50,'admin',1695498828,'168.121.102.166',3,'',''),(51,'admin',1695498834,'168.121.102.166',3,'',''),(52,'admin',1695499366,'168.121.102.166',3,'',''),(53,'admin',1695499376,'168.121.102.166',3,'',''),(54,'admin',1695499763,'168.121.102.166',3,'',''),(55,'admin',1695499774,'168.121.102.166',3,'',''),(56,'admin',1695500191,'127.0.0.1',3,'',''),(57,'cypox',1776019087,'::1',7,'',''),(58,'cypox',1776019093,'::1',7,'',''),(59,'cypox',1776019146,'::1',7,'',''),(60,'test',1776031115,'127.0.0.1',9,'TestBrowser',''),(61,'test',1776031130,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(62,'test',1776031837,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(63,'admin',1776032061,'::1',3,'curl/8.5.0',''),(64,'test',1776032094,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(65,'admin',1776032487,'::1',3,'curl/8.5.0',''),(66,'admin',1776032592,'::1',3,'curl/8.5.0',''),(67,'testuser5',1776032606,'::1',5,'curl/8.5.0',''),(68,'test',1776032612,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(69,'cypox',1776032632,'::1',7,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(70,'test',1776032645,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(71,'testuser5',1776032650,'::1',5,'curl/8.5.0',''),(72,'testuser5',1776032663,'::1',5,'curl/8.5.0',''),(73,'testuser5',1776032815,'::1',5,'curl/8.5.0',''),(74,'testuser5',1776032829,'::1',5,'curl/8.5.0',''),(75,'testuser5',1776032855,'::1',5,'curl/8.5.0',''),(76,'testuser5',1776032884,'::1',5,'curl/8.5.0',''),(77,'testuser5',1776032921,'::1',5,'curl/8.5.0',''),(78,'testuser5',1776032962,'::1',5,'curl/8.5.0',''),(79,'testuser5',1776033004,'::1',5,'curl/8.5.0',''),(80,'cypox',1776033156,'::1',7,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(81,'test',1776033188,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(82,'test',1776109084,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(83,'test',1776413843,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36',''),(84,'test',1776553755,'172.22.0.1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','');
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paygol_logs`
--

DROP TABLE IF EXISTS `paygol_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paygol_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `service_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `shortcode` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `keyword` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sender` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `operator` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `custom` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `points` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `price` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `currency` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paygol_logs`
--

LOCK TABLES `paygol_logs` WRITE;
/*!40000 ALTER TABLE `paygol_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `paygol_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paypal_logs`
--

DROP TABLE IF EXISTS `paypal_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paypal_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amount` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `item_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `custom` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amounts` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paypal_logs`
--

LOCK TABLES `paypal_logs` WRITE;
/*!40000 ALTER TABLE `paypal_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions_ranks`
--

DROP TABLE IF EXISTS `permissions_ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions_ranks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rank` int NOT NULL,
  `adm_login` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_home` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_support` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `delticket` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `adm_settings` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_settings_news` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_settings_users` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_settings_villages` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_settings_worlds` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_settings_worlds_reset` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_ranks` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `adm_memo` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `addpremium` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `gerenciar` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `ban` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `cargos` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `spam` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions_ranks`
--

LOCK TABLES `permissions_ranks` WRITE;
/*!40000 ALTER TABLE `permissions_ranks` DISABLE KEYS */;
INSERT INTO `permissions_ranks` VALUES (5,5,'1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1');
/*!40000 ALTER TABLE `permissions_ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `premium_feature`
--

DROP TABLE IF EXISTS `premium_feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `premium_feature` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `world` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `activated_on` varchar(400) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'active_on|active_for',
  `activated_until` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `premium_feature`
--

LOCK TABLES `premium_feature` WRITE;
/*!40000 ALTER TABLE `premium_feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `premium_feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ranks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `namecolor` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranks`
--

LOCK TABLES `ranks` WRITE;
/*!40000 ALTER TABLE `ranks` DISABLE KEYS */;
INSERT INTO `ranks` VALUES (1,'Lanceiro','','');
/*!40000 ALTER TABLE `ranks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `session` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `userid` int NOT NULL,
  `hkey` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sid` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_vacation` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (5,0,'',2,'DmA3','Jlu3z9ZscAdC5BVpZLIH2VcFHAY77r1G',0),(45,0,'',4,'rfis','4y72dLNy5fWnvY6fPqpoTyqv2QhP6fx4',0),(70,3,'',3,'dCBN','qp3ImRyQqGTpJ4PwNvGlKTgEEaW4Z13D',0),(88,9,'',9,'mV6d','9FJllmQbQwQayUApAzDXFSRsdClIt6Ng',0),(83,5,'',5,'MxoR','b9raPsM8Df3YvLsvmJ4xJmhINNc5NIwj',0);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_feedback`
--

DROP TABLE IF EXISTS `support_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support_feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `supporter` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `rating` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_feedback`
--

LOCK TABLES `support_feedback` WRITE;
/*!40000 ALTER TABLE `support_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_response`
--

DROP TABLE IF EXISTS `support_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support_response` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticket_id` int NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT 'Opcional!',
  `response` varchar(3000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_response`
--

LOCK TABLES `support_response` WRITE;
/*!40000 ALTER TABLE `support_response` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_response` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_ticket`
--

DROP TABLE IF EXISTS `support_ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support_ticket` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `world` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `text` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_response` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_ticket`
--

LOCK TABLES `support_ticket` WRITE;
/*!40000 ALTER TABLE `support_ticket` DISABLE KEYS */;
INSERT INTO `support_ticket` VALUES (1,1,'1','1','Ik zie een bug','Hoi Bug\r\n','24-11-2014 12:54:35','resolved','24-11-2014 12:54:35');
/*!40000 ALTER TABLE `support_ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support_upload`
--

DROP TABLE IF EXISTS `support_upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support_upload` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `ticket_id` int NOT NULL,
  `name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `upload_name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `date` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hour` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `extension` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support_upload`
--

LOCK TABLES `support_upload` WRITE;
/*!40000 ALTER TABLE `support_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banned` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `ban_reason` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ban_from` int NOT NULL,
  `ban_data` datetime NOT NULL,
  `ban_end` datetime NOT NULL,
  `username` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sid` int NOT NULL,
  `country` varchar(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `country_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time_reg` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_reg` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `join_date` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `activation_code` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `activated` int NOT NULL,
  `premium_points` int NOT NULL DEFAULT '100',
  `administration` int NOT NULL DEFAULT '1',
  `rank` int NOT NULL DEFAULT '1',
  `wins` int NOT NULL DEFAULT '0',
  `support_session` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'N','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','Mugaru','7ec57a9a5122f75c27221ac8de1b0b9a','baasszz@live.nl',0,'','','','','1416476570','',0,100,1,1,0,'',1695467421),(2,'N','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','Ukiraki','064eb240f0be2b5e5f7e78eeedf2ff39','nickdenbutter@hotmail.com',0,'','','','','1416566613','',0,100,1,1,0,'',1416570051),(3,'N','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','admin','6ede495b3b6faca7bf0e80e5dfe92804','akamarumutante22@gmail.com',0,'','','','','1695435237','',0,100,1,1,0,'',1695514360),(4,'N','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00','Bruno','c5208d8c6cd28ba8d0185cdac2ab8345','brunoxdoliveira@gmail.com',0,'','','','','1695473633','',0,100,1,1,0,'',0),(5,'N','',0,'2026-04-12 20:27:11','2026-04-12 20:27:11','testuser5','6ede495b3b6faca7bf0e80e5dfe92804','test5@example.com',0,'','','1776018431','127.0.0.1','1776018431','',0,100,1,1,0,'',1776103900),(6,'N','',0,'2026-04-12 20:27:16','2026-04-12 20:27:16','testuser6','99b0c8a41516134bf239735dd3f46dea','test6@example.com',0,'','','1776018436','127.0.0.1','1776018436','',0,100,1,1,0,'',0),(7,'N','',0,'2026-04-12 20:27:51','2026-04-12 20:27:51','cypox','7ae9f99c3d8b07ae17ddd4d66fd52e92','cypox@cypox.com',0,'','','1776018471','::1','1776018471','',0,100,1,1,0,'',1776033183),(9,'N','',0,'2000-01-01 00:00:00','2000-01-01 00:00:00','test','ef36ce8210c6be2ce1b894ffe1f38153','test@test.com',0,'','','1776030478','::1','1776030478','',1,100,1,1,0,'',1776554213);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worlds`
--

DROP TABLE IF EXISTS `worlds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `worlds` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `db` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `active` int NOT NULL,
  `order` int NOT NULL,
  `start` int NOT NULL,
  `type` enum('world','cluster') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'world',
  `cluster_end_time` int NOT NULL DEFAULT '0',
  `duration` int NOT NULL,
  `prize` int NOT NULL,
  `tribe_bonus` int NOT NULL,
  `limit` int NOT NULL,
  `link` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `dir` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worlds`
--

LOCK TABLES `worlds` WRITE;
/*!40000 ALTER TABLE `worlds` DISABLE KEYS */;
INSERT INTO `worlds` VALUES (1,'World1','tribalwars_world',1,1,0,'world',0,0,999,666,0,'tribalwars/wereld1','wereld1');
/*!40000 ALTER TABLE `worlds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tribalwars_main'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-18 20:19:42
