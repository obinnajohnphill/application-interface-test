Application Interface Test

- Installation: composer install

- Run Test: ./vendor/bin/phpunit tests

- Create a database

- Created tables:

CREATE TABLE customers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(30) NULL,
firstname VARCHAR(30) NULL,
lastname VARCHAR(30) NULL,
dob DATE NULL,
email VARCHAR(50),
intl_number INTEGER,
mobile_number INTEGER,
pwd VARCHAR(200),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);