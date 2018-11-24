-- MySQL dump 10.15  Distrib 10.0.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: spotifake
-- ------------------------------------------------------
-- Server version	10.0.36-MariaDB-0ubuntu0.16.04.1

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
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_1` varchar(100) NOT NULL,
  `user_2` varchar(100) NOT NULL,
  `state` varchar(10) DEFAULT 'pending',
  `avatar_url` text,
  `username` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `friend_id_uindex` (`id`),
  KEY `friend_user_id_fk` (`user_1`),
  KEY `friend_user_id_fk_2` (`user_2`),
  CONSTRAINT `friend_user_id_fk` FOREIGN KEY (`user_1`) REFERENCES `user` (`id`),
  CONSTRAINT `friend_user_id_fk_2` FOREIGN KEY (`user_2`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend`
--

LOCK TABLES `friend` WRITE;
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party`
--

DROP TABLE IF EXISTS `party`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_playlist` varchar(100) NOT NULL,
  `difficulty` char(4) DEFAULT NULL,
  `auto_generated` tinyint(1) DEFAULT NULL,
  `direct` tinyint(1) DEFAULT NULL,
  `finished` tinyint(1) NOT NULL DEFAULT '0',
  `owner` text,
  `current_track_number` int(11) DEFAULT '0',
  `nb_track` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `party_id_uindex` (`id`),
  KEY `party_playlist_id_fk` (`id_playlist`),
  CONSTRAINT `party_playlist_id_fk` FOREIGN KEY (`id_playlist`) REFERENCES `playlist` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party`
--

LOCK TABLES `party` WRITE;
/*!40000 ALTER TABLE `party` DISABLE KEYS */;
/*!40000 ALTER TABLE `party` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party_user`
--

DROP TABLE IF EXISTS `party_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party_user` (
  `id_party` int(11) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id_party`,`id_user`),
  UNIQUE KEY `party_user_idParty_idUser_uindex` (`id_party`,`id_user`),
  KEY `party_user_user_id_fk` (`id_user`),
  CONSTRAINT `party_user_party_id_fk` FOREIGN KEY (`id_party`) REFERENCES `party` (`id`),
  CONSTRAINT `party_user_user_id_fk` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party_user`
--

LOCK TABLES `party_user` WRITE;
/*!40000 ALTER TABLE `party_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `party_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `party_user_state`
--

DROP TABLE IF EXISTS `party_user_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `party_user_state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idParty` int(11) NOT NULL,
  `idUser` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `finished` tinyint(1) DEFAULT '0',
  `current_track_number` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `score_id_uindex` (`id`),
  KEY `score_party_id_fk` (`idParty`),
  KEY `score_user_id_fk` (`idUser`),
  CONSTRAINT `score_party_id_fk` FOREIGN KEY (`idParty`) REFERENCES `party` (`id`),
  CONSTRAINT `score_user_id_fk` FOREIGN KEY (`idUser`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `party_user_state`
--

LOCK TABLES `party_user_state` WRITE;
/*!40000 ALTER TABLE `party_user_state` DISABLE KEYS */;
/*!40000 ALTER TABLE `party_user_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist` (
  `id` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `id_user` varchar(100) DEFAULT NULL,
  `id_party` int(11) DEFAULT NULL,
  `url_image` text,
  `nb_track` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `playlist_id_uindex` (`id`),
  KEY `playlist_party_id_fk` (`id_party`),
  KEY `playlist_user_id_fk` (`id_user`),
  CONSTRAINT `playlist_user_id_fk` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist_track`
--

DROP TABLE IF EXISTS `playlist_track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `playlist_track` (
  `id_playlist` varchar(100) NOT NULL,
  `id_track` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_track`
--

LOCK TABLES `playlist_track` WRITE;
/*!40000 ALTER TABLE `playlist_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `playlist_track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `track`
--

DROP TABLE IF EXISTS `track`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `track` (
  `id` varchar(100) NOT NULL,
  `title` text,
  `artist` text,
  `album` text,
  `cover_url` text,
  `sample_url` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `musique_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `track`
--

LOCK TABLES `track` WRITE;
/*!40000 ALTER TABLE `track` DISABLE KEYS */;
/*!40000 ALTER TABLE `track` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `avatar_url` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_uindex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-21 23:49:35
