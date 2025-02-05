-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Фев 05 2025 г., 18:54
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Documents`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Document`
--

CREATE TABLE `Document` (
  `Document_id` int NOT NULL,
  `Document_title` varchar(100) NOT NULL,
  `Document_content` text NOT NULL,
  `Document_data_create` date NOT NULL,
  `Document_last_modified` date NOT NULL,
  `Document_user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Document`
--

INSERT INTO `Document` (`Document_id`, `Document_title`, `Document_content`, `Document_data_create`, `Document_last_modified`, `Document_user_id`) VALUES
(83, 'Test', '&gt; I also make [Caret](https://caret.io?ref=parsedown) - a Markdown editor for Mac and PC.\r\n\r\n## Parsedown\r\n\r\n[![Build Status](https://img.shields.io/travis/erusev/parsedown/master.svg?style=flat-square)](https://travis-ci.org/erusev/parsedown)\r\n[![Total Downloads](http://img.shields.io/packagist/dt/erusev/parsedown.svg?style=flat-square)](https://packagist.org/packages/erusev/parsedown)\r\n\r\nBetter Markdown Parser in PHP\r\n\r\n[Demo](http://parsedown.org/demo) |\r\n[Benchmarks](http://parsedown.org/speed) |\r\n[Tests](http://parsedown.org/tests/) |\r\n[Documentation](https://github.com/erusev/parsedown/wiki/)\r\n\r\n### Features\r\n\r\n* One File\r\n* No Dependencies\r\n* Super Fast\r\n* Extensible\r\n* [GitHub flavored](https://help.github.com/articles/github-flavored-markdown)\r\n* Tested in 5.3 to 7.1 and in HHVM\r\n* [Markdown Extra extension](https://github.com/erusev/parsedown-extra)', '2025-02-05', '2025-02-05', NULL),
(85, 'New document', '', '2025-02-05', '2025-02-05', NULL),
(89, 'Ручной тест', '#fgh\r\n**hhkjdfg**  \r\nlkjljl\r\n***\r\n- ghghgh\r\n- ghgkhjk\r\n1. fhkhjkj\r\n2. nmbb\r\n\r\n***\r\n|столбец1|столбец2|столбец3|\r\n|-|:-:|-:|\r\n|gfg|hgh|jjhj|\r\n***\r\n[PHP][1] \r\n\r\n```\r\necho &quot;Hellos World!&quot;\r\n\r\n```\r\n***\r\n~~hkgfjhkj~~ __gkhjfg__ \r\n[1]: / &quot;язык программирование&quot;\r\n\r\n', '2025-02-05', '2025-02-05', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Document`
--
ALTER TABLE `Document`
  ADD PRIMARY KEY (`Document_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Document`
--
ALTER TABLE `Document`
  MODIFY `Document_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
