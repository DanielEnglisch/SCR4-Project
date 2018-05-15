-- SCR4-Produktbewertungsportal SQL
-- v.1.1 - Daniel Englisch


-- Drop previous
DROP TABLE ratings;
DROP TABLE products;
DROP TABLE users;
DROP TABLE categories;
DROP FUNCTION IF EXISTS `getNumberOfRatings`;
DROP FUNCTION IF EXISTS `getAverageRating`;


-- Tables

CREATE TABLE users(
	username VARCHAR(20),
    password VARCHAR(64) NOT NULL,
    CONSTRAINT PRIMARY KEY (username)
);

CREATE TABLE categories(
  name  VARCHAR(20),
  CONSTRAINT PRIMARY KEY (name)
);

CREATE TABLE products(
    product_id Int AUTO_INCREMENT,
    author VARCHAR(20),
    name VARCHAR(30) NOT NULL,
    manufacturer VARCHAR(30) NOT NULL,
    category VARCHAR(20),
    CONSTRAINT PRIMARY KEY (product_id, author),
    CONSTRAINT FOREIGN KEY (author) REFERENCES users(username) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (category) REFERENCES categories(name) ON DELETE SET NULL
    
);

CREATE TABLE ratings(
    rating_id Int AUTO_INCREMENT,
    product_id Int,
    author VARCHAR(20) NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    value Int(1) NOT NULL,
    comment Text,
    CONSTRAINT PRIMARY KEY (rating_id, product_id),
    CONSTRAINT FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    CONSTRAINT FOREIGN KEY (author) REFERENCES users(username) ON DELETE CASCADE,
    CONSTRAINT ratings_value_check CHECK (`value`>=1 AND `value`<=5)

);

-- MySQL Routines

DELIMITER $$

-- getAverageRating(product_id)
CREATE DEFINER=`root`@`localhost` FUNCTION `getAverageRating` (`product_id` INT) RETURNS FLOAT BEGIN
 DECLARE res FLOAT;
 SELECT AVG(`value`) INTO res FROM ratings WHERE ratings.product_id = product_id;
 RETURN res;
END$$

-- getNumberOfRatings(product_id)
CREATE DEFINER=`root`@`localhost` FUNCTION `getNumberOfRatings` (`product_id` INT) RETURNS INT(11) NO SQL
BEGIN
 DECLARE res INT;
 SELECT COUNT(*) INTO res FROM ratings WHERE ratings.product_id = product_id;
 RETURN res;
END$$

DELIMITER ;