-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2023 г., 12:04
-- Версия сервера: 10.2.43-MariaDB
-- Версия PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `url` varchar(60) NOT NULL,
  `cve` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `date_add` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `urls`
--

INSERT INTO `urls` (`id`, `id_user`, `url`, `cve`, `date_add`) VALUES
(45, 8, 'https://iitu.edu.kz/ru/', '[\"CVE-2019-11358\",\"CVE-2015-9251\"]', '2023-02-12 16:49:40'),
(46, 8, 'https://www.interpress.kz', '[\"CVE-2019-11358\"]', '2023-02-12 19:42:12');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `email`, `password`) VALUES
(8, 'asd', 'aidos', 'aidos@gmail.com', '1bbd886460827015e5d605ed44252251'),
(9, 'asd', 'aidos2', 'aidos2@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(10, '111', '111', '111@gmail.com', '1bbd886460827015e5d605ed44252251'),
(11, 'mina', 'mina', 'mina@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(12, 'mina', 'mina', 'mina@gmail.com', '25d55ad283aa400af464c76d713c07ad');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
