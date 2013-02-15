SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `nippou` ;
CREATE SCHEMA IF NOT EXISTS `nippou` DEFAULT CHARACTER SET utf8 ;
USE `nippou` ;

-- -----------------------------------------------------
-- Table `nippou`.`defaults`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nippou`.`defaults` ;

CREATE  TABLE IF NOT EXISTS `nippou`.`defaults` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `content` VARCHAR(2555) NOT NULL ,
  `time` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nippou`.`forms`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nippou`.`forms` ;

CREATE  TABLE IF NOT EXISTS `nippou`.`forms` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `content` VARCHAR(2555) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `user_id` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nippou`.`kemail_queue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nippou`.`kemail_queue` ;

CREATE  TABLE IF NOT EXISTS `nippou`.`kemail_queue` (
  `id` INT(15) NOT NULL AUTO_INCREMENT ,
  `priority` INT(1) NOT NULL DEFAULT '5' ,
  `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  `from` VARCHAR(500) NOT NULL ,
  `to` VARCHAR(500) NOT NULL ,
  `subject` VARCHAR(500) NOT NULL ,
  `body` LONGTEXT NOT NULL ,
  `additional_headers` LONGTEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `priority` (`priority` ASC) ,
  INDEX `time` (`time` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nippou`.`mails`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nippou`.`mails` ;

CREATE  TABLE IF NOT EXISTS `nippou`.`mails` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `content` VARCHAR(2555) NOT NULL ,
  `send_time` DATETIME NULL ,
  `save_time` VARCHAR(45) NULL ,
  `status` INT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nippou`.`settings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nippou`.`settings` ;

CREATE  TABLE IF NOT EXISTS `nippou`.`settings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_id` INT(11) NOT NULL ,
  `name` VARCHAR(255) NOT NULL ,
  `time` INT(11) NOT NULL DEFAULT 24 ,
  `from_name` VARCHAR(255) NOT NULL ,
  `from_mail` VARCHAR(255) NOT NULL ,
  `to_email` VARCHAR(45) NULL DEFAULT 'nippou@oneofthem.jp' ,
  PRIMARY KEY (`id`) ,
  INDEX `user_id` (`user_id` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `nippou`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `nippou`.`users` ;

CREATE  TABLE IF NOT EXISTS `nippou`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(25) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username` (`username` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `nippou`.`forms`
-- -----------------------------------------------------
START TRANSACTION;
USE `nippou`;
INSERT INTO `nippou`.`forms` (`id`, `user_id`, `content`) VALUES (NULL, 1, 'お疲れ様です。<br>トゥーです。<br>{date}の日報をお送りいたします。<br><br>・勤務時間 {time1}&nbsp; ~ {time2}<br>１．【参加プロジェクトwikiと進捗】	<br>プロジェクト：爆釣！SG	Wiki：<br><br>２．【プロジェクト目標　および　個人DRI】	<br>プロジェクト:BuzzMe<br><br>３．【今日の作業内容　および　DRIチェック】<br>■MUST DO<br>{1}<br><br>■OTHER TASK	<br>{2}<br><br>４． 【明日以降のタスク】<br>■MUST DO<br>{3}	<br><br>■OTHER TASK[ASM] <br><br>【OTHER】<br><br>５． 【所感やネタ、情報共有など】　　<br><br>&nbsp;以上です<br>');
INSERT INTO `nippou`.`forms` (`id`, `user_id`, `content`) VALUES (NULL, 2, 'お疲れ様です、ロンです。<br><br>{date}の日報を送信します。<br><br>勤務時間 {time1} -{time2}<br><br>1. 【参加プロジェクトsushipanic v1.3と進捗】<br>{1}<br>3. 【今日の作業内容　および　DRIチェック】<br>■MUST DO<br>{2}<br><br>■OTHER<br>{3}\'');

COMMIT;

-- -----------------------------------------------------
-- Data for table `nippou`.`settings`
-- -----------------------------------------------------
START TRANSACTION;
USE `nippou`;
INSERT INTO `nippou`.`settings` (`id`, `user_id`, `name`, `time`, `from_name`, `from_mail`, `to_email`) VALUES (NULL, 1, 'タイン・トゥー', 24, 'Dang Thanh Tu', 'tu@oneofthem.jp', 'tu@oneofthem.jp');
INSERT INTO `nippou`.`settings` (`id`, `user_id`, `name`, `time`, `from_name`, `from_mail`, `to_email`) VALUES (NULL, 2, 'ロン', 24, 'Nguyen Thanh Long', 'long@oneofthem.jp', 'tu@oneofthem.jp');

COMMIT;

-- -----------------------------------------------------
-- Data for table `nippou`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `nippou`;
INSERT INTO `nippou`.`users` (`id`, `username`, `password`) VALUES (1, 'luckymancvp', 'bba19fea927b71d74e753f2487e107fd');
INSERT INTO `nippou`.`users` (`id`, `username`, `password`) VALUES (2, 'long', 'bb34bdb533b492a62429dd0541d70c6f');

COMMIT;
