
INSERT INTO `users` (`username`, `password`) VALUES
('Alex', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Andi', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Daniel', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Dave', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW'),
('Maike', '$2y$10$raxGm9Th3GQpwwme1d9p5OS3wAVLWAIGDjWmftPfXVXoTxlupx8RW');

INSERT INTO `categories` (`name`) VALUES
('Car'),
('Office'),
('Software'),
('Toys');

INSERT INTO `products` (`product_id`, `author`, `name`, `manufacturer`, `category`) VALUES
(1, 'Alex', 'Moyo Reifen', 'Moyo', 'Car'),
(2, 'Andi', 'Minecraft Account', 'Mojang/Microsoft', 'Software'),
(3, 'Daniel', 'Fidget Spinner', 'Chinaware', 'Toys'),
(4, 'Dave', 'Lenkrad Spielzeug', 'Carrera', 'Toys');

INSERT INTO `ratings` (`rating_id`, `product_id`, `author`, `date`, `value`, `comment`) VALUES
(1, 1, 'Andi', '2018-05-19 10:40:45', 3, 'Ware ganz ok.'),
(2, 1, 'Maike', '2018-05-19 10:40:45', 1, 'Sehr gute Reifen'),
(3, 3, 'Andi', '2018-05-19 10:41:11', 1, 'Gutes Zeug!'),
(4, 3, 'Dave', '2018-05-19 10:41:11', 5, 'Braucht keiner!');


COMMIT;