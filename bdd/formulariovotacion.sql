-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema formulariovotacion
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `formulariovotacion` ;

-- -----------------------------------------------------
-- Schema formulariovotacion
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `formulariovotacion` DEFAULT CHARACTER SET utf8mb4 ;
USE `formulariovotacion` ;

-- -----------------------------------------------------
-- Table `formulariovotacion`.`candidatos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `formulariovotacion`.`candidatos` (
  `id_candidato` INT(11) NOT NULL,
  `nombre_candidato` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`id_candidato`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `formulariovotacion`.`comunas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `formulariovotacion`.`comunas` (
  `comuna_id` INT(11) NOT NULL,
  `comuna_nombre` VARCHAR(64) NOT NULL,
  `provincia_id` INT(11) NOT NULL,
  PRIMARY KEY (`comuna_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `formulariovotacion`.`provincias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `formulariovotacion`.`provincias` (
  `provincia_id` INT(11) NOT NULL,
  `provincia_nombre` VARCHAR(64) NOT NULL,
  `region_id` INT(11) NOT NULL,
  PRIMARY KEY (`provincia_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `formulariovotacion`.`regiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `formulariovotacion`.`regiones` (
  `region_id` INT(11) NOT NULL,
  `region_nombre` VARCHAR(64) NOT NULL,
  `region_ordinal` VARCHAR(4) NOT NULL,
  PRIMARY KEY (`region_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `formulariovotacion`.`votaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `formulariovotacion`.`votaciones` (
  `voto_id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre_apellido` VARCHAR(40) NOT NULL,
  `alias` VARCHAR(20) NOT NULL,
  `rut` VARCHAR(12) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `region` VARCHAR(30) NOT NULL,
  `comuna` VARCHAR(30) NOT NULL,
  `candidato` VARCHAR(40) NOT NULL,
  `como_se_entero` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`rut`))
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = utf8mb4;

CREATE UNIQUE INDEX `voto_id` ON `formulariovotacion`.`votaciones` (`voto_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
