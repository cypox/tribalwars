-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: tribalwars_world
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
-- Table structure for table `ally`
--

DROP TABLE IF EXISTS `ally`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ally` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `short` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `points` int unsigned NOT NULL,
  `rank` int unsigned NOT NULL,
  `best_points` int unsigned NOT NULL,
  `members` int unsigned NOT NULL,
  `villages` int unsigned NOT NULL,
  `intern_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `homepage` varchar(640) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `irc` varchar(640) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `intro_igm` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `killed_units_att` int NOT NULL,
  `killed_units_att_rank` int NOT NULL,
  `killed_units_def` int NOT NULL,
  `killed_units_def_rank` int NOT NULL,
  `killed_units_altogether` int NOT NULL,
  `killed_units_altogether_rank` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rank` (`rank`),
  KEY `name` (`name`),
  KEY `short` (`short`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ally`
--

LOCK TABLES `ally` WRITE;
/*!40000 ALTER TABLE `ally` DISABLE KEYS */;
INSERT INTO `ally` VALUES (1,'Test','test',43192,1,43192,2,6,'Tribo+fundada+por++%5Bplayer%5DMugaru%5B%2Fplayer%5D%0D%0A%0D%0AEste+texto+pode+ser+alterado+pelos+administradores+da+tribo.%0D%0A%5Bplayer%5Dolla%5B%2Fplayer%5D','%5Bally%5Dtest%5B%2Fally%5D+foi+fundada+por+%5Bplayer%5DMugaru%5B%2Fplayer%5D.%0AEm+caso+de+d%C3%BAvidas+dirija-se+%C3%A0+%5Bplayer%5DMugaru%5B%2Fplayer%5D%0A%0AEste+texto+pode+ser+alterado+pelos+diplomatas+da+tribo.','','','','',2800,0,440,0,3240,0),(2,'STAFF','STAFF',515,2,515,1,1,'Tribo+fundada+por+%5Bplayer%5Dadmin%5B%2Fplayer%5D%0A%0AEste+texto+pode+ser+alterado+pelos+administradores+da+tribo.','%5Bally%5DSTAFF%5B%2Fally%5D+foi+fundada+por+%5Bplayer%5Dadmin%5B%2Fplayer%5D.%0AEm+caso+de+d%C3%BAvidas+dirija-se+%C3%A0+%5Bplayer%5Dadmin%5B%2Fplayer%5D%0A%0AEste+texto+pode+ser+alterado+pelos+diplomatas+da+tribo.','','','','',0,0,0,0,0,0);
/*!40000 ALTER TABLE `ally` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ally_contracts`
--

DROP TABLE IF EXISTS `ally_contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ally_contracts` (
  `from_ally` int NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to_ally` int NOT NULL,
  `short` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ally_contracts`
--

LOCK TABLES `ally_contracts` WRITE;
/*!40000 ALTER TABLE `ally_contracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `ally_contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ally_events`
--

DROP TABLE IF EXISTS `ally_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ally_events` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ally` int unsigned NOT NULL,
  `time` int unsigned NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ally` (`ally`),
  KEY `time` (`time`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ally_events`
--

LOCK TABLES `ally_events` WRITE;
/*!40000 ALTER TABLE `ally_events` DISABLE KEYS */;
INSERT INTO `ally_events` VALUES (2,1,1416479364,'Tribo+fundada+por+%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E.'),(3,1,1416567371,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D2%22%3EUkiraki%3C%2Fa%3E+foi+convidado+por+%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E.'),(4,1,1416567897,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D2%22%3EUkiraki%3C%2Fa%3E+juntou-se+%C3%A0+tribo.'),(5,1,1416824291,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(6,1,1416825175,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(7,1,1416825178,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(8,1,1416825476,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(9,1,1416826058,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(10,1,1416826065,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(11,1,1416826330,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(12,1,1416826401,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(13,1,1416826407,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(14,1,1416826627,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(15,1,1416826674,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(16,1,1416826913,'%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D1%22%3EMugaru%3C%2Fa%3E+modificou+o+quadro+de+an%C3%BAncios.'),(17,2,1695477987,'Tribo+fundada+por+%3Ca+href%3D%22game.php%3Fvillage%3D%3B%26screen%3Dinfo_player%26id%3D3%22%3Eadmin%3C%2Fa%3E.');
/*!40000 ALTER TABLE `ally_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ally_invites`
--

DROP TABLE IF EXISTS `ally_invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ally_invites` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_ally` int unsigned NOT NULL,
  `to_userid` int unsigned NOT NULL,
  `to_username` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ally_invites`
--

LOCK TABLES `ally_invites` WRITE;
/*!40000 ALTER TABLE `ally_invites` DISABLE KEYS */;
/*!40000 ALTER TABLE `ally_invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `graphic` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

LOCK TABLES `announcement` WRITE;
/*!40000 ALTER TABLE `announcement` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `build`
--

DROP TABLE IF EXISTS `build`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `build` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `mode` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `building` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `villageid` int unsigned DEFAULT NULL,
  `end_time` int unsigned NOT NULL,
  `build_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `villageid` (`villageid`)
) ENGINE=MyISAM AUTO_INCREMENT=862 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `build`
--

LOCK TABLES `build` WRITE;
/*!40000 ALTER TABLE `build` DISABLE KEYS */;
/*!40000 ALTER TABLE `build` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config` (
  `name` varchar(100) NOT NULL,
  `ano` varchar(100) NOT NULL,
  `cdn` varchar(100) NOT NULL,
  `forum` varchar(100) NOT NULL,
  `version` varchar(100) NOT NULL,
  `global_db` varchar(100) NOT NULL,
  `world_name` varchar(100) NOT NULL,
  `master_pw` varchar(100) NOT NULL,
  `speed` varchar(100) NOT NULL,
  `count_create_left` varchar(100) NOT NULL,
  `min_villages` varchar(100) NOT NULL,
  `map_incircle` varchar(100) NOT NULL,
  `left_name` varchar(100) NOT NULL,
  `village_choose_direction` varchar(100) NOT NULL,
  `reason_defense` varchar(100) NOT NULL,
  `factor_spy` varchar(100) NOT NULL,
  `cancel_movement` varchar(100) NOT NULL,
  `movement_speed` varchar(100) NOT NULL,
  `moral_activ` enum('0','1') NOT NULL,
  `min_moral` varchar(100) NOT NULL,
  `agreement_per_hour` varchar(100) NOT NULL,
  `agreement_min` varchar(100) NOT NULL,
  `agreement_max` varchar(100) NOT NULL,
  `noob_protection` varchar(100) NOT NULL,
  `ennobled_protection` varchar(100) NOT NULL,
  `dealer_time` varchar(100) NOT NULL,
  `cancel_dealers` varchar(100) NOT NULL,
  `ag_style` varchar(100) NOT NULL,
  `bh_style` varchar(100) NOT NULL,
  `create_ally` enum('0','1') NOT NULL,
  `leave_ally` enum('0','1') NOT NULL,
  `close_ally` enum('0','1') NOT NULL,
  `members_ally` varchar(100) NOT NULL,
  `auto_ally` enum('0','1') NOT NULL,
  `no_actions` enum('0','1') NOT NULL,
  `not_more_villages` enum('0','1') NOT NULL,
  `ip_control` enum('0','1') NOT NULL,
  `attack_visit` enum('0','1') NOT NULL,
  `build_destroy` enum('0','1') NOT NULL,
  `archers` enum('0','1') NOT NULL,
  `night_start` varchar(100) NOT NULL,
  `night_end` varchar(100) NOT NULL,
  `spy_style` varchar(100) NOT NULL,
  `gold_coin_price_wood` varchar(100) NOT NULL,
  `gold_coin_price_stone` varchar(100) NOT NULL,
  `gold_coin_price_iron` varchar(100) NOT NULL,
  `auto_build_active` varchar(100) NOT NULL,
  `auto_build_max_points` varchar(100) NOT NULL,
  `auto_build_grow_time` varchar(100) NOT NULL,
  `buildings_base` varchar(100) NOT NULL,
  `buildings_factor` varchar(100) NOT NULL,
  `catapult_wall_base` varchar(100) NOT NULL,
  `catapult_wall_factor` varchar(100) NOT NULL,
  `ram_buildings_base` varchar(100) NOT NULL,
  `ram_buildings_factor` varchar(100) NOT NULL,
  `ram_wall_base` varchar(100) NOT NULL,
  `ram_wall_factor` varchar(100) NOT NULL,
  `church` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES ('Tribalwars','2023','../global_cdn','#','V0.1','tribalwars_world','World1','testtest','100','1','1','0','Barbarendorp','true','50','2','10','0.20','','35','0.1','02','35','3600','90','5','5','2','1','','','','50','','','','','','1','','20','7','3','28000','30000','25000','true','400','0.5','195','1.115','300','1.09','1.8','1.205','4','1.09','');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `country` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `begin_ip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `end_ip` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `begin_ip_num` int unsigned DEFAULT NULL,
  `end_ip_num` int unsigned DEFAULT NULL,
  `country_code` varchar(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `country_name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `begin_ip_num` (`begin_ip_num`,`end_ip_num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `create_village`
--

DROP TABLE IF EXISTS `create_village`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `create_village` (
  `nw_c` int NOT NULL DEFAULT '1',
  `no_c` int NOT NULL DEFAULT '1',
  `so_c` int NOT NULL DEFAULT '1',
  `sw_c` int NOT NULL DEFAULT '1',
  `nw` int NOT NULL DEFAULT '0',
  `no` int NOT NULL DEFAULT '0',
  `so` int NOT NULL DEFAULT '0',
  `sw` int NOT NULL DEFAULT '0',
  `no_alpha` int NOT NULL DEFAULT '0',
  `nw_alpha` int NOT NULL DEFAULT '0',
  `so_alpha` int NOT NULL DEFAULT '0',
  `sw_alpha` int NOT NULL DEFAULT '0',
  `next_left` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `create_village`
--

LOCK TABLES `create_village` WRITE;
/*!40000 ALTER TABLE `create_village` DISABLE KEYS */;
INSERT INTO `create_village` VALUES (4,3,5,5,2,2,2,2,56,81,39,0,1);
/*!40000 ALTER TABLE `create_village` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `create_village_barb`
--

DROP TABLE IF EXISTS `create_village_barb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `create_village_barb` (
  `nw_c` int NOT NULL DEFAULT '1',
  `no_c` int NOT NULL DEFAULT '1',
  `so_c` int NOT NULL DEFAULT '1',
  `sw_c` int NOT NULL DEFAULT '1',
  `nw` int NOT NULL DEFAULT '0',
  `no` int NOT NULL DEFAULT '0',
  `so` int NOT NULL DEFAULT '0',
  `sw` int NOT NULL DEFAULT '0',
  `no_alpha` int NOT NULL DEFAULT '0',
  `nw_alpha` int NOT NULL DEFAULT '0',
  `so_alpha` int NOT NULL DEFAULT '0',
  `sw_alpha` int NOT NULL DEFAULT '0',
  `next_left` int NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `create_village_barb`
--

LOCK TABLES `create_village_barb` WRITE;
/*!40000 ALTER TABLE `create_village_barb` DISABLE KEYS */;
INSERT INTO `create_village_barb` VALUES (21,23,19,22,58,58,58,58,0,20,71,57,1);
/*!40000 ALTER TABLE `create_village_barb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cron`
--

DROP TABLE IF EXISTS `cron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cron` (
  `mail` int NOT NULL DEFAULT '0',
  `mail_last` int NOT NULL,
  `report` int NOT NULL DEFAULT '0',
  `report_last` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cron`
--

LOCK TABLES `cron` WRITE;
/*!40000 ALTER TABLE `cron` DISABLE KEYS */;
/*!40000 ALTER TABLE `cron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dealers`
--

DROP TABLE IF EXISTS `dealers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dealers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_userid` int unsigned NOT NULL,
  `to_userid` int unsigned NOT NULL,
  `from_village` int unsigned NOT NULL,
  `to_village` int unsigned NOT NULL,
  `wood` int unsigned NOT NULL,
  `stone` int unsigned NOT NULL,
  `iron` int unsigned NOT NULL,
  `start_time` int unsigned NOT NULL,
  `end_time` int unsigned NOT NULL,
  `is_offer` int unsigned NOT NULL DEFAULT '0',
  `dealers` int unsigned NOT NULL DEFAULT '0',
  `type` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_village` (`from_village`),
  KEY `to_village` (`to_village`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dealers`
--

LOCK TABLES `dealers` WRITE;
/*!40000 ALTER TABLE `dealers` DISABLE KEYS */;
/*!40000 ALTER TABLE `dealers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `destroy`
--

DROP TABLE IF EXISTS `destroy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destroy` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `building` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `villageid` int unsigned NOT NULL,
  `end_time` int unsigned NOT NULL,
  `build_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destroy`
--

LOCK TABLES `destroy` WRITE;
/*!40000 ALTER TABLE `destroy` DISABLE KEYS */;
/*!40000 ALTER TABLE `destroy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `event_time` int unsigned DEFAULT '0',
  `event_type` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `event_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `villageid` int unsigned DEFAULT NULL,
  `knot_event` int NOT NULL,
  `cid` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `can_knot` int NOT NULL DEFAULT '0',
  `is_locked` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `event_type` (`event_type`),
  KEY `event_id` (`event_id`),
  KEY `event_time` (`event_time`),
  KEY `user_id` (`user_id`),
  KEY `villageid` (`villageid`)
) ENGINE=MyISAM AUTO_INCREMENT=1052 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ally` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum`
--

LOCK TABLES `forum` WRITE;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_f_read`
--

DROP TABLE IF EXISTS `forum_f_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_f_read` (
  `id` int NOT NULL AUTO_INCREMENT,
  `forum_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_f_read`
--

LOCK TABLES `forum_f_read` WRITE;
/*!40000 ALTER TABLE `forum_f_read` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_f_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_post`
--

DROP TABLE IF EXISTS `forum_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `thread_id` int NOT NULL,
  `message` varchar(4000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `posted_by` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_post`
--

LOCK TABLES `forum_post` WRITE;
/*!40000 ALTER TABLE `forum_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_read`
--

DROP TABLE IF EXISTS `forum_read`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_read` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `thread_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=334 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_read`
--

LOCK TABLES `forum_read` WRITE;
/*!40000 ALTER TABLE `forum_read` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_read` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_thread`
--

DROP TABLE IF EXISTS `forum_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_thread` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `author` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `important` int NOT NULL DEFAULT '0',
  `closed` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_thread`
--

LOCK TABLES `forum_thread` WRITE;
/*!40000 ALTER TABLE `forum_thread` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `friends` (
  `id` int NOT NULL AUTO_INCREMENT,
  `to_userid` int NOT NULL DEFAULT '0',
  `from_userid` int NOT NULL DEFAULT '0',
  `status` enum('activ','pending') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=730 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `knight_items`
--

DROP TABLE IF EXISTS `knight_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `knight_items` (
  `uid` int unsigned NOT NULL,
  `chosen` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `progress` int unsigned DEFAULT NULL,
  `last_actu` int unsigned DEFAULT NULL,
  `spear` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `sword` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `axe` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `archer` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `spy` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `light` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `heavy` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `marcher` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `ram` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `catapult` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  `snob` enum('false','true') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `knight_items`
--

LOCK TABLES `knight_items` WRITE;
/*!40000 ALTER TABLE `knight_items` DISABLE KEYS */;
INSERT INTO `knight_items` VALUES (1,NULL,0,1416673375,'true','true','true','false','true','true','true','false','true','true','true'),(3,'spear',40,1695514099,'true','false','false','false','false','false','true','false','false','false','false');
/*!40000 ALTER TABLE `knight_items` ENABLE KEYS */;
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
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int unsigned NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `userid` int unsigned NOT NULL,
  `uv` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logins`
--

LOCK TABLES `logins` WRITE;
/*!40000 ALTER TABLE `logins` DISABLE KEYS */;
INSERT INTO `logins` VALUES (49,'Mugaru',1416476661,'83.81.200.141',1,''),(50,'Mugaru',1416476684,'83.81.200.141',1,''),(51,'Mugaru',1416476691,'83.81.200.141',1,''),(52,'Mugaru',1416481322,'83.81.200.141',1,''),(53,'Mugaru',1416481624,'83.81.200.141',1,''),(54,'Mugaru',1416483997,'83.81.200.141',1,''),(55,'Mugaru',1416490007,'83.81.200.141',1,''),(56,'Mugaru',1416493416,'83.81.200.141',1,''),(57,'Mugaru',1416494916,'83.81.200.141',1,''),(58,'Mugaru',1416495111,'83.81.200.141',1,''),(59,'Mugaru',1416497314,'83.81.200.141',1,''),(60,'Mugaru',1416559519,'83.81.200.141',1,''),(61,'Ukiraki',1416566729,'83.81.212.175',2,''),(62,'Ukiraki',1416566737,'83.81.212.175',2,''),(63,'Mugaru',1416566791,'83.81.200.141',1,''),(64,'Mugaru',1416588558,'84.85.223.71',1,''),(65,'Mugaru',1416593065,'84.85.223.71',1,''),(66,'Mugaru',1416593070,'84.85.223.71',1,''),(67,'Mugaru',1416759798,'84.85.223.71',1,''),(68,'Mugaru',1416765799,'84.85.223.71',1,''),(69,'Mugaru',1416765832,'84.85.223.71',1,''),(70,'Mugaru',1416765836,'84.85.223.71',1,''),(71,'Mugaru',1416818677,'83.81.200.141',1,''),(72,'Mugaru',1416819277,'83.81.200.141',1,''),(73,'Mugaru',1416819295,'83.81.200.141',1,''),(74,'Mugaru',1416820588,'83.81.200.141',1,''),(75,'Mugaru',1416821749,'83.81.200.141',1,''),(76,'Mugaru',1416825001,'83.81.200.141',1,''),(77,'Mugaru',1416825280,'83.81.200.141',1,''),(78,'Mugaru',1416825285,'83.81.200.141',1,''),(79,'Mugaru',1416827388,'83.81.200.141',1,''),(80,'Mugaru',1416834314,'83.81.200.141',1,''),(81,'Mugaru',1416840930,'83.81.200.141',1,''),(82,'Mugaru',1416847475,'84.85.223.71',1,''),(83,'Mugaru',1416908167,'83.81.200.141',1,''),(84,'Mugaru',1416910872,'83.81.200.141',1,''),(85,'Mugaru',1416911236,'83.81.200.141',1,''),(86,'Mugaru',1416921834,'83.81.200.141',1,''),(87,'Mugaru',1416923716,'83.81.200.141',1,''),(88,'Mugaru',1416928402,'83.81.200.141',1,''),(89,'admin',1695440835,'127.0.0.1',3,''),(90,'admin',1695440843,'127.0.0.1',3,''),(91,'admin',1695467171,'168.121.102.166',3,''),(92,'Mugaru',1695467258,'127.0.0.1',1,''),(93,'admin',1695467439,'127.0.0.1',3,''),(94,'Bruno',1695473660,'191.245.68.246',4,''),(95,'admin',1695500198,'127.0.0.1',3,''),(96,'cypox',1776020010,'::1',7,''),(97,'cypox',1776020016,'::1',7,''),(98,'cypox',1776020026,'::1',7,''),(99,'cypox',1776020093,'::1',7,''),(100,'cypox',1776020115,'::1',7,''),(101,'cypox',1776025590,'::1',7,''),(102,'cypox',1776026511,'::1',7,''),(103,'admin',1776032137,'::1',3,'curl/8.5.0'),(104,'admin',1776032592,'::1',3,'curl/8.5.0'),(105,'cypox',1776032636,'::1',7,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(106,'cypox',1776032640,'::1',7,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(107,'testuser5',1776032668,'::1',5,'curl/8.5.0'),(108,'test',1776032735,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(109,'test',1776032743,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(110,'testuser5',1776032815,'::1',5,'curl/8.5.0'),(111,'testuser5',1776032829,'::1',5,'curl/8.5.0'),(112,'testuser5',1776032829,'::1',5,'curl/8.5.0'),(113,'test',1776032846,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(114,'testuser5',1776032856,'::1',5,'curl/8.5.0'),(115,'testuser5',1776032884,'::1',5,'curl/8.5.0'),(116,'testuser5',1776032921,'::1',5,'curl/8.5.0'),(117,'testuser5',1776032962,'::1',5,'curl/8.5.0'),(118,'test',1776032984,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(119,'testuser5',1776033004,'::1',5,'curl/8.5.0'),(120,'cypox',1776033158,'::1',7,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(121,'test',1776033190,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(122,'test',1776109089,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(123,'test',1776413848,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36'),(124,'test',1776552211,'::1',9,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36');
/*!40000 ALTER TABLE `logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `village` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int unsigned NOT NULL,
  `log` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `event_id` int unsigned NOT NULL,
  `event_type` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (5,'','b5691fb35076a588724f378b2ee51ead',1416478881,'1281198.755%3A+Angriff%3A+350%3Cbr+%2F%3E1281198.772%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1281198.782%3A+Lese+query+mov%3Cbr+%2F%3E1281199.038%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1281202.363%3A+Update+mov%3Cbr+%2F%3E1281206.742%3A+Event+updaten%3Cbr+%2F%3E1281207.327%3A+gleich+zur%C3%83%C2%BCck%3Cbr+%2F%3E1281207.343%3A+Lese+query+mov%3Cbr+%2F%3E1281208.248%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',5,''),(6,'','108908052f9d7a009893ff8c3afbec4a',1416479583,'1983887.178%3A+Angriff%3A+358%3Cbr+%2F%3E1983887.213%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1983887.238%3A+Lese+query+mov%3Cbr+%2F%3E1983887.476%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1983889.818%3A+Update+mov%3Cbr+%2F%3E1983893.156%3A+Event+updaten%3Cbr+%2F%3E1983893.751%3A+update+event+main%3Cbr+%2F%3E',6,''),(7,'','4da5e186dce877cbbc722b46fa4e5f60',1416479590,'1990887.153%3A+Angriff%3A+359%3Cbr+%2F%3E1990887.184%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1990887.2%3A+Lese+query+mov%3Cbr+%2F%3E1990895.982%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1990898.07%3A+Update+mov%3Cbr+%2F%3E1990901.136%3A+Event+updaten%3Cbr+%2F%3E1990901.726%3A+update+event+main%3Cbr+%2F%3E',7,''),(8,'','ad74094460430a3f1a9ce3fa414d8564',1416479739,'2139148.923%3A+Angriff%3A+360%3Cbr+%2F%3E2139148.957%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2139148.974%3A+Lese+query+mov%3Cbr+%2F%3E2139149.318%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E2139152.854%3A+Update+mov%3Cbr+%2F%3E2139158.242%3A+Event+updaten%3Cbr+%2F%3E2139159.041%3A+update+event+main%3Cbr+%2F%3E',8,''),(9,'','bb61eeea24830ece156b7497e604ea94',1416479922,'2322499.803%3A+Angriff%3A+358%3Cbr+%2F%3E2322499.84%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2322499.854%3A+Lese+query+mov%3Cbr+%2F%3E2322501.86%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',6,''),(10,'','0a8ccf3f3230ba13104542320879dd04',1416479929,'2329498.745%3A+Angriff%3A+359%3Cbr+%2F%3E2329498.769%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2329498.779%3A+Lese+query+mov%3Cbr+%2F%3E2329500.197%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',7,''),(11,'','edf1867f1a04cde04e52167538d448c6',1416480219,'2619022.934%3A+Angriff%3A+360%3Cbr+%2F%3E2619022.974%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2619022.999%3A+Lese+query+mov%3Cbr+%2F%3E2619024.596%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',8,''),(12,'','9f68dbd6741ead536b2011d36d3edb44',1416481367,'167403.385%3A+Angriff%3A+363%3Cbr+%2F%3E167403.424%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E167403.445%3A+Lese+query+mov%3Cbr+%2F%3E167403.797%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E167407.661%3A+Update+mov%3Cbr+%2F%3E167413.034%3A+Event+updaten%3Cbr+%2F%3E167413.995%3A+update+event+main%3Cbr+%2F%3E',9,''),(13,'','0d376226b0ac47101c66809d66af2783',1416481369,'169403.041%3A+Angriff%3A+364%3Cbr+%2F%3E169403.073%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E169403.09%3A+Lese+query+mov%3Cbr+%2F%3E169403.321%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E169406.261%3A+Update+mov%3Cbr+%2F%3E169418.336%3A+Event+updaten%3Cbr+%2F%3E169419.026%3A+update+event+main%3Cbr+%2F%3E',10,''),(14,'','3fb4e55c0b526497fd30a751ab056620',1416481370,'170403.534%3A+Angriff%3A+365%3Cbr+%2F%3E170403.566%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E170403.582%3A+Lese+query+mov%3Cbr+%2F%3E170403.893%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E170411.742%3A+Update+mov%3Cbr+%2F%3E170419.174%3A+Event+updaten%3Cbr+%2F%3E170419.987%3A+update+event+main%3Cbr+%2F%3E',11,''),(15,'','dfd2ec0fb72383290009ff825d22999f',1416481372,'172403.185%3A+Angriff%3A+366%3Cbr+%2F%3E172403.215%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E172403.228%3A+Lese+query+mov%3Cbr+%2F%3E172403.476%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E172410.449%3A+Update+mov%3Cbr+%2F%3E172414.177%3A+Event+updaten%3Cbr+%2F%3E172415.102%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',12,''),(16,'','d59c486c3e8fd5b55f11196f2499ed14',1416481927,'727097.368%3A+Angriff%3A+375%3Cbr+%2F%3E727097.399%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E727097.415%3A+Lese+query+mov%3Cbr+%2F%3E727098.388%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',13,''),(17,'','f636ddbe3e4dbfc67659c68c4c040606',1416482567,'1367686.777%3A+Angriff%3A+363%3Cbr+%2F%3E1367686.812%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1367686.827%3A+Lese+query+mov%3Cbr+%2F%3E1367688.263%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',9,''),(18,'','2c870b7c1902cc7e93afce30f3b16e0d',1416482569,'1369677.308%3A+Angriff%3A+364%3Cbr+%2F%3E1369677.342%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1369677.353%3A+Lese+query+mov%3Cbr+%2F%3E1369678.506%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',10,''),(19,'','5831ba6c09734c98360f56c38e05f29e',1416482570,'1370677.309%3A+Angriff%3A+365%3Cbr+%2F%3E1370677.332%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1370677.34%3A+Lese+query+mov%3Cbr+%2F%3E1370678.344%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',11,''),(20,'','c5b418c6677f4838f2f4bce4a172e0fe',1416484952,'152089.545%3A+Angriff%3A+414%3Cbr+%2F%3E152089.579%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E152089.592%3A+Lese+query+mov%3Cbr+%2F%3E152089.825%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E152092.677%3A+Update+mov%3Cbr+%2F%3E152098.351%3A+Event+updaten%3Cbr+%2F%3E152099.058%3A+update+event+main%3Cbr+%2F%3E',14,''),(21,'','10e27e93ac7fadaf0270be5a25575ecd',1416484955,'155085.299%3A+Angriff%3A+415%3Cbr+%2F%3E155085.332%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E155085.343%3A+Lese+query+mov%3Cbr+%2F%3E155085.627%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E155088.8%3A+Update+mov%3Cbr+%2F%3E155092.51%3A+Event+updaten%3Cbr+%2F%3E155093.119%3A+update+event+main%3Cbr+%2F%3E',15,''),(22,'','b55c975895b3402e395f4d574bf21479',1416484956,'156090.905%3A+Angriff%3A+416%3Cbr+%2F%3E156090.94%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E156090.957%3A+Lese+query+mov%3Cbr+%2F%3E156091.271%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E156095.027%3A+Update+mov%3Cbr+%2F%3E156100.429%3A+Event+updaten%3Cbr+%2F%3E156101.113%3A+update+event+main%3Cbr+%2F%3E',16,''),(23,'','275674fb9e05b1ffad932b5a49d544f3',1416484958,'158081.499%3A+Angriff%3A+417%3Cbr+%2F%3E158081.523%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E158081.533%3A+Lese+query+mov%3Cbr+%2F%3E158081.757%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E158084.24%3A+Update+mov%3Cbr+%2F%3E158095.498%3A+Event+updaten%3Cbr+%2F%3E158096.338%3A+update+event+main%3Cbr+%2F%3E',17,''),(24,'','b72baeff0625682821d72a9c5f6f8803',1416485801,'1001995.289%3A+Angriff%3A+414%3Cbr+%2F%3E1001995.312%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1001995.322%3A+Lese+query+mov%3Cbr+%2F%3E1001996.627%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',14,''),(25,'','a3a0864f499c96a4c4ab2b4b3526ab10',1416485805,'1004995.288%3A+Angriff%3A+415%3Cbr+%2F%3E1004995.319%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1004995.336%3A+Lese+query+mov%3Cbr+%2F%3E1005004.473%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',15,''),(26,'','0d4e24d167f215963173b0039ead162a',1416485805,'1005995.205%3A+Angriff%3A+416%3Cbr+%2F%3E1005995.226%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1005995.235%3A+Lese+query+mov%3Cbr+%2F%3E1005996.285%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',16,''),(27,'','83ea54c0c36a3fd97017913acbbdab77',1416485807,'1007995.263%3A+Angriff%3A+417%3Cbr+%2F%3E1007995.292%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1007995.302%3A+Lese+query+mov%3Cbr+%2F%3E1007996.426%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',17,''),(28,'','ddaee5b50bf68bdd6eb870e2ef95e849',1416486043,'1243773.509%3A+Angriff%3A+422%3Cbr+%2F%3E1243773.547%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1243773.562%3A+Lese+query+mov%3Cbr+%2F%3E1243773.831%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1243777.17%3A+Update+mov%3Cbr+%2F%3E1243782.564%3A+Event+updaten%3Cbr+%2F%3E1243783.486%3A+update+event+main%3Cbr+%2F%3E',20,''),(29,'','024675e298b9c5d5ebc61c3fc63b3ecf',1416486213,'1413225.024%3A+Angriff%3A+422%3Cbr+%2F%3E1413225.059%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1413225.074%3A+Lese+query+mov%3Cbr+%2F%3E1413226.325%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',20,''),(30,'','354fad664415f2efe53832901d85569f',1416486703,'1903423.499%3A+Angriff%3A+420%3Cbr+%2F%3E1903423.521%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1903423.532%3A+Lese+query+mov%3Cbr+%2F%3E1903428.62%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1903434.539%3A+Update+mov%3Cbr+%2F%3E1903438.073%3A+Event+updaten%3Cbr+%2F%3E1903438.821%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',18,''),(31,'','45aed7866d66cd7330e801e9f24cd073',1416486706,'1906427.553%3A+Angriff%3A+421%3Cbr+%2F%3E1906427.65%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1906427.668%3A+Lese+query+mov%3Cbr+%2F%3E1906427.893%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1906433.704%3A+Update+mov%3Cbr+%2F%3E1906438.697%3A+Event+updaten%3Cbr+%2F%3E1906439.507%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',19,''),(32,'','808f2ca4d53011a5d1b87b97ea5e2f61',1416500245,'1045174.39%3A+Angriff%3A+458%3Cbr+%2F%3E1045174.419%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1045174.436%3A+Lese+query+mov%3Cbr+%2F%3E1045174.642%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1045177.387%3A+Update+mov%3Cbr+%2F%3E1045181.82%3A+Event+updaten%3Cbr+%2F%3E1045182.448%3A+update+event+main%3Cbr+%2F%3E',22,''),(33,'','3d09115ebdf5d61a1b5fb0a308f313ef',1416500246,'1046174.604%3A+Angriff%3A+459%3Cbr+%2F%3E1046174.627%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1046174.636%3A+Lese+query+mov%3Cbr+%2F%3E1046174.896%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1046177.687%3A+Update+mov%3Cbr+%2F%3E1046181.689%3A+Event+updaten%3Cbr+%2F%3E1046182.383%3A+update+event+main%3Cbr+%2F%3E',23,''),(34,'','a0c340af2733b2a1073a3c1bdb1a86df',1416501094,'1894149.68%3A+Angriff%3A+458%3Cbr+%2F%3E1894149.735%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1894149.754%3A+Lese+query+mov%3Cbr+%2F%3E1894150.875%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',22,''),(35,'','3ead3cb77e302a4148a347bd695bfe0e',1416501095,'1895149.896%3A+Angriff%3A+459%3Cbr+%2F%3E1895149.918%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1895149.927%3A+Lese+query+mov%3Cbr+%2F%3E1895150.971%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',23,''),(36,'','7d10a315e6850a8c1239d9a24a28d93c',1416501433,'2233860.942%3A+Angriff%3A+457%3Cbr+%2F%3E2233860.964%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2233860.973%3A+Lese+query+mov%3Cbr+%2F%3E2233861.23%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E2233863.926%3A+Update+mov%3Cbr+%2F%3E2233867.654%3A+Event+updaten%3Cbr+%2F%3E2233868.354%3A+update+event+main%3Cbr+%2F%3E',21,''),(37,'','0d5cb9c7201fe525515d1897ae839768',1416501510,'2309993.659%3A+Angriff%3A+463%3Cbr+%2F%3E2309993.693%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2309993.712%3A+Lese+query+mov%3Cbr+%2F%3E2309994.02%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E2309997.88%3A+Update+mov%3Cbr+%2F%3E2310002.651%3A+Event+updaten%3Cbr+%2F%3E2310003.451%3A+update+event+main%3Cbr+%2F%3E',24,''),(38,'','3f80e4d3634812a6ac72511959f5a37f',1416503482,'682479.921%3A+Angriff%3A+457%3Cbr+%2F%3E682479.957%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E682479.971%3A+Lese+query+mov%3Cbr+%2F%3E682481.191%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',21,''),(39,'','b48ca7fe7e76a8aeff609d1a6eb16c18',1416503558,'758669.809%3A+Angriff%3A+463%3Cbr+%2F%3E758669.835%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E758669.849%3A+Lese+query+mov%3Cbr+%2F%3E758670.908%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',24,''),(40,'','a35caae4d00d2bcefd6e310cafb9ddb1',1416568544,'944795.809%3A+Angriff%3A+482%3Cbr+%2F%3E944795.835%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E944795.848%3A+Lese+query+mov%3Cbr+%2F%3E944798.353%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',25,''),(41,'','a66024cbfe292f30cd9270b6505fbcce',1416764115,'2115694.987%3A+Angriff%3A+540%3Cbr+%2F%3E2115695.031%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2115695.053%3A+Lese+query+mov%3Cbr+%2F%3E2115697.853%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',27,''),(42,'','80a8cc8ee4142ede9206b9f88719b671',1416764378,'2378237.691%3A+Angriff%3A+541%3Cbr+%2F%3E2378237.722%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2378237.737%3A+Lese+query+mov%3Cbr+%2F%3E2378238.583%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',28,''),(43,'','9d09a706ab3bc928c5fa7d46d67c00c0',1416764459,'2459383.702%3A+Angriff%3A+539%3Cbr+%2F%3E2459383.738%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2459383.762%3A+Lese+query+mov%3Cbr+%2F%3E2459384.007%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E2459387.127%3A+Update+mov%3Cbr+%2F%3E2459391.037%3A+Event+updaten%3Cbr+%2F%3E2459391.733%3A+update+event+main%3Cbr+%2F%3E',26,''),(44,'','5c264b2b2fe7a92e88c8239b680ea347',1416765179,'3179879.52%3A+Angriff%3A+539%3Cbr+%2F%3E3179879.547%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E3179879.56%3A+Lese+query+mov%3Cbr+%2F%3E3179880.62%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',26,''),(45,'','5c92a4177556896e2f31616283cc9068',1416820793,'1193113.552%3A+Angriff%3A+542%3Cbr+%2F%3E1193113.585%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1193113.597%3A+Lese+query+mov%3Cbr+%2F%3E1193113.843%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1193116.672%3A+Update+mov%3Cbr+%2F%3E1193120.482%3A+Event+updaten%3Cbr+%2F%3E1193121.151%3A+update+event+main%3Cbr+%2F%3E',29,''),(46,'','5b1d7b3d08970fcc1c9db012e0788a13',1416820963,'1363573.253%3A+Angriff%3A+542%3Cbr+%2F%3E1363573.276%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1363573.286%3A+Lese+query+mov%3Cbr+%2F%3E1363574.202%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',29,''),(47,'','8a4c425c3a466f7238dff6ff533b0936',1416821177,'1577063.781%3A+Angriff%3A+553%3Cbr+%2F%3E1577063.792%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1577063.799%3A+Lese+query+mov%3Cbr+%2F%3E1577064.025%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1577066.515%3A+Update+mov%3Cbr+%2F%3E1577069.997%3A+Event+updaten%3Cbr+%2F%3E1577070.635%3A+update+event+main%3Cbr+%2F%3E',30,''),(48,'','ee957929f51e53d185a317e799031b01',1416821347,'1747467.116%3A+Angriff%3A+553%3Cbr+%2F%3E1747467.134%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1747467.146%3A+Lese+query+mov%3Cbr+%2F%3E1747469.115%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',30,''),(49,'','aa843cd655d57a8e5b221d6f2d23926e',1416821595,'1995113.958%3A+Angriff%3A+554%3Cbr+%2F%3E1995113.986%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1995114.002%3A+Lese+query+mov%3Cbr+%2F%3E1995114.242%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1995118.779%3A+Update+mov%3Cbr+%2F%3E1995122.477%3A+Event+updaten%3Cbr+%2F%3E1995123.189%3A+update+event+main%3Cbr+%2F%3E',31,''),(50,'','e805eb87b300d8068bbb6c9e2ba4e816',1416822161,'2561402.703%3A+Angriff%3A+554%3Cbr+%2F%3E2561402.725%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2561402.736%3A+Lese+query+mov%3Cbr+%2F%3E2561404.392%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',31,''),(51,'','fe007906fccb0cf08a579939c25c5302',1416828619,'1819918.573%3A+Angriff%3A+558%3Cbr+%2F%3E1819918.594%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1819918.608%3A+Lese+query+mov%3Cbr+%2F%3E1819918.83%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1819921.486%3A+Update+mov%3Cbr+%2F%3E1819924.966%3A+Event+updaten%3Cbr+%2F%3E1819925.63%3A+update+event+main%3Cbr+%2F%3E',32,''),(52,'','056cf1cab1887b7fdf00cffea7596fa0',1416828621,'1821918.89%3A+Angriff%3A+559%3Cbr+%2F%3E1821918.901%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1821918.91%3A+Lese+query+mov%3Cbr+%2F%3E1821919.105%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1821921.545%3A+Update+mov%3Cbr+%2F%3E1821925.688%3A+Event+updaten%3Cbr+%2F%3E1821926.383%3A+update+event+main%3Cbr+%2F%3E',33,''),(53,'','5ccc7fd065b592be8171f0f337677d3f',1416828622,'1822919.163%3A+Angriff%3A+560%3Cbr+%2F%3E1822919.195%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1822919.211%3A+Lese+query+mov%3Cbr+%2F%3E1822919.53%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1822922.757%3A+Update+mov%3Cbr+%2F%3E1822927.705%3A+Event+updaten%3Cbr+%2F%3E1822928.748%3A+update+event+main%3Cbr+%2F%3E',34,''),(54,'','bde77744dd5a3c60c2f59f34e62ffa59',1416828624,'1824918.527%3A+Angriff%3A+561%3Cbr+%2F%3E1824918.537%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1824918.544%3A+Lese+query+mov%3Cbr+%2F%3E1824918.756%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1824921.506%3A+Update+mov%3Cbr+%2F%3E1824925.788%3A+Event+updaten%3Cbr+%2F%3E1824926.515%3A+update+event+main%3Cbr+%2F%3E',35,''),(55,'','8de8b50195ca1003b3c3bd4529859c23',1416829468,'2668967.111%3A+Angriff%3A+558%3Cbr+%2F%3E2668967.122%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2668967.13%3A+Lese+query+mov%3Cbr+%2F%3E2668968.208%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',32,''),(56,'','27b82d3129374b61a05127d96af62501',1416829470,'2670967.361%3A+Angriff%3A+559%3Cbr+%2F%3E2670967.372%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2670967.38%3A+Lese+query+mov%3Cbr+%2F%3E2670968.365%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',33,''),(57,'','79418aaed12bfa866edc85ad38d92c14',1416829471,'2671970.959%3A+Angriff%3A+560%3Cbr+%2F%3E2671970.991%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2671971.004%3A+Lese+query+mov%3Cbr+%2F%3E2671972.337%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',34,''),(58,'','effc67bfeca4c05e3ab35f2cf2164fda',1416829473,'2673965.888%3A+Angriff%3A+561%3Cbr+%2F%3E2673965.909%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2673965.918%3A+Lese+query+mov%3Cbr+%2F%3E2673967.069%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',35,''),(59,'','351be1b49aae4194926df06ed2fa822c',1416833054,'2654187.003%3A+Angriff%3A+563%3Cbr+%2F%3E2654187.034%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2654187.048%3A+Lese+query+mov%3Cbr+%2F%3E2654187.303%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E2654197.571%3A+Update+mov%3Cbr+%2F%3E2654203.602%3A+Event+updaten%3Cbr+%2F%3E2654204.799%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',36,''),(60,'','891f111531e57daf355ad24abe29344d',1416833072,'2672190.847%3A+Angriff%3A+564%3Cbr+%2F%3E2672190.866%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2672190.884%3A+Lese+query+mov%3Cbr+%2F%3E2672191.189%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E2672194.802%3A+Update+mov%3Cbr+%2F%3E2672203.123%3A+Event+updaten%3Cbr+%2F%3E2672204.181%3A+update+event+main%3Cbr+%2F%3E',37,''),(61,'','17e24f5ab6546ff56048c285717a00e6',1416833921,'3521258.457%3A+Angriff%3A+564%3Cbr+%2F%3E3521258.483%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E3521258.496%3A+Lese+query+mov%3Cbr+%2F%3E3521259.648%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',37,''),(62,'','c544c310147dc55ad9ae44a07d0148a2',1416842897,'1697965.964%3A+Angriff%3A+591%3Cbr+%2F%3E1697965.99%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1697966.001%3A+Lese+query+mov%3Cbr+%2F%3E1697966.937%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',41,''),(63,'','bfc3b912b3119b1b709356518cf140b6',1416846108,'1308734.923%3A+Angriff%3A+588%3Cbr+%2F%3E1308734.949%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1308734.962%3A+Lese+query+mov%3Cbr+%2F%3E1308735.278%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1308738.217%3A+Update+mov%3Cbr+%2F%3E1308741.868%3A+Event+updaten%3Cbr+%2F%3E1308742.446%3A+update+event+main%3Cbr+%2F%3E',38,''),(64,'','78f9f86e24e0b5a4180f20194ff4180d',1416846109,'1309734.883%3A+Angriff%3A+589%3Cbr+%2F%3E1309734.91%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1309734.925%3A+Lese+query+mov%3Cbr+%2F%3E1309735.175%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1309738.023%3A+Update+mov%3Cbr+%2F%3E1309741.624%3A+Event+updaten%3Cbr+%2F%3E1309742.206%3A+update+event+main%3Cbr+%2F%3E',39,''),(65,'','841866c5956f6f495dc9157e5add62d9',1416846111,'1311734.9%3A+Angriff%3A+590%3Cbr+%2F%3E1311734.922%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1311734.931%3A+Lese+query+mov%3Cbr+%2F%3E1311735.167%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1311738.011%3A+Update+mov%3Cbr+%2F%3E1311741.401%3A+Event+updaten%3Cbr+%2F%3E1311742.13%3A+update+event+main%3Cbr+%2F%3E',40,''),(66,'','dafaf28a210b14c86b5d0b4c36cc76a1',1416846178,'1378857.421%3A+Angriff%3A+592%3Cbr+%2F%3E1378857.452%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E1378857.465%3A+Lese+query+mov%3Cbr+%2F%3E1378857.753%3A+Gehe+in+do_mov_attack%3Cbr+%2F%3E1378865.849%3A+Update+mov%3Cbr+%2F%3E1378870.182%3A+Event+updaten%3Cbr+%2F%3E1378871.039%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',42,''),(67,'','c06b77e99c85b1f3e5ae5774cbb4f9fb',1416850908,'2508978.939%3A+Angriff%3A+588%3Cbr+%2F%3E2508978.979%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2508979.001%3A+Lese+query+mov%3Cbr+%2F%3E2508980.588%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',38,''),(68,'','0180eeb7265654d6dc3025a093a4ad09',1416850909,'2509978.671%3A+Angriff%3A+589%3Cbr+%2F%3E2509978.693%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2509978.725%3A+Lese+query+mov%3Cbr+%2F%3E2509979.771%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',39,''),(69,'','0e53a3b0af91d3dd138c472c5500950d',1416850911,'2511978.671%3A+Angriff%3A+590%3Cbr+%2F%3E2511978.694%3A+Gehe+in+do_mov%28%29.%3Cbr+%2F%3E2511978.738%3A+Lese+query+mov%3Cbr+%2F%3E2511979.84%3A+L%C3%AF%C2%BF%C2%BDsche+event+main%3Cbr+%2F%3E',40,'');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_archiv`
--

DROP TABLE IF EXISTS `mail_archiv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_archiv` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int NOT NULL DEFAULT '0',
  `from_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `to_id` int unsigned NOT NULL DEFAULT '0',
  `to_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `subject` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int unsigned NOT NULL DEFAULT '0',
  `owner` int unsigned NOT NULL,
  `type` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `to_id` (`to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_archiv`
--

LOCK TABLES `mail_archiv` WRITE;
/*!40000 ALTER TABLE `mail_archiv` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_archiv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_block`
--

DROP TABLE IF EXISTS `mail_block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_block` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `userid` int unsigned NOT NULL,
  `blocked_id` int unsigned NOT NULL,
  `blocked_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blocked_id` (`blocked_id`),
  KEY `blocked_name` (`blocked_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_block`
--

LOCK TABLES `mail_block` WRITE;
/*!40000 ALTER TABLE `mail_block` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_block` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_in`
--

DROP TABLE IF EXISTS `mail_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_in` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int NOT NULL DEFAULT '0',
  `from_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `to_id` int unsigned NOT NULL DEFAULT '0',
  `to_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `subject` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_read` int unsigned NOT NULL DEFAULT '0',
  `is_answered` int unsigned NOT NULL DEFAULT '0',
  `output_id` int NOT NULL DEFAULT '0',
  `time` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `to_id` (`to_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_in`
--

LOCK TABLES `mail_in` WRITE;
/*!40000 ALTER TABLE `mail_in` DISABLE KEYS */;
INSERT INTO `mail_in` VALUES (4,-1,'Equipe Imperalis',1,'Mugaru','Bem-vindo+ao+Imperalis%21','Bem-vindo+ao+Wereld+1+%5Bplayer%5DMugaru%5B%2Fplayer%5D%21%0A%0A++++Esperamos+que+se+divirta+entrando+nessa+nova+jornada%21%0A%09%0A%09Se+tiver+perguntas+ou+algum+problema+no+jogo+poder%C3%A1+nos+contactar+pelo+%5Burl%3Dhttp%3A%2F%2Fsupport.zapping.tk%5Dsuporte%5B%2Furl%5D.%0A%09%0A%09Entre+em+nosso+%5Burl%3Dhttp%3A%2F%2Fforum.zapping.tk%5Df%C3%B3rum%5B%2Furl%5D+e+fique+atualizado+sobre+tudo%21%0A%0A%09Atenciosamente%2C%0A%09Equipe+%5Burl%3Dhttp%3A%2F%2Fzapping.tk%5DImperalis%5B%2Furl%5D',1,0,0,1416476927),(6,-1,'Equipe Imperalis',2,'Ukiraki','Bem-vindo+ao+Imperalis%21','Bem-vindo+ao+Wereld+1+%5Bplayer%5DUkiraki%5B%2Fplayer%5D%21%0A%0A++++Esperamos+que+se+divirta+entrando+nessa+nova+jornada%21%0A%09%0A%09Se+tiver+perguntas+ou+algum+problema+no+jogo+poder%C3%A1+nos+contactar+pelo+%5Burl%3Dhttp%3A%2F%2Fsupport.zapping.tk%5Dsuporte%5B%2Furl%5D.%0A%09%0A%09Entre+em+nosso+%5Burl%3Dhttp%3A%2F%2Fforum.zapping.tk%5Df%C3%B3rum%5B%2Furl%5D+e+fique+atualizado+sobre+tudo%21%0A%0A%09Atenciosamente%2C%0A%09Equipe+%5Burl%3Dhttp%3A%2F%2Fzapping.tk%5DImperalis%5B%2Furl%5D',0,0,0,1416566789),(7,-1,'Equipe Tribalwars',3,'admin','Welkom+bij+Tribalwars%21','Welkom+bij+World2+%5Bplayer%5Dadmin%5B%2Fplayer%5D%21%0D%0A%0D%0A++++We+hopen+dat+je+veel+plezier+hebt+tijdens+dit+nieuwe+avontuur%21%0D%0A%09%0D%0A%09Als+je+vragen+of+problemen+hebt+met+spel%2C+neem+dan+contact+op+met+de+support%0D%0A%09%0D%0A%09Meld+je+aan+op+het+forum%2C+en+blijf+op+de+hoogte+van+het+laatste+nieuws+%3A%29%21%0D%0A%0D%0A%09Gegroet%2C+%0D%0A%09Het+team',1,0,0,1695440846),(8,-1,'Equipe Tribalwars',7,'cypox','Welkom+bij+Tribalwars%21','Welkom+bij+World1+%5Bplayer%5Dcypox%5B%2Fplayer%5D%21%0D%0A%0D%0A++++We+hopen+dat+je+veel+plezier+hebt+tijdens+dit+nieuwe+avontuur%21%0D%0A%09%0D%0A%09Als+je+vragen+of+problemen+hebt+met+spel%2C+neem+dan+contact+op+met+de+support%0D%0A%09%0D%0A%09Meld+je+aan+op+het+forum%2C+en+blijf+op+de+hoogte+van+het+laatste+nieuws+%3A%29%21%0D%0A%0D%0A%09Gegroet%2C+%0D%0A%09Het+team',0,0,0,1776026075),(9,-1,'Equipe Tribalwars',5,'testuser5','Welkom+bij+Tribalwars%21','Welkom+bij+World1+%5Bplayer%5Dtestuser5%5B%2Fplayer%5D%21%0D%0A%0D%0A++++We+hopen+dat+je+veel+plezier+hebt+tijdens+dit+nieuwe+avontuur%21%0D%0A%09%0D%0A%09Als+je+vragen+of+problemen+hebt+met+spel%2C+neem+dan+contact+op+met+de+support%0D%0A%09%0D%0A%09Meld+je+aan+op+het+forum%2C+en+blijf+op+de+hoogte+van+het+laatste+nieuws+%3A%29%21%0D%0A%0D%0A%09Gegroet%2C+%0D%0A%09Het+team',0,0,0,1776033004),(10,-1,'Equipe Tribalwars',9,'test','Welkom+bij+Tribalwars%21','Welkom+bij+World1+%5Bplayer%5Dtest%5B%2Fplayer%5D%21%0D%0A%0D%0A++++We+hopen+dat+je+veel+plezier+hebt+tijdens+dit+nieuwe+avontuur%21%0D%0A%09%0D%0A%09Als+je+vragen+of+problemen+hebt+met+spel%2C+neem+dan+contact+op+met+de+support%0D%0A%09%0D%0A%09Meld+je+aan+op+het+forum%2C+en+blijf+op+de+hoogte+van+het+laatste+nieuws+%3A%29%21%0D%0A%0D%0A%09Gegroet%2C+%0D%0A%09Het+team',1,0,0,1776033082);
/*!40000 ALTER TABLE `mail_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_in_post`
--

DROP TABLE IF EXISTS `mail_in_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_in_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `text` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `time` int NOT NULL,
  `msg_id` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_in_post`
--

LOCK TABLES `mail_in_post` WRITE;
/*!40000 ALTER TABLE `mail_in_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_in_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_mass`
--

DROP TABLE IF EXISTS `mail_mass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_mass` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `text` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `array_subjects_id` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `from_id` int NOT NULL,
  `from_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `belongs_to` int NOT NULL DEFAULT '0',
  `delete` enum('y','n') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'n',
  `id_display` int NOT NULL DEFAULT '-1',
  `username_display` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_id` (`from_id`),
  KEY `belongs_to` (`belongs_to`),
  KEY `delete` (`delete`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_mass`
--

LOCK TABLES `mail_mass` WRITE;
/*!40000 ALTER TABLE `mail_mass` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_mass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_out`
--

DROP TABLE IF EXISTS `mail_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_out` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_id` int unsigned NOT NULL DEFAULT '0',
  `from_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `to_id` int unsigned NOT NULL DEFAULT '0',
  `to_username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `subject` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_read` int unsigned NOT NULL DEFAULT '0',
  `time` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from_id` (`from_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_out`
--

LOCK TABLES `mail_out` WRITE;
/*!40000 ALTER TABLE `mail_out` DISABLE KEYS */;
INSERT INTO `mail_out` VALUES (1,1,'Mugaru',1,'Mugaru','123','123',1,1416480302);
/*!40000 ALTER TABLE `mail_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_post`
--

DROP TABLE IF EXISTS `mail_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_post` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `text` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int NOT NULL,
  `from_id` int NOT NULL,
  `from_username` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to_id` int NOT NULL,
  `to_username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16392 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_post`
--

LOCK TABLES `mail_post` WRITE;
/*!40000 ALTER TABLE `mail_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `mail_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_subject`
--

DROP TABLE IF EXISTS `mail_subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mail_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_post` int NOT NULL,
  `from_id` int NOT NULL DEFAULT '-1',
  `to_id` int NOT NULL DEFAULT '-1',
  `from_username` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to_username` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `post_num` int NOT NULL,
  `status_from` enum('read','new','answered') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status_to` enum('read','new','answered') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `delete_from` enum('y','n') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'n',
  `delete_to` enum('y','n') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'n',
  `read_unique` enum('y','n') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'n',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `delete_from` (`delete_from`),
  KEY `delete_to` (`delete_to`),
  KEY `from_id` (`from_id`),
  KEY `to_id` (`to_id`),
  KEY `subject` (`subject`)
) ENGINE=MyISAM AUTO_INCREMENT=16142 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_subject`
--

LOCK TABLES `mail_subject` WRITE;
/*!40000 ALTER TABLE `mail_subject` DISABLE KEYS */;
INSERT INTO `mail_subject` VALUES (16136,'Bem-vindo+ao+Imperalis%21',1416476927,-1,1,'Equipe Imperalis','Mugaru',1,'answered','new','n','n','n','2014-11-20 06:48:47'),(16137,'Bem-vindo+ao+Imperalis%21',1416566789,-1,2,'Equipe Imperalis','Ukiraki',1,'answered','new','n','n','n','2014-11-21 07:46:29'),(16138,'Welkom+bij+Tribalwars%21',1695440846,-1,3,'Equipe Tribalwars','admin',1,'answered','new','n','n','n','2023-09-22 22:47:26'),(16139,'Welkom+bij+Tribalwars%21',1776026075,-1,7,'Equipe Tribalwars','cypox',1,'answered','new','n','n','n','2026-04-12 20:34:35'),(16140,'Welkom+bij+Tribalwars%21',1776033004,-1,5,'Equipe Tribalwars','testuser5',1,'answered','new','n','n','n','2026-04-12 22:30:04'),(16141,'Welkom+bij+Tribalwars%21',1776033082,-1,9,'Equipe Tribalwars','test',1,'answered','new','n','n','n','2026-04-12 22:31:22');
/*!40000 ALTER TABLE `mail_subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `map` (
  `id` int NOT NULL AUTO_INCREMENT,
  `x` smallint NOT NULL,
  `y` smallint NOT NULL,
  `type` enum('grass','berg','see','forest','other') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'other',
  `image` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `x` (`x`),
  KEY `y` (`y`)
) ENGINE=MyISAM AUTO_INCREMENT=354256 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
/*!40000 ALTER TABLE `map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_info`
--

DROP TABLE IF EXISTS `map_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `map_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `resources` int NOT NULL,
  `farm` int NOT NULL,
  `dealers` int NOT NULL,
  `troops` int NOT NULL,
  `attktime` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_info`
--

LOCK TABLES `map_info` WRITE;
/*!40000 ALTER TABLE `map_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `map_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_styling`
--

DROP TABLE IF EXISTS `map_styling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `map_styling` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `x` int unsigned NOT NULL,
  `y` int unsigned NOT NULL,
  `type` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_styling`
--

LOCK TABLES `map_styling` WRITE;
/*!40000 ALTER TABLE `map_styling` DISABLE KEYS */;
/*!40000 ALTER TABLE `map_styling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marked`
--

DROP TABLE IF EXISTS `marked`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marked` (
  `marker_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `marked_id` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `color` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marked`
--

LOCK TABLES `marked` WRITE;
/*!40000 ALTER TABLE `marked` DISABLE KEYS */;
/*!40000 ALTER TABLE `marked` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medal`
--

DROP TABLE IF EXISTS `medal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `medal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `points` int NOT NULL DEFAULT '0',
  `points_stage` int NOT NULL DEFAULT '0',
  `lad` int NOT NULL DEFAULT '0',
  `lad_stage` int NOT NULL DEFAULT '0',
  `saque` int NOT NULL DEFAULT '0',
  `saque_stage` int NOT NULL DEFAULT '0',
  `conquer` int NOT NULL DEFAULT '0',
  `conquer_stage` int NOT NULL DEFAULT '0',
  `lider` int NOT NULL DEFAULT '0',
  `lider_stage` int NOT NULL DEFAULT '0',
  `hero` int NOT NULL DEFAULT '0',
  `hero_stage` int NOT NULL DEFAULT '0',
  `rank` int NOT NULL DEFAULT '0',
  `rank_stage` int NOT NULL DEFAULT '0',
  `reserved` int NOT NULL DEFAULT '0',
  `reserved_stage` int NOT NULL DEFAULT '0',
  `merkat` int NOT NULL DEFAULT '0',
  `merkat_stage` int NOT NULL DEFAULT '0',
  `friends` int NOT NULL DEFAULT '0',
  `friends_stage` int NOT NULL DEFAULT '0',
  `wars` int NOT NULL DEFAULT '0',
  `wars_stage` int NOT NULL DEFAULT '0',
  `demolisher` int NOT NULL DEFAULT '0',
  `demolisher_stage` int NOT NULL DEFAULT '0',
  `tribo` int NOT NULL DEFAULT '0',
  `tribo_stage` int NOT NULL DEFAULT '0',
  `nobles_faith` int NOT NULL DEFAULT '0',
  `nobles_faith_stage` int NOT NULL DEFAULT '0',
  `master_camp` int NOT NULL DEFAULT '0',
  `master_camp_stage` int NOT NULL DEFAULT '0',
  `scout` int NOT NULL DEFAULT '0',
  `scout_stage` int NOT NULL DEFAULT '0',
  `gluck` int NOT NULL DEFAULT '0',
  `gluck_stage` int NOT NULL DEFAULT '0',
  `bluck` int NOT NULL DEFAULT '0',
  `bluck_stage` int NOT NULL DEFAULT '0',
  `vit` int NOT NULL DEFAULT '0',
  `vit_stage` int NOT NULL DEFAULT '0',
  `aconquer` int NOT NULL DEFAULT '0',
  `aconquer_stage` int NOT NULL DEFAULT '0',
  `aatack` int NOT NULL DEFAULT '0',
  `aatack_stage` int NOT NULL DEFAULT '0',
  `refors` int NOT NULL DEFAULT '0',
  `refors_stage` int NOT NULL DEFAULT '0',
  `resurrection` int NOT NULL DEFAULT '0',
  `resurrection_stage` int NOT NULL DEFAULT '0',
  `gold` int NOT NULL DEFAULT '0',
  `gold_stage` int NOT NULL DEFAULT '0',
  `wallbreaker` int NOT NULL DEFAULT '0',
  `wallbreaker_stage` int NOT NULL DEFAULT '0',
  `rank_view` int NOT NULL DEFAULT '0',
  `points_view` int NOT NULL DEFAULT '0',
  `lad_view` int NOT NULL DEFAULT '0',
  `saque_view` int NOT NULL DEFAULT '0',
  `conquer_view` int NOT NULL DEFAULT '0',
  `lider_view` int NOT NULL DEFAULT '0',
  `hero_view` int NOT NULL DEFAULT '0',
  `reserved_view` int NOT NULL DEFAULT '0',
  `merkat_view` int NOT NULL DEFAULT '0',
  `friends_view` int NOT NULL DEFAULT '0',
  `wars_view` int NOT NULL DEFAULT '0',
  `demolisher_view` int NOT NULL DEFAULT '0',
  `tribo_view` int NOT NULL DEFAULT '0',
  `nobles_faith_view` int NOT NULL DEFAULT '0',
  `master_camp_view` int NOT NULL DEFAULT '0',
  `scout_view` int NOT NULL DEFAULT '0',
  `aatack_view` int NOT NULL DEFAULT '0',
  `gluck_view` int NOT NULL DEFAULT '0',
  `bluck_view` int NOT NULL DEFAULT '0',
  `aconquer_view` int NOT NULL DEFAULT '0',
  `refors_view` int NOT NULL DEFAULT '0',
  `resurrection_view` int NOT NULL DEFAULT '0',
  `gold_view` int NOT NULL DEFAULT '0',
  `wallbreaker_view` int NOT NULL DEFAULT '0',
  `total_stage` int NOT NULL DEFAULT '0',
  `rang` int NOT NULL DEFAULT '0',
  `userid` int NOT NULL DEFAULT '0',
  `username` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1475 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci AVG_ROW_LENGTH=289;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medal`
--

LOCK TABLES `medal` WRITE;
/*!40000 ALTER TABLE `medal` DISABLE KEYS */;
INSERT INTO `medal` VALUES (1465,43092,2,527219,3,33,1,5,1,0,0,2200,2,1,4,0,0,0,0,0,0,33,2,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,0,0,0,2640,3,2,0,0,0,66,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,20,0,1,'Mugaru'),(1466,100,1,0,0,0,0,0,0,0,0,0,0,4,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4,0,2,'Ukiraki'),(1467,515,1,0,0,0,0,0,0,0,0,0,0,3,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4,0,3,'admin'),(1468,26,0,0,0,0,0,0,0,0,0,0,0,5,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,7,'cypox'),(1469,12379,2,0,0,0,0,0,0,0,0,0,0,2,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,5,0,9,'test'),(1474,26,0,0,0,0,0,0,0,0,0,0,0,6,3,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,0,5,'testuser5');
/*!40000 ALTER TABLE `medal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movements`
--

DROP TABLE IF EXISTS `movements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movements` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `from_village` int unsigned DEFAULT NULL,
  `to_village` int unsigned DEFAULT NULL,
  `units` varchar(350) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start_time` int unsigned NOT NULL,
  `end_time` int unsigned NOT NULL,
  `building` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `from_userid` int unsigned NOT NULL,
  `to_userid` int unsigned NOT NULL,
  `to_hidden` int unsigned DEFAULT '0',
  `wood` int unsigned NOT NULL DEFAULT '0',
  `stone` int unsigned NOT NULL DEFAULT '0',
  `iron` int unsigned NOT NULL DEFAULT '0',
  `send_from_village` int unsigned NOT NULL,
  `send_from_user` int unsigned NOT NULL,
  `send_to_user` int unsigned NOT NULL,
  `send_to_village` int unsigned NOT NULL,
  `die` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `end_time` (`end_time`),
  KEY `send_from_village` (`send_from_village`),
  KEY `send_from_user` (`send_from_user`),
  KEY `send_to_user` (`send_to_user`),
  KEY `send_to_village` (`send_to_village`),
  KEY `from_hidden` (`to_hidden`),
  KEY `type` (`type`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movements`
--

LOCK TABLES `movements` WRITE;
/*!40000 ALTER TABLE `movements` DISABLE KEYS */;
INSERT INTO `movements` VALUES (43,514,494,'20;120;110;50;100;150;20;20;1;0','attack',1776477102,1776478460,'wall',9,3,0,0,0,0,514,9,3,494,0);
/*!40000 ALTER TABLE `movements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sell` int unsigned NOT NULL,
  `buy` int unsigned NOT NULL,
  `sell_ress` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `buy_ress` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `multi` int NOT NULL,
  `from_village` int unsigned NOT NULL,
  `time` int unsigned NOT NULL,
  `do_action` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ratio_max` double unsigned NOT NULL,
  `userid` int unsigned NOT NULL,
  `x` int unsigned NOT NULL,
  `y` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers`
--

LOCK TABLES `offers` WRITE;
/*!40000 ALTER TABLE `offers` DISABLE KEYS */;
/*!40000 ALTER TABLE `offers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `offers_multi`
--

DROP TABLE IF EXISTS `offers_multi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `offers_multi` (
  `id` int unsigned NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offers_multi`
--

LOCK TABLES `offers_multi` WRITE;
/*!40000 ALTER TABLE `offers_multi` DISABLE KEYS */;
/*!40000 ALTER TABLE `offers_multi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quests`
--

DROP TABLE IF EXISTS `quests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quests` (
  `userid` int NOT NULL,
  `leem30` int NOT NULL,
  `hout30` int NOT NULL,
  `ijzer30` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quests`
--

LOCK TABLES `quests` WRITE;
/*!40000 ALTER TABLE `quests` DISABLE KEYS */;
INSERT INTO `quests` VALUES (1,1,1,1),(3,0,0,0),(5,0,0,0),(9,1,1,1);
/*!40000 ALTER TABLE `quests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quickbar`
--

DROP TABLE IF EXISTS `quickbar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quickbar` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `img` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `href` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `target` int unsigned NOT NULL,
  `uid` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quickbar`
--

LOCK TABLES `quickbar` WRITE;
/*!40000 ALTER TABLE `quickbar` DISABLE KEYS */;
/*!40000 ALTER TABLE `quickbar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranking_ally_k`
--

DROP TABLE IF EXISTS `ranking_ally_k`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ranking_ally_k` (
  `id` int NOT NULL AUTO_INCREMENT,
  `allyid` int NOT NULL,
  `ally` varchar(255) NOT NULL,
  `members` int NOT NULL,
  `rank` int NOT NULL,
  `points` int NOT NULL,
  `villages` int NOT NULL,
  `continent` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranking_ally_k`
--

LOCK TABLES `ranking_ally_k` WRITE;
/*!40000 ALTER TABLE `ranking_ally_k` DISABLE KEYS */;
/*!40000 ALTER TABLE `ranking_ally_k` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ranking_user_k`
--

DROP TABLE IF EXISTS `ranking_user_k`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ranking_user_k` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `rank` int NOT NULL,
  `points` int NOT NULL,
  `villages` int NOT NULL,
  `continent` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1574 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ranking_user_k`
--

LOCK TABLES `ranking_user_k` WRITE;
/*!40000 ALTER TABLE `ranking_user_k` DISABLE KEYS */;
/*!40000 ALTER TABLE `ranking_user_k` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recruit`
--

DROP TABLE IF EXISTS `recruit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recruit` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `unit` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `num_unit` int unsigned DEFAULT '0',
  `num_finished` int unsigned DEFAULT '0',
  `last_reload` int DEFAULT '-1',
  `time_finished` int unsigned NOT NULL,
  `time_start` int unsigned NOT NULL,
  `time_per_unit` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `building` varchar(35) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `villageid` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `building` (`building`),
  KEY `villageid` (`villageid`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recruit`
--

LOCK TABLES `recruit` WRITE;
/*!40000 ALTER TABLE `recruit` DISABLE KEYS */;
/*!40000 ALTER TABLE `recruit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(230) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_image` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `time` int unsigned NOT NULL,
  `type` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `a_units` varchar(350) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `b_units` varchar(350) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `c_units` varchar(350) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `d_units` varchar(350) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `e_units` varchar(350) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `agreement` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ram` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `catapult` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to_user` int unsigned NOT NULL,
  `from_user` int NOT NULL,
  `to_village` int unsigned NOT NULL,
  `from_village` int unsigned NOT NULL,
  `receiver_userid` int unsigned NOT NULL,
  `is_new` int unsigned NOT NULL DEFAULT '1',
  `in_group` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `luck` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `moral` int DEFAULT NULL,
  `wins` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hives` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `see_def_units` int unsigned NOT NULL DEFAULT '1',
  `ally` int unsigned NOT NULL,
  `allyname` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `from_username` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `to_username` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `receiver_userid` (`receiver_userid`),
  KEY `group` (`in_group`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (22,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28Aldeia+de+Mugaru%29','../global_cdn/graphic/dots/blue.png',1416478880,'attack','0;0;0;0;118;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,24,22,0,1,'defense','17',100,'att','0;0;0;0;0',1,0,'','',''),(25,'Barbarendorp+%28499%7C502%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416479582,'attack','0;0;1000;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,25,22,0,1,'defense','-4',100,'att','3840;5205;955;10000;10000',1,0,'','',''),(28,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416479589,'attack','0;0;1000;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,24,22,0,1,'defense','0',100,'att','3334;3333;3333;10000;10000',1,0,'','',''),(30,'Barbarendorp+%28500%7C499%29+K45+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416479738,'attack','0;0;1000;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,23,22,0,1,'defense','16',100,'att','4164;3575;2261;10000;10000',1,0,'','',''),(32,'Barbarendorp+%28500%7C499%29+K45+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416481366,'attack','0;0;500;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;69','20;20','0;0;','',0,1,23,22,0,1,'defense','-21',100,'att','3544;3340;2116;9000;9000',1,0,'','',''),(34,'Barbarendorp+%28500%7C499%29+K45+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416481368,'attack','0;0;500;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','69;46','20;20','0;0;','',0,1,23,22,0,1,'defense','10',100,'att','3418;3417;2165;9000;9000',1,0,'','',''),(36,'Barbarendorp+%28500%7C499%29+K45+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416481369,'attack','0;0;500;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','46;11','20;20','0;0;','',0,1,23,22,0,1,'defense','-17',100,'att','3418;3417;2165;9000;9000',1,0,'','',''),(38,'Barbarendorp+%28500%7C499%29+K45+foi+conquistada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416481371,'attack','0;0;500;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','11;-14','20;20','0;0;','',0,1,23,22,0,1,'defense','-3',100,'att','3418;3417;2165;9000;9000',1,0,'','',''),(41,'Barbarendorp+%28499%7C502%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416484951,'attack','0;0;1000;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;74','20;20','0;0;','',0,1,25,22,0,1,'defense','-23',100,'att','5838;5838;2324;14000;14000',1,0,'','',''),(43,'Barbarendorp+%28499%7C502%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416484954,'attack','0;0;1000;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','74;46','20;20','0;0;','',0,1,25,22,0,1,'defense','-24',100,'att','5838;5838;2324;14000;14000',1,0,'','',''),(45,'Barbarendorp+%28499%7C502%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416484955,'attack','0;0;1000;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','46;26','20;20','0;0;','',0,1,25,22,0,1,'defense','-16',100,'att','5838;5839;2323;14000;14000',1,0,'','',''),(47,'Barbarendorp+%28499%7C502%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416484957,'attack','0;0;1000;0;50;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','26;6','20;20','0;0;','',0,1,25,22,0,1,'defense','-21',100,'att','5839;5838;2323;14000;14000',1,0,'','',''),(51,'Barbarendorp+%28499%7C502%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/blue.png',1416486042,'attack','0;0;0;118;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,25,22,0,1,'defense','6',100,'att','0;0;0;0;0',1,0,'','',''),(53,'Barbarendorp+%28499%7C502%29+K54+foi+conquistada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416486702,'attack','0;0;1000;0;0;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','10;-21','20;20','0;0;','',0,1,25,22,0,1,'defense','3',100,'att','4093;4092;1815;10000;10000',1,0,'','',''),(60,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416500244,'attack','0;0;1000;0;0;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;80','20;20','0;0;','',0,1,24,22,0,1,'defense','-2',100,'att','3334;3333;3333;10000;10000',1,0,'','',''),(62,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416500245,'attack','0;0;1000;0;0;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','80;59','20;20','0;0;','',0,1,24,22,0,1,'defense','8',100,'att','3334;3333;3333;10000;10000',1,0,'','',''),(65,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28002+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416501432,'attack','0;1000;0;0;0;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','62;39','20;20','0;0;','',0,1,24,23,0,1,'defense','10',100,'att','5000;5000;5000;15000;15000',1,0,'','',''),(67,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28002+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416501508,'attack','0;1000;0;0;0;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','39;10','20;20','0;0;','',0,1,24,23,0,1,'defense','22',100,'att','4985;5028;4987;15000;15000',1,0,'','',''),(70,'Medalha+L%C3%ADder+em+pontos+Prata+-+N%C3%ADvel+3','',1416566789,'medal','','','','',NULL,'','','','rank;3',0,0,0,0,2,1,'other',NULL,NULL,'','',1,0,'','',''),(72,'001+%7C+TT+forneceu+Ukiraki.','',1416567223,'sendRess','','','','',NULL,'','','','',2,1,226,22,2,1,'trade',NULL,NULL,'','5000;5000;5000',1,0,'','',''),(74,'001+%7C+TT+forneceu+Ukiraki.','',1416567234,'sendRess','','','','',NULL,'','','','',2,1,226,22,2,0,'trade',NULL,NULL,'','5000;5000;5000',1,0,'','',''),(75,'Mugaru+lhe+convidou+para+%C3%A0+tribo+%27Test%27.','',1416567371,'ally_invite','','','','',NULL,'','','','',2,1,0,0,2,0,'other',NULL,NULL,'','',1,1,'Test','',''),(78,'Medalha+Campe%C3%A3o+de+Pontua%C3%A7%C3%A3o+Hout+-+Level+1','',1416569849,'medal','','','','',NULL,'','','','points;1',0,0,0,0,2,0,'other',NULL,NULL,'','',1,0,'','',''),(83,'001+%7C+TT+apoiou+Mugaru.','',1416764114,'support','0;0;0;0;1671;0;0;0;0;0','','','',NULL,'','','','',1,1,25,22,1,0,'support',NULL,NULL,'','',1,0,'','',''),(84,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28500%7C504%29+K55.','../global_cdn/graphic/dots/green.png',1416764458,'attack','0;0;5323;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','3;3','0;0;','',0,1,31,22,1,0,'attack','-11',100,'att','1463;1463;1463;4389;53230',1,0,'','',''),(85,'Barbarendorp+%28500%7C504%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416764458,'attack','0;0;5323;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','3;3','0;0;','',0,1,31,22,0,1,'defense','-11',100,'att','1463;1463;1463;4389;53230',1,0,'','',''),(86,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/blue.png',1416820792,'attack','0;0;0;118;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,24,22,1,0,'attack','-25',100,'def','0;0;0;0;0',1,0,'','',''),(87,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/blue.png',1416820792,'attack','0;0;0;118;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,24,22,0,1,'defense','-25',100,'def','0;0;0;0;0',1,0,'','',''),(88,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/blue.png',1416821176,'attack','0;0;0;265;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,24,22,1,1,'attack','5',100,'att','0;0;0;0;0',1,0,'','',''),(89,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/blue.png',1416821176,'attack','0;0;0;265;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;20','0;0;','',0,1,24,22,0,1,'defense','5',100,'att','0;0;0;0;0',1,0,'','',''),(90,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/green.png',1416821594,'attack','0;0;5323;0;1671;0;330;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;0','0;0;','',0,1,24,22,1,0,'attack','-5',100,'att','62304;62303;62303;186910;186910',1,0,'','',''),(91,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416821594,'attack','0;0;5323;0;1671;0;330;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;100','20;0','0;0;','',0,1,24,22,0,1,'defense','-5',100,'att','62304;62303;62303;186910;186910',1,0,'','',''),(92,'Medalha+Comandante+de+Guerra+Brons+-+Level+2','',1416827771,'medal','','','','',NULL,'','','','wars;2',0,0,0,0,1,0,'other',NULL,NULL,'','',1,0,'','',''),(93,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/green.png',1416828618,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;75','0;0','0;0;','',0,1,24,22,1,1,'attack','-2',100,'att','8667;8667;8666;26000;26000',1,0,'','',''),(94,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416828618,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;75','0;0','0;0;','',0,1,24,22,0,1,'defense','-2',100,'att','8667;8667;8666;26000;26000',1,0,'','',''),(95,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/green.png',1416828620,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','75;49','0;0','0;0;','',0,1,24,22,1,1,'attack','20',100,'att','8666;8668;8666;26000;26000',1,0,'','',''),(96,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416828620,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','75;49','0;0','0;0;','',0,1,24,22,0,1,'defense','20',100,'att','8666;8668;8666;26000;26000',1,0,'','',''),(97,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/green.png',1416828621,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','49;29','0;0','0;0;','',0,1,24,22,1,1,'attack','-1',100,'att','8667;8668;8665;26000;26000',1,0,'','',''),(98,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416828621,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','49;29','0;0','0;0;','',0,1,24,22,0,1,'defense','-1',100,'att','8667;8668;8665;26000;26000',1,0,'','',''),(99,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/green.png',1416828623,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','29;4','0;0','0;0;','',0,1,24,22,1,0,'attack','7',100,'att','8667;8669;8664;26000;26000',1,0,'','',''),(100,'Barbarendorp+%28501%7C502%29+K55+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416828623,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','29;4','0;0','0;0;','',0,1,24,22,0,1,'defense','7',100,'att','8667;8669;8664;26000;26000',1,0,'','',''),(101,'Mugaru+%28001+%7C+TT%29+conquista+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/green.png',1416833053,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','16;-8','0;0','0;0;','',0,1,24,22,1,1,'attack','-10',100,'att','8667;8667;8666;26000;26000',1,0,'','',''),(102,'Barbarendorp+%28501%7C502%29+K55+foi+conquistada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416833053,'attack','0;0;1000;0;200;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','16;-8','0;0','0;0;','',0,1,24,22,0,1,'defense','-10',100,'att','8667;8667;8666;26000;26000',1,0,'','',''),(103,'Seu+apoio+de+001+%7C+TT+em+Barbarendorp+%28501%7C502%29+K55+foi+atacado.','../global_cdn/graphic/dots/red.png',1416833072,'supportAttack','0;0;1000;0;200;0;0;0;0;0','0;0;1000;0;200;0;0;0;0;0','','',NULL,'','','','',1,1,24,22,1,0,'defense',NULL,NULL,'','',1,0,'','',''),(104,'Mugaru+%28001+%7C+TT%29+ataca+Barbarendorp+%28501%7C502%29+K55.','../global_cdn/graphic/dots/yellow.png',1416833071,'attack','0;0;1000;0;0;0;0;0;0;1','0;0;127;0;0;0;0;0;0;0','0;0;1000;0;200;0;0;0;0;0','0;0;1000;0;200;0;0;0;0;0','','25;1','0;0','0;0;','',1,1,24,22,1,1,'attack','19',100,'att','2908;2914;2908;8730;8730',1,0,'','',''),(105,'Medalha+Cara+sem+sorte+Hout+-+Level+1','',1416833698,'medal','','','','',NULL,'','','','bluck;1',0,0,0,0,1,1,'other',NULL,NULL,'','',1,0,'','',''),(106,'Medalha+A+riqueza+vem+em+ouro+Hout+-+Level+1','',1416841246,'medal','','','','',NULL,'','','','gold;1',0,0,0,0,1,0,'other',NULL,NULL,'','',1,0,'','',''),(107,'Mugaru+%28001+%7C+TT%29+ataca+Bonusdorp+%28492%7C501%29+K54.','../global_cdn/graphic/dots/green.png',1416846107,'attack','0;0;300;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;77','3;3','0;0;','',0,1,321,22,1,1,'attack','25',100,'att','2632;2632;2632;7896;11000',1,0,'','',''),(108,'Bonusdorp+%28492%7C501%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416846107,'attack','0;0;300;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','100;77','3;3','0;0;','',0,1,321,22,0,1,'defense','25',100,'att','2632;2632;2632;7896;11000',1,0,'','',''),(109,'Mugaru+%28001+%7C+TT%29+ataca+Bonusdorp+%28492%7C501%29+K54.','../global_cdn/graphic/dots/green.png',1416846108,'attack','0;0;300;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','77;53','3;3','0;0;','',0,1,321,22,1,1,'attack','-22',100,'att','1;1;2;4;11000',1,0,'','',''),(110,'Bonusdorp+%28492%7C501%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416846108,'attack','0;0;300;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','77;53','3;3','0;0;','',0,1,321,22,0,1,'defense','-22',100,'att','1;1;2;4;11000',1,0,'','',''),(111,'Mugaru+%28001+%7C+TT%29+ataca+Bonusdorp+%28492%7C501%29+K54.','../global_cdn/graphic/dots/green.png',1416846110,'attack','0;0;300;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','53;26','3;3','0;0;','',0,1,321,22,1,1,'attack','17',100,'att','4;3;6;13;11000',1,0,'','',''),(112,'Bonusdorp+%28492%7C501%29+K54+foi+atacada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416846110,'attack','0;0;300;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','','53;26','3;3','0;0;','',0,1,321,22,0,1,'defense','17',100,'att','4;3;6;13;11000',1,0,'','',''),(113,'Mugaru+%28001+%7C+TT%29+conquista+Bonusdorp+%28492%7C501%29+K54.','../global_cdn/graphic/dots/green.png',1416846177,'attack','0;0;100;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','26;-9','3;3','0;0;','',0,1,321,22,1,0,'attack','17',100,'att','119;102;186;407;9000',1,0,'','',''),(114,'Bonusdorp+%28492%7C501%29+K54+foi+conquistada+por+Mugaru+%28001+%7C+TT%29','../global_cdn/graphic/dots/red.png',1416846177,'attack','0;0;100;0;100;0;0;0;0;1','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','0;0;0;0;0;0;0;0;0;0','26;-9','3;3','0;0;','',0,1,321,22,0,1,'defense','17',100,'att','119;102;186;407;9000',1,0,'','',''),(115,'Medalha+Conquista+Hout+-+Level+1','',1416847476,'medal','','','','',NULL,'','','','conquer;1',0,0,0,0,1,1,'other',NULL,NULL,'','',1,0,'','',''),(116,'Medalha+L%C3%ADder+em+pontos+Zilver+-+Level+3','',1695440846,'medal','','','','',NULL,'','','','rank;3',0,0,0,0,3,0,'other',NULL,NULL,'','',1,0,'','',''),(117,'O+paladino+encontrou+um+item','',1695471658,'knight_item','','','','',NULL,'','','','heavy',0,0,0,0,3,0,'other',NULL,NULL,'','',1,0,'','',''),(118,'Medalha+Campe%C3%A3o+de+Pontua%C3%A7%C3%A3o+Hout+-+Level+1','',1695475879,'medal','','','','',NULL,'','','','points;1',0,0,0,0,3,0,'other',NULL,NULL,'','',1,0,'','',''),(119,'O+paladino+encontrou+um+item','',1695502867,'knight_item','','','','',NULL,'','','','spear',0,0,0,0,3,0,'other',NULL,NULL,'','',1,0,'','',''),(120,'Medalha+L%C3%ADder+em+pontos+Zilver+-+Level+3','',1776032962,'medal','','','','',NULL,'','','','rank;3',0,0,0,0,5,1,'other',NULL,NULL,'','',1,0,'','',''),(125,'Medalha+Points+Champion+Bronze+-+Level+2','',1776476878,'medal','','','','',NULL,'','','','points;2',0,0,0,0,9,0,'other',NULL,NULL,'','',1,0,'','',''),(122,'Medalha+L%C3%ADder+em+pontos+Zilver+-+Level+3','',1776033004,'medal','','','','',NULL,'','','','rank;3',0,0,0,0,5,1,'other',NULL,NULL,'','',1,0,'','',''),(123,'Medalha+L%C3%ADder+em+pontos+Zilver+-+Level+3','',1776033158,'medal','','','','',NULL,'','','','rank;3',0,0,0,0,7,1,'other',NULL,NULL,'','',1,0,'','','');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `research`
--

DROP TABLE IF EXISTS `research`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `research` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `research` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `villageid` int unsigned NOT NULL,
  `end_time` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `villageid` (`villageid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `research`
--

LOCK TABLES `research` WRITE;
/*!40000 ALTER TABLE `research` DISABLE KEYS */;
/*!40000 ALTER TABLE `research` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `run_events`
--

DROP TABLE IF EXISTS `run_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `run_events` (
  `id` int unsigned NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `run_events`
--

LOCK TABLES `run_events` WRITE;
/*!40000 ALTER TABLE `run_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `run_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `save_players`
--

DROP TABLE IF EXISTS `save_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `save_players` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `round_id` int unsigned NOT NULL DEFAULT '0',
  `username` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `rank` int unsigned NOT NULL DEFAULT '0',
  `ally` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `points` int unsigned NOT NULL DEFAULT '0',
  `villages` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `save_players`
--

LOCK TABLES `save_players` WRITE;
/*!40000 ALTER TABLE `save_players` DISABLE KEYS */;
/*!40000 ALTER TABLE `save_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `save_rounds`
--

DROP TABLE IF EXISTS `save_rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `save_rounds` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `start` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `end` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `speed_units` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `moral` int unsigned NOT NULL DEFAULT '0',
  `speed` int unsigned NOT NULL DEFAULT '0',
  `name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `map` int unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `save_rounds`
--

LOCK TABLES `save_rounds` WRITE;
/*!40000 ALTER TABLE `save_rounds` DISABLE KEYS */;
/*!40000 ALTER TABLE `save_rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `userid` int unsigned NOT NULL,
  `sid` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `hkey` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_vacation` int unsigned NOT NULL DEFAULT '0',
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`(333)),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (18,3,'qp3ImRyQqGTpJ4PwNvGlKTgEEaW4Z13D','dCBN',0,'admin'),(19,4,'rfis','4y72dLNy5fWnvY6fPqpoTyqv2QhP6fx4',0,'Bruno'),(31,9,'8XrUZ6FinEtixqWAyMcu81oq7SaITKxo','gpyg',0,'test'),(28,5,'b9raPsM8Df3YvLsvmJ4xJmhINNc5NIwj','MxoR',0,'testuser5');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `share`
--

DROP TABLE IF EXISTS `share`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `share` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_from` int NOT NULL,
  `id_to` int NOT NULL,
  `time` int NOT NULL,
  `username_to` varchar(320) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `delete_time` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `share`
--

LOCK TABLES `share` WRITE;
/*!40000 ALTER TABLE `share` DISABLE KEYS */;
/*!40000 ALTER TABLE `share` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_place`
--

DROP TABLE IF EXISTS `unit_place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit_place` (
  `unit_spear` int DEFAULT '0',
  `unit_sword` int DEFAULT '0',
  `unit_archer` int DEFAULT '0',
  `unit_axe` int DEFAULT '0',
  `unit_spy` int DEFAULT '0',
  `unit_light` int DEFAULT '0',
  `unit_marcher` int DEFAULT '0',
  `unit_heavy` int DEFAULT '0',
  `unit_ram` int DEFAULT '0',
  `unit_catapult` int DEFAULT '0',
  `unit_knight` int DEFAULT '0',
  `unit_snob` int DEFAULT '0',
  `villages_from_id` int NOT NULL DEFAULT '0',
  `villages_to_id` int NOT NULL DEFAULT '0',
  KEY `villages_from_id` (`villages_from_id`),
  KEY `villages_to_id` (`villages_to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_place`
--

LOCK TABLES `unit_place` WRITE;
/*!40000 ALTER TABLE `unit_place` DISABLE KEYS */;
INSERT INTO `unit_place` VALUES (0,0,0,6497,1118,1371,0,0,1213,0,0,3,22,22),(3096,3923,0,0,0,0,0,3,0,0,0,4,23,23),(500,500,0,0,500,0,0,100,0,20,0,0,24,24),(969,0,0,2208,0,0,0,0,1976,0,0,0,25,25),(0,0,0,0,0,0,0,0,0,0,0,0,26,26),(0,0,0,0,0,0,0,0,0,0,0,0,27,27),(0,0,0,0,0,0,0,0,0,0,0,0,28,28),(0,0,0,0,0,0,0,0,0,0,0,0,29,29),(0,0,0,0,0,0,0,0,0,0,0,0,30,30),(0,0,0,0,0,0,0,0,0,0,0,0,31,31),(0,0,0,0,0,0,0,0,0,0,0,0,32,32),(0,0,0,0,0,0,0,0,0,0,0,0,33,33),(0,0,0,0,0,0,0,0,0,0,0,0,34,34),(0,0,0,0,0,0,0,0,0,0,0,0,35,35),(0,0,0,0,0,0,0,0,0,0,0,0,36,36),(0,0,0,0,0,0,0,0,0,0,0,0,37,37),(0,0,0,0,0,0,0,0,0,0,0,0,38,38),(0,0,0,0,0,0,0,0,0,0,0,0,39,39),(0,0,0,0,0,0,0,0,0,0,0,0,40,40),(0,0,0,0,0,0,0,0,0,0,0,0,41,41),(0,0,0,0,0,0,0,0,0,0,0,0,42,42),(0,0,0,0,0,0,0,0,0,0,0,0,43,43),(0,0,0,0,0,0,0,0,0,0,0,0,44,44),(0,0,0,0,0,0,0,0,0,0,0,0,45,45),(0,0,0,0,0,0,0,0,0,0,0,0,46,46),(0,0,0,0,0,0,0,0,0,0,0,0,47,47),(0,0,0,0,0,0,0,0,0,0,0,0,48,48),(0,0,0,0,0,0,0,0,0,0,0,0,49,49),(0,0,0,0,0,0,0,0,0,0,0,0,50,50),(0,0,0,0,0,0,0,0,0,0,0,0,51,51),(0,0,0,0,0,0,0,0,0,0,0,0,52,52),(0,0,0,0,0,0,0,0,0,0,0,0,53,53),(0,0,0,0,0,0,0,0,0,0,0,0,54,54),(0,0,0,0,0,0,0,0,0,0,0,0,55,55),(0,0,0,0,0,0,0,0,0,0,0,0,56,56),(0,0,0,0,0,0,0,0,0,0,0,0,57,57),(0,0,0,0,0,0,0,0,0,0,0,0,58,58),(0,0,0,0,0,0,0,0,0,0,0,0,59,59),(0,0,0,0,0,0,0,0,0,0,0,0,60,60),(0,0,0,0,0,0,0,0,0,0,0,0,61,61),(0,0,0,0,0,0,0,0,0,0,0,0,62,62),(0,0,0,0,0,0,0,0,0,0,0,0,63,63),(0,0,0,0,0,0,0,0,0,0,0,0,64,64),(0,0,0,0,0,0,0,0,0,0,0,0,65,65),(0,0,0,0,0,0,0,0,0,0,0,0,66,66),(0,0,0,0,0,0,0,0,0,0,0,0,67,67),(0,0,0,0,0,0,0,0,0,0,0,0,68,68),(0,0,0,0,0,0,0,0,0,0,0,0,69,69),(0,0,0,0,0,0,0,0,0,0,0,0,70,70),(0,0,0,0,0,0,0,0,0,0,0,0,71,71),(0,0,0,0,0,0,0,0,0,0,0,0,72,72),(0,0,0,0,0,0,0,0,0,0,0,0,73,73),(0,0,0,0,0,0,0,0,0,0,0,0,74,74),(0,0,0,0,0,0,0,0,0,0,0,0,75,75),(0,0,0,0,0,0,0,0,0,0,0,0,76,76),(0,0,0,0,0,0,0,0,0,0,0,0,77,77),(0,0,0,0,0,0,0,0,0,0,0,0,78,78),(0,0,0,0,0,0,0,0,0,0,0,0,79,79),(0,0,0,0,0,0,0,0,0,0,0,0,80,80),(0,0,0,0,0,0,0,0,0,0,0,0,81,81),(0,0,0,0,0,0,0,0,0,0,0,0,82,82),(0,0,0,0,0,0,0,0,0,0,0,0,83,83),(0,0,0,0,0,0,0,0,0,0,0,0,84,84),(0,0,0,0,0,0,0,0,0,0,0,0,85,85),(0,0,0,0,0,0,0,0,0,0,0,0,86,86),(0,0,0,0,0,0,0,0,0,0,0,0,87,87),(0,0,0,0,0,0,0,0,0,0,0,0,88,88),(0,0,0,0,0,0,0,0,0,0,0,0,89,89),(0,0,0,0,0,0,0,0,0,0,0,0,90,90),(0,0,0,0,0,0,0,0,0,0,0,0,91,91),(0,0,0,0,0,0,0,0,0,0,0,0,92,92),(0,0,0,0,0,0,0,0,0,0,0,0,93,93),(0,0,0,0,0,0,0,0,0,0,0,0,94,94),(0,0,0,0,0,0,0,0,0,0,0,0,95,95),(0,0,0,0,0,0,0,0,0,0,0,0,96,96),(0,0,0,0,0,0,0,0,0,0,0,0,97,97),(0,0,0,0,0,0,0,0,0,0,0,0,98,98),(0,0,0,0,0,0,0,0,0,0,0,0,99,99),(0,0,0,0,0,0,0,0,0,0,0,0,100,100),(0,0,0,0,0,0,0,0,0,0,0,0,101,101),(0,0,0,0,0,0,0,0,0,0,0,0,102,102),(0,0,0,0,0,0,0,0,0,0,0,0,103,103),(0,0,0,0,0,0,0,0,0,0,0,0,104,104),(0,0,0,0,0,0,0,0,0,0,0,0,105,105),(0,0,0,0,0,0,0,0,0,0,0,0,106,106),(0,0,0,0,0,0,0,0,0,0,0,0,107,107),(0,0,0,0,0,0,0,0,0,0,0,0,108,108),(0,0,0,0,0,0,0,0,0,0,0,0,109,109),(0,0,0,0,0,0,0,0,0,0,0,0,110,110),(0,0,0,0,0,0,0,0,0,0,0,0,111,111),(0,0,0,0,0,0,0,0,0,0,0,0,112,112),(0,0,0,0,0,0,0,0,0,0,0,0,113,113),(0,0,0,0,0,0,0,0,0,0,0,0,114,114),(0,0,0,0,0,0,0,0,0,0,0,0,115,115),(0,0,0,0,0,0,0,0,0,0,0,0,116,116),(0,0,0,0,0,0,0,0,0,0,0,0,117,117),(0,0,0,0,0,0,0,0,0,0,0,0,118,118),(0,0,0,0,0,0,0,0,0,0,0,0,119,119),(0,0,0,0,0,0,0,0,0,0,0,0,120,120),(0,0,0,0,0,0,0,0,0,0,0,0,121,121),(0,0,0,0,0,0,0,0,0,0,0,0,122,122),(0,0,0,0,0,0,0,0,0,0,0,0,123,123),(0,0,0,0,0,0,0,0,0,0,0,0,124,124),(0,0,0,0,0,0,0,0,0,0,0,0,125,125),(0,0,0,0,0,0,0,0,0,0,0,0,126,126),(0,0,0,0,0,0,0,0,0,0,0,0,127,127),(0,0,0,0,0,0,0,0,0,0,0,0,128,128),(0,0,0,0,0,0,0,0,0,0,0,0,129,129),(0,0,0,0,0,0,0,0,0,0,0,0,130,130),(0,0,0,0,0,0,0,0,0,0,0,0,131,131),(0,0,0,0,0,0,0,0,0,0,0,0,132,132),(0,0,0,0,0,0,0,0,0,0,0,0,133,133),(0,0,0,0,0,0,0,0,0,0,0,0,134,134),(0,0,0,0,0,0,0,0,0,0,0,0,135,135),(0,0,0,0,0,0,0,0,0,0,0,0,136,136),(0,0,0,0,0,0,0,0,0,0,0,0,137,137),(0,0,0,0,0,0,0,0,0,0,0,0,138,138),(0,0,0,0,0,0,0,0,0,0,0,0,139,139),(0,0,0,0,0,0,0,0,0,0,0,0,140,140),(0,0,0,0,0,0,0,0,0,0,0,0,141,141),(0,0,0,0,0,0,0,0,0,0,0,0,142,142),(0,0,0,0,0,0,0,0,0,0,0,0,143,143),(0,0,0,0,0,0,0,0,0,0,0,0,144,144),(0,0,0,0,0,0,0,0,0,0,0,0,145,145),(0,0,0,0,0,0,0,0,0,0,0,0,146,146),(0,0,0,0,0,0,0,0,0,0,0,0,147,147),(0,0,0,0,0,0,0,0,0,0,0,0,148,148),(0,0,0,0,0,0,0,0,0,0,0,0,149,149),(0,0,0,0,0,0,0,0,0,0,0,0,150,150),(0,0,0,0,0,0,0,0,0,0,0,0,151,151),(0,0,0,0,0,0,0,0,0,0,0,0,152,152),(0,0,0,0,0,0,0,0,0,0,0,0,153,153),(0,0,0,0,0,0,0,0,0,0,0,0,154,154),(0,0,0,0,0,0,0,0,0,0,0,0,155,155),(0,0,0,0,0,0,0,0,0,0,0,0,156,156),(0,0,0,0,0,0,0,0,0,0,0,0,157,157),(0,0,0,0,0,0,0,0,0,0,0,0,158,158),(0,0,0,0,0,0,0,0,0,0,0,0,159,159),(0,0,0,0,0,0,0,0,0,0,0,0,160,160),(0,0,0,0,0,0,0,0,0,0,0,0,161,161),(0,0,0,0,0,0,0,0,0,0,0,0,162,162),(0,0,0,0,0,0,0,0,0,0,0,0,163,163),(0,0,0,0,0,0,0,0,0,0,0,0,164,164),(0,0,0,0,0,0,0,0,0,0,0,0,165,165),(0,0,0,0,0,0,0,0,0,0,0,0,166,166),(0,0,0,0,0,0,0,0,0,0,0,0,167,167),(0,0,0,0,0,0,0,0,0,0,0,0,168,168),(0,0,0,0,0,0,0,0,0,0,0,0,169,169),(0,0,0,0,0,0,0,0,0,0,0,0,170,170),(0,0,0,0,0,0,0,0,0,0,0,0,171,171),(0,0,0,0,0,0,0,0,0,0,0,0,172,172),(0,0,0,0,0,0,0,0,0,0,0,0,173,173),(0,0,0,0,0,0,0,0,0,0,0,0,174,174),(0,0,0,0,0,0,0,0,0,0,0,0,175,175),(0,0,0,0,0,0,0,0,0,0,0,0,176,176),(0,0,0,0,0,0,0,0,0,0,0,0,177,177),(0,0,0,0,0,0,0,0,0,0,0,0,178,178),(0,0,0,0,0,0,0,0,0,0,0,0,179,179),(0,0,0,0,0,0,0,0,0,0,0,0,180,180),(0,0,0,0,0,0,0,0,0,0,0,0,181,181),(0,0,0,0,0,0,0,0,0,0,0,0,182,182),(0,0,0,0,0,0,0,0,0,0,0,0,183,183),(0,0,0,0,0,0,0,0,0,0,0,0,184,184),(0,0,0,0,0,0,0,0,0,0,0,0,185,185),(0,0,0,0,0,0,0,0,0,0,0,0,186,186),(0,0,0,0,0,0,0,0,0,0,0,0,187,187),(0,0,0,0,0,0,0,0,0,0,0,0,188,188),(0,0,0,0,0,0,0,0,0,0,0,0,189,189),(0,0,0,0,0,0,0,0,0,0,0,0,190,190),(0,0,0,0,0,0,0,0,0,0,0,0,191,191),(0,0,0,0,0,0,0,0,0,0,0,0,192,192),(0,0,0,0,0,0,0,0,0,0,0,0,193,193),(0,0,0,0,0,0,0,0,0,0,0,0,194,194),(0,0,0,0,0,0,0,0,0,0,0,0,195,195),(0,0,0,0,0,0,0,0,0,0,0,0,196,196),(0,0,0,0,0,0,0,0,0,0,0,0,197,197),(0,0,0,0,0,0,0,0,0,0,0,0,198,198),(0,0,0,0,0,0,0,0,0,0,0,0,199,199),(0,0,0,0,0,0,0,0,0,0,0,0,200,200),(0,0,0,0,0,0,0,0,0,0,0,0,201,201),(0,0,0,0,0,0,0,0,0,0,0,0,202,202),(0,0,0,0,0,0,0,0,0,0,0,0,203,203),(0,0,0,0,0,0,0,0,0,0,0,0,204,204),(0,0,0,0,0,0,0,0,0,0,0,0,205,205),(0,0,0,0,0,0,0,0,0,0,0,0,206,206),(0,0,0,0,0,0,0,0,0,0,0,0,207,207),(0,0,0,0,0,0,0,0,0,0,0,0,208,208),(0,0,0,0,0,0,0,0,0,0,0,0,209,209),(0,0,0,0,0,0,0,0,0,0,0,0,210,210),(0,0,0,0,0,0,0,0,0,0,0,0,211,211),(0,0,0,0,0,0,0,0,0,0,0,0,212,212),(0,0,0,0,0,0,0,0,0,0,0,0,213,213),(0,0,0,0,0,0,0,0,0,0,0,0,214,214),(0,0,0,0,0,0,0,0,0,0,0,0,215,215),(0,0,0,0,0,0,0,0,0,0,0,0,216,216),(0,0,0,0,0,0,0,0,0,0,0,0,217,217),(0,0,0,0,0,0,0,0,0,0,0,0,218,218),(0,0,0,0,0,0,0,0,0,0,0,0,219,219),(0,0,0,0,0,0,0,0,0,0,0,0,220,220),(0,0,0,0,0,0,0,0,0,0,0,0,221,221),(0,0,0,0,0,0,0,0,0,0,0,0,222,222),(0,0,0,0,0,0,0,0,0,0,0,0,223,223),(0,0,0,0,0,0,0,0,0,0,0,0,224,224),(0,0,0,0,0,0,0,0,0,0,0,0,225,225),(0,0,0,0,0,0,0,0,0,0,0,0,227,227),(0,0,0,0,0,0,0,0,0,0,0,0,226,226),(0,0,0,0,0,0,0,0,0,0,0,0,228,228),(0,0,0,0,0,0,0,0,0,0,0,0,229,229),(0,0,0,100,0,100,0,0,0,0,0,0,22,321),(0,0,0,0,0,0,0,0,0,0,0,0,230,230),(0,0,0,0,0,0,0,0,0,0,0,0,231,231),(0,0,0,0,0,0,0,0,0,0,0,0,232,232),(0,0,0,0,0,0,0,0,0,0,0,0,233,233),(0,0,0,0,0,0,0,0,0,0,0,0,234,234),(0,0,0,0,0,0,0,0,0,0,0,0,235,235),(0,0,0,0,0,0,0,0,0,0,0,0,236,236),(0,0,0,0,0,0,0,0,0,0,0,0,237,237),(0,0,0,0,0,0,0,0,0,0,0,0,238,238),(0,0,0,0,0,0,0,0,0,0,0,0,239,239),(0,0,0,0,0,0,0,0,0,0,0,0,240,240),(0,0,0,0,0,0,0,0,0,0,0,0,241,241),(0,0,0,0,0,0,0,0,0,0,0,0,242,242),(0,0,0,0,0,0,0,0,0,0,0,0,243,243),(0,0,0,0,0,0,0,0,0,0,0,0,244,244),(0,0,0,0,0,0,0,0,0,0,0,0,245,245),(0,0,0,0,0,0,0,0,0,0,0,0,246,246),(0,0,0,0,0,0,0,0,0,0,0,0,247,247),(0,0,0,0,0,0,0,0,0,0,0,0,248,248),(0,0,0,0,0,0,0,0,0,0,0,0,249,249),(0,0,0,0,0,0,0,0,0,0,0,0,250,250),(0,0,0,0,0,0,0,0,0,0,0,0,251,251),(0,0,0,0,0,0,0,0,0,0,0,0,252,252),(0,0,0,0,0,0,0,0,0,0,0,0,253,253),(0,0,0,0,0,0,0,0,0,0,0,0,254,254),(0,0,0,0,0,0,0,0,0,0,0,0,255,255),(0,0,0,0,0,0,0,0,0,0,0,0,256,256),(0,0,0,0,0,0,0,0,0,0,0,0,257,257),(0,0,0,0,0,0,0,0,0,0,0,0,258,258),(0,0,0,0,0,0,0,0,0,0,0,0,259,259),(0,0,0,0,0,0,0,0,0,0,0,0,260,260),(0,0,0,0,0,0,0,0,0,0,0,0,261,261),(0,0,0,0,0,0,0,0,0,0,0,0,262,262),(0,0,0,0,0,0,0,0,0,0,0,0,263,263),(0,0,0,0,0,0,0,0,0,0,0,0,264,264),(0,0,0,0,0,0,0,0,0,0,0,0,265,265),(0,0,0,0,0,0,0,0,0,0,0,0,266,266),(0,0,0,0,0,0,0,0,0,0,0,0,267,267),(0,0,0,0,0,0,0,0,0,0,0,0,268,268),(0,0,0,0,0,0,0,0,0,0,0,0,269,269),(0,0,0,0,0,0,0,0,0,0,0,0,270,270),(0,0,0,0,0,0,0,0,0,0,0,0,271,271),(0,0,0,0,0,0,0,0,0,0,0,0,272,272),(0,0,0,0,0,0,0,0,0,0,0,0,273,273),(0,0,0,0,0,0,0,0,0,0,0,0,274,274),(0,0,0,0,0,0,0,0,0,0,0,0,275,275),(0,0,0,0,0,0,0,0,0,0,0,0,276,276),(0,0,0,0,0,0,0,0,0,0,0,0,277,277),(0,0,0,0,0,0,0,0,0,0,0,0,278,278),(0,0,0,0,0,0,0,0,0,0,0,0,279,279),(0,0,0,0,0,0,0,0,0,0,0,0,280,280),(0,0,0,0,0,0,0,0,0,0,0,0,281,281),(0,0,0,0,0,0,0,0,0,0,0,0,282,282),(0,0,0,0,0,0,0,0,0,0,0,0,283,283),(0,0,0,0,0,0,0,0,0,0,0,0,284,284),(0,0,0,0,0,0,0,0,0,0,0,0,285,285),(0,0,0,0,0,0,0,0,0,0,0,0,286,286),(0,0,0,0,0,0,0,0,0,0,0,0,287,287),(0,0,0,0,0,0,0,0,0,0,0,0,288,288),(0,0,0,0,0,0,0,0,0,0,0,0,289,289),(0,0,0,0,0,0,0,0,0,0,0,0,290,290),(0,0,0,0,0,0,0,0,0,0,0,0,291,291),(0,0,0,0,0,0,0,0,0,0,0,0,292,292),(0,0,0,0,0,0,0,0,0,0,0,0,293,293),(0,0,0,0,0,0,0,0,0,0,0,0,294,294),(0,0,0,0,0,0,0,0,0,0,0,0,295,295),(0,0,0,0,0,0,0,0,0,0,0,0,296,296),(0,0,0,0,0,0,0,0,0,0,0,0,297,297),(0,0,0,0,0,0,0,0,0,0,0,0,298,298),(0,0,0,0,0,0,0,0,0,0,0,0,299,299),(0,0,0,0,0,0,0,0,0,0,0,0,300,300),(0,0,0,0,0,0,0,0,0,0,0,0,301,301),(0,0,0,0,0,0,0,0,0,0,0,0,302,302),(0,0,0,0,0,0,0,0,0,0,0,0,303,303),(0,0,0,0,0,0,0,0,0,0,0,0,304,304),(0,0,0,0,0,0,0,0,0,0,0,0,305,305),(0,0,0,0,0,0,0,0,0,0,0,0,306,306),(0,0,0,0,0,0,0,0,0,0,0,0,307,307),(0,0,0,0,0,0,0,0,0,0,0,0,308,308),(0,0,0,0,0,0,0,0,0,0,0,0,309,309),(0,0,0,0,0,0,0,0,0,0,0,0,310,310),(0,0,0,0,0,0,0,0,0,0,0,0,311,311),(0,0,0,0,0,0,0,0,0,0,0,0,312,312),(0,0,0,0,0,0,0,0,0,0,0,0,313,313),(0,0,0,0,0,0,0,0,0,0,0,0,314,314),(0,0,0,0,0,0,0,0,0,0,0,0,315,315),(0,0,0,0,0,0,0,0,0,0,0,0,316,316),(0,0,0,0,0,0,0,0,0,0,0,0,317,317),(0,0,0,0,0,0,0,0,0,0,0,0,318,318),(0,0,0,0,0,0,0,0,0,0,0,0,319,319),(0,0,0,0,0,0,0,0,0,0,0,0,320,320),(0,0,0,0,0,0,0,0,0,0,0,0,321,321),(0,0,0,0,0,0,0,0,0,0,0,0,322,322),(0,0,0,0,0,0,0,0,0,0,0,0,323,323),(0,0,0,0,0,0,0,0,0,0,0,0,324,324),(0,0,0,0,0,0,0,0,0,0,0,0,325,325),(0,0,0,0,0,0,0,0,0,0,0,0,326,326),(0,0,0,0,0,0,0,0,0,0,0,0,327,327),(0,0,0,0,0,0,0,0,0,0,0,0,328,328),(0,0,0,0,0,0,0,0,0,0,0,0,329,329),(0,0,0,0,0,0,0,0,0,0,0,0,330,330),(0,0,0,0,0,0,0,0,0,0,0,0,331,331),(0,0,0,0,0,0,0,0,0,0,0,0,332,332),(0,0,0,0,0,0,0,0,0,0,0,0,333,333),(0,0,0,0,0,0,0,0,0,0,0,0,334,334),(0,0,0,0,0,0,0,0,0,0,0,0,335,335),(0,0,0,0,0,0,0,0,0,0,0,0,336,336),(0,0,0,0,0,0,0,0,0,0,0,0,337,337),(0,0,0,0,0,0,0,0,0,0,0,0,338,338),(0,0,0,0,0,0,0,0,0,0,0,0,339,339),(0,0,0,0,0,0,0,0,0,0,0,0,340,340),(0,0,0,0,0,0,0,0,0,0,0,0,341,341),(0,0,0,0,0,0,0,0,0,0,0,0,342,342),(0,0,0,0,0,0,0,0,0,0,0,0,343,343),(0,0,0,0,0,0,0,0,0,0,0,0,344,344),(0,0,0,0,0,0,0,0,0,0,0,0,345,345),(0,0,0,0,0,0,0,0,0,0,0,0,346,346),(0,0,0,0,0,0,0,0,0,0,0,0,347,347),(0,0,0,0,0,0,0,0,0,0,0,0,348,348),(0,0,0,0,0,0,0,0,0,0,0,0,349,349),(0,0,0,0,0,0,0,0,0,0,0,0,350,350),(0,0,0,0,0,0,0,0,0,0,0,0,351,351),(0,0,0,0,0,0,0,0,0,0,0,0,352,352),(0,0,0,0,0,0,0,0,0,0,0,0,353,353),(0,0,0,0,0,0,0,0,0,0,0,0,354,354),(0,0,0,0,0,0,0,0,0,0,0,0,355,355),(0,0,0,0,0,0,0,0,0,0,0,0,356,356),(0,0,0,0,0,0,0,0,0,0,0,0,357,357),(0,0,0,0,0,0,0,0,0,0,0,0,358,358),(0,0,0,0,0,0,0,0,0,0,0,0,359,359),(0,0,0,0,0,0,0,0,0,0,0,0,360,360),(0,0,0,0,0,0,0,0,0,0,0,0,361,361),(0,0,0,0,0,0,0,0,0,0,0,0,362,362),(0,0,0,0,0,0,0,0,0,0,0,0,363,363),(0,0,0,0,0,0,0,0,0,0,0,0,364,364),(0,0,0,0,0,0,0,0,0,0,0,0,365,365),(0,0,0,0,0,0,0,0,0,0,0,0,366,366),(0,0,0,0,0,0,0,0,0,0,0,0,367,367),(0,0,0,0,0,0,0,0,0,0,0,0,368,368),(0,0,0,0,0,0,0,0,0,0,0,0,369,369),(0,0,0,0,0,0,0,0,0,0,0,0,370,370),(0,0,0,0,0,0,0,0,0,0,0,0,371,371),(0,0,0,0,0,0,0,0,0,0,0,0,372,372),(0,0,0,0,0,0,0,0,0,0,0,0,373,373),(0,0,0,0,0,0,0,0,0,0,0,0,374,374),(0,0,0,0,0,0,0,0,0,0,0,0,375,375),(0,0,0,0,0,0,0,0,0,0,0,0,376,376),(0,0,0,0,0,0,0,0,0,0,0,0,377,377),(0,0,0,0,0,0,0,0,0,0,0,0,378,378),(0,0,0,0,0,0,0,0,0,0,0,0,379,379),(0,0,0,0,0,0,0,0,0,0,0,0,380,380),(0,0,0,0,0,0,0,0,0,0,0,0,381,381),(0,0,0,0,0,0,0,0,0,0,0,0,382,382),(0,0,0,0,0,0,0,0,0,0,0,0,383,383),(0,0,0,0,0,0,0,0,0,0,0,0,384,384),(0,0,0,0,0,0,0,0,0,0,0,0,385,385),(0,0,0,0,0,0,0,0,0,0,0,0,386,386),(0,0,0,0,0,0,0,0,0,0,0,0,387,387),(0,0,0,0,0,0,0,0,0,0,0,0,388,388),(0,0,0,0,0,0,0,0,0,0,0,0,389,389),(0,0,0,0,0,0,0,0,0,0,0,0,390,390),(0,0,0,0,0,0,0,0,0,0,0,0,391,391),(0,0,0,0,0,0,0,0,0,0,0,0,392,392),(0,0,0,0,0,0,0,0,0,0,0,0,393,393),(0,0,0,0,0,0,0,0,0,0,0,0,394,394),(0,0,0,0,0,0,0,0,0,0,0,0,395,395),(0,0,0,0,0,0,0,0,0,0,0,0,396,396),(0,0,0,0,0,0,0,0,0,0,0,0,397,397),(0,0,0,0,0,0,0,0,0,0,0,0,398,398),(0,0,0,0,0,0,0,0,0,0,0,0,399,399),(0,0,0,0,0,0,0,0,0,0,0,0,400,400),(0,0,0,0,0,0,0,0,0,0,0,0,401,401),(0,0,0,0,0,0,0,0,0,0,0,0,402,402),(0,0,0,0,0,0,0,0,0,0,0,0,403,403),(0,0,0,0,0,0,0,0,0,0,0,0,404,404),(0,0,0,0,0,0,0,0,0,0,0,0,405,405),(0,0,0,0,0,0,0,0,0,0,0,0,406,406),(0,0,0,0,0,0,0,0,0,0,0,0,407,407),(0,0,0,0,0,0,0,0,0,0,0,0,408,408),(0,0,0,0,0,0,0,0,0,0,0,0,409,409),(0,0,0,0,0,0,0,0,0,0,0,0,410,410),(0,0,0,0,0,0,0,0,0,0,0,0,411,411),(0,0,0,0,0,0,0,0,0,0,0,0,412,412),(0,0,0,0,0,0,0,0,0,0,0,0,413,413),(0,0,0,0,0,0,0,0,0,0,0,0,414,414),(0,0,0,0,0,0,0,0,0,0,0,0,415,415),(0,0,0,0,0,0,0,0,0,0,0,0,416,416),(0,0,0,0,0,0,0,0,0,0,0,0,417,417),(0,0,0,0,0,0,0,0,0,0,0,0,418,418),(0,0,0,0,0,0,0,0,0,0,0,0,419,419),(0,0,0,0,0,0,0,0,0,0,0,0,420,420),(0,0,0,0,0,0,0,0,0,0,0,0,421,421),(0,0,0,0,0,0,0,0,0,0,0,0,422,422),(0,0,0,0,0,0,0,0,0,0,0,0,423,423),(0,0,0,0,0,0,0,0,0,0,0,0,424,424),(0,0,0,0,0,0,0,0,0,0,0,0,425,425),(0,0,0,0,0,0,0,0,0,0,0,0,426,426),(0,0,0,0,0,0,0,0,0,0,0,0,427,427),(0,0,0,0,0,0,0,0,0,0,0,0,428,428),(0,0,0,0,0,0,0,0,0,0,0,0,429,429),(0,0,0,0,0,0,0,0,0,0,0,0,430,430),(0,0,0,0,0,0,0,0,0,0,0,0,431,431),(0,0,0,0,0,0,0,0,0,0,0,0,432,432),(0,0,0,0,0,0,0,0,0,0,0,0,433,433),(0,0,0,0,0,0,0,0,0,0,0,0,434,434),(0,0,0,0,0,0,0,0,0,0,0,0,435,435),(0,0,0,0,0,0,0,0,0,0,0,0,436,436),(0,0,0,0,0,0,0,0,0,0,0,0,437,437),(0,0,0,0,0,0,0,0,0,0,0,0,438,438),(0,0,0,0,0,0,0,0,0,0,0,0,439,439),(0,0,0,0,0,0,0,0,0,0,0,0,440,440),(0,0,0,0,0,0,0,0,0,0,0,0,441,441),(0,0,0,0,0,0,0,0,0,0,0,0,442,442),(0,0,0,0,0,0,0,0,0,0,0,0,443,443),(0,0,0,0,0,0,0,0,0,0,0,0,444,444),(0,0,0,0,0,0,0,0,0,0,0,0,445,445),(0,0,0,0,0,0,0,0,0,0,0,0,446,446),(0,0,0,0,0,0,0,0,0,0,0,0,447,447),(0,0,0,0,0,0,0,0,0,0,0,0,448,448),(0,0,0,0,0,0,0,0,0,0,0,0,449,449),(0,0,0,0,0,0,0,0,0,0,0,0,450,450),(0,0,0,0,0,0,0,0,0,0,0,0,451,451),(0,0,0,0,0,0,0,0,0,0,0,0,452,452),(0,0,0,0,0,0,0,0,0,0,0,0,453,453),(0,0,0,0,0,0,0,0,0,0,0,0,454,454),(0,0,0,0,0,0,0,0,0,0,0,0,455,455),(0,0,0,0,0,0,0,0,0,0,0,0,456,456),(0,0,0,0,0,0,0,0,0,0,0,0,457,457),(0,0,0,0,0,0,0,0,0,0,0,0,458,458),(0,0,0,0,0,0,0,0,0,0,0,0,459,459),(0,0,0,0,0,0,0,0,0,0,0,0,460,460),(0,0,0,0,0,0,0,0,0,0,0,0,461,461),(0,0,0,0,0,0,0,0,0,0,0,0,462,462),(0,0,0,0,0,0,0,0,0,0,0,0,463,463),(0,0,0,0,0,0,0,0,0,0,0,0,464,464),(0,0,0,0,0,0,0,0,0,0,0,0,465,465),(0,0,0,0,0,0,0,0,0,0,0,0,466,466),(0,0,0,0,0,0,0,0,0,0,0,0,467,467),(0,0,0,0,0,0,0,0,0,0,0,0,468,468),(0,0,0,0,0,0,0,0,0,0,0,0,469,469),(0,0,0,0,0,0,0,0,0,0,0,0,470,470),(0,0,0,0,0,0,0,0,0,0,0,0,471,471),(0,0,0,0,0,0,0,0,0,0,0,0,472,472),(0,0,0,0,0,0,0,0,0,0,0,0,473,473),(0,0,0,0,0,0,0,0,0,0,0,0,474,474),(0,0,0,0,0,0,0,0,0,0,0,0,475,475),(0,0,0,0,0,0,0,0,0,0,0,0,476,476),(0,0,0,0,0,0,0,0,0,0,0,0,477,477),(0,0,0,0,0,0,0,0,0,0,0,0,478,478),(0,0,0,0,0,0,0,0,0,0,0,0,479,479),(0,0,0,0,0,0,0,0,0,0,0,0,480,480),(0,0,0,0,0,0,0,0,0,0,0,0,481,481),(0,0,0,0,0,0,0,0,0,0,0,0,482,482),(0,0,0,0,0,0,0,0,0,0,0,0,483,483),(0,0,0,0,0,0,0,0,0,0,0,0,484,484),(0,0,0,0,0,0,0,0,0,0,0,0,485,485),(0,0,0,0,0,0,0,0,0,0,0,0,486,486),(0,0,0,0,0,0,0,0,0,0,0,0,487,487),(0,0,0,0,0,0,0,0,0,0,0,0,488,488),(0,0,0,0,0,0,0,0,0,0,0,0,489,489),(0,0,0,0,0,0,0,0,0,0,0,0,490,490),(0,0,0,0,0,0,0,0,0,0,0,0,491,491),(0,0,0,0,0,0,0,0,0,0,0,0,492,492),(0,0,0,0,0,0,0,0,0,0,0,0,493,493),(2,1,0,0,0,0,0,0,0,0,1,0,494,494),(0,0,0,0,0,0,0,0,0,0,0,0,495,495),(0,0,0,0,0,0,0,0,0,0,0,0,496,496),(0,0,0,0,0,0,0,0,0,0,0,0,497,497),(0,0,0,0,0,0,0,0,0,0,0,0,498,498),(0,0,0,0,0,0,0,0,0,0,0,0,499,499),(0,0,0,0,0,0,0,0,0,0,0,0,500,500),(0,0,0,0,0,0,0,0,0,0,0,0,501,501),(0,0,0,0,0,0,0,0,0,0,0,0,502,502),(0,0,0,0,0,0,0,0,0,0,0,0,503,503),(0,0,0,0,0,0,0,0,0,0,0,0,504,504),(0,0,0,0,0,0,0,0,0,0,0,0,505,505),(0,0,0,0,0,0,0,0,0,0,0,0,506,506),(0,0,0,0,0,0,0,0,0,0,0,0,507,507),(0,0,0,0,0,0,0,0,0,0,0,0,508,508),(0,0,0,0,0,0,0,0,0,0,0,0,509,509),(0,0,0,0,0,0,0,0,0,0,0,0,510,510),(0,0,0,0,0,0,0,0,0,0,0,0,511,511),(0,0,0,0,0,0,0,0,0,0,0,0,512,512),(0,0,0,0,0,0,0,0,0,0,0,0,513,513),(20,120,0,160,50,100,0,200,70,70,1,3,514,514),(0,0,0,0,0,0,0,0,0,0,0,0,515,515),(0,0,0,0,0,0,0,0,0,0,0,0,516,516),(0,0,0,0,0,0,0,0,0,0,0,0,517,517);
/*!40000 ALTER TABLE `unit_place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '',
  `banned` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'N',
  `villages` int NOT NULL,
  `points` int unsigned NOT NULL,
  `ennobled_by` varchar(90) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ally` int NOT NULL DEFAULT '-1',
  `ally_titel` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ally_found` int unsigned NOT NULL DEFAULT '0',
  `ally_lead` int unsigned NOT NULL DEFAULT '0',
  `ally_invite` int unsigned NOT NULL DEFAULT '0',
  `ally_diplomacy` int unsigned NOT NULL DEFAULT '0',
  `ally_mass_mail` int unsigned NOT NULL DEFAULT '0',
  `rang` int unsigned NOT NULL,
  `villages_mode` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'prod',
  `attacks` int unsigned DEFAULT '0',
  `new_report` int unsigned NOT NULL DEFAULT '0',
  `new_mail` int unsigned DEFAULT '0',
  `market_sell` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'all',
  `market_buy` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'all',
  `market_ratio_max` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '3',
  `killed_units_att` int unsigned NOT NULL,
  `killed_units_att_rank` int unsigned NOT NULL,
  `killed_units_def` int unsigned NOT NULL,
  `killed_units_def_rank` int unsigned NOT NULL,
  `killed_units_altogether` int unsigned NOT NULL,
  `killed_units_altogether_rank` int unsigned NOT NULL,
  `do_action` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `last_activity` int unsigned NOT NULL,
  `birthday` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vacation_id` int NOT NULL DEFAULT '-1',
  `vacation_name` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `vacation_accept` int unsigned NOT NULL DEFAULT '0',
  `b_day` int unsigned NOT NULL,
  `b_month` int unsigned NOT NULL,
  `b_year` int unsigned NOT NULL,
  `sex` enum('f','m','x') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'x',
  `home` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `personal_text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `window_width` int unsigned NOT NULL DEFAULT '840',
  `show_toolbar` int unsigned NOT NULL DEFAULT '1',
  `dyn_menu` int unsigned NOT NULL DEFAULT '1',
  `confirm_queue` int unsigned NOT NULL DEFAULT '1',
  `map_size` int unsigned NOT NULL DEFAULT '9',
  `minimap_size` enum('s','m','b') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'm',
  `memo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `map_reload` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `graphical_overview` tinyint unsigned NOT NULL DEFAULT '1',
  `overview` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'new',
  `labels` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'yes',
  `coins` int unsigned NOT NULL DEFAULT '0',
  `snobs` int unsigned NOT NULL DEFAULT '0',
  `coinsNext` int unsigned NOT NULL DEFAULT '1',
  `protection` int NOT NULL DEFAULT '0',
  `group` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `css` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'stamm.css',
  `image_base` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'graphic',
  `gfx_old` tinyint unsigned NOT NULL DEFAULT '0',
  `knightname` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT 'Paladin',
  `data_inregistrare` varchar(1111) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_inregistrare` varchar(1111) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `medc` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `premium_active` int NOT NULL,
  `premium_active_until` int NOT NULL,
  `premium_activated_at` int NOT NULL,
  `join_actions` enum('n','y') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `rang` (`rang`),
  KEY `vacation_id` (`vacation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11419 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mugaru','','N',5,43092,'Mugaru',1,'',1,1,1,1,1,1,'combined',0,0,0,'all','all','3',2800,1,440,1,3240,1,'1695467421',1695467421,'',-1,'',0,0,0,0,'x','','','w123',840,1,1,1,9,'m','','',1,'new','yes',66,5,12,0,'','stamm.css','graphic',0,'Paladin','','','1',0,0,0,'y'),(2,'Ukiraki','','N',1,100,'',1,'',0,0,0,0,0,4,'prod',0,0,0,'all','all','3',0,2,0,2,0,2,'1416570051',1416570051,'',-1,'',0,0,0,0,'x','','','',840,1,1,1,9,'m','','',1,'new','yes',0,0,1,0,'','stamm.css','graphic',0,'Paladin','','','1',0,0,0,'y'),(3,'admin','','N',1,515,'',2,'',1,1,1,1,1,3,'commands',1,0,0,'all','all','3',0,0,0,0,0,0,'',1776032303,'',-1,'',0,24,12,1993,'m','75991561705','','',840,1,1,1,9,'m','','',1,'new','yes',0,0,1,0,'','stamm.css','graphic',0,'Paladin','','','1',0,0,0,'y'),(4,'Bruno','','N',0,0,'',-1,'',0,0,0,0,0,7,'prod',0,0,0,'all','all','3',0,0,0,0,0,0,'',0,'',-1,'',0,0,0,0,'x','','','',840,1,1,1,9,'m','','',1,'new','yes',0,0,1,0,'','stamm.css','graphic',0,'Paladin','','','0',0,0,0,'n'),(7,'cypox','','N',1,26,'',-1,'',0,0,0,0,0,5,'prod',0,1,1,'all','all','3',0,0,0,0,0,0,'1776033183',1776033183,'',-1,'',0,0,0,0,'x','','','',840,1,1,1,9,'m','','',1,'new','yes',0,0,1,1776249158,'','stamm.css','graphic',0,'Paladin','1776019918','','1',0,0,0,'y'),(5,'testuser5','','N',1,26,'',-1,'',0,0,0,0,0,6,'prod',0,1,1,'all','all','3',0,0,0,0,0,0,'1776033522',1776103900,'',-1,'',0,0,0,0,'x','','','',840,1,1,1,9,'m','','',1,'new','yes',0,0,1,1776249162,'','stamm.css','graphic',0,'Paladin','1776033004','::1','1',0,0,0,'y'),(9,'test','','N',1,12379,'',-1,'',0,0,0,0,0,2,'commands',0,0,0,'all','all','3',0,0,0,0,0,0,'1776552132',1776552868,'',-1,'',0,0,0,0,'x','','','',840,1,1,1,9,'m','','',1,'new','yes',9,1,1,1776249137,'','stamm.css','graphic',0,'Paladin','1776032735','::1','1',0,0,0,'y');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `villages`
--

DROP TABLE IF EXISTS `villages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `villages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `x` int unsigned NOT NULL,
  `y` int unsigned NOT NULL,
  `bonus` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `userid` int NOT NULL,
  `r_wood` double unsigned DEFAULT '500',
  `r_stone` double unsigned DEFAULT '500',
  `r_iron` double unsigned DEFAULT '400',
  `r_bh` int unsigned NOT NULL DEFAULT '0',
  `last_prod_aktu` int unsigned NOT NULL,
  `points` int unsigned NOT NULL,
  `continent` int unsigned NOT NULL,
  `main` int unsigned DEFAULT '1',
  `barracks` int unsigned DEFAULT '0',
  `stable` int unsigned DEFAULT '0',
  `garage` int unsigned DEFAULT '0',
  `snob` int unsigned DEFAULT '0',
  `smith` int unsigned DEFAULT '0',
  `place` int unsigned DEFAULT '1',
  `statue` int unsigned DEFAULT '0',
  `market` int unsigned DEFAULT '0',
  `wood` int unsigned DEFAULT '0',
  `stone` int unsigned DEFAULT '0',
  `iron` int unsigned DEFAULT '0',
  `storage` int unsigned DEFAULT '1',
  `farm` int unsigned DEFAULT '1',
  `hide` int unsigned DEFAULT '1',
  `wall` int unsigned DEFAULT '0',
  `unit_spear_tec_level` int unsigned DEFAULT '1',
  `unit_sword_tec_level` int unsigned DEFAULT '0',
  `unit_axe_tec_level` int unsigned DEFAULT '0',
  `unit_archer_tec_level` int unsigned DEFAULT '1',
  `unit_spy_tec_level` int unsigned DEFAULT '1',
  `unit_light_tec_level` int unsigned DEFAULT '0',
  `unit_marcher_tec_level` int unsigned DEFAULT '0',
  `unit_heavy_tec_level` int unsigned DEFAULT '0',
  `unit_ram_tec_level` int unsigned DEFAULT '0',
  `unit_catapult_tec_level` int unsigned DEFAULT '0',
  `unit_knight_tec_level` int unsigned DEFAULT '1',
  `unit_snob_tec_level` int unsigned DEFAULT '1',
  `trader_away` int unsigned DEFAULT '0',
  `main_build` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `all_unit_spear` int unsigned NOT NULL DEFAULT '0',
  `all_unit_sword` int unsigned DEFAULT '0',
  `all_unit_axe` int unsigned DEFAULT '0',
  `all_unit_archer` int unsigned DEFAULT '0',
  `all_unit_spy` int unsigned DEFAULT '0',
  `all_unit_light` int unsigned DEFAULT '0',
  `all_unit_marcher` int unsigned DEFAULT '0',
  `all_unit_heavy` int unsigned DEFAULT '0',
  `all_unit_ram` int unsigned DEFAULT '0',
  `all_unit_catapult` int unsigned DEFAULT '0',
  `all_unit_knight` int unsigned DEFAULT '0',
  `all_unit_snob` int unsigned DEFAULT '0',
  `recruited_snobs` int unsigned DEFAULT '0',
  `control_villages` int unsigned DEFAULT '0',
  `attacks` int unsigned DEFAULT '0',
  `agreement` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '100',
  `agreement_aktu` int unsigned NOT NULL,
  `snobed_by` int DEFAULT '-1',
  `dealers_outside` int unsigned NOT NULL DEFAULT '0',
  `create_time` int unsigned NOT NULL,
  `smith_tec` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `conmap_con` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `l_grow` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x_2` (`x`,`y`),
  KEY `name` (`name`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=518 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `villages`
--

LOCK TABLES `villages` WRITE;
/*!40000 ALTER TABLE `villages` DISABLE KEYS */;
INSERT INTO `villages` VALUES (22,500,501,2,'001+%7C+TT',1,400720,400640,400624,24390,1695467421,10372,55,21,25,20,15,3,20,1,1,21,30,30,30,30,30,10,20,1,0,1,1,1,1,0,0,1,0,1,1,0,'',0,0,7284,0,1118,1471,0,0,1213,0,0,3,3,4,0,'100',0,-1,0,1416476927,'','','',0),(23,500,499,0,'002+%7C+TT',1,400720,400640,400624,11473,1416908222,10720,45,20,25,20,15,3,20,1,1,25,30,30,30,30,30,10,20,1,1,0,1,1,0,0,1,0,0,1,1,0,'',3096,3923,0,0,0,0,0,3,0,0,0,4,4,0,0,'100',1416559587,22,0,1416476927,'','','',1416478614),(24,501,502,0,'004+%7C+TT',1,11108.972222213,11028.972222213,145484.94444442,6243,1416908215,9179,55,30,25,20,15,1,20,1,1,25,24,29,22,28,23,10,20,1,1,0,1,1,0,0,1,0,1,1,1,0,'',500,500,0,0,500,0,0,100,0,20,0,0,0,0,0,'24.441666666666',1416841493,22,0,1416476927,'','','',1416478629),(25,499,502,0,'003+%7C+TT',1,180180.66666667,180100.66666667,314893.66666667,17469,1416908221,12379,54,30,25,20,15,3,20,1,1,25,30,30,30,30,30,10,20,1,0,1,1,1,0,0,0,1,0,1,1,0,'',969,0,2208,0,0,0,0,0,1976,0,0,0,0,0,0,'100',1416569771,22,0,1416476927,'','','',1416478641),(226,497,503,0,'Aldeia+de+Ukiraki',2,1177.77777777775,1083.11111111109,2041.2777777777,42,1416570051,100,54,5,0,0,0,0,0,1,0,0,8,6,7,6,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416566789,'','','',0),(284,502,498,0,'Barbarendorp',-1,1220,1140,1024,142,1416839358,403,45,5,7,9,7,0,4,1,0,6,8,3,6,10,6,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839441),(285,504,502,0,'Barbarendorp',-1,1220,1140,1024,169,1416839358,404,55,8,0,9,8,0,5,1,0,7,7,6,8,10,5,8,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839444),(286,500,497,0,'Barbarendorp',-1,1220,1140,1024,182,1416839358,404,45,8,5,7,5,0,6,1,0,9,4,4,3,9,9,4,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839442),(287,500,498,0,'Barbarendorp',-1,1220,1140,1024,198,1416839358,403,45,6,4,9,3,0,7,1,0,8,4,6,9,8,10,9,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839445),(288,498,495,0,'Barbarendorp',-1,1220,1140,1024,210,1416839358,402,44,7,8,8,2,0,7,1,0,10,4,3,7,9,4,9,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839442),(289,495,498,0,'Barbarendorp',-1,1220,1140,1024,241,1416839358,410,44,6,7,8,2,0,11,1,0,4,6,7,3,8,6,4,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839437),(290,500,502,0,'Barbarendorp',-1,1220,1140,1024,202,1416839358,403,55,6,7,8,4,0,7,1,0,8,5,6,8,3,10,6,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839449),(291,501,496,0,'Barbarendorp',-1,1220,1140,1024,186,1416839358,408,45,9,9,6,6,0,7,1,0,5,4,3,9,8,5,6,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839442),(292,501,505,0,'Barbarendorp',-1,1220,1140,1024,123,1416839358,402,55,8,3,9,9,0,3,1,0,3,7,5,4,5,7,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839441),(293,498,500,0,'Barbarendorp',-1,1220,1140,1024,164,1416839358,406,54,6,9,7,5,0,4,1,0,9,9,6,3,10,7,8,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839358,'','','',1416839445),(294,502,508,6,'Bonusdorp',-1,1220,1140,1024,195,1416839371,401,55,7,8,2,5,0,5,1,0,9,6,6,10,9,7,7,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839463),(295,496,502,6,'Bonusdorp',-1,1220,1140,1024,151,1416839371,404,54,6,4,5,10,0,4,1,0,6,11,6,6,4,7,6,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839457),(296,502,494,6,'Bonusdorp',-1,1220,1140,1024,227,1416839371,402,45,10,9,5,0,0,10,1,0,5,4,7,5,9,11,6,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839457),(297,505,506,6,'Bonusdorp',-1,1220,1140,1024,281,1416839371,414,55,4,3,5,6,0,11,1,0,8,9,8,8,6,3,4,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839453),(298,498,504,6,'Bonusdorp',-1,1220,1140,1024,175,1416839371,403,54,11,6,8,4,0,4,1,0,7,5,10,7,3,4,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839457),(299,505,495,6,'Bonusdorp',-1,1220,1140,1024,138,1416839371,402,45,10,3,5,10,0,3,1,0,6,6,4,5,5,6,7,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839452),(300,507,504,6,'Bonusdorp',-1,1220,1140,1024,170,1416839371,401,55,5,6,9,8,0,7,1,0,4,5,8,3,4,3,8,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839450),(301,498,505,6,'Bonusdorp',-1,1220,1140,1024,162,1416839371,404,54,11,6,7,7,0,3,1,0,7,4,5,9,5,4,7,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839456),(302,506,498,6,'Bonusdorp',-1,1220,1140,1024,174,1416839371,403,45,13,6,4,4,0,3,1,0,9,7,7,8,7,8,8,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839459),(303,500,495,6,'Bonusdorp',-1,1220,1140,1024,140,1416839371,405,45,8,5,5,9,0,2,1,0,6,3,11,5,7,10,8,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839458),(304,508,502,6,'Bonusdorp',-1,1220,1140,1024,173,1416839371,403,55,7,4,9,5,0,6,1,0,6,9,6,8,10,7,7,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839463),(305,495,503,6,'Bonusdorp',-1,1220,1140,1024,290,1416839371,405,54,8,6,3,3,0,10,1,0,12,6,5,7,5,3,7,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839450),(306,501,493,6,'Bonusdorp',-1,1220,1140,1024,182,1416839371,402,45,5,8,8,5,0,6,1,0,7,3,3,8,6,4,9,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839452),(307,498,493,6,'Bonusdorp',-1,1220,1140,1024,180,1416839371,403,44,7,4,8,8,0,6,1,0,7,2,5,9,6,7,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839454),(308,500,508,6,'Bonusdorp',-1,1220,1140,1024,177,1416839371,404,55,6,4,12,5,0,8,1,0,4,2,3,5,5,5,4,1,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839436),(309,500,506,6,'Bonusdorp',-1,1220,1140,1024,208,1416839371,412,55,6,5,3,8,0,9,1,0,5,9,9,4,5,10,10,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839458),(310,503,492,6,'Bonusdorp',-1,1220,1140,1024,176,1416839371,403,45,8,9,5,7,0,5,1,0,6,9,8,9,4,7,7,1,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839454),(311,495,494,6,'Bonusdorp',-1,1220,1140,1024,192,1416839371,404,44,7,7,7,5,0,7,1,0,8,4,6,5,10,5,9,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839465),(312,503,511,6,'Bonusdorp',-1,1220,1140,1024,200,1416839371,401,55,7,5,7,7,0,8,1,0,3,9,7,9,4,4,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839456),(313,497,506,6,'Bonusdorp',-1,1220,1140,1024,206,1416839371,405,54,10,6,6,4,0,7,1,0,5,10,11,7,1,2,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839461),(314,506,493,6,'Bonusdorp',-1,1220,1140,1024,146,1416839371,401,45,9,7,9,4,0,1,1,0,8,9,4,7,7,9,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839459),(315,494,496,6,'Bonusdorp',-1,1220,1140,1024,158,1416839371,403,44,9,10,3,6,0,3,1,0,5,4,3,12,7,8,10,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839455),(316,506,509,6,'Bonusdorp',-1,1220,1140,1024,221,1416839371,403,55,8,4,5,3,0,9,1,0,4,9,9,10,7,11,8,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839464),(317,493,504,6,'Bonusdorp',-1,1220,1140,1024,179,1416839371,403,54,9,3,5,8,0,7,1,0,6,5,4,4,2,9,8,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839453),(318,508,495,6,'Bonusdorp',-1,1220,1140,1024,240,1416839371,411,45,5,4,5,8,0,10,1,0,5,6,4,11,7,5,4,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839451),(319,492,499,6,'Bonusdorp',-1,1220,1140,1024,193,1416839371,401,44,6,10,5,4,0,7,1,0,7,6,7,5,5,6,10,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839461),(320,508,508,6,'Bonusdorp',-1,1220,1140,1024,154,1416839371,401,55,8,5,8,6,0,6,1,0,3,8,7,5,9,9,9,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839464),(321,492,501,6,'005+%7C+TT',1,969.33333333322,889.33333333322,2123.3333333332002,198,1416908199,442,54,5,6,3,10,0,3,1,0,10,10,10,9,8,5,8,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1416908183,22,0,1416839371,'','','',1416839453),(322,508,500,6,'Bonusdorp',-1,1220,1140,1024,173,1416839371,409,55,10,5,4,5,0,5,1,0,6,8,3,9,5,11,10,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839468),(323,498,491,6,'Bonusdorp',-1,1220,1140,1024,223,1416839371,405,44,8,6,7,5,0,9,1,0,7,5,3,9,8,5,7,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839371,'','','',1416839457),(324,509,506,0,'Barbarendorp',-1,1220,1140,1024,173,1416839783,401,55,7,5,7,8,0,5,1,0,8,11,5,4,4,4,5,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839866),(325,498,506,0,'Barbarendorp',-1,1220,1140,1024,194,1416839783,405,54,5,4,3,7,0,7,1,0,9,8,5,4,9,10,10,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839878),(326,502,492,0,'Barbarendorp',-1,1220,1140,1024,207,1416839783,401,45,6,5,7,5,0,8,1,0,8,5,3,8,10,7,6,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839872),(327,498,490,0,'Barbarendorp',-1,1220,1140,1024,156,1416839783,402,44,8,5,3,5,0,6,1,0,5,8,7,7,14,10,5,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839877),(328,510,503,0,'Barbarendorp',-1,1220,1140,1024,189,1416839783,404,55,9,7,9,5,0,7,1,0,4,5,9,7,2,5,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839864),(329,497,507,0,'Barbarendorp',-1,1220,1140,1024,192,1416839783,402,54,7,6,4,8,0,6,1,0,8,6,10,6,7,3,8,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839870),(330,503,489,0,'Barbarendorp',-1,1220,1140,1024,215,1416839783,401,45,5,6,3,8,0,8,1,0,5,5,6,13,6,9,5,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839865),(331,495,492,0,'Barbarendorp',-1,1220,1140,1024,174,1416839783,402,44,5,5,10,5,0,6,1,0,6,4,4,8,8,6,7,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839870),(332,511,500,0,'Barbarendorp',-1,1220,1140,1024,168,1416839783,421,55,5,3,6,10,0,6,1,0,6,8,5,6,10,2,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839869),(333,494,505,0,'Barbarendorp',-1,1220,1140,1024,160,1416839783,401,54,4,4,10,5,0,5,1,0,6,4,6,7,9,7,9,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839870),(334,506,491,0,'Barbarendorp',-1,1220,1140,1024,203,1416839783,410,45,9,10,5,2,0,7,1,0,10,3,3,4,8,10,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839868),(335,492,494,0,'Barbarendorp',-1,1220,1140,1024,149,1416839783,403,44,8,10,3,8,0,3,1,0,6,6,4,9,8,5,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839869),(336,502,511,0,'Barbarendorp',-1,1220,1140,1024,207,1416839783,404,55,5,7,9,5,0,9,1,0,5,5,2,8,3,8,6,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839861),(337,493,503,0,'Barbarendorp',-1,1220,1140,1024,161,1416839783,403,54,4,7,3,10,0,4,1,0,9,9,5,3,7,4,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839868),(338,509,492,0,'Barbarendorp',-1,1220,1140,1024,268,1416839783,402,45,6,6,4,4,0,11,1,0,8,5,8,6,6,8,6,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839867),(339,490,496,0,'Barbarendorp',-1,1220,1140,1024,193,1416839783,405,44,4,6,6,7,0,7,1,0,9,2,9,3,10,9,8,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839869),(340,503,514,0,'Barbarendorp',-1,1220,1140,1024,156,1416839783,402,55,6,7,4,8,0,4,1,0,4,4,7,10,7,9,10,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839874),(341,499,508,0,'Barbarendorp',-1,1220,1140,1024,188,1416839783,410,54,9,3,11,4,0,7,1,0,7,4,8,2,5,4,9,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839861),(342,511,496,0,'Barbarendorp',-1,1220,1140,1024,161,1416839783,406,45,8,8,6,7,0,7,1,0,2,7,7,4,9,8,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839869),(343,489,498,0,'Barbarendorp',-1,1220,1140,1024,188,1416839783,401,44,8,5,6,5,0,4,1,0,9,10,5,9,8,3,8,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839881),(344,506,512,0,'Barbarendorp',-1,1220,1140,1024,134,1416839783,404,55,6,9,5,9,0,3,1,0,6,4,6,6,11,5,7,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839865),(345,497,512,0,'Barbarendorp',-1,1220,1140,1024,132,1416839783,408,54,7,6,8,10,0,2,1,0,4,5,4,9,6,4,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839859),(346,512,499,0,'Barbarendorp',-1,1220,1140,1024,160,1416839783,403,45,8,9,3,6,0,4,1,0,8,6,8,7,12,7,4,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839872),(347,496,491,0,'Barbarendorp',-1,1220,1140,1024,228,1416839783,404,44,8,1,4,7,0,10,1,0,8,5,2,4,3,12,6,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839861),(348,509,510,0,'Barbarendorp',-1,1220,1140,1024,183,1416839783,402,55,10,3,7,5,0,8,1,0,3,7,7,2,7,7,4,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839868),(349,495,509,0,'Barbarendorp',-1,1220,1140,1024,128,1416839783,405,54,5,7,7,4,0,4,1,0,3,8,6,6,14,8,10,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839876),(350,506,489,0,'Barbarendorp',-1,1220,1140,1024,178,1416839783,404,45,7,5,6,4,0,5,1,0,9,8,8,5,11,11,6,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839878),(351,497,489,0,'Barbarendorp',-1,1220,1140,1024,179,1416839783,401,44,7,6,7,4,0,7,1,0,7,11,2,6,7,12,4,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839875),(352,512,508,0,'Barbarendorp',-1,1220,1140,1024,190,1416839783,401,55,6,4,2,3,0,7,1,0,5,5,4,6,8,7,7,16,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839864),(353,492,508,0,'Barbarendorp',-1,1220,1140,1024,170,1416839783,404,54,2,6,7,10,0,7,1,0,5,6,7,4,4,5,5,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839859),(354,508,491,0,'Barbarendorp',-1,1220,1140,1024,189,1416839783,405,45,8,3,7,4,0,7,1,0,7,9,8,6,9,11,7,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839879),(355,493,490,0,'Barbarendorp',-1,1220,1140,1024,159,1416839783,421,44,7,8,4,10,0,4,1,0,5,7,8,9,6,7,4,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839873),(356,513,506,0,'Barbarendorp',-1,1220,1140,1024,154,1416839783,402,55,6,11,4,6,0,4,1,0,6,8,5,7,6,8,9,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839873),(357,491,505,0,'Barbarendorp',-1,1220,1140,1024,219,1416839783,404,54,7,3,8,5,0,7,1,0,10,4,5,8,7,4,10,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839874),(358,510,494,0,'Barbarendorp',-1,1220,1140,1024,190,1416839783,401,45,8,8,6,5,0,6,1,0,6,4,7,11,7,9,6,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839876),(359,491,492,0,'Barbarendorp',-1,1220,1140,1024,202,1416839783,407,44,4,7,4,8,0,5,1,0,8,8,8,12,6,6,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839871),(360,514,502,0,'Barbarendorp',-1,1220,1140,1024,180,1416839783,401,55,9,6,5,4,0,6,1,0,7,10,4,7,8,10,6,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839877),(361,489,504,0,'Barbarendorp',-1,1220,1140,1024,185,1416839783,402,54,9,5,8,4,0,6,1,0,7,8,7,6,7,6,8,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839875),(362,512,497,0,'Barbarendorp',-1,1220,1140,1024,177,1416839783,403,45,7,7,10,2,0,7,1,0,2,7,7,7,5,6,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839867),(363,490,495,0,'Barbarendorp',-1,1220,1140,1024,181,1416839783,404,44,9,7,1,8,0,7,1,0,6,7,8,5,7,9,9,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839783,'','','',1416839873),(364,507,514,1,'Bonusdorp',-1,1220,1140,1024,198,1416839789,401,55,7,6,7,2,0,5,1,0,11,8,6,6,11,7,8,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839885),(365,496,512,1,'Bonusdorp',-1,1220,1140,1024,188,1416839789,405,54,3,8,10,2,0,6,1,0,7,9,7,8,6,7,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839875),(366,503,488,1,'Bonusdorp',-1,1220,1140,1024,219,1416839789,403,45,9,8,7,3,0,9,1,0,6,6,6,7,6,4,7,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839873),(367,488,497,1,'Bonusdorp',-1,1220,1140,1024,226,1416839789,401,44,5,7,4,7,0,9,1,0,9,7,5,4,7,5,6,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839871),(368,509,513,1,'Bonusdorp',-1,1220,1140,1024,157,1416839789,403,55,4,5,7,7,0,2,1,0,6,9,7,11,8,9,10,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839886),(369,497,513,1,'Bonusdorp',-1,1220,1140,1024,203,1416839789,403,54,9,8,6,6,0,9,1,0,6,2,5,4,9,4,6,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839868),(370,504,487,1,'Bonusdorp',-1,1220,1140,1024,162,1416839789,406,45,8,5,8,6,0,4,1,0,9,5,7,3,10,8,9,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839881),(371,494,488,1,'Bonusdorp',-1,1220,1140,1024,219,1416839789,403,44,6,4,6,5,0,7,1,0,9,2,8,11,11,5,10,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839884),(372,512,510,1,'Bonusdorp',-1,1220,1140,1024,151,1416839789,418,55,7,4,11,4,0,4,1,0,4,3,7,9,7,11,10,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839885),(373,494,511,1,'Bonusdorp',-1,1220,1140,1024,152,1416839789,405,54,9,5,1,10,0,4,1,0,8,5,3,4,8,6,8,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839870),(374,508,488,1,'Bonusdorp',-1,1220,1140,1024,193,1416839789,407,45,9,4,6,6,0,7,1,0,8,7,7,3,9,6,10,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839884),(375,492,491,1,'Bonusdorp',-1,1220,1140,1024,153,1416839789,403,44,7,1,10,7,0,5,1,0,5,11,5,5,4,9,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839871),(376,514,507,1,'Bonusdorp',-1,1220,1140,1024,170,1416839789,404,55,6,8,3,7,0,7,1,0,4,9,2,6,10,6,7,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839882),(377,492,510,1,'Bonusdorp',-1,1220,1140,1024,166,1416839789,402,54,8,7,3,8,0,6,1,0,5,5,12,3,5,11,4,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839874),(378,510,490,1,'Bonusdorp',-1,1220,1140,1024,271,1416839789,401,45,5,8,3,5,0,11,1,0,9,5,5,6,5,6,5,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839866),(379,490,494,1,'Bonusdorp',-1,1220,1140,1024,172,1416839789,402,44,11,6,5,5,0,6,1,0,6,10,5,2,4,7,9,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839877),(380,515,504,1,'Bonusdorp',-1,1220,1140,1024,211,1416839789,401,55,6,4,9,6,0,10,1,0,5,6,3,1,7,2,4,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839858),(381,490,508,1,'Bonusdorp',-1,1220,1140,1024,196,1416839789,402,54,3,7,5,9,0,7,1,0,8,4,4,8,4,6,10,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839873),(382,512,493,1,'Bonusdorp',-1,1220,1140,1024,165,1416839789,403,45,4,9,10,4,0,6,1,0,6,5,5,5,8,7,4,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839870),(383,487,495,1,'Bonusdorp',-1,1220,1140,1024,146,1416839789,409,44,7,5,6,8,0,7,1,0,3,3,4,1,11,11,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839789,'','','',1416839873),(384,516,502,0,'Barbarendorp',-1,1220,1140,1024,181,1416839792,409,55,7,5,6,7,0,6,1,0,7,8,7,8,9,10,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839887),(385,488,506,0,'Barbarendorp',-1,1220,1140,1024,193,1416839792,404,54,6,2,8,4,0,9,1,0,2,10,6,7,5,13,8,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839877),(386,514,497,0,'Barbarendorp',-1,1220,1140,1024,225,1416839792,411,45,7,2,6,7,0,9,1,0,8,6,7,4,2,10,6,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839883),(387,487,498,0,'Barbarendorp',-1,1220,1140,1024,158,1416839792,405,44,8,8,8,5,0,3,1,0,8,4,8,7,10,8,7,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839882),(388,504,515,0,'Barbarendorp',-1,1220,1140,1024,226,1416839792,405,55,7,3,9,1,0,8,1,0,10,6,4,7,6,9,10,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839879),(389,487,504,0,'Barbarendorp',-1,1220,1140,1024,153,1416839792,405,54,10,7,5,7,0,3,1,0,9,6,4,3,11,5,6,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839877),(390,514,499,0,'Barbarendorp',-1,1220,1140,1024,193,1416839792,404,45,5,5,8,5,0,7,1,0,8,6,9,3,7,9,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839887),(391,500,487,0,'Barbarendorp',-1,1220,1140,1024,174,1416839792,404,45,4,10,6,6,0,6,1,0,4,9,5,9,8,3,8,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839884),(392,503,518,0,'Barbarendorp',-1,1220,1140,1024,233,1416839792,402,55,9,5,3,7,0,9,1,0,6,5,8,10,4,5,5,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839879),(393,487,501,0,'Barbarendorp',-1,1220,1140,1024,209,1416839792,402,54,7,9,1,4,0,6,1,0,9,8,9,7,5,7,10,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839892),(394,506,486,0,'Barbarendorp',-1,1220,1140,1024,197,1416839792,401,45,5,5,6,8,0,7,1,0,6,6,12,6,5,3,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839877),(395,497,487,0,'Barbarendorp',-1,1220,1140,1024,174,1416839792,401,44,7,7,8,7,0,7,1,0,5,4,7,4,7,5,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839874),(396,507,517,0,'Barbarendorp',-1,1220,1140,1024,155,1416839792,402,55,2,4,5,10,0,4,1,0,8,6,6,6,7,8,8,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839877),(397,495,512,0,'Barbarendorp',-1,1220,1140,1024,208,1416839792,401,54,10,7,7,3,0,9,1,0,4,9,6,6,6,5,4,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839877),(398,502,486,0,'Barbarendorp',-1,1220,1140,1024,179,1416839792,406,45,8,4,5,8,0,7,1,0,6,7,3,8,9,9,8,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839886),(399,494,489,0,'Barbarendorp',-1,1220,1140,1024,154,1416839792,403,44,6,7,9,6,0,5,1,0,5,6,10,3,7,9,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839877),(400,510,515,0,'Barbarendorp',-1,1220,1140,1024,178,1416839792,404,55,8,7,8,6,0,8,1,0,1,6,4,7,8,5,3,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839870),(401,496,516,0,'Barbarendorp',-1,1220,1140,1024,156,1416839792,403,54,11,3,6,7,0,5,1,0,5,6,7,5,4,10,9,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839887),(402,506,485,0,'Barbarendorp',-1,1220,1140,1024,167,1416839792,401,45,5,3,8,8,0,1,1,0,11,10,7,5,9,3,6,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839869),(403,490,490,0,'Barbarendorp',-1,1220,1140,1024,115,1416839792,407,44,5,11,2,8,0,2,1,0,5,5,4,6,13,6,9,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839872),(404,512,513,0,'Barbarendorp',-1,1220,1140,1024,168,1416839792,404,55,8,7,8,5,0,5,1,0,6,5,11,3,5,8,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839882),(405,493,513,0,'Barbarendorp',-1,1220,1140,1024,167,1416839792,407,54,6,3,7,3,0,7,1,0,5,10,6,8,15,8,5,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839878),(406,508,486,0,'Barbarendorp',-1,1220,1140,1024,150,1416839792,421,45,6,3,11,7,0,3,1,0,7,8,6,7,10,6,2,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839873),(407,488,492,0,'Barbarendorp',-1,1220,1140,1024,166,1416839792,402,44,5,8,8,2,0,3,1,0,9,6,7,5,10,5,10,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839884),(408,514,511,0,'Barbarendorp',-1,1220,1140,1024,170,1416839792,404,55,6,10,5,8,0,5,1,0,5,2,10,8,3,4,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839873),(409,491,513,0,'Barbarendorp',-1,1220,1140,1024,144,1416839792,403,54,8,6,8,7,0,5,1,0,3,8,2,5,7,6,10,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839879),(410,510,489,0,'Barbarendorp',-1,1220,1140,1024,196,1416839792,408,45,4,7,2,6,0,7,1,0,9,4,9,6,14,2,10,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839889),(411,486,497,0,'Barbarendorp',-1,1220,1140,1024,238,1416839792,409,44,8,3,5,5,0,7,1,0,12,8,7,6,8,8,8,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839885),(412,516,508,0,'Barbarendorp',-1,1220,1140,1024,192,1416839792,405,55,4,7,8,5,0,6,1,0,6,8,11,9,9,4,7,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839882),(413,490,509,0,'Barbarendorp',-1,1220,1140,1024,138,1416839792,406,54,7,8,6,9,0,4,1,0,4,8,6,5,7,8,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839884),(414,511,490,0,'Barbarendorp',-1,1220,1140,1024,148,1416839792,402,45,6,5,2,10,0,5,1,0,6,4,10,2,6,11,9,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839879),(415,496,488,0,'Barbarendorp',-1,1220,1140,1024,165,1416839792,407,44,8,9,6,9,0,6,1,0,6,6,4,5,6,3,2,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839868),(416,517,506,0,'Barbarendorp',-1,1220,1140,1024,170,1416839792,403,55,8,6,7,5,0,6,1,0,5,7,7,6,8,9,7,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839890),(417,486,502,0,'Barbarendorp',-1,1220,1140,1024,170,1416839792,403,54,8,9,7,5,0,5,1,0,7,8,6,6,7,5,10,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839881),(418,514,492,0,'Barbarendorp',-1,1220,1140,1024,138,1416839792,412,45,10,6,4,10,0,4,1,0,5,3,1,7,5,10,6,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839792,'','','',1416839871),(419,496,483,0,'Barbarendorp',-1,1220,1140,1024,215,1416839793,403,44,8,7,4,6,0,8,1,0,9,5,9,4,7,8,9,1,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839793,'','','',1416839881),(420,518,503,0,'Barbarendorp',-1,1220,1140,1024,133,1416839793,404,55,8,7,4,10,0,4,1,0,2,7,8,6,9,3,6,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839793,'','','',1416839874),(421,498,515,0,'Barbarendorp',-1,1220,1140,1024,172,1416839793,405,54,6,9,5,8,0,5,1,0,5,6,7,10,4,7,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839793,'','','',1416839877),(422,514,495,0,'Barbarendorp',-1,1220,1140,1024,139,1416839793,401,45,7,5,8,8,0,3,1,0,7,7,5,4,4,11,8,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839793,'','','',1416839884),(423,494,484,0,'Barbarendorp',-1,1220,1140,1024,190,1416839793,415,44,1,3,11,5,0,6,1,0,9,6,9,3,7,8,6,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839793,'','','',1416839886),(424,506,517,3,'Bonusdorp',-1,1220,1140,1024,159,1416839798,414,55,8,10,6,9,0,5,1,0,7,5,5,2,5,3,4,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839872),(425,498,517,3,'Bonusdorp',-1,1220,1140,1024,166,1416839798,402,54,9,7,10,2,0,6,1,0,4,10,2,7,5,7,6,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839883),(426,516,497,3,'Bonusdorp',-1,1220,1140,1024,139,1416839798,401,45,5,6,3,6,0,5,1,0,3,7,8,5,14,7,4,12,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839889),(427,491,484,3,'Bonusdorp',-1,1220,1140,1024,176,1416839798,404,44,6,4,3,5,0,5,1,0,7,6,8,7,10,9,10,13,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839902),(428,503,520,3,'Bonusdorp',-1,1220,1140,1024,178,1416839798,405,55,10,7,5,4,0,5,1,0,7,5,7,9,10,8,7,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839895),(429,494,517,3,'Bonusdorp',-1,1220,1140,1024,151,1416839798,402,54,12,2,4,7,0,5,1,0,3,12,6,6,9,4,5,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839884),(430,510,487,3,'Bonusdorp',-1,1220,1140,1024,211,1416839798,402,45,5,3,3,8,0,7,1,0,10,4,8,6,7,9,7,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839888),(431,489,488,3,'Bonusdorp',-1,1220,1140,1024,206,1416839798,402,44,8,6,7,3,0,8,1,0,5,7,11,8,9,8,5,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839889),(432,506,519,3,'Bonusdorp',-1,1220,1140,1024,179,1416839798,403,55,6,4,7,6,0,6,1,0,6,9,9,7,7,10,7,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839893),(433,491,515,3,'Bonusdorp',-1,1220,1140,1024,181,1416839798,404,54,9,10,5,4,0,6,1,0,3,9,8,8,2,5,4,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839798,'','','',1416839885),(434,515,492,2,'Bonusdorp',-1,1220,1140,1024,150,1416839803,414,45,6,4,6,8,0,5,1,0,7,4,3,8,13,11,8,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839891),(435,488,490,2,'Bonusdorp',-1,1220,1140,1024,239,1416839803,401,44,8,4,5,5,0,8,1,0,11,5,7,5,5,8,5,9,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839891),(436,508,518,2,'Bonusdorp',-1,1220,1140,1024,233,1416839803,414,55,7,7,6,5,0,9,1,0,5,6,8,11,6,8,5,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839896),(437,489,513,2,'Bonusdorp',-1,1220,1140,1024,172,1416839803,401,54,6,8,7,5,0,5,1,0,5,9,12,5,8,4,6,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839896),(438,515,495,2,'Bonusdorp',-1,1220,1140,1024,129,1416839803,401,45,9,8,9,8,0,3,1,0,3,3,2,8,3,7,7,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839881),(439,486,492,2,'Bonusdorp',-1,1220,1140,1024,160,1416839803,418,44,8,5,4,11,0,4,1,0,8,4,7,6,5,7,8,1,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839882),(440,510,517,2,'Bonusdorp',-1,1220,1140,1024,245,1416839803,404,55,7,4,3,5,0,10,1,0,6,6,9,6,5,4,10,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839893),(441,487,511,2,'Bonusdorp',-1,1220,1140,1024,118,1416839803,404,54,8,4,8,10,0,1,1,0,5,6,8,4,8,5,5,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839885),(442,515,499,2,'Bonusdorp',-1,1220,1140,1024,206,1416839803,405,45,4,10,3,5,0,5,1,0,11,10,3,9,8,7,2,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839893),(443,485,495,2,'Bonusdorp',-1,1220,1140,1024,157,1416839803,402,44,8,9,4,6,0,5,1,0,3,7,6,10,9,9,10,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839803,'','','',1416839898),(444,513,515,4,'Bonusdorp',-1,1220,1140,1024,171,1416839808,401,55,8,7,10,2,0,5,1,0,6,10,5,8,5,4,10,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839808,'','','',1416839893),(445,484,508,4,'Bonusdorp',-1,1220,1140,1024,172,1416839808,403,54,9,8,6,4,0,5,1,0,7,8,7,3,7,6,7,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839808,'','','',1416839900),(446,503,483,4,'Bonusdorp',-1,1220,1140,1024,221,1416839808,402,45,5,8,8,5,0,9,1,0,8,4,7,3,5,4,6,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839808,'','','',1416839884),(447,483,497,4,'Bonusdorp',-1,1220,1140,1024,160,1416839808,406,44,7,6,8,7,0,5,1,0,3,4,4,9,6,5,8,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839808,'','','',1416839897),(448,515,513,4,'Bonusdorp',-1,1220,1140,1024,201,1416839808,409,55,7,10,8,1,0,5,1,0,10,6,9,6,7,4,6,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839808,'','','',1416839891),(449,483,505,5,'Bonusdorp',-1,1220,1140,1024,218,1416839811,408,54,6,4,6,8,0,9,1,0,7,6,4,7,6,4,10,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839811,'','','',1416839899),(450,503,482,5,'Bonusdorp',-1,1220,1140,1024,175,1416839811,408,45,10,7,6,5,0,4,1,0,8,13,8,5,4,7,8,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839811,'','','',1416839906),(451,483,500,5,'Bonusdorp',-1,1220,1140,1024,195,1416839811,402,54,10,6,5,5,0,6,1,0,7,9,11,6,4,7,5,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839811,'','','',1416839905),(452,517,510,5,'Bonusdorp',-1,1220,1140,1024,199,1416839811,404,55,8,5,7,4,0,6,1,0,8,7,9,7,9,3,7,10,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839811,'','','',1416839904),(453,482,502,5,'Bonusdorp',-1,1220,1140,1024,171,1416839811,402,54,8,9,2,7,0,6,1,0,6,4,7,6,7,8,9,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839811,'','','',1416839904),(454,507,483,0,'Barbarendorp',-1,1220,1140,1024,202,1416839815,407,45,9,8,4,6,0,8,1,0,6,6,9,4,6,6,9,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839902),(455,494,483,0,'Barbarendorp',-1,1220,1140,1024,183,1416839815,404,44,9,9,5,5,0,6,1,0,9,8,3,5,10,7,4,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839900),(456,519,507,0,'Barbarendorp',-1,1220,1140,1024,154,1416839815,421,55,3,5,11,8,0,6,1,0,1,1,5,8,7,8,6,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839896),(457,494,516,0,'Barbarendorp',-1,1220,1140,1024,185,1416839815,403,54,8,5,3,7,0,5,1,0,7,7,12,9,10,6,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839911),(458,509,486,0,'Barbarendorp',-1,1220,1140,1024,167,1416839815,403,45,6,4,7,8,0,5,1,0,4,3,7,11,7,9,9,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839909),(459,497,481,0,'Barbarendorp',-1,1220,1140,1024,172,1416839815,403,44,8,10,3,6,0,6,1,0,3,10,5,10,6,8,7,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839901),(460,519,505,0,'Barbarendorp',-1,1220,1140,1024,192,1416839815,404,55,5,11,3,4,0,7,1,0,7,4,4,8,4,10,10,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839910),(461,497,520,0,'Barbarendorp',-1,1220,1140,1024,227,1416839815,414,54,7,7,5,7,0,9,1,0,4,4,6,11,5,6,4,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839899),(462,511,487,0,'Barbarendorp',-1,1220,1140,1024,209,1416839815,402,45,9,5,6,5,0,9,1,0,3,6,5,10,5,11,7,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839904),(463,494,482,0,'Barbarendorp',-1,1220,1140,1024,168,1416839815,402,44,7,8,9,5,0,4,1,0,6,6,10,8,4,6,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839907),(464,520,502,0,'Barbarendorp',-1,1220,1140,1024,132,1416839815,405,55,4,10,6,8,0,4,1,0,3,6,6,5,6,10,7,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839907),(465,493,519,0,'Barbarendorp',-1,1220,1140,1024,215,1416839815,408,54,6,8,9,4,0,8,1,0,9,5,4,4,2,7,5,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839898),(466,513,489,0,'Barbarendorp',-1,1220,1140,1024,185,1416839815,409,45,7,8,7,5,0,7,1,0,6,6,9,4,5,11,6,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839911),(467,491,483,0,'Barbarendorp',-1,1220,1140,1024,186,1416839815,402,44,5,10,4,7,0,8,1,0,5,5,7,4,3,9,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839900),(468,506,520,0,'Barbarendorp',-1,1220,1140,1024,230,1416839815,410,55,9,4,5,8,0,9,1,0,9,0,6,5,4,7,9,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839895),(469,490,517,0,'Barbarendorp',-1,1220,1140,1024,214,1416839815,406,54,5,6,5,7,0,7,1,0,9,6,12,6,5,9,5,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839903),(470,517,491,0,'Barbarendorp',-1,1220,1140,1024,215,1416839815,403,45,5,7,7,1,0,9,1,0,5,7,9,5,6,9,10,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839912),(471,488,484,0,'Barbarendorp',-1,1220,1140,1024,154,1416839815,403,44,6,7,3,3,0,7,1,0,4,8,6,3,15,7,10,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839905),(472,509,519,0,'Barbarendorp',-1,1220,1140,1024,168,1416839815,410,55,6,10,5,5,0,6,1,0,5,5,8,7,9,11,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839912),(473,488,516,0,'Barbarendorp',-1,1220,1140,1024,186,1416839815,402,54,6,6,9,6,0,7,1,0,7,3,6,8,9,6,4,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839897),(474,516,494,0,'Barbarendorp',-1,1220,1140,1024,211,1416839815,403,45,4,6,7,6,0,9,1,0,5,7,9,4,7,4,8,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839904),(475,486,487,0,'Barbarendorp',-1,1220,1140,1024,162,1416839815,401,44,7,9,5,8,0,5,1,0,8,6,8,2,9,6,3,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839897),(476,511,518,0,'Barbarendorp',-1,1220,1140,1024,179,1416839815,402,55,7,9,4,7,0,5,1,0,9,7,7,5,7,7,9,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839910),(477,485,514,0,'Barbarendorp',-1,1220,1140,1024,208,1416839815,403,54,8,6,4,7,0,7,1,0,8,4,9,9,8,6,7,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839910),(478,517,497,0,'Barbarendorp',-1,1220,1140,1024,165,1416839815,402,45,6,8,6,9,0,4,1,0,8,6,5,8,7,3,7,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839901),(479,484,490,0,'Barbarendorp',-1,1220,1140,1024,177,1416839815,402,44,9,4,6,5,0,6,1,0,7,7,7,4,5,11,7,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839912),(480,513,516,0,'Barbarendorp',-1,1220,1140,1024,189,1416839815,403,55,4,10,2,6,0,7,1,0,8,7,6,7,8,11,2,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839898),(481,483,511,0,'Barbarendorp',-1,1220,1140,1024,166,1416839815,406,54,8,8,2,6,0,3,1,0,8,7,8,6,8,7,10,11,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839919),(482,501,482,0,'Barbarendorp',-1,1220,1140,1024,172,1416839815,405,45,8,2,5,8,0,7,1,0,6,8,3,5,10,8,10,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839912),(483,482,493,0,'Barbarendorp',-1,1220,1140,1024,213,1416839815,403,44,7,6,4,7,0,9,1,0,7,6,6,6,8,8,5,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839903),(484,515,514,0,'Barbarendorp',-1,1220,1140,1024,192,1416839815,401,55,6,5,5,5,0,8,1,0,7,12,6,4,8,12,6,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839907),(485,482,508,0,'Barbarendorp',-1,1220,1140,1024,176,1416839815,405,54,5,3,7,7,0,6,1,0,7,10,5,7,9,8,8,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839908),(486,504,480,0,'Barbarendorp',-1,1220,1140,1024,181,1416839815,406,45,9,3,4,8,0,6,1,0,9,6,6,6,7,12,4,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839902),(487,481,495,0,'Barbarendorp',-1,1220,1140,1024,158,1416839815,405,44,10,6,7,8,0,5,1,0,5,4,7,6,7,5,6,7,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839900),(488,517,512,0,'Barbarendorp',-1,1220,1140,1024,185,1416839815,402,55,2,8,6,4,0,6,1,0,7,4,8,6,8,8,9,12,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839907),(489,481,505,0,'Barbarendorp',-1,1220,1140,1024,146,1416839815,401,54,7,7,10,4,0,4,1,0,6,7,6,3,7,7,10,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839909),(490,507,481,0,'Barbarendorp',-1,1220,1140,1024,163,1416839815,408,45,5,8,6,10,0,5,1,0,6,5,3,9,2,6,6,4,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839891),(491,481,499,0,'Barbarendorp',-1,1220,1140,1024,217,1416839815,402,44,9,6,4,7,0,10,1,0,4,3,7,4,8,5,6,5,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839815,'','','',1416839895),(492,519,510,0,'Barbarendorp',-1,1220,1140,1024,222,1416839816,401,55,9,2,6,5,0,7,1,0,10,4,5,10,8,9,7,6,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839816,'','','',1416839906),(493,480,502,0,'Barbarendorp',-1,1220,1140,1024,202,1416839816,401,54,6,8,8,2,0,9,1,0,4,3,4,9,8,11,6,2,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1416839816,'','','',1416839903),(494,501,498,0,'Aldeia+ADMIN',3,2210.49999967,2130.49999967,3557.49999966,323,1695514360,515,45,15,5,1,1,0,12,1,1,10,1,1,1,13,4,1,1,1,1,1,1,1,0,0,0,1,0,1,1,0,'',2,1,0,0,0,0,0,0,0,0,1,0,0,0,1,'100',0,-1,0,1695440845,'','','',0),(495,490,480,0,'Barbarendorp',-1,1220,1140,1024,160,1695440846,404,44,8,2,7,8,0,6,1,0,3,4,11,4,7,10,6,8,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1695440846,'','','',1695442167),(496,509,483,0,'Barbarendorp',-1,1220,1140,1024,149,1695440846,402,45,7,6,11,4,0,4,1,0,6,6,4,8,9,7,5,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1695440846,'','','',1695442157),(497,520,508,0,'Barbarendorp',-1,1220,1140,1024,135,1695440846,401,55,11,3,7,9,0,4,1,0,3,4,7,6,5,8,9,3,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1695440846,'','','',1695442161),(498,497,497,0,'Aldeia+de+cypox',7,1720,1640,1624,1,1776033183,26,44,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1776026024,'','1','1',0),(499,487,482,0,'Barbarendorp',-1,1220,1140,1024,1,1776026024,26,44,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1776026024,'','1','1',0),(500,492,519,0,'Barbarendorp',-1,1220,1140,1024,1,1776026024,26,54,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1776026024,'','1','1',0),(501,510,484,0,'Barbarendorp',-1,1220,1140,1024,1,1776026024,26,45,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',0,-1,0,1776026024,'','1','1',0),(510,503,496,0,'Aldeia+de+testuser5',5,1720,1640,1624,1,1776103900,26,45,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033004,-1,0,1776033004,'','','',0),(503,514,486,0,'Barbarendorp',-1,1220,1140,1024,1,1776032921,26,45,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776032921,-1,0,1776032921,'','','',0),(504,520,505,0,'Barbarendorp',-1,1220,1140,1024,1,1776032921,26,55,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776032921,-1,0,1776032921,'','','',0),(505,497,521,0,'Barbarendorp',-1,1220,1140,1024,1,1776032921,26,54,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776032921,-1,0,1776032921,'','','',0),(507,486,483,0,'Barbarendorp',-1,1220,1140,1024,1,1776032962,26,44,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776032962,-1,0,1776032962,'','','',0),(508,521,502,0,'Barbarendorp',-1,1220,1140,1024,1,1776032962,26,55,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776032962,-1,0,1776032962,'','','',0),(509,495,520,0,'Barbarendorp',-1,1220,1140,1024,1,1776032962,26,54,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776032962,-1,0,1776032962,'','','',0),(511,515,488,0,'Barbarendorp',-1,1220,1140,1024,1,1776033004,26,45,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033004,-1,0,1776033004,'','','',0),(512,483,486,0,'Barbarendorp',-1,1220,1140,1024,1,1776033004,26,44,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033004,-1,0,1776033004,'','','',0),(513,501,521,0,'Barbarendorp',-1,1220,1140,1024,1,1776033004,26,55,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033004,-1,0,1776033004,'','','',0),(514,499,496,0,'cypox village',9,292200.00000002,292200.00000002,367200.00000002,7628,1776552868,12379,44,30,25,20,15,3,20,1,1,25,30,30,30,30,30,10,20,1,1,1,1,1,1,0,1,1,1,1,1,0,'',20,120,160,0,50,100,0,200,70,70,1,3,3,0,0,'100',1776033082,-1,0,1776033082,'','','',0),(515,519,494,0,'Barbarendorp',-1,1220,1140,1024,1,1776033082,26,45,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033082,-1,0,1776033082,'','','',0),(516,493,520,0,'Barbarendorp',-1,1220,1140,1024,1,1776033082,26,54,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033082,-1,0,1776033082,'','','',0),(517,482,488,0,'Barbarendorp',-1,1220,1140,1024,1,1776033082,26,44,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,0,1,0,0,1,1,0,0,0,0,0,1,1,0,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'100',1776033082,-1,0,1776033082,'','','',0);
/*!40000 ALTER TABLE `villages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tribalwars_world'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-19  0:54:54
