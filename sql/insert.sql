-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Mai 2018 um 10:41
-- Server-Version: 10.1.31-MariaDB
-- PHP-Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `scr4`
--

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('Alex', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Andi', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Daniel', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Dave', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Maike', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW');

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`name`) VALUES
('Car'),
('Office'),
('Software'),
('Toys');

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`product_id`, `author`, `name`, `manufacturer`, `category`) VALUES
(1, 'Alex', 'Moyo Reifen', 'Moyo', 'Car'),
(2, 'Andi', 'Minecraft Account', 'Mojang/Microsoft', 'Software'),
(3, 'Daniel', 'Fidget Spinner', 'Chinaware', 'Toys'),
(4, 'Dave', 'Lenkrad Spielzeug', 'Carrera', 'Toys');

--
-- Daten für Tabelle `ratings`
--

INSERT INTO `ratings` (`rating_id`, `product_id`, `author`, `date`, `value`, `comment`) VALUES
(1, 1, 'Andi', '2018-05-19 10:40:45', 3, 'Ware ganz ok.'),
(2, 1, 'Maike', '2018-05-19 10:40:45', 1, 'Sehr gute Reifen'),
(3, 3, 'Andi', '2018-05-19 10:41:11', 1, 'Gutes Zeug!'),
(4, 3, 'Dave', '2018-05-19 10:41:11', 5, 'Braucht keiner!');


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
