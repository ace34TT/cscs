-- MariaDB dump 10.18  Distrib 10.5.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cscs_v2
-- ------------------------------------------------------
-- Server version	10.5.8-MariaDB-3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `cscs_v2`
--

-- CREATE DATABASE /*!32312 IF NOT EXISTS*/ `cscs_v2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

-- USE `cscs_v2`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `names` varchar(255) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `passwords` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'RABENANDRASANA Tafinasoa','tafinasoa35@gmail.com','2cfc0426809e66e53e048a4c87b639cdf1f8ab5b'),(2,'Mampionona Tsiky Kezia','kezia@cscsmadagascar.mg','7c59b57991d55631c7b18c1fb082af0e5bb00852');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `passwords` varchar(40) NOT NULL,
  `personnal_information` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `personnal_information` (`personnal_information`),
  CONSTRAINT `candidates_ibfk_1` FOREIGN KEY (`personnal_information`) REFERENCES `personnal_informations` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidates`
--

LOCK TABLES `candidates` WRITE;
/*!40000 ALTER TABLE `candidates` DISABLE KEYS */;
INSERT INTO `candidates` VALUES (24,'tafinasoa35@gmail.com','2cfc0426809e66e53e048a4c87b639cdf1f8ab5b',40);
/*!40000 ALTER TABLE `candidates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate` int(10) unsigned NOT NULL,
  `content` mediumtext NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `events` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate` (`candidate`),
  KEY `events` (`events`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`),
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`events`) REFERENCES `events` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `responsible` varchar(255) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `names` varchar(50) NOT NULL,
  `events` varchar(15) NOT NULL,
  `method` varchar(15) NOT NULL,
  `province` varchar(30) NOT NULL,
  `place` varchar(255) NOT NULL,
  `dates` date NOT NULL,
  `schedule` time NOT NULL,
  `descriptions` mediumtext NOT NULL,
  `stat` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (11,'  Mampionona Tsiky Kezia','  Mampionona Tsiky Kezia','0345969629','eve1','pretest','face_to_face','Antananarivo','Iavoloha','2021-04-27','14:30:00','',0),(12,'  Mampionona Tsiky Kezia','  Mampionona Tsiky Kezia','0345969629','eve2','final_test','face_to_face','Antananarivo','Iavoloha','2021-04-27','16:45:00','',0),(13,'  RABENANDRASANA Tafinasoa','  RABENANDRASANA Tafinasoa','0345969629','final test 1','final_test','face_to_face','Antananarivo','siege','2021-04-28','21:32:00','',0),(14,'  Mampionona Tsiky Kezia','  Mampionona Tsiky Kezia','0345969629','text x','pretest','face_to_face','Antananarivo','Iavoloha','2021-04-28','21:55:00','',0),(15,'  Mampionona Tsiky Kezia','  Mampionona Tsiky Kezia','0345969629','test 1','pretest','face_to_face','Antananarivo','Iavoloha','2021-04-30','12:05:00','',0),(16,'  Mampionona Tsiky Kezia','  Mampionona Tsiky Kezia','0345969629','test 2','final_test','face_to_face','Antananarivo','Iavoloha','2021-04-30','12:07:00','',0),(17,'  Mampionona Tsiky Kezia','  Mampionona Tsiky Kezia','0345969629','test 1','pretest','face_to_face','Antananarivo','Iavoloha','2021-05-02','19:40:00','',0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendings`
--

DROP TABLE IF EXISTS `pendings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `candidate` int(10) unsigned NOT NULL,
  `stat` tinyint(1) DEFAULT 0,
  `test` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidate` (`candidate`),
  CONSTRAINT `pendings_ibfk_1` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendings`
--

LOCK TABLES `pendings` WRITE;
/*!40000 ALTER TABLE `pendings` DISABLE KEYS */;
INSERT INTO `pendings` VALUES (55,24,1,0),(56,24,0,1),(57,24,1,0);
/*!40000 ALTER TABLE `pendings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnal_informations`
--

DROP TABLE IF EXISTS `personnal_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personnal_informations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `date_of_birth` varchar(30) NOT NULL,
  `height` double NOT NULL,
  `weights` double NOT NULL,
  `province` varchar(30) NOT NULL,
  `addresses` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `post` varchar(30) NOT NULL,
  `validation_code` varchar(40) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `code_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `email_2` (`email`),
  UNIQUE KEY `email_3` (`email`),
  UNIQUE KEY `email_4` (`email`),
  UNIQUE KEY `email_5` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnal_informations`
--

LOCK TABLES `personnal_informations` WRITE;
/*!40000 ALTER TABLE `personnal_informations` DISABLE KEYS */;
INSERT INTO `personnal_informations` VALUES (40,'Tafinasoa','Rabenandrasana','Male','2000-03-01',1.77,56.4,'Antananarivo','IB 31 Iavoloha Ambohibao','0345969629','tafinasoa35@gmail.com','PAA ','eebcae39b2d5ca2cfd2f05b7cb1ea3d0c2590457','2021-05-02 15:28:47','used');
/*!40000 ALTER TABLE `personnal_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `quota` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (3,'Waiter / Waitress','culinary',150,'2021-04-26 14:55:53'),(7,'PAA','Select',150,'2021-05-02 13:36:58');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `events` int(10) unsigned NOT NULL,
  `candidate` int(10) unsigned NOT NULL,
  `note` double NOT NULL,
  `result` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stat` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `event` (`events`),
  KEY `candidate` (`candidate`),
  CONSTRAINT `results_ibfk_1` FOREIGN KEY (`events`) REFERENCES `events` (`id`),
  CONSTRAINT `results_ibfk_2` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (56,17,24,6,0,'2021-05-02 15:29:45',1);
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `results_view`
--

DROP TABLE IF EXISTS `results_view`;
/*!50001 DROP VIEW IF EXISTS `results_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `results_view` (
  `users` tinyint NOT NULL,
  `firstname` tinyint NOT NULL,
  `lastname` tinyint NOT NULL,
  `post` tinyint NOT NULL,
  `events` tinyint NOT NULL,
  `note` tinyint NOT NULL,
  `result` tinyint NOT NULL,
  `stat` tinyint NOT NULL,
  `created_date` tinyint NOT NULL,
  `types` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `test_candidate_assignment`
--

DROP TABLE IF EXISTS `test_candidate_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_candidate_assignment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `events` int(10) unsigned NOT NULL,
  `candidate` int(10) unsigned NOT NULL,
  `stat` tinyint(1) NOT NULL DEFAULT 0,
  `notified` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `events` (`events`),
  KEY `candidate` (`candidate`),
  CONSTRAINT `test_candidate_assignment_ibfk_1` FOREIGN KEY (`events`) REFERENCES `events` (`id`),
  CONSTRAINT `test_candidate_assignment_ibfk_2` FOREIGN KEY (`candidate`) REFERENCES `candidates` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_candidate_assignment`
--

LOCK TABLES `test_candidate_assignment` WRITE;
/*!40000 ALTER TABLE `test_candidate_assignment` DISABLE KEYS */;
INSERT INTO `test_candidate_assignment` VALUES (140,17,24,1,1),(141,17,24,0,0);
/*!40000 ALTER TABLE `test_candidate_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `users`
--

DROP TABLE IF EXISTS `users`;
/*!50001 DROP VIEW IF EXISTS `users`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `users` (
  `users` tinyint NOT NULL,
  `firstname` tinyint NOT NULL,
  `lastname` tinyint NOT NULL,
  `gender` tinyint NOT NULL,
  `date_of_birth` tinyint NOT NULL,
  `height` tinyint NOT NULL,
  `weights` tinyint NOT NULL,
  `province` tinyint NOT NULL,
  `addresses` tinyint NOT NULL,
  `phone` tinyint NOT NULL,
  `email` tinyint NOT NULL,
  `post` tinyint NOT NULL,
  `reg_date` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Current Database: `cscs_v2`
--

-- USE `cscs_v2`;

--
-- Final view structure for view `results_view`
--

/*!50001 DROP TABLE IF EXISTS `results_view`*/;
/*!50001 DROP VIEW IF EXISTS `results_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `results_view` AS select `candidates`.`id` AS `users`,`personnal_informations`.`firstname` AS `firstname`,`personnal_informations`.`lastname` AS `lastname`,`personnal_informations`.`post` AS `post`,`results`.`events` AS `events`,`results`.`note` AS `note`,`results`.`result` AS `result`,`results`.`stat` AS `stat`,`results`.`created_date` AS `created_date`,`events`.`events` AS `types` from (((`results` join `candidates` on(`results`.`candidate` = `candidates`.`id`)) join `personnal_informations` on(`candidates`.`personnal_information` = `personnal_informations`.`id`)) join `events` on(`results`.`events` = `events`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `users`
--

/*!50001 DROP TABLE IF EXISTS `users`*/;
/*!50001 DROP VIEW IF EXISTS `users`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `users` AS select `candidates`.`id` AS `users`,`personnal_informations`.`firstname` AS `firstname`,`personnal_informations`.`lastname` AS `lastname`,`personnal_informations`.`gender` AS `gender`,`personnal_informations`.`date_of_birth` AS `date_of_birth`,`personnal_informations`.`height` AS `height`,`personnal_informations`.`weights` AS `weights`,`personnal_informations`.`province` AS `province`,`personnal_informations`.`addresses` AS `addresses`,`personnal_informations`.`phone` AS `phone`,`personnal_informations`.`email` AS `email`,`personnal_informations`.`post` AS `post`,`personnal_informations`.`reg_date` AS `reg_date` from (`personnal_informations` join `candidates` on(`candidates`.`personnal_information` = `personnal_informations`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-03 12:20:32
