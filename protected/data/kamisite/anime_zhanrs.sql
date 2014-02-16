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

-- Дамп структуры для таблица kamisite.anime_zhanrs
DROP TABLE IF EXISTS `anime_zhanrs`;
CREATE TABLE IF NOT EXISTS `anime_zhanrs` (
  `anime_id` int(10) unsigned NOT NULL,
  `zhanr_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`anime_id`,`zhanr_id`),
  KEY `FK__anime` (`anime_id`),
  KEY `FK__zhanrs` (`zhanr_id`),
  CONSTRAINT `FK__anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__zhanrs` FOREIGN KEY (`zhanr_id`) REFERENCES `zhanrs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Жанры аниме';

-- Экспортируемые данные не выделены.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
