-- MySQL Script generated by MySQL Workbench
-- 05/22/18 20:10:11
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema tosle_database
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tosle_database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tosle_database` DEFAULT CHARACTER SET utf8 ;
USE `tosle_database` ;

-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_file`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_file` (
  `file_id` INT NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(100) NULL,
  `file_path` VARCHAR(255) NULL,
  `file_type` INT NULL,
  `file_comment` VARCHAR(255) NULL,
  PRIMARY KEY (`file_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_firstname` VARCHAR(100) NULL,
  `user_lastname` VARCHAR(100) NULL,
  `user_pseudo` VARCHAR(100) NULL,
  `user_email` VARCHAR(255) NULL,
  `user_password` VARCHAR(255) NULL,
  `user_birthday` TIMESTAMP(0) NULL,
  `user_dateinscription` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `user_dateupdated` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_status` INT NULL,
  `user_newsletter` INT NULL,
  `user_token` VARCHAR(100) NULL,
  `user_dateconnection` TIMESTAMP(0) NULL,
  `user_fileid` INT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_tosle_user_tosle_file_idx` (`user_fileid` ASC),
  CONSTRAINT `fk_tosle_user_tosle_file`
    FOREIGN KEY (`user_fileid`)
    REFERENCES `tosle_database`.`tosle_file` (`file_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_group` (
  `group_id` INT NOT NULL AUTO_INCREMENT,
  `group_name` VARCHAR(100) NULL,
  `group_fileid` INT NULL,
  PRIMARY KEY (`group_id`),
  INDEX `fk_tosle_group_tosle_file1_idx` (`group_fileid` ASC),
  CONSTRAINT `fk_tosle_group_tosle_file1`
    FOREIGN KEY (`group_fileid`)
    REFERENCES `tosle_database`.`tosle_file` (`file_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_lesson` (
  `lesson_id` INT NOT NULL AUTO_INCREMENT,
  `lesson_title` VARCHAR(100) NULL,
  `lesson_description` VARCHAR(255) NULL,
  `lesson_datecreate` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `lesson_url` VARCHAR(100) NULL,
  `lesson_status` INT NULL,
  PRIMARY KEY (`lesson_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_chapter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_chapter` (
  `chapter_id` INT NOT NULL AUTO_INCREMENT,
  `chapter_title` VARCHAR(100) NULL,
  `chapter_content` LONGTEXT NULL,
  `chapter_datecreate` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `chapter_status` INT NULL,
  `chapter_type` INT NULL,
  `chapter_url` VARCHAR(100) NULL,
  `chapter_fileid` INT NULL,
  PRIMARY KEY (`chapter_id`),
  INDEX `fk_tosle_chapter_tosle_file1_idx` (`chapter_fileid` ASC),
  CONSTRAINT `fk_tosle_chapter_tosle_file1`
    FOREIGN KEY (`chapter_fileid`)
    REFERENCES `tosle_database`.`tosle_file` (`file_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_blog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_blog` (
  `blog_id` INT NOT NULL AUTO_INCREMENT,
  `blog_title` VARCHAR(100) NULL,
  `blog_type` INT NULL,
  `blog_content` LONGTEXT NULL,
  `blog_datecreate` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `blog_status` INT NULL,
  `blog_url` VARCHAR(100) NULL,
  `blog_fileid` INT NULL,
  PRIMARY KEY (`blog_id`),
  INDEX `fk_tosle_blog_tosle_file1_idx` (`blog_fileid` ASC),
  CONSTRAINT `fk_tosle_blog_tosle_file1`
    FOREIGN KEY (`blog_fileid`)
    REFERENCES `tosle_database`.`tosle_file` (`file_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_file`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_file` (
  `file_id` INT NOT NULL AUTO_INCREMENT,
  `file_name` VARCHAR(100) NULL,
  `file_path` VARCHAR(255) NULL,
  `file_type` INT NULL,
  `file_comment` VARCHAR(255) NULL,
  PRIMARY KEY (`file_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_conversation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_conversation` (
  `conversation_id` INT NOT NULL AUTO_INCREMENT,
  `conversation_iddest` INT NULL,
  `conversation_type` INT NULL,
  `conversation_datecreate` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `conversation_status` INT NULL,
  PRIMARY KEY (`conversation_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_message` (
  `message_id` INT NOT NULL AUTO_INCREMENT,
  `message_content` LONGTEXT NULL,
  `message_datecreate` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `message_status` INT NULL,
  `message_idsender` INT NOT NULL,
  `message_dateupdated` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  INDEX `fk_tosle_message_tosle_user1_idx` (`message_idsender` ASC),
  CONSTRAINT `fk_tosle_message_tosle_user1`
    FOREIGN KEY (`message_idsender`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_category` (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `category_name` VARCHAR(100) NULL,
  `category_type` INT NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_portfolio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_portfolio` (
  `portfolio_id` INT NOT NULL AUTO_INCREMENT,
  `portfolio_name` VARCHAR(100) NULL,
  `portfolio_value` LONGTEXT NULL,
  PRIMARY KEY (`portfolio_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_config`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_config` (
  `config_id` INT NOT NULL AUTO_INCREMENT,
  `config_name` VARCHAR(100) NULL,
  `config_value` LONGTEXT NULL,
  PRIMARY KEY (`config_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_notification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_notification` (
  `notification_id` INT NOT NULL AUTO_INCREMENT,
  `notification_name` VARCHAR(100) NULL,
  `notification_value` VARCHAR(255) NULL,
  `notification_type` INT NULL,
  `notification_iddest` INT NULL,
  PRIMARY KEY (`notification_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_homework`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_homework` (
  `homework_id` INT NOT NULL AUTO_INCREMENT,
  `homework_title` VARCHAR(100) NULL,
  `homework_type` INT NULL,
  `homework_value` VARCHAR(45) NULL,
  `homework_fileid` INT NULL,
  `homework_datecreate` TIMESTAMP(0) NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`homework_id`),
  INDEX `fk_tosle_homework_tosle_file1_idx` (`homework_fileid` ASC),
  CONSTRAINT `fk_tosle_homework_tosle_file1`
    FOREIGN KEY (`homework_fileid`)
    REFERENCES `tosle_database`.`tosle_file` (`file_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_mark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_mark` (
  `mark_id` INT NOT NULL AUTO_INCREMENT,
  `mark_type` INT NULL,
  `mark_value` FLOAT NULL,
  `mark_comment` VARCHAR(255) NULL,
  PRIMARY KEY (`mark_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_stats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_stats` (
  `stats_id` INT NOT NULL AUTO_INCREMENT,
  `stats_name` VARCHAR(100) NULL,
  `stats_value` FLOAT NULL,
  PRIMARY KEY (`stats_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_comment` (
  `comment_id` INT NOT NULL AUTO_INCREMENT,
  `comment_content` LONGTEXT NULL,
  PRIMARY KEY (`comment_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_userlesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_userlesson` (
  `userlesson_id` INT NOT NULL AUTO_INCREMENT,
  `userlesson_userid` INT NOT NULL,
  `userlesson_lessonid` INT NOT NULL,
  PRIMARY KEY (`userlesson_id`),
  INDEX `fk_tosle_userlessons_tosle_user1_idx` (`userlesson_userid` ASC),
  INDEX `fk_tosle_userlessons_tosle_lessons1_idx` (`userlesson_lessonid` ASC),
  CONSTRAINT `fk_tosle_userlessons_tosle_user1`
    FOREIGN KEY (`userlesson_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_userlessons_tosle_lessons1`
    FOREIGN KEY (`userlesson_lessonid`)
    REFERENCES `tosle_database`.`tosle_lesson` (`lesson_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_userchapter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_userchapter` (
  `userchapter_id` INT NOT NULL AUTO_INCREMENT,
  `userchapter_userid` INT NOT NULL,
  `userchapter_chapterid` INT NOT NULL,
  PRIMARY KEY (`userchapter_id`),
  INDEX `fk_tosle_userchapter_tosle_user1_idx` (`userchapter_userid` ASC),
  INDEX `fk_tosle_userchapter_tosle_chapter1_idx` (`userchapter_chapterid` ASC),
  CONSTRAINT `fk_tosle_userchapter_tosle_user1`
    FOREIGN KEY (`userchapter_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_userchapter_tosle_chapter1`
    FOREIGN KEY (`userchapter_chapterid`)
    REFERENCES `tosle_database`.`tosle_chapter` (`chapter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_homeworkmark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_homeworkmark` (
  `homeworkmark_id` INT NOT NULL AUTO_INCREMENT,
  `homeworkmark_userid` INT NOT NULL,
  `homeworkmark_homeworkid` INT NOT NULL,
  `homeworkmark_markid` INT NOT NULL,
  PRIMARY KEY (`homeworkmark_id`),
  INDEX `fk_tosle_homeworkmark_tosle_user1_idx` (`homeworkmark_userid` ASC),
  INDEX `fk_tosle_homeworkmark_tosle_homework1_idx` (`homeworkmark_homeworkid` ASC),
  INDEX `fk_tosle_homeworkmark_tosle_mark1_idx` (`homeworkmark_markid` ASC),
  CONSTRAINT `fk_tosle_homeworkmark_tosle_user1`
    FOREIGN KEY (`homeworkmark_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_homeworkmark_tosle_homework1`
    FOREIGN KEY (`homeworkmark_homeworkid`)
    REFERENCES `tosle_database`.`tosle_homework` (`homework_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_homeworkmark_tosle_mark1`
    FOREIGN KEY (`homeworkmark_markid`)
    REFERENCES `tosle_database`.`tosle_mark` (`mark_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_userhomework`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_userhomework` (
  `userhomework_id` INT NOT NULL AUTO_INCREMENT,
  `userhomework_homeworkid` INT NOT NULL,
  `userhomework_userid` INT NOT NULL,
  PRIMARY KEY (`userhomework_id`),
  INDEX `fk_tosle_userhomework_tosle_homework1_idx` (`userhomework_homeworkid` ASC),
  INDEX `fk_tosle_userhomework_tosle_user1_idx` (`userhomework_userid` ASC),
  CONSTRAINT `fk_tosle_userhomework_tosle_homework1`
    FOREIGN KEY (`userhomework_homeworkid`)
    REFERENCES `tosle_database`.`tosle_homework` (`homework_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_userhomework_tosle_user1`
    FOREIGN KEY (`userhomework_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_lessonmark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_lessonmark` (
  `lessonmark_id` INT NOT NULL AUTO_INCREMENT,
  `lessonmark_markid` INT NOT NULL,
  `lessonmark_lessonid` INT NOT NULL,
  `lessonmark_userid` INT NOT NULL,
  PRIMARY KEY (`lessonmark_id`),
  INDEX `fk_tosle_lessonmark_tosle_mark1_idx` (`lessonmark_markid` ASC),
  INDEX `fk_tosle_lessonmark_tosle_lesson1_idx` (`lessonmark_lessonid` ASC),
  INDEX `fk_tosle_lessonmark_tosle_user1_idx` (`lessonmark_userid` ASC),
  CONSTRAINT `fk_tosle_lessonmark_tosle_mark1`
    FOREIGN KEY (`lessonmark_markid`)
    REFERENCES `tosle_database`.`tosle_mark` (`mark_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_lessonmark_tosle_lesson1`
    FOREIGN KEY (`lessonmark_lessonid`)
    REFERENCES `tosle_database`.`tosle_lesson` (`lesson_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_lessonmark_tosle_user1`
    FOREIGN KEY (`lessonmark_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_chaptermark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_chaptermark` (
  `chaptermark_id` INT NOT NULL AUTO_INCREMENT,
  `chaptermark_markid` INT NOT NULL,
  `chaptermark_userid` INT NOT NULL,
  `chaptermark_chapterid` INT NOT NULL,
  PRIMARY KEY (`chaptermark_id`),
  INDEX `fk_tosle_chaptermark_tosle_mark1_idx` (`chaptermark_markid` ASC),
  INDEX `fk_tosle_chaptermark_tosle_user1_idx` (`chaptermark_userid` ASC),
  INDEX `fk_tosle_chaptermark_tosle_chapter1_idx` (`chaptermark_chapterid` ASC),
  CONSTRAINT `fk_tosle_chaptermark_tosle_mark1`
    FOREIGN KEY (`chaptermark_markid`)
    REFERENCES `tosle_database`.`tosle_mark` (`mark_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_chaptermark_tosle_user1`
    FOREIGN KEY (`chaptermark_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_chaptermark_tosle_chapter1`
    FOREIGN KEY (`chaptermark_chapterid`)
    REFERENCES `tosle_database`.`tosle_chapter` (`chapter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_blogmark`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_blogmark` (
  `blogmark_id` INT NOT NULL AUTO_INCREMENT,
  `blogmark_markid` INT NOT NULL,
  `blogmark_userid` INT NOT NULL,
  `blogmark_blogid` INT NOT NULL,
  PRIMARY KEY (`blogmark_id`),
  INDEX `fk_tosle_blogmark_tosle_mark1_idx` (`blogmark_markid` ASC),
  INDEX `fk_tosle_blogmark_tosle_user1_idx` (`blogmark_userid` ASC),
  INDEX `fk_tosle_blogmark_tosle_blog1_idx` (`blogmark_blogid` ASC),
  CONSTRAINT `fk_tosle_blogmark_tosle_mark1`
    FOREIGN KEY (`blogmark_markid`)
    REFERENCES `tosle_database`.`tosle_mark` (`mark_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_blogmark_tosle_user1`
    FOREIGN KEY (`blogmark_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_blogmark_tosle_blog1`
    FOREIGN KEY (`blogmark_blogid`)
    REFERENCES `tosle_database`.`tosle_blog` (`blog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_chaptercomment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_chaptercomment` (
  `chaptercomment_id` INT NOT NULL AUTO_INCREMENT,
  `chaptercomment_userid` INT NOT NULL,
  `chaptercomment_commentid` INT NOT NULL,
  `chaptercomment_chapterid` INT NOT NULL,
  PRIMARY KEY (`chaptercomment_id`),
  INDEX `fk_tosle_chaptercomment_tosle_user1_idx` (`chaptercomment_userid` ASC),
  INDEX `fk_tosle_chaptercomment_tosle_comment1_idx` (`chaptercomment_commentid` ASC),
  INDEX `fk_tosle_chaptercomment_tosle_chapter1_idx` (`chaptercomment_chapterid` ASC),
  CONSTRAINT `fk_tosle_chaptercomment_tosle_user1`
    FOREIGN KEY (`chaptercomment_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_chaptercomment_tosle_comment1`
    FOREIGN KEY (`chaptercomment_commentid`)
    REFERENCES `tosle_database`.`tosle_comment` (`comment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_chaptercomment_tosle_chapter1`
    FOREIGN KEY (`chaptercomment_chapterid`)
    REFERENCES `tosle_database`.`tosle_chapter` (`chapter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_blogcomment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_blogcomment` (
  `blogcomment_id` INT NOT NULL AUTO_INCREMENT,
  `blogcomment_userid` INT NOT NULL,
  `blogcomment_commentid` INT NOT NULL,
  `blogcomment_blogid` INT NOT NULL,
  PRIMARY KEY (`blogcomment_id`),
  INDEX `fk_tosle_blogcomment_tosle_user1_idx` (`blogcomment_userid` ASC),
  INDEX `fk_tosle_blogcomment_tosle_comment1_idx` (`blogcomment_commentid` ASC),
  INDEX `fk_tosle_blogcomment_tosle_blog1_idx` (`blogcomment_blogid` ASC),
  CONSTRAINT `fk_tosle_blogcomment_tosle_user1`
    FOREIGN KEY (`blogcomment_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_blogcomment_tosle_comment1`
    FOREIGN KEY (`blogcomment_commentid`)
    REFERENCES `tosle_database`.`tosle_comment` (`comment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_blogcomment_tosle_blog1`
    FOREIGN KEY (`blogcomment_blogid`)
    REFERENCES `tosle_database`.`tosle_blog` (`blog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_messageconversation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_messageconversation` (
  `messageconversation_id` INT NOT NULL AUTO_INCREMENT,
  `messageconversation_messageid` INT NOT NULL,
  `messageconversation_conversationid` INT NOT NULL,
  PRIMARY KEY (`messageconversation_id`),
  INDEX `fk_tosle_messageconversation_tosle_message1_idx` (`messageconversation_messageid` ASC),
  INDEX `fk_tosle_messageconversation_tosle_conversation1_idx` (`messageconversation_conversationid` ASC),
  CONSTRAINT `fk_tosle_messageconversation_tosle_message1`
    FOREIGN KEY (`messageconversation_messageid`)
    REFERENCES `tosle_database`.`tosle_message` (`message_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_messageconversation_tosle_conversation1`
    FOREIGN KEY (`messageconversation_conversationid`)
    REFERENCES `tosle_database`.`tosle_conversation` (`conversation_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_usergroup`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_usergroup` (
  `usergroup_id` INT NOT NULL AUTO_INCREMENT,
  `usergroup_groupid` INT NOT NULL,
  `usergroup_userid` INT NOT NULL,
  PRIMARY KEY (`usergroup_id`),
  INDEX `fk_tosle_usergroup_tosle_group1_idx` (`usergroup_groupid` ASC),
  INDEX `fk_tosle_usergroup_tosle_user1_idx` (`usergroup_userid` ASC),
  CONSTRAINT `fk_tosle_usergroup_tosle_group1`
    FOREIGN KEY (`usergroup_groupid`)
    REFERENCES `tosle_database`.`tosle_group` (`group_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_usergroup_tosle_user1`
    FOREIGN KEY (`usergroup_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_categorylesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_categorylesson` (
  `categorylesson_id` INT NOT NULL AUTO_INCREMENT,
  `categorylesson_categoryid` INT NOT NULL,
  `categorylesson_lessonid` INT NOT NULL,
  PRIMARY KEY (`categorylesson_id`),
  INDEX `fk_tosle_categorylesson_tosle_category1_idx` (`categorylesson_categoryid` ASC),
  INDEX `fk_tosle_categorylesson_tosle_lesson1_idx` (`categorylesson_lessonid` ASC),
  CONSTRAINT `fk_tosle_categorylesson_tosle_category1`
    FOREIGN KEY (`categorylesson_categoryid`)
    REFERENCES `tosle_database`.`tosle_category` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_categorylesson_tosle_lesson1`
    FOREIGN KEY (`categorylesson_lessonid`)
    REFERENCES `tosle_database`.`tosle_lesson` (`lesson_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_categoryblog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_categoryblog` (
  `categoryblog_id` INT NOT NULL AUTO_INCREMENT,
  `categoryblog_categoryid` INT NOT NULL,
  `categoryblog_blogid` INT NOT NULL,
  PRIMARY KEY (`categoryblog_id`),
  INDEX `fk_tosle_categoryblog_tosle_category1_idx` (`categoryblog_categoryid` ASC),
  INDEX `fk_tosle_categoryblog_tosle_blog1_idx` (`categoryblog_blogid` ASC),
  CONSTRAINT `fk_tosle_categoryblog_tosle_category1`
    FOREIGN KEY (`categoryblog_categoryid`)
    REFERENCES `tosle_database`.`tosle_category` (`category_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_categoryblog_tosle_blog1`
    FOREIGN KEY (`categoryblog_blogid`)
    REFERENCES `tosle_database`.`tosle_blog` (`blog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_subscriptionblog`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_subscriptionblog` (
  `subscriptionblog_id` INT NOT NULL AUTO_INCREMENT,
  `subscriptionblog_userid` INT NOT NULL,
  `subscriptionblog_blogid` INT NOT NULL,
  PRIMARY KEY (`subscriptionblog_id`),
  INDEX `fk_tosle_subscriptionblog_tosle_user1_idx` (`subscriptionblog_userid` ASC),
  INDEX `fk_tosle_subscriptionblog_tosle_blog1_idx` (`subscriptionblog_blogid` ASC),
  CONSTRAINT `fk_tosle_subscriptionblog_tosle_user1`
    FOREIGN KEY (`subscriptionblog_userid`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_subscriptionblog_tosle_blog1`
    FOREIGN KEY (`subscriptionblog_blogid`)
    REFERENCES `tosle_database`.`tosle_blog` (`blog_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_lessonchapter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_lessonchapter` (
  `lessonchapter_id` INT NOT NULL AUTO_INCREMENT,
  `lessonchapter_order` INT NULL,
  `lessonchapter_lessonid` INT NOT NULL,
  `lessonchapter_chapterid` INT NOT NULL,
  PRIMARY KEY (`lessonchapter_id`),
  INDEX `fk_tosle_lessonchapter_tosle_lesson1_idx` (`lessonchapter_lessonid` ASC),
  INDEX `fk_tosle_lessonchapter_tosle_chapter1_idx` (`lessonchapter_chapterid` ASC),
  CONSTRAINT `fk_tosle_lessonchapter_tosle_lesson1`
    FOREIGN KEY (`lessonchapter_lessonid`)
    REFERENCES `tosle_database`.`tosle_lesson` (`lesson_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tosle_lessonchapter_tosle_chapter1`
    FOREIGN KEY (`lessonchapter_chapterid`)
    REFERENCES `tosle_database`.`tosle_chapter` (`chapter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tosle_database`.`tosle_statsconnection`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tosle_database`.`tosle_statsconnection` (
  `statsconnection_id` INT NOT NULL AUTO_INCREMENT,
  `statsconnection_date` TIMESTAMP(0) NULL,
  `tosle_user_user_id` INT NOT NULL,
  PRIMARY KEY (`statsconnection_id`),
  INDEX `fk_tosle_statsconnection_tosle_user1_idx` (`tosle_user_user_id` ASC),
  CONSTRAINT `fk_tosle_statsconnection_tosle_user1`
    FOREIGN KEY (`tosle_user_user_id`)
    REFERENCES `tosle_database`.`tosle_user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
