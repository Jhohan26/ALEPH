-- MariaDB dump 10.19-11.3.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: cursos
-- ------------------------------------------------------
-- Server version	11.3.2-MariaDB

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
-- Table structure for table `Categorias`
--

DROP TABLE IF EXISTS `Categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categorias`
--

LOCK TABLES `Categorias` WRITE;
/*!40000 ALTER TABLE `Categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `Categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cursos`
--

DROP TABLE IF EXISTS `Cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `miniatura` varchar(128) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `Niveles_id` int(11) NOT NULL,
  `Categorias_id` int(11) NOT NULL,
  `profesor` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Cursos_Niveles_idx` (`Niveles_id`),
  KEY `fk_Cursos_Categorias1_idx` (`Categorias_id`),
  KEY `fk_Cursos_Usuarios1_idx` (`profesor`),
  CONSTRAINT `fk_Cursos_Categorias1` FOREIGN KEY (`Categorias_id`) REFERENCES `Categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursos_Niveles` FOREIGN KEY (`Niveles_id`) REFERENCES `Niveles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursos_Usuarios1` FOREIGN KEY (`profesor`) REFERENCES `Usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cursos`
--

LOCK TABLES `Cursos` WRITE;
/*!40000 ALTER TABLE `Cursos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Cursos_realizados`
--

DROP TABLE IF EXISTS `Cursos_realizados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cursos_realizados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_id` int(11) NOT NULL,
  `Cursos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Cursos_realizados_Usuarios1_idx` (`Usuarios_id`),
  KEY `fk_Cursos_realizados_Cursos1_idx` (`Cursos_id`),
  CONSTRAINT `fk_Cursos_realizados_Cursos1` FOREIGN KEY (`Cursos_id`) REFERENCES `Cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cursos_realizados_Usuarios1` FOREIGN KEY (`Usuarios_id`) REFERENCES `Usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cursos_realizados`
--

LOCK TABLES `Cursos_realizados` WRITE;
/*!40000 ALTER TABLE `Cursos_realizados` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cursos_realizados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Niveles`
--

DROP TABLE IF EXISTS `Niveles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Niveles`
--

LOCK TABLES `Niveles` WRITE;
/*!40000 ALTER TABLE `Niveles` DISABLE KEYS */;
/*!40000 ALTER TABLE `Niveles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(45) NOT NULL,
  `segundo_nombre` varchar(45) DEFAULT NULL,
  `primer_apellido` varchar(45) NOT NULL,
  `segundo_apellido` varchar(45) DEFAULT NULL,
  `nombre_usuario` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contrasena` char(64) NOT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `Roles_id` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuarios`
--

LOCK TABLES `Usuarios` WRITE;
/*!40000 ALTER TABLE `Usuarios` DISABLE KEYS */;
INSERT INTO `Usuarios` VALUES
(1,'Jhohan','Esteban','Reyes','García','Jhohan26','jhohan@gmail.com','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','',1),
(2,'Jhony','Santiago','Reyes','García','Jhony','jhonysantiagoreyesgarcia@gmail.com','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','',1),
(3,'Juan','Esteban','Serna','Saenz','Juanzesaenz24','juan@gmail.com','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','',1);
/*!40000 ALTER TABLE `Usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Videos`
--

DROP TABLE IF EXISTS `Videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Videos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `Cursos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Videos_Cursos1_idx` (`Cursos_id`),
  CONSTRAINT `fk_Videos_Cursos1` FOREIGN KEY (`Cursos_id`) REFERENCES `Cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Videos`
--

LOCK TABLES `Videos` WRITE;
/*!40000 ALTER TABLE `Videos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Videos_vistos`
--

DROP TABLE IF EXISTS `Videos_vistos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Videos_vistos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_id` int(11) NOT NULL,
  `Videos_id` int(11) NOT NULL,
  `Cursos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_Videos_vistos_Usuarios1_idx` (`Usuarios_id`),
  KEY `fk_Videos_vistos_Videos1_idx` (`Videos_id`),
  KEY `fk_Videos_vistos_Cursos1_idx` (`Cursos_id`),
  CONSTRAINT `fk_Videos_vistos_Cursos1` FOREIGN KEY (`Cursos_id`) REFERENCES `Cursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Videos_vistos_Usuarios1` FOREIGN KEY (`Usuarios_id`) REFERENCES `Usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Videos_vistos_Videos1` FOREIGN KEY (`Videos_id`) REFERENCES `Videos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Videos_vistos`
--

LOCK TABLES `Videos_vistos` WRITE;
/*!40000 ALTER TABLE `Videos_vistos` DISABLE KEYS */;
/*!40000 ALTER TABLE `Videos_vistos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-09  9:23:17
