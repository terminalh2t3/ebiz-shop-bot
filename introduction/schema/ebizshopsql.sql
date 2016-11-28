# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: us-cdbr-iron-east-04.cleardb.net (MySQL 5.5.46-log)
# Database: heroku_aed1426a52073c7
# Generation Time: 2016-11-28 15:15:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bot_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bot_data`;

CREATE TABLE `bot_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bot_instances
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bot_instances`;

CREATE TABLE `bot_instances` (
  `id` varchar(150) NOT NULL,
  `name` varchar(255) NOT NULL,
  `meta` text,
  `status` varchar(50) NOT NULL,
  UNIQUE KEY `ix_instance_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table bot_leads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bot_leads`;

CREATE TABLE `bot_leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(10) unsigned DEFAULT NULL,
  `source` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'facebook',
  `user_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_wait` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_quick_save` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linked_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subscribe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_payment_enabled` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auto_stop` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `source` (`source`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `bot_leads` WRITE;
/*!40000 ALTER TABLE `bot_leads` DISABLE KEYS */;

INSERT INTO `bot_leads` (`id`, `instance_id`, `source`, `user_id`, `first_name`, `last_name`, `profile_pic`, `locale`, `timezone`, `gender`, `email`, `phone`, `country`, `location`, `_wait`, `_quick_save`, `linked_account`, `subscribe`, `is_payment_enabled`, `auto_stop`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(2,NULL,'facebook','1125092620944564','Vũ','Tuấn Anh','https://scontent.xx.fbcdn.net/v/t1.0-1/14702400_1317270528297879_3217915383972723060_n.jpg?oh=6cab96e523f1fb75f4db72d00cd65b68&oe=58B26420','en_US','7','male',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'2016-11-28 09:54:54','2016-11-28 09:54:54',NULL);

/*!40000 ALTER TABLE `bot_leads` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bot_leads_meta
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bot_leads_meta`;

CREATE TABLE `bot_leads_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `meta_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lead_id` (`user_id`,`meta_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bot_messages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bot_messages`;

CREATE TABLE `bot_messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(10) unsigned DEFAULT NULL,
  `to_lead` text,
  `to_channel` text,
  `content` text NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `notification_type` varchar(20) DEFAULT 'REGULAR',
  `send_limit` varchar(10) DEFAULT '1',
  `sent_count` int(11) unsigned NOT NULL DEFAULT '0',
  `routines` varchar(255) DEFAULT NULL,
  `unique_id` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_at` timestamp NULL DEFAULT NULL,
  `end_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_id` (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table bot_nodes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bot_nodes`;

CREATE TABLE `bot_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instance_id` int(10) unsigned DEFAULT NULL,
  `pattern` text COLLATE utf8_unicode_ci,
  `answers` text COLLATE utf8_unicode_ci NOT NULL,
  `wait` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sources` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notification_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'REGULAR',
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
