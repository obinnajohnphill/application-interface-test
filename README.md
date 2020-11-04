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
email VARCHAR(200) NULL,
intl_number VARCHAR(50) NULL,
mobile_number VARCHAR(50) NULL,
pwd VARCHAR(200) NULL,
created_at DATETIME NULL
);

CREATE TABLE addresses (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
contact_name VARCHAR(100) NULL,
business_name VARCHAR(100) NULL,
address_one VARCHAR(100) NULL,
address_two VARCHAR(100) NULL,
city VARCHAR(50) NULL,
county VARCHAR(50) NULL,
country VARCHAR(10) NULL,
postcode VARCHAR(10) NULL,
address_type VARCHAR(30) NULL,
created_at DATETIME NULL
);