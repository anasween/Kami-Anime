-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.34-MariaDB-log - MariaDB Server
-- ОС Сервера:                   Linux
-- HeidiSQL Версия:              8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных kamisite
CREATE DATABASE IF NOT EXISTS `u856840273_kami` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `u856840273_kami`;


-- Дамп структуры для таблица kamisite.action
CREATE TABLE IF NOT EXISTS `action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.action: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` (`id`, `title`, `comment`, `subject`) VALUES
	(1, 'create', 'Создание записи', 'Действие'),
	(2, 'read', 'Просмотр записи', 'Действие'),
	(3, 'update', 'Редактирование записи', 'Действие'),
	(4, 'delete', 'Удаление записи', 'Действие'),
	(5, 'message', 'Сообщения', 'Контроллер'),
	(6, 'user', 'Пользователи', 'Контроллер'),
	(7, 'news', 'Новости', 'Контроллер'),
	(8, 'admin', 'Управление записями', 'Действие'),
	(9, 'translation', 'Переводы', 'Контроллер'),
	(10, 'comments', 'Комментарии', 'Контроллер'),
	(11, 'anime', 'Аниме', 'Контроллер');
/*!40000 ALTER TABLE `action` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.anime
CREATE TABLE IF NOT EXISTS `anime` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_ru` varchar(100) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `name_jp` varchar(100) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `autor_id` int(10) unsigned NOT NULL,
  `createtime` timestamp NULL DEFAULT NULL,
  `modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `year` int(4) NOT NULL,
  `views` int(100) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Uniq` (`name_ru`,`name_en`,`name_jp`),
  KEY `FK__user` (`autor_id`),
  CONSTRAINT `FK__user` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Таблица со всеми аниме';

-- Дамп данных таблицы kamisite.anime: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `anime` DISABLE KEYS */;
INSERT INTO `anime` (`id`, `name_ru`, `name_en`, `name_jp`, `poster`, `autor_id`, `createtime`, `modify`, `year`, `views`, `description`) VALUES
	(2, 'Душа - 07', '07-Ghost', 'セブンゴースト', 'abb2b937a2b64cb558cd39a6b249ad40.jpg', 3, NULL, '2014-02-10 18:34:40', 2009, 0, '<p>\r\n	Юный Тейто Кляйн учится в военной академии Барсбургской Империи. Бывшего пленника из захваченной страны взяли в элитную школу из-за редкого дара владения «зайфоном» - местным эквивалентом магической энергии. Хотя среди невзгод военного времени Тейто утратил память о детстве и своем происхождении, недавнее рабское прошлое он помнит хорошо – как и окружающие учителя и ученики из «стержневой нации». Единственный способ выжить – пробиться в выпускники, а заканчивает академию лишь 1 из 25 кадетов. Так что днем парень грызет гранит науки, а ночью борется с кошмарами, в которых иногда приоткрывается прошлое. Если бы не единственный друг Микагэ – не дожил бы Тейто до суровых экзаменов. Вот только, собрав волю и силы в кулак, он и прошлое стал видеть отчетливей, и вдруг понял, что безжалостный ректор Аянами – тот человек, что убил его отца.</p><p>\r\n	<br>\r\n	Безрассудная попытка отомстить Аянами закончилась для героя дерзким побегом и обретением убежища в Церкви – единственной силе, способной противостоять военным в Империи. Церковники учат, что миф о падении злого бога Фелорена надо понимать буквально, и что его слуги во плоти давно ходят среди людей, готовя пробуждение своего господина. Лишь Семеро Духов, посланцев Света, что воплощаются в лучших из смертных, несут человечеству надежду на избавление от зла. Хотя церковники тоже люди и не совершенны, вера их крепка, и среди них мальчик нашел истинного Учителя. Кем же станет Тенто Кляйн, несущий в себе божественный артефакт – Глаз Михаила?</p>');
/*!40000 ALTER TABLE `anime` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.anime_zhanrs
CREATE TABLE IF NOT EXISTS `anime_zhanrs` (
  `anime_id` int(10) unsigned NOT NULL,
  `zhanr_id` int(10) unsigned NOT NULL,
  KEY `FK__anime` (`anime_id`),
  KEY `FK__zhanrs` (`zhanr_id`),
  CONSTRAINT `FK__anime` FOREIGN KEY (`anime_id`) REFERENCES `anime` (`id`),
  CONSTRAINT `FK__zhanrs` FOREIGN KEY (`zhanr_id`) REFERENCES `zhanrs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Жанры аниме';

-- Дамп данных таблицы kamisite.anime_zhanrs: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `anime_zhanrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `anime_zhanrs` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `autor_id` int(10) unsigned NOT NULL COMMENT 'Автор',
  `text` text NOT NULL COMMENT 'Текст',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `news_id` int(10) unsigned DEFAULT NULL COMMENT 'Новость',
  `group_id` int(10) unsigned DEFAULT NULL COMMENT 'Группа',
  `profile_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_user` (`autor_id`),
  KEY `FK_comments_news` (`news_id`),
  KEY `FK_comments_usergroup` (`group_id`),
  KEY `FK_comments_profile` (`profile_id`),
  CONSTRAINT `FK_comments_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  CONSTRAINT `FK_comments_profile` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`),
  CONSTRAINT `FK_comments_user` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_comments_usergroup` FOREIGN KEY (`group_id`) REFERENCES `usergroup` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Комментарии';

-- Дамп данных таблицы kamisite.comments: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `autor_id`, `text`, `createtime`, `news_id`, `group_id`, `profile_id`) VALUES
	(4, 3, '<ol>\r\n<li>Мне кажется я сделал добавление комментариев, УРАА!!!!</li><li>Их еще и изменять можно!!!</li><li>Вообще круто!</li></ol>', '2014-01-20 15:38:11', 2, NULL, NULL),
	(6, 3, '<p>123123123123</p>', '2014-02-04 12:52:20', NULL, 1, NULL),
	(7, 3, '<p>123123</p>', '2014-02-05 21:47:01', NULL, NULL, 3);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.friendship
CREATE TABLE IF NOT EXISTS `friendship` (
  `inviter_id` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  `acknowledgetime` int(11) DEFAULT NULL,
  `requesttime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  PRIMARY KEY (`inviter_id`,`friend_id`),
  KEY `FK_friendship_user_2` (`friend_id`),
  CONSTRAINT `FK_friendship_user` FOREIGN KEY (`inviter_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_friendship_user_2` FOREIGN KEY (`friend_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.friendship: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `friendship` DISABLE KEYS */;
