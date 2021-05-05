# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.18-MariaDB)
# Datenbank: videostore
# Erstellt am: 2021-05-05 11:53:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Export von Tabelle languages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;

INSERT INTO `languages` (`id`, `code`)
VALUES
	(1,'de'),
	(2,'en'),
	(3,'ru');

/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;


# Export von Tabelle todos_lang
# ------------------------------------------------------------

DROP TABLE IF EXISTS `todos_lang`;

CREATE TABLE `todos_lang` (
  `todo_id` bigint(20) unsigned NOT NULL,
  `language_id` int(11) unsigned NOT NULL,
  `text` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`todo_id`,`language_id`),
  KEY `language_id` (`language_id`),
  CONSTRAINT `todos_lang_ibfk_1` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `todos_lang_ibfk_2` FOREIGN KEY (`todo_id`) REFERENCES `todos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `todos_lang` WRITE;
/*!40000 ALTER TABLE `todos_lang` DISABLE KEYS */;

INSERT INTO `todos_lang` (`todo_id`, `language_id`, `text`)
VALUES
	(1,1,'Consequatur adipisci neque vitae provident.'),
	(2,1,'Facere amet eveniet dolores et voluptatum.'),
	(3,1,'Debitis quis dolor consectetur aut aut.'),
	(4,1,'Expedita nulla sunt ipsa non.'),
	(5,1,'Laudantium sunt qui excepturi adipisci atque rem.'),
	(6,1,'Eos id corporis et vero.'),
	(7,1,'Voluptas quisquam est iure est consequatur aut.'),
	(8,1,'Qui laborum sit molestiae fuga omnis voluptates.'),
	(9,1,'Nam vitae non est nulla id.'),
	(10,1,'Ut et at magnam similique.'),
    (1,2,'Consequatur adipisci neque vitae provident.'),
    (2,2,'Facere amet eveniet dolores et voluptatum.'),
    (3,2,'Debitis quis dolor consectetur aut aut.'),
    (4,2,'Expedita nulla sunt ipsa non.'),
    (5,2,'Laudantium sunt qui excepturi adipisci atque rem.'),
    (6,2,'Eos id corporis et vero.'),
    (7,2,'Voluptas quisquam est iure est consequatur aut.'),
    (8,2,'Qui laborum sit molestiae fuga omnis voluptates.'),
    (9,2,'Nam vitae non est nulla id.'),
    (10,2,'Ut et at magnam similique.'),
    (1,3,'Consequatur adipisci neque vitae provident.'),
    (2,3,'Facere amet eveniet dolores et voluptatum.'),
    (3,3,'Debitis quis dolor consectetur aut aut.'),
    (4,3,'Expedita nulla sunt ipsa non.'),
    (5,3,'Laudantium sunt qui excepturi adipisci atque rem.'),
    (6,3,'Eos id corporis et vero.'),
    (7,3,'Voluptas quisquam est iure est consequatur aut.'),
    (8,3,'Qui laborum sit molestiae fuga omnis voluptates.'),
    (9,3,'Nam vitae non est nulla id.'),
    (10,3,'Ut et at magnam similique.');

/*!40000 ALTER TABLE `todos_lang` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
