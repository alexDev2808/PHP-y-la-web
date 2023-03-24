DROP DATABASE IF EXISTS contacts_app;

CREATE DATABASE contacts_app;
USE contacts_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);

INSERT INTO users (name, email, password) VALUES ("J. Alexis", "test@test.com", "123456789");

CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    phone_number VARCHAR(255)
);

INSERT INTO contacts (name, phone_number) VALUES ("Alexis TH", "234552343455");