/*!40000 ALTER TABLE `friendship` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.message
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` int(10) unsigned NOT NULL,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `message_read` tinyint(1) NOT NULL,
  `answered` tinyint(1) DEFAULT NULL,
  `draft` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_message_user` (`from_user_id`),
  KEY `FK_message_user_2` (`to_user_id`),
  CONSTRAINT `FK_message_user` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_message_user_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.message: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `autor_id` int(10) unsigned NOT NULL COMMENT 'Автор',
  `title` varchar(100) NOT NULL COMMENT 'Заголовок',
  `text` text NOT NULL COMMENT 'Текст',
  `create_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата создания',
  `views` int(100) NOT NULL DEFAULT '0' COMMENT 'Просмотры',
  PRIMARY KEY (`id`),
  KEY `news__tbl_users` (`autor_id`),
  CONSTRAINT `FK_news_user` FOREIGN KEY (`autor_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Новости';

-- Дамп данных таблицы kamisite.news: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `autor_id`, `title`, `text`, `create_Date`, `views`) VALUES
	(2, 3, 'Новая новость!!!', '<p>Что-то тут будет написано, много какого-то текста с картинками наверное...</p><p>Или нет, но тут как повезет. Нужно просто написать кучу бессмысленного текста как в ПЗ моей, можно доже копировать в ней смысла 0...</p><h4>Перечень изменений</h4><ul>\r\n<li><strong>Новый упрощенный дизайн.</strong> В стиле flat, с таким оформлением будет проще кастомизировать <a href="http://getbootstrap.com/examples/theme/">стандартную тему</a> фреймворка.</li><li><strong>Оптимизация для мобильных устройств: </strong>Bootstrap теперь всегда адаптивный, для удобства отображения любого сайта на маленьких экранах.</li><li><strong>Новый <a href="http://getbootstrap.com/customize/">кастомайзер</a>:</strong> более удобный и функциональный.</li><li><strong>Улучшенная блочная модель:</strong> везде используется box-sizing: border-box.</li><li><strong>Новая система сетки:</strong> добавлено больше возможностей, четыре типа классов сетки — телефон, планшет, десктоп и большой десктоп.</li><li><strong>Переписаны JavaScript плагины:</strong> много улучшений, в том числе в производительности.</li><li><strong>Новый иконки Glyphicons:</strong> 40 новых и все в формате иконочного шрифта.</li><li><strong>Улучшенный navbar</strong> для повышения адаптивности навигации сайта.</li><li><strong>Модальные окна оптимизированы</strong> для просмотра на мобильных устройствах.</li><li><strong>Добавлены новые компоненты</strong>, убраны устаревшие:</li><li><strong>Улучшение кастомизации элементов</strong> — кнопок, таблиц, форм, уведомлений и т.д.</li><li><strong>Убрана поддержка Internet Explorer 7 и Firefox 3.6:</strong> для корректной работы в IE 8 необходим <a href="https://github.com/scottjehl/Respond">Respond.js</a>. Больше о поддержки браузерами — в новой, улучшенной <a href="http://getbootstrap.com/getting-started/#browser-support">в документации</a>.</li></ul>', '2014-02-10 20:06:09', 72),
	(3, 3, 'Еще новость', '<p>Потестим что будет, если добавить видон с ютуба например:</p><p><iframe width="420" height="315" src="//www.youtube.com/embed/FFSU_3MJLww" frameborder="0" allowfullscreen=""></iframe></p>', '2014-01-31 12:11:04', 7);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.permission
CREATE TABLE IF NOT EXISTS `permission` (
  `principal_id` int(10) unsigned NOT NULL,
  `subordinate_id` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('user','role') NOT NULL,
  `action` int(10) unsigned NOT NULL,
  `subaction` int(10) unsigned NOT NULL,
  `template` tinyint(1) NOT NULL,
  `comment` text,
  PRIMARY KEY (`principal_id`,`subordinate_id`,`type`,`action`,`subaction`),
  KEY `FK_permission_action` (`action`),
  KEY `FK_permission_action_2` (`subaction`),
  CONSTRAINT `FK_permission_action` FOREIGN KEY (`action`) REFERENCES `action` (`id`),
  CONSTRAINT `FK_permission_action_2` FOREIGN KEY (`subaction`) REFERENCES `action` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.permission: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` (`principal_id`, `subordinate_id`, `type`, `action`, `subaction`, `template`, `comment`) VALUES
	(5, 5, 'role', 7, 1, 0, ''),
	(5, 5, 'role', 7, 3, 0, 'Контроллер новостей'),
	(5, 5, 'role', 7, 4, 0, ''),
	(5, 5, 'role', 7, 8, 0, 'Релизер имеет доступ к управлению новостями');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.privacysetting
CREATE TABLE IF NOT EXISTS `privacysetting` (
  `user_id` int(10) unsigned NOT NULL,
  `message_new_friendship` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_message` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_profilecomment` tinyint(1) NOT NULL DEFAULT '1',
  `appear_in_search` tinyint(1) NOT NULL DEFAULT '1',
  `show_online_status` tinyint(1) NOT NULL DEFAULT '1',
  `log_profile_visits` tinyint(1) NOT NULL DEFAULT '1',
  `ignore_users` varchar(255) DEFAULT NULL,
  `public_profile_fields` bigint(15) unsigned DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `FK_privacysetting_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.privacysetting: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `privacysetting` DISABLE KEYS */;
INSERT INTO `privacysetting` (`user_id`, `message_new_friendship`, `message_new_message`, `message_new_profilecomment`, `appear_in_search`, `show_online_status`, `log_profile_visits`, `ignore_users`, `public_profile_fields`) VALUES
	(3, 1, 1, 1, 1, 1, 1, '', 0);
