-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema profielapp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema profielapp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `profielapp` DEFAULT CHARACTER SET utf8mb3 ;
USE `profielapp` ;

-- -----------------------------------------------------
-- Table `profielapp`.`bedrijf`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`bedrijf` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`gebruikers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`gebruikers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `voornaam` VARCHAR(45) NOT NULL,
  `achternaam` VARCHAR(45) NOT NULL,
  `wachtwoord` VARCHAR(64) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `gebruikersnaam` VARCHAR(45) NOT NULL,
  `beheerder` INT NOT NULL,
  `aangemaakt_op` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`gebruiker_heeft_bedrijf`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`gebruiker_heeft_bedrijf` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gebruikers_id` INT NOT NULL,
  `bedrijf_id` INT NOT NULL,
  `startDatum` DATE NOT NULL,
  `eindDatum` DATE NULL DEFAULT NULL,
  `functieTitel` VARCHAR(45) NOT NULL,
  `locatie` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `gebruikers_id`, `bedrijf_id`),
  INDEX `fk_users_has_bedrijf_bedrijf1_idx` (`bedrijf_id` ASC) VISIBLE,
  INDEX `fk_users_has_bedrijf_users1_idx` (`gebruikers_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_has_bedrijf_bedrijf1`
    FOREIGN KEY (`bedrijf_id`)
    REFERENCES `profielapp`.`bedrijf` (`id`),
  CONSTRAINT `fk_users_has_bedrijf_users1`
    FOREIGN KEY (`gebruikers_id`)
    REFERENCES `profielapp`.`gebruikers` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`hobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`hobby` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`gebruiker_heeft_hobby`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`gebruiker_heeft_hobby` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Hobby_id` INT NOT NULL,
  `gebruikers_id` INT NOT NULL,
  `afbeelding` LONGBLOB NULL DEFAULT NULL,
  `beschrijving` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `Hobby_id`, `gebruikers_id`),
  INDEX `fk_Hobby_has_users_users1_idx` (`gebruikers_id` ASC) VISIBLE,
  INDEX `fk_Hobby_has_users_Hobby1_idx` (`Hobby_id` ASC) VISIBLE,
  CONSTRAINT `fk_Hobby_has_users_Hobby1`
    FOREIGN KEY (`Hobby_id`)
    REFERENCES `profielapp`.`hobby` (`id`),
  CONSTRAINT `fk_Hobby_has_users_users1`
    FOREIGN KEY (`gebruikers_id`)
    REFERENCES `profielapp`.`gebruikers` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`niveau`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`niveau` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`scholen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`scholen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`gebruiker_heeft_scholen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`gebruiker_heeft_scholen` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gebruikers_id` INT NOT NULL,
  `scholen_id` INT NOT NULL,
  `niveau_id` INT NOT NULL,
  `diploma` INT NULL DEFAULT NULL,
  `startDatum` DATE NULL DEFAULT NULL,
  `eindDatum` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `gebruikers_id`, `scholen_id`, `niveau_id`),
  INDEX `fk_gebruikers_has_scholen_scholen1_idx` (`scholen_id` ASC) VISIBLE,
  INDEX `fk_gebruikers_has_scholen_gebruikers1_idx` (`gebruikers_id` ASC) VISIBLE,
  INDEX `fk_gebruiker_heeft_scholen_niveau1_idx` (`niveau_id` ASC) VISIBLE,
  CONSTRAINT `fk_gebruiker_heeft_scholen_niveau1`
    FOREIGN KEY (`niveau_id`)
    REFERENCES `profielapp`.`niveau` (`id`),
  CONSTRAINT `fk_gebruikers_has_scholen_gebruikers1`
    FOREIGN KEY (`gebruikers_id`)
    REFERENCES `profielapp`.`gebruikers` (`id`),
  CONSTRAINT `fk_gebruikers_has_scholen_scholen1`
    FOREIGN KEY (`scholen_id`)
    REFERENCES `profielapp`.`scholen` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`vakken`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`vakken` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `profielapp`.`gebruiker_heeft_vakken`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `profielapp`.`gebruiker_heeft_vakken` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `gebruikers_id` INT NOT NULL,
  `vakken_id` INT NOT NULL,
  `cijfer` DECIMAL(10,0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `gebruikers_id`, `vakken_id`),
  INDEX `fk_users_has_vakken_vakken1_idx` (`vakken_id` ASC) VISIBLE,
  INDEX `fk_users_has_vakken_users1_idx` (`gebruikers_id` ASC) VISIBLE,
  CONSTRAINT `fk_users_has_vakken_users1`
    FOREIGN KEY (`gebruikers_id`)
    REFERENCES `profielapp`.`gebruikers` (`id`),
  CONSTRAINT `fk_users_has_vakken_vakken1`
    FOREIGN KEY (`vakken_id`)
    REFERENCES `profielapp`.`vakken` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
