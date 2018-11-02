-- MySQL dump 10.13  Distrib 5.7.21, for osx10.9 (x86_64)
--
-- Host: localhost    Database: panu_db
-- ------------------------------------------------------
-- Server version	5.7.21

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
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com',0,'Chubut','Calle Falsa 123','123456',NULL,7),(2,'ASd2','asdasd@gmail.com',1,'Buenos Aires','asdasd 123','qwe123123',NULL,1),(5,'ASd22','asdasdasd@gmail.com',1,'Buenos Aires','asdasd 123','qwe123123',NULL,1),(6,'asdasdasd','asldkjas@asldkjas.com',0,'Chaco','daslkdas','asdasd',NULL,1),(7,'asdlkjasasdlkj','asldkjasd@alsdkjaslkdj.com',0,'Catamarca','aslkdjasd','asdasd','perfilasdlkjasasdlkj.JPG',1),(9,'asdasdasdasadsdasadsdas','dlaksjdalskjdaslkj@aklndaslkjdaslk.com',0,'Chaco','laksjdasdlkj','asdasd','',1),(10,'asdasdalkjdasd','aslkdjasd@aslkdjdasd.com',0,'C.A.B.A.','aslkdjas','asdasd',NULL,1),(11,'adsldkasjdaslk','asd@asd.com',0,'Buenos Aires','lkasjd','asdasd',NULL,1),(12,'asdkasjdh','asd22@asd.com',0,'C.A.B.A.','asdasd','$2y$10$HsLAdRrK0FuwLJts3Z3ZTurLxWZSU8AJ4yqc4N8GjFn24nnMdYYhu','perfilasdkasjdh.png',1);
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

-- Dump completed on 2018-11-02 11:09:54
