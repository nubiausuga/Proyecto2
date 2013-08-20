SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Producto` (
  `id_Producto` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  `Int_Precio` INT NULL,
  `id_Establecimiento` INT NOT NULL,
  PRIMARY KEY (`id_Producto`, `id_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Tipo_Establecimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Tipo_Establecimiento` (
  `Str_Descripcion` VARCHAR(150) NULL,
  `id_Tipo_Establecimiento` INT NOT NULL,
  PRIMARY KEY (`id_Tipo_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Usuario` (
  `id_Usuario` INT NOT NULL,
  `Str_Nombre` VARCHAR(150) NULL,
  `Str_Apellido` VARCHAR(150) NULL,
  `Str_Contrasena` VARCHAR(150) NULL,
  `Str_Correo` VARCHAR(150) NULL,
  `Str_Profesion` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Establecimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Establecimiento` (
  `id_Establecimiento` INT NOT NULL,
  `Str_Nombre` VARCHAR(150) NOT NULL,
  `Int_Responsable` INT NOT NULL,
  `Int_Tipo_Establecimiento` INT NOT NULL,
  PRIMARY KEY (`id_Establecimiento`),
  INDEX `id_Tipo_Establecimiento_idx` (`Int_Tipo_Establecimiento` ASC),
  INDEX `Int_Responsable_idx` (`Int_Responsable` ASC),
  CONSTRAINT `id_Establecimiento`
    FOREIGN KEY (`id_Establecimiento`)
    REFERENCES `mydb`.`Tbl_Producto` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Tipo_Establecimiento`
    FOREIGN KEY (`Int_Tipo_Establecimiento`)
    REFERENCES `mydb`.`Tbl_Tipo_Establecimiento` (`id_Tipo_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Int_Responsable`
    FOREIGN KEY (`Int_Responsable`)
    REFERENCES `mydb`.`Tbl_Usuario` (`id_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Cuenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Cuenta` (
  `id_Cuenta` INT NOT NULL,
  `Id_usuario` INT NULL,
  `Int_Saldo` INT NULL,
  `Str_Estado` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cuenta`),
  INDEX `id_Usuario_idx` (`Id_usuario` ASC),
  CONSTRAINT `id_Usuario`
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `mydb`.`Tbl_Usuario` (`id_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Movimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Movimiento` (
  `id_Movimiento` INT NOT NULL,
  `id_Establecimiento` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  `Str_Fecha` VARCHAR(150) NULL,
  `Str_hora` VARCHAR(150) NULL,
  `Str_Valor` VARCHAR(150) NULL,
  `id_Cuenta` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Establecimiento`),
  INDEX `id_Establecimiento_idx` (`id_Establecimiento` ASC),
  INDEX `id_Cuenta_idx` (`id_Cuenta` ASC),
  CONSTRAINT `id_Establecimiento`
    FOREIGN KEY (`id_Establecimiento`)
    REFERENCES `mydb`.`Tbl_Establecimiento` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Cuenta`
    FOREIGN KEY (`id_Cuenta`)
    REFERENCES `mydb`.`Tbl_Cuenta` (`id_Cuenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Movimiento_Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Movimiento_Producto` (
  `id_Movimiento` INT NOT NULL,
  `id_Producto` INT NOT NULL,
  `int_Cantidad` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Producto`),
  INDEX `id_Producto_idx` (`id_Producto` ASC),
  CONSTRAINT `id_Movimiento`
    FOREIGN KEY (`id_Movimiento`)
    REFERENCES `mydb`.`Tbl_Movimiento` (`id_Movimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Producto`
    FOREIGN KEY (`id_Producto`)
    REFERENCES `mydb`.`Tbl_Producto` (`id_Producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Empleado` (
  `id_Cedula` INT NOT NULL,
  `Str_Cargo` VARCHAR(150) NULL,
  `Str_Establecimiento` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cedula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tbl_Estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tbl_Estudiante` (
  `id_Cedula` INT NOT NULL,
  `Str_Carrera` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cedula`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
