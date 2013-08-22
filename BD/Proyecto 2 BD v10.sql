SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Tipo_Establecimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tipo_Establecimiento` (
  `id_Tipo_Establecimiento` INT NOT NULL,
  `TEst_Descripcion` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Tipo_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `id_Doc_Identidad` INT NOT NULL,
  `Usr_Nombres` VARCHAR(150) NOT NULL,
  `Usr_Apellidos` VARCHAR(150) NOT NULL,
  `Usr_Password` VARCHAR(150) NOT NULL,
  `Usr_Correo` VARCHAR(150) NOT NULL,
  `Usr_Tipo_Documento` INT NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE INDEX `id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Establecimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Establecimiento` (
  `id_Establecimiento` INT NOT NULL,
  `Est_Nombre` VARCHAR(150) NOT NULL,
  `Est_Responsable` INT NOT NULL,
  `Est_Tipo_Establecimiento` INT NOT NULL,
  PRIMARY KEY (`id_Establecimiento`),
  INDEX `id_Tipo_Establecimiento_idx` (`Est_Tipo_Establecimiento` ASC),
  INDEX `Int_Responsable_idx` (`Est_Responsable` ASC),
  UNIQUE INDEX `id_Establecimiento_UNIQUE` (`id_Establecimiento` ASC),
  CONSTRAINT `id_Tipo_Establecimiento`
    FOREIGN KEY (`Est_Tipo_Establecimiento`)
    REFERENCES `mydb`.`Tipo_Establecimiento` (`id_Tipo_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Int_Responsable`
    FOREIGN KEY (`Est_Responsable`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cuenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cuenta` (
  `id_Cuenta` INT NOT NULL,
  `Id_usuario` INT NULL,
  `Cuen_Saldo` INT NULL,
  `Cuen_Estado` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cuenta`),
  INDEX `id_Usuario_idx` (`Id_usuario` ASC),
  CONSTRAINT `id_Usuario`
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Movimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Movimiento` (
  `id_Movimiento` INT NOT NULL,
  `id_Establecimiento` INT NOT NULL,
  `Mov_Descripcion` VARCHAR(150) NULL,
  `Mov_Fecha` VARCHAR(150) NULL,
  `Mov_Hora` VARCHAR(150) NULL,
  `Mov_Valor` VARCHAR(150) NULL,
  `id_Cuenta` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Establecimiento`),
  INDEX `id_Establecimiento_idx` (`id_Establecimiento` ASC),
  INDEX `id_Cuenta_idx` (`id_Cuenta` ASC),
  CONSTRAINT `id_Establecimiento`
    FOREIGN KEY (`id_Establecimiento`)
    REFERENCES `mydb`.`Establecimiento` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Cuenta`
    FOREIGN KEY (`id_Cuenta`)
    REFERENCES `mydb`.`Cuenta` (`id_Cuenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Producto` (
  `id_Producto` INT NOT NULL,
  `Prod_Descripcion` VARCHAR(150) NULL,
  `Prod_Precio` INT NULL,
  `Prod_id_Establecimiento` INT NULL,
  PRIMARY KEY (`id_Producto`),
  INDEX `Int_id_Establecimiento_idx` (`Prod_id_Establecimiento` ASC),
  CONSTRAINT `Int_id_Establecimiento`
    FOREIGN KEY (`Prod_id_Establecimiento`)
    REFERENCES `mydb`.`Establecimiento` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Movimiento_Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Movimiento_Producto` (
  `id_Movimiento` INT NOT NULL,
  `id_Producto` INT NOT NULL,
  `MovP_Cantidad` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Producto`),
  INDEX `id_Producto_idx` (`id_Producto` ASC),
  CONSTRAINT `id_Movimiento`
    FOREIGN KEY (`id_Movimiento`)
    REFERENCES `mydb`.`Movimiento` (`id_Movimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Producto`
    FOREIGN KEY (`id_Producto`)
    REFERENCES `mydb`.`Producto` (`id_Producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Empleado` (
  `id_Doc_Identidad` INT NOT NULL,
  `Str_Cargo` VARCHAR(150) NOT NULL,
  `Str_Establecimiento` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE INDEX `id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad` ASC),
  CONSTRAINT `id_Doc_Identidad`
    FOREIGN KEY (`id_Doc_Identidad`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Estudiante` (
  `Est_id_Doc_Identidad` INT NOT NULL,
  `Str_Carrera` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`Est_id_Doc_Identidad`),
  UNIQUE INDEX `Est_id_Doc_Identidad_UNIQUE` (`Est_id_Doc_Identidad` ASC),
  CONSTRAINT `Est_id_Doc_Identidad`
    FOREIGN KEY (`Est_id_Doc_Identidad`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
