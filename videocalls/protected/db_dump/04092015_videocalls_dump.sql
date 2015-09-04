-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: videocalls
-- ------------------------------------------------------
-- Server version	5.6.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `usercontacts`
--

-- COMMENT OUT WHEN ON LOCAL ENVIRONMENT
USE stef90210_videoc;

DROP TABLE IF EXISTS `usercontacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usercontacts` (
  `relationID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DB internal id',
  `userID` int(11) NOT NULL COMMENT 'user''s IDs',
  `contactID` int(11) NOT NULL COMMENT 'contact ID = userID; just for simple connection amongst users',
  PRIMARY KEY (`relationID`),
  KEY `userID_index` (`userID`),
  CONSTRAINT `fk_users_usercontacts` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='managing contacts';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usercontacts`
--

LOCK TABLES `usercontacts` WRITE;
/*!40000 ALTER TABLE `usercontacts` DISABLE KEYS */;
INSERT INTO `usercontacts` VALUES (1,2,1),(2,1,2),(3,1,3),(4,1,4),(5,4,1),(6,1,5),(7,5,1),(8,5,2),(9,5,3),(10,5,4),(11,6,5),(12,5,6),(13,4,6),(14,6,4),(15,1,6),(16,6,1);
/*!40000 ALTER TABLE `usercontacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userdescriptions`
--

DROP TABLE IF EXISTS `userdescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userdescriptions` (
  `userDescriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userStory` varchar(160) DEFAULT 'is happy',
  PRIMARY KEY (`userDescriptionID`),
  KEY `fk_users_userstories` (`userID`),
  CONSTRAINT `fk_users_userstories` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Text stories on every user\nFK to users table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userdescriptions`
--

LOCK TABLES `userdescriptions` WRITE;
/*!40000 ALTER TABLE `userdescriptions` DISABLE KEYS */;
INSERT INTO `userdescriptions` VALUES (1,5,'quit his job to become a musician'),(2,5,'now has a dog'),(3,5,'loves to go hiking'),(4,1,'has 28 grandchildren'),(5,2,'nowadays lives in palma de mallorca'),(6,3,'likes beer'),(7,4,'still riding his motor bike'),(8,4,'still smoking 2 packs of cigarettes day in and day out'),(9,3,'goes to church every sunday'),(10,2,'plays the guitar every evening'),(11,2,'has won the \'best gardener\' contest in his city'),(12,6,'has her own social tailorshop'),(13,6,'has adopted her 26th dog last year');
/*!40000 ALTER TABLE `userdescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usernotifications`
--

DROP TABLE IF EXISTS `usernotifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usernotifications` (
  `notID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `notText` varchar(160) DEFAULT NULL,
  `notLink` varchar(160) DEFAULT NULL,
  `notCompleted` tinyint(4) DEFAULT '0' COMMENT '3-way handshake\nnotification set to complete when all 3 stages of invitation != ''notRead''\n',
  `notAnswer` varchar(7) DEFAULT 'unread' COMMENT 'unread -> yes/no',
  `inviterID` int(11) DEFAULT NULL,
  `notTimeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notID`),
  KEY `fk_notifications_users_idx` (`userID`),
  CONSTRAINT `fk_notifications_users` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COMMENT='table to notify users on call - invitations';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usernotifications`
--

LOCK TABLES `usernotifications` WRITE;
/*!40000 ALTER TABLE `usernotifications` DISABLE KEYS */;
INSERT INTO `usernotifications` VALUES (28,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&roomId=1&guest=2',1,'yes',2,'2015-08-28 08:22:18'),(29,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',2,'2015-08-28 08:22:18'),(30,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:22:18'),(31,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-08-28 08:22:18'),(32,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:22:18'),(33,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:22:18'),(34,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:23:12'),(35,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:39:10'),(36,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 09:10:35'),(37,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 09:53:30'),(38,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 12:19:04'),(39,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 12:19:19'),(40,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 12:19:52'),(41,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-08-28 12:24:14'),(42,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:56:32'),(43,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:56:47'),(44,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:57:58'),(45,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:58:15'),(46,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:58:39'),(47,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:59:35'),(48,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:59:49'),(49,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:00:07'),(50,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:00:26'),(51,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:00:35'),(52,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:01:00'),(53,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:01:08'),(54,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:01:56'),(55,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:04:24'),(56,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:05:35'),(57,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:05:46'),(58,NULL,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=',1,'unread',2,'2015-09-03 12:06:51'),(59,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:48:11'),(60,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:49:09'),(61,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:49:22'),(62,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:49:47'),(63,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 13:30:52'),(64,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-03 13:51:00'),(65,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-03 13:57:26'),(66,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 13:59:08'),(67,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-04 08:21:30'),(68,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'no',2,'2015-09-04 08:30:05'),(69,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-04 08:30:05'),(70,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-04 08:30:05'),(71,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 08:30:24'),(72,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 08:46:43'),(73,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 08:49:30'),(74,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-04 08:50:19'),(75,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 09:29:51'),(76,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-09-04 09:33:06'),(77,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-09-04 09:36:44'),(78,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-04 09:38:14'),(79,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-04 09:41:05'),(80,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-09-04 09:55:41');
/*!40000 ALTER TABLE `usernotifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifying a single user',
  `username` varchar(50) NOT NULL COMMENT 'userName used for log in',
  `creationDate` datetime NOT NULL COMMENT 'date of creation',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'irma','2015-06-22 00:00:00'),(2,'josef','2015-06-22 00:00:00'),(3,'theresia','2015-06-22 00:00:00'),(4,'georg','2015-06-22 00:00:00'),(5,'robert','2015-06-26 00:00:00'),(6,'geli','2015-06-26 00:00:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-04 12:46:47
