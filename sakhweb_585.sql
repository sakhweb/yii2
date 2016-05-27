-- phpMyAdmin SQL Dump
-- version 4.0.10.15
-- http://www.phpmyadmin.net
--
-- Хост: 10.0.0.168:3307
-- Время создания: Май 27 2016 г., 14:52
-- Версия сервера: 5.5.44-37.3-log
-- Версия PHP: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `sakhweb_585`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `title`) VALUES
(1, 'администратор'),
(2, 'пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(255) NOT NULL,
  `email_confirm_token` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `auth_key`, `email_confirm_token`, `password_hash`, `name`, `phone`, `email`, `role_id`, `status`) VALUES
(1, 'ru_KYqQzSZwgVHR49WReXeMlWe1SJ9To', NULL, '$2y$13$GgYqB6FXt5djPben/VT4KuzWzhQt2FyN76rVUp01Vewmsglpv/yua', 'admin', '+79117577981', 'www@sakh-web.ru', 1, 1),
(2, 'TpAOsO87x6mHfEYlzcPAQ5zy0xBgsOc7', '', '$2y$13$NKY4hLlBgFVaiuOsMCVtm.LcuLqR5GOvkD54YaybM73KihdzjxA/C', 'sakhweb', '+79117577981', 'homa1denis@rambler.ru', 2, 1);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
