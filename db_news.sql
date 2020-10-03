-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: db_news
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

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
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `create_time` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (4,'Google Bersedia Bayar 1 Miliar Dolar untuk Konten Berita','download.png','\r\nHomeTeknoTech News\r\nGoogle Bersedia Bayar 1 Miliar Dolar untuk Konten Berita\r\nAndina LibriantyAndina Librianty\r\n02 Okt 2020, 19:00 WIB\r\n\r\nGoogle\r\nPerbesar\r\nKantor pusat Google di Mountain View. Liputan6.com/Jeko Iqbal Reza\r\nLiputan6.com, Jakarta - Google bersedia membayar USD 1 miliar untuk perusahaan media di dunia atas berita-berita selama tiga tahun ke depan. Komitmen tersebut merupakan bagian dari produk baru bernama Google News Showcase.\r\n\r\nDilansir Reuters, Jumat (2/10/2020), CEO Google, Sundar Pichai, mengatakan Google News Showcase akan dirilis pertama kali di Jerman dan Brasil.\r\n\r\n','2020-10-03 01:51:18',5),(5,'Donald Trump Positif Covid-19 Jadi Trending Topic Terpopuler','download.jpeg','1. Presiden Donald Trump Positif Covid-19 Jadi Trending Topic di Twitter\r\n\r\nPresiden Amerika Serikat (AS) Donald Trump mengumumkan dirinya positif Covid-19 setelah dites. Tidak hanya Presiden Trump, sang ibu negara AS Melania Trump pun ikut tertular virus corona baru ini.\r\n\r\nDonald Trump mengumumkan dirinya positif terkena Covid-19 melalui akun Twitter pribadinya @realDonaldTrump.\r\n\r\n\"Malam ini, saya dan Ibu Negara AS dites positif Covid-19. Kami berdua akan memulai karantina dan proses pemulihan secepatnya. Kami akan melaluinya bersama,\" cuit Donald Trump lewat akun Twitternya, Jumat (2/10/2020).','2020-10-03 01:58:32',5);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `role` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'gilang','mgfa9802@gmail.com','programmer'),(2,'ganang','ganang@gmail.com','jurnalis'),(5,'Liputan 6','liputan@mail.com','wartawan');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_news'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-03 15:38:15