/*!40000 ALTER TABLE `privacysetting` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `icq` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`),
  KEY `FK_profile_user` (`user_id`),
  CONSTRAINT `FK_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.profile: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `user_id`, `lastname`, `firstname`, `email`, `icq`, `skype`, `about`) VALUES
	(3, 3, 'Amelevich', 'Ilya', 'g.s.xbeer@mail.ru', '482572673', 'beer_131', '');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.profile_visit
CREATE TABLE IF NOT EXISTS `profile_visit` (
  `visitor_id` int(10) unsigned NOT NULL,
  `visited_id` int(10) unsigned NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`visitor_id`,`visited_id`),
  KEY `FK_profile_visit_user_2` (`visited_id`),
  CONSTRAINT `FK_profile_visit_user` FOREIGN KEY (`visitor_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_profile_visit_user_2` FOREIGN KEY (`visited_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.profile_visit: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `profile_visit` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_visit` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `membership_priority` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.role: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `title`, `description`, `membership_priority`, `price`, `duration`) VALUES
	(1, 'Moderator', 'Исправление ошибок, поиск и удаление спама.', 0, 0, 0),
	(5, 'Releaser', 'В обязанности входит заливка и оформление аниме/новостей/манги/дорам.', NULL, NULL, NULL);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.translation
CREATE TABLE IF NOT EXISTS `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`message`,`language`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.translation: ~2 959 rows (приблизительно)
/*!40000 ALTER TABLE `translation` DISABLE KEYS */;
INSERT INTO `translation` (`message`, `translation`, `language`, `category`) VALUES
	(_binary 0x41626F7574, 'Инфо', 'ru', 'yum'),
	(_binary 0x41636365737320636F6E74726F6C, 'Контроль доступа', 'ru', 'yum'),
	(_binary 0x416374696F6E, 'Действие', 'ru', 'yum'),
	(_binary 0x416374696F6E73, 'Действия', 'ru', 'yum'),
	(_binary 0x416374697665, 'Активирован', 'ru', 'yum'),
	(_binary 0x416374697665207573657273, 'Активных пользователей', 'ru', 'yum'),
	(_binary 0x416464, 'Добавить', 'ru', 'yum'),
	(_binary 0x41646420616E6F74686572205573657267726F7570, 'Создать другую группу', 'ru', 'yum'),
	(_binary 0x416464206173206120667269656E64, 'Добавить в друзья', 'ru', 'yum'),
	(_binary 0x41646D696E20696E626F78, 'Администрирование ящика', 'ru', 'yum'),
	(_binary 0x41646D696E207573657273, 'Администраторов', 'ru', 'yum'),
	(_binary 0x41646D696E697374726174696F6E, 'Администрирование', 'ru', 'yum'),
	(_binary 0x416C6C6F776564206C6F77657263617365206C65747465727320616E64206469676974732E, 'Допускаются строчные буквы и цифры.', 'ru', 'yum'),
	(_binary 0x416C7265616479206578697374732E, 'Уже существует.', 'ru', 'yum'),
	(_binary 0x416E696D65, 'Аниме', 'ru', 'yum'),
	(_binary 0x416E73776572, 'Ответить', 'ru', 'yum'),
	(_binary 0x416E7377657220746F2074686973206D657373616765, 'Ответить на это сообщение', 'ru', 'yum'),
	(_binary 0x41707065617220696E20736561726368, 'Показывать в поиске', 'ru', 'yum'),
	(_binary 0x41726520796F75207375726520746F2064656C6574652074686973206974656D3F, 'Вы действительно хотите удалить эту запись?', 'ru', 'yum'),
	(_binary 0x41726520796F75207375726520746F2072656D6F7665207468697320636F6D6D656E742066726F6D20796F75722070726F66696C653F, 'Вы уверены, что хотите удалить этот комент из профиля?', 'ru', 'yum'),
	(_binary 0x41737369676E207065726D697373696F6E, 'Назначить права доступа', 'ru', 'yum'),
	(_binary 0x417574686F72, 'Автор', 'ru', 'yum'),
	(_binary 0x4175746F72, 'Автор', 'ru', 'yum'),
	(_binary 0x4176617461722061646D696E697374726174696F6E, 'Администрирование аватаров', 'ru', 'yum'),
	(_binary 0x41766174617220696D616765, 'Аватар', 'ru', 'yum'),
	(_binary 0x4261636B, 'Назад', 'ru', 'yum'),
	(_binary 0x4261636B20746F20696E626F78, 'Назад к ящику', 'ru', 'yum'),
	(_binary 0x42616E6E6564, 'Заблокирован', 'ru', 'yum'),
	(_binary 0x42616E6E6564207573657273, 'Забанненых пользователей', 'ru', 'yum'),
	(_binary 0x42726F777365, 'Просмотр', 'ru', 'yum'),
	(_binary 0x42726F777365207573657267726F757073, 'Просмотр групп', 'ru', 'yum'),
	(_binary 0x42726F777365207573657273, 'Просмотр пользователей', 'ru', 'yum'),
	(_binary 0x43616E63656C, 'Отмена', 'ru', 'yum'),
	(_binary 0x43617465676F7279, 'Категория', 'ru', 'yum'),
	(_binary 0x4368616E67652050617373776F7264, 'Изменить пароль', 'ru', 'yum'),
	(_binary 0x4368616E67652061646D696E2050617373776F7264, 'Изменить пароль администратора', 'ru', 'yum'),
	(_binary 0x4368616E67652070617373776F7264, 'Изменить пароль', 'ru', 'yum'),
	(_binary 0x4368616E6765732069732073617665642E, 'Изменения сохранены.', 'ru', 'yum'),
	(_binary 0x436F6D6D656E74, 'Комментарий', 'ru', 'yum'),
	(_binary 0x436F6D706F7365, 'Написать', 'ru', 'yum'),
	(_binary 0x436F6E6669726D, 'Подтвердить', 'ru', 'yum'),
	(_binary 0x436F6E6669726D6174696F6E2070656E64696E67, 'Ожидает подтверждения', 'ru', 'yum'),
	(_binary 0x437265617465, 'Создать', 'ru', 'yum'),
	(_binary 0x43726561746520416374696F6E, 'Создать действие', 'ru', 'yum'),
	(_binary 0x4372656174652050726F66696C65204669656C64, 'Добавить', 'ru', 'yum'),
	(_binary 0x4372656174652055736572, 'Новый', 'ru', 'yum'),
	(_binary 0x437265617465205573657267726F7570, 'Создать группу', 'ru', 'yum'),
	(_binary 0x437265617465206D792070726F66696C65, 'Создать мой профиль', 'ru', 'yum'),
	(_binary 0x437265617465206E6577, 'Создать новость', 'ru', 'yum'),
	(_binary 0x437265617465206E6577205472616E736C6174696F6E, 'Создать новый перевод', 'ru', 'yum'),
	(_binary 0x437265617465206E65772055736572, 'Создать нового пользователя', 'ru', 'yum'),
	(_binary 0x437265617465206E6577205573657267726F7570, 'Создать новую группу', 'ru', 'yum'),
	(_binary 0x437265617465206E657720616374696F6E, 'Создать новое действие', 'ru', 'yum'),
	(_binary 0x437265617465206E657720726F6C65, 'Создать новую роль', 'ru', 'yum'),
	(_binary 0x437265617465206E6577207573657267726F7570, 'Создать новую группу', 'ru', 'yum'),
	(_binary 0x43726561746520726F6C65, 'Создать роль', 'ru', 'yum'),
	(_binary 0x44656661756C74, 'По умолчанию', 'ru', 'yum'),
	(_binary 0x44656C657465, 'Удалить', 'ru', 'yum'),
	(_binary 0x44656C657465204163636F756E74, 'Удалить аккаунт', 'ru', 'yum'),
	(_binary 0x44656C6574652050726F66696C65204669656C64, 'Удалить', 'ru', 'yum'),
	(_binary 0x44656C6574652055736572, 'Удалить', 'ru', 'yum'),
	(_binary 0x44656C657465206163636F756E74, 'Удалить аккаунт', 'ru', 'yum'),
	(_binary 0x44656C657465206E6577, 'Удалить новость', 'ru', 'yum'),
	(_binary 0x44656E79, 'Отклонить', 'ru', 'yum'),
	(_binary 0x4465736372697074696F6E, 'Описание', 'ru', 'yum'),
	(_binary 0x446966666572656E74207573657273206C6F6767656420696E20746F646179, 'Сегодня зашло разны пользователей', 'ru', 'yum'),
	(_binary 0x446973706C6179206F72646572206F66206669656C64732E, 'Порядок отображения полей.', 'ru', 'yum'),
	(_binary 0x446F206E6F742061707065617220696E20736561726368, 'Не показывать в поиске', 'ru', 'yum'),
	(_binary 0x446F20796F752077616E7420746F206772616E742074686973207065726D697373696F6E20746F20612075736572206F72206120726F6C65, 'Вы желаете назначить права доступа пользователю или роли', 'ru', 'yum'),
	(_binary 0x446F72616D73, 'Дорамы', 'ru', 'yum'),
	(_binary 0x452D6D61696C, 'Электронная почта', 'ru', 'yum'),
	(_binary 0x45646974, 'Редактировать', 'ru', 'yum'),
	(_binary 0x4564697420706572736F6E616C2064617461, 'Редактировать личную информацию', 'ru', 'yum'),
	(_binary 0x456469742070726F66696C65, 'Редактирование профиля', 'ru', 'yum'),
	(_binary 0x456469742070726F66696C65206669656C64, 'Редактировать поле профиля', 'ru', 'yum'),
	(_binary 0x456D61696C20697320696E636F72726563742E, 'Пользователь с таким электроным адресом не зарегистрирован.', 'ru', 'yum'),
	(_binary 0x4572726F72204D657373616765, 'Сообщение об ошибке', 'ru', 'yum'),
	(_binary 0x4572726F72206D657373616765207768656E20796F752076616C69646174652074686520666F726D2E, 'Сообщение об ошибке при проверке формы.', 'ru', 'yum'),
	(_binary 0x4669656C642053697A65, 'Размер поля', 'ru', 'yum'),
	(_binary 0x4669656C642053697A65206D696E, 'Минимальное значение', 'ru', 'yum'),
	(_binary 0x4669656C642054797065, 'Тип поля', 'ru', 'yum'),
	(_binary 0x4669656C64206E616D65206F6E20746865206C616E6775616765206F66202671756F743B736F757263654C616E67756167652671756F743B2E, 'Название поля на языке "sourceLanguage".', 'ru', 'yum'),
	(_binary 0x4669656C642073697A6520636F6C756D6E20696E207468652064617461626173652E, 'Размер поля колонки в базе данных', 'ru', 'yum'),
	(_binary 0x4669656C64207479706520636F6C756D6E20696E207468652064617461626173652E, 'Тип поля колонки в базе данных.', 'ru', 'yum'),
	(_binary 0x4669656C64732077697468202A206172652072657175697265642E, 'Поля с * к заполнению обязательны.', 'ru', 'yum'),
	(_binary 0x4669656C64732077697468203C7370616E20636C6173733D227265717569726564223E2A3C2F7370616E3E206172652072657175697265642E, 'Поля с <span class="required">*</span> обязательны к заполнению.', 'ru', 'yum'),
	(_binary 0x4669727374204E616D65, 'Имя', 'ru', 'yum'),
	(_binary 0x466F7220616C6C, 'Для всех', 'ru', 'yum'),
	(_binary 0x467269656E6473, 'Друзья', 'ru', 'yum'),
	(_binary 0x467269656E6473206F66207B757365726E616D657D, 'Друзья {username}', 'ru', 'yum'),
	(_binary 0x467269656E6473686970, 'Дружба', 'ru', 'yum'),
	(_binary 0x467269656E647368697020636F6E6669726D6564, 'Дружба подтверждена', 'ru', 'yum'),
	(_binary 0x467269656E6473686970207265717565737420616C72656164792073656E74, 'Запрос на дружбу уже отправлен', 'ru', 'yum'),
	(_binary 0x467269656E6473686970207265717565737420686173206265656E2072656A6563746564, 'Запрос дружбы был отклонен', 'ru', 'yum'),
	(_binary 0x46726F6D, 'От', 'ru', 'yum'),
	(_binary 0x4772616E74207065726D697373696F6E, 'Назначить права доступа', 'ru', 'yum'),
	(_binary 0x4772616E74207065726D697373696F6E20746F206E6577207573657273, 'Назначать права новым пользователям', 'ru', 'yum'),
	(_binary 0x47726F7570206F776E6572, 'Владелец группы', 'ru', 'yum'),
	(_binary 0x47726F7570207469746C65, 'Название группы', 'ru', 'yum'),
	(_binary 0x47726F757073, 'Группы', 'ru', 'yum'),
	(_binary 0x48656C70, 'Помощь', 'ru', 'yum'),
	(_binary 0x48696464656E, 'Скрыт', 'ru', 'yum'),
	(_binary 0x49676E6F726564207573657273, 'Игнорировать пользователей', 'ru', 'yum'),
	(_binary 0x496E616374697665207573657273, 'Неактивных пользователей', 'ru', 'yum'),
	(_binary 0x496E636F72726563742061637469766174696F6E2055524C2E, 'Неправильная ссылка активации учетной записи.', 'ru', 'yum'),
	(_binary 0x496E636F72726563742070617373776F726420286D696E696D616C206C656E67746820342073796D626F6C73292E, 'Минимальная длина пароля 4 символа.', 'ru', 'yum'),
	(_binary 0x496E636F7272656374207265636F76657279206C696E6B2E, 'Неправильная ссылка востановления пароля.', 'ru', 'yum'),
	(_binary 0x496E636F72726563742073796D626F6C27732E2028412D7A302D3929, 'В имени пользователя допускаются только латинские буквы и цифры.', 'ru', 'yum'),
	(_binary 0x496E636F727265637420757365726E616D6520286C656E677468206265747765656E203320616E642032302063686172616374657273292E, 'Длина имени пользователя от 3 до 20 символов.', 'ru', 'yum'),
	(_binary 0x496E737472756374696F6E732068617665206265656E2073656E7420746F20796F752E20506C6561736520636865636B20796F757220656D61696C2E, 'Инструкции были Вам высланы. Проверьте почту.', 'ru', 'yum'),
	(_binary 0x496E76616C696420726571756573742E20506C6561736520646F206E6F74207265706561742074686973207265717565737420616761696E2E, 'Ошибка в запросе. Пожалуйста не повторяйте его снова.', 'ru', 'yum'),
	(_binary 0x496E7669746174696F6E, 'Приглашение', 'ru', 'yum'),
	(_binary 0x4A6F696E2067726F7570, 'Присоединится к группе', 'ru', 'yum'),
	(_binary 0x4C616E6775616765, 'Язык', 'ru', 'yum'),
	(_binary 0x4C617374204E616D65, 'Фамилия', 'ru', 'yum'),
	(_binary 0x4C617374207669736974, 'Последний визит', 'ru', 'yum'),
	(_binary 0x4C656176652067726F7570, 'Покинуть группу', 'ru', 'yum'),
	(_binary 0x4C656176652070617373776F726420656D70747920746F2067656E657261746520612072616E646F6D2050617373776F7264, 'Для генерации случайного пароля оставте поле пустым', 'ru', 'yum'),
	(_binary 0x4C656176652070617373776F726420656D70747920746F2067656E657261746520612072616E646F6D2050617373776F726420, 'Для генерации случайного пароля оставте поле пустым', 'ru', 'yum'),
	(_binary 0x4C656176652070617373776F726420656D70747920746F206B65657020697420756E6368616E676564, 'Оставте поле пароля пустым, чтобы он не изменился', 'ru', 'yum'),
	(_binary 0x4C6574206D652061707065617220696E2074686520736561726368, 'Позволить показывать меня в поиске', 'ru', 'yum'),
	(_binary 0x4C65747465727320617265206E6F7420636173652D73656E7369746976652E, 'Регистр значение не имеет.', 'ru', 'yum'),
	(_binary 0x4C697374, 'Список', 'ru', 'yum'),
	(_binary 0x4C6973742050726F66696C65204669656C64, 'Список', 'ru', 'yum'),
	(_binary 0x4C6973742055736572, 'Список пользователей', 'ru', 'yum'),
	(_binary 0x4C6F6767656420696E206173, 'Вы вошли как', 'ru', 'yum'),
	(_binary 0x4C6F67696E, 'Вход', 'ru', 'yum'),
	(_binary 0x4C6F676F7574, 'Выйти', 'ru', 'yum'),
	(_binary 0x4C6F73742050617373776F72643F, 'Забыли пароль?', 'ru', 'yum'),
	(_binary 0x4C6F73742070617373776F72643F, 'Забыли пароль?', 'ru', 'yum'),
	(_binary 0x4D61696E, 'Главная', 'ru', 'yum'),
	(_binary 0x4D616E616765, 'Управление', 'ru', 'yum'),
	(_binary 0x4D616E61676520416374696F6E73, 'Управление действиями', 'ru', 'yum'),
	(_binary 0x4D616E6167652050726F66696C65204669656C64, 'Настройка полей', 'ru', 'yum'),
	(_binary 0x4D616E6167652050726F66696C65204669656C6473, 'Настройка полей', 'ru', 'yum'),
	(_binary 0x4D616E6167652050726F66696C6573, 'Управление профилями', 'ru', 'yum'),
	(_binary 0x4D616E61676520526F6C6573, 'Управление ролями', 'ru', 'yum'),
	(_binary 0x4D616E616765205472616E736C6174696F6E73, 'Управление переводами', 'ru', 'yum'),
	(_binary 0x4D616E6167652055736572, 'Управление пользователями', 'ru', 'yum'),
	(_binary 0x4D616E616765205573657273, 'Управление пользователями', 'ru', 'yum'),
	(_binary 0x4D616E616765206D7920667269656E6473, 'Управление моими друзьями', 'ru', 'yum'),
	(_binary 0x4D616E616765206E657773, 'Управление новостями', 'ru', 'yum'),
	(_binary 0x4D616E616765207065726D697373696F6E73, 'Управление правами доступа', 'ru', 'yum'),
	(_binary 0x4D616E6167652070726F66696C6573, 'Управление профилями', 'ru', 'yum'),
	(_binary 0x4D616E6761, 'Манга', 'ru', 'yum'),
	(_binary 0x4D61746368, 'Совпадение (RegExp)', 'ru', 'yum'),
	(_binary 0x4D657373616765, 'Сообщение', 'ru', 'yum'),
	(_binary 0x4D65737361676520227B6D6573736167657D2220686173206265656E2073656E7420746F207B746F7D, 'Сообщение "{message}" было отправлено {to}', 'ru', 'yum'),
	(_binary 0x4D65737361676520636F756E74, 'Сообщений', 'ru', 'yum'),
	(_binary 0x4D6573736167652066726F6D, 'Сообщение от', 'ru', 'yum'),
	(_binary 0x4D6573736167652066726F6D20, 'Сообщение от', 'ru', 'yum'),
	(_binary 0x4D65737361676573, 'Сообщения', 'ru', 'yum'),
	(_binary 0x4D696E696D616C2070617373776F7264206C656E67746820342073796D626F6C732E, 'Минимальная длина пароля 4 символа.', 'ru', 'yum'),
	(_binary 0x4D697363, 'Разное', 'ru', 'yum'),
	(_binary 0x4D7920667269656E6473, 'Мои друзья', 'ru', 'yum'),
	(_binary 0x4D792067726F757073, 'Мои группы', 'ru', 'yum'),
	(_binary 0x4D7920696E626F78, 'Мой ящик', 'ru', 'yum'),
	(_binary 0x4D792070726F66696C65, 'Мой профиль', 'ru', 'yum'),
	(_binary 0x4E657720667269656E64736869702072657175657374, 'Новый запрос дружбы', 'ru', 'yum'),
	(_binary 0x4E657720667269656E647368697020726571756573742066726F6D207B757365726E616D657D, 'Новый запрос дружбы от {username}', 'ru', 'yum'),
	(_binary 0x4E65772070617373776F7264, 'Новый пароль', 'ru', 'yum'),
	(_binary 0x4E65772070617373776F72642069732073617665642E, 'Новый пароль сохранен.', 'ru', 'yum'),
	(_binary 0x4E6577207472616E736C6174696F6E, 'Новый перевод', 'ru', 'yum'),
	(_binary 0x4E6577207573657273207265676973746572656420746F646179, 'Пользователей зарегестрированных сегодня', 'ru', 'yum'),
	(_binary 0x4E657773, 'Новости', 'ru', 'yum'),
	(_binary 0x4E657773206C697374, 'Список новостей', 'ru', 'yum'),
	(_binary 0x4E6F, 'Нет', 'ru', 'yum'),
	(_binary 0x4E6F2C206275742073686F77206F6E20726567697374726174696F6E20666F726D, 'Нет, но показать при регистрации', 'ru', 'yum'),
	(_binary 0x4E6F7420616374697665, 'Не активирован', 'ru', 'yum'),
	(_binary 0x4F6B, 'Ok', 'ru', 'yum'),
	(_binary 0x4F6E6C79206F776E6572, 'Только владелец', 'ru', 'yum'),
	(_binary 0x4F6E6C7920796F757220667269656E6473206172652073686F776E2068657265, 'Здесь показаны только ваши друзья', 'ru', 'yum'),
	(_binary 0x4F746865722056616C696461746F72, 'Другой валидатор', 'ru', 'yum'),
	(_binary 0x4F776E6572, 'Владелец', 'ru', 'yum'),
	(_binary 0x5061727469636970616E7420636F756E74, 'Участников', 'ru', 'yum'),
	(_binary 0x5061727469636970616E7473, 'Участники', 'ru', 'yum'),
	(_binary 0x50617373776F7264, 'Пароль', 'ru', 'yum'),
	(_binary 0x50617373776F726420697320696E636F72726563742E, 'Неверный пароль.', 'ru', 'yum'),
	(_binary 0x50617373776F726420737472656E677468, 'Надежность пароля', 'ru', 'yum'),
	(_binary 0x5065726D697373696F6E73, 'Права доступа', 'ru', 'yum'),
	(_binary 0x506C6561736520636865636B20796F757220656D61696C2E20416E20696E737472756374696F6E73207761732073656E7420746F20796F757220656D61696C20616464726573732E, 'На Ваш адрес электронной почты было отправлено письмо с инструкциями.', 'ru', 'yum'),
	(_binary 0x506C6561736520656E74657220612072657175657374204D65737361676520757020746F203235352063686172616374657273, 'Пожалуйста введите сообщение длинной менее 255 символов', 'ru', 'yum'),
	(_binary 0x506C6561736520656E74657220746865206C6574746572732061732074686579206172652073686F776E20696E2074686520696D6167652061626F76652E, 'Пожалуйста, введите буквы, показанные на картинке выше.', 'ru', 'yum'),
	(_binary 0x506C6561736520656E74657220796F7572206C6F67696E206F7220656D61696C206164647265732E, 'Пожалуйста, введите Ваш логин или адрес электронной почты.', 'ru', 'yum'),
	(_binary 0x506C656173652066696C6C206F75742074686520666F6C6C6F77696E6720666F726D207769746820796F7572206C6F67696E2063726564656E7469616C733A, 'Пожалуйста, заполните следующую форму с вашими Логин и паролем:', 'ru', 'yum'),
	(_binary 0x506F736974696F6E, 'Позиция', 'ru', 'yum'),
	(_binary 0x507265646566696E65642076616C75657320286578616D706C653A20312C20322C20332C20342C20353B292E, 'Предопределенные значения (пример: 1;2;3;4;5;).', 'ru', 'yum'),
	(_binary 0x5072696D617279, 'Основные', 'ru', 'yum'),
	(_binary 0x507269766163792073657474696E6773, 'Настройки приватности', 'ru', 'yum'),
	(_binary 0x5072697661637973657474696E6773, 'Настройки приватности', 'ru', 'yum'),
	(_binary 0x50726F66696C65, 'Профиль', 'ru', 'yum'),
	(_binary 0x50726F66696C6520436F6D6D656E7473, 'Комментарии профиля', 'ru', 'yum'),
	(_binary 0x50726F66696C65204669656C6473, 'Поля профиля', 'ru', 'yum'),
	(_binary 0x50726F66696C65206669656C64207075626C6963206F7074696F6E73, 'Настройки видимости столбцов профиля', 'ru', 'yum'),
	(_binary 0x50726F66696C6520766973697473, 'Посещения профилей', 'ru', 'yum'),
	(_binary 0x50726F66696C6573, 'Профили', 'ru', 'yum'),
	(_binary 0x52616E6765, 'Ряд значений', 'ru', 'yum'),
	(_binary 0x52656365697665206120456D61696C20666F72206E657720467269656E64736869702072657175657374, 'Присылать E-Mail при новом запросе на добавление в друзья', 'ru', 'yum'),
	(_binary 0x52656365697665206120456D61696C207768656E2061206E65772070726F66696C6520636F6D6D656E7420776173206D616465, 'Присылать E-Mail при добавлении комментария в мой профиль', 'ru', 'yum'),
	(_binary 0x52656365697665206120456D61696C207768656E206E6577204D6573736167652061727269766573, 'Присылать E-Mail при приходе нового сообщения', 'ru', 'yum'),
	(_binary 0x52656769737465726564207573657273, 'Зарегистрированные пользователи', 'ru', 'yum'),
	(_binary 0x526567697374726174696F6E, 'Регистрация', 'ru', 'yum'),
	(_binary 0x526567697374726174696F6E2064617465, 'Дата регистрации', 'ru', 'yum'),
	(_binary 0x526567756C61722065787072657373696F6E20286578616D706C653A272F5E5B412D5A612D7A302D39732C5D2B242F7527292E, 'Регулярные выражения (пример:\'/^[A-Za-z0-9s,]+$/u\')', 'ru', 'yum'),
	(_binary 0x52656D656D626572206D65206E6578742074696D65, 'Запомнить меня', 'ru', 'yum'),
	(_binary 0x52656D6F766520417661746172, 'Убрать аватар', 'ru', 'yum'),
	(_binary 0x52656D6F766520636F6D6D656E74, 'Удалить комментарий', 'ru', 'yum'),
	(_binary 0x52656D6F766520667269656E64, 'Убрать из друзей', 'ru', 'yum'),
	(_binary 0x5265706C79, 'Ответить', 'ru', 'yum'),
	(_binary 0x5265706C7920746F206D657373616765, 'Ответить на сообщение', 'ru', 'yum'),
	(_binary 0x5265717569726564, 'Обязательность', 'ru', 'yum'),
	(_binary 0x5265717569726564206669656C642028666F726D2076616C696461746F72292E, 'Обязательное поле (проверка формы).', 'ru', 'yum'),
	(_binary 0x526573746F7265, 'Восстановить', 'ru', 'yum'),
	(_binary 0x5265747970652050617373776F7264, 'Повторите пароль', 'ru', 'yum'),
	(_binary 0x5265747970652050617373776F726420697320696E636F72726563742E, 'Пароли не совпадают.', 'ru', 'yum'),
	(_binary 0x5265747970652070617373776F7264, 'Повторите пароль', 'ru', 'yum'),
	(_binary 0x52657479706520796F7572206E65772070617373776F7264, 'Повторите пароль', 'ru', 'yum'),
	(_binary 0x526F6C65, 'Роль', 'ru', 'yum'),
	(_binary 0x526F6C6573, 'Роли', 'ru', 'yum'),
	(_binary 0x526F6C6573202F2041636365737320636F6E74726F6C, 'Роли / Контроль доступа', 'ru', 'yum'),
	(_binary 0x53617665, 'Сохранить', 'ru', 'yum'),
	(_binary 0x536176652070726F66696C65206368616E676573, 'Применить изменения', 'ru', 'yum'),
	(_binary 0x5361766520726F6C65, 'Сохранить роль', 'ru', 'yum'),
	(_binary 0x536561726368, 'Поиск', 'ru', 'yum'),
	(_binary 0x53656172636820666F7220757365726E616D65, 'Искать по логину', 'ru', 'yum'),
	(_binary 0x53656C65637420746865206669656C647320746861742073686F756C64206265207075626C6963, 'Выберите столбцы, которые должны быть видимыми', 'ru', 'yum'),
	(_binary 0x53656E64, 'Отправить', 'ru', 'yum'),
	(_binary 0x53656E6420696E7669746174696F6E, 'Отправить приглашение', 'ru', 'yum'),
	(_binary 0x53656E64206D657373616765, 'Отправить сообщение', 'ru', 'yum'),
	(_binary 0x53656E74206D65737361676573, 'Отправленные сообщения', 'ru', 'yum'),
	(_binary 0x536570617261746520757365726E616D6573207769746820636F6D6D6120746F2069676E6F726520737065636966696564207573657273, 'Разделите логины запятыми для игноривания этих пользователей', 'ru', 'yum'),
	(_binary 0x5365742041766174617220666F72207573657220, 'Установить аватар пользователю ', 'ru', 'yum'),
	(_binary 0x53686F77206F6E6C696E6520737461747573, 'Показывать онлайн статус', 'ru', 'yum'),
	(_binary 0x53686F772070726F66696C6520766973697473, 'Показать посещения', 'ru', 'yum'),
	(_binary 0x5369676E656420696E206173, 'Вы вошли как', 'ru', 'yum'),
	(_binary 0x536F6369616C, 'Социальные', 'ru', 'yum'),
	(_binary 0x53746174697374696373, 'Статистика', 'ru', 'yum'),
	(_binary 0x537461747573, 'Статус', 'ru', 'yum'),
	(_binary 0x537570657275736572, 'Супер пользователь', 'ru', 'yum'),
	(_binary 0x54657874207472616E736C6174696F6E73, 'Переводы фраз', 'ru', 'yum'),
	(_binary 0x5468616E6B20796F7520666F7220796F757220726567697374726174696F6E2E20506C6561736520636865636B20796F757220656D61696C206F72206C6F67696E2E, 'Регистрация завершена. Пожалуйста проверьте свой электронный ящик или выполните вход.', 'ru', 'yum'),
	(_binary 0x5468616E6B20796F7520666F7220796F757220726567697374726174696F6E2E20506C6561736520636865636B20796F757220656D61696C2E, 'Регистрация завершена. Пожалуйста проверьте свой электронный ящик.', 'ru', 'yum'),
	(_binary 0x546865205573657267726F7570207B67726F75706E616D657D20686173206265656E207375636365737366756C6C792063726561746564, 'Группа {groupname} была успешно создана', 'ru', 'yum'),
	(_binary 0x54686520667269656E6473686970207265717565737420686173206265656E2073656E74, 'Запрос на добавление в друзья был отправлен', 'ru', 'yum'),
	(_binary 0x54686520696D6167652073686F756C642068617665206174206C65617374203530707820616E642061206D6178696D756D206F6620323030707820696E20776964746820616E64206865696768742E20537570706F727465642066696C65747970657320617265202E6A70672C202E67696620616E64202E706E67, 'Изображение должно быть как минимум 50px и как максимум 200px по ширине и высоте. Поддерживаемые расширения файлов: .jpg, .gif и .png', 'ru', 'yum'),
	(_binary 0x54686520696D616765207761732075706C6F61646564207375636365737366756C6C79, 'Картинка успешно загружена', 'ru', 'yum'),
	(_binary 0x546865206D696E696D756D2076616C7565206F6620746865206669656C642028666F726D2076616C696461746F72292E, 'Минимальное значение поля (проверка формы).', 'ru', 'yum'),
	(_binary 0x546865206E65772070617373776F726420686173206265656E207361766564, 'Новый пароль был сохранен', 'ru', 'yum'),
	(_binary 0x5468652076616C7565206F66207468652064656661756C74206669656C6420286461746162617365292E, 'Значение поля по умолчанию (база данных).', 'ru', 'yum'),
	(_binary 0x54686573652075736572732068617665206265656E2061737369676E656420746F207468697320726F6C65, 'Данным пользователям назначена эта роль', 'ru', 'yum'),
	(_binary 0x54686973206D6573736167652077696C6C2062652073656E7420746F207B757365726E616D657D, 'Это сообщение будет отправлено {username}', 'ru', 'yum'),
	(_binary 0x5468697320757365722062656C6F6E677320746F20746865736520726F6C65733A, 'Роли пользователя', 'ru', 'yum'),
	(_binary 0x546869732075736572277320656D61696C2061647265737320616C7265616479206578697374732E, 'Пользователь с таким электронным адресом уже существует.', 'ru', 'yum'),
	(_binary 0x5468697320757365722773206E616D6520616C7265616479206578697374732E, 'Пользователь с таким именем уже существует.', 'ru', 'yum'),
	(_binary 0x54696D65206F66206669727374207669736974, 'Время первого визита', 'ru', 'yum'),
	(_binary 0x54696D65206F66206C617374207669736974, 'Время последнего визита', 'ru', 'yum'),
	(_binary 0x54696D652073656E74, 'Время отправки', 'ru', 'yum'),
	(_binary 0x5469746C65, 'Название', 'ru', 'yum'),
	(_binary 0x546F, 'Кому', 'ru', 'yum'),
	(_binary 0x546F207468652070726F66696C65, 'К профилю', 'ru', 'yum'),
	(_binary 0x546F74616C204E756D206F6620566973697473, 'Количество посещений', 'ru', 'yum'),
	(_binary 0x546F74616C207573657273, 'Всего пользователей', 'ru', 'yum'),
	(_binary 0x5472616E736C6174696F6E, 'Перевод', 'ru', 'yum'),
	(_binary 0x5472616E736C6174696F6E732068617665206265656E207361766564, 'Перевод был успешно сохранен', 'ru', 'yum'),
	(_binary 0x54797065, 'Тип', 'ru', 'yum'),
	(_binary 0x557064617465, 'Изменить', 'ru', 'yum'),
	(_binary 0x55706461746520416374696F6E, 'Редактировать действие', 'ru', 'yum'),
	(_binary 0x5570646174652050726F66696C65204669656C64, 'Править', 'ru', 'yum'),
	(_binary 0x5570646174652055736572, 'Править', 'ru', 'yum'),
	(_binary 0x557064617465206D792070726F66696C65, 'Редактировать профиль', 'ru', 'yum'),
	(_binary 0x557064617465206E6577, 'Редактировать новость', 'ru', 'yum'),
	(_binary 0x55706461746520726F6C65, 'Редактировать роль', 'ru', 'yum'),
	(_binary 0x557064617465207472616E736C6174696F6E207B6D6573736167657D, 'Редактировать перевод {message}', 'ru', 'yum'),
	(_binary 0x55706C6F616420417661746172, 'Загрузить аватар', 'ru', 'yum'),
	(_binary 0x55706C6F616420617661746172, 'Загрузить аватар', 'ru', 'yum'),
	(_binary 0x55706C6F61642061766174617220496D616765, 'Загрузить аватар', 'ru', 'yum'),
	(_binary 0x55706C6F61642061766174617220666F722061646D696E, 'Загрузить аватар администратору', 'ru', 'yum'),
	(_binary 0x55706C6F61642061766174617220696D616765, 'Загрузить аватар', 'ru', 'yum'),
	(_binary 0x557365204772617661746172, 'Использовать Gravatar', 'ru', 'yum'),
	(_binary 0x55736572, 'Пользователь', 'ru', 'yum'),
	(_binary 0x557365722041646D696E697374726174696F6E, 'Администрирование пользователей', 'ru', 'yum'),
	(_binary 0x557365722061637469766174696F6E, 'Активация пользователя', 'ru', 'yum'),
	(_binary 0x557365722062656C6F6E677320746F20746865736520726F6C6573, 'Роли пользователя', 'ru', 'yum'),
	(_binary 0x5573657267726F757073, 'Группы', 'ru', 'yum'),
	(_binary 0x557365726E616D65, 'Логин', 'ru', 'yum'),
	(_binary 0x557365726E616D6520697320696E636F72726563742E, 'Пользователь с таким именем не зарегистрирован.', 'ru', 'yum'),
	(_binary 0x557365726E616D65206F722050617373776F726420697320696E636F7272656374, 'Имя пользователя или пароль введены неверно', 'ru', 'yum'),
	(_binary 0x5573657273, 'Пользователи', 'ru', 'yum'),
	(_binary 0x55736572733A, 'Пользователи:', 'ru', 'yum'),
	(_binary 0x5661726961626C65206E616D65, 'Имя переменной', 'ru', 'yum'),
	(_binary 0x566572696669636174696F6E20436F6465, 'Проверочный код', 'ru', 'yum'),
	(_binary 0x566572696669636174696F6E20636F6465, 'Код с картинки', 'ru', 'yum'),
	(_binary 0x56696577, 'Просмотреть', 'ru', 'yum'),
	(_binary 0x566965772044657461696C73, 'Подробнее', 'ru', 'yum'),
	(_binary 0x566965772050726F66696C65204669656C64, 'Просмотр', 'ru', 'yum'),
	(_binary 0x566965772050726F66696C65204669656C642023, 'Поле профиля #', 'ru', 'yum'),
	(_binary 0x566965772055736572, 'Просмотр профиля', 'ru', 'yum'),
	(_binary 0x56696577207573657220227B656D61696C7D22, 'Просмотр пользователя "{email}"', 'ru', 'yum'),
	(_binary 0x56696577207573657220227B757365726E616D657D22, 'Просмотр пользователя "{username}"', 'ru', 'yum'),
	(_binary 0x56697369626C65, 'Видимость', 'ru', 'yum'),
	(_binary 0x56697369742070726F66696C65, 'Посмотреть профиль', 'ru', 'yum'),
	(_binary 0x56697369746564, 'Посещенный', 'ru', 'yum'),
	(_binary 0x56697369746F72, 'Посетитель', 'ru', 'yum'),
	(_binary 0x57726974652061206D657373616765, 'Написать сообщение', 'ru', 'yum'),
	(_binary 0x57726974652061206D65737361676520746F20746869732055736572, 'Написать сообщение этому пользователю', 'ru', 'yum'),
	(_binary 0x577269746520636F6D6D656E74, 'Написать комментарий', 'ru', 'yum'),
	(_binary 0x5772697465206D657373616765, 'Написать', 'ru', 'yum'),
	(_binary 0x5772697474656E206174, 'Написано', 'ru', 'yum'),
	(_binary 0x5772697474656E2066726F6D, 'От', 'ru', 'yum'),
	(_binary 0x596573, 'Да', 'ru', 'yum'),
	(_binary 0x59657320616E642073686F77206F6E20726567697374726174696F6E20666F726D, 'Да и показать при регистрации', 'ru', 'yum'),
	(_binary 0x596F75206163636F756E74206973206163746976617465642E, 'Ваша учетная запись активирована.', 'ru', 'yum'),
	(_binary 0x596F75206163636F756E74206973206163746976652E, 'Ваша учетная запись уже активирована.', 'ru', 'yum'),
	(_binary 0x596F75206163636F756E7420697320626C6F636B65642E, 'Ваш аккаунт заблокирован.', 'ru', 'yum'),
	(_binary 0x596F75206163636F756E74206973206E6F74206163746976617465642E, 'Ваш аккаунт не активирован.', 'ru', 'yum'),
	(_binary 0x596F7520616C72656164792061726520667269656E6473, 'Вы уже друзья', 'ru', 'yum'),
	(_binary 0x596F7520646F206E6F74206861766520616E7920667269656E647320796574, 'У Вас еще нет друзей', 'ru', 'yum'),
	(_binary 0x596F7520646F206E6F7420686176652073657420616E2061766174617220696D61676520796574, 'У вас пока не установлен аватар', 'ru', 'yum'),
	(_binary 0x596F752068617665206A6F696E656420746869732067726F7570, 'Вы присоединились к данной группе', 'ru', 'yum'),
	(_binary 0x596F75722063757272656E742070617373776F7264, 'Ваш текущий пароль', 'ru', 'yum'),
	(_binary 0x596F757220667269656E6473686970207265717565737420686173206265656E206163636570746564, 'Ваш запрос на дружбу был подтвержден', 'ru', 'yum'),
	(_binary 0x596F757220707269766163792073657474696E67732068617665206265656E207361766564, 'Ваши настройки приватности были сохранены', 'ru', 'yum'),
	(_binary 0x596F75722070726F66696C65, 'Ваш профиль', 'ru', 'yum'),
	(_binary 0x5A68616E7273, 'Жанры', 'ru', 'yum'),
	(_binary 0x61626F7574, 'Обо мне', 'ru', 'yum'),
	(_binary 0x61637469766174696F6E206B6579, 'Ключ активации', 'ru', 'yum'),
	(_binary 0x656D61696C, 'E-Mail', 'ru', 'yum'),
	(_binary 0x66697273746E616D65, 'Имя', 'ru', 'yum'),
	(_binary 0x696371, 'ICQ', 'ru', 'yum'),
	(_binary 0x6C6173746E616D65, 'Фамилия', 'ru', 'yum'),
	(_binary 0x6C6173747669736974, 'Последний визит', 'ru', 'yum'),
	(_binary 0x70617373776F7264, 'Пароль', 'ru', 'yum'),
	(_binary 0x736B797065, 'Skype', 'ru', 'yum'),
	(_binary 0x757365726E616D65, 'Логин', 'ru', 'yum'),
	(_binary 0x757365726E616D65206F7220656D61696C, 'Логин или email', 'ru', 'yum');
