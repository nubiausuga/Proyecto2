SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Movimiento_Producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Movimiento_Producto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Movimiento_Producto` (
  `id_Movimiento` INT NOT NULL,
  `id_Producto` INT NOT NULL,
  `int_Cantidad` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Producto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Tipo_Establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Tipo_Establecimiento` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Tipo_Establecimiento` (
  `id_Tipo_Establecimiento` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Tipo_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Movimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Movimiento` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Movimiento` (
  `id_Movimiento` INT NOT NULL,
  `id_Establecimiento` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  `Str_Fecha` VARCHAR(150) NULL,
  `Str_hora` VARCHAR(150) NULL,
  `Str_Valor` VARCHAR(150) NULL,
  `id_Cuenta` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Establecimineto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Establecimineto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Establecimineto` (
  `id_Establecimineto` INT NOT NULL,
  `Str_Nombre` VARCHAR(150) NULL,
  `Str_Responsable` VARCHAR(150) NULL,
  `Int_Tipo_Establecimiento` INT NULL,
  PRIMARY KEY (`id_Establecimineto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Producto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Producto` (
  `id_Producto` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  `Int_Precio` INT NULL,
  `Int_id_Establecimineto` INT NULL,
  PRIMARY KEY (`id_Producto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Usuario` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Usuario` (
  `id_Codigo` INT NOT NULL,
  `Str_Nombre` VARCHAR(150) NULL,
  `Str_Apellido` VARCHAR(150) NULL,
  `Str_Contrasena` VARCHAR(150) NULL,
  `Str_Correo` VARCHAR(150) NULL,
  `Str_Tipo_Usuario` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Codigo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Empleado` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Empleado` (
  `id_Cedula` INT NOT NULL,
  `Str_Cargo` VARCHAR(150) NULL,
  `Str_Establecimiento` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cedula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Cuenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Cuenta` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Cuenta` (
  `id_Cuenta` INT NOT NULL,
  `Id_usuario` INT NULL,
  `Int_Saldo` INT NULL,
  `Str_Estado` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cuenta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Estudiante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Tbl_Estudiante` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Estudiante` (
  `id_Cedula` INT NOT NULL,
  `Str_Carrera` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cedula`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
