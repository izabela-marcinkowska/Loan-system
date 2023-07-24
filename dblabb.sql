-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: mariadb:3306
-- Tid vid skapande: 22 jul 2023 kl 10:38
-- Serverversion: 10.11.3-MariaDB-1:10.11.3+maria~ubu2204
-- PHP-version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `dblabb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` int(10) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumpning av Data i tabell `items`
--

INSERT INTO `items` (`id`, `type`, `description`) VALUES
(1, 1, 'Apple'),
(5, 4, 'iPhone');

-- --------------------------------------------------------

--
-- Tabellstruktur `itemtypes`
--

CREATE TABLE IF NOT EXISTS `itemtypes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumpning av Data i tabell `itemtypes`
--

INSERT INTO `itemtypes` (`id`, `name`) VALUES
(2, 'Book'),
(1, 'Fruit'),
(4, 'Phone');

-- --------------------------------------------------------

--
-- Tabellstruktur `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `loandate` timestamp NOT NULL DEFAULT current_timestamp(),
  `returndate` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `item` (`item`,`user`,`active`),
  KEY `fk_loan_user_id` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumpning av Data i tabell `loan`
--

INSERT INTO `loan` (`id`, `item`, `user`, `loandate`, `returndate`, `active`) VALUES
(1, 1, 1, '2023-07-19 19:15:41', '2023-07-30', 0),
(2, 5, 1, '2023-07-22 10:08:33', '2023-07-25', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`) VALUES
(1, 'loaner', 'loaner', 'loaner@example.com');

-- --------------------------------------------------------

--
-- Tabellstruktur `userdata`
--

CREATE TABLE IF NOT EXISTS `userdata` (
  `userid` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(64) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_itemtypes_id` FOREIGN KEY (`type`) REFERENCES `itemtypes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `fk_loan_items_id` FOREIGN KEY (`item`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_loan_user_id` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `userdata`
--
ALTER TABLE `userdata`
  ADD CONSTRAINT `fk_userdata_user_id` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
