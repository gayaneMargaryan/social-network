-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 10 2017 г., 01:23
-- Версия сервера: 5.6.34
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `user_id`, `image`, `created`) VALUES
(5, 34, '5988f856080f6sea-star-wallpaper-1.jpg', '0000-00-00 00:00:00'),
(7, 34, '5988f8663c3f572ddd12.jpg', '0000-00-00 00:00:00'),
(8, 34, '5988fd3ba26c3apennine-mountains-italy-nature-hd-wallpaper-1920x1080-2500.jpg', '0000-00-00 00:00:00'),
(9, 34, '5988fd40e3bc7174589_zakat_priroda_1920x1080_(www.GetBg.net).jpg', '0000-00-00 00:00:00'),
(10, 34, '5988fd48646ce1b92c3b6704e2d1f2138b7355b0e1fd6.jpg', '0000-00-00 00:00:00'),
(11, 34, '5988fd4e7fe027cdd4654db6c.jpg', '0000-00-00 00:00:00'),
(12, 34, '5988fd688f7ebfonstola.ru-63530.jpg', '0000-00-00 00:00:00'),
(13, 34, '5988fd7b16d2dbranch_flowers_spring_90708_1920x1080.jpg', '0000-00-00 00:00:00'),
(14, 34, '5988fd83a3155IMG_167042.jpg', '0000-00-00 00:00:00'),
(15, 34, '5988fd8fafdd039615485-ships-wallpapers.jpeg', '0000-00-00 00:00:00'),
(16, 34, '5989bcfc7e951apennine-mountains-italy-nature-hd-wallpaper-1920x1080-2500.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `created`, `updated`) VALUES
(10, 34, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '2017-08-09 22:09:31', '0000-00-00 00:00:00'),
(11, 34, 'Lorem ipsum2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', '2017-08-09 22:13:47', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` enum('MALE','FEMALE','OTHER','') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL,
  `status` enum('ACTIVE','PENDING','DELETED','BANNED','NEW') DEFAULT 'NEW',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `email`, `gender`, `password`, `avatar`, `status`, `created`, `modified`) VALUES
(34, 'panda', 'panda', 'panda@mail.ru', 'OTHER', '$1$UL1.N04.$Zs4EvkcGuXyAZDZnyGqrb1', '5988ec4f1f1a7panda.jpg', 'NEW', '2017-08-04 20:56:00', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
