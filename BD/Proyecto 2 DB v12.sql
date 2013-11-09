CREATE DATABASE  IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mydb`;
-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	5.6.13

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
-- Table structure for table `cuenta`
--

DROP TABLE IF EXISTS `cuenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta` (
  `id_Cuenta` bigint(20) NOT NULL,
  `Cuen_Saldo` double DEFAULT NULL,
  `Cuen_Estado` varchar(150) DEFAULT NULL,
  `Usuario_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`id_Cuenta`),
  KEY `fk_Cuenta_Usuario1_idx` (`Usuario_id_Doc_Identidad`),
  CONSTRAINT `fk_Cuenta_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta`
--

LOCK TABLES `cuenta` WRITE;
/*!40000 ALTER TABLE `cuenta` DISABLE KEYS */;
INSERT INTO `cuenta` VALUES (201010013010,0,'Activada',201010013010);
/*!40000 ALTER TABLE `cuenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleado` (
  `id_Doc_Identidad` bigint(20) NOT NULL,
  `Str_Cargo` varchar(150) NOT NULL,
  `Usuario_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE KEY `id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad`),
  KEY `fk_Empleado_Usuario1_idx` (`Usuario_id_Doc_Identidad`),
  CONSTRAINT `fk_Empleado_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento`
--

DROP TABLE IF EXISTS `establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento` (
  `id_Establecimiento` bigint(20) NOT NULL,
  `Est_Nombre` varchar(150) NOT NULL,
  `Tipo_Establecimiento_id_Tipo_Establecimiento1` bigint(20) NOT NULL,
  PRIMARY KEY (`id_Establecimiento`),
  UNIQUE KEY `id_Establecimiento_UNIQUE` (`id_Establecimiento`),
  KEY `fk_Establecimiento_Tipo_Establecimiento1_idx` (`Tipo_Establecimiento_id_Tipo_Establecimiento1`),
  CONSTRAINT `fk_Establecimiento_Tipo_Establecimiento1` FOREIGN KEY (`Tipo_Establecimiento_id_Tipo_Establecimiento1`) REFERENCES `tipo_establecimiento` (`id_Tipo_Establecimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento`
--

LOCK TABLES `establecimiento` WRITE;
/*!40000 ALTER TABLE `establecimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `establecimiento_has_propietario`
--

DROP TABLE IF EXISTS `establecimiento_has_propietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `establecimiento_has_propietario` (
  `Establecimiento_id_Establecimiento` bigint(20) NOT NULL,
  `Propietario_id_Doc_Ideintidad` bigint(20) NOT NULL,
  PRIMARY KEY (`Establecimiento_id_Establecimiento`,`Propietario_id_Doc_Ideintidad`),
  KEY `fk_Establecimiento_has_Propietario_Propietario1_idx` (`Propietario_id_Doc_Ideintidad`),
  KEY `fk_Establecimiento_has_Propietario_Establecimiento1_idx` (`Establecimiento_id_Establecimiento`),
  CONSTRAINT `fk_Establecimiento_has_Propietario_Establecimiento1` FOREIGN KEY (`Establecimiento_id_Establecimiento`) REFERENCES `establecimiento` (`id_Establecimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Establecimiento_has_Propietario_Propietario1` FOREIGN KEY (`Propietario_id_Doc_Ideintidad`) REFERENCES `propietario` (`id_Doc_Ideintidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_has_propietario`
--

LOCK TABLES `establecimiento_has_propietario` WRITE;
/*!40000 ALTER TABLE `establecimiento_has_propietario` DISABLE KEYS */;
/*!40000 ALTER TABLE `establecimiento_has_propietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `id_Doc_Identidad` bigint(20) NOT NULL,
  `Str_Carrera` varchar(150) NOT NULL,
  `Usuario_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE KEY `Est_id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad`),
  KEY `fk_Estudiante_Usuario1_idx` (`Usuario_id_Doc_Identidad`),
  CONSTRAINT `fk_Estudiante_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES (201010013010,'Ingenieria de Sistemas',201010013010);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura`
--

DROP TABLE IF EXISTS `factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura` (
  `idFactura` bigint(20) NOT NULL AUTO_INCREMENT,
  `Fac_Fecha` datetime DEFAULT NULL,
  `Fac_Total` double DEFAULT NULL,
  `Fac_EstadoFactura` int(11) DEFAULT NULL,
  `Fact_ValorCarnet` double DEFAULT NULL,
  `Fact_ValorEfectivo` double DEFAULT NULL,
  `Usuario_id_Doc_Identidad1` bigint(20) NOT NULL,
  `Establecimiento_id_Establecimiento` bigint(20) NOT NULL,
  `Empleado_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `fk_Factura_Usuario1_idx` (`Usuario_id_Doc_Identidad1`),
  KEY `fk_Factura_Establecimiento1_idx` (`Establecimiento_id_Establecimiento`),
  KEY `fk_Factura_Empleado1_idx` (`Empleado_id_Doc_Identidad`),
  CONSTRAINT `fk_Factura_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad1`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Establecimiento1` FOREIGN KEY (`Establecimiento_id_Establecimiento`) REFERENCES `establecimiento` (`id_Establecimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Empleado1` FOREIGN KEY (`Empleado_id_Doc_Identidad`) REFERENCES `empleado` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura_has_producto`
--

DROP TABLE IF EXISTS `factura_has_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura_has_producto` (
  `Factura_idFactura` bigint(20) NOT NULL,
  `Producto_id_Producto` bigint(20) NOT NULL,
  PRIMARY KEY (`Factura_idFactura`,`Producto_id_Producto`),
  KEY `fk_Factura_has_Producto_Producto1_idx` (`Producto_id_Producto`),
  KEY `fk_Factura_has_Producto_Factura1_idx` (`Factura_idFactura`),
  CONSTRAINT `fk_Factura_has_Producto_Factura1` FOREIGN KEY (`Factura_idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_has_Producto_Producto1` FOREIGN KEY (`Producto_id_Producto`) REFERENCES `producto` (`id_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura_has_producto`
--

LOCK TABLES `factura_has_producto` WRITE;
/*!40000 ALTER TABLE `factura_has_producto` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura_has_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `id_Producto` bigint(20) NOT NULL,
  `Prod_Descripcion` varchar(150) DEFAULT NULL,
  `Prod_ValorUnitario` double NOT NULL,
  `Prod_Marca` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_Producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (5,'3 Litros de Bebida Gaseosa-mente Deliciosa',4500,'Coca-Cola Company'),(6,'Papas de bolsita',1100,'Lays'),(9,'Papitas de limón',1100,'Margarita');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propietario`
--

DROP TABLE IF EXISTS `propietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propietario` (
  `id_Doc_Ideintidad` bigint(20) NOT NULL,
  `Pro_Nombre` varchar(45) DEFAULT NULL,
  `Usuario_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`id_Doc_Ideintidad`),
  KEY `fk_Propietario_Usuario1_idx` (`Usuario_id_Doc_Identidad`),
  CONSTRAINT `fk_Propietario_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propietario`
--

LOCK TABLES `propietario` WRITE;
/*!40000 ALTER TABLE `propietario` DISABLE KEYS */;
/*!40000 ALTER TABLE `propietario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_establecimiento`
--

DROP TABLE IF EXISTS `tipo_establecimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_establecimiento` (
  `id_Tipo_Establecimiento` bigint(20) NOT NULL,
  `TEst_Descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_Tipo_Establecimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_establecimiento`
--

LOCK TABLES `tipo_establecimiento` WRITE;
/*!40000 ALTER TABLE `tipo_establecimiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_establecimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_Doc_Identidad` bigint(20) NOT NULL,
  `Usr_Nombres` varchar(150) NOT NULL,
  `Usr_Apellidos` varchar(150) NOT NULL,
  `Usr_Password` varchar(150) NOT NULL,
  `Usr_Correo` varchar(150) NOT NULL,
  `Usr_Tipo_Documento` smallint(6) NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE KEY `id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (201010013010,'Jason','Cárcamo C.','217249c4f82851bef5ce1046b42fd4f3','jcarcam1@eafit.edu.co',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-08 19:26:47
