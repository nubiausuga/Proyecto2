CREATE DATABASE  IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mydb`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Table structure for table `android`
--

DROP TABLE IF EXISTS `android`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `android` (
  `idAndroid` int(11) NOT NULL,
  `Android_Codigo` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`idAndroid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `android`
--

LOCK TABLES `android` WRITE;
/*!40000 ALTER TABLE `android` DISABLE KEYS */;
INSERT INTO `android` VALUES (1,201010013010);
/*!40000 ALTER TABLE `android` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `cuenta` VALUES (1017201436,0,'Activada',1017201436),(200927500010,0,'Activada',200927500010),(201010013010,4399,'Activada',201010013010);
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
  `empl_Establecimiento` varchar(150) NOT NULL,
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
INSERT INTO `empleado` VALUES (1017201436,'Developer',1017201436,'El Rancherito');
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
  `Nit_Establecimiento` varchar(50) NOT NULL,
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
INSERT INTO `establecimiento` VALUES (1231231231,'El Rancherito',870532934,'123.123.123-1');
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
  `Propietario_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`Establecimiento_id_Establecimiento`,`Propietario_id_Doc_Identidad`),
  KEY `fk_Establecimiento_has_Propietario_Propietario1_idx` (`Propietario_id_Doc_Identidad`),
  KEY `fk_Establecimiento_has_Propietario_Establecimiento1_idx` (`Establecimiento_id_Establecimiento`),
  CONSTRAINT `fk_Establecimiento_has_Propietario_Propietario1` FOREIGN KEY (`Propietario_id_Doc_Identidad`) REFERENCES `propietario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Establecimiento_has_Propietario_Establecimiento1` FOREIGN KEY (`Establecimiento_id_Establecimiento`) REFERENCES `establecimiento` (`id_Establecimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `establecimiento_has_propietario`
--

LOCK TABLES `establecimiento_has_propietario` WRITE;
/*!40000 ALTER TABLE `establecimiento_has_propietario` DISABLE KEYS */;
INSERT INTO `establecimiento_has_propietario` VALUES (1231231231,1017201436);
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
INSERT INTO `estudiante` VALUES (200927500010,'Ingenieria de Sistemas',200927500010),(201010013010,'Ingenieria de Sistemas',201010013010);
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
  UNIQUE KEY `idFactura_UNIQUE` (`idFactura`),
  KEY `fk_Factura_Usuario1_idx` (`Usuario_id_Doc_Identidad1`),
  KEY `fk_Factura_Establecimiento1_idx` (`Establecimiento_id_Establecimiento`),
  KEY `fk_Factura_Empleado1_idx` (`Empleado_id_Doc_Identidad`),
  CONSTRAINT `fk_Factura_Empleado1` FOREIGN KEY (`Empleado_id_Doc_Identidad`) REFERENCES `empleado` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Establecimiento1` FOREIGN KEY (`Establecimiento_id_Establecimiento`) REFERENCES `establecimiento` (`id_Establecimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad1`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura`
--

LOCK TABLES `factura` WRITE;
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` VALUES (2,'2013-11-13 18:13:16',5600,1,5600,0,201010013010,1231231231,1017201436),(3,'2013-11-13 19:24:52',1100,1,1100,0,201010013010,1231231231,1017201436),(4,'2013-11-13 19:26:36',1100,1,1100,0,201010013010,1231231231,1017201436),(5,'2013-11-13 19:27:06',1100,1,1100,0,201010013010,1231231231,1017201436),(6,'2013-11-13 22:24:36',4500,1,4500,0,201010013010,1231231231,1017201436),(8,'2013-11-13 23:27:23',2200,1,2200,0,201010013010,1231231231,1017201436),(9,'2013-11-13 23:35:20',2201,1,2201,0,201010013010,1231231231,1017201436),(10,'2013-11-13 23:38:34',5601,1,5601,0,201010013010,1231231231,1017201436);
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura_has_producto`
--

DROP TABLE IF EXISTS `factura_has_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura_has_producto` (
  `idFacturaProdcuto` bigint(20) NOT NULL AUTO_INCREMENT,
  `Factura_idFactura` bigint(20) NOT NULL,
  `Producto_id_Producto` bigint(20) NOT NULL,
  PRIMARY KEY (`idFacturaProdcuto`),
  UNIQUE KEY `idFacturaProdcuto_UNIQUE` (`idFacturaProdcuto`),
  KEY `fk_Factura_has_Producto_Producto1_idx` (`Producto_id_Producto`),
  KEY `fk_Factura_has_Producto_Factura1_idx` (`Factura_idFactura`),
  CONSTRAINT `fk_Factura_has_Producto_Factura1` FOREIGN KEY (`Factura_idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_has_Producto_Producto1` FOREIGN KEY (`Producto_id_Producto`) REFERENCES `producto` (`id_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura_has_producto`
--

LOCK TABLES `factura_has_producto` WRITE;
/*!40000 ALTER TABLE `factura_has_producto` DISABLE KEYS */;
INSERT INTO `factura_has_producto` VALUES (1,6,5),(2,5,9),(3,8,9),(4,9,9),(5,9,9),(6,10,5),(7,10,9);
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
INSERT INTO `producto` VALUES (5,'Coca-Cola 2.5 Litros',4500,'Coca-Cola Company'),(6,'Papas de bolsita',1100,'Lays'),(9,'Papitas de limon',1100,'Margarita');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propietario`
--

DROP TABLE IF EXISTS `propietario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propietario` (
  `id_Doc_Identidad` bigint(20) NOT NULL,
  `Pro_Nombre` varchar(45) DEFAULT NULL,
  `Usuario_id_Doc_Identidad` bigint(20) NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  KEY `fk_Propietario_Usuario1_idx` (`Usuario_id_Doc_Identidad`),
  CONSTRAINT `fk_Propietario_Usuario1` FOREIGN KEY (`Usuario_id_Doc_Identidad`) REFERENCES `usuario` (`id_Doc_Identidad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propietario`
--

LOCK TABLES `propietario` WRITE;
/*!40000 ALTER TABLE `propietario` DISABLE KEYS */;
INSERT INTO `propietario` VALUES (1017201436,'Jason Cárcamo',1017201436);
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
INSERT INTO `tipo_establecimiento` VALUES (870532934,'Cafeteria-Restaurante');
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
INSERT INTO `usuario` VALUES (1017201436,'Jason','Carcamo C.','217249c4f82851bef5ce1046b42fd4f3','jcarcam1@empleadosEafit.com',2),(200927500010,'Andrés Felipe','Ramírez Cuervo','81dc9bdb52d04dc20036dbd8313ed055','andresfr@gmail.com',1),(201010013010,'Jason','Carcamo C.','217249c4f82851bef5ce1046b42fd4f3','jcarcam1@eafit.edu.co',1);
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

-- Dump completed on 2013-11-13 18:38:43
