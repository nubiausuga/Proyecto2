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
  `id_Tipo_Establecimiento` BIGINT NOT NULL,
  `TEst_Descripcion` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Tipo_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Establecimiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Establecimiento` (
  `id_Establecimiento` BIGINT NOT NULL,
  `Est_Nombre` VARCHAR(150) NOT NULL,
  `Tipo_Establecimiento_id_Tipo_Establecimiento1` BIGINT NOT NULL,
  PRIMARY KEY (`id_Establecimiento`),
  UNIQUE INDEX `id_Establecimiento_UNIQUE` (`id_Establecimiento` ASC),
  INDEX `fk_Establecimiento_Tipo_Establecimiento1_idx` (`Tipo_Establecimiento_id_Tipo_Establecimiento1` ASC),
  CONSTRAINT `fk_Establecimiento_Tipo_Establecimiento1`
    FOREIGN KEY (`Tipo_Establecimiento_id_Tipo_Establecimiento1`)
    REFERENCES `mydb`.`Tipo_Establecimiento` (`id_Tipo_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Producto` (
  `id_Producto` BIGINT NOT NULL,
  `Prod_Descripcion` VARCHAR(150) NULL,
  `Prod_ValorUnitario` DOUBLE NULL,
  PRIMARY KEY (`id_Producto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `id_Doc_Identidad` BIGINT NOT NULL,
  `Usr_Nombres` VARCHAR(150) NOT NULL,
  `Usr_Apellidos` VARCHAR(150) NOT NULL,
  `Usr_Password` VARCHAR(150) NOT NULL,
  `Usr_Correo` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE INDEX `id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Empleado` (
  `id_Doc_Identidad` BIGINT NOT NULL,
  `Str_Cargo` VARCHAR(150) NOT NULL,
  `Usuario_id_Doc_Identidad` BIGINT NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE INDEX `id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad` ASC),
  INDEX `fk_Empleado_Usuario1_idx` (`Usuario_id_Doc_Identidad` ASC),
  CONSTRAINT `fk_Empleado_Usuario1`
    FOREIGN KEY (`Usuario_id_Doc_Identidad`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cuenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cuenta` (
  `id_Cuenta` BIGINT NOT NULL,
  `Cuen_Saldo` DOUBLE NULL,
  `Cuen_Estado` VARCHAR(150) NULL,
  `Usuario_id_Doc_Identidad` BIGINT NOT NULL,
  PRIMARY KEY (`id_Cuenta`),
  INDEX `fk_Cuenta_Usuario1_idx` (`Usuario_id_Doc_Identidad` ASC),
  CONSTRAINT `fk_Cuenta_Usuario1`
    FOREIGN KEY (`Usuario_id_Doc_Identidad`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Estudiante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Estudiante` (
  `id_Doc_Identidad` BIGINT NOT NULL,
  `Str_Carrera` VARCHAR(150) NOT NULL,
  `Usuario_id_Doc_Identidad` BIGINT NOT NULL,
  PRIMARY KEY (`id_Doc_Identidad`),
  UNIQUE INDEX `Est_id_Doc_Identidad_UNIQUE` (`id_Doc_Identidad` ASC),
  INDEX `fk_Estudiante_Usuario1_idx` (`Usuario_id_Doc_Identidad` ASC),
  CONSTRAINT `fk_Estudiante_Usuario1`
    FOREIGN KEY (`Usuario_id_Doc_Identidad`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Factura` (
  `idFactura` BIGINT NOT NULL AUTO_INCREMENT,
  `Fac_Fecha` DATETIME NULL,
  `Fac_Total` DOUBLE NULL,
  `Fac_EstadoFactura` INT NULL,
  `Fact_ValorCarnet` DOUBLE NULL,
  `Fact_ValorEfectivo` DOUBLE NULL,
  `Usuario_id_Doc_Identidad1` BIGINT NOT NULL,
  `Establecimiento_id_Establecimiento` BIGINT NOT NULL,
  `Empleado_id_Doc_Identidad` BIGINT NOT NULL,
  PRIMARY KEY (`idFactura`),
  INDEX `fk_Factura_Usuario1_idx` (`Usuario_id_Doc_Identidad1` ASC),
  INDEX `fk_Factura_Establecimiento1_idx` (`Establecimiento_id_Establecimiento` ASC),
  INDEX `fk_Factura_Empleado1_idx` (`Empleado_id_Doc_Identidad` ASC),
  CONSTRAINT `fk_Factura_Usuario1`
    FOREIGN KEY (`Usuario_id_Doc_Identidad1`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Establecimiento1`
    FOREIGN KEY (`Establecimiento_id_Establecimiento`)
    REFERENCES `mydb`.`Establecimiento` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_Empleado1`
    FOREIGN KEY (`Empleado_id_Doc_Identidad`)
    REFERENCES `mydb`.`Empleado` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Propietario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Propietario` (
  `id_Doc_Ideintidad` BIGINT NOT NULL,
  `Pro_Nombre` VARCHAR(45) NULL,
  `Usuario_id_Doc_Identidad` BIGINT NOT NULL,
  PRIMARY KEY (`id_Doc_Ideintidad`),
  INDEX `fk_Propietario_Usuario1_idx` (`Usuario_id_Doc_Identidad` ASC),
  CONSTRAINT `fk_Propietario_Usuario1`
    FOREIGN KEY (`Usuario_id_Doc_Identidad`)
    REFERENCES `mydb`.`Usuario` (`id_Doc_Identidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Establecimiento_has_Propietario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Establecimiento_has_Propietario` (
  `Establecimiento_id_Establecimiento` BIGINT NOT NULL,
  `Propietario_id_Doc_Ideintidad` BIGINT NOT NULL,
  PRIMARY KEY (`Establecimiento_id_Establecimiento`, `Propietario_id_Doc_Ideintidad`),
  INDEX `fk_Establecimiento_has_Propietario_Propietario1_idx` (`Propietario_id_Doc_Ideintidad` ASC),
  INDEX `fk_Establecimiento_has_Propietario_Establecimiento1_idx` (`Establecimiento_id_Establecimiento` ASC),
  CONSTRAINT `fk_Establecimiento_has_Propietario_Establecimiento1`
    FOREIGN KEY (`Establecimiento_id_Establecimiento`)
    REFERENCES `mydb`.`Establecimiento` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Establecimiento_has_Propietario_Propietario1`
    FOREIGN KEY (`Propietario_id_Doc_Ideintidad`)
    REFERENCES `mydb`.`Propietario` (`id_Doc_Ideintidad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Factura_has_Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Factura_has_Producto` (
  `Factura_idFactura` BIGINT NOT NULL,
  `Producto_id_Producto` BIGINT NOT NULL,
  PRIMARY KEY (`Factura_idFactura`, `Producto_id_Producto`),
  INDEX `fk_Factura_has_Producto_Producto1_idx` (`Producto_id_Producto` ASC),
  INDEX `fk_Factura_has_Producto_Factura1_idx` (`Factura_idFactura` ASC),
  CONSTRAINT `fk_Factura_has_Producto_Factura1`
    FOREIGN KEY (`Factura_idFactura`)
    REFERENCES `mydb`.`Factura` (`idFactura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Factura_has_Producto_Producto1`
    FOREIGN KEY (`Producto_id_Producto`)
    REFERENCES `mydb`.`Producto` (`id_Producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
