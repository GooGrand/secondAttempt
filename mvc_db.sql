-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 12 2020 г., 06:43
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mvc_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `birthday`, `password`, `admin`) VALUES
(14, 'admin', 'admin', 'admin@lol.ru', '2020-06-16', '$2y$10$pXkE7MkiIBD/Kk1jP3t7TOYu.b/s1iy4Ki.YWxFt9a7QEtP8XuzmG', 1),
(22, '141412313', '1414', '1414@1414.14', '2020-06-28', '$2y$10$SLxOlbLnGpP4tm9eezdmWuaDN6ecTMU6x1zt8AZPoB7KBjLr5pCUC', 0),
(29, '141414', '141414', 'sha2231rkanovnikita@gma22l.com', '2020-06-15', '$2y$10$uD7P08L6mMWJxMoommIDI.4zGRdkxc9xNgoKYZ39nxYg1ndHsj/te', 0),
(30, '12313131313', '12333332232', '11313@2222222.ewe', '2020-06-22', '$2y$10$c8Wbfbh60HWeFOA/k5.Ng.VHZH.PzvxWICennIjDwG32tHABzp/f6', 0),
(32, '13', '13', '13@13.122', '2020-06-08', '$2y$10$1ydZrKUSbFGmrPvDIpcvE.7n1Vg2XhAckpNEuejhz4P9Je5Uwh6Qe', 0),
(33, 'qweq', 'qwe', 'qwe@qwe.qwe', '2020-06-27', '$2y$10$IDKsB7ic0hro.YRGeTZ5quQqc/EEICSkwgrfkIKdKryx2LZCS0MI6', 0),
(34, 'Nikita Valer\'evich', 'Valer\'evich', '13131313@13.1111', '2020-06-14', '$2y$10$90.5fLS6YBJwaSi5x7I9V.AI.ztHucduUBOkto45Fe0cMJVKxquqy', 0),
(35, '123', '3232323', '123@131313.23', '2020-04-13', '$2y$10$6N7EXN6CkLKTiHvNtbw29uM.A6Bk8WRL0547KlBHeG5nr1Rbg9wvO', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
