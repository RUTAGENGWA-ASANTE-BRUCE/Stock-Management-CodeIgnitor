-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: stockManagementProject
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventories` (
  `inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productImage` varchar(50) NOT NULL,
  `color` varchar(30) NOT NULL,
  `unitPrice` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `supplierName` varchar(50) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  PRIMARY KEY (`inventory_id`),
  KEY `supplierIdNo` (`supplierId`),
  KEY `productIdNo` (`productId`),
  CONSTRAINT `productIdNo` FOREIGN KEY (`productId`) REFERENCES `products` (`product_id`),
  CONSTRAINT `supplierIdNo` FOREIGN KEY (`supplierId`) REFERENCES `suppliers` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (5,5,'PI Phone','0a9214ced6c83d8f2a559b83a1aadf44.png','black',2000000,10,2147483647,'Gilbert',3),(6,18,'Headsets','1655813727.png','red',200000,2,2147483647,'Rutagengwa Asante ',1),(7,17,'PS5','1655813663.png','black',500000,3,2147483647,'Rutagengwa Asante ',1);
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `productImage` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `colors` varchar(100) NOT NULL,
  `supplierName` varchar(50) NOT NULL,
  `supplierId` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `supplierId` (`supplierId`),
  CONSTRAINT `supplierId` FOREIGN KEY (`supplierId`) REFERENCES `suppliers` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (3,'shoes','afa821f4f51f0ad3a144e39286a90eb4.png','sports',200000,'red,black,Yellow','Rutagengwa Asante Bruce',1,'Lebron'),(5,'PI Phone','0a9214ced6c83d8f2a559b83a1aadf44.png','communication',2000000,'black,Yellow','Gilbert',3,'Tesla'),(17,'PS5','1655813663.png','Gaming',500000,'red,black,Yellow','Rutagengwa Asante ',1,'XBOX'),(18,'Headsets','1655813727.png','electronics',200000,'red,black,green','Rutagengwa Asante ',1,'HP Power'),(19,'PS4','1655814509.png','Gaming',120000,'red,black,green','Moustapha',2,'XBOX');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suppliers` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `gender` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` VALUES (1,'Rutagengwa Asante ','rutagengwabruce@gmail.com','berlin','0788657707','male'),(2,'Moustapha','moustapha@gmail.com','Switzerland','079426414725','male'),(3,'Gilbert','gilbert@gmail.com','London','0738593353','male');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `profilePicture` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Rutagengwa Asante Bruce','rutagengwa@gmail.com','male','Rwandan','','46b2428a384c08bf52275add03f26eaace50abe535e75212fc1fec3ea233e3d08e1f07ad13c9528ef26cd91e3d2be40d30e28cee82a4ac85c39b793ae4fd5801'),(2,'Rutagengwa Asante Bruce','rutagengwabruce@gmail.com','male','Rwandan','','ddb9ea3a851f4d2845802c1dadc714ac1d945a5675d3de2a62b18dffb6da1cd3652ff98f92654e75b882551edac622020b5753e06b14a9558a67d01283d8ef33'),(3,'Rutagengwa Asante Bruce','rutagengwabruce@gmail.com','male','Rwandan','','b8c87002a8d467b047b54b739016ba0f2b720dce61499102270251ba1cdfa4d5c00626163628c057967a086433dcb28ff852536b017436708bdbb71943082f51'),(4,'Rutagengwa Asante Bruce','rutagengwabruce@gmail.com','male','Rwandan','','46b2428a384c08bf52275add03f26eaace50abe535e75212fc1fec3ea233e3d08e1f07ad13c9528ef26cd91e3d2be40d30e28cee82a4ac85c39b793ae4fd5801'),(5,'Gilbert','rutagengwabruce@gmail.com','male','Rwandan','','589698bbb8c467f025fab2a2d44ca652c679573fbaf3624ab1022bdce1abcd6a0fd6a9dc3f1132fbd91aa2f4522479f2527cab3e34519db71e91c3d025432572'),(6,'Rutagengwa Asante Bruce','rutagengwabruce@gmail.com','male','Rwandan','','b494afbd39d0b54c2fff6afa7de0d09d480654d2d3037da0dfd0e647975e0f54abe5fbe06784783613f27ceb18aca94c4f54dffb1fd216cb3ee8929894596ffe'),(7,'Rutagengwa Asante Bruce','rutagengwabruce@gmail.com','male','Rwandan','http://localhost/Stock-Management-CodeIgnitor/stoc','46b2428a384c08bf52275add03f26eaace50abe535e75212fc1fec3ea233e3d08e1f07ad13c9528ef26cd91e3d2be40d30e28cee82a4ac85c39b793ae4fd5801'),(8,'Rutagengwa Asante Bruce','rutagengwabruce@gmail.com','male','Rwandan','301825c7fe5d8c6a72652664460d77ca.jpg','46b2428a384c08bf52275add03f26eaace50abe535e75212fc1fec3ea233e3d08e1f07ad13c9528ef26cd91e3d2be40d30e28cee82a4ac85c39b793ae4fd5801'),(9,'Gilbert','rutagengwabruce@gmail.com','male','American','af7a9db00abbeebe8d79717922b1c7c5.jpg','6aedee5d995d83e12c4b354115a81a65c70d2312664abad6c205237e3db04fe03ca62048aab605600407bb5b0b59543ccddbe259cc2d6b6574eea26b5070adf1'),(10,'Manzi cedrick','manzicedrick@gmail.com','male','Rwandan','5276c590c9cdd59b70b6f011a7f0a5a1.jpg','a7f9a9213db72f9934f8a7019eee5389e965a40e323eda3874b030d5e7310bfafecf2b410be01b8720a3d832f57d55ac157d3e8634090f1564d421f0cd078dc8'),(11,'peace Trezor Nsabimana','trezor@gmail.com','male','American','b2af4e32eab957ca960f30092cde561d.jpg','74b11b0d7a8e74e82a07cd944a922df00267287bc4fe753a527d048ade3b07e174261d78191e2515a178ec15682763aab5259c75d2f49a1ab6c571d625791186');
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

-- Dump completed on 2022-06-21 17:05:28