/*!40000 ALTER TABLE `translation` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(64) CHARACTER SET latin1 NOT NULL,
  `activationKey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastvisit` int(11) NOT NULL DEFAULT '0',
  `lastaction` int(11) NOT NULL DEFAULT '0',
  `lastpasswordchange` int(11) NOT NULL DEFAULT '0',
  `failedloginattempts` int(11) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') DEFAULT 'Instant',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.user: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `failedloginattempts`, `superuser`, `status`, `avatar`, `notifyType`) VALUES
	(3, 'BeeR', '$2a$13$VRQ2UqlvjcRNDnER8PEKVemIxAjS77/rAW.cX0EdJmCOL7PvtgJFq', '$2a$13$MWMmM4kS0x4kxzatIVdpCuHJKyKGY3bpvUQY8gFrVf.5JbjyOL8fG', 1389561767, 1391867007, 1392051496, 1389561762, 0, 1, 1, 'images/avatars/3_1c8n.jpg', 'Instant');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.usergroup
CREATE TABLE IF NOT EXISTS `usergroup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(10) unsigned NOT NULL,
  `participants` text,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usergroup_user` (`owner_id`),
  CONSTRAINT `FK_usergroup_user` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.usergroup: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `usergroup` DISABLE KEYS */;
INSERT INTO `usergroup` (`id`, `owner_id`, `participants`, `title`, `description`) VALUES
	(1, 3, '["2","4"]', 'Ronin Inc.', 'Команда по переводу манги');
/*!40000 ALTER TABLE `usergroup` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `FK_user_role_role` (`role_id`),
  CONSTRAINT `FK_user_role_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `FK_user_role_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы kamisite.user_role: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
	(3, 1);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Дамп структуры для таблица kamisite.zhanrs
CREATE TABLE IF NOT EXISTS `zhanrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Жанры';

-- Дамп данных таблицы kamisite.zhanrs: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `zhanrs` DISABLE KEYS */;
INSERT INTO `zhanrs` (`id`, `title`) VALUES
	(1, 'Комедия'),
	(2, 'Драма'),
	(3, 'Повседневность');
/*!40000 ALTER TABLE `zhanrs` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
