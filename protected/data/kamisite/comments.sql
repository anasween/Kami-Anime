-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.35-MariaDB-log - MariaDB Server
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица kamisite.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `autor_id` int(10) unsigned NOT NULL COMMENT 'Автор',
  `text` text NOT NULL COMMENT 'Текст',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `news_id` int(10) unsigned DEFAULT NULL COMMENT 'Новость',
  `group_id` int(10) unsigned DEFAULT NULL COMMENT 'Группа',
  `profile_id` int(10) unsigned DEFAULT NULL,
  `anime_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_user` (`autor_id`),
  KEY `FK_comments_news` (`news_id`),
  KEY `FK_comments_usergroup` (`group_id`),
  KEY `FK_comments_profile` (`profile_id`),
  KEY `FK_comments_anime` (`anime_id`),
  CONSTRAINT `FK_comments_anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`),
  CONSTRAINT `FK_comments_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  CONSTRAINT `FK_comments_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `FK_comments_user` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_comments_usergroup` FOREIGN KEY (`group_id`) REFERENCES `usergroup` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Комментарии';

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
