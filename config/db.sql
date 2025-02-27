SET NAMES utf8;
SET SQL_MODE='';

CREATE DATABASE IF NOT EXISTS `shkolo_task` DEFAULT CHARACTER SET utf8;

USE `shkolo_task`;

DROP TABLE IF EXISTS `buttons_data`;

CREATE TABLE `buttons_data` (
         `id` INT PRIMARY KEY,
         `title` VARCHAR(255) NOT NULL,
         `link` TEXT NOT NULL,
         `color` VARCHAR(20) NOT NULL,
         `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
         `last_updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


INSERT INTO `buttons_data` (id, title, link, color) VALUES
                                                 (1, '', '', 'white'),
                                                 (2, '', '', 'white'),
                                                 (3, '', '', 'white'),
                                                 (4, '', '', 'white'),
                                                 (5, '', '', 'white'),
                                                 (6, '', '', 'white'),
                                                 (7, '', '', 'white'),
                                                 (8, '', '', 'white'),
                                                 (9, '', '', 'white');