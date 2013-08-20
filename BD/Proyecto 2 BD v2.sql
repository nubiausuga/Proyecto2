SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `Tbl_Producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Producto` ;

CREATE TABLE IF NOT EXISTS `Tbl_Producto` (
  `id_Producto` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  `Int_Precio` INT NULL,
  `id_Establecimiento` INT NOT NULL,
  PRIMARY KEY (`id_Producto`, `id_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Tbl_Tipo_Establecimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Tipo_Establecimiento` ;

CREATE TABLE IF NOT EXISTS `Tbl_Tipo_Establecimiento` (
  `Str_Descripcion` VARCHAR(150) NULL,
  `id_Tipo_Establecimiento` INT NOT NULL,
  PRIMARY KEY (`id_Tipo_Establecimiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Tbl_Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Usuario` ;

CREATE TABLE IF NOT EXISTS `Tbl_Usuario` (
  `id_Usuario` INT NOT NULL,
  `Str_Nombre` VARCHAR(150) NULL,
  `Str_Apellido` VARCHAR(150) NULL,
  `Str_Contrasena` VARCHAR(150) NULL,
  `Str_Correo` VARCHAR(150) NULL,
  `Str_Profesion` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Tbl_Establecimineto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Establecimineto` ;

CREATE TABLE IF NOT EXISTS `Tbl_Establecimineto` (
  `id_Establecimineto` INT NOT NULL,
  `Str_Nombre` VARCHAR(150) NULL,
  `Int_Responsable` INT NULL,
  `Int_Tipo_Establecimiento` INT NULL,
  PRIMARY KEY (`id_Establecimineto`),
  CONSTRAINT `id_Establecimiento`
    FOREIGN KEY (`id_Establecimineto`)
    REFERENCES `Tbl_Producto` (`id_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Tipo_Establecimiento`
    FOREIGN KEY (`Int_Tipo_Establecimiento`)
    REFERENCES `Tbl_Tipo_Establecimiento` (`id_Tipo_Establecimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Int_Responsable`
    FOREIGN KEY (`Int_Responsable`)
    REFERENCES `Tbl_Usuario` (`id_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_Tipo_Establecimiento_idx` ON `Tbl_Establecimineto` (`Int_Tipo_Establecimiento` ASC);

CREATE INDEX `Int_Responsable_idx` ON `Tbl_Establecimineto` (`Int_Responsable` ASC);


-- -----------------------------------------------------
-- Table `Tbl_Cuenta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Cuenta` ;

CREATE TABLE IF NOT EXISTS `Tbl_Cuenta` (
  `id_Cuenta` INT NOT NULL,
  `Id_usuario` INT NULL,
  `Int_Saldo` INT NULL,
  `Str_Estado` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cuenta`),
  CONSTRAINT `id_Usuario`
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `Tbl_Usuario` (`id_Usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_Usuario_idx` ON `Tbl_Cuenta` (`Id_usuario` ASC);


-- -----------------------------------------------------
-- Table `Tbl_Movimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Movimiento` ;

CREATE TABLE IF NOT EXISTS `Tbl_Movimiento` (
  `id_Movimiento` INT NOT NULL,
  `id_Establecimiento` INT NOT NULL,
  `Str_Descripcion` VARCHAR(150) NULL,
  `Str_Fecha` VARCHAR(150) NULL,
  `Str_hora` VARCHAR(150) NULL,
  `Str_Valor` VARCHAR(150) NULL,
  `id_Cuenta` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Establecimiento`),
  CONSTRAINT `id_Establecimiento`
    FOREIGN KEY (`id_Establecimiento`)
    REFERENCES `Tbl_Establecimineto` (`id_Establecimineto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Cuenta`
    FOREIGN KEY (`id_Cuenta`)
    REFERENCES `Tbl_Cuenta` (`id_Cuenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_Establecimiento_idx` ON `Tbl_Movimiento` (`id_Establecimiento` ASC);

CREATE INDEX `fk_Tbl_Movimiento_Tbl_Cuenta1_idx` ON `Tbl_Movimiento` (`id_Cuenta` ASC);


-- -----------------------------------------------------
-- Table `Tbl_Movimiento_Producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Movimiento_Producto` ;

CREATE TABLE IF NOT EXISTS `Tbl_Movimiento_Producto` (
  `id_Movimiento` INT NOT NULL,
  `id_Producto` INT NOT NULL,
  `int_Cantidad` INT NULL,
  PRIMARY KEY (`id_Movimiento`, `id_Producto`),
  CONSTRAINT `id_Movimiento`
    FOREIGN KEY (`id_Movimiento`)
    REFERENCES `Tbl_Movimiento` (`id_Movimiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_Producto`
    FOREIGN KEY (`id_Producto`)
    REFERENCES `Tbl_Producto` (`id_Producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `id_Producto_idx` ON `Tbl_Movimiento_Producto` (`id_Producto` ASC);


-- -----------------------------------------------------
-- Table `Tbl_Empleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Empleado` ;

CREATE TABLE IF NOT EXISTS `Tbl_Empleado` (
  `id_Cedula` INT NOT NULL,
  `Str_Cargo` VARCHAR(150) NULL,
  `Str_Establecimiento` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cedula`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Tbl_Estudiante`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `Tbl_Estudiante` ;

CREATE TABLE IF NOT EXISTS `Tbl_Estudiante` (
  `id_Cedula` INT NOT NULL,
  `Str_Carrera` VARCHAR(150) NULL,
  PRIMARY KEY (`id_Cedula`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
