-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 07 2015 г., 12:45
-- Версия сервера: 5.5.43-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `Romania`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Goods`
--

CREATE TABLE IF NOT EXISTS `Goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Goods`
--

INSERT INTO `Goods` (`id`, `name`, `price`) VALUES
(1, 'Дом на берегу моря', 3000000),
(2, 'Яхта', 2500000),
(3, 'Коробка спичек', 1),
(4, 'Пластиковый стакан (0,3 л)', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `UserGoods`
--

CREATE TABLE IF NOT EXISTS `UserGoods` (
  `userId` int(11) NOT NULL,
  `goodId` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`,`goodId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `UserGoods`
--

INSERT INTO `UserGoods` (`userId`, `goodId`, `count`) VALUES
(1, 3, 4),
(1, 4, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `money` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `pass`, `admin`, `money`) VALUES
(1, 'RusskijMir', 'ee34nf3o', 1, 500004);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
