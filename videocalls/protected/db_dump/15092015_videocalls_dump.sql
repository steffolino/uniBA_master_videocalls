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
-- Table structure for table `UserContacts`
--

DROP TABLE IF EXISTS `UserContacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserContacts` (
  `relationID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DB internal id',
  `userID` int(11) NOT NULL COMMENT 'user''s IDs',
  `contactID` int(11) NOT NULL COMMENT 'contact ID = userID; just for simple connection amongst Users',
  PRIMARY KEY (`relationID`),
  KEY `userID_index` (`userID`),
  CONSTRAINT `fk_users_usercontacts` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='managing contacts';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserContacts`
--

LOCK TABLES `UserContacts` WRITE;
/*!40000 ALTER TABLE `UserContacts` DISABLE KEYS */;
INSERT INTO `UserContacts` VALUES (1,2,1),(2,1,2),(3,1,3),(4,1,4),(5,4,1),(6,1,5),(7,5,1),(8,5,2),(9,5,3),(10,5,4),(11,6,5),(12,5,6),(13,4,6),(14,6,4),(15,1,6),(16,6,1),(17,8,7),(18,7,8);
/*!40000 ALTER TABLE `UserContacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserDescriptions`
--

DROP TABLE IF EXISTS `UserDescriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserDescriptions` (
  `userDescriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userStory` varchar(160) DEFAULT 'ist gluecklich',
  PRIMARY KEY (`userDescriptionID`),
  KEY `fk_users_userstories` (`userID`),
  CONSTRAINT `fk_users_userstories` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Text stories on every user\nFK to Users table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserDescriptions`
--

LOCK TABLES `UserDescriptions` WRITE;
/*!40000 ALTER TABLE `UserDescriptions` DISABLE KEYS */;
INSERT INTO `UserDescriptions` VALUES (1,5,'quit his job to become a musician'),(2,5,'now has a dog'),(3,5,'loves to go hiking'),(4,1,'has 28 grandchildren'),(5,2,'nowadays lives in palma de mallorca'),(6,3,'likes beer'),(7,4,'still riding his motor bike'),(8,4,'still smoking 2 packs of cigarettes day in and day out'),(9,3,'goes to church every sunday'),(10,2,'plays the guitar every evening'),(11,2,'has won the \'best gardener\' contest in his city'),(12,6,'has her own social tailorshop'),(13,6,'has adopted her 26th dog last year');
/*!40000 ALTER TABLE `UserDescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserImages`
--

DROP TABLE IF EXISTS `UserImages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserImages` (
  `userImageID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userImageLink1` varchar(256) DEFAULT 'images/remPhotos/userDefault/image01.jpg',
  `userImageLink2` varchar(256) DEFAULT 'images/remPhotos/userDefault/image02.jpg',
  `userImageLink3` varchar(256) DEFAULT 'images/remPhotos/userDefault/image03.jpg',
  `userImageDescription1` varchar(256) DEFAULT 'Lorem Ipsum Dolor 1',
  `userImageDescription2` varchar(256) DEFAULT 'Lorem Ipsum Dolor 2',
  `userImageDescription3` varchar(256) DEFAULT 'Lorem Ipsum Dolor 3',
  PRIMARY KEY (`userImageID`),
  KEY `fk_userImages_users_idx` (`userID`),
  CONSTRAINT `fk_userImages_users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserImages`
--

LOCK TABLES `UserImages` WRITE;
/*!40000 ALTER TABLE `UserImages` DISABLE KEYS */;
INSERT INTO `UserImages` VALUES (1,1,'images/remPhotos/userDefault/image01.jpg','images/remPhotos/userDefault/image02.jpg','images/remPhotos/userDefault/image03.jpg','Lorem Ipsum Dolor 1','Lorem Ipsum Dolor 2','Lorem Ipsum Dolor 3'),(8,2,'images/remPhotos/userDefault/image01.jpg','images/remPhotos/userDefault/image02.jpg','images/remPhotos/userDefault/image03.jpg','Lorem Ipsum Dolor 1','Lorem Ipsum Dolor 2','Lorem Ipsum Dolor 3'),(9,3,'images/remPhotos/userDefault/image01.jpg','images/remPhotos/userDefault/image02.jpg','images/remPhotos/userDefault/image03.jpg','Lorem Ipsum Dolor 1','Lorem Ipsum Dolor 2','Lorem Ipsum Dolor 3'),(10,4,'images/remPhotos/userDefault/image01.jpg','images/remPhotos/userDefault/image02.jpg','images/remPhotos/userDefault/image03.jpg','Lorem Ipsum Dolor 1','Lorem Ipsum Dolor 2','Lorem Ipsum Dolor 3'),(11,5,'images/remPhotos/userDefault/image01.jpg','images/remPhotos/userDefault/image02.jpg','images/remPhotos/userDefault/image03.jpg','Lorem Ipsum Dolor 1','Lorem Ipsum Dolor 2','Lorem Ipsum Dolor 3'),(12,6,'images/remPhotos/userDefault/image01.jpg','images/remPhotos/userDefault/image02.jpg','images/remPhotos/userDefault/image03.jpg','Lorem Ipsum Dolor 1','Lorem Ipsum Dolor 2','Lorem Ipsum Dolor 3');
/*!40000 ALTER TABLE `UserImages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserMusic`
--

DROP TABLE IF EXISTS `UserMusic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserMusic` (
  `musicID` int(11) NOT NULL AUTO_INCREMENT,
  `musicLink` varchar(256) NOT NULL DEFAULT 'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`musicID`),
  KEY `fk_usermusic_users_idx` (`userID`),
  CONSTRAINT `fk_usermusic_users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='link to Users favourite music stream';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserMusic`
--

LOCK TABLES `UserMusic` WRITE;
/*!40000 ALTER TABLE `UserMusic` DISABLE KEYS */;
INSERT INTO `UserMusic` VALUES (1,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',1),(2,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',2),(3,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',3),(4,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',4),(5,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',5),(6,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',6),(7,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',7),(8,'http://mp3.ffh.de/ffhchannels/hqschlager.mp3',8);
/*!40000 ALTER TABLE `UserMusic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserNotifications`
--

DROP TABLE IF EXISTS `UserNotifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserNotifications` (
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
  CONSTRAINT `fk_notifications_users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=utf8 COMMENT='table to notify Users on call - invitations';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserNotifications`
--

LOCK TABLES `UserNotifications` WRITE;
/*!40000 ALTER TABLE `UserNotifications` DISABLE KEYS */;
INSERT INTO `UserNotifications` VALUES (28,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&roomId=1&guest=2',1,'yes',2,'2015-08-28 08:22:18'),(29,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',2,'2015-08-28 08:22:18'),(30,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:22:18'),(31,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-08-28 08:22:18'),(32,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:22:18'),(33,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:22:18'),(34,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:23:12'),(35,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 08:39:10'),(36,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 09:10:35'),(37,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-08-28 09:53:30'),(38,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 12:19:04'),(39,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 12:19:19'),(40,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-08-28 12:19:52'),(41,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-08-28 12:24:14'),(42,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:56:32'),(43,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:56:47'),(44,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:57:58'),(45,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:58:15'),(46,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:58:39'),(47,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:59:35'),(48,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 11:59:49'),(49,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:00:07'),(50,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:00:26'),(51,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:00:35'),(52,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:01:00'),(53,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:01:08'),(54,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:01:56'),(55,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:04:24'),(56,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:05:35'),(57,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 12:05:46'),(58,NULL,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=',1,'unread',2,'2015-09-03 12:06:51'),(59,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:48:11'),(60,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:49:09'),(61,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:49:22'),(62,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 12:49:47'),(63,4,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-03 13:30:52'),(64,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-03 13:51:00'),(65,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-03 13:57:26'),(66,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-03 13:59:08'),(67,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-04 08:21:30'),(68,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'no',2,'2015-09-04 08:30:05'),(69,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-04 08:30:05'),(70,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-04 08:30:05'),(71,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 08:30:24'),(72,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 08:46:43'),(73,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 08:49:30'),(74,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'unread',2,'2015-09-04 08:50:19'),(75,1,'You are invited to answer the call by josef','/yii/videocalls/index.php?r=call/room&host=2&guest=1',1,'yes',2,'2015-09-04 09:29:51'),(76,2,'You are invited to answer the call by irma','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'no',1,'2015-09-04 09:33:06'),(77,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-09-04 09:36:44'),(78,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-04 09:38:14'),(79,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-04 09:41:05'),(80,2,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-09-04 09:55:41'),(81,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:37:03'),(82,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:37:49'),(83,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:37:54'),(84,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:38:14'),(85,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:39:06'),(86,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:39:12'),(87,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:40:25'),(88,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:41:00'),(89,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:41:36'),(90,3,'Sie werden von irmaangerufen','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-04 14:42:58'),(91,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 11:39:26'),(92,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:33:10'),(93,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:33:31'),(94,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:33:45'),(95,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:34:15'),(96,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:34:59'),(97,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:35:23'),(98,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:35:29'),(99,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:39:08'),(100,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:41:02'),(101,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:41:32'),(102,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:41:56'),(103,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:42:51'),(104,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:44:37'),(105,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:51:43'),(106,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:51:56'),(107,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:52:07'),(108,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:52:16'),(109,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:53:06'),(110,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:53:17'),(111,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 12:53:26'),(112,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:06:22'),(113,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:10:58'),(114,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:12:02'),(115,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:13:08'),(116,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:13:21'),(117,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:13:26'),(118,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2%3Fslideshow%3Dtrue',1,'unread',5,'2015-09-07 13:13:36'),(119,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:13:43'),(120,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:15:54'),(121,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:16:23'),(122,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:17:16'),(123,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:18:52'),(124,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 13:23:15'),(125,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:02:55'),(126,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:13:42'),(127,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:18:15'),(128,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:18:48'),(129,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:19:39'),(130,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:20:26'),(131,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:21:03'),(132,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:21:29'),(133,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:21:34'),(134,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:23:13'),(135,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:26:04'),(136,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:29:23'),(137,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:34:03'),(138,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:34:21'),(139,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:35:06'),(140,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:37:49'),(141,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:43:07'),(142,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:43:48'),(143,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 14:44:20'),(144,1,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=1',1,'unread',5,'2015-09-07 14:56:59'),(145,1,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=1',1,'unread',5,'2015-09-07 14:58:04'),(146,1,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=1',1,'unread',5,'2015-09-07 15:00:28'),(147,1,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=1',1,'unread',5,'2015-09-07 15:01:32'),(148,1,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=1',1,'unread',5,'2015-09-07 15:01:46'),(149,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:06:19'),(150,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:08:09'),(151,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:08:35'),(152,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:10:26'),(153,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:10:38'),(154,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:12:02'),(155,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:16:06'),(156,2,'Sie werden von Robertangerufen','/yii/videocalls/index.php?r=call/room&host=5&guest=2',1,'unread',5,'2015-09-07 15:17:10'),(157,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'yes',1,'2015-09-10 13:47:28'),(158,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 11:44:48'),(159,3,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-14 12:05:58'),(160,3,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=3',1,'unread',1,'2015-09-14 12:08:47'),(161,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 13:38:06'),(162,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 13:48:24'),(163,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:13:11'),(164,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:14:23'),(165,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:15:32'),(166,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:17:48'),(167,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:18:47'),(168,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:19:00'),(169,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:21:20'),(170,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:23:04'),(171,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:23:25'),(172,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:25:36'),(173,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:57:59'),(174,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:58:08'),(175,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 14:59:57'),(176,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:00:14'),(177,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:02:29'),(178,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:09:43'),(179,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:12:50'),(180,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:13:00'),(181,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:19:29'),(182,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:20:51'),(183,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:21:09'),(184,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:24:02'),(185,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:25:55'),(186,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:26:14'),(187,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:29:04'),(188,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:31:53'),(189,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:32:06'),(190,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:35:15'),(191,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:35:47'),(192,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:36:28'),(193,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:43:36'),(194,2,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=2',1,'unread',1,'2015-09-14 15:44:17'),(195,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:14:02'),(196,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:15:31'),(197,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:16:05'),(198,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:16:25'),(199,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:16:45'),(200,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:48:19'),(201,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:48:30'),(202,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:51:57'),(203,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:52:40'),(204,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:54:02'),(205,2,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=2',1,'unread',8,'2015-09-15 16:54:40'),(206,7,'FRANCISCO ruft Sie an','/yii/videocalls/index.php?r=call/room&host=8&guest=7',1,'yes',8,'2015-09-15 16:55:19'),(207,4,'IRMA ruft Sie an','/yii/videocalls/index.php?r=call/room&host=1&guest=4',1,'unread',1,'2015-09-15 18:18:15');
/*!40000 ALTER TABLE `UserNotifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identifying a single user',
  `username` varchar(50) NOT NULL COMMENT 'userName used for log in',
  `creationDate` datetime NOT NULL COMMENT 'date of creation',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'irma','2015-06-22 00:00:00'),(2,'josef','2015-06-22 00:00:00'),(3,'theresia','2015-06-22 00:00:00'),(4,'georg','2015-06-22 00:00:00'),(5,'robert','2015-06-26 00:00:00'),(6,'geli','2015-06-26 00:00:00'),(7,'tatiane','0000-00-00 00:00:00'),(8,'francisco','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-15 20:45:43
