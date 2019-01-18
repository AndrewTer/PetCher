-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 19 2019 г., 02:22
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blablacat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ban`
--

CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `favourite_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `cost` int(11) NOT NULL,
  `other_information` text NOT NULL,
  `kind` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `owner_id`, `pet_id`, `date_out`, `date_in`, `cost`, `other_information`, `kind`) VALUES
(1, 1, 1, '2019-01-20', '2019-01-23', 5000, 'Улетаю по делам, нужно посидеть, подробности обговорим по телефону', 'current'),
(2, 1, 2, '2019-01-02', '2019-01-05', 2500, '', 'performed');

-- --------------------------------------------------------

--
-- Структура таблицы `pets`
--

CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `kind` varchar(50) DEFAULT NULL,
  `breed` varchar(100) NOT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `growth` double DEFAULT NULL,
  `other_information` text NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pets`
--

INSERT INTO `pets` (`id`, `owner_id`, `name`, `kind`, `breed`, `sex`, `weight`, `growth`, `other_information`, `photo`) VALUES
(1, 1, 'Бурбон', 'собака', 'бигль', 'мальчик', 12, 0.3, 'Хороший мальчик', 'andrey_burbon1.jpg'),
(2, 1, 'Анфиса', 'кошка', 'без породы', 'девочка', 5, 0.2, '', 'andrey_anfisa1.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `sitter_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `sitter_id` int(11) DEFAULT NULL,
  `mark` double DEFAULT NULL,
  `text` text,
  `hidden` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) DEFAULT NULL,
  `password` text,
  `role` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(50) NOT NULL,
  `rating` double DEFAULT NULL,
  `folder` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `full_name`, `password`, `role`, `phone_number`, `email`, `address`, `description`, `photo`, `rating`, `folder`) VALUES
(1, 'Андрей ', '41d8b17b7d2ed68df448e2f85447ec0c', 'owner', '+79213363348', 'andrej_terexin@mail.ru', 'Санкт-Петербург, улица Крюкова, дом 10', 'У меня двое домашних животных, кошка по кличке Анфиса и собака по кличке Бурбон. Души в них не чаю)', 'no', 0, 'andrey'),
(9, 'Андрей Терехин', '41d8b17b7d2ed68df448e2f85447ec0c', 'owner', '', 'andrewcter@gmail.com', '', '', 'no', 0, ''),
(10, 'Крутой Чел', '41d8b17b7d2ed68df448e2f85447ec0c', 'owner', '', 'krutoy@yandex.ru', '', '', 'no', 0, 'krutoy-chel10');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
