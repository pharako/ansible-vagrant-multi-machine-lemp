CREATE TABLE IF NOT EXISTS `things` (
    `thing_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(128) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`thing_id`)
) ENGINE=InnoDB;

INSERT INTO `things` (`name`) VALUES
("Thing1"),
("Thing2"),
("Thing3");

